<?php

namespace App\Providers;

use App\Models\User;

use Session, CartHelper;

//use App\Models\Setting;
//use App\Models\Photo;
//use App\Models\StaticPost;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Repo\TagRepository;
use App\Repositories\Repo\PostRepository;
use App\Repositories\Repo\BrandRepository;
use App\Repositories\Repo\PhotoRepository;
use App\Repositories\Repo\ContactRepository;
use App\Repositories\Repo\ProductRepository;
use App\Repositories\Repo\SeoPageRepository;
use App\Repositories\Repo\SettingRepository;

use App\Repositories\Repo\CategoryRepository;

use App\Repositories\Repo\ThongbaoRepository;
use App\Repositories\Repo\StaticPostRepository;

class ManualServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        /* bind lang */
        $this->app->bind('likes', function () {
            if (!Auth::guard()->check()) {
                return null;
            }
            $user = Auth::guard()->user();
            $list_like = explode(',', $user['likes']);
            return array_filter($list_like);
        });


        /* bind lang */
        $this->app->bind('lang', function () {
            $model_setting = new SettingRepository();
            $model_setting = $model_setting->GetItem(['type' => 'setting']);
            $result = json_decode($model_setting['options'], true);

            // if (session('locale')) {
            //     return session('locale');
            // } else {
            //     Session::put('locale', config('app.locale'));
            //     Session::put('lang', config('app.locale'));
            //     return session('locale');
            // }

            if (session('locale')) {
                return session('locale');
            } else {
                if (isset($result)) {
                    Session::put('locale', $result['lang_default']);
                    Session::put('lang', $result['lang_default']);
                } else {
                    Session::put('locale', config('app.locale'));
                    Session::put('lang', config('app.locale'));
                }

                return session('locale');
            }
        });
        /* bind setting */
        $this->app->bind('setting', function () {
            $model_setting = new SettingRepository();
            return $model_setting->GetItem(['type' => 'setting']);
        });
        /* bind setting options*/
        $this->app->bind('settingOptions', function () {
            $model_setting = new SettingRepository();
            $model_setting = $model_setting->GetItem(['type' => 'setting']);
            return json_decode($model_setting['options'], true);
        });
        /* bind logo */
        $this->app->bind('logo', function () {
            $model_photo = new PhotoRepository();
            return $model_photo->GetItem(['type' => 'logo', 'act' => 'photo_static']);
        });
        /* bind popup */
        /*$this->app->bind('popup', function () {
            $model_photo = new PhotoRepository();
            return $model_photo->GetItem(['type'=>'popup','act'=>'photo_multi', 'hienthi'=>1, 'noibat'=>1]);
        });*/
        /* bind noimage */
        $this->app->bind('noimage', function () {
            return asset('img/noimage.png');
        });
        /* bind bocongthuong */
        /*$this->app->bind('bocongthuong', function () {
            $model_photo = new PhotoRepository();
            return $model_photo->GetItem(['type'=>'bocongthuong','act'=>'photo_static']);
        });*/

        $this->app->bind('seopage_static', function () {
            $model_photo = new SeoPageRepository();
            return $model_photo->GetRepoStatic();
        });

        /* bind photo_static */
        $this->app->bind('photo_static', function () {
            $model_photo = new PhotoRepository();
            return $model_photo->GetPhotoStatic(['act' => 'photo_static']);
        });
        /* bind favicon */
        $this->app->bind('favicon', function () {
            $model_photo = new PhotoRepository();
            return $model_photo->GetItem(['type' => 'favicon', 'act' => 'photo_static']);
        });
        /* bind bocongthuong */
        $this->app->bind('mangxahoi', function () {
            $model_photo = new PhotoRepository();
            return $model_photo->GetAllItems('mangxahoi', ['hienthi' => 1]);
        });

        $this->app->bind('lienhe', function () {
            $model_contact = new StaticPostRepository();
            return $model_contact->GetItem(['type'=>'lienhe']);
        });

        $this->app->bind('backgroundfooter', function () {
            $model_photo = new PhotoRepository();
            return $model_photo->GetAllItems('backgroundfooter', ['hienthi' => 1]);
        });

        $this->app->bind('linkout', function () {
            $model_photo = new PhotoRepository();
            return $model_photo->GetAllItems('linkout', ['hienthi' => 1]);
        });
        // /* bind bocongthuong */
        // $this->app->bind('lienketnhanh', function () {
        //     $model_photo = new PhotoRepository();
        //     return $model_photo->GetAllItems('lienketnhanh',['hienthi'=>1]);
        // });

        /* bind footer */
        $this->app->bind('footer', function () {
            $model_staticpost = new StaticPostRepository();
            return $model_staticpost->GetItem(['type' => 'footer']);
        });

        /* bind chinhsachs */
        $this->app->bind('chinhsach', function () {
            $model_post = new PostRepository();
            return $model_post->GetAllItems('chinhsach', ['hienthi' => 1]);
        });

        /* bind chinhsachs */
        $this->app->bind('kienthuc', function () {
            $model_post = new PostRepository();
            return $model_post->GetAllItems('kienthuc', ['hienthi' => 1]);
        });

        /* bind chinhsachs */
        $this->app->bind('sanforex', function () {
            $model_post = new PostRepository();
            return $model_post->GetAllItems('sanforex', ['hienthi' => 1]);
        });

        /* bind chinhsachs */
        $this->app->bind('lienket', function () {
            $model_post = new PostRepository();
            return $model_post->GetAllItems('lienket', ['hienthi' => 1]);
        });

        $this->app->bind('dichvu', function () {
            $model_post = new PostRepository();
            return $model_post->GetAllItems('dichvu', ['hienthi' => 1],  null, false, false, 5);
        });


        /* bind chinhsachs */
        $this->app->bind('danhmuc_cap1', function () {
            $model_category = new CategoryRepository();
            return $model_category->GetAllItems('product', ['hienthi' => 1, 'level' => 0], null, false, false, 5);
        });

        /* bind chinhsachs */
        $this->app->bind('thongbao', function () {
            if (Auth::guard()->check()) {
                $user = Auth::guard()->user();
                $model_thongbao = new ThongbaoRepository();
                return $model_thongbao->GetThongbaos(['hienthi' => 1, 'daxoa' => 0, 'id_user' => $user->id]);
            } else {
                return null;
            }
        });

        $this->app->bind('countthongbao', function () {
            if (Auth::guard()->check()) {
                $user = Auth::guard()->user();
                $model_thongbao = new ThongbaoRepository();
                return $model_thongbao->GetThongbaos(['hienthi' => 1, 'daxoa' => 0, 'daxem' => 0, 'id_user' => $user->id]);
            } else {
                return null;
            }
        });

        /* bind footer */
        $this->app->bind('share_all_cart', function () {
            return CartHelper::Get_all_cart();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function provides()
    {
        return ['lang', 'setting', 'logo', 'favicon', 'footer', 'share_all_cart'];
    }
}
