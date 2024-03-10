@extends('admin.master')

@section('content')
<form class="validation-form" novalidate method="post" action="{{ route('admin.order.import',['man']) }}" enctype="multipart/form-data">
	@csrf
	<div class="mt-2" style="font-style: italic; color: #999;"><i class="fas fa-bell-on mr-1"></i> Sử dụng file excel để cập nhật đơn hàng từ các sàn thương mại điện tử</div>
	<div class="mt-2">
		<div class="lazada-input-excel">
			<label for="file"><i class="fas fa-file-import mr-3"></i> Tải file Excel</label>
   			<input type="file" id="file" name="file">
		</div>

		<div class="lazada-format-excel">
			<div class="lazada-format-excel-item">
			    <input type="radio" name="format" id="txt" value="lazada" checked>
			    <label for="txt">Sàn Lazada</label>
			</div>
			<div class="lazada-format-excel-item">
			    <input type="radio" name="format" id="csv" value="shopee">
			    <label for="csv">Sàn Shopee</label>
			</div>
		</div>
		<button type="sbumit" class="btn btn-sm btn-info btn-export-excel mt-3 text-white" title="Đồng bộ bằng Excel"><i class="fal fa-file-excel mr-1"></i>Xác nhận</button>
	</div>
	<input type="hidden" name="type" value="">
</form>
@endsection


<!--js thêm cho mỗi trang-->
@push('css')
	<link rel="stylesheet" href="{{asset('css/admin/lazada.css')}}" >
@endpush


<!--js thêm cho mỗi trang-->
@push('js')
	
@endpush
