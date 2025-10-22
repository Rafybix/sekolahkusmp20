@extends('layouts.backend.app')

@section('content')
<div class="container-fluid py-3">
    <h1 class="mb-4 fw-bold text-center text-md-start">Daftar Penilaian</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <a href="{{ route('penilaian.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Penilaian
        </a>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-striped align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th scope="col" style="min-width: 180px;">Judul</th>
                    <th scope="col" style="min-width: 120px;">Tanggal</th>
                    <th scope="col" style="min-width: 250px;">Deskripsi</th>
                    <th scope="col" style="min-width: 200px;">File</th>
                    <th scope="col" style="min-width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penilaians as $p)
                <tr>
                    <td class="fw-semibold">{{ $p->judul }}</td>
                    <td>{{ $p->tanggal ? \Carbon\Carbon::parse($p->tanggal)->translatedFormat('j F Y') : '-' }}</td>
                    <td class="text-truncate" style="max-width: 300px;">
                        <div class="overflow-hidden" style="max-height: 5.5em;">
                            {!! $p->deskripsi ?? '-' !!}
                        </div>
                    </td>
                    <td>
                        @if($p->file_upload)
                            <ul class="mb-0 ps-3">
                                @foreach($p->file_upload as $file)
                                    <li>
                                        <a href="{{ asset('storage/' . $file['path']) }}" target="_blank" class="text-decoration-none">
                                            <i class="bi bi-paperclip me-1"></i>{{ $file['title'] ?? 'Lihat File' }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex flex-column flex-md-row gap-2">
                            <a href="{{ route('penilaian.edit', $p->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('penilaian.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-3">Belum ada penilaian</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
