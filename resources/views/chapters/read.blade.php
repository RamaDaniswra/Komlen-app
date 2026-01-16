@extends('layouts.public')

@section('content')

<style>
    .reply-form { display: none; }
    .reply-form.active { display: block; }
</style>

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
            
            <a href="{{ route('comics.show', $comic->slug) }}" class="text-sm font-medium text-gray-400 hover:text-white transition flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Daftar Chapter
            </a>
        </div>
    </div>
</header>

<main class="max-w-3xl mx-auto py-12 px-4 transition-colors">

    <div class="mb-10 text-center">
        <h2 class="text-3xl font-black text-gray-900 dark:text-white leading-tight mb-2 uppercase">{{ $comic->title }}</h2>
        <p class="text-indigo-600 dark:text-indigo-400 font-bold tracking-[0.2em] text-sm italic">Chapter {{ $chapter->number }}</p>
    </div>

    {{-- Content --}}
    <div class="space-y-1">
        @foreach($chapter->pages as $page)
            <img src="{{ asset('storage/' . $page->image_path) }}" class="w-full shadow-2xl dark:shadow-none" alt="Halaman {{ $page->page_number }}" loading="lazy">
        @endforeach
    </div>

    {{-- Navigation --}}
    <div class="flex flex-col sm:flex-row justify-center items-center mt-16 gap-4">
        @if($prev)
            <a href="{{ route('chapters.read', [$comic->slug, $prev->number]) }}" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-gray-900 dark:bg-gray-800 text-white px-8 py-3.5 rounded-2xl hover:bg-black dark:hover:bg-gray-700 transition font-bold shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg> Sebelumnya
            </a>
        @endif

        @if($next)
            <a href="{{ route('chapters.read', [$comic->slug, $next->number]) }}" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-indigo-600 text-white px-8 py-3.5 rounded-2xl hover:bg-indigo-500 transition font-black shadow-xl shadow-indigo-500/20">
                Berikutnya <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        @endif
    </div>

    {{-- Comments Section --}}
    <div class="mt-24 border-t border-gray-100 dark:border-gray-800 pt-16">
        
        @auth
            <form action="{{ route('comment.store', $chapter->id) }}" method="POST" class="bg-white dark:bg-gray-950 p-6 rounded-[2rem] shadow-sm border border-gray-100 dark:border-gray-800 mb-12">
                @csrf
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-2 h-6 bg-indigo-600 rounded-full"></div>
                    <h4 class="text-xl font-black text-gray-900 dark:text-white uppercase tracking-tighter">Diskusi</h4>
                </div>
                <textarea name="content" class="w-full p-4 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-700 text-gray-900 dark:text-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition" rows="3" placeholder="Tuliskan pendapatmu..." required></textarea>
                <div class="flex justify-end mt-3">
                    <button class="bg-indigo-600 text-white px-8 py-2.5 rounded-xl font-black hover:bg-indigo-500 transition-all text-sm">KIRIM</button>
                </div>
            </form>
        @endauth

        <div class="space-y-6">
            @forelse ($comments->where('parent_id', null) as $comment)
                <div class="group bg-white dark:bg-gray-950/50 p-6 rounded-[2rem] border border-gray-50 dark:border-gray-800/50 transition-all">
                    <div class="flex gap-4">
                        <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white font-black shrink-0 shadow-lg shadow-indigo-500/20">
                            {{ strtoupper(substr($comment->user->username, 0, 1)) }}
                        </div>
                        
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <div class="flex items-center gap-2">
                                    <span class="font-black text-gray-900 dark:text-gray-100 text-sm uppercase tracking-tight">{{ $comment->user->username }}</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase">{{ $comment->created_at->diffForHumans() }}</span>
                                    
                                    @auth
                                        @if(auth()->user()->role === 'admin' || auth()->id() == $comment->user_id)
                                            <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Hapus komentar ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-gray-400 hover:text-red-500 transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                            
                            <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-3">{{ $comment->content }}</p>

                            @auth
                                <button onclick="toggleReplyForm('{{ $comment->id }}')" class="text-[10px] font-black text-indigo-600 dark:text-indigo-400 uppercase tracking-widest hover:underline flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" /></svg>
                                    Reply
                                </button>
                                
                                <form id="reply-form-{{ $comment->id }}" action="{{ route('comment.store', $chapter->id) }}" method="POST" class="reply-form mt-4">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <textarea name="content" class="w-full p-3 bg-gray-100 dark:bg-gray-800 border-none text-sm text-gray-900 dark:text-gray-100 rounded-xl focus:ring-1 focus:ring-indigo-500 outline-none transition" rows="2" placeholder="Balas komentar {{ $comment->user->username }}..." required></textarea>
                                    <div class="flex justify-end mt-2">
                                        <button class="bg-indigo-600 text-white px-4 py-1.5 rounded-lg font-bold text-[10px] hover:bg-indigo-500 transition uppercase">Kirim Balasan</button>
                                    </div>
                                </form>
                            @endauth

                            @if($comment->replies->count() > 0)
                                <div class="mt-6 ml-2 pl-4 border-l-2 border-indigo-100 dark:border-gray-800 space-y-6">
                                    @foreach($comment->replies as $reply)
                                        <div class="flex gap-3 relative">
                                            <div class="w-8 h-8 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-[10px] font-black text-indigo-600 shrink-0 border border-gray-200 dark:border-gray-700">
                                                {{ strtoupper(substr($reply->user->username, 0, 1)) }}
                                            </div>

                                            <div class="flex-1">
                                                <div class="flex items-center justify-between mb-1">
                                                    <div class="flex items-center gap-2">
                                                        <span class="font-bold text-gray-900 dark:text-gray-100 text-xs">{{ $reply->user->username }}</span>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <span class="text-[9px] text-gray-400 uppercase">{{ $reply->created_at->diffForHumans() }}</span>
                                                        @auth
                                                            @if(auth()->user()->role === 'admin' || auth()->id() == $reply->user_id)
                                                                <form action="{{ route('comment.destroy', $reply->id) }}" method="POST">
                                                                    @csrf @method('DELETE')
                                                                    <button type="submit" class="text-gray-300 hover:text-red-500 transition"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                                                                </form>
                                                            @endif
                                                        @endauth
                                                    </div>
                                                </div>
                                                
                                                <p class="text-gray-500 dark:text-gray-400 text-xs leading-relaxed">
                                                    {!! $reply->content !!}
                                                </p>
                                                
                                                @auth
                                                    <button onclick="toggleReplyForm('{{ $reply->id }}')" class="text-[9px] font-bold text-gray-400 mt-1 uppercase hover:text-indigo-500 transition">Reply</button>
                                                    
                                                    <form id="reply-form-{{ $reply->id }}" action="{{ route('comment.store', $chapter->id) }}" method="POST" class="reply-form mt-3">
                                                        @csrf
                                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                        <textarea name="content" class="w-full p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-xs rounded-lg outline-none focus:ring-1 focus:ring-indigo-500" rows="2" placeholder="Balas {{ $reply->user->username }}..." required></textarea>
                                                        <div class="flex justify-end mt-1">
                                                            <button class="bg-gray-800 dark:bg-indigo-600 text-white px-3 py-1 rounded-md text-[9px] font-bold uppercase">Kirim</button>
                                                        </div>
                                                    </form>
                                                @endauth
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 text-gray-500 italic text-sm">Belum ada diskusi.</div>
            @endforelse
        </div>
    </div>
</main>

<script>
    function toggleReplyForm(commentId) {
        document.querySelectorAll('.reply-form').forEach(form => {
            if(form.id !== `reply-form-${commentId}`) {
                form.classList.remove('active');
            }
        });
        const form = document.getElementById(`reply-form-${commentId}`);
        form.classList.toggle('active');
    }
</script>

@endsection