@extends('layouts.backend.app')

@section('content')
<div class="content-wrapper container-xxl p-0">
  <div class="content-header row mb-3">
    <div class="col-12">
      <h2 class="fw-bold">Data Kepala Sekolah</h2>
    </div>
  </div>

  <div class="row">
    <!-- TABEL DATA -->
    <div class="col-md-7">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">Daftar Kepala Sekolah</h4>
        </div>
        <div class="card-body">
          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          <table class="table table-bordered">
            <thead class="table-light">
              <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($data as $key => $row)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>
                  @if($row->foto)
                    <img src="{{ asset('storage/'.$row->foto) }}" class="rounded" width="60">
                  @else
                    <span class="text-muted">-</span>
                  @endif
                </td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->nip ?? '-' }}</td>
                <td>
                  <a href="{{ route('backend-kepalasekolah.edit', $row->id) }}" class="btn btn-sm btn-primary">Edit</a>
                  <form action="{{ route('backend-kepalasekolah.destroy', $row->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                  </form>
                </td>
              </tr>
              @empty
                <tr><td colspan="5" class="text-center text-muted">Belum ada data</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- FORM TAMBAH -->
    <div class="col-md-5">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">Tambah Kepala Sekolah</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('backend-kepalasekolah.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-2">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-group mb-2">
              <label>NIP</label>
              <input type="text" name="nip" class="form-control">
            </div>
            <div class="form-group mb-2">
              <label>Foto</label>
              <input type="file" name="foto" class="form-control">
            </div>
            <div class="form-group mb-2">
              <label>Sambutan</label>
              <textarea name="sambutan" rows="3" class="form-control"></textarea>
            </div>
            <div class="form-group mb-2">
              <label>Instagram</label>
              <input type="text" name="instagram" class="form-control" placeholder="https://instagram.com/...">
            </div>
            <div class="form-group mb-2">
              <label>Facebook</label>
              <input type="text" name="facebook" class="form-control" placeholder="https://facebook.com/...">
            </div>
            <div class="form-group mb-2">
              <label>Youtube</label>
              <input type="text" name="youtube" class="form-control" placeholder="https://youtube.com/...">
            </div>
            <button class="btn btn-success w-100 mt-3">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
