@foreach ($cateBlog as $l => $list)
    @php
        $items = $list['has_all_post'];
    @endphp
    @if ($items)
        <div class="p-8 mb-20 border border-solid rounded-none border-cmain revealOnScroll"
            data-animation="animate__fadeInUp" data-timeout="{{ ($l + 1) * 200 }}">
            <div class="mb-5 -mt-16 text-center">
                <p class="inline-block px-3 py-5 text-white uppercase bg-cmain w-[80%] m-auto text-center">
                    {{ $list['ten' . $lang] }}</p>
            </div>
            <ul class="flex flex-col gap-3 pl-3 mt-8 css_define w-[80%] m-auto" style="list-style-type:square">
                @foreach ($items as $k => $v)
                    @if ($k < 5)
                        <li><a href="{{ $v['tenkhongdau' . $lang] }}"
                                class="text-black transition-all duration-500 hover:text-cmain">{{ $v['ten' . $lang] }}</a>
                        </li>
                        @if (config('config_all.data_demo'))
                            <li><a href="{{ $v['tenkhongdau' . $lang] }}"
                                    class="text-black transition-all duration-500 hover:text-cmain">{{ $v['ten' . $lang] }}</a>
                            </li>
                            <li><a href="{{ $v['tenkhongdau' . $lang] }}"
                                    class="text-black transition-all duration-500 hover:text-cmain">{{ $v['ten' . $lang] }}</a>
                            </li>
                            <li><a href="{{ $v['tenkhongdau' . $lang] }}"
                                    class="text-black transition-all duration-500 hover:text-cmain">{{ $v['ten' . $lang] }}</a>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
            <p class="mt-6 text-right w-[80%] m-auto"><a href="{{ $list['tenkhongdau' . $lang] }}"
                    class="text-[11px] font-medium transition-all duration-500 bg-white text-cmain hover:text-cmain3">[{{ __('Xem tất cả') }}...]</a>
            </p>
        </div>
    @endif
@endforeach
