@extends('frontend.template.app')
@section('content')

<section class="col-span-6 space-y-6">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6 text-center">Album Kegiatan</h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 justify-items-center">
            @forelse ($albums as $album)
                <a href="{{ route('album.show', $album->id) }}" 
                   class="block bg-white border border-gray-200 rounded-md hover:shadow-md transition p-2 text-center w-36">
                    @php
                        $path = public_path('uploads/album_photos/' . $album->gambar);
                    @endphp

                    @if($album->gambar && file_exists($path))
                        <img src="{{ asset('uploads/album_photos/' . $album->gambar) }}" 
                             alt="{{ $album->nama }}" 
                             class="w-full h-24 object-cover rounded-md mb-2">
                    @else
                        <img src="{{ asset('Assets/Frontend/img/album.png') }}" 
                             alt="Default Album" 
                             class="w-full h-24 object-cover rounded-md mb-2">
                    @endif

                    <h3 class="text-sm font-bold text-gray-800 leading-tight">{{ strtoupper($album->nama) }}</h3>
                    <p class="text-xs text-gray-600 mt-1 line-clamp-2">{{ $album->deskripsi }}</p>
                </a>
            @empty
                <p class="text-center col-span-full text-gray-500">Belum ada album kegiatan.</p>
            @endforelse
        </div>
    </div>
</section>

@endsection
