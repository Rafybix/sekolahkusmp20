@extends('frontend.template.app')
@section('content')
 <!-- KONTEN TENGAH -->
        <section class="col-span-6 space-y-6">
            <!-- Berita Utama -->
            <div>
                <div class="relative bg-white shadow rounded-xl overflow-hidden h-[450px]">
                    <img src="{{ asset('assets/img/smp20.jpg') }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    <div class="absolute bottom-5 left-5 right-5 text-white">
                        <h2 class="text-2xl font-bold">SMP Negeri 20 Kendari</h2>
                        <p class="text-sm mt-1">Tempat menimba ilmu, tempat tercipta kenangan. SMPN 20 Kendari, rumah
                            kedua penuh cerita.</p>
                    </div>
                </div>
            </div>

            <!-- Artikel -->

            <hr class="border-t-4 border-black my-4">
            <div class="grid grid-cols-2 gap-6">
                <!-- Card 1 -->
                <article class="bg-white shadow rounded-xl overflow-hidden flex flex-col">
                    <img src="https://tse2.mm.bing.net/th/id/OIP.K9sCF2SaBxAscCd8zSRkLgHaE8?pid=Api&P=0&h=220"
                        class="w-full h-40 object-cover">
                    <div class="p-4 flex-1 flex flex-col">
                        <h3 class="font-semibold text-gray-800">Selamat Datang di SMA Alur</h3>
                        <p class="text-sm text-gray-500 flex items-center mt-1"><i
                                class="far fa-calendar-alt mr-2"></i> 3 Oktober 2025</p>
                        <p class="text-sm text-gray-600 mt-2 flex-1">Kami dengan bangga menyambut tahun ajaran baru
                            dengan semangat dan dedikasi untuk memberikan pendidikan terbaik.</p>
                        <a href="#"
                            class="mt-3 inline-block text-center bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 text-sm font-medium hover:bg-gray-200">Baca
                            Selengkapnya</a>
                    </div>
                </article>
                <!-- Card 2 -->
                <article class="bg-white shadow rounded-xl overflow-hidden flex flex-col">
                    <img src="https://tse2.mm.bing.net/th/id/OIP.K9sCF2SaBxAscCd8zSRkLgHaE8?pid=Api&P=0&h=220"
                        class="w-full h-40 object-cover">
                    <div class="p-4 flex-1 flex flex-col">
                        <h3 class="font-semibold text-gray-800">Prestasi Siswa di Olimpiade Sains Nasional</h3>
                        <p class="text-sm text-gray-500 flex items-center mt-1"><i
                                class="far fa-calendar-alt mr-2"></i> 2 Oktober 2025</p>
                        <p class="text-sm text-gray-600 mt-2 flex-1">Siswa-siswi SMA Alur meraih medali emas dan perak
                            dalam kompetisi Olimpiade Sains Nasional tahun ini.</p>
                        <a href="#"
                            class="mt-3 inline-block text-center bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 text-sm font-medium hover:bg-gray-200">Baca
                            Selengkapnya</a>
                    </div>
                </article>
                <!-- Card 3 -->
                <article class="bg-white shadow rounded-xl overflow-hidden flex flex-col">
                    <img src="https://i.ibb.co/0Vxq2Qh/artikel1.jpg" class="w-full h-40 object-cover">
                    <div class="p-4 flex-1 flex flex-col">
                        <h3 class="font-semibold text-gray-800">Program Ekstrakurikuler Baru</h3>
                        <p class="text-sm text-gray-500 flex items-center mt-1"><i
                                class="far fa-calendar-alt mr-2"></i> 1 Oktober 2025</p>
                        <p class="text-sm text-gray-600 mt-2 flex-1">SMA Alur membuka berbagai ekstrakurikuler baru
                            untuk mendukung bakat dan minat siswa.</p>
                        <a href="#"
                            class="mt-3 inline-block text-center bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 text-sm font-medium hover:bg-gray-200">Baca
                            Selengkapnya</a>
                    </div>
                </article>
                <!-- Card 4 -->
                <article class="bg-white shadow rounded-xl overflow-hidden flex flex-col">
                    <img src="https://i.ibb.co/pWvsvK7/artikel2.jpg" class="w-full h-40 object-cover">
                    <div class="p-4 flex-1 flex flex-col">
                        <h3 class="font-semibold text-gray-800">Kunjungan Industri ke Perusahaan Teknologi</h3>
                        <p class="text-sm text-gray-500 flex items-center mt-1"><i
                                class="far fa-calendar-alt mr-2"></i> 30 September 2025</p>
                        <p class="text-sm text-gray-600 mt-2 flex-1">Siswa berkesempatan belajar langsung di perusahaan
                            teknologi ternama di Indonesia.</p>
                        <a href="#"
                            class="mt-3 inline-block text-center bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 text-sm font-medium hover:bg-gray-200">Baca
                            Selengkapnya</a>
                    </div>
                </article>
            </div>
        </section>
@endsection