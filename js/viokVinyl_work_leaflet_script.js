// leaflet map

viokMap = document.querySelector('#leaflet-map');

if (viokMap) {

    latitude = viokMap.getAttribute('data-latitude');
    longitude = viokMap.getAttribute('data-longitude');

    var mymap = L.map('leaflet-map').setView([latitude, longitude], 13);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoiY2lyY3VzLXB5Z2FyZ3VzIiwiYSI6ImNqeDRxMXl1aDA3dnM0NG14Y280ZDBhaHUifQ.pAEs59hSzZL1CU234bd6Xg'
    }).addTo(mymap);

    var marker = L.marker([latitude, longitude]).addTo(mymap);
}



