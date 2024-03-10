@if(isset($category_child))

<div class="pt-10 -mt-48 bg-cmain3 md:mt-0" style="z-index: 99999;position: relative;">

    @if(isset($title_crumb))<h2 class="block text-4xl font-bold text-center capitalize my-7 text-cmain2 md:hidden"><span>{{$title_crumb}}</span></h2>@endif

        @handheld       
        <div class="flex items-center justify-between p-5 font-bold uppercase border-0 px-7 bg-cmain3 filter-btn">{{__('Bộ lọc')}} <i class="fal fa-chevron-down"></i></div>               
        @elsedesktop
            <form id="form-filter" action="" class="bor-none">
                @csrf
                <div class="flex flex-wrap justify-center gap-3 content-page-layout filter-main">

                    @if($category_child)

                    @php

                        //(array_key_exists('ids_level_'.($level_child+1), $query) && $query['ids_level_'.($level_child+1)]);

                    @endphp

                    <div>

                        <select name="data[ids_level_{{$level_child+1}}]" class="select-form-nice select-form-get" data-property="ids_level_{{$level_child+1}}">

                            <option value="">{{__('Loại sản phẩm')}}</option>

                            @foreach($category_child as $k=>$v)

                            <option value="{{$v['id']}}" {{(array_key_exists('ids_level_'.($level_child+1), $query) && $query['ids_level_'.($level_child+1)]==$v['id']) ? 'selected' : ''}}>{{$v['ten'.$lang]}}</option>

                            @endforeach

                        </select>

                    </div>

                    @endif 


                    
                    <div class="filter-price-box">

                        {{__('Giá')}}

                        <div class="filter-price-inner">

                            <div class="filter-price-small">

                                <input type="text" name="khoanggia" id="khoanggia">

                                <input type="hidden" name="giamin" id="giamin">

                                <input type="hidden" name="giamax" id="giamax">

                            </div>

                        </div>

                    </div>

                    @if($thuoctinhs)

                        @foreach($thuoctinhs as $k=>$v)

                        @php

                            $values = $v['has_all_post'];

                        @endphp

                        <div>

                            <select name="data[{{$v['id']}}-property]" class="select-form-nice select-form-get" data-property="{{$v['id']}}-property">

                                <option value="">{{$v['ten'.$lang]}}</option>

                                @foreach($values as $value)

                                <option value="{{$value['id']}}" {{(in_array($value['id'],$query)) ? 'selected' : ''}}>{{$value['ten'.$lang]}}</option>

                                @endforeach

                            </select>

                        </div>

                        @endforeach

                    @endif     

                    </div>


                    <!-- @handheld
                    <div class="filter-price-inner">

                        <div class="filter-price-small">

                            {{-- <label for="khoanggia">Giá từ <span class="" id="filter_giatu">0</span> tới <span class="" id="filter_giaden">1000</span></label> --}}

                            <input type="text" name="khoanggia" id="khoanggia">

                            <input type="hidden" name="giamin" id="giamin">

                            <input type="hidden" name="giamax" id="giamax">

                        </div>

                    </div>
            
                    @endhandheld -->

                <input type="hidden" name="page" value="{{(isset($query['page'])) ? $query['page'] : 1}}">
            </form>
        @endhandheld

        <input type="hidden" name="query" value="{{count($query)}}">  
</div>


