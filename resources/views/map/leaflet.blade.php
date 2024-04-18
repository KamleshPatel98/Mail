<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Map</title>
    <link rel="stylesheet" href="{{ asset('assets/leaflet/leaflet.css') }}">
    <style>
        #map { height: 500px; }
    </style>
</head>
<body>
    <div id="map"></div>
    <script src="{{ asset('assets/leaflet/leaflet.js') }}"></script>
    <script>
        var map = L.map('map').setView([21.2514, 81.6296], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        @foreach ($leaflets as $row)
            var marker = L.marker([{{ $row->X }}, {{ $row->Y }}]).addTo(map);
            marker.bindPopup("<b>{{$row->X}}!</b><br>{{ $row->id }}").openPopup();
        @endforeach



        // var circle = L.circle([51.508, -0.11], {
        //     color: 'red',
        //     fillColor: '#f03',
        //     fillOpacity: 0.5,
        //     radius: 500
        // }).addTo(map);

        // @foreach ($leaflets as $row)
        //     var circle = L.circle([{{ $row->X }}, {{ $row->Y }}], {
        //         color: 'red',
        //         fillColor: '#f03',
        //         fillOpacity: 0.5,
        //         radius: 500
        //     }).addTo(map);
        // @endforeach

        // var polygon = L.polygon([
        //     [51.509, -0.08],
        //     [51.503, -0.06],
        //     [51.51, -0.047]
        // ]).addTo(map);

        
        // circle.bindPopup("I am a circle.");
        // polygon.bindPopup("I am a polygon.");

        var popup = L.popup()
        .setLatLng([21.103, 81.10])
        .setContent("I am a standalone popup.")
        .openOn(map);

        //
        // function onMapClick(e) {
        //     alert("You clicked the map at " + e.latlng);
        // }

        // map.on('click', onMapClick);

        var popup = L.popup();

        function onMapClick(e) {
            popup
            .setLatLng(e.latlng)
            .setContent("You clicked the map at " + e.latlng.toString())
            .openOn(map);
        }

        map.on('click', onMapClick);
    </script>
</body>
</html>