<?php



namespace App\Helpers;



use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Cookie;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Request;


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

use App\Repositories\Repo\CommentRepository;



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



class Helper{

	private static $hash;

	private static $data_breadcum;



	public static $seo;

	public static $repo;



	/*public static function is_valid_domain($url){

	    $validation = FALSE;

	    //Parse URL

		$urlparts = parse_url(filter_var($url, FILTER_SANITIZE_URL));

	    //Check host exist else path assign to host

		if(!isset($urlparts['host'])){

	        $urlparts['host'] = $urlparts['path'];

	    }



	    if($urlparts['host']!=''){

	       	//Add scheme if not found

		   	if (!isset($urlparts['scheme'])){

	            $urlparts['scheme'] = 'http';

	        }

	        //Validation

			if(checkdnsrr($urlparts['host'], 'A') && in_array($urlparts['scheme'],array('http','https')) && ip2long($urlparts['host']) === FALSE){

	            $urlparts['host'] = preg_replace('/^www\./', '', $urlparts['host']);

	            $url = $urlparts['scheme'].'://'.$urlparts['host']. "/";



	            if (filter_var($url, FILTER_VALIDATE_URL) !== false && @get_headers($url)) {

	                $validation = TRUE;

	            }

	        }

	    }

		return $validation;

	}*/



	private static $albumRepo, $brandRepo, $colorRepo, $galleryRepo, $photoRepo, $postRepo, $productOptRepo, $productRepo, $sizeRepo, $staticRepo, $tagRepo, $categoryRepo, $newsletterRepo, $contactRepo, $seopageRepo, $questionRepo, $couponRepo, $settingRepo, $inventoryRepo, $inventoryDetailRepo, $binhluanRepo;

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

            case 'binhluan':

                $model = self::$binhluanRepo = new CommentRepository();

                self::$relations = [];

