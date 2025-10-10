@extends('frontend.template.app')
@section('content')
 <!-- KONTEN TENGAH -->
        <section class="col-span-6 space-y-6">
            <!-- Berita Utama -->
            <div>
               <div class="relative bg-white shadow rounded-xl overflow-hidden h-[450px]">
  <img id="heroImage" 
       src="{{ asset('Assets/Frontend/img/smp20.jpg') }}" 
       class="w-full h-full object-cover transition-opacity duration-500">
  <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
  <div class="absolute bottom-5 left-5 right-5 text-white">
    <h2 class="text-2xl font-bold">SMP Negeri 20 Kendari</h2>
    <p class="text-sm mt-1">
      Tempat menimba ilmu, tempat tercipta kenangan. SMPN 20 Kendari, rumah kedua penuh cerita.
    </p>
  </div>
</div>

            </div>


@php
    $currentPage = request()->get('page', 1);

    $perPage = 6;

    $offset = ($currentPage - 1) * $perPage;

    $beritaPage = $berita->slice($offset, $perPage);

    $totalPages = ceil($berita->count() / $perPage);
@endphp

    <div class="grid grid-cols-2 gap-6">
        @foreach ($beritaPage as $item)
            <article class="bg-white shadow rounded-xl overflow-hidden flex flex-col">
                <img src="{{ asset('storage/images/berita/' . $item->thumbnail) }}"
                    alt="{{ $item->title }}"
                    class="w-full h-40 object-cover">

                <div class="p-4 flex-1 flex flex-col">
                    <h3 class="font-semibold text-gray-800">{{ $item->title }}</h3>

                    <p class="text-sm text-gray-500 flex items-center mt-1">
                        <i class="far fa-calendar-alt mr-2"></i>
                        {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('j F Y') }}
                    </p>

                    <p class="text-sm text-gray-600 mt-2 flex-1">
                        {{ Str::limit(strip_tags($item->content), 100, '...') }}
                    </p>

                    <a href="{{ route('detail.berita', $item->slug) }}"
                        class="mt-3 inline-block text-center bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 text-sm font-medium hover:bg-gray-200">
                        Baca Selengkapnya
                    </a>
                </div>
            </article>
        @endforeach
    </div>

    <!-- PAGINATION -->
    @if ($totalPages > 1)
        <div class="mt-6 flex justify-center items-center space-x-2">
            @if ($currentPage > 1)
                <a href="?page={{ $currentPage - 1 }}"
                   class="px-3 py-1 border rounded-lg text-sm bg-gray-100 hover:bg-gray-200">
                    &laquo; Sebelumnya
                </a>
            @endif

            @for ($page = 1; $page <= $totalPages; $page++)
                <a href="?page={{ $page }}"
                   class="px-3 py-1 border rounded-lg text-sm 
                          {{ $page == $currentPage ? 'bg-blue-600 text-white' : 'bg-white hover:bg-gray-100' }}">
                    {{ $page }}
                </a>
            @endfor

            @if ($currentPage < $totalPages)
                <a href="?page={{ $currentPage + 1 }}"
                   class="px-3 py-1 border rounded-lg text-sm bg-gray-100 hover:bg-gray-200">
                    Berikutnya &raquo;
                </a>
            @endif
        </div>
    @endif
</section>

{{-- SCRIPT SLIDESHOW --}}
<script>
    const images = [
        "{{ asset('Assets/Frontend/img/smp20.jpg') }}",
        "{{ asset('Assets/Frontend/img/3.jpg') }}",
        "{{ asset('Assets/Frontend/img/gambar2.jpg') }}",
    ];

    let currentIndex = 0;
    const heroImage = document.getElementById('heroImage');

    setInterval(() => {
        currentIndex = (currentIndex + 1) % images.length;
        heroImage.classList.add('opacity-0');
        setTimeout(() => {
            heroImage.src = images[currentIndex];
            heroImage.classList.remove('opacity-0');
        }, 500);
    }, 4000);
</script>
@endsection
