@extends('desktop.master')

@section('element_detail', 'main_page_detail fix_detail_menu')
@section('page_detail', 'page_detail')
{{-- @section('menu', $is_fix_menu) --}}


@section('banner')
    @include('desktop.layouts.banner')
@endsection

@section('content')
    <div class="content-page-layout">
        <div class="overflow-hidden bg-white mb-5">
            @if (count($posts) > 0)
                @foreach ($posts as $k => $v)
                    @if ($k % 2 == 0)
                        <div class="bg-center bg-cover bg-no-repeat revealOnScroll" data-animation="animate__backInLeft"
                            data-timeout="300">
                            <div class="container flex md:flex-row flex-col gap-y-4 pt-6 pb-6 md:pt-15 md:pb-25">
                                <div class="self-end md:-mb-8 z-10 md:px-0 px-4 md:-mr-20">
                                    <div
                                        class="text-[100px] md:text-[150px] italic font-semibold opacity-50 relative z-10 text-cmain8">
                                        {{ $k > 9 ? $k : '0' . $k + 1 }}
                                    </div>
                                    <div
                                        class="bg-[#ebf7ec] flex flex-col gap-y-4 px-6 py-4 w-fit rounded-md -mt-10 shadow-xl cursor-pointer popup-trigger">
                                        <span class="text-xl md:text-3xl font-semibold">{{ $v['ten' . $lang] }}</span><span
                                            class="md:text-2xl font-normal text-justify text-split-6" title="Xem thêm">
                                            {!! $v['noidung' . $lang] !!}
                                        </span>
                                    </div>
                                </div><img loading="lazy" src="{{ Thumb::Crop(UPLOAD_POST, $v['photo'], 672, 518, 1) }}"
                                    width="672" height="518" alt="/"
                                    class="w-full md:w-3/5 aspect-img object-cover flex-none shadow-2xl rounded-sm order-last">
                            </div>
                        </div>
                    @else
                        <div class="lg:pt-24 bg-center bg-cover bg-no-repeat revealOnScroll"
                            data-animation="animate__backInRight" data-timeout="300">
                            <div class="container flex md:flex-row flex-col gap-y-4 pt-6 pb-6 md:pt-15 md:pb-25">
                                <div class="self-end md:-mb-8 z-10 md:px-0 px-4  md:-ml-20">
                                    <div
                                        class="text-[100px] md:text-[150px] italic font-semibold opacity-50 relative z-10 text-right text-cmain8">
                                        {{ $k > 9 ? $k : '0' . $k + 1 }}
                                    </div>
                                    <div
                                        class="bg-[#ebf7ec] flex flex-col gap-y-4 px-6 py-4 w-fit rounded-md -mt-10 shadow-xl cursor-pointer popup-trigger">
                                        <span class="text-xl md:text-3xl font-semibold">{{ $v['ten' . $lang] }}</span>
                                        <span class="md:text-2xl font-normal text-justify text-split-6" title="Xem thêm">
                                            {!! $v['noidung' . $lang] !!}
                                        </span>
                                    </div>
                                </div> <img loading="lazy" src="{{ Thumb::Crop(UPLOAD_POST, $v['photo'], 672, 518, 1) }}"
                                    width="672" height="518" alt="/" alt="/"
                                    class="w-full md:w-3/5 aspect-img object-cover flex-none shadow-2xl rounded-sm order-first">
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="alert-data" role="alert">
                    <strong><i class="mr-1 far fa-exclamation-circle"></i>{{ __('Không tìm thấy kết quả') }}!</strong>
                </div>
            @endif
        </div>
    </div>
    <div class="overlay"></div>
    <div id="popup-container" class="popup-container">
    </div>
@endsection

<!--css thêm cho mỗi trang-->
@push('css_page')
    <style>
        .self-end {
            align-self: flex-end;
        }

        .aspect-img {
            aspect-ratio: 3/2;
        }

        .popup-container {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            z-index: 9999;
            max-height: 80vh;
            overflow-y: auto;
        }

        .popup-content {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            color: black;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        body.no-scroll {
            overflow: hidden;
        }

        @media (max-width: 600px) {
            .popup-container {
                width: 90%;
            }

            .container img {
                height: 300px;
            }

            .container .text-\[200px\] {
                font-size: 150px;
            }
        }
    </style>
@endpush

<!--js thêm cho mỗi trang-->
@push('js_page')
    <script>
        $(document).ready(function() {
            var $popupContainer = $('#popup-container');
            var overlay = $('.overlay');
            var isPopupOpen = false;

            function showPopup(content) {
                $popupContainer.html(content).fadeIn();
                overlay.show();
                isPopupOpen = true;
                $('body').addClass('no-scroll');
                if (window.innerWidth > 768) {
                    $('#menu').hide();
                }

            }

            function hidePopup() {
                $popupContainer.fadeOut();
                overlay.hide();
                isPopupOpen = false;
                $('body').removeClass('no-scroll');
                if (window.innerWidth > 768) {
                    $('#menu').show();
                }
            }

            $('.popup-trigger').on('click', function(event) {
                var content = $(this).find('span:eq(1)').html();
                showPopup(content);
                event.stopPropagation(); // Ngăn chặn sự kiện click lan ra các phần tử cha khác
            });

            // Đóng popup khi click ra ngoài nó
            $(document).on('click', function(event) {
                // Nếu popup đang mở và không phải là click vào popup
                if (isPopupOpen && !$popupContainer.is(event.target) && $popupContainer.has(event.target)
                    .length === 0) {
                    hidePopup();
                }
            });

            $(document).on('keydown', function(event) {
                if (isPopupOpen && event.keyCode === 27) {
                    hidePopup();
                }
            });
        });
    </script>
@endpush

@push('strucdata')
    @include('desktop.layouts.strucdata')
@endpush
