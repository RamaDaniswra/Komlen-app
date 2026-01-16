@extends('layouts.public')

@section('content')

<header class="bg-gray-900 text-white py-4 shadow sticky top-0 z-50">
    <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tighter">
            Kom<span class="text-indigo-600">Len</span>
        </a>
        
        <div class="flex items-center gap-4">
            <button onclick="toggleTheme()" class="p-2 rounded-lg bg-gray-800 hover:bg-gray-700 transition border border-gray-700 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </button>
            <a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition text-sm font-medium flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>
</header>

<main class="max-w-6xl mx-auto px-4 py-12">

    <div class="bg-white dark:bg-gray-900 p-8 rounded-[2rem] shadow-sm mb-12 border border-gray-100 dark:border-gray-800 transition-colors">
        <form method="GET" class="space-y-6">
            {{-- Search Bar Custom Icon --}}
            <div class="relative group">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari judul..."
                       class="w-full pl-5 pr-14 py-4 bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700 text-gray-900 dark:text-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition font-medium"/>
                <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 group-hover:text-indigo-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>

            <div class="flex flex-wrap gap-4">
                <select name="genre" class="flex-1 min-w-[180px] p-3.5 border border-gray-100 dark:border-gray-700 rounded-xl text-sm bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-300 outline-none focus:ring-2 focus:ring-indigo-500 font-medium">
                    <option value="">Semua Genre</option>
                    @foreach ($genres as $g)
                        <option value="{{ $g->id }}" {{ request('genre') == $g->id ? 'selected' : '' }}>
                            {{ $g->name }}
                        </option>
                    @endforeach
                </select>

                <select name="sort" class="flex-1 min-w-[180px] p-3.5 border border-gray-100 dark:border-gray-700 rounded-xl text-sm bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-300 outline-none focus:ring-2 focus:ring-indigo-500 font-medium">
                    <option value="">Urutkan Berdasarkan</option>
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Update Terbaru</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Paling Lama</option>
                    <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>Judul A–Z</option>
                    <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Judul Z–A</option>
                </select>

                <button type="submit" class="bg-indigo-600 text-white px-10 py-3.5 rounded-xl font-bold hover:bg-indigo-500 transition shadow-lg shadow-indigo-500/20">
                    Filter
                </button>
                
                @if(request('search') || request('genre') || request('sort'))
                    <a href="{{ route('comics.list') }}" class="px-6 py-3.5 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-700 transition text-sm font-bold flex items-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Grid Komik --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8">
        @forelse ($comics as $comic)
        <a href="{{ route('comics.show', $comic->slug) }}" class="block group">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm group-hover:shadow-2xl group-hover:-translate-y-2 overflow-hidden transition-all duration-500 border border-gray-100 dark:border-gray-800 h-full flex flex-col">

                <div class="relative overflow-hidden aspect-[3/4]">
                    @if($comic->cover_image && file_exists(public_path('storage/'.$comic->cover_image)))
                        <img src="{{ asset('storage/'.$comic->cover_image) }}"
                             class="w-full h-full object-cover transition duration-700 group-hover:scale-110"
                             alt="{{ $comic->title }}">
                    @else
                        <img src="https://placehold.co/300x400?text={{ urlencode($comic->title) }}"
                             class="w-full h-full object-cover"
                             alt="placeholder">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-4">
                      <span class="text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">Detail Komik</span>
                    </div>
                </div>

                <div class="p-4">
                    <h4 class="font-bold text-sm truncate text-gray-900 dark:text-gray-100 mb-2 group-hover:text-indigo-500 transition-colors">
                        {{ $comic->title }}
                    </h4>

                    @php
                        $limit = 5; 
                        $totalGenres = $comic->genres->count();
                        $more = $totalGenres - $limit;
                    @endphp

                    <div class="flex flex-wrap gap-1 mb-3">
                        @foreach($comic->genres->take($limit) as $g)
                            <span class="text-[9px] font-bold uppercase tracking-wider bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 px-2 py-0.5 rounded-md">
                                {{ $g->name }}
                            </span>
                        @endforeach

                        @if($more > 0)
                            <span class="text-[9px] font-bold bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 px-2 py-0.5 rounded-md">
                                +{{ $more }}
                            </span>
                        @endif
                    </div>

                    <div class="flex items-center justify-between pt-3 border-t border-gray-100 dark:border-gray-800">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center text-[10px] text-gray-500 dark:text-gray-400 gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                {{ number_format($comic->views_count) }}
                            </div>
                            <div class="flex items-center text-[10px] text-amber-500 gap-1 font-bold">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                                {{ number_format($comic->ratings->avg('rating') ?: 0, 1) }}
                            </div>
                        </div>
                        <p class="text-[10px] text-indigo-600 dark:text-indigo-400 font-black bg-indigo-50 dark:bg-indigo-500/10 px-2 py-0.5 rounded-lg uppercase tracking-tighter">
                            Ch. {{ optional($comic->latestChapter)->number ?? '0' }}
                        </p>
                    </div>
                </div>
            </div>
        </a>

        @empty
            <div class="col-span-full py-24 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 dark:bg-gray-900 rounded-full mb-4 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">Wah, komik "{{ request('search') }}" tidak ditemukan.</p>
                <a href="{{ route('comics.list') }}" class="text-indigo-500 mt-2 inline-block font-bold hover:underline italic">Tampilkan semua koleksi</a>
            </div>
        @endforelse
    </div>

    <div class="mt-16 flex justify-center">
        {{ $comics->appends(request()->query())->links() }}
    </div>

</main>

<footer class="bg-gray-900 text-gray-500 text-sm text-center py-10 border-t border-gray-800">
    <p>© {{ date('Y') }} KomLen Digital Library. All rights reserved.</p>
</footer>

@endsection