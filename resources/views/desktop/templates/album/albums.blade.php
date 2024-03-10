@extends('desktop.master')

@section('element_detail','main_page_detail')

@section('follow')
    @include('desktop.layouts.follow')
@endsection

@section('content')
<div class="content-page-layout bor-none">
    @if(isset($albums) && count($albums)>0)
        {{-- @if(!$banner)<h2 class="home-title page-title"><span>{{$title_crumb}}</span></h2>@endif --}}
        @foreach($albums as $k=>$v)
        @php
            $bosuutp_photos = $v['get_photos'];	
            $products = $v['has_all_products_limit'];
        @endphp
            @if($products)
            <div class="border-0 border-t-0 lg:border-t border-solid border-[rgba(30,30,30,10%)] mt-8 md:mt-[50px] pt-[50px] last:mb-[50px]">
                {{-- <div class="mb-10 text-center">
                    <p class="capitalize text-cmain font-medium text-[32px] mb-3">{{$v['ten'.$lang]}}</p>
                    <p class="text-base font-medium content-layout-small text-cmain opacity-70">{{$v['mota'.$lang]}}</p>
                </div>	 --}}
                @if($bosuutp_photos)
                    <div>
                        <div class="flex flex-wrap flex-col-reverse gap-[16px] {{($k%2==1) ? 'lg:flex-row-reverse' : 'lg:flex-row'}}">
                            @desktop
                            @if(isset($bosuutp_photos[0]['photo']) && $bosuutp_photos[0]['photo']!='')
                            <div class="w-full lg:w-[312px] hidden lg:block">
                                <a href="{{UPLOAD_ALBUM.$bosuutp_photos[0]['photo']}}" class="overflow-hidden himg group" data-fancybox="bosuutap-{{$k}}">
                                    <img class="w-full lazy scale-img" data-src="{{Thumb::Crop(UPLOAD_ALBUM,$bosuutp_photos[0]['photo'],312,395,1)}}" alt="" width="312" height="395">
                                </a>
                            </div>
                            @endif
                            @enddesktop
                            <div class="flex flex-wrap w-full lg:w-[calc(100%-490px-312px-32px)] gap-3 md:gap-[16px] justify-between">
                                @if(isset($bosuutp_photos[1]['photo']) && $bosuutp_photos[1]['photo']!='')
                                <a href="{{UPLOAD_ALBUM.$bosuutp_photos[1]['photo']}}" class="himg w-[calc(100%/2-8px)] overflow-hidden himg group" data-fancybox="bosuutap-{{$k}}">
                                    <img class="w-full lazy scale-img" data-src="{{Thumb::Crop(UPLOAD_ALBUM,$bosuutp_photos[1]['photo'],188,189,1)}}" alt="" width="188" height="188">
                                </a>
                                @endif
                                @if(isset($bosuutp_photos[2]['photo']) && $bosuutp_photos[2]['photo']!='')
                                <a href="{{UPLOAD_ALBUM.$bosuutp_photos[2]['photo']}}" class="himg w-[calc(100%/2-8px)] overflow-hidden himg group" data-fancybox="bosuutap-{{$k}}">
                                    <img class="w-full lazy scale-img" data-src="{{Thumb::Crop(UPLOAD_ALBUM,$bosuutp_photos[2]['photo'],188,189,1)}}" alt="" width="188" height="188">
                                </a>
                                @endif
                                @if(isset($bosuutp_photos[3]['photo']) && $bosuutp_photos[3]['photo']!='')
                                <a href="{{UPLOAD_ALBUM.$bosuutp_photos[3]['photo']}}" class="himg w-[calc(100%/2-8px)] overflow-hidden himg group" data-fancybox="bosuutap-{{$k}}">
                                    <img class="w-full lazy scale-img" data-src="{{Thumb::Crop(UPLOAD_ALBUM,$bosuutp_photos[3]['photo'],188,189,1)}}" alt="" width="188" height="188">
                                </a>
                                @endif
                                @if(isset($bosuutp_photos[4]['photo']) && $bosuutp_photos[4]['photo']!='')
                                <a href="{{UPLOAD_ALBUM.$bosuutp_photos[4]['photo']}}" class="himg w-[calc(100%/2-8px)] overflow-hidden himg group" data-fancybox="bosuutap-{{$k}}">
                                    <img class="w-full lazy scale-img" data-src="{{Thumb::Crop(UPLOAD_ALBUM,$bosuutp_photos[4]['photo'],188,189,1)}}" alt="" width="188" height="188">
                                </a>
                                @endif
                            </div>
                            <div class="w-full lg:w-[490px] text-white p-5 md:p-[60px]" title="{{$v['ten'.$lang]}}" style="background:#{{(($v['bg_color']!='') ? $v['bg_color'] : '1B4932')}}">
                                <h2 class="mb-4"><a class="text-4xl font-semibold uppercase leading-[30px] md:leading-[45px] line-clamp-2" style="color:#{{(($v['text_color']!='') ? $v['text_color'] : '1E1E1E')}}" href="{{$v['tenkhongdau'.$lang]}}">{{$v['ten'.$lang]}}</a></h2>
                                <div class="text-xl leading-7 md:text-base md:leading-5 opacity-70 line-clamp-5" style="color:#{{(($v['text_color']!='') ? $v['text_color'] : '1E1E1E')}}">{{$v['mota'.$lang]}}</div>
                                <a href="{{$v['tenkhongdau'.$lang]}}" class="border border-solid rounded-none mt-6 inline-flex items-center justify-center px-5 py-[10px] transition-all duration-300 hover:scale-105 hover:text-cmain2" style="color:#{{(($v['text_color']!='') ? $v['text_color'] : '1E1E1E')}}; border-color:#{{(($v['text_color']!='') ? $v['text_color'] : '1E1E1E')}}">{{__('Xem tất cả')}}</a>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="mt-10 product_km__owl owl-carousel owl-theme">
                    @foreach($products as $k=>$v)
                        <x-product-item :item="$v"/>	
                    @endforeach
                </div>

            </div>
            @endif
        @endforeach
    @else
        <div class="alert-data" role="alert">
            <strong><i class="mr-1 far fa-exclamation-circle"></i>No results were found !</strong>
        </div>
    @endif
</div>

@endsection

<!--css thêm cho mỗi trang-->
@push('css_page')

@endpush

<!--js thêm cho mỗi trang-->
@push('js_page')
	<!-- Like Share -->
    <script src="//sp.zalo.me/plugins/sdk.js"></script>

    <script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55e11040eb7c994c" async="async"></script>
    <script type="text/javascript">
        var addthis_config = addthis_config||{};
        addthis_config.lang = LANG
    </script>
@endpush

@push('strucdata')
	@include('desktop.layouts.strucdata')
@endpush