@handheld
<form id="form-filter" action="" class="">
    @csrf
    <div class="flex flex-col bg-white filter-mobile">
        <p class="flex justify-between p-3 font-bold uppercase border-0 border-b border-gray-200 border-solid">{{__('Bộ lọc')}} <span class="filter-close"><i class="fal fa-times-circle" style="font-size: 20px;"></span></i></p>
        <div>
        @if($category_child)
        @php
            //(array_key_exists('ids_level_'.($level_child+1), $query) && $query['ids_level_'.($level_child+1)]);
        @endphp

        <div style="overflow: auto;max-height: calc(100vh - 4rem);padding-bottom:1rem;">
            <div class="px-5 mt-8">
                <p class="mb-3 font-bold uppercase">{{__('Loại sản phẩm')}}</p>
                <div class="flex flex-wrap gap-3">
                    @foreach($category_child as $k=>$v)
                    <div class="relative">
                        <label for="radio-level-{{$v['id']}}" class="block p-3 border border-gray-200 border-solid rounded-none">                            
                            <input id="radio-level-{{$v['id']}}" type="radio" name="data[ids_level_{{$level_child+1}}]" data-property="ids_level_{{$level_child+1}}" class="absolute top-0 left-0 opacity-0 select-form-radio" {{(array_key_exists('ids_level_'.($level_child+1), $query) && $query['ids_level_'.($level_child+1)]==$v['id']) ? 'checked' : ''}} value="{{$v['id']}}">
                            <span class="absolute top-0 left-0 flex items-center justify-center w-full h-full opacity-0">{{$v['ten'.$lang]}}</span>
                            <p>{{$v['ten'.$lang]}}</p>
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>


            <div class="px-5 mt-8">
                <p class="mb-3 font-bold uppercase">{{__('Giá')}}</p>
                <div class="flex flex-wrap gap-3">
                    <div class="filter-price-inner">
                        <div class="filter-price-small">
                            <input type="text" name="khoanggia" id="khoanggia">
                            <input type="hidden" name="giamin" id="giamin">
                            <input type="hidden" name="giamax" id="giamax">
                        </div>
                    </div>
                </div>
            </div>


            @if($thuoctinhs)
                @foreach($thuoctinhs as $k=>$v)
                    @php
                        $values = $v['has_all_post'];
                    @endphp
                    <div class="px-5 mt-8">
                        <p class="mb-3 font-bold uppercase">{{$v['ten'.$lang]}}</p>
                        <div class="flex flex-wrap gap-3">
                            @foreach($values as $value)
                            <div class="relative">
                                <label for="radio-property-{{$value['id']}}" class="block p-3 border border-gray-200 border-solid rounded-none">                                    
                                    <input id="radio-property-{{$value['id']}}" type="radio" name="data[{{$v['id']}}-property]" data-property="{{$v['id']}}-property" class="absolute top-0 left-0 opacity-0 select-form-radio" {{(array_key_exists('ids_level_'.($level_child+1), $query) && $query['ids_level_'.($level_child+1)]==$v['id']) ? 'checked' : ''}} value="{{$value['id']}}">
                                    <span class="absolute top-0 left-0 flex items-center justify-center w-full h-full opacity-0">{{$value['ten'.$lang]}}</span>
                                    <p>{{$value['ten'.$lang]}}</p>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif

        </div>

        @endif 
        </div>
    </div>
</form>
@endhandheld

@endif


