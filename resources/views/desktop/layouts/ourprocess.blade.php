<div class="home-whyworld home-ourprocess">
	<div class="home-whyworld-contain">
		<p class="home-title">{{quatrinhlamviec}}</p>
		<div class="content-page-layout">
			<div class="whyworld__owl owl-carousel owl-theme">
				@foreach($ourprocess as $k=>$v)
					<div class="whyworld-item">
						<p class="home-whyworld-icon himg"><img src="{{Thumb::Crop(UPLOAD_PHOTO,$v['photo'],100,100,1,$v['type'])}}" alt="" width="100" height="100"></p>
						<h3 class="home-whyworld-name">{{$v['ten'.$lang]}}</h3>
						<div class="home-whyworld-mota">{{$v['mota'.$lang]}}</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>