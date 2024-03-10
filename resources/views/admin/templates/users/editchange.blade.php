@extends('admin.master')

@section('content')
<form method="post" action="{{ route('admin.users.change') }}" enctype="multipart/form-data">
    @csrf
    <div class="card-footer text-sm sticky-top">
        <button type="submit" class="btn btn-sm bg-gradient-primary"><i class="far fa-save mr-2"></i>Lưu</button>
        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
    </div>
    <div class="card card-primary card-outline text-sm">
        <div class="card-header">
            <h3 class="card-title">Thông tin admin</h3>
        </div>
        <div class="card-body">
            <div class="row">
                @if(isset($info_check))
                    @if($info_check)
                    <p class="dev-option-error text-success col-xl-12"><i class="fas fa-exclamation-circle"></i> {{ $info_loading }} </p>
                    @else
                    <p class="dev-option-error text-danger col-xl-12"><i class="fas fa-exclamation-circle"></i> {{ $info_loading }} </p>
                    @endif
                @endif
                <div class="form-group col-xl-4 col-lg-6 col-md-6">
                    <label for="old_password">Mật khẩu cũ:</label>
                    <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Mật khẩu cũ" required>
                </div>
                <div class="form-group col-xl-4 col-lg-6 col-md-6">
                    <label for="new_password">
                        <span class="d-inline-block align-middle">Mật khẩu mới:</span>
                        <span class="text-danger ml-2" id="show_password"></span>
                    </label>
                    <div class="row align-items-center">
                        <div class="col-6"><input type="password" class="form-control" name="new_password" id="new_password" placeholder="Mật khẩu mới" required></div>
                        <div class="col-6"><span class="btn btn-sm bg-gradient-primary text-sm" onclick="randomPassword()"><i class="fas fa-random mr-2"></i>Tạo mật khẩu</span></div>
                    </div>
                </div>
                <div class="form-group col-xl-4 col-lg-6 col-md-6">
                    <label for="renew_password">Nhập lại mật khẩu mới:</label>
                    <input type="password" class="form-control" name="renew_password" id="renew_password" placeholder="Nhập lại mật khẩu mới" required>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-sm">
        <button type="submit" class="btn btn-sm bg-gradient-primary"><i class="far fa-save mr-2"></i>Lưu</button>
        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
    </div>
</form>
@endsection

<!--js thêm cho mỗi trang-->
@section('js_page')
<script type="text/javascript">
    function randomPassword()
    {
        var chuoi = "";
        for(i=0;i<9;i++)
        {
            chuoi += "!@#$%^&*()?abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890".charAt(Math.floor(Math.random()*62));
        }
        jQuery('#new_password').val(chuoi);
        jQuery('#renew_password').val(chuoi);
        jQuery('#show_password').html(chuoi);
    }
</script>
@endsection
