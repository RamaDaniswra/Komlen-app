@extends('admin.layout')

@section('content')
<div class="max-w-6xl mx-auto">
    {{-- Header --}}
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.comics.index') }}" class="flex items-center justify-center w-10 h-10 bg-slate-800 text-slate-400 rounded-xl hover:bg-slate-700 transition shadow-lg">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-3xl font-black text-slate-100 tracking-tighter">Tambah Komik Baru</h1>
        
        </div>
    </div>

    <form action="{{ route('admin.comics.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-slate-900 p-8 rounded-3xl border border-slate-800 shadow-2xl space-y-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-600/5 blur-[80px]"></div>
                    
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Judul Utama Komik</label>
                        <input type="text" name="title" value="{{ old('title') }}" 
                               class="w-full bg-slate-800 border-none text-slate-100 p-4 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition placeholder:text-slate-600 font-bold" 
                               placeholder="Judul">
                        @error('title') <p class="text-red-500 text-[10px] font-bold mt-2 uppercase italic">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Penulis / Author</label>
                        <input type="text" name="author" value="{{ old('author') }}" 
                               class="w-full bg-slate-800 border-none text-slate-100 p-4 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition placeholder:text-slate-600 font-bold" 
                               placeholder="Nama penulis...">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Sinopsis Cerita</label>
                        <textarea name="description" rows="8" 
                                  class="w-full bg-slate-800 border-none text-slate-100 p-4 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none resize-none transition placeholder:text-slate-600 font-medium" 
                                  placeholder="Tulis ringkasan cerita di sini...">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                
                <div class="bg-slate-900 p-6 rounded-3xl border border-slate-800 shadow-2xl">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4 text-center">Cover Display</label>
                    
                    <div class="relative group border-2 border-dashed border-slate-700 rounded-2xl p-2 hover:border-indigo-500 transition cursor-pointer bg-slate-800/30 overflow-hidden" 
                         onclick="document.getElementById('cover_input').click()">
                        
                        <input type="file" name="cover_image" id="cover_input" class="hidden" accept="image/*" onchange="previewImage(event)">
                        
                        <div id="preview_container" class="hidden w-full h-80 rounded-xl overflow-hidden shadow-inner">
                            <img id="image_preview" class="w-full h-full object-cover">
                        </div>

                        <div id="placeholder_info" class="text-center py-16 text-slate-600 group-hover:text-indigo-400 transition">
                            <i class="fa-solid fa-cloud-arrow-up text-5xl mb-4"></i>
                            <p class="text-[10px] font-black tracking-widest uppercase">Pilih Cover Image</p>
                            <p class="text-[9px] mt-2 italic font-medium">Recomended: 3:4 Aspect Ratio</p>
                        </div>

                        <div id="change_overlay" class="hidden absolute inset-0 bg-slate-900/80 items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                            <span class="text-[10px] font-black text-white bg-indigo-600 px-6 py-3 rounded-full shadow-2xl transform scale-90 group-hover:scale-100 transition-transform">
                                <i class="fa-solid fa-sync mr-2"></i>GANTI GAMBAR
                            </span>
                        </div>
                    </div>
                    @error('cover_image') <p class="text-red-500 text-[10px] font-bold mt-3 text-center uppercase">{{ $message }}</p> @enderror
                </div>

                <div class="bg-slate-900 p-6 rounded-3xl border border-slate-800 shadow-2xl">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4 text-center">Kategori Genre</label>
                    <div class="grid grid-cols-2 gap-2 max-h-40 overflow-y-auto pr-2 custom-scrollbar">
                        @foreach ($genres as $g)
                        <label class="flex items-center gap-3 p-3 bg-slate-800/50 rounded-xl cursor-pointer hover:bg-slate-700 border border-transparent hover:border-indigo-500/30 transition group">
                            <input type="checkbox" name="genres[]" value="{{ $g->id }}" 
                                   class="w-4 h-4 rounded border-none bg-slate-900 text-indigo-600 focus:ring-offset-slate-900 focus:ring-indigo-500">
                            <span class="text-[11px] font-bold text-slate-400 group-hover:text-slate-100 transition">{{ $g->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white py-5 rounded-2xl font-black text-sm uppercase tracking-[0.3em] hover:bg-indigo-500 shadow-2xl shadow-indigo-900/30 transition-all active:scale-95 group">
                    SIMPAN KOMIK <i class="fa-solid fa-chevron-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        const file = event.target.files[0];
        
        reader.onload = function() {
            const preview = document.getElementById('image_preview');
            const container = document.getElementById('preview_container');
            const placeholder = document.getElementById('placeholder_info');
            const overlay = document.getElementById('change_overlay');

            preview.src = reader.result;
            container.classList.remove('hidden');
            placeholder.classList.add('hidden');
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
        }
        
        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #4f46e5; }
</style>
@endsection