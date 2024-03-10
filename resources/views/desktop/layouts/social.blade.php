@php
	$mangxahoi = app('mangxahoi');
@endphp
@if($mangxahoi)
<div class="mangxahoi_container ">
	@foreach($mangxahoi as $k=>$v)
		<a href="{{$v['link']}}" target="_blank"><img src="{{Thumb::Crop(UPLOAD_PHOTO,$v['photo'],40,40,1)}}" alt="" width="40" height="40"></a>
	@endforeach
	{{-- <a href=""><img src="img/home/tele.png" alt="" width="40" height="40"></a>
	<a href=""><img src="img/home/zalo.png" alt="" width="40" height="40"></a>
	<a href=""><img src="img/home/hotline.png" alt="" width="40" height="40"></a>
	<a href=""><img src="img/home/messenger.png" alt="" width="40" height="40"></a> --}}
</div>
@endif