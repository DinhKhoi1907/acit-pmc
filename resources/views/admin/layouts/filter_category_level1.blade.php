@php
    //### lấy thông tin prefix
    $prefix = Helper::GetPrefixAdmin($request);
@endphp

@if($danhmucparent)
<select class="form-control select-filter-category" data-url="{{url()->current()}}">
	<option value="" {{($level=='') ? 'selected' : ''}}>Chọn cấp danh mục</option>

	@foreach($danhmucparent as $k=>$v)
    <option value="{{($v['id'])}}" {{($level!='' && $level==$v['id']) ? 'selected' : ''}}>{{($v['tenvi'])}}</option>
	@endforeach
    {{-- <option value="1" {{($level!='' && $level==1) ? 'selected' : ''}}>Cấp 2</option>
    <option value="2" {{($level!='' && $level==2) ? 'selected' : ''}}>Cấp 3</option> --}}
</select>
@endif


@push('js')
    <script>
        $('.select-filter-category').change(function(){
	        var name = '';
	        var keyword = $("#keyword").val();
	        var level = $(this).val();

	        var url = '{{url()->current()}}'+'?';

	        if(level!=''){
	            url += "ids_level_1="+encodeURI(level);
	        }
	        if(keyword){
	            url += "&keyword="+encodeURI(keyword);
	        }

	        return window.location = url;
	    });
    </script>
@endpush
