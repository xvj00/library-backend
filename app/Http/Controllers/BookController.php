<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Edition;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::with('editions', 'authors', 'genres')->get();

        return response()->json(['books' => $books], 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'author_id' => 'required|integer',
            'genre_id' => 'required|integer',
            'edition_id' => 'required|integer',
        ]);

        $book = Book::create($data);
        $book->authors()->attach($request->author_id);
        $book->genres()->attach($request->genre_id);
        $book->edition_id = $request->edition_id;
        $book->save();

        return response()->json(['message' => 'Book created successfully',$book],200);

    }
}
