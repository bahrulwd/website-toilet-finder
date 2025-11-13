<?php

namespace App\Http\Controllers;

use App\Models\Toilet;
use App\Models\Review;
use Illuminate\Http\Request;

class ToiletReviewController extends Controller
{
    // Tampilkan halaman review untuk toilet tertentu
    public function show($id)
    {
        $toilet = Toilet::find($id);
        if (!$toilet) {
            abort(404, 'Toilet tidak ditemukan');
        }
        $reviews = $toilet->reviews()->latest()->get();
        $images = is_array($toilet->images) ? $toilet->images : json_decode($toilet->images, true) ?? ['images/toilet1.png', 'images/toilet2.png'];

        return view('review', compact('toilet', 'reviews', 'images'));
    }

    // Simpan review baru
    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Review::create([
            'toilet_id' => $id,
            'content' => $request->content,
        ]);

        return redirect()->route('toilet.review.show', $id)->with('success', 'Ulasan berhasil dikirim!');
    }
}