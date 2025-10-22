@extends('layouts.backend.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="mb-4">{{ isset($penilaian) ? 'Edit' : 'Tambah' }} Penilaian</h1>

    @if($errors->any())
        <div class="alert alert-danger mb-3">
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
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control w-full" value="{{ old('judul', $penilaian->judul ?? '') }}" required>
        </div>

        {{-- Tanggal --}}
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control w-full" value="{{ old('tanggal', $penilaian->tanggal ?? '') }}">
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="editor" class="form-control w-full">{{ old('deskripsi', $penilaian->deskripsi ?? '') }}</textarea>
        </div>

        {{-- Upload File Dinamis --}}
        <div class="mb-3">
            <label class="form-label">Upload File</label>
            <div id="file-container" class="space-y-2">
                {{-- Input baru --}}
                <div class="file-row flex flex-col sm:flex-row gap-2">
                    <input type="file" name="file_upload[]" class="form-control w-full sm:flex-1">
                    <input type="text" name="file_title[]" class="form-control w-full sm:flex-1" placeholder="Judul file">
                    <button type="button" class="btn btn-danger remove-file w-full sm:w-auto">Hapus</button>
                </div>

                {{-- File lama --}}
                @if(isset($penilaian) && $penilaian->file_upload)
                    @foreach($penilaian->file_upload as $file)
                        <div class="file-row flex flex-col sm:flex-row gap-2">
                            <input type="text" class="form-control w-full sm:flex-1" value="{{ $file['title'] }}" readonly>
                            <a href="{{ asset('storage/' . $file['path']) }}" target="_blank" class="btn btn-info w-full sm:w-auto">Lihat File</a>
                            <button type="button" class="btn btn-danger remove-file w-full sm:w-auto">Hapus</button>
                        </div>
                    @endforeach
                @endif
            </div>
            <button type="button" id="add-file" class="btn btn-primary mt-2 w-full sm:w-auto">Tambah File</button>
        </div>

        {{-- Tombol --}}
        <div class="flex flex-col sm:flex-row gap-3">
            <button type="submit" class="btn btn-primary w-full sm:w-auto">{{ isset($penilaian) ? 'Perbarui' : 'Simpan' }}</button>
            <a href="{{ route('penilaian.index') }}" class="btn btn-secondary w-full sm:w-auto text-center">Batal</a>
        </div>
    </form>
</div>

{{-- CKEditor 5 --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
let editor;
ClassicEditor
    .create(document.querySelector('#editor'), {
        toolbar: [
            'heading','|','bold','italic','link','bulletedList',
            'numberedList','blockQuote','|','undo','redo'
        ]
    })
    .then(newEditor => {
        editor = newEditor;
    })
    .catch(error => {
        console.error('CKEditor error:', error);
    });

document.querySelector('form').addEventListener('submit', function(){
    document.querySelector('#editor').value = editor.getData();
});

// Tambah / Hapus file dinamis
document.getElementById('add-file').addEventListener('click', function() {
    const container = document.getElementById('file-container');
    const div = document.createElement('div');
    div.classList.add('file-row','flex','flex-col','sm:flex-row','gap-2');
    div.innerHTML = `
        <input type="file" name="file_upload[]" class="form-control w-full sm:flex-1">
        <input type="text" name="file_title[]" class="form-control w-full sm:flex-1" placeholder="Judul file">
        <button type="button" class="btn btn-danger remove-file w-full sm:w-auto">Hapus</button>
    `;
    container.appendChild(div);
});

document.getElementById('file-container').addEventListener('click', function(e){
    if(e.target && e.target.classList.contains('remove-file')){
        e.target.parentNode.remove();
    }
});
</script>
@endsection
