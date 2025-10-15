@extends('layouts.backend.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Foto Struktur Kurikulum</h2>
        <a href="{{ route('backend-kurikulum.create') }}" class="btn btn-primary">+ Tambah Foto</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse ($kurikulums as $item)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top" style="height:250px;object-fit:cover;" alt="Foto Kurikulum">

                    <div class="card-body text-center">
                        <form action="{{ route('backend-kurikulum.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus foto ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted text-center">Belum ada foto kurikulum diunggah.</p>
        @endforelse
    </div>
</div>
@endsection
