@extends('desktop.master')

@section('body','cart_page')

@section('element_detail','product_detail_content cart_page fix_detail_menu')

@section('banner')
    @include('desktop.layouts.banner')
@endsection


@section('content')


@if(isset($row_cart) && count($row_cart)>0)

<div class="py-16 bg-cmain3">
	<div class="pb-3 content-layout">
		<div class="block my-5 text-4xl font-bold text-center capitalize text-cmain md:hidden"><span>{{__('Giỏ hàng')}}</span></div>
		<form class="form-cart validation-cart form-cart-main" novalidate method="post" action="{{route('cart.order')}}" enctype="multipart/form-data">

			@csrf

			<div class="flex p-0 rounded-none md:p-4 wrap-cart align-items-stretch justify-content-between md:rounded-2xl">

				@php
					$coupon_discount = 0;
				@endphp


				{{--TOP CART--}}

				<div class="top-cart">

					<div class="sticky self-start w-full bortop top-3">

						<p class="title-cart">{{__('Sản phẩm đã chọn')}}</p>

						<div class="list-procart">

							{{--

							<div class="flex procart procart-label align-items-start justify-content-between">

								<div class="pic-procart">{{__('Hình ảnh')}}</div>

								<div class="info-procart">{{__('Tên sản phẩm')}}</div>

								<div class="quantity-procart">

									<p>{{__('Số lượng')}}</p>

									<p>{{__('Thành tiền')}}</p>

								</div>

								<div class="price-procart">{{__('Thành tiền')}}</div>

							</div>--}}



							@foreach($row_cart as $k=>$v)

								@php

									$pid = $v['id_product'];

									$quantity = $v['soluong'];

									$mau = ($v['mau'])?$v['mau']:0;

									$size = ($v['size'])?$v['size']:0;

									$code = ($v['code'])?$v['code']:'';

									$proinfo = CartHelper::get_product_info($pid,$size,$mau);

									$pro_price = $proinfo['gia'];

									$pro_price_new = $proinfo['giamoi'];

									$pro_price_qty = $pro_price*$quantity;

									$pro_price_new_qty = $pro_price_new*$quantity;

									$isCOD = ($proinfo['COD']) ? true : false; 

								@endphp



								<div class="procart procart_item procart-{{$code}}">
									<div class="flex align-items-start justify-content-between">
										<div class="pic-procart">

											<a class="text-decoration-none" href="{{$proinfo['tenkhongdauvi']}}" target="_blank" title="{{$proinfo['ten'.$lang]}}">

												<img src="{{ (isset($proinfo['photo']))?Thumb::Crop(UPLOAD_PRODUCT,$proinfo['photo'],300,0,1,$proinfo['type']):'' }}" alt="{{$proinfo['tenkhongdau'.$lang]}}" onerror=src="{{Thumb::Crop('img/','noimage.png',300,0,1)}}" />

											</a>

										</div>

										<div class="info-procart">

											{{-- <p class="cart-warning-product text-danger cart-warning-{{$code}} d-none">({{__('Sản phẩm này vừa mới hết hàng')}})</p> --}}

											<h3 class="name-procart"><a class="text-decoration-none" href="{{$proinfo['tenkhongdauvi']}}" target="_blank" title="{{$proinfo['ten'.$lang]}}">{{$proinfo['ten'.$lang]}}</a></h3>

											<div class="properties-procart">

												@if($mau)

													@php

														$maudetail=CartHelper::get_mau_info($mau);

													@endphp

													<p>{{__('Màu')}}: <strong>{{$maudetail['ten'.$lang]}}</strong></p>

												@endif



												@if($size)

													@php

														$sizedetail=CartHelper::get_size_info($size);

													@endphp

													<p>{{__('Phân loại')}}: <strong>{{$sizedetail['ten'.$lang]}}</strong></p>

												@endif

											</div>

											<a class="del-procart text-decoration-none" data-code="{{$code}}">

												<i class="fal fa-times"></i>

											</a>



											<div class="mt-1 quantity-procart">

												<div class="price-procart price-procart-rp">

													@if($proinfo['gia'] > 0)

														<p class="price-new-cart load-price-new-{{$code}}">
															@if($proinfo['giamoi'] > 0)
																{!!Helper::Format_Money($pro_price_new_qty)!!}
															@else
																{!!Helper::Format_Money($pro_price_qty)!!}
															@endif
														</p>
														

														<p class="price-old-cart load-price-{{$code}}">

															@if($proinfo['giamoi']<$proinfo['gia'] && $proinfo['giamoi']>0)

																{!!Helper::Format_Money($pro_price_qty)!!}

															@endif

														</p>														
													@else

														<p class="price-new-cart load-price-{{$code}}">

															{!!Helper::Format_Money($pro_price_qty)!!}

														</p>

													@endif

													{{-- <div class="flex items-center justify-end mt-1 text-xs" style="color:#999">
														<svg width="12" height="12" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ccc" fill-rule="evenodd" clip-rule="evenodd"><path d="M12.628 21.412l5.969-5.97 1.458 3.71-12.34 4.848-4.808-12.238 9.721 9.65zm-1.276-21.412h-9.352v9.453l10.625 10.547 9.375-9.375-10.648-10.625zm4.025 9.476c-.415-.415-.865-.617-1.378-.617-.578 0-1.227.241-2.171.804-.682.41-1.118.584-1.456.584-.361 0-1.083-.408-.961-1.218.052-.345.25-.697.572-1.02.652-.651 1.544-.848 2.276-.106l.744-.744c-.476-.476-1.096-.792-1.761-.792-.566 0-1.125.227-1.663.677l-.626-.627-.698.699.653.652c-.569.826-.842 2.021.076 2.938 1.011 1.011 2.188.541 3.413-.232.6-.379 1.083-.563 1.475-.563.589 0 1.18.498 1.078 1.258-.052.386-.26.763-.621 1.122-.451.451-.904.679-1.347.679-.418 0-.747-.192-1.049-.462l-.739.739c.463.458 1.082.753 1.735.753.544 0 1.087-.201 1.612-.597l.54.538.697-.697-.52-.521c.743-.896 1.157-2.209.119-3.247zm-9.678-7.476c.938 0 1.699.761 1.699 1.699 0 .938-.761 1.699-1.699 1.699-.938 0-1.699-.761-1.699-1.699 0-.938.761-1.699 1.699-1.699z"></path></svg>
														<p class="price-km-cart load-km-{{$code}}"> - 100.000</p>
													</div> --}}

												</div>

												<div class="quantity-counter-procart quantity-counter-procart-{{$code}} flex align-items-stretch justify-content-between">

													<span class="counter-procart-minus counter-procart">-</span>

													<input type="number" class="quantity-procat" min="1" value="{{$quantity}}" data-pid="{{$pid}}" data-code="{{$code}}"/>

													<span class="counter-procart-plus counter-procart">+</span>

												</div>

												<div class="pic-procart pic-procart-rp">

													<a class="text-decoration-none" href="{{$proinfo['tenkhongdauvi']}}" target="_blank" title="{{$proinfo['ten'.$lang]}}">

														<img src="{{ (isset($proinfo['photo']))?Thumb::Crop(UPLOAD_PRODUCT,$proinfo['photo'],300,0,1,$proinfo['type']):'' }}" alt="{{$proinfo['tenkhongdau'.$lang]}}" onerror=src="{{Thumb::Crop('img/','noimage.png',300,0,1)}}" />

													</a>

													<a class="del-procart text-decoration-none" data-code="{{$code}}">

														<i class="fa fa-times-circle"></i>

														<span>{{__('Xóa')}}</span>

													</a>

												</div>

											</div>

										</div>

										

										<div class="hidden price-procart md:block">

											@if($proinfo['giamoi'] > 0 )

												<p class="price-new-cart load-price-new-{{$code}}">

													{!!Helper::Format_Money($pro_price_new_qty)!!}

												</p>

												

												<p class="price-old-cart load-price-{{$code}}">

													@if($proinfo['giamoi']<$proinfo['gia'] && $proinfo['giamoi']>0)

														{!!Helper::Format_Money($pro_price_qty)!!}

													@endif

												</p>										

											@else

												<p class="price-new-cart load-price-{{$code}}">

													{!!Helper::Format_Money($pro_price_qty)!!}

												</p>

											@endif

											{{-- <div class="flex items-center justify-end mt-1 text-xs" style="color:#999">
												<svg width="12" height="12" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ccc" fill-rule="evenodd" clip-rule="evenodd"><path d="M12.628 21.412l5.969-5.97 1.458 3.71-12.34 4.848-4.808-12.238 9.721 9.65zm-1.276-21.412h-9.352v9.453l10.625 10.547 9.375-9.375-10.648-10.625zm4.025 9.476c-.415-.415-.865-.617-1.378-.617-.578 0-1.227.241-2.171.804-.682.41-1.118.584-1.456.584-.361 0-1.083-.408-.961-1.218.052-.345.25-.697.572-1.02.652-.651 1.544-.848 2.276-.106l.744-.744c-.476-.476-1.096-.792-1.761-.792-.566 0-1.125.227-1.663.677l-.626-.627-.698.699.653.652c-.569.826-.842 2.021.076 2.938 1.011 1.011 2.188.541 3.413-.232.6-.379 1.083-.563 1.475-.563.589 0 1.18.498 1.078 1.258-.052.386-.26.763-.621 1.122-.451.451-.904.679-1.347.679-.418 0-.747-.192-1.049-.462l-.739.739c.463.458 1.082.753 1.735.753.544 0 1.087-.201 1.612-.597l.54.538.697-.697-.52-.521c.743-.896 1.157-2.209.119-3.247zm-9.678-7.476c.938 0 1.699.761 1.699 1.699 0 .938-.761 1.699-1.699 1.699-.938 0-1.699-.761-1.699-1.699 0-.938.761-1.699 1.699-1.699z"></path></svg>
												<p class="price-km-cart load-km-{{$code}}"> - 100.000</p>
											</div> --}}

										</div>
									</div>
									
									{{-- @if(!$isCOD)
										<p class="ml-2 text-xs text-left text-red-600 md:text-right">({{__('Sản phẩm này hiện tại không hỗ trợ COD')}})</p>
									@endif --}}
								</div>

							@endforeach

						</div>

					</div>

				</div>

				{{--END TOP CART--}}



				{{--BOTTOM CART--}}

				<div class="bottom-cart">

					<div class="section-cart">

						<div class="mb-4 bortop">

							<div class="p-relative">

								<p class="title-cart">{{__('Thông tin khách hàng')}}</p>

								{{-- @if($id_login>0)

								<button type="button" class="btn btn-sm btn-light text-muted" data-fancybox data-type="ajax" data-src="address/select-default" style="position: absolute; right: 0; top: -8px;"><i class="fal fa-map-marker-edit"></i> {{__('Sửa')}}</button>

								@endif --}}

							</div>



							{{-- @if($id_login>0)

							<div class="js-ouput-address-delivery">

								<div class="default_address">

									@php

										$check_address = 0;

									@endphp



									@forelse($user_address as $key => $value)

										@if($value['is_default'] == 1)

											@php

												$check_address = 1;

												$id_district_ship = $value['id_district'];

											@endphp

											<div class="mb-3 rounded address-items bg-light">

												<h6 class="flex p-2 m-0 text-white rounded justify-content-between align-items-center bg-secondary">

													<div class="flex align-content-center">

														<i class="mr-1 fal fa-home"></i>

														<span>{{$value['tenvi']}}</span>

													</div>

												</h6>

												<div class="p-2" id="show_address_type">

													<span class="d-block">{{__('Họ tên người nhận')}}: {{$value['hoten']}}</span>

													<span class="d-block">{{__('Số điện thoại')}}: {{$value['dienthoai']}}</span>

													<span class="d-block">{{__('Địa chỉ')}}: {{$value['address']}}, {{Helper::getFullPlace("item", $value['id_ward'])}}, {{Helper::getFullPlace("cat", $value['id_district'])}}, {{Helper::getFullPlace("list", $value['id_city'])}}</span>

												</div>

												<input type="hidden" name="id_address_delivery" id="id_address_delivery" value="{{$value['id']}}" required>

												<input type="hidden" name="dienthoai" class="dienthoai" id="dienthoai" value="{{$value['dienthoai']}}" required>

											</div>

											@php

												break;

											@endphp

										@endif

									@empty

										<p>{{khongcodulieu}}</p>

									@endforelse



									@if($check_address == 0)

										<div class="alert alert-danger">

											<div class="mb-2 text-center">{{__('Bạn chưa có địa chỉ giao hàng ?')}}</div>

											<div class="flex justify-content-center">

												<button type="button" class="btn btn-sm btn-dark" data-fancybox data-type="ajax" data-src="address/show"><i class="fal fa-map-marker-plus"></i> {{__('Thêm mới địa chỉ')}}</button>

											</div>

										</div>

									@endif

									

								</div>

								@if($id_login == 0)

									<div class="info_nhanhang">

										<span class="d-block dc-mg">{{__('Địa chỉ')}}: {{$settingOption['diachi']}}</span>

										<div class="input-double-cart w-clear">

											<div class="input-cart">

												<input type="text" class="form-control ten" id="ten" name="ten" placeholder="{{__('Họ tên')}}" value="" />

												<div class="invalid-feedback">{{__('Vui lòng nhập họ tên')}}</div>

											</div>

											<div class="input-cart">

												<input type="number" class="form-control dienthoai1" id="dienthoai1" name="dienthoai1" placeholder="{{__('Số điện thoại')}}" value="" />

												<div class="invalid-feedback">{{__('Vui lòng nhập số điện thoại')}}</div>



												<button type="button" class="edit_sdt">{{__('Sửa')}}</button>

												<input type="hidden" name="city" value="1" />

												<input type="hidden" name="district" value="15" />

											</div>

										</div>

									</div>

								@endif

							</div>



							@else --}}



							<div class="information-cart">

								<div class="input-double-cart w-clear">

									<div class="input-cart">

										<input type="text" class="form-control" id="ten" name="ten" placeholder="{{__('Họ tên')}}" value="{{(isset($user) ? $user['name'] : '')}}" required />

										<div class="invalid-feedback">{{__('Vui lòng nhập họ tên')}}</div>

									</div>

									<div class="input-cart">

										<input type="text" class="form-control" class="dienthoai" name="dienthoai" id="dienthoai" placeholder="{{__('Số điện thoại')}}" value="{{(isset($user) ? $user['phonenumber'] : '')}}" required />

										<div class="invalid-feedback">{{__('Vui lòng nhập số điện thoại')}}</div>

									</div>

								</div>

								<div class="input-cart">

									<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{(isset($user) ? $user['email'] : '')}}" />

									<div class="invalid-feedback">{{__('Vui lòng nhập email')}}</div>

								</div>    			            

							</div>

							{{-- @endif --}}



							<div class="input-cart">

								<textarea class="form-control" id="yeucaukhac" name="yeucaukhac" placeholder="{{__('Yêu cầu khác')}}" value="" /></textarea>

							</div>

						</div>





						<div class="mb-4 bortop">

							<div class="p-relative">

								<p class="title-cart">{{__('Thông tin địa chỉ')}}</p>

							</div>

							<div class="information-cart">

								<div class="default_address">

									<div class="input-triple-cart w-clear">

										@if(config('delivery.active')==true)

										<div class="mb-2 input-cart" style="width:100%">

											@php

												$transpost_method = config('delivery.transpost_method');

											@endphp

											<select class="custom-select delivery-select" name="method_delivery" required>

												<option value="">-- {{__('Chọn phương thức vận chuyển')}} --</option>

												@if($transpost_method)

													@foreach($transpost_method as $k=>$v)

													<option value="{{$k}}">{{$v['name']}}</option>

													@endforeach

												@endif

											</select>

											<div class="invalid-feedback">{{__('Vui lòng chọn phương thức vận chuyển')}}</div>  

										</div>

										@endif

										<div class="relative input-cart">

											<p class="px-2 py-1 cursor-pointer form-control select-delivery select-delivery-choose select-delivery-choose-city" data-box="city">{{__('Tỉnh/thành phố')}}</p>

											<input type="text" class="absolute opacity-0 form-control select-delivery select-city-delivery" placeholder="{{__('Tỉnh/thành phố')}}" autocomplete="off" required data-box="city" name="city" style="z-index:-1" />

										

										{{-- <select class="{{(config('delivery.active')==false) ? 'select-city-delivery' : 'select-city-cart'}} custom-select" required id="city" name="city" required>

												<option value="">{{tinhthanh}}</option>

												@if(config('delivery.active')==false)

													@forelse ($city as $key => $v)

														<option value="{{$v['id']}}">{{$v['ten']}}</option>

													@empty

													@endforelse

												@endif

											</select>  	
										--}}
											
											<div class="invalid-feedback">{{__('Vui lòng chọn tỉnh/thành phố')}}</div> 
											<span style="position:absolute;top:10px;right:10px;"><i class="fal fa-angle-down"></i></span>

										</div>

										<div class="relative input-cart">

										{{-- <select class="{{(config('delivery.active')==true) ? 'select-district-delivery' : 'select-district-cart'}} select-district custom-select" required id="district" name="district" required>

												<option value="">{{__('Quận/huyện')}}</option>

											</select>--}}

											<p class="px-2 py-1 cursor-pointer form-control select-delivery select-delivery-choose select-delivery-choose-district" data-box="district">{{__('Quận/huyện')}}</p>

											<input type="text" class="absolute opacity-0 form-control select-delivery select-district-delivery" placeholder="{{__('Quận/huyện')}}" autocomplete="off" required data-box="district" name="district" style="z-index:-1" /> 

											<div class="invalid-feedback">{{__('Vui lòng chọn quận/huyện')}}</div>
											<span style="position:absolute;top:10px;right:10px;"><i class="fal fa-angle-down"></i></span>

										</div>

										<div class="relative input-cart">											

											{{-- <select class="{{(config('delivery.active')==true) ? 'select-wards-delivery' : 'select-wards-cart'}} select-wards custom-select" required id="wards" name="wards" required>

												<option value="">{{phuongxa}}</option>

											</select>--}}

											

											<p class="px-2 py-1 cursor-pointer form-control select-delivery select-delivery-choose select-delivery-choose-ward" data-box="ward">{{__('Phường/xã')}}</p>

											<input type="text" class="absolute opacity-0 form-control select-delivery select-wards-delivery" placeholder="{{__('Phường/xã')}}" autocomplete="off" required name="wards" style="z-index:-1"> 

											<div class="invalid-feedback">{{__('Vui lòng chọn phường/xã')}}</div>
											<span style="position:absolute;top:10px;right:10px;"><i class="fal fa-angle-down"></i></span>

										</div>

									</div>

									<div class="input-cart">

										<input type="text" class="form-control" id="diachi" name="diachi" placeholder="{{__('Địa chỉ')}}" value="" required data-box="ward" />

										<div class="invalid-feedback">{{__('Vui lòng nhập địa chỉ')}}</div>

									</div>



									<div class="mb-2 delivery-service-price" id="delivery-service-price"></div>



									{{--<div class="line-or"><span>{{hoac}}</span></div>--}}

								</div>

								{{--<div class="clearfix box_nhantaishop">

									<input type="checkbox" name="nhanhangtaishop" id="nhanhangtaishop">

									<label for="nhanhangtaishop">{{nhanhangtaishop}}</label>

								</div>--}}

								{{-- <div class="info_nhanhang">

									<span class="d-block dc-mg">{{$settingOption['diachi'.$lang]}}</span>

								</div> --}}

							</div>

						</div>





						@if(config('config_all.coupon.active')==true)

							<div class="bortop">

								<p class="title-cart">{{__('Mã giảm giá')}}</p>

								{{-- @if($vouchers)
									<div class="p-2 mb-3 rounded-md info-cart-voucher bg-cmain3">										
										<div class="flex gap-5">
											@foreach($vouchers as $k=>$v)
												<div class="flex items-center gap-1 p-1 cursor-pointer cart-voucher-item" data-value="{{$v['ma']}}">
													<div class="cart-voucher-img"><i class="fal fa-gift-card"></i></div>
													<div class="cart-voucher-content">
														<p class="cart-voucher-code">{{$v['ma']}}</p>
														<div class="cart-voucher-info">{{$v['noidungvi']}}</div>
													</div>
												</div>
											@endforeach
										</div>
									</div>
								@endif --}}
								
								{{-- @if($vouchers)
									<div class="mb-3 info-cart-voucher">
										<div class="info-cart-voucher-flex voucher__owl owl-carousel owl-theme">
											@foreach($vouchers as $k=>$v)
												<div class="cart-voucher-item" data-value="{{$v['ma']}}">
													<div class="cart-voucher-img"><i class="fal fa-gift-card"></i></div>
													<div class="cart-voucher-content">
														<p class="cart-voucher-code">{{$v['ma']}}</p>
														<div class="cart-voucher-info">{{$v['noidungvi']}}</div>
													</div>
												</div>
											@endforeach
										</div>
									</div>
								@endif --}}

								<div class="information-cart">

									<div class="input-cart voucher-input">

										<span class="voucher-icon"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="#ccc" fill-rule="evenodd" clip-rule="evenodd"><path d="M12.628 21.412l5.969-5.97 1.458 3.71-12.34 4.848-4.808-12.238 9.721 9.65zm-1.276-21.412h-9.352v9.453l10.625 10.547 9.375-9.375-10.648-10.625zm4.025 9.476c-.415-.415-.865-.617-1.378-.617-.578 0-1.227.241-2.171.804-.682.41-1.118.584-1.456.584-.361 0-1.083-.408-.961-1.218.052-.345.25-.697.572-1.02.652-.651 1.544-.848 2.276-.106l.744-.744c-.476-.476-1.096-.792-1.761-.792-.566 0-1.125.227-1.663.677l-.626-.627-.698.699.653.652c-.569.826-.842 2.021.076 2.938 1.011 1.011 2.188.541 3.413-.232.6-.379 1.083-.563 1.475-.563.589 0 1.18.498 1.078 1.258-.052.386-.26.763-.621 1.122-.451.451-.904.679-1.347.679-.418 0-.747-.192-1.049-.462l-.739.739c.463.458 1.082.753 1.735.753.544 0 1.087-.201 1.612-.597l.54.538.697-.697-.52-.521c.743-.896 1.157-2.209.119-3.247zm-9.678-7.476c.938 0 1.699.761 1.699 1.699 0 .938-.761 1.699-1.699 1.699-.938 0-1.699-.761-1.699-1.699 0-.938.761-1.699 1.699-1.699z"/></svg></span>

										<input type="text" class="form-control" id="voucher" name="voucher" placeholder="Nhập mã giảm giá (nếu có)" value="">

										<span id="voucher-check-btn">{{__('Áp dụng')}}</span>	    			                

									</div>

									<div id="voucher-content" class="mb-2 d-none"></div>

								</div>

							</div>

						@endif





						<div class="bortop">

							<p class="title-cart">{{__('Hình thức thanh toán')}}</p>

							<div class="information-cart">
								{{-- @if(!$isDebit)
									<div class="relative payments-cart custom-control custom-radio">
										<input type="radio" class="custom-control-input -z-10 payment_radio" id="payments-COD" name="option_payment"
											value="COD" required>
										<label class="payments-label custom-control-label before:!left-1"
											for="payments-COD"
											data-payments="COD">
											{{__('Thanh toán khi nhận hàng COD')}}
										</label>
									</div>
									@if (config('payment.momo')['active'] == true)
										<div class="relative payments-cart custom-control custom-radio">
											<input type="radio" class="custom-control-input -z-10 payment_radio" id="payments-momo" name="option_payment"
												value="momo" required>
											<label class="payments-label custom-control-label before:!left-1"
												for="payments-momo"
												data-payments="momo">
												{{__('Thanh toán online qua cổng Momo')}}
											</label>
										</div>
									@endif
								@endif --}}
								
								{{-- @if (config('payment.alepay')['active'] == true)
									@if(!$isDebit)
										<div class="payments-cart custom-control custom-radio">
											<input type="radio" class="custom-control-input -z-10 payment_radio" id="payments-alepay" name="option_payment"
												value="alepay" required>
											<label class="payments-label custom-control-label before:!left-1"
												for="payments-alepay"
												data-payments="alepay">
												{{__('Thanh toán online qua cổng Alepay')}}
											</label>
										</div>
									@endif

									<div class="payments-cart custom-control custom-radio">
										<input type="radio" class="custom-control-input -z-10 payment_radio" id="payments-alepay-domestic" name="option_payment"
											value="alepay-domestic" required>
										<label class="payments-label custom-control-label before:!left-1"
											for="payments-alepay-domestic"
											data-payments="alepay-domestic">
											{{__('Thanh toán trả góp bằng tín dụng')}}
										</label>
									</div>
									<input type="hidden" name="isDebit" value="{{$isDebit}}">
								@endif --}}

								{{-- @if(config('payment.nganluong')['active']==true)

									<div class="payments-cart custom-control custom-radio">

										<input type="radio" class="custom-control-input" id="payments-1" name="option_payment" value="COD" required>

										<label class="payments-label custom-control-label" for="payments-1" data-payments="1">

											<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">

												<g fill="none" fill-rule="evenodd">

													<g>

														<g>

															<g>

																<path fill="#242424" fill-rule="nonzero" d="M2.18 0c.875 0 1.585.71 1.585 1.585l-.001.297h7.9c1.084 0 1.609.306 2.425 1.34l.147.19 1.61 2.235h14.416c.96 0 1.738.793 1.738 1.772v11.515c0 .979-.778 1.772-1.738 1.772H11.15c-.96 0-1.737-.793-1.737-1.772l-.001-5.251h-1.38c-.828 0-1.617-.377-2.35-.993-.166-.14-.321-.285-.465-.433l-.25-.271-.06-.07H3.731c-.15.72-.788 1.26-1.551 1.26h-.595C.71 13.176 0 12.466 0 11.591V1.585C0 .71.71 0 1.585 0h.595zm28.016 6.588H12.167l2.975 2.708c.787.716.335 1.666-.674 2.155-.876.425-1.951.438-2.806-.092l-.168-.113-1.142-1.039v8.68c0 .484.387.878.864.878h18.98c.477 0 .863-.394.863-.879V7.466c0-.484-.386-.878-.863-.878zM3.764 10.975H5.37l.172.233.101.122.07.08c.17.19.362.382.573.56.522.438 1.058.713 1.574.764l.17.008h1.381v-2.628h-.626c-1.04 0-1.778-.358-2.219-.979l-.09-.137c-.239-.395-.334-.793-.354-1.185l-.004-.168h.94c0 .29.057.591.224.866.23.382.635.62 1.312.657l.19.005h1.83l1.474 1.344c.533.388 1.327.399 1.97.087.5-.243.608-.47.451-.612l-3.22-2.93.004-1.15v-.265l3.446.002-1.21-1.678c-.734-.963-1.029-1.157-1.865-1.157h-7.9v8.161zM2.18.793h-.595c-.404 0-.737.302-.786.693l-.006.1V11.59c0 .404.302.738.693.787l.1.006h.594c.404 0 .737-.302.786-.693l.006-.1V1.585c0-.404-.302-.737-.693-.786l-.1-.006z" transform="translate(-308 -50) translate(308 56)"/>

																<g fill="#0D5CB6" transform="translate(-308 -50) translate(308 56) translate(16 8.47)">

																	<circle cx="4.706" cy="4.706" r="4.706"/>

																</g>

															</g>

															<g fill="#FFF" fill-rule="nonzero">

																<path d="M2.77 2.67l-1.544-.372c-.23-.055-.39-.234-.39-.434 0-.25.24-.452.536-.452h.965c.215 0 .42.057.591.162.079.047.19.032.258-.026l.298-.252c.092-.077.077-.203-.026-.27-.32-.207-.71-.32-1.121-.32H2.3v-.53C2.3.08 2.207 0 2.09 0h-.418c-.115 0-.209.079-.209.176v.53h-.092c-.8 0-1.442.58-1.366 1.268.054.489.498.885 1.058 1.02l1.475.355c.229.055.39.234.39.434 0 .25-.241.452-.536.452h-.965c-.215 0-.42-.056-.592-.161-.078-.048-.188-.032-.257.025l-.298.252c-.092.077-.077.203.025.27.321.208.711.32 1.122.32h.036v.53c0 .097.094.176.21.176h.418c.115 0 .209-.079.209-.176v-.53h.035c.597 0 1.16-.3 1.352-.776.266-.654-.19-1.319-.918-1.495z" transform="translate(-308 -50) translate(308 56) translate(18.824 10.353)"/>

															</g>

														</g>

													</g>

												</g>

											</svg>



											{{thanhtoankhinhanhangcod}}

										</label>

									</div>



									<div class="payments-cart custom-control custom-radio payments-alepay">

										<input type="radio" class="custom-control-input" id="payments-3" name="option_payment" data-type="VISA" data-element="#bank-element-VISA" value="VISA" required>

										<label class="payments-label custom-control-label credit-type" for="payments-3" data-payments="3">

											<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">

												<g fill="none" fill-rule="evenodd">

													<g>

														<g>

															<g>

																<path fill="#242424" fill-rule="nonzero" d="M21.85 4c1.05 0 1.9.85 1.9 1.9v12.2c0 1.05-.85 1.9-1.9 1.9H1.9C.85 20 0 19.15 0 18.1V5.9C0 4.85.85 4 1.9 4h19.95zm0 1H1.9c-.459 0-.837.343-.893.787L1 5.9v12.2c0 .459.343.837.787.893L1.9 19h19.95c.459 0 .837-.343.893-.787l.007-.113V5.9c0-.459-.343-.837-.787-.893L21.85 5z" transform="translate(-360 -50) translate(360 50) translate(3 7)"/>

																<path fill="#242424" d="M24.786 15c-.303 0-.549-.247-.549-.553 0-.306.246-.447.55-.447h.567c.595 0 1.233-.598 1.233-1.18V2.213c0-.61-.627-1.248-1.233-1.248H7.864c-.588 0-1.214.638-1.214 1.248v.53c0 .305-.098.552-.4.552-.304 0-.55-.247-.55-.553v-.53C5.7.993 6.67 0 7.864 0h17.49c1.21 0 2.196.992 2.196 2.212V12.82c0 1.181-1.006 2.179-2.196 2.179h-.568zM8.38 14H3.32c-.176 0-.32-.223-.32-.5s.144-.5.32-.5h5.06c.176 0 .32.223.32.5s-.144.5-.32.5M5.599 16H3.25C3.112 16 3 15.777 3 15.5s.112-.5.251-.5H5.6c.139 0 .251.223.251.5s-.112.5-.251.5" transform="translate(-360 -50) translate(360 50) translate(3 7)"/>

																<g fill="#0D5CB6">

																	<path d="M2.375 5C1.088 5 0 3.856 0 2.5 0 1.146 1.088 0 2.375 0 3.685 0 4.75 1.122 4.75 2.5 4.75 3.88 3.685 5 2.375 5z" transform="translate(-360 -50) translate(360 50) translate(3 7) translate(11.4 12)"/>

																	<path d="M6.175 5C4.888 5 3.8 3.856 3.8 2.5 3.8 1.146 4.888 0 6.175 0 7.485 0 8.55 1.122 8.55 2.5 8.55 3.88 7.485 5 6.175 5z" opacity=".5" transform="translate(-360 -50) translate(360 50) translate(3 7) translate(11.4 12)"/>

																</g>

															</g>

														</g>

													</g>

												</g>

											</svg>

											{{thanhtoanthequocte}}

											<img src="{{asset('img/credit-type-visa.svg')}}"/>

											<img src="{{asset('img/credit-type-mastercard.svg')}}"/>

											<img src="{{asset('img/credit-type-jcb.svg')}}"/>

										</label>

									</div>



									<div class="payments-cart custom-control custom-radio payments-alepay">

										<input type="radio" class="custom-control-input payment-popup" data-type="ATM_ONLINE" data-element="#bank-element-ATM_ONLINE" id="payments-4" name="option_payment" value="ATM_ONLINE" required>

										<label class="payments-label custom-control-label" for="payments-4" data-payments="4">

											<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">

												<g fill="none" fill-rule="evenodd">

													<g>

														<g>

															<g transform="translate(-256 -50) translate(256 50) translate(2 7)">

																<path fill="#242424" fill-rule="nonzero" d="M25.305 0C26.793 0 28 1.207 28 2.695v12.61C28 16.793 26.793 18 25.305 18H2.695C1.207 18 0 16.793 0 15.305V2.695C0 1.207 1.207 0 2.695 0h22.61zm0 1H2.695c-.887 0-1.615.681-1.689 1.549L1 2.695v12.61c0 .887.681 1.615 1.549 1.689l.146.006h22.61c.887 0 1.615-.681 1.689-1.549l.006-.146V2.695c0-.887-.681-1.615-1.549-1.689L25.305 1z"/>

																<path fill="#000" fill-rule="nonzero" d="M6.146 14.214l.53-1.606h2.286l.53 1.606h1.171L8.458 8H7.205L5 14.214h1.146zm2.553-2.463H6.934l.87-2.653h.03l.865 2.653zm5.255 2.463V8.94h1.856V8h-4.824v.939h1.86v5.275h1.108zm3.617 0v-4.41h.03l1.796 4.41h.758l1.796-4.41h.03v4.41h1V8h-1.284l-1.904 4.742h-.034L17.855 8h-1.287v6.214h1.003z"/>

																<rect width="5" height="3" x="20" y="3" fill="#0D5CB6" rx="1"/>

															</g>

														</g>

													</g>

												</g>

											</svg>



										Thanh toán online bằng thẻ ngân hàng nội địa</label>

										<div class="transition payments-info payments-info-4 d-none">

											<div class="box_bank_alepay">

												<div class="container-fluid">

													<div class="clearfix">

														<div class=" col-xs-12">

															<div class="panel panel-default data-bank">

																<div class="panel-heading">Chọn ngân hàng</div>

																<div class="panel-body">

																	<ul class="list-bank"></ul>

																</div>

															</div>

														</div>

													</div>

												</div>

											</div>

										</div>

									</div>

									
									
									@include('desktop.layouts.bank')
									

								@endif --}}

								@if($hinhthucthanhtoan)

									@foreach($hinhthucthanhtoan as $k=>$v)

									<div class="payments-cart custom-control custom-radio">

										<input type="radio" class="custom-control-input" id="payments-{{$v['id']}}" name="payments" value="{{$v['id']}}" required>

										<label class="payments-label custom-control-label" for="payments-{{$v['id']}}" data-payments="{{$v['id']}}">

											{{$v['ten'.$lang]}}

										</label>	    						

									</div>

									<div class="payments-cart-show" id="payments-cart-show-{{$v['id']}}">{!! $v['noidung'.$lang] !!}</div>

									@endforeach

								@endif

							</div>

						</div>
						
						{{-- <div id="show-list-tragop"></div> --}}


						{{-- <div class="mt-4 bortop">
							<p class="flex items-center title-cart">{{__('Xác minh thanh toán')}} <a href="xac-minh-thanh-toan" target="_blank" class="flex items-center ml-3 text-sm font-normal normal-case">(<i class="mr-1 fal fa-hand-point-right"></i>Xem hướng dẫn)</a></p>
							<div class="relative flex items-center justify-center py-8 mt-6 border border-gray-200 border-dashed rounded-md manage-form-img bg-cmain6">
								<p id="photoUpload-preview" class="relative manage-form-img-preview">
									<img src="img/manage/icon_camera.png" alt="camera">
									<span class="absolute -top-[20px] -left-[10px] text-3xl">+</span>
								</p>
								<label class="module-upload-file css-upload-file" id="photo-zone" for="file-zone" data-preview="photoUpload-preview">
									<input type="file" name="file" id="file-zone" required class="opacity-0">
									<div class="invalid-feedback absolute -top-[26px]">Vui lòng thêm hình ảnh xác minh bên dưới</div>
								</label>
							</div>
						</div> --}}

						<div class="mt-4 bortop">

							<p class="title-cart">{{__('Thành tiền')}}</p>
		
							<div class="mt-0 money-procart">
		
								@if(config('config_all.order.ship')==true)
		
									<div class="flex items-center justify-between font-bold total-procart">
		
										<span>{{__('Tạm tính')}}:</span>
		
										<span class="total-price load-price-temp">{!!Helper::Format_Money(CartHelper::get_order_total($id_login,$token_member_cart))!!}</span>
		
									</div>
		
								@endif
		
		
		
								{{-- <div class="flex items-center justify-between font-bold total-procart">
		
									<span>{{__('Khuyến mãi')}}:</span>
		
									<span class="total-price load-price-coupon">0đ</span>
		
								</div> --}}
		
		
		
								@if(config('config_all.order.ship')==true)
		
									<div class="flex total-procart font-weight-bold align-items-center justify-content-between">
		
										<span>{{__('Phí vận chuyển')}}:</span>
		
										<span class="total-price load-price-ship">0đ</span>
		
									</div>
		
								@endif
		
		
		
								<div class="flex items-center justify-between text-xl font-semibold total-procart">
		
									<span>{{__('Tổng tiền')}}:</span>
		
									<div class="total-price load-price-total fs-20">{!!Helper::Format_Money(CartHelper::get_order_total($id_login,$token_member_cart))!!}</div>
		
								</div>
		
								<input type="hidden" class="coupon-temp" name="coupon-temp" value="{{$coupon_discount}}">
		
								<input type="hidden" class="price-temp" name="price-temp" value="{{CartHelper::get_order_total($id_login,$token_member_cart)}}">
		
								<input type="hidden" class="price-ship" name="price-ship" value="">
		
								<input type="hidden" class="price-total" name="price-total" value="{{CartHelper::get_order_total($id_login,$token_member_cart)}}">
		
								{{-- <input type="hidden" name="bankCode" id="bankCode"> --}}
		
							</div>
		
							<input type="hidden" name="thanhtoan" value="{{__('Thanh toán')}}">
		
							{{--<input type="submit" class="mt-2 btn-payment-cart btn-cart btn btn-danger btn-lg btn-block text-uppercase font-weight-bold" name="btn-thanhtoan" value="{{__('Thanh toán')}}" disabled>--}}
		
							<button class="w-full p-3 mt-2 font-semibold text-center text-white uppercase transition-all duration-300 border-0 rounded-md cursor-pointer bg-cmain6 hover:bg-cmain3 text-md btn-payment-cart btn-cart bg-bgmain">{{__('Thanh toán')}}</button>
		
						</div>

					</div>



						{{-- <div class="clearfix" id="fix_button_thanhtoan">

							<div class="fix_btn_thanhtoan_left"><span>{{__('Tổng tiền')}}: </span><b><span class="total-price load-price-total fs-20">{!!Helper::Format_Money(CartHelper::get_order_total($id_login,$token_member_cart))!!}</span></b></div>



							<div class="fix_btn_thanhtoan_right">

								<input type="hidden" name="thanhtoan" value="{{__('Thanh toán')}}">
								

								<button class="w-full p-3 mt-2 font-semibold text-center text-white uppercase border-0 rounded-md cursor-pointer text-md btn-payment-cart btn-cart bg-bgmain3">{{__('Thanh toán')}}</button>

							</div>

						</div> --}}

					</div>

					{{--### END BOTTOM CART--}}

				</div>

			</div>

		</form>

	</div>
</div>

@else

<div class="pb-3 center-layout">

	<a href="san-pham" class="inline-block bg-white empty-cart text-decoration-none">

		{{-- <i class="fas fa-shopping-cart"></i> --}}
		<svg width="80" height="80"" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M20.71 16.71L18.29 14.29C18.197 14.1963 18.0864 14.1219 17.9646 14.0711C17.8427 14.0203 17.712 13.9942 17.58 13.9942C17.448 13.9942 17.3173 14.0203 17.1954 14.0711C17.0736 14.1219 16.963 14.1963 16.87 14.29L13.29 17.87C13.1973 17.9634 13.124 18.0743 13.0742 18.1961C13.0245 18.3179 12.9992 18.4484 13 18.58V21C13 21.2652 13.1054 21.5196 13.2929 21.7071C13.4804 21.8946 13.7348 22 14 22H16.42C16.5516 22.0008 16.6821 21.9755 16.8039 21.9258C16.9257 21.876 17.0366 21.8027 17.13 21.71L20.71 18.13C20.8037 18.037 20.8781 17.9264 20.9289 17.8046C20.9797 17.6827 21.0058 17.552 21.0058 17.42C21.0058 17.288 20.9797 17.1573 20.9289 17.0354C20.8781 16.9136 20.8037 16.803 20.71 16.71ZM16 20H15V19L17.58 16.42L18.58 17.42L16 20ZM10 20H6C5.73478 20 5.48043 19.8946 5.29289 19.7071C5.10536 19.5196 5 19.2652 5 19V5C5 4.73478 5.10536 4.48043 5.29289 4.29289C5.48043 4.10536 5.73478 4 6 4H11V7C11 7.79565 11.3161 8.55871 11.8787 9.12132C12.4413 9.68393 13.2044 10 14 10H17V11C17 11.2652 17.1054 11.5196 17.2929 11.7071C17.4804 11.8946 17.7348 12 18 12C18.2652 12 18.5196 11.8946 18.7071 11.7071C18.8946 11.5196 19 11.2652 19 11V9C19 9 19 9 19 8.94C18.9896 8.84813 18.9695 8.75763 18.94 8.67V8.58C18.8919 8.47718 18.8278 8.38267 18.75 8.3L12.75 2.3C12.6673 2.22222 12.5728 2.15808 12.47 2.11C12.4402 2.10576 12.4099 2.10576 12.38 2.11L12.06 2H6C5.20435 2 4.44129 2.31607 3.87868 2.87868C3.31607 3.44129 3 4.20435 3 5V19C3 19.7956 3.31607 20.5587 3.87868 21.1213C4.44129 21.6839 5.20435 22 6 22H10C10.2652 22 10.5196 21.8946 10.7071 21.7071C10.8946 21.5196 11 21.2652 11 21C11 20.7348 10.8946 20.4804 10.7071 20.2929C10.5196 20.1054 10.2652 20 10 20ZM13 5.41L15.59 8H14C13.7348 8 13.4804 7.89464 13.2929 7.70711C13.1054 7.51957 13 7.26522 13 7V5.41ZM8 14H14C14.2652 14 14.5196 13.8946 14.7071 13.7071C14.8946 13.5196 15 13.2652 15 13C15 12.7348 14.8946 12.4804 14.7071 12.2929C14.5196 12.1054 14.2652 12 14 12H8C7.73478 12 7.48043 12.1054 7.29289 12.2929C7.10536 12.4804 7 12.7348 7 13C7 13.2652 7.10536 13.5196 7.29289 13.7071C7.48043 13.8946 7.73478 14 8 14ZM8 10H9C9.26522 10 9.51957 9.89464 9.70711 9.70711C9.89464 9.51957 10 9.26522 10 9C10 8.73478 9.89464 8.48043 9.70711 8.29289C9.51957 8.10536 9.26522 8 9 8H8C7.73478 8 7.48043 8.10536 7.29289 8.29289C7.10536 8.48043 7 8.73478 7 9C7 9.26522 7.10536 9.51957 7.29289 9.70711C7.48043 9.89464 7.73478 10 8 10ZM10 16H8C7.73478 16 7.48043 16.1054 7.29289 16.2929C7.10536 16.4804 7 16.7348 7 17C7 17.2652 7.10536 17.5196 7.29289 17.7071C7.48043 17.8946 7.73478 18 8 18H10C10.2652 18 10.5196 17.8946 10.7071 17.7071C10.8946 17.5196 11 17.2652 11 17C11 16.7348 10.8946 16.4804 10.7071 16.2929C10.5196 16.1054 10.2652 16 10 16Z" fill="black"></path> </svg>

		<p>{{__('Chưa có sản phẩm nào được chọn')}}</p>

		<span class="rounded-md">Mua sản phẩm</span>

	</a>

</div>

@endif





<!--///// MODAL LOCATION //////-->

@include('desktop.layouts.location')



@endsection





<!--css thêm cho mỗi trang-->

@push('css_page')



@endpush



<!--js thêm cho mỗi trang-->

@push('js_page')

	<script>

		$('.payments-cart').click(function(){

			var id = $(this).find('input').val();

			$('.payments-cart-show').removeClass('d-block');

			$('#payments-cart-show-'+id).addClass('d-block');

		});



		$('input[name="option_payment"]').click(function(){

			var value = $(this).attr('data-type');

			var element = $(this).attr('data-element');



			if(value){

				$('.bank-online-methods').removeClass('bank-active');

				$('.payment-content').removeClass('payment-content-active');

				$(element).addClass('payment-content-active');



				var first_input = $(element).find('input[name="bankcode"]').eq(0);

				first_input.prop('checked',true);

				first_input.parents('.bank-online-methods').addClass('bank-active');

				

			}

		});





		$('.payment-bank-close').click(function(){

			$('.payment-content').removeClass('payment-content-active');

		});





		$('input[name="bankcode"]').change(function(){

			if($(this).is(':checked')){

				$('.bank-online-methods').removeClass('bank-active');

				$(this).parents('.bank-online-methods').addClass('bank-active');

				console.log($(this).val());

			}

		});



		$('.bank-online-methods').dblclick(function(){

			$('.payment-bank-close').trigger('click');

		});



	</script>





	<script>



		$('.select-delivery').click(function(){

			var type = $('.delivery-select').val();

			var box = $(this).attr('data-box');

			var url = '';

			var id = 0;



			//### set url

			switch(box) {

			  case 'city':

			    url = 'transpost/get-city';		

			    $('.select-delivery-choose-district').text('Quận huyện');		   

			    $('.select-district-delivery').val(''); 

			    $('.select-delivery-choose-ward').text('Phường xã');

			    $('.select-wards-delivery').val(''); 

				$('.location-title').addClass('hidden');

			    break;

			  case 'district':

			    url = 'transpost/get-district';

			    id = $('.select-city-delivery').val();

			    $('.select-delivery-choose-ward').text('Phường xã');

			    $('.select-wards-delivery').val(''); 

				$('.location-title').removeClass('hidden').addClass('flex').attr('data-back','city');

			    break;

			  case 'ward':

			    url = 'transpost/get-ward';

			    id = $('.select-district-delivery').val();	 
				
				$('.location-title').removeClass('hidden').addClass('flex').attr('data-back','district');

			    break;

			}



			$.ajax({

				url:url,

				type: "GET",

				dataType: 'html',

				async: true,

				data: {type:type,id:id},

				success: function(result){

					if(result) {

						$('.location-body').html(result);

						$('.localtion-modal').addClass('location-modal-active');

					}

				}

			});

		});	





		$('body').on('click', '.location-option', function(){

			var id = $(this).attr('data-value');

			var box = $(this).attr('data-box');

			var type = $(this).attr('type');

			var name = $(this).text();

			var url = '';



			//### set url

			switch(box) {

			  case 'city':

			    url = 'transpost/get-district';

			    $('.select-city-delivery').val(id);
				
				$('.location-title').removeClass('hidden').addClass('flex').attr('data-back','city');

			    break;

			  case 'district':

			    url = 'transpost/get-ward';

			    $('.select-district-delivery').val(id);

				$('.location-title').removeClass('hidden').addClass('flex').attr('data-back','district');

			    break;

			  case 'ward':

			    url = 'transpost/get-service-price';

			    $('.select-wards-delivery').val(id);

				$('.location-title').addClass('hidden');

			    break;

			}


			//### response

			if(box=='city' || box=='district'){

				$.ajax({

					url:url,

					type: "GET",

					dataType: 'html',

					async: true,

					data: {type:type, id:id},

					success: function(result){

						if(result) {

							$('.location-body').html(result);

							$('.select-delivery-choose-'+box).text(name);

						}

					}

				});

			}else if(box=='ward'){

				var city = $('.select-city-delivery').val();

				var district = $('.select-district-delivery').val();

				var ward = $('select-wards-delivery').val();


				$('.localtion-modal').removeClass('location-modal-active');

				$('.select-delivery-choose-'+box).text(name);

				// $.ajax({

				// 	url:url,

				// 	type: "GET",

				// 	dataType: 'html',

				// 	async: true,

				// 	data: {type:type, city:city, district:district, ward:ward},

				// 	success: function(result){

				// 		if(result) {

				// 			//$('.delivery-service-price').html(result);

				// 			$('.localtion-modal').removeClass('location-modal-active');

				// 			$('.select-delivery-choose-'+box).text(name);



				// 			// if($(".delivery__owl").exists()) {

				// 			// 	var owl = $('.delivery__owl');



				// 			// 	owl.owlCarousel({

				// 			// 		items: 2,

				// 			// 		autoplay: false,

				// 			// 		loop: false,

				// 			// 		lazyLoad: true,

				// 			// 		//mouseDrag: true,

				// 			// 		autoplayHoverPause:true,

				// 			// 		margin:15,

				// 			// 		nav: false,

				// 			// 		dots: false,

				// 			// 		responsiveClass:true,

				// 			// 	    responsive:{

				// 			// 	        0:{

				// 			// 	            items:1,

				// 			// 	            nav:false

				// 			// 	        },

				// 			// 	        551:{

				// 			// 	            items:2,

				// 			// 	            nav:false

				// 			// 	        }

				// 			// 	    }

				// 			// 	});

				// 			// }

				// 		}

				// 	}

				// });

			}

		});


		$('body').on('click', '.location-title', function(){
			var val_back = $(this).attr('data-back');
			$('.select-delivery-choose-'+val_back).trigger('click');
		});


		/*test*/

		//$('.select-wards-delivery').trigger('change');





		$('body').on('change', 'input[name="option_delivery"]', function(){

			var order_service = $(this).val();

			var type = $(this).attr('data-type');

			var city = $('.select-city-delivery').val();

			var district = $('.select-district-delivery').val();

			var ward = $('.select-wards-delivery').val();

			var ward = $('.select-wards-delivery').val();

			var voucher_code = $('#voucher').val();



			$.ajax({

				url:'transpost/get-info-price',

				type: "GET",

				dataType: 'json',

				data: {type:type, city:city, district:district, ward:ward,order_service:order_service,voucher_code:voucher_code},

				success: function(result){

					if(result) {

						$('.load-price-ship').html(result.phiship_text);

						$('.price-ship').val(result.phiship);

						ShipCart(); //### in function.js

					}

				}

			});

		});


		$('input[name="payments"]').click(function(){
			$('input[name="option_payment"]').prop( "checked", false );
			$('input[name="option_payment"]').prop( "required", false );
		});

		$('input[name="option_payment"]').click(function(){
			$('input[name="payments"]').prop( "checked", false );
			$('input[name="payments"]').prop( "required", false );
		});

		$('.cart-voucher-item').click(function(){
			$('.cart-voucher-item').removeClass('cart-voucher-active');
			$(this).addClass('cart-voucher-active');
			var value = $(this).attr('data-value');

			$('#voucher').val(value);
			$('#voucher-check-btn').trigger('click');
		});


		if($(".voucher__owl").exists()) {

			var owl = $('.voucher__owl');



			owl.owlCarousel({

				items: 2,

				autoplay: false,

				loop: false,

				lazyLoad: true,

				//mouseDrag: true,

				autoplayHoverPause:true,

				margin:15,

				nav: false,

				dots: false,

				responsiveClass:true,

			    responsive:{

			        0:{

			            items:1,

			            nav:false

			        },

			        551:{

			            items:2,

			            nav:false

			        }

			    }

			});

		}


		$('.payment_radio').change(function(){
			var selected_value = $(this).prop("checked", true).val();
			var voucher_code = $('#voucher').val();
			var dienthoai = $('#dienthoai').val();
			let ship = $(".price-ship").val();
			$('#loading_order').show(); 
			$('#show-list-tragop').html('');
			if(selected_value=='alepay-domestic' || selected_value=='COD'){
				$.ajax({
					url:'{{route("ajax.cod")}}',
					type: "POST",
					dataType: 'html',
					data: {selected_value:selected_value, voucher_code:voucher_code, dienthoai:dienthoai,ship:ship, _token:$('meta[name="csrf-token"]').attr('content')},
					success: function(result){
						if(result) {
							$('#show-list-tragop').html(result);
							$('#loading_order').hide();	
							if($(".false-domestic").exists()){
								$('.payment_radio').prop('checked', false);	
								$('.payments-label').removeClass('active');		
							}									
						}else{
							$('#loading_order').hide();	
						}
					}
				});
			}else{
				$('#loading_order').hide();	
			}
		});

		
		$('body').on('click', '.domestic-item', function() {
			$('.domestic-item').removeClass('domestic-bankCode-active');
			$(this).addClass('domestic-bankCode-active');
			console.log('ok');
		});
		$('body').on('change', 'input[name="bankCode"]', function() {
			var value = $(this).val();
			$('.domestic-payment').addClass('absolute hidden opacity-0');
			$('#domestic-payment-'+value).removeClass('absolute hidden opacity-0').addClass('relative block opacity-100');
		});

		$('body').on('click', '.paymentMethod-type', function() {
			$('input[name="paymentMethod"]').prop('checked',false);
			$(this).find('input[name="paymentMethod"]').prop('checked',true);
		});
		
		$(window).on('load', function () {
			var isDebit = $('input[name="isDebit"]').val();
			if(isDebit){
				$('input[name="option_payment"]').eq(0).trigger('click');
			}
		});
	</script>

@endpush





@push('strucdata')

	@include('desktop.layouts.strucdata')

@endpush