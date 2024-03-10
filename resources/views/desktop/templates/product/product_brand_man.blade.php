@extends('desktop.master')

@section('element_detail','main_page_detail')
@section('center_detail','lg:py-12')

@section('banner')
    @include('desktop.layouts.banner')
@endsection

@section('content')
@if(isset($nhacungcap_menu))
    <div class="content-page-layout p-3 md:p-[55px] lg:-mt-[10rem] mt-0 relative after:content-[''] after:absolute after:w-full after:h-[143px] after:top-[10px] after:left-0 after:bg-white lg:after:rounded-[20px] after:shadow-shadow1 after:rounded-0 after:hidden lg:after:block">
        <div class="brand__owl owl-carousel owl-theme">
            @foreach($nhacungcap_menu as $k=>$v)
                <a class="himg" href="{{$v['tenkhongdau'.$lang]}}">
                    <img src="{{Thumb::Crop(UPLOAD_BRAND,$v['photo'],369,108,1)}}" alt="slider" width="186" height="54">
                </a>
            @endforeach
        </div>
    </div>
@endif
    

<div class="lg:py-4 content-page-layout bor-none">
	<div class="bg-white rounded ">
		@if(!$banner)<h2 class="home-title page-title"><span>{{$title_crumb}}</span></h2>@endif

        @foreach($danhmuc_cap1 as $k=>$v)
        @php
            $items = $v['has_all_child_limit'];
        @endphp
            @if($items)
                <div class="mt-8">
                    <div class="bg-cmain4 rounded-lg uppercase text-cmain py-4 border-0 border-b border-solid border-cmain3 mb-6 font-bold text-xl flex items-center justify-between pr-4"><p class="flex items-center"><span class="relative w-[8px] h-[8px] inline-block after:content-[''] after:absolute after:w-[8px] after:h-[8px] after:bg-cmain after:top-0 after:left-[8px] before:content-[''] before:absolute before:w-[8px] before:h-[8px] before:bg-cmain3 before:top-[3px] before:left-[11px] mr-5"></span>{{$v['ten'.$lang]}}</p><a href="{{$v['tenkhongdau'.$lang]}}" class="capitalize text-sm font-semibold text-cmain">Xem tất cả <i class="ml-2 fal fa-long-arrow-right"></i></a></div>
                    <div>
                        <div class="flex flex-wrap justify-between gap-8">
                            @foreach($items as $i=>$item)
                                <x-product-item :item="$item" class="lg:w-[calc(100%/4-24px)] mb-8 w-[calc(100%/2-12px)]"/>
                            @endforeach
                        </div>                        
                    </div>
                </div>
            @endif
        @endforeach

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
        var addthis_config = addthis_config||{};
        addthis_config.lang = LANG
    </script>
@endpush

@push('strucdata')
	@include('desktop.layouts.strucdata')
@endpush