@if($products && count($products)>0)
@handheld
@foreach ($products as $k => $v)
    @php
        
        $collection = (is_array($v)) ? collect($v['has_property']) : $v['HasProperty'];
        $keyed = $collection->mapWithKeys(function ($item) {
            return [$item['id_property'] => $item];
        });
        $keyed->all();
        $keyed = is_array($keyed) ? $keyed : $keyed->toArray();
    @endphp

    <div class="flex">
        <a class="w-[45%] md:w-[40%] bg-white flex items-center btn-dialog-show" data-id="{{$v['id']}}" data-type="{{$v['type']}}"><img src="{{Thumb::Crop(UPLOAD_PRODUCT,$v['photo'],876,876,1)}}" alt="{{$v['tenkhongdau'.$lang]}}"></a>
        <div class="w-[55%] md:w-[60%] flex flex-col gap-3 pl-5">
            @if(isset($thuoctinhs) && $thuoctinhs!=null)
                @foreach ($thuoctinhs as $kp => $vp)
                <p><span class="font-bold mr-3">{{ $vp['ten'.$lang] }} :</span>{{$keyed[$vp['id']]['belong_property']['ten'.$lang]}}</p>
                @endforeach
            @endif 
            <p><span class="font-bold mr-3">MM (ly) :</span>{{$v['ly']}}</p>
            <p><span class="font-bold mr-3">Chứng nhận :</span>{{$v['chungnhan']}}</p>
            <a href="{{$settingOption['messenger']}}" target="_blank" class="inline-flex bg-cmain2 hover:bg-cmain text-white rounded-md items-center justify-center px-5 py-2">{{__('Liên hệ')}}</a>
        </div>
    </div>
@endforeach
@elsedesktop
    <table class="w-full border border-collapse table-auto border-slate-400">
        <thead>
            <tr>
                <th class="table-h w-[100px]">{{__('Sản phẩm')}}</th>
                <th class="table-h">{{__('Mã SP')}}</th>
                @if(isset($thuoctinhs) && $thuoctinhs!=null)
                <th class="table-h">
                    {{$thuoctinhs[0]['ten'.$lang]}}
                </th>
                @endif
                <th class="table-h">{{__('Kích thước')}}</th>
                <th class="table-h">{{__('Khối lượng')}}</th>
                @if(isset($thuoctinhs) && $thuoctinhs!=null)
                    @foreach ($thuoctinhs as $k => $v)
                        @if($k!=0)<th class="table-h">{{ $v['ten'.$lang] }}</th>@endif
                    @endforeach
                @endif                                   
                <th class="table-h">{{__('Chứng nhận')}}</th>
                <th class="table-h w-[145px]">{{__('Giá')}}</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($products as $k => $v)
            @php
                
                $collection = (is_array($v)) ? collect($v['has_property']) : $v['HasProperty'];
                $keyed = $collection->mapWithKeys(function ($item) {
                    return [$item['id_property'] => $item];
                });
                $keyed->all();
                $keyed = is_array($keyed) ? $keyed : $keyed->toArray();
            @endphp
            <tr>
                <td class="table-d w-[100px] btn-dialog-show" data-id="{{$v['id']}}" data-type="{{$v['type']}}"><img src="{{Thumb::Crop(UPLOAD_PRODUCT,$v['photo'],876,876,1)}}" alt="{{$v['tenkhongdau'.$lang]}}" width="70" height="70"></td>
                <td class="table-d">{{ $v['masp'] }}</td>
                @if(isset($thuoctinhs) && $thuoctinhs!=null)
                <td class="table-d">
                    {{$keyed[$thuoctinhs[0]['id']]['belong_property']['ten'.$lang]}}
                </td>
                @endif
                <td class="table-d">{{ $v['kichthuoc'] }}</td>
                <td class="table-d">{{ $v['khoiluong'] }}</td>
                @if(isset($thuoctinhs) && $thuoctinhs!=null)
                    @foreach ($thuoctinhs as $kp => $vp)
                        @if($kp!=0)<td class="uppercase table-d">{{$keyed[$vp['id']]['belong_property']['ten'.$lang]}}</td>@endif
                    @endforeach
                @endif                                    
                <td class="table-d">{{ $v['chungnhan'] }}</td>
                <td class="table-d w-[145px]"><a href="{{$settingOption['messenger']}}" target="_blank" class="inline-flex items-center justify-center px-5 py-2 text-white transition-all duration-300 rounded-md bg-cmain2 hover:bg-cmain">{{__('Liên hệ')}}</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endhandheld
    @if (!is_array($products))
        <div class="row">
            <div class="col-sm-12 dev-center dev-paginator ajax-pagiantion">{{ $products->links() }}</div>
        </div>
    @endif
@else
	<div class="alert-data" role="alert">
		<strong><i class="mr-1 far fa-exclamation-circle"></i>{{ __('Không tìm thấy kết quả') }} !</strong>
	</div>
@endif


@push('js_page')
<script>
    $(document).on("click", function (event) {
        // If the target is not the container or a child of the container, then process
        // the click event for outside of the container.
        if ($(event.target).closest("#show-content-ajax").length === 0) {			
              $('.show-popup-close').trigger('click');
        }
    });
</script>
@endpush