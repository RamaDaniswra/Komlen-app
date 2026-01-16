<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Chapter;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Chapter $chapter)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $content = $request->content;

    if ($request->parent_id) {
        $parentComment = Comment::find($request->parent_id);

        if ($parentComment->parent_id !== null) {
            $content = " <span class='text-indigo-500 font-bold'>@" . $parentComment->user->username . "</span> " . $content;
        }
    }

        Comment::create([
            'user_id' => auth()->id(),
            'chapter_id' => $chapter->id,
            'content' => $request->input('content'),
            'parent_id' => $request->parent_id,
        ]);

        return back()->with('success', 'Komentar berhasil dikirim');
    }
    public function destroy(Comment $comment)
{

    if(auth()->user()->role === 'admin' || auth()->id() == $comment->user_id) {
        $comment->delete();
        return back()->with('success', 'Komentar berhasil dihapus.');
    }

    return back()->with('error', 'Anda tidak memiliki akses untuk menghapus ini.');
    }
}
