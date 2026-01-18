@php
    $locationsJson = json_encode($this->locations ?? []);
@endphp

<div>
    <style>
        #map {
            height: 520px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            background: #f3f4f6;
        }
    </style>

    <div class="space-y-4">
        <div class="text-sm text-gray-600">
            Titik lokasi pendaftar yang telah mengisi koordinat latitude dan longitude.
        </div>

        <div id="map"></div>

        <div class="overflow-hidden rounded-xl border border-gray-200">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-2 text-left">Nama</th>
                        <th class="px-3 py-2 text-left">Email</th>
                        <th class="px-3 py-2 text-left">Telepon</th>
                        <th class="px-3 py-2 text-left">Divisi</th>
                        <th class="px-3 py-2 text-left">Latitude</th>
                        <th class="px-3 py-2 text-left">Longitude</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($this->locations ?? [] as $l)
                        <tr class="border-t">
                            <td class="px-3 py-2">{{ $l['nama'] ?? '-' }}</td>
                            <td class="px-3 py-2">{{ $l['email'] ?? '-' }}</td>
                            <td class="px-3 py-2">{{ $l['phone'] ?? '-' }}</td>
                            <td class="px-3 py-2">{{ $l['divisi'] ?? '-' }}</td>
                            <td class="px-3 py-2">{{ $l['lat'] ?? '-' }}</td>
                            <td class="px-3 py-2">{{ $l['lng'] ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr class="border-t">
                            <td colspan="6" class="px-3 py-3 text-center text-gray-500">Belum ada data lokasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        (function() {
            const mapData = {!! $locationsJson !!};
            
            // Load Leaflet CSS
            const link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
            document.head.appendChild(link);
            
            // Load Leaflet JS
            const script = document.createElement('script');
            script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
            script.onload = initMap;
            document.head.appendChild(script);
            
            function initMap() {
                // Wait for L to be available
                if (typeof window.L === 'undefined') {
                    setTimeout(initMap, 100);
                    return;
                }
                
                const mapElement = document.getElementById('map');
                if (!mapElement) return;
                
                try {
                    const map = window.L.map('map').setView([-7.983, 112.621], 12);
                    
                    window.L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(map);
                    
                    const bounds = window.L.latLngBounds();
                    const markers = [];
                    
                    mapData.forEach(function(loc) {
                        if (typeof loc.lat === 'number' && typeof loc.lng === 'number') {
                            const marker = window.L.marker([loc.lat, loc.lng]).addTo(map);
                            const popup = '<div style="min-width:240px">' +
                                '<strong>' + (loc.nama || '-') + '</strong><br>' +
                                'Email: ' + (loc.email || '-') + '<br>' +
                                'Telepon: ' + (loc.phone || '-') + '<br>' +
                                'Divisi: ' + (loc.divisi || '-') + '<br>' +
                                'Koordinat: ' + loc.lat + ', ' + loc.lng +
                                '</div>';
                            marker.bindPopup(popup);
                            markers.push(marker);
                            bounds.extend([loc.lat, loc.lng]);
                        }
                    });
                    
                    if (markers.length > 0) {
                        map.fitBounds(bounds.pad(0.15));
                    }
                    
                    console.log('Map initialized with ' + markers.length + ' markers');
                } catch (e) {
                    console.error('Map error:', e);
                }
            }
        })();
    </script>
</div>

