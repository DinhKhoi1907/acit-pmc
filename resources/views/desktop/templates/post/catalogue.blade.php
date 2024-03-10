@extends('desktop.master')

@section('element_detail', 'main_page_detail fix_detail_menu')
@section('page_detail', 'page_detail')
@section('menu', $is_fix_menu)


@section('banner')
    @include('desktop.layouts.banner')
@endsection

@section('content')
    <div class="bg-cmain3 ">
        <div class="bor-none content-page-layout -mt-10 lg:-mt-[100px] md:mt-0">
            <div class="lg:py-0">
                <div class="list-news lg:py-8">
                    @if (isset($posts) && count($posts) > 0)
                        <div class="flex flex-wrap lg:-mx-20px -mx-10px gap-6">
                            @foreach ($posts as $k => $v)
                                <div class="item-news lg:px-20px px-10px w-full lg:w-[calc(100%/3-16px)] md:w-[calc(100%/2-12px)] lg:mb-65px mb-30px rounded-t-xl revealOnScroll zoom-image shadow-lg"
                                    style="position: relative;" data-animation="animate__fadeInUp"
                                    data-timeout="{{ ($k + 1) * 200 }}">
                                    <a href="public/upload/file/{{ $v['taptin'] }}" target="_blank"
                                        class="relative block pb-[61.85567%] overflow-hidden">
                                        <img class="absolute left-0 top-0 w-full h-full object-cover lazy loaded rounded-t-xl"
                                            src="{{ Thumb::Crop(UPLOAD_POST, $v['photo'], 368, 228, 1) }}" width="368"
                                            height="228" alt="">
                                    </a>
                                    <div class="news-i lg:py-[25px] lg:px-[25px] py-[15px] px-[10px]">
                                        <div class="relative">
                                            <span class="font-medium lg:text-16px">
                                                FILE
                                            </span>
                                            <h3 class="block lg:text-[18px] text-[16px] font-bold mb-[14px] mt-0">
                                                <a href="public/upload/file/{{ $v['taptin'] }}" target="_blank"
                                                    class="text-split block">
                                                    <span class="text-black">{{ $v['ten' . $lang] }}</span>
                                                </a>
                                            </h3>

                                        </div>
                                    </div>
                                </div>
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
