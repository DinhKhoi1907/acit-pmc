@extends('admin.master')

@section('content')
	@csrf
	<div class="text-sm card-footer sticky-top">
        <a class="text-white btn btn-sm bg-gradient-primary" href="{{ route('admin.photo.add', ['man_photo', $type]) }}" title="Thêm mới"><i class="mr-2 fas fa-plus"></i>Thêm mới</a>
        <a class="text-white btn btn-sm bg-gradient-danger" id="delete-all" data-url="{{ route('admin.photo.deleteAll', ['man_photo', $type]) }}" title="Xóa tất cả"><i class="mr-2 far fa-trash-alt"></i>Xóa tất cả</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">     
                <div class="card-header">
                    <div class="mb-2 align-middle form-inline col-sm-3 form-search d-inline-block">
                        <div class="input-group input-group-sm">
                            <input class="text-sm form-control form-control-navbar" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="{{ (isset($request->keyword))?$request->keyword:'' }}" onkeypress="doEnter(event,'keyword','{{ route('admin.photo.show',['man_photo', $type]) }}')">
                            <div class="input-group-append bg-primary rounded-right">
                                <button class="text-white btn btn-navbar" type="button" onclick="onSearch('keyword','{{ route('admin.photo.show',['man_photo', $type]) }}')">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-0 card-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">
                                    <div class="icheck-primary d-inline dev-check">
                                        <input type="checkbox" id="checkAll">
                                        <label for="checkAll"></label>
                                    </div>
                                </th>
                                <th class="text-center align-middle" width="10%">STT</th>

                                @if(isset($config[$type]['avatar']) && $config[$type]['avatar']==true)
                                	<th class="text-center align-middle" width="8%">Hình</th>
                                @endif

                                @if(isset($config[$type]['tieude']) && $config[$type]['tieude']==true)
        				        	<th class="align-middle" style="width:30%">Tiêu đề</th>
        				        @endif

        				        @if(isset($config[$type]['link']) && $config[$type]['link']==true)
        				        	<th class="align-middle">Link</th>
        				        @endif

        				        @if(isset($config[$type]['video']) && $config[$type]['video']==true)
        				        	<th class="align-middle">Link video</th>
        				        @endif

        				        @if(isset($config[$type]['check']))
        				        	@foreach($config[$type]['check'] as $key=>$value)
                                        @php
                                            TableManipulation::AddFieldToTable('photo',$key);
                                        @endphp
        				        		<th class="text-center align-middle">{{ $value }}</th>
        				        	@endforeach
        				        @endif

                                <th class="text-center align-middle">Hiển thị</th>
                                <th class="text-center align-middle">Thao tác</th>
                            </tr>
                        </thead>
                        @empty($itemShow)
                            <tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
                        @endempty

                       	@isset($itemShow)
                            <tbody>
                                @foreach($itemShow as $k=>$v)
                                    <tr>
                                        <td class="text-center align-middle dev-item-checkbox">
                                            <div class="icheck-primary d-inline dev-check">
                                                <input type="checkbox" class="select-checkbox" id="checkItem-{{$v['id']}}" value="<?=$v['id']?>">
                                                <label for="checkItem-{{$v['id']}}"></label>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <input type="number" class="m-auto form-control form-control-mini update-stt" min="0" value="{{$v['stt']}}" data-id="{{$v['id']}}" data-model="photo" data-level="man_photo">
                                        </td>

                                        @if(isset($config[$type]['avatar']) && $config[$type]['avatar']==true)
        	                                <td class="text-center align-middle dev-item-img">
        	                                    <a href="{{route('admin.photo.edit',['man_photo',$type,$v['id']])}}" title="{{ $v['tenvi'] }}"><img src="{{ config('config_upload.UPLOAD_PHOTO').$v['photo'] }}" onerror=src="{{asset('img/noimage.png')}}" alt="{{ $v['tenvi'] }}" style="width:initial !important;" ></a>
        	                                </td>
        	                            @endif

                                        @if(isset($config[$type]['tieude']) && $config[$type]['tieude']==true)
        	                                <td class="align-middle">
        	                                    <a class="text-dark" href="{{route('admin.photo.edit',['man_photo',$type,$v['id']])}}" title="{{ $v['tenvi'] }}">{{ $v['tenvi'] }}</a>
        	                                </td>
        	                            @endif

                                        @if(isset($config[$type]['link']) && $config[$type]['link']==true)
                                        	<td class="align-middle">{{ $v['link'] }}</td>
                                        @endif

                                        @if(isset($config[$type]['video']) && $config[$type]['video']==true)
                                        	<td class="align-middle">{{$v['link_video']}}</td>
                                        @endif

                                        @if(isset($config[$type]['check']))
        				        			@foreach($config[$type]['check'] as $key=>$value)
        									<td class="text-center align-middle dev-item-display show-checkbox">
        										<div class="custom-control custom-checkbox my-checkbox">
        											<input type="checkbox" class="custom-control-input" data-model="photo" data-level="man_photo" data-id="{{ $v['id'] }}" data-loai="{{$key}}" {{($v[$key])?'checked':''}}>
        											<label for="show-checkbox-{{ $v['id'] }}" class="custom-control-label"></label>
        										</div>
        									</td>
        									@endforeach
        						        @endif

        								<td class="text-center align-middle dev-item-display show-checkbox">
                                        	<div class="custom-control custom-checkbox my-checkbox">
                                                <input type="checkbox" class="custom-control-input" data-model="photo" data-level="man_photo" data-id="{{ $v['id'] }}" data-loai="hienthi" {{($v['hienthi'])?'checked':''}}>
                                                <label for="show-checkbox-{{ $v['id'] }}" class="custom-control-label"></label>
                                            </div>
                                        </td>

                                        <td class="text-center align-middle dev-item-option">
                                            <div class="dropdown show">
                                              <a class="btn-dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="fas fa-ellipsis-v" ></i>
                                              </a>

                                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="btn btn-sm d-block btn-none-css" href="{{route('admin.photo.edit',['man_photo',$type,$v['id']])}}" title="Chỉnh sửa"><i class="fas fa-pencil-alt"></i> Chỉnh sửa</a>
                                                    <a class="btn btn-sm d-block delete-item btn-none-css" data-url="{{route('admin.photo.delete',['man_photo',$type,$v['id']])}}" title="Xóa"><i class="fas fa-trash-alt"></i> Xóa</a>
                                              </div>
                                            </div>                                  
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endisset
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row">
                       <div class="col-sm-12 dev-center dev-paginator">{{ $itemShow->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection

<!--js thêm cho mỗi trang-->
@section('js_page')

@endsection
