@extends('admin.master')

@section('content')
<form class="validation-form" novalidate method="post" action="{{ route('admin.users.save') }}" enctype="multipart/form-data">
    @csrf
    <div class="card-footer text-sm sticky-top">
        <button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
        <a class="btn btn-sm bg-gradient-danger" href="{{ route('admin.users.show') }}" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
    </div>
    <div class="card card-primary card-outline text-sm">
        <div class="card-header">
            <h3 class="card-title">{{(isset($request->id))?"Cập nhật":"Thêm mới"}} tài khoản</h3>
        </div>
        <div class="card-body">
        	<div class="row">
				<div class="form-group col-md-4 mb-4">
					<label for="username" class="inp">
                        <input type="text" class="form-control" name="data[username]" id="username" placeholder="&nbsp;" value="{{$rowItem['username']}}" {{(isset($request->id))?'readonly':''}} required>
                        <span class="label">Tên đăng nhập</span>
                        <span class="focus-bg"></span>
                    </label>
				</div>
				<div class="form-group col-md-4 mb-4">
					<label for="name" class="inp">
                        <input type="text" class="form-control" name="data[name]" id="name" placeholder="&nbsp;" value="{{$rowItem['name']}}" required>
                        <span class="label">Họ tên</span>
                        <span class="focus-bg"></span>
                    </label>
				</div>

				@if(!isset($request->id))
				<div class="form-group col-md-4 mb-4">
					<label for="password">Mật khẩu:</label>
					<input type="password" class="form-control" name="data[password]" id="password" placeholder="Mật khẩu" {{(!isset($request->id))?'required':''}}>
				</div>
				<div class="form-group col-md-4 mb-4">
					<label for="confirm_password">Nhập lại mật khẩu:</label>
					<input type="password" class="form-control" name="data[confirm_password]" id="confirm_password" placeholder="Nhập lại mật khẩu" {{(!isset($request->id))?'required':''}}>
				</div>
				@endif

				<div class="form-group col-md-4 mb-4">
					<label for="email" class="inp">
                        <input type="email" class="form-control" name="data[email]" id="email" placeholder="&nbsp;" value="{{$rowItem['email']}}" required>
                        <span class="label">Email</span>
                        <span class="focus-bg"></span>
                    </label>					
				</div>
				<div class="form-group col-md-4 mb-4">
					<label for="dienthoai" class="inp">
                        <input type="text" class="form-control" name="data[phonenumber]" id="dienthoai" placeholder="&nbsp;" value="{{$rowItem['phonenumber']}}" required>
                        <span class="label">Điện thoại</span>
                        <span class="focus-bg"></span>
                    </label>
				</div>
                <div class="form-group col-md-4 mb-4">
                	<label for="mathanhvien" class="inp">
                        <input type="text" class="form-control" name="data[mathanhvien]" id="mathanhvien" placeholder="&nbsp;" value="{{$rowItem['mathanhvien']}}" required>
                        <span class="label">Mã thành viên</span>
                        <span class="focus-bg"></span>
                    </label>
                </div>
			</div>
			<div class="form-group">
				<label for="kichhoat" class="d-inline-block align-middle mb-0 mr-2">Kích hoạt:</label>
				<div class="custom-control custom-checkbox d-inline-block align-middle">
                    <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[kichhoat]" id="kichhoat-checkbox" {{(!isset($rowItem['kichhoat']) || $rowItem['kichhoat']==1)?'checked':''}}>
                    <label for="kichhoat-checkbox" class="custom-control-label"></label>
                </div>
			</div>
        </div>

        {{-- <div class="card-header">
            <h3 class="card-title">Thông tin tài khoản thanh toán</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4 mb-4">
                    <label for="momo" class="inp">
                        <input type="text" class="form-control" placeholder="&nbsp;" value="{{$rowItem['somomo']}}" readonly="">
                        <span class="label">Tài khoản Momo</span>
                        <span class="focus-bg"></span>
                    </label>
                </div>
                <div class="form-group col-md-4 mb-4">
                    <label for="nganhang" class="inp">
                        <input type="text" class="form-control" placeholder="&nbsp;" value="{{$rowItem['has_nganhang']['tenvi']}}" readonly="">
                        <span class="label">Ngân hàng đăng ký</span>
                        <span class="focus-bg"></span>
                    </label>
                </div>
                <div class="form-group col-md-4 mb-4">
                    <label for="nganhang" class="inp">
                        <input type="text" class="form-control" placeholder="&nbsp;" value="{{$rowItem['sotaikhoan']}}" readonly="">
                        <span class="label">Số tài khoản ngân hàng</span>
                        <span class="focus-bg"></span>
                    </label>
                </div>                
            </div>
        </div> --}}
    </div>

    <input type="hidden" name="id" value="{{isset($rowItem['id'])?$rowItem['id']:''}}">
</form>
@endsection

<!--js thêm cho mỗi trang-->
@section('js_page')
    
@endsection
