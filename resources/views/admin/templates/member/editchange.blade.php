@extends('admin.master')

@section('content')
<form method="post" action="{{ route('admin.member.change') }}" enctype="multipart/form-data">
    @csrf
    <div class="text-sm card-footer sticky-top">
        <button type="submit" class="btn btn-sm bg-gradient-primary"><i class="mr-2 far fa-save"></i>Lưu</button>
        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="mr-2 fas fa-redo"></i>Làm lại</button>
    </div>
    <div class="text-sm card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Thay đổi mật khẩu <a><span class="text-sm" style="cursor: pointer;color:#26b99a" onclick="randomPassword()">(<i class="mr-1 far fa-hand-point-right"></i>Tạo ngẫu nhiên)</span></a><span class="ml-2 text-danger" style="text-transform: none !important;" id="show_password"></span></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        @if(isset($info_check))
                            @if($info_check)
                            <p class="dev-option-error text-success col-xl-12"><i class="fas fa-exclamation-circle"></i> {{ $info_loading }} </p>
                            @else
                            <p class="dev-option-error text-danger col-xl-12"><i class="fas fa-exclamation-circle"></i> {{ $info_loading }} </p>
                            @endif
                        @endif
                        <div class="form-group col-xl-4 col-lg-6 col-md-6">                            
                            <label for="old_password" class="inp">
                                <input type="password" class="form-control for-seo" name="old_password" id="old_password" placeholder="&nbsp;" required>
                                <span class="label">Mật khẩu cũ</span>
                            </label>
                        </div>
                        <div class="form-group col-xl-4 col-lg-6 col-md-6">
                            <label for="new_password" class="inp">
                                <input type="text" class="form-control for-seo" name="new_password" id="new_password" placeholder="&nbsp;" required>
                                <span class="label">Mật khẩu mới</span>
                            </label>

                            {{--
                            <label for="new_password">
                                <span class="align-middle d-inline-block">Mật khẩu mới: ( <a><span class="text-sm" style="cursor: pointer;color:#26b99a" onclick="randomPassword()"><i class="mr-1 far fa-hand-point-right"></i>Tạo ngẫu nhiên</span></a> )</span>
                                <span class="ml-2 text-danger" id="show_password"></span>
                            </label>
                            <div class="row align-items-center">
                                <div class="col-12"><input type="password" class="form-control" name="new_password" id="new_password" placeholder="Mật khẩu mới" required></div>
                            </div>--}}
                        </div>
                        <div class="form-group col-xl-4 col-lg-6 col-md-6">
                            <label for="renew_password" class="inp">
                                <input type="password" class="form-control for-seo" name="renew_password" id="renew_password" placeholder="&nbsp;" required>
                                <span class="label">Nhập lại mật khẩu mới</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 d-none">
                    <div class="text-sm card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Hình đại diện</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
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
                                <div class="photoUpload-dimension">{{ "Width: 200px - Height: 200px ()" }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="text-sm card-footer">
        <button type="submit" class="btn btn-sm bg-gradient-primary"><i class="mr-2 far fa-save"></i>Lưu</button>
        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="mr-2 fas fa-redo"></i>Làm lại</button>
    </div> --}}
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
        $('#new_password').val(chuoi);
        $('#renew_password').val(chuoi);
        $('#show_password').text(chuoi);
    }
</script>
@endsection
