<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return view('ratings.index', ['authors' => $authors]);
    }

    public function store(Request $request)
    {
        try {
            $rating = new Rating;
            $rating->book_id = $request->book_id;
            $rating->rating = $request->rating;
            $rating->save();

            return redirect()->route('books.index')->with('success', 'Your rating has been saved successfully!');
        } catch (\Exception $e) {
            return redirect()->route('books.index')->with('error', $e->getMessage());
        }
    }
}
