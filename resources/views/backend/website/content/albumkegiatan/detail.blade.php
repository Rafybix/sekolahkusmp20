@extends('frontend.template.app')
@section('content')
<section class="col-span-6 space-y-6">
    <div class="container">
  <h2 class="mb-4">{{ $album->nama_album }}</h2>
  <p>{{ $album->deskripsi }}</p>

  <div class="row">
    @forelse($album->photos as $photo)
      <div class="col-md-3 mb-3">
        <div class="card shadow-sm">
        <img src="{{ asset('storage/' . $photo->file_path) }}" 
     class="card-img-top" 
     alt="Foto Kegiatan">
        </div>
      </div>
    @empty
      <p>Tidak ada foto di album ini.</p>
    @endforelse
  </div>
</div>
</section>
@endsection