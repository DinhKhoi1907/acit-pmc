{{-- <p class="relative home-title text-cmain">{{__('Liên hệ')}}<span class="title-thanh border-cmain"></span></p> --}}

<div
    class="content-page-layout flex flex-col lg:flex-row mb-0 lg:rounded-[12px] overflow-hidden rounded-0 flex-wrap bg-cmain3 bor-none p-[42px]">

    <div class="lg:w-[443px] w-full flex flex-col items-start justify-center relative">
        {{-- <span class="absolute top-0 left-0 flex items-center justify-center w-full h-full"><img src="{{ Thumb::Crop(UPLOAD_PHOTO, $photo_static['logo']['photo'], 192, 194, 1) }}" alt=""
            width="96px" height="97px"></span> --}}

        <p class="text-cmain8 text-3xl md:text-[30px] leading-[48px] uppercase text-left font-Gilroy font-bold">
            {{ $row_detail['ten' . $lang] }}</p>


        <div class="mt-4 leading-8 break-words text-cmain2 md:leading-8">
            {!! $row_detail['noidung' . $lang] !!}
        </div>

        <div class="w-full pb-8 mt-5 mb-3 border-0 border-b border-dashed border-cmain2 border-opacity-30">
            <p class="flex items-center mb-5">
                <span class=" text-cmain2 w-[calc(100%-40px-10px)]">Địa chỉ: {{ $settingOption['diachi'] }}{{ $settingOption['tinhthanh'] }}</span>
            </p>
            <p class="flex items-center mb-5">
                <span class=" text-cmain2 w-[calc(100%-40px-10px)]">Số điện thoại: {{ $settingOption['hotline'] }}</span>
            </p>
            @if ($settingOption['email'] != '')
                <p class="flex items-center">
                    <span class=" text-cmain2 w-[calc(100%-40px-10px)]">Email: {{ $settingOption['email'] }}</span>
                </p>
            @endif
        </div>

    </div>
    <div class="w-full lg:w-[calc(100%-443px)] bor-none pl-0 lg:pl-20">
        @if ($settingOption['toado_iframe'] != '')
            <div class="contact-map">{!! $settingOption['toado_iframe'] !!}</div>
        @endif

    </div>
</div>



@if ($settingOption['toado_iframe'] != '')
    {{-- <div class="contact-map">{!! $settingOption['toado_iframe'] !!}</div> --}}
@endif
