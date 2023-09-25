@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="list_shown">List Shown</label>
                    <select class="form-control" id="list_shown" name="list_shown">
                        @for ($i = 10; $i <= 100; $i += 10)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="search">Search</label>
                    <input type="text" class="form-control" id="search" name="search">
                </div>
            </div>
        </div>

        <div class="row mt-3 mb-5">
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary" id="submit_filter">Submit</button>
            </div>
        </div>

        <div class="table-responsive">
            <table id="booksTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Book Name</th>
                        <th>Category Name</th>
                        <th>Author Name</th>
                        <th>Average Rating</th>
                        <th>Voter</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#booksTable').DataTable({
                processing: true,
                serverSide: true,
                "bLengthChange": false,
                "bFilter": false,
                ajax: {
                    url: '{{ route('books.dataTables') }}',
                    data: function(data) {
                        data.list_shown = $('#list_shown').val();
                        data.search = $('#search').val();
                    }
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1 + ($('#booksTable').DataTable().page()*$('#booksTable').DataTable().page.len());
                        }
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'category.name'
                    },
                    {
                        data: 'author.name'
                    },
                    {
                        data: 'average_rating',
                        render: function(data) {
                            return data.toFixed(2);
                        }
                    },
                    {
                        data: 'rating_count'
                    }
                ],
                order: [
                    [4, 'desc']
                ],
                "responsive": true
            });

            $('#submit_filter').click(function() {
                var listShown = $('#list_shown').val();
                $('#booksTable').DataTable().page.len(parseInt(listShown, 10));
                $('#booksTable').DataTable().draw();
            });
        });
    </script>
@endsection
