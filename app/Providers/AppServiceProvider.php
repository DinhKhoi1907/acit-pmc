<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

use App\Models\Setting;
use App\Models\Photo;
use App\Models\StaticPost;

use Helper, CartHelper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->bind(TodoInterface::class,TodoRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Đổ dữ liệu chung cho trang admin
        View::composer(['admin.master'], function ($view) {
            //Gọi model

            // xử lý dữ liệu

            //đổ dữ liệu share view
            $response_share = array(

            );

            $response_share = array_merge($response_share);
            $view->with($response_share);
        });


        // Đổ dữ liệu chung cho trang desktop
        View::composer(['desktop.master'], function ($view) {
            //Gọi model

            //### xử lý dữ liệu
            //# Lấy số lượng đơn hàng
            //$share_all_cart = CartHelper::Get_all_cart();

            //đổ dữ liệu share view
            $response_share = array(
                //"share_all_cart" => $share_all_cart
            );

            $response_share = array_merge($response_share);
            $view->with($response_share);
        });

        //Define: share of laravel framework
        Paginator::useBootstrap();
    }
}
