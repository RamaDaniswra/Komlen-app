@extends('admin.layout')

@section('content')
<div class="max-w-7xl mx-auto">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-black text-slate-100 tracking-tight">Edit <span class="text-indigo-500">Chapter {{ $chapter->number }}</span></h1>
            <p class="text-slate-500 font-bold uppercase text-[10px] tracking-widest">{{ $comic->title }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.comics.chapters.index', $comic->id) }}" class="px-6 py-3 bg-slate-800 text-slate-300 rounded-2xl font-bold text-xs hover:bg-slate-700 transition">
                BATAL
            </a>
            <button form="mainForm" class="px-8 py-3 bg-indigo-600 text-white rounded-2xl font-black text-xs hover:bg-indigo-500 shadow-xl shadow-indigo-900/40 transition active:scale-95">
                SIMPAN PERUBAHAN
            </button>
        </div>
    </div>

    <form id="mainForm" action="{{ route('admin.comics.chapters.update', [$comic->id, $chapter->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-slate-900 border border-slate-800 p-8 rounded-[2rem] shadow-xl">
                    <h3 class="text-xs font-black text-slate-500 uppercase tracking-[0.2em] mb-6">Chapter Info</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="text-[10px] font-black text-slate-500 uppercase block mb-2 ml-1">Nomor Chapter</label>
                            <input type="number" name="number" value="{{ old('number', $chapter->number) }}" class="w-full bg-slate-800 border-none text-slate-100 p-4 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition font-bold">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-500 uppercase block mb-2 ml-1">Judul Chapter</label>
                            <input type="text" name="title" value="{{ old('title', $chapter->title) }}" class="w-full bg-slate-800 border-none text-slate-100 p-4 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition font-bold">
                        </div>
                    </div>
                </div>

                <div class="bg-indigo-600/10 border border-indigo-500/20 p-8 rounded-[2rem]">
                    <h3 class="text-xs font-black text-indigo-400 uppercase tracking-[0.2em] mb-4">Tambah Halaman</h3>
                    <p class="text-slate-500 text-[10px] mb-4 font-medium italic">*Gambar baru akan ditambahkan di akhir urutan secara default.</p>
                    <input type="file" name="new_images[]" multiple class="block w-full text-xs text-slate-400 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 transition cursor-pointer">
                </div>
            </div>

            <div class="lg:col-span-8 bg-slate-900 border border-slate-800 p-8 rounded-[2rem] shadow-xl">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="font-black text-slate-100 flex items-center gap-3">
                        <i class="fa-solid fa-layer-group text-indigo-500"></i>
                        Penyusun Halaman <span class="text-slate-600 text-xs font-bold">({{ $chapter->pages->count() }} Total)</span>
                    </h3>
                    <span class="text-[10px] font-bold text-slate-500 uppercase">Gunakan checkbox untuk menghapus</span>
                </div>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach($chapter->pages->sortBy('page_number') as $page)
                        <div class="relative bg-slate-800 rounded-3xl overflow-hidden border-2 border-slate-700 group hover:border-indigo-500/50 transition">
                            
                            <div class="relative">
                                <img src="{{ asset('storage/' . $page->image_path) }}" class="w-full aspect-[2/3] object-cover transition duration-500 group-hover:scale-105" id="img-{{ $page->id }}">
                                
                                <div class="absolute top-3 left-3 bg-slate-900/90 text-white text-[10px] font-black px-3 py-1.5 rounded-xl backdrop-blur-md border border-slate-700">
                                    HLM {{ $loop->iteration }}
                                </div>

                                <label class="absolute top-3 right-3 cursor-pointer group/del">
                                    <input type="checkbox" name="delete_pages[]" value="{{ $page->id }}" class="peer hidden">
                                    <div class="w-8 h-8 bg-slate-900/90 peer-checked:bg-red-600 rounded-xl flex items-center justify-center border border-slate-700 transition group-hover/del:scale-110">
                                        <i class="fa-solid fa-trash-can text-xs text-white"></i>
                                    </div>
                                    <div class="hidden peer-checked:block absolute inset-0 -z-10 bg-red-600/20 backdrop-blur-[2px]"></div>
                                </label>
                            </div>

                            <div class="p-3 bg-slate-900/50">
                                <div class="relative overflow-hidden">
                                    <input type="file" 
                                           name="replace_images[{{ $page->id }}]" 
                                           onchange="previewPageUpdate(this, 'img-{{ $page->id }}')"
                                           class="absolute inset-0 opacity-0 cursor-pointer">
                                    <div class="py-2 text-center border border-slate-700 rounded-xl bg-slate-800 group-hover:bg-slate-700 transition">
                                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-tighter">Ganti File</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function previewPageUpdate(input, imgId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(imgId).src = e.target.result;
                document.getElementById(imgId).classList.add('ring-4', 'ring-indigo-500');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection