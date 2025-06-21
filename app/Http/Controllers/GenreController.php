<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function store(Request $request)
    {
        $data = $request -> validate([
            'title' => 'required|string',
        ]);
        $edition = Genre::create($data);
        return response()->json($edition);
    }

    public function update(Request $request, $id)
    {
        $genre = Genre::findOrFail($id);
        $data = $request->validate([
            'title' => 'sometimes|string',
        ]);
        $genre->update($data);
        return response()->json(['message' => 'Genre updated successfully', 'genre' => $genre]);
    }

    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();
        return response()->json(['message' => 'Genre deleted successfully']);
    }
}
