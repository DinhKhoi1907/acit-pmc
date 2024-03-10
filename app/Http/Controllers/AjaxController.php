<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Http\Traits\SupportTrait;

use App\Jobs\SendEmail;
use App\Mail\MailNotify;

use App\Models\Places;
use App\Models\Order;
use App\Models\Cart;
use App\Models\User;

use App\Payment\Alepay;
use App\Payment\NganLuong;

use DB, Session;

use Helper, Thumb;
use CartHelper, Mail;



class AjaxController extends Controller
{

    use SupportTrait;

    public function IsCODAjax(Request $request){
        $selected_value = $request->selected_value;
        $voucher_code = $request->voucher_code;
        $dienthoai = $request->dienthoai;
        $ship = $request->ship;
        

        $json['result'] = true;
        $json['text'] = "";
        $json['icon'] = 'warning';

        if($selected_value=="COD"){
            $id_login=Helper::GetCookie('login_member_id');
            $token_member_cart = Helper::GetCookie('member_cart');

            $mode_cart = new Cart();
            if($id_login>0){
                $mode_cart = $mode_cart->where('id_user',$id_login);
            }else{
                $mode_cart = $mode_cart->where('id_user',0)->where('token_member_cart',$token_member_cart);
            }
            $row_exist = $mode_cart->get();
            $row_exist = ($row_exist) ? $row_exist->toArray() : null;

            $array_product = array();
            if($row_exist){
                foreach($row_exist as $k=>$v){
                    $proinfo = CartHelper::get_product_info($v['id_product'],$v['size'],$v['mau']);
                    if($proinfo['COD']==0){
                        $json['result'] = false;
                        $json['text'] = __("Tồn tại sản phẩm không hỗ trợ phương thức COD, quý khách vui lòng cập nhật lại giỏ hàng hoặc chọn phương thức thanh toán khác !");
                        $json['icon'] = 'warning';
                        break;
                    }
                }
            }            
        }


        if($selected_value=="alepay-domestic"){
            //### Lấy thông tin giỏ hàng
            //$model = new Cart();
            //### lấy tổng số tiền của đơn hiện tại
            $id_login = Helper::GetCookie('login_member_id');
            $token_member_cart = Helper::GetCookie('member_cart');
            $tongtien = CartHelper::get_order_total($id_login,$token_member_cart);

            if($tongtien<3000000){//### ko đạt đk trả góp
                $json['result'] = false;
                $json['text'] = __("Đơn hàng chưa đủ điều kiện áp dụng phương thức thanh toán trả góp. Giá trị tối thiểu của đơn hàng là 3.000.000 VND");
                $json['icon'] = 'warning';
            }else{
                if($dienthoai==''){
                    $json['result'] = false;
                    $json['text'] = __("Vui lòng nhập số điện thoại");
                    $json['icon'] = 'warning';
                }else{
                    $row = $this->couponRepo->GetItem(['ma'=>$voucher_code, 'hienthi'=>1]);

                    //### Kiểm tra voucher và phí ship ==> số tiền sau giảm
                    $tongtien_saucung = $tongtien;
                    if($row){ // nếu voucher tồn tại
                        $model_order = new Order();
                        $user_ordered = $model_order->where('dienthoai',$dienthoai)->where('voucher_code',$voucher_code)->get();

                        //###
                        $solan_cothesudung = $row['solan'] - $row['solan_dadung'];
                        $solan_duoc_dung = $row['dung_nhieulan'];
                        $sotien_toithieu = $row['min_price'];
                        $thongtin_voucher = $row['noidungvi'];
                        

                        //### lấy tổng số tiền của đơn hiện tại
                        $id_login = Helper::GetCookie('login_member_id');
                        $token_member_cart = Helper::GetCookie('member_cart');
                        $tongtien = CartHelper::get_order_total($id_login,$token_member_cart);
                        $sotien_duocgiam = 0;

                        //## lấy số tiền được giảm dựa trên loại giảm và mức giảm
                        if($row['loaigiam']==0){ // nếu loại giảm là theo số tiền
                            $sotien_duocgiam = $row['mucgiam'];
                        }else{ // nếu loại giảm là theo phần trăm
                            $sotien_duocgiam = (($row['mucgiam']*$tongtien)/100);
                        }

                        $tongtien_saucung = $tongtien - $sotien_duocgiam + $ship;
                    }


                    //## Lấy thông tin ds ngân hàng trả góp Alepay
                    $tientragopdinhky = $tongtien_saucung;
                    $listTragop = $this->GetInstallment($tientragopdinhky);

                    $response['listTragop'] = $listTragop;
                }
            }
        }

        $response['json'] = $json;

        return view('desktop.templates.cart.listTragop')->with($response);
       // return json_encode($json);
    }


    private function GetInstallment($tientragopdinhky){
        //### Lấy config payment
        $config_nganluong = config('payment')['alepay'];
        $config_nganluong_active = $config_nganluong['active'];
        $config_nganluong = $config_nganluong[$config_nganluong['type']];
        if ($config_nganluong_active) {
            //Alepay
            $alepay = new Alepay($config_nganluong);
            $result = $alepay->getInstallmentInfo($tientragopdinhky); 
            if($result->code){
                return json_decode(json_encode($result->data), true);
                //return $result->data;
            }else{
                return null;
            } 
        }

        return null;
    }
    

