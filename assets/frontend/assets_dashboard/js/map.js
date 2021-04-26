var mymap = L.map('mapid').setView([-7.57110295267244, 110.82622065004949], 14);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: '&copy; Data Covid-19 Kota Surakarta 2021',
    // maxZoom: 18,
    minZoom: 13,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoibmlyZWRvY3oiLCJhIjoiY2tsMjhpM3BkM3JpcDJvcW42cXo3NGNnMSJ9.rBOz7uajzNiVUcgbDfiZ0A'
    }).addTo(mymap);

var marker = L.marker([-7.57110295267244, 110.82622065004949]).addTo(mymap);