@php
	$max_level = $config[$type]['max_level'];
@endphp
<select class="form-control select-filter-category" data-url="{{url()->current()}}">
	<option value="" {{($level=='') ? 'selected' : ''}}>Chọn cấp danh mục</option>
	
	@for($i=0;$i<$max_level;$i++)
    <option value="{{($i)}}" {{($level!='' && $level==$i) ? 'selected' : ''}}>Cấp {{($i+1)}}</option>
	@endfor
    {{-- <option value="1" {{($level!='' && $level==1) ? 'selected' : ''}}>Cấp 2</option>
    <option value="2" {{($level!='' && $level==2) ? 'selected' : ''}}>Cấp 3</option> --}}
</select>

@push('js')
    <script>
        $('.select-filter-category').change(function(){
	        var name = '';
	        var keyword = $("#keyword").val();
	        var level = $(this).val();

	        var url = '{{url()->current()}}'+'?';

	        if(level!=''){
	            url += "level="+encodeURI(level);
	        }
	        if(keyword){
	            url += "&keyword="+encodeURI(keyword);
	        }

	        return window.location = url;
	    });
    </script>
@endpush