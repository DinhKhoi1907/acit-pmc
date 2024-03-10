<div class="bg-cmain5 px-4 py-2 relative rounded-md border border-solid border-cmain4">
    <p class="absolute -top-5 -right-[18px]">        
    <p class="text-cmain uppercase font-bold text-base py-3 ">Danh mục sản phẩm</p>

    @if($danhmuc_cap1)
        <ul class="mt-2">
            <li class="py-3 hover:bg-cmain3 group rounded-md relative menu-sidebar-li  mb-1 {{Helper::currentMenu('san-pham','sidebar-active')}}"><a href="san-pham" class="text-cmain2 hover:text-cmain font-semibold uppercase group-hover:pl-3 transition-all duration-300">Tất cả sản phẩm</a></li>
            @foreach($danhmuc_cap1 as $k=>$v)
                @php
                    $childs = $v['has_level_child'];
                @endphp
                <li class="py-3 hover:bg-cmain3 group rounded-md relative menu-sidebar-li mb-1 {{Helper::currentMenu($v['tenkhongdau'.$lang],'sidebar-active')}}"><a href="{{$v['tenkhongdau'.$lang]}}" class="text-cmain2 hover:text-cmain font-semibold uppercase pl-3 transition-all duration-300">{{$v['ten'.$lang]}}</a>
                    @if($childs)
                        <ul class="absolute bg-cmain5 top-0 w-full left-[100%] rounded-md">
                            @foreach($childs as $k=>$v)
                                <li class="py-3 pl-5"><a href="{{$v['tenkhongdau'.$lang]}}" class="text-cmain2 hover:text-cmain font-semibold uppercase group-hover:pl-3 transition-all duration-300">{{$v['ten'.$lang]}}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>