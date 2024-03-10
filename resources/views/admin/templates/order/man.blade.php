@extends('admin.master')

@section('content')
	@csrf
	<div class="card-footer sticky-top">
		{{--<a class="text-white btn btn-sm bg-gradient-primary" href="{{ route('admin.order.create',['man']) }}" title="Tạo đơn"><i class="mr-2 fas fa-plus"></i>Tạo đơn</a>--}}
		<a class="text-white btn btn-sm bg-gradient-danger" id="delete-all" data-url="{{ route('admin.order.deleteAll', ['man']) }}" title="Xóa tất cả"><i class="mr-2 far fa-trash-alt"></i>Xóa tất cả</a>
		@if(config('config_all.order.export_excel') && config('config_all.order.export_excel') == true)
			<button type="button" onclick="actionOrder('{{ route('admin.order.exportAll',['man']) }}')" class="ml-2 text-white btn btn-sm btn-info btn-export-excel" title="Xuất đơn hàng Excel"><i class="mr-1 fal fa-file-excel"></i>Xuất đơn hàng Excel</button>
		@endif	
		{{-- <div class="pl-0 ml-1 btn dropdown">
		  <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Thao tác
		  </button>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
			<a class="btn btn-sm bg-gradient-info btn-none-css" href="{{ route('admin.order.import',['man']) }}" title=""><i class="text-sm nav-icon fas fa-layer-group" target="_blank"></i> Nhập đơn hàng</a>
		  </div>
		</div> --}}
	</div>

	<div class="row">
		<div class="col-12">
		    <!-- tab -->
    		@include('admin.layouts.tab_order')

			<div class="card miko-card">
              <div class="card-header">	
              	<!-- Error -->
    			@include('admin.layouts.filter_order')
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

								<th>Họ tên</th>
								<th class="text-center">Ngày đặt</th>
								<th class="text-center">Tổng giá</th>
								<th class="text-center">Tình trạng</th>
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
									<input type="number" class="m-auto form-control form-control-mini update-stt" min="0" value="{{$v['stt']}}" data-id="{{$v['id']}}" data-model="order" data-level="list">
								</td>

								<td class="dev-item-name">
									<a class="text-info" href="{{route('admin.order.edit',['man',$v['id']])}}">
										<b>{{$v['hoten']}}</b>
									</a>
									<div>{{$v['madonhang']}}</div>
									<p class="text-danger"><i class="mr-1 fal fa-phone-alt"></i> {{$v['dienthoai']}}</p>
									{{-- <span class="text-{{config('config_all.channel')[$v['channel']]['color']}} font-weight-bold">{{config('config_all.channel')[$v['channel']]['name']}}</span> --}}
								</td>
								<td class="text-center dev-item-name"><div>{{date('h:m', $v['ngaytao'])}}</div>{{date('d-m-Y', $v['ngaytao'])}}</td>
								<td class="text-center dev-item-name"><span class="text-danger font-weight-bold">{{ number_format($v['tonggia'],0,',','.') }}đ</span></td>
								<td class="text-center dev-item-name">
									<p class="mb-0"><span class="badge badge-{{ config('config_all.order_status')[$v['tinhtrang']]['color'] }}">{{ config('config_all.order_status')[$v['tinhtrang']]['name'] }}</span></p>
									<p class="mb-0">
										<span class="badge {{$v['status_payments']==3 ? 'badge-danger':'badge-success' }}">
											{{$v['status_payments']==0 ? 'Chưa thanh toán':'' }}
											{{$v['status_payments']==1 ? 'Đã thanh toán':'' }}
											{{$v['status_payments']==2 ? 'Hủy/ Chưa thanh toán':'' }}
											{{$v['status_payments']==3 ? 'Không thành công':'' }}
										</span></p>
								</td>

								<td class="text-center align-middle dev-item-option">
									<div class="dropdown show">
									  <a class="btn-dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									    <i class="fas fa-ellipsis-v" ></i>
									  </a>

									  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									    <a class="btn btn-sm d-block btn-none-css" target="blank" href="{{route('admin.order.print',['man', 'id'=>$v['id']])}}" title="In đơn hàng"><i class="mr-2 far fa-print"></i> In đơn hàng</a>
									    <a class="btn btn-sm d-block btn-none-css" href="{{route('admin.order.edit',['man',$v['id']])}}" title="Chỉnh sửa"><i class="mr-2 fas fa-pencil-alt"></i> Chỉnh sửa</a>
										<a class="btn btn-sm d-block delete-item btn-none-css" data-url="{{route('admin.order.delete',['man',$v['id']])}}" title="Xóa"><i class="mr-2 fas fa-trash-alt"></i> Xóa</a>
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

			  <input type='hidden' name="query_str" value="{{$query_str}}" id="query_str"/>
            </div>
		</div>
	</div>
@endsection

<!--js thêm cho mỗi trang-->
@section('js_page')
	<script>
		function doSearch(evt,obj,url){
			if(url==''){
				notifyDialog("Đường dẫn không hợp lệ");
		        return false;
			}
		    if(evt.keyCode == 13 || evt.which == 13) onSearch(obj,url);
			actionOrder(url);
		}
		/* Action order (Search - Export excel - Export word) */
		function actionOrder(url){
			var listid = "";
			var query_str = $("#query_str").val();
			var tinhtrang = parseInt($("#tinhtrang").val());
			var channel = parseInt($("#channel").val());
			var httt = parseInt($("#httt").val());
			var ngaydat = $("#ngaydat").val();
			var khoanggia = $("#khoanggia").val();
			var city = parseInt($("#id_city").val());
			var district = parseInt($("#id_district").val());
			var wards = parseInt($("#id_wards").val());
			var loaifilexuat = parseInt($("#loaifilexuat").val());
			var keyword = $("#keyword").val();

			$("input.select-checkbox").each(function(){
				if(this.checked) listid = listid+","+this.value;
			});
			listid = listid.substr(1);
			url += "?listid="+listid;
			url += "&loaifilexuat="+loaifilexuat;
			if(tinhtrang) url += "&tinhtrang="+tinhtrang;
			if(httt) url += "&httt="+httt;
			if(channel<6) url += "&channel="+channel;
			if(ngaydat) url += "&ngaydat="+ngaydat;
			if(khoanggia) url += "&khoanggia="+khoanggia;
			if(city) url += "&city="+city;
			if(district) url += "&district="+district;
			if(wards) url += "&wards="+wards;
			if(keyword) url += "&keyword="+encodeURI(keyword);
			window.location = url;
		}

		$(document).ready(function(){
			$('#ngaydat').daterangepicker({
                callback: this.render,
                autoUpdateInput: false,
                timePicker: false,
                timePickerIncrement: 30,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            })
            $('#ngaydat').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' | ' + picker.endDate.format('YYYY-MM-DD'));
            });
            $('#ngaydat').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD'));
            });

            /* rangeSlider */
            $('#khoanggia').ionRangeSlider({
                skin: "flat",
                min     : {{($minTotal>0)?$minTotal:1}},
                max     : {{($maxTotal>0)?$maxTotal:1}},
                from    : {{($giatu)?$giatu:1}},
                to      : {{($giaden)?$giaden:$maxTotal}},
                type    : 'double',
                step    : 1,
                postfix : ' đ',
                prettify: true,
                hasGrid : true
            })
            $('body').on("click", ".js-load-order-detail", function(){
                let id = $(this).attr('data-id');
                $('#order-detail-'+id).slideToggle();
            })
		});
	</script>
@endsection
