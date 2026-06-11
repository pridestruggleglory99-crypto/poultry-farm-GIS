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
        .leaflet-container { z-index: 1; }

        #imageModal { z-index: 9999; }

        #imageViewport {
            position: relative;
            overflow: hidden;
            width: 100%;
            background: #f3f4f6;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            cursor: default;
            user-select: none;
            touch-action: none;
        }

        #imageWrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            transform-origin: center center;
            will-change: transform;
        }

        #imageWrapper img {
            max-width: 100%;
            display: block;
            pointer-events: none;
            border-radius: 8px;
        }

        #zoomLabel {
            position: absolute;
            bottom: 10px;
            right: 12px;
            background: rgba(0,0,0,0.55);
            color: #fff;
            font-size: 12px;
            padding: 3px 8px;
            border-radius: 999px;
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
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

        .zoom-btn:hover { background: #f9fafb; }

        @media (max-width: 640px) {
            .table-head { display: none; }

            .farm-row {
                display: block;
                border: 1px solid #e5e7eb;
                border-radius: 12px;
                margin-bottom: 12px;
                padding: 12px;
                background: #fff;
            }

            .farm-row td {
                display: flex;
                align-items: flex-start;
                gap: 8px;
                padding: 6px 0;
                border: none;
                font-size: 14px;
            }

            .farm-row td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #6b7280;
                min-width: 80px;
                flex-shrink: 0;
            }

            .farm-row td.td-center { justify-content: flex-start; }
        }
    </style>

</head>

