@php
    $mangxahoi = app('mangxahoi');
    $lienhe = app('lienhe');
    $footer = app('footer');
    $chinhsach = app('chinhsach');
    $kienthuc = app('kienthuc');
    $lienket = app('lienket');
    $danhmuc_cap1 = app('danhmuc_cap1');
    $dichvu = app('dichvu');
    $backgroundfooter = app('backgroundfooter');
@endphp

<div @if ($backgroundfooter) style="background-image: url({{ Thumb::Crop(UPLOAD_PHOTO, $backgroundfooter[0]['background'], 1920, 1067, 1) }})" @endif
    class="relative pt-12 overflow-hidden bor-none section-footer">
    <div class="content-page-layout z-auto">
        <div class="flex items-center gap-[17px] max-w-[526px]">
            <a href=""> <img src="img/logo-footer.png" alt="" width="64" height="75"></a>
            <p class="text-white text-[18px] font-bold uppercase leading-[20px]">
                {{ isset($lienhe['ten' . $lang]) ? $lienhe['ten' . $lang] : 'ACIT' }}</p>
        </div>
        <div
            class="py-[37px] flex flex-wrap lg:flex-nowrap gap-[50px] lg:gap-[117px] footer-content lg:justify-between items-start">
            <div class="max-w-[526px] info-footer">
                <p class="mb-8">{{ isset($lienhe['noidung' . $lang]) ? $lienhe['noidung' . $lang] : 'ACIT' }}</p>
                <div class="flex flex-col gap-2">
                    <p>Số điện thoại: {{ $settingOption['hotline'] }}</p>
                    <p>Email:{{ $settingOption['email'] }}</p>
                    <p>Địa chỉ: {{ $settingOption['diachi'] }} {{ $settingOption['tinhthanh'] }}</p>
                </div>

            </div>
            <div class="min-w-[211px] flex flex-col gap-5 sanpham-footer">
                <h1>Sản phẩm</h1>
                @foreach ($danhmuc_cap1 as $k => $v)
                    <a href="{{ $v['tenkhongdau' . $lang] }}">
                        <p>{{ $v['ten' . $lang] }}</p>
                    </a>
                @endforeach
            </div>
            <div class="flex flex-col gap-5 dichvu-footer">
                <h1>Dịch vụ</h1>
                @foreach ($dichvu as $k => $v)
                    <a href="{{ $v['tenkhongdau' . $lang] }}">
                        <p>{{ $v['ten' . $lang] }}</p>
                    </a>
                @endforeach

            </div>
        </div>
        <div
            class="flex items-center justify-between py-8 border-0 border-t border-white border-solid border-opacity-90">
            <div class="w-full text-center text-white">Copyright © 2023 {{ $setting['ten' . $lang] }} - All Rights
                Reserved.
            </div>
        </div>
    </div>
</div>

<div
    class="fixed bg-cmain8 sm:bg-cmain8 bottom-0 sm:bottom-16 lg: md:bottom-12 right-0 sm:right-[10px] z-[9999] w-auto flex flex-row sm:flex-col items-center justify-between cursor-pointer">
    {{-- <div class="flex items-center pl-4 text-base text-white sm:hidden">Copyright © 2023 {{$setting['ten'.$lang]}} - All Rights Reserved .</div> --}}
    <div class="flex flex-row items-center justify-end sm:flex-col">
        {{-- <a href="https://chat.zalo.me/{{str_replace(' ','',$settingOption['zalo'])}}" target="_blank" class="cursor-pointer w-[60px] h-[60px] rounded-none flex items-start justify-center border border-solid border-cmain bg-[#0180C7] group transition-all duration-500 border-r-0 sm:border-b-0"><img src="img/zalo.png" alt=""></a>
		<a href="{{$settingOption['fanpage']}}" target="_blank" class="cursor-pointer w-[60px] h-[60px] rounded-none flex items-center justify-center border border-solid border-cmain hover:bg-cmain2 group transition-all duration-500 border-r-0 sm:border-b-0 bg-[#4A6EAA]"><img src="img/facebook.jpg" alt="" width="40px"></a> --}}
        <div
            class="back-to-top cursor-pointer w-[40px] sm:w-[60px] h-[40px] sm:h-[60px] rounded-none flex items-start justify-center border border-solid border-white hover:bg-white group transition-all duration-500 bg-cmain8">
            <svg class="mt-4 sm:mt-6 animate-bounce" width="15" height="17" viewBox="0 0 15 17" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path class="group-hover:stroke-cmain8" d="M7.5 17L7.5 1" stroke="white" />
                <path class="group-hover:stroke-cmain8" d="M14 7.3999L7.5 0.999903L1 7.3999" stroke="white" />
            </svg>
        </div>
    </div>
</div>
