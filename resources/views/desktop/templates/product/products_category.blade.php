@extends('desktop.master')



@section('element_detail','main_page_detail')



@section('banner')

    @include('desktop.layouts.banner')

@endsection



@section('content')

<div class="bg-cmain3 lg:py-12 bor-none">

	<div class="lg:py-4 content-page-layout">

		<div class="">

			@if(isset($category) && count($category)>0)

				@if(!$banner)<h2 class="home-title page-title"><span>{{$title_crumb}}</span></h2>@endif

				<div id="showcategory_products">

					<div class="flex flex-wrap gap-x-7 md:gap-x-5 gap-y-7">

                        @foreach($category as $k=>$v)

                            <div class="w-[calc(100%/2-14px)] md:w-[calc(100%/3-14px)] group revealOnScroll" data-animation="animate__fadeInUp" data-timeout="{{($k+1)*200}}">

                                <h2><a href="{{$v['tenkhongdau'.$lang]}}" class="himg" title="{{$v['ten'.$lang]}}"><img class="lazy" data-src="{{Thumb::Crop(UPLOAD_CATEGORY,$v['photo'],726,592,1)}}" alt="{{$v['tenkhongdau'.$lang]}}" width="363" height="296"></a></h2>

                                <div class="rounded-[4px] shadow-shadow1 py-3 px-4 ml-3 md:ml-[31px] w-[calc(100%-0.75rem)] md:w-[calc(100%-31px)] -mt-5 relative z-[99] bg-white min-h-[64px] transition-all duration-300 group-hover:bg-cmain2 flex flex-col justify-center">

                                    <a class="mb-1 text-base uppercase text-cmain" href="{{$v['tenkhongdau'.$lang]}}">{{$v['ten'.$lang]}}</a>

                                    <p class="text-xs font-light text-cmain font-el">{{$v['mota'.$lang]}}</p>

                                </div>

                            </div>

                        @endforeach

                    </div>

				</div>

			@else

				<div class="alert-data" role="alert">

					<strong><i class="mr-1 far fa-exclamation-circle"></i>{{__('Không tìm thấy kết quả')}} !</strong>

				</div>

			@endif



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

        var addthis_config = addthis_config||{};

        addthis_config.lang = LANG

    </script>

@endpush



@push('strucdata')

	@include('desktop.layouts.strucdata')

@endpush