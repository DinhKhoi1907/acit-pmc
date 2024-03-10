@extends('desktop.master')

@section('element_detail', 'main_page_detail')

@section('center_detail', '')

@section('content')

    @php
        $giamoi = $row_detail['giamoi'] < $row_detail['gia'] ? $row_detail['giamoi'] : 0;
        $gia = $row_detail['gia'];
        $giakm = $row_detail['giakm'];
    @endphp

    @php
        //### phần trăm đánh giá
        if ($info_rating == null) {
            $info_rating = [];
        }
        $average_score = isset($info_rating['allrating']) && $info_rating['allrating'] > 0 ? round($info_rating['maxstar'] / $info_rating['allrating']) : 0;
        //max_star
    @endphp


@section('banner')
    @include('desktop.layouts.banner')
@endsection

<div class="py-5 md:py-16">
    {{-- <div class="content-page-layout">
        @if (isset($breadcrumbs))
            <nav class="w-full mb-5 hbreadcrumb" aria-label="breadcrumb">
                <div class="center-layout">
                    {!! $breadcrumbs !!}
                </div>
            </nav>
        @endif
    </div> --}}

    <div class="flex flex-wrap content-page-layout" id="page-product-detail">
        @if ($hinhanhsp && count($hinhanhsp) > 0)
            <div
                class="mb-3 lg:mb-0 relative top-8 md:top-5 md:left-5 z-[999] mt-5 md:mt-0 gallery-photo-thumb w-full md:w-[120px] px-5 lg:px-0">
                <div>
                    <div class="slick-product">
                        @foreach ($hinhanhsp as $k => $v)
                            <a class="block thumb-pro-detail {{ $k == 0 ? 'mz-thumb-selected' : '' }} himg"
                                data-zoom-id="Zoom-1"
                                data-image="{{ Thumb::Crop(UPLOAD_PRODUCT, $v['photo'], 800, 800, 1, $v['type']) }}"
                                href="{{ Thumb::Crop(UPLOAD_PRODUCT, $v['photo'], 800, 800, 1, $v['type']) }}"
                                title="{{ $v['ten' . $lang] }}">
                                <img src="{{ Thumb::Crop(UPLOAD_PRODUCT, $v['photo'], 120, 80, 1, $v['type']) }}"
                                    alt="{{ $v['ten' . $lang] }}" class="rounded-md w-[120px] h-[80px]">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <div class="relative w-full lg:w-[35%] overflow-hidden" id="gallery-photo-main">
            <div class="flex flex-col">
                <div class="w-full product_detail_album himg">
                    <a id="Zoom-1" class="MagicZoom "
                        data-options="zoomWidth:200px; zoomHeight:150px;zoomMode: magnifier;cssClass: mz-square"
                        href="{{ Thumb::Crop(UPLOAD_PRODUCT, $row_detail['photo'], 800, 800, 1, $row_detail['type']) }}"
                        title="{{ $row_detail['ten' . $lang] }}"><img
                            src="{{ Thumb::Crop(UPLOAD_PRODUCT, $row_detail['photo'], 800, 800, 1, $row_detail['type']) }}"
                            alt="{{ $row_detail['ten' . $lang] }}"></a>
                </div>
            </div>
        </div>

        <div class="//detail_product_sticky w-full lg:w-[55%] p-10 bor-none bg-cmain3 mt-6 md:mt-0">
            <div class="//detail__right">
                <div class="//home-tourhot-info">
                    <div>
                        <input class="hidden" id="id_product" value="{{ $row_detail['id'] }}" />
                        <h2 class="text-xl md:text-[32px] font-bold text-main">{{ $row_detail['ten' . $lang] }}</h2>
                        @if ($row_detail['mota' . $lang] != '')
                            <div class=" mota mt-3 leading-[140%] text-cmain2 content-main content-css">
                                {!! $row_detail['mota' . $lang] !!}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div
        class="flex flex-wrap mt-12 content-page-layout //bor-none rounded-none md:rounded-[20px] shadow-sm overflow-hidden relative">
        <div
            class="gap-5 px-5 py-6 border-0 border-b border-solid cursor-pointer lg:justify-start border-opacity-10 md:px-8 md:py-5 border-cmain2 //toggle-faq">
            <span
                class="px-4 py-2 text-base font-medium uppercase bg-main md:text-base text-white rounded-[10px] btn-product-toggle bg-cmain8 ">Thông
                tin chi tiết</span>
        </div>
        <div class="relative w-full px-[5%] py-3 mt-5 lg:px-8">
            <div class="content-main content-css leading-[160%] product-toggle-item relative visible">
                {!! $row_detail['motangan' . $lang] !!}
            </div>
        </div>
    </div>



    @if ($products)
        <div class="mt-0 md:mt-8 bor-none">
            <div class="p-0 bg-white content-page-layout section-product-nb">
                <div class="dichvu-title">
                    <h1 class="pb-8 ">
                        Các sản phẩm khác
                    </h1>
                </div>
                <div class="products__owl owl-carousel owl-theme">
                    @foreach ($products as $k => $v)
                        <x-product-item-other :key="$k" :item="$v" class="" />
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@endsection



