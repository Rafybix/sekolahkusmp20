@extends('layouts.backend.app')

@section('content')
<div class="container mt-4">
  <h3>Daftar Album Kegiatan</h3>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  {{-- ✅ Form tambah album --}}
  <form action="{{ route('backend-albumkegiatan.store') }}" method="POST" class="mb-3" enctype="multipart/form-data">
    @csrf
    <input type="text" name="nama" placeholder="Nama Album" class="form-control mb-2" required>
    <textarea name="deskripsi" placeholder="Deskripsi" class="form-control mb-2"></textarea>
    <input type="file" name="gambar" class="form-control mb-2">
    <button class="btn btn-success">Tambah</button>
  </form>

  {{-- ✅ Tabel daftar album --}}
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Deskripsi</th>
        <th>Gambar</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($albums as $album)
      <tr>
        <td>{{ $album->nama }}</td>
        <td>{{ $album->deskripsi }}</td>
        <td>
          @if($album->gambar)
            <img src="{{ asset('storage/' . $album->gambar) }}" alt="Gambar Album" width="80" class="rounded">
          @else
            <span class="text-muted">Tidak ada</span>
          @endif
        </td>
        <td>
  <a href="{{ route('backend-photos.show', $album->id) }}" class="btn btn-sm btn-info">Lihat Foto</a>
  <a href="{{ route('backend-albumkegiatan.edit', $album->id) }}" class="btn btn-sm btn-primary">Edit</a>
  <form action="{{ route('backend-albumkegiatan.destroy', $album->id) }}" method="POST" class="d-inline">
    @csrf 
    @method('DELETE')
    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus album ini?')">Hapus</button>
  </form>
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
@endsection
