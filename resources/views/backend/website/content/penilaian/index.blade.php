@extends('layouts.backend.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Penilaian</h1>

    @if(session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif

    <a href="{{ route('penilaian.create') }}" class="btn btn-primary mb-3">Tambah Penilaian</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th style="width: 20%;">Judul</th>
                <th style="width: 10%;">Tanggal</th>
                <th style="width: 30%;">Deskripsi</th>
                <th style="width: 25%;">File</th>
                <th style="width: 15%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penilaians as $p)
            <tr>
                <td>{{ $p->judul }}</td>
                <td>{{ $p->tanggal ? \Carbon\Carbon::parse($p->tanggal)->translatedFormat('j F Y') : '-' }}</td>
                <td style="max-width: 400px;">
                    <div style="display: -webkit-box; -webkit-line-clamp: 5; -webkit-box-orient: vertical; overflow: hidden;">
                        {!! $p->deskripsi ?? '-' !!}
                    </div>
                </td>
                <td>
                    @if($p->file_upload)
                        <ul class="mb-0">
                            @foreach($p->file_upload as $file)
                                <li>
                                    <a href="{{ asset('storage/' . $file['path']) }}" target="_blank">
                                        {{ $file['title'] ?? 'Lihat File' }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('penilaian.edit', $p->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>
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
