@extends('admin.master')

@section('content')
<form class="validation-form" novalidate method="post" action="{{route('admin.newsletter.save',['man',$type])}}" enctype="multipart/form-data">
	@csrf
    <div class="text-sm card-footer sticky-top">
        <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="mr-2 far fa-save"></i>Lưu</button>
        <div class="pl-0 ml-1 btn dropdown">
          <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Thao tác
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">            
            <button type="reset" class="btn btn-sm bg-gradient-secondary btn-none-css"><i class="mr-2 fas fa-redo"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger btn-none-css" href="{{route('admin.newsletter.show',['man',$type])}}" title="Thoát"><i class="mr-2 fas fa-sign-out-alt"></i>Thoát</a>
          </div>
        </div>        
    </div>
    <div class="text-sm card card-primary card-outline">
		<div class="card-header">
            <h3 class="card-title">Chi tiết {{$config[$type]['title_main']}}</h3>
        </div>
        <div class="card-body">
            @if(isset($config[$type]['file']) && $config[$type]['file'] == true)
                <div class="form-group">
                    <label class="mb-1 mr-2 change-file" for="file-taptin">
                        <p>Upload tập tin:</p>
                        <strong class="ml-2">
                            <span class="btn btn-sm bg-gradient-success"><i class="mr-2 fas fa-file-upload"></i>Chọn tập tin</span>
                            <div><b class="text-sm text-split"></b></div>
                        </strong>
                    </label>
                    <strong class="mt-2 mb-2 text-sm d-block">{{$config[$type]['file_type']}}</strong>
                    <div class="custom-file my-custom-file d-none">
                        <input type="file" class="custom-file-input" name="file-taptin" id="file-taptin">
                        <label class="custom-file-label" for="file-taptin">Chọn file</label>
                    </div>
                    @if(isset($rowItem['taptin']) && ($rowItem['taptin'] != ''))
                        <a class="p-2 mb-1 text-white align-middle rounded btn btn-sm bg-gradient-primary d-inline-block" href="{{ Helper::GetFolder($folder_upload,true).$rowItem['taptin'] }}" title="Download tập tin hiện tại"><i class="mr-2 fas fa-download"></i>Download tập tin hiện tại</a>
                    @endif
                </div>
            @endif

            @php
                $user = $rowItem['belong_user'];
            @endphp

            @if($user)
                <div class="form-group col-md-12" style="background: #fafafa; ">
                    <a style="display: block;padding: 0.8rem 0.5rem;" href="{{route('admin.users.edit',[$user['id']])}}" target="_blank"><i class="mr-1 fal fa-info-circle"></i>Xem chi tiết tài khoản</a>
                </div>
            @endif

            <div class="form-group-category row">
                @if(isset($config[$type]['ten']) && $config[$type]['ten'] == true)
                    <div class="form-group col-md-4">
                        <label for="ten">Họ tên:</label>
                        <input type="text" class="form-control" name="data[tenvi]" id="ten" placeholder="Họ tên" value="{{$rowItem['tenvi']}}">
                    </div>
                @elseif($user)
                    <div class="form-group col-md-4">
                        <label for="ten">Họ tên:</label>
                        <input type="text" class="form-control" name="" id="ten" placeholder="Họ tên" value="{{$user['name']}}" readonly>
                    </div>
                @endif

                @if(isset($config[$type]['dienthoai']) && $config[$type]['dienthoai'] == true)
                    <div class="form-group col-md-4">
                        <label for="dienthoai">Điện thoại:</label>
                        <input type="text" class="form-control" name="data[dienthoai]" id="dienthoai" placeholder="Điện thoại" value="{{$rowItem['dienthoai']}}">
                    </div>
                @elseif($user)
                    <div class="form-group col-md-4">
                        <label for="dienthoai">Điện thoại:</label>
                        <input type="text" class="form-control" name="" id="dienthoai" placeholder="Điện thoại" value="{{$user['phonenumber']}}" readonly>
                    </div>
                @endif

                @if(isset($config[$type]['email']) && $config[$type]['email'] == true)
                    <div class="form-group col-md-4">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="data[email]" id="email" placeholder="Email" value="{{$rowItem['email']}}">
                    </div>
                @elseif($user)
                    <div class="form-group col-md-4">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" name="" id="email" placeholder="Email" value="{{$user['email']}}" readonly>
                    </div>
                @endif

                @if(isset($config[$type]['chucvu']) && $config[$type]['chucvu'] == true)
                    <div class="form-group col-md-4">
                        <label for="chucvu">Chức vụ:</label>
                        <input type="text" class="form-control" name="data[chucvu]" id="chucvu" placeholder="Chức vụ" value="{{$rowItem['chucvu']}}">
                    </div>
                @endif

                @if(isset($config[$type]['congty']) && $config[$type]['congty'] == true)
                    <div class="form-group col-md-4">
                        <label for="congty">Công ty:</label>
                        <input type="text" class="form-control" name="data[congty]" id="congty" placeholder="Công ty" value="{{$rowItem['congty']}}">
                    </div>
                @endif

                @if($user)  
                    <div class="form-group col-md-4">
                        <label for="giatrixunap">Xu nạp:</label>
                        <input type="text" class="form-control" name="" id="giatrixunap" placeholder="Xu nạp" value="{{$rowItem['giatrixunap']}}" readonly>
                    </div>  

                    <div class="form-group col-md-4">
                        <label for="giatrinap">Tiền quy đổi:</label>
                        <input type="text" class="form-control" name="" id="giatrinap" placeholder="Giá trị nạp" value="{{$rowItem['giatrinap']}}" readonly>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="magiaodich">Mã giao dịch:</label>
                        <input type="text" class="form-control" name="" id="magiaodich" placeholder="Mã giao dịch" value="{{$rowItem['magiaodich']}}" readonly>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="soxu">Số xu hiện có:</label>
                        <input type="text" class="form-control" name="" id="soxu" placeholder="Số xu hiện có" value="{{$user['tongxu']}}" readonly>
                    </div>
                @endif

                @if($user)
                    <div class="form-group col-md-4">
                        <label for="hinhthuc">Hình thức:</label>
                        <select id="hinhthuc" class="form-control select2">
                            <option value="0">{{($rowItem['hinhthuc']==0) ? 'Nạp xu' : 'Rút xu'}}</option>        
                        </select>
                    </div>
                @endif
                @if($user)
                    <div class="form-group col-md-4">
                        <label for="phuongthuc">Phương thức thanh toán:</label>
                        <select id="phuongthuc" class="form-control select2">
                            <option value="0">{{($rowItem['phuongthuc']==0) ? 'Thanh toán qua momo' : 'Thanh toán qua tài khoản ngân hàng'}}</option>     
                        </select>
                    </div>
                @endif

                @if(isset($config[$type]['chieucao']) && $config[$type]['chieucao'] == true)
                    <div class="form-group col-md-4">
                        <label for="chieucao">Chiều cao:</label>
                        <input type="text" class="form-control" name="data[chieucao]" id="chieucao" placeholder="Chiều cao" value="{{$rowItem['chieucao']}}">
                    </div>
                @endif

                @if(isset($config[$type]['cannang']) && $config[$type]['cannang'] == true)
                    <div class="form-group col-md-4">
                        <label for="cannang">Cân nặng:</label>
                        <input type="text" class="form-control" name="data[cannang]" id="cannang" placeholder="Cân nặng" value="{{$rowItem['cannang']}}">
                    </div>
                @endif

                @if(isset($config[$type]['facebook']) && $config[$type]['facebook'] == true)
                    <div class="form-group col-md-4">
                        <label for="facebook">Link facebook:</label>
                        <input type="text" class="form-control" name="data[facebook]" id="facebook" placeholder="Link facebook" value="{{$rowItem['facebook']}}">
                    </div>
                @endif

                @if(isset($config[$type]['diachi']) && $config[$type]['diachi'] == true)
                    <div class="form-group col-md-4">
                        <label for="diachi">Địa chỉ:</label>
                        <input type="text" class="form-control" name="data[diachi]" id="diachi" placeholder="Địa chỉ" value="{{$rowItem['diachi']}}">
                    </div>
                @endif

                @if(isset($config[$type]['chude']) && $config[$type]['chude'] == true)
                    <div class="form-group col-md-4">
                        <label for="chude">Chủ đề:</label>
                        <input type="text" class="form-control" name="data[chude]" id="chude" placeholder="Chủ đề" value="{{$rowItem['chude']}}">
                    </div>
                @endif

                @if(isset($config[$type]['tinhtrang']) && count($config[$type]['tinhtrang']) > 0)
                    <div class="form-group col-md-4">
                        <label for="tinhtrang">Tình trạng:</label>
                        <select id="tinhtrang" name="data[tinhtrang]" class="form-control select2">
                            <option value="0">Cập nhật tình trạng</option>
                            @foreach($config[$type]['tinhtrang'] as $key => $value)
                                <option {{(isset($rowItem['tinhtrang']) && ($rowItem['tinhtrang'] == $key)) ? "selected" : ""}} value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
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
            <div class="form-group">
                <label for="stt" class="mb-0 mr-2 align-middle d-inline-block">Số thứ tự:</label>
                <input type="number" class="align-middle form-control form-control-mini d-inline-block" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="{{(isset($rowItem['stt'])) ? $rowItem['stt'] : 1}}">
            </div>
			<div class="form-group">
				<label for="hienthi" class="mb-0 mr-2 align-middle d-inline-block">Đã xem:</label>
				<div class="align-middle custom-control custom-checkbox d-inline-block">
                    <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox" {{(!isset($rowItem['hienthi']) || $rowItem['hienthi']==1)?'checked':''}}>
                    <label for="hienthi-checkbox" class="custom-control-label"></label>
                </div>
			</div>
        </div>
    </div>
    {{-- <div class="text-sm card-footer">
        <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="mr-2 far fa-save"></i>Lưu</button>
        <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="mr-2 fas fa-redo"></i>Làm lại</button>
        <a class="btn btn-sm bg-gradient-danger" href="{{route('admin.newsletter.show',['man',$type])}}" title="Thoát"><i class="mr-2 fas fa-sign-out-alt"></i>Thoát</a>
        <input type="hidden" name="id" value="{{ (isset($rowItem['id']))?$rowItem['id']:'' }}">
    </div> --}}

    <input type="hidden" name="id" value="{{ (isset($rowItem['id']))?$rowItem['id']:'' }}">
</form>
@endsection

<!--js thêm cho mỗi trang-->
@section('js_page')

@endsection
