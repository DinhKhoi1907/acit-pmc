@extends('desktop.master')

@section('element_detail','page-manage')

@section('content')
	@php
		$validates = ($errors->any()) ? $errors->toArray() : null;
	@endphp

	<div class="login-layout mb-5">
		<form id="manage-coin-form" class="manage-form-contain hidden-info-user">
			<div class="manage-form-left">
				@include('desktop.templates.account.sidebarinfo')
			</div>
			<div class="manage-form-right">
				@if($history)
				@php
					$tinhtrang = config('config_type.newsletter.naprutxu.tinhtrang');
				@endphp

				<div class="manage-history-box">
				@foreach($history as $k=>$v)
					<div class="manage-history-item">
						<div class="manage-history-title"><p class="manage-history-title-name">{{($v['hinhthuc']==0) ? 'Nạp xu' : 'Rút xu'}}</p><p class="manage-history-title-date">{{date('H:i d/m/Y', $v['ngaytao'])}}</p></div>
						<div class="manage-history-info">
							<div class="manage-history-coin-flex">
								<p>Số xu: <strong>{{$v['giatrixunap']}}</strong></p>
								<p class="ml-2" style="color:#999;font-size: 12px;">(Giá quy đổi: {{Helper::Format_Money($v['giatrinap'], ' đ')}})</p>
							</div>
							<p>Thanh toán: {{($v['hinhthuc']==0) ? 'Qua momo' : 'Qua tài khoản ngân hàng'}}</p>
							<p class="manage-history-status manage-history-status-{{$v['tinhtrang']}}">{{$tinhtrang[$v['tinhtrang']]}}</p>
						</div>
					</div>
				@endforeach
				</div>

				@endif
			</div>
		</form>
	</div>
@endsection

@push('css_page')
	<link rel="stylesheet" href="{{ asset('plugins/jquery-ui-1-13/jquery-ui.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
	<link rel="stylesheet" href="{{ asset('css/manage.css') }} ">
@endpush

<!--js thêm cho mỗi trang-->

@push('js_page')	
	<script src="{{ asset('plugins/jquery-ui-1-13/jquery-ui.min.js') }}"></script>

	<script>
		var cleave = new Cleave('#giatrinap', {
		    numeral: true
		});		
	</script>
@endpush


@push('strucdata')


@endpush