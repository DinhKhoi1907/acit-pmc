@extends('admin.master')

@section('content')
	@csrf
	<div class="card-footer sticky-top">
		<a class="btn btn-sm bg-gradient-primary text-white" href="{{ route('admin.product.edit',['man',$type]) }}" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
		<a class="btn btn-sm bg-gradient-danger text-white ml-1" id="delete-all" data-url="{{ route('admin.product.deleteAll', ['man', $type]) }}" title="Xóa tất cả"><i class="far fa-trash-alt"></i> Xóa tất cả</a>

		@if(config('config_all.import_exel') && config('config_all.import_exel') == true  || config('config_all.export_exel') && config('config_all.export_exel') == true)
			<div class="btn dropdown pl-0 ml-1">
			  <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Thao tác
			  </button>
			  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				@if(config('config_all.import_exel') && config('config_all.import_exel') == true  && config('config_type.product')[$type]['import_excel']  && config('config_type.product')[$type]['import_excel'] == true)
					<a class="dropdown-item" href="{{ route('admin.product.exportAll',['man',$type]) }}"  title="Xuất danh sách sản phẩm"><i class="fal fa-file-excel mr-1"></i>Xuất danh sách sản phẩm</a>
				@endif
				@if(config('config_all.import_exel') && config('config_all.import_exel') == true && config('config_type.product')[$type]['export_excel']  && config('config_type.product')[$type]['export_excel'] == true)
					<a href="{{ route('admin.product.importView',['man',$type]) }}" class="dropdown-item" title="Nhập danh sách sản phẩm"><i class="fal fa-file-excel mr-1"></i>Nhập danh sách sản phẩm</a>
					<a href="{{ route('admin.product.importImages',['man',$type]) }}" class="dropdown-item" title="Nhập danh sách sản phẩm"><i class="fas fa-image"></i> Upload hình ảnh</a>
				@endif
				</div>
			</div>
		@endif
	</div>

	<div class="row">
		<div class="col-12">
			<div class="card">
              <div class="card-header">
              	<div class="row">
	                <div class="form-inline col-sm-3 form-search d-inline-block align-middle mb-2">
			            <div class="input-group input-group-sm">
			                <input class="form-control form-control-navbar text-sm" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="{{ (isset($request->keyword))?$request->keyword:'' }}" onkeypress="doEnter(event,'keyword','{{ route('admin.product.show',['man', $type]) }}')">
			                <div class="input-group-append bg-primary rounded-right">
			                    <button class="btn btn-navbar text-white" type="button" onclick="onSearch('keyword','{{ route('admin.product.show',['man', $type]) }}')">
			                        <i class="fas fa-search"></i>
			                    </button>
			                </div>
			            </div>
			        </div>
			        @if(isset($config[$type]['dropdown']) && $config[$type]['dropdown'] == true)
				        <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-6 form-filter-category">
	                    	@include('admin.layouts.category')
	                    </div>	
                    @endif		        
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
								<th class="align-middle text-center">STT</th>

								@if(isset($config[$type]['show_images']) && $config[$type]['show_images'] == true)
								<th>Hình</th>
								@endif

								<th>Tiêu đề</th>

								@if(isset($config[$type]['check']) && $config[$type]['check'] == true)
									@foreach($config[$type]['check'] as $key => $value)
										<th class="align-middle text-center">{{ $value }}</th>
									@endforeach
								@endif

								<th class="align-middle text-center">Hiển thị</th>
								<th class="text-center">Thao tác</th>
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
								<td class="dev-item-stt">
									<input type="number" class="form-control form-control-mini m-auto update-stt" min="0" value="{{$v['stt']}}" data-id="{{$v['id']}}" data-model="product" data-level="man">
								</td>

								@if(isset($config[$type]['show_images']) && $config[$type]['show_images'] == true)
								<td class="dev-item-img"><a href="{{route('admin.product.edit',['man',$type,$v['id']])}}"><img src="{{ config('config_upload.UPLOAD_PRODUCT').$v['photo'] }}" onerror=src="{{asset('img/noimage.png')}}" alt="image"></a></td>
								@endif

								<td class="dev-item-name">
									<a href="{{route('admin.product.edit',['man',$type,$v['id']])}}">
										{{$v['tenvi']}}
										<p style="margin:0"><span class="text-danger">Giá: {{Helper::Format_Money($v['gia'],0,',','.')}}đ</span>&nbsp;&nbsp;<span style='text-decoration: line-through;'>{{Helper::Format_Money($v['giacu'],0,',','.')}}đ</span></p>
									</a>
									@if(count($v->HasProductOptions)>0)
									<a class="text-primary mr-3" href="{{ route('admin.productOption.show',['man',$type,'id_product'=>$v['id']]) }}" title="Quản lý phiên bản"><i class="fas fa-copy mr-2"></i></i>Xem ({{ count($v->HasProductOptions) }}) phiên bản</a>
									@endif
									{{--
									<div class="tool-action w-clear">
                                    	@if(isset($config[$type]['view']) && $config[$type]['view'] == true)
                                    		<a class="text-primary mr-3" href="{{URL::to('/'.$v['tenkhongdauvi'])}}" target="_blank" title="{{$v['tenvi']}}"><i class="far fa-eye mr-1"></i>View</a>
                                    	@endif
                                    	<a class="text-info mr-3" href="{{route('admin.product.edit',[$request->category,$type,$v['id']])}}" title="{{$v['tenvi']}}"><i class="far fa-edit mr-1"></i>Edit</a>
                                    	<a class="text-info mr-3 text-danger delete-item" data-url="{{route('admin.product.delete',['man',$type,$v['id']])}}" title="{{$v['tenvi']}}"><i class="far fa-trash-alt mr-1"></i>Delete</a>
                                    </div>--}}
								</td>

								@if(isset($config[$type]['check']) && $config[$type]['check'] == true)
									@foreach($config[$type]['check'] as $key => $value)
										<td class="align-middle text-center dev-item-display show-checkbox">
											<div class="custom-control custom-checkbox my-checkbox">
		                                        <input type="checkbox" class="custom-control-input" data-model="product" data-level="man" data-id="{{ $v['id'] }}" data-loai="{{$key}}" {{($v[$key])?'checked':''}}>
		                                        <label for="show-checkbox-{{ $v['id'] }}" class="custom-control-label"></label>
		                                    </div>
										</td>
									@endforeach
								@endif

								<td class="align-middle text-center dev-item-display show-checkbox">
                                	<div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input" data-model="product" data-level="man" data-id="{{ $v['id'] }}" data-loai="hienthi" {{($v['hienthi'])?'checked':''}}>
                                        <label for="show-checkbox-{{ $v['id'] }}" class="custom-control-label"></label>
                                    </div>
                                </td>

                                <td class="dev-item-option align-middle text-center">
									<div class="dropdown show">
									  <a class="btn-dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									    <i class="fas fa-ellipsis-v" ></i>
									  </a>

									  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									  	@if(count($v->HasProductOptions)>0)
									  	<a class="btn btn-sm d-block btn-none-css" href="{{ route('admin.productOption.show',['man',$type,'id_product'=>$v['id']]) }}" title="Quản lý phiên bản"><i class="fas fa-copy mr-2"></i></i>Xem ({{ count($v->HasProductOptions) }}) phiên bản</a>
									  	@endif
									    <a class="btn btn-sm d-block btn-none-css" href="{{route('admin.product.edit',['man',$type,$v['id']])}}" title="Chỉnh sửa"><i class="fas fa-pencil-alt"></i> Chỉnh sửa</a>
											<a class="btn btn-sm d-block delete-item btn-none-css" data-url="{{route('admin.product.delete',['man',$type,$v['id']])}}" title="Xóa"><i class="fas fa-trash-alt"></i> Xóa</a>
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
			  <input type='hidden' name="query_str" value="{{$query_str}}" id="query_str"/>
            </div>
		</div>
	</div>
