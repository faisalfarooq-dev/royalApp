<div>
    <div class="modal-header">
        <h5>Book Detail's</h5>
    </div>
    <div class="col-4">
        <label><strong>Title:</strong> </label>
    </div>
    <div class="col-8">
        {{ $book['title'] ?? 'N/A' }}
    </div>
    <div class="col-4">
        <label><strong>Release Date:</strong> </label>
    </div>
    <div class="col-8">
        @if(isset($book['release_date'])) {{ \Carbon\Carbon::parse($book['release_date'])->format('d M Y') }} @else N/A @endif
    </div>
    <div class="col-4">
        <label><strong>isbn:</strong> </label>
    </div>
    <div class="col-8">
        {{ $book['isbn'] ?? 'N/A' }}
    </div>
    <div class="col-4">
        <label><strong>Number of Pages:</strong> </label>
    </div>
    <div class="col-8">
        {{ $book['number_of_pages'] ?? 'N/A' }}
    </div>
    <div class="col-4">
        <label><strong>Description:</strong> </label>
    </div>
    <div class="col-8">
        {{ $book['description'] ?? 'N/A' }}
    </div>
</div>
<a href="{{ url()->previous() }}">Back</a>
