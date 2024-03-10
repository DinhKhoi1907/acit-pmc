@extends('desktop.master')

@section('element_detail','page-manage fix_detail_menu')

@section('banner')
    @include('desktop.layouts.banner')
@endsection

{{-- @section('follow')
    @include('desktop.layouts.follow')
@endsection --}}


{{-- @section('danhgia')
    <!--ĐÁNH GIÁ-->
	@include('desktop.layouts.danhgia')
@endsection --}}


@section('content')
	@php
		$validates = ($errors->any()) ? $errors->toArray() : null;
	@endphp

<div class="py-16 bg-white bor-none">
	<div class="content-layout-cart">
		<div class="relative bg-white shadow-none md:shadow-shadow3 rounded-none md:rounded-3xl min-h-[500px] overflow-hidden">
			<div class="p-10 px-5 bg-white md:px-10">
				<div class="mb-8 text-2xl font-bold text-center capitalize md:text-4xl text-cmain">{{__('Thông tin khóa học')}}</div>
				<div>
					@php
						$order_status = config('config_all.order_status');
					@endphp

					@foreach($orders as $k=>$v)
						@php
							$items = $v['has_order_detail_all'];							
						@endphp
						<div class="flex flex-col justify-between px-3 py-2 mb-5 overflow-hidden border-0 border-b border-white border-solid rounded-md bg-gray-50 last:border-0">
							<div class="flex items-center justify-between gap-5 pb-1 mt-1 mb-2 text-sm font-bold border-0 border-b border-white border-solid">
								<p>#{{$v['madonhang']}}</p>
								<span class="text-xs italic font-normal text-gray-500">{{Helper::TimeElapsed($v['ngaytao'])}}</span>
							</div>
							<div class="flex items-center justify-between gap-5">
								<div class="flex items-center gap-5">
									<div class="flex flex-col items-center justify-center p-2 rounded-md w-[70px] h-[70px] bg-cmain3">
										<span class=""><i class="text-3xl fal fa-box-open opacity-70"></i></span>							
									</div>
									@if($items)
									<div class="flex flex-col text-sm">
										<p>- {{$items[0]['ten']}} (x{{$items[0]['soluong']}})</p>
										@if(count($items)>1)<p>- ... {{__('và các sản phẩm khác')}}</p>@endif									
									</div>
									@endif
								</div>
								<div>
									@if($v['status_payments']!=3)
										@if($v['tinhtrang']==1 || $v['tinhtrang']==2 || $v['tinhtrang']==3 || $v['tinhtrang']==4)
											@php
												$percent = (100 / 4) * $v['tinhtrang'];
											@endphp
											<div class="text-right w-[80px]">
												{{-- <p class="mb-1 text-sm font-bold text-cmain">Hoàn thành</p> --}}
												<p class="flex items-center justify-between text-xl font-bold text-cmain6">{{$percent}}%<i class="fal fa-tasks"></i></p>
												<p class="relative w-full h-[4px] bg-gray-300 rounded-md"><span class="absolute top-0 left-0 h-full rounded-md bg-cmain6" style="width:{{$percent}}%"></span></p>
											</div>
										@elseif($v['tinhtrang']==6)
											<div>{{__($order_status[$v['tinhtrang']]['name'])}}</div>
										@else
											<div class="flex flex-col items-end text-base font-semibold text-red-700">{{__($order_status[$v['tinhtrang']]['name'])}}</div> 
										@endif
									@else										
										<div class="flex items-center justify-end mt-3 text-base font-semibold text-red-700">{{__(config('config_all.payment_status')[$v['status_payments']]['name'])}}</div>
									@endif
								</div>
							</div>
							
							<div id="cart-toggle-{{$v['id']}}" class="pt-5 mt-8 overflow-hidden" style="display:none;">
								{{-- @if($v['status_payments']!=3)
									@if($v['tinhtrang']==1 || $v['tinhtrang']==2 || $v['tinhtrang']==3 || $v['tinhtrang']==4)
									<div class="relative flex items-center p-2 border-0 border-t-4 border-solid border-cmain w-[130%]">
										<span class="absolute -left-[25%] h-1 -top-1 bg-cmain7" style="width:{{$percent}}%"></span>
										<div class="w-[calc(100%/4)] relative">
											<span class="inline-flex mt-2 -ml-1 text-xs font-medium text-cmain2 h-[32px] items-start {{($percent>=25) ? 'opacity-100' : 'opacity-30'}}">{{__($order_status[1]['name'])}}</span>
											<span class="w-[18px] md:w-[26px] h-[18px] md:h-[26px] rounded-full bg-white inline-block border-solid border-cmain7 border-[6px] md:border-8 -top-[17px] md:-top-[23px] -left-[3%] absolute {{($percent>=25) ? 'opacity-100' : 'opacity-40'}}"></span>
										</div>
										<div class="w-[calc(100%/4)] relative">
											<span class="inline-flex mt-2 text-xs font-medium -ml-7 text-cmain2 h-[32px] items-start {{($percent>=50) ? 'opacity-100' : 'opacity-30'}}">{{__($order_status[2]['name'])}}</span>
											<span class="w-[18px] md:w-[26px] h-[18px] md:h-[26px] rounded-full bg-white inline-block border-solid border-cmain7 border-[6px] md:border-8 -top-[17px] md:-top-[23px] -left-[3%] absolute {{($percent>=50) ? 'opacity-100' : 'opacity-40'}}"></span>
										</div>
										<div class="w-[calc(100%/4)] relative">
											<span class="inline-flex mt-2 text-xs -ml-8 text-cmain2 w-[80px] text-center font-medium h-[32px] items-start {{($percent>=75) ? 'opacity-100' : 'opacity-30'}}">{{__($order_status[3]['name'])}}</span>
											<span class="w-[18px] md:w-[26px] h-[18px] md:h-[26px] rounded-full bg-white inline-block border-solid border-cmain7 border-[6px] md:border-8 -top-[17px] md:-top-[23px] -left-[3%] absolute {{($percent>=75) ? 'opacity-100' : 'opacity-40'}}"></span>
										</div>
										<div class="w-[calc(100%/4)] relative">
											<span class="inline-flex mt-2 -ml-6 text-xs font-medium text-cmain2 h-[32px] items-start {{($percent>=100) ? 'opacity-100' : 'opacity-30'}}">{{__($order_status[4]['name'])}}</span>
											<span class="w-[18px] md:w-[26px] h-[18px] md:h-[26px] rounded-full bg-white inline-block border-solid border-cmain7 border-[6px] md:border-8 -top-[17px] md:-top-[23px] -left-[3%] absolute {{($percent>=100) ? 'opacity-100' : 'opacity-40'}}"></span>
										</div>
									</div>
									@endif
								@endif --}}

								@if($v['status_payments']!=3)
									<div class="flex items-center justify-end px-1 py-2 mt-3 mb-3 text-base font-semibold text-red-700 border-0 border-t border-solid border-cmain3">{{__(config('config_all.payment_status')[$v['status_payments']]['name'])}}</div>
								@endif

								<div class="">
									<p class="mb-2 text-base font-semibold text-cmain2">{{__('Chi tiết đơn hàng')}}</p>
									@if($items)
										@php
											if(config('config_all.data_demo')){
												//### test duplicate array customer
												$arr_tmp = array();
												for($i=0;$i<5;$i++){
													$arr_tmp = array_merge($items, $arr_tmp);
												}
												$items = $arr_tmp;
											}											
										@endphp
										
										@foreach($items as $item)
										<div class="flex justify-between pl-2 mb-4 text-base">
											<div>
												- {{$item['ten']}} (x{{$item['soluong']}})
												@if($v['tinhtrang']==4)
													@php
														$product = $item['belong_product'];
													@endphp
													{{-- <p class="ml-3 text-xs underline cursor-pointer btn-danhgia-submit" data-idpro="{{$item['id_product']}}" data-imgpro="{{ Thumb::Crop(UPLOAD_PRODUCT,$product['photo'],69,77,2,$product['type']) }}" data-namepro="{{$product['ten'.$lang]}}"><i class="mr-1 text-yellow-400 fas fa-star" style="font-size: 9px;"></i>{{__('Đánh giá sản phẩm')}}</p> --}}
												@endif
											</div>
											<p class="text-base font-semibold text-red-500">{!! ($item['giamoi']>0) ? Helper::Format_Money($item['giamoi']) : Helper::Format_Money($item['gia']) !!} <span></span></p>
										</div>
										@endforeach
									@endif
									@if($v['giamgia']>0)
									<div class="flex justify-end pl-2 mt-2 mb-1">
										<div class="flex items-center text-xs font-semibold text-gray-500">
											<i class="mr-1 fal fa-tag"></i>-{!! Helper::Format_Money($v['giamgia']) !!}											
										</div>
									</div>	
									@endif								
								</div>
							</div>	

							<div class="flex items-center justify-between pt-1 mt-2 text-base font-bold border-0 border-t border-white border-solid text-cmain2">								
								<p class="flex items-center mt-2 text-xs italic cursor-pointer text-cmain2 btn-toggle-order" data-id="#cart-toggle-{{$v['id']}}" data-hide="{{__('Ẩn đi')}}" data-open="{{__('Chi tiết')}}">{{__('Chi tiết')}} <i class="ml-1 fas fa-caret-down"></i></p>
								<div class="flex items-center gap-3 text-cmain">
									<p>{!!Helper::Format_Money($v['tonggia'])!!}</p>
									@if($v['status_payments']==3)
										<div><a href="{{route('cart.orderPayAgain',[$v['id']])}}" class="inline-block px-2 py-2 text-xs text-white rounded-md cursor-pointer bg-cmain2"><i class="fal fa-undo"></i> {{__('Thanh toán lại')}}</a></div>
									@endif
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
        </div>
	</div>
