<aside class="col-span-3 space-y-6">
    <!-- Kepala Sekolah -->
    <div class="bg-white shadow rounded-xl p-5">
        <h2 class="text-gray-700 font-semibold mb-3">Kepala Sekolah</h2>
        <img src="{{ asset('assets/img/kepala-sekolah.jpg') }}"
            alt="Kepala Sekolah" class="rounded-lg mb-3">
        <h3 class="font-bold text-gray-700">Wa Ode Nurhafiah S.Pd</h3>
        <p class="text-gray-600 text-sm mt-1">Nip.19760612 200212 2 010</p>
        <hr class="border-t border-gray-300 my-4 opacity-70">
        <p class="text-sm text-gray-700 mt-3 font-semibold">Ikuti Kami:</p>
        <div class="flex space-x-3 mt-2 text-gray-600 text-lg">
            <a href="" class="hover:text-pink-500"><i class="fab fa-instagram"></i></a>
            <a href="#" class="hover:text-blue-600"><i class="fab fa-facebook"></i></a>
            <a href="#" class="hover:text-sky-500"><i class="fab fa-twitter"></i></a>
            <a href="https://www.youtube.com/channel/UC6Ch-ozwmR80eepmeACxE1g/videos" class="hover:text-red-600"><i class="fab fa-youtube"></i></a>
        </div>
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
