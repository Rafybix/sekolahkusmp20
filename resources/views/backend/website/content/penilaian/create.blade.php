@extends('layouts.backend.app')

@section('content')
<div class="container-xxl mt-3">
    <h1 class="mb-4">{{ isset($penilaian) ? 'Edit' : 'Tambah' }} Penilaian</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            {{-- Error Validation --}}
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

                <div class="row g-3">
                    {{-- Judul --}}
                    <div class="col-12">
                        <label for="judul" class="form-label fw-semibold">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $penilaian->judul ?? '') }}" required>
                    </div>

                    {{-- Tanggal --}}
                    <div class="col-md-6 col-12">
                        <label for="tanggal" class="form-label fw-semibold">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal', $penilaian->tanggal ?? '') }}">
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-12">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" id="editor" class="form-control" rows="6">{{ old('deskripsi', $penilaian->deskripsi ?? '') }}</textarea>
                    </div>

                    {{-- Upload File Dinamis --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">Upload File</label>
                        <div id="file-container" class="d-flex flex-column gap-2">

                            {{-- Input baru --}}
                            <div class="file-row row g-2 align-items-center">
                                <div class="col-md-5 col-12">
                                    <input type="file" name="file_upload[]" class="form-control">
                                </div>
                                <div class="col-md-5 col-12">
                                    <input type="text" name="file_title[]" class="form-control" placeholder="Judul file">
                                </div>
                                <div class="col-md-2 col-12 d-grid">
                                    <button type="button" class="btn btn-danger remove-file">Hapus</button>
                                </div>
                            </div>

                            {{-- File lama --}}
                            @if(isset($penilaian) && $penilaian->file_upload)
                                @foreach($penilaian->file_upload as $file)
                                    <div class="file-row row g-2 align-items-center">
                                        <div class="col-md-5 col-12">
                                            <input type="text" class="form-control" value="{{ $file['title'] }}" readonly>
                                        </div>
                                        <div class="col-md-5 col-12">
                                            <a href="{{ asset('storage/' . $file['path']) }}" target="_blank" class="btn btn-info w-100">Lihat File</a>
                                        </div>
                                        <div class="col-md-2 col-12 d-grid">
                                            <button type="button" class="btn btn-danger remove-file">Hapus</button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="mt-2 d-grid d-md-inline">
                            <button type="button" id="add-file" class="btn btn-primary">Tambah File</button>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="col-12 d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-primary"> {{ isset($penilaian) ? 'Perbarui' : 'Simpan' }} </button>
                        <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- CKEditor --}}
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
    .then(newEditor => { editor = newEditor; })
    .catch(error => console.error('CKEditor error:', error));

document.querySelector('form').addEventListener('submit', function(){
    document.querySelector('#editor').value = editor.getData();
});

// Tambah/Hapus File Dinamis
document.getElementById('add-file').addEventListener('click', function() {
    const container = document.getElementById('file-container');
    const div = document.createElement('div');
    div.classList.add('file-row', 'row', 'g-2', 'align-items-center');
    div.innerHTML = `
        <div class="col-md-5 col-12">
            <input type="file" name="file_upload[]" class="form-control">
        </div>
        <div class="col-md-5 col-12">
            <input type="text" name="file_title[]" class="form-control" placeholder="Judul file">
        </div>
        <div class="col-md-2 col-12 d-grid">
            <button type="button" class="btn btn-danger remove-file">Hapus</button>
        </div>
    `;
    container.appendChild(div);
});

document.getElementById('file-container').addEventListener('click', function(e){
    if(e.target && e.target.classList.contains('remove-file')){
        e.target.closest('.file-row').remove();
    }
});
</script>
@endsection
