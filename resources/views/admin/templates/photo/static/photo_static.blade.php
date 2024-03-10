@extends('admin.master')

@section('content')
<form method="post" id="form-watermark" action="{{route('admin.photo.save_static',['photo_static',$type])}}" enctype="multipart/form-data">
	@csrf
    <div class="card-footer text-sm sticky-top">
        <button type="submit" class="btn btn-sm bg-gradient-primary"><i class="far fa-save mr-2"></i>Lưu</button>
        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
    </div>
    <div class="card card-primary card-outline text-sm">
        <div class="card-header">
            <h3 class="card-title">Chi tiết {{ $config[$type]['title_main'] }}</h3>
        </div>
        <div class="card-body">
            @if(isset($config[$type]['images']) && $config[$type]['images'] == true)
                <div class="form-group">
                    <label class="change-photo" for="file">
                        <p>Upload hình ảnh:</p>
                        <div class="rounded">
                            <img class="rounded img-upload" src="{{ (isset($rowItem['photo']))?config('config_upload.UPLOAD_PHOTO').$rowItem['photo']:'' }}" onerror="src='{{asset('img/noimage.png')}}'" alt="Alt Photo"/>
                            <strong>
                                <b class="text-sm text-split"></b>
                                <span class="btn btn-sm bg-gradient-success"><i class="fas fa-camera mr-2"></i>Chọn hình</span>
                            </strong>
                        </div>
                    </label>
                    <strong class="d-block mt-2 mb-2 text-sm">{{ "Width: ".$config[$type]['width']*$config[$type]['ratio']." px - Height: ".$config[$type]['height']*$config[$type]['ratio']." px (".$config[$type]['img_type'].")" }}</strong>
                    <div class="custom-file my-custom-file d-none">
                        <input type="file" class="custom-file-input" name="file" id="file">
                        <label class="custom-file-label" for="file">Chọn file</label>
                    </div>
                </div>
            @endif


            <div class="card-body" style="margin-top: 30px">
                @if(isset($config[$type]['background']) && $config[$type]['background'] == true)
                    <div class="form-group">
                        <label class="change-photo-background" for="background">
                            <p>Upload hình ảnh background:</p>
                            <div class="rounded">
                                <img class="rounded img-upload-background" src="{{ (isset($rowItem['background']))?config('config_upload.UPLOAD_PHOTO').$rowItem['background']:'' }}" onerror="src='{{asset('img/noimage.png')}}'" alt="Alt Photo"/>
                                <strong>
                                    <b class="text-sm text-split"></b>
                                    <span class="btn btn-sm bg-gradient-success"><i class="fas fa-camera mr-2"></i>Chọn hình nền</span>
                                </strong>
                            </div>
                        </label>
                        <strong class="d-block mt-2 mb-2 text-sm">{{ "Width: ".$config[$type]['width']*$config[$type]['ratio']." px - Height: ".$config[$type]['height']*$config[$type]['ratio']." px (".$config[$type]['img_type'].")" }}</strong>
                        <div class="custom-file my-custom-file d-none">
                            <input type="file" class="custom-file-input" name="background" id="background">
                            <label class="custom-file-label" for="background">Chọn file</label>
                        </div>
                    </div>
                @endif

            @if(isset($config[$type]['watermark-advanced']) && $config[$type]['watermark-advanced'] == true)
                <div class="row">
                    <div class="col-xl-4 row">
                        <div class="form-group col-12">
                            <label>Vị trí đóng dấu:</label>
                            <div class="watermark-position rounded">
                                <label for="tl">
                                    <input type="radio" name="data[options][watermark][position]" id="tl" value="top-left" {{(isset($options['watermark']['position']) && $options['watermark']['position']=='top-left')?'checked':''}}>
                                    <img class="rounded" onerror="src='{{asset('img/noimage.png')}}'" src="{{(isset($options['watermark']['position']) && $options['watermark']['position']=='top-left')?config('config_upload.UPLOAD_PHOTO').$rowItem['photo']:''}}" alt="watermark-cover">
                                </label>

								<label for="tc">
                                    <input type="radio" name="data[options][watermark][position]" id="tc" value="top" {{(isset($options['watermark']['position']) && $options['watermark']['position']=='top')?'checked':''}}>
                                    <img class="rounded" onerror="src='{{asset('img/noimage.png')}}'" src="{{(isset($options['watermark']['position']) && $options['watermark']['position']=='top')?config('config_upload.UPLOAD_PHOTO').$rowItem['photo']:''}}" alt="watermark-cover">
                                </label>
                                <label for="tr">
                                    <input type="radio" name="data[options][watermark][position]" id="tr" value="top-right" {{(isset($options['watermark']['position']) && $options['watermark']['position']=='top-right')?'checked':''}}>
                                    <img class="rounded" onerror="src='{{asset('img/noimage.png')}}'" src="{{(isset($options['watermark']['position']) && $options['watermark']['position']=='top-right')?config('config_upload.UPLOAD_PHOTO').$rowItem['photo']:''}}" alt="watermark-cover">
                                </label>
                                <label for="mr">
                                    <input type="radio" name="data[options][watermark][position]" id="mr" value="right" {{(isset($options['watermark']['position']) && $options['watermark']['position']=='right')?'checked':''}}>
                                    <img class="rounded" onerror="src='{{asset('img/noimage.png')}}'" src="{{(isset($options['watermark']['position']) && $options['watermark']['position']=='right')?config('config_upload.UPLOAD_PHOTO').$rowItem['photo']:''}}" alt="watermark-cover">
                                </label>
                                <label for="br">
                                    <input type="radio" name="data[options][watermark][position]" id="br" value="bottom-right" {{(isset($options['watermark']['position']) && $options['watermark']['position']=='bottom-right')?'checked':''}}>
                                    <img class="rounded" onerror="src='{{asset('img/noimage.png')}}'" src="{{(isset($options['watermark']['position']) && $options['watermark']['position']=='bottom-right')?config('config_upload.UPLOAD_PHOTO').$rowItem['photo']:''}}" alt="watermark-cover">
                                </label>
                                <label for="bc">
                                    <input type="radio" name="data[options][watermark][position]" id="bc" value="bottom" {{(isset($options['watermark']['position']) && $options['watermark']['position']=='bottom')?'checked':''}}>
                                    <img class="rounded" onerror="src='{{asset('img/noimage.png')}}'" src="{{(isset($options['watermark']['position']) && $options['watermark']['position']=='bottom')?config('config_upload.UPLOAD_PHOTO').$rowItem['photo']:''}}" alt="watermark-cover">
                                </label>
                                <label for="bl">
                                    <input type="radio" name="data[options][watermark][position]" id="bl" value="bottom-left" {{(isset($options['watermark']['position']) && $options['watermark']['position']=='bottom-left')?'checked':''}}>
                                    <img class="rounded" onerror="src='{{asset('img/noimage.png')}}'" src="{{(isset($options['watermark']['position']) && $options['watermark']['position']=='bottom-left')?config('config_upload.UPLOAD_PHOTO').$rowItem['photo']:''}}" alt="watermark-cover">
                                </label>
                                <label for="ml">
                                    <input type="radio" name="data[options][watermark][position]" id="ml" value="left" {{(isset($options['watermark']['position']) && $options['watermark']['position']=='left')?'checked':''}}>
                                    <img class="rounded" onerror="src='{{asset('img/noimage.png')}}'" src="{{(isset($options['watermark']['position']) && $options['watermark']['position']=='left')?config('config_upload.UPLOAD_PHOTO').$rowItem['photo']:''}}" alt="watermark-cover">
                                </label>
                                <label for="cc">
                                    <input type="radio" name="data[options][watermark][position]" id="cc" value="center" {{(isset($options['watermark']['position']) && $options['watermark']['position']=='center')?'checked':''}}>
                                    <img class="rounded" onerror="src='{{asset('img/noimage.png')}}'" src="{{(isset($options['watermark']['position']) && $options['watermark']['position']=='center')?config('config_upload.UPLOAD_PHOTO').$rowItem['photo']:''}}" alt="watermark-cover">
                                </label>
                            </div>
							<input type="hidden" name="data[options][watermark][type]" value="{{$type}}">
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                @if(isset($config[$type]['link']) && $config[$type]['link'] == true)
                    <div class="form-group col-md-6">
                        <label for="link">Link:</label>
                        <input type="text" class="form-control" name="data[link]" id="link" placeholder="Link" value="{{ $rowItem['link'] }}">
                    </div>
                @endif

                @if(isset($config[$type]['video']) && $config[$type]['video'] == true)
                    <div class="form-group col-md-6">
                        <label for="link_video">Video:</label>
                        <input type="text" class="form-control" name="data[link_video]" id="link_video" placeholder="Video" value="{{ $rowItem['link_video'] }}">
                    </div>
                @endif

                @if(isset($config[$type]['video_iframe']) && $config[$type]['video_iframe'] == true)
                    <div class="form-group">
                        <label class="change-photo" for="video">
                            <p>Upload video (.mp4):</p>
                            <div>
                                <video width="300" controls autoplay="" muted>
                                    <source src="{{ (isset($rowItem['video']))?config('config_upload.UPLOAD_PHOTO').$rowItem['video']:'' }}" type="video/mp4">
                                    <source src="{{ (isset($rowItem['video']))?config('config_upload.UPLOAD_PHOTO').$rowItem['video']:'' }}" type="video/webm">
                                </video>
                            </div>
                            <div class="rounded">
                                <strong>
                                    <b class="text-sm text-split"></b>
                                    <span class="btn btn-sm bg-gradient-success"><i class="fas fa-camera mr-2"></i>Chọn video</span>
                                </strong>
                            </div>
                        </label>
                        <div class="custom-file my-custom-file d-none">
                            <input type="file" class="custom-file-input" name="video" id="video" accept="video/mp4">
                            <label class="custom-file-label" for="video">Chọn file</label>
                        </div>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                <div class="custom-control custom-checkbox d-inline-block align-middle">
                	@if($rowItem['hienthi']==1 || !isset($rowItem))
                    <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox" checked>
                    @else
                    <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox">
                    @endif
                    <label for="hienthi-checkbox" class="custom-control-label"></label>
                </div>
            </div>

            @if((isset($config[$type]['tieude']) && $config[$type]['tieude'] == true) || (isset($config[$type]['mota']) && $config[$type]['mota'] == true) || (isset($config[$type]['noidung']) && $config[$type]['noidung'] == true))
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                            @foreach(config('config_all.lang') as $k => $v)
                                <li class="nav-item">
                                    <a class="nav-link {{($k=='vi')?'active':''}}" id="tabs-lang" data-toggle="pill" href="#tabs-lang-{{$k}}" role="tab" aria-controls="tabs-lang-{{$k}}" aria-selected="true">{{$v}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                            @foreach(config('config_all.lang') as $k => $v)
                                <div class="tab-pane fade show {{($k=='vi')?'active':''}}" id="tabs-lang-{{$k}}" role="tabpanel" aria-labelledby="tabs-lang">
                                    @if((isset($config[$type]['tieude']) && $config[$type]['tieude'] == true))
                                        <div class="form-group">
                                            <label for="ten{{$k}}">Tiêu đề ({{$k}}):</label>
                                            <input type="text" class="form-control" name="data[ten{{$k}}]" id="ten{{$k}}" placeholder="Tiêu đề ({{$k}})" value="{{ $rowItem['ten'.$k] }}">
                                        </div>
                                    @endif

                                    @if((isset($config[$type]['mota']) && $config[$type]['mota'] == true))
                                        <div class="form-group">
                                            <label for="mota{{$k}}">Mô tả ({{$k}}):</label>
                                            <textarea class="form-control {{((isset($config[$type]['mota_cke']) && $config[$type]['mota_cke'] == true))?'form-control-ckeditor':''}}" name="data[mota{{$k}}]" id="mota{{$k}}" rows="5" placeholder="Mô tả ({{$k}})">{{($rowItem['mota'.$k])}}</textarea>
                                        </div>
                                    @endif

                                    @if((isset($config[$type]['noidung']) && $config[$type]['noidung'] == true))
                                        <div class="form-group">
                                            <label for="noidung{{$k}}">Nội dung ({{$k}}):</label>
                                            <textarea class="form-control {{((isset($config[$type]['noidung_cke']) && $config[$type]['noidung_cke'] == true))?'form-control-ckeditor':''}}" name="data[noidung{{$k}}]" id="noidung{{$k}}" rows="5" placeholder="Nội dung ({{$k}})">{{($rowItem['noidung'.$k])}}</textarea>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    {{-- <div class="card-footer text-sm">
        <button type="submit" class="btn btn-sm bg-gradient-primary"><i class="far fa-save mr-2"></i>Lưu</button>
        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
    </div> --}}
    <input type="hidden" name="id" value="{{ (isset($rowItem['id']))?$rowItem['id']:'' }}">
</form>
@endsection

<!--js thêm cho mỗi trang-->
@section('js_page')
	<script>
		$(document).ready(function(){
			$('#file').change(function(event){
				var file = URL.createObjectURL(event.target.files[0]);
				$('.img-upload').attr('src',file);
			});

            $('#background').change(function(event){
				var background = URL.createObjectURL(event.target.files[0]);
				$('.img-upload-background').attr('src',background);
			});

			/* Watermark */
			$(".watermark-position label").click(function(){
				if($(".change-photo img").length)
				{
					var img = $(".change-photo img").attr("src");
					if(img)
					{
						$(".watermark-position label img").attr("src","img/noimage.png");
						$(this).find("img").attr("src",img);
						$(this).find("img").show();
					}
				}
				else
				{
					notifyDialog("Dữ liệu hình ảnh không hợp lệ");
					return false;
				}
			})
		});

	/*function previewWatermark(){
		$o = $("#form-watermark");
		var formData = new FormData();
		formData.append('file', $('#file')[0].files[0]);
		formData.append('data', $o.serialize());

		$.ajax({
			type:'POST',
			url: "index.php?com=photo&act=save-watermark&type=<?=(isset($type) && $type != '') ? $type : ''?>",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(data){
				Swal.fire({
					imageUrl: "assets/images/ajax-loader.gif",
					customClass: {
						confirmButton: 'btn btn-sm bg-gradient-primary text-sm',
					},
					buttonsStyling: false,
					confirmButtonText: '<i class="fas fa-check mr-2"></i>Đồng ý',
					showClass: {
						popup: 'animated fadeInDown faster'
					},
					hideClass: {
						popup: 'animated fadeOutUp faster'
					}
				})

				toDataURL('index.php?com=photo&act=preview-watermark&type=<?=(isset($type) && $type != '') ? $type : ''?>&position='+data.position+'&img='+data.image+'&watermark='+data.path+'&upload='+data.upload+'&opacity='+data.data.opacity+'&per='+data.data.per+'&small_per='+data.data.small_per+'&min='+data.data.min+'&max='+data.data.max+"&t="+data.time, function(dataUrl){$(".swal2-image").attr("src", dataUrl);})
			},
			error: function(data){
				console.log("error");
			}
		});

		return false;
	}*/
	</script>
@endsection
