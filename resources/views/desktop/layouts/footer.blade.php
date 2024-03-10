@php
	$mangxahoi = app('mangxahoi');
	$footer = app('footer');
	$chinhsach = app('chinhsach');
	$kienthuc = app('kienthuc');
	$lienket = app('lienket');
@endphp


<div class="relative pt-12 pb-[150px] overflow-hidden bg-cmain bor-none">
	<span class="absolute bottom-0 left-0 w-full"><img src="img/bghoa.png" alt=""></span>
	{{-- <span class="absolute top-0 left-0 z-10 w-full h-full bg-black opacity-90"></span> --}}
	<span class="absolute top-0 left-0 w-full h-full opacity-[0.05] z-1 bg-download bg-fixed bg-no-repeat bg-cover"></span>
	<div class="content-page-layout">
		<div class="flex flex-col flex-wrap justify-between pb-10 md:flex-row lg:pb-8">
			<div class="w-full md:w-[45%]">
				<p class="mb-5 text-4xl font-extrabold text-white capitalize trading limit">Nguyen Duy Import Export</p>
				<div class="flex flex-col text-[15px] text-white gap-y-3">
					<p class="">Address: {{$settingOption['diachi']}} {{$settingOption['tinhthanh']}}</p>
					<p class="">Hotline: {{$settingOption['hotline']}}</p>
					<p class="">Email: {{$settingOption['email']}}</p>
					<p class="">Website: {{$settingOption['website']}}</p>
				</div>
				{{-- <div class="w-full leading-[180%] text-white text-[15px] font-light mt-8">{!! $footer['noidung'.$lang] !!}</div> --}}
				<div class="w-full mt-6 text-left md:mt-8">
					<p class="mb-5 text-xl font-bold text-white uppercase md:text-base">Follow us</p>
					<div class="flex flex-wrap items-center gap-5 mt-5 md:justify-start">
						@foreach($mangxahoi as $k=>$v)
							<a href="{{$v['link']}}"  target="_blank" class="transition-all duration-300 himg hover:-mt-2"><img class="" src="{{UPLOAD_PHOTO.$v['photo']}}" alt="mang-xa-hoi" width="50" height="50"></a>
						@endforeach
					</div>
				</div>
			</div>
			<div class="w-full md:w-[55%] lg:w-[45%] mt-8 md:mt-0">
				<div class="footer-map">{!! $settingOption['toado_iframe'] !!}</div>
			</div>
			<div class="flex flex-wrap items-center w-full gap-3 mt-10">
				<p class="mr-2 text-base font-bold text-white uppercase">Policy:</p>
				@foreach($chinhsach as $k=>$v)
				<a href="{{$v['tenkhongdau'.$lang]}}" class="text-xl text-white transition-all duration-500 sm:text-base opacity-80 hover:opacity-100">{{$v['ten'.$lang]}}</a>
				@endforeach
			</div>
		</div>
		{{-- <div class="flex flex-col justify-between mt-10 md:flex-row lg:mt-12">
			<div class="flex justify-between w-full md:w-[50%]">
				<div class="w-[30%]">
					<p class="mb-5 text-xl font-bold text-white uppercase md:text-base">Menu</p>
					<div class="flex flex-col gap-3">
						<a href="" class="text-xl text-white transition-all duration-500 sm:text-base opacity-80 hover:text-cmain">About us</a>
						<a href="" class="text-xl text-white transition-all duration-500 sm:text-base opacity-80 hover:text-cmain">Our product</a>
						<a href="" class="text-xl text-white transition-all duration-500 sm:text-base opacity-80 hover:text-cmain">Blogs</a>
						<a href="" class="text-xl text-white transition-all duration-500 sm:text-base opacity-80 hover:text-cmain">Contact us</a>
					</div>
				</div>
				<div class="w-[30%]">
					<p class="mb-5 text-xl font-bold text-white uppercase md:text-base">Policy</p>
					<div class="flex flex-col gap-3">
						@foreach($kienthuc as $k=>$v)
						<a href="{{$v['tenkhongdau'.$lang]}}" class="text-xl text-white transition-all duration-500 sm:text-base opacity-80 hover:text-cmain">{{$v['ten'.$lang]}}</a>
						@endforeach
					</div>
				</div>
				@if($chinhsach)
				<div class="w-[30%]">
					<p class="mb-5 text-xl font-bold text-whback-to-top cursor-pointer w-[40px] sm:w-[60px] h-[40px] sm:h-[60px] rounded-none flex items-start justify-center border border-solid border-cmain hover:bg-white group transition-all duration-500 bg-cmainite uppercase md:text-base">Our services</p>
					<div class="flex flex-col gap-3">
						@foreach($chinhsach as $k=>$v)
						<a href="{{$v['tenkhongdau'.$lang]}}" class="text-xl text-white transition-all duration-500 sm:text-base opacity-80 hover:text-cmain">{{$v['ten'.$lang]}}</a>
						@endforeach
					</div>
				</div>
				@endif
			</div>
			<div class="w-full md:w-[29%] mt-10 md:mt-0 text-center md:text-left">
				<p class="mb-5 text-xl font-bold text-white uppercase md:text-base">Follow us</p>
				<div class="flex flex-wrap items-center justify-center gap-5 mt-5 md:justify-start">
					@foreach($mangxahoi as $k=>$v)
						<a href="{{$v['link']}}"  target="_blank" class="transition-all duration-300 himg hover:-mt-2"><img class="" src="{{UPLOAD_PHOTO.$v['photo']}}" alt="mang-xa-hoi" width="50" height="50"></a>
					@endforeach
				</div>
			</div>
		</div> --}}
		<div class="flex items-center justify-between py-8 border-0 border-t border-white border-solid border-opacity-10">
			<div class="w-full text-center text-white">Copyright © 2023 {{$setting['ten'.$lang]}} - All Rights Reserved .</span> <br>Design by <strong>freelancervab@gmail.com</strong></div>
		</div>
	</div>
