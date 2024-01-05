@if (session()->has('error'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong class="me-2">Something went wrong!</strong>{{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

