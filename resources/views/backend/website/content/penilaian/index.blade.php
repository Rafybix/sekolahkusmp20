@extends('layouts.backend.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Penilaian</h1>

    @if(session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif

    <a href="{{ route('penilaian.create') }}" class="btn btn-primary mb-3">Tambah Penilaian</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th>File/Link</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penilaians as $p)
            <tr>
                <td>{{ $p->judul }}</td>
                <td>{{ $p->tanggal ? \Carbon\Carbon::parse($p->tanggal)->translatedFormat('j F Y') : '-' }}</td>
                <td>{{ $p->deskripsi ?? '-' }}</td>
                <td>
                    @if($p->file_pdf)
                        <a href="{{ asset('storage/' . $p->file_pdf) }}" target="_blank">📄 PDF</a>
                    @elseif($p->link)
                        <a href="{{ $p->link }}" target="_blank">🔗 Link</a>
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('penilaian.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('penilaian.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada penilaian</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
