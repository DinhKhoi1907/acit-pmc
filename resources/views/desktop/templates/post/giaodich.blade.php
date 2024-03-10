@extends('desktop.master')

@section('element_detail', 'main_page_detail fix_detail_menu')
@section('page_detail', 'page_detail')
{{-- @section('menu', $is_fix_menu) --}}


@section('banner')
    @include('desktop.layouts.banner')
@endsection


@section('content')
    <div class="bg-white lg:py-14 bor-none">
        @if($danhmucparent)
        <div class="flex-wrap hidden gap-2 mb-8 lg:flex content-page-layout">
            <a href="giao-dich-xa-hoi" class="px-4 py-2 text-sm transition-all duration-500 text-cmain2 bg-cmain hover:text-cmain2 hover:bg-cmain">Giao dịch xã hội</a>
            @foreach($danhmucparent as $k=>$v)
            <a href="{{$v['tenkhongdau'.$lang]}}" class="px-4 py-2 text-sm text-white transition-all duration-500 bg-cmain2 hover:text-cmain2 hover:bg-cmain">{{$v['ten'.$lang]}}</a>
            @endforeach
        </div>
        @endif
        
        <div class="relative flex lg:py-4 content-page-layout">
            <div class="w-full lg:w-[877px]">
                @if($danhmucparent)
                    @foreach($danhmucparent as $l=>$list)
                        @php
                            $allPost = $list['has_all_post'];
                            if(config('config_all.data_demo')){
                                //### test duplicate array customer
                                $arr_tmp = array();
                                for($i=0;$i<10;$i++){
                                    $arr_tmp = array_merge($allPost, $arr_tmp);
                                }
                                $allPost = $arr_tmp;
                            }
                        @endphp

                        <div class="mb-20">
                            <div class="text-xl md:text-[20px] font-bold text-black relative mb-7 border-0 border-b border-solid border-cmain2 border-opacity-30 pb-2 flex items-center justify-between">
                                <p class="uppercase">{{$list['ten'.$lang]}}<span class="absolute w-[80px] border-0 border-t-[4px] border-cmain border-solid -bottom-[8px] md:-bottom-[10px] left-0 pb-2 transition-all duration-500 group-hover:border-black"></span></p>
                                <a href="{{$list['tenkhongdau'.$lang]}}" class="inline-flex items-center text-sm font-bold text-black transition-all duration-300 normal hover:text-cmain">Xem tất cả <i class="ml-2 fal fa-long-arrow-right"></i></a>
                            </div>
                            @if($allPost)
                            <div class="giaodich__owl owl-carousel owl-theme block-img dots_news__owl">
                                @foreach($allPost as $k=>$v)
                                    @if($k==0 || $k%6==0)<div class="flex gap-[16px] sm:gap-[28px] md:gap-[21px] flex-wrap">@endif
                                        <div class="w-[calc(100%/2-8px)] sm:w-[calc(100%/2-14px)] md:w-[calc(100%/3-14px)] rounded-xl overflow-hidden border border-solid border-gray-200 border-opacity-80 group">
                                            <a href="{{($v['linklienket']) ? $v['linklienket'] : $v['tenkhongdau'.$lang]}}" class="overflow-hidden himg"><img class="w-full transition-all duration-500 group-hover:scale-105" src="{{ Thumb::Crop(UPLOAD_POST, $v['photo'], 680, 420, 1) }}" alt="" width="340" height="210"></a>
                                            <div class="p-5">
                                                <h3 class="mb-2"><a href="{{($v['linklienket']) ? $v['linklienket'] : $v['tenkhongdau'.$lang]}}" class="block text-base font-bold uppercase text-cmain2">{{$v['ten'.$lang]}}</a></h3>
                                                <div class="flex justify-between gap-x-[5px] sm:gap-x-[10px] gap-y-2 flex-wrap">
                                                    <div class="w-[calc(50%-5px)]">
                                                        <p class="text-cmain3"><span class="text-base font-semibold">{{$v['ruiro']}}</span>/10</p>
                                                        <p class="text-[13px] md:text-xs text-cmain2">Rủi ro</p>
                                                    </div>
                                                    <div class="w-[calc(50%-5px)]">
                                                        <p class="text-cmain3"><span class="text-base font-semibold">{{$v['khanangsinhloi']}}</span>%</p>
                                                        <p class="text-[13px] md:text-xs text-cmain2">Khả năng sinh lời</p>
                                                    </div>
                                                    <div class="w-[calc(50%-5px)]">
                                                        <p class="text-cmain2"><span class="text-base font-semibold">{{$v['hoahong']}}</span>%</p>
                                                        <p class="text-[13px] md:text-xs text-cmain2">Hoa hồng</p>
                                                    </div>
                                                    <div class="w-[calc(50%-5px)]">
                                                        <p class="text-cmain2"><span class="text-base font-semibold">{{($v['donbay']!='') ? $v['donbay'] : '0'}}</span></p>
                                                        <p class="text-[13px] md:text-xs text-cmain2">Đòn bẩy</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @if(($k+1)%6==0 || ($k+1)>=count($allPost))</div>@endif
                                @endforeach
                            </div>
                            @else
                            <div class="alert-data" role="alert">
                                <strong><i class="mr-1 far fa-exclamation-circle"></i>{{ __('Đang cập nhật dữ liệu...') }}!</strong>
                            </div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="w-[calc(100%-877px)] pl-20 sticky-top top-10 self-start flex-col gap-10 hidden lg:flex">@include('desktop.layouts.sidebarright')</div>
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
