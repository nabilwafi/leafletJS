@extends('layout')
@section('content')


<a href="{{ route('admin.dashboard') }}">Table</a>
<div>
    <input type="text" id="input_name" name="">
    <button type="button" id="button">Search</button>
</div>
<div id="map"></div>

{{-- Script --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

<script>
    var result;
    var map = L.map('map').setView([-6.8467497, 107.650042], 15);
    var publiKey = 'pk.eyJ1IjoibmFiaWx3YWZpIiwiYSI6ImNrejVvNGR3NjBjNTAycnFuZDYyNDRycTIifQ.64NBmUKA4bxoC933pq2X7w';

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: publiKey,
    }).addTo(map);

    $(document).ready(() => {
        $.getJSON('titik/gedung', (data) => {
            $.each(data, (item) => {

                $.getJSON('info/gedung/' + data[item].id, (detail) => {

                    var content = `
                        <div class="card">
                            <h1 class="card-title">${detail.nama_gedung}</h1>
                            <div class="card-line"></div>
                            <div>
                            <img class="foto-marker" src="${"uploads/" + detail.foto}" alt="..." />
                            </div>
                            <div class="card-line"></div>
                            <diV>${detail.alamat}</div>
                            <div class="card-line"></div>
                            <diV>${detail.deskripsi}</div>
                        </div>
                        `;

                    var popup = L.popup()
                        .setLatLng([data[item].latitude, data[item].longitude])
                        .setContent(content);

                    $('#button').bind('click', () => {
                        const x = document.getElementById('input_name').value;
                        if (x == detail.nama_gedung) {
                            map.flyTo([parseFloat(data[item].latitude), parseFloat(data[item].longitude)], 22);
                            L.marker([
                            parseFloat(data[item].latitude),
                            parseFloat(data[item].longitude),
                        ])
                        .addTo(map)
                        .bindPopup(popup).openPopup();
                        }
                    });

                    L.marker([
                            parseFloat(data[item].latitude),
                            parseFloat(data[item].longitude),
                        ])
                        .addTo(map)
                        .bindPopup(popup);
                });
            });
        });
    });

    $.getJSON("/geojson/kota_Bandung.geojson", function (json) {
        geoLayer = L.geoJson(json, {
            style: function (feature) {
                return {
                    fillOpacity: 0.5,
                    weight: 2,
                    opacity: 1,
                }
            },

            onEachFeature: function (feature, layer) {
                layer.addTo(map);
                layer.addEventListener('mouseover', function () {
                    layer.bindPopup(feature.properties.Name);
                });
            }
        });

    });

</script>
@endsection
