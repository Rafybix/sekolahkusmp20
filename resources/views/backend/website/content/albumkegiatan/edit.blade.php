@extends('layouts.backend.app')

@section('content')
<div class="container mt-4">
  <h3>Edit Album</h3>

  <form action="{{ route('backend-albumkegiatan.update', $album->id) }}" method="POST" enctype="multipart/form-data">
    @csrf 
    @method('PUT')

    <input type="text" name="nama" class="form-control mb-2" value="{{ $album->nama }}" required>
    <textarea name="deskripsi" class="form-control mb-2">{{ $album->deskripsi }}</textarea>

    <div class="mb-3">
      <label>Gambar Saat Ini:</label><br>
      @if($album->gambar)
        <img src="{{ asset('storage/' . $album->gambar) }}" alt="Gambar Album" width="100" class="rounded mb-2">
      @else
        <p class="text-muted">Tidak ada gambar</p>
      @endif
      <input type="file" name="gambar" class="form-control">
    </div>

    <button class="btn btn-success">Simpan Perubahan</button>
    <a href="{{ route('backend-albumkegiatan.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection