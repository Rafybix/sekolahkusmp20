@extends('frontend.template.app')
@section('content')
{{-- INDEX BERITA --}}
<section class="col-span-6 space-y-6">
  <!-- JUDUL HALAMAN -->
  <div class="bg-white shadow rounded-xl p-4 flex items-center gap-2 border-l-4 border-blue-500">
    <i class="fa-solid fa-newspaper text-blue-500 text-xl"></i>
    <h2 class="text-2xl font-bold text-gray-800">Index Berita</h2>
  </div>

  <!-- FILTER PENCARIAN -->
<div class="bg-white p-4 rounded-xl shadow flex flex-wrap gap-3 items-center text-sm">
  <input id="searchInput" 
         type="text" 
         placeholder="Cari berita..." 
         class="border rounded-lg px-2 py-1 w-full sm:w-52 focus:ring focus:ring-blue-300 outline-none">

  <select id="filterTanggal" class="border rounded-lg px-2 py-1 focus:ring focus:ring-blue-300 w-20">
    <option value="">Tgl</option>
    @for ($i = 1; $i <= 31; $i++)
      <option value="{{ sprintf('%02d', $i) }}">{{ $i }}</option>
    @endfor
  </select>

  <select id="filterBulan" class="border rounded-lg px-2 py-1 focus:ring focus:ring-blue-300 w-28">
    <option value="">Bulan</option>
    @php
      $bulan = ['01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'Mei','06'=>'Jun','07'=>'Jul','08'=>'Agu','09'=>'Sep','10'=>'Okt','11'=>'Nov','12'=>'Des'];
    @endphp
    @foreach ($bulan as $num => $nama)
      <option value="{{ $num }}">{{ $nama }}</option>
    @endforeach
  </select>

  <select id="filterTahun" class="border rounded-lg px-2 py-1 focus:ring focus:ring-blue-300 w-24">
    <option value="">Tahun</option>
    @for ($i = 2020; $i <= date('Y'); $i++)
      <option value="{{ $i }}">{{ $i }}</option>
    @endfor
  </select>

  <button id="filterBtn" 
          class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 transition text-sm">
    Lihat
  </button>
</div>


  <!-- DAFTAR BERITA -->
  <div id="daftarBerita" class="space-y-5">
    <!-- ITEM BERITA -->
    <div class="berita bg-white shadow rounded-xl p-5 flex gap-5 hover:shadow-lg transition duration-300"
         data-tanggal="14" data-bulan="04" data-tahun="2022">
      <img src="https://images.unsplash.com/photo-1596495577886-d920f1fb7238?auto=format&fit=crop&w=300&q=80"
           alt="Gambar Berita 1" class="w-28 h-28 object-cover rounded-lg">
      <div>
        <h3 class="text-lg font-bold text-gray-800 hover:text-blue-600 cursor-pointer">
          PENILAIAN TENGAH SEMESTER GENAP SUSULAN TAHUN 2022
        </h3>
        <p class="text-sm text-gray-500 mb-2">
          <span class="font-semibold text-blue-600">Kategori:</span> Berita • 2022-04-14 • 09:18 WIB
        </p>
        <p class="text-gray-700 leading-relaxed">
          Assalamu’alaikum... Bagi siswa SMPN 20 Kendari yang belum mengikuti penilaian tengah semester, berikut link soal penilaian susulan.
        </p>
      </div>
    </div>

    <div class="berita bg-white shadow rounded-xl p-5 flex gap-5 hover:shadow-lg transition duration-300"
         data-tanggal="17" data-bulan="06" data-tahun="2021">
      <img src="https://images.unsplash.com/photo-1588072432836-e10032774350?auto=format&fit=crop&w=300&q=80"
           alt="Gambar Berita 2" class="w-28 h-28 object-cover rounded-lg">
      <div>
        <h3 class="text-lg font-bold text-gray-800 hover:text-blue-600 cursor-pointer">
          PPDB SMPN 20 KENDARI TAHUN AJARAN 2021/2022
        </h3>
        <p class="text-sm text-gray-500 mb-2">
          <span class="font-semibold text-blue-600">Kategori:</span> Berita • 2021-06-17 • 01:33 WIB
        </p>
        <p class="text-gray-700 leading-relaxed">
          Penerimaan peserta didik baru SMP Negeri 20 Kendari untuk tahun pelajaran 2021/2022 telah dibuka. Segera daftar dan bergabung bersama kami!
        </p>
      </div>
    </div>

    <div class="berita bg-white shadow rounded-xl p-5 flex gap-5 hover:shadow-lg transition duration-300"
         data-tanggal="05" data-bulan="06" data-tahun="2020">
      <img src="https://images.unsplash.com/photo-1601933470928-c1b8b89b3e60?auto=format&fit=crop&w=300&q=80"
           alt="Gambar Berita 3" class="w-28 h-28 object-cover rounded-lg">
      <div>
        <h3 class="text-lg font-bold text-gray-800 hover:text-blue-600 cursor-pointer">
          PENGUMUMAN KELULUSAN KELAS IX SMPN 20 KENDARI TAHUN 2020
        </h3>
        <p class="text-sm text-gray-500 mb-2">
          <span class="font-semibold text-blue-600">Kategori:</span> Berita • 2020-06-05 • 03:04 WIB
        </p>
        <p class="text-gray-700 leading-relaxed">
          Pengumuman kelulusan kelas IX SMP Negeri 20 Kendari tahun pelajaran 2019/2020 akan diumumkan melalui website resmi pada Jumat, 5 Juni 2020 pukul 16.00 WITA.
        </p>
      </div>
    </div>
  </div>
</section>
@endsection



