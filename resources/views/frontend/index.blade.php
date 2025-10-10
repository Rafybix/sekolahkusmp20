@extends('frontend.template.app')
@section('content')
{{-- INDEX BERITA --}}
<section class="col-span-6 space-y-6">
@php
    $kategori = \App\Models\KategoriBerita::orderBy('nama', 'asc')->get();

    $tanggal = request('tanggal');
    $bulan = request('bulan');
    $tahun = request('tahun');
    $kategori_id = request('kategori');

    // 🔹 Cek apakah ada filter aktif
    $adaFilter = $tanggal || $bulan || $tahun || $kategori_id;

    $query = \App\Models\Berita::query()->with('kategori');

    if ($tanggal) $query->whereDay('created_at', $tanggal);
    if ($bulan) $query->whereMonth('created_at', $bulan);
    if ($tahun) $query->whereYear('created_at', $tahun);
    if ($kategori_id) $query->where('kategori_id', $kategori_id);

    // 🔹 Kalau ada filter → ambil berita
    // 🔹 Kalau tidak ada → kosong (supaya reset bersih)
    $berita = $adaFilter
        ? $query->orderBy('created_at', 'desc')->get()
        : collect();
@endphp

<!-- 📰 JUDUL HALAMAN -->
<div class="bg-white shadow rounded-xl p-4 flex items-center gap-2 border-l-4 border-blue-500">
  <i class="fa-solid fa-newspaper text-blue-500 text-xl"></i>
  <h2 class="text-2xl font-bold text-gray-800">Daftar Berita</h2>
</div>

<!-- 🔍 FORM FILTER -->
<form method="GET" action="{{ url()->current() }}" 
      class="bg-white p-4 rounded-xl shadow flex flex-wrap gap-3 items-center text-sm mt-3">

  <select name="tanggal" class="border rounded-lg px-2 py-1 focus:ring focus:ring-blue-300 w-20">
    <option value="">Tgl</option>
    @for ($i = 1; $i <= 31; $i++)
      <option value="{{ sprintf('%02d', $i) }}" {{ request('tanggal') == sprintf('%02d', $i) ? 'selected' : '' }}>
        {{ $i }}
      </option>
    @endfor
  </select>

  <select name="bulan" class="border rounded-lg px-2 py-1 focus:ring focus:ring-blue-300 w-28">
    <option value="">Bulan</option>
    @php
      $bulan = [
        '01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'Mei','06'=>'Jun',
        '07'=>'Jul','08'=>'Agu','09'=>'Sep','10'=>'Okt','11'=>'Nov','12'=>'Des'
      ];
    @endphp
    @foreach ($bulan as $num => $nama)
      <option value="{{ $num }}" {{ request('bulan') == $num ? 'selected' : '' }}>{{ $nama }}</option>
    @endforeach
  </select>

  <select name="tahun" class="border rounded-lg px-2 py-1 focus:ring focus:ring-blue-300 w-24">
    <option value="">Tahun</option>
    @for ($i = 2020; $i <= date('Y'); $i++)
      <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
    @endfor
  </select>

  <select name="kategori" class="border rounded-lg px-2 py-1 focus:ring focus:ring-blue-300 w-40">
    <option value="">Semua Kategori</option>
    @foreach ($kategori as $kat)
      <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>
        {{ $kat->nama }}
      </option>
    @endforeach
  </select>

  <button type="submit" 
          class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 transition text-sm">
    Lihat
  </button>

  <a href="{{ url()->current() }}" 
     class="bg-gray-200 text-gray-700 px-3 py-1 rounded-lg hover:bg-gray-300 transition text-sm">
    Reset
  </a>
</form>

<!-- 📋 HASIL BERITA -->
<div class="mt-5 grid gap-5 [grid-template-columns:repeat(auto-fit,minmax(280px,1fr))] max-w-7xl mx-auto">
  @forelse ($berita as $item)
    @php
      $title = $item->title ?? $item->judul ?? 'Tanpa Judul';
      $content = $item->content ?? $item->isi ?? '';
      $kategoriNama = $item->kategori->nama ?? 'Umum';
      $gambar = $item->thumbnail ?? $item->gambar ?? $item->foto ?? null;

      $gambarPath = $gambar && file_exists(public_path('storage/images/berita/' . $gambar))
          ? asset('storage/images/berita/' . $gambar)
          : asset('assets/img/noimage.jpg');
    @endphp

    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition flex flex-col overflow-hidden h-full">
      <img src="{{ $gambarPath }}"
           alt="{{ $title }}"
           class="w-full h-48 object-cover">

      <div class="p-4 flex flex-col justify-between flex-1">
        <div>
          <h4 class="font-semibold text-blue-600 text-base leading-tight hover:underline mb-1">
            {{ $title }}
          </h4>
          <p class="text-xs text-gray-500 mb-1">
            {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') }}
          </p>
          <p class="text-gray-700 text-sm leading-snug line-clamp-4">
            {{ \Illuminate\Support\Str::limit(strip_tags($content), 130) }}
          </p>
        </div>
        <div class="mt-3">
          <span class="text-[10px] bg-blue-100 text-blue-600 px-2 py-0.5 rounded">
            {{ $kategoriNama }}
          </span>
        </div>
      </div>
    </div>
  @empty
    @if ($adaFilter)
      <p class="text-center text-gray-500">Tidak ada berita ditemukan.</p>
    @endif
  @endforelse
</div>











<!-- SEMUA BERITA -->
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
                  
 <!-- GRID 2 KOLOM COMPACT -->
<ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @forelse ($semuaBerita as $item)
        <li class="bg-white rounded-lg shadow transition hover:-translate-y-1 hover:shadow-lg overflow-hidden">
            <!-- Gambar (diperkecil tinggi) -->
            <div class="h-20 w-full overflow-hidden">
                <a href="{{ route('detail.berita', $item->slug) }}">
                    <img 
                        src="{{ asset('storage/images/berita/' . ($item->thumbnail ?? 'default.jpg')) }}" 
                        alt="{{ $item->title ?? 'Berita' }}" 
                        class="w-full h-full object-cover"
                    >
                </a>
            </div>

            <!-- Konten (diperkecil padding dan font) -->
            <div class="p-3 space-y-1">
                <h3 class="text-base font-semibold text-blue-900 hover:text-blue-600 transition leading-tight">
                    <a href="{{ route('detail.berita', $item->slug) }}">
                        {{ $item->title ?? 'Judul Tidak Diketahui' }}
                    </a>
                </h3>

                <div class="text-xs text-gray-500 flex items-center gap-1">
                    <i class="fa-regular fa-calendar text-blue-500 text-xs"></i>
                    {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                </div>

                <p class="text-gray-700 text-xs line-clamp-2">
                    {{ strip_tags($item->isi ?? $item->content ?? 'Tidak ada isi berita') }}
                </p>

                <a href="{{ route('detail.berita', $item->slug) }}" 
                   class="text-xs text-blue-600 font-medium hover:underline">
                    Baca Selengkapnya →
                </a>
            </div>
        </li>
    @empty
        <li>
            <div class="bg-gray-50 p-4 rounded-lg text-center text-gray-500 text-sm">
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
</div>








</section>
@endsection



