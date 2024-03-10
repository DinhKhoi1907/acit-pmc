@extends('admin.master')

@section('content')
	@csrf
	<div class="text-sm card-footer sticky-top">
        @if(isset($config[$type]['guiemail']) && $config[$type]['guiemail'] == true)
           <a class="text-white btn btn-sm bg-gradient-success" id="send-email" title="Gửi email"><i class="mr-2 fas fa-paper-plane"></i>Gửi email</a>
        @endif
        <div class="pl-0 ml-1 btn dropdown">
          <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Thao tác
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">            
            <a class="btn btn-sm bg-gradient-primary btn-none-css" href="{{ route('admin.newsletter.edit',['man',$type]) }}" title="Thêm mới"><i class="mr-2 fas fa-plus"></i>Thêm mới</a>
            <a class="btn btn-sm bg-gradient-danger btn-none-css" id="delete-all" data-url="{{ route('admin.newsletter.deleteAll', ['man', $type]) }}" title="Xóa tất cả"><i class="mr-2 far fa-trash-alt"></i>Xóa tất cả</a> 
          </div>
        </div>		       
    </div>
    <div class="mb-0 text-sm card card-primary card-outline">
        <div class="card-header">
            <div class="mb-3 align-middle form-inline form-search">
                <div class="input-group input-group-sm">
                    <input class="text-sm form-control form-control-navbar" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="{{ (isset($request->keyword))?$request->keyword:'' }}" onkeypress="doEnter(event,'keyword','{{ route('admin.newsletter.show',['man', $type]) }}')">
                    <div class="input-group-append bg-primary rounded-right">
                        <button class="text-white btn btn-navbar" type="button" onclick="onSearch('keyword','{{ route('admin.newsletter.show',['man', $type]) }}')">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <h3 class="card-title">Danh sách {{ $config[$type]['title_main'] }}</h3>
			@if(isset($config[$type]['guiemail']) && $config[$type]['guiemail'] == true)
                <p class="float-left mt-1 mb-0 d-block text-secondary w-100">Chọn email sau đó kéo xuống dưới cùng danh sách này để có thể thiết lập nội dung email muốn gửi đi.</p>
            @endif
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
                        <th class="text-center align-middle" width="10%">STT</th>
						<th class="align-middle" style="width:30%">Email</th>
						{{-- <th class="align-middle" style="width:30%">Điện thoại</th> --}}
						<th class="text-center align-middle">Tình trạng</th>
						{{-- <th class="text-center align-middle">Đã xem</th> --}}
                        <th class="text-center align-middle">Thao tác</th>
                    </tr>
                </thead>

                @if(empty($itemShow))
                    <tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
                @else
                    <tbody>
                        @foreach($itemShow as $k=>$v)
                            @php
                                $user = ($v['id_user']!=0) ? $v['BelongUser'] : null;
                            @endphp
                            <tr>
								<td class="text-center align-middle dev-item-checkbox">
									<div class="icheck-primary d-inline dev-check">
				                        <input type="checkbox" class="select-checkbox" id="checkItem-{{$v['id']}}" value="{{$v['id']}}">
				                        <label for="checkItem-{{$v['id']}}"></label>
				                    </div>
								</td>
								<td class="dev-item-stt">
									<input type="number" class="m-auto form-control form-control-mini update-stt" min="0" value="{{$v['stt']}}" data-id="{{$v['id']}}" data-model="newsletter" data-level="man">
								</td>

                                {{-- <td class="align-middle">
                                    <a class="text-dark" href="{{route('admin.newsletter.edit',['man',$type,$v['id']])}}" title="{{$v['tenvi']}}">{{($user) ? $user['name'] : $v['tenvi']}}</a>
                                </td>

								<td class="align-middle">
                                    <a class="text-dark" href="{{route('admin.newsletter.edit',['man',$type,$v['id']])}}" title="{{$v['dienthoai']}}">{{($user) ? $user['dienthoai'] : $v['dienthoai']}}</a>
                                </td> --}}

                                <td class="align-middle">
                                    <a class="text-dark" href="{{route('admin.newsletter.edit',['man',$type,$v['id']])}}" title="{{$v['email']}}">{{($user) ? $user['email'] : $v['email']}}</a>
                                </td>

								@if(isset($config[$type]['tinhtrang']) && count($config[$type]['tinhtrang']) > 0)
                                    @php
                                        switch ($v['tinhtrang']) {
                                            case 0:
                                                $str = 'info';
                                                break;
                                            
                                            case 1:
                                                $str = 'error';
                                                break;

                                            case 2:
                                                $str = 'success';
                                                break;
                                        }
                                    @endphp
                                    <td class="text-center align-middle"><span class="badge badge-{{$str}}">{!! Helper::get_status_newsletter($v['tinhtrang'],$type) !!}</span></td>
                                @endif

								{{-- <td class="text-center align-middle dev-item-display show-checkbox">
                                	<div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input" data-model="newsletter" data-level="man" data-id="{{ $v['id'] }}" data-loai="hienthi" {{($v['hienthi'])?'checked':''}}>
                                        <label for="show-checkbox-{{ $v['id'] }}" class="custom-control-label"></label>
                                    </div>
                                </td> --}}

                                <td class="text-center align-middle dev-item-option">
                                    <div class="dropdown show">
                                      <a class="btn-dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="fas fa-ellipsis-v" ></i>
                                      </a>

                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="btn btn-sm d-block btn-none-css" href="{{route('admin.newsletter.edit',['man',$type,$v['id']])}}" title="Chỉnh sửa"><i class="fas fa-pencil-alt"></i> Chỉnh sửa</a>
                                            <a class="btn btn-sm d-block delete-item btn-none-css" data-url="{{route('admin.newsletter.delete',['man',$type,$v['id']])}}" title="Xóa"><i class="fas fa-trash-alt"></i> Xóa</a>
                                      </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @endif
            </table>
        </div>
    </div>

	<div class="card-footer">
	  <div class="row">
		 <div class="col-sm-12 dev-center dev-paginator">{{ $itemShow->links() }}</div>
	  </div>
	</div>

	@if(isset($config[$type]['guiemail']) && $config[$type]['guiemail'] == true)
        <div class="mt-3 mb-0 text-sm card card-primary card-outline">
            <form name="frmsendemail" method="post" action="{{route('admin.newsletter.send',['man',$type])}}" enctype="multipart/form-data">
				@csrf
                <div class="card-header">
                    <h3 class="card-title">Gửi email đến danh sách được chọn</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="tieude">Tiêu đề:</label>
                        <input type="text" class="form-control" name="tieude" id="tieude" placeholder="Tiêu đề">
                    </div>
                    <div class="form-group">
                        <label class="mb-1 mr-2 align-middle d-inline-block">Upload tập tin:</label>
                        <strong class="mt-2 mb-2 text-sm d-block">{{$config[$type]['file_type']}}</strong>
                        <div class="custom-file my-custom-file">
                            <input type="file" class="custom-file-input" name="file" id="file">
                            <label class="custom-file-label" for="file">Chọn file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="noidung">Nội dung thông tin:</label>
                        <textarea class="form-control form-control-ckeditor" name="noidung" id="noidung" rows="5" placeholder="Nội dung thông tin"></textarea>
                    </div>
                    <input type="hidden" name="listemail" id="listemail">
                </div>
            </form>
        </div>
    @endif

	<div class="card-footer">
		@if(isset($config[$type]['guiemail']) && $config[$type]['guiemail'] == true)
           <a class="text-white btn btn-sm bg-gradient-success" id="send-email" title="Gửi email"><i class="mr-2 fas fa-paper-plane"></i>Gửi email</a>
        @endif
	  	{{-- <a class="text-white btn btn-sm bg-gradient-primary" href="{{ route('admin.newsletter.edit',['man', $type]) }}" title="Thêm mới"><i class="mr-2 fas fa-plus"></i>Thêm mới</a>
	  	<a class="text-white btn btn-sm bg-gradient-danger" id="delete-all" data-url="{{ route('admin.newsletter.deleteAll', ['man', $type]) }}" title="Xóa tất cả"><i class="mr-2 far fa-trash-alt"></i>Xóa tất cả</a> --}}
	</div>
@endsection

<!--js thêm cho mỗi trang-->
@section('js_page')
	<script>
		/* Send email */
		$('body').on('click','#send-email', function(){
			confirmDialog("send-email","Bạn muốn gửi thông tin cho các mục đã chọn ?","");
		});

		/* Send email */
		function sendEmail(){
			var listemail="";
			$("input.select-checkbox").each(function(){
				if (this.checked) listemail = listemail+","+this.value;
			});
			listemail = listemail.substr(1);
			if(listemail == ""){
				notifyDialog("Bạn hãy chọn ít nhất 1 mục để gửi");
				return false;
			}
			$("#listemail").val(listemail);
			document.frmsendemail.submit();
		}
	</script>
@endsection
