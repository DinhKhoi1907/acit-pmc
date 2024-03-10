@extends('admin.master')

@section('content')
<form class="validation-form" novalidate method="post" action="{{route('admin.size.save',['man',$type])}}" enctype="multipart/form-data">
	@csrf
    <div class="text-sm card-footer sticky-top">
        <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="mr-2 far fa-save"></i>Lưu</button>
        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="mr-2 fas fa-redo"></i>Làm lại</button>
        <a class="btn btn-sm bg-gradient-danger" href="{{route('admin.size.show',['man',$type])}}" title="Thoát"><i class="mr-2 fas fa-sign-out-alt"></i>Thoát</a>
    </div>
    <div class="text-sm card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Kích thước {{ $config[$type]['title_main'] }}</h3>
        </div>
        <div class="card-body">
			@if(isset($config[$type]['size_images']) && $config[$type]['size_images'] == true)
                <div class="form-group">
                    <label class="change-photo" for="file">
                        <p>Upload hình ảnh:</p>
                        <div class="rounded">
                            <img class="rounded img-upload" src="{{ (isset($rowItem['photo']))?config('config_upload.UPLOAD_SIZE').$rowItem['photo']:'' }}" onerror=src="{{asset('img/noimage.png')}}" alt="Alt Photo"/>
                            <strong>
                                <b class="text-sm text-split"></b>
                                <span class="btn btn-sm bg-gradient-success"><i class="mr-2 fas fa-camera"></i>Chọn hình</span>
                            </strong>
                        </div>
                    </label>
                    <strong class="mt-2 mb-2 text-sm d-block">{{ "Width: ".$config[$type]['width_size']." px - Height: ".$config[$type]['height_size']." px (".$config[$type]['img_type_size'].")" }}</strong>
                    <div class="custom-file my-custom-file d-none">
                        <input type="file" class="custom-file-input" name="file" id="file">
                        <label class="custom-file-label" for="file">Chọn file</label>
                    </div>
                </div>
			@endif

            <div class="form-group">
                <label for="hienthi" class="mb-0 mr-2 align-middle d-inline-block">Hiển thị:</label>
				<div class="align-middle custom-control custom-checkbox d-inline-block">
					@if((isset($rowItem['hienthi']) && $rowItem['hienthi']==1) || !isset($rowItem))
					<input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox" checked>
					@else
					<input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox">
					@endif
					<label for="hienthi-checkbox" class="custom-control-label"></label>
				</div>
            </div>
            <div class="form-group">
                <label for="stt" class="mb-0 mr-2 align-middle d-inline-block">Số thứ tự:</label>
                <input type="number" class="align-middle form-control form-control-mini d-inline-block" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="{{ (isset($rowItem['stt'])) ? $rowItem['stt'] : 1 }}">
            </div>
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="p-0 card-header border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                        @foreach(config('config_all.lang') as $k => $v)
                            <li class="nav-item">
                                <a class="nav-link {{($k=='vi')?'active':''}}" id="tabs-lang" data-toggle="pill" href="#tabs-lang-{{$k}}" role="tab" aria-controls="tabs-lang-{{$k}}" aria-selected="true">{{$v}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-body card-article">
                    <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                        @foreach(config('config_all.lang') as $k => $v)
                            <div class="tab-pane fade show {{($k=='vi')?'active':''}}" id="tabs-lang-{{$k}}" role="tabpanel" aria-labelledby="tabs-lang">
                                <div class="form-group">
                                    <label for="ten{{$k}}" class="inp">
                                        <input type="text" class="form-control for-seo" name="data[ten{{$k}}]" id="ten{{$k}}" placeholder="&nbsp;" value="{{(isset($rowItem['ten'.$k])) ? $rowItem['ten'.$k] : ''}}" {{($k=='vi')?'required':''}}>
                                        <span class="label">Tiêu đề ({{$k}}):</span>
                                        <span class="focus-bg"></span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="id" value="{{ (isset($rowItem['id']))?$rowItem['id']:'' }}">
</form>
@endsection

<!--js thêm cho mỗi trang-->
@section('js_page')

@endsection
