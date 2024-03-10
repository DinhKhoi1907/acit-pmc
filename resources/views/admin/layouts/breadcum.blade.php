<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a></li>
          <li class="breadcrumb-item active">
            @if((isset($request) && isset($config[$request->type])) || isset($other_title))
                @if(isset($other_title))
                    {{ $other_title }}
                @else
                    @if(isset($config[$request->type]['title_main_'.$request->category]))
                        {{ $config[$request->type]['title_main_'.$request->category] }}
                    @elseif(isset($config[$request->type]['title_main']))
                        {{ $config[$request->type]['title_main'] }}
                    @endif
                @endif
            @endif
          </li>
        </ol>
        <!--<h1 class="m-0 text-dark">Dashboard</h1>-->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
