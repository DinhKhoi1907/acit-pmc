<div class="photoUpload-zone">
	<div class="photoUpload-detail" id="photoUpload-preview-{{$item}}"><img class="rounded" src="{{ Helper::GetFolder($folder,true).$photo }}" onerror=src="{{asset('img/noimage1.png')}}" alt="Alt Photo"/></div>
	<label class="photoUpload-file module-upload-file" id="photo-zone-{{$item}}" for="file-zone-{{$item}}" data-preview="photoUpload-preview-{{$item}}">
		<input type="file" name="{{ $attributes['name'] }}" id="file-zone-{{$item}}">
		<i class="fas fa-cloud-upload-alt"></i>
		<p class="photoUpload-drop">Kéo và thả hình vào đây</p>
		<p class="photoUpload-or">hoặc</p>
		<p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
	</label>
    <div class="photoUpload-dimension">{{ "Width: ".$width*$ratio." px - Height: ".$height*$ratio." px (".$extension.")" }}</div>

	{{-- @if($request->category=='man')
		<div class="photoUpload-dimension">{{ "Width: ".$config[$type]['width']*$config[$type]['ratio']." px - Height: ".$config[$type]['height']*$config[$type]['ratio']." px (".$config[$type]['img_type'].")" }}</div>
	@else
		<div class="photoUpload-dimension">{{ "Width: ".$config[$type]['width_'.$request->category]." px - Height: ".$config[$type]['height_'.$request->category]." px (".$config[$type]['img_type'].")" }}</div>
	@endif --}}
</div>

<input type="hidden" name="width" value="{{$width}}" />
<input type="hidden" name="height" value="{{$height}}" />