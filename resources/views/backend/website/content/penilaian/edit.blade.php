@extends('layouts.backend.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-5 text-2xl font-bold text-gray-800">{{ isset($penilaian) ? 'Edit' : 'Tambah' }} Penilaian</h1>

    @if($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($penilaian) ? route('penilaian.update', $penilaian->id) : route('penilaian.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($penilaian)) @method('PUT') @endif

        {{-- Judul --}}
        <div class="mb-4">
            <label for="judul" class="form-label font-semibold">Judul</label>
            <input type="text" name="judul" class="form-control border rounded px-3 py-2 w-full" value="{{ old('judul', $penilaian->judul ?? '') }}" required>
        </div>

        {{-- Tanggal --}}
        <div class="mb-4">
            <label for="tanggal" class="form-label font-semibold">Tanggal</label>
            <input type="date" name="tanggal" class="form-control border rounded px-3 py-2 w-full" value="{{ old('tanggal', $penilaian->tanggal ?? '') }}">
        </div>

        {{-- Deskripsi --}}
        <div class="mb-5">
            <label for="deskripsi" class="form-label font-semibold">Deskripsi</label>
            <textarea name="deskripsi" id="editor" class="form-control border rounded px-3 py-2 w-full">{{ old('deskripsi', $penilaian->deskripsi ?? '') }}</textarea>
        </div>

        {{-- File Lama --}}
        @if(isset($penilaian) && $penilaian->file_upload)
            <div class="mb-5">
                <label class="form-label font-semibold">File Saat Ini</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach($penilaian->file_upload as $index => $file)
                        <div class="relative border rounded-lg p-3 flex items-center justify-between bg-gray-50">
                            <a href="{{ asset('storage/' . $file['path']) }}" target="_blank" class="file-link px-3 py-1 rounded font-medium">
                                {{ $file['title'] ?? 'Lihat File' }}
                            </a>
                            <button type="button" class="btn btn-sm btn-danger remove-old-file text-white px-3 py-1 rounded ml-2">
                                Hapus
                            </button>
                            <input type="hidden" name="existing_files[{{ $index }}][path]" value="{{ $file['path'] }}">
                            <input type="hidden" name="existing_files[{{ $index }}][title]" value="{{ $file['title'] }}">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Upload File Baru --}}
        <div class="mb-5">
            <label class="form-label font-semibold">Upload File Baru</label>
            <div id="file-container" class="space-y-3">
                <div class="file-row flex gap-3 items-center">
                    <input type="file" name="file_upload_new[]" class="form-control border rounded px-3 py-2 flex-1">
                    <input type="text" name="file_title_new[]" class="form-control border rounded px-3 py-2 flex-1" placeholder="Judul file">
                    <button type="button" class="btn btn-danger remove-file bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Hapus</button>
                </div>
            </div>
            <button type="button" id="add-file" class="btn btn-primary mt-3 bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded">Tambah File</button>
        </div>

        {{-- Tombol Simpan & Batal tetap sama --}}
        <div class="flex gap-3">
            <button type="submit" class="btn btn-primary bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded">Simpan</button>
            <a href="{{ route('penilaian.index') }}" class="btn btn-secondary bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded">Batal</a>
        </div>
    </form>
</div>

{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
ClassicEditor
    .create(document.querySelector('#editor'), {
        toolbar: [
            'heading','|','bold','italic','link','bulletedList','numberedList','blockQuote','|','undo','redo'
        ]
    })
    .catch(error => console.error(error));

// Tambah file baru
document.getElementById('add-file').addEventListener('click', function() {
    const container = document.getElementById('file-container');
    const div = document.createElement('div');
    div.classList.add('file-row','flex','gap-3','items-center');
    div.innerHTML = `
        <input type="file" name="file_upload_new[]" class="form-control border rounded px-3 py-2 flex-1">
        <input type="text" name="file_title_new[]" class="form-control border rounded px-3 py-2 flex-1" placeholder="Judul file">
        <button type="button" class="btn btn-danger remove-file bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Hapus</button>
    `;
    container.appendChild(div);
});

// Hapus file baru
document.getElementById('file-container').addEventListener('click', function(e){
    if(e.target && e.target.classList.contains('remove-file')){
        e.target.parentNode.remove();
    }
});

// Hapus file lama
document.querySelectorAll('.remove-old-file').forEach(button => {
    button.addEventListener('click', function() {
        const parent = this.parentNode;
        parent.querySelectorAll('input[type="hidden"]').forEach(input => input.remove());
        parent.remove();
    });
});
</script>

<style>
.file-link {
    color: #000;
    background-color: #3B82F6; /* biru */
    padding: 5px 10px;
    border-radius: 6px;
    text-decoration: none;
    display: inline-block;
}
.file-link:hover {
    background-color: #2563EB;
}
</style>
@endsection
