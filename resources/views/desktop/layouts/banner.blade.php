
@if(isset($banner) && $banner['banner']!='')
<div class="pt-[56px] lg:pt-40">
	<div class="relative flex-col hidden lg:flex banner-page">
		{{-- <span class="absolute top-0 left-0 z-10 w-full h-full bg-black opacity-70"></span> --}}
		<img class="" src="{{Thumb::Crop($folder_upload,$banner['banner'],1440,280,1)}}" alt="banner" width="100%" height="400">
		<div class="absolute left-0 z-50 flex w-full h-full">
			<div class="flex flex-col items-center justify-end w-full pb-40">
				@include('desktop.layouts.breadcum')
				@if(isset($title_crumb))<p class="text-white font-bold uppercase text-6xl text-center w-[70%] mt-3">{{__($title_crumb)}}</p>@endif
			</div>
			<span class="absolute bottom-0 left-0 w-full h-full bg-gradient-to-t to-[rgba(0,0,0,20%)] from-transparent revealOnScroll animated animate__fadeIn" data-animation="animate__fadeIn" data-timeout="500"></span>
		</div>
	</div>
</div>
@endif
