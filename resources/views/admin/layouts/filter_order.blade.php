@if(config('config_all.order.search') && config('config_all.order.search') == true)
    <div class="mb-0 text-sm card card-primary card-outline miko-none-card collapsed-card">
        <div class="pl-2 mb-0 card-header">
        	<div class="row">
        		{{-- <div class="mr-2 card-tools miko-tool-filter">
	                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-filter" style="font-size: 15px;"></i> Lọc</button>
	            </div> --}}
	            <div class="mb-2 align-middle form-inline col-sm-3 form-search d-inline-block">
		            <div class="input-group input-group-sm">
		                <input class="text-sm form-control form-control-navbar" type="search" id="keyword" placeholder="Tìm theo tên hoặc số điện thoại" aria-label="Tìm kiếm" value="{{ (isset($request->keyword))?$request->keyword:'' }}" onkeypress="doEnter(event,'keyword','{{ route('admin.order.show',['man']) }}')">
		                <div class="input-group-append bg-primary rounded-right">
		                    <button class="text-white btn btn-navbar" type="button" onclick="onSearch('keyword','{{ route('admin.order.show',['man']) }}')">
		                        <i class="fas fa-search"></i>
		                    </button>
		                </div>
		            </div>
		        </div>
	        </div>
        </div>
        <div class="px-0 card-body">
        	<div class="row">
        		<div class="col-md-6 col-sm-12">
        			<div class="row">
	        			<div class="form-group col-md-6 col-sm-6">
			                <label>Ngày đặt:</label>
			                <div class="input-group">
			                    <div class="input-group-prepend">
			                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
			                    </div>
			                    <input type="text" class="float-right form-control" name="ngaydat" id="ngaydat" value="{{(isset($request->ngaydat)) ? $request->ngaydat : ''}}" readonly>
			                </div>
			            </div>
			            <div class="form-group col-md-6 col-sm-6">
			                <label>Tình trạng:</label>
							<select id="tinhtrang" name="data[tinhtrang]" class="text-sm form-control">
								@foreach($order_status as $k=>$v)
									<option value="{{$k}}" {{$request->tinhtrang==$k ? 'selected':'' }}>{{$v['name']}}</option>
								@endforeach
							</select>
			            </div>
			            <div class="form-group col-md-6 col-sm-6">
			                <label>Hình thức thanh toán:</label>
			                <select id="httt" name="httt" class="text-sm form-control">
			                    <option value="0">Chọn hình thức thanh toán</option>
			                    @if(config('config_all.payment_method') && config('config_all.payment_deffine')==true)
		                            <option {{($request->httt==1)? 'selected':''}} value="1">Thanh toán khi nhận hàng COD</option>
				                    <option {{($request->httt==2)? 'selected':''}} value="2">Thanh toán chuyển khoản ngân hàng</option>
				                    <option {{($request->httt==3)? 'selected':''}} value="3">Thanh toán thẻ quốc tế</option>
				                    <option {{($request->httt==4)? 'selected':''}} value="4">Thanh toán thẻ ATM</option>
		                        @else
		                            @foreach($hinhthucthanhtoan as $k=>$v)
		                                <option {{($request->httt==$v['id'])? 'selected':''}} value="{{$v['id']}}">{{$v['tenvi']}}</option>
		                            @endforeach
		                        @endif
			                </select>
			            </div>
			            <div class="form-group col-md-6 col-sm-6">
			                <label>Kênh bán hàng:</label>
			                <select id="channel" name="channel" class="text-sm form-control">
			                    <option value="6">Chọn kênh bán hàng</option>
			                    @foreach(config('config_all.channel') as $k => $v){?>
			                    	@if($v['active']==true)<option {{$request->channel==$k ? 'selected':''}} value="{{$k}}">{{$v['name']}}</option>@endif
			                    @endforeach
			                </select>
			            </div>
			            <div class="form-group col-md-6 col-sm-6 dev-place-select">
			                <label>Tỉnh thành:</label>
			                {!! Helper::get_ajax_places("places", "places", "list", null, $request, 'required', 'Chọn tỉnh thành') !!}
			            </div>
			            <div class="form-group col-md-6 col-sm-6 dev-place-select">
			                <label>Quận huyện:</label>
			                {!! Helper::get_ajax_places("places", "places", "cat", null, $request, 'required', 'Chọn quận huyện') !!}
			            </div>
			            <div class="form-group col-md-6 col-sm-6 dev-place-select">
			                <label>Phường xã:</label>
			                {!! Helper::get_ajax_places("places", "places", "item", null, $request, 'required', 'Chọn phường xã') !!}
			            </div>
						<div class="form-group col-md-6 col-sm-6">
							<label>Loại file xuất:</label>
			                <select id="loaifilexuat" name="loaifilexuat" class="text-sm form-control">
			                    <option value="0" {{($request->loaifilexuat==0)?'selected':''}}>Xuất file chia theo tháng</option>
								<option value="1" {{($request->loaifilexuat==1)?'selected':''}}>Xuất file chung</option>
			                </select>
			            </div>
			            <div class="form-group col-md-12 col-sm-12">
			                <label>Khoảng giá:</label>
			                <input type="text" class="primary" id="khoanggia" name="khoanggia">
			            </div>

			            <div class="mt-2 mb-0 text-center form-group col-12">
			                <a class="text-white btn btn-sm bg-gradient-success" onclick="actionOrder('{{ route('admin.order.show',['man']) }}')" title="Tìm kiếm"><i class="mr-1 fas fa-search"></i>Tìm kiếm</a>
			                <a class="ml-1 text-white btn btn-sm bg-gradient-danger" href="{{route('admin.order.show',['man'])}}" title="Hủy lọc"><i class="mr-1 fas fa-times"></i>Hủy lọc</a>
			            </div>
			        </div>
        		</div>
        		<div class="col-md-6 col-sm-12">@if($chart)<div>{!! $chart->render() !!}</div>@endif</div>	            
	        </div>
        </div>
    </div>
@endif