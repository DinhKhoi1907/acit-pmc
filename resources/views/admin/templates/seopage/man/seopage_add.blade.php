@extends('admin.master')



@section('content')

<form class="validation-form" novalidate method="post" action="{{ route('admin.seopage.save', [$category, $type]) }}" enctype="multipart/form-data" autocomplete="off">

    @csrf

    <div class="text-sm card-footer sticky-top">

        <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="mr-2 far fa-save"></i>Lưu</button>

        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="mr-2 fas fa-redo"></i>Làm lại</button>

    </div>



    <div class="row">

        <div class="col-xl-8">

            @if(isset($config[$type]['banner']) && $config[$type]['banner']==true)

            <div class="text-sm card card-primary card-outline ">

                <div class="card-header">

                    <h3 class="card-title">Banner</h3>

                </div>

                <div class="card-body">

                    <div class="photoUpload-zone">

                        <div class="photoUpload-detail" id="photoUpload-preview2"><img class="rounded" src="{{ Helper::GetFolder($folder_upload,true).$rowItem['banner'] }}" onerror=src="{{asset('img/noimage1.png')}}" alt="Alt Photo"/></div>

                        <label class="photoUpload-file" id="photo-zone2" for="file-zone2">

                            <input type="file" name="banner" id="file-zone2">

                            <i class="fas fa-cloud-upload-alt"></i>

                            <p class="photoUpload-drop">Kéo và thả hình vào đây</p>

                            <p class="photoUpload-or">hoặc</p>

                            <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>

                        </label>

                        <div class="photoUpload-dimension">Width: {{ $config[$type]['width'] }} px - Height: {{ $config[$type]['height'] }} px </br>(.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF)</div>

                    </div>                    

                </div>

            </div>

            @endif

            <div class="text-sm card card-primary card-outline">

                <div class="card-header">

                    <h3 class="card-title">Nội dung {{ $config[$type]['title_main'] }}</h3>

                    <div class="card-tools">

                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                    </div>

                </div>

                <div class="card-body">

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

                                        @if(isset($config[$type]['tieude']) && $config[$type]['tieude']==true)

                                        <div class="form-group">

                                            <label for="ten{{$k}}" class="inp">

                                                <input type="text" class="form-control for-seo" name="data[ten{{$k}}]" id="ten{{$k}}" placeholder="&nbsp;" value="{{ (isset($rowItem['ten'.$k]))?$rowItem['ten'.$k]:'' }}">

                                                <span class="label">Tiêu đề:</span>

                                                <span class="focus-bg"></span>

                                            </label>

                                        </div>

                                        @endif

                                        @if(isset($config[$type]['mota']) && $config[$type]['mota']==true)

                                        <div class="form-group">

                                            <label for="mota{{$k}}" class="inp">

                                                <textarea class="form-control for-seo {{(isset($config[$type]['mota_cke']) && $config[$type]['mota_cke'] == true)?'form-control-ckeditor':''}}" name="data[mota{{$k}}]" id="mota{{$k}}" rows="5" placeholder="&nbsp;">{{ (isset($rowItem['mota'.$k]))?$rowItem['mota'.$k]:'' }}</textarea>

                                                <span class="label">Mô tả ({{$k}}):</span>

                                                <span class="focus-bg"></span>

                                            </label>

                                        </div>

                                        @endif

                                        {{-- <div class="form-group">

                                            <label for="noidung{{$k}}">Nội dung ({{$k}}):</label>

                                            <textarea class="form-control for-seo form-control-ckeditor" name="data[noidung{{$k}}]" id="noidung{{$k}}" rows="5" placeholder="&nbsp;">{{ (isset($rowItem['noidung'.$k]))?$rowItem['noidung'.$k]:'' }}</textarea>

                                        </div> --}}

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    </div>



                </div>

            </div>



        </div>

        <div class="col-xl-4">

            @if(isset($config[$type]['image']) && $config[$type]['image']==true)

            <div class="text-sm card card-primary card-outline">

                <div class="card-header">

                    <h3 class="card-title">Hình đại diện</h3>

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

                        <div class="photoUpload-dimension">Width: 300 px - Height: 200 px (.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF)</div>

                    </div>                    

                </div>

            </div>

            @endif



            

            @if(isset($config[$type]['seo']) && $config[$type]['seo']==true)

            <div class="col-xl-12">

                <div class="text-sm card card-primary card-outline">

                    <div class="card-header">

                        <h3 class="card-title">Nội dung SEO</h3>

                        <a class="float-right text-white btn btn-sm bg-gradient-success d-inline-block create-seo" title="Tạo SEO">Tạo SEO</a>

                    </div>

                    <div class="card-body">

                        @include('admin.layouts.seo')

                    </div>

                </div>

            </div>

            @endif

            

        </div>



    </div>



    <input type="hidden" name="id" value="{{ (isset($rowItem['id']))?$rowItem['id']:'' }}">

    

    {{-- <div class="text-sm card-footer">

        <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="mr-2 far fa-save"></i>Lưu</button>

        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="mr-2 fas fa-redo"></i>Làm lại</button>

        <input type="hidden" name="id" value="{{ (isset($rowItem['id']))?$rowItem['id']:'' }}">

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