</div>

{{-- @if($linkout)
<div class="fixed bottom-[60px] right-[1%] flex flex-col z-[9999] gap-[10px]">
	@foreach($linkout as $k=>$v)
		<a href="{{$v['link']}}" class="bg-cmain rounded-full p-[1px] w-[40px] h-[40px] himg" target="_blank"><img src="{{Thumb::Crop(UPLOAD_PHOTO,$v['photo'],50,0,2)}}" alt="" width="40" height="40"></a>
	@endforeach
</div>
@endif --}}


<div class="fixed bg-cmain sm:bg-cmain bottom-0 sm:bottom-16 lg: md:bottom-12 right-0 sm:right-[10px] z-[20] w-auto flex flex-row sm:flex-col items-center justify-between">
	{{-- <div class="flex items-center pl-4 text-base text-white sm:hidden">Copyright © 2023 {{$setting['ten'.$lang]}} - All Rights Reserved .</div> --}}
	<div class="flex flex-row items-center justify-end sm:flex-col">
		{{-- <a href="https://chat.zalo.me/{{str_replace(' ','',$settingOption['zalo'])}}" target="_blank" class="cursor-pointer w-[60px] h-[60px] rounded-none flex items-start justify-center border border-solid border-cmain bg-[#0180C7] group transition-all duration-500 border-r-0 sm:border-b-0"><img src="img/zalo.png" alt=""></a>
		<a href="{{$settingOption['fanpage']}}" target="_blank" class="cursor-pointer w-[60px] h-[60px] rounded-none flex items-center justify-center border border-solid border-cmain hover:bg-cmain2 group transition-all duration-500 border-r-0 sm:border-b-0 bg-[#4A6EAA]"><img src="img/facebook.jpg" alt="" width="40px"></a> --}}
		<div class="back-to-top cursor-pointer w-[40px] sm:w-[60px] h-[40px] sm:h-[60px] rounded-none flex items-start justify-center border border-solid border-white hover:bg-white group transition-all duration-500 bg-cmain"><svg class="mt-4 sm:mt-6 animate-bounce" width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path class="group-hover:stroke-cmain" d="M7.5 17L7.5 1" stroke="white"/><path class="group-hover:stroke-cmain" d="M14 7.3999L7.5 0.999903L1 7.3999" stroke="white"/></svg>
		</div>
	</div>
</div>



