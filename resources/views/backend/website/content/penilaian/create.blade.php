@extends('layouts.backend.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Penilaian</h1>

    @if($errors->any())
        <div class="alert alert-danger mb-3">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penilaian.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="judul">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}">
        </div>

        <div class="mb-3">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="file_upload">Upload File</label>
            <input type="file" name="file_upload" class="form-control">
            <small class="text-muted">Bisa upload PDF, Word, Excel, gambar, atau file lainnya.</small>
        </div>

        <div class="mb-3">
            <label for="link">Link</label>
            <input type="url" name="link" class="form-control" value="{{ old('link') }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
