@extends('frontend.template.app')

@section('content')
@php
    $perPage = 6;
    $currentPage = request()->get('page', 1);

    $filtered = $penilaians->filter(function($item) {
        $date = $item->tanggal ? \Carbon\Carbon::parse($item->tanggal) : null;
        if(!$date) return false;

        $match = true;
        if(request('tanggal')) $match = $match && $date->day == (int)request('tanggal');
        if(request('bulan')) $match = $match && $date->month == (int)request('bulan');
        if(request('tahun')) $match = $match && $date->year == (int)request('tahun');

        return $match;
    });

    $total = $filtered->count();
    $paginated = $filtered->forPage($currentPage, $perPage);
    $lastPage = ceil($total / $perPage);
@endphp

<section class="col-span-6 space-y-6">
    <h2 class="text-3xl font-bold mb-6 text-center text-gray-900">Daftar Penilaian</h2>

    <!-- Form Filter Minimalis -->
    <form method="GET" class="flex flex-wrap justify-center gap-4 mb-4">
        <input type="number" name="tanggal" min="1" max="31" placeholder="Tanggal" value="{{ request('tanggal') }}" 
               class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-24" />
        <input type="number" name="bulan" min="1" max="12" placeholder="Bulan" value="{{ request('bulan') }}" 
               class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-24" />
        <input type="number" name="tahun" min="2000" max="2099" placeholder="Tahun" value="{{ request('tahun') }}" 
               class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-32" />
        <button type="submit" 
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            Filter
        </button>
        <a href="{{ url()->current() }}" 
           class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400 transition">
            Reset
        </a>
    </form>

    <!-- Hasil Filter -->
    <div class="flex flex-col gap-6">
        @if(request()->hasAny(['tanggal','bulan','tahun']))
            <p class="text-gray-700 text-sm text-center mb-2">
                Menampilkan hasil filter:
                @if(request('tanggal')) Tanggal {{ request('tanggal') }} @endif
                @if(request('bulan')) Bulan {{ request('bulan') }} @endif
                @if(request('tahun')) Tahun {{ request('tahun') }} @endif
            </p>
        @endif

        @forelse($paginated as $p)
        <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">

            <!-- Judul -->
            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $p->judul }}</h3>

            <!-- Tanggal -->
            @if($p->tanggal)
            <p class="text-gray-500 text-sm mb-3">{{ \Carbon\Carbon::parse($p->tanggal)->translatedFormat('j F Y') }}</p>
            @endif

            <!-- Deskripsi -->
            @if($p->deskripsi)
            <p class="text-gray-700 mb-4">{{ $p->deskripsi }}</p>
            @endif

            <!-- File / Link di bawah -->
            <div class="flex flex-wrap gap-3 mt-4">
                @if($p->file_upload)
                <a href="{{ asset('storage/' . $p->file_upload) }}" target="_blank"
                   class="flex items-center justify-center text-white bg-blue-600 hover:bg-blue-700 font-medium px-4 py-2 rounded-lg transition text-sm">
                    Lihat File
                </a>
                @endif

                @if($p->link)
                <a href="{{ $p->link }}" target="_blank"
                   class="flex items-center justify-center text-white bg-green-600 hover:bg-green-700 font-medium px-4 py-2 rounded-lg transition text-sm">
                    Buka Link
                </a>
                @endif

                @if(!$p->file_upload && !$p->link)
                <span class="text-gray-400 text-sm italic">Tidak ada file atau link</span>
                @endif
            </div>
        </div>
        @empty
        <p class="text-gray-600 text-center">Belum ada penilaian yang sesuai filter.</p>
        @endforelse
    </div>

    <!-- Pagination Manual -->
    @if($lastPage > 1)
    <div class="mt-6 flex justify-center space-x-2">
        @if($currentPage > 1)
        <a href="?page={{ $currentPage - 1 }}{{ request()->has('tanggal') ? '&tanggal='.request('tanggal') : '' }}{{ request()->has('bulan') ? '&bulan='.request('bulan') : '' }}{{ request()->has('tahun') ? '&tahun='.request('tahun') : '' }}" 
           class="px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition">&laquo;</a>
        @else
        <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded-full cursor-not-allowed">&laquo;</span>
        @endif

        @for($i = 1; $i <= $lastPage; $i++)
            @if($i == $currentPage)
            <span class="px-4 py-2 bg-blue-600 text-white rounded-full">{{ $i }}</span>
            @else
            <a href="?page={{ $i }}{{ request()->has('tanggal') ? '&tanggal='.request('tanggal') : '' }}{{ request()->has('bulan') ? '&bulan='.request('bulan') : '' }}{{ request()->has('tahun') ? '&tahun='.request('tahun') : '' }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full hover:bg-gray-300 transition">{{ $i }}</a>
            @endif
        @endfor

        @if($currentPage < $lastPage)
        <a href="?page={{ $currentPage + 1 }}{{ request()->has('tanggal') ? '&tanggal='.request('tanggal') : '' }}{{ request()->has('bulan') ? '&bulan='.request('bulan') : '' }}{{ request()->has('tahun') ? '&tahun='.request('tahun') : '' }}" 
           class="px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition">&raquo;</a>
        @else
        <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded-full cursor-not-allowed">&raquo;</span>
        @endif
    </div>
    @endif
</section>
@endsection
