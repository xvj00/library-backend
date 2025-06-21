<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorStoreRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function store(AuthorStoreRequest $request)
    {
        $data = $request->validated();
        $author = Author::create($data);
        return response()->json($author);
    }

    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);
        $data = $request->validate([
            'name' => 'sometimes|string',
        ]);
        $author->update($data);
        return response()->json(['message' => 'Author updated successfully', 'author' => $author]);
    }

    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();
        return response()->json(['message' => 'Author deleted successfully']);
    }
}
