<?php
$config = array();

/* Logo */
$nametype = "slide";
$config[$nametype]['category'] = "man_photo";
$config[$nametype]['title_main'] = "Slide";
$config[$nametype]['images'] = true;
$config[$nametype]['background'] = false;
$config[$nametype]['avatar'] = true;
$config[$nametype]['link'] = true;
$config[$nametype]['tieude'] = true;
$config[$nametype]['mota'] = true;
$config[$nametype]['width'] = 1920;
$config[$nametype]['height'] = 800;
$config[$nametype]['ratio'] = 1;
$config[$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


/* Logo */
$nametype = "slidemobile";
$config[$nametype]['category'] = "man_photo";
$config[$nametype]['title_main'] = "Slide mobile";
$config[$nametype]['images'] = true;
$config[$nametype]['background'] = false;
$config[$nametype]['avatar'] = true;
$config[$nametype]['link'] = false;
$config[$nametype]['tieude'] = false;
$config[$nametype]['width'] = 1245;
$config[$nametype]['height'] = 1410;
$config[$nametype]['ratio'] = 1;
$config[$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


/* Logo */
$nametype = "logo";
$config[$nametype]['category'] = "photo_static";
$config[$nametype]['title_main'] = "Logo";
$config[$nametype]['images'] = true;
$config[$nametype]['background'] = false;
$config[$nametype]['width'] = 569;
$config[$nametype]['height'] = 512;
$config[$nametype]['ratio'] = 1;
$config[$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

$nametype = "sodotochuc";
$config[$nametype]['category'] = "photo_static";
$config[$nametype]['title_main'] = "Sơ đồ tổ chức";
$config[$nametype]['images'] = true;
$config[$nametype]['background'] = true;
$config[$nametype]['width'] = 1415;
$config[$nametype]['height'] = 725;
$config[$nametype]['ratio'] = 1;
$config[$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


$nametype = "backgroundspnb";
$config[$nametype]['category'] = "photo_static";
$config[$nametype]['title_main'] = "Hình nền sản phẩm nổi bật";
$config[$nametype]['images'] = false;
$config[$nametype]['background'] = true;
$config[$nametype]['width'] = 1415;
$config[$nametype]['height'] = 725;
$config[$nametype]['ratio'] = 1;
$config[$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


$nametype = "backgroundfooter";
$config[$nametype]['category'] = "photo_static";
$config[$nametype]['title_main'] = "Hình nền footer";
$config[$nametype]['images'] = false;
$config[$nametype]['background'] = true;
$config[$nametype]['width'] = 1415;
$config[$nametype]['height'] = 725;
$config[$nametype]['ratio'] = 1;
$config[$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


/* Favicon */
$nametype = "favicon";
$config[$nametype]['category'] = "photo_static";
$config[$nametype]['title_main'] = "Favicon";
$config[$nametype]['images'] = true;
$config[$nametype]['width'] = 50;
$config[$nametype]['height'] = 50;
$config[$nametype]['ratio'] = 2;
$config[$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';


/* mangxahoi */
$nametype = "mangxahoi";
$config[$nametype]['category'] = "man_photo";
$config[$nametype]['title_main'] = "Mạng xã hội";
$config[$nametype]['number'] = 1;
$config[$nametype]['images'] = true;
$config[$nametype]['video'] = false;
$config[$nametype]['avatar'] = true;
$config[$nametype]['link'] = true;
$config[$nametype]['tieude'] = true;
$config[$nametype]['mota'] = false;
$config[$nametype]['width'] = 50;
$config[$nametype]['height'] = 50;
$config[$nametype]['ratio'] = 1;
$config[$nametype]['check'] = array();
$config[$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

return $config;
