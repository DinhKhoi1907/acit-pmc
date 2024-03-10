@extends('admin.master')

@section('content')
    @php
        $lang = 'vi';
    @endphp
    <form class="validation-form autosave-form" novalidate method="post"
        action="{{ route('admin.post.save', ['man', $type]) }}" enctype="multipart/form-data">
        @csrf
        <div class="text-sm card-footer sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i
                    class="mr-2 far fa-save"></i>Lưu</button>
            <div class="pl-0 ml-1 btn dropdown">
                <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Thao tác
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <button type="submit" class="btn btn-sm bg-gradient-success submit-check btn-none-css"
                        name="savehere"><i class="mr-2 far fa-save"></i>Lưu tại trang</button>
                    <button type="submit" class="btn btn-sm bg-gradient-success submit-check btn-none-css"
                        name="savedraft"><i class="mr-2 fas fa-file-export"></i>Lưu nháp</button>
                    <button type="reset" class="btn btn-sm bg-gradient-secondary btn-none-css"><i
                            class="mr-2 fas fa-redo"></i>Làm lại</button>
                    <a class="btn btn-sm bg-gradient-danger btn-none-css"
                        href="{{ route('admin.post.show', ['man', $type]) }}" title="Thoát"><i
                            class="mr-2 fas fa-sign-out-alt"></i>Thoát</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="{{ $type != 'livesignal' ? 'col-xl-8' : 'col-xl-12' }}">
                @if (isset($config[$type]['slug']) && $config[$type]['slug'] == true)
                    @include('admin.layouts.slug')
                @endif
                <div class="text-sm card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Nội dung {{ $config[$type]['title_main'] }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (isset($config[$type]['file']) && $config[$type]['file'] == true)
                            <div class="form-group">
                                <label class="mb-1 mr-2 change-file" for="file-taptin">
                                    <p>Upload tập tin:</p>
                                    <strong class="ml-2">
                                        <span class="btn btn-sm bg-gradient-success"><i
                                                class="mr-2 fas fa-file-upload"></i>Chọn tập tin</span>
                                        <div><b class="text-sm text-split"></b></div>
                                    </strong>
                                </label>
                                <strong class="mt-2 mb-2 text-sm d-block">Định dạng file:
                                    {{ $config[$type]['file_type'] }}</strong>
                                <div class="custom-file my-custom-file d-none">
                                    <input type="file" class="custom-file-input" name="file-taptin" id="file-taptin">
                                    <label class="custom-file-label" for="file-taptin">Chọn file</label>
                                </div>
                                @if (isset($rowItem['taptin']) && $rowItem['taptin'] != '')
                                    <a class="p-2 mb-1 text-white align-middle rounded btn btn-sm bg-gradient-primary d-inline-block"
                                        href="{{ isset($rowItem['taptin']) ? config('config_upload.UPLOAD_FILE') . $rowItem['taptin'] : '' }}"
                                        download title="Download tập tin hiện tại"><i
                                            class="mr-2 fas fa-download"></i>Download tập tin hiện tại</a>
                                @endif
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="hienthi" class="mb-0 mr-2 align-middle d-inline-block">Hiển thị:</label>
                            <div class="align-middle custom-control custom-checkbox d-inline-block">
                                @if ($rowItem['hienthi'] == 1 || !isset($rowItem))
                                    <input type="checkbox" class="custom-control-input hienthi-checkbox"
                                        name="data[hienthi]" id="hienthi-checkbox" checked>
                                @else
                                    <input type="checkbox" class="custom-control-input hienthi-checkbox"
                                        name="data[hienthi]" id="hienthi-checkbox">
                                @endif
                                <label for="hienthi-checkbox" class="custom-control-label"></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="stt" class="mb-0 mr-2 align-middle d-inline-block">Số thứ tự:</label>
                            <input type="number" class="align-middle form-control form-control-mini d-inline-block"
                                min="0" name="data[stt]" id="stt" placeholder="Số thứ tự"
                                value="{{ isset($rowItem['stt']) ? $rowItem['stt'] : '1' }}">
                        </div>

                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="p-0 card-header border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                    @foreach (config('config_all.lang') as $k => $v)
                                        @php
                                            TableManipulation::AddFieldToTable('post', 'ten' . $k, 'string');
                                            TableManipulation::AddFieldToTable('post', 'tenkhongdau' . $k, 'string');
                                        @endphp
                                        <li class="nav-item">
                                            <a class="nav-link {{ $k == 'vi' ? 'active' : '' }}" id="tabs-lang"
                                                data-toggle="pill" href="#tabs-lang-{{ $k }}" role="tab"
                                                aria-controls="tabs-lang-{{ $k }}"
                                                aria-selected="true">{{ $v }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-body card-article">
                                <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                    @foreach (config('config_all.lang') as $k => $v)
                                        <div class="tab-pane fade show {{ $k == 'vi' ? 'active' : '' }}"
                                            id="tabs-lang-{{ $k }}" role="tabpanel"
                                            aria-labelledby="tabs-lang">
                                            <div class="form-group">
                                                <label for="ten{{ $k }}" class="inp">
                                                    <input type="text" class="form-control for-seo"
                                                        name="data[ten{{ $k }}]" id="ten{{ $k }}"
                                                        placeholder="&nbsp;"
                                                        value="{{ isset($rowItem['ten' . $k]) ? $rowItem['ten' . $k] : '' }}"
                                                        required>
                                                    <span class="label">Tiêu đề ({{ $k }}):</span>
                                                    <span class="focus-bg"></span>
                                                </label>
                                            </div>

                                            @if (isset($config[$type]['tensan']) && $config[$type]['tensan'] == true)
                                                <div class="form-group">
                                                    <label for="tensan{{ $k }}" class="inp">
                                                        <input type="text" class="form-control for-seo"
                                                            name="data[tensan{{ $k }}]"
                                                            id="tensan{{ $k }}" placeholder="&nbsp;"
                                                            value="{{ isset($rowItem['tensan' . $k]) ? $rowItem['tensan' . $k] : '' }}"
                                                            required>
                                                        <span class="label">Tên sàn ({{ $k }}):</span>
                                                        <span class="focus-bg"></span>
                                                    </label>
                                                </div>
                                            @endif

                                            @if (isset($config[$type]['chucvu']) && $config[$type]['chucvu'] == true)
                                                <div class="form-group">
                                                    <label for="chucvu{{ $k }}" class="inp">
                                                        <input type="text" class="form-control"
                                                            name="data[chucvu{{ $k }}]"
                                                            id="chucvu{{ $k }}" placeholder="&nbsp;"
                                                            value="{{ isset($rowItem['chucvu' . $k]) ? $rowItem['chucvu' . $k] : '' }}"
                                                            required>
                                                        <span class="label">Chức vụ ({{ $k }}):</span>
                                                        <span class="focus-bg"></span>
                                                    </label>
                                                </div>
                                            @endif

                                            @if (isset($config[$type]['diachi']) && $config[$type]['diachi'] == true)
                                                <div class="form-group">
                                                    <label for="giaidoan{{ $k }}" class="inp">
                                                        <input type="text" class="form-control for-seo"
                                                            name="data[giaidoan{{ $k }}]"
                                                            id="giaidoan{{ $k }}" placeholder="&nbsp;"
                                                            value="{{ isset($rowItem['giaidoan' . $k]) ? $rowItem['giaidoan' . $k] : '' }}"
                                                            required>
                                                        <span class="label">Địa chỉ ({{ $k }}):</span>
                                                        <span class="focus-bg"></span>
                                                    </label>
                                                </div>
                                            @endif

                                            @if (isset($config[$type]['solieu']) && $config[$type]['solieu'] == true)
                                                <div class="form-group">
                                                    <label for="giatri" class="inp">
                                                        <input type="text" class="form-control for-seo"
                                                            name="data[giatri]" id="giatri" placeholder="&nbsp;"
                                                            value="{{ isset($rowItem['giatri']) ? $rowItem['giatri'] : '' }}"
                                                            required>
                                                        <span class="label">Giá trị:</span>
                                                        <span class="focus-bg"></span>
                                                    </label>
                                                </div>
                                                <div class="form-group d-none">
                                                    <label for="donvi" class="inp">
                                                        <input type="text" class="form-control for-seo"
                                                            name="data[donvi]" id="donvi" placeholder="&nbsp;"
                                                            value="{{ isset($rowItem['donvi']) ? $rowItem['donvi'] : '' }}">
                                                        <span class="label">Đơn vị:</span>
                                                        <span class="focus-bg"></span>
                                                    </label>
                                                </div>
                                            @endif

                                            @if (isset($config[$type]['iframe']) && $config[$type]['iframe'] == true)
                                                <div class="form-group">
                                                    <label for="iframe" class="inp">
                                                        <textarea class="form-control for-seo" name="data[iframe]" id="iframe" rows="5" placeholder="&nbsp;">{{ isset($rowItem['iframe']) ? $rowItem['iframe'] : '' }}</textarea>
                                                        <span class="label">Iframe:</span>
                                                        <span class="focus-bg"></span>
                                                    </label>
                                                </div>
                                            @endif

                                            @if (isset($config[$type]['mota']) && $config[$type]['mota'] == true)
                                                <div class="form-group">
                                                    <label for="mota{{ $k }}" class="inp">
                                                        <textarea
                                                            class="form-control for-seo {{ isset($config[$type]['mota_cke']) && $config[$type]['mota_cke'] == true ? 'form-control-ckeditor' : '' }}"
                                                            name="data[mota{{ $k }}]" id="mota{{ $k }}" rows="8" placeholder="&nbsp;">{{ isset($rowItem['mota' . $k]) ? $rowItem['mota' . $k] : '' }}</textarea>
                                                        <span class="label">Mô tả ({{ $k }}):</span>
                                                        <span class="focus-bg"></span>
                                                    </label>
                                                </div>
                                            @endif

                                            @if (isset($config[$type]['add_description']) && $config[$type]['add_description'] == true)
                                                @php
                                                    $mota = json_decode($rowItem['mota' . $k], true);
                                                @endphp
                                                <p class="add_description">Thêm mô tả</p>
                                                <div id="load_add_des">
                                                    @if ($mota)
                                                        @foreach ($mota as $k => $v)
                                                            <div class="form-group-box">
                                                                <div class="form-group">
                                                                    <label for="tenvi" class="inp">
                                                                        <input type="text" class="form-control for-seo"
                                                                            name="data_tieudemota[]" id="tenvi"
                                                                            placeholder="&nbsp;"
                                                                            value="{{ $v['tieude'] }}"
                                                                            required=""><span class="label">Tiêu đề mô
                                                                            tả:</span>
                                                                        <span class="focus-bg"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="form-group form-group-des">
                                                                    <label for="mota" class="inp">
                                                                        <textarea class="form-control for-seo" name="data_mota[]" id="mota" rows="5" placeholder="&nbsp;">{{ $v['mota'] }}</textarea><span class="label">Mô
                                                                            tả :</span><span class="focus-bg"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="input-group-append filterproduct_remove">
                                                                    <div class="input-group-text"><strong>Xóa</strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            @endif

                                            @if (isset($config[$type]['noidung']) && $config[$type]['noidung'] == true)
                                                <div class="form-group">
                                                    <label for="noidung<?= $k ?>">Nội dung ({{ $k }}):</label>
                                                    <textarea class="form-control for-seo form-control-ckeditor" name="data[noidung{{ $k }}]"
                                                        id="noidung{{ $k }}" rows="5" placeholder="Nội dung ({{ $k }})">{{ isset($rowItem['noidung' . $k]) ? $rowItem['noidung' . $k] : '' }}</textarea>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        @if (isset($config[$type]['map']) && $config[$type]['map'] == true)
                            <div class="form-group">
                                <label for="dienthoai" class="inp">
                                    <input type="text" class="form-control" name="data[dienthoai]" id="dienthoai"
                                        placeholder="&nbsp;"
                                        value="{{ isset($rowItem['dienthoai']) ? $rowItem['dienthoai'] : '' }}" required>
                                    <span class="label">Điện thoại:</span>
                                    <span class="focus-bg"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <a class="mb-2 ml-1 text-sm font-weight-normal d-block" style="color:#26b99a"
                                    href="https://www.google.com/maps" target="_blank"
                                    title="Lấy mã nhúng google map"><b><i class="fas fa-map-marked-alt"></i> (Lấy mã
                                        nhúng)</b></a>
                                <label for="toado_iframe" class="inp">
                                    <textarea class="form-control for-seo" name="data[map]" id="toado_iframe" rows="5" placeholder="&nbsp;">{{ isset($rowItem['map']) ? $rowItem['map'] : '' }}</textarea>
                                    <span class="label">Tọa độ google map iframe</span>
                                    <span class="focus-bg"></span>
                                </label>
                            </div>
                        @endif

                    </div>
                </div>
            </div>


            <!-- Chart image -->
            {{-- @include('admin.layouts.chart_image') --}}

            <div class="col-xl-4">
                @if (isset($config[$type]['dropdown']) && $config[$type]['dropdown'] == true)
                    <div class="mb-3 form-group col-sm-12">
                        @include('admin.layouts.category')
                    </div>
                @endif

                @if (isset($config[$type]['tags']) && $config[$type]['tags'] == true)
                    <div class="text-sm card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Danh mục {{ $config[$type]['title_main'] }}</h3>
                        </div>
                        <div class="card-body">
                            @if (isset($config[$type]['tags']) && $config[$type]['tags'] == true)
                                <div class="form-group col-xl-6 col-sm-4">
                                    <label class="d-block" for="id_tags">{{ $config_tags[$type]['title_main'] }}
                                        :</label>
                                    {!! Helper::get_tags($rowItem['id'], 'post', $type) !!}
                                </div>
                            @endif
                        </div>
                    </div>
                @endif


                @if (isset($config[$type]['place']) && $config[$type]['place'] == true)
                    @php
                        $places['city'] = $rowItem['id_city'];
                        $places['district'] = $rowItem['id_district'];
                        $places['wards'] = $rowItem['id_wards'];
                        $places = (object) $places;
                    @endphp
                    <div class="text-sm card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Vị trí cửa hàng</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="input-cart">
                                {!! Helper::get_ajax_places('places', 'places', 'list', null, $places, 'required', 'Chọn tỉnh thành') !!}
                                <div class="invalid-feedback">Vui lòng chọn tỉnh thành</div>
                            </div>
                            <div class="input-cart">
                                {!! Helper::get_ajax_places('places', 'places', 'cat', null, $places, 'required', 'Chọn quận huyện') !!}
                                <div class="invalid-feedback">Vui lòng chọn quận huyện</div>
                            </div>
                            <div class="input-cart">
                                {!! Helper::get_ajax_places('places', 'places', 'item', null, $places, 'required', 'Chọn phường xã') !!}
                                <div class="invalid-feedback">Vui lòng chọn phường/xã</div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (isset($config[$type]['rating']) && $config[$type]['rating'] == true)
                    @php
                        $userrating = json_decode($rowItem['userrating'], true);
                    @endphp
                    <div class="text-sm card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin người đánh giá</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-user d-flex align-items-center">
                                <div class="mr-3 card-user-image">
                                    <span>Chọn hình<br>(100x100)</span>
                                    <div id="photoUpload-user"><img
                                            src="{{ isset($userrating['photo']) ? Helper::GetFolder($folder_upload, true) . $userrating['photo'] : '' }}"
                                            width="100%"></div>
                                    <label class="photoUpload-file" id="photo-user-zone" for="file-user-zone">
                                        <input type="file" name="dataUser[photo]" id="file-user-zone">
                                    </label>
                                </div>
                                <div class="card-user-info">
                                    <input type="text" name="dataUser[ten]" placeholder="Tên:"
                                        class="card-user-input" value="{{ $userrating ? $userrating['ten'] : '' }}">
                                    {{-- <input type="text" name="dataUser[chucvu]" placeholder="Chức vụ:" class="card-user-input" value="{{ ($userrating) ? $userrating['chucvu'] : '' }}"> --}}
                                    <input type="hidden" name="dataUser[star]" class="card-user-star"
                                        value="{{ $userrating ? $userrating['star'] : 0 }}">
                                    <div class='rating-stars'>
                                        <ul id='stars'>
                                            <li class='star {{ $userrating['star'] >= 1 ? 'selected' : '' }}'
                                                title='Poor' data-value='1'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star {{ $userrating['star'] >= 2 ? 'selected' : '' }}'
                                                title='Fair' data-value='2'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star {{ $userrating['star'] >= 3 ? 'selected' : '' }}'
                                                title='Good' data-value='3'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star {{ $userrating['star'] >= 4 ? 'selected' : '' }}'
                                                title='Excellent' data-value='4'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star {{ $userrating['star'] >= 5 ? 'selected' : '' }}'
                                                title='WOW!!!' data-value='5'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                @if (isset($config[$type]['link_website']) && $config[$type]['link_website'] == true)
                    <div class="text-sm card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Nút link website</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group d-none">
                                <label for="tieudenut" class="inp">
                                    <input type="text" class="form-control for-seo" name="data[tieudenut]"
                                        id="tieudenut" placeholder="&nbsp;"
                                        value="{{ isset($rowItem['tieudenut']) ? $rowItem['tieudenut'] : '' }}">
                                    <span class="label">Tiêu đề nút:</span>
                                    <span class="focus-bg"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="linklienket" class="inp">
                                    <input type="text" class="form-control for-seo" name="data[linklienket]"
                                        id="linklienket" placeholder="&nbsp;"
                                        value="{{ isset($rowItem['linklienket']) ? $rowItem['linklienket'] : '' }}">
                                    <span class="label">Link liên kết:</span>
                                    <span class="focus-bg"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endif

                @if (isset($config[$type]['link']) && $config[$type]['link'] == true)
                    <div class="text-sm card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Link</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="link" class="inp">
                                    <input type="text" class="form-control for-seo" name="data[link]" id="link"
                                        placeholder="&nbsp;"
                                        value="{{ isset($rowItem['link']) ? $rowItem['link'] : '' }}">
                                    <span class="label">Link:</span>
                                    <span class="focus-bg"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endif

                @if (isset($config[$type]['icon']) && $config[$type]['icon'] == true)
                    <div class="text-sm card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Icon đại diện</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="photoUpload-zone">
                                <div class="photoUpload-detail" id="photoUpload-preview2"><img class="rounded"
                                        src="{{ Helper::GetFolder($folder_upload, true) . $rowItem['icon'] }}"
                                        onerror=src="{{ asset('img/noimage1.png') }}" alt="Alt Photo" /></div>
                                <label class="photoUpload-file" id="photo-zone2" for="file-zone2">
                                    <input type="file" name="icon" id="file-zone2">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                                    <p class="photoUpload-or">hoặc</p>
                                    <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
                                </label>
                                <div class="photoUpload-dimension">
                                    {{ 'Width: ' . $config[$type]['width_icon'] * $config[$type]['ratio'] . ' px - Height: ' . $config[$type]['height_icon'] * $config[$type]['ratio'] . ' px (' . $config[$type]['img_type'] . ')' }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (isset($config[$type]['other_info']) && $config[$type]['other_info'] == true)
                    <div class="text-sm card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin khác</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="diadiem" class="inp">
                                    <input type="text" class="form-control for-seo" name="data[diadiem]"
                                        id="diadiem" placeholder="&nbsp;"
                                        value="{{ isset($rowItem['diadiem']) ? $rowItem['diadiem'] : '' }}">
                                    <span class="label">Địa điểm:</span>
                                    <span class="focus-bg"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="thoigian" class="inp">
                                    <input type="text" class="form-control for-seo" name="data[thoigian]"
                                        id="thoigian" placeholder="&nbsp;"
                                        value="{{ isset($rowItem['thoigian']) ? $rowItem['thoigian'] : '' }}">
                                    <span class="label">Thời gian:</span>
                                    <span class="focus-bg"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="p-0 card-header border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                @foreach (config('config_all.lang') as $k => $v)
                                    @php
                                        TableManipulation::AddFieldToTable('post', 'mucthoigian' . $k, 'string');
                                    @endphp
                                    <li class="nav-item">
                                        <a class="nav-link {{ $k == 'vi' ? 'active' : '' }}" id="tabs-other"
                                            data-toggle="pill" href="#tabs-other-{{ $k }}" role="tab"
                                            aria-controls="tabs-lang-{{ $k }}"
                                            aria-selected="true">{{ $v }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-body card-article">
                            <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                @foreach (config('config_all.lang') as $k => $v)
                                    <div class="tab-pane fade show {{ $k == 'vi' ? 'active' : '' }}"
                                        id="tabs-other-{{ $k }}" role="tabpanel" aria-labelledby="tabs-lang">
                                        <div class="form-group">
                                            <label for="mucthoigian{{ $k }}" class="inp">
                                                <input type="text" class="form-control for-seo"
                                                    name="data[mucthoigian{{ $k }}]"
                                                    id="mucthoigian{{ $k }}" placeholder="&nbsp;"
                                                    value="{{ isset($rowItem['mucthoigian' . $k]) ? $rowItem['mucthoigian' . $k] : '' }}">
                                                <span class="label">Mục thời gian ({{ $k }}):</span>
                                                <span class="focus-bg"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @if (isset($config[$type]['images']) && $config[$type]['images'] == true)
                    <div class="text-sm card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Hình đại diện</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (config('config_all.fileupload') == true)
                                @php
                                    $amount_images = $config[$type]['amount_images'];
                                    for ($i = 0; $i < $amount_images; $i++) {
                                        TableManipulation::AddFieldToTable('post', 'photo' . ($i > 0 ? $i : ''), 'string');
                                        TableManipulation::AddFieldToTable('post', 'idphoto' . ($i > 0 ? $i : ''));
                                    }
                                @endphp
                                @include('admin.layouts.devimage')

                                @if ($request->category == 'man')
                                    <div class="mt-2">
                                        <strong>{{ 'Width: ' . $config[$type]['width'] * $config[$type]['ratio'] . ' px - Height: ' . $config[$type]['height'] * $config[$type]['ratio'] . ' px (' . $config[$type]['img_type'] . ')' }}</strong>
                                    </div>
                                @else
                                    <div class="mt-2">
                                        <strong>{{ 'Width: ' . $config[$type]['width_' . $request->category] . ' px - Height: ' . $config[$type]['height_' . $request->category] . ' px (' . $config[$type]['img_type'] . ')' }}</strong>
                                    </div>
                                @endif
                                <input type="hidden" name="width" value="{{ $config[$type]['width'] }}" />
                                <input type="hidden" name="height" value="{{ $config[$type]['height'] }}" />
                            @else
                                @include('admin.layouts.image')
                            @endif
                        </div>
                    </div>
                @endif


                @if (isset($config[$type]['thongtin']) && $config[$type]['thongtin'] == true)
                    <div class="text-sm card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group col-md-12">
                                <label class="d-block" for="ruiro">Rủi ro (Risk):</label>
                                <div class="input-group">
                                    <input type="text" class="form-control ruiro" name="data[ruiro]" id="ruiro"
                                        placeholder="Rủi ro (risk)" value="{{ $rowItem['ruiro'] }}" maxlength="2">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><strong>/10</strong></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="d-block" for="khanangsinhloi">Khả năng sinh lời (Profitability):</label>
                                <div class="input-group">
                                    <input type="text" class="form-control khanangsinhloi" name="data[khanangsinhloi]"
                                        id="khanangsinhloi" placeholder="Khả năng sinh lời"
                                        value="{{ $rowItem['khanangsinhloi'] }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><strong>%</strong></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="d-block" for="hoahong">Hoa hồng (Commissions):</label>
                                <div class="input-group">
                                    <input type="text" class="form-control hoahong" name="data[hoahong]"
                                        id="hoahong" placeholder="Hoa hồng" value="{{ $rowItem['hoahong'] }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><strong>%</strong></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="d-block" for="donbay">Đòn bẩy (Everages):</label>
                                <div class="input-group">
                                    <input type="text" class="form-control donbay" name="data[donbay]" id="donbay"
                                        placeholder="Ex: 1:2000" value="{{ $rowItem['donbay'] }}">
                                    {{-- <div class="input-group-append">
                                        <div class="input-group-text"><strong>/10</strong></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- @if (isset($config[$type]['images']) && $config[$type]['images'] == true)
            <div class="text-sm card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Hình đại diện 2</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.layouts.image2')
                </div>
            </div>
            @endif --}}

                @if (isset($config[$type]['images_other']) && $config[$type]['images_other'] == true)
                    <div class="text-sm card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Hình ảnh khác</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 photoUpload-zone">
                                <div class="photoUpload-detail" id="photoUpload-other1"><img class="rounded"
                                        src="{{ Helper::GetFolder($folder_upload, true) . $rowItem['photo1'] }}"
                                        onerror=src="{{ asset('img/noimage1.png') }}" alt="Alt Photo" /></div>
                                <label class="photoUpload-file" id="photo-other1" for="file-other1">
                                    <input type="file" name="photo1" id="file-other1">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                                    <p class="photoUpload-or">hoặc</p>
                                    <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
                                </label>
                                <div class="form-group">
                                    <label for="hienthi1" class="mb-0 mr-2 align-middle d-inline-block">Hiển thị:</label>
                                    <div class="align-middle custom-control custom-checkbox d-inline-block">
                                        @if ($rowItem['hienthi1'] == 1 || !isset($rowItem))
                                            <input type="checkbox" class="custom-control-input hienthi-checkbox"
                                                name="data[hienthi1]" id="hienthi1-checkbox" checked>
                                        @else
                                            <input type="checkbox" class="custom-control-input hienthi-checkbox"
                                                name="data[hienthi1]" id="hienthi1-checkbox">
                                        @endif
                                        <label for="hienthi1-checkbox" class="custom-control-label"></label>
                                    </div>
                                </div>

                                <div class="photoUpload-dimension">
                                    {{ 'Width: 128px - Height: 120px (' . $config[$type]['img_type'] . ')' }}</div>
                            </div>

                            <div class="mb-3 photoUpload-zone">
                                <div class="photoUpload-detail" id="photoUpload-other2"><img class="rounded"
                                        src="{{ Helper::GetFolder($folder_upload, true) . $rowItem['photo2'] }}"
                                        onerror=src="{{ asset('img/noimage1.png') }}" alt="Alt Photo" /></div>
                                <label class="photoUpload-file" id="photo-other2" for="file-other2">
                                    <input type="file" name="photo2" id="file-other2">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                                    <p class="photoUpload-or">hoặc</p>
                                    <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
                                </label>
                                <div class="form-group">
                                    <label for="hienthi2" class="mb-0 mr-2 align-middle d-inline-block">Hiển thị:</label>
                                    <div class="align-middle custom-control custom-checkbox d-inline-block">
                                        @if ($rowItem['hienthi2'] == 1 || !isset($rowItem))
                                            <input type="checkbox" class="custom-control-input hienthi-checkbox"
                                                name="data[hienthi2]" id="hienthi2-checkbox" checked>
                                        @else
                                            <input type="checkbox" class="custom-control-input hienthi-checkbox"
                                                name="data[hienthi2]" id="hienthi2-checkbox">
                                        @endif
                                        <label for="hienthi2-checkbox" class="custom-control-label"></label>
                                    </div>
                                </div>

                                <div class="photoUpload-dimension">
                                    {{ 'Width: 250px - Height: 233px (' . $config[$type]['img_type'] . ')' }}</div>
                            </div>

                            <div class="photoUpload-zone">
                                <div class="photoUpload-detail" id="photoUpload-other3"><img class="rounded"
                                        src="{{ Helper::GetFolder($folder_upload, true) . $rowItem['photo3'] }}"
                                        onerror=src="{{ asset('img/noimage1.png') }}" alt="Alt Photo" /></div>
                                <label class="photoUpload-file" id="photo-other3" for="file-other3">
                                    <input type="file" name="photo3" id="file-other3">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                                    <p class="photoUpload-or">hoặc</p>
                                    <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
                                </label>
                                <div class="form-group">
                                    <label for="hienthi3" class="mb-0 mr-2 align-middle d-inline-block">Hiển thị:</label>
                                    <div class="align-middle custom-control custom-checkbox d-inline-block">
                                        @if ($rowItem['hienthi3'] == 1 || !isset($rowItem))
                                            <input type="checkbox" class="custom-control-input hienthi-checkbox"
                                                name="data[hienthi3]" id="hienthi3-checkbox" checked>
                                        @else
                                            <input type="checkbox" class="custom-control-input hienthi-checkbox"
                                                name="data[hienthi3]" id="hienthi3-checkbox">
                                        @endif
                                        <label for="hienthi3-checkbox" class="custom-control-label"></label>
                                    </div>
                                </div>
                                <div class="photoUpload-dimension">
                                    {{ 'Width: 280px - Height: 274px (' . $config[$type]['img_type'] . ')' }}</div>
                            </div>

                        </div>
                    </div>
                @endif

                @if (isset($config[$type]['postnew']) && $config[$type]['postnew'] == true)
                    <div class="text-sm card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Loại tin</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select name="data[loaitin]" class="form-control select-change-loaitin">
                                    <option value="0" {{ $rowItem['loaitin'] == 0 ? 'selected' : '' }}>Miễn phí
                                    </option>
                                    <option value="1" {{ $rowItem['loaitin'] == 1 ? 'selected' : '' }}>Trả phí
                                    </option>
                                    <option value="2" {{ $rowItem['loaitin'] == 2 ? 'selected' : '' }}>Trả phí theo
                                        tháng</option>
                                </select>
                            </div>

                            <div id="show-loaitin-fee" class="d-none">
                                <div class="form-group">
                                    <label for="luotxemgioihan" class="inp">
                                        <input type="text" class="form-control for-seo" name="data[luotxemgioihan]"
                                            id="luotxemgioihan" placeholder="&nbsp;"
                                            value="{{ isset($rowItem['luotxemgioihan']) ? $rowItem['luotxemgioihan'] : '' }}">
                                        <span class="label">Số vé xem (1 tài khoản là 1 vé):</span>
                                        <span class="focus-bg"></span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <select name="data[kieuxem]" class="form-control">
                                        <option value="0" {{ $rowItem['kieuxem'] == 0 ? 'selected' : '' }}>Xem trong
                                            24h</option>
                                        <option value="1" {{ $rowItem['kieuxem'] == 1 ? 'selected' : '' }}>Xem vĩnh
                                            viễn</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="soxuphaitra" class="inp">
                                        <input type="text" class="form-control for-seo" name="data[soxuphaitra]"
                                            id="soxuphaitra" placeholder="&nbsp;"
                                            value="{{ isset($rowItem['soxuphaitra']) ? $rowItem['soxuphaitra'] : '' }}">
                                        <span class="label">Số xu phải trả:</span>
                                        <span class="focus-bg"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                @if (isset($config[$type]['show_video']) && $config[$type]['show_video'] == true)
                    <div class="text-sm card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Video</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group d-none">
                                <label for="tenvideo" class="inp">
                                    <input type="text" class="form-control for-seo" name="data[tenvideo]"
                                        id="tenvideo" placeholder="&nbsp;"
                                        value="{{ isset($rowItem['tenvideo']) ? $rowItem['tenvideo'] : '' }}">
                                    <span class="label">Tiêu đề video:</span>
                                    <span class="focus-bg"></span>
                                </label>
                            </div>

                            <span
                                style="color: #666; font-style: italic; font-size: 12px; margin-bottom: 10px; display: block;"><strong>Link
                                    mẫu:</strong> https://www.youtube.com/watch?v=ID_video</span>
                            <div class="form-group">
                                <input type="text" class="form-control" name="data[video]" id="video"
                                    onchange="youtubePreview(this.value,'#loadVideo');" placeholder="Video"
                                    value="{{ $rowItem['video'] }}">
                            </div>
                            <div class="form-group">
                                <label for="link_video">Video preview:</label>
                                <div><iframe id="loadVideo" width="100%" height="0px" frameborder="0"
                                        allowfullscreen style="width:100%;height:250px;"></iframe></div>
                            </div>

                            {{-- <label>Poster:</label>
                            @include('admin.layouts.poster') --}}
                        </div>
                    </div>
                @endif

                @if (isset($config[$type]['seo']) && $config[$type]['seo'] == true)
                    <div class="text-sm card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Nội dung SEO</h3>
                            <a class="float-right text-white btn btn-sm bg-gradient-success d-inline-block create-seo"
                                title="Tạo SEO">Tạo SEO</a>
                        </div>
                        <div class="card-body">
                            @include('admin.layouts.seo')
                        </div>
                    </div>
                @endif

            </div>
        </div>

        @if (isset($config[$type]['gallery']))
            <div class="text-sm card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Bộ sưu tập {{ $config[$type]['title_main'] }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    @if (config('config_all.fileupload') == true)
                        @include('admin.layouts.gallery_multy')
                    @else
                        <div class="form-group" id="photo-upload-group">
                            <label for="filer-gallery" class="mb-3 label-filer-gallery">Album hình:
                                ({{ $config[$type]['img_type'] }})</label>
                            <input type="file" name="files[]" id="filer-gallery" multiple="multiple">
                            <input type="hidden" class="col-filer" value="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                            <input type="hidden" class="act-filer" name="level" value="man">
                            <input type="hidden" class="folder-filer" name="model" value="post">
                            <input type="hidden" class="folder-filer" name="type" value="{{ $type }}">
                            <input type="hidden" name="hash" value="{{ Helper::generateHash() }}" />
                        </div>
                        @if (isset($gallery) && count($gallery) > 0)
                            <div class="form-group form-group-gallery form-group-gallery-main">
                                {{-- <label class="label-filer">Album hiện tại:</label> --}}
                                <div class="mb-3 action-filer d-none">
                                    <a class="mr-1 text-white btn btn-sm bg-gradient-primary check-all-filer"><i
                                            class="mr-2 far fa-square"></i>Chọn tất cả</a>
                                    <button type="button"
                                        class="mr-1 text-white btn btn-sm bg-gradient-success sort-filer"><i
                                            class="mr-2 fas fa-random"></i>Sắp xếp</button>
                                    <a class="text-white btn btn-sm bg-gradient-danger delete-all-filer"><i
                                            class="mr-2 far fa-trash-alt"></i>Xóa tất cả</a>
                                </div>
                                <div
                                    class="text-sm text-white alert my-alert alert-sort-filer alert-info bg-gradient-info">
                                    <i class="mr-2 fas fa-info-circle"></i>Có thể chọn nhiều hình để di chuyển
                                </div>
                                <div class="jFiler-items my-jFiler-items jFiler-row">
                                    <ul class="jFiler-items-list jFiler-items-grid row scroll-bar" id="jFilerSortable">
                                        @foreach ($gallery as $v)
                                            {{ Helper::galleryFiler($v['stt'], $v['id'], $v['photo'], $v['tenvi'], 'post', 'col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6') }}
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        @endif

        {{-- Autosave --}}
        <input type="hidden" name="id" value="{{ isset($rowItem['id']) ? $rowItem['id'] : '' }}">
        <input type="hidden" name="type_main" value="{{ $type }}">
        <input type="hidden" name="table" value="post">
        <input type="hidden" name="model" class="autosave-btn" value="post">
        <input type="hidden" name="type" value="{{ $type }}" class="type-main">
    </form>
@endsection

@push('css')
    <style>
        /* Rating Star Widgets Style */
        .rating-stars ul {
            list-style-type: none;
            padding: 0;

            -moz-user-select: none;
            -webkit-user-select: none;
            cursor: pointer;
        }

        .rating-stars ul>li.star {
            display: inline-block;

        }

        /* Idle State of the stars */
        .rating-stars ul>li.star>i.fa {
            font-size: 1em;
            /* Change the size of the stars */
            color: #ccc;
            /* Color on idle state */
        }

        /* Hover state of the stars */
        .rating-stars ul>li.star.hover>i.fa {
            color: #FFCC36;
        }

        /* Selected state of the stars */
        .rating-stars ul>li.star.selected>i.fa {
            color: #FF912C;
        }
    </style>
@endpush


<!--js thêm cho mỗi trang-->
@push('js')
    <script>
        //Auto save after 15 minute
        AutoSave();

        $('.add_description').click(function() {

            var div_e =
                '<div class="form-group-box"><div class="form-group"><label for="tenvi" class="inp"><input type="text" class="form-control for-seo" name="data_tieudemota[]" id="tenvi" placeholder="&nbsp;" value="" required=""><span class="label">Tiêu đề mô tả:</span><span class="focus-bg"></span></label></div><div class="form-group form-group-des"><label for="mota" class="inp"><textarea class="form-control for-seo" name="data_mota[]" id="mota" rows="5" placeholder="&nbsp;"></textarea><span class="label">Mô tả :</span><span class="focus-bg"></span></label></div><div class="input-group-append filterproduct_remove"><div class="input-group-text"><strong>Xóa</strong></div></div></div>';

            $("#load_add_des").append(div_e);
        });


        $('body').on('click', '.filterproduct_remove', function() {
            $(this).parent('.form-group-box').remove();
        });


        $(window).on('load', function() {
            var val = $('#video').val();
            youtubePreview(val, '#loadVideo');

            $('.select-change-loaitin').trigger('change');
        });


        $('.select-change-loaitin').change(function() {
            var value = $(this).val();

            if (value == 1) {
                $('#show-loaitin-fee').removeClass('d-none').addClass('d-block');
            } else {
                $('#show-loaitin-fee').addClass('d-none').removeClass('d-block');
            }
        });


        //rating if exist
        $('#stars li').on('mouseover', function() {
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function(e) {
                if (e < onStar) {
                    $(this).addClass('hover');
                } else {
                    $(this).removeClass('hover');
                }
            });

        }).on('mouseout', function() {
            $(this).parent().children('li.star').each(function(e) {
                $(this).removeClass('hover');
            });
        });


        /* 2. Action to perform on click */
        $('#stars li').on('click', function() {
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            var msg = "";
            if (ratingValue > 1) {
                msg = ratingValue;
            } else {
                msg = ratingValue;
            }
            responseMessage(msg);

        });

        function responseMessage(msg) {
            $('.card-user-star').val(msg);
        }

        $(window).on('load', function() {
            var star_value = $('.card-user-star').val();
            $('#stars li').eq(star_value - 1).trigger('click');
        });
    </script>
@endpush
