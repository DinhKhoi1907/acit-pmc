@if($products)
	<div class="flex flex-wrap gap-4 lg:gap-6">
		@foreach($products as $k=>$v)
			<x-product-item :item="$v" class="w-[calc(100%/2-8px)] lg:w-[calc(100%/4-18px)]"/>
			@if(config('config_all.data_demo'))
			<x-product-item :item="$v" class="w-[calc(100%/2-8px)] lg:w-[calc(100%/4-18px)]"/>
			<x-product-item :item="$v" class="w-[calc(100%/2-8px)] lg:w-[calc(100%/4-18px)]"/>
			<x-product-item :item="$v" class="w-[calc(100%/2-8px)] lg:w-[calc(100%/4-18px)]"/>
			@endif
		@endforeach
	</div>

	@if(isset($products))
	<div class="row">
		<div class="col-sm-12 dev-center dev-paginator ajax-pagiantion">{{ $products->links() }}</div>
	</div>
	@endif
@else
	<div class="alert-data" role="alert">
		<strong><i class="mr-1 far fa-exclamation-circle"></i>{{ __('Không tìm thấy kết quả') }} !</strong>
	</div>
@endif