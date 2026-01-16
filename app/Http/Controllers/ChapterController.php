<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function index(Comic $comic)
    {
        $chapters = $comic->chapters()->latest()->paginate(10);

        return view('admin.chapters.index', compact('comic', 'chapters'));
    }

    public function create(Comic $comic)
    {
        return view('admin.chapters.create', compact('comic'));
    }

    public function store(Request $request, Comic $comic)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'number' => 'required|numeric',
        'images.*' => 'image|required'
    ]);

    $chapter = $comic->chapters()->create([
        'title' => $data['title'],
        'number' => $data['number'],
    ]);

  if ($request->hasFile('images')) {
    $files = $request->file('images');

    usort($files, function($a, $b) {
        $nameA = $a->getClientOriginalName();
        $nameB = $b->getClientOriginalName();
        
        return strnatcmp($nameA, $nameB);
    });

    $pageNumber = 1;
    foreach ($files as $img) {
        $path = $img->store('chapters', 'public');
        $chapter->pages()->create([
            'image_path' => $path,
            'page_number' => $pageNumber,
        ]);
        $pageNumber++;
    }
}

    return redirect()
        ->route('admin.comics.chapters.index', $comic->id)
        ->with('success', 'Chapter berhasil ditambahkan');
}

    public function edit(Comic $comic, Chapter $chapter)
    {
        return view('admin.chapters.edit', compact('comic', 'chapter'));
    }

    public function update(Request $request, Comic $comic, Chapter $chapter)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'number' => 'required|numeric',
        ]);

        $chapter->update($data);

        return redirect()->route('admin.comics.chapters.index', $comic->id)
                         ->with('success', 'Chapter berhasil diupdate');
    }

    public function destroy(Comic $comic, Chapter $chapter)
    {
        $chapter->delete();

        return back()->with('success', 'Chapter berhasil dihapus');
    }
}
