<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poultry GIS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <style>

        .leaflet-container {
            z-index: 1;
        }

        .leaflet-popup {
            margin-bottom: 12px;
        }

        .leaflet-popup-content-wrapper {
            border-radius: 12px !important;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15) !important;
        }

        .leaflet-popup-content {
            margin: 14px 16px !important;
        }

        .popup-goto {
            display: block;
            margin-top: 10px;
            background: #3b82f6;
            color: white;
            font-size: 12px;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 8px;
            cursor: pointer;
            border: none;
            width: 100%;
            text-align: center;
        }

        .popup-goto:hover {
            background: #2563eb;
        }

        @keyframes rowBlink {
            0%,100% { background: #dbeafe; }
            50% { background: transparent; }
        }

        @keyframes cardBlink {
            0%,100% {
                border-color: #3b82f6;
                box-shadow: 0 0 0 3px #bfdbfe;
            }
            50% {
                border-color: #e5e7eb;
                box-shadow: none;
            }
        }

        .row-highlight {
            animation: rowBlink 0.6s ease 4;
        }

        .card-highlight {
            animation: cardBlink 0.6s ease 4;
        }

        .card-field {
            display: grid;
            grid-template-columns: 68px 1fr;
            column-gap: 8px;
            align-items: start;
            padding: 6px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .card-field:last-of-type {
            border-bottom: none;
        }

        .card-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #9ca3af;
            padding-top: 2px;
            line-height: 1.4;
        }

        .card-value {
            font-size: 14px;
            color: #374151;
            line-height: 1.5;
            word-break: break-word;
        }

        #imageViewport,
        #measureViewport {
            position: relative;
            overflow: hidden;
            width: 100%;
            background: #f3f4f6;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #modalImage,
        #measurementImage {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 8px;
            transition: transform 0.2s ease;
            transform-origin: center center;
            display: block;
        }

        .zoom-btn {
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 16px;
            color: #374151;
            transition: background 0.15s;
        }

        .zoom-btn:hover {
            background: #f9fafb;
        }

        /* DROPDOWN MENU */
        .action-wrapper {
            position: relative;
            display: inline-block;
        }

        .action-menu {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 6px);
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            min-width: 170px;
            z-index: 999;
            overflow: hidden;
        }

        .action-menu.open {
            display: block;
        }

        .action-menu a,
        .action-menu button {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 10px 14px;
            font-size: 13px;
            color: #374151;
            background: none;
            border: none;
            cursor: pointer;
            text-align: left;
            text-decoration: none;
            transition: background 0.1s;
        }

        .action-menu a:hover,
        .action-menu button:hover {
            background: #f9fafb;
        }

        .action-menu .menu-icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            flex-shrink: 0;
        }

    </style>

</head>

<x-back-to-top/>

<body class="bg-gray-100 min-h-screen">

<!-- NAVBAR -->
<nav class="bg-white border-b border-gray-200 sticky top-0 z-50">

    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6">

        <div class="h-14 sm:h-16 flex items-center justify-between">

            <div>
                <h1 class="text-lg sm:text-2xl font-black text-gray-800">
                    Poultry GIS
                </h1>

                <p class="hidden sm:block text-xs text-gray-500">
                    Poultry Farm Monitoring System
                </p>
            </div>

            <div class="flex items-center gap-2">

                <a href="/"
                   class="px-3 py-2 rounded-xl text-gray-600 hover:bg-gray-100 transition text-sm">
                    Dashboard
                </a>

                <a href="/databank"
                   class="px-3 py-2 rounded-xl bg-blue-500 text-white text-sm">
                    Databank
                </a>

            </div>

        </div>

    </div>

</nav>

