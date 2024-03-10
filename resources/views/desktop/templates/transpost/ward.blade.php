<!-- @if($ward)
	@if($transpost_type=='ViettelPost')
		@foreach($ward as $k=>$v)
			<div class="location-option" data-value="{{$v['WARDS_ID']}}" data-box="ward" type="{{$transpost_type}}">{{$v['WARDS_NAME']}}</div>
		@endforeach
	@endif
@endif -->


@if($ward)
	@foreach($ward as $k=>$v)
		<div class="location-option" data-value="{{$v['id']}}" data-box="ward" type="">{{$v['ten']}}</div>
	@endforeach
@endif