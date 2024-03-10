<div class="photoUpload-zone">
	<div class="photoUpload-detail" id="photoUpload-preview3"><img class="rounded" src="{{ Helper::GetFolder($folder_upload,true).$rowItem['poster'] }}" onerror=src="{{asset('img/noimage1.png')}}" alt="Alt Photo"/></div>
	<label class="photoUpload-file" id="photo-zone3" for="file-zone3">
		<input type="file" name="poster" id="file-zone3">
		<i class="fas fa-cloud-upload-alt"></i>
		<p class="photoUpload-drop">Kéo và thả hình vào đây</p>
		<p class="photoUpload-or">hoặc</p>
		<p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
	</label>
	<div class="photoUpload-dimension">{{ "Width: ".$config[$type]['poster_width']*$config[$type]['ratio']." px - Height: ".$config[$type]['poster_height']*$config[$type]['ratio']." px (".$config[$type]['img_type'].")" }}</div>
</div>