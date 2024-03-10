@if($products)
    <div class="dots_custom__owl product__owl owl-carousel owl-theme">
        @foreach($products as $k=>$v)
            <x-product-item :item="$v" :key="$k" class="w-full"></x-product-item>
        @endforeach
    </div>
@else
    <div class="alert-data" role="alert">
        <strong><i class="mr-1 far fa-exclamation-circle"></i>Không tìm thấy kết quả !</strong>
    </div>
@endif