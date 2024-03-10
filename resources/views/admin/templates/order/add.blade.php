@extends('admin.master')



@section('content')

<form class="validation-form" novalidate method="post" action="{{route('admin.order.save',['man'])}}" enctype="multipart/form-data">

	@csrf

	<div class="bg-white shadow-sm sticky-top d-flex justify-content-between align-items-center">

		<div class="p-2 d-flex align-items-center">

			<div class="px-2 py-1 mr-2 text-white rounded bg-primary d-flex flex-column" style="background: rgba(38, 185, 154, 1) !important;">

				<b>Mã đơn hàng</b>

				<span class="font-weight-bold">{{$rowItem['madonhang']}}</span>

			</div>

			{{--

			<div class="px-2 py-1 mr-2 rounded bg-light d-flex flex-column">

				<b>Kênh bán hàng</b>

				<span class="text-{{ config('config_all.channel')[$rowItem['channel']]['color'] }}">{{ config('config_all.channel')[$rowItem['channel']]['name'] }}</span>

			</div>--}}

			<div class="px-2 py-1 mr-2 rounded bg-light d-flex flex-column">

				<b>Thanh toán</b>

				<span class="text-{{ config('config_all.payment_status')[$rowItem['status_payments']]['color'] }} ">{{ config('config_all.payment_status')[$rowItem['status_payments']]['name'] }}</span>

			</div>

			<div class="px-2 py-1 mr-2 rounded bg-light d-flex flex-column">

				<b>Tình trạng</b>

				<span class="text-{{ config('config_all.delivery_status')[$rowItem['tinhtrang']]['color'] }} ">{{ config('config_all.delivery_status')[$rowItem['tinhtrang']]['name'] }}</span>

			</div>

		</div>

		<div class="p-2 d-flex align-items-center">

			<a class="ml-1 btn btn-sm btn-light" target="blank" href="{{route('admin.order.print',['man', 'id'=>$rowItem['id']])}}" title="In đơn hàng"><i class="far fa-print"></i> In</a>

			@if($rowItem['channel']!=2 && $rowItem['channel']!=3)
			<button type="submit" class="btn btn-sm bg-gradient-success submit-check" name="savehere"><i class="mr-2 far fa-save"></i>Cập nhật</button>
			@endif
			
			<input type="hidden" name="id" value="{{$rowItem['id']}}">

		</div>

	</div>

	<div class="mt-3 row">

		<div class="col-md-12">

			<div class="card">

				<div class="card-header">

					<h6 class="m-0 font-weight-bold">Thông tin khách hàng</h6>

				</div>

				<div class="card-body">

					<div class="row">

						<div class="form-group col-md-4">

							<label>Họ và tên:</label>

							<input type="text" class="form-control" name="data[hoten]" {{$rowItem['channel']==2 ? 'readonly':''}} value="{{$rowItem['hoten']}}">

						</div>

						<div class="form-group col-md-4">

							<label>Điện thoại:</label>

							<input type="text" class="form-control" name="data[dienthoai]" {{$rowItem['channel']==2 ? 'readonly':''}} value="{{$rowItem['dienthoai']}}">

						</div>

						<div class="form-group col-md-4">

							<label>Email:</label>

							<input type="text" class="form-control" name="data[email]" {{$rowItem['channel']==2 ? 'readonly':''}} value="{{$rowItem['email']}}">

						</div>

					</div>

					<div class="form-group">

						<label>Địa chỉ:</label>

						<textarea class="form-control" name="data[diachi]" {{$rowItem['channel']==2 ? 'readonly':''}} rows="3">{{$rowItem['diachi']}}</textarea>

					</div>

					<div class="form-group">
						<label>Xác minh thanh toán:</label>
						<div>
							<img src="{{UPLOAD_FILE.$rowItem['photo']}}" style="max-width:100%" alt="">
						</div>
					</div>

					@if(config('config_all.order.ship') && config('config_all.order.ship') == true)

						<div class="form-group">

							<label>Phí vận chuyển:</label>

							<input type="text" class="form-control format-price" {{$rowItem['channel']==2 ? 'readonly':''}} name="data[phiship]" value="{{$rowItem['phiship']}}">

						</div>

					@endif

					@if($rowItem['yeucaukhac'] != '')

						<div class="form-group">

							<label>Yêu cầu của khách:</label>

							<p class="text-danger">{{$rowItem['yeucaukhac']}}</p>

						</div>

					@endif

				</div>

			</div>

		</div>

		<div class="col-md-12">

			<div class="mb-3 bg-white shadow-sm">

				<h6 class="p-3 m-0 font-weight-bold">Thông tin sản phẩm</h6>

				<div class="px-3 table-responsive">

					<table class="table table-hover">

						<thead>

							<tr>

								<th class="align-middle" style="width:50%">Tên sản phẩm</th>

								<th class="text-center align-middle">Đơn giá</th>

								<th class="text-center align-middle" width="82px">Số lượng</th>

								<th class="text-right align-middle">Tạm tính</th>

							</tr>

						</thead>

						@if($ordersDetail)

							<tbody>

								@php

									$total_product = 0;

								@endphp

								@foreach($ordersDetail as $k => $v)

									@php


									@endphp

									<tr>

										<td class="px-0 align-middle">

										    <div class="d-flex">

										        <a title="{{$v['ten']}}"><img class="rounded img-preview" onerror=src="{{asset('img/noimage.png')}}" src="{{ Helper::GetFolder($folder_upload,true).$v['photo'] }}" alt="{{$v['ten']}}"></a>

										        <div class="pl-2">

										            <p class="mb-1 text-primary">{{$v['ten']}}</p>

										            @if($v['mau']!='' || $v['size']!='')

										                <p class="mb-0">

										                    @if($v['mau']!=0)

										                        <span class="pr-2">Màu: {{$v['mau']}}</span>

										                    @endif

										                    @if($v['size']!=0)

										                        <span class="pr-2">Kích cỡ: {{$v['size']}}</span>

										                    @endif

										                </p>

										            @endif

										        </div>

										    </div>

										</td>

										<td class="text-center align-middle">

										    <div class="price-cart-detail">

										        @if($v['gia'] && $v['giamoi']>0)

										            <span class="price-old-cart-detail text-muted">{!! Helper::Format_Money($v['gia'], '<sup>đ</sup>') !!}</span>

										        @endif

										        <span>{!! Helper::Format_Money((($v['giamoi']>0) ? $v['giamoi'] : $v['gia'] ), '<sup>đ</sup>') !!}</span>

										    </div>

										</td>

										<td class="text-center align-middle">{{$v['soluong']}}</td>

										<td class="text-right align-middle">

										    <div class="price-cart-detail">

										        @if($v['gia'] && $v['giamoi']>0)

										            <span class="price-old-cart-detail text-muted">{!! Helper::Format_Money($v['gia']*$v['soluong'], '<sup>đ</sup>') !!}</span>

										        @endif

										        <span>{!! Helper::Format_Money((($v['giamoi']>0) ? $v['giamoi'] : $v['gia'] )*$v['soluong'], '<sup>đ</sup>') !!}</span>

										    </div>

										</td>

									</tr>

								@endforeach

							</tbody>

						@else

							<tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>



						@endif

					</table>

				</div>

			</div>

			<div class="mb-3 bg-white shadow-sm order__information">

				<h6 class="p-3 m-0 font-weight-bold">

					<span>Thông tin thanh toán</span>

				</h6>

				<div class="px-3 pb-3 row">

					<div class="col-md-5">

						<textarea class="form-control h-100" name="data[ghichu]" rows="5" placeholder="Ghi chú">{{$rowItem['ghichu']}}</textarea>

					</div>

					<div class="col-md-7">

						<div class="py-1 text-right row">

							<div class="col-md-8">

								Số lượng sản phẩm:

							</div>

							<div class="col-md-4">{{(isset($total_product))?$total_product:0}}</div>

						</div>

						<div class="py-1 text-right row">

							<div class="col-md-8">

								Tổng tiền sản phẩm:

							</div>

							<div class="col-md-4">{!! Helper::Format_Money($rowItem['tamtinh'], '<sup>đ</sup>') !!}</div>

						</div>

						<div class="py-1 text-right row">

							<div class="col-md-8">

								Phí vận chuyển:

							</div>

							<div class="col-md-4">{!! Helper::Format_Money($rowItem['phiship'], '<sup>đ</sup>') !!}</div>

						</div>

						<div class="py-1 text-right row">

							<div class="col-md-8">

								Giảm giá:

							</div>

							<div class="col-md-4">-{!! Helper::Format_Money($rowItem['giamgia'], '<sup>đ</sup>') !!}</div>

						</div>



						@if($rowItem['voucher_code']!='')

						<div class="py-1 text-right row">

							<div class="col-md-8">

								Mã voucher đã dùng:

							</div>

							<div class="col-md-4"><span class="text-success">{{$rowItem['voucher_code']}}</span></div>

						</div>

						@endif

						
						@if($rowItem['channel']==2)
						<div class="py-1 text-right row">

							<div class="col-md-8">

								Chi phí sàn TMĐT:

							</div>

							<div class="col-md-4">-{!! Helper::Format_Money($rowItem['chiphi_kenhbanhang'], '<sup>đ</sup>') !!}</div>

						</div>
						@endif

						<div class="py-1 text-right row">

							<h6 class="m-0 col-md-8 font-weight-bold">

								Tổng giá trị đơn hàng:

							</h6>

							<h6 class="m-0 col-md-4 font-weight-bold">{!! Helper::Format_Money($rowItem['tonggia'], '<sup>đ</sup>') !!}</h6>

						</div>

						<div class="py-1 text-right row">

							<div class="col-md-8">

								Hình thức thanh toán:

							</div>

							<div class="col-md-4">

								@if(config('payment.nganluong')['active']==true && $rowItem['httt']==0)

									@php

										$arr_payments = config('payment.nganluong.payment_method');

										$payment_method = $arr_payments[$rowItem['payment_method']];

									@endphp

									{{ $payment_method['name'] }}
								@endif
								

								@if(config('payment.alepay')['active']==true && $rowItem['httt']==0)

									@php

										$arr_payments = config('payment.alepay.payment_method');

										$payment_method = $arr_payments[$rowItem['payment_method']];

									@endphp

									{{ $payment_method['name'] }}
								@endif


								@if(config('config_all.payment_define')==true)
									{{ config('config_all.payment_method')[$rowItem['httt']]['name']}}
								@else
									@if(isset($hinhthucthanhtoan))
									<span class="text-danger">{{$hinhthucthanhtoan['ten'.$lang]}}</span>
									@endif
								@endif

							</div>

						</div>

						<div class="py-1 text-right row">

							<div class="col-md-8">

								Khách đã thanh toán:

							</div>

							<div class="col-md-4">

								@if($rowItem['payment_status'] == 1)

									{!! Helper::Format_Money($rowItem['tonggia'], '<sup>đ</sup>') !!}

								@else

									{!! Helper::Format_Money(0, '<sup>đ</sup>') !!}

								@endif

							</div>

						</div>

						<div class="py-1 text-right row align-items-center">

							<div class="col-md-8">

								Trạng thái thanh toán:

							</div>

							<div class="col-md-4">

								<select id="status_payments" name="data[status_payments]" class="text-sm form-control">

									<option value="0" {{$rowItem['status_payments']==0 ? 'selected':'' }}>Chưa thanh toán</option>

									<option value="1" {{$rowItem['status_payments']==1 ? 'selected':'' }}>Đã thanh toán</option>

									<option value="2" {{$rowItem['status_payments']==2 ? 'selected':'' }}>Hủy/ Chưa thanh toán</option>

									<option value="3" {{$rowItem['status_payments']==3 ? 'selected':'' }}>Không thành công</option>

								</select>

							</div>

						</div>

						<div class="py-1 text-right row align-items-center">

							<div class="col-md-8">

								Trạng thái đơn hàng:

							</div>

							<div class="col-md-4">

								@php

									$disabled = ($rowItem['tinhtrang']==5 || $rowItem['tinhtrang']==7) ? 'disabled' : '';

								@endphp

								<select id="tinhtrang" name="data[tinhtrang]" class="text-sm form-control">

									@foreach($order_status as $k=>$v)

										@php

											$disabled = ($rowItem['tinhtrang']==5 || $rowItem['tinhtrang']==7) ? 'disabled' : '';

										@endphp

										<option value="{{$k}}" {{$rowItem['tinhtrang']==$k ? 'selected':'' }} {{$disabled}}>{{$v['name']}}</option>

									@endforeach

								</select>

							</div>

						</div>


						@if($rowItem['channel']!=2 && $rowItem['channel']!=3)
						{{-- <div class="py-1 text-right row align-items-center">

							<div class="col-md-8">{{($rowItem['cancel_vandon']==1) ? 'Thông báo' : ''}}</div>

							<div class="col-md-4">

								@if($rowItem['cancel_vandon']==0) 

									@if($rowItem['is_vandon']==0 && $rowItem['mavandon']=='')

										<a class="btn btn-sm bg-gradient-success" href="{{route('admin.order.sendbill', ['man',$rowItem['id']])}}" title="Tạo vận đơn"><i class="mr-2 fas fa-sign-out-alt"></i>Tạo vận đơn</a>

									@else

										<a class="btn btn-sm bg-gradient-danger" href="{{route('admin.order.cancelbill', ['man',$rowItem['id']])}}" title="Tạo vận đơn"><i class="mr-2 far fa-ban"></i>Hủy vận đơn</a>

									@endif

								@else

									<p class="mb-0 text-danger">Không thể tạo lại vận đơn sau khi đã hủy</p>

								@endif

							</div>

						</div> --}}
						@endif


					</div>

				</div>

			</div>





			@if(Auth::guard('admin')->user()->role == 3 && $rowItem['json_shopee'] != 0)

			<div class="p-2 mb-3 bg-white shadow-sm ">

				<h6 class="p-3 m-0 font-weight-bold show_shopee_info"style="cursor: pointer;">Hiển thị thông tin chi tiết đơn hàng</h6>

				<div class="shopee_info" style="display: none;">

					<table>

						@foreach (json_decode($rowItem['json_shopee'], true) as $key => $value)

						<tr style="">

							<td style="padding: 5px;">{{$key}}</td>

							<td style="padding: 5px;">=> </td>

							<td style="padding: 5px;">{{$value}}</td>

						</tr>

						@endforeach

					</table>

				</div>

			</div>

			@endif

		</div>

	</div>



    <div class="text-sm card-footer">
    	@if($rowItem['channel']!=2 && $rowItem['channel']!=3)
        <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="mr-2 far fa-save"></i>Lưu</button>

        <button type="submit" class="btn btn-sm bg-gradient-success submit-check" name="savehere"><i class="mr-2 far fa-save"></i>Lưu tại trang</button>
        @endif

        <a class="btn btn-sm bg-gradient-danger" href="{{route('admin.order.show',['man'])}}" title="Thoát"><i class="mr-2 fas fa-sign-out-alt"></i>Thoát</a>

        <input type="hidden" name="id" value="{{ (isset($rowItem['id']))?$rowItem['id']:'' }}">

    </div>

</form>

@endsection



<!--js thêm cho mỗi trang-->

@section('js_page')



@endsection