    public function Filter(Request $request){
        $data = $request->data;
        $param = array();
        $pagePer = 20;
        $arr_price = config('config_all.filter_price');
        $giamin = $arr_price[$request->giamin];
        $giamax = $arr_price[$request->giamax];

        //$page = ($request->page) ? $request->page : 1;
        //dd($request->page);
        $arr_tmp = $product_ids = array();
        if(isset($data)){
            foreach($data as $k=>$v){
                if($k==0 && $v!=null){
                    $param[$k] = $v;
                }else{
                    //### $k là id nhóm thuộc tính | $v là id thuộc tính
                    if($v!=null){
                        $tmp = explode("-", $k);
                        $param[$tmp[0]] = $v;
                    }
                }
            }
        }
        
        if(isset($param) && $param!=null){
            //$product_ids = array();
            $key_first = array_key_first($param);
            $val_first = $param[$key_first];
            $arr_tmp = (is_string($key_first)) ? array_slice($param, 1) : $param;

            if($arr_tmp){
                $product_ids = $this->productPropertyRepo->Query()->selectRaw('id_product, count(id_product) as sl')->whereIn('id_value', $arr_tmp)->havingRaw('sl = '.count($arr_tmp))->get()->pluck('id_product');
            }
            $product_ids = ($product_ids) ? $product_ids->toArray() : null;
        }


        //### Lấy ds sản phẩm dựa theo các đk trên
        if(isset($product_ids) && count($product_ids)>0){
            $products = $this->productRepo->Query()->where('type','product')->whereBetween('gia', [$giamin, $giamax]);
            if (is_string($key_first)) {
                $products = $products->where($key_first,$val_first);
            }
            if($product_ids){
                $products = $products->whereIn('id', $product_ids)->orderBy('stt', 'asc');
            }
            $products = $products->paginate($pagePer)->withQueryString();
            $products = ($products->count()>0) ? $products : null;
                
        }else{            
            if(count($arr_tmp)>0 && count($product_ids)==0){
                $products = null;
            }else{                
                if(!$product_ids && (isset($key_first) && !is_string($key_first))){
                    $products = null;
                }else{
                    $products = $this->productRepo->Query()->where('type','product')->whereBetween('gia', [$giamin, $giamax]);
                    if (isset($key_first) && is_string($key_first)) {
                        $products = $products->where($key_first,$val_first);
                    }     
                    $products = $products->paginate($pagePer)->withQueryString();
                    $products = ($products->count()>0) ? $products : null;
                }
            }
        }

        $response = array(
            "products" => $products
        );

        return view('desktop.layouts.products')->with($response);
    }

    
    public function FilterKC(Request $request){
        $type='kimcuong';
        $data = $request->data;
        $valueMinLy = $request->valueMinLy;
        $valueMaxLy = $request->valueMaxLy;
        
        $valueMin = $request->valueMin;
        $valueMax = $request->valueMax;

        $param = array();
        $pagePer = 20;

        $ids_product = $products = $arr_ids = array();

        //### kiểm tra từng nhóm thuộc tính theo loại hình ảnh
        if($data){
            foreach($data as $k=>$v){
                $arr_tmp = explode('-',$k);
                $ids_product_tmp = $this->productPropertyRepo->Query()->where('id_value',$v)->where('id_property',$arr_tmp[0]);
                if($ids_product){
                    $ids_product_tmp = $ids_product_tmp->whereIn('id_product',$ids_product);
                }
                $ids_product = $ids_product_tmp->pluck('id_product');
            }
        }


        $checkRoll = true; //### dùng để kiểm tra từng nhóm thuộc tính
        foreach($valueMin as $k => $v){
            if(!$checkRoll) //### nếu còn đk cho phép kiểm tra
                break;
                
            $id_propertyParent = $k;
            $stt_min = $v;
            $stt_max = $valueMax[$k];
            
            //### lấy ds thuộc tính KC có stt từ min tới max
            $result = $this->postRepo->Query()->where('type',$type)->where('ids_level_1',$id_propertyParent)->whereBetween('stt',[$stt_min+1, $stt_max+1])->get()->pluck('id');
            $ids = ($result) ? $result->toArray() : null;
            
            if($ids){
                //### từ ids thuộc tính tìm được ==> lấy ids_product theo ids thuộc tính
                $ids_product_tmp = $this->productPropertyRepo->Query()->whereIn('id_value',$ids);
                if($ids_product){
                    $ids_product_tmp = $ids_product_tmp->whereIn('id_product',$ids_product);
                }
                $ids_product_tmp = $ids_product_tmp->get()->pluck('id_product');
                $ids_product = ($ids_product_tmp) ? $ids_product_tmp->toArray() : null;

                $checkRoll = ($ids_product) ? true : false; //### nếu sau khi kiểm tra tồn tại ids product thỏa đk thì thiết lập cho phép chạy kiểm tra tiếp . Ngược lại thiết lập dừng kiểm tra
            }
        }

        if($ids_product){
            $relations = $this->productRepo->Query()->GetRelations();
            $products = $this->productRepo->Query()->with($relations)->where('type',$type)->whereBetween('ly', [$valueMinLy, $valueMaxLy])->whereIn('id',$ids_product)->where('hienthi',1)->paginate($pagePer)->withQueryString();
        }

        //### lấy thông tin ds thuộc tính lọc và nhóm lọc
        $thuoctinhs = $this->categoryRepo->GetAllItems($type,['level'=>0]);
        $thuoctinhsNB = $this->categoryRepo->GetAllItems($type,['level'=>0,'noibat'=>1]);

        $response = array(
            "products" => $products,
            "thuoctinhs" => $thuoctinhs,
            "thuoctinhsNB" => $thuoctinhsNB
        );

        return view('desktop.layouts.productsKC')->with($response);
    }
    

    public function AddLikePost(Request $request){

        if(Auth::guard()->check()){
            $model_user = new User();
            $user = Auth::guard()->user();
            $id = $request->id;

            //### lấy thông bài viết
            $row = $this->productRepo->GetOneItem($id);

            $list_like = explode(',', $user['likes']);
            $list_like = array_filter($list_like);
                   
            if(in_array($row['id'], $list_like)){
                $pos = array_search($row['id'], $list_like);
                unset($list_like[$pos]);

                //$data['likes'] = implode(',', $list_like);
                $update = User::find($user['id']);
                $update->likes = implode(',', $list_like);
                $update->save();
                //$row = $this->productRepo->SaveItem($data,$id);

                $json['result'] = false;
                $json['text'] = __("Xóa khỏi danh sách sản phẩm yêu thích !");
                $json['icon'] = 'warning';
                //$json['count'] = count(array_filter(explode(',', $user['likes'])));
            }else{
                array_push($list_like, $row['id']);
                $update = User::find($user['id']);
                $update->likes = implode(',', $list_like);
                $update->save();
                //$data['likes'] = implode(',', $list_like);
                //$row = $this->productRepo->SaveItem($data,$id);

                $json['result'] = true;
                $json['text'] = __("Đã thêm vào danh sách sản phẩm yêu thích !");
                $json['icon'] = 'success';
                //$json['count'] = count(array_filter(explode(',', $user['likes'])));
            }

        }else{
            $json['result'] = false;
            $json['text'] = __('Chỉ thành viên mới được thực hiện chức năng này !');
            $json['icon'] = 'warning';
        }

        return json_encode($json);
    }
    
    
    public function Checktoturial(Request $request){
        $sestion = $request->sesition;
        $request->session()->put('toturial', $sestion);
    }


    public function LoadCategoryChildAjax(Request $request){
        $id = $request->id;
        $id_lv2 = $request->id_lv2;
        $categories = $this->categoryRepo->GetAllItems('tintuc',['level_1'=>$id, 'hienthi'=>1]);

        $response = array(
            "categories" => $categories,
            "id_lv2" => $id_lv2
        );

        return view('desktop.templates.ajax.show_category')->with($response);
    }


    public function LoadVideoHomeAjax(Request $request){
        $id = $request->id;

        $post = $this->postRepo->GetItem(['id'=>$id, 'hienthi'=>1]);

        $response = array(            
            "post" => $post
        );

        return view('desktop.templates.ajax.show_video_home')->with($response);
    }

