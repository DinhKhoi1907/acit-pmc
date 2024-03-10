@extends('admin.master')

@section('content')
	@csrf
	<div class="card-footer sticky-top">
		<a class="btn btn-sm bg-gradient-primary text-white" href="{{ route('admin.lang.edit') }}" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
		<a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="{{ route('admin.lang.deleteAll') }}" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>		

		<div class="btn dropdown pl-0 ml-0">
		  <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Chức năng
		  </button>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" href="{{ route('admin.lang.export') }}"  title="Xuất excel ngôn ngữ"><i class="fal fa-file-excel mr-1"></i>Xuất excel ngôn ngữ</a>
				<a href="{{ route('admin.lang.importView') }}" class="dropdown-item" title="Nhập excel ngôn ngữ"><i class="fal fa-file-excel mr-1"></i>Nhập excel ngôn ngữ</a>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="card">
              <div class="card-header">
                <div class="row">
                	<div class="form-inline col-sm-3 form-search d-inline-block align-middle mb-2">
			          	<div class="input-group input-group-sm">
			              	<input class="form-control form-control-navbar text-sm" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="{{ (isset($request->keyword))?$request->keyword:'' }}" onkeypress="doEnter(event,'keyword','{{ route('admin.lang.show') }}')">
			              	<div class="input-group-append bg-primary rounded-right">
			                  	<button class="btn btn-navbar text-white" type="button" onclick="onSearch('keyword','{{ route('admin.lang.show') }}')">
			                      	<i class="fas fa-search"></i>
			                  	</button>
			              	</div>
			          	</div>
			      	</div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
				<div class="row">
				   <div class="col-sm-12">
				      <table class="table table-hover text-nowrap">
				         <thead>
				            <tr>
								<th class="align-middle text-center">
									<div class="icheck-primary d-inline dev-check">
				                        <input type="checkbox" id="checkAll">
				                        <label for="checkAll"></label>
				                    </div>
								</th>
								<th>Từ khóa</th>

                                @foreach(config('config_all.lang') as $k=>$v)
                                <th>{{$v}}</th>
                                @endforeach

								<th class="align-middle text-center">Thao tác</th>
				            </tr>
				         </thead>
				         <tbody>
				         	@foreach($itemShow as $k=>$v)
				            <tr>
								<td class="dev-item-checkbox align-middle text-center">
									<div class="icheck-primary d-inline dev-check">
				                        <input type="checkbox" class="select-checkbox" id="checkItem-{{$v['id']}}" value="{{$v['id']}}">
				                        <label for="checkItem-{{$v['id']}}"></label>
				                    </div>
								</td>

								<td class="dev-item-name"><a href="{{route('admin.lang.edit',[$v['id']])}}" class="text-info">{{$v['giatri']}}</a></td>

                                @foreach(config('config_all.lang') as $key=>$value)
                                <td class="dev-item-name"><a href="{{route('admin.lang.edit',[$v['id']])}}">{{$v['lang'.$key]}}</a></td>
                                @endforeach

								<td class="dev-item-option align-middle text-center">
									<div class="dropdown show">
									  	<a class="btn-dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									    	<i class="fas fa-ellipsis-v" ></i>
									  	</a>

									  	<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									    	<a class="btn btn-sm d-block btn-none-css" href="{{route('admin.lang.edit',[$v['id']])}}" title="Chỉnh sửa"><i class="fas fa-pencil-alt"></i> Chỉnh sửa</a>
											<a class="btn btn-sm d-block delete-item btn-none-css" data-url="{{route('admin.lang.delete',[$v['id']])}}" title="Xóa"><i class="fas fa-trash-alt"></i> Xóa</a>
									  	</div>
									</div>
								</td>
				            </tr>
				            @endforeach
				         </tbody>
				      </table>
				   </div>
				</div>
              </div>
              <!-- /.card-footer -->
              <div class="card-footer">
              	<div class="row">
				   <div class="col-sm-12 dev-center dev-paginator">{{ $itemShow->links() }}</div>
				</div>				
              </div>
            </div>
		</div>
	</div>
@endsection

@push('css')
	
@endpush

<!--js thêm cho mỗi trang-->
@section('js_page')

@endsection
