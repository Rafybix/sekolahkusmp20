@extends('frontend.template.app')
@section('content')

<section class="col-span-6 space-y-6">
      <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6 text-center">Album Kegiatan</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($albums as $album)
                <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition">
                    @if($album->gambar && file_exists(public_path('uploads/albumkegiatan/' . $album->gambar)))
                        <img src="{{ asset('uploads/albumkegiatan/' . $album->gambar) }}" 
                             alt="{{ $album->nama }}" class="w-full h-48 object-cover">
                    @else
                        <div class="bg-gray-200 h-48 flex items-center justify-center text-gray-500">
                            Tidak ada gambar
                        </div>
                    @endif
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ $album->nama }}</h3>
                        <p class="text-gray-600 text-sm mt-1">{{ $album->deskripsi }}</p>
                    </div>
                </div>
            @empty
                <p class="text-center col-span-full text-gray-500">Belum ada album kegiatan.</p>
            @endforelse
        </div>
    </div>
</section>

@endsection
