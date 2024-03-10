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
                        <div class="flex flex-wrap gap-[12px] sm:gap-[30px] justify-center">
                            @foreach($posts as $k=>$v)
                                <div class="w-[calc(100%/2-6px)] sm:w-[calc(100%/2-22.5px)] md:w-[calc(100%/3-22.5px)] lg:w-[calc(100%/4-22.5px)] text-center bg-gray-100 py-10 px-5 sahdow-shadow1 rounded-md relative group">
                                    <a href="{{$v['tenkhongdau'.$lang]}}" title="{{$v['ten'.$lang]}}" class="absolute top-0 left-0 z-50 w-full h-full transition-all duration-500 border border-solid rounded-md border-cmain2 border-opacity-20 group-hover:border-opacity-100"></a>
                                    <a href="{{$v['tenkhongdau'.$lang]}}" title="{{$v['ten'.$lang]}}" class="himg"><img class="inline-block transition-all duration-500 group-hover:scale-90" src="{{ Thumb::Crop(UPLOAD_POST, $v['photo'], 125, 125, 1) }}" alt="" width="125" height="125"></a>
                                    <span class="inline-block my-3 text-cmain2 opacity-70">{{$v['mota'.$lang]}}</span>
                                    <p class="text-2xl text-cmain2"><span class="mr-2 font-semibold text-red-600">{{$v['giatri']}}</span>per lot</p>
                                    <p class="mt-5 text-base font-medium text-cmain2"><i class="mr-2 fal fa-sync"></i>Chiết khấu tự động</p>
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
