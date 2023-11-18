

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if ($book) <div class="table-responsive">
                        <table class="table table-primary" id="posts">
                            <tbody>
                                <tr>
                                    <th scope="col">Name</th>
                                    <td>{{ $book->name}}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Author Name</th>
                                    <td>{{ $book->author_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Book Details</th>
                                    <th>{{ $book->book_details }}</th>
                                </tr>
                                <tr>
                                    <th scope="col">Image</th>
                                    <td><img src="{{ $book->gallery->image}}" style="width: 100px;"
                                        alt="">
                                </td>

                                </tr>
                            </tbody>
                        </table>
                        @else
                        <h3 class="text-center text-danger">No Books Found</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
