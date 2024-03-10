@if($product)
@php                                    
	$collection = (is_array($product)) ? collect($product['has_property']) : $product['HasProperty'];
	$keyed = $collection->mapWithKeys(function ($item) {
		return [$item['id_property'] => $item];
	});
	$keyed->all();
	$keyed = is_array($keyed) ? $keyed : $keyed->toArray();
@endphp

	<div class="flex justify-between items-center px-6 md:px-12 bg-cmain2">		
		<div class="font-bold text-white md:text-[26px] uppercase text-xl lg:text-[24px]"><span>{{$product['ten'.$lang]}}</span></div>
		<span class="show-popup-close py-2 md:py-4 cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"><path fill="#fff" d="M23 20.168l-8.185-8.187 8.185-8.174-2.832-2.807-8.182 8.179-8.176-8.179-2.81 2.81 8.186 8.196-8.186 8.184 2.81 2.81 8.203-8.192 8.18 8.192z"/></svg></span>
	</div>

	<div class="md:p-12 p-6 max-h-[88%] overflow-auto scroll-css">
		<div class="flex items-center flex-col lg:flex-row">			
			<p class="w-full lg:w-[45%]  himg"><img class="" src="{{ Thumb::Crop(UPLOAD_PRODUCT,$product['photo'],876,876,1) }}" alt="{{$product['ten'.$lang]}}" class=""></p>		
			<div class="w-full lg:w-[55%] pl-0 lg:pl-8">				
				<p class="mt-2 text-base"><span>{{__('Mã SP')}}</span> : {{$product['masp']}}</p>
				
				<div class="mt-5">
					<table class="w-full border border-collapse table-auto border-slate-400">
						<tr class="odd:bg-gray-50">
							<td class="text-base capitalize font-semibold p-3">MM (ly)</td>
							<td class="text-base p-3">{{$product['ly']}}</td>
						</tr>
						@if(isset($thuoctinhs) && $thuoctinhs!=null)
							@foreach ($thuoctinhs as $k => $v)
								<tr class="odd:bg-gray-50">
									<td class="text-base capitalize font-semibold p-3">{{ $v['ten'.$lang] }}</td>
									<td class="text-base p-3 uppercase">{{$keyed[$v['id']]['belong_property']['ten'.$lang]}}</td>
								</tr>
							@endforeach
						@endif
						<tr class="odd:bg-gray-50">
							<td class="text-base capitalize font-semibold p-3">{{__('Kích thước')}}</td>
							<td class="text-base p-3">{{$product['kichthuoc']}}</td>
						</tr>
						<tr class="odd:bg-gray-50">
							<td class="text-base capitalize font-semibold p-3">{{__('Khối lượng')}}</td>
							<td class="text-base p-3">{{$product['khoiluong']}}</td>
						</tr>
						<tr class="odd:bg-gray-50">
							<td class="text-base capitalize font-semibold p-3">{{__('Chứng nhận')}}</td>
							<td class="text-base p-3">{{$product['chungnhan']}}</td>
						</tr>
					</table>
				</div>
				<p class="mt-5 flex justify-end"><a href="{{$settingOption['messenger']}}" target="_blank" class="inline-flex bg-cmain2 hover:bg-cmain text-white rounded-md items-center justify-center px-5 py-2 text-base font-bold w-full lg:w-auto"><svg class="mr-2" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path fill="white" d="M12 0c-6.627 0-12 4.975-12 11.111 0 3.497 1.745 6.616 4.472 8.652v4.237l4.086-2.242c1.09.301 2.246.464 3.442.464 6.627 0 12-4.974 12-11.111 0-6.136-5.373-11.111-12-11.111zm1.193 14.963l-3.056-3.259-5.963 3.259 6.559-6.963 3.13 3.259 5.889-3.259-6.559 6.963z"/></svg>{{__('Liên hệ')}}</a></p>
			</div>
		</div> 
	</div>
@else
	<div class="alert-data" role="alert">
		<strong><i class="mr-1 far fa-exclamation-circle"></i>{{__('Nội dung đang được cập nhật')}} ...</strong>
	</div>
@endif