<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Beranda - Komik Terbaru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        tailwind.config = {
            darkMode: 'class',
        }

        function toggleTheme() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }
    </script>
    <style>
        .hero-bg-img {
            transition: opacity 1.5s ease-in-out, transform 2s ease-in-out;
        }
        .hero-overlay {
            background: linear-gradient(to bottom, rgba(17, 24, 39, 0.8), rgba(17, 24, 39, 0.95));
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors duration-300">

<header class="bg-gray-900 text-white py-4 shadow sticky top-0 z-50">
    <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tighter">
            Kom<span class="text-indigo-600">Len</span>
        </a>

        <nav class="flex items-center space-x-6 text-sm font-medium">
            <a href="{{ route('home') }}" class="hover:text-indigo-400 transition">Beranda</a>
            <a href="{{ route('comics.list') }}" class="hover:text-indigo-400 transition">List</a>
            
            <button onclick="toggleTheme()" class="p-2 rounded-lg bg-gray-800 hover:bg-gray-700 transition border border-gray-700 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </button>

            <div class="h-4 w-[1px] bg-gray-700"></div>
             @guest
                <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Login</a>
            @else
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-indigo-400 hover:underline">Admin</a>
                @endif
                
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 text-gray-300 hover:text-red-400 transition">
                        <span class="font-semibold">{{ auth()->user()->username }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            @endguest
        </nav>
    </div>
</header>

<section class="relative bg-gray-900 py-32 overflow-hidden min-h-[500px] flex items-center">
    <div id="hero-bg-container" class="absolute inset-0 grid grid-cols-2 md:grid-cols-5 gap-0"></div>
    <div class="absolute inset-0 hero-overlay"></div>

    <div class="max-w-6xl mx-auto px-4 relative z-10 text-center">
        <span class="inline-block px-4 py-1.5 bg-indigo-600/20 text-indigo-400 text-xs font-bold rounded-full mb-6 tracking-widest uppercase border border-indigo-500/30">
            Koleksi Komik Digital
        </span>
        <h2 class="text-5xl md:text-7xl font-extrabold text-white mb-6 leading-[1.1] tracking-tight">
            Baca Komik Tanpa <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">Batas Waktu.</span>
        </h2>
        <p class="text-gray-400 text-lg mb-10 max-w-2xl mx-auto leading-relaxed">Nikmati Komik Secara Online Kapanpun Dimanapun .</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="#komik-terbaru" class="bg-indigo-600 text-white px-10 py-4 rounded-2xl font-bold hover:bg-indigo-500 transition shadow-2xl shadow-indigo-500/40">Mulai Membaca</a>
            <a href="{{ route('comics.list') }}" class="bg-white/5 backdrop-blur-md text-white border border-white/10 px-10 py-4 rounded-2xl font-bold hover:bg-white/10 transition">Daftar Komik</a>
        </div>
    </div>
</section>

{{-- Seksi Komik Terbaru --}}
<section id="komik-terbaru" class="max-w-6xl mx-auto px-4 py-16">
    <div class="flex items-center justify-between mb-8">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Update Terbaru</h3>
        <a href="{{ route('comics.list') }}" class="text-indigo-500 text-sm font-semibold hover:underline">Lihat Semua</a>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
      @forelse ($comics as $comic)
      <a href="{{ route('comics.show', $comic->slug) }}" class="block group h-full">
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm group-hover:shadow-2xl group-hover:-translate-y-2 overflow-hidden transition-all duration-500 border border-gray-100 dark:border-gray-800 h-full flex flex-col">

          <div class="relative overflow-hidden aspect-[3/4] shrink-0">
              @if($comic->cover_image && file_exists(public_path('storage/'.$comic->cover_image)))
                <img src="{{ asset('storage/'.$comic->cover_image) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="{{ $comic->title }}">
              @else
                <img src="https://placehold.co/300x400?text={{ urlencode($comic->title) }}" class="w-full h-full object-cover" alt="placeholder">
              @endif
              <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-4">
                  <span class="text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">Detail Komik</span>
              </div>
          </div>

          <div class="p-4 flex flex-col flex-grow">
            <h4 class="font-bold text-sm truncate text-gray-900 dark:text-gray-100 mb-2 group-hover:text-indigo-500 transition-colors">{{ $comic->title }}</h4>

            @php
              $limit = 5;
              $totalGenres = $comic->genres->count();
              $more = $totalGenres - $limit;
            @endphp

            <div class="flex flex-wrap gap-1 mb-3 min-h-[40px] content-start">
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

            <div class="flex items-center justify-between pt-3 border-t border-gray-100 dark:border-gray-800 mt-auto">
                <div class="flex items-center gap-3">
                    <div class="flex items-center text-[10px] text-gray-500 dark:text-gray-400 gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        {{ number_format($comic->views_count) }}
                    </div>
                    <div class="flex items-center text-[10px] text-amber-500 gap-1 font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" /></svg>
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
        <p class="text-gray-600 dark:text-gray-400 col-span-full text-center py-20">Belum ada komik tersedia.</p>
      @endforelse
    </div>

    <div class="mt-12 flex justify-center">
      {{ $comics->links() }}
    </div>
</section>

<footer class="bg-gray-900 text-gray-500 text-sm text-center py-10 border-t border-gray-800">
    <div class="mb-4">
        <span class="text-xl font-bold text-white tracking-tighter">Kom<span class="text-indigo-600">Len</span></span>
    </div>
    <p>© {{ date('Y') }} KomLen Digital Library. All rights reserved.</p>
</footer>

<script>
    const comicCovers = [
        @foreach($comics->take(15) as $c)
            "{{ asset('storage/'.$c->cover_image) }}",
        @endforeach
    ];

    const bgContainer = document.getElementById('hero-bg-container');
    const columnCount = window.innerWidth < 768 ? 2 : 5;
    let activeImages = [];

    function initHero() {
        bgContainer.innerHTML = '';
        activeImages = [];
        let shuffled = [...comicCovers].sort(() => 0.5 - Math.random());
        for(let i = 0; i < columnCount; i++) {
            const imgUrl = shuffled[i] || 'https://placehold.co/300x400';
            const imgElement = document.createElement('img');
            imgElement.src = imgUrl;
            imgElement.className = 'hero-bg-img w-full h-full object-cover';
            bgContainer.appendChild(imgElement);
            activeImages.push(imgUrl);
        }
    }

    function rotateImage() {
        const imgs = bgContainer.getElementsByTagName('img');
        if(imgs.length === 0) return;
        const randomIndex = Math.floor(Math.random() * imgs.length);
        const targetImg = imgs[randomIndex];
        let newImgUrl;
        do {
            newImgUrl = comicCovers[Math.floor(Math.random() * comicCovers.length)];
        } while (activeImages.includes(newImgUrl) && comicCovers.length > columnCount);
        targetImg.style.opacity = '0';
        targetImg.style.transform = 'scale(1.1)';
        setTimeout(() => {
            targetImg.src = newImgUrl;
            activeImages[randomIndex] = newImgUrl;
            targetImg.style.opacity = '1';
            targetImg.style.transform = 'scale(1)';
        }, 1500);
    }

    initHero();
    setInterval(rotateImage, 4000);
</script>

</body>
</html>