                break;

        }

        return $model;

    }





	public static function GetConfigBase(){

		return url('/').'/';

	}





	/* Check HTTP */

	public static function checkHTTP($arrayDomain, &$config_base, &$config_base_tmp, $host, $config_server_name, $config_url)

	{

		config(['config_all.config_base' => $config_base]);



		/*if(count($arrayDomain) > 0 && in_array($host,$arrayDomain) && Helper::is_valid_domain($host))

		{

			$get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));

			$read = stream_socket_client("ssl://".$host.":443", $errno, $errstr,30, STREAM_CLIENT_CONNECT, $get);

			$cert = stream_context_get_params($read);

			$certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);



			$http=(isset($certinfo) && time()<$certinfo['validTo_time_t']) ? 'https://' : 'http://';

			$config_base_tmp = $http.$config_server_name.$config_url;

		}*/

	}





	/*

    |--------------------------------------------------------------------------

    | Cấu hình thông tin gửi mail

    |--------------------------------------------------------------------------

    */

	public static function SetConfigMail($options){

		if($options['mailertype']==1){

			config([

				'mail.default' => 'smtp',

				'mail.mailers.smtp.host' => $options['ip_host'],

				'mail.mailers.smtp.port' => $options['port_host'],

				'mail.mailers.smtp.encryption' => ($options['secure_host']=='tls')?'':$options['secure_host'],

				'mail.mailers.smtp.username' => $options['email_host'],

				'mail.mailers.smtp.password' => $options['password_host']

			]);

		}else{

			config([

				'mail.default' => 'smtp',

				'mail.mailers.smtp.host' => $options['host_gmail'],

				'mail.mailers.smtp.port' => $options['port_gmail'],

				'mail.mailers.smtp.encryption' => $options['secure_gmail'],

				'mail.mailers.smtp.username' => $options['email_gmail'],

				'mail.mailers.smtp.password' => $options['password_gmail']

			]);

		}

	}





	/*

    |--------------------------------------------------------------------------

    | Set coockies truy cập website

    |--------------------------------------------------------------------------

    */

	public static function SetCookie($cookie){

		if(!self::GetCookie($cookie)){

			$token_member_cart = self::stringRandom(32);

			$cookie_expiration_time=60*24*365;

			Cookie::queue($cookie, $token_member_cart, $cookie_expiration_time);

		}

	}





	/*

    |--------------------------------------------------------------------------

    | Set coockies truy cập website

    |--------------------------------------------------------------------------

    */

	public static function SetCookieLogin($cookie,$isLogin=false){

		$id_login = (!$isLogin) ? 0 : Auth::guard()->user()->id;

		$time_expire=60*24;

		Cookie::queue($cookie, $id_login, $time_expire);

	}





	/*

    |--------------------------------------------------------------------------

    | Get coockies truy cập website

    |--------------------------------------------------------------------------

    */

	public static function GetCookie($cookie){

		return Cookie::get($cookie);

	}





	/*

    |--------------------------------------------------------------------------

    | Set breadcum

    |--------------------------------------------------------------------------

    */

	public static function setBreadCrumbs($slug='', $name='')

	{

		if($name != '')

		{

			self::$data_breadcum[] = array('slug' => $slug, 'name' => $name);

		}

	}





	/*

    |--------------------------------------------------------------------------

    | Get breadcum

    |--------------------------------------------------------------------------

    */

	public static function getBreadCrumbs()

	{

		$config_base = self::GetConfigBase();//config('config_all.config_base');



		$json = array();

		$breadcumb = '';



		if(self::$data_breadcum)

		{

			$breadcumb .= '<ol class="pl-0 mb-0 breadcrumb">';

			$breadcumb .= '<li class="breadcrumb-item"><a class="text-decoration-none" href="'.$config_base.'"><span>Trang chủ</span></a></li>';

			$k = 1;

			foreach(self::$data_breadcum as $key => $value)

			{

				if($value['name'] != '')

				{

					$slug = ($value['slug']) ? $config_base.$value['slug'] : '';

					$name = $value['name'];

					$active = ($key == count(self::$data_breadcum) - 1) ? "active" : "";

					$breadcumb .= '<li class="breadcrumb-item '.$active.'"><a class="text-decoration-none" href="'.$slug.'"><span class="font-bold">'.$name.'</span></a></li>';

					$json[] = array("@type"=>"ListItem","position"=>$k,"name"=>$name,"item"=>$slug);

					$k++;

				}

			}

		    $breadcumb .= '</ol>';

		    $breadcumb .= '<script type="application/ld+json">{"@context": "https://schema.org","@type": "BreadcrumbList","itemListElement": '.((json_encode($json))).'}</script>';

		}



	    return $breadcumb;

	}



	/*

    |--------------------------------------------------------------------------

    | Get upload folder url

    |--------------------------------------------------------------------------

    */

	public static function DefineFolderUpload()

	{
		//### config upload
		$config_upload = config('config_upload');

		$arr_tmp = array();

		foreach($config_upload as $k=>$v){

			if(defined($k)==false){define($k,$v);}

		}


		//### config const
		$config_const = config('const');

		$arr_tmp = array();

		foreach($config_const as $k=>$v){

			if(defined($k)==false){define($k,$v);}

		}

	}





	/*

    |--------------------------------------------------------------------------

    | Get upload folder url

    |--------------------------------------------------------------------------

    */

	public static function DefineLang($lang){

		$model_lang = new Lang();

		$langs = $model_lang->GetAllItems();



		foreach($langs as $k=>$v){

			if(defined($v['giatri'])==false) {

				define($v['giatri'],$v['lang'.$lang]);

			}

		}

	}



	/*

    |--------------------------------------------------------------------------

    | Get prefix admin

    |--------------------------------------------------------------------------

    */

	public static function GetPrefixMain($request)

	{

		$url_prefix = $request->route()->getPrefix();

		$arr_prefix = explode("/",$url_prefix);

		return $arr_prefix[0];

	}





	/*

    |--------------------------------------------------------------------------

    | Get prefix admin

    |--------------------------------------------------------------------------

    */

	public static function GetPrefixAdmin($request)

	{

		$url_prefix = $request->route()->getPrefix();

		$arr_prefix = explode("/",$url_prefix);

		return $arr_prefix[1];

	}



	/*

    |--------------------------------------------------------------------------

    | Active vị trí dòng menu người dùng đang thao tác

    |--------------------------------------------------------------------------

    */

	public static function GetMenuActive($category,$type){

		return session(['category'=>$category,'type'=>$type]);

	}





	/*

    |--------------------------------------------------------------------------

    | Lấy mảng type từ file config_type truyền vào để thực hiện middleware CheckModel - kiểm tra type cho phép thao tác dữ liệu

    |--------------------------------------------------------------------------

    */

	public static function GetArrayType($config_type){

		$arr_type = array();

		if($config_type!=null){

			foreach($config_type as $key=>$value){

				array_push($arr_type, $key);

			}

		}

		return $arr_type;

	}





	/*

    |--------------------------------------------------------------------------

    | Tạo dữ liệu SEO

    |--------------------------------------------------------------------------

    */

	public static function CreateSeo()

  	{

        $arr_lang = config('config_all.lang');

        $seo_create = implode(', ', array_map(

            function ($k,$v) { return sprintf("%s", $v); },$arr_lang,array_keys($arr_lang)

        ));

        return $seo_create;

  	}





  	/*

    |--------------------------------------------------------------------------

    | Đếm ký tự của SEO

    |--------------------------------------------------------------------------

    */

  	public static function CountSeo($string='')

  	{

        return strlen(utf8_decode($string));

  	}





  	/*

    |--------------------------------------------------------------------------

    | Upload hình ảnh vào folder tương ứng

    |--------------------------------------------------------------------------

    */

  	public static function UploadImageToFolder($image,$oldimage,$folder_url,$time=true){
  		$isLargeImg = (Helper::getInfoImage($image) > 2000) ? true : false;
	      $arr_extension = config('config_all')['extension_img'];
	      $extension = strtolower($image->getClientOriginalExtension());
	      if(in_array($extension, $arr_extension)) {
	      $rand = Str::random(10);
	      $ten_anh = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
	      $result = Str::slug($ten_anh, '-');

	        // $getimage = ($time)?time().'_'.$image->getClientOriginalName():$image->getClientOriginalName();
	        $getimage = ($time)?$result."-".$rand.".".$extension:$result.".".$extension;
	          if($isLargeImg){
	          Image::make($image)->resize(2000, null, function ($constraint) {
	           $constraint->aspectRatio();
	          })->save($folder_url.$getimage);
	          }else{
	            $image->move($folder_url, $getimage);
	          }
	          //xóa hình cũ
	          $image_path = $folder_url.$oldimage;
	      if ($oldimage!='' && file_exists($image_path)) {
	        @unlink($image_path);
	      }
	          return $getimage;
	    }
	    return '';

  		/*$isLargeImg = (Helper::getInfoImage($image) > 2000) ? true : false;



  		$arr_extension = config('config_all')['extension_img'];

  		$extension = $image->getClientOriginalExtension();



  		if(in_array($extension, $arr_extension)) {

		    $getimage = ($time)?time().'_'.$image->getClientOriginalName():$image->getClientOriginalName();



	        if($isLargeImg){

			    Image::make($image)->resize(2000, null, function ($constraint) {

				   $constraint->aspectRatio();

			    })->save($folder_url.$getimage);

	        }else{

	        	$image->move($folder_url, $getimage);

	        }





	        //xóa hình cũ

	        $image_path = $folder_url.$oldimage;

			if ($oldimage!='' && file_exists($image_path)) {

				@unlink($image_path);

			}



	        return $getimage;

		}



		return '';*/



  	}

	public static function UploadFileToFolder($image,$oldimage,$folder_url,$time=true){
		$isLargeImg = (Helper::getInfoImage($image) > 2000) ? true : false;
	  $arr_extension = config('config_all')['extension_img'];
	  $extension = strtolower($image->getClientOriginalExtension());

	  if(in_array($extension, $arr_extension)) {
			$rand = Str::random(10);
			$ten_anh = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
			$result = Str::slug($ten_anh, '-');

		  $getimage = ($time)?$result."-".$rand.".".$extension:$result.".".$extension;
		  $image->move($folder_url, $getimage);
		  // if($isLargeImg){
		  //   	Image::make($image)->resize(2000, null, function ($constraint) {
		  //    		$constraint->aspectRatio();
		  //   	})->save($folder_url.$getimage);
		  // }else{
		  //     $image->move($folder_url, $getimage);
		  // }

		  //xóa hình cũ
		  $image_path = $folder_url.$oldimage;
			if ($oldimage!='' && file_exists($image_path)) {
			  @unlink($image_path);
			}
		  return $getimage;
	  }
	  return '';
  }





  	/*

    |--------------------------------------------------------------------------

    | Delete hình ảnh

    |--------------------------------------------------------------------------

    */

  	public static function DeleteImage($image_path){

  		if (file_exists($image_path)) {

			@unlink($image_path);

		}

  	}





	/*

    |--------------------------------------------------------------------------

    | Lấy tình trạng nhận tin

    |--------------------------------------------------------------------------

    */

	public static function get_status_newsletter($tinhtrang=0, $type='')

	{

		$loai = '';

		$config = config('config_type.newsletter');



		if($config && count($config[$type]['tinhtrang']) > 0)

		{

			foreach($config[$type]['tinhtrang'] as $key => $value)

			{

				if($key == $tinhtrang)

				{

					$loai = $value;

					break;

				}

			}

		}



		if($loai == '') $loai="Đang chờ duyệt...";



		return $loai;

	}





	public static function CreateDraft($model,$type){

		$model = self::initialized($model);

		$row = $model->SaveItem(['type'=>$type, 'draft'=>1, 'ngaytao'=>time(), 'ngaysua' => time()], null);

		return $row->id;

	}


	/*

    |--------------------------------------------------------------------------

    | Upload video vào folder tương ứng

    |--------------------------------------------------------------------------

    */

  	public static function UploadVideoToFolder($image,$oldimage,$folder_url,$time=true){
  		$arr_extension = config('config_all')['extension_video'];

  		$extension = strtolower($image->getClientOriginalExtension());


  		if(in_array($extension, $arr_extension)) {

		    $getimage = ($time)?time().'_'.$image->getClientOriginalName():$image->getClientOriginalName();

	        $image->move($folder_url, $getimage);

	        //xóa hình cũ

	        $image_path = $folder_url.$oldimage;

			if ($oldimage!='' && file_exists($image_path)) {

				@unlink($image_path);

			}

	        return $getimage;

		}

		return '';

  	}





  	/*

    |--------------------------------------------------------------------------

    | Lấy folder theo model tương ứng

    |--------------------------------------------------------------------------

    */

  	public static function GetFolder($model,$nonepath=false){

  		//get model to get data

  		$folder='';

		switch ($model) {

			case 'user':

				$folder = ($nonepath)?config('config_upload.UPLOAD_USER'):base_path(config('config_upload.UPLOAD_USER'));

				break;

			case 'product':

				$folder = ($nonepath)?config('config_upload.UPLOAD_PRODUCT'):base_path(config('config_upload.UPLOAD_PRODUCT'));

				break;

			case 'productOption':

				$folder = ($nonepath)?config('config_upload.UPLOAD_PRODUCT'):base_path(config('config_upload.UPLOAD_PRODUCT'));

				break;

			case 'post':

				$folder = ($nonepath)?config('config_upload.UPLOAD_POST'):base_path(config('config_upload.UPLOAD_POST'));

				break;

			case 'album':

				$folder = ($nonepath)?config('config_upload.UPLOAD_ALBUM'):base_path(config('config_upload.UPLOAD_ALBUM'));

				break;

			case 'image':

  				$folder = ($nonepath)?config('config_upload.UPLOAD_IMAGE'):base_path(config('config_upload.UPLOAD_IMAGE'));

  				break;

  			case 'file':

  				$folder = ($nonepath)?config('config_upload.UPLOAD_FILE'):base_path(config('config_upload.UPLOAD_FILE'));

  				break;

  			case 'photo':

  				$folder = ($nonepath)?config('config_upload.UPLOAD_PHOTO'):base_path(config('config_upload.UPLOAD_PHOTO'));

  				break;

			case 'staticpost':

  				$folder = ($nonepath)?config('config_upload.UPLOAD_STATICPOST'):base_path(config('config_upload.UPLOAD_STATICPOST'));

  				break;

			case 'color':

  				$folder = ($nonepath)?config('config_upload.UPLOAD_COLOR'):base_path(config('config_upload.UPLOAD_COLOR'));

  				break;

			case 'size':

  				$folder = ($nonepath)?config('config_upload.UPLOAD_SIZE'):base_path(config('config_upload.UPLOAD_SIZE'));

  				break;

			case 'brand':

  				$folder = ($nonepath)?config('config_upload.UPLOAD_BRAND'):base_path(config('config_upload.UPLOAD_BRAND'));

  				break;

			case 'tags':

				$folder = ($nonepath)?config('config_upload.UPLOAD_TAGS'):base_path(config('config_upload.UPLOAD_TAGS'));

				break;

			case 'seopage':

				$folder = ($nonepath)?config('config_upload.UPLOAD_SEOPAGE'):base_path(config('config_upload.UPLOAD_SEOPAGE'));

				break;

			case 'category':

				$folder = ($nonepath)?config('config_upload.UPLOAD_CATEGORY'):base_path(config('config_upload.UPLOAD_CATEGORY'));

				break;

			case 'gallery':

				$folder = ($nonepath)?config('config_upload.UPLOAD_GALLERY'):base_path(config('config_upload.UPLOAD_GALLERY'));

				break;

			default:

				# code...

				break;

		}

		//echo $folder;

		return $folder;

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

			case 'binhluan':

				//$model = new SeoPage();

				$model = self::initialized('binhluan');

        		self::$repo = self::$binhluanRepo;

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





  	/*

    |--------------------------------------------------------------------------

    | Tạo hash ngẫu nhiên hỗ trợ cho việc upload hình ảnh kèm theo

    |--------------------------------------------------------------------------

    */

	public static function generateHash()

	{

		if(!self::$hash)

		{

			self::$hash = self::stringRandom(10);

		}

		return self::$hash;

	}





	/*

    |--------------------------------------------------------------------------

    | Tạo chuỗi ngẫu nhiên

    |--------------------------------------------------------------------------

    */

	public static function stringRandom($sokytu=10)

	{

		$str = '';



		if($sokytu > 0)

		{

			$chuoi = 'ABCDEFGHIJKLMNOPQRSTUVWXYZWabcdefghijklmnopqrstuvwxyzw0123456789';

			for($i=0; $i<$sokytu; $i++)

			{

				$vitri = mt_rand( 0 ,strlen($chuoi) );

				$str= $str . substr($chuoi,$vitri,1 );

			}

		}



		return $str;

	}


	/*

    |--------------------------------------------------------------------------

    | Tạo chuỗi ngẫu nhiên

    |--------------------------------------------------------------------------

    */

	public static function numberRandom($sokytu=10)

	{

		$str = '';



		if($sokytu > 0)

		{

			$chuoi = '0123456789';

			for($i=0; $i<$sokytu; $i++)

			{

				$vitri = mt_rand( 0 ,strlen($chuoi) );

				$str= $str . substr($chuoi,$vitri,1 );

			}

		}



		return $str;

	}





  	/*

    |--------------------------------------------------------------------------

    | Load danh mục cấp khi thay đổi lựa chọn trên giao diện

    |--------------------------------------------------------------------------

    */

	public static function get_ajax_category($model='', $table='', $level='', $type='', $rowItem=null, $title_select='Chọn danh mục', $class_select='select-category'){



		$id_parent = 'id_'.$level;

		$data_model = 'data-model="'.$model.'"';

		$data_level = '';

		$data_type = 'data-type="'.$type.'"';

		$data_table = '';

		$data_child = '';

		$data_parent=0;



		$model = Helper::Get_model($model,$level);



		$run_sql = $model->where('type', $type);



		if($level == 'list')

		{

			$data_level = 'data-level="list"';

			$data_table = 'data-table="'.$table.'cat"';

			$data_child = 'data-child="id_cat"';

			$data_parent = (isset($rowItem['id_list'])) ? htmlspecialchars($rowItem['id_list']) : 0;

		}

		else if($level == 'cat')

		{

			$data_level = 'data-level="cat"';

			$data_table = 'data-table="'.$table.'item"';

			$data_child = 'data-child="id_item"';

			$data_parent = (isset($rowItem['id_cat'])) ? htmlspecialchars($rowItem['id_cat']) : 0;

			$idlist = (isset($rowItem['id_list'])) ? htmlspecialchars($rowItem['id_list']) : 0;

			$run_sql = $run_sql->where('id_list', $idlist);

		}

		else if($level == 'item')

		{

			$data_level = 'data-level="item"';

			$data_table = 'data-table="'.$table.'sub"';

			$data_child = 'data-child="id_sub"';

			$data_parent = (isset($rowItem['id_item'])) ? htmlspecialchars($rowItem['id_item']) : 0;



			$idlist = (isset($rowItem['id_list'])) ? htmlspecialchars($rowItem['id_list']) : 0;

			$run_sql = $run_sql->where('id_list', $idlist);



			$idcat = (isset($rowItem['id_cat'])) ? htmlspecialchars($rowItem['id_cat']) : 0;

			$run_sql = $run_sql->where('id_cat', $idcat);

		}

		else if($level == 'sub')

		{

			$data_level = '';

			$data_type = '';

			$class_select = '';

			$data_parent = (isset($rowItem['id_sub'])) ? htmlspecialchars($rowItem['id_sub']) : 0;



			$idlist = (isset($rowItem['id_list'])) ? htmlspecialchars($rowItem['id_list']) : 0;

			$run_sql = $run_sql->where('id_list', $idlist);



			$idcat = (isset($rowItem['id_cat'])) ? htmlspecialchars($rowItem['id_cat']) : 0;

			$run_sql = $run_sql->where('id_cat', $idcat);



			$iditem = (isset($rowItem['id_item'])) ? htmlspecialchars($rowItem['id_item']) : 0;

			$run_sql = $run_sql->where('id_item', $iditem);

		}



		$rows = $run_sql->orderBy('stt', 'asc')->get()->toArray();



		//$rows = $model->where('type', $type)->orderBy('stt', 'asc')->get()->toArray();



		$str = '<select id="'.$id_parent.'" name="data['.$id_parent.']" '.$data_model.' '.$data_level.' '.$data_type.' '.$data_table.' '.$data_child.' class="form-control select2 '.$class_select.'"><option value="0">'.$title_select.'</option>';

		foreach($rows as $v)

		{

			if(($v["id"] == (int)$data_parent)) $selected = "selected";

			else $selected = "";



			$str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenvi"].'</option>';

		}

		$str .= '</select>';



		return $str;

	}





	/*

    |--------------------------------------------------------------------------

    | Get tags product

    |--------------------------------------------------------------------------

    */

	public static function get_tags($id=0, $table='', $type=''){

		if($id){

			$temps = DB::table($table)->select('id_tags')->where('id',$id)->where('type',$type)->first();

			$arr_tags = explode(',', $temps->id_tags);



			for($i=0;$i<count($arr_tags);$i++) $temp[$i]=$arr_tags[$i];

		}



		$row_tags = DB::table('tags')->select('tenvi','id')->where('type',$type)->get();



		$str = '<select id="tags_group" name="tags_group[]" class="select2">';

		for($i=0;$i<count($row_tags);$i++){

			if(isset($temp) && count($temp) > 0){

				if(in_array($row_tags[$i]->id,$temp)) $selected = 'selected="selected"';

				else $selected = '';

			}else{

				$selected = '';

			}

			$str .= '<option value="'.$row_tags[$i]->id.'" '.$selected.' /> '.$row_tags[$i]->tenvi.'</option>';

		}

		$str .= '</select>';



		return $str;

	}



	/*

    |--------------------------------------------------------------------------

    | Get brand for product

    |--------------------------------------------------------------------------

    */

	public static function get_brand($id=0, $table='',$type=''){

		if($id){

			$temps = DB::table($table)->select('id_brand')->where('id',$id)->where('type',$type)->first();

		}



		$row_brand = DB::table('brand')->select('tenvi','id')->where('type',$type)->get();



		$str = '<select id="brand" name="data[id_brand]" class="form-control select2">';

		$str .= '<option value="0">Chọn thương hiệu</option>';

		for($i=0;$i<count($row_brand);$i++){

			if(isset($temps)){

				if($row_brand[$i]->id==$temps->id_brand) $selected = 'selected="selected"';

				else $selected = '';

			}else{

				$selected = '';

			}

			$str .= '<option value="'.$row_brand[$i]->id.'" '.$selected.' /> '.$row_brand[$i]->tenvi.'</option>';

		}

		$str .= '</select>';



		return $str;

	}


	/*

    |--------------------------------------------------------------------------

    | Get brand for product

    |--------------------------------------------------------------------------

    */

	public static function get_bst($id=0, $table='',$type=''){

		if($id){

			$temps = DB::table($table)->select('id_bst')->where('id',$id)->where('type','product')->first();

		}



		$row_brand = DB::table('album')->select('tenvi','id')->where('type',$type)->get();



		$str = '<select id="bst" name="data[id_bst]" class="form-control select2">';

		$str .= '<option value="0">Chọn bộ sưu tập</option>';

		for($i=0;$i<count($row_brand);$i++){

			if(isset($temps)){

				if($row_brand[$i]->id==$temps->id_bst) $selected = 'selected="selected"';

				else $selected = '';

			}else{

				$selected = '';

			}

			$str .= '<option value="'.$row_brand[$i]->id.'" '.$selected.' /> '.$row_brand[$i]->tenvi.'</option>';

		}

		$str .= '</select>';



		return $str;

	}





	/*

    |--------------------------------------------------------------------------

    | Get color for product

    |--------------------------------------------------------------------------

    */

	public static function get_color($id=0, $table='',$type=''){

		if($id){

			$temps = DB::table($table)->select('id_mau')->where('id',$id)->where('type',$type)->first();

			$arr_mau = explode(',', $temps->id_mau);



			for($i=0;$i<count($arr_mau);$i++) $temp[$i]=$arr_mau[$i];

		}



		$row_mau = DB::table('color')->select('tenvi','id')->where('type',$type)->get();



		$str = '<select id="mau_group" name="mau_group[]" class="select multiselect" multiple="multiple" onchange="LoadProductChildren()">';

		for($i=0;$i<count($row_mau);$i++){

			if(isset($temp) && count($temp) > 0){

				if(in_array($row_mau[$i]->id,$temp)) $selected = 'selected="selected"';

				else $selected = '';

			}else{

				$selected = '';

			}

			$str .= '<option value="'.$row_mau[$i]->id.'" '.$selected.'> '.$row_mau[$i]->tenvi.'</option>';

		}

		$str .= '</select>';

		return $str;

	}



	/*

    |--------------------------------------------------------------------------

    | Get size for product

    |--------------------------------------------------------------------------

    */

	public static function get_size($id=0, $table='',$type=''){

		if($id){

			$temps = DB::table($table)->select('id_size')->where('id',$id)->where('type',$type)->first();

			$arr_mau = explode(',', $temps->id_size);



			for($i=0;$i<count($arr_mau);$i++) $temp[$i]=$arr_mau[$i];

		}



		$row_mau = DB::table('size')->select('tenvi','id')->where('type',$type)->get();



		$str = '<select id="size_group" name="size_group[]" class="select multiselect" multiple="multiple" onchange="LoadProductChildren()">';

		for($i=0;$i<count($row_mau);$i++){

			if(isset($temp) && count($temp) > 0){

				if(in_array($row_mau[$i]->id,$temp)) $selected = 'selected="selected"';

				else $selected = '';

			}else{

				$selected = '';

			}

			$str .= '<option value="'.$row_mau[$i]->id.'" '.$selected.'> '.$row_mau[$i]->tenvi.'</option>';

		}

		$str .= '</select>';



		return $str;

	}





	/*

    |--------------------------------------------------------------------------

    | Get info row of table

    |--------------------------------------------------------------------------

    */

	public static function GetInfoTable($table,$id=0,$params='*'){

		if($id){

			$params = explode(',', $params);

			$row = DB::table($table)->select($params)->where('id',$id)->first();

			//Helper::showSQL($row);

		}

		return $row;

	}



	/*

    |--------------------------------------------------------------------------

    | Change array product option

    |--------------------------------------------------------------------------

    */

	public static function GetArrayIdsOption($ArrayObj_option){

		$arr = Array();

		foreach($ArrayObj_option as $k=>$v){

			$arr[$v['id']]=$v['id'];

		}

		return $arr;

	}



	/*

    |--------------------------------------------------------------------------

    | Show SQL string

    |--------------------------------------------------------------------------

    */

	public static function showSQL($obj){

		dd($obj->toSql(), $obj->getBindings());

	}



	/*

    |--------------------------------------------------------------------------

    | Get places category by link

    |--------------------------------------------------------------------------

    */

	public static function get_places_category($table='',$level_parent, $request, $title_select='Chọn danh mục')

	{

		$type = $request->type;

		$level = $request->category;

		$id_city = $request->id_city;

		$id_district = $request->id_district;

		$id_wards = $request->id_wards;



		switch ($level_parent) {

			case 'list':

				$id_parent = 'id_city';

				break;

			case 'cat':

				$id_parent = 'id_district';

				break;

			case 'item':

				$id_parent = 'id_wards';

				break;

		}





		$model = Helper::Get_model($table,$level_parent);

		$run_sql = $model;

		if($type){

			$run_sql = $run_sql->where('type', $type);

		}



		if($level_parent == 'list')

		{

			$level_child = "cat";

			$parent = $id_city;

		}

		else if($level_parent == 'cat')

		{

			$level_child = "item";

			$parent = $id_district;

			$run_sql = $run_sql->where('id_city', $id_city);

		}

		else if($level_parent == 'item')

		{

			$level_child = "man";

			$parent = $id_wards;

			$run_sql = $run_sql->where('id_district', $id_district);

		}

		/*else if($level_parent == 'sub')

		{

			$parent = $id_sub;

			$level_child = "man";

			$run_sql = $run_sql->where('id_wards', $id_item);

		}*/



		$rows = $run_sql->orderBy('stt', 'asc')->get()->toArray();

		$route = "admin.$table.show";

		$route_url = ($type) ? $route_url = route($route,[$level,$type]) : $route_url = route($route,[$level]);



		$str = '<select id="'.$id_parent.'" name="'.$id_parent.'" data-model="'.$table.'" data-category="'.$level.'" data-type="'.$type.'" data-url="'.$route_url.'" onchange="onchange_category($(this))" class="form-control filer-category select2"><option value="0">'.$title_select.'</option>';

		foreach($rows as $v)

		{

			$selected='';

			if(isset($parent) && ($v["id"] == (int)$parent)) $selected = "selected";

			else $selected = "";

			$str .= '<option value='.$v["id"].' '.$selected.'>'.$v["ten"].'</option>';

		}

		$str .= '</select>';



		return $str;

	}



	/*

    |--------------------------------------------------------------------------

    | Load danh mục cấp khi thay đổi lựa chọn trên giao diện

    |--------------------------------------------------------------------------

    */

	public static function get_ajax_places($model='', $table='', $level='', $type='', $rowItem=null, $required='', $title_select='Chọn danh mục', $class_select='select-category-places'){

		switch ($level) {

			case 'list':

				$id_parent = 'id_city';

				break;

			case 'cat':

				$id_parent = 'id_district';

				break;

			case 'item':

				$id_parent = 'id_wards';

				break;

		}



		$data_model = 'data-model="'.$model.'"';

		$data_level = '';

		$data_type = 'data-type="'.$type.'"';

		$data_table = '';

		$data_child = '';

		$data_parent=0;



		$model = Helper::Get_model($model,$level);



		$run_sql = $model;

		if($type){$run_sql = $run_sql->where('type', $type);}



		if($level == 'list')

		{

			$data_level = 'data-level="list"';

			$data_table = 'data-table="district"';

			$data_child = 'data-child="id_district"';

			$data_parent = (isset($rowItem->city)) ? $rowItem->city : 0;

			$data_title='data-title="Chọn quận huyện"';

		}

		else if($level == 'cat')

		{

			$data_level = 'data-level="cat"';

			$data_table = 'data-table="ward"';

			$data_child = 'data-child="id_wards"';

			$data_parent = (isset($rowItem->district)) ? $rowItem->district : 0;

			$idlist = (isset($rowItem->city)) ? $rowItem->city : 0;

			$run_sql = $run_sql->where('id_city', $idlist);

			$data_title='data-title="Chọn phường xã"';

		}

		else if($level == 'item')

		{

			$data_level = 'data-level="item"';

			$data_table = 'data-table="street"';

			$data_child = 'data-child="id_street"';

			$data_parent = (isset($rowItem->wards)) ? $rowItem->wards : 0;



			//$idlist = (isset($rowItem->city)) ? $rowItem->city : 0;

			//$run_sql = $run_sql->where('id_city', $idlist);



			$idcat = (isset($rowItem->district)) ? $rowItem->district : 0;

			$run_sql = $run_sql->where('id_district', $idcat);

			$data_title='data-title="Chọn đường"';

		}

		/*else if($level == 'sub')

		{

			$data_level = '';

			$data_type = '';

			$class_select = '';

			$data_parent = (isset($rowItem['id_sub'])) ? htmlspecialchars($rowItem['id_sub']) : 0;



			$idlist = (isset($rowItem['id_list'])) ? htmlspecialchars($rowItem['id_list']) : 0;

			$run_sql = $run_sql->where('id_list', $idlist);



			$idcat = (isset($rowItem['id_cat'])) ? htmlspecialchars($rowItem['id_cat']) : 0;

			$run_sql = $run_sql->where('id_cat', $idcat);



			$iditem = $data_parent = (isset($rowItem['id_item'])) ? htmlspecialchars($rowItem['id_item']) : 0;

			$run_sql = $run_sql->where('id_item', $iditem);

		}*/



		$rows = $run_sql->orderBy('stt', 'asc')->get()->toArray();

		//$rows = $model->where('type', $type)->orderBy('stt', 'asc')->get()->toArray();



		$str = '<select id="'.$id_parent.'" name="data['.$id_parent.']" '.$data_model.' '.$data_level.' '.$data_type.' '.$data_table.' '.$data_child.' '.$data_title.' '.$required.' class="form-control select2 '.$class_select.'"><option value="0">'.$title_select.'</option>';

		foreach($rows as $v)

		{

			if(($v["id"] == (int)$data_parent)) $selected = "selected";

			else $selected = "";



			$str .= '<option value='.$v["id"].' '.$selected.'>'.$v["ten"].'</option>';

		}

		$str .= '</select>';

		return $str;

	}









	/*

    |--------------------------------------------------------------------------

    | Get category by link

    |--------------------------------------------------------------------------

    */

    public static function get_category_select($table='',$type,$array_parents)

	{

		$str_level='';



		if($array_parents){

			switch ($table) {

				case 'album':

					$array_check_model = ['list','man'];

					break;

				case 'product':

				case 'post':

					$array_check_model = ['list','cat','item','sub','man'];

					break;

			}

			foreach($array_parents as $k=>$v ){

				if(in_array($k,$array_check_model)){

					$field = '&id_';

					$field .= $k.'=';

					$model = Helper::Get_model($table,$k);

					$run_sql = $model;

					if($type){$run_sql = $run_sql->where('type', $type);}

					$rows = $run_sql->hienthi()->orderBy('stt', 'asc')->get()->toArray();



					$str_level .= '<optgroup label="'.$v.'">';

					foreach($rows as $k=>$v){

						$str_level .= '<option value="'.$field.$v['id'].'">'.$v['tenvi'].'</option>';

					}

					$str_level .= '</optgroup>';

				}

			}

		}

		return $str_level;

	}





	public static function get_category_all($table='',$level_parent, $request, $title_select='Chọn danh mục')

	{

		$type = $request->type;

		$level = $request->category;

		$id_list = $request->id_list;

		$id_cat = $request->id_cat;

		$id_item = $request->id_item;

		$id_sub = $request->id_sub;

		$id_parent = 'id_'.$level_parent;

		$str_level = '';



		if($level_parent == 'cat')

		{

			$level_child = ['list'=>'Danh mục cấp 1'];

			$str_level .= self::get_category_select($table,$type,$level_child);

		}

		if($level_parent == 'item')

		{

			$level_child = ['list'=>'Danh mục cấp 1', 'cat'=>'Danh mục cấp 2'];

			$str_level .= self::get_category_select($table,$type,$level_child);

		}

		if($level_parent == 'sub')

		{

			$level_child = ['list'=>'Danh mục cấp 1', 'cat'=>'Danh mục cấp 2', 'item'=>'Danh mục cấp 3'];

			$str_level .= self::get_category_select($table,$type,$level_child);

		}

		if($level_parent == 'man')

		{

			$level_child = ['list'=>'Danh mục cấp 1', 'cat'=>'Danh mục cấp 2', 'item'=>'Danh mục cấp 3','sub'=>'Danh mục cấp 4'];

			$str_level .= self::get_category_select($table,$type,$level_child);

		}



		$route = "admin.$table.show";

		$route_url = ($type) ? $route_url = route($route,[$level,$type]) : $route_url = route($route,[$level]);



		$str = '<select id="all_category" name="all_category" data-model="'.$table.'" data-category="'.$level.'" data-type="'.$type.'" data-url="'.$route_url.'" onchange="onchange_category_all($(this))" class="form-control filer-category select2"><option value="0">'.$title_select.'</option>';

		$str.=$str_level;

		$str .= '</select>';



		return $str;

	}







	/*

    |--------------------------------------------------------------------------

    | Get category by link

    |--------------------------------------------------------------------------

    */

	public static function get_link_category($table='',$level_parent, $request, $title_select='Chọn danh mục')

	{

		$type = $request->type;

		$level = $request->category;

		$id_list = $request->id_list;

		$id_cat = $request->id_cat;

		$id_item = $request->id_item;

		$id_sub = $request->id_sub;

		$id_parent = 'id_'.$level_parent;



		$model = Helper::Get_model($table,$level_parent);

		$run_sql = $model;



		if($type){$run_sql = $run_sql->where('type', $type);}



		if($level_parent == 'list')

		{

			$level_child = "cat";

			$parent = $id_list;

		}

		else if($level_parent == 'cat')

		{

			$level_child = "item";

			$parent = $id_cat;

			$run_sql = $run_sql->where('id_list', $id_list);

		}

		else if($level_parent == 'item')

		{

			$level_child = "sub";

			$parent = $id_item;

			$run_sql = $run_sql->where('id_cat', $id_cat);

		}

		else if($level_parent == 'sub')

		{

			$parent = $id_sub;

			$level_child = "man";

			$run_sql = $run_sql->where('id_item', $id_item);

		}



		$rows = $run_sql->orderBy('stt', 'asc')->get()->toArray();

		$route = "admin.$table.show";

		$route_url = ($type) ? $route_url = route($route,[$level,$type]) : $route_url = route($route,[$level]);



		$str = '<select id="'.$id_parent.'" name="'.$id_parent.'" data-model="'.$table.'" data-category="'.$level.'" data-type="'.$type.'" data-url="'.$route_url.'" onchange="onchange_category($(this))" class="form-control filer-category select2"><option value="0">'.$title_select.'</option>';

		foreach($rows as $v)

		{

			$selected='';

			if(isset($parent) && ($v["id"] == (int)$parent)) $selected = "selected";

			else $selected = "";

			$str .= '<option value='.$v["id"].' '.$selected.'>'.$v["tenvi"].'</option>';

		}

		$str .= '</select>';



		return $str;

	}





	/*

    |--------------------------------------------------------------------------

    |

    |--------------------------------------------------------------------------

    */

	public static function galleryFiler($stt=1, $id=0, $photo='', $name='', $model='', $col='', $hash='')

	{

		$folder_url = Helper::GetFolder($model,true);

		$str = '';

		$str .= '<li class="jFiler-item my-jFiler-item my-jFiler-item-'.$id.' '.$col.'" data-id="'.$id.'">';

		$str .= '<div class="jFiler-item-container">';

		$str .= '<div class="jFiler-item-inner">';

		$str .= '<div class="jFiler-item-thumb">';

		$str .= '<div class="jFiler-item-thumb-image">';

		$str .= '<img src="'.$folder_url.$photo.'" alt="'.$name.'"><i class="fas fa-arrows-alt"></i>';

		$str .= '</div>';

		$str .= '</div>';

		if($hash=='gallery'){

			$str .= '<p class="gallery-image-name">'.$photo.'</p>';

		}

		$str .= '<div class="jFiler-item-assets jFiler-row">';

		$str .= '<ul class="list-inline pull-right d-flex align-items-center justify-content-between">';

		$str .= '<li class="ml-1">';

		$str .= '<a class="icon-jfi-trash jFiler-item-trash-action my-jFiler-item-trash" data-id="'.$id.'" data-folder="'.$model.'"></a>';

		$str .= '</li>';

		$str .= '<li class="mr-1">';

		$str .= '<div class="align-middle custom-control custom-checkbox d-inline-block text-md">';

		$str .= '<input type="checkbox" class="custom-control-input filer-checkbox" id="filer-checkbox-'.$id.'" value="'.$id.'">';

		$str .= '<label for="filer-checkbox-'.$id.'" class="custom-control-label font-weight-normal">'.(($hash!='gallery') ? 'Chọn' : '').'</label>';

		$str .= '</div>';

		$str .= '</li>';

		$str .= '</ul>';

		$str .= '</div>';

		$str .= '<input type="'.(($hash=='gallery') ? 'hidden' : 'number').'" class="mb-1 rounded form-control form-control-sm my-jFiler-item-info" value="'.$stt.'" placeholder="Số thứ tự" data-info="stt" data-id="'.$id.'"/>';

		$str .= '<input type="'.(($hash=='gallery') ? 'hidden' : 'text').'" class="rounded form-control form-control-sm my-jFiler-item-info" value="'.$name.'" placeholder="Tiêu đề" data-info="tieude" data-id="'.$id.'"/>';

		$str .= '</div>';

		$str .= '</div>';

		$str .= '</li>';

		echo $str;

	}





	/*

    |--------------------------------------------------------------------------

    |

    |--------------------------------------------------------------------------

    */

	public static function galleryImage($stt=1, $id=0, $photo='', $name='', $model='', $col='')

	{

		$folder_url = Helper::GetFolder($model,true);

		$str = '';

		$str .= '<li class="jFiler-item my-jFiler-item my-jFiler-item-'.$id.' '.$col.'" data-id="'.$id.'">';

		$str .= '<div class="jFiler-item-container">';

		$str .= '<div class="jFiler-item-inner">';

		$str .= '<div class="jFiler-item-thumb">';

		$str .= '<div class="jFiler-item-thumb-image">';

		$str .= '<img src="'.$folder_url.$photo.'" alt="'.$name.'"><i class="fas fa-arrows-alt"></i>';

		$str .= '</div>';

		$str .= '</div>';

		$str .= '<div class="jFiler-item-assets jFiler-row">';

		$str .= '<ul class="list-inline pull-right d-flex align-items-center justify-content-between">';

		$str .= '<li class="ml-1">';

		$str .= '<a class="icon-jfi-trash jFiler-item-trash-action my-jFiler-item-trash" data-id="'.$id.'" data-folder="'.$model.'"></a>';

		$str .= '</li>';

		$str .= '<li class="mr-1">';

		$str .= '<div class="align-middle custom-control custom-checkbox d-inline-block text-md">';

		$str .= '<input type="checkbox" class="custom-control-input filer-checkbox" id="filer-checkbox-'.$id.'" value="'.$id.'">';

		$str .= '<label for="filer-checkbox-'.$id.'" class="custom-control-label font-weight-normal">Chọn</label>';

		$str .= '</div>';

		$str .= '</li>';

		$str .= '</ul>';

		$str .= '</div>';

		$str .= '<input type="number" class="mb-1 rounded form-control form-control-sm my-jFiler-item-info" value="'.$stt.'" placeholder="Số thứ tự" data-info="stt" data-id="'.$id.'"/>';

		$str .= '<input type="text" class="rounded form-control form-control-sm my-jFiler-item-info" value="'.$name.'" placeholder="Tiêu đề" data-info="tieude" data-id="'.$id.'"/>';

		$str .= '</div>';

		$str .= '</div>';

		$str .= '</li>';

		echo $str;

	}





	/*

    |--------------------------------------------------------------------------

    | UTF8 convert

    |--------------------------------------------------------------------------

    */

	public static function utf8convert($str='')

	{

		if($str != '')

		{

			$utf8 = array(

				'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

				'd'=>'đ|Đ',

				'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

				'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',

				'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

				'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

				'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',

				''=>'`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\“|\”|\:|\;|_',

			);



			foreach($utf8 as $ascii => $uni)

			{

				$str = preg_replace("/($uni)/i",$ascii,$str);

			}

		}



		return $str;

	}





	/*

    |--------------------------------------------------------------------------

    | Change title

    |--------------------------------------------------------------------------

    */

	public static function changeTitle($text='', $char='-')

	{

		if($text != '')

		{

			$text = strtolower(self::utf8convert($text));

			$text = preg_replace("/[^a-z0-9-\s]/", "",$text);

			$text = preg_replace('/([\s]+)/', $char, $text);

			$text = str_replace(array('%20', ' '), $char, $text);

			$text = preg_replace("/\-\-\-\-\-/",$char,$text);

			$text = preg_replace("/\-\-\-\-/",$char,$text);

			$text = preg_replace("/\-\-\-/",$char,$text);

			$text = preg_replace("/\-\-/",$char,$text);

			$text = '@'.$text.'@';

			$text = preg_replace('/\@\-|\-\@|\@/', '', $text);

		}



		return $text;

	}





	/*

    |--------------------------------------------------------------------------

    | Check permission

    |--------------------------------------------------------------------------

    */

	/*public static function CheckPermission($permission)

	{

        if(!Auth::guard('admin')->user()->can($permission) && Auth::guard('admin')->user()->role!=3){

            return false;

        }

		return true;

	}*/





	public static function CheckPermissionParent($permissions_parent=null,$permission)

	{

		if(Auth::guard('admin')->user()->role!=3){

			if($permissions_parent!=null){

				$permissions_parent = $permissions_parent->toArray();

				if(in_array($permission,$permissions_parent)){

					return true;

				}

				return false;

			}

		}

		return true;

	}





	/*

    |--------------------------------------------------------------------------

    | Get permission

    |--------------------------------------------------------------------------

    */

	public static function get_permission($id_permission=0)

	{

		$str='';

		$row = DB::table('roles')->where('id_admin',Auth::guard('admin')->user()->id)->where('hienthi',1)->get();

		if($row){

			$str = '<select id="id_nhomquyen" name="data[id_nhomquyen]" class="form-control select2" required><option value="0">Nhóm quyền</option>';

			foreach($row as $v)

			{

				if($v->id == (int)@$id_permission) $selected = "selected";

				else $selected = "";



				$str .= '<option value='.$v->id.' '.$selected.'>'.$v->role_name.'</option>';

			}

			$str .= '</select>';

		}

		return $str;

	}



	/*

    |--------------------------------------------------------------------------

    | Get today visitors dashboard

    |--------------------------------------------------------------------------

    */

	public static function GetTodayVisitors($daysInMonth,$year,$month)

	{

		$kq='';

		for($i = 1; $i <= $daysInMonth; $i++) {

			$k = $i+1;

			$begin = strtotime($year.'-'.$month.'-'.$i);

			$end = strtotime($year.'-'.$month.'-'.$k);

			$todayrc = DB::table('counter')->select('id')->where('tm','>=',$begin)->where('tm','<',$end)->get();

			$kq.= $todayrc->count().',';

		}

		return $kq;

	}





	/*

    |--------------------------------------------------------------------------

    |  Format money

    |--------------------------------------------------------------------------

    */

	public static function Format_Money($price=0, $unit='đ', $html=false)

	{

		$str = '';



		$str .= number_format($price, 0, ',', '.');

		if($unit != '')

		{

			if($html)

			{

				$str .= '<span>'.$unit.'</span>';

			}

			else

			{

				$str .= '<span>'.$unit.'</span>';

			}

		}

		return $str;

	}


	public static function Format_Money_Other($price=0, $unit='vnđ', $html=false)

	{

		$str = '';



		$str .= number_format($price, 0, ',', '.');

		if($unit != '')

		{

			if($html)

			{

				$str .= $unit;

			}

			else

			{

				$str .= $unit;

			}

		}

		return $str;

	}






	/*

    |--------------------------------------------------------------------------

    |  Count contact by type

    |--------------------------------------------------------------------------

    */

	public static function CountAllInform()

	{

		$countOrder = $countContact = $countNewsletter = $countQuestion = $countDanhgia = 0;

		$countDanhgia = self::CountDanhGiaNew();

		$countBinhluan = self::CountBinhLuanNew();


		if(config('config_all.order.active')==true){

			$countOrder = self::CountOrderNew();

		}



		if(config('config_all.question.active')==true){

			$countQuestion = self::CountQuestionNew();

		}



		if(config('config_type.contact')){

			$config_contact = config('config_type.contact');

			foreach($config_contact as $k=>$v){

				$countContact+=self::CountContact($k);

			}

		}



		if(config('config_type.newsletter')){

			$config_newsletter = config('config_type.newsletter');

			foreach($config_newsletter as $k=>$v){

				$countNewsletter+=self::CountNewsletter($k);

			}

		}

		return $countOrder + $countContact + $countNewsletter + $countQuestion + $countDanhgia + $countBinhluan;

	}









	/*

    |--------------------------------------------------------------------------

    |  Count contact by type

    |--------------------------------------------------------------------------

    */

	public static function CountContact($type)

	{

		return DB::table('contact')->where('type',$type)->where('hienthi',0)->count();

	}



	/*

    |--------------------------------------------------------------------------

    |  Count newsletter by type

    |--------------------------------------------------------------------------

    */

	public static function CountNewsletter($type)

	{

		return DB::table('newsletter')->where('type',$type)->where('tinhtrang',0)->count();

	}





	/*

    |--------------------------------------------------------------------------

    |  Count order new

    |--------------------------------------------------------------------------

    */

	public static function CountOrderNew()

	{

		return DB::table('order')->where('tinhtrang',1)->where('hienthi',1)->count();

	}



	/*

    |--------------------------------------------------------------------------

    |  Count order new

    |--------------------------------------------------------------------------

    */

	public static function CountQuestionNew()

	{

		return DB::table('question')->where('duyettin',0)->where('hienthi',1)->count();

	}


	/*

    |--------------------------------------------------------------------------

    |  Count order new

    |--------------------------------------------------------------------------

    */

	public static function CountDanhGiaNew()

	{

		return DB::table('danhgia')->where('duyettin',0)->count();

	}


	/*

    |--------------------------------------------------------------------------

    |  Count order new

    |--------------------------------------------------------------------------

    */

	public static function CountBinhLuanNew()

	{

		return DB::table('comment')->where('hienthi',1)->count();

	}





	/*

    |--------------------------------------------------------------------------

    |  Get info of places

    |--------------------------------------------------------------------------

    */

	public static function GetPlace($table='', $id=0, $transporttype='')

	{

		if($table && $id)

		{

			$row = DB::table($table)->select('ten');

			if($transporttype!=''){

				$row = $row->where('id_delivery',$id)->where('type', $transporttype);

			}else{

				$row = $row->where('id',$id);

			}

			$row = $row->first();



			return $row->ten;

		}

		return '';

	}





	/*

    |--------------------------------------------------------------------------

    |  Set Query URL

    |--------------------------------------------------------------------------

    */

	public static function SetQuery($query){

		$str = '';

		foreach($query as $k=>$v){

			$str .= '&'.$k.'='.$v;

		}

		return $str;

	}





	/* Lấy youtube */

	public static function GetYoutube($url='')

	{

		if($url != '')

		{

			$parts = parse_url($url);

			if(isset($parts['query']))

			{

				parse_str($parts['query'], $qs);

				if(isset($qs['v'])) return $qs['v'];

				else if($qs['vi']) return $qs['vi'];

			}



			if(isset($parts['path']))

			{

				$path = explode('/', trim($parts['path'], '/'));

				return $path[count($path) - 1];

			}

		}



		return false;

	}





	/* Lấy youtube */

	public static function GetThumbYoutube($url='')

	{

		//https://img.youtube.com/vi/8z6lQBZvnRA/hqdefault.jpg

		if($url != '')

		{

			$check_url = str_contains($url, 'youtu.be/');

			if($check_url){
				$url = explode('youtu.be/',$url);
				$url = 'https://www.youtube.com/watch?v='.$url[1];
			}

			$video_arr = explode( '?v=', $url );

			$video_arr = explode( '&t', $video_arr[1]);

			return "https://img.youtube.com/vi/".$video_arr[0]."/hqdefault.jpg";

		}



		return false;

	}


	/* Lấy youtube */

	public static function GetIDYoutube($url='')

	{

		//https://img.youtube.com/vi/8z6lQBZvnRA/hqdefault.jpg

		if($url != '')

		{

			$check_url = str_contains($url, 'youtu.be/');

			if($check_url){
				$url = explode('youtu.be/',$url);
				$url = 'https://www.youtube.com/watch?v='.$url[1];
			}

			$video_arr = explode( '?v=', $url );

			$video_arr = explode( '&t', $video_arr[1]);

			return $video_arr[0];

		}



		return false;

	}





	/* Lấy getCurrentPageURL */

	public static function getCurrentPageURL()

	{

		$pageURL = 'http';

		if(array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") $pageURL .= "s";

		$pageURL .= "://";

		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

		$urlpos = strpos($pageURL, "?p");

		$pageURL = ($urlpos) ? explode("?p=", $pageURL) : explode("&p=", $pageURL);

		return $pageURL[0];

	}



	/* Lấy getCurrentPageURL Cano */

	public static function getCurrentPageURL_CANO()

	{

		$pageURL = 'http';

		if(array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") $pageURL .= "s";

		$pageURL .= "://";

		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

		$pageURL = str_replace("amp/", "", $pageURL);

		$urlpos = strpos($pageURL, "?p");

		$pageURL = ($urlpos) ? explode("?p=", $pageURL) : explode("&p=", $pageURL);

		$pageURL = explode("?", $pageURL[0]);

		$pageURL = explode("#", $pageURL[0]);

		$pageURL = explode("index", $pageURL[0]);

		return $pageURL[0];

	}





	/* Lấy places */

	public static function getFullPlace($table='', $id=0)

	{

		if($table && $id)

		{

			//### Gọi model

			$model = new Places($table);

			$row = $model->GetOneItem($id);



			$result = '';

			$result .= $row['ten'];

			return $result;

		}

		else

		{

			return false;

		}

	}





	/* Get data table */

    public static function GetDataTable($model,$type,$param=null){

    	switch ($model) {

			case 'product':

				self::initialized('product');

        		$model = self::$productRepo;

				break;

			case 'post':

				self::initialized('post');

        		$model = self::$postRepo;

				break;

			case 'album':

				self::initialized('album');

        		$model = self::$albumRepo;

				break;

			case 'tags':

				self::initialized('tags');

        		$model = self::$tagRepo;

				break;

			case 'category':

				self::initialized('category');

        		$model = self::$categoryRepo;

				break;

			case 'brand':

				self::initialized('brand');

        		$model = self::$brandRepo;

				break;

		}



		return $model->GetAll($type,$param,self::$relations);

    }





	public static function GetArraySitemap($arr_requick,$isIndex=false){

		$array_sitemap_page_index = array('');

		$array_sitemap_post = $array_sitemap_tags = $array_sitemap_brand = $array_sitemap_product = $array_sitemap_album = $array_sitemap_category = $array_sitemap_category_detail = $array_sitemap_list_index = array();

		$arr_model_check = array('post','product','album','tags', 'brand');


		foreach($arr_requick as $key=>$value){

			if(isset($value['menu'])){

				if($value['menu']){array_push($array_sitemap_page_index,$value['com']);}

				/* Ds product - post - album ko thuộc cấp (man) */

				if(isset($value['model']) && isset($value['sitemap']) && $value['sitemap']==true && in_array($value['model'],$arr_model_check)){
					$params = [];
					if($value['model']!='brand'){
						$params['id_category'] = 0;
					}


					$data = self::GetDataTable($value['model'],$value['type'],$params);

					if($data){

						switch ($value['model']) {

							case 'tags':

								$array_sitemap_tags = array_merge($array_sitemap_tags, $data->toArray());

								break;

							case 'post':

								$array_sitemap_post = array_merge($array_sitemap_post, $data->toArray());

								break;

							case 'product':

								$array_sitemap_product = array_merge($array_sitemap_product, $data->toArray());

								break;

							case 'album':

								$array_sitemap_album = array_merge($array_sitemap_album, $data->toArray());

								break;

							case 'brand':

								$array_sitemap_brand = array_merge($array_sitemap_brand, $data->toArray());

								break;

						}

					}

				}



				/* Ds danh mục category */

				if(isset($value['model']) && $value['model']=='category' && $value['sitemap']){
					$arr_tmp = $data = $data_tmp = array();

					$data = $data_tmp = self::GetDataTable($value['model'],$value['type']);

					$data = $data->toArray();



					foreach($data_tmp as $t=>$tmp){

						switch ($value['relation']) {

							case 'product':

								$tmp_hasAll = $tmp->HasAllProduct;

								break;

							case 'post':

								$tmp_hasAll = $tmp->HasAllPost;

								break;

							case 'album':

								$tmp_hasAll = $tmp->HasAllAlbum;

								break;

						}

						$data[$t]['list_child_item'] = ($tmp_hasAll) ? $tmp_hasAll->toArray() : array();

						$arr_tmp[$data[$t]['tenkhongdauvi']] = $data[$t]['list_child_item'];

					}



					$array_sitemap_category = array_merge($array_sitemap_category, $arr_tmp);

					$array_sitemap_category_detail = array_merge($array_sitemap_category_detail, $data);

					$array_sitemap_list_index = array_merge($array_sitemap_list_index, $data);

				}

			}

		}





		$array_sitemap_main = array(

			'page' => $array_sitemap_page_index,

			'category' => ($isIndex) ? $array_sitemap_list_index : $array_sitemap_category_detail,

			'post' => $array_sitemap_post,

			'product' => $array_sitemap_product,

			'album' => $array_sitemap_album,

			'tags' => $array_sitemap_tags,

			'brand' => $array_sitemap_brand

		);

		//dd($array_sitemap_list_index);
		//dd($array_sitemap_main['category']);



		if(!$isIndex){

			$array_sitemap_main = array_merge($array_sitemap_main,$array_sitemap_category);

		}



		return $array_sitemap_main;

	}





	/* Create sitemap */

	public static function CreateSitemapPage($values, $page='')

	{

		$config_base = self::GetConfigBase();//config('config_all.config_base');



		$array_numberpage_sitemap = array();

		$sitemap = null;



		switch ($page) {

			case 'page':

				foreach($values as $k=>$v){

					$array_tmp = Helper::XMLElement($config_base.$v,date('c',time()));

					array_push($array_numberpage_sitemap, $array_tmp);

				}

				break;

			case 'category':

			case 'product':

			case 'post':

				foreach($values as $k=>$v){

					$array_tmp = Helper::XMLElement($config_base.$v['tenkhongdauvi'],date('c',$v['ngaysua']));

					array_push($array_numberpage_sitemap, $array_tmp);

				}

				break;

			case 'tags':

				foreach($values as $k=>$v){

					$array_tmp = Helper::XMLElement($config_base.'tags/'.$v['tenkhongdauvi'],date('c',$v['ngaysua']));

					array_push($array_numberpage_sitemap, $array_tmp);

				}

				break;

			default:

				foreach($values as $k=>$v){

					$array_tmp = Helper::XMLElement($config_base.$v['tenkhongdauvi'],date('c',$v['ngaysua']));

					array_push($array_numberpage_sitemap, $array_tmp);

				}

				break;

		}



		return $array_numberpage_sitemap;

	}





	public static function XMLElement($loc,$lastmod,$changefreq='weekly',$priority=1){

		return  array(

					'loc' => $loc,

					'lastmod' => $lastmod,

					'changefreq' => $changefreq,

					'priority' => $priority,

				);

	}





	/* Create SEO */

	public static function setSeo($key='', $value='')

	{

		if($key != '' && $value != '') self::$seo[$key] = $value;

	}



	public static function getSeo($key)

	{

		return (isset(self::$seo[$key]) && self::$seo[$key] != '') ? self::$seo[$key] : '';

	}



	/* Get Img size */

	public static function getImgSize($photo='', $patch='')

	{

		$x = (file_exists(isset($patch))) ? getimagesize($patch) : null;
		if($x==null){
			$x[0] = '';
			$x[1] = '';
			$x['mime'] = '';
		}

		return array("p"=>$photo,"w"=>$x[0],"h"=>$x[1],"m"=>$x['mime']);

	}





	/* Counter statistic */

	public static function getCounter(){

        $locktime = 30 * 60;

        $initialvalue = 1;

        $records = 100000;

        $day = date('d');

        $month = date('n');

        $year = date('Y');



        /* Day start */

        $daystart = mktime(0,0,0,$month,$day,$year);



        /* Month start */

        $monthstart = mktime(0,0,0,$month,1,$year);



        /* Week start */

        $weekday = date('w');

        $weekday--;

        if($weekday < 0) $weekday = 7;

        $weekday = $weekday * 24*60*60;

        $weekstart = $daystart - $weekday;



        /* Yesterday start */

        $yesterdaystart = $daystart - (24*60*60);

        $now = time();

        $ip = $_SERVER['REMOTE_ADDR'];



        $t = Counter::max('id');

        $all_visitors = $t;



        if($all_visitors !== NULL) $all_visitors += $initialvalue;

        else $all_visitors = $initialvalue;



        /* Delete old records */

        $temp = $all_visitors - $records;



        if($temp>0) Counter::where('id','<',$temp)->delete();



        $vip = Counter::select(Counter::raw('count(*) as visitip'))->where('ip',$ip)->where('tm','>',$now-$locktime)->first();

        $items = ($vip) ? $vip->visitip : null;



        if($items==null || $items==0) Counter::create(['tm'=>$now,'ip'=>$ip]);



        $n = $all_visitors;

        $div = 100000;

        while ($n > $div) $div *= 10;



        $todayrec = Counter::select(Counter::raw('count(*) as todayrecord'))->where('tm','>',$daystart)->first();

        $yesrec = Counter::select(Counter::raw('count(*) as yesterdayrec'))->where('tm','>',$yesterdaystart)->where('tm','<',$daystart)->first();

        $weekrec = Counter::select(Counter::raw('count(*) as weekrec'))->where('tm','>=',$weekstart)->first();

        $monthrec = Counter::select(Counter::raw('count(*) as monthrec'))->where('tm','>=',$monthstart)->first();

        $totalrec = Counter::max('id');



        $result['today'] = $todayrec->todayrecord;

        $result['yesterday'] = $yesrec->yesterdayrec;

        $result['week'] = $weekrec->weekrec;

        $result['month'] = $monthrec->monthrec;

        $result['total'] = $totalrec;

		$result['online'] = self::getOnline();



        return $result;

    }



	/* Counter online user */

    public static function getOnline()

    {

        $session = Session::getId();

        $time = time();

        $time_check = $time - 600;

        $ip = $_SERVER['REMOTE_ADDR'];



        $result = Online::select()->where('session',$session)->get();

        if(count($result) == 0)

        {

            Online::create(['session'=>$session,'time'=>$time,'ip'=>$ip]);

        }

        else

        {

            Online::where('session', $session)->update(['time'=>$time]);

        }



        Online::select()->where('time','<',$time_check)->delete();



        $user_online = Online::select()->get();

        $user_online = $user_online->count();



        return $user_online;

    }





	/* Check Lockpage */

	/*public static function LockPage(){

		$config_lock = config('config_all.lockpage');

		if($config_lock!=''){

			return false;

		}

		return true;

	}*/





	/* Lấy IP */

	public static function getRealIPAddress()

	{

		if(!empty($_SERVER['HTTP_CLIENT_IP']))

		{

			$ip = $_SERVER['HTTP_CLIENT_IP'];

		}

		elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))

		{

			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];

		}

		else

		{

			$ip = $_SERVER['REMOTE_ADDR'];

		}

		return $ip;

	}



	public static function setPrefixCategory($level, $str='-'){

		$str_output = '';

		for($i=0;$i<$level+1;$i++){

			$str_output .= $str.' ';

		}

		return $str_output;

	}



	public static function showMultyCategory($data){

		$str_result = '';



		if($data){

			foreach($data as $k=>$v){

				$str_result .= '<li> </li>';

			}

		}



		return $str_result;

	}





	public static function showCategory($data, $id_selected=0){

		$str_result = '';

		$categories = [];



		if($data){

		 	$categories = $data->toArray();

		 	$str_result = self::getCategoryChild($categories, 0, $id_selected);

		}



		return $str_result;

	}





	public static function getCategoryChild($categories, $parent_id = 0, $id_selected)

	{



	    foreach ($categories as $k => $v)

	    {

	    	$selected = ($id_selected==$v['id']) ? 'miko-li-active' : '';



	    	$ids_parent = ($v['ids_parent']) ? explode(',',$v['ids_parent']) : array();



	        // Nếu là chuyên mục con thì hiển thị

	        if ($v['id_parent'] == $parent_id || in_array($parent_id, $ids_parent))

	        {

	            echo '<li value="'.$v['id'].'" class="miko-li-select '.($selected).'" style="padding-left:'.(($v['level']+1)*20).'px">';

                    echo $v['tenvi'];

                echo '</li>';



	            // Xóa chuyên mục đã lặp

	            unset($categories[$k]);



	            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp

	            self::getCategoryChild($categories, $v['id'], $id_selected);

	        }

	    }

	}





	public static function getInfoImage($sourceImage)

	{

		$image_info = getimagesize($sourceImage);

		return ($image_info) ? $image_info[0] : 0;

	}





	public static function showCategoryAll($id_div='',$limit='',$type='product'){

		$categoryRepo = self::initialized('category')->Query();

		$categoryRepo = $categoryRepo->where('type',$type)->where('hienthi',1)->orderBy('stt', 'asc');



		$danhmucparent = ($limit!='') ? $categoryRepo->get() : $categoryRepo->get();

		$str_result = '';

		$categories = [];



		if($danhmucparent){

		 	$categories = $danhmucparent->toArray();

		 	$str_result .= self::getCategoryChildAll($categories, 0, $id_div);

		}



		return $str_result;

	}



	public static function getCategoryChildAll($categories, $parent_id = 0, $id_div='')

	{

		$is_ul = false;

		$str_li='';



	    foreach ($categories as $k => $v)

	    {

	        // Nếu là chuyên mục con thì hiển thị

	        if ($v['id_parent'] == $parent_id)

	        {

	        	$is_ul=true;

	            $str_li.='<li><a href="'.$v['tenkhongdauvi'].'">'.$v['tenvi'].'</a>';



	            // Xóa chuyên mục đã lặp

	            unset($categories[$k]);



	            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp

	            $str_li.=self::getCategoryChildAll($categories, $v['id']);

	            $str_li.='</li>';

	        }

	    }



	    if($is_ul){

	    	return '<ul id="'.(($parent_id==0) ? $id_div : '').'">'.$str_li.'</ul>';

	    }

	    return '';

	}





	public static function showCategoryMenu($id_div='', $type='product'){

		$categoryRepo = self::initialized('category')->Query();

		$categoryRepo = $categoryRepo->whereRaw("type = ? and hienthi=1 or (menu=1 and level=0)", [$type])->orderBy('stt', 'asc');



		$danhmucparent = $categoryRepo->get();

		$str_result = '';

		$categories = [];



		if($danhmucparent){

		 	$categories = $danhmucparent->toArray();

		 	$str_result .= self::getCategoryChildMenu($categories, 0, $id_div);

		}



		return $str_result;

	}



	public static function getCategoryChildMenu($categories, $parent_id = 0, $id_div='')

	{

		$is_ul = false;

		$str_li='';

		$dem_level_1 = 0;



	    foreach ($categories as $k => $v)

	    {

	    	if($dem_level_1>=4){

	    		break;

	    	}

	        // Nếu là chuyên mục con thì hiển thị

	        if ($v['id_parent'] == $parent_id)

	        {

	        	$is_ul=true;

	            $str_li.='<li><a href="'.$v['tenkhongdauvi'].'">'.$v['tenvi'].'</a>';



	            // Xóa chuyên mục đã lặp

	            unset($categories[$k]);



	            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp

	            $str_li.=self::getCategoryChildMenu($categories, $v['id']);

	            $str_li.='</li>';

	        }

	        if($v['level']==0 && $v['menu']==1){

	    		$dem_level_1++;

	    		//echo '<p>1</p>';

	    	}





	    }



	    if($is_ul){

	    	return '<ul id="'.(($parent_id==0) ? $id_div : '').'">'.$str_li.'</ul>';

	    }

	    return '';

	}





	public static function ShowCategoryName($id_category){

		$categoryRepo = self::initialized('category');

		$row = $categoryRepo->GetOneItem($id_category);

		if($row){

			return $row['tenvi'];

		}

		return '';

	}



	public static function GetCheckColor($row_product){

		$arr_tmp = array();

		$colorRepo = self::initialized('color');

		$productOptRepo = self::initialized('productoption');



		$ids_mau = $productOptRepo->GetAllItemsByParamsPluck('id_mau',['type'=>$row_product['type'], 'id_product'=>$row_product['id'], 'xoatam'=>0, 'hienthi'=>1]);

        $mau = $colorRepo->GetAllItemByIds($ids_mau);

		return $mau;

	}





	public static function GetCheckSize($row_product){

		$arr_tmp = array();

		$sizeRepo = self::initialized('size');

		$productOptRepo = self::initialized('productoption');



		$params = array(

			'type'=>$row_product['type'],

			'id_product'=>$row_product['id'],

			'xoatam'=>0,

			'hienthi'=>1

		);



		$ids_size = $productOptRepo->GetAllItemsByParamsPluck('id_size',$params);



        $size = $sizeRepo->GetAllItemByIds($ids_size);

		return $size;

	}





	public static function GetColor($id_mau){

		$arr_mau = explode(',',$id_mau);

		$arr_tmp = array();

		$colorRepo = self::initialized('color');



		foreach($arr_mau as $k=>$v){

			$row = $colorRepo->GetOneItem($v);

			$arr_tmp[] = $row;

		}

		return $arr_tmp;

	}



	public static function GetSize($id_size){

		$arr_size = explode(',',$id_size);

		$arr_tmp = array();

		$sizeRepo = self::initialized('size');

		foreach($arr_size as $k=>$v){

			$row = $sizeRepo->GetOneItem($v);

			$arr_tmp[] = $row;

		}

		return $arr_tmp;

	}


	public static function GetNoimage($width,$height,$type=1){

		return Thumb::Crop('img/','noimage.png',$width,$height,$type);

	}


	public static function GetMenuLv($level=0,$type='product',$id_parent=''){
		$categoryRepo = self::initialized('category')->Query();
		$category_tmp = $categoryRepo->whereRaw("type = ? and hienthi=1 and level=? and tenvi<>''", [$type, $level]);
		if($id_parent!=''){
			$category_tmp = $category_tmp->whereRaw('FIND_IN_SET("'.$id_parent.'", ids_level_1)');
		}
		$category_tmp = $category_tmp->orderBy('stt', 'asc')->get();
		return ($category_tmp) ? $category_tmp->toArray() : null;
	}


	public static function showCategoryMenuMulty($id_div='', $type='product' , $lang='vi', $ismobile=false, $haschild=false){

		$str_result = '';

		$categoryRepo = self::initialized('category')->Query();

		$max_level = $categoryRepo->max('level');

		//$categoryRepo = $categoryRepo->whereRaw("type = ? and hienthi=1 or (menu=1 and level=0)", [$type])->orderBy('stt', 'asc')->get();



		for($i=0;$i<=$max_level;$i++){

			if($i==0){

				$category_tmp = $categoryRepo->whereRaw("type = ? and hienthi=1 and level=?", [$type, $i])->orderBy('stt', 'asc')->get();

			}else{

				$category_tmp = $categoryRepo->whereRaw("type = ? and hienthi=1 and level=?", [$type,$i])->orderBy('stt', 'asc')->get();

			}

			if($category_tmp){ $arr_category_multy[$i] = $category_tmp->toArray(); }

		}



		//### lấy html menu

		if($arr_category_multy){

			$str_result .= self::getCategoryChildMenuMulty($id_div, $max_level, $arr_category_multy, self::GetConfigBase(),0,null,$lang,$ismobile,$haschild);

		}



		return $str_result;

	}





	public static function getCategoryChildMenuMulty($id_div, $max_level, $arr_category_multy, $str_tenkhongdau='', $position=0, $arr_ids_before=array(),$lang,$ismobile=false,$haschild=false)

	{

		$str_result='';

		if(isset($arr_category_multy[$position])){

			if((!$ismobile) || $haschild){$str_result .= '<ul id="'.(($position==0) ? $id_div : '').'">';}



			foreach($arr_category_multy[$position] as $k=>$v){

				if( $position>0){

					$check_id = true;

					foreach($arr_ids_before as $level => $id){

						if(!in_array($id, explode(',',$v['ids_level_'.($level+1)]))){

							$check_id = false;

							break;

						}

					}



					if( $check_id ){

						$arr_ids_before_tmp = $arr_ids_before;

						$arr_ids_before_tmp[$position] = $v['id'];

						$str_result .= '<li>';

						if($ismobile){
							$str_result .= '<div class="menu-side-title" style="padding-left:1.5rem">';
						}

						$str_result .= '<a href="'.$str_tenkhongdau.$v['tenkhongdau'.$lang].'">'.$v['ten'.$lang].'</a>';

						if($ismobile){
							$str_result .= '</div>';
						}

						$str_result .= self::getCategoryChildMenuMulty($id_div, $max_level, $arr_category_multy,$str_tenkhongdau.$v['tenkhongdau'.$lang].'/',$position+1,$arr_ids_before_tmp, $lang, $haschild);

						$str_result .= '</li>';

					}

				}else{

					$arr_ids_before_tmp = $arr_ids_before;

					$arr_ids_before_tmp[$position] = $v['id'];

					$currentMenu = '';
					if(!$ismobile){
						$currentMenu = self::currentMenu($v['tenkhongdau'.$lang]);
					}

					$str_result .= '<li class="'.$currentMenu.'">';

					if($ismobile){
						$str_result .= '<div class="menu-side-title">';
					}

					$str_result .= '<a href="'.$str_tenkhongdau.$v['tenkhongdau'.$lang].'">'.$v['ten'.$lang].'</a>';

					if($ismobile){
						$str_result .= '</div>';
					}

					$str_result .= self::getCategoryChildMenuMulty($id_div, $max_level, $arr_category_multy,$str_tenkhongdau.$v['tenkhongdau'.$lang].'/',$position+1,$arr_ids_before_tmp, $lang, $haschild);

					$str_result .= '</li>';

				}

			}

			if((!$ismobile) || $haschild){$str_result .= '</ul>';}

		}

		return $str_result;

	}



	public static function showCategoryMenuMultyBlog($id_div='', $type='product' , $lang='vi', $ismobile=false, $haschild=false){

		$str_result = '';

		$categoryRepo = self::initialized('category')->Query();

		$max_level = $categoryRepo->max('level');

		//$categoryRepo = $categoryRepo->whereRaw("type = ? and hienthi=1 or (menu=1 and level=0)", [$type])->orderBy('stt', 'asc')->get();



		for($i=0;$i<=$max_level;$i++){

			if($i==0){

				$category_tmp = $categoryRepo->whereRaw("type = ? and hienthi=1 and level=?", [$type, $i])->orderBy('stt', 'asc')->get();

			}else{

				$category_tmp = $categoryRepo->whereRaw("type = ? and hienthi=1 and level=?", [$type,$i])->orderBy('stt', 'asc')->get();

			}

			if($category_tmp){ $arr_category_multy[$i] = $category_tmp->toArray(); }

		}



		//### lấy html menu

		if($arr_category_multy){

			$str_result .= self::getCategoryChildMenuMultyBlog($id_div, $max_level, $arr_category_multy, self::GetConfigBase(),0,null,$lang,$ismobile,$haschild);

		}



		return $str_result;

	}





	public static function getCategoryChildMenuMultyBlog($id_div, $max_level, $arr_category_multy, $str_tenkhongdau='', $position=0, $arr_ids_before=array(),$lang,$ismobile=false,$haschild=false)

	{

		$str_result='';

		if(isset($arr_category_multy[$position])){

			if((!$ismobile) || $haschild){$str_result .= '<ul id="'.(($position==0) ? $id_div : '').'">';}



			foreach($arr_category_multy[$position] as $k=>$v){

				if( $position>0){

					$check_id = true;

					foreach($arr_ids_before as $level => $id){

						if(!in_array($id, explode(',',$v['ids_level_'.($level+1)]))){

							$check_id = false;

							break;

						}

					}



					if( $check_id ){

						$arr_ids_before_tmp = $arr_ids_before;

						$arr_ids_before_tmp[$position] = $v['id'];

						//### Lấy số lượng blog thuộc category theo id
						$postRepo = self::initialized('post')->Query();
						$max_blog = $postRepo->whereRaw("type = ? and hienthi=1 and ids_level_".($v['level']+1)." = ?", [$v['type'], $v['id']])->count();

						$str_result .= '<li>';

						if($ismobile){
							$str_result .= '<div class="menu-side-title" style="padding-left:1.5rem">';
						}

						$str_result .= '<a href="'.$str_tenkhongdau.$v['tenkhongdau'.$lang].'">'.$v['ten'.$lang].'</a>';

						$str_result .= ' <span>('.$max_blog.')</span>';

						if($ismobile){
							$str_result .= '</div>';
						}

						$str_result .= self::getCategoryChildMenuMultyBlog($id_div, $max_level, $arr_category_multy,$str_tenkhongdau.$v['tenkhongdau'.$lang].'/',$position+1,$arr_ids_before_tmp, $lang, $haschild);

						$str_result .= '</li>';

					}

				}else{

					$arr_ids_before_tmp = $arr_ids_before;

					$arr_ids_before_tmp[$position] = $v['id'];

					//### Lấy số lượng blog thuộc category theo id
					$postRepo = self::initialized('post')->Query();
					$max_blog = $postRepo->whereRaw("type = ? and hienthi=1 and ids_level_".($v['level']+1)." = ?", [$v['type'], $v['id']])->count();

					$currentMenu = '';
					if(!$ismobile){
						$currentMenu = self::currentMenu($v['tenkhongdau'.$lang]);
					}

					$str_result .= '<li class="'.$currentMenu.'">';

					if($ismobile){
						$str_result .= '<div class="menu-side-title">';
					}

					$str_result .= '<a href="'.$str_tenkhongdau.$v['tenkhongdau'.$lang].'">'.$v['ten'.$lang].'</a>';

					$str_result .= ' <span>('.$max_blog.')</span>';

					if($ismobile){
						$str_result .= '</div>';
					}

					$str_result .= self::getCategoryChildMenuMultyBlog($id_div, $max_level, $arr_category_multy,$str_tenkhongdau.$v['tenkhongdau'.$lang].'/',$position+1,$arr_ids_before_tmp, $lang, $haschild);

					$str_result .= '</li>';

				}

			}

			if((!$ismobile) || $haschild){$str_result .= '</ul>';}

		}

		return $str_result;

	}





	public static function getLevelCategory($parent, $typecate='1'){

		$categoryRepo = self::initialized('category')->Query();

		$categories_byId = $categoryRepo->where('level', $typecate)->whereRaw('FIND_IN_SET('.$parent['id'].',ids_level_'.$typecate.')')->get();

		return ($categories_byId) ? $categories_byId->toArray() : null;

	}





	public static function getInfoCategory($id){

		$categoryRepo = self::initialized('category')->Query();

		$categories_byId = $categoryRepo->where('id', $id)->first();

		return ($categories_byId) ? $categories_byId->toArray() : '';

	}



	public static function TimeElapsed($time) {

	    $time_difference = time() - $time;



	    if( $time_difference < 1 ) { return 'chưa đầy 1 giây trước'; }

	    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'năm',

	                30 * 24 * 60 * 60       =>  'tháng',

	                24 * 60 * 60            =>  'ngày',

	                60 * 60                 =>  'giờ',

	                60                      =>  'phút',

	                1                       =>  'giây'

	    );



	    foreach( $condition as $secs => $str )

	    {

	        $d = $time_difference / $secs;



	        if( $d >= 1 )

	        {

	            $t = round( $d );

	            return /*'khoảng ' .*/ $t . ' ' . $str . ' trước';

	        }

	    }

	}





	/*

    |--------------------------------------------------------------------------

    | Get coockies truy cập website

    |--------------------------------------------------------------------------

    */

	public static function GetInfoProduct($id, $table){

		if($table=='product_option'){

			$model = self::Get_model('productOption');

		}else if($table=='product'){

			$model = self::Get_model('product');

		}



		return $model->GetItem(['id'=>$id]);

	}





	/*

    |--------------------------------------------------------------------------

    | Get videos

    |--------------------------------------------------------------------------

    */

	public static function GetVideos($id_category,$type){

		$model = self::Get_model('post');

		$result = $model->Query()->where('hienthi',1)->where('type',$type)->whereRaw('FIND_IN_SET('.$id_category.',ids_level_1)')->orderBy('stt', 'asc');

		if($result){

			return $result->get()->toArray();

		}

		return null;

	}





	/*

    |--------------------------------------------------------------------------

    | Get videos

    |--------------------------------------------------------------------------

    */

	public static function saveImgBase64($param,$fileName)

	{

	    $file = 'public/upload/image/'.$fileName;

	    $image_base64 = base64_decode($param);

	    return file_put_contents($file, $image_base64);

	}





	public static function CheckFile($file){

		if($file!=''){

			$arr_tmp = explode('.', $file);

			return $arr_tmp[1];

		}

		return '';

	}


	public static function GetPriceBetween($id_product=0){

		$model = self::Get_model('productOption');

		$row_giamin = $model->Query()->where('hienthi',1)->where('xoatam',0)->where('phienbanmau',0)->where('id_product', $id_product)->min('gia');
		$row_giamax = $model->Query()->where('hienthi',1)->where('xoatam',0)->where('phienbanmau',0)->where('id_product', $id_product)->max('gia');
		$row_giamoimin = $model->Query()->where('hienthi',1)->where('xoatam',0)->where('phienbanmau',0)->where('id_product', $id_product)->min('giamoi');
		$row_giamoimax = $model->Query()->where('hienthi',1)->where('xoatam',0)->where('phienbanmau',0)->where('id_product', $id_product)->max('giamoi');

		$result['giamin'] = ($row_giamoimin == 0) ? $row_giamin : $row_giamoimin;
		$result['giamax'] = ($row_giamoimax == 0) ? $row_giamax : $row_giamoimax;

		if($id_product==97){
			//dd($row_giamin);
		}
		return $result;

	}


	public static function GetCurrentWeekday($date) {
	    date_default_timezone_set('Asia/Ho_Chi_Minh');

	    $weekday = date("l", $date);
	    $weekday = strtolower($weekday);
	    switch($weekday) {
	        case 'monday':
	            $weekday = __('Thứ hai');
	            break;
	        case 'tuesday':
	            $weekday = __('Thứ ba');
	            break;
	        case 'wednesday':
	            $weekday = __('Thứ tư');
	            break;
	        case 'thursday':
	            $weekday = __('Thứ năm');
	            break;
	        case 'friday':
	            $weekday = __('Thứ sáu');
	            break;
	        case 'saturday':
	            $weekday = __('Thứ bảy');
	            break;
	        default:
	            $weekday = __('Chủ nhật');
	            break;
	    }
	    return $weekday.', '.date('d/m', $date);
	}


	public static function Inform($option, $data=null){
        $icon = $text = $description = $isform ='';
        $class = '';

        switch ($option) {
            case 'hasSignin': // Nếu tk đã đang đăng nhập
                $icon = 'hasSignin';
                $text = __('Thành công!');
                $class = 'classSuccess';
                $description = __('Đăng ký tài khoản thành công. Kiểm tra email đăng ký để kích hoạt tài khoản !');
                $bg = 'bgSuccess';
                break;

            case 'hasLogin': // Nếu tk đã đang đăng nhập
                $icon = 'hasLogin';
                $text = __('Cảnh báo!');
                $class = 'classWarning';
                $description = __('Tài khoản của bạn hiện tại đã đăng nhập !');
                $bg = 'bgWarning';
                break;

            case 'successLogin': // Nếu đăng nhập thành công
                $icon = 'successLogin';
                $text = __('Thành công!');
                $class = 'classSuccess';
                $description = __('Tài khoản hợp lệ, đăng nhập thành công!');
                $bg = 'bgSuccess';
                break;

            case 'errorLogin': // Nếu đăng nhập thành công
                $icon = 'errorLogin';
                $text = __('Xảy ra lỗi!');
                $class = 'classError';
                $description = __('Xảy ra lỗi trong quá trình đăng nhập. Vui lòng thực hiện lại!');
                $bg = 'bgError';
                break;

            case 'notLogin': // Nếu đăng nhập thành công
                $icon = 'errorLogin';
                $text = __('Xảy ra lỗi!');
                $class = 'classError';
                $description = __('Hệ thống phát hiện tài khoản chưa đăng nhập. Vui lòng đăng nhập để tiếp tục');
                $bg = 'bgError';
                break;

            case 'notExist': // Nếu tài khoản ko tồn tại
                $icon = 'notExist';
                $text = __('Xảy ra lỗi!');
                $class = 'classError';
                $description = __('Hệ thống phát hiện tài khoản email này không tồn tại !');
                $bg = 'bgError';
                break;

            case 'successReset': // Nếu tài khoản ko tồn tại
                $icon = 'successReset';
                $text = __('Thành công!');
                $class = 'classSuccess';
                $description = __('Quá trình tạo mật khẩu mới thành công! Kiểm tra email để nhận mật khẩu mới');
                $bg = 'bgSuccess';
                break;

            case 'errorReset': // Nếu tài khoản ko tồn tại
                $icon = 'errorReset';
                $text = __('Xảy ra lỗi!');
                $class = 'classError';
                $description = __('Xảy ra lỗi trong quá trình cài lại mật khẩu!');
                $bg = 'bgError';
                break;

            case 'successEditpass': // Nếu tài khoản ko tồn tại
                $icon = 'successEditpass';
                $text = __('Thành công!');
                $class = 'classSuccess';
                $description = __('Thay đổi mật khẩu thành công !');
                $bg = 'bgSuccess';
                break;

            case 'errorEditpass': // Nếu tài khoản ko tồn tại
                $icon = 'errorReset';
                $text = __('Xảy ra lỗi!');
                $class = 'classError';
                $description = __('Xảy ra lỗi trong quá trình thay đổi mật khẩu!');
                $bg = 'bgError';
                break;

            case 'hasPostNews': // Nếu tài khoản ko tồn tại
                $icon = 'successEditpass';
                $text = __('Thành công!');
                $class = 'classSuccess';
                $description = __('Quá trình đăng tin đã hoàn thành. Kiểm tra danh sách tin đăng để xem thông tin chi tiết');
                $bg = 'bgSuccess';
                break;

            case 'notExistPostnews': // Nếu tài khoản ko tồn tại
                $icon = 'errorReset';
                $text = __('Xảy ra lỗi!');
                $class = 'classError';
                $description = __('Không tìm thấy trang tin đăng để chỉnh sửa. Vui lòng kiểm tra lại đường dẫn có hợp lệ');
                $bg = 'bgError';
                break;

            case 'notPrice': // Nếu tài khoản ko tồn tại
                $icon = 'hasLogin';
                $text = __('Cảnh báo!');
                $class = 'classWarning';
                $description = __('Tài khoản của bạn không đủ số xu để xem tin này. Vui lòng nạp xu');
                $bg = 'bgWarning';
                break;

            case 'overVexem': // Nếu tài khoản ko tồn tại
                $icon = 'hasLogin';
                $text = __('Cảnh báo!');
                $class = 'classWarning';
                $description = __('Tin đăng hiện tại đã hết lượt xem.');
                $bg = 'bgWarning';
                break;

            case 'extendTime': // Nếu tài khoản ko tồn tại
                $icon = 'hasLogin';
                $text = __('Cảnh báo!');
                $class = 'classWarning';
                $description = __('Thời gian xem tin đăng này đã hết hiệu lực đối với tài khoản của bạn. Bạn có muốn gia hạn thời gian xem tin ?');
                $isform = 'extendTime';
                $bg = 'bgWarning';
                break;

            case 'notVIP': // Nếu tài khoản ko tồn tại
                $icon = 'hasLogin';
                $text = __('Cảnh báo!');
                $class = 'classWarning';
                $description = __('Tài khoản của bạn chưa nâng cấp gói xem tin theo tháng. Vui lòng nâng cấp gói tin !');
                $bg = 'bgWarning';
                break;

            case 'overVIP': // Nếu tài khoản ko tồn tại
                $icon = 'hasLogin';
                $text = __('Cảnh báo!');
                $class = 'classWarning';
                $description = __('Gói xem tin theo tháng của bạn đã hết hiệu lực sử dụng. Vui lòng gia hạn gói tin để tiếp tục!');
                $bg = 'bgWarning';
                $isform = 'overVIP';
                break;
        }

        $response = array(
            'icon' => $icon,
            'text' => $text,
            'description' => $description,
            'class' => $class,
            'data' => $data,
            'bg' => $bg,
            'isform' => $isform
        );

        return view('desktop.templates.account.inform', $response);
    }


    public static function GetPostById($id_post){
    	$model = self::Get_model('post');
    	return $model->GetItem(['id'=>$id_post]);
    }

	// public static function currentMenu($slug, $name_class='current-active'){
	// 	// $arr_slug = (Request::path()!='') ? explode('/',Request::path()) : null;
	// 	// if ($arr_slug && in_array($slug, $arr_slug)) {
	// 	// 	return $name_class;		//
	// 	// }
	// 	// return '';

	// 	return (Request::segment(count(Request::segments())) == $slug) ? $name_class : '';
	// }

	public static function currentMenu($slug, $name_class='current-active'){
		$arr_slug = (Request::path()!='') ? explode('/',Request::path()) : null;
		if ($arr_slug && in_array($slug, $arr_slug)) {
			return $name_class;
		    //return (Request::segment(count(Request::segments())) == $slug) ? 'current-active' : '';
		}
		return '';
	}

	public static function ActiveCategory($slug, $name_class='current-active-category'){
		return (Request::segment(count(Request::segments())) == $slug) ? 'current-active-category' : '';
	}


	public static function ChangeDate($date){
    	$arr_result = array();
    	$arr_tmp = explode('/',$date);
    	$arr_result[0] = $arr_tmp[1];
    	$arr_result[1] = $arr_tmp[0];
    	$arr_result[2] = $arr_tmp[2];

    	return implode('/',$arr_result);
    }
}

