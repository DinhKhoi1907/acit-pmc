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
		@if(isset($keywords) && $keywords!='')
			<h2 class="home-title page-title"><span>Có {{count($products)}} kết quả tìm kiếm với từ khóa '{{$keywords}}'</span></h2>
		@endif

		<div class="flex">
			<div class="product_layout_box w-full">
				<div id="showcategory_products">
					<div class="flex flex-wrap justify-between gap-8">
						@foreach($products as $k=>$v)
							<x-product-item :item="$v" class="lg:w-[calc(100%/4-24px)] mb-8 w-[calc(100%/2-12px)]"/>
						@endforeach
					</div>

					<div class="row">
						<div class="col-sm-12 dev-center dev-paginator">{{ $products->links() }}</div>
					</div>
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