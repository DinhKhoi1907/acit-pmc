@extends('admin.master')


@section('content')
	<div class="inform-lazada-layout">
		<div class="inform-lazada-content">
			<p class="inform-lazada-title">Thông báo</p>
			<div class="inform-lazada-box">
				<i class="fas fa-exclamation-circle"></i>
				<div class="inform-lazada-descript">
					Mã token liên kết sàn thương mại Lazada đã hết hạn, quản trị viên vui lòng kích hoạt lại mã để sử dụng.
				</div>
			</div>
			<p class="inform-lazada-btn mt-2"><a href="{{$url}}" target="_blank">Link kích hoạt</a></p>
		</div>
	</div>
@endsection


@push('css')
	<link rel="stylesheet" href="{{asset('css/admin/lazada.css')}}" >
@endpush


<!--js thêm cho mỗi trang-->
@section('js_page')
	<script>
		
	</script>
@endsection