<!--css thêm cho mỗi trang-->

@push('css_page')
<link rel="stylesheet" href="{{ asset('css/magiczoomplus.css') }} ">

<link rel="stylesheet" href="{{ asset('css/product_detail.css') }}">

<link rel="stylesheet" href="{{ asset('plugins/slick/slick.css') }}">

<link rel="stylesheet" href="{{ asset('plugins/slick/slick-theme.css') }}">

<link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }} ">

<link rel="stylesheet" href="{{ asset('css/popup.css') }}">

<style>
    .slick-product .slick-slide img {
        display: inline-block !important;
        border-radius: 0;
        /* border: 1px solid #666 !important; */
        opacity: 1;
    }

    #page-product-detail .slick-product .mz-thumb-selected img {
        opacity: 1;
        border: 1px solid rgba(102, 102, 102, 0.4) !important;
    }

    .faq-toggle-active i {
        transform: rotate(180deg);
    }

    .error-message {
        color: red
    }
</style>
@endpush


<!--js thêm cho mỗi trang-->

@push('js_page')
<script src="{{ asset('plugins/slick/slick.js') }}" charset="utf-8"></script>

<script src="{{ asset('js/magiczoomplus.js') }}"></script>

<script>
    $('.toggle-faq').click(function() {
        var id = $(this).attr('data-id');
        $('#show-faq-' + id).slideToggle();

        if (!$('#box-faq-' + id).hasClass('faq-toggle-active')) {
            $('#box-faq-' + id).addClass('faq-toggle-active');
        } else {
            $('#box-faq-' + id).removeClass('faq-toggle-active')
        }
    });
</script>

<script>
    $(window).on('load', function() {
        $('.btn-toggle').eq(0).trigger('click');
    });

    $('.btn-toggle').click(function() {

        var e_id = $(this).attr('data-id');
        if (!$(e_id).hasClass('box-toggle-active')) {

            $('.box-toggle').removeClass('box-toggle-active');
            $('.btn-toggle').removeClass('btn-toggle-active');

            $(e_id).addClass('box-toggle-active');
            $(this).addClass('btn-toggle-active');
        } else {

            $(e_id).removeClass('box-toggle-active');
            $(this).removeClass('btn-toggle-active');
        }
    });


    $('body').on('click', '.btn-tab', function() {
        var div = $(this).attr('data-id');

        $('html, body').animate({
            scrollTop: $(div).offset().top
        }, 2000);
    });
</script>

<script>
    // var owl = $('.slick-product');
    // owl.owlCarousel({
    // 	autoplay:true,
    // 	margin: 10,
    // 	dots: false,
    // 	autoplayHoverPause:true,
    // 	autoplaySpeed: 1500,
    // 	nav: false,
    // 	// navText: ["<span class='slide-nav-right'><img src='img/arrow1.png'></span>","<span class='slide-nav-left'><img src='img/arrow1.png'></span>"],
    // 	loop: true,
    // 	onInitialized: function() {
    // 		//$('.tintuc__owl').append('<a href="tin-tuc" class="btn-view-product">Xem tất cả</a>');
    // 	},
    // 	responsive: {
    // 		0: {
    // 			items: 4,
    // 			dots: false,
    // 			nav: false,
    // 		},
    // 		645: {
    // 			items: 5,
    // 			dots: false,
    // 			nav: false,
    // 		},
    // 		820: {
    // 			items: 6,
    // 			dots: false,
    // 			nav: false,
    // 		},
    // 		1025: {
    // 			items: 5
    // 		}
    // 	}
    // });



    $('.slick-product').slick({
        infinite: true,
        slidesToShow: 4,
        autoplay: true,
        arrows: false,
        vertical: true,
        verticalSwiping: true,
        infinite: true,
        speed: 3000,
        slidesToScroll: 2,
        autoplaySpeed: 3000,
        responsive: [{
                breakpoint: 1025,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 2,
                    // vertical:true,
                    // verticalSwiping:true,
                }
            },
            {
                breakpoint: 640,
                settings: {
                    slidesToShow: 8,
                    slidesToScroll: 1,
                    vertical: false,
                    verticalSwiping: false,
                }
            },
            {
                breakpoint: 420,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    vertical: false,
                    verticalSwiping: false,
                }
            }
        ]
    });
</script>

