@extends('desktop.master')

@section('element_detail', 'main_page_detail')
@section('page_detail', 'page_detail')
@section('menu', $is_fix_menu)


@section('banner')
    {{-- @include('desktop.layouts.banner') --}}
@endsection

@section('content')
    <div class="py-16 bg-cmain9 bor-none">
        <div class="content-page-layout">
            <div class="px-8 py-12 bg-white rounded-md shadow-shadow3">
                <p class="home-title">{{ __($title_crumb) }}</p>
                <div class="content-main w-clear">
                    <div class="text-base text-center">
                        {{ __('Bạn có thể tìm đọc tất cả các bài viết trên blog') }} {{ __('theo') }} <a datae="#tukhoa"
                            class="text-cmain scroll-btn">{{ __('từ khóa') }}</a>,
                        {{ __('theo') }} <a datae="#detai" class="text-cmain scroll-btn">{{ __('đề tài') }}</a>,
                        {{ __('hoặc') }}
                        {{ __('theo') }} <a datae="#thoigian"
                            class="text-cmain scroll-btn">{{ __('thời gian xuất bản') }}</a>.
                    </div>

                    <div id="tukhoa" class="mb-8">
                        <p class="mb-4 text-2xl text-black uppercase">{{ __('Tìm kiếm') }}</p>
                        <input type="text" id="keyword" value="" placeholder="{{ __('Từ khóa tìm kiếm') }}"
                            onkeypress="doEnterBlog(event,'keyword');"
                            class="w-full p-5 bg-gray-100 border-0 outline-none font-body placeholder:text-sm">
                    </div>

                    <div id="detai" class="mb-8">
                        <p class="mb-4 text-2xl text-black uppercase">{{ __('Theo đề tài') }}</p>
                        <div id="blog-topic">
                            {!! Helper::showCategoryMenuMultyBlog('', 'blog', $lang) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!--css thêm cho mỗi trang-->
@push('css_page')
    <style>
        #blog-topic ul {}

        #blog-topic ul li {}

        #blog-topic ul li ul {
            margin-left: 1.5rem;
            margin-bottom: 0.5rem;
        }

        #blog-topic ul li ul li ul {
            margin-left: 1.5rem;
            margin-bottom: 0.5rem;
        }

        #blog-topic ul li a {
            margin-bottom: 0.5rem;
            color: #008080;
            display: inline-block;
            font-size: 15px;
        }
    </style>
@endpush

<!--js thêm cho mỗi trang-->
@push('js_page')
@endpush

@push('strucdata')
    @include('desktop.layouts.strucdata')
@endpush
