@extends('desktop.master')



@section('element_detail','main_page_detail')



@section('banner')

    @include('desktop.layouts.banner')

@endsection



@section('content')

<div class="bg-cmain9 lg:py-12 bor-none">

	<div class="lg:py-4 content-page-layout">

		<div class="">

            @if($categories)
                <div class="flex gap-5 items-center justify-center mb-8">
                    @foreach($categories as $k=>$v)
                        <a href="{{$v['tenkhongdau'.$lang]}}" class="bg-gray-100 rounded-md py-4 px-5 cursor-pointer min-w-[150px] text-center font-bold text-cmain2 capitalize transition-all duration-300 hover:bg-cmain3 hover:text-white">{{$v['ten'.$lang]}}</a>
                    @endforeach
                </div>
            @endif


			@if(isset($products) && count($products)>0)

				{{-- @if(isset($keywords) && $keywords!='')
					@if($lang=='vi')
					<h2 class="home-title page-title"><span>Có {{count($products)}} kết quả tìm kiếm với từ khóa '{{$keywords}}'</span></h2>
					@else
					<h2 class="home-title page-title"><span>There are {{count($products)}} search results with keyword '{{$keywords}}'</span></h2>
					@endif
				@endif --}}

				

				<div id="showcategory_products">

					<div class="flex flex-wrap gap-4 lg:gap-6">

						@foreach($products as $k=>$v)

							<x-product-item :key="$k" :item="$v" class="w-[calc(100%/2-8px)] lg:w-[calc(100%/4-18px)] "/>

							@if(config('config_all.data_demo'))

							<x-product-item :key="$k" :item="$v" class="w-[calc(100%/2-8px)] lg:w-[calc(100%/4-18px)] "/>

							<x-product-item :key="$k" :item="$v" class="w-[calc(100%/2-8px)] lg:w-[calc(100%/4-18px)] "/>

							<x-product-item :key="$k" :item="$v" class="w-[calc(100%/2-8px)] lg:w-[calc(100%/4-18px)] "/>

							@endif

						@endforeach

					</div>



					@if(!is_array($products))

					<div class="row">

						<div class="col-sm-12 dev-center dev-paginator">{{ $products->links() }}</div>

					</div>

					@endif

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

	<link rel="stylesheet" href="{{asset('css/images-compare.css')}}">

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