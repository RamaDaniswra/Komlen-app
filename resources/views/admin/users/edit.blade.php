@extends('admin.layout')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h1 class="text-3xl font-black text-slate-100 tracking-tight">Edit Profile</h1>
            <p class="text-indigo-400 font-bold italic">User ID: #{{ $user->id }}</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="text-sm font-bold text-slate-500 hover:text-white transition">
            <i class="fa-solid fa-xmark mr-1"></i> Batal
        </a>
    </div>

    <div class="bg-slate-900 p-10 rounded-3xl border border-slate-800 shadow-2xl relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-600/5 blur-[80px] rounded-full"></div>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6 relative z-10">
            @csrf @method('PUT')

            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" 
                       class="w-full bg-slate-800 border-none text-slate-100 p-4 rounded-2xl focus:ring-2 focus:ring-blue-500 transition">
                @error('username') <p class="text-red-500 text-[10px] font-bold mt-2">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                       class="w-full bg-slate-800 border-none text-slate-100 p-4 rounded-2xl focus:ring-2 focus:ring-blue-500 transition">
                @error('email') <p class="text-red-500 text-[10px] font-bold mt-2">{{ $message }}</p> @enderror
            </div>

            <div class="p-6 bg-slate-800/50 rounded-2xl border border-slate-700">
                <label class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-2">Ganti Password</label>
                <input type="password" name="password" placeholder="Biarkan kosong jika tetap" 
                       class="w-full bg-slate-900 border-none text-slate-100 p-4 rounded-xl focus:ring-2 focus:ring-indigo-500 transition">
                <p class="text-[9px] text-slate-600 mt-2 italic font-medium">*Isi kolom ini hanya jika Anda ingin merubah password user.</p>
                @error('password') <p class="text-red-500 text-[10px] font-bold mt-2">{{ $message }}</p> @enderror
            </div>

            <button class="w-full bg-blue-600 text-white py-5 rounded-2xl font-black text-lg hover:bg-blue-500 shadow-xl shadow-blue-900/20 transition-all active:scale-95">
                <i class="fa-solid fa-user-shield mr-2"></i> UPDATE USER DATA
            </button>
        </form>
    </div>
</div>
@endsection