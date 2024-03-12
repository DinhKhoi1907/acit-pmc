{{-- @php
    $giamoi = $item['giamoi'] < $item['gia'] ? $item['giamoi'] : 0;
    $gia = $item['gia'];
    $giakm = $item['giakm'];
    $size_arr = $item['id_size'] != '' ? explode(',', $item['id_size']) : null;
@endphp --}}

{{-- <div class="p-3 sm:p-4 overflow-hidden bg-cmain3 {{ $attributes['class'] }}">
    <a href="{{$item['tenkhongdau'.$lang]}}" title="{{$item['ten'.$lang]}}" class="himg"><img src="{{ Thumb::Crop(UPLOAD_PRODUCT, $item['photo'], 800, 800, 1) }}" alt="" width="400" height="400"></a>
    <div class="px-0 py-4 md:py-8 md:px-3">
        <h2><a href="{{$item['tenkhongdau'.$lang]}}" class="text-xl sm:text-xl font-bold capitalize font-Montserrat leading-[120%] md:leading-[140%] text-cmain">{{$item['ten'.$lang]}}</a></h2>
        <div class="flex items-center mt-2">
            @if ($giamoi < $gia && $giamoi > 0)
            <p class="text-xl font-bold text-red-600 md:text-base font-Montserrat">{!! $giamoi < $gia ? Helper::Format_Money($giamoi) : Helper::Format_Money($gia) !!}</p>
            @endif

            @if ($giamoi == 0)
            <p class="text-xl font-bold text-red-600 md:text-base font-Montserrat">{!! Helper::Format_Money($gia) !!}</p>
            @else
            <p class="ml-4 text-sm text-gray-600 line-through font-Montserrat opacity-70">{!! Helper::Format_Money($gia) !!}</p>
            @endif
        </div>
        <div class="line-clamp-3 text-[15px] leading-[140%] mt-2">{{$item['mota'.$lang]}}</div>
    </div>
</div> --}}

<div class="lg:w-[calc(100%/3-16px)] md:w-[calc(100%/2-12px)] relative overflow-hidden group revealOnScroll cursor-pointer box-info-product bg-white shadow-md rounded-lg card-nb"
    data-animation="animate__fadeInUp">
    <a href="{{ $item['tenkhongdau' . $lang] }}" class="product-item">
        @if($item->HasLevelOne)
        <button
            class="absolute bg-cmain text-white py-3 px-6 right-[6px] top-[22px] border-0 text-[14px] rounded-lg z-10">{{ $item->HasLevelOne->tenvi }}</button>
        @endif
        <img class="rounded-lg z-10" src="{{ Thumb::Crop(UPLOAD_PRODUCT, $item['photo'], 292, 301, 1) }}" width="292" height="301">
        <div class="p-5 flex flex-col gap-3 z-10">
            <h1 class="text-cmain font-[18px] font-semibold uppercase">{{ $item['ten' . $lang] }}</h1>
            <p class="text-cmain1 font-medium text-[16px]">Xem chi tiết</p>
        </div>
        <div
            class="bg-hover opacity-1 flex flex-col justify-start rounded-lg absolute top-0 right-0 left-0 bottom-0 info-product text-white pt-[54px] px-6 pb-6">
            <div class="font-bold text-[18px] mb-[13px] uppercase ">
                {{ $item['ten' . $lang] }}
            </div>
            <div class="text-white text-sm font-normal">
                {{ $item['mota' . $lang] }}
            </div>
            <div class="text-white flex flex-row items-center flex-wrap gap-x-6 mt-auto">
                <span class="xl:w-auto underline transition-all duration-300 font-medium text-[16px]">
                    Xem chi tiết
                </span>
            </div>
        </div>
    </a>
</div>



{{--
<div class="{{ $attributes['class'] }} group revealOnScroll" data-animation="animate__zoomIn" data-timeout="{{($key+1)*100}}">
    <a href="{{ $item['tenkhongdau' . $lang] }}" class="overflow-hidden himg rounded-2xl"><img
            src="{{ Thumb::Crop(UPLOAD_PRODUCT, $item['photo'], 870, 828, 1) }}"
            alt="{{ $item['tenkhongdau' . $lang] }}" width="290px" height="276px" class="transition-all duration-700 rounded-2xl group-hover:scale-110"></a>
    <h2 class="my-[10px]"><a href="{{ $item['tenkhongdau' . $lang] }}"
            class="block font-bold text-center text-cmain leading-[141%] text-xl md:text-[18px]">{{ $item['ten' . $lang] }}</a>
    </h2>
    <div class="flex flex-wrap md:flex-nowrap items-center justify-center gap-[6px]">
        @if ($giamoi < $gia && $giamoi > 0)
            <p class="w-full md:w-auto font-semibold leading-5 text-cmain6 tracking-[0.02em] font-Gilroy text-[20px] text-center md:text-left">
                {!! $giamoi < $gia ? Helper::Format_Money($giamoi) : Helper::Format_Money($gia) !!}</p>
        @endif
        @if ($giamoi == 0)
            <p class="w-full md:w-auto font-semibold leading-5 text-cmain6 tracking-[0.02em] font-Gilroy text-[20px] text-center md:text-left">
                {!! $giamoi < $gia && $giamoi > 0 ? Helper::Format_Money($giamoi) : Helper::Format_Money($gia) !!}</p>
        @else
            <p class="w-full md:w-auto text-black opacity-40 tracking-[0.02em] text-base md:text-xs line-through font-Gilroy text-center md:text-left">
                {!! Helper::Format_Money($gia) !!}</p>
        @endif
    </div>
    <div class="flex flex-row-reverse justify-center mt-[18px] flex-wrap gap-[7px]">
        @if ($size_arr)
            @foreach ($size_arr as $item)
                @if ($item == '36')
                    <a class="text-black rounded-full border border-solid border-black py-[6px] px-4 w-full md:w-auto text-center md:text-left js-action-cart-size cursor-pointer transition-all duration-500 hover:bg-cmain6 hover:text-white hover:border-cmain6" data-id="{{ $item['id'] }}" data-id-size="{{$item}}" data-action="addnow">Học
                    Online</a>
                    @else
                    <a class="text-white rounded-full bg-cmain py-[6px] px-4 border-solid border-black w-full md:w-auto text-center md:text-left js-action-cart-size cursor-pointer transition-all duration-500 hover:bg-cmain6 hover:text-white hover:border-cmain6" data-id="{{ $item['id'] }}" data-id-size="{{$item}}" data-action="addnow">Đăng ký
                    học</a>

                @endif
            @endforeach
        @else
        <a class="text-white rounded-full bg-cmain py-[6px] px-4 border-solid border-black w-full md:w-auto text-center md:text-left js-action-cart cursor-pointer" data-id="{{ $item['id'] }}" data-action="addnow">Đăng ký
            học</a>
        @endif
    </div>
</div> --}}