<!-- CONTENT -->
<div class="max-w-screen-2xl mx-auto p-3 sm:p-6 space-y-6">

    <!-- MAP -->
    <div id="map"
         class="w-full rounded-2xl overflow-hidden border border-gray-200 shadow-sm"
         style="height:65vh;">
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow-sm p-4 sm:p-6">

        <!-- FILTER -->
        <div class="flex flex-col sm:flex-row gap-3 mb-6">

            <div class="relative flex-1">

                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                <input
                    type="text"
                    id="searchInput"
                    placeholder="Search farm..."
                    class="w-full border border-gray-300 rounded-2xl pl-11 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                >

            </div>

            <select
                id="districtFilter"
                class="border border-gray-300 rounded-2xl px-4 py-3 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            >

                <option value="">All Kecamatan</option>

                @foreach($districts as $district)
                    <option value="{{ strtolower($district) }}">
                        {{ $district }}
                    </option>
                @endforeach

            </select>

            <button
                type="button"
                id="resetBtn"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-3 rounded-2xl text-sm transition"
            >
                Reset
            </button>

        </div>

        <!-- MOBILE -->
        <div class="grid gap-3 md:hidden">

            @foreach($farms as $farm)

                <div
                    class="farm-card bg-white border border-gray-200 rounded-2xl shadow-sm"
                    id="card-{{ $farm->id }}"
                    data-search="{{ strtolower($farm->name . ' ' . $farm->address . ' ' . $farm->district . ' ' . $farm->phone) }}"
                    data-district="{{ strtolower($farm->district) }}"
                >

                    <div class="px-4 pt-4 pb-3 border-b border-gray-100">

                        <h3 class="font-bold text-gray-800 text-base leading-snug">
                            {{ $farm->name }}
                        </h3>

                    </div>

                    <div class="px-4 py-1">

                        <div class="card-field">
                            <span class="card-label">Address</span>
                            <span class="card-value">{{ $farm->address }}</span>
                        </div>

                        <div class="card-field">
                            <span class="card-label">Kecamatan</span>
                            <span class="card-value">{{ $farm->district }}</span>
                        </div>

                        <div class="card-field">
                            <span class="card-label">Phone</span>
                            <span class="card-value">{{ $farm->phone }}</span>
                        </div>

                    </div>

                    <div class="px-4 pb-4 pt-3 grid grid-cols-3 gap-2">

                        <a
                            href="{{ $farm->google_maps }}"
                            target="_blank"
                            class="bg-green-500 hover:bg-green-600 text-white text-center py-2 rounded-xl text-sm flex items-center justify-center"
                        >
                            <i class="fa-solid fa-link"></i>
                        </a>

                        <button
                            onclick="goToPin({{ $farm->id }})"
                            class="bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-xl text-sm"
                        >
                            <i class="fa-solid fa-location-dot"></i>
                        </button>

                        <button
                            onclick="openModal('{{ asset($farm->screenshot) }}', '{{ $farm->name }}', {{ $farm->id }})"
                            class="bg-indigo-500 hover:bg-indigo-600 text-white py-2 rounded-xl text-sm"
                        >
                            <i class="fa-solid fa-ruler-combined"></i>
                        </button>

                    </div>

                </div>

            @endforeach

        </div>

        <!-- DESKTOP -->
        <div class="hidden md:block overflow-x-auto">

            <table class="w-full text-sm">

                <thead>

                    <tr class="bg-gray-50 text-gray-500 uppercase text-xs">

                        <th class="px-4 py-3 text-left">Name</th>
                        <th class="px-4 py-3 text-left">Address</th>
                        <th class="px-4 py-3 text-left">Kecamatan</th>
                        <th class="px-4 py-3 text-left">Phone</th>
                        <th class="px-4 py-3 text-center">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($farms as $farm)

                        <tr
                            class="farm-row border-b hover:bg-gray-50 transition"
                            id="row-{{ $farm->id }}"
                            data-search="{{ strtolower($farm->name . ' ' . $farm->address . ' ' . $farm->district . ' ' . $farm->phone) }}"
                            data-district="{{ strtolower($farm->district) }}"
                        >

                            <td class="px-4 py-4 font-medium text-gray-800">
                                {{ $farm->name }}
                            </td>

                            <td class="px-4 py-4 text-gray-600">
                                {{ $farm->address }}
                            </td>

                            <td class="px-4 py-4">

                                <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                    {{ $farm->district }}
                                </span>

                            </td>

                            <td class="px-4 py-4 text-gray-600">
                                {{ $farm->phone }}
                            </td>

                            <td class="px-4 py-4 text-center">

                                <div class="action-wrapper">

                                    <button
                                        onclick="toggleMenu(this)"
                                        class="bg-gray-800 hover:bg-gray-700 text-white text-xs font-semibold px-4 py-1.5 rounded-lg transition flex items-center gap-1.5"
                                    >
                                        Action
                                        <i class="fa-solid fa-chevron-down text-[10px]"></i>
                                    </button>

                                    <div class="action-menu">

                                        <a href="{{ $farm->google_maps }}" target="_blank">
                                            <span class="menu-icon bg-green-100 text-green-600">
                                                <i class="fa-solid fa-link"></i>
                                            </span>
                                            Google Maps
                                        </a>

                                        <button onclick="closeMenus(); goToPin({{ $farm->id }})">
                                            <span class="menu-icon bg-blue-100 text-blue-600">
                                                <i class="fa-solid fa-location-dot"></i>
                                            </span>
                                            Lihat di Peta
                                        </button>

                                        <button onclick="closeMenus(); openModal('{{ asset($farm->screenshot) }}', '{{ $farm->name }}', {{ $farm->id }})">
                                            <span class="menu-icon bg-indigo-100 text-indigo-600">
                                                <i class="fa-solid fa-ruler-combined"></i>
                                            </span>
                                            Ukur Bangunan
                                        </button>

                                    </div>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- MODAL -->
