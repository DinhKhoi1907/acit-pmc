<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Repo interface
        $this->app->singleton(
            \App\Repositories\Repo\ProductRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Repo\PostRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Repo\StaticPostRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Repo\AlbumRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Repo\PhotoRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Repo\ColorRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Repo\SizeRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Repo\BrandRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Repo\GalleryRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Repo\ProductOptionRepository::class
        );  
        $this->app->singleton(
            \App\Repositories\Repo\CategoryRepository::class
        );  
        $this->app->singleton(
            \App\Repositories\Repo\CategoryPropertyRepository::class
        );    
        $this->app->singleton(
            \App\Repositories\Repo\SettingRepository::class
        );  
        $this->app->singleton(
            \App\Repositories\Repo\NewsletterRepository::class
        );  
        $this->app->singleton(
            \App\Repositories\Repo\ContactRepository::class
        );  
        $this->app->singleton(
            \App\Repositories\Repo\SeoPageRepository::class
        ); 
        $this->app->singleton(
            \App\Repositories\Repo\QuestionRepository::class
        ); 
        $this->app->singleton(
            \App\Repositories\Repo\InventoryRepository::class
        ); 
        $this->app->singleton(
            \App\Repositories\Repo\InventoryDetailRepository::class
        ); 
        $this->app->singleton(
            \App\Repositories\Repo\DanhgiaRepository::class
        ); 
        $this->app->singleton(
            \App\Repositories\Repo\ThongbaoRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Repo\CommentRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Repo\PostWithUserRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Repo\HistoryPayRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Repo\ProductPropertyRepository::class
        );
        $this->app->singleton(
            \App\Lazada\LazadaPlatformAPI::class
        ); 
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
}
