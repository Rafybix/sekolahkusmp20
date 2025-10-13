@extends('layouts.backend.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Penilaian</h1>

    @if($errors->any())
        <div class="alert alert-danger mb-3">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penilaian.update', $penilaian->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul', $penilaian->judul) }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $penilaian->tanggal) }}">
        </div>

        <div class="mb-3">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $penilaian->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="file_pdf">Upload PDF</label>
            <input type="file" name="file_pdf" class="form-control">
            @if($penilaian->file_pdf)
                <small>File saat ini: <a href="{{ asset('storage/'.$penilaian->file_pdf) }}" target="_blank">📄 PDF</a></small>
            @endif
        </div>

        <div class="mb-3">
            <label for="link">Link</label>
            <input type="url" name="link" class="form-control" value="{{ old('link', $penilaian->link) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
