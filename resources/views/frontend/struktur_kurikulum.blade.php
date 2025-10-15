@extends('frontend.template.app')

@section('content')
<section class="col-span-6 space-y-6">
    <div class="bg-white p-6 h-full flex flex-col justify-start">
        <div class="flex items-center mb-6">
            <i class="fa-solid fa-diagram-project text-blue-600 text-3xl mr-3"></i>
            <h2 class="text-3xl font-bold text-gray-800 border-l-4 border-blue-500 pl-3">
                Struktur Kurikulum
            </h2>
        </div>

        <!-- FOTO KURIKULUM -->
        <div class="mt-10 space-y-8">
            @forelse($kurikulums as $kurikulum)
                <div class="overflow-hidden transition duration-300">
                    <img src="{{ asset('storage/' . $kurikulum->foto) }}" 
                         alt="Struktur Kurikulum" 
                         class="w-full h-[90vh] object-cover cursor-pointer"
                         onclick="openLightbox('{{ asset('storage/' . $kurikulum->foto) }}')">
                </div>
            @empty
                <p class="text-center text-gray-500 text-lg mt-6">Belum ada foto kurikulum yang diunggah.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- LIGHTBOX -->
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center hidden z-50">
    <div class="relative max-w-full max-h-[95vh] p-4">
        <!-- Gambar asli diperbesar tapi masih fit di layar -->
        <img id="lightbox-img" src="" alt="Foto Kurikulum" class="w-auto max-w-full h-auto max-h-[95vh] rounded shadow-lg">
        <button onclick="closeLightbox()" class="absolute top-2 right-2 text-white text-3xl font-bold">&times;</button>
    </div>
</div>

<script>
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');

    function openLightbox(src) {
        lightboxImg.src = src;
        lightbox.classList.remove('hidden');
    }

    function closeLightbox() {
        lightbox.classList.add('hidden');
        lightboxImg.src = '';
    }

    // tutup lightbox jika klik di luar gambar
    lightbox.addEventListener('click', function(e) {
        if(e.target === lightbox) closeLightbox();
    });
</script>
@endsection
