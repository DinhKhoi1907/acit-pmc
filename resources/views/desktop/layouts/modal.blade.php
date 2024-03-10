<!-- Modal cart right-->

<div id="fixmodel_cart" class="fixmodel_cart">

	<div id="fixmodel_cart_site" class="fixmodel_cart_site">

		<button id="fixmodel_cart_site_close" class="fixmodel_cart_site_close">

			<i class="fal fa-times-circle"></i>

			{{--<svg class="icon icon--close" viewBox="0 0 19 19" role="presentation">

				<path d="M9.1923882 8.39339828l7.7781745-7.7781746 1.4142136 1.41421357-7.7781746 7.77817459 7.7781746 7.77817456L16.9705627 19l-7.7781745-7.7781746L1.41421356 19 0 17.5857864l7.7781746-7.77817456L0 2.02943725 1.41421356.61522369 9.1923882 8.39339828z" fill="currentColor" fill-rule="evenodd"></path>

			</svg>--}}

		</button>

		<div class="fixmodel_cart_contain">

			<p class="fixmodel_title">{{__('Sản phẩm đã chọn')}} <span class="fixmodel_number_cart">(<span class="ajax-count-cart">{{app('share_all_cart')}}</span> {{__('')}})</span></p>

			<p class="fixmodel_title_thongbao">{{__('Thông báo')}}</p>

			<div class="fixmodel_cart_view {{(!Login::isLogin()) ? 'flex-col' : ''}} scroll-css"></div>

		</div>

	</div>	

</div>

<a href="javascript:void(0);" id="fix_site_overlay" class="fix_site_overlay"></a>





<!-- Modal cart change-->

<div id="model_change_cart" class="model_change_cart">

	<div id="model_changecart_site" class="model_changecart_site">

		<button id="model_changecart_site_close" class="model_changecart_site_close">

			<svg class="icon icon--close" viewBox="0 0 19 19" role="presentation">

				<path d="M9.1923882 8.39339828l7.7781745-7.7781746 1.4142136 1.41421357-7.7781746 7.77817459 7.7781746 7.77817456L16.9705627 19l-7.7781745-7.7781746L1.41421356 19 0 17.5857864l7.7781746-7.77817456L0 2.02943725 1.41421356.61522369 9.1923882 8.39339828z" fill="currentColor" fill-rule="evenodd"></path>

			</svg>

		</button>

		<div class="model_changecart_contain"></div>

	</div>	

</div>

<a href="javascript:void(0);" id="cartchange_site_overlay" class="cartchange_site_overlay"></a>