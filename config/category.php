<?php
$config = array();

/* Category */
$nametype = 'product';
$config[$nametype]['relation'] = "product";
$config[$nametype]['menu'] = false;
$config[$nametype]['sitemap'] = true;
$config[$nametype]['title_main'] = "Sản phẩm";
$config[$nametype]['title_main_category'] = "Danh mục sản phẩm";
$config[$nametype]['images_category'] = true;
$config[$nametype]['background_category'] = false;
$config[$nametype]['category_multy'] = true;
$config[$nametype]['show_images_category'] = true;
$config[$nametype]['slug_category'] = true;
$config[$nametype]['check_category'] = array();
$config[$nametype]['mota_category'] = true;
$config[$nametype]['noidung_category'] = false;
$config[$nametype]['seo_category'] = true;
$config[$nametype]['banner'] = false;
$config[$nametype]['bg_color'] = false;
$config[$nametype]['property'] = false;
$config[$nametype]['width_category'] = 500;
$config[$nametype]['height_category'] = 500;
$config[$nametype]['widthbg_category'] = 1440;
$config[$nametype]['heightbg_category'] = 255;
$config[$nametype]['width_banner'] = 300;
$config[$nametype]['height_banner'] = 300;
$config[$nametype]['ratio'] = 1;
$config[$nametype]['amount_images'] = 1;
$config[$nametype]['menu_multiple'] = 0; //: 1 là thiết lập chọn nhiều - 0 là chọn 1
$config[$nametype]['thumb_category'] = '260x320x1';
$config[$nametype]['max_level'] = 2;
$config[$nametype]['img_type_category'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
// $config[$nametype]['gallery'] = array
// (

//     $nametype => array

//     (

//         "title_main_photo" => "Hình ảnh danh mục sản phẩm",

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


/* Post */
$nametype = 'news';
$config[$nametype]['relation'] = "post";
$config[$nametype]['menu'] = false;
$config[$nametype]['sitemap'] = true;
$config[$nametype]['title_main'] = "Tin tức";
$config[$nametype]['title_main_category'] = "Danh mục tin tức";
$config[$nametype]['images_category'] = true;
$config[$nametype]['background_category'] = false;
$config[$nametype]['category_multy'] = true;
$config[$nametype]['show_images_category'] = true;
$config[$nametype]['slug_category'] = true;
$config[$nametype]['check_category'] = array();
$config[$nametype]['mota_category'] = true;
$config[$nametype]['noidung_category'] = false;
$config[$nametype]['seo_category'] = true;
$config[$nametype]['banner'] = false;
$config[$nametype]['bg_color'] = false;
$config[$nametype]['property'] = false;
$config[$nametype]['width_category'] = 500;
$config[$nametype]['height_category'] = 500;
$config[$nametype]['widthbg_category'] = 1440;
$config[$nametype]['heightbg_category'] = 255;
$config[$nametype]['width_banner'] = 300;
$config[$nametype]['height_banner'] = 300;
$config[$nametype]['ratio'] = 1;
$config[$nametype]['amount_images'] = 1;
$config[$nametype]['menu_multiple'] = 0;
$config[$nametype]['thumb_category'] = '260x320x1';
$config[$nametype]['max_level'] = 1;
$config[$nametype]['img_type_category'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';



/* Category */
/*$nametype = 'video';
    $config[$nametype]['relation'] = "video";
    $config[$nametype]['menu'] = false;
    $config[$nametype]['sitemap'] = false;
    $config[$nametype]['title_main'] = "Video";
    $config[$nametype]['title_main_category'] = "Danh mục video";
    $config[$nametype]['images_category'] = true;
    $config[$nametype]['category_multy'] = true;
    $config[$nametype]['show_images_category'] = true;
    $config[$nametype]['slug_category'] = true;
    $config[$nametype]['check_category'] = array();
    $config[$nametype]['mota_category'] = false;
    $config[$nametype]['seo_category'] = true;
    $config[$nametype]['width_category'] = 300;
    $config[$nametype]['height_category'] = 200;
    $config[$nametype]['thumb_category'] = '300x200x1';
    $config[$nametype]['img_type_category'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';*/

return $config;
