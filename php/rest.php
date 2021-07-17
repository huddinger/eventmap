<?php

require_once('db.php');

 function get_events( $data ) {
   return db_get_events();
 }


 function eventmap_rest_init() {
   register_rest_route( 'eventmap/v1', '/events', array(
     'methods' => 'GET',
     'callback' => 'get_events',
   ) );
 }


add_action('rest_api_init', 'eventmap_rest_init');

?>
