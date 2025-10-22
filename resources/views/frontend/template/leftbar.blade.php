<aside class="col-span-3 space-y-6">
   <!-- Kepala Sekolah -->
<div class="bg-white shadow rounded-xl p-5">
  <h2 class="text-gray-700 font-semibold mb-3">Kepala Sekolah</h2>

  @if ($kepala)
    <div class="text-center">
      <!-- FOTO (versi kotak) -->
      <img src="{{ asset('storage/' . $kepala->foto) }}"
           alt="{{ $kepala->nama }}"
           class="w-40 h-48 mx-auto mb-3 shadow-md object-cover rounded-lg border border-gray-200">

      <!-- NAMA DAN NIP -->
      <h3 class="font-bold text-gray-800 text-lg">{{ $kepala->nama }}</h3>
      @if ($kepala->nip)
        <p class="text-gray-600 text-sm">NIP. {{ $kepala->nip }}</p>
      @endif

      <!-- GARIS PEMBATAS -->
      <hr class="border-t border-gray-300 my-4 opacity-70">

      <!-- SAMBUTAN SINGKAT -->
      @if ($kepala->sambutan)
        <p class="text-gray-700 text-sm leading-relaxed">
          {{ Str::limit(strip_tags($kepala->sambutan), 100) }}
        </p>
      @endif

      <!-- MEDIA SOSIAL -->
      <p class="text-sm text-gray-700 mt-4 font-semibold">Ikuti Kami:</p>
      <div class="flex justify-center space-x-4 mt-2 text-gray-600 text-xl">
        @if ($kepala->instagram)
          <a href="{{ $kepala->instagram }}" target="_blank" class="hover:text-pink-500">
            <i class="fab fa-instagram"></i>
          </a>
        @endif
        @if ($kepala->facebook)
          <a href="{{ $kepala->facebook }}" target="_blank" class="hover:text-blue-600">
            <i class="fab fa-facebook"></i>
          </a>
        @endif
        @if ($kepala->youtube)
          <a href="{{ $kepala->youtube }}" target="_blank" class="hover:text-red-600">
            <i class="fab fa-youtube"></i>
          </a>
        @endif
      </div>
    </div>
  @else
    <p class="text-gray-500 text-sm text-center">Data kepala sekolah belum tersedia.</p>
  @endif
</div>





    <!-- Berita Terbaru -->
    <div class="bg-white shadow rounded-xl p-5">
        <h2 class="text-gray-700 font-semibold mb-3">Berita Terbaru</h2>

        @php
            use App\Models\Berita;
            // Ambil 10 berita terbaru langsung dari database agar tidak error
            $beritaTerbaru = \App\Models\Berita::where('is_active', '0')
                                ->orderBy('created_at', 'desc')
                                ->take(10)
                                ->get();
        @endphp

        @if ($beritaTerbaru->count() > 0)
            <div class="space-y-4">
                @foreach ($beritaTerbaru as $item)
                    <div class="flex space-x-3">
                        <img src="{{ asset('storage/images/berita/' . $item->thumbnail) }}"
                             alt="{{ $item->title }}"
                             class="w-16 h-16 object-cover rounded-md">
                        <div>
                            <span class="text-xs text-blue-500 font-medium">
                                {{ $item->kategori->nama ?? 'Umum' }}
                            </span>
                            <h3 class="text-sm font-semibold text-gray-700 leading-tight">
                                <a href="{{ route('detail.berita', $item->slug) }}" class="hover:text-blue-600">
                                    {{ Str::limit($item->title, 50) }}
                                </a>
                            </h3>
                            <p class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('j F Y') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-sm">Belum ada berita.</p>
        @endif
    </div>





</aside>
