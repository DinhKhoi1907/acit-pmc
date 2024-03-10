@extends('desktop.master')
@section('element_detail', 'main_page_detail fix_detail_menu')
@section('page_detail', 'page_detail')
@section('menu', $is_fix_menu)

@section('banner')
    {{-- @include('desktop.layouts.banner') --}}
@endsection

@section('content')
    <div class="relative h-[350px] md:h-[450px]">
        <img class="block object-cover w-full h-full lg:w-auto"
            src="{{ Thumb::Crop(UPLOAD_STATICPOST, $row_detail['banner'], 1920, 450, 1) }}" alt="ve-chung-toi" width="1920">
        <span class="absolute top-0 left-0 z-10 w-full h-full bg-black opacity-30"></span>
        <h2
            class="font-extrabold capitalize text-white text-[30px] md:text-[52px] font-Montserrat text-center absolute z-50 w-full h-full flex items-center justify-center top-0 left-0">
            <p class="relative font-[Roboto] uppercase text-white tracking-[2px]">Giới thiệu<span
                    class="absolute w-[50px] h-[4px] bg-white left-[calc(50%-25px)] -bottom-3"></span></p>
        </h2>
    </div>
    <div class="relative z-50 revealOnScroll" data-animation="animate__fadeInUp">
        <div
            class="ab-us bg-[#F1FAFE] xl:h-screen w-full flex 2xl:flex-row flex-col justify-between items-center overflow-hidden relative gap-y-8">
            <div class="container grid lg:grid-cols-12 items-center lg:h-screen us_info xl:px-0 lg:px-6 px-4">
                <div
                    class="bg-[url('https://www.acit-pmc.online/img/Logo_ACIT.png')] w-auto h-auto xl:w-[664px] xl:h-[628px] xl:left-[500px] top-0 absolute bg-no-repeat">
                </div>
                <div class="xl:col-span-6 lg:col-span-6 md:col-span-4 lg:z-10 revealOnScroll"
                    data-animation="animate__fadeInLeft" data-timeout="300">
                    <div>
                        <span class="font-medium text-3xl xl:text-5xl -mb-2 mr-4 text-black">Về chúng tôi</span>
                        <span class="font-extrabold text-6xl xl:text-9xl text-cmain">{{ isset($settingOption['tenchinh']) ? $settingOption['tenchinh'] : 'ACIT' }}</span>
                    </div>
                    <h1 class="text-cmain font-medium text-2xl">
                        {{ $row_detail['ten' . $lang] }}
                    </h1>
                    <div class="flex flex-col gap-y-6 mt-4 font-normal text-xl xl:pr-30">
                        <div class="flex flex-col gap-x-1 text-xl font-normal text-justify">
                            {!! $row_detail['noidung' . $lang] !!}
                        </div>
                    </div>
                </div>
            </div>
            @if ($hinhanhsp)
                <div
                    class="skew-box lg:absolute top-0 lg:flex grid grid-cols-3 right-6 text-white xl:text-4xl text-base font-extrabold lg:w-[42%] w-full lg:h-full">
                    @foreach ($hinhanhsp as $k => $v)
                        <a style="background-image: url({{ Thumb::Crop(UPLOAD_STATICPOST, $v['photo'], 440, 1148, 1) }})"
                            class="lg:w-44 xl:w-62 2xl:w-72 w-full h-72 lg:h-full bg-center bg-cover lg:-skew-x-6 overflow-hidden flex justify-center items-end relative skew-item cursor-pointer">
                            <div
                                class="flex md:flex-row flex-col gap-x-2 xl:gap-x-3 items-center z-20 py-4 xl:py-16 px-0 xl:px-4 skew-text">
                                <div>
                                    <div class="text-base xl:text-2xl uppercase whitespace-nowrap font-bold 2xl:text-3xl">
                                        {{ $v['ten' . $lang] }}
                                    </div>
                                </div>
                            </div>
                            <div class="absolute top-0 right-0 bottom-0 left-0 opacity-0 z-10 bg-hover skew-mask w-full">
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="container flex xl:flex-row flex-col items-center py-6 md:py-16 gap-x-16 gap-y-4 bg-white re">
            <img src="{{ Thumb::Crop($folder_upload, $row_detail['photo'], 605, 328, 1) }}" alt="/"
                class="hidden sm:block revealOnScroll" data-animation="animate__backInLeft" data-timeout="200">
            <div class="text-xl text-justify revealOnScroll" data-animation="animate__backInRight" data-timeout="200">
                {!! $row_detail['mota' . $lang] !!}
            </div>
        </div>
        {{-- Sơ đồ tổ chức --}}
        @if ($sodotochuc)
            <div style="background-image: url({{ Thumb::Crop(UPLOAD_PHOTO, $sodotochuc[0]['background'], 1920, 1067, 1) }})"
                class="bg-center bg-no-repeat bg-cover w-full py-16">
                <div class="container flex flex-col justify-center items-center history">
                    <h1 style="color:#fff !important" class="pb-5">Sơ đồ tổ chức </h1>
                    <img alt="/" class="px-2 xl:px-0 mt-3 xl:mt-8 w-full xl:w-[75%]"
                        src="{{ Thumb::Crop(UPLOAD_PHOTO, $sodotochuc[0]['photo'], 1415, 725, 1) }}">
                </div>
            </div>
        @endif
        <div
            class="bg-center z-10 bg-no-repeat bg-cover w-full h-fit relative mt-10 flex flex-col justify-center xl:pb-4 pb-8">
            <div class="flex flex-col items-center justify-center md:pb-16 md:mt-10 lg:pt-0 mt-0 py-8 revealOnScroll history"
                data-animation="animate__fadeInUp">
                <h1 class="text-cmain8">Lịch sử hình thành </h1>
            </div>
            <div class="relative content-page-layout px-[100px]">
                <div class="history__owl owl-carousel owl-theme">
                    @foreach ($lichsuhinhthanh as $k => $v)
                        @if ($k % 2 == 0)
                            <div class="flex flex-col group relative z-[1] w-full rounded-md overflow-hidden revealOnScroll"
                                data-animation="animate__fadeInUp" data-timeout="{{ $k * 300 }}"><img
                                    src="{{ Thumb::Crop(UPLOAD_POST, $v['photo'], 340, 250, 1) }}"
                                    alt="{{ $v['ten' . $lang] }}"
                                    class="h-[250px] w-[400px] object-cover self-center shadow-lg shadow-prim-70/30 rounded-md md:order-first">
                                <div class="h-fit md:h-72 self-center text-center md:order-last md:mt-20">
                                    <div class="text-cmain text-3xl md:text-6xl font-semibold opacity-50">
                                        {{ $v['ten' . $lang] }}
                                    </div>
                                    <div class="text-xl md:text-3xl font-normal text-cmain6">
                                        {{ $v['mota' . $lang] }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="flex flex-col relative z-[1] w-full rounded-md overflow-hidden revealOnScroll"
                                data-animation="animate__fadeInUp" data-timeout="{{ $k * 200 }}"><img
                                    src="{{ Thumb::Crop(UPLOAD_POST, $v['photo'], 340, 250, 1) }}"
                                    alt="{{ $v['ten' . $lang] }}"
                                    class="h-[250px] w-[400px] object-cover self-center shadow-lg shadow-prim-70/30 rounded-md md:order-last">
                                <div
                                    class="h-fit md:h-72 self-center text-center md:order-first flex flex-col justify-end py-2">
                                    <div class="text-cmain text-3xl md:text-6xl font-semibold opacity-50">
                                        {{ $v['ten' . $lang] }}
                                    </div>
                                    <div class="text-xl md:text-3xl font-normal text-cmain6">
                                        {{ $v['mota' . $lang] }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

    @endsection
    <!--css thêm cho mỗi trang-->
    @push('css_page')
        <style>
            .us_info:before {
                height: 400px !important;
                width: 400px !important;
                /* background-image: url("/images/logo_white_large.png") !important */
            }

            .group-service:hover:after {
                opacity: 0.1;
                transition-duration: 300ms
            }

            .owl-dots {
                text-align: center !important;
            }

            .history>h1 {
                text-align: center;
                font-size: 42px;
                font-weight: 700;
                line-height: 110%;
                text-transform: uppercase;
            }

            .owl-theme .owl-dots .owl-dot.active span,
            .owl-theme .owl-dots .owl-dot:hover span {
                background: #076C40;
            }

            .owl-theme .owl-nav {
                margin-top: -30px !important;
            }
        </style>
    @endpush

    <!--js thêm cho mỗi trang-->
    @push('js_page')
        <script>
            if ($(".history__owl").exists()) {
                var owl_list_history = $('.history__owl');
                owl_list_history.owlCarousel({
                    autoplay: false,
                    margin: 20,
                    items: 5,
                    dots: true,
                    autoplayHoverPause: true,
                    autoplaySpeed: 3000,
                    autoplayTimeout: 2000,
                    smartSpeed: 3000,
                    //smartSpeed: 2000,
                    loop: false,
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
                            items: 3,
                            spaceBetween: 10,
                            nav: true,
                            navText: [
                                "<button class='arrow-left-product'><i class = 'fas fa-arrow-left'></i></button>",
                                "<button class='arrow-right-product'><i class='fas fa-arrow-right'></i></button>"
                            ]
                        }
                    }
                });
            }
        </script>
        <!-- Like Share -->
        <script>
            $('.video-item').click(function() {
                var id = $(this).attr('data-id');
                var name = $(this).attr('data-name');
                var video = '//www.youtube.com/embed/' + id;

                $('#show-video').find('iframe').attr('src', video);
                $('#show-name-video').text(name);
                $('.video-play').removeClass('opacity-0').addClass('opacity-100');
                $('.video-playing').removeClass('opacity-100').addClass('opacity-0');
                $(this).find('.video-play').removeClass('opacity-100').addClass('opacity-0');
                $(this).find('.video-playing').removeClass('opacity-0').addClass('opacity-100');
            });
        </script>

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
                "{{ (isset($row_detail['photo']))?url('/').'/'.UPLOAD_STATICPOST.$row_detail['photo']:'' }}"
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