<div id="form-tuyendung" class="form-tuyendung-box">
	<div class="form-tuyendung-main">
		<div class="py-[42px] px-5 bg-cmain3 relative">
			<span class="form-tuyendung-close"><i class="text-white fal fa-times"></i></span>
			<p class="text-xl font-bold text-center text-white uppercase md:text-base">{{__('Để lại thông tin mua hàng')}},<br> {{__('chúng tôi sẽ liên hệ lại ngay')}}</p>
		</div>
		<form id="frm_contact" class="p-5 bg-white form-contact frm_check_recaptcha validation-contact content-box-layout" novalidate data-animation="animate__fadeInUp" method="post" action="{{ route('sendContact') }}" enctype="multipart/form-data">
			@csrf
			<div class="h-[50vh] overflow-auto flex flex-col justify-center">
				<input type="hidden" name="type" value="enquiry" />
				<div class="w-full mb-3 input-contact">
					{{-- <span class="block mb-2 label title-contact "><strong class="mr-1 font-normal text-cmain">*</strong>Họ tên</span> --}}
					<label for="ten" class="inp">
						<input type="text" class="form-control" name="ten" id="ten" placeholder="* {{__('Họ và tên')}}" required style="border-radius: 5px;">
						{{-- <span class="focus-bg">Tên của bạn</span> --}}
						<div class="invalid-feedback">{{__('Vui lòng nhập họ tên')}} !</div>
					</label>
				</div>
				<div class="w-full mb-3 input-contact">
					{{-- <span class="block mb-2 label title-contact "><strong class="mr-1 font-normal text-cmain">*</strong>Số điện thoại</span> --}}
					<label for="email" class="inp">
						<input type="text" class="form-control" name="email" id="email" placeholder="* Email" required style="border-radius: 5px;">
						{{-- <span class="focus-bg">Số điện thoại</span> --}}
						<div class="invalid-feedback">{{__('Vui lòng nhập email')}} !</div>
					</label>
				</div>
				<div class="w-full mb-3 input-contact">
					{{-- <span class="block mb-2 label title-contact "><strong class="mr-1 font-normal text-cmain">*</strong>Số điện thoại</span> --}}
					<label for="dienthoai" class="inp">
						<input type="text" class="form-control" name="dienthoai" id="dienthoai" placeholder="* {{__('Số điện thoại')}}" required style="border-radius: 5px;">
						{{-- <span class="focus-bg">Số điện thoại</span> --}}
						<div class="invalid-feedback">{{__('Vui lòng nhập số điện thoại')}} !</div>
					</label>
				</div>
				<div class="w-full mb-3 input-contact">
					{{-- <span class="block mb-2 label title-contact "><strong class="mr-1 font-normal text-cmain">*</strong>Họ tên</span> --}}
					<label for="sanphammuonmua" class="inp">
						<input type="text" class="form-control" name="sanpham" id="sanphammuonmua" placeholder="* {{__('Sản phẩm muốn mua')}}" required style="border-radius: 5px;">
						{{-- <span class="focus-bg">Tên của bạn</span> --}}
						<div class="invalid-feedback">{{__('Vui lòng nhập sản phẩm muốn mua')}} !</div>
					</label>
				</div>
				<div class="w-full mb-3 input-contact">
					{{-- <span class="block mb-2 label title-contact "><strong class="mr-1 font-normal text-cmain">*</strong>Họ tên</span> --}}
					<label for="soluong" class="inp">
						<input type="number" class="form-control" name="soluong" id="soluong" placeholder="* {{__('Số lượng')}}" required style="border-radius: 5px;">
						{{-- <span class="focus-bg">Tên của bạn</span> --}}
						<div class="invalid-feedback">{{__('Vui lòng nhập số lượng')}} !</div>
					</label>
				</div>
				<div class="w-full mb-3 input-contact">
					{{-- <span class="block mb-2 text-sm font-bold label title-contact text-cmain3">{{ __('Lời nhắn') }}</span> --}}
					<label for="noidung" class="h-full inp">
						<textarea class="h-full form-control" id="noidung" rows="3" name="noidung" placeholder="{{__('Ghi chú')}}" style="border-radius: 5px;"></textarea>
						{{-- <span class="focus-bg"></span> --}}
						{{-- <div class="invalid-feedback">{{ __('Vui lòng nhập lời nhắn') }} !</div> --}}
					</label>
				</div>

				{{-- @if($thongtintk)
					<div class="my-4 leading-[140%]">{!! $thongtintk['noidung'.$lang] !!}</div>
				@endif --}}
			</div>

			<div class="mt-5 text-center">
				<button type="submit" class="text-white rounded-md text-xl md:text-base font-demium flex items-center justify-center w-full h-[52px] cursor-pointer m-auto border-0 font-bold bg-cmain3" name="submit-contact">{{__('Gửi')}}</button>
			</div>
		</form>
	</div>
</div>
