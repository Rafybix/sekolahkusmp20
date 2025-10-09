@extends('layouts.backend.app')

@section('content')
<div class="container mt-4">
  <h3>Foto Album: {{ $album->nama }}</h3>
  <p>{{ $album->deskripsi }}</p>

  <hr>

  {{-- Form upload foto --}}
  <form action="{{ route('backend-albumkegiatan.upload', $album->id) }}" method="POST" enctype="multipart/form-data" class="mb-4">
    @csrf
    <input type="file" name="foto" required class="form-control mb-2">
    <button class="btn btn-success">Upload Foto</button>
  </form>

  {{-- Daftar foto --}}
  <div class="row">
    @foreach($album->fotos as $foto)
      <div class="col-md-3 mb-3 text-center">
        <img src="{{ asset('storage/' . $foto->path) }}" alt="Foto" class="img-fluid rounded mb-2">
        <form action="{{ route('backend-albumkegiatan.deletephoto', $foto->id) }}" method="POST">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus foto ini?')">Hapus</button>
        </form>
      </div>
    @endforeach
  </div>

  <a href="{{ route('backend-albumkegiatan.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Album</a>
</div>
@endsection