@endsection

<!--js thêm cho mỗi trang-->
@section('js_page')
	<script>
		/* Action order (Search - Export excel - Export word) */
		function actionOrder(url){
			var listid = "";
			var query_str = $("#query_str").val();
			/*var tinhtrang = parseInt($("#tinhtrang").val());
			var channel = parseInt($("#channel").val());
			var httt = parseInt($("#httt").val());
			var ngaydat = $("#ngaydat").val();
			var khoanggia = $("#khoanggia").val();
			var city = parseInt($("#id_city").val());
			var district = parseInt($("#id_district").val());
			var wards = parseInt($("#id_wards").val());
			var keyword = $("#keyword").val();*/

			$("input.select-checkbox").each(function(){
				if(this.checked) listid = listid+","+this.value;
			});
			listid = listid.substr(1);
			url += "?listid="+listid;
			/*if(tinhtrang) url += "&tinhtrang="+tinhtrang;
			if(httt) url += "&httt="+httt;
			if(channel<6) url += "&channel="+channel;
			if(ngaydat) url += "&ngaydat="+ngaydat;
			if(khoanggia) url += "&khoanggia="+khoanggia;
			if(city) url += "&city="+city;
			if(district) url += "&district="+district;
			if(wards) url += "&wards="+wards;
			if(keyword) url += "&keyword="+encodeURI(keyword);*/
			window.location = url+query_str;
		}
	</script>
@endsection