@push('css_page')

    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">  

    <link href="{{ asset('plugins/rangeSlider/ion.rangeSlider.css') }}" rel="stylesheet">

    <style>
        .filter-price-box{display: flex;height: 42px;width: 145px;background-color: #fff; border-radius: 5px; border: solid 1px #e8e8e8;cursor: pointer;justify-content: space-between; align-items: center;position: relative;padding: 0 1rem;}

        .filter-price-box:after { border-bottom: 2px solid #999; border-right: 2px solid #999; content: ''; display: block; height: 5px; margin-top: -4px; pointer-events: none; position: absolute; right: 12px; top: 50%; -webkit-transform-origin: 66% 66%; -ms-transform-origin: 66% 66%; transform-origin: 66% 66%; -webkit-transform: rotate(45deg); -ms-transform: rotate(45deg); transform: rotate(45deg); -webkit-transition: all 0.15s ease-in-out; transition: all 0.15s ease-in-out; width: 5px; }

        .filter-price-inner{position: absolute;width: 300px;z-index: 99; top: 100%; left: 0;padding-top: 5px;display: none;}

        .filter-price-small{background: #fff;border: solid 1px #e8e8e8;border-radius: 5px;padding: 0.5rem;}

        .filter-price-inner .irs-grid-pol.small{display: none;}

        .filter-price-inner .irs--square .irs-grid-text { font-size: 8px; }

        .filter-price-inner .irs--square .irs-from, .filter-price-inner .irs--square .irs-to, .irs--square .irs-single{font-size: 9px}

        .filter-price-inner .irs--square .irs-min, .filter-price-inner .irs--square .irs-max{font-size: 9px; }

        .filter-price-active .filter-price-inner{display: block;}

        .filter-mobile{position: fixed; z-index: 99999999;top:0;left:-100%;width: 100%; height: 100%;transition:all ease 0.3s;}
        .filter-mobile-active{left: 0;}

        .select-form-radio:checked + span{ border:1px solid #333;background:#333;color:#fff;opacity: 100% !important;}
        .select-form-radio:checked + p{ color: #fff; position: relative; z-index: 99;}

        @media screen and (max-width: 1024px){
            .filter-price-inner{position: relative;display: block;width: 100%;}
            .filter-main >div{width:100%;}
        }

        

    </style>

@endpush





<!--js thêm cho mỗi trang-->

@push('js_page')

    <script>

        $('.filter-price-box').click(function(){

            if(!$('.filter-price-box').hasClass('filter-price-active')){

                $('.filter-price-box').addClass('filter-price-active');

            }else{
                setTimeout(function(){
                    $('.filter-price-box').removeClass('filter-price-active')
                }, 500);   
            }

        });



        // Close when clicking outside        

        $(document).on("click", function (event) {
            if ($(event.target).closest(".filter-price-box").length === 0) {
                $('.filter-price-box').removeClass('filter-price-active');
            }
        });

        $('.filter-close').click(function(){
            $('.filter-mobile').removeClass('filter-mobile-active');
        });


        $('.filter-btn').click(function(){
            $('.filter-mobile').addClass('filter-mobile-active');
        });

    </script>





    <script src="{{ asset('plugins/rangeSlider/ion.rangeSlider.js') }}"></script>

    <script>

        /* rangeSlider */

        $('#khoanggia').ionRangeSlider({

            skin: "square",

            min     : 0,

            max     : 7,

            from    : 1,

            to      : 6,

            type    : 'int',

            //step    : 5000000,

            //postfix : ' đ',

            grid:true,

            values: ['0','2 triệu','5 triệu','10 triệu','20 triệu','30 triệu','50 triệu','Trên 50'],

            //prettify: true,

            //hasGrid : true,

            //hide_min_max: true,

            //hide_from_to: true,

            onStart: function (data) {

                var from = data.min.toLocaleString('en-US');

                var to = data.max.toLocaleString('en-US');



                $('#giamin').val(data.from);

                $('#giamax').val(data.to);

                //$('#filter_giatu').text(from.replace(/[,_]/g,'.')+' đ');

                //$('#filter_giaden').text(to.replace(/[,_]/g,'.')+' đ');

            },

            onChange: function (data) {             

                var from = data.from.toLocaleString('en-US');

                var to = data.to.toLocaleString('en-US');               

                

                $('#giamin').val(data.from);

                $('#giamax').val(data.to);

               

                //$('#filter_giatu').text(from.replace(/[,_]/g,'.')+' đ');

                //$('#filter_giaden').text(to.replace(/[,_]/g,'.')+' đ');

            },

            onFinish: function(data){               

                var data = dataBrowser = '';

                var pageURL = $(location).attr("href");

                var fullURL = window.location.origin+window.location.pathname;



                if($("#form-filter .select-form-get").exists()) {  

                    var href_filter = '';

                    $('select.select-form-get').each(function(e){                        

                        var pre_selected = $(this).attr('data-property');

                        var val_selected = $(this).find(":selected").val();                    

                        if(val_selected!=''){

                            href_filter += '&'+pre_selected+'='+val_selected;

                        }

                    });

                }

                if($("#form-filter .select-form-radio").exists()) {  

                    var href_filter = '';

                    $('.select-form-radio').each(function(e){                        

                        var pre_selected = $(this).attr('data-property');

                        // var val_selected = $(this).find(":checked").val();                    

                        // if(val_selected!=''){

                        //     href_filter += '&'+pre_selected+'='+val_selected;

                        // }

                        if($(this).is(':checked')){
                            var val_selected = $(this).val();                 
                            console.log(val_selected);
                            if(val_selected!=''){

                                href_filter += '&'+pre_selected+'='+val_selected;

                            }
                        }

                    });

                }





                var giamin = $('#giamin').val();

                var giamax = $('#giamax').val();

                

                //console.log(window.location.origin+window.location.pathname);

                //console.log(pageURL+'?'+href_filter+'&giamin='+giamin+'&giamax='+giamax);

                ChangeUrlBrowser(fullURL+'?'+href_filter+'&giamin='+giamin+'&giamax='+giamax);



                setTimeout(function(){

                    //$('.filter-price-box').removeClass('filter-price-active');

                    $('#form-filter').trigger('submit');

                }, 500);

            }

        })

    </script>





    <script src="js/jquery.nice-select.js"></script>

    <script src="js/fastclick.js"></script>

    <script src="js/prism.js"></script>

    

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

            $('.select-form-nice').niceSelect();

            FastClick.attach(document.body);



            $('input[name="page"]').val(1);

            

            $('.select-form-get').change(function(){

                var data = dataBrowser = '';

			    var pageURL = $(location).attr("href");

                var fullURL = window.location.origin+window.location.pathname;



                if($("#form-filter .select-form-get").exists()) {	

                    var href_filter = '';



                    $('select.select-form-get').each(function(e){                        

                        var pre_selected = $(this).attr('data-property');

                        var val_selected = $(this).find(":selected").val();                    

                        if(val_selected!=''){

                            href_filter += '&'+pre_selected+'='+val_selected;

                        }

                    });

                }

                var giamin = $('#giamin').val();

                var giamax = $('#giamax').val();

                //console.log(window.location.origin+window.location.pathname);

                //console.log(pageURL+'?'+href_filter+'&giamin='+giamin+'&giamax='+giamax);

                ChangeUrlBrowser(fullURL+'?'+href_filter+'&giamin='+giamin+'&giamax='+giamax);

                $('#form-filter').trigger('submit');

            });


            $('.select-form-radio').change(function(){

                var data = dataBrowser = '';

                var pageURL = $(location).attr("href");

                var fullURL = window.location.origin+window.location.pathname;
                

                if($("#form-filter .select-form-radio").exists()) {	

                    var href_filter = '';

                    $('.select-form-radio').each(function(e){                        

                        var pre_selected = $(this).attr('data-property');

                        if($(this).is(':checked')){
                            var val_selected = $(this).val();                 
                            console.log(val_selected);
                            if(val_selected!=''){
                                href_filter += '&'+pre_selected+'='+val_selected;
                            }
                        }
                        

                    });

                }

                var giamin = $('#giamin').val();

                var giamax = $('#giamax').val();

                //console.log(window.location.origin+window.location.pathname);

                //console.log(pageURL+'?'+href_filter+'&giamin='+giamin+'&giamax='+giamax);

                ChangeUrlBrowser(fullURL+'?'+href_filter+'&giamin='+giamin+'&giamax='+giamax);

                $('#form-filter').trigger('submit');

            });



            $('#form-filter').submit(function(e){

                e.preventDefault();



                $('#loading_order').show();   

                var token = $('meta[name="csrf-token"]').attr('content');

                var formData = new FormData($('#form-filter')[0]);



                //var giamin = $('#giamin').val();

                //var giamax = $('#giamax').val();



                $.ajax({

                    url:"{{route('ajax.filter')}}",

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



            $('body').on('click', '.ajax-pagiantion a', function(e) {

                e.preventDefault();

                

                var pageNum = $(this).attr('href').split('page=')[1];

                var data = dataBrowser = '';

			    var pageURL = $(location).attr("href");

                var fullURL = window.location.origin+window.location.pathname;



                $('input[name="page"]').val(pageNum);

                    

                //console.log(pageNum);



                if($("#form-filter .select-form-get").exists()) {	

                    var href_filter = '';



                    $('select.select-form-get').each(function(e){                        

                        var pre_selected = $(this).attr('data-property');

                        var val_selected = $(this).find(":selected").val();                    

                        if(val_selected!=''){

                            href_filter += '&'+pre_selected+'='+val_selected;

                        }

                    });

                }

                if($("#form-filter .select-form-radio").exists()) {	

                    var href_filter = '';



                    $('.select-form-radio').each(function(e){                        

                        var pre_selected = $(this).attr('data-property');

                        //var val_selected = $(this).find(":checked").val();  
                        
                        if($(this).is(':checked')){
                            var val_selected = $(this).val();                 
                            console.log(val_selected);
                            if(val_selected!=''){

                                href_filter += '&'+pre_selected+'='+val_selected;

                            }
                        }

                    });

                }

                var giamin = $('#giamin').val();

                var giamax = $('#giamax').val();

                //console.log(pageURL+'?'+href_filter);return false;

                ChangeUrlBrowser(fullURL+'?'+href_filter+'&giamin='+giamin+'&giamax='+giamax+'&page='+pageNum);



                $('#form-filter').trigger('submit');

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