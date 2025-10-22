<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SMP Negeri 20 Kendari')</title>

    <!-- Tailwind & Font Awesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

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
    </style>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Navbar -->
    <header class="bg-gray-900 text-white">
        @include('frontend.template.navbar')
    </header>

    <!-- Isi halaman -->
    <main class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-6 mt-6 px-4">
    {{-- Sidebar kiri --}}
    <div class="order-2 md:order-1 md:col-span-3">
        @includeIf('frontend.template.leftbar')
    </div>

    {{-- Konten utama --}}
    <div class="order-1 md:order-2 md:col-span-6">
        @yield('content')
    </div>

    {{-- Sidebar kanan --}}
    <div class="order-3 md:order-3 md:col-span-3">
        @includeIf('frontend.template.rightbar')
    </div>
</main>


    <!-- Footer -->
    @includeIf('frontend.template.footer')

    <!-- Script Dropdown -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menus = [
                { area: 'profilDropdownArea', menu: 'profilDropdown' },
                { area: 'kurikulumDropdownArea', menu: 'kurikulumDropdown' },
                { area: 'prestasiDropdownArea', menu: 'prestasiDropdown' },
                { area: 'artikelDropdownArea', menu: 'artikelDropdown' }
            ];
            menus.forEach(({ area, menu }) => {
                const areaEl = document.getElementById(area);
                const menuEl = document.getElementById(menu);
                if (areaEl && menuEl) {
                    areaEl.addEventListener('mouseenter', () => menuEl.classList.remove('hidden'));
                    areaEl.addEventListener('mouseleave', () => {
                        setTimeout(() => {
                            if (!menuEl.matches(':hover')) menuEl.classList.add('hidden');
                        }, 150);
                    });
                    menuEl.addEventListener('mouseleave', () => menuEl.classList.add('hidden'));
                }
            });
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
