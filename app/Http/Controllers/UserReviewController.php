<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserReviewController extends Controller
{
    public function index()
    {
        // Ambil semua review user dari tabel user_reviews
        $userReviews = DB::table('user_reviews')->orderByDesc('created_at')->get();
        return view('reviewapp', compact('userReviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'review' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        DB::table('user_reviews')->insert([
            'name' => $request->name,
            'review' => $request->review,
            'rating' => $request->rating,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('user.reviews')->with('success', 'Thank you for your review!');
    }
}