<body class="bg-gray-100 min-h-screen">

    <!-- NAVBAR -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="h-16 flex items-center justify-between">

                <div>
                    <h1 class="text-lg sm:text-2xl font-black text-gray-800">Poultry GIS</h1>
                    <p class="hidden sm:block text-xs text-gray-500">Poultry Farm Monitoring System</p>
                </div>

                <div class="flex items-center gap-2">
                    <a href="/" class="px-3 sm:px-4 py-2 rounded-xl text-gray-600 hover:bg-gray-100 transition text-sm">
                        Dashboard
                    </a>
                    <a href="/databank" class="px-3 sm:px-4 py-2 rounded-xl bg-blue-500 text-white shadow-sm text-sm">
                        Databank
                    </a>
                </div>

            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="max-w-7xl mx-auto p-4 sm:p-6 space-y-4 sm:space-y-6">

        <!-- MAP -->
        <div class="bg-white rounded-2xl shadow-sm p-3 sm:p-4">
            <h2 class="text-lg sm:text-xl font-semibold text-gray-700 mb-3 sm:mb-4">Farm Map</h2>
            <div id="map" class="w-full rounded-xl" style="height: clamp(280px, 50vw, 500px);"></div>
        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-2xl shadow-sm p-3 sm:p-4">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                <h2 class="text-lg sm:text-xl font-semibold text-gray-700">Poultry Farm Data</h2>
                <input
                    type="text"
                    id="searchInput"
                    placeholder="Search farm..."
                    class="border border-gray-300 rounded-lg px-4 py-2 w-full sm:w-64 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                >
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse min-w-[560px] sm:min-w-0">

                    <thead class="table-head">
                        <tr class="bg-gray-100 text-left text-sm">
                            <th class="p-3">Name</th>
                            <th class="p-3">Address</th>
                            <th class="p-3">Phone</th>
                            <th class="p-3 text-center">Maps</th>
                            <th class="p-3 text-center">Location</th>
                            <th class="p-3 text-center">Building Measurement</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($farms as $farm)
                            <tr
                                class="border-b hover:bg-gray-50 farm-row"
                                data-name="{{ strtolower($farm->name) }}"
                                data-address="{{ strtolower($farm->address) }}"
                            >
                                <td class="p-3 text-sm" data-label="Name">{{ $farm->name }}</td>
                                <td class="p-3 text-sm" data-label="Address">{{ $farm->address }}</td>
                                <td class="p-3 text-sm" data-label="Phone">{{ $farm->phone }}</td>

                                <!-- MAPS LINK -->
                                <td class="p-3 text-center td-center" data-label="Maps">
                                    <a
                                        href="{{ $farm->google_maps }}"
                                        target="_blank"
                                        class="text-blue-500 hover:text-blue-700 text-xl"
                                        aria-label="Open in Google Maps"
                                    >
                                        <i class="fa-solid fa-link"></i>
                                    </a>
                                </td>

                                <!-- GO TO PIN -->
                                <td class="p-3 text-center td-center" data-label="Location">
                                    <button
                                        onclick="goToPin({{ $farm->id }})"
                                        class="text-green-500 hover:text-green-700 text-xl"
                                        title="Go to pin"
                                    >
                                        <i class="fa-solid fa-location-dot"></i>
                                    </button>
                                </td>

                                <!-- DETAIL -->
                                <td class="p-3 text-center td-center" data-label="Measurement">
                                    <button
                                        onclick="openModal('{{ asset($farm->screenshot) }}', '{{ $farm->name }}', {{ $farm->id }})"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm"
                                    >
                                        Detail
                                    </button>
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
        class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50 p-4 sm:p-6"
    >
        <div class="bg-white rounded-2xl w-full max-w-4xl relative flex flex-col max-h-[95vh] overflow-hidden">

            <!-- HEADER -->
            <div class="flex items-center justify-between px-5 py-4 border-b flex-shrink-0">
                <h2 id="modalTitle" class="text-xl font-bold text-gray-800"></h2>
                <button onclick="closeModal()" class="text-2xl text-gray-400 hover:text-red-500 leading-none">&times;</button>
            </div>

            <!-- BODY -->
            <div class="overflow-y-auto p-5 space-y-6">

                <!-- ORIGINAL IMAGE -->
                <div>
                    <h3 class="text-base font-semibold text-gray-700 mb-3">Original Satellite Image</h3>
                    <div id="imageViewport" style="height: clamp(220px, 40vw, 420px);">
                        <div id="imageWrapper">
                            <img id="modalImage" src="" alt="Satellite image">
                        </div>
                        <span id="zoomLabel">100%</span>
                    </div>
                    <div class="flex items-center gap-2 mt-2">
                        <button class="zoom-btn" onclick="zoomIn()">+</button>
                        <button class="zoom-btn" onclick="zoomOut()">−</button>
                        <button class="zoom-btn" style="width:auto;padding:0 10px;font-size:11px;" onclick="zoomReset()">Reset</button>
                        <span class="text-xs text-gray-400 ml-1">Scroll / pinch to zoom · drag to pan</span>
                    </div>
                </div>

                <!-- MEASURE BUTTON -->
                <div>
                    <button
                        id="measureBtn"
                        onclick="showMeasurement()"
                        class="bg-blue-500 hover:bg-blue-600 active:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition-colors"
                    >
                        <i class="fa-solid fa-ruler-combined mr-2"></i>Ukur Bangunan
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
                        <h3 class="text-base font-semibold text-gray-700 mb-3">Hasil Pengukuran AI</h3>
                        <div id="measureViewport" style="height: clamp(220px, 40vw, 420px); position:relative; overflow:hidden; width:100%; background:#f3f4f6; border-radius:12px; border:1px solid #e5e7eb; user-select:none; touch-action:none;">
                            <div id="measureWrapper" style="display:flex; justify-content:center; align-items:center; transform-origin:center center; will-change:transform;">
                                <img id="measurementImage" src="" alt="Measurement result" style="max-width:100%; display:block; pointer-events:none; border-radius:8px;">
                            </div>
                            <span id="measureZoomLabel" style="position:absolute;bottom:10px;right:12px;background:rgba(0,0,0,0.55);color:#fff;font-size:12px;padding:3px 8px;border-radius:999px;opacity:0;transition:opacity 0.3s;pointer-events:none;"></span>
                        </div>
                        <div class="flex items-center gap-2 mt-2">
                            <button class="zoom-btn" onclick="mZoomIn()">+</button>
                            <button class="zoom-btn" onclick="mZoomOut()">−</button>
                            <button class="zoom-btn" style="width:auto;padding:0 10px;font-size:11px;" onclick="mZoomReset()">Reset</button>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-base font-semibold text-gray-700 mb-3">Data Pengukuran</h3>
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

    <!-- SCRIPTS -->
    <script>

        // ── MAP ──
        const initialCenter = [-6.9147, 107.6098];
        const initialZoom   = 11;

        const map = L.map('map').setView(initialCenter, initialZoom);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const farms   = @json($farms);
        const markers = {};

        farms.forEach(farm => {
            if (farm.latitude && farm.longitude) {
                const marker = L.marker([farm.latitude, farm.longitude])
                    .addTo(map)
                    .bindPopup(`
                        <div style="width:200px">
                            <h3 style="font-weight:bold;margin-bottom:6px;font-size:14px;">${farm.name ?? '-'}</h3>
                            <p style="font-size:12px;color:#555;">${farm.address ?? '-'}</p>
                            ${farm.screenshot ? `<img src="/${farm.screenshot}" style="width:100%;margin-top:8px;border-radius:8px;">` : ''}
                        </div>
                    `);
                markers[farm.id] = marker;
            }
        });

        // ── GO TO PIN ──
        function goToPin(farmId) {
            const marker = markers[farmId];
            if (!marker) return;
            window.scrollTo({ top: 0, behavior: 'smooth' });
            map.flyTo(marker.getLatLng(), 17, { duration: 1.2 });
            setTimeout(() => marker.openPopup(), 1300);
        }

        // ── RESET VIEW BUTTON ──
        const resetControl = L.control({ position: 'topright' });
        resetControl.onAdd = function () {
            const div = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
            div.innerHTML = `<button style="background:white;padding:6px 10px;cursor:pointer;font-weight:bold;font-size:13px;">Reset View</button>`;
            div.onclick = () => map.setView(initialCenter, initialZoom);
            return div;
        };
        resetControl.addTo(map);

        // ── SEARCH ──
        document.getElementById('searchInput').addEventListener('input', function () {
            const q = this.value.toLowerCase();
            document.querySelectorAll('.farm-row').forEach(row => {
                const name    = row.dataset.name    || '';
                const address = row.dataset.address || '';
                row.style.display = (name.includes(q) || address.includes(q)) ? '' : 'none';
            });
        });

        // ── ZOOM/PAN FACTORY ──
        function makeZoomPan(viewportEl, wrapperEl, labelEl) {

            const ZOOM_STEP = 0.25;
            const MIN_SCALE = 0.5;
            const MAX_SCALE = 5;

            let scale     = 1, tx = 0, ty = 0;
            let dragging  = false;
            let dsx = 0, dsy = 0, dox = 0, doy = 0;
            let pointers  = [], lastPinch = null, labelTimer = null, lastTap = 0;

            function apply(animate) {
                wrapperEl.style.transition = animate ? 'transform 0.2s ease' : 'none';
                wrapperEl.style.transform  = `scale(${scale}) translate(${tx}px,${ty}px)`;
            }

            function showLabel() {
                if (!labelEl) return;
                labelEl.textContent   = Math.round(scale * 100) + '%';
                labelEl.style.opacity = '1';
                clearTimeout(labelTimer);
                labelTimer = setTimeout(() => { labelEl.style.opacity = '0'; }, 1200);
            }

            function clamp() {
                if (scale <= 1) { tx = 0; ty = 0; return; }
                const vw = viewportEl.clientWidth,  vh = viewportEl.clientHeight;
                const iw = wrapperEl.clientWidth,   ih = wrapperEl.clientHeight;
                const mx = Math.max(0, (iw * scale - vw) / (2 * scale));
                const my = Math.max(0, (ih * scale - vh) / (2 * scale));
                tx = Math.min(mx, Math.max(-mx, tx));
                ty = Math.min(my, Math.max(-my, ty));
            }

            function zoomAt(ns, px, py) {
                ns = Math.min(MAX_SCALE, Math.max(MIN_SCALE, ns));
                const vw = viewportEl.clientWidth, vh = viewportEl.clientHeight;
                const iw = wrapperEl.clientWidth,  ih = wrapperEl.clientHeight;
                tx -= ((px / vw - 0.5) * iw) * (ns / scale - 1) / ns;
                ty -= ((py / vh - 0.5) * ih) * (ns / scale - 1) / ns;
                scale = ns;
                clamp(); apply(true); showLabel();
            }

            const api = {
                zoomIn()    { zoomAt(scale + ZOOM_STEP, viewportEl.clientWidth/2,  viewportEl.clientHeight/2); },
                zoomOut()   { zoomAt(scale - ZOOM_STEP, viewportEl.clientWidth/2,  viewportEl.clientHeight/2); },
                zoomReset() { scale=1; tx=0; ty=0; apply(true); showLabel(); },
            };

            viewportEl.addEventListener('wheel', e => {
                e.preventDefault();
                const r = viewportEl.getBoundingClientRect();
                zoomAt(scale + (e.deltaY < 0 ? ZOOM_STEP : -ZOOM_STEP), e.clientX - r.left, e.clientY - r.top);
            }, { passive: false });

            viewportEl.addEventListener('mousedown', e => {
                if (scale <= 1) return;
                dragging = true; dsx = e.clientX; dsy = e.clientY; dox = tx; doy = ty;
                viewportEl.style.cursor = 'grabbing';
            });
            document.addEventListener('mousemove', e => {
                if (!dragging) return;
                tx = dox + (e.clientX - dsx) / scale;
                ty = doy + (e.clientY - dsy) / scale;
                clamp(); apply();
            });
            document.addEventListener('mouseup', () => {
                if (!dragging) return;
                dragging = false;
                viewportEl.style.cursor = scale > 1 ? 'grab' : 'default';
            });

            viewportEl.addEventListener('touchstart', e => {
                pointers = Array.from(e.touches);
                if (pointers.length === 1 && scale > 1) {
                    dragging = true; dsx = pointers[0].clientX; dsy = pointers[0].clientY; dox = tx; doy = ty;
                }
                if (pointers.length === 2) {
                    lastPinch = Math.hypot(pointers[0].clientX - pointers[1].clientX, pointers[0].clientY - pointers[1].clientY);
                }
            }, { passive: true });

            viewportEl.addEventListener('touchmove', e => {
                if (e.touches.length === 2) {
                    e.preventDefault();
                    const t1 = e.touches[0], t2 = e.touches[1];
                    const d  = Math.hypot(t1.clientX - t2.clientX, t1.clientY - t2.clientY);
                    if (lastPinch) {
                        const r = viewportEl.getBoundingClientRect();
                        zoomAt(scale * (d / lastPinch), (t1.clientX+t2.clientX)/2 - r.left, (t1.clientY+t2.clientY)/2 - r.top);
                    }
                    lastPinch = d;
                } else if (e.touches.length === 1 && dragging) {
                    tx = dox + (e.touches[0].clientX - dsx) / scale;
                    ty = doy + (e.touches[0].clientY - dsy) / scale;
                    clamp(); apply();
                }
            }, { passive: false });

            viewportEl.addEventListener('touchend', () => { dragging = false; lastPinch = null; pointers = []; });

            viewportEl.addEventListener('dblclick', e => {
                const r = viewportEl.getBoundingClientRect();
                scale < 2 ? zoomAt(2, e.clientX - r.left, e.clientY - r.top) : api.zoomReset();
            });

            viewportEl.addEventListener('touchend', e => {
                const now = Date.now();
                if (now - lastTap < 300 && e.changedTouches.length === 1) {
                    const r = viewportEl.getBoundingClientRect();
                    scale < 2 ? zoomAt(2, e.changedTouches[0].clientX - r.left, e.changedTouches[0].clientY - r.top) : api.zoomReset();
                }
                lastTap = now;
            });

            return api;
        }

        const origZoom    = makeZoomPan(
            document.getElementById('imageViewport'),
            document.getElementById('imageWrapper'),
            document.getElementById('zoomLabel')
        );
        const measureZoom = makeZoomPan(
            document.getElementById('measureViewport'),
            document.getElementById('measureWrapper'),
            document.getElementById('measureZoomLabel')
        );

        function zoomIn()    { origZoom.zoomIn(); }
        function zoomOut()   { origZoom.zoomOut(); }
        function zoomReset() { origZoom.zoomReset(); }
        function mZoomIn()   { measureZoom.zoomIn(); }
        function mZoomOut()  { measureZoom.zoomOut(); }
        function mZoomReset(){ measureZoom.zoomReset(); }

        // ── MODAL ──
        let currentFarmId = null;

        function openModal(image, title, farmId) {
            currentFarmId = farmId;

            document.getElementById('modalImage').src       = image;
            document.getElementById('modalTitle').innerText = title;
            document.getElementById('measurementSection').classList.add('hidden');
            document.getElementById('loadingBox').classList.add('hidden');
            document.getElementById('measurementTableBody').innerHTML = '';
            document.getElementById('measurementImage').src = '';
            document.getElementById('measureBtn').disabled  = false;

            origZoom.zoomReset();

            const modal = document.getElementById('imageModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.getElementById('imageModal').addEventListener('click', function (e) {
            if (e.target === this) closeModal();
        });

        // ── MEASUREMENT ──
        async function showMeasurement() {
            const btn = document.getElementById('measureBtn');
            btn.disabled = true;

            document.getElementById('loadingBox').classList.remove('hidden');
            document.getElementById('measurementSection').classList.add('hidden');

            try {
                const response = await fetch(`/farm/${currentFarmId}/measurement`);
                if (!response.ok) throw new Error('Server error ' + response.status);

                const data = await response.json();

                document.getElementById('loadingBox').classList.add('hidden');
                document.getElementById('measurementSection').classList.remove('hidden');
                document.getElementById('measurementImage').src = data.image;
                measureZoom.zoomReset();

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
                console.error(error);
                document.getElementById('loadingBox').classList.add('hidden');
                alert('Gagal memuat data pengukuran. Coba lagi.');
                btn.disabled = false;
            }
        }

    </script>

</body>
</html>
