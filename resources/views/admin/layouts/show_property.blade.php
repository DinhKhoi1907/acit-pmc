@if($thuoctinhs)
    @foreach($thuoctinhs as $k=>$v)
    @php
        $values = $v['has_all_post'];
    @endphp
        @if($values)
            <div class="form-group">
                <label for="property-{{$v['id']}}">{{$v['tenvi']}}</label>
                <select class="form-control" name="dataProperty[{{$v['id']}}]">
                    <option value="">Chọn giá trị</option>
                    @foreach($values as $value)
                    <option value="{{$value['id']}}" {{ (isset($values_of_thuoctinh) && in_array($value['id'], $values_of_thuoctinh)) ? 'selected' : '' }}>{{$value['tenvi']}}</option>
                    @endforeach
                </select>
            </div>
        @endif
    @endforeach
@else
    <div style="background:#efefef; border-radius:5px; padding:1rem; color:#333;">Không có dữ liệu !</div>
@endif