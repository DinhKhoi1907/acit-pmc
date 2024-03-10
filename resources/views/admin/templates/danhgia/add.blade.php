@extends('admin.master')

@section('content')
<form class="validation-form" novalidate method="post" action="{{route('admin.danhgia.save',['man'])}}" enctype="multipart/form-data">
	@csrf
    <div class="text-sm card-footer sticky-top">
        <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="mr-2 far fa-save"></i>Lưu</button>
        <div class="pl-0 ml-1 btn dropdown">
          <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Thao tác
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <button type="reset" class="btn btn-sm bg-gradient-secondary btn-none-css"><i class="mr-2 fas fa-redo"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger btn-none-css" href="{{route('admin.danhgia.show',['man'])}}" title="Thoát"><i class="mr-2 fas fa-sign-out-alt"></i>Thoát</a>
          </div>
        </div>        
    </div>
    <div class="text-sm card card-primary card-outline">
		<div class="card-header">
            <h3 class="card-title">Chi tiết</h3>
        </div>
        <div class="card-body">
            <div class="form-group-category row">                
                <div class="form-group col-md-4">
                    <label for="ten">Họ tên:</label>
                    <input type="text" class="form-control" name="data[tenvi]" id="ten" placeholder="Họ tên" value="{{$rowItem['tenvi']}}">
                </div>

                <div class="form-group col-md-4">
                    <label for="dienthoai">Điện thoại:</label>
                    <input type="text" class="form-control" name="data[dienthoai]" id="dienthoai" placeholder="Điện thoại" value="{{$rowItem['dienthoai']}}">
                </div>
                
                <div class="form-group col-md-4">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="data[email]" id="email" placeholder="Email" value="{{$rowItem['email']}}">
                </div>
            </div>

            <div class="form-group">
                <label for="noidungvi">Nội dung đánh giá:</label>
                <textarea class="form-control" name="data[noidungvi]" id="noidungvi" rows="5" placeholder="Nội dung">{{$rowItem['noidungvi']}}</textarea>
            </div>

            {{-- <div class="form-group">
                <label for="ghichu"><i class="fas fa-comments"></i> Quản trị viên trả lời:</label>
                <textarea class="form-control" name="data[answer]" id="answer" rows="5" placeholder="">{{$rowItem['answer']}}</textarea>
            </div> --}}

			<div class="form-group">
				<label for="hienthi" class="mb-0 mr-2 align-middle d-inline-block">Đã duyệt:</label>
				<div class="align-middle custom-control custom-checkbox d-inline-block">
                    <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[duyettin]" id="hienthi-checkbox" {{(!isset($rowItem['duyettin']) || $rowItem['duyettin']==1)?'checked':''}}>
                    <label for="hienthi-checkbox" class="custom-control-label"></label>
                </div>
			</div>
        </div>
    </div>
    <div class="text-sm card-footer">
        <input type="hidden" name="id" value="{{ (isset($rowItem['id']))?$rowItem['id']:'' }}">
    </div>
</form>
@endsection

<!--js thêm cho mỗi trang-->
@section('js_page')

@endsection
