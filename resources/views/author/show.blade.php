<div>
    <a href="{{ route('book.create') }}">Create New Book</a>
</div>
@include('partials.alerts')
@if(isset($author['books']) && count($author['books']) === 0)
    <div>
        <a href="{{ route('author.delete', $author['id']) }}">Delete Author</a>
    </div>
@endif
<div>
    <div class="modal-header">
        <h5>Author Detail's</h5>
    </div>
    <div class="col-4">
        <label><strong>First Name:</strong> </label>
    </div>
    <div class="col-8">
        {{ $author['first_name'] ?? 'N/A' }}
    </div>
    <div class="col-4">
        <label><strong>Last Name:</strong> </label>
    </div>
    <div class="col-8">
        {{ $author['last_name'] ?? 'N/A' }}
    </div>
    <div class="col-4">
        <label><strong>DOB:</strong> </label>
    </div>
    <div class="col-8">
        @if($author['birthday']) {{ \Carbon\Carbon::parse($author['birthday'])->format('d M Y') }} @else N/A @endif
    </div>
    <div class="col-4">
        <label><strong>Gender:</strong> </label>
    </div>
    <div class="col-8">
        {{ $author['gender'] ?? 'N/A' }}
    </div>
    <div class="col-4">
        <label><strong>Place of birth:</strong> </label>
    </div>
    <div class="col-8">
        {{ $author['place_of_birth'] ?? null }}
    </div>
</div>
@if(isset($author['books']) && count($author['books']) > 0)
<div>
    <h2>Books Table</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Release Date</th>
            <th>isbn</th>
            <th>Format</th>
            <th>Number of Pages</th>
            <th>Action</th>
        </tr>
        @foreach($author['books'] as $book)
            <tr>
                <td>{{ $book['title'] ?? 'N/A' }}</td>
                <td>
                    @if($book['release_date']) {{ \Carbon\Carbon::parse($book['release_date'])->format('d M Y') }} @else N/A @endif
                </td>
                <td>{{ $book['isbn'] ?? 'N/A' }}</td>
                <td>{{ $book['format'] ?? 'N/A' }}</td>
                <td>{{ $book['number_of_pages'] ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('book.delete', $book['id']) }}">Delete</a>
                    <a href="{{ route('book.show', $book['id']) }}">View</a>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endif
<a href="{{ url()->previous() }}">Back</a>
