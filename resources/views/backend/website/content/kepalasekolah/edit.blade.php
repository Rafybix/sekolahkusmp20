@extends('layouts.backend.app')

@section('content')
<div class="content-wrapper container-xxl p-0">
  <div class="content-header row mb-3">
    <div class="col-12">
      <h2 class="fw-bold">Edit Kepala Sekolah</h2>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <form action="{{ route('backend-kepalasekolah.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="col-md-6">
            <div class="form-group mb-2">
              <label>Nama</label>
              <input type="text" name="nama" value="{{ $item->nama }}" class="form-control">
            </div>
            <div class="form-group mb-2">
              <label>NIP</label>
              <input type="text" name="nip" value="{{ $item->nip }}" class="form-control">
            </div>
            <div class="form-group mb-2">
              <label>Foto</label>
              <input type="file" name="foto" class="form-control">
              @if($item->foto)
                <img src="{{ asset('storage/'.$item->foto) }}" width="100" class="mt-2 rounded">
              @endif
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group mb-2">
              <label>Sambutan</label>
              <textarea name="sambutan" rows="3" class="form-control">{{ $item->sambutan }}</textarea>
            </div>
            <div class="form-group mb-2">
              <label>Instagram</label>
              <input type="text" name="instagram" value="{{ $item->instagram }}" class="form-control">
            </div>
            <div class="form-group mb-2">
              <label>Facebook</label>
              <input type="text" name="facebook" value="{{ $item->facebook }}" class="form-control">
            </div>
            <div class="form-group mb-2">
              <label>Youtube</label>
              <input type="text" name="youtube" value="{{ $item->youtube }}" class="form-control">
            </div>
          </div>
        </div>

        <button class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('backend-kepalasekolah.index') }}" class="btn btn-secondary mt-3">Kembali</a>
      </form>
    </div>
  </div>
</div>
@endsection
