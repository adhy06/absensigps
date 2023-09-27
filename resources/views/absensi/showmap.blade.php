<style>
    #map { 
        height: 400px; 
    }
</style>

<div id="map"></div>

<script>
    var lokasi = "{{ $absensi->lokasi_masuk }}";
    var lok = lokasi.split(",");
    var latitude = lok[0];
    var longitude = lok[1];
    
    var map = L.map('map').setView([latitude,longitude], 16);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
var marker = L.marker([latitude,longitude]).addTo(map);
var circle = L.circle([-7.739844100369356, 110.46191618526666], {
        // var circle = L.circle([-7.5123401400230705, 110.63880137513144], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 50
        }).addTo(map);

var popup = L.popup()
    .setLatLng([latitude,longitude])
    .setContent("{{ $absensi->nama_lengkap }}")
    .openOn(map);
</script>