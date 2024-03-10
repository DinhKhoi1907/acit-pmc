@if($posts)
	<div class="flex items-center justify-between px-6 md:px-12 ">
		<div class="font-semibold text-cmain2 md:text-[30px] uppercase text-[24px]"><span>{{$posts['ten'.$lang]}}</span></div>
		<span class="py-2 cursor-pointer show-popup-close md:py-4"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"><path fill="#FDBC22" d="M23 20.168l-8.185-8.187 8.185-8.174-2.832-2.807-8.182 8.179-8.176-8.179-2.81 2.81 8.186 8.196-8.186 8.184 2.81 2.81 8.203-8.192 8.18 8.192z"/></svg></span>
	</div>

	<div class="md:p-12 p-5 max-h-[88%] overflow-auto scroll-css">
		@if(isset($posts['photo']) && $posts['photo'] != '')
			<div class="js-img-compare">
				<div>
					<span class="images-compare-label">Before</span>
					<img class="w-full lg:w-fit" src="{{ Thumb::Crop(UPLOAD_PRODUCT,$posts['photo2'],900,600,1) }}" alt="{{$posts['tenkhongdau'.$lang]}}" width="276" height="190">
				</div>
				<div style="display: none;">
					<span class="images-compare-label">After</span>
					<img class="w-full lg:w-fit" src="{{ Thumb::Crop(UPLOAD_PRODUCT,$posts['photo'],900,600,1) }}" alt="{{$posts['tenkhongdau'.$lang]}}" width="276" height="190">
				</div>
			</div>
		@else
			<div class="alert-data text-cmain" role="alert">
				<strong><i class="mr-1 far fa-exclamation-circle"></i>The content is being updated ...</strong>
			</div>
		@endif
	</div>
@else
	<div class="flex items-center justify-between px-6 md:px-12 ">
		<div class="font-semibold text-cmain2 md:text-[30px] uppercase text-[24px]"><span>{{$posts['ten'.$lang]}}</span></div>
		<span class="py-2 cursor-pointer show-popup-close md:py-4"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"><path fill="#FDBC22" d="M23 20.168l-8.185-8.187 8.185-8.174-2.832-2.807-8.182 8.179-8.176-8.179-2.81 2.81 8.186 8.196-8.186 8.184 2.81 2.81 8.203-8.192 8.18 8.192z"/></svg></span>
	</div>
	<div class="md:p-12 p-5 max-h-[88%] overflow-auto scroll-css">
		<div class="alert-data" role="alert">
			<strong><i class="mr-1 far fa-exclamation-circle"></i>The content is being updated ...</strong>
		</div>
	</div>
@endif