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
    @for($i=0;$i<$numberPhoto;$i++)
        <div class="col-xl-12">
            <div class="card card-primary card-outline text-sm">
                <div class="card-header">
                    <h3 class="card-title">{{ $config[$type]['title_main'].": ".($i+1) }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if(isset($config[$type]['images']) && $config[$type]['images']==true)
                        <div class="col-xl-6">                        
                            <div class="form-group">                                
                                <label class="change-photo" for="file{{$i}}">
                                    <p>Upload hình ảnh:</p>
                                    <div class="rounded">
                                        <img class="rounded img-upload" src="" onerror=src="{{asset('img/noimage.png')}}" alt="Alt Photo"/>
                                        <strong>
                                            <b class="text-sm text-split"></b>
                                            <span class="btn btn-sm bg-gradient-success"><i class="fas fa-camera mr-2"></i>Chọn hình</span>
                                        </strong>
                                    </div>
                                </label>

                                <div class="form-group mt-2 d-none">
                                    <label for="hienthi{{$i}}" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                                    <div class="custom-control custom-checkbox d-inline-block align-middle">
                                        <input type="checkbox" class="custom-control-input hienthi-checkbox" name="dataMulti[{{$i}}][hienthi1]" id="hienthi-checkbox{{$i}}" checked>
                                        <label for="hienthi-checkbox{{$i}}" class="custom-control-label"></label>
                                    </div>
                                </div>

                                <strong class="d-block mt-2 mb-2 text-sm">{{ "Width: ".$config[$type]['width']." px - Height: ".$config[$type]['height']." px (".$config[$type]['img_type'].")" }}</strong>

                                <div class="custom-file my-custom-file d-none">
                                    <input type="file" class="custom-file-input" name="file{{$i}}" id="file{{$i}}">
                                    <label class="custom-file-label" for="file{{$i}}">Chọn file</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="hienthi{{$i}}" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                                <div class="custom-control custom-checkbox d-inline-block align-middle">
                                    <input type="checkbox" class="custom-control-input hienthi-checkbox" name="dataMulti[{{$i}}][hienthi]" id="hienthi-checkbox{{$i}}" checked>
                                    <label for="hienthi-checkbox{{$i}}" class="custom-control-label"></label>
                                </div>
                            </div>
                        </div>
                        
                        @endif

                        @if(isset($config[$type]['video_upload']) && $config[$type]['video_upload']==true)
                        <div class="col-xl-6">   
                            <div class="form-group">
                                <label class="change-photo" for="video{{$i}}">
                                    <p>Upload video (.mp4):</p>
                                    <div class="rounded">
                                        <img class="rounded img-upload" src="{{ (isset($rowItem['photo']))?config('config_upload.UPLOAD_PHOTO').$rowItem['video']:'' }}" onerror="src='{{asset('img/noimage.png')}}'" alt="Alt Photo"/>
                                        <strong>
                                            <b class="text-sm text-split"></b>
                                            <span class="btn btn-sm bg-gradient-success"><i class="fas fa-camera mr-2"></i>Chọn video</span>
                                        </strong>                            
                                    </div>
                                </label>
                                <div class="custom-file my-custom-file d-none">
                                    <input type="file" class="custom-file-input" name="video{{$i}}" id="video{{$i}}" accept="video/mp4">
                                    <label class="custom-file-label" for="video{{$i}}">Chọn file</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="hienthi_video{{$i}}" class="d-inline-block align-middle mb-0 mr-2">Hiển thị video:</label>
                                <div class="custom-control custom-checkbox d-inline-block align-middle">
                                    <input type="checkbox" class="custom-control-input hienthi_video-checkbox" name="dataMulti[{{$i}}][hienthi_video]" id="hienthi_video-checkbox{{$i}}" checked>
                                    <label for="hienthi_video-checkbox{{$i}}" class="custom-control-label"></label>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(isset($config[$type]['background']) && $config[$type]['background']==true)
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label class="change-photo" for="background{{$i}}">
                                    <p>Upload hình nền:</p>
                                    <div class="rounded">
                                        <img class="rounded img-upload" src="" onerror=src="{{asset('img/noimage.png')}}" alt="Alt Photo"/>
                                        <strong>
                                            <b class="text-sm text-split"></b>
                                            <span class="btn btn-sm bg-gradient-success"><i class="fas fa-camera mr-2"></i>Chọn hình</span>
                                        </strong>
                                    </div>
                                </label>

                                <strong class="d-block mt-2 mb-2 text-sm">{{ "Width: ".$config[$type]['width_bg']." px - Height: ".$config[$type]['height_bg']." px (".$config[$type]['img_type'].")" }}</strong>

                                <div class="custom-file my-custom-file d-none">
                                    <input type="file" class="custom-file-input" name="background{{$i}}" id="background{{$i}}">
                                    <label class="custom-file-label" for="background{{$i}}">Chọn file</label>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(isset($config[$type]['another_image']) && $config[$type]['another_image']==true)
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label class="change-photo" for="file_model{{$i}}">
                                    <p>Hình 1:</p>
                                    <div class="rounded">
                                        <img class="rounded img-upload" src="" onerror=src="{{asset('img/noimage.png')}}" alt="Alt Photo"/>
                                        <strong>
                                            <b class="text-sm text-split"></b>
                                            <span class="btn btn-sm bg-gradient-success"><i class="fas fa-camera mr-2"></i>Chọn hình</span>
                                        </strong>
                                    </div>
                                </label>

                                <div class="form-group mt-2">
                                    <label for="hienthi{{$i}}" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                                    <div class="custom-control custom-checkbox d-inline-block align-middle">
                                        <input type="checkbox" class="custom-control-input hienthi-checkbox" name="dataMulti[{{$i}}][hienthi2]" id="hienthi-checkbox{{$i}}" checked>
                                        <label for="hienthi-checkbox{{$i}}" class="custom-control-label"></label>
                                    </div>
                                </div>

                                <strong class="d-block mt-2 mb-2 text-sm">{{ "Width: 205px - Height: 175px (".$config[$type]['img_type'].")" }}</strong>                                

                                <div class="custom-file my-custom-file d-none">
                                    <input type="file" class="custom-file-input" name="file_model{{$i}}" id="file_model{{$i}}">
                                    <label class="custom-file-label" for="file{{$i}}">Chọn file</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">                           
                            <div class="form-group">
                                <label class="change-photo" for="file_banner{{$i}}">
                                    <p>Hình 2:</p>
                                    <div class="rounded">
                                        <img class="rounded img-upload" src="" onerror=src="{{asset('img/noimage.png')}}" alt="Alt Photo"/>
                                        <strong>
                                            <b class="text-sm text-split"></b>
                                            <span class="btn btn-sm bg-gradient-success"><i class="fas fa-camera mr-2"></i>Chọn hình</span>
                                        </strong>
                                    </div>
                                </label>

                                <div class="form-group mt-2">
                                    <label for="hienthi<?=$i?>" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                                    <div class="custom-control custom-checkbox d-inline-block align-middle">
                                        <input type="checkbox" class="custom-control-input hienthi-checkbox" name="dataMulti[{{$i}}][hienthi3]" id="hienthi-checkbox{{$i}}" checked>
                                        <label for="hienthi-checkbox<?=$i?>" class="custom-control-label"></label>
                                    </div>
                                </div>

                                <strong class="d-block mt-2 mb-2 text-sm">{{ "Width: 230px - Height:180px (".$config[$type]['img_type'].")" }}</strong> 

                                <div class="custom-file my-custom-file d-none">
                                    <input type="file" class="custom-file-input" name="file_banner{{$i}}" id="file_banner{{$i}}">
                                    <label class="custom-file-label" for="file{{$i}}">Chọn file</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="form-group">
                                <label class="change-photo" for="file_descript{{$i}}">
                                    <p>Hình 3:</p>
                                    <div class="rounded">
                                        <img class="rounded img-upload" src="" onerror=src="{{asset('img/noimage.png')}}" alt="Alt Photo"/>
                                        <strong>
                                            <b class="text-sm text-split"></b>
                                            <span class="btn btn-sm bg-gradient-success"><i class="fas fa-camera mr-2"></i>Chọn hình</span>
                                        </strong>
                                    </div>
                                </label>

                                <div class="form-group mt-2">
                                    <label for="hienthi<?=$i?>" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                                    <div class="custom-control custom-checkbox d-inline-block align-middle">
                                        <input type="checkbox" class="custom-control-input hienthi-checkbox" name="dataMulti[{{$i}}][hienthi4]" id="hienthi-checkbox{{$i}}" checked>
                                        <label for="hienthi-checkbox<?=$i?>" class="custom-control-label"></label>
                                    </div>
                                </div>

                                <strong class="d-block mt-2 mb-2 text-sm">{{ "Width: 355x - Height: 180px (".$config[$type]['img_type'].")" }}</strong>

                                <div class="custom-file my-custom-file d-none">
                                    <input type="file" class="custom-file-input" name="file_descript{{$i}}" id="file_descript{{$i}}">
                                    <label class="custom-file-label" for="file{{$i}}">Chọn file</label>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    @if(isset($config[$type]['prename']) && $config[$type]['prename']==true)
                        <div class="form-group">
                            <label for="prename{{$i}}">Định danh:</label>
                            <input type="text" class="form-control" name="dataMulti[{{$i}}][prename]" id="prename{{$i}}" placeholder="Định danh">
                        </div>
                    @endif

                    @if(isset($config[$type]['link']) && $config[$type]['link']==true)
                        <div class="form-group">
                            <label for="link{{$i}}">Link:</label>
                            <input type="text" class="form-control" name="dataMulti[{{$i}}][link]" id="link{{$i}}" placeholder="Link">
                        </div>
                    @endif

                    @if(isset($config[$type]['video']) && $config[$type]['video']==true)
                        <div class="form-group">
                            <label for="link_video{{$i}}">Video:</label>
                            <input type="text" class="form-control" name="dataMulti[{{$i}}][link_video]" id="link_video{{$i}}" onchange="youtubePreview(this.value,'#loadVideo{{$i}}');" placeholder="Video">
                        </div>
                        <div class="form-group">
                            <label for="link_video">Video preview:</label>
                            <div><iframe id="loadVideo{{$i}}" width="0px" height="0px" frameborder="0" allowfullscreen></iframe></div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="stt{{$i}}" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
                        <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="dataMulti[{{$i}}][stt]" id="stt{{$i}}" placeholder="Số thứ tự" value="1">
                    </div>

                    @if(isset($config[$type]['settime']) && $config[$type]['settime'] == true)
                    <div class="form-settime mb-3">
                        <div class="form-group">
                            <label for="" class="d-inline-block align-middle mb-0 mr-2">Thiết lập thời gian hiển thị:</label>
                        </div>
                        <div class="form-group d-flex">
                            <input id="loaihienthi-0" type="radio" name="dataMulti[{{$i}}][loaihienthi]" value="0" checked> 
                            <label for="loaihienthi-0" class="d-inline-block align-middle mb-0 ml-2">Hiển thị 1 lần khi truy cập website</label>
                        </div>
                        <div class="form-group d-flex">
                            <input id="loaihienthi-1" type="radio" name="dataMulti[{{$i}}][loaihienthi]" value="1">
                            <label for="loaihienthi-1" class="d-inline-block align-middle mb-0 ml-2" >Hiển thị 1 lần sau <input type="number" name="dataMulti[{{$i}}][timehienthi]" value="0" style="width:50px;text-align:center"> phút</label>
                        </div>
                    </div>
                    @endif

                    @if((isset($config[$type]['tieude']) && $config[$type]['tieude']==true) || (isset($config[$type]['mota']) && $config[$type]['mota']==true) || (isset($config[$type]['noidung']) && $config[$type]['noidung']==true))
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                    @foreach(config('config_all.lang') as $key => $value)
                                        @php
                                            TableManipulation::AddFieldToTable('photo','ten'.$key, 'string');
                                        @endphp
                                        <li class="nav-item">
                                            <a class="nav-link {{($key=='vi')?'active':''}}" id="tabs-lang" data-toggle="pill" href="#tabs-lang-{{$key}}-{{$i}}" role="tab" aria-controls="tabs-lang-{{$key}}-{{$i}}" aria-selected="true"><?=$value?></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-body card-article">
                                <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                    @foreach(config('config_all.lang') as $key => $value)
                                        <div class="tab-pane fade show {{($key=='vi')?'active':''}}" id="tabs-lang-{{$key}}-{{$i}}" role="tabpanel" aria-labelledby="tabs-lang">
                                            @if(isset($config[$type]['tieude']) && $config[$type]['tieude']==true)
                                                <div class="form-group">
                                                    <label for="ten{{$key}}{{$i}}">Tiêu đề ({{ $key }}):</label>
                                                    <input type="text" class="form-control" name="dataMulti[{{$i}}][ten{{$key}}]" id="ten{{$key}}{{$i}}" placeholder="Tiêu đề ({{ $key }})">
                                                </div>
                                            @endif

                                            @if(isset($config[$type]['mota']) && $config[$type]['mota']==true)
                                                <div class="form-group">
                                                    <label for="mota{{$key}}{{$i}}">Mô tả ({{$key}}):</label>
                                                    <textarea class="form-control {{ ((isset($config[$type]['mota_cke']) && $config[$type]['mota_cke'] == true))?'form-control-ckeditor':'' }}" name="dataMulti[{{$i}}][mota{{$key}}]" id="mota{{$key}}{{$i}}" rows="5" placeholder="Mô tả ({{$key}})"></textarea>
                                                </div>
                                            @endif

                                            @if(isset($config[$type]['noidung']) && $config[$type]['noidung']==true)
                                                <div class="form-group">
                                                    <label for="noidung{{$key}}{{$i}}">Nội dung (<?=$k?>):</label>
                                                    <textarea class="form-control {{ ((isset($config[$type]['noidung_cke']) && $config[$type]['noidung_cke'] == true))?'form-control-ckeditor':'' }}" name="dataMulti[{{$i}}][mota{{$key}}]" id="noidung{{$key}}{{$i}}" rows="5" placeholder="Nội dung ({{$key}})"></textarea>
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
        </div>
    @endfor
    </div>
</form>
@endsection

<!--js thêm cho mỗi trang-->
@section('js_page')

@endsection