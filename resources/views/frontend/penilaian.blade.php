@extends('frontend.template.app')

@section('content')
@php
    // Tentukan jumlah item per halaman
    $perPage = 6;

    // Ambil halaman dari query string, default 1
    $currentPage = request()->get('page', 1);

    // Hitung total item
    $total = $penilaians->count();

    // Slice collection sesuai halaman
    $paginated = $penilaians->forPage($currentPage, $perPage);

    // Hitung total halaman
    $lastPage = ceil($total / $perPage);
@endphp

<section class="col-span-6 space-y-6">
    <h2 class="text-3xl font-bold mb-10 text-center text-gray-900">Daftar Penilaian</h2>

    <div class="flex flex-col gap-6">
        @forelse($paginated as $p)
        <div class="bg-white rounded-2xl shadow-lg flex hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
            
            <!-- Bagian kiri: informasi teks -->
            <div class="flex-1 p-6 flex flex-col justify-between">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $p->judul }}</h3>

                @if($p->tanggal)
                <p class="text-gray-500 text-sm mb-3 flex items-center gap-1">
                    <span>📅</span> {{ \Carbon\Carbon::parse($p->tanggal)->translatedFormat('j F Y') }}
                </p>
                @endif

                @if($p->deskripsi)
                <p class="text-gray-700 mb-4">{{ $p->deskripsi }}</p>
                @endif
            </div>

            <!-- Bagian kanan: File / Link -->
            <div class="flex flex-col justify-center p-6 space-y-3 border-l border-gray-200">
                @if($p->file_upload)
                <a href="{{ asset('storage/' . $p->file_upload) }}" target="_blank"
                   class="flex items-center gap-2 text-white bg-blue-600 hover:bg-blue-700 font-medium px-4 py-2 rounded-xl transition text-sm">
                    📄 Lihat File
                </a>
                @endif

                @if($p->link)
                <a href="{{ $p->link }}" target="_blank"
                   class="flex items-center gap-2 text-white bg-green-600 hover:bg-green-700 font-medium px-4 py-2 rounded-xl transition text-sm">
                    🔗 Buka Link
                </a>
                @endif

                @if(!$p->file_upload && !$p->link)
                <span class="text-gray-400 text-sm italic">Tidak ada file atau link</span>
                @endif
            </div>
        </div>
        @empty
        <p class="text-gray-600 text-center">Belum ada penilaian yang diunggah.</p>
        @endforelse
    </div>

    <!-- Pagination Manual -->
    @if($lastPage > 1)
    <div class="mt-6 flex justify-center space-x-2">
        {{-- Previous --}}
        @if($currentPage > 1)
        <a href="?page={{ $currentPage - 1 }}" class="px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition">&laquo;</a>
        @else
        <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded-full cursor-not-allowed">&laquo;</span>
        @endif

        {{-- Page Numbers --}}
        @for($i = 1; $i <= $lastPage; $i++)
            @if($i == $currentPage)
            <span class="px-4 py-2 bg-blue-600 text-white rounded-full">{{ $i }}</span>
            @else
            <a href="?page={{ $i }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full hover:bg-gray-300 transition">{{ $i }}</a>
            @endif
        @endfor

        {{-- Next --}}
        @if($currentPage < $lastPage)
        <a href="?page={{ $currentPage + 1 }}" class="px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition">&raquo;</a>
        @else
        <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded-full cursor-not-allowed">&raquo;</span>
        @endif
    </div>
    @endif
</section>
@endsection
