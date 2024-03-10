
<div class="bg-cmain3 pt-10 -mt-48 md:mt-0">
<h2 class="block text-4xl font-bold text-center capitalize my-7 text-cmain2 md:hidden "><span>{{$title_crumb}}</span></h2>
<form id="form-filter" action="" class="bor-none ">
    @csrf
    <div class="flex content-page-layout gap-[40px] flex-wrap">
        @if(isset($thuoctinhsNB) && $thuoctinhsNB!=null)
            @foreach($thuoctinhsNB as $k=>$v)
                @php
                    $properties = $v['has_all_post'];
                @endphp
                @if($v['hienthianh'])
                    @if($properties)
                    <div class="w-full sm:w-[calc(50%-20px)]">
                        <p class="mb-1 font-bold text-cmain opacity-90">{{$v['ten'.$lang]}}:</p>
                        <div class="flex flex-wrap">
                            @foreach($properties as $p=>$prop)
                                <div class="p-1 bg-white border border-gray-300 border-solid rounded-none -ml-[1px] cursor-pointer relative">
                                    <label class="cursor-pointer" for="filterKC-{{$prop['id']}}">
                                        <img src="{{Thumb::Crop(UPLOAD_POST,$prop['photo'],100,100,1)}}" alt="" width="40px" height="40px">
                                        <input type="radio" name="data[{{$v['id']}}-property]" value="{{$prop['id']}}" id="filterKC-{{$prop['id']}}" class="absolute top-0 left-0 opacity-0 radio-hinhanh" data-property="{{$v['id']}}-property" {{(isset($query[$v['id'].'-property']) && $query[$v['id'].'-property']==$prop['id']) ? 'checked' : ''}}>
                                    </label>
                                </div> 
                            @endforeach
                        </div>
                    </div>
                    @endif
                @else
                    @if($k==1)
                        <div class="w-full sm:w-[calc(50%-20px)]">
                            <p class="mb-1 font-bold text-cmain opacity-90">MM(Ly):</p>
                            <div class="flex flex-wrap">
                                <div class="w-full filter-ly-small">
                                    <input type="text" name="ly" id="ly">
                                    <input type="hidden" name="lymin" id="lymin" value="{{$minLY}}">
                                    <input type="hidden" name="lymax" id="lymax" value="{{$maxLY}}">
                                </div>
                            </div>
                            <input type="hidden" name="valueMinLy" value="{{(isset($query['lymin'])) ? $query['lymin'] : $minLY}}" id="valueMinLy">
                            <input type="hidden" name="valueMaxLy" value="{{(isset($query['lymax'])) ? $query['lymax'] : $maxLY}}" id="valueMaxLy">
                        </div>
                        @if($properties)
                            @php
                                $names_arr = array_column($properties, 'ten'.$lang);
                                $names = ($names_arr) ? implode(',',$names_arr) : '';  
                            @endphp
                            <div class="w-full sm:w-[calc(50%-20px)]">
                                <p class="mb-1 font-bold text-cmain opacity-90">{{$v['ten'.$lang]}}:</p>
                                <div class="flex flex-wrap">
                                    <div class="w-full filter-ly-small">
                                        <input type="text" name="{{$v['id']}}-property" id="{{$v['id']}}-property" class="range-item" data-id="{{$v['id']}}">
                                        <input type="hidden" id="{{$v['id']}}-property-min" value="0">
                                        <input type="hidden" id="{{$v['id']}}-property-max" value="{{count($names_arr)-1}}">
                                    </div>
                                </div>
                                <input type="hidden" id="valueList-{{$v['id']}}" value="{{$names}}">
                                <input type="hidden" name="valueMin[{{$v['id']}}]" id="valueMin-{{$v['id']}}" value="{{(isset($query[$v['id'].'-property-min'])) ? $query[$v['id'].'-property-min'] : 0}}">
                                <input type="hidden" name="valueMax[{{$v['id']}}]" id="valueMax-{{$v['id']}}" value="{{(isset($query[$v['id'].'-property-max'])) ? $query[$v['id'].'-property-max'] : (count($names_arr)-1) }}">
                            </div>
                        @endif
                    @else
                        @if($properties)
                            @php
                                $names_arr = array_column($properties, 'ten'.$lang);
                                $names = ($names_arr) ? implode(',',$names_arr) : '';
                            @endphp
                            <div class="w-full sm:w-[calc(50%-20px)]">
                                <p class="mb-1 font-bold text-cmain opacity-90">{{$v['ten'.$lang]}}:</p>
                                <div class="flex flex-wrap">
                                    <div class="w-full filter-ly-small">
                                        <input type="text" name="{{$v['id']}}-property" id="{{$v['id']}}-property" class="range-item" data-id="{{$v['id']}}">
                                        <input type="hidden" id="{{$v['id']}}-property-min" value="0">
                                        <input type="hidden" id="{{$v['id']}}-property-max" value="{{count($names_arr)-1}}">
                                    </div>
                                </div>
                                <input type="hidden" id="valueList-{{$v['id']}}" value="{{$names}}">
                                <input type="hidden" name="valueMin[{{$v['id']}}]" id="valueMin-{{$v['id']}}" value="{{(isset($query[$v['id'].'-property-min'])) ? $query[$v['id'].'-property-min'] : 0}}">
                                <input type="hidden" name="valueMax[{{$v['id']}}]" id="valueMax-{{$v['id']}}" value="{{(isset($query[$v['id'].'-property-max'])) ? $query[$v['id'].'-property-max'] : (count($names_arr)-1) }}">
                            </div>
                        @endif
                    @endif
                @endif
            @endforeach
        @endif
    </div>

    <input type="hidden" name="page" value="{{(isset($query['page'])) ? $query['page'] : 1}}">
