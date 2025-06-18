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
}
