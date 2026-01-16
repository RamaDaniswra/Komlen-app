@extends('admin.layout')

@section('content')
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
    <div>
        <h1 class="text-4xl font-black text-slate-100 tracking-tighter">Daftar komik</h1>
        <p class="text-slate-500 font-medium italic">Kelola seluruh koleksi komik</p>
    </div>
    <a href="{{ route('admin.comics.create') }}"
       class="bg-indigo-600 text-white px-8 py-4 rounded-2xl shadow-xl shadow-indigo-900/30 hover:bg-indigo-500 transition-all font-black flex items-center gap-3 active:scale-95">
       <i class="fa-solid fa-plus"></i> Tambah Komik
    </a>
</div>

<div class="bg-slate-900 rounded-3xl border border-slate-800 shadow-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-800/50 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">
                    <th class="px-8 py-5 w-24">Cover</th>
                    <th class="px-8 py-5">Detail Komik</th>
                    <th class="px-8 py-5">Genre</th>
                    <th class="px-8 py-5">Stats</th>
                    <th class="px-8 py-5 text-right pr-12">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800">
                @foreach ($comics as $comic)
                <tr class="hover:bg-slate-800/30 transition group">
                    {{-- Cover --}}
                    <td class="px-8 py-6">
                        <div class="relative w-16 h-24 overflow-hidden rounded-xl shadow-lg border border-slate-700">
                            <img src="{{ asset('storage/' . $comic->cover_image) }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                    </td>

                    {{-- Info --}}
                    <td class="px-8 py-6">
                        <p class="font-bold text-slate-200 text-lg group-hover:text-indigo-400 transition">{{ $comic->title }}</p>
                        <p class="text-xs text-slate-500 mt-1">Author: {{ $comic->author }}</p>
                        <p class="text-[10px] text-slate-600 uppercase font-black mt-2">Uploader: {{ $comic->uploader?->username ?? 'System' }}</p>
                    </td>

                    {{-- Genre --}}
                    <td class="px-8 py-6">
                        <div class="flex flex-wrap gap-1 max-w-[200px]">
                            @foreach ($comic->genres as $genre)
                                <span class="px-2 py-0.5 bg-slate-800 text-slate-400 rounded text-[9px] font-bold border border-slate-700">{{ $genre->name }}</span>
                            @endforeach
                        </div>
                    </td>

                    {{-- Stats --}}
                    <td class="px-8 py-6">
                        <a href="{{ route('admin.comics.chapters.index', $comic->id) }}" class="flex flex-col group/btn">
                            <span class="text-slate-100 font-black text-xl leading-none">{{ $comic->chapters_count ?? $comic->chapters->count() }}</span>
                            <span class="text-[10px] text-indigo-500 font-bold tracking-widest uppercase mt-1 group-hover/btn:underline">Chapters <i class="fa-solid fa-chevron-right text-[8px]"></i></span>
                        </a>
                    </td>

                    {{-- Actions --}}
                    <td class="px-8 py-6">
                        <div class="flex justify-end gap-3">
                            <a href="{{ route('admin.comics.edit', $comic->id) }}"
                               class="w-10 h-10 flex items-center justify-center bg-slate-800 text-blue-400 rounded-xl hover:bg-blue-600 hover:text-white transition shadow-lg"
                               title="Edit Komik">
                               <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.comics.destroy', $comic->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="w-10 h-10 flex items-center justify-center bg-slate-800 text-red-500 rounded-xl hover:bg-red-600 hover:text-white transition shadow-lg"
                                        onclick="return confirm('Hapus komik ini?')">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @if($comics->hasPages())
    <div class="p-8 bg-slate-900/50 border-t border-slate-800">
        {{ $comics->links() }}
    </div>
    @endif
</div>
@endsection