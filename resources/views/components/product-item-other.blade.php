
<div class="relative overflow-hidden group revealOnScroll cursor-pointer bg-white shadow-md rounded-lg card-nb"
    data-animation="animate__fadeInUp" data-timeout="{{ ($key + 1) * 200 }}">
    <a href="{{ $item['tenkhongdau' . $lang] }}" class="product-item">
        @if ($item)
            <button
                class="absolute bg-cmain text-white py-3 px-6 right-[6px] top-[22px] border-0 text-[14px] rounded-lg z-10">{{ $item['has_level_one']['tenvi'] }}</button>
        @endif
        <img class="rounded-lg z-10" src="public/upload/test/image_78.png" width="292" height="301">
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

