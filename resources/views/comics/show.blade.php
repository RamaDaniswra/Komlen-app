@extends('layouts.public')

@section('content')

<header class="bg-gray-900 text-white py-4 shadow-sm border-b dark:border-gray-800 sticky top-0 z-50 transition-colors">
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
            
            <a href="{{ route('home') }}" class="text-sm font-medium text-gray-400 hover:text-white transition flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>
</header>

<main class="max-w-6xl mx-auto px-4 py-12 min-h-screen transition-colors duration-300">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

        {{-- Cover Image --}}
        <div class="flex justify-center md:block">
            <div class="sticky top-24">
                <img src="{{ asset('storage/' . $comic->cover_image) }}"
                     class="w-[300px] md:w-full h-auto aspect-[3/4] object-cover rounded-[2rem] shadow-2xl dark:shadow-indigo-500/10 border-4 border-white dark:border-gray-900"
                     alt="{{ $comic->title }}">
            </div>
        </div>

        {{-- Comic Info --}}
        <div class="md:col-span-2">
            <h2 class="text-4xl font-black mb-4 text-gray-900 dark:text-white leading-tight">
                {{ $comic->title }}
            </h2>

            <div class="flex items-center gap-6 mb-8 text-sm transition-colors">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500 fill-current" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                    </svg>
                    <span class="font-bold text-gray-900 dark:text-gray-200 text-lg">{{ number_format($comic->ratings->avg('rating') ?: 0, 1) }}</span>
                    <span class="text-gray-500 dark:text-gray-400">({{ $comic->ratings->count() }} Review)</span>
                </div>
                <div class="flex items-center gap-2 border-l border-gray-200 dark:border-gray-800 pl-6 text-gray-500 dark:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <span class="font-bold text-gray-900 dark:text-gray-200 text-lg">{{ number_format($comic->views_count) }}</span>
                    <span>Dibaca</span>
                </div>
            </div>

            {{-- Rating Action --}}
            @auth
                <div class="mb-8 p-6 bg-indigo-50 dark:bg-indigo-950/20 rounded-2xl border border-indigo-100 dark:border-indigo-900/40 transition-colors">
                    <h3 class="text-xs font-black text-indigo-600 dark:text-indigo-400 mb-3 uppercase tracking-widest">Berikan Penilaian Kamu</h3>
                    <form action="{{ route('comics.rate', $comic->id) }}" method="POST" class="flex gap-3">
                        @csrf
                        @php
                            $myRating = $comic->ratings->where('user_id', auth()->id())->first()?->rating;
                        @endphp
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="submit" name="rating" value="{{ $i }}" 
                                class="transition-all hover:scale-125 {{ $myRating >= $i ? 'text-amber-500' : 'text-gray-300 dark:text-gray-700' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                            </button>
                        @endfor
                    </form>
                </div>
            @endauth

            {{-- Genres --}}
            <div class="mb-8 flex flex-wrap gap-2">
                @forelse ($comic->genres as $genre)
                    <span class="px-4 py-1.5 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 rounded-lg text-xs font-bold uppercase tracking-wider transition-colors border border-transparent hover:border-indigo-500">
                        {{ $genre->name }}
                    </span>
                @empty
                    <span class="text-gray-500 text-sm italic">Tidak ada genre</span>
                @endforelse
            </div>

            {{-- Description & Author --}}
            <div class="space-y-6 mb-10">
                <div class="flex items-center gap-2">
                    <div>
                        <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Author</h3>
                        <p class="text-gray-900 dark:text-gray-200 font-bold">{{ $comic->author ?? 'Tidak diketahui' }}</p>
                    </div>
                </div>
                
                <div class="bg-gray-50 dark:bg-gray-900/50 p-6 rounded-2xl border border-gray-100 dark:border-gray-800">
                    <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Sinopsis</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed italic italic">
                        "{{ $comic->description }}"
                    </p>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-wrap gap-4">
                @if($comic->chapters->count() > 0)
                    <a href="{{ route('chapters.read', [$comic->slug, $comic->chapters->first()->number]) }}"
                       class="bg-indigo-600 text-white px-10 py-4 rounded-2xl font-black shadow-xl shadow-indigo-500/30 hover:bg-indigo-500 transition-all flex items-center gap-3 active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        MULAI BACA
                    </a>
                @endif

                @auth
                    @php
                        $progress = \App\Models\UserRead::where('user_id', auth()->id())
                        ->whereHas('chapter', function ($q) use ($comic) {
                            $q->where('comic_id', $comic->id);
                        })
                        ->with('chapter')
                        ->orderBy('updated_at', 'desc')
                        ->first();
                    @endphp

                    @if($progress)
                        <a href="{{ route('chapters.read', [$comic->slug,  $progress->chapter->number]) }}"
                           class="bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-700 px-10 py-4 rounded-2xl font-black shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition-all flex items-center gap-2 active:scale-95">
                            LANJUT CH {{ $progress->chapter->number }}
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    {{-- Chapters List --}}
    <section class="mt-20">
        <div class="flex items-center gap-4 mb-8">
            <h3 class="text-2xl font-black text-gray-900 dark:text-white uppercase tracking-tighter">Daftar Chapter</h3>
            <div class="h-[2px] flex-1 bg-gray-100 dark:bg-gray-800"></div>
        </div>

        <div class="bg-white dark:bg-gray-900 rounded-[2rem] shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden divide-y dark:divide-gray-800 transition-colors">
            @forelse($comic->chapters as $chapter)
                <a href="{{ route('chapters.read', [$comic->slug, $chapter->number]) }}"
                    class="flex justify-between items-center px-8 py-5 hover:bg-indigo-50 dark:hover:bg-indigo-500/5 group transition-all">
                    
                    <div class="flex items-center gap-4">
                        <span class="w-10 h-10 rounded-xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-xs font-black text-gray-400 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                            {{ $chapter->number }}
                        </span>
                        <span class="font-bold text-gray-700 dark:text-gray-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                             {{ $chapter->title }}
                        </span>
                    </div>

                    <div class="flex items-center gap-4">
                        <span class="text-gray-400 text-[10px] font-bold uppercase tracking-widest hidden sm:block">
                            {{ $chapter->pages->count() }} Halaman
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300 group-hover:text-indigo-500 transform group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>
            @empty
                <div class="px-8 py-12 text-center text-gray-500 italic">
                    Belum ada chapter tersedia.
                </div>
            @endforelse
        </div>
    </section>
</main>

<footer class="bg-gray-900 text-gray-500 text-sm text-center py-10 border-t border-gray-800">
    <p>© {{ date('Y') }} KomLen Digital Library. All rights reserved.</p>
</footer>

@endsection