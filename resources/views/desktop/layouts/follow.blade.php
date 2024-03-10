@if($followInstagram)

@php

    $photos = $followInstagram['get_photos'];



    if(config('config_all.data_demo')){

        //### test duplicate array customer

        $arr_tmp = array();

        for($i=0;$i<2;$i++){

            $arr_tmp = array_merge($photos, $arr_tmp);

        }

        $photos = $arr_tmp;

    }

@endphp

<div class="bg-cmain3 md:py-[67px] pb-0 pt-[67px]">

    <div class="content-page-layout">

        @if($lang=='vi')
        <a href="{{$settingOption['instagram']}}" target="_blank" class="text-cmain text-2xl md:text-[32px] mb-[45px] text-center block">THEO DÕI <span class="font-semibold text-cmain2">TRANG SỨC VIỆT NAM</span> TRÊN <span class="font-semibold text-cmain2">INSTAGRAM</span></a>
        @else
        <a href="{{$settingOption['instagram']}}" target="_blank" class="text-cmain text-2xl md:text-[32px] mb-[45px] text-center block">FOLLOW <span class="font-semibold text-cmain2">VIETNAM JEWELRY</span> ON <span class="font-semibold text-cmain2">INSTAGRAM</span></a>
        @endif

        <div class="follow__owl owl-carousel owl-theme">

            @foreach($photos as $k=>$v)

                <p class="lazy"><img class="w-auto" src="{{Thumb::Crop(UPLOAD_STATICPOST,$v['photo'],582,412,1)}}" alt="" width="291" height="206"></p>

            @endforeach

        </div>

    </div>

</div>

@endif