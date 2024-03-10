<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*SEO Tool*/
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;// OR with multi
//use Artesaos\SEOTools\Facades\JsonLdMulti;// OR
//use Artesaos\SEOTools\Facades\SEOTools;
/*### END SEO Tool*/


use App\Http\Traits\SupportTrait;

use Helper, CartHelper, Session;

class HomeController extends Controller
{
    use SupportTrait;


    public function Index(Request $request){

        if(config('config_all.lockpage')==true){
            return view('lock');
        }

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

        /* Delete */
        Session::forget('field');


        //### xử lý dữ liệu : những dữ liệu chung cho tất cả các view blade
        //$lang = app('lang');

        if (session('locale')) {
            $lang = session('locale');
        } else {
            $lang= config('app.locale');
            Session::put('locale', $lang);
            Session::put('lang', $lang);
        }

        //gọi đối tượng truy vấn
        $model_album = $this->albumRepo;
        $model_product = $this->productRepo;
        $model_post = $this->postRepo;
        $model_staticpost = $this->staticRepo;
        $model_photo = $this->photoRepo;
        $model_category = $this->categoryRepo;
        $model_seopage = $this->seopageRepo;
        $model_brand = $this->brandRepo;
        $model_gallery = $this->galleryRepo;

        //dd(date('H:i d/m/y',1658718564));

        //xử lý
        //### Lấy ds sản phẩm nổi bật
        $slide = $model_photo->GetAllItems('slide',['hienthi'=>1]);
        $slidemobile = $model_photo->GetAllItems('slidemobile',['hienthi'=>1]);
        $vechungtoi = $model_staticpost->GetItem(['hienthi'=>1,'type'=>'vechungtoi']);
        $hinh_intro = $model_gallery->GetAllItems('vechungtoi',['id_photo'=>$vechungtoi['id'], 'kind'=>'man', 'val'=>'vechungtoi', 'com'=>'staticpost']);
        $products_nb = $model_product->GetAllItems('product',['hienthi'=>1, 'noibat'=>1]);
        $products_cate = $model_category->GetAllItems('product',['hienthi'=>1]);
        $dichvu_nb = $model_post->GetAllItems('dichvu',['hienthi'=>1, 'noibat'=>1], null, false, false, 5, ['ngaytao'=>'desc']);
        $tintuc_nb = $model_post->GetAllItems('news',['hienthi'=>1, 'noibat'=>1]);
        $khachhang = $model_post->GetAllItems('khachhang',['hienthi'=>1]);


        $forex = $model_post->GetAllItems('forex',['hienthi'=>1,'noibat'=>1]);
        $sanforex = app('sanforex');
        $tinmoinhat = $model_post->GetAllItems('news',['hienthi'=>1],null,false,false,4,['ngaytao'=>'desc']);
        $tinnoibat = $model_post->GetAllItems('news',['hienthi'=>1,'noibat'=>1]);
        $videos = $model_post->GetAllItems('video',['hienthi'=>1],null,false,false,10,['ngaytao'=>'desc']);

        $motangan = $model_staticpost->GetItem(['hienthi'=>1,'type'=>'motangan']);

        $cauchuyen = $model_staticpost->GetItem(['hienthi'=>1,'type'=>'cauchuyen']);

        $hinhanhsp = $model_gallery->GetAllItems('vechungtoi',['id_photo'=>$vechungtoi['id'], 'kind'=>'man', 'val'=>'vechungtoi', 'com'=>'staticpost'], null, false, false, 3);
        $doitac = $this->postRepo->GetAllItems('corevalue',['hienthi'=>1]);
        $chungnhan_bangkhen = $this->postRepo->GetAllItems('chungnhan-bangkhen',['hienthi'=>1]);

        $setting = app('setting');
        $logo = app('logo');

        $photo = ($logo['photo']!='')?Helper::GetConfigBase().UPLOAD_PHOTO.$logo['photo']:'';
        $img_json_bar = ($logo['photo']!='')?Helper::getImgSize($logo['photo'],UPLOAD_PHOTO.$logo['photo']):'';
        $backgroundspnb = $model_photo->GetAllItems('backgroundspnb',['hienthi'=>1]);

    //    dd($videos);

        //đổ dữ liệu
        $response = array(
            "slide" => $slide,
            "slidemobile" => $slidemobile,
            "vechungtoi" => $vechungtoi,
            "hinh_intro" => $hinh_intro,
            "products_nb" => $products_nb,
            "products_cate" => $products_cate,
            "dichvu_nb" => $dichvu_nb,
            "tintuc_nb" => $tintuc_nb,
            "khachhang" => $khachhang,
            "doitac" => $doitac,
            "chungnhan_bangkhen" => $chungnhan_bangkhen,

            "forex" => $forex,
            "sanforex" => $sanforex,
            "tinmoinhat" => $tinmoinhat,
            "tinnoibat" => $tinnoibat,
            "videos"   => $videos,
            "lang" => $lang,
            "hinhanhsp" => $hinhanhsp,
            "backgroundspnb" => $backgroundspnb
        );
        // dd($response);


        /*### SEO TOOL */
        SEOMeta::setCanonical(url()->current());
        SEOMeta::setTitle($setting['title'.$lang]);
        SEOMeta::setKeywords($setting['keywords'.$lang]);
        SEOMeta::setDescription($setting['description'.$lang]);

        OpenGraph::setDescription($setting['description'.$lang]);
        OpenGraph::setTitle($setting['title'.$lang]);
        OpenGraph::setUrl($request->url());
        OpenGraph::addProperty('type', 'object');
        if($img_json_bar!='' && count($img_json_bar)>0){
            OpenGraph::addImage($photo, ['height' => $img_json_bar['h'], 'width' => $img_json_bar['w'], 'type' => $img_json_bar['m'], 'alt' =>$setting['title'.$lang]]);
        }else{
            OpenGraph::addImage($photo, ['alt' =>$setting['title'.$lang]]);
        }

        TwitterCard::setTitle($setting['title'.$lang]);
        TwitterCard::setDescription($setting['description'.$lang]);
        TwitterCard::setImage($photo);


        return view('desktop.templates.home')->with($response);
    }


    public function CheckAge(Request $request){
        if($request->getMethod() == 'GET'){
            return view('desktop.templates.checkAge');
        }


        ///### check age has enough
        $age = (int)$request->age;
        $now = (int)date("Y");
        $age_now = $now-$age;

        if($age_now>=18){
            Session::put('age',['active'=>1]);
            return redirect()->route('home');
        }

        $settingOptions = app('settingOptions');
        return redirect()->to($settingOptions['fanpage'])->send();

        //return redirect()->route('age.check');
    }
}
