
var marker = null;
var map;
var context ;
var defaultZoom = null
var defaultLatLng = null


/*
 *  Event Handlers
 */

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


/*
 * Ajax Handlers
 */

function processEvent(item) {
  latlon = [parseFloat(item['lat']), parseFloat(item['lon'])]

  marker = L.marker(latlon)
            .addTo(map);

  popup = '<b>' + item['title'] + '</b> <br>' + item['info']
  marker.bindPopup(popup);

  if ( context == 'event' )
    map.setView( latlon , defaultZoom )
}

function processEvents(data) {
  data.forEach((item, i) => {
      processEvent(item)
  })
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

  map.setZoom(defaultZoom);

  map.setView(defaultLatLng, defaultZoom)
}


function init() {
  //get context
  //and exit if necessary
  context = jQuery( '#eventmap-type' ).val()
  if( context == "" )
    return

  //initialize map
  map = L.map('eventmap');
  L.tileLayer('http://tile.stamen.com/toner/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  // Get view Options
  jQuery.ajax("/?rest_route=/eventmap/v1/options")
    .done( processOptions )
    .error(function(){console.log('eventmap: error loading data')})

  // If we're on a event screen, set a event location marker
  // and register changes
  if ( context == 'event' ) {
    searchParams = new URLSearchParams(document.URL)
    if ( searchParams.has('id') ) {
      id = searchParams.get('id')
      jQuery.ajax("/?rest_route=/eventmap/v1/event/" + id)
        .done( processEvent )
        .error(function(){console.log('eventmap: error loading data')})
    }

    map.addEventListener('click', clickEventHandler)
  }

  // if we're on the map, we want to show all events
  if ( context == 'map' ) {
    jQuery.ajax("/?rest_route=/eventmap/v1/events")
      .done( processEvents )
      .error(function(){console.log('eventmap: error loading data')})
  }

  // on the options page, we want to set the default view
  if ( context == 'options' ) {
    map.addEventListener( 'moveend', moveEventHandler )
    map.addEventListener( 'zoomend', zoomEventHandler )
  }

}


// run init when page has loaded
jQuery(init);
