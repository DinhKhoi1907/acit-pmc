<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*SEO Tool*/
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;// OR with multi
//use Artesaos\SEOTools\Facades\JsonLdMulti;// OR
//use Artesaos\SEOTools\Facades\SEOTools;
/*### END SEO Tool*/

use App\Models\OrderDetail;

use Helper, TableManipulation;

class ProductController extends Controller
{

    public $relations = ['HasProductOptions', 'HasProductOptionsAll', 'HasAllChild', 'HasProductOptionsSample'];

    public function ShowProducts($response, Request $request){
        //### gọi model
        $model = $this->productRepo;//new Product('man');
        $lang = (isset($response->lang))?$response->lang:'vi';
        $field = (isset($response->field))?$response->field:'';
        $slug = (isset($response->slug))?$response->slug:'';
        $type = (isset($response->type))?$response->type:'';
        $category = (isset($response->category))?$response->category:'';
        $title_main = (isset($response->title))?$response->title:'';
        $model_question = 'product';

        $row_seo = $banner = $this->seopageRepo->GetItem(['type'=>$type]);

        $arr_categorylist = $arr_brandlist = array();
        $array_category_id = $request->category_query;
        $array_brand_id = $request->brand_query;

        //### lấy ds brand và category filter
        if($array_brand_id){
            $arr_brandlist = explode(',', $array_brand_id);
        }

        if($array_category_id){
            $arr_categorylist = explode(',', $array_category_id);
        }

        //### lấy ds thương hiệu
        $thuonghieus = $this->brandRepo->GetAllItems('product');

        //### lấy ds danh mục cấp 3
        $danhmuc3 = $this->categoryRepo->GetAllItems('product',['level'=>2]);
        //### xử lý
        if($field!=''){
            //### lấy dữ liệu
            $model_gallery = $this->galleryRepo;//new Gallery();
            $row_detail = $model->GetOneItem($field,$this->relations);

            //### lấy ds ids category
            if($row_detail['id_category']!=0){

                $id_cate  = $row_detail['id_category'];
                $arr_childCategory = $arr_parentCategory = array();
                $row_detail_cate = $this->categoryRepo->GetOneItem($id_cate,null);

                //lấy ds category con
                array_push($arr_childCategory, (int)$id_cate);
                $arr_childCategory = array_merge($arr_childCategory, $this->categoryRepo->GetChildCategory($type,$id_cate));
                $params['id_category'] = $arr_childCategory;

                //lấy ds category cha
                array_push($arr_parentCategory, $row_detail_cate['id_parent']);
                $arr_parentCategory = array_merge($arr_parentCategory, $this->categoryRepo->GetParentCategory($type,$row_detail_cate['id_parent']));
                $arr_parentCategory = array_reverse($arr_parentCategory);
            }

            //### lấy ds bài viết theo ids_level
            if(TableManipulation::CheckFieldToTable('product', 'ids_level_1') && $row_detail['ids_level_1']!=''){
                $id_cate  = $row_detail['ids_level_1'];
                $params['ids_level_1'] = explode(',',$id_cate);
            }

            $params['id'] = $field;
            $params['hienthi'] = 1;

            $products = $model->GetAllItemsExceptId($type,$params,null);
            $hinhanhsp = $model_gallery->GetAllItems($type,['id_photo'=>$row_detail['id'], 'kind'=>'man', 'val'=>$type, 'com'=>$type]);
            $title = ($row_detail['title'.$lang]!='') ? $row_detail['title'.$lang] : $row_detail['ten'.$lang];
            $keywords = ($row_detail['keywords'.$lang]!='') ? $row_detail['keywords'.$lang] : $row_detail['ten'.$lang];
            $description = ($row_detail['description'.$lang]!='') ? $row_detail['description'.$lang] : $row_detail['ten'.$lang];
            $title_crumb = ($row_detail['ten'.$lang]) ? $row_detail['ten'.$lang] : $title_main;
            $photo = ($row_detail['photo']!='')?Helper::GetConfigBase().UPLOAD_PRODUCT.$row_detail['photo']:'';
            $img_json_bar = ($row_detail['photo']!='')?Helper::getImgSize($row_detail['photo'],UPLOAD_PRODUCT.$row_detail['photo']):'';
            $published_time = date('c',$row_detail['ngaytao']);
            $modified_time = date('c',$row_detail['ngaysua']);

            //### follow instagram
            $followInstagram = $this->staticRepo->GetItem(['type'=>'follow','hienthi'=>1]);

            //### kiểm tra số lượng
            $is_soluong=true;
            if((config('config_all.order.soluong') || config('lazada.active'))){
                $is_soluong = ($row_detail['soluong_website']>0) ? true : false;
            }


            /* Lấy color */
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


            /* Lấy size */
            $size=[];
            if($row_detail['id_size']){
                //$model_size = $this->sizeRepo;//new Size();
                //$size = $model_size->GetAllItemsFindInSet($type,'id',$row_detail['id_size']);
                $ids_size = $this->productOptRepo->GetAllItemsByParamsPluck('id_size',['type'=>$type, 'id_product'=>$row_detail['id'], 'xoatam'=>0, 'hienthi'=>1]);
                $size = $this->sizeRepo->GetAllItemByIds($ids_size);
            }


            /* Lấy thông tin phiên bản đầu tiên */
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


            //### Lấy thông tin category
            $row_category = $this->categoryRepo->GetOneItem($row_detail['id_category']);


            //### Thiết lập breadcum
            $arr_parentCategory = array();
            array_push($arr_parentCategory, $row_detail['id_category']);
            $arr_parentCategory = array_merge($arr_parentCategory, $this->categoryRepo->GetParentCategory($type,$row_detail['id_category']));
            $arr_parentCategory = array_reverse($arr_parentCategory);

            if(isset($title_crumb) && $title_crumb != '') Helper::setBreadCrumbs($slug,__($title_main));
            if($arr_parentCategory){
                foreach($arr_parentCategory as $k=>$v){
                    $row_breadcum = $this->categoryRepo->GetOneItem($v);
                    if($v){Helper::setBreadCrumbs($row_breadcum['tenkhongdauvi'],$row_breadcum['ten'.$lang]);}
                }
            }
            Helper::setBreadCrumbs($row_detail['tenkhongdauvi'],$row_detail['ten'.$lang]);
            $breadcrumbs = Helper::getBreadCrumbs();


            //### lấy thông tin : hướng dẫn thanh toán và chính sách đổi trả
            $huongdanthanhtoan = $this->staticRepo->GetItem(['type'=>'huongdanthanhtoan']);
            $chinhsachdoitra = $this->staticRepo->GetItem(['type'=>'chinhsachdoitra']);


            //### lấy danh sách câu hỏi
            $question = $this->questionRepo->GetQuestions(['type'=>$type,'model'=>$model_question,'id_item'=>$row_detail['id'],'duyettin'=>1,'hienthi'=>1], null, true, false);


            //### Lấy thông tin đánh giá
            $info_rating = $this->GetRating($row_detail);
            $danhgia_list = $this->danhgiaRepo->GetAllItems('',['id_product'=>$field,'duyettin'=>1]);

            if(config('config_all.data_demo')){
                //### test duplicate array customer
                $arr_tmp = array();
                for($i=0;$i<20;$i++){
                    $arr_tmp = array_merge($danhgia_list, $arr_tmp);
                }
                $danhgia_list = $arr_tmp;
            }


            //### đếm số lượt mua hàng
            $order_detail = new OrderDetail();
            $count_luotmua = $order_detail->where('id_product', $field)->where('hienthi',1)->count();

            //### Lấy ds tags của sản phẩm hiện tại
            $tags = array();
            if($row_detail['id_tags']!=''){
                $tag_arr = explode(',',$row_detail['id_tags']);
                $tags = $this->tagRepo->Query()->whereIn('id',$tag_arr)->where('hienthi',1)->get();
                if($tags){
                    $tags = $tags->toArray();
                }
            }

            $myCollection = collect($hinhanhsp);
            $newItem = [
                "photo" => $row_detail['photo'],
                "type" => "product",
                "com" => "product",
                "kind" => "man",
                "tenvi" => $row_detail['tenvi']
            ];

            $myCollection->prepend($newItem);

            $hinhanhsp = $myCollection->all();
            // dd($hinhanhsp);

            //### trả dữ liệu -> blade view
            $response = array(
                "row_detail" => $row_detail,
                "products" => $products,
                "hinhanhsp" => $hinhanhsp,
                "title_crumb" => $title_main,
                "breadcrumbs" => $breadcrumbs,
                "mau" => $mau,
                "size" => $size,
                "pro_list" => $row_category,
                "huongdanthanhtoan" => $huongdanthanhtoan,
                "chinhsachdoitra" => $chinhsachdoitra,
                "gallery_color" => $gallery_color,
                'giamoi' =>$giamoi,
                'gia' =>$gia,
                'giakm' =>$giakm,
                'is_version' => $is_version,
                'is_soluong' => $is_soluong,
                "question" => $question,
                "type_question" => $type,
                "model_question" => $model_question,
                "id_item" => $row_detail['id'],
                "info_rating" => $info_rating,
                "danhgia_list" => $danhgia_list,
                "count_luotmua" => $count_luotmua,
                "tags" => $tags,
                "banner" => $banner,
                "folder_upload" => UPLOAD_SEOPAGE,
                "followInstagram" => $followInstagram
            );
            $view =  view('desktop.templates.product.product_other')->with($response);
        }else{
            //### lấy dữ liệu
            $model_seo = $this->seopageRepo;//new SeoPage();
            $params['hienthi'] = 1;

            $check = false;
            if($slug == 'san-pham-moi'){
                $params['moi'] = 1;
                $check = true;
            }else if($slug == 'san-pham-ban-chay'){
                $params['banchay'] = 1;
                $check = true;
            }else if($slug == 'san-pham-khuyen-mai'){
                $params['khuyenmai'] = 1;
                $check = true;
            }
            $list_ids_level_1 = [];
            $list_ids_level_2 = [];

            if($request->ids_level_1) {
                $list_ids_level_1 = $params['list_ids_level_1'] = explode(',', $request->ids_level_1);
            }

            if($request->ids_level_2) {
                $list_ids_level_2 = $params['list_ids_level_2'] = explode(',', $request->ids_level_2);
            }

            $products = $model->GetAllItems($type,$params,null, true);
            // dd($products);

            $row_seo = $model_seo->GetItem(['type'=>$type]);
            $title = (isset($row_seo) && $row_seo['title'.$lang]!='') ? $row_seo['title'.$lang] : $row_seo['ten'.$lang];
            $keywords = (isset($row_seo) && $row_seo['keywords'.$lang]!='') ? $row_seo['keywords'.$lang] : $row_seo['ten'.$lang];
            $description = (isset($row_seo) && $row_seo['description'.$lang]!='') ? $row_seo['description'.$lang] : $row_seo['ten'.$lang];
            $title_crumb = $title_main;
            $photo = (isset($row_seo) && $row_seo['photo']!='')?Helper::GetConfigBase().UPLOAD_SEOPAGE.$row_seo['photo']:'';
            $img_json_bar = (isset($row_seo) && $row_seo['photo']!='')?Helper::getImgSize($row_seo['photo'],UPLOAD_SEOPAGE.$row_seo['photo']):'';
            $category = $this->categoryRepo->GetAllItems('product',['hienthi'=>1,'noibat'=>1,'level'=>0]);

            /* breadCrumbs */
            if(isset($title_crumb) && $title_crumb != '') Helper::setBreadCrumbs($slug,$title_main);
            $breadcrumbs = Helper::getBreadCrumbs();

            $slide = array();
            if(!$check && $type!='kimcuong'){
                //### slider
                $slide = $this->photoRepo->GetAllItems('slide',['hienthi'=>1]);
            }

            //### Lấy thông tin thuộc tính KC
            $thuoctinhs = $thuoctinhsNB = array();
            $minLY = 0; $maxLY = 10;
            $query = $request->request->all();
            if($type=='kimcuong'){
                $thuoctinhs = $this->categoryRepo->GetAllItems($type,['level'=>0]);
                $thuoctinhsNB = $this->categoryRepo->GetAllItems($type,['level'=>0,'noibat'=>1]);
                $minLY = $this->productRepo->Query()->where('type',$type)->min('ly');
                $maxLY = $this->productRepo->Query()->where('type',$type)->max('ly');
            }

            //### list categories
            $categories = $this->categoryRepo->GetAllItems($type,['hienthi'=>1, 'level'=> 0]);
            //dd($categories);

            //### follow instagram
            $followInstagram = $this->staticRepo->GetItem(['type'=>'follow','hienthi'=>1]);

            //### trả dữ liệu -> blade view
            $response = array(
                "products" => $products,
                "title_crumb" => $title_crumb,
                "breadcrumbs" => $breadcrumbs,
                "danhmuc3" => $danhmuc3,
                "thuonghieus" => $thuonghieus,
                "brandlist" => $arr_brandlist,
                "categorylist" => $arr_categorylist,
                "category" => $category,
                "banner" => $banner,
                "folder_upload" => UPLOAD_SEOPAGE,
                "slide" => $slide,
                "categories" => $categories,
                "followInstagram" => $followInstagram,
                "thuoctinhs" => $thuoctinhs,
                "thuoctinhsNB" => $thuoctinhsNB,
                "minLY" => $minLY,
                "maxLY" => $maxLY,
                "query" => $query,
                "list_ids_level_1" => $list_ids_level_1,
                "list_ids_level_2" => $list_ids_level_2
            );

            $view = view('desktop.templates.product.products')->with($response);

            // if($check){
            //     $view = view('desktop.templates.product.products')->with($response);
            // }else{
            //     if($type=='combo'){
            //         $view = view('desktop.templates.product.kimcuong')->with($response);
            //     }else{
            //         $view = view('desktop.templates.product.products')->with($response);
            //     }
            // }
        }

        /*### SEO TOOL */
        SEOMeta::setCanonical(url()->current());
        SEOMeta::setTitle($title);
        SEOMeta::setKeywords($keywords);
        SEOMeta::setDescription($description);

        OpenGraph::setDescription($description);
        OpenGraph::setTitle($title);
        OpenGraph::setUrl($request->url());
        if($field){
            OpenGraph::addProperty('type', 'article');
            SEOMeta::addMeta('article:published_time', $published_time, 'property');
            SEOMeta::addMeta('article:modified_time', $modified_time, 'property');
        }else{
            OpenGraph::addProperty('type', 'object');
        }
        if($img_json_bar!='' && count($img_json_bar)>0){
            OpenGraph::addImage($photo, ['height' => $img_json_bar['h'], 'width' => $img_json_bar['w'], 'type' => $img_json_bar['m'], 'alt' =>$title]);
        }else{
            OpenGraph::addImage($photo, ['alt' =>$title]);
        }

        TwitterCard::setTitle($title);
        TwitterCard::setDescription($description);
        TwitterCard::setImage($photo);

        return $view;
    }


