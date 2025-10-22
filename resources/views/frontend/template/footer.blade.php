<!-- FOOTER -->
<footer class="bg-black text-white mt-10">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 border-t border-gray-700">
        <!-- Kontak -->
        <div>
            <h3 class="font-semibold mb-3">Kontak Kami</h3>
            <p class="flex items-center space-x-2">
                <i class="fas fa-phone"></i>
                <span>{{ $footer->telp ?? '(021) 1234–5678' }}</span>
            </p>
            <p class="flex items-center space-x-2 mt-2">
                <i class="fas fa-envelope"></i>
                <span>{{ $footer->email ?? 'info@smaalur.sch.id' }}</span>
            </p>
        </div>
        <!-- Alamat -->
        <div>
            <h3 class="font-semibold mb-3">Alamat</h3>
            <p class="flex items-start sm:items-center">
                <i class="fas fa-map-marker-alt mr-2 mt-1 sm:mt-0"></i>
                <span>{{ $footer->alamat ?? 'Jalan Ruruhi Kecamatan Poasia Kelurahan Rahandauna Kota Kendari' }}</span>
            </p>
        </div>
        <!-- Tentang -->
        <div>
            <h3 class="font-semibold mb-3">Tentang</h3>
            <p>{{ $footer->tentang ?? 'SMP 20 Kendari adalah sekolah menengah atas yang berkomitmen untuk memberikan pendidikan berkualitas tinggi.' }}</p>
        </div>
    </div>

    <div class="border-t border-gray-700 py-4 text-center text-sm text-gray-400">
        © {{ date('Y') }} SMP Negeri 20 Kendari. All rights reserved.
    </div>
</footer>
