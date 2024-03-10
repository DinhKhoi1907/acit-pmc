@if (session('alert'))
    <div class="main-header alert alert-danger css-fix-alert css-fix-alert-error" role="alert">
      <i class="fas fa-exclamation-circle"></i> {{ session('alert') }}
    </div>
@endif

@if (session('alertSuccess'))
    <div class="main-header alert alert-success css-fix-alert css-fix-alert-success" role="alert">
      <i class="fas fa-exclamation-circle"></i> {{ session('alertSuccess') }}
    </div>
@endif
