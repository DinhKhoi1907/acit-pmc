@if($products)
<div class="home-expert-container">
	<div class="home-expert-main">
		@foreach($products as $k=>$v)
		@php
			$sosao = $v['sosao'];
		@endphp
		@if($k==0 || $k%2==0)<div class="home-expert-box">@endif
			<div class="home-expert-item hover-star himg wow animate__animated animate__fadeInRight">
				<img src="{{Thumb::Crop(UPLOAD_PRODUCT,$v['photo'],170,208,1)}}" alt="" width="170" height="208" alt="{{$v['tenkhongdau'.$lang]}}">
				<a href="{{$v['tenkhongdau'.$lang]}}" class="home-expert-item-info">
					<span class="home-expert-item-name">{{$v['ten'.$lang]}}</span>
					@if($v['giatext']!='')<span class="home-expert-item-price">{{$v['giatext']}}usd</span>@endif
					@if($sosao>0)
					<p class="home-expert-item-star">
						@for($i=1;$i<=$sosao;$i++)
							<i class="fas fa-star"></i>
						@endfor
					</p>
					@endif
				</a>
			</div>
		@if(($k+1)%2==0 || ($k+1)>=count($products))</div>@endif
		@endforeach
	</div>
</div>
<div class="home-expert-scroll">
	<div class="home-expert-scroll-box">
		<span class="home-expert-scroll-prev">
			<svg width="17" height="10" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M0.181903 4.70504C0.0881345 4.79881 0.0354556 4.92599 0.0354556 5.05859C0.0354556 5.1912 0.0881345 5.31838 0.181903 5.41215L4.42454 9.65479C4.51831 9.74856 4.64549 9.80123 4.7781 9.80123C4.9107 9.80123 5.03788 9.74856 5.13165 9.65479C5.22542 9.56102 5.2781 9.43384 5.2781 9.30123C5.2781 9.16863 5.22542 9.04145 5.13165 8.94768L1.74249 5.55852L16.0918 5.55923C16.1575 5.55923 16.2226 5.54628 16.2834 5.52112C16.3441 5.49596 16.3993 5.45908 16.4458 5.41259C16.4923 5.36611 16.5292 5.31092 16.5543 5.25018C16.5795 5.18944 16.5924 5.12434 16.5924 5.05859C16.5924 4.99285 16.5795 4.92775 16.5543 4.86701C16.5292 4.80627 16.4923 4.75108 16.4458 4.70459C16.3993 4.65811 16.3441 4.62123 16.2834 4.59607C16.2226 4.57091 16.1575 4.55796 16.0918 4.55796L1.74249 4.55867L5.13165 1.16951C5.22542 1.07574 5.2781 0.948562 5.2781 0.815954C5.2781 0.683346 5.22542 0.556168 5.13165 0.4624C5.03788 0.368631 4.9107 0.315953 4.7781 0.315953C4.64549 0.315953 4.51831 0.368631 4.42454 0.4624L0.181903 4.70504Z" fill="#CC965F"/>
			</svg>
		</span>
		<div class="home-expert-scroll-math"><span class="home-expert-scroll-btn"></span></div>
		<span class="home-expert-scroll-next">
			<svg width="17" height="10" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M16.4455 4.70504C16.5393 4.79881 16.592 4.92599 16.592 5.05859C16.592 5.1912 16.5393 5.31838 16.4455 5.41215L12.2029 9.65479C12.1091 9.74856 11.982 9.80123 11.8493 9.80123C11.7167 9.80123 11.5896 9.74856 11.4958 9.65479C11.402 9.56102 11.3493 9.43384 11.3493 9.30123C11.3493 9.16863 11.402 9.04145 11.4958 8.94768L14.885 5.55852L0.535637 5.55923C0.469893 5.55923 0.404793 5.54628 0.344053 5.52112C0.283314 5.49596 0.228125 5.45908 0.181637 5.41259C0.135149 5.36611 0.0982725 5.31092 0.0731134 5.25018C0.0479544 5.18944 0.0350049 5.12434 0.0350049 5.05859C0.0350049 4.99285 0.0479544 4.92775 0.0731134 4.86701C0.0982725 4.80627 0.135149 4.75108 0.181637 4.70459C0.228125 4.65811 0.283314 4.62123 0.344053 4.59607C0.404793 4.57091 0.469893 4.55796 0.535637 4.55796L14.885 4.55867L11.4958 1.16951C11.402 1.07574 11.3493 0.948562 11.3493 0.815954C11.3493 0.683346 11.402 0.556168 11.4958 0.4624C11.5896 0.368631 11.7167 0.315953 11.8493 0.315953C11.982 0.315953 12.1091 0.368631 12.2029 0.4624L16.4455 4.70504Z" fill="#CC965F"/>
			</svg>
		</span>
	</div>
</div>
@endif