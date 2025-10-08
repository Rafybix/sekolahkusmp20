@extends('frontend.template.app')
@section('content')
<!-- PENILAIAN DAN EVALUASI SEKOLAH -->
<section class="col-span-6 space-y-6">
    <div class="bg-white rounded-3xl shadow-xl p-10 border border-gray-100">
        <!-- Judul -->
        <div class="text-center mb-10">
            <h2 class="text-4xl font-extrabold text-gray-800 tracking-wide mb-2">
                Penilaian dan Evaluasi Sekolah
            </h2>
            <p class="text-gray-500 text-lg">
                Evaluasi berkelanjutan untuk meningkatkan mutu pendidikan di lingkungan sekolah.
            </p>
            <div class="mt-4 w-32 mx-auto h-1 bg-gradient-to-r from-blue-600 to-blue-400 rounded-full"></div>
        </div>

        <!-- Konten Utama -->
        <div class="grid md:grid-cols-2 gap-10 text-gray-700 leading-relaxed">
            <!-- Kolom 1 -->
            <div class="space-y-5">
                <h3 class="text-2xl font-semibold text-blue-700 border-l-4 border-blue-500 pl-3">
                    Tujuan Penilaian
                </h3>
                <p>
                    Penilaian dilakukan sebagai sarana untuk mengukur sejauh mana proses pembelajaran dan
                    pengelolaan sekolah berjalan efektif. Melalui evaluasi yang terarah, sekolah mampu menilai
                    tingkat keberhasilan siswa, kinerja guru, serta efektivitas program pendidikan.
                </p>
                <p>
                    Hasil penilaian menjadi dasar pengambilan keputusan dalam meningkatkan mutu pembelajaran,
                    memperkuat manajemen sekolah, serta menumbuhkan budaya akademik yang berorientasi pada kualitas.
                </p>
            </div>

            <!-- Kolom 2 -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-2xl shadow-inner border border-blue-200">
                <h3 class="text-2xl font-semibold text-blue-800 mb-3">Aspek Penilaian</h3>
                <ul class="list-disc ml-6 space-y-2">
                    <li>Kedisiplinan dan kehadiran peserta didik dan tenaga pendidik.</li>
                    <li>Prestasi akademik serta non-akademik siswa.</li>
                    <li>Kinerja dan profesionalisme tenaga pendidik.</li>
                    <li>Manajemen sekolah dan pelayanan administrasi.</li>
                    <li>Partisipasi orang tua dan masyarakat.</li>
                    <li>Kebersihan, keamanan, dan kenyamanan lingkungan belajar.</li>
                </ul>
            </div>
        </div>

        <!-- Tabel Skala -->
        <div class="mt-14">
            <h3 class="text-2xl font-semibold text-blue-700 border-l-4 border-blue-500 pl-3 mb-6">
                Skala Penilaian Mutu Sekolah
            </h3>

            <div class="overflow-x-auto rounded-2xl border border-gray-200 shadow-sm">
                <table class="min-w-full text-left text-gray-700">
                    <thead class="bg-gradient-to-r from-blue-600 to-blue-500 text-white">
                        <tr>
                            <th class="py-4 px-6 font-semibold text-sm uppercase">Kategori</th>
                            <th class="py-4 px-6 font-semibold text-sm uppercase">Deskripsi</th>
                            <th class="py-4 px-6 font-semibold text-sm uppercase text-center">Nilai</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-6 font-semibold">Sangat Baik</td>
                            <td class="py-4 px-6">Mutu sekolah sangat tinggi dan menjadi contoh bagi sekolah lain.</td>
                            <td class="py-4 px-6 text-center text-green-600 font-bold">91–100</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-6 font-semibold">Baik</td>
                            <td class="py-4 px-6">Sebagian besar indikator mutu tercapai dengan hasil memuaskan.</td>
                            <td class="py-4 px-6 text-center text-blue-600 font-bold">76–90</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-6 font-semibold">Cukup</td>
                            <td class="py-4 px-6">Beberapa indikator perlu peningkatan agar hasil lebih optimal.</td>
                            <td class="py-4 px-6 text-center text-yellow-600 font-bold">61–75</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-6 font-semibold">Perlu Perbaikan</td>
                            <td class="py-4 px-6">Sebagian besar indikator belum tercapai secara konsisten.</td>
                            <td class="py-4 px-6 text-center text-red-600 font-bold">≤ 60</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Kesimpulan -->
        <div class="mt-12 text-center text-gray-600">
            <p class="text-lg italic">
                “Penilaian bukan sekadar angka, melainkan cerminan dari proses dan dedikasi seluruh warga sekolah
                dalam menciptakan pendidikan yang bermutu dan berkarakter.”
            </p>
        </div>
    </div>
</section>
@endsection




