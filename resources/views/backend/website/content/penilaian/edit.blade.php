@extends('layouts.backend.app')

@section('content')
<div class="container-fluid py-4 px-3">
    <div class="bg-white p-4 rounded shadow-sm mx-auto" style="max-width: 900px;">
        <h1 class="mb-4 text-center text-md-start">
            {{ isset($penilaian) ? 'Edit' : 'Tambah' }} Penilaian
        </h1>

        {{-- Error alert --}}
        @if($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($penilaian) ? route('penilaian.update', $penilaian->id) : route('penilaian.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($penilaian)) @method('PUT') @endif

            {{-- Judul --}}
            <div class="mb-3">
                <label for="judul" class="form-label fw-semibold">Judul</label>
                <input type="text" name="judul" class="form-control" 
                       value="{{ old('judul', $penilaian->judul ?? '') }}" required>
            </div>

            {{-- Tanggal --}}
            <div class="mb-3">
                <label for="tanggal" class="form-label fw-semibold">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" 
                       value="{{ old('tanggal', $penilaian->tanggal ?? '') }}">
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                <textarea name="deskripsi" id="editor" class="form-control" rows="5">{{ old('deskripsi', $penilaian->deskripsi ?? '') }}</textarea>
            </div>

            {{-- File Lama --}}
            @if(isset($penilaian) && $penilaian->file_upload)
                <div class="mb-4">
                    <label class="form-label fw-semibold">File Saat Ini</label>
                    <div class="row g-3">
                        @foreach($penilaian->file_upload as $index => $file)
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="border rounded p-3 bg-light h-100 d-flex flex-column justify-content-between">
                                    <a href="{{ asset('storage/' . $file['path']) }}" 
                                       target="_blank" class="btn btn-sm btn-primary w-100 mb-2">
                                        {{ $file['title'] ?? 'Lihat File' }}
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger w-100 remove-old-file">Hapus</button>
                                    <input type="hidden" name="existing_files[{{ $index }}][path]" value="{{ $file['path'] }}">
                                    <input type="hidden" name="existing_files[{{ $index }}][title]" value="{{ $file['title'] }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Upload File Baru --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">Upload File Baru</label>
                <div id="file-container" class="d-flex flex-column gap-2 mb-2">
                    <div class="file-row border rounded p-3 bg-light">
                        <div class="row g-2">
                            <div class="col-12 col-md-5">
                                <input type="file" name="file_upload_new[]" class="form-control">
                            </div>
                            <div class="col-12 col-md-5">
                                <input type="text" name="file_title_new[]" class="form-control" placeholder="Judul file">
                            </div>
                            <div class="col-12 col-md-2">
                                <button type="button" class="btn btn-danger w-100 remove-file">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" id="add-file" class="btn btn-primary mt-2">Tambah File</button>
            </div>

            {{-- Tombol Simpan & Batal --}}
            <div class="d-flex flex-wrap gap-2 justify-content-end">
                <button type="submit" class="btn btn-success px-4">Simpan</button>
                <a href="{{ route('penilaian.index') }}" class="btn btn-secondary px-4">Batal</a>
            </div>
        </form>
    </div>
</div>

{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
ClassicEditor
    .create(document.querySelector('#editor'), {
        toolbar: ['heading','|','bold','italic','link','bulletedList','numberedList','blockQuote','|','undo','redo']
    })
    .catch(error => console.error(error));

// Tambah file baru
document.getElementById('add-file').addEventListener('click', function() {
    const container = document.getElementById('file-container');
    const div = document.createElement('div');
    div.classList.add('file-row','border','rounded','p-3','bg-light');
    div.innerHTML = `
        <div class="row g-2">
            <div class="col-12 col-md-5">
                <input type="file" name="file_upload_new[]" class="form-control">
            </div>
            <div class="col-12 col-md-5">
                <input type="text" name="file_title_new[]" class="form-control" placeholder="Judul file">
            </div>
            <div class="col-12 col-md-2">
                <button type="button" class="btn btn-danger w-100 remove-file">Hapus</button>
            </div>
        </div>
    `;
    container.appendChild(div);
});

// Hapus file baru
document.getElementById('file-container').addEventListener('click', function(e){
    if(e.target && e.target.classList.contains('remove-file')){
        e.target.closest('.file-row').remove();
    }
});

// Hapus file lama
document.querySelectorAll('.remove-old-file').forEach(button => {
    button.addEventListener('click', function() {
        const parent = this.closest('.col-12');
        parent.remove();
    });
});
</script>

{{-- RESPONSIVE FIX --}}
<style>
/* Pastikan layout nggak melar di mobile */
.container-fluid {
    width: 100%;
    overflow-x: hidden;
}

/* Atur tampilan card form di tengah */
@media (max-width: 768px) {
    .bg-white {
        padding: 1.25rem !important;
    }
    .file-row {
        padding: 0.75rem !important;
    }
    .btn {
        font-size: 0.9rem !important;
    }
    h1 {
        font-size: 1.4rem !important;
    }
}
</style>
@endsection
