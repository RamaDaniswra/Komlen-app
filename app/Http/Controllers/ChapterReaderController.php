<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use App\Models\Chapter;
use App\Models\UserRead;

class ChapterReaderController extends Controller
{
    public function read(Comic $comic, Chapter $chapter)
    {
        
    $comic->increment('views_count');

    if($chapter->comic_id !== $comic->id) {
        abort(404);
        }

     $chapter = Chapter::with([
    'pages' => function ($q) {
        $q->orderBy('page_number', 'asc');
    },
    'comments.user'
])->where('comic_id', $comic->id)
  ->where('number', operator: $chapter->number)
  ->firstOrFail();

        // Chapter sebelumnya & berikutnya
        $prev = Chapter::where('comic_id', $comic->id)
            ->where('number', '<', $chapter->number)
            ->orderBy('number', 'desc')
            ->first();

        $next = Chapter::where('comic_id', $comic->id)
            ->where('number', '>', $chapter->number)
            ->orderBy('number', 'asc')
            ->first();

        $comments = $chapter->comments()->with('user')->latest()->get();

        if(auth()->check()) {
            UserRead::updateOrCreate(
                ['user_id' => auth()->id(), 'chapter_id' => $chapter->id],
                ['last_read_page' => 1]
            );
        }

        return view('chapters.read', compact('comic', 'chapter', 'prev', 'next', 'comments'));
    }
}
