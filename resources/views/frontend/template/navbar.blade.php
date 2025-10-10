<!-- Header -->
<header class="bg-gray-900 text-white">
  <div class="container mx-auto px-6 py-4 flex justify-between items-center">
    <div class="flex items-center gap-3">
      <img src="{{ asset('Assets/Frontend/img/logosmp20.jpeg') }}"
        alt="Logo SMP Negeri 20 Kendari" class="w-12 h-12 rounded-full object-cover">
      <h1 class="text-xl md:text-2xl font-bold text-white">SMP NEGERI 20 KENDARI</h1>
    </div>

    <span class="hidden sm:block text-sm italic text-amber-400">Website Resmi SMP Negeri 20 Kendari</span>
  </div>
</header>

<!-- Navbar -->
<nav class="bg-gray-900 text-white relative">
  <div class="container mx-auto px-6 py-3 flex justify-between items-center">
    <!-- Tombol Burger -->
    <button id="menu-toggle" class="md:hidden focus:outline-none">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

    <!-- Menu utama -->
    <ul id="menu"
      class="hidden md:flex flex-col md:flex-row md:space-x-6 space-y-3 md:space-y-0 text-sm absolute md:relative top-full left-0 w-full md:w-auto bg-gray-900 md:bg-transparent z-50 md:static">
      
      <li><a href="/" class="block px-4 py-2 hover:bg-gray-800 md:hover:bg-transparent md:hover:text-amber-400">Home</a></li>

      <!-- Profil Sekolah -->
      <li class="group relative">
        <button class="w-full md:w-auto flex justify-between items-center px-4 py-2 hover:bg-gray-800 md:hover:bg-transparent md:hover:text-amber-400 dropdown-toggle">
          Profil Sekolah
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <ul class="hidden group-hover:block md:absolute bg-gray-800 md:rounded-md md:shadow-lg md:w-48 md:mt-1">
          <li><a href="{{ route('sambutan') }}" class="block px-4 py-2 hover:bg-gray-700">Sambutan Kepala Sekolah</a></li>
          <li><a href="{{ route('visi_misi') }}" class="block px-4 py-2 hover:bg-gray-700">Visi & Misi</a></li>
          <li><a href="{{ route('saran_mutu') }}" class="block px-4 py-2 hover:bg-gray-700">Sasaran Mutu</a></li>
          <li><a href="{{ route('tujuan') }}" class="block px-4 py-2 hover:bg-gray-700">Tujuan</a></li>
          <li><a href="{{ route('moto') }}" class="block px-4 py-2 hover:bg-gray-700">Moto</a></li>
        </ul>
      </li>

      <!-- Kurikulum -->
      <li class="group relative">
        <button class="w-full md:w-auto flex justify-between items-center px-4 py-2 hover:bg-gray-800 md:hover:bg-transparent md:hover:text-amber-400 dropdown-toggle">
          Kurikulum
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <ul class="hidden group-hover:block md:absolute bg-gray-800 md:rounded-md md:shadow-lg md:w-48 md:mt-1">
          <li><a href="{{ route('struktur_kurikulum') }}" class="block px-4 py-2 hover:bg-gray-700">Struktur Kurikulum</a></li>
          <li><a href="{{ route('akademik') }}" class="block px-4 py-2 hover:bg-gray-700">Program Akademik</a></li>
          <li><a href="{{ route('ekstrakulikuler') }}" class="block px-4 py-2 hover:bg-gray-700">Ekstrakurikuler</a></li>
        </ul>
      </li>

      <!-- Album -->
      <li class="group relative">
        <button class="w-full md:w-auto flex justify-between items-center px-4 py-2 hover:bg-gray-800 md:hover:bg-transparent md:hover:text-amber-400 dropdown-toggle">
          Album
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <ul class="hidden group-hover:block md:absolute bg-gray-800 md:rounded-md md:shadow-lg md:w-48 md:mt-1">
          <li><a href="{{ route('artikel') }}" class="block px-4 py-2 hover:bg-gray-700">Album Kegiatan</a></li>
        </ul>
      </li>

      <li><a href="{{ route('index') }}" class="block px-4 py-2 hover:bg-gray-800 md:hover:bg-transparent md:hover:text-amber-400">Index Berita</a></li>
      <li><a href="{{ route('penilaian') }}" class="block px-4 py-2 hover:bg-gray-800 md:hover:bg-transparent md:hover:text-amber-400">Penilaian</a></li>
      <li><a href="{{ route('hubungi') }}" class="block px-4 py-2 hover:bg-gray-800 md:hover:bg-transparent md:hover:text-amber-400">Hubungi Kami</a></li>

      <!-- Tombol Login untuk Mobile -->
      <li class="md:hidden px-4 py-3">
        <a href="{{ route('login') }}" class="block bg-amber-500 hover:bg-amber-600 rounded-md text-center font-semibold py-2">
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

<!-- Script -->
<script>
  const toggleBtn = document.getElementById('menu-toggle');
  const menu = document.getElementById('menu');
  const dropdowns = document.querySelectorAll('.dropdown-toggle');

  // Toggle menu (mobile)
  toggleBtn.addEventListener('click', (e) => {
    e.stopPropagation(); // biar gak langsung tertutup
    menu.classList.toggle('hidden');
  });

  // Toggle submenu (mobile)
  dropdowns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const submenu = btn.nextElementSibling;
      submenu.classList.toggle('hidden');
    });
  });

  // Klik di luar menu => tutup menu
  window.addEventListener('click', (e) => {
    if (!menu.classList.contains('hidden')) {
      if (!menu.contains(e.target) && !toggleBtn.contains(e.target)) {
        menu.classList.add('hidden');
      }
    }
  });
</script>
