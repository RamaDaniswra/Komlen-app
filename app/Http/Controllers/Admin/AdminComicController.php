<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class AdminComicController extends Controller
{
    public function index()
    {
        $comics = Comic::withCount('chapters')
            ->orderBy('updated_at', 'desc')
            ->paginate(15);

        return view('admin.comics.index', compact('comics'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('admin.comics.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'nullable',
            'cover_image' => 'image|mimes:jpg,jpeg,png|max:2048',
            'genres' => 'array'
        ]);

        $data = $request->only(['title', 'author', 'description']);
        $data['slug'] = Str::slug($request->title);
        $data['uploaded_by'] = auth()->id();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('cover', 'public');
        }

        $comic = Comic::create($data);

        if ($request->has('genres')) {
            $comic->genres()->attach($request->genres);
        }

        return redirect()->route('admin.comics.index')
            ->with('success', 'Komik berhasil ditambah.');
    }

    public function edit(Comic $comic)
    {
        $genres = Genre::all();
        return view('admin.comics.edit', compact('comic', 'genres'));
    }

    public function update(Request $request, Comic $comic)
    {
      $request->validate([
        'title' => 'required',
        'author' => 'required',
        'description' => 'nullable',
        'cover_image' => 'image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only(['title', 'author', 'description']);

    if ($request->hasFile('cover_image')) {
        if ($comic->cover_image && Storage::disk('public')->exists($comic->cover_image)) {
            Storage::disk('public')->delete($comic->cover_image);
        }

        $data['cover_image'] = $request->file('cover_image')->store('cover', 'public');
    }

    $comic->update($data);

    if ($request->has('genres')) {
        $comic->genres()->sync($request->genres);
    }

    return redirect()->route('admin.comics.index')
        ->with('success', 'Komik berhasil diupdate.');
    }

   public function destroy(Comic $comic)
{
    if ($comic->cover_image && Storage::disk('public')->exists($comic->cover_image)) {
    Storage::disk('public')->delete($comic->cover_image);
}

    $comic->delete();

    return redirect()->route('admin.comics.index')
        ->with('success', 'Komik berhasil dihapus.');
}
}