    public function LoadProductHomeAjax(Request $request){
        $id = $request->id;
        $type = $request->type;
        $level = $request->level;

        $param_tmp = array();
        if($id>0) {$param_tmp['ids_level_'.($level+1)] = $id;}
        $param_tmp['hienthi'] = 1;
        //$param_tmp['noibat'] = 1;
        
        //## tin video nổi bật
        $model_product = $this->productRepo; 
        $products = $model_product->GetAllItems('product',$param_tmp);

        if(config('config_all.data_demo')){
            if($products){
                $arr_tmp = array();
                for($i=0;$i<16;$i++){
                    $arr_tmp = array_merge($products, $arr_tmp);
                }
                $products = $arr_tmp;        
            }      
        }  

        $response = array(
            "products" => $products
        );

        return view('desktop.templates.ajax.show_product_home')->with($response);
    }



    public function LoadPostHomeAjax(Request $request){
        $id = $request->id;
        $type = $request->type;

        $param_tmp = array();
        //$param_tmp['hienthi'] = 1;
        
        //## tin video nổi bật
        $model_post = $this->productRepo;
        $model_post = $model_post->Query()->where('type',$type)->where('id',$id);
        if($param_tmp){
            foreach($param_tmp as $k=>$v){
                $model_post = $model_post->where($k,$v);
            }
        }
        $posts = $model_post->first();

        $response = array(
            "posts" => ($posts) ? $posts->toArray() : null
        );

        return view('desktop.templates.ajax.show_post_home')->with($response);
    }


    public function LoadPostDetailHomeAjax(Request $request){
        $id = $request->id;
        $type = $request->type;

        $param_tmp = array();
        $param_tmp['hienthi'] = 1;
        
        //## tin video nổi bật
        $model = $this->productRepo;
        $relations = $model->Query()->GetRelations();
        $model = $model->Query()->with($relations)->where('type',$type)->where('id',$id);
        if($param_tmp){
            foreach($param_tmp as $k=>$v){
                $model = $model->where($k,$v);
            }
        }
        $product = $model->first();

        $thuoctinhs = $this->categoryRepo->GetAllItems($type,['level'=>0]);

        $response = array(
            "product" => ($product) ? $product->toArray() : null,
            "thuoctinhs" => $thuoctinhs
        );

        return view('desktop.templates.ajax.show_postdetail_home')->with($response);
    }


    public function SearchCuahang(Request $request){
        $id_city = $request->id_city;

        $cuahangs = $this->postRepo->GetAllItems('cuahang', ['id_city'=>$id_city]);

        $response = array(
            "cuahangs" => $cuahangs
        );

        return view('desktop.templates.ajax.show_cuahang')->with($response);
    }


