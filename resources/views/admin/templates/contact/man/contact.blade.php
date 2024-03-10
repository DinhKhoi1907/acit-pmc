@extends('admin.master')

@section('content')
	@csrf
	<div class="card-footer text-sm sticky-top">
    	<a class="btn btn-sm bg-gradient-primary text-white" href="{{ route('admin.contact.edit',['man',$type]) }}" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
        <a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="{{ route('admin.contact.deleteAll', ['man', $type]) }}" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card"> 
		        <div class="card-header">
		        	<div class="form-inline col-sm-3 form-search d-inline-block align-middle ">
			            <div class="input-group input-group-sm">
							<input class="form-control form-control-navbar text-sm" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="{{ (isset($request->keyword))?$request->keyword:'' }}" onkeypress="doEnter(event,'keyword','{{ route('admin.contact.show',['man', $type]) }}')">
			                <div class="input-group-append bg-primary rounded-right">
			                    <button class="btn btn-navbar text-white" type="button" onclick="onSearch('keyword','{{ route('admin.contact.show',['man', $type]) }}')">
			                        <i class="fas fa-search"></i>
			                    </button>
			                </div>
			            </div>
			        </div>            
		        </div>
		        <div class="card-body table-responsive p-0">
		            <table class="table table-hover">
		                <thead>
		                    <tr>
								<th class="align-middle text-center">
									<div class="icheck-primary d-inline dev-check">
										<input type="checkbox" id="checkAll">
										<label for="checkAll"></label>
									</div>
								</th>

		            <th class="align-middle text-center" width="10%">STT</th>
								<th class="align-middle" style="width:20%">Họ tên</th>
								@if($type=='lienhetuvan')
								<th class="align-middle" style="width:20%">Loại tuyển dụng</th>
								@endif
								<th class="align-middle" style="width:20%">Email</th>
								@if(isset($config[$type]['showservice']) && $config[$type]['showservice'] == true)
								<th class="align-middle" style="width:20%">Service</th>
								@endif
								<th class="align-middle text-center">Duyệt</th>
		                        <th class="align-middle text-center">Thao tác</th>
		                    </tr>
		                </thead>
		                @if(empty($itemShow))
		                    <tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
		                @else
		                    <tbody>
		                        @foreach($itemShow as $k=>$v)
		                        	@php
																$user = $v['BelongUser'];																
															@endphp
		                            <tr>
										<td class="dev-item-checkbox align-middle text-center">
											<div class="icheck-primary d-inline dev-check">
						                        <input type="checkbox" class="select-checkbox" id="checkItem-{{$v['id']}}" value="{{$v['id']}}">
						                        <label for="checkItem-{{$v['id']}}"></label>
						                    </div>
										</td>
										<td class="dev-item-stt">
											<input type="number" class="form-control form-control-mini m-auto update-stt" min="0" value="{{$v['stt']}}" data-id="{{$v['id']}}" data-model="contact" data-level="man">
										</td>											
		                                <td class="align-middle">
		                                    <a class="text-dark" href="{{route('admin.contact.edit',['man',$type,$v['id']])}}" title="{{$v['tenvi']}}">{{($user) ? $user->name : $v['tenvi']}}</a>
		                                </td>
		                  @if($type=='lienhetuvan')
		                  <td class="align-middle">
                          {{$v['loaituyendung']}}
                      </td>
                      @endif

										<td class="align-middle">
		                                    <a class="text-dark" href="{{route('admin.contact.edit',['man',$type,$v['id']])}}" title="{{$v['email']}}">{{($user) ? $user->email : $v['email']}}</a>
		                                </td>

										@if(isset($config[$type]['showservice']) && $config[$type]['showservice'] == true)
										<td class="align-middle">
		                                    <a class="text-dark" title="{{$v['service']}}">{{($user) ? $user->service : $v['service']}}</a>
		                                </td>
										@endif

										<td class="align-middle text-center dev-item-display show-checkbox">
		                                	<div class="custom-control custom-checkbox my-checkbox">
		                                        <input type="checkbox" class="custom-control-input" data-model="contact" data-level="man" data-id="{{ $v['id'] }}" data-loai="hienthi" {{($v['hienthi'])?'checked':''}}>
		                                        <label for="show-checkbox-{{ $v['id'] }}" class="custom-control-label"></label>
		                                    </div>
		                                </td>

		                                <td class="align-middle text-center text-md text-nowrap">
		                                	<div class="dropdown show">
                                              <a class="btn-dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="fas fa-ellipsis-v" ></i>
                                              </a>

                                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="btn btn-sm btn-light btn-none-css btn-edit-color" href="{{route('admin.contact.edit',['man',$type,$v['id']])}}" title="Chỉnh sửa"><i class="fas fa-pencil-alt"></i> Chỉnh sửa</a>
												<a class="btn btn-sm btn-danger btn-none-css delete-item" data-url="{{route('admin.contact.delete',['man',$type,$v['id']])}}" title="Xóa"><i class="fas fa-trash-alt"></i> Xóa</a>

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
