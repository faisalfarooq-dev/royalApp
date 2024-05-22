<div>
    <div class="modal-header">
        <h5>User Detail's</h5>
    </div>
    <div class="col-4">
        <label><strong>First Name:</strong> </label>
    </div>
    <div class="col-8">
        {{ $user['first_name'] ?? 'N/A' }}
    </div>
    <div class="col-4">
        <label><strong>Last Name:</strong> </label>
    </div>
    <div class="col-8">
        {{ $user['last_name'] ?? 'N/A' }}
    </div>
    <div class="col-4">
        <label><strong>Gender:</strong> </label>
    </div>
    <div class="col-8">
        {{ $user['gender'] ?? 'N/A' }}
    </div>
    <div class="col-4">
        <label><strong>Status:</strong> </label>
    </div>
    <div class="col-8">
        @if($user['active'])
            Active
        @else
            Inactive
        @endif
    </div>
</div>
<a href="{{ url()->previous() }}">Back</a>
