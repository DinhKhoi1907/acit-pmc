@extends('desktop.master')

@section('element_detail', 'main_page_detail fix_detail_menu')

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

        // $phantram_onestar = (isset($info_rating['allrating']) && $info_rating['allrating']>0) ? round(($info_rating['onestar'] * 100) / $info_rating['allrating']) : 0;

        // $phantram_twostar = (isset($info_rating['allrating']) && $info_rating['allrating']>0) ?  round(($info_rating['twostar'] * 100) / $info_rating['allrating']) : 0;

        // $phantram_threestar = (isset($info_rating['allrating']) && $info_rating['allrating']>0) ?  round(($info_rating['threestar'] * 100) / $info_rating['allrating']) : 0;

        // $phantram_fourstar = (isset($info_rating['allrating']) && $info_rating['allrating']>0) ?  round(($info_rating['fourstar'] * 100) / $info_rating['allrating']) : 0;

        // $phantram_fivestar = (isset($info_rating['allrating']) && $info_rating['allrating']>0) ?  round(($info_rating['fivestar'] * 100) / $info_rating['allrating']) : 0;

        $average_score = isset($info_rating['allrating']) && $info_rating['allrating'] > 0 ? round($info_rating['maxstar'] / $info_rating['allrating']) : 0;
        //max_star
    @endphp


@section('banner')
    {{-- @include('desktop.layouts.banner') --}}
@endsection

