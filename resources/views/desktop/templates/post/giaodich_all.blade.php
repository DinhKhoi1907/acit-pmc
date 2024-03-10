@extends('desktop.master')

@section('element_detail', 'main_page_detail fix_detail_menu')
@section('page_detail', 'page_detail')
{{-- @section('menu', $is_fix_menu) --}}


@section('banner')
    @include('desktop.layouts.banner')
@endsection

@section('content')
    <div class="bg-white lg:py-14 bor-none">
        <div class="lg:py-4">
            @if(isset($title_crumb))<p class="block mb-8 text-3xl font-bold text-center uppercase md:text-4xl text-cmain2 lg:hidden">{{__($title_crumb)}}</p>@endif
            @if($categories)
            <div class="flex-wrap hidden gap-2 mb-8 lg:flex content-page-layout">
                <a href="giao-dich-xa-hoi" class="px-4 py-2 text-sm text-white transition-all duration-500 bg-cmain2 hover:text-cmain2 hover:bg-cmain">Giao dịch xã hội</a>
                @foreach($categories as $k=>$v)
                <a href="{{$v['tenkhongdau'.$lang]}}" class="px-4 py-2 text-sm  transition-all duration-500 {{(isset($row_detail['tenkhongdau'.$lang]) && $row_detail['tenkhongdau'.$lang]==$v['tenkhongdau'.$lang]) ? 'text-cmain2 bg-cmain' : 'text-white bg-cmain2'}}  hover:text-cmain2 hover:bg-cmain">{{$v['ten'.$lang]}}</a>
                @endforeach
            </div>
            @endif
            <div class="relative flex content-page-layout">
                <div class="w-full lg:w-[877px]">
                    @if(isset($posts) && count($posts) > 0)
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
                        <div class="row">
                            @if(!config('config_all.data_demo'))
                            <div class="col-sm-12 dev-center dev-paginator">{{ $posts->links() }}</div>
                            @endif
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
@endpush

@push('strucdata')
    @include('desktop.layouts.strucdata')
@endpush