    public function LoadCuahang(Request $request){
        $id = $request->id;

        $cuahang_item = $this->postRepo->GetItem(['id'=>$id]);

        $response = array(
            "cuahang_item" => $cuahang_item
        );

        return view('desktop.templates.ajax.load_cuahang')->with($response);
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy ds đánh giá theo type
    |--------------------------------------------------------------------------
    */
    public function FilterCategory(Request $request){
        $array_category_id = $request->array_category_id;
        $array_brand_id = $request->array_brand_id;
        $str_category = $str_brand = '';
        $arr_category = $arr_brand = array();


        if($array_category_id!=''){
            $str_tmp = '';
            $array_category_id = explode(',', $array_category_id);

            foreach($array_category_id as $k=> $v){
                $row = $this->categoryRepo->GetItem(['tenkhongdauvi' => $v]);

                if($row){
                    array_push($arr_category, $row['id']);
                }                
            }
        }


        if($array_brand_id!=''){
            $str_tmp = '';
            $array_brand_id = explode(',', $array_brand_id);

            foreach($array_brand_id as $k=> $v){
                $row = $this->brandRepo->GetItem(['tenkhongdauvi' => $v]);

                if($row){
                    array_push($arr_brand, $row['id']);
                }
            }
        }

        $run = $this->productRepo->Query();
        if($arr_category){
            $str_tmp = '';
            foreach($arr_category as $k=>$v){
                if($k>0 && $k<count($arr_category)){
                    $str_tmp .= ' or ';
                }
                $str_tmp .= 'FIND_IN_SET('.$v.',ids_level_3)';
            }        
            if($str_tmp!=''){
                $str_category .= '('.$str_tmp.')';
            }
            $run = $run->whereRaw($str_category);    
        }

        if($arr_brand){
            $str_tmp = '';
            foreach($arr_brand as $k=>$v){
                if($k>0 && $k<count($arr_brand)){
                    $str_tmp .= ' or ';
                }
                $str_tmp .= 'id_brand='.$v;
            }        
            if($str_tmp!=''){
                $str_brand .= '('.$str_tmp.')';
            }
            $run = $run->whereRaw($str_brand);
        }

        $items = $run->where('hienthi',1)->orderBy('stt', 'asc')->paginate(21)->withQueryString();

        $response = array(
            "products" => $items
        );

        return view('desktop.templates.ajax.show_categoryproduct')->with($response);
    }



    /*
    |--------------------------------------------------------------------------
    | Lấy ds đánh giá theo type
    |--------------------------------------------------------------------------
    */
    public function ChangeDanhGia(Request $request){
        $type = $request->type;
        $id_product = $request->id_product;
        $params = [];
        $model = $this->danhgiaRepo->Query();

        switch ($type) {
            case 'all':
                $result =  $model->where('id_product',$id_product)->where('hienthi',1);
                break;

            case 'text':
                $result =  $model->where('id_product',$id_product)->where('noidungvi','<>','')->where('hienthi',1);
                break;

            case 'photo':
                $result =  $model->where('id_product',$id_product)->where('photo','<>','')->where('hienthi',1);
                break;
        }

        if($result){
            $result = $result->paginate(20)->withQueryString();

            //### Trả về giao diện
            $response = array(
                'danhgia_list'=>$result
            );

            return view('desktop.templates.ajax.danhgia')->with($response);
        }        
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy ds câu hỏi Theo id_category
    |--------------------------------------------------------------------------
    */
    public function AddDanhGia(Request $request){
        $photo_json = [];
        $photos_arr = $request->photos;

        if($photos_arr){
            foreach($photos_arr as $k=>$v){
                $arr_tmp = json_decode($v,true);                
                array_push($photo_json, $arr_tmp['name']);
                Helper::saveImgBase64($arr_tmp['data'],$arr_tmp['name']);
            }
        }


        //### check rating
        $order = new Order();
        $checkOrder = $order->GetItem(['dienthoai'=>$request->rating_phone]);
        
        if(!$checkOrder){
            $json['result'] = false;
            $json['text'] = __('Bạn không thể đánh giá khi chưa mua sản phẩm này.');
            $json['icon'] = 'warning';
        }else{
            //### check đã đánh giá sản phẩm hiện tại?
            $check_danhgia = $this->danhgiaRepo->Getitem(['id_product'=>$request->rating_id_product, 'dienthoai'=>$request->rating_phone]);
            if($check_danhgia){
                $json['result'] = false;
                $json['text'] = __('Bạn đã đánh giá về sản phẩm này.');
                $json['icon'] = 'warning';
            }else{
                $data['noidungvi'] = $request->rating_content;

                if(Auth::guard()->check()){
                    $user = Auth::guard()->user(); 
                    $data['tenvi'] = $user['name'];
                    $data['dienthoai'] = $user['phonenumber'];
                    $data['email'] = $user['email'];
                    $data['user'] = $user['id'];
                }else{
                    $data['tenvi'] = $request->rating_name;
                    $data['dienthoai'] = $request->rating_phone;
                    $data['email'] = $request->rating_email;
                    $data['user'] = $request->rating_email;
                } 
                $data['star'] = $request->rating_count_star;
                $data['id_product'] = $request->rating_id_product;
                $data['ngaytao'] = time();
                $data['photo'] = ($photo_json) ? json_encode($photo_json) : ''; //json

                if($this->danhgiaRepo->SaveItem($data)){
                    $json['result'] = true;
                    $json['text'] = __('Đã gửi thông tin đánh giá. Chờ quản trị viên xét duyệt');
                    $json['icon'] = 'success';
                }else{
                    $json['result'] = false;
                    $json['text'] = __('Có lỗi xảy ra. Gửi thông tin thất bại');
                    $json['icon'] = 'warning';
                }
            }

            return json_encode($json);
        }

        return json_encode($json);
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy ds câu hỏi Theo id_category
    |--------------------------------------------------------------------------
    */
    public function ChangeQuestion(Request $request){
        $id = $request->id;  
        $keyword = $request->keyword;   
        $is_pagination = $request->is_pagination;

        $type = $request->type;  
        $model = $request->model;  

        $param['type'] = $type;
        $param['model'] = $model;
        $param['duyettin'] = 1;
        $param['hienthi'] = 1;

        if($keyword!=''){
            $param['keyword_filter'] = $keyword;
        }
        
        if($id){
            $param['id_item'] = $id;
        }


        $question = ($is_pagination) ? $this->questionRepo->GetQuestions($param,null,true) : $this->questionRepo->GetQuestions($param);
        //dd($is_pagination);
        //### Trả về giao diện
        $response = array(
            'question'=>$question
        );

        return view('desktop.templates.ajax.question')->with($response);
    }


    /*
    |--------------------------------------------------------------------------
    | Thêm câu hỏi
    |--------------------------------------------------------------------------
    */
    public function AddQuestion(Request $request){
        $data = $request->hoidap;
        $data['ngaytao'] = time();
        $data['hienthi'] = 1;

        $json['result'] = false;
        $json['text'] = 'Có lỗi xảy ra. Gửi thông tin thất bại';

        if($this->questionRepo->SaveItem($data,null)){
            $json['result'] = true;
            $json['text'] = 'Gửi câu hỏi thành công.';
        }
        return json_encode($json);
    }


    /*
    |--------------------------------------------------------------------------
    | Kiểm tra giỏ hàng
    |--------------------------------------------------------------------------
    */
    public function CheckCartAjax(Request $request){
        //### thiết lập
        $id_login=Helper::GetCookie('login_member_id');
        $token_member_cart = Helper::GetCookie('member_cart');

        //$setting = app('setting');
        //if($setting['isSoluong']==1){
        if((config('config_all.order.soluong') || config('lazada.active'))){
            //### xử lý
            $mode_cart = new Cart();
            if($id_login>0){
                $mode_cart = $mode_cart->where('id_user',$id_login);
            }else{
                $mode_cart = $mode_cart->where('id_user',0)->where('token_member_cart',$token_member_cart);
            }
            $row_exist = $mode_cart->get();
            $row_exist = ($row_exist) ? $row_exist->toArray() : null;

            $array_product = array();
            $is_success = true;
            if($row_exist){
                foreach($row_exist as $k=>$v){
                    $proinfo = CartHelper::get_product_info($v['id_product'],$v['size'],$v['mau']);
                    if($proinfo['soluong_website']<$v['soluong']){
                        $array_product[$v['code']] = $proinfo['soluong_website'];
                        $is_success = false;
                    }
                }
            }


            //### trả kết quả
            $data['success'] = $is_success;
            $data['data'] = $array_product;
        }else{
            $data['success'] = true;
        }
        
        return json_encode($data);
    }


    public function LoadJsAjax(Request $request){
        return view('desktop.templates.ajax.js_afterload');
    }

     
    /*
    |--------------------------------------------------------------------------
    | Load data product list
    |--------------------------------------------------------------------------
    */
    public function LoadProductList(Request $request){
        $id = $request->id;
        $type = $request->type;

        $products = $this->productRepo->Query()->whereRaw('FIND_IN_SET("'.$id.'", ids_level_1)')->get();

        $response = array(
            'products' => ($products) ? $products->toArray() : null
        );

        return view('desktop.layouts.product_top')->with($response);
    }


    public function LoadPostList(Request $request){
        $type = $request->type;

        $params['noibat'] = 1;
        $params['hienthi'] = 1;
        $items = $this->postRepo->GetAllItems($type,$params);

        $response = array(
            'items'=>$items,
            'type' => $type
        );
        return view('desktop.templates.ajax.post_list')->with($response);
    }


    /*
    |--------------------------------------------------------------------------
    | Phân trang ajax theo model và type
    |--------------------------------------------------------------------------
    */
    public function PaginationAjax(Request $request){
        $model = $request->model;
        $category = $request->category;
        $type = $request->type;
        switch ($model) {
            case 'product':
                $model = $this->productRepo;
                break;
            case 'post':
                $model = $this->productRepo;
                break;
        }

        $items = $model->GetAllItems($type,null, null, true);

        $response = array(
            'items'=>$items
        );
        return view('desktop.templates.ajax.pagination')->with($response);
    }


    /*
    |--------------------------------------------------------------------------
    | Chi tiết sản phẩm
    |--------------------------------------------------------------------------
    */
    public function ProductDetailAjax(Request $request){
        //### Khai báo model xử lý
        /*$model_option = new ProductOption();
        $model_gallery = new Gallery();
        $model_size = new Size();*/

        $model_option = $this->productOptRepo;
        $model_gallery = $this->galleryRepo;
        $model_size = $this->sizeRepo;
        $lang = session('lang');
        $data = array();

        //### Khai báo biến
        $size = $request->size;
        $mau = $request->mau;
        $id = $request->id;
        $cmd = $request->cmd;

        //kiểm tra size theo màu
        $size_ProOption = $model_option->GetAllItemsByParamsPluck('id_size',['type'=>'product', 'id_product'=>$id, 'id_mau'=>$mau, 'xoatam'=>0, 'hienthi'=>1]);
        $size_exist = $model_size->GetAllItemByIds($size_ProOption);
        $size_str = '';

        if($size_exist){
            foreach ($size_exist as $key => $value){
                $active = ($key==0)?'active':'';
                $checked = ($key==0)?'checked':'';
                $size_str.='<a class="mr-1 size-pro-detail text-decoration-none '.$active.' " data-id="'.$id.'">';
                    $size_str.='<input type="radio" value="'.$value['id'].'" class="detail__properties-items js-select-variant" name="size-pro-detail" '.$checked.'>';
                $size_str.=$value['ten'.$lang].'</a>';
            }
        }
        
        $size = ($cmd=='color_click' && isset($size_exist) && !empty($size_exist)) ? (($size_exist[0]['id'])?$size_exist[0]['id']:$size) : $size;

        //chi tiết sản phẩm
        $detail = $model_option->GetItem(['type'=>'product', 'id_product'=>$id, 'id_size'=>$size, 'id_mau'=>$mau]);
        $data['sku']=$detail['masp'];
        $data['photo']=Thumb::Crop(UPLOAD_PRODUCT,$detail['photo'],1108,1240,2,$detail['type']);
        $data['giamoi'] = ($detail['giamoi']>0) ? Helper::Format_Money($detail['giamoi']) : Helper::Format_Money($detail['gia']);
        $data['gia'] = ($detail['giamoi']>0) ? Helper::Format_Money($detail['gia']) : '';
        $data['giakm'] = ($detail['giakm']>0) ? $detail['giakm'] : 0;

        if(!config('config_all.order.soluong') && !config('lazada.active')){
            $data['is_soluong'] = true;
        }else{
            $data['is_soluong'] = ($detail['soluong_website']>0) ? true : false;
        }
    
        //$data['cotheban_tmp']=$detail['cotheban_tmp'];
        $data['size'] = $size_str;

        return json_encode($data);
    }


    public function ProductGalleryAjax(Request $request){
        $model_option = $this->productOptRepo;
        $model_gallery = $this->galleryRepo;
        $model_size = $this->sizeRepo;
        $lang = session('lang');    
        $data = array();    

        //### Khai báo biến
        $size = $request->size;
        $mau = $request->mau;
        $id = $request->id;
        $cmd = $request->cmd;

        if($mau){
            $gallery_color = $this->galleryRepo->GetAllItems('product_color',['id_photo'=>$id, 'id_color'=>$mau]);
        }
        
        $response = array(
            'gallery_color'=>$gallery_color
        );

        return view('desktop.layouts.product_gallery')->with($response);
    }


    /*
    |--------------------------------------------------------------------------
    | Đặt hàng
    |--------------------------------------------------------------------------
    */

    public function IsProduct($id,$mau,$size){
        $is_proOption = $this->productOptRepo->GetItem(['id_product'=>$id, 'id_mau'=>$mau, 'id_size'=>$size, 'xoatam'=>0, 'hienthi'=>1]);
        return (!$is_proOption) ? false : true;
    }

    public function IsProductParent($id,$mau,$size){
        $params['id'] = $id;
        $params['hienthi'] = 1;
        if($mau!=0){$params['id_mau'] = $mau;}
        if($size!=0){$params['id_size'] = $size;}

        $is_proOption = $this->productRepo->GetItem($params);
        return (!$is_proOption) ? false : true;
    }


    public function CheckVoucherAjax(Request $request, $ship=0){
        $json_arr = array();
        $data_req = $request->toArray();
        $voucher_code = $request->voucher_code;
        $dienthoai = $request->dienthoai;
        $ship = ($ship==0) ? $data_req['ship'] : 0;


        if($voucher_code==''){
            $ship=0;
        }

        if($dienthoai==''){
            $json_arr['status'] = false;
            $json_arr['text'] = __('Bạn cần nhập số điện thoại ở mục THÔNG TIN GIAO HÀNG trước khi sử dụng mã giảm giá');

        }else{
            $row = $this->couponRepo->GetItem(['ma'=>$voucher_code, 'hienthi'=>1]);
            
            if($row){ // nếu voucher tồn tại
                $json_arr['status'] = true;
                $json_arr['text'] = __('Mã giảm giá hợp lệ');
                $json_arr['thongtin'] = '';
                $json_arr['sotien_duocgiam'] = $json_arr['tongtien_saugiam'] = 0;
                $json_arr['sotien_duocgiam_text'] = $json_arr['tongtien_saugiam_text'] = '0đ';

                $model_order = new Order();
                //$user_exist = $model_order->where('dienthoai',$dienthoai)->get();
                $user_ordered = $model_order->where('dienthoai',$dienthoai)->where('voucher_code',$voucher_code)->get();


                //###
                $solan_cothesudung = $row['solan'] - $row['solan_dadung'];
                $solan_duoc_dung = $row['dung_nhieulan'];
                $sotien_toithieu = $row['min_price'];
                $thongtin_voucher = $row['noidungvi'];
                

                //### lấy tổng số tiền của đơn hiện tại
                $id_login = Helper::GetCookie('login_member_id');
                $token_member_cart = Helper::GetCookie('member_cart');

                $tongtien = CartHelper::get_order_total($id_login,$token_member_cart);
                $sotien_duocgiam = 0;


                //## lấy số tiền được giảm dựa trên loại giảm và mức giảm
                if($row['loaigiam']==0){ // nếu loại giảm là theo số tiền
                    $sotien_duocgiam = $row['mucgiam'];
                }else{ // nếu loại giảm là theo phần trăm
                    $sotien_duocgiam = ($row['apdungcho']==0) ? (($row['mucgiam']*$tongtien)/100) : CartHelper::get_order_coupon($id_login,$token_member_cart,$row);
                }
              
                if(time()<$row['ngaybatdau'] || time()>$row['ngayketthuc']){ // nếu voucher không còn trong thời gian sử dụng
                    $json_arr['status'] = false;
                    $json_arr['text'] = __('Mã giảm giá không tồn tại');

                }else if($solan_cothesudung<=0){ // nếu voucher ko còn lượt sử dụng
                    $json_arr['status'] = false;
                    $json_arr['text'] = __('Mã giảm giá đã hết lượt áp dụng');

                }else if($solan_duoc_dung==0 && count($user_ordered)>0){ // đk: voucher chỉ dc dùng cho 1 lần đặt hàng và nếu đã có đơn đặt trước đó=> ko thể dùng voucher
                    $json_arr['status'] = false;
                    $json_arr['text'] = __('Mã giảm giá đã được sử dụng cho lần đặt hàng trước');
                }else if($tongtien<$sotien_toithieu){ // nếu tổng tiền của đơn hiện tại < số tiền tối thiểu mà voucher quy định => false
                    $json_arr['status'] = false;
                    $json_arr['text'] = __('Mã giảm giá chỉ áp dụng cho đơn hàng tối thiểu ').Helper::Format_Money_Other($sotien_toithieu);
                }else{
                    $json_arr['text'] = $json_arr['text'].' - '.$thongtin_voucher;
                    $json_arr['sotien_duocgiam'] = $sotien_duocgiam;
                    $json_arr['sotien_duocgiam_text'] = '-'.Helper::Format_Money_Other($sotien_duocgiam);

                    $json_arr['tongtien_saugiam'] = $tongtien - $sotien_duocgiam + $ship;
                    $json_arr['tongtien_saugiam_text'] = Helper::Format_Money_Other($tongtien - $sotien_duocgiam + $ship);
                }
            }else{ // nếu voucher không tồn tại
                $json_arr['status'] = false;
                $json_arr['text'] = __('Mã giảm giá không tồn tại');
                $json_arr['sotien_duocgiam'] = 0;
                $json_arr['sotien_duocgiam_text'] = '0đ';                
            }
        }

        return json_encode($json_arr);

    }


    public function CartAjax(Request $request){
        //$this->init($request);

        //### khai báo model
        $model_product = $this->productRepo;
        $model_option = $this->productOptRepo;
        $model_gallery = $this->galleryRepo;

        //### xử lý
        $cmd = ($request->cmd) ? $request->cmd : '';
        $action = ($request->action) ? $request->action : '';
        $id = ($request->id && $request->id > 0) ? $request->id : 0;
        $mau = ($request->mau && $request->mau > 0) ? $request->mau : 0;
        $size = ($request->size && $request->size > 0) ? $request->size : 0;
        $quantity = ($request->quantity && $request->quantity > 0) ? $request->quantity : 1;
        $code = ($request->code && $request->code != '') ? $request->code : '';
        $oldcode = ($request->oldcode && $request->oldcode != '') ? $request->oldcode : '';
        $ship = ($request->ship && $request->ship > 0) ? $request->ship : 0;
        $free = ($request->free && $request->free > 0) ? $request->free : 0;
        $lang = session('locale');
        $voucher_code = $request->voucher_code;

        $id_login = Helper::GetCookie('login_member_id');
        $token_member_cart = Helper::GetCookie('member_cart');

        //dd(__('Thanh toán'));

        //### kiểm tra kiểu chọn đặt hàng
        if($cmd == 'add-cart' && $id > 0){
            //### kiểm tra sản phẩm phiên bản có tồn tại
            if(!$this->IsProduct($id,$mau,$size) && !$this->IsProductParent($id,$mau,$size)){
                $data = array('warning' => __('Sản phẩm này chưa có hàng, vui lòng chọn màu hoặc size khác.'));
                return json_encode($data);
            }

            $pd_detail = $model_product->GetOneItem($id);
            $pd_detailOption = $model_option->GetItem(['id_size'=>$size, 'id_mau'=>$mau, 'id_product'=>$id]);

            //$setting = app('setting');
            //if($setting['isSoluong']==1){
            if((config('config_all.order.soluong') || config('lazada.active'))){
                //### check soluong có còn
                $is_soluong = false;
                $soluong_now = 0;            
                if($pd_detail && $pd_detail['soluong_website']>0){
                    $is_soluong = true;
                    $soluong_now = $pd_detail['soluong_website'];
                }
                if($pd_detailOption){
                    $pd_detail = $pd_detailOption;
                    $is_soluong = ($pd_detailOption['soluong_website']>0) ? true : false;
                    $soluong_now = $pd_detailOption['soluong_website'];
                }

                $mode_cart = new Cart();
                if($id_login>0){
                    $mode_cart = $mode_cart->where('id_user',$id_login);
                }else{
                    $mode_cart = $mode_cart->where('id_user',0)->where('token_member_cart',$token_member_cart);
                }
                $row_exist = $mode_cart->where('id_product',$id)->where('mau',$mau)->where('size',$size)->first();
                $row_exist = ($row_exist) ? $row_exist->toArray() : null;
                $soluong_buy = ($row_exist) ? $row_exist['soluong'] : 0;

                $thongbao_status = '';
                if(($quantity+$soluong_buy)>$soluong_now){
                    $is_soluong = false;
                    $thongbao_status = $pd_detail['ten'.$lang].' chỉ còn '.$soluong_now.' sản phẩm';
                }
                if($soluong_now==0){
                    $thongbao_status = 'Sản phẩm '.$pd_detail['ten'.$lang].' tạm hết hàng';
                }
            }else{
                if($pd_detailOption){
                    $pd_detail = $pd_detailOption;
                }

                $thongbao_status = '';
                $is_soluong = true;
            }

            if($is_soluong){
                $cart_tmp = CartHelper::addtocart($quantity,$id,$mau,$size,$id_login,$token_member_cart);
                //### xóa cart nếu action là changenow
                if($action=='changenow' && $cart_tmp['code']!=$oldcode){
                    CartHelper::removeOldcart($oldcode,$id_login,$token_member_cart);
                }
            }
            $max = CartHelper::count_cart($id_login,$token_member_cart);

            //### response dữ liệu
            $data = array('max' => $max, 'sku' => $pd_detail['masp'], 'name' => $pd_detail['ten'.$lang], 'price' => $pd_detail['gia'],'is_soluong' => $is_soluong, 'thongbao_status'=>$thongbao_status);
            
            return json_encode($data);

        }else if($cmd == 'update-cart' && $id > 0 && $code != ''){
            $mode_cart = new Cart();

            if($id_login>0){
                $mode_cart = $mode_cart->where('id_user',$id_login);
            }else{
                $mode_cart = $mode_cart->where('id_user',0)->where('token_member_cart',$token_member_cart);
            }
            $row_exist = $mode_cart->where('code',$code)->first();

            //### cập nhật giỏ hàng
            if($row_exist){
                $row_exist->toArray();
                $size = $row_exist['size'];
                $mau = $row_exist['mau'];

                if((config('config_all.order.soluong') || config('lazada.active'))){
                    //### check soluong có còn
                    $pd_detail = $model_product->GetOneItem($id); 
                    $pd_detailOption = $model_option->GetItem(['id_size'=>$size, 'id_mau'=>$mau, 'id_product'=>$id]);
                    
                    $is_soluong = false;
                    $soluong_now = 0;
                    if($pd_detail && $pd_detail['soluong_website']>0){
                        $is_soluong = true;
                        $soluong_now = $pd_detail['soluong_website'];
                    }
                    if($pd_detailOption){
                        $pd_detail = $pd_detailOption;
                        $is_soluong = ($pd_detailOption['soluong_website']>0) ? true : false;
                        $soluong_now = $pd_detailOption['soluong_website'];
                    }

                    $thongbao_status = 'Sản phẩm '.$pd_detail['ten'.$lang].' tạm hết hàng';
                    if($quantity>$soluong_now){
                        $is_soluong = false;
                        $thongbao_status = $pd_detail['ten'.$lang].' chỉ còn '.$soluong_now.' sản phẩm';
                    }
                }else{
                    $thongbao_status = '';
                    $is_soluong = true;
                }

                if($is_soluong){
                    //### cập nhật
                    $cartAdd['soluong'] = $quantity;
                    $mode_cart = new Cart();
                    $mode_cart->SaveItem($cartAdd,$row_exist['id']);
                }

                $proinfo = CartHelper::get_product_info($id,$size,$mau);
                $gia = Helper::Format_Money($proinfo['gia']*$quantity);
                $giamoi = Helper::Format_Money($proinfo['giamoi']*$quantity);
                $temp = CartHelper::get_order_total($id_login,$token_member_cart);
                $tempText = Helper::Format_Money($temp);

                $giaban = ($proinfo['giamoi']>0) ? $giamoi : $gia;

                $max = CartHelper::count_cart($id_login,$token_member_cart);

                $total = $temp;

                if($ship) $total += $ship;
                $totalText = Helper::Format_Money($total);

                //$data = array('max' => $max, 'gia' => ($proinfo['giamoi']>0) ? $gia : '', 'giamoi' => ($proinfo['giamoi']>0)?$giamoi:$giaban, 'temp' => $temp, 'tempText' => $tempText, 'total' => $total, 'totalText' => $totalText,'is_soluong' => $is_soluong, 'thongbao_status'=>$thongbao_status,'soluong_buy'=>$row_exist['soluong']);

                $data = array('max' => $max, 'gia' => $gia, 'giamoi' => ($proinfo['giamoi']>0)?$giamoi:$giaban, 'temp' => $temp, 'tempText' => $tempText, 'total' => $total, 'totalText' => $totalText,'is_soluong' => $is_soluong, 'thongbao_status'=>$thongbao_status,'soluong_buy'=>$row_exist['soluong']);


                //### Kiểm tra mã voucher
                $data_voucher = array();
                if(isset($voucher_code) && $voucher_code!=''){
                    $data_voucher = $this->CheckVoucherAjax($request,$ship);
                    $data_voucher = json_decode($data_voucher,true);
                }
                return json_encode(array_merge($data,$data_voucher));
            }

        }else if($cmd == 'popup-change-cart'){
            $row_exist = $row_detail = null;
            if($id){
                $row_detail = $this->productRepo->GetOneItem($id);   
            }else if($code!=''){
                $mode_cart = new Cart();

                if($id_login>0){
                    $mode_cart = $mode_cart->where('id_user',$id_login);
                }else{
                    $mode_cart = $mode_cart->where('id_user',0)->where('token_member_cart',$token_member_cart);
                }
                $row_exist = $mode_cart->where('code',$code)->first();
                if($row_exist){
                    $row_exist = $row_exist->toArray();
                    $row_detail = $this->productRepo->GetOneItem($row_exist['id_product']);
                }
            }

            if($row_detail){
                $type = $row_detail['type'];

                //### kiểm tra số lượng
                $is_soluong=true;
                if((config('config_all.order.soluong') || config('lazada.active'))){
                    $is_soluong = ($row_detail['soluong_website']>0) ? true : false;  
                } 

                $hinhanhsp = $this->galleryRepo->GetAllItems($type,['id_photo'=>$row_detail['id'], 'kind'=>'man', 'val'=>$type, 'com'=>$type]);

                //### Lấy color
                $mau='';
                $gallery_color = array();
                if($row_detail['id_mau']) {
                    $ids_mau = $this->productOptRepo->GetAllItemsByParamsPluck('id_mau',['type'=>$type, 'id_product'=>$row_detail['id'], 'xoatam'=>0, 'hienthi'=>1]);                
                    $mau = $this->colorRepo->GetAllItemByIds($ids_mau);

                    //### Lấy ds gallery color
                    if($mau){
                        foreach($mau as $k=>$v){
                            $gallery_color[$v['id']] = $model_gallery->GetAllItems('product_color',['id_photo'=>$row_detail['id'], 'id_color'=>$v['id']]);
                        }
                    }
                }

                //###  Lấy size
                $size='';
                if($row_detail['id_size']){
                    $ids_size = $this->productOptRepo->GetAllItemsByParamsPluck('id_size',['type'=>$type, 'id_product'=>$row_detail['id'], 'xoatam'=>0, 'hienthi'=>1]);
                    $size = $this->sizeRepo->GetAllItemByIds($ids_size);
                }


                //###  Lấy thông tin phiên bản đầu tiên
                $idmau = ($mau) ? $mau[0] : 0;
                $idsize = ($size) ? $size[0] : 0;
                $row_option_first = $this->productOptRepo->GetItem(['id_product'=>$row_detail['id'], 'id_size'=>$idsize, 'id_mau'=>$idmau]);
                $giamoi = ($row_option_first) ? $row_option_first['giamoi'] : $row_detail['giamoi'];
                $gia = ($row_option_first) ? $row_option_first['gia'] : $row_detail['gia'];
                $giakm = ($row_option_first) ? $row_option_first['giakm'] : $row_detail['giakm'];
                $is_version = ($row_option_first) ? true : false;
                if($row_option_first){
                    if((config('config_all.order.soluong') || config('lazada.active'))){
                        $is_soluong = ($row_option_first['soluong_website']>0) ? true : false;
                    }
                }

                //### trả dữ liệu -> blade view
                $response = array(
                    "id_login" => $id_login,
                    "token_member_cart" => $token_member_cart,
                    "row_exist" => $row_exist,
                    "row_detail" => $row_detail,
                    "hinhanhsp" => $hinhanhsp,
                    "mau" => $mau,
                    "size" => $size,
                    'giamoi' =>$giamoi,
                    'gia' =>$gia,
                    'giakm' =>$giakm,
                    'is_version' => $is_version,
                    'is_soluong' => $is_soluong,
                    'code' => $code
                );
                return view('desktop.templates.ajax.show_change_cart')->with($response);
            }

        }else if($cmd == 'delete-cart' && $code != ''){

            $mode_cart = new Cart();
            $coupon_discount=0;
            $row = $mode_cart->select('id_product')->where('code',$code)->first();
            if($row){
                $product = $row->toArray();
                CartHelper::remove_product($code,$id_login,$token_member_cart);
                $max = CartHelper::count_cart($id_login,$token_member_cart);
                $temp = CartHelper::get_order_total($id_login,$token_member_cart);
                $tempText = Helper::Format_Money($temp);
                $total = $temp;

                if($ship) $total += $ship;
                $totalText = Helper::Format_Money($total);
                $data = array('max' => $max, 'temp' => $temp, 'tempText' => $tempText, 'total' => $total, 'totalText' => $totalText, 'coupon' => $coupon_discount);


                //### Kiểm tra mã voucher
                $data_voucher = array();
                if(isset($voucher_code) && $voucher_code!=''){
                    $data_voucher = $this->CheckVoucherAjax($request,$ship);
                    $data_voucher = json_decode($data_voucher,true);
                }
                return json_encode(array_merge($data,$data_voucher));
            }

        }else if($cmd == 'ship-cart'){
            //### khai báo model
            $coupon_discount=0;
            $coupon_ship=0;

            $shipData = array();
            $shipText = '0đ';
            $total = 0;
            $totalText = '';

            $temp = CartHelper::get_order_total($id_login,$token_member_cart);
            $total = CartHelper::get_order_total($id_login,$token_member_cart) - $coupon_discount + $ship;
            if($ship>0){
                $shipText = Helper::Format_Money($ship);
            }

            $totalText = Helper::Format_Money($total);
            $data = array('shipText' => $shipText, 'temp' => $temp, 'ship' => $ship, 'totalText' => $totalText, 'total' => $total);

            //### Kiểm tra mã voucher
            $data_voucher = array();
            if(isset($voucher_code) && $voucher_code!=''){
                $data_voucher = $this->CheckVoucherAjax($request,$ship);
                $data_voucher = json_decode($data_voucher,true);
            }
 
            return json_encode(array_merge($data,$data_voucher));

        }else if($cmd == 'popup-cart'){
            $mode_cart = new Cart();
            if($id_login) {
                $row_cart = $mode_cart->where('id_user',$id_login)->get();
            }else{
                $row_cart = $mode_cart->where('token_member_cart',$token_member_cart)->where('id_user',0)->get();
            }

            //### trả dữ liệu -> blade view
            $response = array(
                "row_cart" => $row_cart,
                "id_login" => $id_login,
                "token_member_cart" => $token_member_cart
            );

            return view('desktop.templates.ajax.show_cart')->with($response);

        }else if($cmd == 'thongbao'){

            $thongbao = app('thongbao');

            //### trả dữ liệu -> blade view
            $response = array(
                "thongbao" => $thongbao
            );

            return view('desktop.templates.ajax.show_thongbao')->with($response);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Load quận huyện
    |--------------------------------------------------------------------------
    */
    public function DistrictAjax(Request $request){

        $id_city = (isset($request->id_city) && $request->id_city > 0) ? $request->id_city : 0;
        $district = null;
        $str = '';

        if($id_city) {
            $model = new Places('cat');
            $district = $model->select('ten', 'id')->where('id_delivery',0)->where('id_city',$id_city)->get()->toArray();
        }

        $str .= '<option value="">'.__('Quận/huyện').'</option>';

        if($district){
            foreach($district as $k=>$v){
                $str .= '<option value="'.$v['id'].'">'.$v['ten'].'</option>';
            }
        }

        return $str;
    }


    /*
    |--------------------------------------------------------------------------
    | Load phường xã
    |--------------------------------------------------------------------------
    */
    public function WardsAjax(Request $request){
        $id_district = (isset($request->id_district) && $request->id_district > 0) ? $request->id_district : 0;
        $wards = null;
        $str = '';

        if($id_district) {
            $model = new Places('item');
            $wards = $model->select('ten', 'id')->where('id_delivery',0)->where('id_district',$id_district)->get()->toArray();
        }

        $str .= '<option value="">'.__('Phường/xã').'</option>';
        if($wards){
            foreach($wards as $k=>$v){
                $str .= '<option value="'.$v['id'].'">'.$v['ten'].'</option>';
            }
        }
        return $str;
    }


    /*
    |--------------------------------------------------------------------------
    | Thêm địa chỉ giao hàng
    |--------------------------------------------------------------------------
    */
    public function AddAdressAjax(Request $request){
        dd('ok');
    }

    public function GetSizes(Request $request){
        $idproduct = $request->idproduct;
        $idmau = ($request->idmau) ? $request->idmau : 0; 
        $idsize = $request->idsize; 

        $type = 'product';
        $lang = app('lang');

        
        $ids_size = $this->productOptRepo->GetAllItemsByParamsPluck('id_size',['id_product'=>$idproduct, 'type'=>$type, 'id_mau'=>$idmau, 'xoatam'=>0, 'hienthi'=>1]);
        $sizes = $this->sizeRepo->GetAllItemByIds($ids_size);

        //### html select size
        $str = $str_opt = '';
        $str.= '<select name="cart-size" class="cart-size-change">';
            if($sizes){
                foreach($sizes as $s=>$size){
                    $str.= '<option value="'.$size['id'].'">'.$size['ten'.$lang].'</option>';
                }                    
            }else{
                $str.='<option value="0">'.__('Tạm hết size').'</option>';
            }            
        $str.='</select>';
        

        //### giaban - giamoi
        //$size = ($sizes) ? $sizes[0] : (($idsize) ? $idsize : 0);
        $size = ($idsize) ? $idsize : (($sizes) ? $sizes[0] : 0);
        $row_version = $this->productOptRepo->GetItem(['id_product'=>$idproduct, 'id_mau'=>$idmau, 'id_size'=>$size]);


        /*$data['gia'] = ($row_version) ? Helper::format_money($row_version['gia']) : '0đ';
        $data['giamoi'] = ($row_version) ? Helper::format_money($row_version['giamoi']) : '0đ';
        $data['giakm'] = ($row_version) ? $row_version['giakm'] : '0';*/

        $data['gia'] = ($row_version && $row_version['giamoi']>0 && $row_version['giamoi']<$row_version['gia']) ? Helper::format_money($row_version['gia']) : '';
        $data['giamoi'] = ($row_version && $row_version['giamoi']>0) ? Helper::format_money($row_version['giamoi']) : (($row_version && $row_version['gia']>0) ? Helper::format_money($row_version['gia']) : 'Liên hệ');
        $data['giakm'] = ($row_version) ? $row_version['giakm'] : '0';

        $data['select'] = $str;
        return json_encode($data);
        //return $str;
    }
}
