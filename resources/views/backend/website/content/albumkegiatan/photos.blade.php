@extends('layouts.backend.app')

@section('content')
<div class="bg-white p-6 rounded-xl shadow max-w-6xl mx-auto">
    {{-- Judul --}}
    <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center md:text-left">
        📸 Foto di Album: {{ $album->nama }}
    </h2>

    {{-- Form Upload Foto --}}
    <form action="{{ route('backend-photos.store', $album->id) }}" method="POST" enctype="multipart/form-data" class="mb-8">
        @csrf
        <div class="flex flex-col md:flex-row items-stretch gap-3">
            <input type="file" name="file_path" required
                class="w-full md:w-1/3 border rounded-lg p-2 text-sm focus:ring-2 focus:ring-green-400 focus:outline-none">
            <input type="text" name="caption" placeholder="Keterangan foto"
                class="w-full md:flex-1 border rounded-lg p-2 text-sm focus:ring-2 focus:ring-green-400 focus:outline-none">
            <button type="submit"
                class="bg-green-500 hover:bg-green-600 text-white font-medium px-5 py-2 rounded-lg transition">
                Tambah Foto
            </button>
        </div>
    </form>

    {{-- Grid Foto --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5">
        @forelse($album->photos as $photo)
            <div class="group relative rounded-xl overflow-hidden shadow-lg hover:shadow-2xl bg-white border transition">
                {{-- Gambar --}}
                <img src="{{ asset('storage/' . $photo->file_path) }}"
                    class="w-full h-40 object-cover group-hover:scale-105 transition duration-300 ease-in-out">

                {{-- Caption --}}
                @if($photo->caption)
                    <div class="p-2 text-center text-xs text-gray-700 break-words bg-gray-50">
                        {{ $photo->caption }}
                    </div>
                @endif

                {{-- Tombol Hapus --}}
                <form action="{{ route('backend-photos.destroy', [$album->id, $photo->id]) }}" method="POST"
                    class="absolute top-2 right-2">
                    @csrf
                    @method('DELETE')
                    <button
                        class="bg-white/70 backdrop-blur-md text-red-500 hover:text-white hover:bg-red-500
                               rounded-full p-1.5 shadow-lg transition duration-200 border border-white/30"
                        title="Hapus Foto"
                        onclick="return confirm('Hapus foto ini?')">
                        ✕
                    </button>
                </form>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500 italic">
                Belum ada foto di album ini.
            </div>
        @endforelse
    </div>
</div>
@endsection
