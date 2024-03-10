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
            <div class="content-page-layout">
                @if(isset($title_crumb))<p class="block mb-8 text-3xl font-bold text-center uppercase md:text-4xl text-cmain2 lg:hidden">{{__($title_crumb)}}</p>@endif
                <div class=" w-clear">
                    @if (count($posts) > 0)
                        <div class="flex gap-y-[30px] md:gap-y-[50px] gap-x-[30px] flex-wrap">
                            @foreach($posts as $k=>$v)
                            <div class="flex w-full lg:w-[calc(100%/2-15px)] items-center group">
                                <p class="himg w-[120px] md:w-[150px] relative z-50 bg-white p-2 shadow-lg"><img src="{{ Thumb::Crop(UPLOAD_POST, $v['icon'], 300, 300, 1) }}" alt="" width="150" height="150"></p>
                                <div class="py-8 pr-10 bg-white border border-gray-200 border-solid rounded-none pl-14 w-[calc(100%-100px)] md:w-[calc(100%-130px)] -ml-[20px] transition-all duration-500 group-hover:bg-cmain group-hover:border-white">
                                    <a href="{{$v['tenkhongdau'.$lang]}}" class="relative block mb-5 text-xl font-bold text-black capitalize md:text-2xl">{{$v['tensan'.$lang]}}<span class="absolute w-[25px] md:w-[50px] border-0 border-t-[2px] border-cmain border-solid -bottom-4 left-0 pb-2 transition-all duration-500 group-hover:border-black"></span></a>
                                    <div class="leading-[140%] text-base mb-3 line-clamp-3 whitespace-pre-line">{{$v['mota'.$lang]}}</div>
                                    <div class="flex items-center gap-3">
                                        <a href="{{$v['tenkhongdau'.$lang]}}" class="inline-flex items-center px-4 py-2 text-xs font-bold text-black transition-all duration-500 border border-solid rounded-none border-cmain bg-cmain group-hover:bg-white"><i class="mr-2 fal fa-search-dollar"></i>Đánh giá</a>
                                        <a href="{{$v['linklienket']}}" target="_blank" class="inline-flex items-center px-4 py-2 text-xs font-bold text-black border border-solid rounded-none border-cmain3 bg-cmain3">Website<i class="ml-2 fal fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
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
                        @if(!config('config_all.data_demo'))
                        <div class="col-sm-12 dev-center dev-paginator">{{ $posts->links() }}</div>
                        @endif
                    </div>
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
@endpush

@push('strucdata')
    @include('desktop.layouts.strucdata')
@endpush
