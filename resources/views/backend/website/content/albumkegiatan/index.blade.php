@extends('layouts.backend.app')

@section('content')
<div class="content-wrapper container-xxl p-0">
  <div class="content-header row mb-3">
    <div class="col-12">
      <h2 class="fw-bold">Daftar Album Kegiatan</h2>
    </div>
  </div>

  <div class="row">
    <!-- FORM TAMBAH -->
    <div class="col-md-4 mb-3">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">Tambah Album</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('backend-albumkegiatan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-2">
              <label>Nama Album</label>
              <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-2">
              <label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control" rows="2"></textarea>
            </div>
            <div class="mb-2">
              <label>Gambar Sampul</label>
              <input type="file" name="gambar" class="form-control">
            </div>
            <button class="btn btn-success w-100 mt-2">Tambah</button>
          </form>
        </div>
      </div>
    </div>

    <!-- TABEL DAFTAR ALBUM -->
    <div class="col-md-8">
      <div class="card">
        <div class="card-header border-bottom d-flex justify-content-between align-items-center">
          <h4 class="card-title mb-0">Daftar Album</h4>
        </div>
        <div class="card-body">
          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          <div class="table-responsive">
            <table class="table table-bordered align-middle">
              <thead class="table-light">
                <tr>
                  <th>Nama</th>
                  <th>Deskripsi</th>
                  <th>Gambar</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($albums as $album)
                <tr>
                  <td>{{ $album->nama }}</td>
                  <td class="small">{{ $album->deskripsi }}</td>
                  <td class="text-center">
                    @if($album->gambar)
                      <img src="{{ asset('storage/' . $album->gambar) }}" alt="Gambar Album" width="80" class="rounded img-fluid">
                    @else
                      <span class="text-muted">Tidak ada</span>
                    @endif
                  </td>
                  <td class="text-center">
                    <div class="d-flex flex-wrap justify-content-center gap-1">
                      <a href="{{ route('backend-photos.show', $album->id) }}" class="btn btn-sm btn-info">Lihat</a>
                      <a href="{{ route('backend-albumkegiatan.edit', $album->id) }}" class="btn btn-sm btn-primary">Edit</a>
                      <form action="{{ route('backend-albumkegiatan.destroy', $album->id) }}" method="POST" class="d-inline">
                        @csrf 
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus album ini?')">Hapus</button>
                      </form>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="4" class="text-center text-muted">Belum ada album kegiatan</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- CSS tambahan untuk HP --}}
<style>
  @media (max-width: 768px) {
    .card-title { font-size: 1rem; }
    .table td, .table th { font-size: 0.9rem; white-space: nowrap; }
    .btn { font-size: 0.8rem; }
  }
</style>
@endsection
