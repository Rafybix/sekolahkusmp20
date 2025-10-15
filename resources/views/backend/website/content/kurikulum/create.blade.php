@extends('layouts.backend.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Upload Foto Kurikulum</h2>

    <form action="{{ route('backend-kurikulum.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="foto" class="form-label">Pilih Foto</label>
            <input type="file" name="foto" id="foto" class="form-control" required>
            @error('foto')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Upload</button>
        <a href="{{ route('backend-kurikulum.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
