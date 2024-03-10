const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

/*([
    'css/animate.min.css',
    'css/all.min.css',
    'plugins/sweetalert2/sweetalert2.min.css',
    'css/jquery.fancybox.min.css',
    'css/fonts.css',
    //'css/style.css',
    //'css/responsive.css',
    //'css/owl.carousel.min.css',
    //'css/owl.theme.default.min.css',
    //'css/cart.css'
], 'css/minify.css');*/

/*mix.scripts([
     'plugins/jquery/jquery.min.js',
     'plugins/sweetalert2/sweetalert2.all.min.js',
     'js/jquery.fancybox.min.js',
     'js/owl.carousel.min.js',
     'js/function.js',
     'js/app.js',
     'js/addon.js'
], 'js/minify.js');*/

mix.postCss("src/tailwind.css", "public/css/app.css", [
  require("tailwindcss"),
]).options({
    processCssUrls: false
});

/*mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
]);*/
