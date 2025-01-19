<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'deskripsi' => '',
        ]);
        $validatedData['users_id'] = Auth::user()->id;
        $validatedData['games_id'] = $request->input('games_id');
        $validatedData['tanggal_ulasan'] = $request->input('tanggal_ulasan');
        $validatedData['nilai'] = $request->input('nilai');

        $existingReview = Review::where('users_id', $validatedData['users_id'])
                            ->where('games_id', $validatedData['games_id'])
                            ->first();



        if ($existingReview) {
            // Update the existing review
            $existingReview->update($validatedData);
            $message = 'Review updated successfully';
        } else {
            // Create a new review
            Review::create($validatedData, Null);
            $message = 'Review submitted successfully';
        }

        return redirect()->route('frontend.game.show', $validatedData['games_id'])->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($games_id, $users_id)
    {
        $review = Review::where('games_id', $games_id)
                        ->where('users_id', $users_id)
                        ->first();  // Retrieve the first matching review

        if ($review) { // Check if a review was found
            $review->delete();
            return back()->with('success', 'Review successfully deleted');
        } else {
            return back()->with('error', 'Review not found.'); // Handle the case where no matching review exists.
        }
    }
}
