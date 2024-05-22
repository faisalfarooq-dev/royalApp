@if(session('error'))
    <div class="alert alert-danger border-0 alert-dismissible fade show">
        <span class="fw-semibold">Oh snap!</span> {{ session('error') }}
    </div>
@elseif(session('success'))
    <div class="alert alert-success border-0 alert-dismissible fade show">
        <span class="fw-semibold">Well done!</span>
        {{ session('success') }}
    </div>
@endif
