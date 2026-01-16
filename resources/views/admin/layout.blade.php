<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - KomLen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-slate-950 font-sans text-slate-200">

    <div class="flex h-screen overflow-hidden">

        {{-- Sidebar --}}
        <aside class="bg-slate-900 text-slate-300 w-72 flex flex-col shadow-2xl border-r border-slate-800">
            <div class="p-6 border-b border-slate-800">
                <h2 class="text-white text-2xl font-extrabold tracking-tighter">
                    Kom<span class="text-indigo-500">Len</span> <span class="text-[10px] font-light text-slate-500 uppercase tracking-[0.3em] ml-1">Admin</span>
                </h2>
            </div>

            <div class="px-6 py-4 flex items-center gap-3 bg-slate-800/30">
                <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white font-black shadow-lg shadow-indigo-900/50">
                    {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-bold text-white leading-none">{{ auth()->user()->username }}</p>
                    <p class="text-[10px] text-indigo-400 mt-1 uppercase font-black tracking-widest">Admin</p>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                <p class="px-3 text-[10px] font-black text-slate-600 uppercase tracking-widest mb-4">Main Navigation</p>
                
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/40' : 'hover:bg-slate-800 hover:text-white text-slate-400' }}">
                    <i class="fa-solid fa-chart-pie w-5"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('admin.comics.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.comics.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/40' : 'hover:bg-slate-800 hover:text-white text-slate-400' }}">
                    <i class="fa-solid fa-book-open w-5"></i>
                    <span class="font-medium">Kelola Komik</span>
                </a>

                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.users.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/40' : 'hover:bg-slate-800 hover:text-white text-slate-400' }}">
                    <i class="fa-solid fa-user-shield w-5"></i>
                    <span class="font-medium">Kelola User</span>
                </a>

                <div class="pt-6 pb-2 border-t border-slate-800 mt-6">
                    <p class="px-3 text-[10px] font-black text-slate-600 uppercase tracking-widest mb-4">Website</p>
                </div>

                <a href="{{ route('home') }}" target="_blank"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-all text-slate-400 hover:text-white">
                    <i class="fa-solid fa-arrow-up-right-from-square w-5"></i>
                    <span class="font-medium">Lihat Website</span>
                </a>
            </nav>

            <div class="p-4 border-t border-slate-800">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="flex items-center justify-center gap-2 w-full bg-red-500/10 text-red-500 py-3 rounded-xl hover:bg-red-600 hover:text-white transition-all font-bold text-sm">
                        <i class="fa-solid fa-power-off"></i>
                        <span>LOGOUT</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content Area --}}
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden bg-slate-950">
            {{-- Header --}}
            <header class="bg-slate-900/50 border-b border-slate-800 py-4 px-8 flex justify-between items-center backdrop-blur-md">
                <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest">
                    <i class="fa-solid fa-terminal mr-2 text-indigo-500"></i>
                    @if(request()->routeIs('admin.dashboard')) Overview Status
                    @elseif(request()->routeIs('admin.comics.*')) Comic Management
                    @elseif(request()->routeIs('admin.users.*')) User Authorities
                    @else Admin Panel @endif
                </h3>
                <div class="text-[10px] font-bold text-slate-500 bg-slate-800 px-4 py-2 rounded-full border border-slate-700">
                    <i class="fa-regular fa-clock mr-2"></i>{{ now()->format('D, d M Y') }}
                </div>
            </header>

            {{-- Main Content --}}
            <main class="flex-1 p-8 overflow-y-auto custom-scrollbar">
                
                {{-- Notifikasi --}}
                @if(session('success'))
                    <div class="mb-6 flex items-center gap-3 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 rounded-2xl shadow-lg">
                        <i class="fa-solid fa-circle-check"></i>
                        <p class="text-sm font-bold">{{ session('success') }}</p>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>

    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #020617; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #312e81; }
    </style>

</body>
</html>