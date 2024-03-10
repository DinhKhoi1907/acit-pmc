@extends('desktop.master')



@section('element_detail', 'main_page_detail fix_detail_menu')



@section('banner')
    @include('desktop.layouts.banner')
@endsection


@section('content')
    <div class="lg:py-14 md:pt-10">
        <div class="content-page-layout bor-none">
            <div id="showcategory_products" class="flex gap-4 showcategory_products">
                <div class="lg:w-1/4 md:w-[30%]">
                    <div id="filter-desktop" class="hidden rounded-t-md md:block lg:block">
                        <p class="flex items-center px-3 py-3 text-xl font-medium text-white uppercase bg-cmain8"><i
                                class="mr-2 text-[5px]"></i>Danh mục sản phẩm</p>
                        <div
                            class="p-3 border border-t-0 border-b-0 border-solid rounded-none border-cmain2 border-opacity-5">
                            @if ($categories)
                                @foreach ($categories as $k => $v)
                                    <div class="flex flex-wrap items-center mb-3 last:mb-0">
                                        <input
                                            class="text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            type="checkbox" name="phanloaiProduct" value="{{ $v['id'] }}"
                                            id="phanloai-{{ $v['id'] }}" level="1"
                                            @if (isset($list_ids_level_1) && in_array($v['id'], $list_ids_level_1)) checked @endif
                                            @if (isset($level_child) && $level_child == 1 && $id_item == $v['id']) checked @endif>
                                        <label class="ml-2 line-clamp-1 max-w-[80%] text-[16px] font-medium"
                                            for="phanloai-{{ $v['id'] }}">{{ $v['ten' . $lang] }}</label>
                                        @if ($v['has_level_child'])
                                            <div
                                                class="flex items-center justify-center w-5 h-5 ml-auto cursor-pointer icon_down">
                                                <i class="far fa-chevron-down"></i>
                                            </div>
                                            <div class="hidden w-full pl-6 listChild">
                                                @foreach ($v['has_level_child'] as $key => $vChild)
                                                    <div class="flex items-center mb-2 last:mb-0">
                                                        <input
                                                            class="text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                            type="checkbox" value="{{ $vChild['id'] }}"
                                                            @if (isset($list_ids_level_2) && in_array($vChild['id'], $list_ids_level_2)) checked @endif
                                                            @if (isset($level_child) && ($level_child == 2) && ($id_item == $vChild['id'])) checked @endif
                                                            name="phanloaiProduct2" id="phanloai-{{ $vChild['id'] }}"
                                                            level="2">
                                                        <label class="ml-2 text-[16px] font-medium"
                                                            for="phanloai-{{ $vChild['id'] }}">{{ $vChild['ten' . $lang] }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <input type="hidden" name="url" value="https://www.acit-pmc.online/san-pham">
                    </div>
                </div>
                @if (isset($products) && count($products) > 0)
                    <div class="w-full md:w-3/4 lg:w-3/4">
                        <div class="flex flex-wrap gap-[24px] justify-center items-center">
                            @foreach ($products as $k => $v)
                                <x-product-item :key="$k" :item="$v" />
                            @endforeach
                        </div>
                        @if (!is_array($products))
                            <div class="row">
                                <div class="col-sm-12 dev-center dev-paginator">{{ $products->links() }}</div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
<!--css thêm cho mỗi trang-->

@push('css_page')
    <link rel="stylesheet" href="{{ asset('css/images-compare.css') }}">
    <style>
        .listChild {
            display: block;
            transition: max-height 0.3s ease-out;
            max-height: 0;
            overflow: hidden;
        }

        .listChild.active {
            max-height: 1000px;
            margin-top: 8px;
        }
    </style>
@endpush



<!--js thêm cho mỗi trang-->

@push('js_page')
    <script>
        $(document).ready(function() {
            $('.listChild').each(function() {
                if ($(this).find('input:checked').length > 0) {
                    $(this).toggleClass('active');
                    $(this).css('max-height', $(this).prop('scrollHeight') + 'px');
                }
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            var level = $('#filter-desktop input[name="level"]').val();

            // $('#filter-desktop input[name="url"]').val(window.location.origin + window.location.pathname);

            $('#filter-desktop input[name="phanloaiProduct"]').change(function() {
                var value = $(this).val();
                var fullURL = $('#filter-desktop input[name="url"]').val();
                var hrefUrl = '';
                var phanloaiIDs = $("#filter-desktop input[name='phanloaiProduct']:checkbox:checked").map(
                    function() {
                        return $(this).val();
                    }).get();
                var phanloai = phanloaiIDs.join(',');

                var phanloaiIDs2 = $("#filter-desktop input[name='phanloaiProduct2']:checkbox:checked").map(
                    function() {
                        return $(this).val();
                    }).get();
                var phanloai2 = phanloaiIDs2.join(',');
                if (phanloai != '') {
                    hrefUrl += '&ids_level_1=' + phanloai;
                }
                if (phanloai2 != '') {
                    hrefUrl += '&ids_level_2=' + phanloai2;
                }
                ChangeUrlBrowser(fullURL + '?' + hrefUrl);
                console.log(fullURL + '?' + hrefUrl)
            });

            $('#filter-desktop input[name="phanloaiProduct2"]').change(function() {
                var value = $(this).val();
                var fullURL = $('#filter-desktop input[name="url"]').val();
                var hrefUrl = '';

                var phanloaiIDs = $("#filter-desktop input[name='phanloaiProduct']:checkbox:checked").map(
                    function() {
                        return $(this).val();
                    }).get();
                var phanloai = phanloaiIDs.join(',');

                var phanloaiIDs2 = $("#filter-desktop input[name='phanloaiProduct2']:checkbox:checked").map(
                    function() {
                        return $(this).val();
                    }).get();
                var phanloai2 = phanloaiIDs2.join(',');

                if (phanloai != '') {
                    hrefUrl += '&ids_level_1=' + phanloai;
                }
                if (phanloai2 != '') {
                    hrefUrl += '&ids_level_2=' + phanloai2;
                }
                ChangeUrlBrowser(fullURL + '?' + hrefUrl);
            });


            function ChangeUrlBrowser(urlNew) {
                const nextURL = urlNew;
                const nextTitle = '';
                const nextState = {};
                console.log(nextState);
                window.history.replaceState(nextState, nextTitle, nextURL);
                console.log(urlNew);
                location.reload();
            }

        })
    </script>


    <script>
        $(document).ready(function() {
            $('.icon_down').click(function() {
                var listChild = $(this).next('.listChild');
                listChild.toggleClass('active');

                if (listChild.hasClass('active')) {
                    listChild.css('max-height', listChild.prop('scrollHeight') + 'px');
                } else {
                    listChild.css('max-height', 0);
                }
            })
        });
    </script>

    <!-- Like Share -->
    <script src="//sp.zalo.me/plugins/sdk.js"></script>

    <script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55e11040eb7c994c" async="async"></script>

    <script type="text/javascript">
        var addthis_config = addthis_config || {};

        addthis_config.lang = LANG
    </script>
@endpush



@push('strucdata')
    @include('desktop.layouts.strucdata')
@endpush
