@extends('layouts.backend.app')

@section('title','Upload Foto Kurikulum')

@section('content')
<div class="container-xxl mt-3">
    <h2 class="mb-4">Upload Foto Kurikulum</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('backend-kurikulum.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="foto" class="form-label">Pilih Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control" required>
                    @error('foto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-flex flex-wrap gap-2 mt-3">
                    <button type="submit" class="btn btn-success">Upload</button>
                    <a href="{{ route('backend-kurikulum.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
