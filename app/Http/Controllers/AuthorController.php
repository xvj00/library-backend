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
}
