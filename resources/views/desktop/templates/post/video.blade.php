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
            <div class="relative flex content-page-layout">
                <div class="w-full lg:w-[877px]">
                    @if(isset($posts) && count($posts) > 0)
                        <div class="flex gap-y-[30px] md:gap-y-[50px] gap-x-[30px] flex-wrap">
                            @foreach($posts as $k=>$v)
                            <div class="relative flex items-center group">
                                <a href="{{$v['tenkhongdau'.$lang]}}" class="himg w-[180px] md:w-[250px] h-[150px] md:h-[180px] overflow-hidden flex cursor-pointer relative rounded-xl">
                                    <img class="items-center justify-center object-cover" src="{{ Helper::GetThumbYoutube($v['video']) }}" alt="" width="250">
                                    <span class="absolute top-0 left-0 flex items-center justify-center w-full h-full bg-[rgba(0,0,0,0.3)] video-play opacity-100"><svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="24" height="24" fill="none"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM15.5963 10.3318C16.8872 11.0694 16.8872 12.9307 15.5963 13.6683L11.154 16.2068C9.9715 16.8825 8.5002 16.0287 8.5002 14.6667L8.5002 9.33339C8.5002 7.97146 9.9715 7.11762 11.154 7.79333L15.5963 10.3318Z" fill="#fff"/>
                                        </svg>
                                    </span>
                                    <span class="absolute top-0 left-0 flex items-center justify-center w-full h-full bg-[rgba(0,0,0,0.3)] text-white text-base font-medium video-playing opacity-0">Đang phát</span>
                                </a>
                                <div class="pl-5 w-[calc(100%-180px)] md:w-[calc(100%-250px)]">
                                    <h3 class="mb-5"><a href="{{$v['tenkhongdau'.$lang]}}" class="text-cmain2 leading-[140%] font-bold text-xl transition-all duration-500 group-hover:text-cmain">{{$v['ten'.$lang]}}</a></h3>
                                    <div class="leading-[140%] line-clamp-0 md:line-clamp-3 hidden md:block">{{$v['mota'.$lang]}}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="row">
                            @if(!config('config_all.data_demo'))
                            <div class="col-sm-12 dev-center dev-paginator">{{ $posts->links() }}</div>
                            @endif
                        </div>
                    @else
                        <div class="alert-data" role="alert">
                            <strong><i class="mr-1 far fa-exclamation-circle"></i>{{ __('Không tìm thấy kết quả') }}
                                !</strong>
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
