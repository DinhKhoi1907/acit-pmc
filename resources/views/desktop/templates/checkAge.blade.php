@extends('desktop.master')

@section('age')
<div class="fixed w-full z-[9999999] h-[100vh] bg-cmain3 top-0 left-0 flex items-center justify-between">
    <div class="w-[600px] m-auto text-center p-12">
        <p><img class="inline-block" src="{{Thumb::Crop(UPLOAD_PHOTO,$photo_static['logo']['photo'],166,0,2)}}" alt="" width="166" height="83"></p>
        <p class="mb-10 text-4xl text-center capitalize text-cmain font-Dancing">Rượu Tháp Đồng</p>
        <p class="text-base font-semibold uppercase">Quý khách đã đủ 18 tuổi?</p>
        <p class="mt-1 text-xl md:text-base">Vui lòng nhập năm sinh bên dưới để hệ thống kiểm tra !</p>
        <form action="{{route('age.check')}}" method="POST" class="relative mt-5">
            @csrf
            <input type="text" placeholder="..." value="" name="age" required class="w-full font-bold border shadow-shadow1 border-cmain placeholder:font-body font-body" id="age">
            <button type="submit" class="absolute flex items-center justify-center px-3 font-semibold text-white uppercase border-0 bg-cmain right-[3px] top-[3px] h-[calc(100%-6px)] text-xs">Kiểm tra</button>
        </form>
        <p class="mt-2 text-sm text-red-600">* Website chỉ giới thiệu sản phẩm rượu đến đối tượng trên 18 tuổi.</p>
    </div>
    <p class="absolute bottom-0 hidden -left-16 lg:block"><img src="img/age6.png" alt=""></p>
    <p class="absolute top-0 right-0 hidden lg:block"><img src="img/la2.png" alt=""></p>
</div>
@endsection