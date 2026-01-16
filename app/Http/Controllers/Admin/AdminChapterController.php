<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminChapterController extends Controller
{
    public function index($comicId)
    {
        $comic = Comic::findOrFail($comicId);

        $chapters = Chapter::where('comic_id', $comicId)
            ->orderBy('number', 'asc')
            ->paginate(15);

        return view('admin.chapters.index', compact('comic','chapters'));
    }

    public function create($comicId)
    {
        $comic = Comic::findOrFail($comicId);
        return view('admin.chapters.create', compact('comic'));
    }

   public function store(Request $request, Comic $comic)
{
   try {
        $number = $request->input('number');
        $index  = $request->input('page_index');

        if ($index == 1) {
            $exists = Chapter::where('comic_id', $comic->id)
                             ->where('number', $number)
                             ->exists();
            if ($exists) {
                return response()->json([
                    'message' => "Chapter nomor $number sudah ada! Gunakan nomor lain atau edit chapter yang lama."
                ], 422);
            }
        }

        if (!$request->hasFile('image')) {
            return response()->json(['message' => 'File gambar tidak terdeteksi'], 422);
        }

        $chapter = Chapter::firstOrCreate(
            ['comic_id' => $comic->id, 'number' => $number],
            ['title' => $request->input('title'), 'user_id' => auth()->id() ?? 1]
        );

        $file = $request->file('image');
        $path = $file->store('chapters', 'public');

        $chapter->pages()->create([
            'image_path' => $path,
            'page_number' => $index,
        ]);

        return response()->json(['success' => true]);

    } catch (\Exception $e) {
        return response()->json(['message' => $e->getMessage()], 500);
    }
}


    public function show($comicId, $chapterId)
    {
        $comic = Comic::findOrFail($comicId);
        $chapter = Chapter::where('comic_id', $comicId)->findOrFail($chapterId);

        return view('admin.chapters.show', compact('comic','chapter'));
    }

   public function edit($comicId, $chapterId)
    {
        $comic = Comic::findOrFail($comicId);
        $chapter = Chapter::with('pages')
            ->where('comic_id', $comicId)
            ->findOrFail($chapterId);

        return view('admin.chapters.edit', compact('comic', 'chapter'));
    }

    public function update(Request $request, $comicId, $chapterId)
{
   $chapter = Chapter::where('comic_id', $comicId)->findOrFail($chapterId);

    $request->validate([
        'number' => 'required',
        'title' => 'required',
        'new_images.*' => 'image|max:5000',
        'replace_images.*' => 'image|max:5000',
    ]);

    $chapter->update([
        'title' => $request->title,
        'number' => $request->number,
    ]);

    if ($request->hasFile('replace_images')) {
        foreach ($request->file('replace_images') as $pageId => $file) {
            $page = $chapter->pages()->find($pageId);
            if ($page) {
                Storage::disk('public')->delete($page->image_path);
                $path = $file->store('chapters', 'public');
                $page->update(['image_path' => $path]);
            }
        }
    }

    if ($request->delete_pages) {
        foreach ($request->delete_pages as $pageId) {
            $page = $chapter->pages()->find($pageId);
            if ($page) {
                Storage::disk('public')->delete($page->image_path);
                $page->delete();
            }
        }
        
        $this->reorderPages($chapter);
    }

    if ($request->hasFile('new_images')) {
        $lastPage = $chapter->pages()->orderBy('page_number', 'desc')->first();
        $startNumber = $lastPage ? $lastPage->page_number + 1 : 1;

        foreach ($request->file('new_images') as $index => $img) {
            $path = $img->store('chapters', 'public');
            $chapter->pages()->create([
                'image_path' => $path,
                'page_number' => $startNumber + $index,
            ]);
        }
    }

    return redirect()
        ->route('admin.comics.chapters.index', $comicId)
        ->with('success', 'Chapter updated successfully!');
}

private function reorderPages($chapter) {
    $pages = $chapter->pages()->orderBy('page_number', 'asc')->get();
    foreach ($pages as $index => $page) {
        $page->update(['page_number' => $index + 1]);
    }
}

   public function destroy($comicId, $chapterId)
{
    $chapter = Chapter::where('comic_id', $comicId)->findOrFail($chapterId);

    foreach ($chapter->pages as $page) {
        if (Storage::disk('public')->exists($page->image_path)) {
            Storage::disk('public')->delete($page->image_path);
        }
        $page->delete();
    }

    $chapter->delete();

    return redirect()
        ->route('admin.comics.chapters.index', $comicId)
        ->with('success', 'Chapter berhasil dihapus.');
}
}
