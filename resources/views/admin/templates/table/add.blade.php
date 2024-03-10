@extends('admin.master')

@section('content')
	<div class="tabledb-layout">
		<div class="tabledb-left">
			<ul class="tabledb-ul">
				@if($tables)
					@foreach($tables as $k=>$v)
						<li class="{{($table_name==$v->Tables_in_db_project) ? 'tabledb-li-active' : ''}}"><a href="{{route('admin.table.show', [$v->Tables_in_db_project])}}"><i class="far fa-caret-right"></i> {{$v->Tables_in_db_project}}</a></li>
					@endforeach
				@endif
			</ul>
		</div>

		<div class="tabledb-right">
			<form class="validation-form" novalidate method="post" action="{{route('admin.table.save')}}" enctype="multipart/form-data">				
				@csrf

				<p class="tabledb-header"><i class="fas fa-paperclip"></i> Name: {{$table_column}}</p>
				<div class="row">
					<div class="form-group col-md-6 col-sm-6 mb-6">
						<label for="name" class="inp">
							<input type="text" class="form-control for-seo" name="namechange" id="namechange" placeholder="&nbsp;" value="{{$table_column}}">
	                        <span class="label">Name</span>
						</label>						
					</div>

					<div class="form-group col-md-6 col-sm-6 mb-6">
						<label for="type" class="inp">
							<select class="form-control for-seo tabledb-type" name="type" id="type" placeholder="&nbsp;">
								@foreach($list_type as $l=>$list)
									<optgroup label="{{$l}}">
										@foreach($list as $v)
											<option value="{{$v}}" {{($v==TableManipulation::GetTableColumnsType($table_name, $table_column)) ? 'selected' : ''}}>{{$v}}</option>
										@endforeach
									</optgroup>
								@endforeach
							</select>
	                        <span class="label">Type</span>
						</label>
					</div>
				</div>

				<div class="text-sm">
					<button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
					<a class="btn btn-sm bg-gradient-danger" href="{{route('admin.table.show',[$table_name])}}" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
					<input type="hidden" class="" name="name" value="{{$table_column}}">
					<input type="hidden" class="" name="table" value="{{$table_name}}">
				</div>
				
			</form>
		</div>
	</div>
@endsection


@push('css')
	<link rel="stylesheet" href="{{ asset('css/admin/table.css') }} ">
@endpush

<!--js thêm cho mỗi trang-->
@section('js_page')
	<script type="text/javascript">
		$(document).ready(function(){
			
		})
	</script>
@endsection
