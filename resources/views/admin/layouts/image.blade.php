<div class="photoUpload-zone">
	<div class="photoUpload-detail" id="photoUpload-preview"><img class="rounded" src="{{ Helper::GetFolder($folder_upload,true).$rowItem['photo'] }}" onerror=src="{{asset('img/noimage1.png')}}" alt="Alt Photo"/></div>
	<label class="photoUpload-file" id="photo-zone" for="file-zone">
		<input type="file" name="file" id="file-zone">
		<i class="fas fa-cloud-upload-alt"></i>
		<p class="photoUpload-drop">Kéo và thả hình vào đây</p>
		<p class="photoUpload-or">hoặc</p>
		<p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
	</label>
	@if($request->category=='man')
		<div class="photoUpload-dimension">{{ "Width: ".$config[$type]['width']*$config[$type]['ratio']." px - Height: ".$config[$type]['height']*$config[$type]['ratio']." px (".$config[$type]['img_type'].")" }}</div>
	@else
		<div class="photoUpload-dimension">{{ "Width: ".$config[$type]['width_'.$request->category]." px - Height: ".$config[$type]['height_'.$request->category]." px (".$config[$type]['img_type'].")" }}</div>
	@endif
</div>

<input type="hidden" name="width" value="{{$config[$type]['width']}}" />
<input type="hidden" name="height" value="{{$config[$type]['height']}}" />
