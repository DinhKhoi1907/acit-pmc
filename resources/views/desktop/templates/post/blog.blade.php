@extends('desktop.master')

@section('element_detail', 'main_page_detail')
@section('page_detail', 'page_detail')
@section('menu', 'fix_menu_scroll')

@section('banner')
    {{-- @include('desktop.layouts.banner') --}}
@endsection

@section('content')
    <div class="py-16 bg-cmain9 bor-none">
        <div class="content-page-layout">

            <div class="flex justify-between px-8 py-12 bg-white rounded-md shadow-shadow3">
                <div class="w-full lg:w-[60%]">
                    {{-- <p class="home-title">{{__($title_crumb)}}</p> --}}
                    <div class="content-main w-clear">
                        @if (count($posts) > 0)
                            <div class="flex flex-wrap">
                                @foreach ($posts as $k => $v)
                                    <div class="w-full border-0 border-b border-gray-500 border-solid pb-14 mb-14 group revealOnScroll last:pb-0 last-mb-0 last:border-b-0"
                                        data-animation="animate__fadeInUp" data-timeout="{{ ($k + 1) * 200 }}">
                                        <h3 class="mb-3"><a href="{{ $v['tenkhongdau' . $lang] }}"
                                                class="font-normal text-cmain3 group-hover:text-cmain text-2xl leading-[131%] block transition-all duration-300 text-center uppercase">{{ $v['ten' . $lang] }}</a>
                                        </h3>
                                        <p
                                            class="text-[#101010] opacity-50 leading-[29px] text-center mb-3 uppercase tracking-[0.05rem]">
                                            {{ date('M d', $v['ngaytao']) }}, {{ date('Y', $v['ngaytao']) }} by Admin</p>
                                        <a href="{{ $v['tenkhongdau' . $lang] }}"
                                            title="{{ $v['tenkhongdau' . $lang] }}"><img class="w-full"
                                                src="{{ Thumb::Crop(UPLOAD_POST, $v['photo'], 604, 576, 1) }}"
                                                alt="" width="339" height="232.5"></a>
                                        <div class="relative">
                                            <div
                                                class="text-[#333333] leading-6 line-clamp-3 border-0 border-t border-solid border-gray-300 pt-2 mt-2 border-opacity-50">
                                                {{ Str::limit($v['mota' . $lang], 300) }}<a
                                                    href="{{ $v['tenkhongdau' . $lang] }}"
                                                    class="font-medium bg-white text-cmain3 hover:text-cmain">[{{ __('Xem thêm') }}...]</a>
                                            </div>
                                        </div>
                                    </div>
                                    @if (config('config_all.data_demo'))
                                        <div class="w-full border-0 border-b border-gray-500 border-solid pb-14 mb-14 group revealOnScroll last:pb-0 last-mb-0 last:border-b-0"
                                            data-animation="animate__fadeInUp" data-timeout="{{ ($k + 1) * 200 }}">
                                            <h3 class="mb-3"><a href="{{ $v['tenkhongdau' . $lang] }}"
                                                    class="font-normal text-cmain3 group-hover:text-cmain text-2xl leading-[131%] block transition-all duration-300 text-center uppercase">{{ $v['ten' . $lang] }}</a>
                                            </h3>
                                            <p
                                                class="text-[#101010] opacity-50 leading-[29px] text-center mb-3 uppercase tracking-[0.05rem]">
                                                {{ date('M d', $v['ngaytao']) }}, {{ date('Y', $v['ngaytao']) }} by Admin
                                            </p>
                                            <a href="{{ $v['tenkhongdau' . $lang] }}"
                                                title="{{ $v['tenkhongdau' . $lang] }}"><img class="w-full"
                                                    src="{{ isset($v['photo']) ? Thumb::Crop(UPLOAD_POST, $v['photo'], 604, 576, 1) : '' }}"
                                                    alt="" width="339" height="232.5"></a>
                                            <div class="relative">
                                                <div
                                                    class="text-[#333333] leading-6 line-clamp-3 border-0 border-t border-solid border-gray-300 pt-2 mt-2 border-opacity-50">
                                                    {{ Str::limit($v['mota' . $lang], 300) }}<a
                                                        href="{{ $v['tenkhongdau' . $lang] }}"
                                                        class="font-medium bg-white text-cmain3 hover:text-cmain">[{{ __('Xem thêm') }}...]</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-full border-0 border-b border-gray-500 border-solid pb-14 mb-14 group revealOnScroll last:pb-0 last-mb-0 last:border-b-0"
                                            data-animation="animate__fadeInUp" data-timeout="{{ ($k + 1) * 200 }}">
                                            <h3 class="mb-3"><a href="{{ $v['tenkhongdau' . $lang] }}"
                                                    class="font-normal text-cmain3 group-hover:text-cmain text-2xl leading-[131%] block transition-all duration-300 text-center uppercase">{{ $v['ten' . $lang] }}</a>
                                            </h3>
                                            <p
                                                class="text-[#101010] opacity-50 leading-[29px] text-center mb-3 uppercase tracking-[0.05rem]">
                                                {{ date('M d', $v['ngaytao']) }}, {{ date('Y', $v['ngaytao']) }} by Admin
                                            </p>
                                            <a href="{{ $v['tenkhongdau' . $lang] }}"
                                                title="{{ $v['tenkhongdau' . $lang] }}"><img class="w-full"
                                                    src="{{ isset($v['photo']) ? Thumb::Crop(UPLOAD_POST, $v['photo'], 604, 576, 1) : '' }}"
                                                    alt="" width="339" height="232.5"></a>
                                            <div class="relative">
                                                <div
                                                    class="text-[#333333] leading-6 line-clamp-3 border-0 border-t border-solid border-gray-300 pt-2 mt-2 border-opacity-50">
                                                    {{ Str::limit($v['mota' . $lang], 300) }}<a
                                                        href="{{ $v['tenkhongdau' . $lang] }}"
                                                        class="font-medium bg-white text-cmain3 hover:text-cmain">[{{ __('Xem thêm') }}...]</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="alert-data" role="alert">
                                <strong><i class="mr-1 far fa-exclamation-circle"></i>{{ __('Không tìm thấy kết quả') }}
                                    !</strong>
                            </div>
                        @endif

                        <div class="clear"></div>
                        <div class="row">
                            <div class="col-sm-12 dev-center dev-paginator">{{ $posts->links() }}</div>
                        </div>
                    </div>
                </div>
                @if ($cateBlog)
                    <div class="w-[30%] mt-8 hidden lg:block">
                        @include('desktop.layouts.cateblog')
                    </div>
                @endif
            </div>


        </div>
    </div>
@endsection

<!--css thêm cho mỗi trang-->
@push('css_page')
@endpush

<!--js thêm cho mỗi trang-->
@push('js_page')
@endpush

@push('strucdata')
    @include('desktop.layouts.strucdata')
@endpush
