
var marker = null;
var map;
var context ;
var defaultZoom = null
var defaultLatLng = null



function clickEventHandler( event ) {
  latlng = event.latlng

  if ( marker == null )
      marker = L.marker(latlng).addTo(map)
  else
    marker.setLatLng(latlng)

  jQuery( '#eventmap-lat' ).val ( latlng.lat )
  jQuery( '#eventmap-lon' ).val ( latlng.lng )
}

function moveEventHandler ( event )  {
  latlng = map.getCenter()

  jQuery( '#eventmap-lat' ).val ( latlng.lat )
  jQuery( '#eventmap-lon' ).val ( latlng.lng )
}

function zoomEventHandler ( event ) {
  console.log('zoom')
  jQuery( '#eventmap-zoom' ).val ( map.getZoom() )
}

function processEvent(item) {
  latlon = [parseFloat(item['lat']), parseFloat(item['lon'])]

  marker = L.marker(latlon)
            .addTo(map);

  marker.bindPopup(item['title']);

  if ( context == 'event' )
    map.setView( latlon , defaultZoom )
}

function processOptions(data) {
  lat  = parseFloat( data['lat']  )
  lon  = parseFloat( data['lon']  )


  defaultZoom = parseInt  ( data['zoom'] )
  defaultLatLng = [lat, lon]


  if ( isNaN(lat + lon) )
    defaultLatLng = [0, 0]

  if ( isNaN(defaultZoom) )
    defaultZoom = 10

  if ( ['options'].includes(context) )
    map.setView(defaultLatLng, defaultZoom)
}

function init() {
  //get context
  context = jQuery( '#eventmap-type' ).val()


  //initialize map
  map = L.map('location-selector');
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  // Get view Options
  jQuery.ajax("/?rest_route=/eventmap/v1/options")
    .done( processOptions )
    .error(function(){console.log('eventmap: error loading data')})

  // If we're on a event screen, set a event location marker
  if ( context == 'event' ) {
    searchParams = new URLSearchParams(document.URL)
    if ( searchParams.has('id') ) {
      id = searchParams.get('id')
      jQuery.ajax("/?rest_route=/eventmap/v1/event/" + id)
        .done( processEvent )
        .error(function(){console.log('eventmap: error loading data')})
    }
  }

  if ( context == 'options' )
    map.addEventListener( 'moveend', moveEventHandler )

  // Register event handlers
  // we want to
  if ( jQuery( '#eventmap-lat' ).length > 0 && jQuery( '#eventmap-lon' ).length > 0)
    map.addEventListener('click', clickEventHandler)

  if ( jQuery( '#eventmap-zoom' ).length > 0 )
    map.addEventListener('zoomend', zoomEventHandler)
}


// run init when page has loaded
jQuery(init);
