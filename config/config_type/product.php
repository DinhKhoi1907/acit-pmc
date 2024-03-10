<?php
	$config = array();

	/* Sản phẩm */
    $nametype = "product";
    $config[$nametype]['com'] = 'san-pham';
    $config[$nametype]['menu'] = true;
    $config[$nametype]['sitemap'] = true;
	$config[$nametype]['title_main'] = "Sản phẩm";
    $config[$nametype]['display'] = true;
    $config[$nametype]['dropdown'] = true;
    $config[$nametype]['brand'] = false;
    $config[$nametype]['title_main_brand'] = "Nhà cung cấp";
    $config[$nametype]['com-brand'] = '';
    $config[$nametype]['mau'] = false;
    $config[$nametype]['size'] = false;
    $config[$nametype]['tags'] = false;
    $config[$nametype]['bst'] = false;
    $config[$nametype]['import'] = false;
    $config[$nametype]['import_price'] = false;
    $config[$nametype]['export'] = false;
    $config[$nametype]['view'] = true;
    $config[$nametype]['copy'] = true;
    $config[$nametype]['copy_image'] = true;
    $config[$nametype]['option'] = false;
    $config[$nametype]['price_option'] = false;
    $config[$nametype]['motangan_option'] = false;
    $config[$nametype]['motangan_option_ck'] = false;
    $config[$nametype]['mota_option'] = false;
    $config[$nametype]['mota_option_ck'] = false;
    $config[$nametype]['noidung_option'] = false;
    $config[$nametype]['noidung_option_ck'] = false;
    $config[$nametype]['seo_option'] = false;
    $config[$nametype]['slug'] = true;
    $config[$nametype]['check'] = array('noibat' => "Nổi bật");
    $config[$nametype]['images'] = true;
    $config[$nametype]['images2'] = false;
    $config[$nametype]['show_images'] = true;
	$config[$nametype]['import_excel'] = false;
	$config[$nametype]['export_excel'] = false;
	$config[$nametype]['watermark'] = false;
    $config[$nametype]['amount_images'] = 1;
    $config[$nametype]['menu_multiple'] = false;
    $config[$nametype]['gallery_option'] = false;
    $config[$nametype]['star'] = false;
    $config[$nametype]['show_video'] = false;
    $config[$nametype]['banner'] = false;
    $config[$nametype]['width_banner'] = 1920;
    $config[$nametype]['height_banner'] = 390;
    $config[$nametype]['gallery'] = array
    (
        $nametype => array
        (
            "title_main_photo" => "Hình ảnh sản phẩm",
            "title_sub_photo" => "Hình ảnh",
            "number_photo" => 3,
            "images_photo" => true,
            "cart_photo" => false,
            "avatar_photo" => true,
            "tieude_photo" => true,
            "width_photo" => 800,
            "height_photo" => 800,
            "thumb_photo" => '800x800x1',
            "img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF'
        )
    );
    $config[$nametype]['ma'] = true;
    $config[$nametype]['giacu'] = false;
    $config[$nametype]['gia'] = true;
    $config[$nametype]['giamoi'] = true;
    $config[$nametype]['giakm'] = true;
    $config[$nametype]['giatext'] = false;
    $config[$nametype]['motangan'] = true;
    $config[$nametype]['motangan_cke'] = true;
    $config[$nametype]['mota'] = true;
    $config[$nametype]['mota_cke'] = false;
    $config[$nametype]['noidung'] = true;
    $config[$nametype]['noidung_cke'] = true;
    $config[$nametype]['thongso'] = false;
    $config[$nametype]['thongso_cke'] = false;
    $config[$nametype]['seo'] = true;
    $config[$nametype]['width'] = 800;
    $config[$nametype]['height'] = 800;
    $config[$nametype]['width2'] = 829;
    $config[$nametype]['height2'] = 570;
	$config[$nametype]['ratio'] = 1;
    $config[$nametype]['img_type'] = '.jpg|.JPG|.png|.PNG';
    // $config[$nametype]['gallery'] = array

    // (

    //     $nametype => array

    //     (

    //         "title_main_photo" => "Hình ảnh sản phẩm",

    //         "title_sub_photo" => "Hình ảnh",

    //         "number_photo" => 3,

    //         "images_photo" => true,

    //         "cart_photo" => false,

    //         "avatar_photo" => true,

    //         "tieude_photo" => true,

    //         "width_photo" => 800,

    //         "height_photo" => 800,

    //         "thumb_photo" => '800x800x1',

    //         "img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF'

    //     )

    // );

    /* Sản phẩm (Màu) */
    // $config[$nametype]['mau_images'] = true;
    // $config[$nametype]['mau_mau'] = true;
    // $config[$nametype]['mau_loai'] = true;
    // $config[$nametype]['width_mau'] = 30;
    // $config[$nametype]['height_mau'] = 30;
    // $config[$nametype]['thumb_mau'] = '30x30x1';
    // $config[$nametype]['img_type_mau'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


    /* Sản phẩm (Hãng) */
    // $config[$nametype]['title_main_brand'] = "Nhà cung cấp";
    // $config[$nametype]['sitemap_brand'] = true;
    // $config[$nametype]['images_brand'] = true;
    // $config[$nametype]['show_images_brand'] = true;
    // $config[$nametype]['slug_brand'] = true;
	// $config[$nametype]['mota_brand'] = false;
	// $config[$nametype]['noidung_brand'] = false;
    // $config[$nametype]['check_brand'] = array("noibat" => "Nổi bật");
    // $config[$nametype]['seo_brand'] = true;
    // $config[$nametype]['width_brand'] = 369;
    // $config[$nametype]['height_brand'] = 108;
    // $config[$nametype]['thumb_brand'] = '506x722x1';
    // $config[$nametype]['width_brand_bg'] = 1440;
    // $config[$nametype]['height_brand_bg'] = 635;
    // $config[$nametype]['img_type_brand'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


	/* Quản lý mục (Không cấp) */
    if($config)
    {
        foreach($config as $key => $value)
        {
            if(!isset($value['dropdown']) || (isset($value['dropdown']) && $value['dropdown'] == false))
            {
                $config['shownews'][$key] = $value;
            }
        }
    }

	//dd($config);

	return $config;
?>
