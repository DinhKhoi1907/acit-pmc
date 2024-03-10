<div class="flex flex-col p-8 model_changecart_view lg:flex-row">
	{{-- <div class="model_changecart_left">
		<div class="gallery_cart_product owl-carousel owl-theme">
			<a class="thumb-pro-detail gallery-photo-scroll" data-zoom-id="Zoom-1" href="#gallery-photo-main" title="{{$row_detail['ten'.$lang]}}">
				<img src="{{ (isset($row_detail['photo']))?Thumb::Crop(UPLOAD_PRODUCT,$row_detail['photo'],1245,895,1,$row_detail['type']):'' }}" alt="{{$row_detail['ten'.$lang]}}">
			</a>
			@if($hinhanhsp)
				@foreach($hinhanhsp as $k=>$v)
				<a class="thumb-pro-detail gallery-photo-scroll" data-zoom-id="Zoom-1" href="#gallery-photo-{{$v['id']}}" title="{{$v['ten'.$lang]}}">
					<img src="{{ (isset($v['photo']))?Thumb::Crop(UPLOAD_PRODUCT,$v['photo'],1245,895,1,$v['type']):'' }}" alt="{{$v['ten'.$lang]}}">
				</a>
				@endforeach
			@endif
		</div>
	</div> --}}

	<div class="relative w-full lg:w-[55%]">
		<div class="w-full mb-5 product_detail_album himg">
			<a class=" bg-cmain4" href="{{ Thumb::Crop(UPLOAD_PRODUCT,$row_detail['photo'],996,716,1,$row_detail['type']) }}" title="{{$row_detail['ten'.$lang]}}"><img src="{{ Thumb::Crop(UPLOAD_PRODUCT,$row_detail['photo'],996,716,1,$row_detail['type']) }}" alt="{{$row_detail['ten'.$lang]}}"></a>
		</div>
		@if($hinhanhsp)
			@if(count($hinhanhsp) > 0)
			<div class="w-full mb-3 lg:mb-0">
				<div>
					<div class="slick-product">
						<a class="block text-center bg-cmain4 thumb-pro-detail himg" data-zoom-id="Zoom-1" href="{{ Thumb::Crop(UPLOAD_PRODUCT,$row_detail['photo'],1245,895,1,$row_detail['type']) }}" data-image="{{ Thumb::Crop(UPLOAD_PRODUCT,$row_detail['photo'],1245,895,1,$row_detail['type']) }}" title="{{$row_detail['ten'.$lang]}}"><img src="{{ Thumb::Crop(UPLOAD_PRODUCT,$row_detail['photo'],996,716,1,$row_detail['type']) }}" alt="{{$row_detail['ten'.$lang]}}" width="84" height="84"></a>
						@php
							if(config('config_all.data_demo')){
								$arr_tmp = array();
								for($i=0;$i<10;$i++){
									$arr_tmp = array_merge($hinhanhsp, $arr_tmp);
								}
								$hinhanhsp = $arr_tmp;
							}
						@endphp
						
						@foreach($hinhanhsp as $v)
							<a class="block text-center bg-cmain4 thumb-pro-detail himg" data-zoom-id="Zoom-1" data-image="{{ Thumb::Crop(UPLOAD_PRODUCT,$v['photo'],1245,895,1,$v['type']) }}" href="{{ Thumb::Crop(UPLOAD_PRODUCT,$v['photo'],1245,895,1,$v['type']) }}" title="{{$row_detail['ten'.$lang]}}">
								<img src="{{ Thumb::Crop(UPLOAD_PRODUCT,$v['photo'],996,716,1,$v['type']) }}" alt="{{$row_detail['ten'.$lang]}}" class="block" width="84" height="84">
							</a>
						@endforeach
					</div>
				</div>
			</div>
			@endif
		@endif
	</div>

	<div class="w-full lg:w-[45%] pl-0 lg:pl-8 mt-8 lg:mt-0">
		<div class="model_changecart_fix">
			<h2 class="mb-2 text-left">
				<a href="{{$row_detail['tenkhongdau'.$lang]}}" class="mb-3 text-3xl md:text-[30px] font-semibold capitalize text-cmain3">{{$row_detail['ten'.$lang]}}</a>
			</h2>

			<div class="flex items-center justify-between border-0 border-b border-solid border-[rgba(30,30,30,10%)] pb-2 mb-3 ">
				<p class="text-base text-cmain3 opacity-80">{{__('Mã')}}: <span class="">{{$row_detail['masp']}}</span></p>
				{{-- <span class="text-base text-cmain2 font-meidum">{{($row_detail['hethang']) ? __('Hết hàng') : __('Còn hàng')}}</span> --}}
			</div>

			<div class="">
				<div class="flex items-center justify-between">
					<div class="flex flex-wrap items-center align-middle">
						@if($giamoi < $gia && $giamoi>0)
							<p class="text-red-600 font-bold text-2xl md:text-[26px] detail__price--new{{$row_detail['id']}}">{!! ($giamoi<$gia) ? Helper::Format_Money($giamoi) : Helper::Format_Money($gia) !!}</p>
						@endif

						@if($giamoi==0)
							<p class="home-tourhot-olddefine"><span class="text-2xl font-bold detail__price--old{{$row_detail['id']}}">{!! Helper::Format_Money($gia) !!}</span></p>
						@else
							<p class="ml-5 home-tourhot-olddefine"><span class="ml-3 line-through text-cmain3 opacity-70 text-base detail__price--old{{$row_detail['id']}}">{!! Helper::Format_Money($gia) !!}</span></p>
						@endif								
					</div>							
				</div>
			</div>

			@if($row_detail['mota'.$lang]!='')<div class="my-3 leading-5 whitespace-pre-line text-cmain3">{{$row_detail['mota'.$lang]}}</div>@endif

			<div>
				@if($mau!='')
				@php
					$masp_colors = ($row_detail['masp_color']!='') ? json_decode($row_detail['masp_color'],true) : null;
				@endphp

				<div class="detail__properties detail__properties__color">
					<div class="mb-2 detail__properties__name">Màu sắc: <span id="color-current" class="ml-2"></span></div>
					<div class="flex flex-wrap items-center">
						@foreach ($mau as $key => $value)
							@if($value['loaihienthi'] == 1)
								<div class="color-pro-detail {{($key == 0) ? 'active' : ''}} {{($key == 0 && count($mau) > 1) ? 'ColorfirstOption' : ''}}" data-id="{{$row_detail['id']}}" data-masp="{{($masp_colors[$value['id']]) ? $masp_colors[$value['id']] : $row_detail['masp']}}" title="{{$value['ten'.$lang]}}" style="background-image: url({{UPLOAD_COLOR.$value['photo']}})">
									<input class="detail__properties-items js-select-variant" type="radio" value="{{$value['id']}}" name="color-pro-detail" >
								</div>
							@else
								<div class="color-pro-detail {{($key == 0) ? 'active' : ''}} {{($key == 0 && count($mau) > 1) ? 'ColorfirstOption' : ''}}" data-id="{{$row_detail['id']}}" data-masp="{{($masp_colors[$value['id']]) ? $masp_colors[$value['id']] : $row_detail['masp']}}" title="{{$value['ten'.$lang]}}" style="background-color: #{{$value['mau']}}" >
									<input class="detail__properties-items js-select-variant" type="radio" value="{{$value['id']}}" name="color-pro-detail" >
								</div>
							@endif
						@endforeach
					</div>
				</div>
				@endif

				@if($size!='')
					<div class="mt-4 detail__properties detail__properties__size">
						<div class="mb-3 text-base font-medium text-cmain3">{{__('Phân loại')}}:</div>
						<div class="flex flex-wrap items-center" id="product_detail_size">
							@foreach ($size as $key => $value)
								<a class="size-pro-detail text-decoration-none mr-1 {{($key == 0) ? 'active' : ''}} {{($key == 0 && count($size) > 1) ? 'SizefirstOption' : ''}}" data-id="{{$row_detail['id']}}">
									<input type="radio" value="{{$value['id']}}" class="detail__properties-items js-select-variant" name="size-pro-detail" {{($key == 0) ? 'checked' : ''}}>
									{{$value['ten'.$lang]}}
								</a>
							@endforeach
						</div>
					</div>
				@endif
			</div>

			@if($row_detail['hethang']!=1)
				<div class="flex items-center justify-between pb-3 mt-2 mb-2 fixbuy">

					<div class="detail__button__grid w-[150px] {{($is_soluong) ? 'fix_button_cart btn-cart-grid' : 'btn-cart-hidden'}}" id="show_btn_conhang">

						<div class="py-0 detail__properties detail__properties_quantity" id="show_soluong_khung">

							{{-- <div class="mb-2 text-base font-medium text-cmain3">{{__('Số lượng')}}</div> --}}
		
							<div class="flex bg-white quantity">
		
								<button type="button" class="quantity__button quantity__button--minus js-change-quantity" data-action="minus"></button>
		
								<input type="text" id="quantity" value="1">
		
								<button type="button" class="quantity__button quantity__button--plus js-change-quantity" data-action="plus"></button>
		
							</div>
		
						</div>
					</div>	
					<div class="detail__button__grid w-[calc(100%-150px)] pl-3 {{($is_soluong) ? 'fix_button_cart btn-cart-grid' : 'btn-cart-hidden'}}" id="show_btn_conhang">
						<a class="flex items-center justify-center text-base font-bold text-white js-action-cart bg-cmain w-full h-[40px] rounded-[6px] transition-all duration-500 group-hover:bg-white group-hover:text-cmain cursor-pointer border border-solid border-cmain hover:bg-white hover:text-cmain" data-id="{{$row_detail['id']}}" data-action="addnow">Thêm vào giỏ hàng</a>
						{{-- <button type="button" class="flex items-center justify-center w-full h-10 text-xl text-white border-0 cursor-pointer md:text-base js-action-cart bg-cmain2 font-el detail__button" data-id="{{$row_detail['id']}}" data-action="buynow" data-debit="false">
							<span>{{__('Mua ngay')}}</span>
						</button> --}}
					</div>
					
				</div>
			@endif

			{{-- 
			<button type="button" class="mt-4 bg-red-500 d-flex justify-content-center align-items-center detail__button detail__wishlist js-action-cart" data-id="{{$row_detail['id']}}" data-oldcode="{{$code}}" data-action="changenow">
				<span><i class="mr-2 fal fa-shopping-bag"></i> {{ ($code!='') ? 'Cập nhật' : 'Thêm vào giỏ' }}</span>
			</button> --}}
		</div>
	</div>
</div>

<style>
	.slick-product .slick-slide img{display: inline-block !important;width:100%; border-radius: 6px;padding:0 5px;}
</style>

<link rel="stylesheet" href="{{ asset('css/product_detail.css') }}">
{{--<script src="{{ asset('js/product.js') }}"></script>--}}

<link rel="stylesheet" href="{{ asset('plugins/slick/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/slick/slick-theme.css') }}">

<script src="{{ asset('plugins/slick/slick.js') }}" charset="utf-8"></script>
<script>
	$('.slick-product').slick({
		infinite: true,
		slidesToShow: 5,
		slidesToScroll: 1,
		autoplay: true,
		//vertical:true,
		//verticalSwiping:true,
		responsive: [
			{
				breakpoint: 1025,
				settings: {
					slidesToShow: 5,
					slidesToScroll: 1,
					// vertical:true,
					// verticalSwiping:true,
				}
			},
			{
				breakpoint: 640,
				settings: {
					slidesToShow: 5,
					slidesToScroll: 1,
					// vertical:false,
					// verticalSwiping:false,
				}
			},				
			{
				breakpoint: 420,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 1,
					// vertical:false,
					// verticalSwiping:false,
				}
			}
		]
	});
</script>