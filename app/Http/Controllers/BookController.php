<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BookController extends Controller
{
    public function index()
    {
        return view('books.index');
    }
    public function dataTables(Request $request)
    {
        try {
            $books = Book::query()->select('id', 'title', 'category_id', 'author_id')
                ->with('category', 'author', 'ratings');

            // Filter by search
            if ($request->has('search')) {
                $books = $books->where('title', 'like', '%' . $request->input('search') . '%')
                    ->orWhereHas('author', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->input('search') . '%');
                    });
            }

            $books = $books->get();

            foreach ($books as $book) {
                $book->rating_count = $book->ratings->count();
                $book->average_rating = $book->averageRating();
            }

            $books = $books->sortByDesc('average_rating');

            return DataTables::of($books)->make(true);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getByAuthorId(Request $request)
    {
        $authorId = $request->input('author_id');

        $books = Book::where('author_id', $authorId)->get();

        return response()->json([
            'books' => $books
        ]);
    }
}
