@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Top 10 Most Famous Author</h1>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Voter</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($authors as $author)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $author->name }}</td>
                            <td>{{ $author->ratingCount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
