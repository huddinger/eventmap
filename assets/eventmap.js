var map = null

function processData(data) {
  data.forEach((item, i) => {
      latlon = [parseFloat(item['lat']), parseFloat(item['lon'])]

      marker = L.marker(latlon)
                .addTo(map);

      marker.bindPopup(item['title']);

  })
}


function processOptions(data) {
  lat  = parseFloat( data['lat']  )
  lon  = parseFloat( data['lon']  )
  zoom = parseInt  ( data['zoom'] )

  if ( isNaN(lat + lon) )
    latlng = [0, 0]

  if ( isNaN(zoom) )
    zoom = 10

  map.setView([lat, lon], zoom)
}

function init() {
  if ( jQuery( '#eventmap' ).length == 0)
    return;

  //initialize map
  map = L.map('eventmap');

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);


  // Get view Options
  jQuery.ajax("/?rest_route=/eventmap/v1/options")
    .done( processOptions )
    .error(function(){console.log('eventmap: error loading data')})


  // Get event data
  jQuery.ajax("?rest_route=/eventmap/v1/events")
    .done( processData )
    .error(function(){console.log('eventmap: error loading data')})
}


// run init when page has loaded
jQuery(init);
