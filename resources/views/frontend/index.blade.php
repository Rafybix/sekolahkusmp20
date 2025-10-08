@extends('frontend.template.app')
@section('content')
{{-- INDEX BERITA --}}
<section class="col-span-6 space-y-6">
  <!-- JUDUL HALAMAN -->
  <div class="bg-white shadow rounded-xl p-4 flex items-center gap-2 border-l-4 border-blue-500">
    <i class="fa-solid fa-newspaper text-blue-500 text-xl"></i>
    <h2 class="text-2xl font-bold text-gray-800">Index Berita</h2>
  </div>

  <!-- FILTER PENCARIAN -->
<div class="bg-white p-4 rounded-xl shadow flex flex-wrap gap-3 items-center text-sm">
  <input id="searchInput" 
         type="text" 
         placeholder="Cari berita..." 
         class="border rounded-lg px-2 py-1 w-full sm:w-52 focus:ring focus:ring-blue-300 outline-none">

  <select id="filterTanggal" class="border rounded-lg px-2 py-1 focus:ring focus:ring-blue-300 w-20">
    <option value="">Tgl</option>
    @for ($i = 1; $i <= 31; $i++)
      <option value="{{ sprintf('%02d', $i) }}">{{ $i }}</option>
    @endfor
  </select>

  <select id="filterBulan" class="border rounded-lg px-2 py-1 focus:ring focus:ring-blue-300 w-28">
    <option value="">Bulan</option>
    @php
      $bulan = ['01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'Mei','06'=>'Jun','07'=>'Jul','08'=>'Agu','09'=>'Sep','10'=>'Okt','11'=>'Nov','12'=>'Des'];
    @endphp
    @foreach ($bulan as $num => $nama)
      <option value="{{ $num }}">{{ $nama }}</option>
    @endforeach
  </select>

  <select id="filterTahun" class="border rounded-lg px-2 py-1 focus:ring focus:ring-blue-300 w-24">
    <option value="">Tahun</option>
    @for ($i = 2020; $i <= date('Y'); $i++)
      <option value="{{ $i }}">{{ $i }}</option>
    @endfor
  </select>

  <button id="filterBtn" 
          class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 transition text-sm">
    Lihat
  </button>
</div>

<!-- SEMUA BERITA -->
<div id="semuaBerita" class="mt-10 space-y-5">
    <h2 class="text-xl font-bold text-gray-800 border-l-4 border-blue-600 pl-3 mb-4">
        Semua Berita
    </h2>

    @php
        // Pastikan variabel tetap ada agar tidak error
        $beritaTerbaru = $beritaTerbaru ?? collect();
        $beritaLama = $beritaLama ?? collect();
    @endphp

    <!-- Bagian Berita Terbaru -->
    @if($beritaTerbaru->isNotEmpty())
        <div class="space-y-5 mb-8">
            <h3 class="text-lg font-semibold text-gray-700 border-l-4 border-green-600 pl-3">Berita Terbaru</h3>
            @foreach($beritaTerbaru as $item)
                <div class="bg-white shadow rounded-xl p-5 hover:shadow-lg transition duration-300">
                    <h3 class="text-lg font-bold text-gray-800 hover:text-green-600">
                        <a href="{{ route('berita.show', $item->id) }}">
                            {{ strtoupper($item->judul ?? 'Judul Tidak Diketahui') }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-500 mb-2">
                        {{ $item->kategori->nama ?? 'Berita' }}
                        • {{ $item->created_at?->format('d M Y') ?? '-' }}
                    </p>
                    <p class="text-gray-700">
                        {{ \Illuminate\Support\Str::limit(strip_tags($item->isi ?? ''), 100, '...') }}
                    </p>
                </div>
            @endforeach
        </div>
    @endif

    @php
use App\Models\Berita;
use Illuminate\Support\Str;

// Ambil semua berita aktif dengan paginasi 7 per halaman
$semuaBerita = Berita::where('is_active', '0')
    ->orderBy('created_at', 'desc')
    ->paginate(7);
@endphp

<div class="news-event-area mt-10">
    <div class="container">
        <div class="row">
            <!-- SEMUA BERITA -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 news-inner-area">
              

                <ul class="news-wrapper list-unstyled" style="display: flex; flex-direction: column; gap: 20px;">
                    @forelse ($semuaBerita as $item)
                        <li 
                            style="display: flex; flex-wrap: wrap; align-items: flex-start; gap: 20px; padding: 18px; background: #fff; border-radius: 10px; box-shadow: 0 3px 8px rgba(0,0,0,0.08); transition: all 0.3s ease-in-out;"
                            onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 6px 14px rgba(0,0,0,0.12)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 3px 8px rgba(0,0,0,0.08)';"
                        >
                            <!-- Gambar -->
                            <div style="flex-shrink: 0; width: 180px; height: 120px; overflow: hidden; border-radius: 8px;">
                                <a href="{{ route('detail.berita', $item->slug) }}">
                                    <img 
                                        src="{{ asset('storage/images/berita/' . ($item->thumbnail ?? 'default.jpg')) }}" 
                                        alt="{{ $item->title ?? 'Berita' }}" 
                                        style="width: 100%; height: 100%; object-fit: cover;"
                                    >
                                </a>
                            </div>

                            <!-- Konten -->
                            <div style="flex: 1; min-width: 220px;">
                                <h3 style="margin: 0; font-size: 1.1rem; font-weight: bold; line-height: 1.4;">
                                    <a href="{{ route('detail.berita', $item->slug) }}" 
                                       style="color: #1e3a8a; text-decoration: none;"
                                       onmouseover="this.style.color='#2563eb';"
                                       onmouseout="this.style.color='#1e3a8a';">
                                        {{ $item->title ?? 'Judul Tidak Diketahui' }}
                                    </a>
                                </h3>

                                <div style="color: #6b7280; font-size: 0.85rem; margin-top: 5px; display: flex; align-items: center; gap: 6px;">
                                    <i class="fa-regular fa-calendar text-blue-500"></i>
                                    {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                                </div>

                                <!-- Isi berita singkat -->
                                <p style="
                                    margin-top: 10px; 
                                    color: #374151; 
                                    font-size: 0.9rem; 
                                    line-height: 1.6;
                                    display: -webkit-box;
                                    -webkit-line-clamp: 3; /* Batas 3 baris */
                                    -webkit-box-orient: vertical;
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                ">
                                    {{ strip_tags($item->isi ?? $item->content ?? 'Tidak ada isi berita') }}
                                </p>

                                <a href="{{ route('detail.berita', $item->slug) }}" 
                                   style="font-size: 0.85rem; color: #2563eb; text-decoration: none; font-weight: 500;"
                                   onmouseover="this.style.textDecoration='underline';"
                                   onmouseout="this.style.textDecoration='none';">
                                    Baca Selengkapnya →
                                </a>
                            </div>
                        </li>
                    @empty
                        <li>
                            <div style="background: #f9fafb; padding: 20px; border-radius: 8px; text-align: center; color: #6b7280;">
                                Tidak ada berita untuk ditampilkan.
                            </div>
                        </li>
                    @endforelse
                </ul>

                <!-- PAGINATION KUSTOM -->
                @if ($semuaBerita->hasPages())
                    <div class="mt-6 flex justify-center items-center gap-2 flex-wrap">
                        {{-- Tombol Sebelumnya --}}
                        @if ($semuaBerita->onFirstPage())
                            <span style="padding: 8px 14px; border-radius: 6px; background: #e5e7eb; color: #9ca3af; font-size: 0.9rem;">← Sebelumnya</span>
                        @else
                            <a href="{{ $semuaBerita->previousPageUrl() }}" 
                               style="padding: 8px 14px; border-radius: 6px; background: #2563eb; color: #fff; font-size: 0.9rem; text-decoration: none;">
                                ← Sebelumnya
                            </a>
                        @endif

                        {{-- Nomor Halaman --}}
                        @foreach ($semuaBerita->links()->elements[0] ?? range(1, $semuaBerita->lastPage()) as $page => $url)
                            @if ($page == $semuaBerita->currentPage())
                                <span style="padding: 8px 14px; border-radius: 6px; background: #2563eb; color: #fff; font-weight: bold;">{{ $page }}</span>
                            @else
                                <a href="{{ $semuaBerita->url($page) }}" 
                                   style="padding: 8px 14px; border-radius: 6px; background: #f3f4f6; color: #374151; text-decoration: none;"
                                   onmouseover="this.style.background='#e5e7eb';"
                                   onmouseout="this.style.background='#f3f4f6';">
                                   {{ $page }}
                                </a>
                            @endif
                        @endforeach

                        {{-- Tombol Berikutnya --}}
                        @if ($semuaBerita->hasMorePages())
                            <a href="{{ $semuaBerita->nextPageUrl() }}" 
                               style="padding: 8px 14px; border-radius: 6px; background: #2563eb; color: #fff; font-size: 0.9rem; text-decoration: none;">
                                Berikutnya →
                            </a>
                        @else
                            <span style="padding: 8px 14px; border-radius: 6px; background: #e5e7eb; color: #9ca3af; font-size: 0.9rem;">Berikutnya →</span>
                        @endif
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>








</section>
@endsection



