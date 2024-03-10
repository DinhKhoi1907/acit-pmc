<?php
namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

/*SEO Tool*/
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;// OR with multi
//use Artesaos\SEOTools\Facades\JsonLdMulti;// OR
//use Artesaos\SEOTools\Facades\SEOTools;
/*### END SEO Tool*/

use View;
use Helper, DB, Thumb, Session, CartHelper;

trait SupportTrait {

    public function init($request){        
        /* Cấu hình base và check SSL*/
        $http=(request()->secure()) ? 'https://' : 'http://';
        $config_url = config('config_all.config_url').'/';
        $config_server_name = $request->getHttpHost();
        if(!config('config_all.ishost')){
            $config_server_name.='/';
        }
        $config_base = $config_base_tmp = $http.$config_server_name.$config_url;


        $setting = app('setting');
        $settingOption = json_decode($setting['options'],true);

        // if(session('lang')){
        //     $lang = session('lang');            
        // }else{
        //     $lang= $settingOption['lang_default'];
        //     Session::put('lang', 'vi');
        // }

        if (session('locale')) {
            $lang = session('locale');
        } else {
            $lang = (isset($settingOption['lang_default']) && $settingOption['lang_default']!='') ? $settingOption['lang_default'] : config('app.locale');
            Session::put('locale', $lang);
            Session::put('lang', $lang);
        }


        //### xử lý dữ liệu : những dữ liệu chung cho tất cả các view blade
        //$lang = app('lang');

        //### Define coockie login
        Helper::SetCookieLogin('login_member_id', Auth::guard()->check());
        //### Define coockie access
        Helper::SetCookie('member_cart');
        //### Define upload const
        Helper::DefineFolderUpload();
        //### Define const lang
        Helper::DefineLang($lang);
        //### Remove thumbs folder after 30 days
        Thumb::RemoveThumbs();

        //### Gọi model
        $config_all = config('config_all');
        $logo = app('logo');
        $favicon = app('favicon');
        $footer = app('footer');
        $photo_static = app('photo_static');
        $user_info = (Auth::guard()->check()) ? Auth::guard()->user()->toArray() : null;
        $likes = app('likes');
        $sanforex = app('sanforex');

        $photo = ($logo['photo']!='')?Helper::GetConfigBase().UPLOAD_PHOTO.$logo['photo']:'';
        $img_json_bar = ($logo['photo']!='')?Helper::getImgSize($logo['photo'],UPLOAD_PHOTO.$logo['photo']):'';
        

        /*### SEO TOOL */
        OpenGraph::addProperty('site_name', $setting['ten'.$lang]);

        TwitterCard::setSite($settingOption['email']);
        TwitterCard::addValue('card','summary_large_image');
        TwitterCard::addValue('creator',$setting['ten'.$lang]);

        //### Share dữ liệu
        $response_share = array(
            "config_all" => $config_all,
            "config_base" => $config_base,
            "lang" => $lang,
            "setting" => $setting,
            "settingOption" => $settingOption,
            "logo" => $logo,
            "favicon" => $favicon,
            "footer" => $footer,
            "user_info" => $user_info,
            "counter" => Helper::getCounter(),
            "photo_static" => $photo_static,
            'danhmuc_cap1' => app('danhmuc_cap1'),
            "likes" => $likes,
            "sanforex" => $sanforex
        );
        $response_share = array_merge($response_share);
        View::share($response_share);

    }

    public function IsPermission($permission){
        //dd(Auth::guard('admin')->user()->can($permission));
        if(!Auth::guard('admin')->user()->can($permission) && Auth::guard('admin')->user()->role!=3){
            return false;
        }
        return true;
    }

    public function GetSettingOption($type='setting'){
        $rowItem = app('setting');//Setting::select('options')->where('type',$type)->first();
        return json_decode($rowItem['options'],true);
    }

    public function GetSetting($type='setting'){
        return app('setting');//Setting::select('*')->where('type',$type)->first();
    }
}
