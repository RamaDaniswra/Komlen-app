@extends('admin.layout')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h1 class="text-3xl font-black text-slate-100 tracking-tight">Edit Komik</h1>
            <p class="text-indigo-400 font-bold italic">{{ $comic->title }}</p>
        </div>
        <a href="{{ route('admin.comics.index') }}" class="text-sm font-bold text-slate-500 hover:text-white transition">
            <i class="fa-solid fa-xmark mr-1"></i> Batalkan
        </a>
    </div>

    <form action="{{ route('admin.comics.update', $comic->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            {{-- Kiri: Metadata --}}
            <div class="lg:col-span-8 space-y-6">
                <div class="bg-slate-900 p-8 rounded-3xl border border-slate-800 shadow-xl space-y-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Judul Komik</label>
                            <input type="text" name="title" value="{{ old('title', $comic->title) }}" class="w-full bg-slate-800 border-none text-slate-100 p-4 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Author</label>
                            <input type="text" name="author" value="{{ old('author', $comic->author) }}" class="w-full bg-slate-800 border-none text-slate-100 p-4 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Deskripsi</label>
                        <textarea name="description" rows="8" class="w-full bg-slate-800 border-none text-slate-100 p-4 rounded-2xl focus:ring-2 focus:ring-indigo-500 resize-none">{{ old('description', $comic->description) }}</textarea>
                    </div>
                </div>

                {{-- Genre --}}
                <div class="bg-slate-900 p-8 rounded-3xl border border-slate-800 shadow-xl">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4">Perbarui Genre</label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                        @foreach ($genres as $genre)
                        <label class="flex items-center gap-2 p-3 bg-slate-800 rounded-xl cursor-pointer hover:bg-slate-700 transition">
                            <input type="checkbox" name="genres[]" value="{{ $genre->id }}" 
                                {{ in_array($genre->id, $comic->genres->pluck('id')->toArray()) ? 'checked' : '' }}
                                class="rounded bg-slate-900 border-none text-indigo-600 focus:ring-indigo-500">
                            <span class="text-xs text-slate-300">{{ $genre->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Kanan: Cover --}}
           <div class="lg:col-span-4 space-y-6">
    <div class="bg-slate-900 p-6 rounded-3xl border border-slate-800 shadow-xl text-center">
        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4">Cover Image</label>
        
        {{-- Container Image --}}
        <div class="relative group w-full aspect-[3/4] rounded-2xl overflow-hidden shadow-2xl border border-slate-700 mb-6 bg-slate-800">
            {{-- Image Display --}}
            <img id="image_preview" 
                 src="{{ asset('storage/' . $comic->cover_image) }}" 
                 class="w-full h-full object-cover transition-opacity duration-300">
            
            {{-- Overlay Label (Hanya muncul saat hover) --}}
            <div class="absolute inset-0 bg-slate-900/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer" 
                 onclick="document.getElementById('edit_cover').click()">
                <span class="bg-white text-slate-900 text-[10px] font-black px-4 py-2 rounded-full shadow-xl">GANTI GAMBAR</span>
            </div>
        </div>
        
        {{-- Hidden Input --}}
        <input type="file" name="cover_image" id="edit_cover" class="hidden" accept="image/*" onchange="previewImage(event)">
        
        <div class="text-[9px] text-slate-500 font-bold uppercase tracking-tighter">
            <i class="fa-solid fa-circle-info mr-1 text-indigo-500"></i> Klik gambar atau tombol di bawah untuk mengubah
        </div>
        
        <button type="button" 
                onclick="document.getElementById('edit_cover').click()"
                class="mt-4 w-full py-3 border-2 border-dashed border-slate-700 rounded-xl text-[10px] font-black text-slate-500 hover:border-indigo-500 hover:text-indigo-400 transition uppercase tracking-widest">
            Pilih File Baru
        </button>
    </div>

    <button type="submit" class="w-full bg-indigo-600 text-white py-5 rounded-2xl font-black text-lg hover:bg-indigo-500 shadow-xl shadow-indigo-900/20 transition-all active:scale-95">
        <i class="fa-solid fa-check-double mr-2"></i> UPDATE KOMIK
    </button>
</div>
<script>
    function previewImage(event) {
        const reader = new FileReader();
        const file = event.target.files[0];
        const preview = document.getElementById('image_preview');
        
        reader.onload = function() {
            preview.style.opacity = '0';
            setTimeout(() => {
                preview.src = reader.result;
                preview.style.opacity = '1';
            }, 200);
        }
        
        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
    </form>
</div>
@endsection