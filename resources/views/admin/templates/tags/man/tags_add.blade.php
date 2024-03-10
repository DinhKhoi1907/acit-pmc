@extends('admin.master')

@section('content')
<form class="validation-form" novalidate method="post" action="{{route('admin.tags.save',['man',$type])}}" enctype="multipart/form-data">
	@csrf
    <div class="card-footer text-sm sticky-top">
        <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
        <div class="btn dropdown pl-0 ml-1">
          <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Thao tác
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <button type="reset" class="btn btn-sm bg-gradient-secondary btn-none-css"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger btn-none-css" href="{{route('admin.tags.show',['man',$type])}}" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
          </div>
        </div>         
    </div>

    <div class="row">
        <div class="col-xl-8">
            <div class="card card-primary card-outline text-sm">
                <div class="card-header">
                    <h3 class="card-title">{{ $config[$type]['title_main'] }}</h3>
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

                    @if(isset($config[$type]['slug']) && $config[$type]['slug'] == true)
                       @include('admin.layouts.slug')
                    @endif

                    
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

                                        @if(isset($config[$type]['mota']) && $config[$type]['mota'] == true)
                                        <div class="form-group">
                                            <label for="mota{{$k}}" class="inp">
                                                <textarea class="form-control for-seo {{(isset($config[$type]['mota_cke']) && $config[$type]['mota_cke'] == true)?'form-control-ckeditor':''}}" name="data[mota{{$k}}]" id="mota{{$k}}" rows="5" placeholder="&nbsp;">{{ (isset($rowItem['mota'.$k]))?$rowItem['mota'.$k]:'' }}</textarea>
                                                <span class="label">Mô tả ({{$k}}):</span>
                                                <span class="focus-bg"></span>
                                            </label>
                                        </div>
                                        @endif

                                        @if(isset($config[$type]['noidung']) && $config[$type]['noidung'] == true)
                                        <div class="form-group">
                                            <label for="noidung{{$k}}">Nội dung ({{$k}}):</label>
                                            <textarea class="form-control for-seo form-control-ckeditor" name="data[noidung{{$k}}]" id="noidung{{$k}}" rows="5" placeholder="Nội dung ({{$k}})">{{ (isset($rowItem['noidung'.$k]))?$rowItem['noidung'.$k]:'' }}</textarea>
                                        </div>
                                        @endif

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            @if(isset($config[$type]['show_images']) && $config[$type]['show_images'] == true)
                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title">Hình đại diện</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('admin.layouts.image')
                    </div>
                </div>
            @endif

            @if(isset($config[$type]['seo']) && $config[$type]['seo'] == true)
            <div class="card card-primary card-outline text-sm">
                <div class="card-header">
                    <h3 class="card-title">Nội dung SEO</h3>
                    <a class="btn btn-sm bg-gradient-success d-inline-block text-white float-right create-seo" title="Tạo SEO">Tạo SEO</a>
                </div>
                <div class="card-body">
                    @include('admin.layouts.seo')
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
