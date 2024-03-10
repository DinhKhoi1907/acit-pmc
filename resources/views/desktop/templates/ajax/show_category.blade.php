@if($categories)
<select name="datapost[ids_level_2]" class="manage-form-field-select manage-form-field-select-level2 mt-3">
	<option value="0">Danh mục cấp ---</option>
	@foreach($categories as $k=>$v)	
		<option value="{{$v['id']}}" {{($id_lv2==$v['id']) ? 'selected' : ''}}>{{$v['tenvi']}}</option>
	@endforeach
</select>
@endif