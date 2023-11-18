

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Books Management</div>

                <div class="card-body">

                    <h4>Edit Form</h4>
                    <form method="post" action="{{ route('books.update',$book->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="mb-3">
                            <label>Book Name</label>
                            <input type="text" name="name" value="{{ old('name', $book->name) }}"
                                class="form-control" autocomplete="off" placeholder="Book Name">
                        </div>
                        <div class="mb-3">
                            <label>Author Name</label>
                            <input type="text" name="author_name" value="{{ old('author_name',$book->author_name) }}"
                                class="form-control" autocomplete="off" placeholder="Author Name">
                        </div>
                        <div class="mb-3">
                            <label>Book Details</label>
                            <textarea class="form-control" name="book_details">{{ old('book_details',$book->book_details) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="file" value="{{ old('file') }}"
                                class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
