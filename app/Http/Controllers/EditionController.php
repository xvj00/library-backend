<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use Illuminate\Http\Request;

class EditionController extends Controller
{
    public function store(Request $request)
    {
        $data = $request -> validate([
            'title' => 'required|string',
        ]);
        $edition = Edition::create($data);
        return response()->json($edition);
    }
}
