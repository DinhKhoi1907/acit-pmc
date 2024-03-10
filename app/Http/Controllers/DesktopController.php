<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Traits\SupportTrait;

use View;
use Helper, DB, Thumb, Session, CartHelper;

class DesktopController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, SupportTrait;

    public $config_all, $config_base, $lang, $setting, $settingOption, $logo, $favicon, $footer, $slug, $field, $category, $type, $full_respons, $token_member_cart, $id_login = 0, $user_info, $requick;

    public $arr_level = array();

    private $arr_com_category = array();
    private $arr_com_product = array();
    private $arr_com_post = array();
    private $arr_com_album = array();
    private $arr_com_tags = array();
    private $arr_com_staticpost = array();
    private $arr_com_contact = array();
    private $arr_com_brand = array();
    private $arr_type = array();

    private $config_category;
    private $config_product;
    private $config_post;
    private $config_album;
    private $config_tags;
    private $config_staticpost;
    private $config_contact;


    /*
    |--------------------------------------------------------------------------
    | Kiểm tra lang đầu vào
    |--------------------------------------------------------------------------
    */
    public function SetLang(Request $request){
        switch ($request->lang) {
            case 'en':
                $this->lang = $request->lang;
                break;
            case 'cn':
                $this->lang = $request->lang;
                break;
            default:
                $this->lang = 'vi';
                break;
        }

        Session::put('lang', $this->lang);
        $hasField = Session::get('field');
        $intentedSlug = Session::get('tenkhongdau' . $this->lang);

        if (isset($hasField) && !empty($hasField)) {
            return redirect()->to($intentedSlug);
        } else {
            return redirect()->to($request->server('HTTP_REFERER'));
        }

    }


    /*
    |--------------------------------------------------------------------------
    | Kiểm tra slug đầu vào để thao tác blade tương ứng
    |--------------------------------------------------------------------------
    */
    public function CallSlug(Request $request){
        //### check age
        // if(!session('age')){
        //     Session::put('age',['active'=>0]);
        // }
        // if(session('age')){
        //     $age = session('age');
        //     if($age['active']==0){
        //         return redirect()->route('age.check');
        //     }
        // }

        //### lấy mảng level từ url

        if($request->slug){
           $this->arr_level['level_1'] = $request->slug;
        }
        if($request->level1){
           $this->arr_level['level_2'] = $request->level1;
        }
        if($request->level2){
            $this->arr_level['level_3'] = $request->level2;
        }

        //### lấy slug url
        $this->slug = (count($this->arr_level)>0) ? $this->arr_level['level_'.count($this->arr_level)] : $request->slug;

        /* Tối ưu link */
        $this->requick = $this->ArraySlug();
        Session::forget('field');

        /* Đếm lang */
        $arr_lang = config('config_all.lang');


        /* Find data */
        if($this->IsSlug()){
            $this->full_response['lang'] = $this->lang;
            $this->full_response['slug']=$this->slug;

            foreach($this->requick as $k => $v){
                $url_tbl = (isset($v['table']) && $v['table'] != '') ? $v['table'] : '';
                $url_type = (isset($v['type']) && $v['type'] != '') ? $v['type'] : '';
                $url_com = (isset($v['com']) && $v['com'] != '') ? $v['com'] : '';
                $url_tbl_tag = (isset($v['table_tag']) && $v['table_tag'] != '') ? $v['table_tag'] : '';
                $url_title = $v['title'];

                if($url_tbl!='' && $url_tbl!='photo' && $url_tbl!='contact' && $url_tbl!='category'){
                    // if($url_type=='tintuc' && $url_tbl=='post'){
                    //     $arr_slug = explode('-', $this->slug);
                    //     $count_arr = count($arr_slug);
                    //     $id = $arr_slug[$count_arr-1];
                    //     //$timesave = $arr_slug[$count_arr-1];
                    //     unset($arr_slug[$count_arr-1]);
                    //     //unset($arr_slug[$count_arr-2]);
                    //     $slugtmp = implode("-", $arr_slug);
                    //     $row = DB::table($url_tbl)->select('*')->where('tenkhongdau'.$this->lang,$slugtmp)->where('id',$id)->where('type',$url_type)->where('hienthi',1)->first();
                    // }else{
                    //     $row = DB::table($url_tbl)->select('*')->where('tenkhongdau'.$this->lang,$this->slug)->where('type',$url_type)->where('hienthi',1)->first();
                    // }
                    $row = DB::table($url_tbl)->select('*')->where('tenkhongdau'.$this->lang,$this->slug)->where('type',$url_type)->where('hienthi',1)->first();

                    if($row){
                        $this->slug = $url_com;
                        $this->full_response['field'] = $row->id;
                        $this->full_response['type'] = $url_type;
                        $this->full_response['slug'] = $this->slug;
                        foreach($arr_lang as $l=>$lang){
                            $row_tmp = @json_decode(json_encode($row), true);
                            $this->full_response['tenkhongdau'.$l] = $row_tmp['tenkhongdau'.$l];
                        }
                        // $this->full_response['slugIntended'] = $row;
                        $this->full_response['lang'] = $this->lang;
                        $this->full_response['table_tag'] = $url_tbl_tag;
                        $this->full_response['title'] = $url_title;
                        break;
                    }
                }else if($url_tbl=='category' && $this->arr_level['level_1']!='tags'){
                    $row = DB::table($url_tbl)->select()->where('tenkhongdau'.$this->lang,$this->slug)->where('hienthi',1)->first();
                    if($row){
                        $this->slug = $url_com;
                        $this->full_response['field'] = $row->id;
                        $this->full_response['type'] = $row->type;
                        foreach($arr_lang as $l=>$lang){
                            $row_tmp = @json_decode(json_encode($row), true);
                            $this->full_response['tenkhongdau'.$l] = $row_tmp['tenkhongdau'.$l];
                        }
                        $this->full_response['slug'] = $this->slug;
                        $this->full_response['lang'] = $this->lang;
                        $this->full_response['table_tag'] = $url_tbl_tag;
                        $this->full_response['title'] = $url_title;
                        if(count($this->arr_level)>1){
                            $this->full_response['arr_level'] = $this->arr_level;
                        }else{
                            $row = json_decode(json_encode($row), true);
                            $this->full_response['arr_level']['level_'.($row['level']+1)] = $row['tenkhongdau'.$this->lang];
                        }
                        break;
                    }
                }
            }

            if (isset($this->full_response['tenkhongdauvi'])) {
                Session::put('field', $this->full_response['field']);
            }

            foreach($arr_lang as $l=>$lang){
                if (isset($this->full_response['tenkhongdau'.$l])) {
                    Session::put('tenkhongdau'.$l, $this->full_response['tenkhongdau'.$l]);
                }
            }
        }

        // dd($this->slug);

        //### check slug
        if(in_array($this->slug, $this->arr_com_category)){

            $this->full_response['title'] = "";
            //$this->full_response['title'] = (isset($this->full_response['title'])) ? $this->full_response['title'] : $this->config_post[$this->full_response['type']]['title_main'];
            return \App::call('App\Http\Controllers\CategoryController@ShowItems', ['response' => (object)$this->full_response] );

        }else if(in_array($this->slug, $this->arr_com_product)){
            $this->full_response['type'] = $this->arr_type[$this->slug];
            $this->full_response['title'] = (isset($this->full_response['title'])) ? $this->full_response['title'] : $this->config_product[$this->full_response['type']]['title_main'];
            return \App::call('App\Http\Controllers\ProductController@ShowProducts', ['response' => (object)$this->full_response] );

        }else if(in_array($this->slug, $this->arr_com_brand)){
            $this->full_response['type'] = $this->arr_type[$this->slug];
            $this->full_response['title'] = (isset($this->full_response['title'])) ? $this->full_response['title'] : $this->config_product[$this->full_response['type']]['title_main_brand'];

            return \App::call('App\Http\Controllers\BrandController@ShowProducts', ['response' => (object)$this->full_response] );

        }else if(in_array($this->slug, $this->arr_com_tags)){
            $this->full_response['type'] = $this->arr_type[$this->slug];
            $this->full_response['title'] = (isset($this->full_response['title'])) ? $this->full_response['title'] : $this->config_tags[$this->full_response['type']]['title_main'];
            return \App::call('App\Http\Controllers\TagController@ShowProducts', ['response' => (object)$this->full_response] );

        }else if(in_array($this->slug, $this->arr_com_post)){
            //$this->full_response['title'] = $this->arr_type[$this->title];
            $this->full_response['type'] = $this->arr_type[$this->slug];
            $this->full_response['title'] = (isset($this->full_response['title'])) ? $this->full_response['title'] : $this->config_post[$this->full_response['type']]['title_main'];
            return \App::call('App\Http\Controllers\PostController@ShowPosts', ['response' => (object)$this->full_response] );

        }else if(in_array($this->slug, $this->arr_com_album)){

            $this->full_response['type'] = $this->arr_type[$this->slug];
            $this->full_response['title'] = (isset($this->full_response['title'])) ? $this->full_response['title'] : $this->config_album[$this->full_response['type']]['title_main'];
            return \App::call('App\Http\Controllers\AlbumController@ShowAlbums', ['response' => (object)$this->full_response] );

        }else if(in_array($this->slug, $this->arr_com_staticpost)){

            $this->full_response['type'] = $this->arr_type[$this->slug];
            $this->full_response['title'] = (isset($this->full_response['title'])) ? $this->full_response['title'] : $this->config_staticpost[$this->full_response['type']]['title_main'];
            return \App::call('App\Http\Controllers\StaticPostController@ShowStatic', ['response' => (object)$this->full_response] );

        }else if(in_array($this->slug, $this->arr_com_contact)){

            $this->full_response['type'] = $this->arr_type[$this->slug];
            $this->full_response['title'] = (isset($this->full_response['title'])) ? $this->full_response['title'] : $this->config_contact[$this->full_response['type']]['title_main'];
            return \App::call('App\Http\Controllers\ContactController@ShowContact', ['response' => (object)$this->full_response] );

        }else{
            if($this->slug == 'gio-hang'){
                $this->full_response['title'] = __('Giỏ hàng');
                $this->full_response['type'] = 'giohang';
                return \App::call('App\Http\Controllers\CartController@ShowCart', ['response' => (object)$this->full_response] );

            }else if($this->slug == 'tim-kiem'){
                $this->full_response['title'] = __('Tìm kiếm');
                $this->full_response['type'] = 'product';
                return \App::call('App\Http\Controllers\SearchController@Search', ['response' => (object)$this->full_response] );

            }else if($this->slug == 'muc-luc'){
                $this->full_response['title'] = __('Mục lục');
                $this->full_response['type'] = 'blog';
                return \App::call('App\Http\Controllers\SearchController@ShowBlog', ['response' => (object)$this->full_response] );

            }else if($this->slug == 'tim-kiem-blog'){
                $this->full_response['title'] = __('Tìm kiếm');
                $this->full_response['type'] = 'blog';
                return \App::call('App\Http\Controllers\SearchController@SearchBlog', ['response' => (object)$this->full_response] );

            }else if($this->slug == 'order'){
                $this->full_response['title'] = "Order";
                $this->full_response['type'] = 'order';
                return \App::call('App\Http\Controllers\StaticPostController@ShowOrder', ['response' => (object)$this->full_response] );

            // }else if($this->slug=='san-pham-moi'){
            //     $this->full_response['type'] = 'product';
            //     $this->full_response['title'] = __('Sản phẩm mới');
            //     return \App::call('App\Http\Controllers\ProductController@ShowProducts', ['response' => (object)$this->full_response] );

            // }else if($this->slug=='san-pham-ban-chay'){
            //     $this->full_response['type'] = 'product';
            //     $this->full_response['title'] = __('Sản phẩm bán chạy');
            //     return \App::call('App\Http\Controllers\ProductController@ShowProducts', ['response' => (object)$this->full_response] );

            // }else if($this->slug=='san-pham-khuyen-mai'){
            //     $this->full_response['type'] = 'product';
            //     $this->full_response['title'] = __('Sản phẩm khuyến mãi');
            //     return \App::call('App\Http\Controllers\ProductController@ShowProducts', ['response' => (object)$this->full_response] );

            // }else if($this->slug=='kim-cuong'){
            //     $this->full_response['type'] = 'kimcuong';
            //     $this->full_response['title'] = __('Kim cương');
            //     return \App::call('App\Http\Controllers\ProductController@ShowProducts', ['response' => (object)$this->full_response] );

            }else{
                return redirect()->route('error.show',['404']);
            }
        }
    }


    /*
    |--------------------------------------------------------------------------
    | mảng table truy vấn slug
    |--------------------------------------------------------------------------
    */
    private function ArraySlug(){
        $arr_config = array();

        $this->config_category = config('category');
        $this->config_product = config('config_type.product');
        $this->config_post = config('config_type.post');
        $this->config_album = config('config_type.album');
        $this->config_tags = config('config_type.tags');
        $this->config_staticpost = config('config_type.staticpost');
        $this->config_contact = config('config_type.contact');


        //run config category
        if($this->config_category){
            foreach($this->config_category as $k=>$v){
                if(isset($v['menu'])){
                    $arr_tmp = array(
                        'title' => $v['title_main'],
                        'table' => 'category',
                        'com' => 'category',
                        'type' => $k,
                        'menu' => $v['menu'],
                        'sitemap' => (isset($v['sitemap'])) ? $v['sitemap'] : false,
                        'model' => 'category',
                        'relation' => $v['relation']
                    );
                    array_push($arr_config, $arr_tmp);
                    array_push($this->arr_com_category, 'category');
                }
            }
        }



        //run config product
        if($this->config_product){
            if (array_key_exists('shownews', $this->config_product)) {
                unset($this->config_product['shownews']);
            }
            foreach($this->config_product as $k=>$v){
                if(isset($v['menu'])){
                    $arr_tmp = array(
                        'title' => $v['title_main'],
                        'table' => 'product',
                        'com' => $v['com'],
                        'type' => $k,
                        'menu' => $v['menu'],
                        'sitemap' => (isset($v['sitemap'])) ? $v['sitemap'] : false,
                        'model' => 'product'
                    );
                    $this->arr_type[$v['com']] = $k;
                    array_push($arr_config, $arr_tmp);
                    array_push($this->arr_com_product, $v['com']);
                }

                if(isset($v['brand']) && (isset($v['sitemap_brand'])) && $v['sitemap_brand']){
                    $arr_tmp = array(
                        'title' => $v['title_main'],
                        'table' => 'brand',
                        'com' => $v['com-brand'],
                        'type' => $k,
                        'menu' => $v['menu'],
                        'sitemap' => (isset($v['sitemap_brand'])) ? $v['sitemap_brand'] : false,
                        'model' => 'brand'
                    );
                    $this->arr_type[$v['com-brand']] = $k;
                    array_push($arr_config, $arr_tmp);
                    array_push($this->arr_com_brand, $v['com-brand']);
                }
            }
        }


        //run config product
        if($this->config_post){
            if (array_key_exists('shownews', $this->config_post)) {
                unset($this->config_post['shownews']);
            }

            foreach($this->config_post as $k=>$v){
                if(isset($v['menu'])){
                    $arr_tmp = array(
                        'title' => $v['title_main'],
                        'table' => 'post',
                        'com' => $v['com'],
                        'type' => $k,
                        'menu' => $v['menu'],
                        'sitemap' => (isset($v['sitemap'])) ? $v['sitemap'] : false,
                        'model' => 'post'
                    );

                    $this->arr_type[$v['com']] = $k;

                    array_push($arr_config, $arr_tmp);
                    array_push($this->arr_com_post, $v['com']);
                }
            }
        }


        //run config album
        if($this->config_album){
            if (array_key_exists('shownews', $this->config_album)) {
                unset($this->config_album['shownews']);
            }
            foreach($this->config_album as $k=>$v){
                if(isset($v['menu'])){
                    $arr_tmp = array(
                        'title' => $v['title_main'],
                        'table' => 'album',
                        'com' => $v['com'],
                        'type' => $k,
                        'menu' => $v['menu'],
                        'sitemap' => (isset($v['sitemap'])) ? $v['sitemap'] : false,
                        'model' => 'album'
                    );
                    $this->arr_type[$v['com']] = $k;
                    array_push($arr_config, $arr_tmp);
                    array_push($this->arr_com_album, $v['com']);
                }
            }
        }


        //run config tags
        if($this->config_tags){
            if (array_key_exists('shownews', $this->config_tags)) {
                unset($this->config_tags['shownews']);
            }
            foreach($this->config_tags as $k=>$v){
                if(isset($v['menu'])){
                    $arr_tmp = array(
                        'title' => $v['title_main'],
                        'table' => 'tags',
                        'com' => $v['com'],
                        'type' => $k,
                        'menu' => $v['menu'],
                        'sitemap' => (isset($v['sitemap'])) ? $v['sitemap'] : false,
                        'model' => 'tags',
                        'table_tag' => $v['table_tag']
                    );
                    $this->arr_type[$v['com']] = $k;
                    array_push($arr_config, $arr_tmp);
                    array_push($this->arr_com_tags, $v['com']);
                }
            }
        }


        //run config staticpost
        if($this->config_staticpost){
            foreach($this->config_staticpost as $k=>$v){
                if($v['com']!='' && isset($v['menu'])){
                    $arr_tmp = array(
                        'title' => $v['title_main'],
                        'table' => 'static',
                        'com' => $v['com'],
                        'type' => $k,
                        'menu' => $v['menu'],
                        'sitemap' => (isset($v['sitemap'])) ? $v['sitemap'] : false,
                        'model' => 'staticpost'
                    );
                    $this->arr_type[$v['com']] = $k;
                    array_push($arr_config, $arr_tmp);
                    array_push($this->arr_com_staticpost, $v['com']);
                }
            }
        }


        //run config contact
        if($this->config_contact){
            foreach($this->config_contact as $k=>$v){
                if($v['com']!='' && isset($v['menu'])){
                    $arr_tmp = array(
                        'title' => $v['title_main'],
                        'table' => 'contact',
                        'com' => $v['com'],
                        'type' => $k,
                        'menu' => $v['menu'],
                        'sitemap' => (isset($v['sitemap'])) ? $v['sitemap'] : false,
                        'model' => 'contact'
                    );
                    $this->arr_type[$v['com']] = $k;
                    array_push($arr_config, $arr_tmp);
                    array_push($this->arr_com_contact, $v['com']);
                }
            }
        }

        return $arr_config;
    }



    /*
    |--------------------------------------------------------------------------
    | Không phải slug trong danh sách
    |--------------------------------------------------------------------------
    */
    private function IsSlug(){
        $arr_notslug = array('', 'tim-kiem', 'account', 'sitemap', 'sitemap.xml');
        if(!in_array($this->slug, $arr_notslug))
            return true;
        return false;
    }


    /*
    |--------------------------------------------------------------------------
    | Tạo sitemap
    |--------------------------------------------------------------------------
    */
    public function SiteMapIndex(Request $request){
        //### Khai báo
        $page = ($request->page) ? $request->page : null;
        $requick = $this->ArraySlug();

        //### Response
        if(!$page){

            $arr_page = Helper::GetArraySitemap($requick,true);

            return response()->view('sitemap.index', [
                'time' => time(),
                'site' => $arr_page,
                'site_category' => $arr_page['category'],
            ])->header('Content-Type', 'text/xml');

        }else if($page!=''){ //sitemap index

            $arr_page = Helper::GetArraySitemap($requick,false);

            //check
            if(!array_key_exists($page,$arr_page)){return redirect()->route('error.show',['404']);}

            //get data
            $arr_detail_sitemap = $arr_page[$page];

            $arr_detail_sitemap = Helper::CreateSitemapPage($arr_detail_sitemap,$page);
            //response
            return response()->view('sitemap.detail', [
                'time' => time(),
                'site' => $arr_detail_sitemap
            ])->header('Content-Type', 'text/xml');

        }else{
            return redirect()->route('error.show',['404']);
        }
    }
}
