@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-end">Insert Rating</h1>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-12">
                <form action="{{ route('ratings.store') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="author_id">Book Author</label>
                        <select class="form-control" id="author_id" name="author_id">
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="book_id">Book Name</label>
                        <select class="form-control" id="book_id" name="book_id">
                            <option value="" disabled>Please select an author first</option>
                            @foreach($authors->first()->books as $book)
                                <option value="{{  $book->id }}">{{ $book->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="rating">Rating</label>
                        <select class="form-control" id="rating" name="rating">
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>

<script>
$(document).ready(function() {
    $('#author_id').change(function() {
        var authorId = $(this).val();
        $.ajax({
            url: '{{ route('books.getByAuthorId') }}',
            data: {
                author_id: authorId
            },
            success: function(data) {
                $('#book_id').empty();
                $('#book_id').append('<option value="" disabled>Please select a book</option>');

                $.each(data.books, function(index, book) {
                    $('#book_id').append('<option value="' + book.id + '">' + book.title + '</option>');
                });
            }
        });
    });
});
</script>
@endsection
