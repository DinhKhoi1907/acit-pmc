@extends('admin.master')

@section('content')
	@csrf
	<div class="card-footer sticky-top">
		<a class="text-white btn btn-sm bg-gradient-primary" href="{{ route('admin.productOption.edit',['man',$type,'id_product'=>$idParent]) }}" title="Thêm mới"><i class="mr-2 fas fa-plus"></i>Thêm mới</a>
		<a class="text-white btn btn-sm bg-gradient-danger" id="delete-all" data-url="{{ route('admin.productOption.deleteAll', ['man', $type, 'id_product'=>$idParent]) }}" title="Xóa tất cả"><i class="mr-2 far fa-trash-alt"></i>Xóa tất cả</a>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="card">
              <div class="card-header">
              	<div class="row">
	                <div class="mb-2 align-middle form-inline col-sm-3 form-search d-inline-block">
			            <div class="input-group input-group-sm">
			                <input class="text-sm form-control form-control-navbar" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="{{ (isset($request->keyword))?$request->keyword:'' }}" onkeypress="doEnter(event,'keyword','{{ route('admin.productOption.show',['man', $type]) }}')">
			                <div class="input-group-append bg-primary rounded-right">
			                    <button class="text-white btn btn-navbar" type="button" onclick="onSearch('keyword','{{ route('admin.productOption.show',['man', $type]) }}')">
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
								@if(config('config_all.order.soluong') || config('lazada.active'))
								<th class="text-center align-middle">Số lượng</th>
								@endif
								@if(isset($config[$type]['mau']) && $config[$type]['mau'] == true)
								<th class="text-center align-middle">Màu sắc</th>
								@endif
                        		<th class="text-center align-middle">Size</th>
								<th class="text-center align-middle">Hiển thị</th>
								<th class="text-center">Thao tác</th>
				            </tr>
				         </thead>
				         <tbody>
				         	@foreach($itemShow as $k=>$v)
				            <tr>
								<td class="text-center align-middle dev-item-checkbox">
									<div class="icheck-primary d-inline dev-check">
				                        <input type="checkbox" class="select-checkbox" id="checkItem-{{$v['id']}}" value="{{$v['id']}}">
				                        <label for="checkItem-{{$v['id']}}"></label>
				                    </div>
								</td>
								<td class="dev-item-stt">
									<input type="number" class="m-auto form-control form-control-mini update-stt" min="0" value="{{$v['stt']}}" data-id="{{$v['id']}}" data-model="productOption" data-level="man">
								</td>

								@if(isset($config[$type]['show_images']) && $config[$type]['show_images'] == true)
									@php
			   							$path_upload = (config('config_all.fileupload')) ? config('config_upload.UPLOAD_GALLERY') : config('config_upload.UPLOAD_PRODUCT');
			   						@endphp
									<td class="dev-item-img"><a href="{{route('admin.productOption.edit',['man',$type,$v['id']])}}"><img src="{{ $path_upload.$v['photo'] }}" onerror=src="{{asset('img/noimage.png')}}" alt="image"></a></td>
								@endif

								<td class="dev-item-name">
									<a href="{{route('admin.productOption.edit',['man',$type,$v['id']])}}">
										{{$v['tenvi']}}
										<p style="margin:0">
											<span class="text-danger">Giá: {!! ($v['giamoi']>0) ? Helper::Format_Money($v['giamoi']) : (($v['gia']>0) ? Helper::Format_Money($v['gia']) : 'Liên hệ' ) !!}</span>
											@if($v['giamoi']>0)<span class="ml-2" style="color:#999;text-decoration: line-through;">{!! Helper::Format_Money($v['gia'],0,',','.') !!}đ</span>@endif
										</p>
									</a>
									<p style="font-size:13px;color:#999;">Mã SP: {{$v['masp']}}</p>
								</td>

								@if(config('config_all.order.soluong') || config('lazada.active'))
								<td class="text-center align-middle">
									<div><span class="text-danger">Website: {{ $v->soluong_website}}</span></div>
									<div><span class="text-success">Lazada: {{ $v->soluong_lazada }}</span></div>
									<div><span class="text-info">Shopee: {{ $v->soluong_shopee }}</span></div>
								</td>
								@endif

								@if(isset($config[$type]['mau']) && $config[$type]['mau'] == true)
								<td class="text-center align-middle">{{ (isset($v->ColorOption->tenvi)) ? $v->ColorOption->tenvi : '' }}</td>
								@endif
								
								<td class="text-center align-middle">{{ (isset($v->SizeOption->tenvi)) ? $v->SizeOption->tenvi : '' }}</td>

								<td class="text-center align-middle dev-item-display show-checkbox">
                                	<div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input" data-model="productOption" data-level="man" data-id="{{ $v['id'] }}" data-loai="hienthi" {{($v['hienthi'])?'checked':''}}>
                                        <label for="show-checkbox-{{ $v['id'] }}" class="custom-control-label"></label>
                                    </div>
                                </td>

                                <td class="text-center align-middle dev-item-option">
									<div class="dropdown show">
									  <a class="btn-dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									    <i class="fas fa-ellipsis-v" ></i>
									  </a>

									  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">									  	
									    <a class="btn btn-sm d-block btn-none-css" href="{{route('admin.productOption.edit',['man',$type,$v['id']])}}" title="Chỉnh sửa"><i class="fas fa-pencil-alt"></i> Chỉnh sửa</a>
											<a class="btn btn-sm d-block delete-item btn-none-css" data-url="{{route('admin.productOption.delete',['man',$type,$v['id'],'id_product'=>$idParent])}}" title="Xóa"><i class="fas fa-trash-alt"></i> Xóa</a>
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
