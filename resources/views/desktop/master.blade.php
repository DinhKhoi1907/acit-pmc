<!DOCTYPE html>
<html lang="{{ $lang }}" class="fixlang-{{ $lang }}">

<head>
    @include('desktop.layouts.head')
    @include('desktop.layouts.css')
    @stack('css_page')
</head>

<body class="font-body @yield('body')">

    <div class="main_container bg-contain bg-no-repeat bg-right-top @yield('element_detail')" id="container_full">
        <div id="fb-root"></div>
        <!-- Error -->
        @include('desktop.layouts.error')
        <!-- Header -->
        @include('desktop.layouts.header')
        <!-- Menu -->
        @include('desktop.layouts.menu')
        <!-- yield banner -->
        @yield('banner')
        <!-- yield filter -->
        {{-- @yield('filter') --}}
        <!-- Breadcum -->
        {{-- @include('desktop.layouts.breadcum')  --}}
        <!-- Content Wrapper. Contains page content -->
        <div class="main-content @yield('center_detail') mt-[40px] md:mt-[33px] lg:mt-[100px]" id="hcontainer">
            <!-- slide -->
            @yield('slider')
            @yield('content')
        </div>
        <!-- Follow -->
        @yield('follow')
        <!-- Follow -->
        @yield('danhgia')
        <!-- Footer -->
        @include('desktop.layouts.footer_main')
    </div>
    <!-- Loading when wait -->
    @include('desktop.layouts.loading')
    <!-- ./wrapper -->

    @yield('age')

    @include('desktop.layouts.js')
    @stack('js_page')
    @stack('strucdata')

</body>

</html>
