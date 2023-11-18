@extends('layouts.app')
@section('style')
    <!-- FontAwesome v6.6.6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/auth/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}"
        rel="stylesheet" />

    <style>
        #outer {
            /* width: 100%; */
            text-align: center;
        }

        .inner {
            display: inline-block;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class=" card-body">

                        @if (Session::has('alert-success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ Session('alert-success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (Session::has('alert-info'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>{{ Session('alert-info') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong></strong>{{ Session::get('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <a class="btn btn-sm btn-info mb-3" href="{{ route('books.create') }}">Create Books Management</a>

                        @if (count($books) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-primary" id="example">
                                    <thead>
                                        <tr>
                                            <th scope="col">Book Name</th>
                                            <th scope="col">Author Name</th>
                                            <th scope="col">Book deatils</th>
                                            <th scope="col">Image</th>
                                            <th class="text-center" scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($books as $book)
                                            <tr>
                                                <td>{{ $book->name }}</td>
                                                <td>{{ $book->author_name }}</td>
                                                <th>{{ $book->book_details }}</th>
                                                <td><img src="{{ $book->gallery->image }}" style="width: 100px;"
                                                        alt="">
                                                </td>
                                                <td id="outer">
                                                    <a href="{{ route('books.show', $book->id) }}"
                                                        class="btn btn-success btn-sm inner mt-2">
                                                        Show</a>
                                                    <a href="{{ route('books.edit', $book->id) }}"
                                                        class="btn btn-info btn-sm inner mt-2">Edit
                                                    </a>
                                                    <form action="{{ route('books.destroy', $book->id) }}" method="post"
                                                        class="inner">
                                                        @method('DELETE')
                                                        @csrf

                                                        <button type="submit" class=" btn btn-danger btn-sm inner mt-2">
                                                                Delete
                                                            </button>
                                                    </form>

                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <h3 class="text-center text-danger">No Books Found</h3>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

