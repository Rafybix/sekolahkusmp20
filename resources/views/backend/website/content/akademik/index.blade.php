@extends('layouts.backend.app')

@section('title','Daftar Foto Program Akademik')

@section('content')
<div class="container-xxl mt-3">
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
        <h2>Daftar Foto Program Akademik</h2>
        <a href="{{ route('backend-akademik.create') }}" class="btn btn-primary mt-2 mt-md-0">+ Tambah Foto</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-3">
        @forelse($akademiks as $item)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm h-100">
                    <img src="{{ asset('storage/' . $item->foto) }}" 
                         class="card-img-top" 
                         style="height:250px;object-fit:cover;" 
                         alt="Foto Program Akademik">

                    <div class="card-body text-center">
                        <form action="{{ route('backend-akademik.destroy', $item->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Yakin mau hapus foto ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted text-center">Belum ada foto program akademik diunggah.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
