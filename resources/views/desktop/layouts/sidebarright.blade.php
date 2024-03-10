@if($sanforex)
    <div class="p-5 shadow-xl bg-gray-50 rounded-xl">
        <p class="relative pb-2 pl-5 mb-8 text-xl font-bold border-0 border-b border-solid border-cmain2 border-opacity-30">Brokers được cấp phép<span class="absolute w-[8px] h-[8px] bg-cmain top-[10px] left-0"></span></p>
        <div class="flex flex-col gap-5">
            @foreach($sanforex as $k=>$v)
            <div class="flex items-center gap-2 pb-5 border-0 border-b border-dashed border-cmain2 border-opacity-10 last:border-none last:pb-0">
                <a href="{{$v['tenkhongdau'.$lang]}}" class="himg w-[90px] border border-solid border-cmain border-opacity-40 rounded-none"><img src="{{ Thumb::Crop(UPLOAD_POST, $v['icon'], 300, 300, 1) }}" alt="" width="90" height="90"></a>
                <div class="w-[calc(100%-90px)] pl-2">
                    <a href="{{$v['tenkhongdau'.$lang]}}" class="relative block mb-1 text-base font-bold text-black capitalize">{{$v['tensan'.$lang]}}</a>
                    <div class="leading-[140%] text-xs mb-2 line-clamp-2 whitespace-pre-line">{{$v['mota'.$lang]}}</div>
                    <div class="flex items-center gap-[15px]">
                        <a href="{{$v['tenkhongdau'.$lang]}}" class="inline-flex items-center text-xs font-bold text-red-600 transition-all duration-500 group-hover:bg-white"><i class="mr-1 fal fa-search-dollar"></i>Đánh giá</a>
                        <span class="w-[5px] h-[5px] bg-cmain2 rounded-full opacity-50"></span>
                        <a href="{{$v['linklienket']}}" target="_blank" class="inline-flex items-center text-xs font-bold text-cmain3 ">Website<i class="ml-1 fal fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@else
    <a href="{{$photo_static['banner1']['link']}}" target="_blank" class="himg"><img class="w-full" src="{{ Thumb::Crop(UPLOAD_PHOTO, $photo_static['banner1']['photo'], 300, 250, 1) }}" alt=""></a>
    <a href="{{$photo_static['banner2']['link']}}" target="_blank" class="himg"><img class="w-full" src="{{ Thumb::Crop(UPLOAD_PHOTO, $photo_static['banner2']['photo'], 300, 250, 1) }}" alt=""></a>
@endif