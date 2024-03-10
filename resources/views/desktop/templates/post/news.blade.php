@extends('desktop.master')

@section('element_detail', 'main_page_detail fix_detail_menu')
@section('page_detail', 'page_detail')
{{-- @section('menu', $is_fix_menu) --}}


@section('banner')
    @include('desktop.layouts.banner')
@endsection

@section('content')
    <div class="bg-cmain3 ">
        <div class="bor-none content-page-layout lg:-mt-[100px] -mt-[120px]">
            <div class="lg:py-0">
                @if (isset($posts) && count($posts) > 0 && $posts->currentPage() == 1)
                    <div class="pt-8 flex flex-wrap md:mt-[30px] mt-0 sm:mt-0 md:mb-8 sm:mb-4 news shadow-lg mb-4" id="news_hot">
                        <div class="xl:flex-1 w-full lg:w-[600px] h-[400px] zoom-image revealOnScroll"
                            data-animation="animate__backInLeft" data-timeout="200" style="position: relative;">
                            <a href="{{ $posts[0]['tenkhongdau' . $lang] }}"
                                target="" class="block relative h-full pb-[58.83%] overflow-hidden">
                                <img class="absolute w-full h-full left-0 top-0 object-cover lazy loaded"
                                    src="{{ Thumb::Crop(UPLOAD_POST, $posts[0]['photo'], 600, 400, 1) }}"
                                    data-src="https://acit.com.vn/upload/news/thumb_843x0/15.jpg" alt=""
                                    data-was-processed="true" width="600" height="400">
                            </a>
                        </div>
                        <div class="lg:w-[calc(100%-600px)] w-full xl:pl-[40px] xl:px-[40px] px-[20px] lg:pt-[30px] lg:py-[10px] py-[18px] news-right revealOnScroll"
                            data-animation="animate__backInRight" data-timeout="200" style="position: relative;">
                            <div class="relative">
                                <span class="time font-medium">
                                    {{ date('d/m/Y', $posts[0]['ngaytao']) }}
                                </span>
                                <a href="{{ $posts[0]['tenkhongdau' . $lang] }}"
                                    target=""
                                    class="block mt-[11px] xl:text-[28px] lg:text-[24px] text-[18px] font-semibold mb-[12px] !leading-[1.43]">
                                    {{ $posts[0]['ten' . $lang] }}
                                </a>
                                <p class="desc lg:text-[16px] text-justify text-split-4 xl:pr-[40px] !leading-[1.5625]">
                                    {{ $posts[0]['mota' . $lang] }}
                                </p>
                                <a href="{{ $posts[0]['tenkhongdau' . $lang] }}"
                                    target=""
                                    class="mt-[10px] btn-gradient inline-block md:px-[30px] px-[10px] md:py-[9px] rounded-[50px] md:text-[16px] font-semibold uppercase opacity-90 text-white hover:opacity-100">Xem
                                    chi tiết</a>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="list-news lg:py-8">
                    @if (isset($posts) && count($posts) > 0)
                        <div class="flex flex-wrap lg:-mx-20px -mx-10px gap-6">
                            @foreach ($posts as $k => $v)
                                @if ($k == 0 && $posts->currentPage() == 1)
                                @else
                                    <div class="item-news lg:px-20px px-10px w-full lg:w-[calc(100%/3-16px)] md:w-[calc(100%/2-12px)] lg:mb-65px mb-30px rounded-t-xl revealOnScroll zoom-image shadow-lg"
                                        style="position: relative;" data-animation="animate__fadeInUp"
                                        data-timeout="{{ ($k + 1) * 200 }}">
                                        <a href="{{ $v['tenkhongdau' . $lang] }}" target=""
                                            class="relative block pb-[61.85567%] overflow-hidden">
                                            <img class="absolute left-0 top-0 w-full h-full object-cover lazy loaded rounded-t-xl"
                                                src="{{ Thumb::Crop(UPLOAD_POST, $v['photo'], 368, 228, 1) }}" width="368" height="228"
                                                alt="">
                                        </a>
                                        <div class="news-i lg:py-[25px] lg:px-[25px] py-[15px] px-[10px]">
                                            <div class="relative">
                                                <span class="font-medium lg:text-16px">
                                                    {{ date('d/m/Y', $v['ngaytao']) }}
                                                </span>
                                                <h3 class="block lg:text-[18px] text-[16px] font-bold mb-[14px] mt-0">
                                                    <a href="{{ $v['tenkhongdau' . $lang] }}" target=""
                                                        class="text-split lg:h-[78px] block">
                                                        <span class="text-black">{{ $v['mota' . $lang] }}</span>
                                                    </a>
                                                </h3>

                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        @if (!is_array($posts))
                            <div class="row">
                                <div class="col-sm-12 dev-center dev-paginator">{{ $posts->links() }}</div>
                            </div>
                        @endif
                    @else
                        <div class="alert-data" role="alert">
                            <strong><i
                                    class="mr-1 far fa-exclamation-circle"></i>{{ __('Không tìm thấy kết quả') }}!</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

<!--css thêm cho mỗi trang-->
@push('css_page')
    <style>
        .list-news .news-i {
            position: relative;
        }

        .list-news .item-news img {
            transition: 0.4s ease-in-out;
        }

        .list-news .item-news:hover {
            background: linear-gradient(180deg, #39B54A 2.38%, rgba(0, 68, 107, 0.00) 23.47%), linear-gradient(107deg, #076C40 4.36%, rgba(57, 181, 74, 0.00) 100%);
        }

        .list-news .item-news:hover span {
            color: white;
        }

        .news-right:before {
            content: "";
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            background: linear-gradient(267.64deg, #39B54A -.24%, rgba(0, 43, 96, 0) -.23%, #076C40 100.49%);
            opacity: .9;
        }

        .btn-gradient {
            background: linear-gradient(267.59deg, #18a85e 12.7%, #17535c 100%);
            transition: .3s all;
        }

        .news a {
            color: white;
        }
    </style>
@endpush

<!--js thêm cho mỗi trang-->
@push('js_page')
@endpush

@push('strucdata')
    @include('desktop.layouts.strucdata')
@endpush