<div class="py-16 bor-none">
    @if (isset($breadcrumbs))
    <div class="content-layout bor-none">
        <nav class="w-full mb-5 hbreadcrumb" aria-label="breadcrumb">
            <div class="center-layout">
                {!! $breadcrumbs !!}
            </div>
        </nav>
    </div>
    @endif
    <div class="flex flex-wrap px-8 py-8 bg-white rounded-md content-layout bor-none shadow-shadow3"
        id="page-product-detail">
        <div class="relative w-full lg:w-[55%] //detail__left" id="gallery-photo-main">
            <div class="flex flex-col">
                @if (isset($gallery_color) && $gallery_color)
                    @foreach ($gallery_color as $g => $gal)
                        <div id="gallery-photo-show-{{ $g }}" class="gallery-photo-item">
                            @php
                                $galleries = $gal;
                            @endphp

                            @if (isset($galleries) && count($galleries) > 0)
                                <div class="w-full product_detail_album">
                                    <a id="Zoom-1" class="MagicZoom"
                                        data-options="zoomWidth:400px; zoomHeight:400px;zoomMode: magnifier;cssClass: mz-square"
                                        href="{{ Thumb::Crop(UPLOAD_PRODUCT, $galleries[0]['photo'], 870, 828, 1, $galleries[0]['com']) }}"
                                        title="{{ $galleries[0]['ten' . $lang] }}"><img
                                            src="{{ Thumb::Crop(UPLOAD_PRODUCT, $galleries[0]['photo'], 870, 828, 1, $galleries[0]['com']) }}"
                                            alt="{{ $galleries[0]['ten' . $lang] }}" class=""></a>
                                </div>
                            @else
                                <div class="w-full product_detail_album">
                                    <a id="Zoom-1" class="MagicZoom"
                                        data-options="zoomWidth:400px; zoomHeight:400px;zoomMode: magnifier;cssClass: mz-square"
                                        href="{{ Thumb::Crop(UPLOAD_PRODUCT, $row_detail['photo'], 870, 828, 1, $row_detail['type']) }}"
                                        title="{{ $row_detail['ten' . $lang] }}"><img
                                            src="{{ Thumb::Crop(UPLOAD_PRODUCT, $row_detail['photo'], 870, 828, 1, $row_detail['type']) }}"
                                            alt="{{ $row_detail['ten' . $lang] }}" class=""></a>
                                </div>
                            @endif

                            @if (isset($galleries) && count($galleries) > 0)
                                <div class="w-full mb-3 lg:mb-0">
                                    <div>
                                        <div class="pt-4 slick-product">
                                            @foreach ($galleries as $v)
                                                <a class="block thumb-pro-detail " data-zoom-id="Zoom-1"
                                                    data-image="{{ Thumb::Crop(UPLOAD_PRODUCT, $v['photo'], 870, 828, 1, $v['type']) }}"
                                                    href="{{ Thumb::Crop(UPLOAD_PRODUCT, $v['photo'], 870, 828, 1, $v['type']) }}"
                                                    title="{{ $v['ten' . $lang] }}">
                                                    <img src="{{ Thumb::Crop(UPLOAD_PRODUCT, $v['photo'], 870, 828, 1, $v['type']) }}"
                                                        alt="{{ $v['ten' . $lang] }}" class="rounded-md">
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="w-full mb-5 product_detail_album himg">
                        <a id="Zoom-1" class="overflow-hidden MagicZoom bg-cmain4 "
                            data-options="zoomWidth:200px; zoomHeight:200px;zoomMode: magnifier;cssClass: mz-square"
                            href="{{ Thumb::Crop(UPLOAD_PRODUCT, $row_detail['photo'], 870, 828, 1, $row_detail['type']) }}"
                            title="{{ $row_detail['ten' . $lang] }}"><img
                                src="{{ Thumb::Crop(UPLOAD_PRODUCT, $row_detail['photo'], 870, 828, 1, $row_detail['type']) }}"
                                alt="{{ $row_detail['ten' . $lang] }}" class=""></a>
                    </div>
                    @if ($hinhanhsp)
                        @if (count($hinhanhsp) > 0)
                            <div class="w-full mb-3 lg:mb-0">
                                <div>
                                    <div class="slick-product">
                                        <a class="block text-center bg-cmain4 thumb-pro-detail himg"
                                            data-zoom-id="Zoom-1"
                                            href="{{ Thumb::Crop(UPLOAD_PRODUCT, $row_detail['photo'], 870, 828, 1, $row_detail['type']) }}"
                                            data-image="{{ Thumb::Crop(UPLOAD_PRODUCT, $row_detail['photo'], 870, 828, 1, $row_detail['type']) }}"
                                            title="{{ $row_detail['ten' . $lang] }}"><img
                                                src="{{ Thumb::Crop(UPLOAD_PRODUCT, $row_detail['photo'], 870, 828, 1, $row_detail['type']) }}"
                                                alt="{{ $row_detail['ten' . $lang] }}" width="84" height="84"></a>
                                        @php
                                            if (config('config_all.data_demo')) {
                                                $arr_tmp = [];
                                                for ($i = 0; $i < 10; $i++) {
                                                    $arr_tmp = array_merge($hinhanhsp, $arr_tmp);
                                                }
                                                $hinhanhsp = $arr_tmp;
                                            }
                                        @endphp

                                        @foreach ($hinhanhsp as $v)
									<a class="block text-center bg-cmain4 thumb-pro-detail himg" data-zoom-id="Zoom-1" data-image="{{ Thumb::Crop(UPLOAD_PRODUCT, $v['photo'], 870, 828, 1, $v['type']) }}" href="{{ Thumb::Crop(UPLOAD_PRODUCT, $v['photo'], 870, 828, 1, $v['type']) }}" title="{{ $row_detail['ten' . $lang] }}">
										<img src="{{ Thumb::Crop(UPLOAD_PRODUCT, $v['photo'], 870, 828, 1, $v['type']) }}" alt="{{ $row_detail['ten' . $lang] }}" class="block rounded-md" width="84" height="84">
									</a> @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @endif
            </div>
        </div>

        <div class="//detail_product_sticky w-full lg:w-[45%] pl-0 lg:pl-8 mt-8 lg:mt-0">
            <div class="//detail__right">

                <div class="//home-tourhot-info">
                    <div>
                        <h2 class="mb-2 text-left">
                            <a href="{{ $row_detail['tenkhongdau' . $lang] }}"
                                class="mb-3 text-3xl md:text-[36px] font-semibold uppercase text-cmain leading-[140%]">{{ $row_detail['ten' . $lang] }}</a>
                        </h2>

                        @if ($row_detail['masp'] != '')
                            <div
                                class="flex items-center justify-between border-0 border-b border-solid border-[rgba(30,30,30,10%)] pb-2 mb-3 ">
                                <p class="text-base text-cmain opacity-80">{{ __('Mã sản phẩm') }}: <span
                                        class="">{{ $row_detail['masp'] }}</span></p>
                                {{-- <span class="text-base text-cmain2 font-meidum">{{($row_detail['hethang']) ? __('Hết hàng') : __('Còn hàng')}}</span> --}}
                            </div>
                        @endif

                        <div class="">
                            <div class="flex items-center justify-between">
                                <div class="flex flex-wrap items-center align-middle">
                                    @if ($giamoi < $gia && $giamoi > 0)
                                        <p
                                            class="text-red-600 font-bold text-2xl md:text-[26px] detail__price--new{{ $row_detail['id'] }}">
                                            {!! $giamoi < $gia ? Helper::Format_Money($giamoi) : Helper::Format_Money($gia) !!}</p>
                                    @endif

                                    @if ($giamoi == 0)
                                        <p class="home-tourhot-olddefine"><span
                                                class="text-2xl font-bold detail__price--old{{ $row_detail['id'] }}">{!! Helper::Format_Money($gia) !!}</span>
                                        </p>
                                    @else
                                        <p class="ml-5 home-tourhot-olddefine"><span
                                                class="ml-3 line-through text-cmain opacity-50 text-base detail__price--old{{ $row_detail['id'] }}">{!! Helper::Format_Money($gia) !!}</span>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if (!empty($size))
                            <div class="pb-3 mt-8 mb-5">
                                <div class="mt-4 detail__properties detail__properties__size">
                                    <div class="flex items-center mb-3 text-base font-bold text-cmain"><i class="mr-2 fal fa-hand-point-right"></i>{{ __('Hình thức học') }}:</div>
                                    <div class="flex flex-wrap items-center gap-3" id="product_detail_size">
                                        @foreach ($size as $key => $value)
                                            <a class="size-pro-detail text-decoration-none mr-1 {{ $key == 0 ? 'active' : '' }} {{ $key == 0 && count($size) > 1 ? 'SizefirstOption' : '' }}"
                                                data-id="{{ $row_detail['id'] }}">
                                                <input type="radio" value="{{ $value['id'] }}"
                                                    class="detail__properties-items js-select-variant"
                                                    name="size-pro-detail" {{ $key == 0 ? 'checked' : '' }}>
                                                {{ $value['ten' . $lang] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($row_detail['motangan' . $lang] != '')
                            <div
                                class="mt-2 mb-6 text-sm leading-7 text-gray-500 lg:leading-6 content-main content-css">
                                {!! $row_detail['motangan' . $lang] !!}</div>
                        @endif


                        @if ($row_detail['hethang'] != 1)
                            <div class="flex items-center justify-between pb-3 mt-2 mb-2 fixbuy">

                                <div class="detail__button__grid w-[150px] {{ $is_soluong ? 'fix_button_cart btn-cart-grid' : 'btn-cart-hidden' }}"
                                    id="show_btn_conhang">

                                    <div class="py-0 detail__properties detail__properties_quantity"
                                        id="show_soluong_khung">


                                        <div class="flex bg-white quantity">

                                            <button type="button"
                                                class="quantity__button quantity__button--minus js-change-quantity"
                                                data-action="minus"></button>

                                            <input type="text" id="quantity" value="1">

                                            <button type="button"
                                                class="quantity__button quantity__button--plus js-change-quantity"
                                                data-action="plus"></button>

                                        </div>

                                    </div>
                                </div>
                                <div class="detail__button__grid w-[calc(100%-150px)] pl-3 {{ $is_soluong ? 'fix_button_cart btn-cart-grid' : 'btn-cart-hidden' }}"
                                    id="show_btn_conhang">
                                    <a class="flex items-center justify-center text-base font-medium text-white js-action-cart bg-cmain6 w-full h-[40px] rounded-[6px] transition-all duration-500 group-hover:bg-white group-hover:text-cmain cursor-pointer border border-solid border-cmain6 hover:bg-white hover:text-cmain"
                                        data-id="{{ $row_detail['id'] }}"
                                        data-action="addnow">{{ __('Đặt hàng') }}</a>
                                </div>

                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap px-8 py-10 mt-12 bg-white rounded-md content-layout bor-none shadow-shadow3"
        id="box-faq-chitiet">
        <div class="flex items-center justify-center w-full cursor-pointer //toggle-faq" data-id="chitiet">
            <span
                class="home-title">{{ __('Thông tin chi tiết') }}</span>
            {{-- <span><i class="text-2xl fal fa-chevron-down text-cmain"></i></span> --}}
        </div>
        <div id="show-faq-chitiet" class="mt-5 content-main content-css">
            {!! $row_detail['noidung' . $lang] !!}
        </div>
    </div>

    @if ($products)
        <div class="mt-12">
            <div class="p-8 bg-white rounded-md content-layout shadow-shadow3">
                <p class="home-title">Sản phẩm khác</p>

                @if(count($products)>3)
                <div class="flex flex-wrap gap-x-[20px] sm:gap-x-[30px] md:gap-[50px] gap-y-[60px] justify-center">

                    @foreach ($products as $k => $v)
                    <x-product-item :key="$k" :item="$v" class="w-[calc(100%/2-10px)] sm:w-[calc(100%/2-15px)] md:w-[calc(100%/3-34px)] lg:w-[calc(100%/4-37.5px)]"/>

                        @if (config('config_all.data_demo'))
                        <x-product-item :key="$k" :item="$v" class="w-[calc(100%/2-10px)] sm:w-[calc(100%/2-15px)] md:w-[calc(100%/3-34px)] lg:w-[calc(100%/4-37.5px)]"/>
                        <x-product-item :key="$k" :item="$v" class="w-[calc(100%/2-10px)] sm:w-[calc(100%/2-15px)] md:w-[calc(100%/3-34px)] lg:w-[calc(100%/4-37.5px)]"/>
                        @endif
                    @endforeach

                </div>
                @else
                <div class="flex flex-wrap mt-12 gap-x-[30px] gap-y-14">

                    @foreach($products as $k=>$v)

                        <x-product-item :key="$k" :item="$v" class="w-[calc(100%/3-20px)]"/>

                        @if (config('config_all.data_demo'))
                        <x-product-item :key="$k" :item="$v" class="w-[calc(100%/3-20px)]"/>
                        <x-product-item :key="$k" :item="$v" class="w-[calc(100%/3-20px)]"/>
                        @endif

                    @endforeach

                </div>
                @endif

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

<style>
    .slick-product .slick-slide img {
        display: inline-block !important;
        width: 100%;
        border-radius: 0px;
        padding: 0 5px;
        background: #fff;
    }

    .faq-toggle-active i {
        transform: rotate(180deg);
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
    $('.slick-product').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: false,
        //vertical:true,
        //verticalSwiping:true,
        responsive: [{
                breakpoint: 1025,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    // vertical:true,
                    // verticalSwiping:true,
                }
            },
            {
                breakpoint: 640,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    // vertical:false,
                    // verticalSwiping:false,
                }
            },
            {
                breakpoint: 420,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    // vertical:false,
                    // verticalSwiping:false,
                }
            }
        ]
    });
</script>

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
