<!-- Js Config -->
<script>
	var MIKOTECH = MIKOTECH || {};
	var CONFIG_ALL = @json($config_all);
	var CONFIG_BASE = CONFIG_ALL.config_base;
	var URL_BASE = '{{Helper::GetConfigBase()}}';
	var WEBSITE_NAME = '{{(isset($setting['tenvi']) && $setting['tenvi'] != '') ? $setting['tenvi'] : ''}}';
	var SHIP_CART = CONFIG_ALL.order.ship;
	var GOTOP = '{{asset('img/top.png')}}';
	var LANG = '{{$lang}}';
	var LANG_KEY = {
		'no_keywords': "{{chuanhaptukhoatimkiem}}",
		'delete_product_from_cart': "Bạn muốn xóa khóa học này ?",
		'no_products_in_cart': "Chưa có khóa học nào được chọn",
		'back_to_home': "{{vetrangchu}}",
		'da_them_san_pham_vao_gio_hang': "{{dathemsanphamvaogiohang}}",
		'wards': "{{phuongxa}}",
		'dahieu': "{{dahieu}}",
		'bancochacmuonxoasanphamnay' : "Bạn có chắc muốn xóa khóa học này khỏi danh sách ?",
		'dongy' : "{{dongy}}",
		'huybo' : "{{huybo}}",
		'danhdaudadoc' : "{{danhdaudadoc}}",
		'danhdauchuadoc' : "{{danhdauchuadoc}}",
		'themhinhanhminhhoa' : "{{themhinhanhminhhoa}}"
	};
	var SITE_KEY_GOOGLE = @json(config('recapcha.site_key_google'));

	var SESSIONTOTURIAL = "{{(!empty(session()->get('toturial'))) ? session()->get('toturial') : 0 }}";

</script>


<!--minify-->
{!! Packer::js([
	'/plugins/jquery/jquery.min.js',
	'/plugins/sweetalert2/sweetalert2.all.min.js',
	'/js/jquery.fancybox.min.js',
	'/js/owl.carousel.min.js',
	'/js/function.js',
	'/js/product.js',
	'/js/app.js',
	//'/js/addon.js',
	//'/js/jquery.ripples.min.js',
	'/js/cleave/cleave.min.js',
	'/js/cleave/addons/cleave-phone.vn.js',
	//'/js/wow.min.js',
	'/js/anime.min.js',
	'/js/modernizr-2.7.2.js',
	'/js/arcontactus.js',
	//'/js/jquery.ui.touch-punch.min.js',
	//'/js/jquery-ui.js'
	//'/js/jquery.easeScroll.js',
	'/js/flags.js',
	'/plugins/slick/slick.js'
], 'js/minify.js') !!}


<!-- lazy load -->
<script src="{{ asset('js/lazyload.min.js') }}"></script>
<script>
	var myLazyLoad = new LazyLoad({
		elements_selector: ".lazy"
	});
</script>

<script>
	function GoogleLanguageTranslatorInit() { new google.translate.TranslateElement({pageLanguage: 'vi'}, 'google_language_translator');}
</script>
{{-- <script src="http://translate.google.com/translate_a/element.js"></script> --}}

<script src="https://translate.google.com/translate_a/element.js?cb=GoogleLanguageTranslatorInit"></script>

<!-- recaptcha show-->
<div id="recaptcha_element"></div>

<!-- Js Body -->
{!! $setting['bodyjs'] !!}

<!-- Js Fanpage -->
{!! $setting['fanpagejs'] !!}