</form>

<input type="hidden" name="query" value="{{isset($query) ? count($query) : 0}}"> 

</div>


@push('css_page')

    <link href="{{ asset('plugins/rangeSlider/ion.rangeSlider.css') }}" rel="stylesheet">

    <style>
        .filter-ly-small .irs-grid-pol.small{display: none;}
        .filter-ly-small .irs--square .irs-grid-text { font-size: 8px; }
        .filter-ly-small .irs--square .irs-from, .filter-ly-small .irs--square .irs-to, .irs--square .irs-single{font-size: 9px}
        .filter-ly-small .irs--square .irs-min, .filter-ly-small .irs--square .irs-max{font-size: 9px; }
        .filter-ly-small .irs-from, .filter-ly-small .irs-to, .filter-ly-small .irs-min, .filter-ly-small .irs-max, .filter-ly-small .irs-grid-text{text-transform: uppercase}
    </style>

@endpush


@push('js_page')

    <script src="{{ asset('plugins/rangeSlider/ion.rangeSlider.js') }}"></script>

    <script>

        $('.radio-hinhanh').change(function(){
            var data = dataBrowser = '';
            var pageURL = $(location).attr("href");
            var fullURL = window.location.origin+window.location.pathname;
            var href_filter = '';
            var lymin = $('#valueMinLy').val();
            var lymax = $('#valueMaxLy').val();

            if($(this).is(':checked')){
                var val_selected = $(this).val();
                var pre_selected = $(this).attr('data-property');
                
                if(val_selected!=''){
                    href_filter += '&'+pre_selected+'='+val_selected;
                }
            }

            $('.range-item').each(function(){
                var id = $(this).attr('data-id');
                var minProperty = $('#valueMin-'+id).val();
                var maxProperty = $('#valueMax-'+id).val();
                href_filter += '&'+id+'-property-min'+'='+minProperty;
                href_filter += '&'+id+'-property-max'+'='+maxProperty;
            });

            ChangeUrlBrowser(fullURL+'?'+href_filter+'&lymin='+lymin+'&lymax='+lymax);
            
            $('#form-filter').trigger('submit');
        });


        $('.range-item').each(function(){
            var e_id = $(this).attr('id');
            var id = $(this).attr('data-id');
            var valueList = $('#valueList-'+id).val();
            var arr_valList = valueList.split(",");

            var min = $('#'+id+'-property-min').val();
            var max = $('#'+id+'-property-max').val();

            var valueMin = $('#valueMin-'+id).val();
            var valueMax = $('#valueMax-'+id).val();

            $('#'+e_id).ionRangeSlider({

                skin: "square",
                min     : min,
                max     : max,
                from    : valueMin,
                to      : valueMax,
                type    : 'int',
                //step    : 0.1,
                grid:true,
                values: arr_valList,

                onStart: function (data) {

                    var from = data.min.toLocaleString('en-US');
                    var to = data.max.toLocaleString('en-US');

                    $('#valueMin-'+id).val(data.from);
                    $('#valueMax-'+id).val(data.to);
                    console.log(data.to);

                },

                onChange: function (data) {
                    var from = data.from.toLocaleString('en-US');
                    var to = data.to.toLocaleString('en-US');

                    $('#valueMin-'+id).val(data.from);
                    $('#valueMax-'+id).val(data.to);

                    var data = dataBrowser = '';
                    var pageURL = $(location).attr("href");
                    var fullURL = window.location.origin+window.location.pathname;
                    var href_filter = '';
                    var lymin = $('#valueMinLy').val();
                    var lymax = $('#valueMaxLy').val();

                    $('.radio-hinhanh').each(function(){
                        if($(this).is(':checked')){
                            var val_selected = $(this).val();
                            var pre_selected = $(this).attr('data-property');
                            
                            if(val_selected!=''){
                                href_filter += '&'+pre_selected+'='+val_selected;
                            }
                        }
                    });   

                    $('.range-item').each(function(){
                        var id = $(this).attr('data-id');
                        var minProperty = $('#valueMin-'+id).val();
                        var maxProperty = $('#valueMax-'+id).val();
                        href_filter += '&'+id+'-property-min'+'='+minProperty;
                        href_filter += '&'+id+'-property-max'+'='+maxProperty;
                    });

                    ChangeUrlBrowser(fullURL+'?'+href_filter+'&lymin='+lymin+'&lymax='+lymax);

                    $('#form-filter').trigger('submit');

                },

                onFinish: function(data){               

                    var giamin = $('#valueMin-'+id).val();
                    var giamax = $('#valueMax-'+id).val();

                }

            })
        });


        $('body').on('click', '.ajax-pagiantion a', function(e) {

            e.preventDefault();

            var pageNum = $(this).attr('href').split('page=')[1];
            var data = dataBrowser = '';
            var pageURL = $(location).attr("href");
            var fullURL = window.location.origin+window.location.pathname;

            $('input[name="page"]').val(pageNum);

            var data = dataBrowser = '';
            var pageURL = $(location).attr("href");
            var href_filter = '';
            var lymin = $('#valueMinLy').val();
            var lymax = $('#valueMaxLy').val();

            $('.radio-hinhanh').each(function(){
                if($(this).is(':checked')){
                    var val_selected = $(this).val();
                    var pre_selected = $(this).attr('data-property');
                    
                    if(val_selected!=''){
                        href_filter += '&'+pre_selected+'='+val_selected;
                    }
                }
            });   

            $('.range-item').each(function(){
                var id = $(this).attr('data-id');
                var minProperty = $('#valueMin-'+id).val();
                var maxProperty = $('#valueMax-'+id).val();
                href_filter += '&'+id+'-property-min'+'='+minProperty;
                href_filter += '&'+id+'-property-max'+'='+maxProperty;
            });

            ChangeUrlBrowser(fullURL+'?'+href_filter+'&lymin='+lymin+'&lymax='+lymax+'&page='+pageNum);

            $('#form-filter').trigger('submit');

        });
    </script>
    

    
    <script>
        var valueMinLy = $('input[name="valueMinLy"]').val();
        var valueMaxLy = $('input[name="valueMaxLy"]').val();

        var lymin = $('input[name="lymin"]').val();
        var lymax = $('input[name="lymax"]').val();        
        
        $('#ly').ionRangeSlider({

            skin: "square",
            min     : lymin,
            max     : lymax,
            from    : valueMinLy,
            to      : valueMaxLy,
            type    : 'double',
            step    : 0.1,

            onStart: function (data) {

                var from = data.min.toLocaleString('en-US');

                var to = data.max.toLocaleString('en-US');

                $('#valueMinLy').val(data.from);

                $('#valueMaxLy').val(data.to);

            },

            onChange: function (data) {             

                var from = data.from.toLocaleString('en-US');
                var to = data.to.toLocaleString('en-US');               

                $('#valueMinLy').val(data.from);
                $('#valueMaxLy').val(data.to);

                var data = dataBrowser = '';
                var pageURL = $(location).attr("href");
                var fullURL = window.location.origin+window.location.pathname;
                var href_filter = '';
                var lymin = $('#valueMinLy').val();
                var lymax = $('#valueMaxLy').val();

                $('.radio-hinhanh').each(function(){
                    if($(this).is(':checked')){
                        var val_selected = $(this).val();
                        var pre_selected = $(this).attr('data-property');
                        
                        if(val_selected!=''){
                            href_filter += '&'+pre_selected+'='+val_selected;
                        }
                    }
                });            
                
                $('.range-item').each(function(){
                    var id = $(this).attr('data-id');
                    var minProperty = $('#valueMin-'+id).val();
                    var maxProperty = $('#valueMax-'+id).val();
                    href_filter += '&'+id+'-property-min'+'='+minProperty;
                    href_filter += '&'+id+'-property-max'+'='+maxProperty;
                });

                ChangeUrlBrowser(fullURL+'?'+href_filter+'&lymin='+lymin+'&lymax='+lymax);

                $('#form-filter').trigger('submit');

            },

            onFinish: function(data){               

                var giamin = $('#valueMinLy').val();

                var giamax = $('#valueMaxLy').val();

            }

        })
    </script>

    <script>
        $('#showcategory_products').hide();

        $(window).on('load', function () {
            
            var max_query = $('input[name="query"]').val();

            if(max_query>0){
                $('#form-filter').trigger('submit');
            }

            $('#showcategory_products').show();

        });

        
        $(document).ready(function() {

            $('#form-filter').submit(function(e){

                e.preventDefault();

                $('#loading_order').show();   

                var token = $('meta[name="csrf-token"]').attr('content');

                var formData = new FormData($('#form-filter')[0]);


                $.ajax({

                    url:"{{route('ajax.filterKC')}}",

                    type: 'POST',

                    dataType: 'html',

                    async: true,

                    data: formData,

                    processData: false,

                    contentType: false,

                    success: function(result){

                        if(result) {

                            $('#showcategory_products').html(result);

                        }

                    },

                    complete: function(){

                        $('#loading_order').hide();                        

                    }

                });

            });
        });

        
        function ChangeUrlBrowser(urlNew){
            const nextURL = urlNew;
            const nextTitle = '';
            const nextState = {};
            // This will create a new entry in the browser's history, without reloading
            //window.history.pushState(nextState, nextTitle, nextURL);
            // This will replace the current entry in the browser's history, without reloading
            window.history.replaceState(nextState, nextTitle, nextURL);
            //location.reload();
        }
    </script>
   
@endpush