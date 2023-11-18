

    @extends('layouts.app')

@section('style')
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Books Management</div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="post" action="{{ route('books.store') }}" enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3">
                            <label>Book Name</label>
                            <input type="text" name="name" value="{{ old('book') }}"
                                class="form-control" autocomplete="off" placeholder="Book Name">
                        </div>
                        <div class="mb-3">
                            <label>Author Name</label>
                            <input type="text" name="author_name" value="{{ old('author_name') }}"
                                class="form-control" autocomplete="off" placeholder="Author Name">
                        </div>
                        <div class="mb-3">
                            <label>Book Details</label>
                            <textarea class="form-control" name="book_details">{{ old('book_details') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="file" value="{{ old('file') }}"
                                class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary mt-4 ">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')



@endsection
