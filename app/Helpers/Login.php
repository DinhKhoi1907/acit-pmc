<?php



namespace App\Helpers;



use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Cookie;

use Illuminate\Support\Facades\Storage;



use App\Repositories\Repo\CategoryRepository;

use App\Repositories\Repo\AlbumRepository;

use App\Repositories\Repo\BrandRepository;

use App\Repositories\Repo\ColorRepository;

use App\Repositories\Repo\GalleryRepository;

use App\Repositories\Repo\PhotoRepository;

use App\Repositories\Repo\PostRepository;

use App\Repositories\Repo\ProductOptionRepository;

use App\Repositories\Repo\ProductRepository;

use App\Repositories\Repo\SizeRepository;

use App\Repositories\Repo\StaticPostRepository;

use App\Repositories\Repo\TagRepository;

use App\Repositories\Repo\NewsletterRepository;

use App\Repositories\Repo\ContactRepository;

use App\Repositories\Repo\SeoPageRepository;

use App\Repositories\Repo\QuestionRepository;

use App\Repositories\Repo\CouponRepository;

use App\Repositories\Repo\SettingRepository;

use App\Repositories\Repo\InventoryRepository;

use App\Repositories\Repo\InventoryDetailRepository;

use App\Repositories\Repo\ThongbaoRepository;


use App\Models\Member;

use App\Models\Places;

use App\Models\Order;

use App\Models\Lang;

use App\Models\Counter;

use App\Models\Online;

use App\Models\User;


use Spatie\Permission\Models\Role;


use DB;

use Image, Session;



class Login{

	private static $hash;

	private static $data_breadcum;



	public static $seo;

	public static $repo;


	private static $albumRepo, $brandRepo, $colorRepo, $galleryRepo, $photoRepo, $postRepo, $productOptRepo, $productRepo, $sizeRepo, $staticRepo, $tagRepo, $categoryRepo, $newsletterRepo, $contactRepo, $seopageRepo, $questionRepo, $couponRepo, $settingRepo, $inventoryRepo, $inventoryDetailRepo;

    //private static $category;

    private static $relations = [];



    private static function initialized($model){

        //### set repo

        switch ($model) {

        	case 'inventory':

                $model = self::$inventoryRepo = new InventoryRepository();

                self::$relations = [];

                break;

           case 'inventory_detail':

            	$model = self::$inventoryDetailRepo = new InventoryDetailRepository();

            	self::$relations = [];

            	break;

        	case 'setting':

                $model = self::$settingRepo = new SettingRepository();

                self::$relations = [];

                break;

        	case 'category':

                $model = self::$categoryRepo = new CategoryRepository();

                self::$relations = [];

                break;

            case 'album':

                $model = self::$albumRepo = new AlbumRepository();

                self::$relations = ['HasAllChild'];            

                break;

            case 'brand':

                $model = self::$brandRepo = new BrandRepository();

                self::$relations = [];

                break;

            case 'color':

                $model = self::$colorRepo = new ColorRepository();

                self::$relations = [];

                break;

            case 'size':

                $model = self::$sizeRepo = new SizeRepository();

                self::$relations = [];

                break;

            case 'gallery':

                $model = self::$galleryRepo = new GalleryRepository();

                self::$relations = [];

                break;

            case 'photo':

                $model = self::$photoRepo = new PhotoRepository();

                self::$relations = [];

                break;

            case 'post':

                $model = self::$postRepo = new PostRepository();

                self::$relations = ['HasAllChild'];              

                break;

            case 'productoption':

                $model = self::$productOptRepo = new ProductOptionRepository();

                self::$relations = ['ProductParent', 'ColorOption', 'SizeOption'];

                break;

            case 'product':

                $model = self::$productRepo = new ProductRepository();

                self::$relations = ['HasProductOptions', 'HasProductOptionsAll', 'HasAllChild'];

                break;

            case 'static':

                $model = self::$staticRepo = new StaticPostRepository();

                self::$relations = [];

                break;

            case 'tags':

                $model = self::$tagRepo = new TagRepository();

                self::$relations = ['HasAllChild'];

                break;

            case 'newsletter':

                $model = self::$newsletterRepo = new NewsletterRepository();

                self::$relations = [];

                break;

            case 'question':

                $model = self::$questionRepo = new QuestionRepository();

                self::$relations = [];

                break;

            case 'coupon':

                $model = self::$couponRepo = new CouponRepository();

                self::$relations = [];

                break;

            case 'contact':

                $model = self::$contactRepo = new ContactRepository();

                self::$relations = [];

                break;

            case 'seopage':

                $model = self::$seopageRepo = new SeoPageRepository();

                self::$relations = [];

                break;

        }

        return $model;

    }