<!-- Swiper JS -->
{{-- <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>

    <script>
      var swiper = new Swiper(".mySwiper", {
        direction: "vertical",
		preventClicks : false,
		slidesPerView : 6,
		spaceBetween: 15,
		breakpoints: {
			0: {
				slidesPerView: 4,
				spaceBetween: 8,
				direction: "horizontal",
			},
			500: {
				slidesPerView: 5,
				spaceBetween: 8,
				direction: "horizontal",
			},
			815: {
				slidesPerView: 8,
				spaceBetween: 8,
				direction: "horizontal",
			},
			1024: {
				slidesPerView: 8,
				spaceBetween: 8,
				direction: "horizontal",
			},
			1025: {
				slidesPerView: 6,
				spaceBetween: 15,
				direction: "vertical",
			}
		},
      });
    </script> --}}

<script>
    $(window).on('load', function() {

        var e_content_show = $('.product_active_tab').attr('data-id');

        $('.product-detail-content-item').removeClass('active_content');

        $(e_content_show).addClass('active_content');



        if ($("#gallery-photo-show-main").exists()) {

            $('.gallery-photo-item').removeClass('gallery-photo-show');

            $('#gallery-photo-show-main').addClass('gallery-photo-show');

        }

    });





    $('.product-detail-tab').click(function() {

        var e_content_show = $(this).attr('data-id');

        $('.product-detail-content-item').removeClass('active_content');

        $(e_content_show).addClass('active_content');



        $('.product-detail-tab').removeClass('product_active_tab');

        $(this).addClass('product_active_tab');

    });





    $('.detail__product_shop').click(function() {

        $('.product_cuahang_main').addClass('product_cuahang_active');

    });



    $('.product_cuahang_close').click(function() {

        $('.product_cuahang_main').removeClass('product_cuahang_active');

    });
</script>



<script>
    // $('.slick-product-one').slick({

    //   slidesToShow: 1,

    //   slidesToScroll: 1,

    //   arrows: false,

    //   fade: true,

    //   asNavFor: '.slick-product-list'

    // });



    // $('.slick-product-list').slick({

    //   slidesToShow: 6,

    //   slidesToScroll: 1,

    //   asNavFor: '.slick-product-one',

    //   dots: false,

    //   focusOnSelect: true,

    //   vertical:true,

    //   verticalSwiping:true,

    //   infinite:false,

    //   responsive: [

    //   	{

    //       breakpoint: 1025,

    //       settings: {

    //         slidesToShow: 8,

    //         slidesToScroll: 1,

    //         infinite: false,

    //         dots: false,

    //         vertical:false,

    //   		verticalSwiping:false,

    //       }

    //     },

    //     {

    //       breakpoint: 801,

    //       settings: {

    //         slidesToShow: 6,

    //         slidesToScroll: 1,

    //         vertical:false,

    //         verticalSwiping:false,

    //       }

    //     },

    //     {

    //       breakpoint: 361,

    //       settings: {

    //         slidesToShow: 4,

    //         slidesToScroll: 1,

    //         vertical:false,

    //         verticalSwiping:false,

    //       }

    //     }

    //   ]

    // });
</script>



{{-- <script src="{{ asset('js/product.js') }}"></script> --}}
@endpush





@push('strucdata')
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v14.0"
    nonce="JS1208QC"></script>

<script type="application/ld+json">

        {

            "@context": "https://schema.org/",

            "@type": "Product",

            "name": "{!!$row_detail['ten'.$lang]!!}",

            "image":

            [

            	"{{ (isset($row_detail['photo']))?url('/').'/'.UPLOAD_PRODUCT.$row_detail['photo']:'' }}"

            ],

            "description": "{{SEOMeta::getDescription()}}",

            "sku":"SP0{{$row_detail['id']}}",

            "mpn": "925872",

            "brand":

            {

                "@type": "Brand",

                "name": "{{(isset($pro_list) && $pro_list['ten'.$lang] != '') ? $pro_list['ten'.$lang] : $setting['ten'.$lang]}}"

            },

            "review":

            {

                "@type": "Review",

                "reviewRating":

                {

                    "@type": "Rating",

                    "ratingValue": "5",

                    "bestRating": "5"

                },

                "author":

                {

                    "@type": "Person",

                    "name": "{!!$setting['ten'.$lang]!!}"

                }

            },

            "aggregateRating":

            {

                "@type": "AggregateRating",

                "ratingValue": "4.4",

                "reviewCount": "89"

            },

            "offers":

            {

                "@type": "Offer",

                "url": "{{url()->current()}}",

                "priceCurrency": "VND",

                "price": "{{($row_detail['giamoi']>0) ? $row_detail['giamoi'] : $row_detail['gia']}}",

                "priceValidUntil": "2020-11-05",

                "itemCondition": "https://schema.org/NewCondition",

                "availability": "https://schema.org/InStock",

                "seller":

                {

                    "@type": "Organization",

                    "name": "Executive Objects"

                }

            }

        }

    </script>
@endpush
