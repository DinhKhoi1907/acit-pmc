@extends('admin.master')

@section('content')
<form class="validation-form" novalidate method="post" action="{{ route('admin.member.save') }}" enctype="multipart/form-data">
    @csrf
    <div class="card-footer text-sm sticky-top">
        <button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
        <a class="btn btn-sm bg-gradient-danger" href="{{ route('admin.member.show') }}" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
    </div>
    <div class="card card-primary card-outline text-sm">
        <div class="card-header">
            <h3 class="card-title">{{(isset($request->id))?"Cập nhật":"Thêm mới"}} tài khoản</h3>
        </div>
        <div class="card-body">
        	<div class="row">
				<div class="form-group col-md-4">
					@if(isset($config['permission']) && $config['permission'] == true)
						<label for="permission">Danh sách nhóm quyền:</label>						
						{!! Helper::get_permission((isset($rowItem['id_nhomquyen'])) ? $rowItem['id_nhomquyen'] : 0) !!}
					@endif
				</div>
				<div class="form-group col-md-4">
					<label for="username">Tài khoản: <span class="text-danger">*</span></label>
					<input type="text" class="form-control" name="data[username]" id="username" placeholder="Tài khoản" value="{{($rowItem) ? $rowItem['username'] : ''}}" {{(isset($request->id))?'readonly':''}} required>
				</div>
				<div class="form-group col-md-4">
					<label for="name">Họ tên: <span class="text-danger">*</span></label>
					<input type="text" class="form-control" name="data[name]" id="name" placeholder="Họ tên" value="{{($rowItem) ? $rowItem['name'] : ''}}" required>
				</div>
				<div class="form-group col-md-4">
					<label for="password">Mật khẩu:</label>
					<input type="password" class="form-control" name="data[password]" id="password" placeholder="Mật khẩu" {{(!isset($request->id))?'required':''}}>
				</div>
				<div class="form-group col-md-4">
					<label for="confirm_password">Nhập lại mật khẩu:</label>
					<input type="password" class="form-control" name="data[confirm_password]" id="confirm_password" placeholder="Nhập lại mật khẩu" {{(!isset($request->id))?'required':''}}>
				</div>
				<div class="form-group col-md-4">
					<label for="email">Email:</label>
					<input type="email" class="form-control" name="data[email]" id="email" placeholder="Email" value="{{($rowItem) ? $rowItem['email'] : ''}}">
				</div>
				<div class="form-group col-md-4">
					<label for="dienthoai">Điện thoại:</label>
					<input type="text" class="form-control" name="data[dienthoai]" id="dienthoai" placeholder="Điện thoại" value="{{($rowItem) ? $rowItem['dienthoai'] : ''}}">
				</div>
			</div>
			<div class="form-group">
				<label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Kích hoạt:</label>
				<div class="custom-control custom-checkbox d-inline-block align-middle">
                    <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox" {{(!isset($rowItem['hienthi']) || $rowItem['hienthi']==1)?'checked':''}}>
                    <label for="hienthi-checkbox" class="custom-control-label"></label>
                </div>
			</div>
        </div>
        <div class="card-footer text-sm">
	        {{-- <button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
	        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
	        <a class="btn btn-sm bg-gradient-danger" href="{{ route('admin.member.show') }}" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a> --}}
	        <input type="hidden" name="id" value="{{isset($rowItem['id'])?$rowItem['id']:''}}">
	    </div>
    </div>
    
</form>
@endsection

<!--js thêm cho mỗi trang-->
@section('js_page')
<script type="text/javascript">

</script>
@endsection
