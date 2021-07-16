<?php

/**
 * Plugin Name:       Event Map
 * Description:       A map with event markers
 * Author:            @fuzzelmukkel, @SirRick
 * License:           MIT
 * Na
 */



 function rest_endpoint( $data ) {

   return "Response from the REST yields";
 }



 function eventmap_shortcode( $atts = [], $content = null, $tag = '' ) {

     return "<div class='wp-eventmap'> <h1> Happy Helloween! </h1> </div>";
 }

 /**
  * Central location to create all shortcodes.
  */
 function eventmap_shortcodes_init() {
     add_shortcode( 'eventmap', 'eventmap_shortcode' );
 }

 function eventmap_rest_init() {
   register_rest_route( 'eventmap/v1', '/events', array(
     'methods' => 'GET',
     'callback' => 'rest_endpoint',
   ) );
 }

 function eventmap_options_page() {
   ?>
    <div class='wrapper'> </div>
      <h1> Options Page </h1>
    </div>
   <?php
 }

 function eventmap_add_options_page() {
   add_menu_page(
       'EventMap',
       'EventMap Data Tool',
       'update_plugins',
       'eventmap',
       'eventmap_options_page',
   );
 }

 add_action('init', 'eventmap_shortcodes_init');
 add_action('rest_api_init', 'eventmap_rest_init');
 add_action('admin_menu', 'eventmap_add_options_page');


?>
