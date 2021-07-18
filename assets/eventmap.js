var map = null

function calculateMid(data) {
  lat = 0
  lon = 0;

  data.forEach((item, i) => {
    lat += parseFloat(item['lat'])
    lon += parseFloat(item['lon'])
  });

  i = data.length
  return [lat/i, lon/i]
}

function setMarkers(data) {
  data.forEach((item, i) => {
      latlon = [parseFloat(item['lat']), parseFloat(item['lon'])]

      marker = L.marker(latlon)
                .addTo(map)
                .bindPopup(item['title']);
  })
}

function processData(data) {
  // calculate center
  console.log(data)

  mid = calculateMid(data)
  map.setView(mid, 10)

  setMarkers(data)
}

function requestData() {
  jQuery.ajax("?rest_route=/eventmap/v1/events")
    .done(function(data){processData(data)})
    .error(function(){console.log('eventmap: error loading data')})
}

function init() {

  //initialize map
  map = L.map('eventmap');

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  map.setView([51.505, -0.09], 13)


  requestData();
}


// run init when page has loaded
jQuery(init);
