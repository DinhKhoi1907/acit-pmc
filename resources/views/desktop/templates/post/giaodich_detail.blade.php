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
            <div class="w-full lg:w-[877px]">
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

                @if(isset($posts) && count($posts) > 0)
                    <div class="mt-10">                        
                        <div class="text-2xl md:text-[28px] font-bold text-black relative mb-6 md:mb-12 border-0 border-b border-solid border-cmain2 border-opacity-30 pb-2 flex items-center justify-between">
                            <p class="uppercase">{{__('Giao dịch khác')}}<span class="absolute w-[80px] border-0 border-t-[4px] border-cmain border-solid -bottom-[8px] md:-bottom-[10px] left-0 pb-2 transition-all duration-500 group-hover:border-black"></span></p>
                        </div>
                        <div class="flex gap-[16px] sm:gap-[28px] flex-wrap">
                            @foreach($posts as $k=>$v)
                            <div class="w-[calc(100%/2-8px)] sm:w-[calc(100%/2-14px)] rounded-xl overflow-hidden border border-solid border-gray-200 border-opacity-80 group">
                                <a href="{{($v['linklienket']) ? $v['linklienket'] : $v['tenkhongdau'.$lang]}}" class="overflow-hidden himg"><img class="w-full transition-all duration-500 group-hover:scale-105" src="{{ Thumb::Crop(UPLOAD_POST, $v['photo'], 680, 420, 1) }}" alt="" width="340" height="210"></a>
                                <div class="p-5">
                                    <h3 class="mb-2"><a href="{{($v['linklienket']) ? $v['linklienket'] : $v['tenkhongdau'.$lang]}}" class="block text-base font-bold uppercase text-cmain2">{{$v['ten'.$lang]}}</a></h3>
                                    <div class="flex justify-between gap-x-[10px] gap-y-2 flex-wrap">
                                        <div class="w-[calc(50%-5px)]">
                                            <p class="text-cmain3"><span class="text-base font-semibold">{{$v['ruiro']}}</span>/10</p>
                                            <p class="text-xs text-cmain2">Rủi ro</p>
                                        </div>
                                        <div class="w-[calc(50%-10px)]">
                                            <p class="text-cmain3"><span class="text-base font-semibold">{{$v['khanangsinhloi']}}</span>%</p>
                                            <p class="text-xs text-cmain2">Khả năng sinh lời</p>
                                        </div>
                                        <div class="w-[calc(50%-10px)]">
                                            <p class="text-cmain2"><span class="text-base font-semibold">{{$v['hoahong']}}</span>%</p>
                                            <p class="text-xs text-cmain2">Hoa hồng</p>
                                        </div>
                                        <div class="w-[calc(50%-10px)]">
                                            <p class="text-cmain2"><span class="text-base font-semibold">{{($v['donbay']!='') ? $v['donbay'] : '0'}}</span></p>
                                            <p class="text-xs text-cmain2">Đòn bẩy</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                    
            </div>
            <div class="w-[calc(100%-877px)] pl-20 sticky-top top-10 self-start flex-col gap-10 hidden lg:flex">@include('desktop.layouts.sidebarright')</div>
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
