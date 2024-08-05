@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 10px;">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin: 10px;">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($message = Session::get('status'))
    <div class="alert alert-info" style="margin: 10px;"><i class="ti-check"></i>
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span>
        </button>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning" style="margin: 10px;"><i class="ti-bell"></i>
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span>
        </button>
    </div>
@endif
{{-- 
@if ($errors->any())
    <div class="alert alert-danger" style="margin: 10px;">
        @foreach ($errors->all() as $error)
            <i class="ti-close"></i> {{ $error }} <br>
        @endforeach
    </div>
@endif --}}
