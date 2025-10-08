<section class="col-span-6 space-y-6">

  <!-- Berita Utama -->
  <div>
    <div class="relative bg-white shadow rounded-xl overflow-hidden h-[450px]">
      <img src="{{ asset('assets/img/smp20.jpg') }}" class="w-full h-full object-cover">
      <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
      <div class="absolute bottom-5 left-5 right-5 text-white">
        <h2 class="text-2xl font-bold">SMP Negeri 20 Kendari</h2>
        <p class="text-sm mt-1">
          Tempat menimba ilmu, tempat tercipta kenangan. SMPN 20 Kendari, rumah kedua penuh cerita.
        </p>
      </div>
    </div>
  </div>

  <!-- Artikel -->
  <hr class="border-t-4 border-black my-4">

  <div class="grid grid-cols-2 gap-6">
    @foreach ($berita as $item)
      <article class="bg-white rounded-2xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg flex flex-col">
        <!-- Gambar -->
        <img 
          src="{{ asset('storage/' . $item->gambar) }}" 
          alt="{{ $item->judul }}" 
          class="w-full h-44 object-cover">

        <!-- Konten -->
        <div class="p-5 flex-1 flex flex-col">
          <h3 class="font-semibold text-gray-800 text-lg leading-snug hover:text-blue-600 transition">
            {{ $item->judul }}
          </h3>

          <p class="text-sm text-gray-500 flex items-center mt-1">
            <i class="far fa-calendar-alt mr-2 text-gray-400"></i>
            {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
          </p>

          <p class="text-sm text-gray-600 mt-3 flex-1 leading-relaxed">
            {{ Str::limit(strip_tags($item->isi), 120, '...') }}
          </p>

          <a href="{{ url('berita/' . $item->id) }}" 
             class="mt-4 inline-block text-center bg-white border border-gray-300 text-gray-800 rounded-lg px-4 py-2 text-sm font-medium hover:bg-gray-100 transition">
            Baca Selengkapnya
          </a>
        </div>
      </article>
    @endforeach
  </div>

</section>
