<!DOCTYPE html>

<html>

<head>

	<!-- UTF-8 -->

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



  	<style>

		body{overflow: hidden;}

		.bg-inform{/*background: url({{asset('img/mail/inform.png')}}) no-repeat bottom center;*/height: 100vh;/*display: flex; justify-content: center;*/}

		.bg-inform-title{width: 100%; min-height: 0px; /*border-radius: 20px; */border: 2px dashed rgba(38, 185, 154, 0.5); text-align: center;/*display: flex; justify-content: center; align-items: center;*/background: #fff;}

		.bg-inform-title span{background: rgba(38, 185, 154, 0.3); color: #26b99a;font-weight: bold;font-size: 22px;padding: 15px 10px;display: block;}

	</style>

	<link href="{{ asset('public/css/app.css') }}" rel="stylesheet">

</head>

<body class="flex items-center justify-center h-screen bg-gray-50 font-body">

	<div class="p-12 m-auto text-center bg-white lg:w-2/4 sm:w-3/4">
		<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24"><path d="M21.856 10.303c.086.554.144 1.118.144 1.697 0 6.075-4.925 11-11 11s-11-4.925-11-11 4.925-11 11-11c2.347 0 4.518.741 6.304 1.993l-1.422 1.457c-1.408-.913-3.082-1.45-4.882-1.45-4.962 0-9 4.038-9 9s4.038 9 9 9c4.894 0 8.879-3.928 8.99-8.795l1.866-1.902zm-.952-8.136l-9.404 9.639-3.843-3.614-3.095 3.098 6.938 6.71 12.5-12.737-3.096-3.096z" class="fill-[darkseagreen]"/></svg>
		<p class="text-3xl font-semibold text-bgmain3">Bạn đã đặt hàng thành công !</p>
		<div class="leading-6">{{$text}}</div>
		<a href="{{route('home')}}" class="inline-flex items-center justify-center p-3 mt-8 font-semibold text-white no-underline rounded-full px-9 bg-bgmain3">Quay về trang chủ <svg class="ml-2" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z" class="fill-white"/></svg></a>

	</div>

</body>

</html>



<!-- Js Config -->

<script>

	var CONFIG_ALL = @json(config('config_all'));

	var CONFIG_BASE = '{{Helper::GetConfigBase()}}';

</script>



<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script>

	$(document).ready(function(){
		setTimeout(function(){ 

			window.location = CONFIG_BASE + "";

		}, 5000);

	});

</script>

