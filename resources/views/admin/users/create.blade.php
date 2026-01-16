@extends('admin.layout')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.users.index') }}" class="flex items-center justify-center w-10 h-10 bg-slate-800 text-slate-400 rounded-xl hover:bg-slate-700 transition">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h1 class="text-3xl font-black text-slate-100">Registrasi User</h1>
    </div>

    <div class="bg-slate-900 p-10 rounded-3xl border border-slate-800 shadow-2xl">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Username</label>
                <div class="relative">
                    <span class="absolute left-4 top-4 text-slate-500"><i class="fa-solid fa-at"></i></span>
                    <input type="text" name="username" value="{{ old('username') }}" 
                           class="w-full bg-slate-800 border-none text-slate-100 p-4 pl-12 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition" 
                           placeholder="Username">
                </div>
                @error('username') <p class="text-red-500 text-xs font-bold mt-2 ml-2 italic">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Email Address</label>
                <div class="relative">
                    <span class="absolute left-4 top-4 text-slate-500"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" value="{{ old('email') }}" 
                           class="w-full bg-slate-800 border-none text-slate-100 p-4 pl-12 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition" 
                           placeholder="name@example.com">
                </div>
                @error('email') <p class="text-red-500 text-xs font-bold mt-2 ml-2 italic">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Security Password</label>
                <div class="relative">
                    <span class="absolute left-4 top-4 text-slate-500"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" 
                           class="w-full bg-slate-800 border-none text-slate-100 p-4 pl-12 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition" 
                           placeholder="••••••••">
                </div>
                @error('password') <p class="text-red-500 text-xs font-bold mt-2 ml-2 italic">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-5 rounded-2xl font-black text-lg hover:bg-indigo-500 shadow-xl shadow-indigo-900/20 transition-all active:scale-95">
                <i class="fa-solid fa-user-check mr-2"></i> CREATE ACCOUNT
            </button>
        </form>
    </div>
</div>
@endsection