@extends('layouts.backend.app')

@section('content')
<div class="bg-white p-6 rounded-xl shadow max-w-6xl mx-auto">
    <h2 class="text-xl md:text-2xl font-bold mb-4 text-gray-800 text-center md:text-left">
        Foto di Album: {{ $album->nama }}
    </h2>

    {{-- Form Upload Foto --}}
    <form action="{{ route('backend-photos.store', $album->id) }}" method="POST" enctype="multipart/form-data" class="mb-6">
        @csrf
        <div class="flex flex-col md:flex-row md:items-center gap-2">
            <input type="file" name="file_path" required
                class="w-full md:w-auto border rounded p-2 text-sm focus:ring focus:ring-green-300">
            <input type="text" name="caption" placeholder="Keterangan foto"
                class="w-full border rounded p-2 text-sm focus:ring focus:ring-green-300">
            <button type="submit"
                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition">
                Tambah Foto
            </button>
        </div>
    </form>

    {{-- Grid Foto --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
        @forelse($album->photos as $photo)
            <div class="border rounded-lg overflow-hidden shadow hover:shadow-lg transition bg-gray-50">
                <img src="{{ asset('storage/' . $photo->file_path) }}" class="w-full h-40 object-cover">
                <div class="p-2 text-center text-sm text-gray-700 break-words">{{ $photo->caption }}</div>
                <form action="{{ route('backend-photos.destroy', [$album->id, $photo->id]) }}" method="POST" class="pb-2 text-center">
                    @csrf
                    @method('DELETE')
                    <button
                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 text-xs rounded transition"
                        onclick="return confirm('Hapus foto ini?')">
                        Hapus
                    </button>
                </form>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500 italic">Belum ada foto di album ini.</div>
        @endforelse
    </div>
</div>
@endsection
