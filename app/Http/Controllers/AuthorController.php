<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    public function index()
    {
        try {
            $authors = Author::select('id', 'name')->with('books.ratings')->get();

            foreach ($authors as $author) {
                $ratingCount = 0;

                foreach ($author->books->sortBy('id') as $book) {
                    $ratingCount += $book->ratings->count();
                }

                $author->ratingCount = $ratingCount;
            }

            $authors = $authors->where('ratingCount', '>', 5)->sortByDesc('ratingCount')->take(10);

            return view('authors.index', ['authors' => $authors]);
        } catch (\Exception $e) {
            return redirect()->route('books.index')->with('error', $e->getMessage());
        }
    }
}
