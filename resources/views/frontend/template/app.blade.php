<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'SMP Negeri 20 Kendari')</title>

  <!-- Tailwind & Font Awesome -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
  />

  <style>
    /* Responsive HP */
    @media (max-width: 768px) {
      main {
        display: flex !important;
        flex-direction: column !important;
        gap: 1.5rem !important;
        padding-left: 1rem;
        padding-right: 1rem;
      }
      main > * {
        width: 100% !important;
        max-width: 100% !important;
      }
    }

    /* Scroll sidebar saat mobile */
    #leftbar, #rightbar {
      overflow-y: auto;
      -webkit-overflow-scrolling: touch;
    }
  </style>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Navbar -->
  <header class="bg-gray-900 text-white">
    @include('frontend.template.navbar')
  </header>

  <!-- Tombol Sidebar Kiri (Mobile) -->
  <button id="toggleLeftbar"
    class="fixed top-1/2 left-2 z-50 bg-yellow-500 text-white p-3 rounded-r-lg shadow-lg md:hidden transform -translate-y-1/2 transition-all duration-300">
    <i class="fa-solid fa-angles-right"></i>
  </button>

  <!-- Tombol Sidebar Kanan (Mobile) -->
  <button id="toggleRightbar"
    class="fixed top-1/2 right-2 z-50 bg-yellow-500 text-white p-3 rounded-l-lg shadow-lg md:hidden transform -translate-y-1/2 transition-all duration-300">
    <i class="fa-solid fa-angles-left"></i>
  </button>

  <!-- Halaman -->
  <main class="max-w-7xl mx-auto grid grid-cols-12 gap-6 mt-6 px-4">

    {{-- Sidebar kiri --}}
    <aside id="leftbar"
      class="col-span-3 md:block fixed md:relative top-0 left-0 h-full md:h-auto bg-white shadow-lg md:shadow-none z-40 w-64 md:w-auto transform -translate-x-full md:translate-x-0 transition-transform duration-300 overflow-y-auto">
      @includeIf('frontend.template.leftbar')
    </aside>

    {{-- Konten utama --}}
    @yield('content')

    {{-- Sidebar kanan --}}
    <aside id="rightbar"
      class="col-span-3 md:block fixed md:relative top-0 right-0 h-full md:h-auto bg-white shadow-lg md:shadow-none z-40 w-64 md:w-auto transform translate-x-full md:translate-x-0 transition-transform duration-300 overflow-y-auto">
      @includeIf('frontend.template.rightbar')

      <!-- Kalender -->
      <div id="calendar" class="p-4 mt-4 border-t border-gray-200"></div>
    </aside>

  </main>

  <!-- Footer -->
  @includeIf('frontend.template.footer')

  <!-- Script Sidebar Toggle -->
  <script>
    const leftbar = document.getElementById('leftbar');
    const rightbar = document.getElementById('rightbar');
    const toggleLeftbar = document.getElementById('toggleLeftbar');
    const toggleRightbar = document.getElementById('toggleRightbar');
    const leftIcon = toggleLeftbar.querySelector('i');
    const rightIcon = toggleRightbar.querySelector('i');

    toggleLeftbar.addEventListener('click', () => {
      const isOpen = !leftbar.classList.contains('-translate-x-full');
      leftbar.classList.toggle('-translate-x-full');
      document.body.classList.toggle('overflow-hidden', !isOpen);

      // Tutup rightbar kalau buka leftbar
      rightbar.classList.add('translate-x-full');
      rightIcon.classList.replace('fa-angles-right', 'fa-angles-left');
      toggleRightbar.classList.remove('hidden');

      if (isOpen) {
        leftIcon.classList.replace('fa-angles-left', 'fa-angles-right');
        toggleRightbar.classList.remove('hidden');
      } else {
        leftIcon.classList.replace('fa-angles-right', 'fa-angles-left');
        toggleRightbar.classList.add('hidden');
      }
    });

    toggleRightbar.addEventListener('click', () => {
      const isOpen = !rightbar.classList.contains('translate-x-full');
      rightbar.classList.toggle('translate-x-full');
      document.body.classList.toggle('overflow-hidden', !isOpen);

      // Tutup leftbar kalau buka rightbar
      leftbar.classList.add('-translate-x-full');
      leftIcon.classList.replace('fa-angles-left', 'fa-angles-right');
      toggleLeftbar.classList.remove('hidden');

      if (isOpen) {
        rightIcon.classList.replace('fa-angles-right', 'fa-angles-left');
        toggleLeftbar.classList.remove('hidden');
      } else {
        rightIcon.classList.replace('fa-angles-left', 'fa-angles-right');
        toggleLeftbar.classList.add('hidden');
      }
    });

    document.addEventListener('click', (e) => {
      if (!leftbar.contains(e.target) && !toggleLeftbar.contains(e.target) && !leftbar.classList.contains('-translate-x-full')) {
        leftbar.classList.add('-translate-x-full');
        leftIcon.classList.replace('fa-angles-left', 'fa-angles-right');
        toggleRightbar.classList.remove('hidden');
      }
      if (!rightbar.contains(e.target) && !toggleRightbar.contains(e.target) && !rightbar.classList.contains('translate-x-full')) {
        rightbar.classList.add('translate-x-full');
        rightIcon.classList.replace('fa-angles-right', 'fa-angles-left');
        toggleLeftbar.classList.remove('hidden');
      }
    });
  </script>

  <!-- Script Kalender -->
  <script>
    const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    const weekdaysShort = ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Min"];
    let today = new Date();
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();

    function generateCalendar(month, year) {
      const calendar = document.getElementById("calendar");
      if (!calendar) return;

      const firstDayOfMonth = new Date(year, month, 1).getDay();
      const daysInMonth = new Date(year, month + 1, 0).getDate();
      const startingDay = (firstDayOfMonth + 6) % 7;

      let html = `
        <div class="flex justify-between items-center mb-3">
          <button onclick="prevMonth()" class="px-3 py-1 bg-black text-white rounded hover:bg-gray-800">&lt;</button>
          <div class="font-bold text-lg text-gray-800">${months[month]} ${year}</div>
          <button onclick="nextMonth()" class="px-3 py-1 bg-black text-white rounded hover:bg-gray-800">&gt;</button>
        </div>
        <table class="w-full border-collapse text-sm">
          <thead>
            <tr class="bg-black text-white">
              ${weekdaysShort.map(d => `<th class="py-2">${d}</th>`).join('')}
            </tr>
          </thead>
          <tbody>
      `;

      let date = 1;
      for (let week = 0; week < 6; week++) {
        html += "<tr class='text-center'>";
        for (let day = 0; day < 7; day++) {
          if (week === 0 && day < startingDay) {
            html += `<td class="py-2"></td>`;
          } else if (date > daysInMonth) {
            html += `<td class="py-2"></td>`;
          } else {
            const isToday = date === today.getDate() && month === today.getMonth() && year === today.getFullYear();
            html += `<td class="py-1">
              <div class="w-9 h-9 flex items-center justify-center mx-auto rounded-full ${isToday ? "bg-black text-white font-bold" : "hover:bg-gray-200"}">
                ${date}
              </div>
            </td>`;
            date++;
          }
        }
        html += "</tr>";
        if (date > daysInMonth) break;
      }

      html += "</tbody></table>";
      calendar.innerHTML = html;
    }

    function prevMonth() {
      currentMonth--;
      if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
      }
      generateCalendar(currentMonth, currentYear);
    }

    function nextMonth() {
      currentMonth++;
      if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
      }
      generateCalendar(currentMonth, currentYear);
    }

    generateCalendar(currentMonth, currentYear);
  </script>
</body>
</html>