</div>
@endsection

@push('css_page')
	<link rel="stylesheet" href="{{ asset('plugins/jquery-ui-1-13/jquery-ui.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
	<link rel="stylesheet" href="{{ asset('css/manage.css') }} ">
@endpush

<!--js thêm cho mỗi trang-->

@push('js_page')	
	<script src="{{ asset('plugins/jquery-ui-1-13/jquery-ui.min.js') }}"></script>
	<!-- daterangepicker -->
	<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
	<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

	
	<script>
		$('.btn-toggle-order').click(function(){
			var e = $(this).attr('data-id');
			var text_hide = $(this).attr('data-hide');
			var text_open = $(this).attr('data-open');
			//var text = $(this).attr('data-text');
			$(e).toggle();
			
			if(!$(this).hasClass('btn-toggle-order-active')){
				$(this).addClass('btn-toggle-order-active');
				$(this).html(text_hide+' <i class="ml-1 fas fa-caret-up"></i>');
			}else{
				$(this).removeClass('btn-toggle-order-active');
				$(this).html(text_open+' <i class="ml-1 fas fa-caret-down"></i>');
			}
		});


		$('#manage-form').submit(function(){
			$('#loading_order').show();
		});

		$('#ngaysinh').datepicker({
			changeYear: true,
			changeMonth: true,		
			yearRange: '1900:c',
			maxDate: '+10Y',	
			dateFormat: 'dd/mm/yy'
		});

		var cleave = new Cleave('#phonenumber', {
		    phone: true,
		    phoneRegionCode: 'vn'
		});		

		var cleave = new Cleave('#somomo', {
		    phone: true,
		    phoneRegionCode: 'vn'
		});	
	</script>
@endpush


@push('strucdata')


@endpush