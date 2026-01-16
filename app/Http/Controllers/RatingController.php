<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Comic $comic)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5'
        ]);

        // Simpan atau update jika sudah pernah kasih rating
        Rating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'comic_id' => $comic->id,
            ],
            [
                'rating' => $request->rating
            ]
        );

        return back()->with('success', 'Rating berhasil disimpan!');
    }
}