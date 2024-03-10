@extends('desktop.master')

@section('element_detail','main_page_detail')
@section('page_detail','page_detail')

@section('banner')
    @include('desktop.layouts.banner')
@endsection

@section('content')
<div class="py- bortop">
    <div class="px-0 rounded">
        @if(!$banner)<div class="uppercase text-bgmain3 rounded-[5px] p-3 font-semibold text-3xl font-body mb-3 wow animate__animated animate__fadeInUp text-center">{{$title_crumb}}</div>@endif
        
        @if(count($gallery)>0)
            <div id="container">
                @foreach($gallery as $k=>$v)
                    @php
                        $photo_video = (isset($v['video'])) ? UPLOAD_PHOTO.$v['video'] : ((isset($v['photo'])) ? UPLOAD_PHOTO.$v['photo'] : '');
                    @endphp
                    <a href="{{$photo_video}}" data-fancybox="gallery" class="himg relative"><img src="{{UPLOAD_PHOTO.$v['photo']}}" alt="{{$v['ten'.$lang]}}">
                        @if($v['video']!='')
                            <span class="absolute top-0 left-0 w-full h-full flex items-center justify-center"><svg width="62" height="62" viewBox="0 0 62 62" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle opacity="0.5" cx="31" cy="31" r="31" fill="white"/>
                                <path d="M49 31L22 46.5885L22 15.4115L49 31Z" fill="#BF2D00"/>
                                </svg>
                            </span>
                        @endif
                    </a>
                @endforeach
            </div>
        @else
            <div class="content-page-layout content-main w-clear">
                <div class="alert-data" role="alert">
                    <strong>{{khongtimthayketqua}}</strong>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection

<!--css thêm cho mỗi trang-->
@push('css_page')
    <link href="{{ asset('/css/flexbox-gallery.css') }}" rel="stylesheet">
@endpush

<!--js thêm cho mỗi trang-->
@push('js_page')
    <script src="{{ asset('js/flexbox-gallery.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#container').flexgal();
        })
    </script>
@endpush

@push('strucdata')
    @include('desktop.layouts.strucdata')
@endpush