@extends('desktop.master')



@section('element_detail', 'main_page_detail fix_detail_menu')

@section('page_detail', 'page_detail')


@section('banner')

    @include('desktop.layouts.banner')

@endsection


@section('content')

    <div class="bg-cmain3 lg:py-14 bor-none lg:-mt-[100px]">
        <div class="lg:py-4 content-page-layout">
            <div class="relative flex content-page-layout">
                <div class="w-full flex flex-wrap">
                    <div
                        class="lg:flex-1 2xl:w-[calc(100%-470px)] lg:w-[calc(100%-370px)] w-full pt-0 lg:pt-[55px] lg:pr-[60px] overflow-hidden">
                        <p class="mb-5 text-3xl font-bold">{{ __($row_detail['ten' . $lang]) }}</p>
                        <div
                            class="flex flex-col items-start justify-between gap-4 pt-3 mb-3 border-0 border-t border-solid md:gap-2 lg:items-center lg:gap-8 lg:flex-row border-cmain2 border-opacity-10">
                            <div class="flex items-center"><i class="mr-2 fal fa-calendar-alt"></i>{{ ngaydang }}:
                                {{ date('d/m/Y h:i A', $row_detail['ngaytao']) }}</div>
                        </div>
                        <div class="entry-content lg:text-16px news-detail-content">
                            @if (isset($row_detail['noidung' . $lang]) && $row_detail['noidung' . $lang] != '')
                                <div class="content-main content-css w-clear">{!! $row_detail['noidung' . $lang] !!}</div>
                            @endif
                        </div>
                    </div>
                    <div
                        class="2xl:w-[470px] lg:w-[370px] w-full sidebar-detail lg:pt-[64px] pt-[40px] md:px-[30px] px-[15px]">
                        @if ($posts_newest)
                            <div class="box-related">
                                <h4 class="uppercase lg:text-[24px] text-[16px] mb-[22px]"><span
                                        class="inline-block title-gradient">
                                        Các tin mới nhất
                                    </span></h4>
                                <div class="list-related">
                                    @foreach ($posts_newest as $k => $v)
                                        <div class="item flex items-center mb-[26px] zoom-image hover:shadow-lg hover:shadow-green-400">
                                            <div class="w-[100px] mr-[20px]">
                                                <a href="{{ $v['tenkhongdau' . $lang] }}" target=""
                                                    class="img block relative pb-[100%] overflow-hidden rounded-[5px]">
                                                    <img class="absolute w-full h-full left-0 top-0 object-cover lazy loaded"
                                                        src="{{ Thumb::Crop(UPLOAD_POST, $v['photo'], 100, 100, 1) }}"
                                                        alt="">
                                                </a>
                                            </div>
                                            <div class="flex-1">
                                                <a href="{{ $v['tenkhongdau' . $lang] }}" target=""
                                                    class="text-split lg:text-[20px] font-semibold text-black">
                                                    {{ $v['mota' . $lang] }}
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    @if (isset($posts) && count($posts) > 0)
                        <div class="mt-10">
                            <div
                                class="text-2xl md:text-[28px] font-bold text-black relative mb-6 md:mb-12 border-0 border-b border-solid border-cmain2 border-opacity-30 pb-2 flex items-center justify-between">
                                <p class="uppercase">{{ __('Tin tức khác') }}<span
                                        class="absolute w-[80px] border-0 border-t-[4px] border-cmain8 border-solid -bottom-[8px] md:-bottom-[10px] left-0 pb-2 transition-all duration-500 group-hover:border-black"></span>
                                </p>
                            </div>
                            <div class="flex flex-col flex-wrap gap-y-10">
                                @foreach ($posts as $k => $v)
                                    <div class="relative flex items-center gap-5 overflow-hidden group zoom-image hover:shadow-lg hover:shadow-green-400 cursor-pointer">
                                        <a href="{{ $v['tenkhongdau' . $lang] }}"
                                            class="himg w-[220px] overflow-hidden"><img
                                                class="w-full transition-all duration-500"
                                                src="{{ Thumb::Crop(UPLOAD_POST, $v['photo'], 340, 280, 1) }}"
                                                alt="" width="340" height="280"></a>
                                        <div class="w-[calc(100%-220px)]">
                                            <h3 class="mb-1"><a href="{{ $v['tenkhongdau' . $lang] }}"
                                                    class="text-xl font-extrabold transition-all duration-500 md:text-2xl text-cmain2 group-hover:text-cmain8 line-clamp-2">{{ $v['ten' . $lang] }}</a>
                                            </h3>
                                            <p class="mb-2 text-xl italic font-medium text-cmain2">
                                                {{ date('d . m . Y', $v['ngaytao']) }}</p>
                                            <div class="text-cmain2 leading-[140%] font-light line-clamp-3">
                                                {{ $v['mota' . $lang] }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    @endsection



    <!--css thêm cho mỗi trang-->

    @push('css_page')
        <style>
            .sidebar-detail {
                background: linear-gradient(1.47deg, #39B54A -3.02%, rgba(0, 43, 96, 0) -3.01%, ##88d0a4 86.86%);
            }
        </style>
    @endpush



    <!--js thêm cho mỗi trang-->

    @push('js_page')
        <!-- Like Share -->

        <script src="//sp.zalo.me/plugins/sdk.js"></script>

        <script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55e11040eb7c994c" async="async"></script>

        <script type="text/javascript">
            var addthis_config = addthis_config || {};

            addthis_config.lang = LANG
        </script>
    @endpush





    @push('strucdata')
        <script type="application/ld+json">

        {

            "@context": "https://schema.org",

            "@type": "NewsArticle",

            "mainEntityOfPage":

            {

                "@type": "WebPage",

                "@id": "https://google.com/article"

            },

            "headline": "{!!$row_detail['ten'.$lang]!!}",

            "image":

            [

                "{{ (isset($row_detail['photo']))?url('/').'/'.UPLOAD_POST.$row_detail['photo']:'' }}"

            ],

            "datePublished": "{{date('Y-m-d',$row_detail['ngaytao'])}}",

            "dateModified": "{{date('Y-m-d',$row_detail['ngaysua'])}}",

            "author":

            {

                "@type": "Person",

                "name": "{!!$setting['ten'.$lang]!!}",

                "url": "{{url()->current()}}"

            },

            "publisher":

            {

                "@type": "Organization",

                "name": "Google",

                "logo":

                {

                    "@type": "ImageObject",

                    "url": "{{ (isset($logo))?url('/').'/'.UPLOAD_PHOTO.$logo['photo']:'' }}"

                }

            },

            "description": "{{SEOMeta::getDescription()}}"

        }

    </script>
    @endpush
