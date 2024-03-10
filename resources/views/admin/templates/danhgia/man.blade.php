@extends('admin.master')

@section('content')
	@csrf
	<div class="text-sm card-footer sticky-top">
        <div class="pl-0 ml-1 btn dropdown">
          <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Thao tác
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">            
            <a class="btn btn-sm bg-gradient-primary btn-none-css" href="{{ route('admin.danhgia.edit',['man']) }}" title="Thêm mới"><i class="mr-2 fas fa-plus"></i>Thêm mới</a>
            <a class="btn btn-sm bg-gradient-danger btn-none-css" id="delete-all" data-url="{{ route('admin.danhgia.deleteAll', ['man']) }}" title="Xóa tất cả"><i class="mr-2 far fa-trash-alt"></i>Xóa tất cả</a> 
          </div>
        </div>		       
    </div>

    <div class="row">
        <div class="col-12">
            <div class="mb-0 text-sm card card-primary card-outline">
                <div class="card-header">
                    <div class="mb-3 align-middle form-inline form-search">
                        <div class="input-group input-group-sm">
                            <input class="text-sm form-control form-control-navbar" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="{{ (isset($request->keyword))?$request->keyword:'' }}" onkeypress="doEnter(event,'keyword','{{ route('admin.danhgia.show',['man']) }}')">
                            <div class="input-group-append bg-primary rounded-right">
                                <button class="text-white btn btn-navbar" type="button" onclick="onSearch('keyword','{{ route('admin.danhgia.show',['man']) }}')">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-0 card-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
        						<th class="text-center align-middle">
        							<div class="icheck-primary d-inline dev-check">
        								<input type="checkbox" id="checkAll">
        								<label for="checkAll"></label>
        							</div>
        						</th>
        						<th class="align-middle" >Ngày gửi</th>
        						<th class="align-middle" style="width:20%">Họ tên</th>
        						<th class="align-middle" style="width:30%">Nội dung đánh giá</th>
        						<th class="align-middle" >Số điện thoại</th>
        						<th class="text-center align-middle d-none">Đã duyệt</th>
                                <th class="text-center align-middle">Hiển thị</th>
                                <th class="text-center align-middle">Thao tác</th>
                            </tr>
                        </thead>
                        @if(empty($itemShow))
                            <tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
                        @else
                            <tbody>
                                @foreach($itemShow as $k=>$v)
                                    <tr>
        								<td class="text-center align-middle dev-item-checkbox">
        									<div class="icheck-primary d-inline dev-check">
        				                        <input type="checkbox" class="select-checkbox" id="checkItem-{{$v['id']}}" value="{{$v['id']}}">
        				                        <label for="checkItem-{{$v['id']}}"></label>
        				                    </div>
        								</td>

        								<td class="align-middle">
                                            <a class="text-green">{{date('d-m-Y',$v['ngaytao'])}}</a>
                                            <p>
                                                <span class="badge badge-danger">{{($v['duyettin']==0) ? 'Mới' : ''}}</span>
                                                <span class="badge badge-info">{{($v['answer']=='') ? 'Chưa xem' : ''}}</span>
                                            </p>
                                        </td>

                                        <td class="align-middle">
                                            <a class="text-info" href="{{route('admin.danhgia.edit',['man',$v['id']])}}" title="{{$v['hoten']}}">{{$v['tenvi']}}</a>
                                        </td>

        								<td class="align-middle">
                                            <div style="color:#999;font-style:italic">{{$v['noidungvi']}}</div>
                                        </td>

                                        <td class="align-middle">
                                            <a class="text-dark" href="{{route('admin.danhgia.edit',['man',$v['id']])}}" title="{{$v['dienthoai']}}">{{$v['dienthoai']}}</a>
                                        </td>

        								<td class="text-center align-middle dev-item-display show-checkbox d-none">
                                        	<div class="custom-control custom-checkbox my-checkbox">
                                                <input type="checkbox" class="custom-control-input" data-model="question" data-level="man" data-id="{{ $v['id'] }}" data-loai="duyettin" {{($v['duyettin'])?'checked':''}}>
                                                <label for="show-checkbox-{{ $v['id'] }}" class="custom-control-label"></label>
                                            </div>
                                        </td>

                                        <td class="text-center align-middle dev-item-display show-checkbox">
                                            <div class="custom-control custom-checkbox my-checkbox">
                                                <input type="checkbox" class="custom-control-input" data-model="question" data-level="man" data-id="{{ $v['id'] }}" data-loai="hienthi" {{($v['hienthi'])?'checked':''}}>
                                                <label for="show-checkbox-{{ $v['id'] }}" class="custom-control-label"></label>
                                            </div>
                                        </td>

                                        <td class="text-center align-middle dev-item-option">
                                            <div class="dropdown show">
                                              <a class="btn-dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="fas fa-ellipsis-v" ></i>
                                              </a>

                                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="btn btn-sm d-block btn-none-css" href="{{route('admin.danhgia.edit',['man',$v['id']])}}" title="Xem"><i class="fas fa-comments"></i> Xem</a>
                                                    <a class="btn btn-sm d-block delete-item btn-none-css" data-url="{{route('admin.danhgia.delete',['man',$v['id']])}}" title="Xóa"><i class="fas fa-trash-alt"></i> Xóa</a>
                                              </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>

                <div class="card-footer">
                  <div class="row">
                     <div class="col-sm-12 dev-center dev-paginator">{{ $itemShow->links() }}</div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!--js thêm cho mỗi trang-->
@section('js_page')
	<script>
		
	</script>
@endsection
