@php
	$likes = count(array_filter(explode(',', $row_detail['likes'])));
@endphp
<div class="my-5 box-share-container">
	<div class="box-share-likes">
		<a class="box-share-like-button" data-id="{{$row_detail['id']}}">
			<svg class="mr-1" width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M40 23.2C40 21.1 38.3 20 36 20H29.3C29.8 18.2 30 16.5 30 15C30 9.2 28.4 8 27 8C26.1 8 25.4 8.1 24.5 8.6C24.2 8.8 24.1 9 24 9.3L23 14.7C21.9 17.5 19.2 20 17 21.7V36C17.8 36 18.6 36.4 19.6 36.9C20.7 37.4 21.8 38 23 38H32.5C34.5 38 36 36.4 36 35C36 34.7 36 34.5 35.9 34.3C37.1 33.8 38 32.8 38 31.5C38 30.9 37.9 30.4 37.7 29.9C38.5 29.4 39.2 28.5 39.2 27.5C39.2 26.9 38.9 26.3 38.6 25.8C39.4 25.2 40 24.2 40 23.2ZM37.9 23.2C37.9 24.5 36.6 24.6 36.4 25.2C36.2 25.9 37.2 26.1 37.2 27.3C37.2 28.5 35.7 28.5 35.5 29.2C35.3 30 36 30.2 36 31.4V31.6C35.8 32.6 34.3 32.7 34 33.1C33.7 33.6 34 33.8 34 34.9C34 35.5 33.3 35.9 32.5 35.9H23C22.2 35.9 21.4 35.5 20.4 35C19.6 34.6 18.8 34.2 18 34V23.5C20.5 21.6 23.7 18.8 24.9 15.3V15.1L25.8 10.1C26.2 10 26.5 10 27 10C27.2 10 28 11.2 28 15C28 16.5 27.7 18.1 27.2 20H27C26.4 20 26 20.4 26 21C26 21.6 26.4 22 27 22H36C37 22 37.9 22.5 37.9 23.2Z" fill="#82B440"/>
				<path d="M16 38H10C8.9 38 8 37.1 8 36V22C8 20.9 8.9 20 10 20H16C17.1 20 18 20.9 18 22V36C18 37.1 17.1 38 16 38ZM10 22V36H16V22H10Z" fill="#82B440"/>
			</svg>Thích
		</a>
		<span class="box-share-like-number">{{$likes}}</span>
	</div>

	<div class="box-share-button">
		<span>Chia sẻ</span>
		<div class="box-share-button-list">
			<a data-href="https://www.facebook.com/sharer/sharer.php?u={{Helper::GetConfigBase().$row_detail['tenkhongdau'.$lang].'-'.$row_detail['id']}}" class="himg share-btn-item"><img src="img/icon/s_face.png" alt="" width="43" height="43" ></a>
			{{--<a href="#" class="himg"><img src="img/icon/s_insta.png" alt="" width="43" height="43"></a>--}}
			<a data-href="https://twitter.com/share?url={{Helper::GetConfigBase().$row_detail['tenkhongdau'.$lang].'-'.$row_detail['id']}}&text={{$row_detail['ten'.$lang]}}" class="himg share-btn-item"><img src="img/icon/s_twiter.png" alt="" width="43" height="43"></a>
			{{--<a href="#" class="himg"><img src="img/icon/s_tiktok.png" alt="" width="43" height="43"></a>--}}
			<a data-href="https://pinterest.com/pin/create/bookmarklet/?media={{Helper::GetConfigBase().UPLOAD_POST.$row_detail['photo']}}&url={{Helper::GetConfigBase().$row_detail['tenkhongdau'.$lang].'-'.$row_detail['id']}}&description={{$row_detail['ten'.$lang]}}" class="himg share-btn-item"><img src="img/icon/s_pin.png" alt="" width="43" height="43"></a>
			<a class="himg btn-save-post" data-id="{{$row_detail['id']}}"><img src="img/icon/s_down.png" alt="" width="43" height="43"></a>
		</div>
	</div>
</div>

@push('css_page')
    <link rel="stylesheet" href="{{ asset('css/share.css') }}">
@endpush


@push('js_page')
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
	<script async src="https://assets.pinterest.com/js/pinit.js" charset="utf-8"></script>
	

	<script>
		$(".share-btn-item").on("click",function(){
			var href = $(this).attr('data-href');			
		  	popupCenter({url: href, title: 'Share', w: 600, h: 400});  
		  	return false;
		});


		const popupCenter = ({url, title, w, h}) => {
		    // Fixes dual-screen position                             Most browsers      Firefox
		    const dualScreenLeft = window.screenLeft !==  undefined ? window.screenLeft : window.screenX;
		    const dualScreenTop = window.screenTop !==  undefined   ? window.screenTop  : window.screenY;

		    const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
		    const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

		    const systemZoom = width / window.screen.availWidth;
		    const left = (width - w) / 2 / systemZoom + dualScreenLeft
		    const top = (height - h) / 2 / systemZoom + dualScreenTop
		    const newWindow = window.open(url, title, 
		      `
		      scrollbars=yes,
		      width=${w / systemZoom}, 
		      height=${h / systemZoom}, 
		      top=${top}, 
		      left=${left}
		      `
		    )

		    if (window.focus) newWindow.focus();
		}
	</script>

	<script>
		$('.box-share-like-button').click(function(){
			var id = $(this).attr('data-id');
			var e = $(this);

			$.ajax({
				url: '{{route('ajax.addLikePost')}}',
				type: "POST",
				dataType: 'json',
				async: true,
				data: {id:id, _token:$('meta[name="csrf-token"]').attr('content')},
				success: function(result){
					if(result) {
						console.log(result);
						$('.box-share-like-number').text(result.count);

						if(result.result==false){
							Swal.fire({
							  position: 'top',
							  icon: result.icon,
							  title: '<p class="h6">'+result.text+'</p>',
							  showConfirmButton: false,
							  timer: 2000,
							  toast: true
						  	});
						}
					}					
				},
				complete: function(){
			        
			    }
			});
		});


		$('.btn-save-post').click(function(){
			var id = $(this).attr('data-id');
			var e = $(this);

			$.ajax({
				url: '{{route('ajax.addSavePost')}}',
				type: "POST",
				dataType: 'json',
				async: true,
				data: {id:id, _token:$('meta[name="csrf-token"]').attr('content')},
				success: function(result){
					if(result) {
						Swal.fire({
						  position: 'top',
						  icon: result.icon,
						  title: '<p class="h6">'+result.text+'</p>',
						  showConfirmButton: false,
						  timer: 2000,
						  toast: true
					  	});
					}					
				},
				complete: function(){
			        
			    }
			});
		});
	</script>
@endpush




{{--
	<div class="share">
                <div class="flex-wrap social-plugin d-flex w-clear">
                    <div class="addthis_inline_share_toolbox_qj48"></div>
                    <div class="ml-2 zalo-share-button" data-href="{{Helper::getCurrentPageURL()}}" data-oaid="{{($settingOption['oaidzalo']!='')?$settingOption['oaidzalo']:'579745863508352884'}}" data-layout="1" data-color="blue" data-customize=false></div>
                </div>
            </div>
--}}
