@extends('frontend.template.app')

@section('title', $berita->title)

@section('content')
<section class="col-span-12 md:col-span-6 space-y-6">

    <!-- Thumbnail + Judul -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="relative">
            <img src="{{ asset('storage/images/berita/' . $berita->thumbnail) }}"
                alt="thumbnail"
                class="w-full h-64 object-cover">
            <div class="absolute bottom-0 left-0 bg-blue-900 text-white p-3 rounded-tr-lg">
                <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($berita->created_at)->format('d M') }}</div>
                <div class="text-sm">{{ \Carbon\Carbon::parse($berita->created_at)->format('Y') }}</div>
            </div>
        </div>
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-3">{{ $berita->title }}</h1>
            <div class="text-gray-600 mb-4 text-sm">
                <i class="fa fa-user mr-1"></i> {{ $berita->user->name }}
                <span class="ml-4"><i class="fa fa-tags mr-1"></i> {{ $berita->kategori->nama }}</span>
            </div>

            <!-- Perbaikan konten biar baris kosong ikut tampil -->
            <div class="prose max-w-none leading-relaxed text-gray-800">
                {!! nl2br(e($berita->content)) !!}
            </div>
        </div>
    </div>

    <!-- Share Sosmed -->
    <div class="flex gap-4 text-xl">
        <a href="#"><i class="fa fa-facebook text-blue-600 hover:opacity-80"></i></a>
        <a href="#"><i class="fa fa-twitter text-sky-500 hover:opacity-80"></i></a>
        <a href="#"><i class="fa fa-linkedin text-blue-700 hover:opacity-80"></i></a>
        <a href="#"><i class="fa fa-pinterest text-red-600 hover:opacity-80"></i></a>
        <a href="#"><i class="fa fa-rss text-yellow-500 hover:opacity-80"></i></a>
        <a href="#"><i class="fa fa-google-plus text-red-500 hover:opacity-80"></i></a>
    </div>

</section>
@endsection
