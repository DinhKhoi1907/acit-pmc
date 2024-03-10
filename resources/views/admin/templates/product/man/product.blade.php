@extends('admin.master')



@section('content')

	@csrf

	<div class="card-footer sticky-top">

		<a class="text-white btn btn-sm bg-gradient-primary" href="{{ route('admin.product.edit',['man',$type]) }}" title="Thêm mới"><i class="mr-2 fas fa-plus"></i>Thêm mới</a>

		<a class="ml-1 text-white btn btn-sm bg-gradient-danger" id="delete-all" data-url="{{ route('admin.product.deleteAll', ['man', $type]) }}" title="Xóa tất cả"><i class="far fa-trash-alt"></i> Xóa tất cả</a>



		@if(config('config_all.import_exel') && config('config_all.import_exel') == true  || config('config_all.export_exel') && config('config_all.export_exel') == true)

			<div class="pl-0 ml-1 btn dropdown">

			  <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

			    Thao tác

			  </button>

			  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

				@if(config('config_all.import_exel') && config('config_all.import_exel') == true  && config('config_type.product')[$type]['import_excel']  && config('config_type.product')[$type]['import_excel'] == true)

					<a class="dropdown-item" href="{{ route('admin.product.exportAll',['man',$type]) }}"  title="Xuất danh sách sản phẩm"><i class="mr-1 fal fa-file-excel"></i>Xuất danh sách sản phẩm</a>

				@endif

				@if(config('config_all.import_exel') && config('config_all.import_exel') == true && config('config_type.product')[$type]['export_excel']  && config('config_type.product')[$type]['export_excel'] == true)

					<a href="{{ route('admin.product.importView',['man',$type]) }}" class="dropdown-item" title="Nhập danh sách sản phẩm"><i class="mr-1 fal fa-file-excel"></i>Nhập danh sách sản phẩm</a>

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

              		<div class="icheck-primary d-inline dev-check miko-product-check miko-product-check-all">

                        <input type="checkbox" id="checkAllProduct">

                        <label for="checkAllProduct"></label>

                    </div>

	                <div class="mb-2 ml-5 form-inline col-sm-3 form-search d-inline">

			            <div class="input-group input-group-sm">

			                <input class="text-sm form-control form-control-navbar" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="{{ (isset($request->keyword))?$request->keyword:'' }}" onkeypress="doEnter(event,'keyword','{{ route('admin.product.show',['man', $type]) }}')">

			                <div class="input-group-append bg-primary rounded-right">

			                    <button class="text-white btn btn-navbar" type="button" onclick="onSearch('keyword','{{ route('admin.product.show',['man', $type]) }}')">

			                        <i class="fas fa-search"></i>

			                    </button>

			                </div>

			            </div>

			        </div>

			        <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-6 form-filter-category">

                    	{{-- @include('admin.layouts.filtermax_category') --}}

                    </div>	

                    {{-- <div class="form-group col-xl-2 col-lg-2 col-md-6 col-sm-6 form-product-layout">

                    	<a class="miko-product-grid-btn" data-class="miko-products-line" data-type="add"><svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M2 23h-2v-2h2v2zm0-12h-2v2h2v-2zm0 5h-2v2h2v-2zm0-15h-2v2h2v-2zm2 0v2h20v-2h-20zm-2 5h-2v2h2v-2zm2 7h20v-2h-20v2zm0 10h20v-2h-20v2zm0-15h20v-2h-20v2zm0 10h20v-2h-20v2z"/></svg></a>

                    	<a class="miko-product-grid-btn" data-class="miko-products-line" data-type="remove"><svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M6 6h-6v-6h6v6zm9-6h-6v6h6v-6zm9 0h-6v6h6v-6zm-18 9h-6v6h6v-6zm9 0h-6v6h6v-6zm9 0h-6v6h6v-6zm-18 9h-6v6h6v-6zm9 0h-6v6h6v-6zm9 0h-6v6h6v-6z"/></svg></a>

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



								<th>Thuộc</th>



								@if(isset($config[$type]['check']) && $config[$type]['check'] == true)

									@foreach($config[$type]['check'] as $key => $value)

										<th class="text-center align-middle">{{ $value }}</th>

									@endforeach

								@endif



								<th class="text-center align-middle">Hiển thị</th>

								<th class="text-center">Thao tác</th>

				            </tr>

				         </thead>

				         <tbody>

				         	@foreach($itemShow as $k=>$v)

				         	@php

				         		$parent = $v['CategoryParent'];

				         	@endphp

				            <tr>

								<td class="text-center align-middle dev-item-checkbox">

									<div class="icheck-primary d-inline dev-check">

				                        <input type="checkbox" class="select-checkbox" id="checkItem-{{$v['id']}}" value="{{$v['id']}}">

				                        <label for="checkItem-{{$v['id']}}"></label>

				                    </div>

								</td>

								<td class="dev-item-stt">

									<input type="number" class="m-auto form-control form-control-mini update-stt" min="0" value="{{$v['stt']}}" data-id="{{$v['id']}}" data-model="product" data-level="man">

								</td>



								@if(isset($config[$type]['show_images']) && $config[$type]['show_images'] == true)

								<td class="dev-item-img"><a href="{{route('admin.product.edit',['man',$type,$v['id']])}}"><img src="{{ config('config_upload.UPLOAD_PRODUCT').$v['photo'] }}" onerror=src="{{asset('img/noimage.png')}}" alt="image"></a></td>

								@endif



								<td class="dev-item-name">

									<a href="{{route('admin.product.edit',['man',$type,$v['id']])}}">

										<span class="text-danger">{{($v['draft']==1) ? '[Bản nháp] ' : '' }}</span> {{$v['tenvi']}}

										<p style="margin:0">

											<span class="text-danger">Giá: {!! ($v['giamoi']>0) ? Helper::Format_Money($v['giamoi']) : (($v['gia']>0) ? Helper::Format_Money($v['gia']) : 'Liên hệ' ) !!}</span>

											@if($v['giamoi']>0)<span class="ml-2" style="color:#999;text-decoration: line-through;">{{Helper::Format_Money($v['gia'],0,',','.')}}đ</span>@endif

										</p>

									</a>

									{{-- <a href="{{route('admin.product.edit',['man',$type,$v['id']])}}">

										{{$v['tenvi']}}

										<p style="margin:0"><span class="text-danger">Giá: {{Helper::Format_Money($v['gia'],0,',','.')}}đ</span>&nbsp;&nbsp;<span style='text-decoration: line-through;'>{{Helper::Format_Money($v['giacu'],0,',','.')}}đ</span></p>

									</a>

									@if(count($v->HasProductOptions)>0)

									<a class="mr-3 text-primary" href="{{ route('admin.productOption.show',['man',$type,'id_product'=>$v['id']]) }}" title="Quản lý phiên bản"><i class="mr-2 fas fa-copy"></i></i>Xem ({{ count($v->HasProductOptions) }}) phiên bản</a>

									@endif --}}

								</td>



								<td class="dev-item-name"><a>{{($parent) ? $parent['ten'.$lang] : ''}}</a></td>



								@if(isset($config[$type]['check']) && $config[$type]['check'] == true)

									@foreach($config[$type]['check'] as $key => $value)

										<td class="text-center align-middle dev-item-display show-checkbox">

											<div class="custom-control custom-checkbox my-checkbox">

		                                        <input type="checkbox" class="custom-control-input" data-model="product" data-level="man" data-id="{{ $v['id'] }}" data-loai="{{$key}}" {{($v[$key])?'checked':''}}>

		                                        <label for="show-checkbox-{{ $v['id'] }}" class="custom-control-label"></label>

		                                    </div>

										</td>

									@endforeach

								@endif



								<td class="text-center align-middle dev-item-display show-checkbox">

                                	<div class="custom-control custom-checkbox my-checkbox">

                                        <input type="checkbox" class="custom-control-input" data-model="product" data-level="man" data-id="{{ $v['id'] }}" data-loai="hienthi" {{($v['hienthi'])?'checked':''}}>

                                        <label for="show-checkbox-{{ $v['id'] }}" class="custom-control-label"></label>

                                    </div>

                                </td>



                                <td class="text-center align-middle dev-item-option">

									<div class="dropdown show">

									  <a class="btn-dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">

									    <i class="fas fa-ellipsis-v" ></i>

									  </a>



									  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

									  	@if(count($v->HasProductOptions)>0)

									  	<a class="btn btn-sm d-block btn-none-css" href="{{ route('admin.productOption.show',['man',$type,'id_product'=>$v['id']]) }}" title="Quản lý phiên bản"><i class="mr-2 fas fa-copy"></i></i>Xem ({{ count($v->HasProductOptions) }}) phiên bản</a>

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

