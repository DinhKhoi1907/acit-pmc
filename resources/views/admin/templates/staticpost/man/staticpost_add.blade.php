@extends('admin.master')

@section('content')
<form class="validation-form" novalidate method="post" action="{{ route('admin.staticpost.save', [$category, $type]) }}" enctype="multipart/form-data" autocomplete="off">
    @csrf
    <div class="text-sm card-footer sticky-top">
        <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="mr-2 far fa-save"></i>Lưu</button>
        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="mr-2 fas fa-redo"></i>Làm lại</button>
    </div>
    <div class="row">
        <div class="col-xl-8">
            <div class="text-sm card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Nội dung {{$config[$type]['title_main']}}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    @if(isset($config[$type]['file']) && $config[$type]['file']==true)
                        <div class="form-group">
                            <label class="mb-1 mr-2 change-file" for="file-taptin">
                                <p>Upload tập tin:</p>
                                <strong class="ml-2">
                                    <span class="btn btn-sm bg-gradient-success"><i class="mr-2 fas fa-file-upload"></i>Chọn tập tin</span>
                                    <div><b class="text-sm text-split"></b></div>
                                </strong>
                            </label>
                            <strong class="mt-2 mb-2 text-sm d-block">Định dạng file: {{$config[$type]['file_type'] }}</strong>
                            <div class="custom-file my-custom-file d-none">
                                <input type="file" class="custom-file-input" name="file-taptin" id="file-taptin">
                                <label class="custom-file-label" for="file-taptin">Chọn file</label>
                            </div>
                            @if(isset($rowItem['taptin']) && $rowItem['taptin'] != '')
                                <a class="p-2 mb-1 text-white align-middle rounded btn btn-sm bg-gradient-primary d-inline-block" href="{{ (isset($rowItem['taptin']))?config('config_upload.UPLOAD_FILE').$rowItem['taptin']:'' }}" download title="Download tập tin hiện tại"><i class="mr-2 fas fa-download"></i>Download tập tin hiện tại</a>
                            @endif
                        </div>
                    @endif

                    @if(isset($config[$type]['select']) && $config[$type]['select']==true)
                        <div class="form-group row">
                            <div class="form-group col-md-4 col-sm-6">
                                <label>Ngày bắt đầu:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="float-right form-control" name="data[begindate]" id="ngaybatdau" value="{{(isset($rowItem['begindate'])) ? $rowItem['begindate'] : ''}}">
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-sm-6">
                                <label>Thời gian bắt đầu:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="float-right form-control" name="data[begintime]" id="thoigianbatdau" value="{{(isset($rowItem['begintime'])) ? $rowItem['begintime'] : ''}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="form-group col-md-4 col-sm-6">
                                <label>Ngày kết thúc:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="float-right form-control" name="data[enddate]" id="ngayketthuc" value="{{(isset($rowItem['enddate'])) ? $rowItem['enddate'] : ''}}">
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-sm-6">
                                <label>Thời gian kết thúc:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="float-right form-control" name="data[endtime]" id="thoigianketthuc" value="{{(isset($rowItem['endtime'])) ? $rowItem['endtime'] : ''}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="d-block" for="giasale">Giá quy ước:</label>
                            <div class="input-group">
                                <input type="text" class="form-control format-price gia_cu" name="data[giasale]" id="giasale" placeholder="Giá sale" value="{{$rowItem['giasale']}}">
                                <div class="input-group-append">
                                    <div class="input-group-text"><strong>VNĐ</strong></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="d-block" for="giasale">Số lượng:</label>
                            <div class="input-group">
                                <input type="text" class="float-right form-control" name="data[tongsl]" id="tongsl" value="{{(isset($rowItem['tongsl'])) ? $rowItem['tongsl'] : ''}}">
                            </div>
                        </div>

                        <div class="form-group col-xl-6 col-sm-4">
                            <label class="d-block" for="id_list">Chọn sản phẩm Flashsale:</label>
                            {!! Helper::get_ajax_product('product', 'product', 'product', $rowItem['id_product']) !!}
                        </div>
                        <div class="form-group col-xl-12 col-sm-12">
                            <div id="showProductSelect">
                                <div class="flashsale_containerB">
                                    @foreach($array_product as $k=>$v)
                                        <div class="flashsale_itemB">
                                            <a class="flashsale_imgB"><img class="rounded img-upload" src="{{ (isset($v['photo']))?config('config_upload.UPLOAD_PRODUCT').$v['photo']:'' }}" onerror=src="{{asset('img/noimage.png')}}" alt="Alt Photo"/></a>
                                            <h2 class="flashsale_nameB"><a>{{ $v['ten'] }}</a></h2>
                                            <div class="flashsale_infoB">
                                                <!--<label>Số lượng:</label>
                                                <input type="text" name="soluong[]" value="<?=$v['soluong']?>">-->
                                                <input type="hidden" name="id[]" value="{{$v['id']}}">
                                                <input type="hidden" name="name[]" value="{{$v['ten']}}">
                                                <input type="hidden" name="photo[]" value="{{$v['photo']}}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="hienthi" class="mb-0 mr-2 align-middle d-inline-block">Hiển thị:</label>
                        <div class="align-middle custom-control custom-checkbox d-inline-block">
                            <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox" {{ (!isset($rowItem['hienthi']) || $rowItem['hienthi']==1)?'checked':'' }}>
                            <label for="hienthi-checkbox" class="custom-control-label"></label>
                        </div>
                    </div>
                    @if((isset($config[$type]['tieude']) && $config[$type]['tieude'] == true) || (isset($config[$type]['mota']) && $config[$type]['mota'] == true) || (isset($config[$type]['noidung']) && $config[$type]['noidung'] == true))
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="p-0 card-header border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                    @foreach(config('config_all.lang') as $k => $v)
                                        @php
                                            TableManipulation::AddFieldToTable('static','ten'.$k, 'string');
                                            TableManipulation::AddFieldToTable('static','mota'.$k, 'text');
                                            TableManipulation::AddFieldToTable('static','noidung'.$k, 'text');
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
                                                    <input type="text" class="form-control for-seo" name="data[ten{{$k}}]" id="ten{{$k}}" placeholder="Tiêu đề ({{$k}})" value="{{ $rowItem['ten'.$k] }}" {{($k=='vi')?'required':''}} >
                                                </div>
                                            @endif

                                            @if(isset($config[$type]['slogan']) && $config[$type]['slogan'] == true)

                                                <div class="form-group">

                                                    <label for="slogan{{$k}}">Slogan ({{$k}}):</label>

                                                    <input type="text" class="form-control for-seo" name="data[slogan{{$k}}]" id="slogan{{$k}}" placeholder="Slogan ({{$k}})" value="{{ $rowItem['slogan'.$k] }}" {{($k==$lang)?'required':''}} >

                                                </div>

                                            @endif

                                            @if(isset($config[$type]['mota']) && $config[$type]['mota'] == true)
                                                <div class="form-group">
                                                    <label for="mota{{$k}}">{{($type=='dai-su-minigo') ? 'Giải thưởng':'Mô tả'}} ({{$k}}):</label>
                                                    <textarea class="form-control for-seo {{(isset($config[$type]['mota_cke']) && $config[$type]['mota_cke'] == true)?'form-control-ckeditor':''}}" name="data[mota{{$k}}]" id="mota{{$k}}" rows="5" placeholder="Mô tả ({{$k}})">{{($rowItem['mota'.$k])}}</textarea>
                                                </div>
                                            @endif

                                            @if(isset($config[$type]['noidung']) && $config[$type]['noidung'] == true)
                                                <div class="form-group">
                                                    <label for="noidung{{$k}}">{{($type=='dai-su-minigo') ? 'Thể lệ':'Nội dung'}} ({{$k}}):</label>
                                                    <textarea class="form-control for-seo {{(isset($config[$type]['noidung_cke']) && $config[$type]['noidung_cke'] == true)?'form-control-ckeditor':''}}" name="data[noidung{{$k}}]" id="noidung{{$k}}" rows="15" placeholder="Nội dung ({{$k}})">{{($rowItem['noidung'.$k])}}</textarea>
                                                </div>
                                            @endif

                                            @if(isset($config[$type]['giatri']) && $config[$type]['giatri'] == true)
                                            <div class="form-group">
                                                <label for="cotloi<?=$k?>">Giá trị cốt lõi ({{$k}}):</label>
                                                <textarea class="form-control for-seo form-control-ckeditor" name="data[cotloi{{$k}}]" id="cotloi{{$k}}" rows="5" placeholder="Giá trị cốt lõi ({{$k}})">{{ (isset($rowItem['cotloi'.$k]))?$rowItem['cotloi'.$k]:'' }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="tamnhin<?=$k?>">Tầm nhìn sứ mệnh ({{$k}}):</label>
                                                <textarea class="form-control for-seo form-control-ckeditor" name="data[tamnhin{{$k}}]" id="tamnhin{{$k}}" rows="5" placeholder="Tầm nhìn sứ mệnh ({{$k}})">{{ (isset($rowItem['tamnhin'.$k]))?$rowItem['tamnhin'.$k]:'' }}</textarea>
                                            </div>
                                            @endif

                                            @if(isset($config[$type]['tieudeform']) && $config[$type]['tieudeform'] == true)
                                                <div class="form-group">
                                                    <label for="tieudeform{{$k}}">Nội dung form ({{$k}}):</label>
                                                    <textarea class="form-control for-seo {{(isset($config[$type]['tieudeform_cke']) && $config[$type]['tieudeform_cke'] == true)?'form-control-ckeditor':''}}" name="data[tieudeform{{$k}}]" id="tieudeform{{$k}}" rows="5" placeholder="Nội dung ({{$k}})">{{($rowItem['tieudeform'.$k])}}</textarea>
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
        <div class="col-xl-4">
            @if(isset($config[$type]['images']) && $config[$type]['images'] == true)
                <div class="text-sm card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Hình ảnh {{$config[$type]['title_main']}}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(config('config_all.fileupload')==true)
                            @php
                                $amount_images = $config[$type]['amount_images'];
                                for($i=0;$i<$amount_images;$i++){
                                    TableManipulation::AddFieldToTable('static','photo'.(($i>0) ? $i : ''), 'string');
                                    TableManipulation::AddFieldToTable('static','idphoto'.(($i>0) ? $i : ''));
                                }
                            @endphp
                            @include('admin.layouts.devimage')
                        @else
                            @include('admin.layouts.image')
                        @endif
                    </div>
                </div>
            @endif
            
            @if(isset($config[$type]['images2']) && $config[$type]['images2'] == true)
                <div class="text-sm card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Hình ảnh {{$config[$type]['title_main']}} 2</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(config('config_all.fileupload')==true)
                            @php
                                $amount_images = $config[$type]['amount_images'];
                                for($i=0;$i<$amount_images;$i++){
                                    TableManipulation::AddFieldToTable('static','photo'.(($i>0) ? $i : ''), 'string');
                                    TableManipulation::AddFieldToTable('static','idphoto'.(($i>0) ? $i : ''));
                                }
                            @endphp
                            @include('admin.layouts.devimage')
                        @else
                            @include('admin.layouts.image2')
                        @endif
                    </div>
                </div>
            @endif
            @if(isset($config[$type]['banner']) && $config[$type]['banner'] == true)
                <div class="text-sm card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Banner {{$config[$type]['title_main']}}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <x-image :photo="$rowItem['banner']" :item="'banner'" :folder="$folder_upload" :width="$config[$type]['width_banner']" :height="$config[$type]['height_banner']" :extension="$config[$type]['img_type']" :ratio="$config[$type]['ratio']" name="banner" />
                    </div>
                </div>
            @endif

            @if(isset($config[$type]['link']) && $config[$type]['link'] == true)
                <div class="text-sm card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Link:</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="linkthamkhao">Tham khảo dự án:</label>
                            <input type="text" class="form-control for-seo" name="data[linkthamkhao]" id="linkthamkhao" placeholder="Tham khảo dự án" value="{{ $rowItem['linkthamkhao'] }}">
                        </div>
                        <div class="form-group">
                            <label for="linkchuyengia">Chuyên gia của chúng tôi:</label>
                            <input type="text" class="form-control for-seo" name="data[linkchuyengia]" id="linkchuyengia" placeholder="Chuyên gia của chúng tôi" value="{{ $rowItem['linkchuyengia'] }}">
                        </div>
                    </div>
                </div>
            @endif

            @if(isset($config[$type]['video']) && $config[$type]['video'] == true)

                {{-- <div class="text-sm card card-primary card-outline">

                    <div class="card-header">

                        <h3 class="card-title">Poster video</h3>

                        <div class="card-tools">

                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                        </div>

                    </div>

                    <div class="card-body">

                        <x-image :photo="$rowItem['poster']" :item="'poster'" :folder="$folder_upload" :width="$config[$type]['width_poster']" :height="$config[$type]['height_poster']" :extension="$config[$type]['img_type']" :ratio="$config[$type]['ratio']" name="poster" />

                    </div>

                </div> --}}

                

                <div class="text-sm card card-primary card-outline">

                    <div class="card-header">

                        <h3 class="card-title">Video Upload (.mp4)</h3>

                        <div class="card-tools">

                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="form-group">

                            @if($rowItem['video']=='')

                                <label class="change-photo" style="width:100%; text-align:center" for="video">

                                    <div class="rounded">

                                        <svg style="fill:rgba(38, 185, 154, 1) !important" xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24"><path d="M16 16h-3v5h-2v-5h-3l4-4 4 4zm3.479-5.908c-.212-3.951-3.473-7.092-7.479-7.092s-7.267 3.141-7.479 7.092c-2.57.463-4.521 2.706-4.521 5.408 0 3.037 2.463 5.5 5.5 5.5h3.5v-2h-3.5c-1.93 0-3.5-1.57-3.5-3.5 0-2.797 2.479-3.833 4.433-3.72-.167-4.218 2.208-6.78 5.567-6.78 3.453 0 5.891 2.797 5.567 6.78 1.745-.046 4.433.751 4.433 3.72 0 1.93-1.57 3.5-3.5 3.5h-3.5v2h3.5c3.037 0 5.5-2.463 5.5-5.5 0-2.702-1.951-4.945-4.521-5.408z"/></svg>

                                        <strong>

                                            <b class="text-sm text-split"></b>

                                            <span class="btn btn-sm bg-gradient-success"><i class="mr-2 fas fa-camera"></i>Chọn video</span>

                                        </strong>

                                    </div>

                                </label>

                            @else

                                <label class="change-photo" style="width:100%; text-align:center" for="video">

                                    <div class="rounded">

                                        <video width="100%" controls autoplay="" muted>

                                            <source src="{{ (isset($rowItem['video']))?config('config_upload.UPLOAD_STATICPOST').$rowItem['video']:'' }}" type="video/mp4">

                                            <source src="{{ (isset($rowItem['video']))?config('config_upload.UPLOAD_STATICPOST').$rowItem['video']:'' }}" type="video/webm">

                                        </video>

                                        <strong>

                                            <b class="text-sm text-split"></b>

                                            <span class="btn btn-sm bg-gradient-success"><i class="mr-2 fas fa-camera"></i>Chọn video</span>

                                        </strong>

                                    </div>

                                </label>

                            @endif



                            <div class="custom-file my-custom-file d-none">

                                <input type="file" class="custom-file-input" name="video" id="video" accept="video/mp4">

                                <label class="custom-file-label" for="video">Chọn file</label>

                            </div>

                        </div>

                    </div>

                </div>

            @endif

            @if(isset($config[$type]['seo']) && $config[$type]['seo'] == true)
                <div class="text-sm card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Nội dung SEO</h3>
                        <a class="float-right text-white btn btn-sm bg-gradient-success d-inline-block create-seo" title="Tạo SEO">Tạo SEO</a>
                    </div>
                    <div class="card-body">
                        @include('admin.layouts.seo')
                    </div>
                </div>
            @endif            
        </div>
    </div>

    @if(isset($config[$type]['gallery']) && $config[$type]['gallery']==true)
        <div class="text-sm card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Bộ sưu tập {{ $config[$type]['title_main'] }}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group" id="photo-upload-group">
                    <label for="filer-gallery" class="mb-1 label-filer-gallery">Album hình: ({{ $config[$type]['img_type_photo'] }})</label>
                    <div class="mb-3 photoUpload-dimensio"><strong>{{ "Width: ".$config[$type]['width']*$config[$type]['ratio']." px - Height: ".$config[$type]['height']*$config[$type]['ratio']." px (".$config[$type]['img_type'].")" }}</strong></div>
                    <input type="file" name="files[]" id="filer-gallery" multiple="multiple">
                    <input type="hidden" class="col-filer" value="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                    <input type="hidden" class="act-filer" name="level" value="man">
                    <input type="hidden" class="folder-filer" name="model" value="staticpost">
                    <input type="hidden" class="folder-filer" name="type" value="{{ $type }}">
                    <input type="hidden" name="hash" value="{{ Helper::generateHash() }}" />
                </div>                
                @if(isset($gallery) && count($gallery) > 0)
                    <div class="form-group form-group-gallery form-group-gallery-main">
                        {{--<label class="label-filer">Album hiện tại:</label>--}}
                        <div class="mb-3 action-filer">
                            <a class="mr-1 text-white btn btn-sm bg-gradient-primary check-all-filer"><i class="mr-2 far fa-square"></i>Chọn tất cả</a>
                            <button type="button" class="mr-1 text-white btn btn-sm bg-gradient-success sort-filer"><i class="mr-2 fas fa-random"></i>Sắp xếp</button>
                            <a class="text-white btn btn-sm bg-gradient-danger delete-all-filer"><i class="mr-2 far fa-trash-alt"></i>Xóa tất cả</a>
                        </div>
                        <div class="text-sm text-white alert my-alert alert-sort-filer alert-info bg-gradient-info"><i class="mr-2 fas fa-info-circle"></i>Có thể chọn nhiều hình để di chuyển</div>
                        <div class="jFiler-items my-jFiler-items jFiler-row">
                            <ul class="jFiler-items-list jFiler-items-grid row scroll-bar" id="jFilerSortable">
                                @foreach($gallery as $v)
                                    {{ Helper::galleryFiler($v['stt'],$v['id'],$v['photo'],$v['tenvi'],'staticpost','col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6') }}
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <input type="hidden" name="id" value="{{ (isset($rowItem['id']))?$rowItem['id']:'' }}">
    <input type="hidden" name="model" class="autosave-btn" value="staticpost">
    <input type="hidden" name="type" value="{{ $type }}">

    {{-- <div class="text-sm card-footer">
        <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="mr-2 far fa-save"></i>Lưu</button>
        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="mr-2 fas fa-redo"></i>Làm lại</button>
        
    </div> --}}
</form>
@endsection

<!--js thêm cho mỗi trang-->
@section('js_page')
    <script>
        $(document).ready(function(){
            $('#ngaybatdau').datetimepicker({
                timepicker:false,
                format:'d/m/Y'
            });

            $('#ngayketthuc').datetimepicker({
                timepicker:false,
                format:'d/m/Y'
            });

            $('#thoigianbatdau').datetimepicker({
                datepicker:false,
                format:'H:i'
            });

            $('#thoigianketthuc').datetimepicker({
                datepicker:false,
                format:'H:i'
            });
        });
    </script>
@endsection
