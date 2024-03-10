@extends('admin.master')

@section('content')
@php
    $user = $rowItem['belong_user'];
@endphp
<form class="validation-form" novalidate method="post" action="{{route('admin.contact.save',['man',$type])}}" enctype="multipart/form-data">
	@csrf
    <div class="text-sm card-footer sticky-top">
        <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="mr-2 far fa-save"></i>Lưu</button>
        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="mr-2 fas fa-redo"></i>Làm lại</button>
        <a class="btn btn-sm bg-gradient-danger" href="{{route('admin.contact.show',['man',$type])}}" title="Thoát"><i class="mr-2 fas fa-sign-out-alt"></i>Thoát</a>
    </div>
    <div class="text-sm card card-primary card-outline">
		<div class="card-header">
            <h3 class="card-title">Chi tiết {{$config[$type]['title_main']}}</h3>
        </div>
        <div class="card-body">
            <div class="form-group-category row">
                @if(isset($config[$type]['ten']) && $config[$type]['ten'] == true)
                    @if($user)
                    <div class="form-group col-md-4">
                        <label for="ten">Họ tên:</label>
                        <input type="text" class="form-control" id="ten" placeholder="Họ tên" value="{{$user['name']}}" readonly="">
                    </div>
                    @else
                    <div class="form-group col-md-4">
                        <label for="ten">Họ tên:</label>
                        <input type="text" class="form-control" name="data[tenvi]" id="ten" placeholder="Họ tên" value="{{$rowItem['tenvi']}}">
                    </div>
                    @endif
                @endif

                @if(isset($config[$type]['dienthoai']) && $config[$type]['dienthoai'] == true)
                    @if($user)
                    <div class="form-group col-md-4">
                        <label for="ten">Họ tên:</label>
                        <input type="text" class="form-control" id="dienthoai" placeholder="Điện thoại" value="{{$user['phonenumber']}}" readonly="">
                    </div>
                    @else
                    <div class="form-group col-md-4">
                        <label for="dienthoai">Điện thoại:</label>
                        <input type="text" class="form-control" name="data[dienthoai]" id="dienthoai" placeholder="Điện thoại" value="{{$rowItem['dienthoai']}}">
                    </div>
                    @endif
                @endif

                @if(isset($config[$type]['email']) && $config[$type]['email'] == true)
                    @if($user)
                    <div class="form-group col-md-4">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" value="{{$user['email']}}" readonly="">
                    </div>
                    @else
                    <div class="form-group col-md-4">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="data[email]" id="email" placeholder="Email" value="{{$rowItem['email']}}">
                    </div>
                    @endif
                @endif

                @if(isset($config[$type]['link']) && $config[$type]['link'] == true)
                    <div class="form-group col-md-4">
                        <label for="link">Link:</label>
                        <input type="text" class="form-control" name="data[link]" id="link" placeholder="Link" value="{{$rowItem['link']}}">
                    </div>
                @endif

                @if(isset($config[$type]['linkphoto']) && $config[$type]['linkphoto'] == true)
                    <div class="form-group col-md-4">
                        <label for="linkphoto">Link Photo:</label>
                        <input type="text" class="form-control" name="data[linkphoto]" id="linkphoto" placeholder="Link Photo" value="{{$rowItem['linkphoto']}}">
                    </div>
                @endif

                @if(isset($config[$type]['congty']) && $config[$type]['congty'] == true)
                    <div class="form-group col-md-4">
                        <label for="congty">Công ty:</label>
                        <input type="text" class="form-control" name="data[congty]" id="congty" placeholder="Công ty" value="{{$rowItem['congty']}}">
                    </div>
                @endif

                @if(isset($config[$type]['service']) && $config[$type]['service'] == true)
                    <div class="form-group col-md-4">
                        <label for="service">Service:</label>
                        <input type="text" class="form-control" name="data[service]" id="service" placeholder="Service" value="{{$rowItem['service']}}">
                    </div>
                @endif

                @if(isset($config[$type]['diachi']) && $config[$type]['diachi'] == true)
                    @if($user)
                    <div class="form-group col-md-4">
                        <label for="diachi">Địa chỉ:</label>
                        <input type="text" class="form-control" id="diachi" placeholder="Địa chỉ" value="{{$user['diachi']}}" readonly="">
                    </div>
                    @else
                    <div class="form-group col-md-4">
                        <label for="diachi">Địa chỉ:</label>
                        <input type="text" class="form-control" name="data[diachi]" id="diachi" placeholder="Địa chỉ" value="{{$rowItem['diachi']}}">
                    </div>
                    @endif
                @endif

                @if(isset($config[$type]['tieude']) && $config[$type]['tieude'] == true)
                    <div class="form-group col-md-4">
                        <label for="tieude">Chủ đề:</label>
                        <input type="text" class="form-control" name="data[tieude]" id="tieude" placeholder="Tiêu đề" value="{{$rowItem['tieude']}}">
                    </div>
                @endif

                @if(isset($config[$type]['sanpham']) && $config[$type]['sanpham'] == true)
                    <div class="form-group col-md-4">
                        <label for="sanpham">Sản phẩm muốn mua:</label>
                        <input type="text" class="form-control" name="data[sanpham]" id="sanpham" placeholder="Sản phẩm muốn mua" value="{{$rowItem['sanpham']}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="soluong">Số lượng:</label>
                        <input type="text" class="form-control" name="data[soluong]" id="soluong" placeholder="Số lượng" value="{{$rowItem['soluong']}}">
                    </div>
                @endif
            </div>

            @if(isset($config[$type]['noidung']) && $config[$type]['noidung'] == true)
                <div class="form-group">
                    <label for="noidung">Nội dung:</label>
                    <textarea class="form-control" name="data[noidung]" id="noidung" rows="5" placeholder="Nội dung">{{$rowItem['noidung']}}</textarea>
                </div>
            @endif
            @if(isset($config[$type]['ghichu']) && $config[$type]['ghichu'] == true)
                <div class="form-group">
                    <label for="ghichu">Ghi chú:</label>
                    <textarea class="form-control" name="data[ghichu]" id="ghichu" rows="5" placeholder="Ghi chú">{{$rowItem['ghichu']}}</textarea>
                </div>
            @endif
			@if(isset($rowItem['taptin']) && ($rowItem['taptin'] != ''))
				<div class="form-group">
					<a class="p-2 mb-1 text-white align-middle rounded btn btn-sm bg-gradient-primary d-inline-block" href="{{ Helper::GetFolder($folder_upload,true).$rowItem['taptin'] }}" title="Download tập tin hiện tại"><i class="mr-2 fas fa-download"></i>Download tập tin hiện tại</a>
				</div>
			@endif

            @if($user && $rowItem['photo']!='')
                <div class="form-group">
                    <label for="">Hình đính kèm:</label>
                    <div style="background: #ebebeb; padding: 1rem;"><img src="{{UPLOAD_FILE.$rowItem['photo']}}" alt=""></div>
                </div>
            @endif

            <div class="form-group">
                <label for="stt" class="mb-0 mr-2 align-middle d-inline-block">Số thứ tự:</label>
                <input type="number" class="align-middle form-control form-control-mini d-inline-block" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="{{(isset($rowItem['stt'])) ? $rowItem['stt'] : 1}}">
            </div>
			<div class="form-group">
				<label for="hienthi" class="mb-0 mr-2 align-middle d-inline-block">Duyệt:</label>
				<div class="align-middle custom-control custom-checkbox d-inline-block">
                    <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox" {{(!isset($rowItem['hienthi']) || $rowItem['hienthi']==1)?'checked':''}}>
                    <label for="hienthi-checkbox" class="custom-control-label"></label>
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
