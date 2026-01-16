@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="mb-10">
    <h1 class="text-4xl font-black text-slate-100 tracking-tighter uppercase">Overview</h1>
    <p class="text-slate-500 font-medium italic">Ringkasan statistik.</p>
</div>

{{-- Stat Cards --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
    {{-- Card Total Komik --}}
    <div class="relative overflow-hidden bg-slate-900 p-8 rounded-3xl border border-slate-800 shadow-2xl group transition-all hover:border-blue-500/50">
        <div class="absolute -right-4 -top-4 text-blue-500/10 text-8xl group-hover:scale-110 transition-transform duration-500">
            <i class="fa-solid fa-book-open"></i>
        </div>
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 flex items-center justify-center bg-blue-500/20 text-blue-400 rounded-xl">
                    <i class="fa-solid fa-book"></i>
                </div>
                <p class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em]">Koleksi Komik</p>
            </div>
            <p class="text-4xl font-black text-slate-100">{{ number_format($totalComics) }}</p>
        </div>
    </div>

    {{-- Card Total Chapters --}}
    <div class="relative overflow-hidden bg-slate-900 p-8 rounded-3xl border border-slate-800 shadow-2xl group transition-all hover:border-indigo-500/50">
        <div class="absolute -right-4 -top-4 text-indigo-500/10 text-8xl group-hover:scale-110 transition-transform duration-500">
            <i class="fa-solid fa-scroll"></i>
        </div>
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 flex items-center justify-center bg-indigo-500/20 text-indigo-400 rounded-xl">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <p class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em]">Total Chapters</p>
            </div>
            <p class="text-4xl font-black text-slate-100">{{ number_format($totalChapters) }}</p>
        </div>
    </div>

    {{-- Card Total Users --}}
    <div class="relative overflow-hidden bg-slate-900 p-8 rounded-3xl border border-slate-800 shadow-2xl group transition-all hover:border-emerald-500/50">
        <div class="absolute -right-4 -top-4 text-emerald-500/10 text-8xl group-hover:scale-110 transition-transform duration-500">
            <i class="fa-solid fa-users"></i>
        </div>
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 flex items-center justify-center bg-emerald-500/20 text-emerald-400 rounded-xl">
                    <i class="fa-solid fa-user-group"></i>
                </div>
                <p class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em]">Total Users</p>
            </div>
            <p class="text-4xl font-black text-slate-100">{{ number_format($totalUsers) }}</p>
        </div>
    </div>
</div>

{{-- Recent Activity Table --}}
<div class="bg-slate-900 rounded-3xl border border-slate-800 shadow-2xl overflow-hidden">
    <div class="p-8 border-b border-slate-800 flex justify-between items-center bg-slate-800/10">
        <h2 class="text-xl font-black text-slate-100 tracking-tight flex items-center gap-3">
            <i class="fa-solid fa-clock-rotate-left text-indigo-500"></i>
            Upload Terakhir
        </h2>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-800/50 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">
                    <th class="px-8 py-5">Judul Komik</th>
                    <th class="px-8 py-5">Chapter</th>
                    <th class="px-8 py-5">Waktu Rilis</th>
                    <th class="px-8 py-5 text-right pr-12">Total Halaman</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800">
                @foreach ($latestUploads as $upload)
                <tr class="hover:bg-slate-800/30 transition group">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-1.5 bg-indigo-500 rounded-full shadow-[0_0_8px_rgba(99,102,241,0.5)]"></div>
                            <span class="font-bold text-slate-200 group-hover:text-indigo-400 transition">{{ $upload->comic->title }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-slate-300">
                        <span class="bg-slate-800 px-3 py-1.5 rounded-xl font-mono text-xs border border-slate-700">
                            Ch. {{ $upload->number }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-xs text-slate-500 font-medium">
                            <i class="fa-regular fa-clock mr-2 text-slate-600"></i>{{ $upload->created_at->diffForHumans() }}
                        </p>
                    </td>
                    <td class="px-8 py-6 text-right pr-12">
                        <div class="flex flex-col items-end">
                            <div class="flex items-center gap-2 text-indigo-400 font-black">
                                <i class="fa-solid fa-file-invoice text-xs opacity-50"></i>
                                <span>{{ $upload->pages->count() }}</span>
                            </div>
                            <span class="text-[9px] text-slate-600 uppercase font-black tracking-tighter italic">Pages Count</span>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="p-6 bg-slate-800/20 border-t border-slate-800 text-center hover:bg-slate-800/40 transition">
        <a href="{{ route('admin.comics.index') }}" class="text-[10px] font-black text-slate-500 hover:text-white transition uppercase tracking-[0.2em]">
            Kelola Katalog Lengkap &rarr;
        </a>
    </div>
</div>
@endsection