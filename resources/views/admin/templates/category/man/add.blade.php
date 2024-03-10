@extends('admin.master')

@section('content')
@php
    $lang = 'vi';
@endphp
<form class="validation-form" novalidate method="post" action="{{route('admin.category.save',[$type])}}" enctype="multipart/form-data">
	@csrf
    <div class="text-sm card-footer sticky-top">
        <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="mr-2 far fa-save"></i>{{__('Lưu')}}</button>
        <div class="pl-0 ml-1 btn dropdown">
          <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{__('Thao tác')}}
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <button type="submit" class="btn btn-sm bg-gradient-success submit-check btn-none-css" name="savehere"><i class="mr-2 far fa-save"></i>{{__('Lưu tại trang')}}</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary btn-none-css"><i class="mr-2 fas fa-redo"></i>{{__('Làm lại')}}</button>
            <a class="btn btn-sm bg-gradient-danger btn-none-css" href="{{route('admin.category.show',[$type])}}" title="Thoát"><i class="mr-2 fas fa-sign-out-alt"></i>{{__('Thoát')}}</a>
          </div>
        </div>     
    </div>
    <div class="row">
        <div class="col-xl-8">
            @if(isset($config[$type]['slug_category']) && $config[$type]['slug_category'] == true)
        	   @include('admin.layouts.slug')
            @endif
            <div class="text-sm card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ $config[$type]['title_main_category'] }} {{__('Nội dung')}}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="hienthi" class="mb-0 mr-2 align-middle d-inline-block">{{__('Hiển thị')}}:</label>
                        <div class="align-middle custom-control custom-checkbox d-inline-block">
                            @if((isset($rowItem) && $rowItem['hienthi']==1) || !isset($rowItem))
                            <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox" checked>
                            @else
                            <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox">
                            @endif
                            <label for="hienthi-checkbox" class="custom-control-label"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stt" class="mb-0 mr-2 align-middle d-inline-block">{{__('Số thứ tự')}}:</label>
                        <input type="number" class="align-middle form-control form-control-mini d-inline-block" min="0" name="data[stt]" id="stt" placeholder="{{__('Số thứ tự')}}" value="{{ (isset($rowItem['stt']))?$rowItem['stt']:'1' }}">
                    </div>
                    
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="p-0 card-header border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                @foreach(config('config_all.lang') as $k => $v)
                                    <li class="nav-item">
                                        <a class="nav-link {{($k==$lang)?'active':''}}" id="tabs-lang" data-toggle="pill" href="#tabs-lang-{{$k}}" role="tab" aria-controls="tabs-lang-{{$k}}" aria-selected="true">{{$v}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-body card-article">
                            <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                @foreach(config('config_all.lang') as $k => $v)
                                    <div class="tab-pane fade show {{($k==$lang)?'active':''}}" id="tabs-lang-{{$k}}" role="tabpanel" aria-labelledby="tabs-lang">
                                        <div class="form-group">
                                            <label for="ten{{$k}}" class="inp">
                                                <input type="text" class="form-control for-seo" name="data[ten{{$k}}]" id="ten{{$k}}" placeholder="&nbsp;" value="{{ (isset($rowItem['ten'.$k]))?$rowItem['ten'.$k]:'' }}" required>
                                                <span class="label">{{__('Tiêu đề')}} ({{$k}}):</span>
                                                <span class="focus-bg"></span>
                                            </label>
                                        </div>

                                        @if(isset($config[$type]['mota_category']) && $config[$type]['mota_category'] == true)
                                        <div class="form-group">
                                            <label for="mota{{$k}}" class="inp">
                                                <textarea class="form-control for-seo {{(isset($config[$type]['mota_cke_category']) && $config[$type]['mota_cke_category'] == true)?'form-control-ckeditor':''}}" name="data[mota{{$k}}]" id="mota{{$k}}" rows="5" placeholder="&nbsp;">{{ (isset($rowItem['mota'.$k]))?$rowItem['mota'.$k]:'' }}</textarea>
                                                <span class="label">{{__('Mô tả')}} ({{$k}}):</span>
                                                <span class="focus-bg"></span>
                                            </label>
                                        </div>
                                        @endif

                                        @if(isset($config[$type]['noidung_category']) && $config[$type]['noidung_category'] == true)
                                        <div class="form-group">
                                            <label for="noidung<?=$k?>">{{__('Nội dung')}} ({{$k}}):</label>
                                            <textarea class="form-control for-seo form-control-ckeditor" name="data[noidung{{$k}}]" id="noidung{{$k}}" rows="5" placeholder="{{__('Nội dung')}} ({{$k}})">{{ (isset($rowItem['noidung'.$k]))?$rowItem['noidung'.$k]:'' }}</textarea>
                                        </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            @if(isset($config[$type]['property']) && $config[$type]['property'] == true && $thuoctinhs)
            <div class="text-sm card card-primary card-outline" id="property-box">
                <div class="card-header">
                    <h3 class="card-title">Thuộc tính</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <select class="form-control select2" name="dataProperty[]" id="" multiple>
                        <option value="">Chọn thuộc tính liên quan</option>
                        @foreach($thuoctinhs as $k=>$v)
                        <option value="{{$v['id']}}" {{(in_array($v['id'], $thuoctinh_selected)) ? 'selected' : ''}}>{{$v['tenvi']}}</option>
                        @endforeach
                    </select>
                </div>
                
            </div>   
            @endif


        </div>
        <div class="col-xl-4">
            @if($config[$type]['category_multy'])
                @include('admin.layouts.category')
            @else
                @include('admin.layouts.category_single')
            @endif

            {{--
        	<div class="text-sm card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Danh mục cha</h3>
                </div>
                <div class="card-body">
                    <div class="form-group-category row">
                        <div class="px-0 mb-0 form-group col-sm-12">
                        	@include('admin.layouts.category')
                        </div>
                    </div>
                </div>
            </div>


            @if(isset($config[$type]['menu_multiple']) && $config[$type]['menu_multiple'])
                <div class="text-sm card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Danh mục cùng cấp với danh mục cha hiện tại</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group-category row">
                            <div class="px-0 mb-0 form-group col-sm-12">
                                @include('admin.layouts.multy_category')
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            --}}


            @if(isset($config[$type]['images_category']) && $config[$type]['images_category'] == true)
            <div class="text-sm card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{__('Hình đại diện')}} 1</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    @if(config('config_all.fileupload')==true)
                        @php
                            $amount_images = $config[$type]['amount_images'];
                            for($i=0;$i<$amount_images;$i++){
                                TableManipulation::AddFieldToTable('category','photo'.(($i>0) ? $i : ''), 'string');
                                TableManipulation::AddFieldToTable('category','idphoto'.(($i>0) ? $i : ''));
                            }
                        @endphp
                        @include('admin.layouts.devimage')

                        <div class=""><strong>{{ "Width: ".$config[$type]['width_category']." px - Height: ".$config[$type]['height_category']." px (".$config[$type]['img_type_category'].")" }}</strong></div>
                        <input type="hidden" name="width" value="{{$config[$type]['width_category']}}" />
                        <input type="hidden" name="height" value="{{$config[$type]['height_category']}}" />
                    @else
                        <div class="photoUpload-zone">
                            <div class="photoUpload-detail" id="photoUpload-preview"><img class="rounded" src="{{ (isset($rowItem)) ? Helper::GetFolder($folder_upload,true).$rowItem['photo'] : '' }}" onerror=src="{{asset('img/noimage1.png')}}" alt="Alt Photo"/></div>
                            <label class="photoUpload-file" id="photo-zone" for="file-zone">
                                <input type="file" name="file" id="file-zone">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                                <p class="photoUpload-or">hoặc</p>
                                <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
                            </label>
                            <div class="photoUpload-dimension">{{ "Width: ".$config[$type]['width_category']." px - Height: ".$config[$type]['height_category']." px (".$config[$type]['img_type_category'].")" }}</div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- <div class="text-sm card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Hình đại diện 2 {{$config[$type]['title_main']}}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                
                <div class="card-body">
                    <x-image :photo="$rowItem['photo2']" :item="'photo2'" :folder="$folder_upload" :width="$config[$type]['width2_category']" :height="$config[$type]['height2_category']" :extension="$config[$type]['img_type_category']" :ratio="$config[$type]['ratio']" name="photo2" />
                </div>
            </div> --}}
            @endif

            @if(isset($config[$type]['banner']) && $config[$type]['banner'] == true)
                <div class="text-sm card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Banner</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <x-image :photo="(isset($rowItem['banner'])) ? $rowItem['banner'] : ''" :item="'banner'" :folder="$folder_upload" :width="$config[$type]['width_banner']" :height="$config[$type]['height_banner']" :extension="$config[$type]['img_type_category']" :ratio="1" name="banner" />
                    </div>
                </div>
            @endif

            @if(isset($config[$type]['bg_color']) && $config[$type]['bg_color'] == true)
            <div class="text-sm card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Cấu hình màu</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="d-block" for="bg_color">Màu nền:</label>
                        <input type="text" class="form-control jscolor" name="data[bg_color]" id="bg_color" maxlength="7" value="{{(isset($rowItem['bg_color']) && $rowItem['bg_color'])?$rowItem['bg_color']:'#000000'}}">
                    </div>
                    <div class="form-group">
                        <label class="d-block" for="text_color">Màu chữ:</label>
                        <input type="text" class="form-control jscolor" name="data[text_color]" id="text_color" maxlength="7" value="{{(isset($rowItem['text_color']) && $rowItem['text_color'])?$rowItem['text_color']:'#000000'}}">
                    </div>
                </div>
            </div>                
            @endif

            @if(isset($config[$type]['background_category']) && $config[$type]['background_category'] == true)
            <div class="text-sm card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Hình nền {{ $config[$type]['title_main_category'] }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    @if(config('config_all.fileupload')==true)
                        @php
                            $amount_images = $config[$type]['amount_images'];
                            for($i=0;$i<$amount_images;$i++){
                                TableManipulation::AddFieldToTable('category','background'.(($i>0) ? $i : ''), 'string');
                                TableManipulation::AddFieldToTable('category','idbackground'.(($i>0) ? $i : ''));
                            }
                        @endphp
                        @include('admin.layouts.devimage')

                        <div class=""><strong>{{ "Width: ".$config[$type]['widthbg_category']." px - Height: ".$config[$type]['heightbg_category']." px (".$config[$type]['img_type_category'].")" }}</strong></div>
                        <input type="hidden" name="width" value="{{$config[$type]['widthbg_category']}}" />
                        <input type="hidden" name="height" value="{{$config[$type]['heightbg_category']}}" />
                    @else
                        <div class="photoUpload-zone">
                            <div class="photoUpload-detail" id="photoUpload-preview-background"><img class="rounded" src="{{ Helper::GetFolder($folder_upload,true).$rowItem['background'] }}" onerror=src="{{asset('img/noimage1.png')}}" alt="Alt Photo"/></div>
                            <label class="photoUpload-file" id="photo-zone-background" for="file-zone-background">
                                <input type="file" name="background" id="file-zone-background">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                                <p class="photoUpload-or">hoặc</p>
                                <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
                            </label>
                            <div class="photoUpload-dimension">{{ "Width: ".$config[$type]['widthbg_category']." px - Height: ".$config[$type]['heightbg_category']." px (".$config[$type]['img_type_category'].")" }}</div>
                        </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    @if(isset($config[$type]['seo_category']) && $config[$type]['seo_category'] == true)
    <div class="text-sm card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">{{__('Nội dung SEO')}}</h3>
            <a class="float-right text-white btn btn-sm bg-gradient-success d-inline-block create-seo" title="{{__('Tạo SEO')}}">{{__('Tạo SEO')}}</a>
        </div>
        <div class="card-body">
        	@include('admin.layouts.seo')
        </div>
    </div>
    @endif

    @if(isset($config[$type]['gallery']))
        <div class="text-sm card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Bộ sưu tập {{ $config[$type]['title_main'] }}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
            	@if(config('config_all.fileupload')==true)
                    @include('admin.layouts.gallery_multy')
                @else            	
	                <div class="form-group" id="photo-upload-group">
	                    <label for="filer-gallery" class="mb-3 label-filer-gallery">Album hình: ({{ $config[$type]['gallery'][$type]['img_type_photo'] }})</label>
	                    <input type="file" name="files[]" id="filer-gallery" multiple="multiple">
	                    <input type="hidden" class="col-filer" value="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
	                    <input type="hidden" class="act-filer" name="level" value="man">
	                    <input type="hidden" class="folder-filer" name="model" value="category">
	                    <input type="hidden" class="folder-filer" name="type" value="{{ $type }}" id="filer-type-main">
	                    <input type="hidden" name="hash" value="{{ Helper::generateHash() }}" />
	                </div>
	                @if(isset($gallery) && count($gallery) > 0)
	                    <div class="form-group form-group-gallery form-group-gallery-main">
	                        {{--<label class="label-filer">Album hiện tại:</label>--}}
	                        <div class="mb-3 action-filer d-none">
	                            <a class="mr-1 text-white btn btn-sm bg-gradient-primary check-all-filer"><i class="mr-2 far fa-square"></i>Chọn tất cả</a>
	                            <button type="button" class="mr-1 text-white btn btn-sm bg-gradient-success sort-filer"><i class="mr-2 fas fa-random"></i>Sắp xếp</button>
	                            <a class="text-white btn btn-sm bg-gradient-danger delete-all-filer"><i class="mr-2 far fa-trash-alt"></i>Xóa tất cả</a>
	                        </div>
	                        <div class="text-sm text-white alert my-alert alert-sort-filer alert-info bg-gradient-info"><i class="mr-2 fas fa-info-circle"></i>Có thể chọn nhiều hình để di chuyển</div>
	                        <div class="jFiler-items my-jFiler-items jFiler-row">
	                            <ul class="jFiler-items-list jFiler-items-grid row scroll-bar" id="jFilerSortable">
	                                @foreach($gallery as $v)
	                                    {{ Helper::galleryFiler($v['stt'],$v['id'],$v['photo'],$v['tenvi'],'category','col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6') }}
	                                @endforeach
	                            </ul>
	                        </div>
	                    </div>
	                @endif
	            @endif
            </div>
        </div>
    @endif

    <input type="hidden" name="id" value="{{ (isset($rowItem['id']))?$rowItem['id']:'' }}">
    <input type="hidden" name="type" value="{{ $type }}" class="type-main">
    <input type="hidden" name="type_main" value="{{$type}}">
    <input type="hidden" name="table" value="category">
</form>
@endsection


<!--js thêm cho mỗi trang-->
@section('js_page')
    
@endsection
