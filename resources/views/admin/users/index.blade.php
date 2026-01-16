@extends('admin.layout')

@section('content')
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
    <div>
        <h1 class="text-4xl font-black text-slate-100 tracking-tighter">Users</h1>
        <p class="text-slate-500 font-medium italic">Kelola data pengguna</p>
    </div>
    <a href="{{ route('admin.users.create') }}"
       class="bg-indigo-600 text-white px-8 py-4 rounded-2xl shadow-xl shadow-indigo-900/30 hover:bg-indigo-500 transition-all font-black flex items-center gap-3 active:scale-95">
       <i class="fa-solid fa-user-plus"></i> Tambah User
    </a>
</div>

<div class="bg-slate-900 rounded-3xl border border-slate-800 shadow-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-800/50 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">
                    <th class="px-8 py-5 w-20">ID</th>
                    <th class="px-8 py-5">Identity</th>
                    <th class="px-8 py-5">Joined Date</th>
                    <th class="px-8 py-5">Role</th>
                    <th class="px-8 py-5 text-right pr-12">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800">
                @foreach($users as $u)
                <tr class="hover:bg-slate-800/30 transition group">
                    <td class="px-8 py-6">
                        <span class="text-slate-600 font-mono text-xs">#{{ $u->id }}</span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-indigo-400 font-black shadow-inner">
                                {{ strtoupper(substr($u->username, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-bold text-slate-200 group-hover:text-white transition">{{ $u->username }}</p>
                                <p class="text-xs text-slate-500">{{ $u->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-sm text-slate-400 font-medium italic">
                            <i class="fa-regular fa-calendar text-slate-600 mr-2"></i>{{ $u->created_at->format('d M Y') }}
                        </p>
                    </td>
                    <td class="px-8 py-6">
                        @if($u->role === 'admin')
                            <span class="px-3 py-1 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 rounded-full text-[10px] font-black uppercase tracking-widest shadow-[0_0_15px_rgba(99,102,241,0.1)]">
                                <i class="fa-solid fa-shield-halved mr-1"></i> Admin
                            </span>
                        @else
                            <span class="px-3 py-1 bg-slate-800 text-slate-500 border border-slate-700 rounded-full text-[10px] font-black uppercase tracking-widest">
                                <i class="fa-solid fa-user mr-1"></i> User
                            </span>
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex justify-end gap-3">
                            <a href="{{ route('admin.users.edit', $u->id) }}"
                               class="w-10 h-10 flex items-center justify-center bg-slate-800 text-blue-400 rounded-xl hover:bg-blue-600 hover:text-white transition shadow-lg">
                               <i class="fa-solid fa-user-pen"></i>
                            </a>
                            <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="w-10 h-10 flex items-center justify-center bg-slate-800 text-red-500 rounded-xl hover:bg-red-600 hover:text-white transition shadow-lg"
                                        onclick="return confirm('Hapus user ini?')">
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
    @if($users->hasPages())
    <div class="p-8 bg-slate-900/50 border-t border-slate-800">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection