<!DOCTYPE html>
<html lang="en" dir="ltr">
<body>
<div>
    @include('partials.alerts')
    <form action="{{ route('book.store') }}" method="POST">
        @csrf
        <div>
            <div>
                <label class="form-label">Title: </label>
                <input type="text" class="form-control" placeholder="Enter title" name="title" value="{{ old('title') }}" required>
            </div>
            <div>
                <label class="form-label">ISBN: </label>
                <input type="text" class="form-control" placeholder="Enter isbn" name="isbn" value="{{ old('isbn') }}" required>
            </div>
            <div>
                <label class="form-label">Format: </label>
                <input type="text" class="form-control" placeholder="Enter format" name="book_format" value="{{ old('book_format') }}" required>
            </div>
            <div>
                <label class="form-label">Number of pages: </label>
                <input type="number" class="form-control" placeholder="Enter number of pages" name="number_of_pages" value="{{ old('number_of_pages') }}" required>
            </div>
            <div>
                <label class="form-label">Release Date: </label>
                <input type="date" class="form-control" name="release_date" value="{{ old('release_date') }}" required>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="form-label">Select Authors: </label>
                <select name="author">
                    @foreach($authors['items'] as $author)
                        <option value="{{ $author['id'] }}">{{ ucwords($author['first_name']) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label">Description: </label>
                <input type="text" name="desc" value="{{ old('desc') }}" required/>
            </div>
        </div>
        <a href="{{ url()->previous() }}" class="btn btn btn-light">Cancel</a>
        <button type="submit" class="btn btn-primary ms-3">Create </button>
    </form>
</div>
</body>
</html>
