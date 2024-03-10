@extends('admin.master')

@section('content')
<form class="validation-form" novalidate method="post" action="{{route('admin.color.save',['man',$type])}}" enctype="multipart/form-data">
	@csrf
    <div class="card-footer text-sm sticky-top">
        <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
        <a class="btn btn-sm bg-gradient-danger" href="{{route('admin.color.show',['man',$type])}}" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
    </div>
    <div class="row">
        <div class="col-xl-8">
            <div class="card card-primary card-outline text-sm">
                <div class="card-header">
                    <h3 class="card-title">Màu sắc {{ $config[$type]['title_main'] }}</h3>
                </div>
                <div class="card-body">
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
                    <div class="form-group">
                        <label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
                        <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="{{ (isset($rowItem['stt'])) ? $rowItem['stt'] : 1 }}">
                    </div>
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
                        <div class="card-body card-article">
                            <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                @foreach(config('config_all.lang') as $k => $v)
                                    <div class="tab-pane fade show {{($k=='vi')?'active':''}}" id="tabs-lang-{{$k}}" role="tabpanel" aria-labelledby="tabs-lang">
                                        <div class="form-group">
                                            <label for="ten{{$k}}" class="inp">
                                                <input type="text" class="form-control for-seo" name="data[ten{{$k}}]" id="ten{{$k}}" placeholder="&nbsp;" value="{{$rowItem['ten'.$k]}}" {{($k=='vi')?'required':''}}>
                                                <span class="label">Tiêu đề ({{$k}}):</span>
                                                <span class="focus-bg"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        @if(isset($config[$type]['mau_mau']) && $config[$type]['mau_mau'] == true)
                            <div class="form-group col-md-3 col-sm-4">
                                <label class="d-block" for="mau">Màu sắc:</label>
                                <input type="text" class="form-control jscolor" name="data[mau]" id="mau" maxlength="7" value="{{($rowItem['mau'])?$rowItem['mau']:'#000000'}}">
                            </div>
                        @endif

                        @if((isset($config[$type]['mau_loai']) && $config[$type]['mau_loai'] == true) && (isset($config[$type]['mau_images']) && $config[$type]['mau_images'] == true))
                            <div class="form-group col-md-3 col-sm-4">
                                <label for="loaihienthi">Loại hiển thị:</label>
                                <select class="form-control" name="data[loaihienthi]" id="loaihienthi">
                                    <option value="0">Chọn loại hiển thị</option>
                                    <option {{ (isset($rowItem['loaihienthi']) && $rowItem['loaihienthi'] == 0)?"selected":"" }} value="0">Màu sắc</option>
                                    <option {{ (isset($rowItem['loaihienthi']) && $rowItem['loaihienthi'] == 1)?"selected":"" }} value="1">Hình ảnh</option>
                                </select>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            @if(isset($config[$type]['mau_images']) && $config[$type]['mau_images'] == true)
                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title">Hình đại diện</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="photoUpload-zone">
                            @if(config('config_all.fileupload')==true)
                                @php
                                    $amount_images = 1;
                                    for($i=0;$i<$amount_images;$i++){
                                        TableManipulation::AddFieldToTable('color','photo'.(($i>0) ? $i : ''), 'string');
                                        TableManipulation::AddFieldToTable('color','idphoto'.(($i>0) ? $i : ''));
                                    }
                                @endphp
                                @include('admin.layouts.devimage')

                                <div class=""><strong>{{ "Width: ".$config[$type]['width_mau']." px - Height: ".$config[$type]['height_mau']." px (".$config[$type]['img_type_mau'].")" }}</strong></div>
                                <input type="hidden" name="width" value="{{$config[$type]['width_mau']}}" />
                                <input type="hidden" name="height" value="{{$config[$type]['height_mau']}}" />
                            @else
                                <div class="photoUpload-detail" id="photoUpload-preview"><img class="rounded" src="{{ Helper::GetFolder($folder_upload,true).$rowItem['photo'] }}" onerror=src="{{asset('img/noimage1.png')}}" alt="Alt Photo"/></div>
                                <label class="photoUpload-file" id="photo-zone" for="file-zone">
                                    <input type="file" name="file" id="file-zone">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                                    <p class="photoUpload-or">hoặc</p>
                                    <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
                                </label>
                                <div class="photoUpload-dimension">{{ "Width: ".$config[$type]['width_mau']." px - Height: ".$config[$type]['height_mau']." px (".$config[$type]['img_type_mau'].")" }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    
    <input type="hidden" name="id" value="{{ (isset($rowItem['id']))?$rowItem['id']:'' }}">
</form>
@endsection

<!--js thêm cho mỗi trang-->
@section('js_page')

@endsection
