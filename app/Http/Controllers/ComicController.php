<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ComicController extends Controller
{
    public function index(Request $request)
    {

        $query = Comic::with(['genres', 'ratings']);

        $query = Comic::with('genres');

        // Filter genre
        if ($request->genre) {
            $query->whereHas('genres', function ($q) use ($request) {
                $q->where('genres.id', $request->genre);
            });
        }

        // Sorting
        switch ($request->sort) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'az':
                $query->orderBy('title', 'asc');
                break;
            case 'za':
                $query->orderBy('title', 'desc');
                break;
            case 'popular':
            $query->orderBy('views_count', 'desc'); // Komik paling banyak dilihat di atas
            break;
            default:
                $query->orderBy('updated_at', 'desc');
        }


        $comics = $query->paginate(20);
        $genres = Genre::all();

        return view('home', compact('comics', 'genres'));
    }

    public function show(Comic $comic)
{
    $comic->load(['genres', 'chapters.pages', 'ratings']);

    // Logika progress baca
    $progress = null;
    if (auth()->check()) {
        $progress = \App\Models\UserRead::where('user_id', auth()->id())
            ->whereHas('chapter', fn($q) => 
                $q->where('comic_id', $comic->id)
            )
            ->with('chapter')
            ->orderBy('updated_at', 'desc')
            ->first();
            
        // Ambil rating yang pernah diberikan user ini (jika ada)
        $userRating = $comic->ratings->where('user_id', auth()->id())->first();
        $comic->user_rating = $userRating ? $userRating->rating : 0;
    }

    // Hitung rata-rata rating
    $averageRating = $comic->ratings->avg('rating') ?: 0;
    $totalVoters = $comic->ratings->count();

    return view('comics.show', compact('comic', 'progress', 'averageRating', 'totalVoters'));
}


    public function edit($id)
    {
        $comic = Comic::with('genres', 'chapters.pages')->findOrFail($id);
        $genres = Genre::all();

        return view('admin.comics.edit', compact('comic', 'genres'));
    }


    public function list(Request $request)
    {
        $query = Comic::with('genres');

        // Search
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter genre
        if ($request->genre) {
            $query->whereHas('genres', fn($q) => $q->where('genre.id', $request->genre));
        }

        // Sorting
        if ($request->sort == 'popular') {
          $query->orderBy('views_count', 'desc');
        }elseif ($request->sort == 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($request->sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($request->sort == 'az') {
            $query->orderBy('title', 'asc');
        } elseif ($request->sort == 'za') {
            $query->orderBy('title', 'desc');
        }

        $comics = $query->paginate(20);
        $genres = Genre::all();

        return view('comics.list', compact('comics', 'genres'));
    }


public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'cover_image' => 'required|image',
    ]);

    $slug = Str::slug($request->title);

    $count = \App\Models\Comic::where('slug', $slug)->count();
    if ($count > 0) {
        $slug .= '-' . ($count + 1);
    }

    Comic::create([
        'title' => $request->title,
        'slug' => $slug,
        'cover_image' => $request->file('cover_image')->store('covers', 'public'),
    ]);

    return redirect()->route('comics.index')->with('success', 'Comic added!');
}
}

