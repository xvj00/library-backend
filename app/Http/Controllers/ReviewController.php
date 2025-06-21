<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Book;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Book $book)
    {
        return response()->json($book->reviews()->with('user:id,name')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request, Book $book)
    {
        $review = $book->reviews()->create($request->validated());

        return response()->json($review, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return response()->json($review->load('user:id,name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        $review->update($request->validated());

        return response()->json($review);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        if (auth()->id() !== $review->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $review->delete();

        return response()->json(null, 204);
    }
}
