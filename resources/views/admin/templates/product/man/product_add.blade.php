@extends('admin.master')

@section('content')


    <form class="validation-form autosave-form" novalidate method="post"
        action="{{ route('admin.product.save', ['man', $type]) }}" enctype="multipart/form-data">
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
                        href="{{ route('admin.product.show', ['man', $type]) }}" title="Thoát"><i
                            class="mr-2 fas fa-sign-out-alt"></i>Thoát</a>
                    @if ($numberOption > 0)
                        <a class="btn btn-sm bg-gradient-info btn-none-css"
                            href="{{ route('admin.productOption.show', ['man', $type, 'id_product' => $rowItem['id']]) }}"
                            title="Thoát"><i class="text-sm nav-icon fas fa-layer-group" target="_blank"></i> Xem phiên
                            bản</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8">
                @if (isset($config[$type]['slug']) && $config[$type]['slug'] == true)
                    @include('admin.layouts.slug')
                @endif

                <div class="text-sm card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Thông tin {{ $config[$type]['title_main'] }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="p-0 card-header border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                    @foreach (config('config_all.lang') as $k => $v)
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
                                            id="tabs-lang-{{ $k }}" role="tabpanel" aria-labelledby="tabs-lang">
                                            <div class="form-group">
                                                <label for="ten{{ $k }}" class="inp">
                                                    <input type="text" class="form-control for-seo"
                                                        name="data[ten{{ $k }}]" id="ten{{ $k }}"
                                                        placeholder="&nbsp;"
                                                        value="{{ isset($rowItem['ten' . $k]) ? $rowItem['ten' . $k] : '' }}"
                                                        required>
                                                    <span class="label">Tiêu đề ({{ $k }}):</span>
                                                    {{-- <span class="focus-bg"></span>
												<p class="mt-2 mb-0 alert-masp text-danger d-none" id="alert-ten{{$k}}-danger">
					                                <i class="mr-1 fas fa-exclamation-triangle"></i>
					                                <span>Tên sản phẩm đã tồn tại.</span>
					                            </p>
					                            <p class="mt-2 mb-0 alert-masp text-success d-none" id="alert-ten{{$k}}-success">
					                                <i class="mr-1 fas fa-check-circle"></i>
					                                <span>Tên sản phẩm hợp lệ.</span>
					                            </p> --}}
                                                </label>
                                            </div>

                                            @if (isset($config[$type]['mota']) && $config[$type]['mota'] == true)
                                                <div class="form-group">
                                                    <label for="mota{{ $k }}" class="inp">
                                                        <textarea
                                                            class="form-control for-seo {{ isset($config[$type]['mota_cke']) && $config[$type]['mota_cke'] == true ? 'form-control-ckeditor' : '' }}"
                                                            name="data[mota{{ $k }}]" id="mota{{ $k }}" rows="5" placeholder="&nbsp;">{{ isset($rowItem['mota' . $k]) ? $rowItem['mota' . $k] : '' }}</textarea>
                                                        <span class="label">Mô tả ngắn ({{ $k }}):</span>
                                                        <span class="focus-bg"></span>
                                                    </label>
                                                </div>
                                            @endif

                                            @if (isset($config[$type]['motangan']) && $config[$type]['motangan'] == true)
                                                <div class="form-group">
                                                    <label for="motangan{{ $k }}">Mô tả chi tiết
                                                        ({{ $k }})
                                                        :</label>
                                                    <textarea
                                                        class="form-control for-seo {{ isset($config[$type]['motangan_cke']) && $config[$type]['motangan_cke'] == true ? 'form-control-ckeditor' : '' }}"
                                                        name="data[motangan{{ $k }}]" id="motangan{{ $k }}" rows="5" placeholder="">{{ isset($rowItem['motangan' . $k]) ? $rowItem['motangan' . $k] : '' }}</textarea>
                                                </div>
                                            @endif

                                            @if (isset($config[$type]['noidung']) && $config[$type]['noidung'] == true)
                                                <div class="form-group">
                                                    <label for="noidung{{ $k }}">Thông tin chi tiết
                                                        ({{ $k }}):</label>
                                                    <textarea class="form-control for-seo form-control-ckeditor" name="data[noidung{{ $k }}]"
                                                        id="noidung{{ $k }}" rows="5" placeholder="Nội dung ({{ $k }})">{{ isset($rowItem['noidung' . $k]) ? $rowItem['noidung' . $k] : '' }}</textarea>
                                                </div>

                                                {{-- <div class="form-group">
											@php
												$options['options'.$k] = json_decode($rowItem['options'.$k],true);
												//$options_en = json_decode($rowItem['optionsen'],true);
												//dd($options);
											@endphp
                                            <label for="noidung{{$k}}">Chi tiết sản phẩm ({{$k}}):</label>
											@for ($i = 0; $i < 10; $i++)
											<div class="row">
												<div class="mb-4 form-group col-md-6 col-sm-6">
													<label for="tieude{{($i+1)}}" class="inp">
														<input type="text" class="form-control for-seo" name="data[options{{$k}}][tieude][]" id="tieude{{($i+1)}}" placeholder="&nbsp;" value="{{ (isset($options['options'.$k]['tieude'][$i])) ? $options['options'.$k]['tieude'][$i] : '' }}">
														<span class="label">Tiêu đề {{($i+1)}} ({{$k}})</span>
													</label>
												</div>
												<div class="mb-4 form-group col-md-6 col-sm-6">
													<label for="giatri{{($i+1)}}" class="inp">
														<input type="text" class="form-control for-seo" name="data[options{{$k}}][giatri][]" id="giatri{{($i+1)}}" placeholder="&nbsp;" value="{{ (isset($options['options'.$k]['giatri'][$i])) ? $options['options'.$k]['giatri'][$i] : '' }}">
														<span class="label">Giá trị {{($i+1)}} ({{$k}})</span>
													</label>
												</div>
											</div>
											@endfor											
                                        </div> --}}
                                            @endif



                                            @if (isset($config[$type]['thongso']) && $config[$type]['thongso'] == true)
                                                <div class="form-group">
                                                    <label for="thongso{{ $k }}">Thông số kỹ thuật
                                                        ({{ $k }}):</label>
                                                    <textarea class="form-control for-seo form-control-ckeditor" name="data[thongso{{ $k }}]"
                                                        id="thongso{{ $k }}" rows="5" placeholder="Thông số kỹ thuật ({{ $k }})">{{ isset($rowItem['thongso' . $k]) ? $rowItem['thongso' . $k] : '' }}</textarea>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="text-sm card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Thông tin {{ $config[$type]['title_main'] }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body card-article">
                        <div class="form-group">
                            <label for="hienthi" class="mb-0 mr-2 align-middle d-inline-block">Hiển thị:</label>
                            <div class="align-middle custom-control custom-checkbox d-inline-block">
                                <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]"
                                    id="hienthi-checkbox"
                                    {{ !isset($rowItem['hienthi']) || $rowItem['hienthi'] == 1 ? 'checked' : '' }}>
                                <label for="hienthi-checkbox" class="custom-control-label"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="stt" class="mb-0 mr-2 align-middle d-inline-block">Số thứ tự:</label>
                            <input type="number" class="align-middle form-control form-control-mini d-inline-block"
                                min="0" name="data[stt]" id="stt" placeholder="Số thứ tự"
                                value="{{ isset($rowItem['stt']) ? $rowItem['stt'] : 1 }}">
                        </div>
                        <div class="row">
                            @if (isset($config[$type]['ma']) && $config[$type]['ma'] == true)
                                <div class="form-group col-md-4 d-none">
                                    <label class="d-block" for="masp">Mã khóa học(của hãng):</label>
                                    <input type="text" class="form-control" name="data[masp_brand]" id="masp_brand"
                                        placeholder="Mã sản phẩm" value="{{ $rowItem['masp_brand'] }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="d-block" for="masp">Mã sản phẩm:</label>
                                    <input type="text" class="form-control " name="data[masp]" id="masp"
                                        placeholder="Mã sản phẩm" value="{{ $rowItem['masp'] }}">
                                    <p class="mt-2 mb-0 alert-masp text-danger d-none" id="alert-masp-danger">
                                        <i class="mr-1 fas fa-exclamation-triangle"></i>
                                        <span>Mã sản phẩm đã tồn tại.</span>
                                    </p>
                                    <p class="mt-2 mb-0 alert-masp text-success d-none" id="alert-masp-success">
                                        <i class="mr-1 fas fa-check-circle"></i>
                                        <span>Mã sản phẩm hợp lệ.</span>
                                    </p>
                                </div>
                            @endif

                            <div class="form-group col-md-4 d-none">
                                <label class="d-block" for="giamoi">Kích thước đóng gói(cm):</label>
                                <div class="input-group">
                                    <input type="text" class="form-control format-price dai" name="data[dai]"
                                        id="dai" placeholder="Chiều dài" value="{{ $rowItem['dai'] }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><strong>x</strong></div>
                                    </div>
                                    <input type="text" class="form-control format-price rong" name="data[rong]"
                                        id="rong" placeholder="Chiều rộng" value="{{ $rowItem['rong'] }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><strong>x</strong></div>
                                    </div>
                                    <input type="text" class="form-control format-price cao" name="data[cao]"
                                        id="cao" placeholder="Chiều cao" value="{{ $rowItem['cao'] }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><strong>/4000</strong></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4 d-none">
                                <label class="d-block" for="giamoi">Khối lượng:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="data[khoiluong]" id="khoiluong"
                                        placeholder="Khối lượng" value="{{ $rowItem['khoiluong'] }}">
                                    {{-- <div class="input-group-append">
									<div class="input-group-text"><strong>Gram</strong></div>
								</div> --}}
                                </div>
                            </div>

                            @if (isset($config[$type]['giatext']) && $config[$type]['giatext'] == true)
                                <div class="form-group col-md-4">
                                    <label class="d-block" for="giatext">Giá:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control format-price" name="data[giatext]"
                                            id="giatext" placeholder="Giá" value="{{ $rowItem['giatext'] }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text"><strong>VNĐ</strong></div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (isset($config[$type]['giacu']) && $config[$type]['giacu'] == true)
                                <div class="form-group col-md-4">
                                    <label class="d-block" for="giacu">Giá cũ:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control format-price gia_cu" name="data[giacu]"
                                            id="giacu" placeholder="Giá cũ" value="{{ $rowItem['giacu'] }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text"><strong>VNĐ</strong></div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (isset($config[$type]['gia']) && $config[$type]['gia'] == true)
                                <div class="form-group col-md-4">
                                    <label class="d-block" for="gia">Giá mặc định:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control format-price gia_ban" name="data[gia]"
                                            id="gia" placeholder="Giá mặc định" value="{{ $rowItem['gia'] }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text"><strong>VNĐ</strong></div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (isset($config[$type]['giamoi']) && $config[$type]['giamoi'] == true)
                                <div class="form-group col-md-4">
                                    <label class="d-block" for="giamoi">Giá mới:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control format-price gia_moi"
                                            name="data[giamoi]" id="giamoi" placeholder="Giá mới"
                                            value="{{ $rowItem['giamoi'] }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text"><strong>VNĐ</strong></div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (isset($config[$type]['giakm']) && $config[$type]['giakm'] == true)
                                <div class="form-group col-md-4">
                                    <label class="d-block" for="giakm">Chiết khấu:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control gia_km" name="data[giakm]"
                                            id="giakm" placeholder="Chiết khấu" value="{{ $rowItem['giakm'] }}"
                                            maxlength="3" readonly>
                                        <div class="input-group-append">
                                            <div class="input-group-text"><strong>%</strong></div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (config('config_all.order.soluong'))
                                <div class="form-group col-md-4">
                                    <label class="d-block" for="soluong_website">Số lượng:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control format-price gia_ban"
                                            name="data[soluong_website]" id="soluong_website" placeholder="Số lượng"
                                            value="{{ $rowItem['soluong_website'] }}">
                                    </div>
                                </div>
                            @endif

                            {{-- <div class="form-group col-md-4">
							<label class="d-block" for="xuatxu">Nhà sản xuất:</label>
							<input type="text" class="form-control" name="data[xuatxu]" id="xuatxu" placeholder="Nhà sản xuất" value="{{$rowItem['xuatxu']}}">
						</div>						 --}}

                        </div>
                    </div>
                </div>

                @if (isset($config[$type]['star']) && $config[$type]['star'] == true)
                    <div class="text-sm card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Số sao đánh giá (<i style="color: #F0983E;" class="fas fa-star"></i><i
                                    style="color: #F0983E;" class="fas fa-star"></i><i style="color: #F0983E;"
                                    class="fas fa-star"></i><i style="color: #F0983E;" class="fas fa-star"></i><i
                                    style="color: #F0983E;" class="fas fa-star"></i>)</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body card-article">
                            <div class="form-group col-md-4">
                                {{-- <label class="d-block" for="sosao">Số sao</label> --}}
                                <div class="input-group">
                                    <input type="number" class="form-control" name="data[sosao]" id="sosao"
                                        placeholder="Số sao" value="{{ $rowItem['sosao'] }}" min="0"
                                        max="5">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><strong><i class="fas fa-star"></i></strong></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
            <div class="col-xl-4">
                @if (isset($config[$type]['dropdown']) && $config[$type]['dropdown'] == true)
                    <div class="p-0 mb-0 form-group col-sm-12">
                        @include('admin.layouts.category')
                    </div>

                    @if (isset($config[$type]['brand']) && $config[$type]['brand'] == true)
                        <div class="text-sm card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Danh mục hãng</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i></button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-group col-xl-12 col-sm-12">
                                    {!! Helper::get_brand($rowItem['id'], 'product', $type) !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (isset($config[$type]['tags']) && $config[$type]['tags'] == true)
                        <div class="text-sm card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">{{ $config_tags[$type]['title_main'] }}</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i></button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-group col-xl-12 col-sm-12">
                                    {!! Helper::get_tags($rowItem['id'], 'product', $type) !!}
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

                @if (config('config_all.order.soluong'))
                    {{-- <div class="text-sm card card-primary card-outline">
				<div class="card-header">
					<h3 class="card-title">Thông tin số lượng sản phẩm</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
					</div>
				</div>
				<div class="card-body">
					<div class="form-group col-md-12">
						@if ($rowItem)
							<div class="form-group">
								<div class="mr-3 custom-control custom-radio d-inline-block text-md">
									<input class="custom-control-input mailertype" type="radio" id="soluong_add" name="soluong_type" value="0" checked>
									<label for="soluong_add" class="custom-control-label font-weight-normal">Thêm</label>
								</div>
								<div class="mr-3 custom-control custom-radio d-inline-block text-md">
									<input class="custom-control-input mailertype" type="radio" id="soluong_minus" name="soluong_type" value="1">
									<label for="soluong_minus" class="custom-control-label font-weight-normal">Giảm</label>
								</div>
							</div>

							<div class="form-group">
	                            <label for="soluong" class="inp">
	                            	<input type="hidden" name="soluong_now" value="{{$rowItem['soluong']}}">
	                                <input type="text" class="form-control" name="soluong" id="soluong" value="{{$rowItem['soluong']}}">
	                                <span class="label">Số lượng hiện tại (<span id="soluong_span">{{$rowItem['soluong']}}</span>)</span>
	                                <span class="focus-bg"></span>
		                        </label>
	                        </div>
	                        <p class="mt-2 mb-2 alert-soluong text-danger d-none" id="alert-soluong-danger">
								<i class="mr-1 fas fa-exclamation-triangle"></i>
								<span>Số lượng ko hợp lệ</span>
							</p>	
							<p class="mt-2 mb-2 alert-soluong text-success d-none" id="alert-soluong-success">
								<i class="mr-1 fas fa-exclamation-triangle"></i>
								<span>Xác nhận thành công</span>
							</p>						
	                        <p class="soluong_submit">Xác nhận</p>
                        @else
                        	<div class="form-group">
								<label class="d-block" for="soluong">Số lượng khởi tạo:</label>
								<div class="input-group">
									<input type="text" class="form-control" name="data[soluong]" id="soluong" placeholder="" value="{{$rowItem['soluong']}}" value="0">									
								</div>
							</div>
                        @endif
					</div>
				</div>
			</div> --}}
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
                            @include('admin.layouts.image')
                        </div>
                    </div>

                    {{-- <div class="text-sm card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Hình nền sản phẩm</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.layouts.image2')
                </div>
            </div> --}}
                @endif


                @if (isset($config[$type]['images2']) && $config[$type]['images2'] == true)
                    <div class="text-sm card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Hình đại diện 2</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <x-image :photo="$rowItem['photo2']" :item="'photo2'" :folder="$folder_upload" :width="$config[$type]['width']"
                                :height="$config[$type]['height']" :extension="$config[$type]['img_type']" :ratio="$config[$type]['ratio']" name="photo2" />
                        </div>
                    </div>
                @endif


                @if (isset($config[$type]['banner']) && $config[$type]['banner'] == true)
                    <div class="text-sm card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Banner {{ $config[$type]['title_main'] }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <x-image :photo="$rowItem['banner']" :item="'banner'" :folder="$folder_upload" :width="$config[$type]['width_banner']"
                                :height="$config[$type]['height_banner']" :extension="$config[$type]['img_type']" :ratio="$config[$type]['ratio']" name="banner" />
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
                            {{-- <div class="form-group">
                        <label for="url_video" class="inp">
                            <input type="text" class="form-control for-seo" name="data[url_video]" id="url_video" placeholder="&nbsp;" value="{{ (isset($rowItem['url_video']))?$rowItem['url_video']:'' }}">
                            <span class="label">Tiêu đề video:</span>
                            <span class="focus-bg"></span>
                        </label>
                    </div> --}}

                            <span
                                style="color: #666; font-style: italic; font-size: 12px; margin-bottom: 10px; display: block;"><strong>Link
                                    mẫu:</strong> https://www.youtube.com/watch?v=ID_video</span>
                            <div class="form-group">
                                <input type="text" class="form-control" name="data[url_video]" id="video"
                                    onchange="youtubePreview(this.value,'#loadVideo');" placeholder="Video"
                                    value="{{ $rowItem['url_video'] }}">
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


        @if (
            (isset($config[$type]['mau']) && $config[$type]['mau'] == true) ||
                (isset($config[$type]['size']) && $config[$type]['size'] == true))
            <div class="text-sm card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Danh mục thuộc tính</h3>
                </div>
                <div class="card-body">
                    <div class="form-group-category row">
                        @if (isset($config[$type]['mau']) && $config[$type]['mau'] == true)
                            <div class="form-group col-xl-3 col-sm-4">
                                <label class="d-block" for="id_mau">Chọn danh mục màu sắc hoặc <span
                                        class="btn-add-property" data-typeProp="color" data-type="{{ $type }}"
                                        data-toggle="modal" data-target="#modal_property_color"
                                        data-showElement="#show_addColor">Thêm màu mới </span></label>
                                <div id="show-select-color">{!! Helper::get_color($rowItem['id'], 'product', $type) !!}</div>
                            </div>
                        @endif
                        @if (isset($config[$type]['size']) && $config[$type]['size'] == true)
                            <div class="form-group col-xl-3 col-sm-4">
                                <label class="d-block" for="id_size">Chọn loại lớp học
                                    {{-- <span
                                        class="btn-add-property" data-typeProp="size" data-type="{{ $type }}"
                                        data-toggle="modal" data-target="#modal_property_size"
                                        data-showElement="#show_addSize">Thêm lớp mới </span> --}}
                                </label>
                                <div id="show-select-size">{!! Helper::get_size($rowItem['id'], 'product', $type) !!}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>


            {{-- show phiên bản con --}}
            <p class="loading-version" style="text-align: center;">
                <img src="{{ asset('img/admin/loader.gif') }}" width="50%">
            </p>
            <div id="show_product_children"></div>
        @endif

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
                                ({{ $config[$type]['gallery'][$type]['img_type_photo'] }})</label>
                            <input type="file" name="files[]" id="filer-gallery" multiple="multiple">
                            <input type="hidden" class="col-filer" value="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                            <input type="hidden" class="act-filer" name="level" value="man">
                            <input type="hidden" class="folder-filer" name="model" value="product">
                            <input type="hidden" class="folder-filer" name="type" value="{{ $type }}"
                                id="filer-type-main">
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
                                            {{ Helper::galleryFiler($v['stt'], $v['id'], $v['photo'], $v['tenvi'], 'product', 'col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6') }}
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
        <input type="hidden" name="table" value="product">
        <input type="hidden" name="model" class="autosave-btn" value="product">
        <input type="hidden" name="type" value="{{ $type }}" class="type-main">
    </form>

    {{-- Show nội dung layout thêm size - color --}}
    @include('admin.layouts.add_property')

@endsection


<!--js thêm cho mỗi trang-->
@section('js_page')
    <script>
        AutoSave();

        $(".format-unit").priceFormat({
            limit: 99,
            prefix: '',
            centsLimit: 0
        });

        $('#sosao').keyup(function() {
            var value = $(this).val();

            if (value > 5) {
                $('#sosao').val(5);
            }
        });

        $(window).on('load', function() {
            setTimeout(function() {
                LoadProductChildren();
            }, 500);
            //LoadProductChildren();
        });


        // $(window).on('load', function () {
        //     var val = $('#video').val();
        //     youtubePreview(val,'#loadVideo');

        //     $('.select-change-loaitin').trigger('change');
        // });


        function LoadProductChildren() {
            var id_product = {{ isset($rowItem['id']) ? $rowItem['id'] : 0 }}
            var mau_group = $('#mau_group').val();
            var size_group = $('#size_group').val();
            var type = $('input[name="type"]').val(); //$('#filer-type-main').val();
            var proname = $('#tenvi').val();
            var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu

            $.ajax({
                url: "{{ route('admin.ajax.properties') }}",
                type: 'POST',
                dataType: 'html',
                async: false,
                data: {
                    id_product: id_product,
                    mau_group: mau_group,
                    size_group: size_group,
                    type: type,
                    proname: proname,
                    _token: _token
                },
                success: function(result) {
                    $('#show_product_children').html(result);

                    /* Load photozone option */
                    photoZoneOption();

                    /* Check masp option*/
                    //checkMaSPoption();

                    /* Format price */
                    $(".format-price").priceFormat({
                        limit: 13,
                        prefix: '',
                        centsLimit: 0
                    });
                    $('.submit-check-option').click(function(event) {
                        var op = $(this).attr('data-position');
                        var group = $(this).attr('data-groupPos');
                        /* Check masp */
                        infoProCheck("masp_option_" + group + '_' + op,
                            true); //tham số đầu vào là tên id của div
                        var elementMasp = $('#alert-masp_option_' + group + '_' + op +
                            '-danger:not(.d-none)');
                        if (elementMasp.length) {
                            //holdonClose();
                            //return false;
                        }
                        checkMaSPoption();
                    });

                    $(".dai_option, .rong_option, .cao_option").keyup(function() {
                        var position = $(this).attr('data-position');
                        var group = $(this).attr('data-groupPos');
                        var dai = $('#dai_option_' + group + '_' + position).val();
                        var rong = $('#rong_option_' + group + '_' + position).val();
                        var cao = $('#cao_option_' + group + '_' + position).val();
                        var weight = 0;

                        if (dai == '0' || rong == '0' || cao == '0') {
                            weight = 0;
                        } else {
                            dai = dai.replace(/,/g, "");
                            rong = rong.replace(/,/g, "");
                            cao = cao.replace(/,/g, "");
                            dai = parseInt(dai);
                            rong = parseInt(rong);
                            cao = parseInt(cao);

                            weight = (dai * rong * cao) / 4000;
                            weight = weight * 1000;
                        }
                        $('#khoiluong_option_' + group + '_' + position).val(weight);
                        $(".format-price").priceFormat({
                            limit: 13,
                            prefix: '',
                            centsLimit: 0
                        });
                    })

                    $('.loading-version').addClass('d-none');
                }
            });
        }

        $('body').on('click', '.delete-option', function() {
            var op = $(this).attr('data-op');
            var id = $(this).attr('data-id');
            var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu

            $('#hidden_xoatam_option_' + op).val(1);
            $('#masp_option_' + op).val(Date.now());
            $('.dev-options-item-' + op).addClass('dev-option-none');

            $.ajax({
                url: "{{ route('admin.ajax.deleteOption') }}",
                type: 'POST',
                dataType: 'html',
                async: false,
                data: {
                    id: id,
                    _token: _token
                },
                success: function(result) {}
            });
        });

        $(document).ready(function() {
            $('.soluong_submit').click(function() {
                var id = $('input[name="id"]').val();
                var table = $('input[name="table"]').val();
                var soluong_type = $('input[name="soluong_type"]:checked').val();
                var soluong_now = $('input[name="soluong_now"]').val();
                var soluong_input = $('input[name="soluong"]').val();
                var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu


                if (soluong_type == 1 && (soluong_input - soluong_now) > 0) {
                    //console.log(soluong_input+'-'+soluong_now);			
                    $('#alert-soluong-danger').removeClass('d-none');
                    $('#alert-soluong-danger').addClass('d-block');
                    return false;
                } else {
                    $('#alert-soluong-danger').addClass('d-none');
                    $('#alert-soluong-danger').removeClass('d-block');

                    $.ajax({
                        url: "{{ route('admin.ajax.changeSoluong') }}",
                        type: 'POST',
                        dataType: 'json',
                        async: false,
                        data: {
                            id: id,
                            table: table,
                            soluong_type: soluong_type,
                            soluong_now: soluong_now,
                            soluong_input: soluong_input,
                            _token: _token
                        },
                        success: function(result) {
                            if (result.success == 1) {
                                //console.log('xác nhận thành công');
                                $('#alert-soluong-success').removeClass('d-none');
                                $('#alert-soluong-success').addClass('d-block');
                                $('#soluong_span').text(result.soluong_now);
                                $('input[name="soluong"]').val(result.soluong_now);
                                $('input[name="soluong_now"]').val(result.soluong_now);
                            }
                        }
                    });
                }
            });
        });
    </script>

    @if (isset($config[$type]['giakm']) && $config[$type]['giakm'] == true)
        <script type="text/javascript">
            function roundNumber(rnum, rlength) {
                return Math.round(rnum * Math.pow(10, rlength)) / Math.pow(10, rlength);
            }
            $(document).ready(function() {
                $(".gia_ban, .gia_moi").keyup(function() {

                    var gia_cu = $('.gia_ban').val();
                    var gia_ban = $('.gia_moi').val();
                    var gia_km = 0;

                    if (gia_cu == '' || gia_cu == '0' || gia_ban == '' || gia_ban == '0') {
                        gia_km = 0;
                    } else {
                        gia_cu = gia_cu.replace(/,/g, "");
                        gia_ban = gia_ban.replace(/,/g, "");
                        gia_cu = parseInt(gia_cu);
                        gia_ban = parseInt(gia_ban);

                        if (gia_ban < gia_cu) {
                            gia_km = 100 - ((gia_ban * 100) / gia_cu);
                            gia_km = roundNumber(gia_km, 0);
                        } else {
                            gia_km = 0;
                        }
                    }
                    console.log(gia_ban);
                    $('.gia_km').val(gia_km);
                })

                $(".gia_cu_op, .gia_ban_op").keyup(function() {
                    var position = $(this).attr('data-position');
                    var group = $(this).attr('data-groupPos');
                    var gia_cu = $('.gia_ban_' + group + '_' + position).val();
                    var gia_ban = $('.gia_moi_' + group + '_' + position).val();
                    var gia_km = 0;

                    if (gia_cu == '' || gia_cu == '0' || gia_ban == '' || gia_ban == '0') {
                        gia_km = 0;
                    } else {
                        gia_cu = gia_cu.replace(/,/g, "");
                        gia_ban = gia_ban.replace(/,/g, "");
                        gia_cu = parseInt(gia_cu);
                        gia_ban = parseInt(gia_ban);

                        if (gia_ban < gia_cu) {
                            gia_km = 100 - ((gia_ban * 100) / gia_cu);
                            gia_km = roundNumber(gia_km, 0);
                        } else {
                            gia_km = 0;
                        }
                    }
                    $('.gia_km_' + group + '_' + position).val(gia_km);
                })

                $(".dai, .rong, .cao").keyup(function() {
                    var dai = $('.dai').val();
                    var rong = $('.rong').val();
                    var cao = $('.cao').val();
                    var weight = 0;

                    if (dai == '0' || rong == '0' || cao == '0') {
                        weight = 0;
                    } else {
                        dai = dai.replace(/,/g, "");
                        rong = rong.replace(/,/g, "");
                        cao = cao.replace(/,/g, "");
                        dai = parseInt(dai);
                        rong = parseInt(rong);
                        cao = parseInt(cao);

                        weight = (dai * rong * cao) / 4000;
                        weight = weight * 1000;
                    }
                    $('#khoiluong').val(weight);
                    $(".format-price").priceFormat({
                        limit: 13,
                        prefix: '',
                        centsLimit: 0
                    });
                })
            })
        </script>
    @endif
@endsection
