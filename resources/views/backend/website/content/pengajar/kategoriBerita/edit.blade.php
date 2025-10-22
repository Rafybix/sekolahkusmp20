@extends('layouts.backend.app')

@section('title')
    Edit Kategori Berita
@endsection

@section('content')

{{-- 🔔 ALERT --}}
@if (session('success'))
  <div class="alert alert-success" role="alert">
    <div class="alert-body">
      <strong>{{ session('success') }}</strong>
      <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
  </div>
@elseif (session('error'))
  <div class="alert alert-danger" role="alert">
    <div class="alert-body">
      <strong>{{ session('error') }}</strong>
      <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
  </div>
@endif

<div class="content-wrapper container-xxl p-0">
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2>Edit Kategori Berita</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="content-body">
    <div class="row">
      <div class="col-12">
        <section>
          <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-header header-bottom d-flex justify-content-between align-items-center">
                  <h4>Edit Data Kategori</h4>

                  {{-- 🔥 Tombol Hapus --}}
                  <form action="{{ route('backend-kategori-berita.hapus', $kategori->id) }}" 
                        method="POST" 
                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                      @csrf
                      <button type="submit" class="btn btn-danger btn-sm">
                          <i class="fa fa-trash"></i> Hapus
                      </button>
                  </form>
                </div>

                <div class="card-body">
                  {{-- ✏️ FORM UPDATE --}}
                  <form action="{{ route('backend-kategori-berita.update', $kategori->id) }}" method="POST">
                      @csrf
                      @method('PUT')

                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Nama <span class="text-danger">*</span></label>
                                  <input type="text" name="nama" 
                                         class="form-control @error('nama') is-invalid @enderror"
                                         value="{{ old('nama', $kategori->nama) }}" required>
                                  @error('nama')
                                      <div class="invalid-feedback">
                                          <strong>{{ $message }}</strong>
                                      </div>
                                  @enderror
                              </div>
                          </div>

                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Status <span class="text-danger">*</span></label>
                                  <select name="is_active" class="form-control @error('is_active') is-invalid @enderror" required>
                                      <option value="">-- Pilih --</option>
                                      <option value="0" {{ $kategori->is_active == '0' ? 'selected' : '' }}>Aktif</option>
                                      <option value="1" {{ $kategori->is_active == '1' ? 'selected' : '' }}>Tidak Aktif</option>
                                  </select>
                                  @error('is_active')
                                      <div class="invalid-feedback">
                                          <strong>{{ $message }}</strong>
                                      </div>
                                  @enderror
                              </div>
                          </div>
                      </div>

                      <div class="mt-2">
                          <button type="submit" class="btn btn-primary">Update</button>
                          <a href="{{ route('backend-kategori-berita.index') }}" class="btn btn-warning">Batal</a>
                      </div>
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
