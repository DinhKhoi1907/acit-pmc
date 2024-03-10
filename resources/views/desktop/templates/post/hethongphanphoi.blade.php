@extends('desktop.master')

@section('element_detail','main_page_detail')
@section('page_detail','page_detail')

@section('banner')
    @include('desktop.layouts.banner')
@endsection

@section('content')
<div class="py-10 bg-cmain3 bor-none">
    <div class="content-page-layout">
        <div class="px-0 rounded lg:py-5">
            @if(!$banner)<div class="home-title"><span>{{__('Hệ thống phân phối')}}</span></div>@endif

            @if($hethongcuahang)
            <div class="">
                <div class="content-page-layout">
                    {{-- <div class="home-title">Hệ thống phân phối trên toàn quốc</div> --}}
                    <div class="flex flex-wrap">
                        <div class="md:w-[398px] w-full">                            
                            <div id="display-hethong-list">
                                @if($hethongcuahang)
                                    <div class="bg-white scroll-hethong over-hethong rounded-l-xl">
                                        @foreach($hethongcuahang as $k=>$v)
                                            <div class="mt-3 cursor-pointer first:mt-0 hethong-ajax-detail">
                                                <p class="font-bold text-cmain">{{$v['ten'.$lang]}}</p>
                                                <div class="mt-[6px]">
                                                    <p class="text-base md:text-xs mb-[6px]"><span class="font-bold">{{__('Địa chỉ')}}:</span> {{$v['giaidoan'.$lang]}}</p>                                    
                                                    <p class="text-base md:text-xs"><span class="font-bold">{{__('Số điện thoại')}}:</span> {{$v['dienthoai']}}</p>
                                                </div>
                                                <div class="hidden hethong-map">{!! $v['map'] !!}</div>                                    
                                            </div>                                    
                                        @endforeach
                                    
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="w-full md:w-[calc(100%-398px-54px)] md:ml-[54px] ml-0 pt-7 md:pt-0" id="display-hethong-map"></div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection

<!--css thêm cho mỗi trang-->
@push('css_page')
    <style>
        .scroll-hethong::-webkit-scrollbar {
            width: 6px;
        }

        /* Track */
        .scroll-hethong::-webkit-scrollbar-track {
            /*background: transparent; */
            background: #D9D9D9;
            border-left:2px solid #fff;
            border-right:2px solid #fff;
        }
        
        /* Handle */
        .scroll-hethong::-webkit-scrollbar-thumb {
            background: #1B4932; 
        }

        /* Handle on hover */
        .scroll-hethong::-webkit-scrollbar-thumb:hover {
            background: #1B4932; cursor: grabbing;
        }
        
        .over-hethong { overflow-y: auto; max-height: 570px; }
        .hethong-ajax-detail {
            padding: 0.5rem 1rem;
            width: 98%;            
        }

        .hethong-ajax-active p, .hethong-ajax-active div{color: #fff;}
        
        .hethong-ajax-detail:hover, .hethong-ajax-active {
            background-color: #47775C;
            transition: all ease 0.4s;
            border-radius: 4px;
        }
        .hethong-ajax-detail:hover p , .hethong-ajax-detail:hover div{color: #fff;}
    </style>
@endpush

<!--js thêm cho mỗi trang-->
@push('js_page')
    <script>
        $(window).on('load', function () {
            $('.hethong-ajax-detail').eq(0).trigger('click');
        });

        
        $('body').on('click', '.hethong-ajax-detail', function() {

            var map = $(this).find('.hethong-map').html();

            $('#display-hethong-map').html(map);

            $('.hethong-ajax-detail').removeClass('hethong-ajax-active');

            $(this).addClass('hethong-ajax-active');

            // $('html, body').stop().animate({
            //     'scrollTop': $('#display-hethong-map').offset().top - 0}, 500, 'swing', function() {
            // });

        });
    </script>
@endpush

@push('strucdata')
    @include('desktop.layouts.strucdata')
@endpush