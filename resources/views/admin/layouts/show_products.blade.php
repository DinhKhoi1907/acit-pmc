@if($products)
	<div class="row">
	   <div class="col-sm-12">
	   		<table class="table table-hover text-nowrap">
	   			<thead>
		            <tr>
						<th></th>
						<th>Hình</th>
						<th>Tiêu đề</th>
		            </tr>
		         </thead>
		         <tbody>
		         	@foreach($products as $k=>$v)
		         		<tr>
		         			<td class="text-center align-middle dev-item-checkbox">
								<div class="icheck-primary d-inline dev-check">
			                        <input type="checkbox" class="select-checkbox" name="ids_product[]" id="checkItem-{{$v['id']}}" value="{{ $v['id'] }}" {{(in_array($v['id'], $ids_product_select)) ? 'checked' : ''}}>
			                        <label for="checkItem-{{$v['id']}}"></label>
			                    </div>
							</td>
							@php
	   							$path_upload = (config('config_all.fileupload')) ? config('config_upload.UPLOAD_GALLERY') : config('config_upload.UPLOAD_PRODUCT');
	   						@endphp
							<td class="dev-item-img"><a><img src="{{ $path_upload.$v['photo'] }}" onerror=src="{{asset('img/noimage.png')}}" alt="image"></a></td>
							<td class="dev-item-name">
								<a><span class="text-danger">{{($v['draft']==1) ? '[Bản nháp] ' : '' }}</span>{{$v['tenvi']}}</a>
							</td>
		         		</tr>
		         	@endforeach
		         </tbody>
	   		</table>
	   	</div>
	</div>
@endif