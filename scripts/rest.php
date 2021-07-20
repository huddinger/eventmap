<?php

require_once('db.php');

function get_event( $data ) {
  return DB::get_event_by_id( $data['id'] );
}

function get_events() {
  return DB::get_events();
}

function get_options() {
  return get_option( 'eventmap-options');
}


function eventmap_rest_init() {
  register_rest_route( 'eventmap/v1', '/events', array(
                       'methods' => 'GET',
                       'callback' => 'get_events' ) );

  register_rest_route( 'eventmap/v1', '/event/(?P<id>\d+)', array(
                       'methods' => 'GET',
                       'callback' => 'get_event' ) );

  register_rest_route( 'eventmap/v1', '/options', array(
                       'methods' => 'GET',
                       'callback' => 'get_options' ) );
}


add_action('rest_api_init', 'eventmap_rest_init');

?>
