@extends('desktop.master')

@section('element_detail','page-manage')

@section('banner')
    @include('desktop.layouts.banner')
@endsection

@section('follow')
    @include('desktop.layouts.follow')
@endsection


@section('content')
@php
    $validates = ($errors->any()) ? $errors->toArray() : null;
@endphp

<div class="pb-14 md:pb-28">
	<div class="content-page-layout">
        <div class="relative flex flex-col -mt-48 overflow-hidden bg-white rounded-none shadow-none md:shadow-shadow1 md:rounded-3xl md:flex-row">           
			<div class="manage-form-left w-full md:w-[465px] bg-cmain2 flex justify-center relative flex-col items-center py-8 md:py-0">
                <div class="flex flex-col items-center">
				    <svg class="opacity-40" xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 24 24"><path fill="#fff" d="M14.666 8.334v3.666l1.463-2.215-1.463-1.451zm-3.092 4.167c.66-.384 1.242-.864 1.758-1.447v1.369c-.445.393-.926.731-1.449 1.018l-.309-.94zm-3.255 2.041c-.652.083-1.57.125-2.319.125v-.97c.688 0 1.551-.037 2.152-.113l.167.958zm2.789-.725l-.036.015c-.586.246-1.22.437-1.91.573l-.167-.958c.655-.131 1.257-.315 1.809-.556l.304.926zm10.892-13.817l-3 11-4.064-3.62 3.9-4.117-5.229 3.614-3.607-.877 12-6zm-3.015 14.779c0 4.546-5.777 9.221-8.221 9.221h-8.764v-22h11.527l-4 2h-5.527v18h5.938c4.155 0 2.638-6 2.638-6 3.349.921 6.003.403 6.003-3.21.28.65.406 1.318.406 1.989z"/></svg>
                    <p class="mt-5 text-center text-white w-[65%] m-auto text-base font-bold opacity-80">{{__('Gửi yêu cầu khiếu nại và chúng tôi sẽ liên hệ trong thời gian sớm nhất')}} !</p>
                </div>
			</div>
			<div class="manage-form-right w-[calc(100%-465px)] px-7 py-14">
				<form id="frm_contact" class="form-contact frm_check_recaptcha validation-contact content-box-layout " novalidate data-animation="animate__fadeInUp" method="post" action="{{ route('sendContact') }}" enctype="multipart/form-data">
                    @csrf        
                    <input type="hidden" name="type" value="khieunai" />   

                    <div class="w-full mb-3 input-contact">        
                        <span class="block mb-2 text-sm font-bold label title-contact text-cmain"><strong class="mr-1 font-normal">*</strong>{{__('Họ tên')}}</span>        
                        <label for="ten" class="inp">        
                            <input type="text" class="form-control" name="ten" id="ten" placeholder="&nbsp;" required>        
                            <span class="focus-bg"></span>        
                            <div class="invalid-feedback">{{__('Vui lòng nhập họ tên')}} !</div>        
                        </label>        
                    </div>
        
                    <div class="flex flex-wrap justify-between">        
                        <div class="input-contact mb-3 w-full md:w-[55%]">        
                            <span class="block mb-2 text-sm font-bold label title-contact text-cmain"><strong class="mr-1 font-normal">*</strong>Email</span>        
                            <label for="email" class="inp">        
                                <input type="email" class="form-control" name="email" id="email" placeholder="&nbsp;" required>        
                                <span class="focus-bg"></span>        
                                <div class="invalid-feedback">{{__('Vui lòng nhập email')}} !</div>        
                            </label>
                        </div>
        
                        <div class="input-contact mb-3 w-full md:w-[calc(45%-24px)] md:ml-6 ml-0">        
                            <span class="block mb-2 text-sm font-bold label title-contact text-cmain"><strong class="mr-1 font-normal">*</strong>{{__('Số điện thoại')}}</span>        
                            <label for="dienthoai" class="inp">        
                                <input type="text" class="form-control" name="dienthoai" id="dienthoai" placeholder="&nbsp;" required>        
                                <span class="focus-bg"></span>        
                                <div class="invalid-feedback">{{__('Vui lòng nhập số điện thoại')}} !</div>        
                            </label>        
                        </div>        
                    </div>
        
                    <div class="w-full">        
                        <span class="block mb-2 text-sm font-bold label title-contact text-cmain">{{__('Lời nhắn')}}</span>        
                        <label for="noidung" class="h-full inp">        
                            <textarea class="h-full form-control" id="noidung" rows="5" name="noidung" placeholder="&nbsp;"></textarea>        
                            <span class="focus-bg"></span>        
                            <div class="invalid-feedback">{{__('Vui lòng nhập lời nhắn')}} !</div>        
                        </label>        
                    </div>
        
                    <div class="mt-5 text-center">
                        <button type="submit" class="bg-cmain2 hover:bg-cmain text-white text-xl md:text-base font-demium rounded-3xl flex items-center justify-center w-[180px] h-[52px] cursor-pointer m-auto border-0 font-bold" name="submit-contact">{{__('Gửi')}}</button>
                    </div>
                </form>
                
            </div>
			
		</div>
	</div>
</div>
@endsection

@push('css_page')
	<link rel="stylesheet" href="{{ asset('css/manage.css') }} ">
@endpush

<!--js thêm cho mỗi trang-->

@push('js_page')	
@endpush


@push('strucdata')


@endpush