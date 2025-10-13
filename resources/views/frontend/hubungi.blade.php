@extends('frontend.template.app')
@section('content')

<section class="col-span-6 space-y-6 p-6 bg-gray-50 rounded-xl shadow-lg">

    <!-- Judul -->
    <div class="text-center">
        <h1 class="text-3xl font-bold text-green-700">Hubungi Kami</h1>
        <p class="text-gray-600 mt-2">
            SMP Negeri 20 Kendari – Kami siap menerima pertanyaan dan masukan dari Anda
        </p>
    </div>

    <!-- Info Modern & Rapi (Glassmorphism) -->
    <div class="grid md:grid-cols-3 gap-6 mt-6">

        <!-- Jam Operasional -->
        <div class="bg-white/30 backdrop-blur-md p-6 rounded-2xl shadow-lg flex flex-col items-center text-center hover:shadow-2xl transition">
            <div class="bg-green-700 text-white p-4 rounded-full text-2xl mb-4">
                <i class="fas fa-clock"></i>
            </div>
            <h2 class="text-xl font-semibold text-green-700 mb-2">Jam Operasional</h2>
            <p class="text-gray-700">Senin - Jumat: 07:00 - 14:00</p>
            <p class="text-gray-700">Sabtu: 07:00 - 12:00</p>
        </div>

        <!-- Layanan Online -->
        <div class="bg-white/30 backdrop-blur-md p-6 rounded-2xl shadow-lg flex flex-col items-center text-center hover:shadow-2xl transition">
            <div class="bg-green-700 text-white p-4 rounded-full text-2xl mb-4">
                <i class="fas fa-laptop-code"></i>
            </div>
            <h2 class="text-xl font-semibold text-green-700 mb-2">Layanan Online</h2>
            <p class="text-gray-700">Pendaftaran siswa baru online</p>
            <p class="text-gray-700">Informasi kegiatan & jadwal</p>
        </div>

        <!-- Lokasi Sekolah -->
        <div class="bg-white/30 backdrop-blur-md p-6 rounded-2xl shadow-lg flex flex-col items-center text-center hover:shadow-2xl transition">
            <div class="bg-green-700 text-white p-4 rounded-full text-2xl mb-4">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <h2 class="text-xl font-semibold text-green-700 mb-2">Lokasi</h2>
            <p class="text-gray-700">Jl. Pendidikan No. 20, Kendari</p>
        </div>

    </div>

    <!-- Form Kontak (Statis + Popup sukses) -->
    <div class="bg-white p-6 rounded-xl shadow mt-6">
        <h2 class="text-2xl font-semibold text-green-700 mb-4">Kirim Pesan</h2>
        <form id="hubungiForm" action="/kirim-pesan" method="POST" class="space-y-4">
    @csrf
    <input type="text" name="nama" placeholder="Nama Anda" class="w-full p-3 border border-gray-300 rounded-lg" required>
    <input type="email" name="email" placeholder="Email Anda" class="w-full p-3 border border-gray-300 rounded-lg" required>
    <textarea name="pesan" placeholder="Pesan Anda" rows="5" class="w-full p-3 border border-gray-300 rounded-lg" required></textarea>
    <button type="submit" class="bg-green-700 text-white px-6 py-3 rounded-lg hover:bg-green-800 transition">
        Kirim Pesan
    </button>
</form>

<div id="successMessage" class="hidden mt-4 bg-green-100 text-green-800 p-3 rounded">
    Pesan berhasil dikirim!
</div>

<script>
document.getElementById('hubungiForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;
    fetch(form.action, {
    method: 'POST',
    body: new FormData(form),
    headers: { 
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json'
    }
})
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById('successMessage').classList.remove('hidden');
            form.reset();
            setTimeout(() => document.getElementById('successMessage').classList.add('hidden'), 3000);
        } else {
            alert('Gagal kirim');
        }
    })
    .catch(() => alert('Error server'));
});
</script>

        <!-- Notifikasi Sukses -->
        <div id="successMessage" class="hidden mt-4 bg-green-100 text-green-800 p-3 rounded">
            Pesan berhasil dikirim!
        </div>
    </div>

    <!-- Peta Lokasi (Google Maps Embed) -->
    <div class="mt-6 rounded-xl overflow-hidden shadow">
       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3980.067589168027!2d122.55590107473465!3d-4.006527695967207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d98929522b3b3db%3A0x6bbe3b32bfd0add9!2sSMP%20Negeri%2020%20Kendari!5e0!3m2!1sen!2sid!4v1760085022364!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

</section>

<!-- Script Popup Sukses -->
<script>
    const form = document.getElementById('hubungiForm');
    const successMessage = document.getElementById('successMessage');

    form.addEventListener('submit', function(e) {
        e.preventDefault(); // hentikan form submit
        successMessage.classList.remove('hidden'); // tampilkan pesan sukses
        form.reset(); // reset form
        setTimeout(() => {
            successMessage.classList.add('hidden'); // sembunyikan lagi setelah 3 detik
        }, 3000);
    });
</script>

@endsection
