@extends('layouts.backend.app')

@section('content')
<div class="content-wrapper container-xxl p-0">
  <div class="content-header row mb-3">
    <div class="col-12">
      <h2 class="fw-bold">Edit Album Kegiatan</h2>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 col-12">
      <div class="card shadow-sm">
        <div class="card-header border-bottom">
          <h4 class="card-title mb-0">Perbarui Data Album</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('backend-albumkegiatan.update', $album->id) }}" method="POST" enctype="multipart/form-data">
            @csrf 
            @method('PUT')

            {{-- Nama Album --}}
            <div class="mb-3">
              <label class="form-label fw-semibold">Nama Album</label>
              <input 
                type="text" 
                name="nama" 
                class="form-control" 
                value="{{ $album->nama }}" 
                required>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
              <label class="form-label fw-semibold">Deskripsi</label>
              <textarea 
                name="deskripsi" 
                class="form-control" 
                rows="3">{{ $album->deskripsi }}</textarea>
            </div>

            {{-- Gambar --}}
            <div class="mb-3">
              <label class="form-label fw-semibold">Gambar Saat Ini</label><br>
              @if($album->gambar)
                <img src="{{ asset('storage/' . $album->gambar) }}" alt="Gambar Album" class="rounded mb-2 img-fluid shadow-sm" style="max-width: 150px;">
              @else
                <p class="text-muted">Tidak ada gambar</p>
              @endif

              <input type="file" name="gambar" class="form-control mt-2">
              <small class="text-muted d-block mt-1">Kosongkan jika tidak ingin mengganti gambar.</small>
            </div>

            {{-- Tombol --}}
            <div class="d-flex flex-wrap gap-2 mt-4">
              <button class="btn btn-success flex-fill">💾 Simpan Perubahan</button>
              <a href="{{ route('backend-albumkegiatan.index') }}" class="btn btn-secondary flex-fill">↩ Kembali</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- CSS tambahan responsif --}}
<style>
  @media (max-width: 768px) {
    h2.fw-bold { font-size: 1.25rem; }
    .card-title { font-size: 1rem; }
    .btn { font-size: 0.9rem; }
    .card { border-radius: 10px; }
  }
</style>
@endsection
