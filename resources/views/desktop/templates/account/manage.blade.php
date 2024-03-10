@extends('desktop.master')

@section('element_detail','page-manage fix_detail_menu')

@section('banner')
    @include('desktop.layouts.banner')
@endsection


@section('content')
@php
	$validates = ($errors->any()) ? $errors->toArray() : null;
@endphp

<div class="py-16 bg-white bor-none">
	<div class="content-page-layout">
		<form id="manage-form" action="{{ route('account.manage') }}" method="POST" enctype="multipart/form-data" class="relative flex flex-col overflow-hidden bg-white shadow-none md:flex-row md:shadow-shadow3 rounded-3xl">
			@csrf

			<div class="manage-form-left w-full md:w-[465px] bg-[#fafafa] flex items-center justify-center relative">
				@include('desktop.templates.account.sidebarinfo')
			</div>
			<div class="manage-form-right w-full md:w-[calc(100%-465px)] px-7 py-10">
				@if(isset($validates['otp']))<span class="login-form-alert login-form-alert-top">{{$validates['otp'][0]}}</span>@endif
				<div class="mb-5">
					<label for="username" class="text-base font-medium">{{__('Tên tài khoản')}}</label>
					<span class="login-form-alert">{{(isset($validates['username'])) ? $validates['username'][0] : ''}}</span>
					<input id="username" type="text" name="username" placeholder="" value="{{ $user['username'] }}" readonly="" class="w-full py-3 bg-gray-100 border-0 rounded-full cursor-not-allowed placeholder:text-sm placeholder:font-el font-el">					
				</div>
				{{-- <div class="mb-5">
					<label for="email" class="text-base font-medium">Email @if($user['email_new_kichhoat'])<span class="manage-email-verified">(Đã xác minh)</span>@endif</label>
					<span class="login-form-alert">{{(isset($validates['email'])) ? $validates['email'][0] : ''}}</span>
					<input id="email" type="email" name="email" placeholder="" value="{{ (old('email')) ? old('email') : $user['email'] }}" class="w-full py-3 bg-transparent bg-gray-100 border border-gray-200 border-solid rounded-full placeholder:text-sm placeholder:font-el font-el">					
				</div> --}}
				<div class="mb-5">
					<label for="phonenumber" class="text-base font-medium">{{__('Điện thoại')}}</label>
					<span class="login-form-alert">{{(isset($validates['phonenumber'])) ? $validates['phonenumber'][0] : ''}}</span>
					<input id="phonenumber" type="text" name="phonenumber" placeholder="" value="{{ $user['phonenumber'] }}" class="w-full py-3 bg-transparent bg-gray-100 border border-gray-200 border-solid rounded-full placeholder:text-sm placeholder:font-el font-el">					
				</div>
				<div class="mb-5">
					<label for="name" class="text-base font-medium">{{__('Họ tên')}}</label>
					<span class="login-form-alert">{{(isset($validates['name'])) ? $validates['name'][0] : ''}}</span>
					<input id="name" type="text" name="name" placeholder="" value="{{ $user['name'] }}" class="w-full py-3 bg-transparent bg-gray-100 border border-gray-200 border-solid rounded-full placeholder:text-sm placeholder:font-el font-el">					
				</div>
				<div class="mb-5">
					<label for="ngaysinh" class="text-base font-medium">{{__('Ngày sinh')}}</label>
					<span class="login-form-alert">{{(isset($validates['ngaysinh'])) ? $validates['ngaysinh'][0] : ''}}</span>
					<input id="ngaysinh" type="text" name="ngaysinh" placeholder="" class="w-full py-3 bg-transparent bg-gray-100 border border-gray-200 border-solid rounded-full placeholder:text-sm placeholder:font-el font-el" value="{{ date('d/m/Y',$user['ngaysinh']) }}">					
				</div>	
				<div class="mb-5">
					<p class="text-base font-medium">{{__('Giới tính')}}</p>
					<div class="flex mt-2 gap-7">
						<p class="flex items-center">
							<input type="radio" id="sex_nam" name="gioitinh" value="0" {{ ($user['gioitinh']==0) ? 'checked' : '' }}>
							<label for="sex_nam">{{__('Nam')}}</label><br>
						</p>
						<p class="flex items-center">
							<input type="radio" id="sex_nu" name="gioitinh" value="1" {{ ($user['gioitinh']==1) ? 'checked' : '' }}>
							<label for="sex_nu">{{__('Nữ')}}</label><br>
						</p>
						<p class="flex items-center">
							<input type="radio" id="sex_khac" name="gioitinh" value="2" {{ ($user['gioitinh']==2) ? 'checked' : '' }}>
							<label for="sex_khac">{{__('Khác')}}</label><br>
						</p>
					</div>
				</div>						
				{{-- <button type="submit" class="manage-form-submit">Lưu</button> --}}
				<button type="submit" class="flex items-center justify-center w-full py-3 mt-10 text-base font-semibold text-center text-white uppercase transition-all duration-300 border-0 rounded-full cursor-pointer manage-form-submit bg-cmain font-el hover:bg-cmain6">{{__('Lưu')}}</button>
			</div>
			<input type="hidden" name="otp" value="">
		</form>
	</div>

	{{-- <div class="manage-form-otp">
		<div class="manage-contain-otp">
			<span class="manage-close-otp"><i class="fal fa-times"></i></span>
			<p class="manage-title-otp">Nhập mã OTP</p>
			<p class="manage-title-des">Kiểm tra email để nhận mã xác thực !</p>
			<div class="manage-form-list-otp">
				<input type="number" name="maotp[]" class="-otp" value="">
				<input type="number" name="maotp[]" class="-otp" value="">
				<input type="number" name="maotp[]" class="-otp" value="">
				<input type="number" name="maotp[]" class="-otp" value="">
				<input type="number" name="maotp[]" class="-otp" value="">
				<input type="number" name="maotp[]" class="-otp" value="">
			</div>
			<span class="login-form-alert d-none" id="show-alert-otp">Chưa nhập mã xác thực !</span>	
		</div>
	</div> --}}
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
		$('#manage-form').submit(function(){
			$('#loading_order').show();
		});

		// $('.manage-form-submit').click(function(){
		// 	$('#loading_order').show();
		// 	if(!$('#email-loading-gif').hasClass('email-loading-active')){
		// 		//e.preventDefault();
		// 		$('#email-loading-gif').addClass('email-loading-active');				
		// 	}

		// 	//### Kiểm tra  ngân hàng, số tài khoản hoặc số momo ==> gửi otp tới số điện thoại đã đăng ký
		// 	var somomo = $('#somomo').val();
		// 	var nganhang = $('input[name="nganhang"]:checked').val();
		// 	var sotaikhoan = $('#sotaikhoan').val();

		// 	$.ajax({
		// 		url: '{{route('ajax.checkOTP')}}',
		// 		type: "POST",
		// 		dataType: 'json',
		// 		async: true,
		// 		data: {somomo:somomo, nganhang:nganhang, sotaikhoan:sotaikhoan, _token:$('meta[name="csrf-token"]').attr('content')},
		// 		success: function(result_data){
		// 			if(result_data.result==true){
		// 				//console.log(result_data);
		// 				$('#manage-form')[0].submit();
		// 			}else{
		// 				//$('input[name="otp"]').val(result_data.otp);
		// 				$('.manage-form-otp').addClass('manage-form-otp-active');
		// 				var e_num_1 = $('.-otp').eq(0);
		// 				var e_num_2 = $('.-otp').eq(1);
		// 				var e_num_3 = $('.-otp').eq(2);
		// 				var e_num_4 = $('.-otp').eq(3);
		// 				var e_num_5 = $('.-otp').eq(4);
		// 				var e_num_6 = $('.-otp').eq(5);

		// 				e_num_1.val('');
		// 				e_num_2.val('');
		// 				e_num_3.val('');
		// 				e_num_4.val('');
		// 				e_num_5.val('');
		// 				e_num_6.val('');

		// 				e_num_1.focus();
		// 				e_num_1.keyup(function(){
		// 					e_num_2.focus();
		// 				});
		// 				e_num_2.keyup(function(){
		// 					e_num_3.focus();
		// 				});
		// 				e_num_3.keyup(function(){
		// 					e_num_4.focus();
		// 				});
		// 				e_num_4.keyup(function(){
		// 					e_num_5.focus();
		// 				});
		// 				e_num_5.keyup(function(){
		// 					e_num_6.focus();
		// 				});
		// 				e_num_6.keyup(function(){							
		// 					var arr_number_otp = $('input[name="maotp[]"]').map(function(){return $(this).val();}).get();
		// 					arr_number_otp = arr_number_otp.join('');
		// 					$('input[name="otp"]').val(arr_number_otp);
		// 					if(arr_number_otp.length==6){
		// 						$('.manage-close-otp').trigger('click');
		// 						$('#manage-form')[0].submit();
		// 					}else{
		// 						$('#show-alert-otp').removeClass('d-none').addClass('d-block');
		// 					}
		// 					//console.log(arr_number_otp.length);
		// 				});
		// 			}
		// 			$('#loading_order').hide();
		// 		}
		// 	});
		// });


		/*$('#manage-form').submit(function(e){
			if(!$('#email-loading-gif').hasClass('email-loading-active')){
				e.preventDefault();
				$('#email-loading-gif').addClass('email-loading-active');
			}

			//### Kiểm tra  ngân hàng, số tài khoản hoặc số momo ==> gửi otp tới số điện thoại đã đăng ký
			var somomo = $('#somomo').val();
			var nganhang = $('input[name="nganhang"]:checked').val();
			var sotaikhoan = $('#sotaikhoan').val();

			$.ajax({
				url: '{{route('ajax.checkOTP')}}',
				type: "POST",
				dataType: 'json',
				async: true,
				data: {somomo:somomo, nganhang:nganhang, sotaikhoan:sotaikhoan, _token:$('meta[name="csrf-token"]').attr('content')},
				success: function(result_data){
					if(result_data.result==true){
						console.log(result_data);
						//$('#manage-form')[0].submit();
					}else{						
						$('input[name="otp"]').val(result_data.otp);
						$('.manage-form-otp').addClass('manage-form-otp-active');
					}
					e.preventDefault();
				}
			});
		});*/


		// $('.manage-close-otp').click(function(){
		// 	$('input[name="otp"]').val('');
		// 	$('.manage-form-otp').removeClass('manage-form-otp-active');
		// });


		// $('.manage-bank-radio').click(function(){
		// 	$('.manage-form-nganhang-item').removeClass('manage-form-nganhang-item-active');
		// 	$(this).parents('.manage-form-nganhang-item').addClass('manage-form-nganhang-item-active');
		// });

		// $('.manage-bank-radio').each(function(){
		// 	if($(this).is(':checked')) {
		// 	 	$(this).parents('.manage-form-nganhang-item').addClass('manage-form-nganhang-item-active');
		// 	}
			
		// });


		// $('#nganhang').click(function(){
		// 	$('.manage-form-nganhang-contain').slideToggle();
		// });


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