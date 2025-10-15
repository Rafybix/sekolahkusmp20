@extends('frontend.template.app')
@section('content')

<section class="col-span-6 space-y-6">
    <div class="bg-white p-6 rounded-xl shadow">
        <div class="flex items-center mb-4">
            <i class="fa-solid fa-people-group text-blue-600 text-2xl mr-3"></i>
            <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-500 pl-3">
                Ekstrakurikuler SMP Negeri 20 Kendari
            </h2>
        </div>

        <p class="text-center text-gray-600 max-w-2xl mx-auto">
            Berikut berbagai kegiatan ekstrakurikuler di SMP Negeri 20 Kendari yang membantu 
            siswa mengembangkan bakat, minat, dan karakter mereka.
        </p>

        @php
            $deskripsiEkskul = [
                'Sepak Bola' => [
                    'deskripsi_singkat' => 'Menumbuhkan sportivitas dan kerja sama tim.',
                    'deskripsi_lengkap' => 'Ekskul Sepak Bola bertujuan mengembangkan kemampuan teknik, fisik, dan kerja sama tim. Siswa berlatih secara rutin dan mengikuti turnamen antar sekolah. Selain melatih fisik, kegiatan ini juga menanamkan nilai fair play, disiplin, dan tanggung jawab.',
                    'gambar_default' => 'https://source.unsplash.com/800x400/?football,team'
                ],
                'Bola Volly' => [
                    'deskripsi_singkat' => 'Melatih ketangkasan dan kerja sama kelompok.',
                    'deskripsi_lengkap' => 'Ekskul Bola Volly melatih koordinasi, komunikasi, dan ketangkasan fisik. Anggota mengikuti latihan rutin dan lomba antar sekolah. Kegiatan ini menumbuhkan rasa percaya diri dan semangat tim yang solid.',
                    'gambar_default' => 'https://source.unsplash.com/800x400/?volleyball,match'
                ],
                'Musik' => [
                    'deskripsi_singkat' => 'Menyalurkan bakat seni dan kreativitas.',
                    'deskripsi_lengkap' => 'Ekskul Musik memberikan wadah bagi siswa yang memiliki minat di bidang seni musik. Siswa dapat belajar alat musik, bernyanyi, hingga membuat komposisi lagu. Ekskul ini juga rutin tampil di acara sekolah dan lomba seni tingkat kota.',
                    'gambar_default' => 'https://source.unsplash.com/800x400/?music,band'
                ],
                'Pencinta Alam (PA)' => [
                    'deskripsi_singkat' => 'Belajar mencintai dan menjaga lingkungan.',
                    'deskripsi_lengkap' => 'Ekskul Pencinta Alam (PA) berfokus pada kegiatan di alam terbuka seperti hiking, camping, dan kegiatan sosial lingkungan. Siswa diajarkan cinta lingkungan, bertahan hidup di alam, dan tanggung jawab terhadap kelestarian alam.',
                    'gambar_default' => 'https://source.unsplash.com/800x400/?nature,mountain'
                ],
                'PMR' => [
                    'deskripsi_singkat' => 'Mempelajari pertolongan pertama dan kemanusiaan.',
                    'deskripsi_lengkap' => 'PMR (Palang Merah Remaja) mengajarkan kepedulian, kemanusiaan, dan keterampilan pertolongan pertama. Siswa belajar menangani luka ringan, evakuasi korban, serta menjadi relawan dalam kegiatan sosial.',
                    'gambar_default' => 'https://source.unsplash.com/800x400/?redcross,healthcare'
                ],
                'Bola Basket' => [
                    'deskripsi_singkat' => 'Meningkatkan daya tahan dan fokus.',
                    'deskripsi_lengkap' => 'Ekskul Basket mengajarkan strategi bermain, kerja sama tim, dan ketangguhan mental. Latihan dilakukan secara rutin untuk menghadapi berbagai turnamen antar sekolah. Selain fisik, kegiatan ini juga menumbuhkan kepemimpinan dan sportivitas.',
                    'gambar_default' => 'https://source.unsplash.com/800x400/?basketball,hoop'
                ],
                'Pramuka' => [
                    'deskripsi_singkat' => 'Mendidik kedisiplinan dan kemandirian.',
                    'deskripsi_lengkap' => 'Pramuka menanamkan nilai disiplin, kemandirian, dan tanggung jawab. Kegiatannya meliputi latihan baris-berbaris, kemah, tali-temali, dan kegiatan sosial masyarakat.',
                    'gambar_default' => 'https://source.unsplash.com/800x400/?scout,camping'
                ],
                'English Club' => [
                    'deskripsi_singkat' => 'Melatih kemampuan berbahasa Inggris.',
                    'deskripsi_lengkap' => 'English Club membantu siswa mengasah kemampuan berbahasa Inggris melalui percakapan, debat, storytelling, dan lomba pidato. Tujuannya meningkatkan kepercayaan diri dan kemampuan komunikasi global.',
                    'gambar_default' => 'https://source.unsplash.com/800x400/?english,study'
                ],
                'Pencak Silat' => [
                    'deskripsi_singkat' => 'Melestarikan seni bela diri Indonesia.',
                    'deskripsi_lengkap' => 'Ekskul Pencak Silat mengajarkan teknik bela diri tradisional Indonesia, mengembangkan kekuatan fisik dan mental, serta menanamkan nilai disiplin, hormat, dan sportivitas.',
                    'gambar_default' => 'https://source.unsplash.com/800x400/?silat,martialarts'
                ],
                'Teater' => [
                    'deskripsi_singkat' => 'Menyalurkan bakat akting dan ekspresi diri.',
                    'deskripsi_lengkap' => 'Ekskul Teater memberikan wadah bagi siswa yang tertarik pada seni peran, drama, dan ekspresi diri. Melalui latihan rutin, siswa belajar tampil di depan umum, memahami karakter, serta menumbuhkan rasa percaya diri dan kerja sama.',
                    'gambar_default' => 'https://source.unsplash.com/800x400/?theater,drama'
                ],
                'Taekwondo' => [
                    'deskripsi_singkat' => 'Melatih fisik, disiplin, dan kepercayaan diri.',
                    'deskripsi_lengkap' => 'Ekskul Taekwondo mengajarkan seni bela diri asal Korea dengan fokus pada ketangkasan, konsentrasi, dan pengendalian diri. Selain melatih tubuh, kegiatan ini menumbuhkan semangat pantang menyerah dan sportivitas.',
                    'gambar_default' => 'https://smpn20kendari.sch.id/system/application/views/main-web/galeri/99512333283-img_20170205_002823.jpg'
                ],
            ];
            $ekskulDB = \App\Models\Ekskul::all();
        @endphp

        <!-- GRID EKSKUL -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-6">
            @foreach ($ekskulDB as $item)
                @php
                    $data = $deskripsiEkskul[$item->nama] ?? null;
                    if(!$data) continue; // skip kalau nama ekskul gak ada di array deskripsi
                    $gambar = $item->foto ? asset('storage/'.$item->foto) : $data['gambar_default'];
                @endphp

                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 shadow-sm hover:shadow-md transition">
                    <h3 class="font-semibold text-lg text-gray-800 mb-2">{{ $item->nama }}</h3>
                    <p class="text-sm text-gray-600">{{ $data['deskripsi_singkat'] }}</p>
                    <button 
                        class="mt-3 text-blue-600 font-medium hover:underline"
                        onclick='openPopup(@json(["nama" => $item->nama, "deskripsi_lengkap" => $data["deskripsi_lengkap"], "gambar" => $gambar]))'
                    >
                        Baca Selengkapnya →
                    </button>
                </div>
            @endforeach
        </div>
    </div>

    <!-- POPUP LANDSCAPE -->
    <div id="popup" class="hidden fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center z-50">
        <div class="bg-white w-11/12 md:w-3/4 lg:w-2/3 rounded-xl shadow-lg overflow-hidden relative animate-fadeIn">
            <div class="flex flex-col md:flex-row">
                <!-- Gambar kiri -->
                <div class="md:w-1/2 w-full overflow-hidden">
                    <img id="popup-image" src="" alt="Gambar Ekskul" class="h-56 md:h-full w-full object-cover animate-slideIn">
                </div>
                <!-- Konten kanan -->
                <div class="md:w-1/2 w-full p-6 flex flex-col justify-between">
                    <div>
                        <h2 id="popup-title" class="text-2xl font-bold text-gray-800 mb-3"></h2>
                        <p id="popup-description" class="text-gray-700 leading-relaxed"></p>
                    </div>
                    <button onclick="closePopup()" class="mt-6 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        @keyframes slideIn {
            from { transform: translateX(-30px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .animate-fadeIn { animation: fadeIn 0.3s ease-out; }
        .animate-slideIn { animation: slideIn 0.5s ease-out; }
    </style>
    <script>
        function openPopup(data) {
            document.getElementById("popup-image").src = data.gambar;
            document.getElementById("popup-title").textContent = data.nama;
            document.getElementById("popup-description").textContent = data.deskripsi_lengkap;
            document.getElementById("popup").classList.remove("hidden");
        }
        function closePopup() {
            document.getElementById("popup").classList.add("hidden");
        }
    </script>
</section>
@endsection
