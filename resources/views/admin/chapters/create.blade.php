@extends('admin.layout')

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #4f46e5; }
    input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
</style>

@section('content')
<div class="max-w-5xl mx-auto">
    {{-- Header --}}
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.comics.chapters.index', $comic->id) }}" class="flex items-center justify-center w-10 h-10 bg-slate-800 text-slate-400 rounded-xl hover:bg-slate-700 transition shadow-lg">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-3xl font-extrabold text-slate-100">Tambah Chapter</h1>
            <p class="text-slate-500 text-sm">Komik: <span class="text-indigo-400 font-medium">{{ $comic->title }}</span></p>
        </div>
    </div>

    <div class="bg-slate-900 p-8 rounded-[2.5rem] shadow-2xl border border-slate-800">
        <form id="uploadForm" class="space-y-6">
            @csrf
            {{-- Info Chapter --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2 ml-1">Nomor Chapter</label>
                    <input type="number" id="number" name="number" class="w-full bg-slate-800 border-none text-slate-100 p-4 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition outline-none font-bold" placeholder="Contoh: 05">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2 ml-1">Judul Chapter</label>
                    <input type="text" id="title" name="title" class="w-full bg-slate-800 border-none text-slate-100 p-4 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition outline-none font-bold" placeholder="Contoh: Awal Mula">
                </div>
            </div>

            {{-- Dropzone --}}
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2 ml-1">Upload Halaman</label>
                <div id="dropzone" class="group relative border-2 border-dashed border-slate-700 rounded-[2rem] p-10 text-center hover:border-indigo-500 hover:bg-indigo-500/5 transition cursor-pointer mb-6" onclick="document.getElementById('images').click()">
                    <input type="file" id="images" multiple class="hidden" accept="image/*" onchange="handleFileSelect(event)">
                    <div class="text-slate-500 group-hover:text-indigo-400 transition">
                        <i class="fa-solid fa-images text-5xl mb-4"></i>
                        <p class="text-lg font-bold">Pilih atau Seret Gambar</p>
                        <p class="text-[10px] opacity-60 mt-1 italic uppercase font-black">Urutan akan otomatis disesuaikan dengan nama file</p>
                    </div>
                </div>

                {{-- Preview Grid --}}
                <div id="previewGrid" class="hidden grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 bg-slate-800/20 p-6 rounded-[2rem] border border-slate-800 mb-8 max-h-[600px] overflow-y-auto custom-scrollbar">
                    </div>
                
                {{-- Progress Bar --}}
                <div id="progressWrapper" class="hidden mt-8 bg-slate-800 p-6 rounded-2xl border border-slate-700 shadow-inner">
                    <div class="flex justify-between items-center mb-4">
                        <span id="statusText" class="text-xs font-black text-indigo-400 uppercase tracking-widest">Menyiapkan...</span>
                        <span id="percentText" class="text-sm font-black text-slate-100">0%</span>
                    </div>
                    <div class="w-full bg-slate-700 rounded-full h-3 overflow-hidden">
                        <div id="progressBar" class="bg-gradient-to-r from-indigo-600 to-indigo-400 h-full rounded-full transition-all duration-300" style="width: 0%"></div>
                    </div>
                </div>
            </div>

            <button type="button" id="btnSubmit" class="w-full bg-indigo-600 text-white py-5 rounded-2xl font-black text-lg hover:bg-indigo-500 shadow-xl shadow-indigo-900/40 transition-all active:scale-95">
                <i class="fa-solid fa-cloud-arrow-up mr-2"></i> SIMPAN & UPLOAD CHAPTER
            </button>
        </form>
    </div>
</div>

<script>
    let selectedFiles = [];

    function handleFileSelect(event) {
        const fileList = event.target.files;
        if (fileList.length === 0) return;

        let newFiles = Array.from(fileList).map(file => ({
            file: file,
            tempId: Math.random().toString(36).substr(2, 9) 
        }));

        selectedFiles = [...selectedFiles, ...newFiles];

        autoSortFiles();
        renderPreview();
    }

    function autoSortFiles() {
        selectedFiles.sort((a, b) => {
            return a.file.name.localeCompare(b.file.name, undefined, {numeric: true, sensitivity: 'base'});
        });
    }

    function renderPreview() {
        const previewGrid = document.getElementById('previewGrid');
        const dropzone = document.getElementById('dropzone');
        previewGrid.innerHTML = '';

        if (selectedFiles.length > 0) {
            previewGrid.classList.remove('hidden');
            previewGrid.classList.add('grid');
            dropzone.classList.add('p-6');
            dropzone.classList.remove('p-10');

            selectedFiles.forEach((item, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = "relative group aspect-[2/3] rounded-2xl overflow-hidden border-2 border-slate-800 bg-slate-900 shadow-lg transition hover:border-indigo-500";
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover opacity-60">
                        
                        <div class="absolute top-2 left-2 right-2 flex justify-between items-start opacity-0 group-hover:opacity-100 transition">
                            <span class="bg-slate-900/90 backdrop-blur text-[8px] text-slate-400 p-1 rounded border border-slate-700 truncate max-w-[70%]">
                                ${item.file.name}
                            </span>
                            <button type="button" onclick="removeFile(${index})" class="w-6 h-6 bg-red-600 text-white rounded-lg flex items-center justify-center shadow-lg hover:bg-red-500">
                                <i class="fa-solid fa-xmark text-[10px]"></i>
                            </button>
                        </div>

                        <div class="absolute bottom-0 left-0 right-0 bg-slate-900/90 p-2 flex items-center gap-2 border-t border-slate-800">
                            <span class="text-[9px] font-black text-slate-500 uppercase">HLM</span>
                            <input type="number" 
                                   value="${index + 1}" 
                                   onchange="changeOrder(${index}, this.value)"
                                   class="w-full bg-indigo-600 text-white text-center text-xs font-black rounded-lg border-none focus:ring-1 focus:ring-white p-1">
                        </div>
                    `;
                    previewGrid.appendChild(div);
                }
                reader.readAsDataURL(item.file);
            });
        } else {
            previewGrid.classList.add('hidden');
        }
    }

    function changeOrder(oldIndex, newOrder) {
        newOrder = parseInt(newOrder);
        if (isNaN(newOrder) || newOrder < 1) { renderPreview(); return; }

        const item = selectedFiles.splice(oldIndex, 1)[0];
        selectedFiles.splice(newOrder - 1, 0, item);
        
        renderPreview();
    }

    function removeFile(index) {
        selectedFiles.splice(index, 1);
        renderPreview();
    }

    document.getElementById('btnSubmit').addEventListener('click', async function() {
        const number = document.getElementById('number').value;
        const title = document.getElementById('title').value;

        if (!number || !title || selectedFiles.length === 0) {
            alert('Lengkapi data chapter dan pilih gambar!');
            return;
        }

        this.disabled = true;
        this.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin mr-2"></i> MENGUPLOAD...';
        document.getElementById('progressWrapper').classList.remove('hidden');

        for (let i = 0; i < selectedFiles.length; i++) {
            const formData = new FormData();
            formData.append('number', number);
            formData.append('title', title);
            formData.append('image', selectedFiles[i].file);
            formData.append('page_index', i + 1); 
            formData.append('_token', '{{ csrf_token() }}');

            try {
                const response = await fetch("{{ route('admin.comics.chapters.store', $comic->id) }}", {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });

                const result = await response.json();
                if (!response.ok) throw new Error(result.message || 'Gagal upload');

                const percent = Math.round(((i + 1) / selectedFiles.length) * 100);
                document.getElementById('progressBar').style.width = percent + '%';
                document.getElementById('percentText').innerText = percent + '%';
                document.getElementById('statusText').innerText = `Halaman ${i + 1} Selesai`;

            } catch (error) {
                alert('Eror pada halaman ' + (i+1) + ': ' + error.message);
                this.disabled = false;
                this.innerHTML = '<i class="fa-solid fa-paper-plane mr-2"></i> COBA LAGI';
                return;
            }
        }

        alert('Berhasil! Chapter ' + number + ' sudah terbit.');
        window.location.href = "{{ route('admin.comics.chapters.index', $comic->id) }}";
    });
</script>
@endsection