  	/*

    |--------------------------------------------------------------------------

    | Lấy model

    |--------------------------------------------------------------------------

    */

  	public static function Get_model($model,$category='man'){

  		//get model to get data

		switch ($model) {

			case 'inventory':

				$model = self::initialized('inventory');

        		self::$repo = self::$inventoryRepo;

				//$model = new Product($category);

				break;

			case 'inventory_detail':

				$model = self::initialized('inventory_detail');

        		self::$repo = self::$inventoryDetailRepo;

				//$model = new Product($category);

				break;

			case 'setting':

				$model = self::initialized('setting');

        		self::$repo = self::$settingRepo;

				//$model = new Product($category);

				break;

			case 'category':

				$model = self::initialized('category');

        		self::$repo = self::$categoryRepo;

				//$model = new Product($category);

				break;

			case 'product':

				$model = self::initialized('product');

        		self::$repo = self::$productRepo;

				//$model = new Product($category);

				break;

			case 'productOption':

				$model = self::initialized('productoption');

        		self::$repo = self::$productOptRepo;

				//$model = new ProductOption();

				break;

			case 'post':

				$model = self::initialized('post');

        		self::$repo = self::$postRepo;

				//$model = new Post($category);

				break;

			case 'album':

				$model = self::initialized('album');

        		self::$repo = self::$albumRepo;

				//$model = new Album($category);

				break;

			case 'photo':

				$model = self::initialized('photo');

        		self::$repo = self::$photoRepo;

				//$model = new Photo();

				break;

			case 'static':

				$model = self::initialized('staticpost');

        		self::$repo = self::$staticRepo;

				//$model = new StaticPost();

				break;

			case 'color':

				$model = self::initialized('color');

        		self::$repo = self::$colorRepo;

				//$model = new Color();

				break;

			case 'size':

				$model = self::initialized('size');

        		self::$repo = self::$sizeRepo;

				//$model = new Size();

				break;

			case 'brand':

				$model = self::initialized('brand');

        		self::$repo = self::$brandRepo;

				//$model = new Brand();

				break;

			case 'tags':

				$model = self::initialized('tags');

        		self::$repo = self::$tagRepo;

				//$model = new Tags();

				break;

			case 'newsletter':

				$model = self::initialized('newsletter');

        		self::$repo = self::$newsletterRepo;

				//$model = new Newsletter();

				break;

			case 'contact':

				$model = self::initialized('contact');

        		self::$repo = self::$contactRepo;

				//$model = new Contact();

				break;

			case 'seopage':

				//$model = new SeoPage();

				$model = self::initialized('seopage');

        		self::$repo = self::$seopageRepo;

				break;

			case 'question':

				//$model = new SeoPage();

				$model = self::initialized('question');

        		self::$repo = self::$questionRepo;

				break;

			case 'coupon':

				//$model = new SeoPage();

				$model = self::initialized('coupon');

        		self::$repo = self::$couponRepo;

				break;

			case 'member':

				$model = new Member();

				break;

			case 'roles':

				$model = new Role();

				break;

			case 'places':

				$model = new Places($category);

				break;			

			case 'order':

				$model = new Order();

				break;		

			case 'users':
				$model = new User();
				break;	

			default:

				# code...

				break;

		}	

		return $model;

  	}


	public static function isLogin() {
	   return Auth::guard()->check();
	}
}

