@extends('layouts.backend.app')

@section('title')
    Kategori Berita
@endsection

@section('content')

{{-- 🔔 ALERT --}}
@if (session('success'))
  <div class="alert alert-success" role="alert">
    <div class="alert-body d-flex justify-content-between align-items-center">
      <strong>{{ session('success') }}</strong>
      <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
  </div>
@elseif (session('error'))
  <div class="alert alert-danger" role="alert">
    <div class="alert-body d-flex justify-content-between align-items-center">
      <strong>{{ session('error') }}</strong>
      <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
  </div>
@endif

<div class="content-wrapper container-xxl p-0">
  <div class="content-body">
    <div class="row">
      <div class="col-12">
        <section>
          <div class="row">

            {{-- 📋 TABEL KATEGORI --}}
            <div class="col-7">
              <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                  <h4 class="card-title mb-0">Kategori Berita</h4>
                  <a href="{{ route('backend-kategori-berita.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> Tambah
                  </a>
                </div>

                <div class="card-datatable p-2">
                  <table class="dt-responsive table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($kategori as $key => $kategoris)
                        <tr>
                          <td>{{ $key + 1 }}</td>
                          <td>{{ $kategoris->nama }}</td>
                          <td>
                            {{-- 🟢 0 = Aktif, 🔴 1 = Tidak Aktif --}}
                            <span class="badge {{ $kategoris->is_active == '0' ? 'badge-success' : 'badge-secondary' }}">
                              {{ $kategoris->is_active == '0' ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                          </td>
                          <td>
                            <a href="{{ route('backend-kategori-berita.edit', $kategoris->id) }}" 
                               class="btn btn-success btn-sm">
                              <i class="fa fa-edit"></i> Edit
                            </a>

                            {{-- ✅ Perbaikan di sini --}}
                            <form action="{{ route('backend-kategori-berita.hapus', $kategoris->id) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i> Hapus
                              </button>
                            </form>
                            {{-- ✅ Akhir perbaikan --}}
                          </td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="4" class="text-center text-muted">Belum ada data kategori.</td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            {{-- 📝 FORM TAMBAH --}}
            <div class="col-5">
              <div class="card">
                <div class="card-header">
                  <h4>Tambah Kategori Berita</h4>
                </div>
                <div class="card-body">
                  <form action="{{ route('backend-kategori-berita.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label>Nama <span class="text-danger">*</span></label>
                      <input type="text" name="nama" 
                             class="form-control @error('nama') is-invalid @enderror" 
                             value="{{ old('nama') }}" required>
                      @error('nama')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label>Status <span class="text-danger">*</span></label>
                      <select name="is_active" class="form-control @error('is_active') is-invalid @enderror" required>
                        <option value="">-- Pilih --</option>
                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Aktif</option>
                        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Tidak Aktif</option>
                      </select>
                      @error('is_active')
                        <div class="invalid-feedback">
                          <strong>{{ $message }}</strong>
                        </div>
                      @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah</button>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </section>
      </div>
    </div>
  </div>
</div>
@endsection
