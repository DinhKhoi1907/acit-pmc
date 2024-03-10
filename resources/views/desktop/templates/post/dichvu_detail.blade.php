@extends('desktop.master')



@section('element_detail', 'main_page_detail fix_detail_menu')

@section('page_detail', 'page_detail')


@section('banner')

    @include('desktop.layouts.banner')

@endsection


@section('content')

<div class="bg-white lg:py-14 bor-none">
    <div class="lg:py-4 content-page-layout">
        <div class="relative flex content-page-layout">
            <div class="w-full">
                <p class="mb-5 text-3xl font-bold">{{ __($row_detail['ten'.$lang]) }}</p>
                <div class="flex flex-col items-start justify-between gap-4 pt-3 mb-3 border-0 border-t border-solid md:gap-2 lg:items-center lg:gap-8 lg:flex-row border-cmain2 border-opacity-10">
                    <div class="flex items-center"><i class="mr-2 fal fa-calendar-alt"></i>{{ ngaydang }}: {{ date('d/m/Y h:i A', $row_detail['ngaytao']) }}</div>
                    <div class="share">
                        <div class="flex flex-wrap social-plugin w-clear ">
                            <div class="addthis_inline_share_toolbox_qj48"></div>
                            <div class="ml-2 zalo-share-button" data-href="{{ Helper::getCurrentPageURL() }}"
                                data-oaid="{{ $settingOption['oaidzalo'] != '' ? $settingOption['oaidzalo'] : '579745863508352884' }}"
                                data-layout="1" data-color="blue" data-customize=false></div>
                        </div>
                    </div>
                </div>                         
                @if (isset($row_detail['noidung' . $lang]) && $row_detail['noidung' . $lang] != '')
                    @include('desktop.layouts.toc')      
                    <div class="content-main content-css w-clear" id="toc-content">{!! $row_detail['noidung' . $lang] !!}</div>
                @else
                    <div class="alert-data" role="alert">
                        <strong><i class="mr-1 far fa-exclamation-circle"></i>{{ __('Không tìm thấy kết quả') }} !</strong>
                    </div>
                @endif

            </div>
        </div>
    </div>
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
