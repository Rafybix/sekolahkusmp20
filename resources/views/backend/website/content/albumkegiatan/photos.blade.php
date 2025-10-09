@extends('layouts.backend.app')

@section('content')
<div class="bg-white p-6 rounded-xl shadow">
    <h2 class="text-xl font-bold mb-4">Foto di Album: {{ $album->nama }}</h2>

    <form action="{{ route('backend-photos.store', $album->id) }}" method="POST" enctype="multipart/form-data" class="mb-6">
        @csrf
        <div>
            <input type="file" name="file_path" required>
        </div>
        <div>
            <input type="text" name="caption" placeholder="Keterangan foto" class="mt-2 w-full border rounded p-2">
        </div>
        <button type="submit" class="mt-2 bg-green-500 text-white px-4 py-2 rounded">Tambah Foto</button>
    </form>

    <div class="grid grid-cols-3 gap-4">
        @foreach($album->photos as $photo)
        <div class="border rounded overflow-hidden shadow">
            <img src="{{ asset('storage/' . $photo->file_path) }}" class="w-full h-40 object-cover">
            <div class="p-2 text-center">{{ $photo->caption }}</div>
            <form action="{{ route('backend-photos.destroy', [$album->id, $photo->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 text-white px-3 py-1 text-sm rounded">Hapus</button>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection
