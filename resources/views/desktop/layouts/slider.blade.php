<div id="slider" class="relative overflow-hidden">
    {{-- <span class="absolute top-0 left-0 z-10 w-full h-full bg-black opacity-30"></span> --}}
    <div class="slide__owl owl-carousel owl-theme block-img">
        @handheld
            @if (isset($slidemobile))
                @foreach ($slidemobile as $k => $v)
                    <div class="relative">
                        <div class="himg"><img src="{{ Thumb::Crop(UPLOAD_PHOTO, $v['photo'], 1245, 1410, 1) }}"
                                alt="slider" width="1245" height="1410" class="block"></div>
                    </div>
                @endforeach
            @endif
            @elsedesktop
            @if (isset($slide))
                @foreach ($slide as $k => $v)
                    <div class="himg relative">
                        <img class="object-cover w-full h-full"
                            src="{{ Thumb::Crop(UPLOAD_PHOTO, $v['photo'], 1920, 700, 1) }}" alt="slider">
                        <div class="absolute w-full h-full m-auto top-[60%] left-0 z-[9999]">
                            <div class="content-page-layout">
                                <div class="flex flex-col gap-5 max-w-[600px]">
                                    <p
                                        class="relative z-[99] text-[40px] font-bold text-white tracking-[1px] hidden lg:block font-Roboto">
                                        {{ $v['ten' . $lang] }}
                                    </p>
                                    <div class="relative z-[99] mt-3 text-[16px] md:text-[16px] text-white leading-[160%]">
                                        {{ $v['mota' . $lang] }}
                                    </div>
                                    @if ($v['link'])
                                        <div class="flex justify-start items-center mt-4 btn-link-slider">
                                            <a href="{{ $v['link'] }}"
                                                class="text-[#EB5757] text-xl font-semibold"><span> Xem
                                                    chi tiết </span><i
                                                    class="text-[#EB5757] fas fa-arrow-right ml-3"></i></a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        @endhandheld
    </div>
</div>


@push('css_page')
    <style>
        .btn-link-slider a:hover {
            color: #39B54A;
        }

        .btn-link-slider a:hover i {
            color: #39B54A;
        }
    </style>
@endpush

@push('js_page')
@endpush
