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

    public function update(Request $request, $id)
    {
        $edition = Edition::findOrFail($id);
        $data = $request->validate([
            'title' => 'sometimes|string',
        ]);
        $edition->update($data);
        return response()->json(['message' => 'Edition updated successfully', 'edition' => $edition]);
    }

    public function destroy($id)
    {
        $edition = Edition::findOrFail($id);
        $edition->delete();
        return response()->json(['message' => 'Edition deleted successfully']);
    }
}
