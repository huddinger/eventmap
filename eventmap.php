<?php

/**
 * Plugin Name:       Event Map
 * Description:       A map with event markers
 * Author:            @fuzzelmukkel, @SirRick
 * License:           MIT
 */

 /*
  * Functions
  */

define ( 'EVENTMAP_ROOT_DIR', plugin_dir_url(__FILE__) );
define ( 'WP_PERMISSION', 'edit_pages' );

// Include the dependencies needed to instantiate the plugin.
foreach ( glob( plugin_dir_path( __FILE__ ) . 'scripts/*.php' ) as $file ) {
    include_once $file;
}


  /*
   * Hooks
   */


function activate_eventmap() {
  DB::create_tables();
  $options = array( 'lat' => 53, 'lon' => 13, 'zoom' => 13 );
  if ( get_option( 'eventmap-options ') == false ) {
    add_option('eventmap-options', $options);
  }
}

function deactivate_eventmap() {
}

function uninstall_eventmap() {
  DB::delete_tables();
  delete_option('eventmap-options');
}



class EventMap {

 function enqueue_scripts() {
     wp_enqueue_style ( 'leaflet-css',  plugin_dir_url(__FILE__) . 'assets/leaflet/leaflet.css');
     wp_enqueue_script( 'eventmap-js', plugin_dir_url(__FILE__) . 'assets/eventmap.js', array('jquery'));
     wp_enqueue_script( 'leaflet-js',   plugin_dir_url(__FILE__) . 'assets/leaflet/leaflet.js');
 }


 function init() {
  $api = new API();
  $api->init();


  $sc = new Shortcode();
  $menu = new AdminMenu();


  add_action( 'admin_post', array( $api, 'process_request' ) );
  add_action( 'wp_enqueue_scripts', array(  $this, 'enqueue_scripts')  );
  add_action( 'admin_enqueue_scripts', array ($this, 'enqueue_scripts') );
  add_action( 'admin_menu', array (  $menu, 'init')  );
  add_action( 'init', array(  $sc, 'init'  )  );


  register_activation_hook(__FILE__, 'activate_eventmap');
  register_deactivation_hook(__FILE__, 'deactivate_eventmap' );
  register_uninstall_hook(__FILE__, 'uninstall_eventmap' );
  }

}

$plugin = new EventMap();
$plugin->init();

?>
