<!-- Header -->
<header class="bg-gray-900 text-white">
  <div class="container mx-auto px-6 py-4 flex justify-between items-center">
    <!-- Logo -->
    <div class="flex items-center gap-3">
      <img src="{{ asset('Assets/Frontend/img/logosmp20.jpeg') }}"
        alt="Logo SMP Negeri 20 Kendari" class="w-12 h-12 rounded-full object-cover">
      <h1 class="text-xl md:text-2xl font-bold text-white">SMP NEGERI 20 KENDARI</h1>
    </div>

    <!-- Kanan -->
    <span class="hidden sm:block text-sm italic text-amber-400">Website Resmi SMP Negeri 20 Kendari</span>
  </div>
</header>

<!-- Navbar -->
<nav class="bg-gray-900 text-white relative">
  <div class="container mx-auto px-6 py-3 flex justify-between items-center">
    <!-- Tombol Burger -->
    <button id="menu-toggle" class="md:hidden focus:outline-none">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

    <!-- Menu utama -->
    <ul id="menu"
      class="hidden md:flex flex-col md:flex-row md:space-x-6 space-y-3 md:space-y-0 text-sm relative z-50">
      <li><a href="/" class="hover:text-gray-300">Home</a></li>

      <!-- Profil Sekolah -->
      <li class="relative group">
        <div class="cursor-pointer flex items-center space-x-1 hover:text-gray-300">
          <span>Profil Sekolah</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mt-0.5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </div>

        <ul
          class="absolute left-0 top-full hidden group-hover:block bg-gray-800 text-white rounded-md w-48 shadow-lg z-50 transition-opacity duration-200 opacity-0 group-hover:opacity-100 transition-all duration-200 ease-out">
          <li><a href="{{ route('sambutan') }}" class="block px-4 py-2 hover:bg-gray-700">Sambutan Kepala Sekolah</a></li>
          <li><a href="{{ route('visi_misi') }}" class="block px-4 py-2 hover:bg-gray-700">Visi & Misi</a></li>
          <li><a href="{{ route('saran_mutu') }}" class="block px-4 py-2 hover:bg-gray-700">Sasaran Mutu</a></li>
          <li><a href="{{ route('tujuan') }}" class="block px-4 py-2 hover:bg-gray-700">Tujuan</a></li>
          <li><a href="{{ route('moto') }}" class="block px-4 py-2 hover:bg-gray-700">Moto</a></li>
        </ul>
      </li>

      <!-- Kurikulum -->
      <li class="relative group">
        <div class="cursor-pointer flex items-center space-x-1 hover:text-gray-300">
          <span>Kurikulum</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mt-0.5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </div>

        <ul
          class="absolute left-0 top-full hidden group-hover:block bg-gray-800 text-white rounded-md w-48 shadow-lg z-50 transition-opacity duration-200 opacity-0 group-hover:opacity-100 transition-all duration-200 ease-out">
          <li><a href="{{ route('struktur_kurikulum') }}" class="block px-4 py-2 hover:bg-gray-700">Struktur Kurikulum</a></li>
          <li><a href="{{ route('akademik') }}" class="block px-4 py-2 hover:bg-gray-700">Program Akademik</a></li>
          <li><a href="{{ route('ekstrakulikuler') }}" class="block px-4 py-2 hover:bg-gray-700">Ekstrakurikuler</a></li>
        </ul>
      </li>

      <!-- Artikel -->
      <li class="relative group">
        <div class="cursor-pointer flex items-center space-x-1 hover:text-gray-300">
          <span>Artikel</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mt-0.5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </div>
        <ul
          class="absolute left-0 top-full hidden group-hover:block bg-gray-800 text-white rounded-md w-48 shadow-lg z-50 transition-opacity duration-200 opacity-0 group-hover:opacity-100 transition-all duration-200 ease-out">
          <li><a href="{{ route('artikel') }}" class="block px-4 py-2 hover:bg-gray-700">Artikel Pendidikan</a></li>
        </ul>
      </li>

      <li><a href="{{ route('index') }}" class="hover:text-gray-300">Index Berita</a></li>
      <li><a href="{{ route('penilaian') }}" class="hover:text-gray-300">Penilaian</a></li>
      <li><a href="#" class="hover:text-gray-300">Hubungi Kami</a></li>

      <!-- Tombol Login untuk Mobile -->
      <li class="md:hidden">
        <a href="{{ route('login') }}" class="block px-4 py-2 bg-amber-500 rounded-md text-center hover:bg-amber-600">
          <i class="fa fa-user mr-1"></i> Login
        </a>
      </li>
    </ul>

    <!-- Tombol Login untuk Desktop -->
    <div class="hidden md:block">
      <a href="{{ route('login') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 rounded-md text-sm font-semibold">
        <i class="fa fa-user mr-1"></i> Login
      </a>
    </div>
  </div>
</nav>

<!-- Script toggle mobile -->
<script>
  const toggleBtn = document.getElementById('menu-toggle');
  const menu = document.getElementById('menu');
  toggleBtn.addEventListener('click', () => menu.classList.toggle('hidden'));
</script>

<style>
  li.group ul {
    transition: opacity 0.15s ease-in-out;
  }
  li.group:hover ul {
    display: block;
  }
</style>