<div
    id="imageModal"
    style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.8); align-items:flex-start; justify-content:center; z-index:99999; padding:1rem; overflow-y:auto; -webkit-overflow-scrolling:touch;"
>

    <div class="bg-white rounded-2xl w-full max-w-5xl relative flex flex-col my-auto">

        <!-- HEADER -->
        <div class="flex items-center justify-between px-5 py-4 border-b flex-shrink-0">

            <h2 id="modalTitle" class="text-xl font-bold text-gray-800"></h2>

            <button
                onclick="closeModal()"
                class="text-2xl text-gray-400 hover:text-red-500 leading-none"
            >
                &times;
            </button>

        </div>

        <!-- BODY -->
        <div class="p-5 space-y-6">

            <!-- ORIGINAL IMAGE -->
            <div>

                <h3 class="text-base font-semibold text-gray-700 mb-3">
                    Original Satellite Image
                </h3>

                <div
                    id="imageViewport"
                    style="height: clamp(160px, 30vw, 420px);"
                >
                    <img id="modalImage" src="" alt="">
                </div>

                <div class="flex items-center gap-2 mt-2">
                    <button class="zoom-btn" onclick="zoomIn()">+</button>
                    <button class="zoom-btn" onclick="zoomOut()">−</button>
                    <button class="zoom-btn" style="width:auto;padding:0 10px;font-size:11px;" onclick="zoomReset()">Reset</button>
                </div>

            </div>

            <!-- MEASURE BUTTON -->
            <div>

                <button
                    id="measureBtn"
                    onclick="showMeasurement()"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg text-sm font-medium"
                >
                    <i class="fa-solid fa-ruler-combined mr-2"></i>
                    Ukur Bangunan
                </button>

            </div>

            <!-- LOADING -->
            <div id="loadingBox" class="hidden flex items-center gap-3 text-blue-500 font-medium">

                <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>

                Memproses pengukuran...

            </div>

            <!-- RESULT -->
            <div id="measurementSection" class="hidden space-y-5">

                <div>

                    <h3 class="text-base font-semibold text-gray-700 mb-3">
                        Hasil Pengukuran AI
                    </h3>

                    <div id="measureViewport" style="height: clamp(160px, 30vw, 420px);">
                        <img id="measurementImage" src="" alt="">
                    </div>

                    <div class="flex items-center gap-2 mt-2">
                        <button class="zoom-btn" onclick="mZoomIn()">+</button>
                        <button class="zoom-btn" onclick="mZoomOut()">−</button>
                        <button class="zoom-btn" style="width:auto;padding:0 10px;font-size:11px;" onclick="mZoomReset()">Reset</button>
                    </div>

                </div>

                <div>

                    <h3 class="text-base font-semibold text-gray-700 mb-3">
                        Data Pengukuran
                    </h3>

                    <div class="overflow-x-auto rounded-xl border border-gray-200">

                        <table class="w-full border-collapse text-sm">

                            <thead>
                                <tr class="bg-gray-50 text-gray-600">
                                    <th class="p-3 text-left font-semibold">Objek</th>
                                    <th class="p-3 text-left font-semibold">Panjang</th>
                                    <th class="p-3 text-left font-semibold">Lebar</th>
                                    <th class="p-3 text-left font-semibold">Luas</th>
                                </tr>
                            </thead>

                            <tbody id="measurementTableBody"></tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

    // MAP
    const map = L.map('map').setView([-6.9147, 107.6098], 11);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const farms = @json($farms->values());

    const markers = {};

    farms.forEach(farm => {

        if (farm.latitude && farm.longitude) {

            const marker = L.marker([farm.latitude, farm.longitude])
                .addTo(map)
                .bindPopup(`
                    <div style="width:210px">
                        <h3 style="font-weight:700;font-size:14px;margin:0 0 4px;">${farm.name}</h3>
                        <p style="font-size:12px;color:#6b7280;">${farm.address ?? '-'}</p>
                        ${farm.screenshot ? `<img src="/${farm.screenshot}" style="width:100%;margin-top:8px;border-radius:8px;">` : ''}
                        <button class="popup-goto" onclick="goToData(${farm.id})">Go to Data</button>
                    </div>
                `);

            markers[farm.id] = marker;
        }

    });

    // RESET VIEW
    const resetControl = L.control({ position: 'topright' });

    resetControl.onAdd = function () {

        const div = L.DomUtil.create('div', 'leaflet-bar leaflet-control');

        div.innerHTML = `
            <button style="background:white;padding:6px 12px;cursor:pointer;font-weight:600;font-size:13px;">
                Reset View
            </button>
        `;

        div.onclick = () => map.setView([-6.9147, 107.6098], 11);

        return div;
    };

    resetControl.addTo(map);

    // DROPDOWN MENU
    function toggleMenu(btn) {
        const menu = btn.nextElementSibling;
        const isOpen = menu.classList.contains('open');
        closeMenus();
        if (!isOpen) menu.classList.add('open');
    }

    function closeMenus() {
        document.querySelectorAll('.action-menu.open').forEach(m => m.classList.remove('open'));
    }

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.action-wrapper')) closeMenus();
    });

    // GO TO PIN
    function goToPin(id) {

        const marker = markers[id];

        if (!marker) return;

        window.scrollTo({ top: 0, behavior: 'smooth' });

        map.flyTo(marker.getLatLng(), 18, { duration: 1.5 });

        setTimeout(() => marker.openPopup(), 1200);
    }

    // GO TO DATA
    function goToData(id) {

        const row = document.getElementById('row-' + id);
        const card = document.getElementById('card-' + id);

        if (row) {
            row.scrollIntoView({ behavior: 'smooth', block: 'center' });
            row.classList.add('row-highlight');
            setTimeout(() => row.classList.remove('row-highlight'), 2400);
        }

        if (card) {
            card.scrollIntoView({ behavior: 'smooth', block: 'center' });
            card.classList.add('card-highlight');
            setTimeout(() => card.classList.remove('card-highlight'), 2400);
        }
    }

    // FILTER
    const searchInput = document.getElementById('searchInput');
    const districtFilter = document.getElementById('districtFilter');
    const resetBtn = document.getElementById('resetBtn');

    function applyFilter() {

        const keyword = searchInput.value.toLowerCase();
        const district = districtFilter.value;

        document.querySelectorAll('.farm-card').forEach(card => {
            const match = card.dataset.search.includes(keyword) && (district === '' || card.dataset.district === district);
            card.style.display = match ? '' : 'none';
        });

        document.querySelectorAll('.farm-row').forEach(row => {
            const match = row.dataset.search.includes(keyword) && (district === '' || row.dataset.district === district);
            row.style.display = match ? 'table-row' : 'none';
        });
    }

    searchInput.addEventListener('input', applyFilter);
    districtFilter.addEventListener('change', applyFilter);
    resetBtn.addEventListener('click', () => {
        searchInput.value = '';
        districtFilter.value = '';
        applyFilter();
    });

    // MODAL
    let currentFarmId = null;

    function openModal(image, title, farmId) {

        currentFarmId = farmId;

        document.getElementById('modalImage').src = image;
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('measurementSection').classList.add('hidden');
        document.getElementById('loadingBox').classList.add('hidden');
        document.getElementById('measurementTableBody').innerHTML = '';
        document.getElementById('measurementImage').src = '';

        zoomReset();
        mZoomReset();

        const modal = document.getElementById('imageModal');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('imageModal').style.display = 'none';
        document.body.style.overflow = '';
    }

    // MEASUREMENT
    async function showMeasurement() {

        document.getElementById('loadingBox').classList.remove('hidden');
        document.getElementById('measurementSection').classList.add('hidden');

        try {

            const response = await fetch(`/farm/${currentFarmId}/measurement`);
            const data = await response.json();

            document.getElementById('loadingBox').classList.add('hidden');
            document.getElementById('measurementSection').classList.remove('hidden');
            document.getElementById('measurementImage').src = data.image;

            let html = '';
            data.measurements.forEach(item => {
                html += `
                    <tr class="border-t border-gray-100 hover:bg-gray-50">
                        <td class="p-3">${item.object_name}</td>
                        <td class="p-3">${item.length} m</td>
                        <td class="p-3">${item.width} m</td>
                        <td class="p-3">${item.area} m²</td>
                    </tr>
                `;
            });

            document.getElementById('measurementTableBody').innerHTML = html;

        } catch (error) {
            document.getElementById('loadingBox').classList.add('hidden');
            alert('Gagal memuat data pengukuran.');
        }
    }

    // ZOOM ORIGINAL
    function zoomIn() {
        const img = document.getElementById('modalImage');
        let scale = parseFloat(img.dataset.scale || 1) + 0.2;
        img.dataset.scale = scale;
        img.style.transform = `scale(${scale})`;
    }

    function zoomOut() {
        const img = document.getElementById('modalImage');
        let scale = Math.max(1, parseFloat(img.dataset.scale || 1) - 0.2);
        img.dataset.scale = scale;
        img.style.transform = `scale(${scale})`;
    }

    function zoomReset() {
        const img = document.getElementById('modalImage');
        img.dataset.scale = 1;
        img.style.transform = 'scale(1)';
    }

    // ZOOM MEASURE
    function mZoomIn() {
        const img = document.getElementById('measurementImage');
        let scale = parseFloat(img.dataset.scale || 1) + 0.2;
        img.dataset.scale = scale;
        img.style.transform = `scale(${scale})`;
    }

    function mZoomOut() {
        const img = document.getElementById('measurementImage');
        let scale = Math.max(1, parseFloat(img.dataset.scale || 1) - 0.2);
        img.dataset.scale = scale;
        img.style.transform = `scale(${scale})`;
    }

    function mZoomReset() {
        const img = document.getElementById('measurementImage');
        img.dataset.scale = 1;
        img.style.transform = 'scale(1)';
    }

</script>

</body>
</html>