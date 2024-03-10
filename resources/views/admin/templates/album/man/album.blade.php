@extends('admin.master')

@section('content')	
	@csrf
	<div class="card-footer sticky-top">
		<a class="text-white btn btn-sm bg-gradient-primary" href="{{ route('admin.album.edit',['man',$type]) }}" title="Thêm mới"><i class="mr-2 fas fa-plus"></i>Thêm mới</a>
		<a class="text-white btn btn-sm bg-gradient-danger" id="delete-all" data-url="{{ route('admin.album.deleteAll', ['man', $type]) }}" title="Xóa tất cả"><i class="mr-2 far fa-trash-alt"></i>Xóa tất cả</a>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="card">
        <div class="card-header">
        	<div class="row">
	          <div class="mb-2 align-middle form-inline col-sm-3 form-search d-inline-block">
			          <div class="input-group input-group-sm">
			              <input class="text-sm form-control form-control-navbar" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="{{ (isset($request->keyword))?$request->keyword:'' }}" onkeypress="doEnter(event,'keyword','{{ route('admin.album.show',['man', $type]) }}')">
			              <div class="input-group-append bg-primary rounded-right">
			                  <button class="text-white btn btn-navbar" type="button" onclick="onSearch('keyword','{{ route('admin.album.show',['man', $type]) }}')">
			                      <i class="fas fa-search"></i>
			                  </button>
			              </div>
			          </div>
			      </div>
			      {{-- <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-6 form-filter-category">
                	@include('admin.layouts.category')
                  </div> --}}
			     </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
				<div class="row">
				   <div class="col-sm-12">
				      <table class="table table-hover text-nowrap">
				         <thead>
				            <tr>
								<th class="text-center align-middle">
									<div class="icheck-primary d-inline dev-check">
				                        <input type="checkbox" id="checkAll">
				                        <label for="checkAll"></label>
				                    </div>
								</th>
								<th class="text-center align-middle">STT</th>

								@if(isset($config[$type]['show_images']) && $config[$type]['show_images'] == true)
								<th>Hình</th>
								@endif

								<th>Tiêu đề</th>

								@if(isset($config[$type]['check']) && $config[$type]['check'] == true)
									@foreach($config[$type]['check'] as $key => $value)
										@php
											TableManipulation::AddFieldToTable('album',$key);
										@endphp
										<th class="text-center align-middle">{{ $value }}</th>
									@endforeach
								@endif

								<th class="text-center align-middle">Hiển thị</th>
								<th class="text-center">Thao tác</th>
				            </tr>
				         </thead>
				         <tbody>
				         	@foreach($itemShow as $k=>$v)
				            <tr>
								<td class="text-center align-middle dev-item-checkbox">
									<div class="icheck-primary d-inline dev-check">
				                        <input type="checkbox" class="select-checkbox" id="checkItem-{{$v['id']}}" value="<?=$v['id']?>">
				                        <label for="checkItem-{{$v['id']}}"></label>
				                    </div>
								</td>
								<td class="dev-item-stt">
									<input type="number" class="m-auto form-control form-control-mini update-stt" min="0" value="{{$v['stt']}}" data-id="{{$v['id']}}" data-model="album" data-level="man">
								</td>

								@if(isset($config[$type]['show_images']) && $config[$type]['show_images'] == true)
									@php
			   							$path_upload = (config('config_all.fileupload')) ? config('config_upload.UPLOAD_GALLERY') : config('config_upload.UPLOAD_ALBUM');
			   						@endphp
									<td class="dev-item-img"><a href="{{route('admin.album.edit',['man',$type,$v['id']])}}"><img src="{{ $path_upload.$v['photo'] }}" onerror=src="{{asset('img/noimage.png')}}" alt="image"></a></td>
								@endif

								<td class="dev-item-name">
									<a href="{{route('admin.album.edit',['man',$type,$v['id']])}}"><span class="text-danger">{{($v['draft']==1) ? '[Bản nháp] ' : '' }}</span>{{$v['tenvi']}}</a>
									{{--
									<div class="mt-2 tool-action w-clear">
                                    	@if(isset($config[$type]['view']) && $config[$type]['view'] == true)
                                    		<a class="mr-3 text-primary" href="{{URL::to('/'.$v['tenkhongdauvi'])}}" target="_blank" title="{{$v['tenvi']}}"><i class="mr-1 far fa-eye"></i>View</a>
                                    	@endif
                                    	<a class="mr-3 text-info" href="{{route('admin.album.edit',[$request->category,$type,$v['id']])}}" title="{{$v['tenvi']}}"><i class="mr-1 far fa-edit"></i>Edit</a>
                                    	<a class="mr-3 text-info text-danger delete-item" data-url="{{route('admin.album.delete',['man',$type,$v['id']])}}" title="{{$v['tenvi']}}"><i class="mr-1 far fa-trash-alt"></i>Delete</a>
                                    </div>--}}
								</td>

								@if(isset($config[$type]['check']) && $config[$type]['check'] == true)
									@foreach($config[$type]['check'] as $key => $value)
										<td class="text-center align-middle dev-item-display show-checkbox">
											<div class="custom-control custom-checkbox my-checkbox">
		                                        <input type="checkbox" class="custom-control-input" data-model="album" data-level="man" data-id="{{ $v['id'] }}" data-loai="{{$key}}" {{($v[$key])?'checked':''}}>
		                                        <label for="show-checkbox-{{ $v['id'] }}" class="custom-control-label"></label>
		                                    </div>
										</td>
									@endforeach
								@endif

								<td class="text-center align-middle dev-item-display show-checkbox">
                                	<div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input" data-model="album" data-level="man" data-id="{{ $v['id'] }}" data-loai="hienthi" {{($v['hienthi'])?'checked':''}}>
                                        <label for="show-checkbox-{{ $v['id'] }}" class="custom-control-label"></label>
                                    </div>
                                </td>

                                <td class="text-center align-middle dev-item-option">
									<div class="dropdown show">
									  <a class="btn-dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									    <i class="fas fa-ellipsis-v" ></i>
									  </a>

									  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									    <a class="btn btn-sm d-block btn-none-css" href="{{route('admin.album.edit',['man',$type,$v['id']])}}" title="Chỉnh sửa"><i class="mr-2 fas fa-pencil-alt"></i> Chỉnh sửa</a>
											<a class="btn btn-sm d-block delete-item btn-none-css" data-url="{{route('admin.album.delete',['man',$type,$v['id']])}}" title="Xóa"><i class="mr-2 fas fa-trash-alt"></i> Xóa</a>
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
              <!-- /.card-body -->
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

@endsection
