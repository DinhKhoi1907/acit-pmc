@if(isset($danhgia_list) && $danhgia_list)
<div class="mt-4 box-danhgia-list" id="show_danhgia_ajax">
    <div class="px-5 py-4 bg-cmain3 lg:px-0">
        <div class="flex justify-between content-layout-danhgia">
            <div class="flex items-center">
                <span class="text-4xl font-semibold text-cmain2">{{$average_score}}.0</span>
                <div class="flex items-center gap-1 ml-5 text-[17px]">
                    @for($i=1;$i<=$average_score;$i++)
                        <i class="fas fa-star text-[#E3B647]"></i>
                    @endfor
                    @for($i=$average_score+1;$i<=5;$i++)
                        <i class="far fa-star text-[#E3B647]"></i>
                    @endfor                    
                </div>    
                <span class="ml-5 text-[#1E1E1E] font-semibold">{{$info_rating['allrating']}} {{__('lượt đánh giá')}}</span>
            </div>
            <div class="flex items-center gap-9">
                <span class="cursor-pointer danhgia-nav-prev"><svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 1L1.70711 8.29289C1.31658 8.68342 1.31658 9.31658 1.70711 9.70711L9 17" stroke="#1E1E1E" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </span>
                <span class="cursor-pointer danhgia-nav-next"><svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L8.29289 8.29289C8.68342 8.68342 8.68342 9.31658 8.29289 9.70711L1 17" stroke="#1E1E1E" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </span>
            </div>
        </div>
    </div>    

    
    <div class="mt-12">
        <div class="danhgia__owl owl-carousel owl-theme">
        @foreach($danhgia_list as $k=>$v)
            @if($k==0 || $k%5==0)<div>@endif
                @php
                    $arr_name = explode(' ', $v['tenvi']);
                    $name = $arr_name[count($arr_name)-1];
                    $photos = json_decode($v['photo'], true);
                    $user = (Auth::guard()->check()) ? Auth::guard()->user()->toArray() : null;
                @endphp
                <div class="border-0 border-b border-solid pb-7 border-[rgba(30,30,30,0.1)] last:border-0 mb-7">
                    <div class="flex gap-8 content-layout-danhgia">
                        @if($user['photo']!='')
                        <img class="w-[60px] h-[60px] rounded-full" src="{{ ($user['photo']) ? Thumb::Crop(UPLOAD_USER,$user['photo'],100,100,1) : '' }}" alt="">
                        @else
                        <span class="w-[60px] h-[60px] bg-cmain2 text-white font-semibold text-3xl rounded-full flex items-center justify-center">{{Str::substr($name, 0, 1);}}</span>
                        @endif
                        <div>
                            <p class="mb-2 font-normal text-black">{{$v['tenvi']}}</p>
                            <div class="flex items-end gap-5">
                                <div class="flex gap-1">
                                    @for($i=1;$i<=$v['star'];$i++)
                                        <i class="fas fa-star text-[#E3B647]"></i>
                                    @endfor
                                    @for($i=$v['star']+1;$i<=5;$i++)
                                        <i class="far fa-star text-[#E3B647]"></i>
                                    @endfor
                                </div>
                                <span class="opacity-50 text-cmain text-[10px] font-semibold">{{date('d/m/Y',$v['ngaytao'])}} lúc {{date('H:i',$v['ngaytao'])}}</span>
                            </div>
                            <div class="mt-2 text-3">{{$v['noidungvi']}}</div>
                            <div class="mt-3 box-danhgia-photos">
                                @if($photos)
                                    @foreach($photos as $p=>$photo)
                                        @if(Helper::CheckFile($photo)=='mp4')
                                            <a data-src="{{UPLOAD_IMAGE.$photo}}" data-fancybox="danhgia-{{$k}}" class="mr-1">
                                                <p class="danhgia-load-canvas" video="{{Helper::GetConfigBase().UPLOAD_IMAGE.$photo}}" data-id="{{$k.'-'.$p}}">
                                                    <video id="video-{{$k.'-'.$p}}" class="video-btn" widht="50" height="50">
                                                        <source type="video/mp4" src="{{Helper::GetConfigBase().UPLOAD_IMAGE.$photo}}"><!-- FireFox 3.5 -->
                                                        Your browser does not support HTML5 video tag. Please download FireFox 3.5 or higher.
                                                    </video>
                                                    {{--<canvas id="video-canvas-{{$k.'-'.$p}}"></canvas>
                                                    <img id="video-img-{{$k.'-'.$p}}" src="" class="d-none video-img">--}}
                                                </p>
                                            </a>
                                        @else
                                            <a data-src="{{UPLOAD_IMAGE.$photo}}" data-fancybox="danhgia-{{$k}}" class="mr-1 w-[50px] h-[50px]"><img src="{{Thumb::Crop(UPLOAD_IMAGE,$photo,50,50,2)}}" alt="" width="50" height="50"></a>
                                        @endif
                                    @endforeach
                                    {{--<a data-src="https://play-ws.vod.shopee.com/c3/98934353/103/AnoyC48AlO1ZkvwhegEVAEc.mp4" data-fancybox="danhgia-{{$k}}" class="mr-1"><img src="https://1500000774.vod2.myqcloud.com/412c22d9vodhk1500000774/4619d615387702296282136545/387702296282136546.jpg"></a>--}}
                                @endif
                            </div>
                            
                            {{-- @if($v['answer']!='')
                                <div class="mt-3 box-hoidap-answer"> 
                                    <div class="box-hoidap-answer-admin"> 
                                        <span class="box-hoidap-answer-img">
                                            <img src="{{Thumb::Crop(UPLOAD_USER,$setting['photo'],35,35,1)}}" alt="admin">
                                        </span> 
                                        <div class="box-hoidap-answer-info"> 
                                            <span class="box-hoidap-answer-name">Admin</span> 
                                            <div class="box-hoidap-answer-content">{{$v['answer']}}</div> 
                                        </div> 
                                    </div> 
                                </div>
                            @endif --}}

                        </div>
                    </div>
                </div>
            @if(($k+1)%5==0 || ($k+1)>=count($danhgia_list))</div>@endif
        @endforeach
        </div>
    </div>


    {{-- @if(isset($danhgia_list) && $danhgia_list)
        @foreach($danhgia_list as $k=>$v)
            @php
                $arr_name = explode(' ', $v['tenvi']);
                $name = $arr_name[count($arr_name)-1];
                $photos = json_decode($v['photo'], true);
            @endphp
            <div class="box-danhgia-item">
                <span class="box-danhgia-char">{{Str::substr($name, 0, 1);}}</span>
                <div class="box-danhgia-info">
                    <div class="box-danhgia-infoname">
                        <div class="mr-2 box-danhgia-name">{{$v['tenvi']}}</div>
                        <div class="box-danhgia-time">{{Helper::TimeElapsed($v['ngaytao'])}}</div>
                    </div>
                    <div class="box-danhgia-infostar">
                        <div class="mr-2 box-danhgia-star-list">
                            @for($i=1;$i<=$v['star'];$i++)
                                <i class="fas fa-star"></i>
                            @endfor
                            @for($i=$v['star']+1;$i<=5;$i++)
                                <i class="far fa-star"></i>
                            @endfor
                        </div>
                        <div class="box-danhgia-confirm"><i class="far fa-badge-check"></i> <span>Đã mua sản phẩm</span></div>
                    </div>
                    <div class="mt-3 box-danhgia-content">{{$v['noidungvi']}}</div>
                    <div class="mt-3 box-danhgia-photos">
                        @if($photos)
                            @foreach($photos as $p=>$photo)
                                @if(Helper::CheckFile($photo)=='mp4')
                                    <a data-src="{{UPLOAD_IMAGE.$photo}}" data-fancybox="danhgia-{{$k}}" class="mr-1">
                                        <p class="danhgia-load-canvas" video="{{Helper::GetConfigBase().UPLOAD_IMAGE.$photo}}" data-id="{{$k.'-'.$p}}">
                                            <video id="video-{{$k.'-'.$p}}" class="video-btn" widht="88" height="88">
                                                <source type="video/mp4" src="{{Helper::GetConfigBase().UPLOAD_IMAGE.$photo}}"><!-- FireFox 3.5 -->
                                                Your browser does not support HTML5 video tag. Please download FireFox 3.5 or higher.
                                            </video>
                                            <canvas id="video-canvas-{{$k.'-'.$p}}"></canvas>
                                            <img id="video-img-{{$k.'-'.$p}}" src="" class="d-none video-img">
                                        </p>
                                    </a>
                                @else
                                    <a data-src="{{UPLOAD_IMAGE.$photo}}" data-fancybox="danhgia-{{$k}}" class="mr-1"><img src="{{Thumb::Crop(UPLOAD_IMAGE,$photo,88,88,2)}}" alt=""></a>
                                @endif
                            @endforeach
                            
                        @endif
                    </div>
                    <div class="mt-2 box-danhgia-date">{{date('d/m/Y', $v['ngaytao'])}} lúc {{date('h:m', $v['ngaytao'])}}</div>

                    @if($v['answer']!='')
                    <div class="mt-3 box-hoidap-answer"> 
                        <div class="box-hoidap-answer-admin"> 
                            <span class="box-hoidap-answer-img">
                                <img src="{{Thumb::Crop(UPLOAD_USER,$setting['photo'],35,35,1)}}" alt="admin">
                            </span> 
                            <div class="box-hoidap-answer-info"> 
                                <span class="box-hoidap-answer-name">Admin</span> 
                                <div class="box-hoidap-answer-content">{{$v['answer']}}</div> 
                            </div> 
                        </div> 
                    </div>
                    @endif
                </div>
            </div>
        @endforeach

        @if(isset($danhgia_list) && !is_array($danhgia_list))
            <div class="clear"></div>
            <div class="row">
               <div class="col-sm-12 dev-center dev-paginator">{{ $danhgia_list->links() }}</div>
            </div>
        @endif
    @endif --}}
</div>
@endif


@push('css_page')
	<link rel="stylesheet" href="{{ asset('css/danhgia.css') }} ">
    <style>
        .danhgia__owl.owl-carousel .owl-item img{width:initial !important;}
    </style>
@endpush

@push('js_page')
<script>
    if($(".danhgia__owl").exists()) {
		var owl = $('.danhgia__owl');
		owl.owlCarousel({
			autoplay:false,
			dots: false,
			autoplayHoverPause:true,
			autoplaySpeed: 1500,
			nav: false,
            items: 1,
			navText: ["<span class='slide-nav-right'><img src='img/arrow1.png'></span>","<span class='slide-nav-left'><img src='img/arrow1.png'></span>"],
			loop: false,
			onInitialized: function() {
				//$('.tintuc__owl').append('<a href="tin-tuc" class="btn-view-product">Xem tất cả</a>');
			}			
		});

        $('.danhgia-nav-next').click(function() {
            owl.trigger('next.owl.carousel');
        })

        $('.danhgia-nav-prev').click(function() {
            owl.trigger('prev.owl.carousel');
        })
	}
</script>
@endpush