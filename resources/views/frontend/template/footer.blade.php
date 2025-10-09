<!-- FOOTER -->
<footer class="bg-black text-white mt-10">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12 px-6 py-10 border-t border-gray-700">

        <!-- Kontak Kami -->
        <div class="space-y-2">
            <h3 class="font-semibold mb-3 text-lg">Kontak Kami</h3>

            <p class="flex items-center">
                <i class="fas fa-phone mr-3 text-blue-400"></i>
                <span>{{ $footer->telp ?? '(Belum diisi)' }}</span>
            </p>

            <p class="flex items-center">
                <i class="fas fa-envelope mr-3 text-blue-400"></i>
                <span>{{ $footer->email ?? '(Belum diisi)' }}</span>
            </p>
        </div>

        <!-- Alamat Sekolah -->
        <div>
            <h3 class="font-semibold mb-3 text-lg">Alamat</h3>
            <p class="flex items-start text-gray-300 leading-relaxed">
                <i class="fas fa-map-marker-alt mr-3 text-red-400 mt-1"></i>
                <span class="break-words max-w-xs">{{ $footer->alamat ?? 'Alamat belum diisi.' }}</span>
            </p>
        </div>

        <!-- Tentang Kami -->
        <div>
            <h3 class="font-semibold mb-3 text-lg">Tentang Kami</h3>
            <p class="text-gray-300 leading-relaxed">
                SMP Negeri 20 Kendari berkomitmen mencetak generasi cerdas, berkarakter, dan berprestasi melalui pendidikan yang berkualitas dan berbudaya.
            </p>
        </div>
    </div>

    <div class="border-t border-gray-700 py-4 text-center text-sm text-gray-400">
        © {{ date('Y') }} SMP Negeri 20 Kendari. All rights reserved.
    </div>
</footer>
