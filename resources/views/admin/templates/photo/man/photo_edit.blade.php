@extends('admin.master')

@section('content')
<form method="post" action="{{route('admin.photo.save',['man_photo',$type])}}" enctype="multipart/form-data">
	@csrf
    <div class="card-footer text-sm sticky-top">
        <button type="submit" class="btn btn-sm bg-gradient-primary"><i class="far fa-save mr-2"></i>Lưu</button>
        <div class="btn dropdown pl-0 ml-1">
          <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Thao tác
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <button type="reset" class="btn btn-sm bg-gradient-secondary btn-none-css"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger btn-none-css" href="{{route('admin.photo.show',['man_photo',$type])}}" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
          </div>
        </div> 
    </div>
    <div class="row">
        <div class="{{($type!='slide') ? 'col-xl-8' : 'col-xl-12'}}">            
            <div class="card card-primary card-outline text-sm">
                <div class="card-header">
                    <h3 class="card-title">Chi tiết {{ $config[$type]['title_main'] }}</h3>
                </div>
                <div class="card-body">
                    @if(isset($config[$type]['video_upload']) && $config[$type]['video_upload'] == true)
                            <div class="form-group">
                                <label class="change-photo" for="video" style="width:100%;">
                                    <p>Upload video (.mp4):</p>
                                    @if($rowItem['video']=='')
                                        <div class="rounded" style="text-align:center">
                                            <img class="rounded img-upload" src="{{ (isset($rowItem['photo']))?config('config_upload.UPLOAD_PHOTO').$rowItem['video']:'' }}" onerror="src='{{asset('img/noimage.png')}}'" alt="Alt Photo"/>
                                            <strong>
                                                <b class="text-sm text-split"></b>
                                                <span class="btn btn-sm bg-gradient-success"><i class="fas fa-camera mr-2"></i>Chọn video</span>
                                            </strong>
                                        </div>
                                    @else
                                        <div>
                                            <video width="100%" controls autoplay="" muted>
                                                <source src="{{ (isset($rowItem['video']))?config('config_upload.UPLOAD_PHOTO').$rowItem['video']:'' }}" type="video/mp4">
                                                <source src="{{ (isset($rowItem['video']))?config('config_upload.UPLOAD_PHOTO').$rowItem['video']:'' }}" type="video/webm">
                                            </video>
                                        </div>
                                        <div class="form-group">
                                            <label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Hiển thị video:</label>
                                            <div class="custom-control custom-checkbox d-inline-block align-middle">
                                                @if($rowItem['hienthi_video']==1 || !isset($rowItem))
                                                <input type="checkbox" class="custom-control-input hienthi_video-checkbox" name="data[hienthi_video]" id="hienthi_video-checkbox" checked>
                                                @else
                                                <input type="checkbox" class="custom-control-input hienthi_video-checkbox" name="data[hienthi_video]" id="hienthi_video-checkbox">
                                                @endif                            
                                                <label for="hienthi_video-checkbox" class="custom-control-label"></label>
                                            </div>
                                        </div>
                                        <div class="rounded">
                                            <strong>
                                                <b class="text-sm text-split"></b>
                                                <span class="btn btn-sm bg-gradient-success"><i class="fas fa-camera mr-2"></i>Chọn video</span>
                                            </strong>                            
                                        </div>
                                    @endif
                                </label>
                                <div class="custom-file my-custom-file d-none">
                                    <input type="file" class="custom-file-input" name="video" id="video" accept="video/mp4">
                                    <label class="custom-file-label" for="video">Chọn file</label>
                                </div>
                            </div>
                        @endif
                    @if((isset($config[$type]['tieude']) && $config[$type]['tieude'] == true) || (isset($config[$type]['mota']) && $config[$type]['mota'] == true) || (isset($config[$type]['noidung']) && $config[$type]['noidung'] == true))
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                    @foreach(config('config_all.lang') as $k => $v)
                                        @php
                                            TableManipulation::AddFieldToTable('photo','mota'.$k, 'string');
                                        @endphp
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
                                            @if(isset($config[$type]['tieude']) && $config[$type]['tieude'] == true)
                                                <div class="form-group">
                                                    <label for="ten{{$k}}">Tiêu đề ({{$k}}):</label>
                                                    <input type="text" class="form-control" name="data[ten{{$k}}]" id="ten{{$k}}" placeholder="Tiêu đề ({{$k}})" value="{{ (isset($rowItem['ten'.$k]))?$rowItem['ten'.$k]:'' }}">
                                                </div>
                                            @endif

                                            @if(isset($config[$type]['mota']) && $config[$type]['mota'] == true)
                                                <div class="form-group">
                                                    <label for="mota{{$k}}">Mô tả ({{$k}}):</label>
                                                    <textarea class="form-control {{(isset($config[$type]['mota_cke']) && $config[$type]['mota_cke'] == true)?'form-control-ckeditor':''}}" name="data[mota{{$k}}]" id="mota{{$k}}" rows="5" placeholder="Mô tả ({{$k}})">{{ $rowItem['mota'.$k] }}</textarea>
                                                </div>
                                            @endif

                                            @if(isset($config[$type]['noidung']) && $config[$type]['noidung'] == true)
                                                <div class="form-group">
                                                    <label for="noidung{{$k}}">Nội dung ({{$k}}):</label>
                                                    <textarea class="form-control {{ (isset($config[$type]['noidung_cke']) && $config[$type]['noidung_cke'] == true)?'form-control-ckeditor':'' }}" name="data[noidung{{$k}}]" id="noidung{{$k}}" rows="5" placeholder="Nội dung ({{$k}})">{{ $rowItem['noidung'.$k] }}</textarea>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        @if(isset($config[$type]['prename']) && $config[$type]['prename'] == true)
                            <div class="form-group">
                                <label for="prename">Định danh:</label>
                                <input type="text" class="form-control" name="data[prename]" id="prename" placeholder="Định danh" value="{{ $rowItem['prename'] }}">
                            </div>
                        @endif

                        @if(isset($config[$type]['link']) && $config[$type]['link'] == true)
                            <div class="form-group">
                                <label for="link">Link:</label>
                                <input type="text" class="form-control" name="data[link]" id="link" placeholder="Link" value="{{ $rowItem['link'] }}">
                            </div>
                        @endif

                        @if(isset($config[$type]['video']) && $config[$type]['video'] == true)
                            <div class="form-group">
                                <label for="link_video">Video:</label>
                                <input type="text" class="form-control" name="data[link_video]" id="link_video" onchange="youtubePreview(this.value,'#loadVideo');" placeholder="Video" value="{{ $rowItem['link_video'] }}">
                            </div>
                            <div class="form-group">
                                <label for="link_video">Video preview:</label>
                                <div><iframe id="loadVideo" width="250" src="//www.youtube.com/embed/{{ Helper::getYoutube($rowItem['link_video']) }}" height='{{ ($rowItem["link_video"] == "")? 0 : 150 }}' frameborder="0" allowfullscreen></iframe></div>
                            </div>
                        @endif
                    

                        {{-- <div class="form-group">
                            <label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                            <div class="custom-control custom-checkbox d-inline-block align-middle">
                                @if($rowItem['hienthi']==1 || !isset($rowItem))
                                <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox" checked>
                                @else
                                <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox">
                                @endif                            
                                <label for="hienthi-checkbox" class="custom-control-label"></label>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
                            <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="{{ (isset($rowItem['stt']))?$rowItem['stt']:'1' }}">
                        </div>

                        @if(isset($config[$type]['settime']) && $config[$type]['settime'] == true)
                        <div class="form-settime">
                            <div class="form-group">
                                <label for="" class="d-inline-block align-middle mb-0 mr-2">Thiết lập thời gian hiển thị:</label>
                            </div>
                            <div class="form-group d-flex">
                                <input id="loaihienthi-0" type="radio" name="data[loaihienthi]" value="0" {{($rowItem['loaihienthi']==0) ? 'checked' : ''}}> 
                                <label for="loaihienthi-0" class="d-inline-block align-middle mb-0 ml-2">Hiển thị 1 lần khi truy cập website</label>
                            </div>
                            <div class="form-group d-flex">
                                <input id="loaihienthi-1" type="radio" name="data[loaihienthi]" value="1" {{($rowItem['loaihienthi']==1) ? 'checked' : ''}}>
                                <label for="loaihienthi-1" class="d-inline-block align-middle mb-0 ml-2" >Hiển thị 1 lần sau <input type="number" name="data[timehienthi]" value="{{$rowItem['timehienthi']}}" style="width:50px;text-align:center"> phút</label>
                            </div>
                        </div>
                        @endif
                        
                    @endif
                </div>
            </div>
        </div>

        {{-- @if($type!='slide')
            <div class="col-xl-4">
                @if(isset($config[$type]['images']) && $config[$type]['images'] == true)
                    <div class="card card-primary card-outline text-sm">
                        <div class="card-header">
                            <h3 class="card-title">Hình đại diện</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="photoUpload-zone">
                                <div class="photoUpload-detail" id="photoUpload-preview"><img class="rounded" src="{{ Helper::GetFolder($folder_upload,true).$rowItem['photo'] }}" onerror=src="{{asset('img/noimage1.png')}}" alt="Alt Photo"/></div>
                                <label class="photoUpload-file" id="photo-zone" for="file-zone">
                                    <input type="file" name="file" id="file-zone">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                                    <p class="photoUpload-or">hoặc</p>
                                    <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
                                </label>
                                <div class="photoUpload-dimension">{{ "Width: ".$config[$type]['width']*$config[$type]['ratio']." px - Height: ".$config[$type]['height']*$config[$type]['ratio']." px (".$config[$type]['img_type'].")" }}</div>
                            </div>

                            <input type="hidden" name="width" value="{{$config[$type]['width']}}" />
                            <input type="hidden" name="height" value="{{$config[$type]['height']}}" />

                        </div>
                    </div>
                @endif

                @if(isset($config[$type]['background']) && $config[$type]['background'] == true)
                    <div class="card card-primary card-outline text-sm">
                        <div class="card-header">
                            <h3 class="card-title">Hình nền</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="photoUpload-zone">
                                <div class="photoUpload-detail" id="photoUpload-preview2"><img class="rounded" src="{{ Helper::GetFolder($folder_upload,true).$rowItem['background'] }}" onerror=src="{{asset('img/noimage1.png')}}" alt="Alt Photo"/></div>
                                <label class="photoUpload-file" id="photo-zone2" for="file-zone2">
                                    <input type="file" name="background" id="file-zone2">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                                    <p class="photoUpload-or">hoặc</p>
                                    <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
                                </label>
                                <div class="photoUpload-dimension">{{ "Width: ".$config[$type]['width_bg']." px - Height: ".$config[$type]['height_bg']." px (".$config[$type]['img_type'].")" }}</div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @else --}}
            <div class="{{($type!='slide') ? 'col-xl-4' : 'col-xl-12'}}">
                <div class="row col-xl-12">
                    @if(isset($config[$type]['images']) && $config[$type]['images'] == true)
                    <div class="{{(isset($config[$type]['another_image']) && $config[$type]['another_image']==true) ? 'col-xl-4' : 'col-xl-12'}}">
                        <div class="card card-primary card-outline text-sm">
                            <div class="card-header">
                                <h3 class="card-title">Hình đại diện</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="photoUpload-zone">
                                    <div class="photoUpload-detail" id="photoUpload-preview"><img class="rounded" src="{{ Helper::GetFolder($folder_upload,true).$rowItem['photo'] }}" onerror=src="{{asset('img/noimage1.png')}}" alt="Alt Photo"/></div>
                                    <label class="photoUpload-file" id="photo-zone" for="file-zone">
                                        <input type="file" name="file" id="file-zone">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                                        <p class="photoUpload-or">hoặc</p>
                                        <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
                                    </label>

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

                                    <div class="photoUpload-dimension">{{ "Width: ".$config[$type]['width']*$config[$type]['ratio']." px - Height: ".$config[$type]['height']*$config[$type]['ratio']." px (".$config[$type]['img_type'].")" }}</div>
                                </div>

                                <input type="hidden" name="width" value="{{$config[$type]['width']}}" />
                                <input type="hidden" name="height" value="{{$config[$type]['height']}}" />

                            </div>
                        </div>                    
                    </div>
                    @endif
                
                @if(isset($config[$type]['another_image']) && $config[$type]['another_image']==true)
                <div class="col-xl-4">
                    <div class="card card-primary card-outline text-sm">
                        <div class="card-header">
                            <h3 class="card-title">Hình 1</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="photoUpload-zone">
                                <div class="photoUpload-detail" id="model-preview"><img class="rounded" src="{{ Helper::GetFolder($folder_upload,true).$rowItem['model'] }}" onerror=src="{{asset('img/noimage1.png')}}" alt="Alt Photo"/></div>
                                <label class="photoUpload-file" id="photo-model-zone" for="model-zone">
                                    <input type="file" name="file_model" id="model-zone">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                                    <p class="photoUpload-or">hoặc</p>
                                    <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
                                </label>

                                <div class="form-group">
                                    <label for="hienthi2" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                                    <div class="custom-control custom-checkbox d-inline-block align-middle">
                                        @if($rowItem['hienthi2']==1 || !isset($rowItem))
                                        <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi2]" id="hienthi-checkbox2" checked>
                                        @else
                                        <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi2]" id="hienthi-checkbox2">
                                        @endif                            
                                        <label for="hienthi-checkbox2" class="custom-control-label"></label>
                                    </div>
                                </div>

                                <div class="photoUpload-dimension">{{ "Width: 205px - Height: 175px (".$config[$type]['img_type'].")" }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-xl-4">
                    <div class="card card-primary card-outline text-sm">
                        <div class="card-header">
                            <h3 class="card-title">Hình 2</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="photoUpload-zone">
                                <div class="photoUpload-detail" id="banner-preview"><img class="rounded" src="{{ Helper::GetFolder($folder_upload,true).$rowItem['banner'] }}" onerror=src="{{asset('img/noimage1.png')}}" alt="Alt Photo"/></div>
                                <label class="photoUpload-file" id="photo-banner-zone" for="banner-zone">
                                    <input type="file" name="file_banner" id="banner-zone">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                                    <p class="photoUpload-or">hoặc</p>
                                    <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
                                </label>

                                <div class="form-group">
                                    <label for="hienthi3" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                                    <div class="custom-control custom-checkbox d-inline-block align-middle">
                                        @if($rowItem['hienthi3']==1 || !isset($rowItem))
                                        <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi3]" id="hienthi-checkbox3" checked>
                                        @else
                                        <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi3]" id="hienthi-checkbox3">
                                        @endif                            
                                        <label for="hienthi-checkbox3" class="custom-control-label"></label>
                                    </div>
                                </div>

                                <div class="photoUpload-dimension">{{ "Width: 230px - Height: 180px (".$config[$type]['img_type'].")" }}</div>
                            </div>
                        </div>
                    </div> 
                </div>

                <div class="col-xl-4">
                    <div class="card card-primary card-outline text-sm">
                        <div class="card-header">
                            <h3 class="card-title">Hình 3</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="photoUpload-zone">
                                <div class="photoUpload-detail" id="descript-preview"><img class="rounded" src="{{ Helper::GetFolder($folder_upload,true).$rowItem['descript'] }}" onerror=src="{{asset('img/noimage1.png')}}" alt="Alt Photo"/></div>
                                <label class="photoUpload-file" id="photo-descript-zone" for="descript-zone">
                                    <input type="file" name="file_descript" id="descript-zone">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                                    <p class="photoUpload-or">hoặc</p>
                                    <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
                                </label>

                                <div class="form-group">
                                    <label for="hienthi4" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                                    <div class="custom-control custom-checkbox d-inline-block align-middle">
                                        @if($rowItem['hienthi4']==1 || !isset($rowItem))
                                        <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi4]" id="hienthi-checkbox4" checked>
                                        @else
                                        <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi4]" id="hienthi-checkbox4">
                                        @endif                            
                                        <label for="hienthi-checkbox4" class="custom-control-label"></label>
                                    </div>
                                </div>

                                <div class="photoUpload-dimension">{{ "Width: 355px - Height: 180px (".$config[$type]['img_type'].")" }}</div>
                            </div>
                        </div>
                    </div> 
                </div>
                @endif 
                </div>               
            </div>
        {{-- @endif --}}
    </div>
    
    <input type="hidden" name="id" value="{{ $rowItem['id'] }}">
</form>
@endsection

<!--js thêm cho mỗi trang-->
@section('js_page')

@endsection