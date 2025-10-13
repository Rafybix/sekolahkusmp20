@extends('frontend.layouts.app')

@section('content')
<section class="max-w-6xl mx-auto py-10 px-4">
    <h2 class="text-3xl font-bold mb-8 text-center text-gray-800">Daftar Penilaian</h2>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($penilaians as $p)
        <div class="bg-white shadow-md rounded-2xl p-6 flex flex-col justify-between hover:shadow-xl transition duration-300">
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $p->judul }}</h3>

                @if($p->tanggal)
                    <p class="text-gray-500 text-sm mb-3 flex items-center gap-1">
                        <span>📅</span> {{ \Carbon\Carbon::parse($p->tanggal)->translatedFormat('j F Y') }}
                    </p>
                @endif

                @if($p->deskripsi)
                    <p class="text-gray-700 mb-4">{{ $p->deskripsi }}</p>
                @endif
            </div>

            <div class="mt-auto flex flex-wrap gap-3 text-sm">
                @if($p->file_upload)
                    <a href="{{ asset('storage/' . $p->file_upload) }}" target="_blank" 
                       class="flex items-center gap-1 text-blue-600 hover:underline">
                        📄 Lihat File
                    </a>
                @endif

                @if($p->link)
                    <a href="{{ $p->link }}" target="_blank" 
                       class="flex items-center gap-1 text-green-600 hover:underline">
                        🔗 Buka Link
                    </a>
                @endif

                @if(!$p->file_upload && !$p->link)
                    <span class="text-gray-400">Tidak ada file atau link</span>
                @endif
            </div>
        </div>
        @empty
            <p class="text-gray-600 col-span-2 text-center">Belum ada penilaian yang diunggah.</p>
        @endforelse
    </div>
</section>
@endsection