    private function GetRating($product){
        $row = $this->danhgiaRepo->Query()->addSelect([
            'onestar'=> $this->danhgiaRepo->Query()->selectRaw('count(id)')->where('id_product',$product['id'])->where('star',1),
            'twostar'=> $this->danhgiaRepo->Query()->selectRaw('count(id)')->where('id_product',$product['id'])->where('star',2),
            'threestar'=> $this->danhgiaRepo->Query()->selectRaw('count(id)')->where('id_product',$product['id'])->where('star',3),
            'fourstar'=> $this->danhgiaRepo->Query()->selectRaw('count(id)')->where('id_product',$product['id'])->where('star',4),
            'fivestar'=> $this->danhgiaRepo->Query()->selectRaw('count(id)')->where('id_product',$product['id'])->where('star',5),
            'allrating'=> $this->danhgiaRepo->Query()->selectRaw('count(id)')->where('id_product',$product['id']),
            'maxstar'=> $this->danhgiaRepo->Query()->selectRaw('sum(star)')->where('id_product',$product['id'])
        ])->first();

        return $row;
    }


    private function GetListRating($product){
        $row = $this->danhgiaRepo->Query()->where('id_product',$product['id']);
        if($row){
            return $row->get()->toArray();
        }
        return null;
    }

}
