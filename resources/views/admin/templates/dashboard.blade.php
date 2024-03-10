@extends('admin.master')

@section('content')
    <div class="">
        <div class="mb-2 text-sm row">
            <div class="col-12 col-sm-6 col-md-3 miko-dashboard">
                <a class="my-info-box info-box miko-primary" href="{{route('admin.setting.show',['man','setting'])}}" title="Cấu hình website">
                    <span class="my-info-box-icon info-box-icon"><i class="fas fa-cogs"></i></span>
                    <div class="mt-1 info-box-content text-dark">
                        <span class="info-box-text text-capitalize miko-text-color">Cấu hình website</span>
                    </div>
                </a>
            </div>

            {{--@if(Auth::guard('admin')->user()->role==3)--}}
            <div class="col-12 col-sm-6 col-md-3 miko-dashboard">
                <a class="my-info-box info-box miko-danger" href="{{route('admin.member.edit',[Auth::guard('admin')->user()->id])}}" title="Tài khoản">
                    <span class="my-info-box-icon info-box-icon"><i class="fas fa-user-cog"></i></span>
                    <div class="mt-1 info-box-content text-dark">
                        <span class="info-box-text text-capitalize miko-text-color">Tài khoản</span>
                    </div>
                </a>
            </div>
            {{--@endif--}}

            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3 miko-dashboard">
                <a class="my-info-box info-box miko-success" href="{{ route('admin.member.editchange') }}" title="Đổi mật khẩu">
                    <span class="my-info-box-icon info-box-icon"><i class="fas fa-key"></i></span>
                    <div class="mt-1 info-box-content text-dark">
                        <span class="info-box-text text-capitalize miko-text-color">Đổi mật khẩu</span>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-md-3 miko-dashboard">
                <a class="my-info-box info-box miko-info" href="{{ route('admin.logout') }}" title="Đăng xuất">
                    <span class="my-info-box-icon info-box-icon"><i class="fas fa-sign-out-alt"></i></span>
                    <div class="mt-1 info-box-content text-dark">
                        <span class="info-box-text text-capitalize miko-text-color">Đăng xuất</span>
                        <span class="info-box-number"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="mt-3 miko-tab-contain">
        <div class="miko-tab-main">
            <a class="mb-1 mr-1 miko-tab-item miko-tab-click miko-tab-active" href="#statistical_access"><i class="mr-2 fal fa-clipboard-list"></i>Thống kê truy cập</a>
            @if(config('config_all.order.active')==true)
            <a class="mb-1 mr-1 miko-tab-item miko-tab-click " href="#statistical_order"><i class="mr-2 fal fa-shopping-bag"></i>Thống kê đơn hàng</a>
            @endif
        </div>
    </div>

    <div class="card miko-card">
       <div class="card-header">
           <h5 class="mb-0">Tháng {{$month}}/{{$year}}</h5>
       </div>
       <div class="card-body">
            <form class="mb-1 form-filter-charts row align-items-center" action="{{route('admin.dashboard')}}" method="get" name="form-thongke" accept-charset="utf-8">
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="form-control select2" name="month" id="month">
                            <option value="">Chọn tháng</option>
                            @for($i=1; $i<=12 ;$i++)
                                <option value="{{$i}}" {{ ($request->month) ? (($i==$request->month) ? 'selected' : '') : (($i==date('m')) ? 'selected' : '') }}  >Tháng {{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="form-control select2" name="year" id="year">
                            <option value="">Chọn năm</option>
                            @for($i=2000;$i<=date('Y')+20;$i++)
                                <option value="{{$i}}" {{ ($request->year) ? (($i==$request->year) ? 'selected' : '') : (($i==date('Y')) ? 'selected' : '') }}  >Năm {{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><button type="submit" class="btn btn-success mikotech-btn-success">Thống Kê</button></div>
                </div>
            </form>
            <div class="miko-statistical">
                <div id="statistical_access" class="miko-statistical-item miko-statistical-active">
                    @if($chart)<div>{!! $chart->render() !!}</div>@endif
                </div>
                
                @if(config('config_all.order.active'))
                <div id="statistical_order" class="miko-statistical-item">
                    @if($chart_order)<div>{!! $chart_order->render() !!}</div>@endif
                </div>
                @endif
            </div>
       </div>
   </div>
@endsection

<!--js thêm cho mỗi trang-->
@push('js')
    <script>
        $('.miko-tab-click').click(function(e){
            e.preventDefault();
            var e_id_show=$(this).attr('href');
            $('.miko-tab-click').removeClass('miko-tab-active');
            $(this).addClass('miko-tab-active');

            $('.miko-statistical-item').removeClass('miko-statistical-active');
            $(e_id_show).addClass('miko-statistical-active');
        });
    </script>
@endpush
