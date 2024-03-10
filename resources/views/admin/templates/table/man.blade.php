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
			@if($column)
				<div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
        						<th class="align-middle text-center">
        							<div class="icheck-primary d-inline dev-check">
        								<input type="checkbox" id="checkAll">
        								<label for="checkAll"></label>
        							</div>
        						</th>
                                <th class="align-middle" width="5%">#</th>
        						<th class="align-middle" style="width:30%">Name</th>
        						<th class="align-middle" >Type</th>
                                <th class="align-middle text-center">Thao tác</th>
                            </tr>
                        </thead>
                        @if(empty($column))
                            <tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
                        @else
                            <tbody>
                                @foreach($column as $k=>$v)
                                    <tr>
        								<td class="dev-item-checkbox align-middle text-center">
        									<div class="icheck-primary d-inline dev-check">
        				                        <input type="checkbox" class="select-checkbox" id="checkItem-{{$k}}" value="">
        				                        <label for="checkItem-{{$k}}"></label>
        				                    </div>
        								</td>
        								<td class="dev-item-stt">
        									{{($k+1)}}
        								</td>

                                        <td class="align-middle">
                                            {{$v}}
                                        </td>

                                        <td class="align-middle">
                                            {{TableManipulation::GetTableColumnsType($table_name, $v)}}
                                        </td>

                                        <td class="dev-item-option align-middle text-center">
                                            <div class="dropdown show">
                                              <a class="btn-dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="fas fa-ellipsis-v" ></i>
                                              </a>

                                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="btn btn-sm d-block btn-none-css" href="{{route('admin.table.edit', [$table_name,$v])}}" title="Chỉnh sửa"><i class="fas fa-pencil-alt"></i> Chỉnh sửa</a>
                                                <a class="btn btn-sm d-block delete-item btn-none-css" data-url="" title="Xóa"><i class="fas fa-trash-alt"></i> Xóa</a>
                                              </div>
                                            </div>
                                        </td>                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>
			@endif
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
