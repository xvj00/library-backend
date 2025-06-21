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

    public function show($id)
    {
        $book = Book::with('editions', 'authors', 'genres')->findOrFail($id);

        return response()->json(['book' => $book], 200);

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

        return response()->json(['message' => 'Book created successfully',$book],201);

    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $data = $request->validate([
            'title' => 'sometimes|string',
            'author_id' => 'sometimes|integer',
            'genre_id' => 'sometimes|integer',
            'edition_id' => 'sometimes|integer',
        ]);
        $book->update($data);
        if ($request->has('author_id')) {
            $book->authors()->sync([$request->author_id]);
        }
        if ($request->has('genre_id')) {
            $book->genres()->sync([$request->genre_id]);
        }
        if ($request->has('edition_id')) {
            $book->edition_id = $request->edition_id;
            $book->save();
        }
        return response()->json(['message' => 'Book updated successfully', 'book' => $book::with('authors', 'genres', 'editions')->find($id)], 201);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json(['message' => 'Book deleted successfully']);
    }
}
