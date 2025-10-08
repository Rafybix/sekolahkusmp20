
<!-- SIDEBAR KANAN -->
        <aside class="col-span-3 space-y-6">
           <!-- Search -->
<div class="bg-white shadow rounded-xl p-5">
    <h2 class="text-gray-700 font-semibold mb-3">Cari Artikel</h2>

    <form action="{{ route('berita.search') }}" method="GET" class="flex mb-4" id="searchForm">
        <input 
            type="text" 
            name="q" 
            id="searchInput"
            placeholder="Cari artikel berdasarkan judul..." 
            autocomplete="off"
            class="w-full border rounded-l px-3 py-2 focus:outline-none"
        >
        <button type="submit" class="bg-black text-white px-3 rounded-r">
            <i class="fas fa-search"></i>
        </button>
    </form>

    <!-- Hasil Pencarian -->
    <div id="searchResults" class="mt-4 space-y-3 hidden">
        <h3 class="text-gray-700 font-semibold mb-2 border-b pb-1">
            Hasil Pencarian:
        </h3>
        <div id="searchItems"></div>
    </div>
</div>

<!-- JS untuk AJAX Search -->
<script>
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    const searchItems = document.getElementById('searchItems');
    const form = document.getElementById('searchForm');

    let delayTimer;

    // Saat user mengetik (real-time)
    searchInput.addEventListener('input', function() {
        clearTimeout(delayTimer);
        const query = this.value.trim();

        if (query === '') {
            searchResults.classList.add('hidden');
            searchItems.innerHTML = '';
            return;
        }

        // kasih delay 0.4 detik biar gak spam server
        delayTimer = setTimeout(() => {
            fetch(`{{ route('berita.search') }}?q=${encodeURIComponent(query)}`)
                .then(response => response.text())
                .then(html => {
                    // cari data json di dalam respons (kita ambil dari route)
                    try {
                        const data = JSON.parse(html);
                        tampilkanHasil(data);
                    } catch {
                        searchItems.innerHTML = '<p class="text-gray-500 text-sm">Tidak ada hasil ditemukan.</p>';
                        searchResults.classList.remove('hidden');
                    }
                })
                .catch(() => {
                    searchItems.innerHTML = '<p class="text-gray-500 text-sm">Terjadi kesalahan.</p>';
                    searchResults.classList.remove('hidden');
                });
        }, 400);
    });

    // Kalau user klik tombol cari tetap bisa submit
    form.addEventListener('submit', function(e) {
        const query = searchInput.value.trim();
        if (query === '') {
            e.preventDefault();
            searchResults.classList.add('hidden');
        }
    });

    // Fungsi menampilkan hasil
    function tampilkanHasil(berita) {
        if (berita.length === 0) {
            searchItems.innerHTML = '<p class="text-gray-500 text-sm">Tidak ada hasil ditemukan.</p>';
            searchResults.classList.remove('hidden');
            return;
        }

        searchItems.innerHTML = berita.map(item => `
            <div class="flex items-start space-x-3">
                <img src="/storage/images/berita/${item.thumbnail}" 
                     alt="${item.title}" 
                     class="w-16 h-16 object-cover rounded-md">
                <div>
                    <h4 class="text-sm font-semibold text-gray-800 leading-tight">
                        <a href="/berita/${item.slug}" class="hover:text-blue-600">
                            ${item.title.length > 50 ? item.title.slice(0, 50) + '...' : item.title}
                        </a>
                    </h4>
                    <p class="text-xs text-gray-500">${item.tanggal}</p>
                </div>
            </div>
        `).join('');

        searchResults.classList.remove('hidden');
    }
</script>





            <!-- Kalender -->
            <div class="bg-white shadow rounded-xl p-5">
                <h2 class="text-gray-700 font-semibold mb-3">Kalender</h2>
                <div id="calendar" class="text-center"></div>
            </div>

            @php
use App\Models\Berita;

// Ambil hanya 12 berita terbaru aktif
$recentPosts = Berita::where('is_active', '0')
    ->orderBy('created_at', 'desc')
    ->take(12)
    ->get();
@endphp

<div class="bg-white shadow rounded-xl p-5">
    <h2 class="text-gray-700 font-semibold mb-3">Recent Posts</h2>
    <ul class="space-y-2 text-sm text-gray-700">
        @forelse ($recentPosts as $post)
            <li class="border-b border-gray-100 pb-1">
                <a href="{{ route('detail.berita', $post->slug) }}" 
                   class="hover:text-blue-600 transition-colors line-clamp-1">
                   {{ $post->title ?? 'Judul Tidak Diketahui' }}
                </a>
            </li>
        @empty
            <li class="text-gray-500 text-sm italic">
                Belum ada berita terbaru.
            </li>
        @endforelse
    </ul>
</div>

        </aside>