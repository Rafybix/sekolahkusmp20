@extends('frontend.template.app')
@section('content')
<section class="col-span-6 space-y-6">
  <div class="container">
    <h2 class="mb-4 text-2xl font-bold text-center">{{ $album->nama }}</h2>
    <p class="text-gray-600 text-center">{{ $album->deskripsi }}</p>

    <!-- Grid Foto -->
    <div class="photo-grid mt-6">
      @forelse($album->photos as $photo)
        <div class="photo-item">
          <a href="{{ asset('storage/' . $photo->file_path) }}"
             data-bs-toggle="modal"
             data-bs-target="#imageModal"
             data-img="{{ asset('storage/' . $photo->file_path) }}">
            <img src="{{ asset('storage/' . $photo->file_path) }}"
                 alt="Foto Kegiatan">
          </a>
        </div>
      @empty
        <p class="text-center text-gray-500 col-span-full">Tidak ada foto di album ini.</p>
      @endforelse
    </div>
  </div>

  <!-- Modal Preview Gambar -->
  <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-body text-center p-0">
          <img src="" id="modalImage" class="img-fluid rounded" alt="Foto Preview">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- JS & CSS langsung disini biar pasti jalan -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('imageModal');
    modal.addEventListener('show.bs.modal', function(event) {
      const link = event.relatedTarget;
      const imgSrc = link.getAttribute('data-img');
      modal.querySelector('#modalImage').src = imgSrc;
    });
  });
</script>

<style>
.photo-grid {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 6px;
}
.photo-item {
  aspect-ratio: 1 / 1;
  overflow: hidden;
  border-radius: 5px;
  border: 1px solid #ddd;
  transition: transform 0.2s ease-in-out;
}
.photo-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.photo-item:hover {
  transform: scale(1.03);
}
@media (max-width: 992px) {
  .photo-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}
@media (max-width: 576px) {
  .photo-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}
</style>
@endsection
