<div class="home-ouracre bortop wow animate__animated animate__fadeInUp">
	<div class="content-page-layout">
		<p class="home-title">{{sucongnhan}}</p>
		<div class="ouraccre__owl owl-carousel owl-theme">
			@foreach($ouraccreditation as $k=>$v)
				<div class="ouraccre-item">
					<a href="{{$v['link']}}" target="_blank" class="himg"><img src="{{Thumb::Crop(UPLOAD_PHOTO,$v['photo'],175,85,1,$v['type'])}}" alt="" width="175" height="85"></a>
				</div>
			@endforeach
		</div>
	</div>
</div>