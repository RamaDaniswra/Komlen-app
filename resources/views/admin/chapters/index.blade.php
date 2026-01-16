@extends('admin.layout')

@section('content')
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
    <div>
        <h1 class="text-4xl font-black text-slate-100 tracking-tighter">Chapters</h1>
        <p class="text-indigo-400 font-medium tracking-wide italic"><i class="fa-solid fa-book-open mr-2"></i>{{ $comic->title }}</p>
    </div>
    <a href="{{ route('admin.comics.chapters.create', $comic->id) }}"
       class="bg-indigo-600 text-white px-8 py-4 rounded-2xl shadow-xl shadow-indigo-900/30 hover:bg-indigo-500 transition-all font-black flex items-center gap-3 active:scale-95">
       <i class="fa-solid fa-plus"></i> Tambah Chapter
    </a>
</div>

<div class="bg-slate-900 rounded-3xl border border-slate-800 shadow-2xl overflow-hidden">
    <table class="w-full text-left">
        <thead>
            <tr class="bg-slate-800/50 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">
                <th class="px-8 py-5 w-24"># No</th>
                <th class="px-8 py-5">Informasi Judul</th>
                <th class="px-8 py-5 text-center">Halaman</th>
                <th class="px-8 py-5 text-right pr-12">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-800">
            @foreach ($chapters as $chapter)
            <tr class="hover:bg-slate-800/30 transition group">
                <td class="px-8 py-6 text-center">
                    <div class="w-12 h-12 flex items-center justify-center bg-slate-800 text-slate-100 rounded-2xl font-black text-lg group-hover:bg-indigo-600 transition shadow-inner">
                        {{ $chapter->number }}
                    </div>
                </td>
                <td class="px-8 py-6">
                    <p class="font-bold text-slate-200 group-hover:text-white">{{ $chapter->title }}</p>
                    <p class="text-xs text-slate-600 mt-1"><i class="fa-regular fa-calendar-check mr-1"></i> {{ $chapter->updated_at->diffForHumans() }}</p>
                </td>
                <td class="px-8 py-6 text-center">
                    <span class="inline-block bg-slate-800 text-slate-400 px-4 py-1.5 rounded-full text-[10px] font-black group-hover:bg-indigo-950 group-hover:text-indigo-400 transition">
                        <i class="fa-solid fa-images mr-2"></i>{{ $chapter->pages->count() }} PAGES
                    </span>
                </td>
                <td class="px-8 py-6">
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.comics.chapters.edit', [$comic->id, $chapter->id]) }}"
                           class="w-10 h-10 flex items-center justify-center bg-slate-800 text-blue-400 rounded-xl hover:bg-blue-600 hover:text-white transition shadow-lg">
                           <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.comics.chapters.destroy', [$comic->id, $chapter->id]) }}"
                              method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="w-10 h-10 flex items-center justify-center bg-slate-800 text-red-500 rounded-xl hover:bg-red-600 hover:text-white transition shadow-lg"
                                    onclick="return confirm('Hapus chapter ini?')">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    @if($chapters->hasPages())
    <div class="p-8 bg-slate-900/50 border-t border-slate-800">
        {{ $chapters->links() }}
    </div>
    @endif
</div>
@endsection