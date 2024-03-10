@extends('desktop.master')

@section('slider')
    @include('desktop.layouts.slider')
@endsection


@section('content')
    @php
        $seopage_static = app('seopage_static');
    @endphp

    @include('desktop.templates.about.index')
    {{-- @if ($vechungtoi)
    <div class="relative pt-0 pb-0 lg:pt-20 lg:pb-20 2xl:pt-32 2xl:pb-40 bg-cmain3">
        <div class="relative flex flex-col-reverse lg:flex-row max-w-full lg:max-w-[90%] 2xl:max-w-[70%] m-auto">
            <div class="w-full lg:w-[600px] relative">
                <p class="himg w-full lg:w-[600px] h-auto lg:h-[600px] flex lg:inline-flex items-center justify-center relative revealOnScroll" data-animation="animate__fadeInLeft">
                    <img class="block object-cover w-full lg:w-auto" src="{{ Thumb::Crop(UPLOAD_STATICPOST, $vechungtoi['photo'], 600, 600, 1) }}" alt="ve-chung-toi" width="600" height="600">
                </p>
            </div>
            <div class="w-full lg:w-[calc(100%-600px)] pl-0 lg:pl-16 relative pt-0 lg:pt-20 z-50 bg-[#F0F1E9] bor-none">
                <p class="mb-2 text-xl md:text-[18px] font-bold uppercase opacity-50 font-Montserrat text-cmain2 revealOnScroll" data-animation="animate__fadeInUp">About us</p>
                <p class="font-extrabold font-Montserrat text-cmain4 text-4xl md:text-[42px] capitalize mb-6 relative leading-[140%] pr-8 revealOnScroll" data-animation="animate__fadeInUp">{{$vechungtoi['ten'.$lang]}}</p>
                <div class="leading-[160%] whitespace-pre-line text-xl md:text-base mb-8 line-clamp-4 pr-8 revealOnScroll" data-animation="animate__fadeInUp">{{$vechungtoi['mota'.$lang]}}</div>
                <a href="ve-chung-toi" class="relative inline-flex items-center px-8 py-3 font-bold uppercase transition-all duration-500 border border-solid rounded-none font-Montserrat text-cmain4 border-cmain4 hover:text-white hover:bg-cmain4 group revealOnScroll" data-animation="animate__fadeInUp">
                    See more
                    <svg class="absolute transition-all duration-300 bg-[#F0F1E9] top-2 -right-6 group-hover:-right-7" fill="#668945" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z"/></svg>
                </a>
                @if ($hinh_intro)
                <div class="mt-10 md:mt-20 ml-0 lg:-ml-[120px] intro__owl owl-carousel owl-theme block-img w-full lg:w-[calc(100%+120px)] revealOnScroll" data-animation="animate__fadeInUp">
                    @foreach ($hinh_intro as $k => $v)
                        <p class="himg"><img src="{{ Thumb::Crop(UPLOAD_STATICPOST, $v['photo'], 600, 600, 1) }}" alt="" width="150" height="150" /></p>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif --}}
    @if ($products_nb)
        <div class="section-product-nb"
            @if($backgroundspnb) style="background-image: url({{ Thumb::Crop(UPLOAD_PHOTO, $backgroundspnb[0]['background'], 1920, 1067, 1) }})" @endif>
            <div class="content-page-layout main-content py-5">
                <div class="text-center py-14 revealOnScroll" data-animation="animate__fadeInUp">
                    <h1 class="uppercase text-[#fff] text-[32px] font-bold">Sản phẩm nổi bật</h1>
                    {{-- <div class="leading-[160%] whitespace-pre-line text-xl md:text-base mb-8 line-clamp-4 text-white revealOnScroll"
                        data-animation="animate__fadeInUp">{{ $seopage_static['product']['mota' . $lang] }}</div> --}}
                    <a href="san-pham">
                        <p class="pt-5 text-white font-[16px]">Xem tất cả</p>
                    </a>
                </div>
                <div class="products__owl owl-carousel owl-theme">
                    @foreach ($products_nb as $k => $v)
                        <div class="relative overflow-hidden group revealOnScroll cursor-pointer bg-white shadow-md rounded-lg card-nb"
                            data-animation="animate__fadeInUp" data-timeout="{{ ($k + 1) * 200 }}">
                            <a href="{{ $v['tenkhongdau' . $lang] }}" class="product-item">
                                <button
                                    class="absolute bg-cmain text-white py-3 px-6 right-[6px] top-[22px] border-0 text-[14px] rounded-lg z-10">{{ $v['has_level_one'] ? $v['has_level_one']['tenvi'] : 'Chưa cập nhật' }}</button>
                                <img class="rounded-lg z-10" src="public/upload/test/image_78.png" width="285"
                                    height="301">
                                <div class="p-5 flex flex-col gap-3 z-10">
                                    <h1 class="text-cmain font-[18px] font-semibold uppercase">{{ $v['ten' . $lang] }}</h1>
                                    <p class="text-cmain1 font-medium text-[16px]">Xem chi tiết</p>
                                </div>
                                <div
                                    class="bg-hover opacity-1 flex flex-col justify-start rounded-lg absolute top-0 right-0 left-0 bottom-0 info-product text-white pt-[54px] px-6 pb-6">
                                    <div class="font-bold text-[18px] mb-[13px] uppercase">
                                        {{ $v['ten' . $lang] }}
                                    </div>
                                    <div class="text-white text-sm font-normal">
                                        {{ $v['mota' . $lang] }}
                                    </div>
                                    <div class="text-white flex flex-row items-center flex-wrap gap-x-6 mt-auto">
                                        <span
                                            class="xl:w-auto underline transition-all duration-300 font-medium text-[16px]">
                                            Xem chi tiết
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- DICH VU NOI BAT --}}
    @include('desktop.templates.about.dichvu')

    {{-- DU AN NOI BAT --}}
    @include('desktop.templates.about.duan')

    {{-- HINH ANH VE CHUNG TOI --}}
    @include('desktop.templates.about.vechungtoi')

    {{-- @if ($products_nb)
    <div class="relative py-0 bg-cmain md:py-14 lg:py-28">
        <span class="absolute left-0 rotate-180 opacity-50 top-20 md:opacity-100"><img class="revealOnScroll" data-animation="animate__fadeInRight" src="img/rau.png" alt=""></span>
        <div class="flex flex-col items-end justify-between lg:items-center lg:flex-row //content-page-layout bor-none">
            <div class="w-full md:w-2/4 lg:w-[40%] py-28 pl-0 lg:pl-[20%] relative items-end lg:items-start">
                <div class="font-extrabold capitalize text-white text-[40px] md:text-[52px] font-Montserrat text-left relative mb-10 revealOnScroll" data-animation="animate__fadeInUp">
                    Typical products<span class="absolute w-[50px] h-[4px] bg-white left-0 -bottom-5"></span>
                </div>
                <div class="leading-[160%] whitespace-pre-line text-xl md:text-base mb-8 line-clamp-4 text-white revealOnScroll" data-animation="animate__fadeInUp">{{$seopage_static['product']['mota'.$lang]}}</div>
                <a href="san-pham" class="relative inline-flex items-center px-8 py-3 font-bold text-white uppercase transition-all duration-500 border border-white border-solid rounded-none font-Montserrat hover:text-cmain hover:bg-white group revealOnScroll" data-animation="animate__fadeInUp">
                    See more
                    <svg class="absolute transition-all duration-300 bg-transparent md:bg-cmain top-2 -right-8 md:-right-6 group-hover:-right-7" fill="white" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z"></path></svg>
                </a>
            </div>
            <div class="w-full lg:w-[55%] pl-0 lg:pl-10 2xl:pl-20 revealOnScroll" data-animation="animate__fadeInRight">
                <div class="typical__owl owl-carousel owl-theme block-img dots_typical__owl">
                    @foreach ($products_nb as $k => $v)
                    @php
                        $giamoi = $v['giamoi'] < $v['gia'] ? $v['giamoi'] : 0;
                        $gia = $v['gia'];
                        $giakm = $v['giakm'];
                    @endphp
                    <div class="p-4 overflow-hidden bg-bui ">
                        <a href="{{$v['tenkhongdau'.$lang]}}" title="{{$v['ten'.$lang]}}" class="himg"><img src="{{ Thumb::Crop(UPLOAD_PRODUCT, $v['photo'], 800, 800, 1) }}" alt="" width="400" height="400"></a>
                        <div class="px-3 py-8">
                            <h2><a href="{{$v['tenkhongdau'.$lang]}}" class="text-2xl sm:text-xl font-bold capitalize font-Montserrat leading-[140%] text-cmain">{{$v['ten'.$lang]}}</a></h2>
                            <div class="flex items-center mt-2">
                                @if ($giamoi < $gia && $giamoi > 0)
                                <p class="text-xl font-bold text-red-600 md:text-base font-Montserrat">{!! $giamoi < $gia ? Helper::Format_Money($giamoi) : Helper::Format_Money($gia) !!}</p>
                                @endif

                                @if ($giamoi == 0)
                                <p class="text-xl font-bold text-red-600 md:text-base font-Montserrat">{!! Helper::Format_Money($gia) !!}</p>
                                @else
                                <p class="ml-4 text-sm text-gray-600 line-through font-Montserrat opacity-70">{!! Helper::Format_Money($gia) !!}</p>
                                @endif
                            </div>
                            <div class="line-clamp-3 text-[15px] leading-[140%] mt-2">{{$v['mota'.$lang]}}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif --}}


    {{-- @if ($products_cate)
    <div class="relative pt-12 pb-0 md:py-12 lg:py-24 bg-cmain3">
        <span class="absolute top-0 left-0 flex items-center justify-center w-full h-full overflow-hidden"><img class="object-cover w-full h-full" src="img/bg_bui.png" alt=""></span>
        <div class="mb-0 lg:mb-16 content-page-layout revealOnScroll" data-animation="animate__fadeInUp">
            <div class="font-extrabold capitalize text-cmain text-[40px] md:text-[52px] mb-10 font-Montserrat text-center relative">
                <p class="">
                    <svg class="-mr-6" style="transform: rotateY(180deg) rotateZ(8deg);" width="30" height="30" fill="#4AAC46" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17,8C8,10,5.9,16.17,3.82,21.34L5.71,22l1-2.3A4.49,4.49,0,0,0,8,20C19,20,22,3,22,3,21,5,14,5.25,9,6.25S2,11.5,2,13.5a6.22,6.22,0,0,0,1.75,3.75C7,8,17,8,17,8Z"/>
                        <rect width="24" height="24" fill="none"/>
                    </svg>
                    <svg height="70" width="70" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 504.125 504.125" xml:space="preserve">
                    <path style="fill:#42a73e;" d="M339.772,0c0,0,44.536,108.954-146.337,182.138C89.719,221.893,10.059,323.789,105.173,481.193
                        c7.877-70.357,41.653-225.485,186.888-260.884c0,0-135.176,50.546-147.117,279.347c69.459,9.752,232.361,16.305,280.726-125.062
                        C489.536,187.817,339.772,0,339.772,0z"/>
                    <path style="fill:#4AAC46;" d="M145.007,498.704c147.456-58.849,254.748-196.71,269.556-361.283C384.418,56.107,339.772,0,339.772,0
                        s44.536,108.954-146.337,182.138C89.719,221.893,10.059,323.789,105.173,481.193c7.877-70.357,41.653-225.485,186.888-260.884
                        C292.053,220.31,157.279,270.73,145.007,498.704z"/>
                    <circle style="fill:#4AAC46;" cx="90.459" cy="171.985" r="13.785"/>
                    <g>
                        <circle style="fill:#4AAC46;" cx="133.782" cy="158.2" r="9.846"/>
                        <circle style="fill:#4AAC46;" cx="124.921" cy="64.662" r="24.615"/>
                        <circle style="fill:#4AAC46;" cx="200.736" cy="120.785" r="7.877"/>
                        <circle style="fill:#4AAC46;" cx="266.713" cy="76.477" r="22.646"/>
                    </g>
                    </svg>
                </p>
                Product portfolio<span class="absolute w-[50px] h-[4px] bg-cmain left-[calc(50%-25px)] -bottom-3"></span>
            </div>
            <div class="text-center max-w-[90%] md:max-w-[60%] m-auto leading-[140%] text-xl md:text-base">{{$seopage_static['productporfolio']['mota'.$lang]}}</div>
        </div>
        <div class="px-0 lg:px-20 porfolio__owl owl-carousel owl-theme block-img bor-none">
            @foreach ($products_cate as $k => $v)
                <div class="relative p-3 overflow-hidden text-center bg-white md:p-5 group revealOnScroll" data-animation="animate__fadeInUp" data-timeout="{{($k+1)*200}}">
                    <a href="{{$v['tenkhongdau'.$lang]}}" class="absolute top-0 left-0 z-50 w-full h-full"></a>
                    <p class="flex items-center justify-center overflow-hidden duration-500 himg transiton-all group-hover:blur-[7px]"><img class="object-cover" src="{{ Thumb::Crop(UPLOAD_CATEGORY, $v['photo'], 500, 500, 1) }}" alt="" width="500" height="500"></p>
                    <h3 class="m-auto mt-8 text-2xl font-extrabold text-center capitalize text-cmain">{{$v['ten'.$lang]}}</h3>
                    <div class="text-center text-black opacity-75 leading-[140%] line-clamp-3 mt-3 mb-8 text-base">{{$v['mota'.$lang]}}</div>
                    <a class="text-base md:text-[18px] font-bold text-center text-cmain underline font-Montserrat uppercase">Read more</a>
                </div>
            @endforeach
        </div>
    </div>
    @endif --}}


    {{-- @if ($dichvu_nb)
    <div class="relative pt-20 pb-0 md:pt-20 lg:pt-32 md:pb-20 lg:pb-28">
        <div class="content-page-layout revealOnScroll" data-animation="animate__fadeInUp">
            <p class="font-extrabold capitalize text-cmain text-[40px] md:text-[52px] mb-10 font-Montserrat text-center relative">Our services<span class="absolute w-[50px] h-[4px] bg-cmain left-[calc(50%-25px)] -bottom-3"></span><img class="absolute opacity-10 w-[200px]  -top-16 left-[calc(50%-100px)]" src="img/dua2.png" alt=""></p>
            <div class="text-center max-w-[90%] md:max-w-[60%] m-auto leading-[140%] text-xl md:text-base">{{$seopage_static['dichvu']['mota'.$lang]}}</div>
        </div>

        <div class="mt-0 md:mt-14 max-w-full md:max-w-[80%] m-auto bor-none">
            <div class="dichvu__owl owl-carousel owl-theme block-img">
                @foreach ($dichvu_nb as $k => $v)
                <div class="relative overflow-hidden group revealOnScroll" data-animation="animate__fadeInUp">
                    <span class="absolute -top-[50px] -left-[1000px] z-[999] w-[2000px]"><img src="img/land3.png" alt=""></span>
                    <span class="absolute -left-[1000px] z-[999] rotate-180 w-[2000px] -bottom-[50px]"><img src="img/land3.png" alt=""></span>
                    <span class="absolute -top-[50px] -left-[1020px] z-[999] w-[2000px]" style="transform: rotate(90deg) rotateX(180deg);"><img src="img/land3.png" alt=""></span>
                    <span class="absolute -top-[50px] -right-[1020px] z-[999] w-[2000px]" style="transform: rotate(90deg) rotateX(360deg);"><img src="img/land3.png" alt=""></span>
                    <a href="###" class="flex items-center justify-center overflow-hidden"><img class="object-none md:object-cover h-[500px] md:h-[600px] lg:h-[700px]" src="{{ Thumb::Crop(UPLOAD_POST, $v['photo'], 500, 700, 1) }}" alt="" width="500" height="700"></a>
                    <a href="{{$v['tenkhongdau'.$lang]}}" class="absolute top-0 left-0 flex items-center justify-center w-full h-full text-white capitalize text-3xl md:text-[40px] font-Montserrat font-semibold bg-[rgba(0,0,0,0.3)]">
                        <span class="relative z-[9999]">{{$v['ten'.$lang]}}</span>
                        <span class="absolute font-Fasthand text-[150px] opacity-30 transition-all duration-500 group-hover:opacity-0">0{{$k+1}}</span>
                        <span class="absolute font-Fasthand text-[150px] group-hover:opacity-50 text-cmain scale-[200%] transition-all duration-500 opacity-0 group-hover:scale-100">0{{$k+1}}</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif --}}


    {{-- @if ($tintuc_nb)
    <div class="relative py-5 md:py-14 lg:py-28 bg-cmain3">
        <span class="absolute top-0 left-0 flex items-center justify-center w-full h-full overflow-hidden"><img class="object-cover w-full h-full" src="img/bg_bui.png" alt=""></span>
        <div class="content-page-layout bor-none">
            <div class="flex flex-col items-center justify-between mb-8 sm:flex-row revealOnScroll" data-animation="animate__fadeInUp">
                <div class="font-extrabold capitalize text-cmain text-[40px] md:text-[52px] font-Montserrat relative">
                    Featured news
                </div>
                <p class="mt-5 text-right sm:mt-0">
                    <a href="tin-tuc" class="relative inline-flex items-center px-8 py-3 font-bold uppercase transition-all duration-500 border border-solid rounded-none font-Montserrat text-cmain border-cmain hover:text-white hover:bg-cmain group">See more</a>
                </p>
            </div>
            <div class="news__owl owl-carousel owl-theme block-img">
                @foreach ($tintuc_nb as $k => $v)
                    <div class="relative overflow-hidden group revealOnScroll" data-animation="animate__fadeInUp" data-timeout="{{($k+1)*200}}">
                        <p class="absolute flex flex-col p-3 text-center top-3 right-3 bg-cmain z-[999]">
                            <span class="inline-block text-3xl md:text-[36px] font-extrabold text-white">{{date('d',$v['ngaytao'])}}</span>
                            <span class="text-base text-white md:text-normal">{{date('M',$v['ngaytao'])}}, {{date('Y',$v['ngaytao'])}}</span>
                        </p>
                        <a href="###" class="relative overflow-hidden himg"><img  class="transition-all duration-500 group-hover:scale-105" src="{{ Thumb::Crop(UPLOAD_POST, $v['photo'], 720, 600, 1) }}" alt="" width="360" height="300"><span class="absolute top-0 left-0 w-full h-full bg-[rgba(0,0,0,0.3)]"></span></a>
                        <div class="p-5 bg-[rgb(74,172,70,5%)] min-h-[198px] flex flex-col justify-between">
                            <div>
                                <h4 class="mb-4"><a href="###" class="leading-[140%] text-black font-Montserrat font-bold text-xl md:text-base">{{$v['ten'.$lang]}}</a></h4>
                                <div class="leading-[140%] mb-3 line-clamp-3">{{$v['mota'.$lang]}}</div>
                            </div>
                            <a href="{{$v['tenkhongdau'.$lang]}}" class="font-bold font-Montserrat text-cmain">Read more</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif --}}



    {{-- <div class="relative z-20 py-5 md:py-20 /bg-cmain" style="background: linear-gradient(45deg, #4AAC46, #286825);">
        <span class="absolute -top-[6rem] -left-20 hidden md:block"><img class="revealOnScroll"
                data-animation="animate__fadeInUp" src="img/rau2.png" alt=""></span>
        <span class="absolute z-20 hidden -right-8 -bottom-28 lg:block"><img class="revealOnScroll"
                data-animation="animate__fadeInUp" data-timeout="200" src="img/rau.png" alt=""></span>
        <div class="flex flex-col items-center justify-center md:flex-row content-page-layout bor-none">
            <div class="w-full md:w-[40%] pr-10 revealOnScroll" data-animation="animate__fadeInUp">
                <div
                    class="font-extrabold uppercase text-white text-4xl md:text-[40px] font-Montserrat text-left relative mb-10">
                    Subscribe to receive news<span class="absolute w-[50px] h-[4px] bg-white left-0 -bottom-5"></span>
                </div>
                <div class="leading-[160%] whitespace-pre-line text-xl md:text-base mb-8 line-clamp-4 text-white">
                    {{ $seopage_static['subscrive']['mota' . $lang] }}</div>
            </div>
            <div class="w-full md:w-[45%] relative mt-5 md:mt-0 revealOnScroll" data-animation="animate__fadeInUp">
                <form
                    class="w-full py-20 px-8 bg-[rgba(255,255,255,0.3)] frm_newsletter //frm_check_recaptcha shadow-shadow3"
                    action="{{ route('sendNewsletter') }}" method="post">
                    @csrf
                    <input type="hidden" name="type" value="guiyeucau" />
                    <input type="hidden" name="isrecaptcha" value="0" />
                    <div class="relative flex flex-col gap-3">
                        <p class="mb-2"><input type="text" name="ten" placeholder="Your name" required=""
                                class="border border-solid border-white border-opacity-40 rounded-0 h-[45px] w-full indent-1 font-Montserrat placeholder:font-Montserrat placeholder:text-white placeholder:opacity-80 bg-transparent">
                        </p>
                        <p class="mb-2"><input type="email" name="email" id="email" placeholder="Email"
                                required=""
                                class="border border-solid border-white border-opacity-40 rounded-0 h-[45px] w-full indent-1 font-Montserrat placeholder:font-Montserrat placeholder:text-white placeholder:opacity-80 bg-transparent">
                        </p>
                        <p class="mb-2"><input type="text" name="dienthoai" id="dienthoai"
                                placeholder="Your phone number" required=""
                                class="border border-solid border-white border-opacity-40 rounded-0 h-[45px] w-full indent-1 font-Montserrat placeholder:font-Montserrat placeholder:text-white placeholder:opacity-80 bg-transparent">
                        </p>
                        <div class="relative">
                            <textarea name="noidung" rows="5" placeholder="Message..."
                                class="w-full bg-transparent border border-white border-solid rounded-none rounded-0 indent-1 font-Montserrat placeholder:font-Montserrat placeholder:text-white placeholder:opacity-80 border-opacity-40"></textarea>
                        </div>
                        <p class="text-center"><button type="submit"
                                class="bg-[rgb(255,255,255,70%)] text-cmain uppercase font-Montserrat border-none font-bold h-[40px] px-8 text-base cursor-pointer mt-5">Send</span>
                        </p></button> </p>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}


    {{-- @if ($khachhang)
        <div class="relative py-10 lg:py-28 bg-cmain3">
            <span class="absolute top-0 left-0 w-full h-[60px]"></span>
            <span class="absolute top-0 left-0 flex items-center justify-center w-full h-full overflow-hidden"><img
                    class="object-cover w-full h-full" src="img/bg_bui.png" alt=""></span>
            <div class="mb-0 md:mb-16 content-page-layout revealOnScroll" data-animation="animate__fadeInUp">
                <div
                    class="font-extrabold capitalize text-cmain text-[40px] md:text-[52px] mb-5 md:mb-10 font-Montserrat text-center relative">
                    Customer feeling<span class="absolute w-[50px] h-[4px] bg-cmain left-[calc(50%-25px)] -bottom-3"></span>
                </div>
            </div>
            <div class="main-content content-page-layout bor-none">
                <div class="customer__owl owl-carousel owl-theme block-img">
                    @foreach ($khachhang as $k => $v)
                        <div class="relative overflow-hidden group revealOnScroll" data-animation="animate__fadeInUp"
                            data-timeout="{{ ($k + 1) * 200 }}">
                            <p class="text-center himg w-full md:w-[200px] m-auto pt-5"><img
                                    class="inline-block border-[4px] border-white border-solid rounded-full shadow-shadow3"
                                    src="{{ Thumb::Crop(UPLOAD_POST, $v['photo'], 200, 200, 1) }}" alt=""
                                    width="200" height="200"></p>
                            <div class="text-center leading-[160%] text-[15px] m-auto mt-8 opacity-80 line-clamp-3">
                                {{ $v['mota' . $lang] }}</div>
                            <p class="mt-5 text-xl font-bold text-center capitalize font-Montserrat">
                                {{ $v['ten' . $lang] }}
                            </p>
                        </div>
                    @endforeach
                </div>
                <div class="owl-controls">
                    <div class="custom-nav owl-nav"></div>
                </div>
            </div>
        </div>
        </div>
    @endif --}}

    {{-- DOI TAC & VIDEO --}}
    @include('desktop.templates.about.doitac')
@endsection


@push('css_page')
    <style>
        .section-product-nb {
            position: relative;
            background-size: cover;
        }

        .section-product-nb::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: linear-gradient(98deg, rgba(255, 255, 255, 0.96) -3.87%, rgba(7, 108, 64, 0.59) 36.12%);
        }

        .bg-hover {
            background: linear-gradient(180deg, rgba(7, 108, 64, 0.70) 49%, rgba(6, 86, 48, 0.70) 74.98%);
        }

        .product-item .info-product {
            transition-property: all !important;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1) !important;
            transition-duration: 700ms !important;
        }

        .product-item:hover .info-product {
            opacity: 1;
            z-index: 100;
            transition: opacity 1s ease;
        }

        .product-item:hover button {
            opacity: 0.5;
        }
    </style>
@endpush

<!--js thêm cho mỗi trang-->
@push('js_page')
    {{-- <script>
        if($(".products__owl").exists()) {
            var owl_list_products = $('.products__owl');
            owl_list_products.owlCarousel({
                autoplay: false,
                margin: 20,
                items: 5,
                dots: false,
                autoplayHoverPause: true,
                autoplaySpeed: 3000,
                autoplayTimeout: 2000,
                smartSpeed: 3000,
                //smartSpeed: 2000,
                loop: true,
                responsive: {
                    0: {
                        items: 1,
                        margin: 40,
                        stagePadding: 30,
                    },

                    600: {
                        items: 2,
                        margin: 20,
                        stagePadding: 20,
                    },

                    750: {
                        items: 3,
                        margin: 15,
                        stagePadding: 20,
                    },
                    1028: {
                        items: 4,
                        spaceBetween: 20,
                        nav: true,
                        navText: [
                            "<button class='arrow-left-product'><i class = 'fas fa-arrow-left'></i></button>",
                            "<button class='arrow-right-product'><i class='fas fa-arrow-right'></i></button>"
                        ]
                    }
                }
            });
        }
    </script> --}}
@endpush


@push('strucdata')
    @include('desktop.layouts.strucdata')
@endpush
