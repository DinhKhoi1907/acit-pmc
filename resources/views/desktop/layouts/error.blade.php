@if (!empty(session('message')))
    <div class="alert alert-success mb-0 alert-dismissible p-3 bg-gray-100">
        <i class="fas fa-exclamation-circle mr-1"></i>{{-- <strong>{{thongbao}} : </strong> --}} {{ session('message') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger mb-0 alert-dismissible">
        <ul class="m-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
