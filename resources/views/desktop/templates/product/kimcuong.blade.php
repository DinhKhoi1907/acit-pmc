@extends('desktop.master')



@section('element_detail', 'main_page_detail')



@section('banner')

    @include('desktop.layouts.banner')

@endsection



@section('filter')

    @include('desktop.layouts.filterKC')

@endsection



@section('content')

    <div class="bg-cmain3 lg:py-12 bor-none">

        <div class="lg:py-4 content-page-layout">            
            <div class="">

                @if (isset($products) && count($products) > 0)

                    <div id="showcategory_products">	
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

                                <div class="flex mb-5 last-mb-0">
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

                                <div class="col-sm-12 dev-center dev-paginator">{{ $products->links() }}</div>

                            </div>
                        @endif

                    </div>
                @else
                    <div class="alert-data" role="alert">

                        <strong><i class="mr-1 far fa-exclamation-circle"></i>{{ __('Không tìm thấy kết quả') }} !</strong>

                    </div>

                @endif



            </div>

        </div>

    </div>
@endsection



<!--css thêm cho mỗi trang-->

@push('css_page')
    <link rel="stylesheet" href="{{ asset('css/images-compare.css') }}">
@endpush



<!--js thêm cho mỗi trang-->

@push('js_page')
    <script>
        $(document).on("click", function (event) {
        	// If the target is not the container or a child of the container, then process
        	// the click event for outside of the container.
        	if ($(event.target).closest("#show-content-ajax").length === 0) {			
        	  	$('.show-popup-close').trigger('click');
        	}
        });

        $('body').on('click', '.btn-dialog-show', function() {
            var id = $(this).attr('data-id');
            var type = $(this).attr('data-type');
            LoadPostHome(id,type);
        });

        function LoadPostHome(id,type){
            $('#loading_order').show();

            $.ajax({
                url: "{{ route('ajax.loadpostdetailhome') }}",
                type: 'POST',
                dataType: 'html',
                async: true,
                data: {id:id, type:type, _token: $('meta[name="csrf-token"]').attr('content')},
                success:function(data)
                {
                    $('#loading_order').hide();
                    $('#show-popup-post').addClass('show-popup-active');
                    $('#show-content-ajax').html(data);
                }
            });
        }

        $( "body" ).on( "click", ".show-popup-close", function() {
            $('#show-popup-post').removeClass('show-popup-active');
            $('#show-content-ajax').html('');
        });
    </script>


    <!-- Like Share -->
    <script src="//sp.zalo.me/plugins/sdk.js"></script>
    <script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55e11040eb7c994c" async="async"></script>

    <script type="text/javascript">
        var addthis_config = addthis_config || {};

        addthis_config.lang = LANG
    </script>
@endpush



@push('strucdata')
    @include('desktop.layouts.strucdata')
@endpush
