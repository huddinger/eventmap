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

  /*
   * DB Handler
   */


  function db_create_tables() {
    global $wpdb;

    $table_name = $wpdb->prefix . "eventmap_data";
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
      id int NOT NULL AUTO_INCREMENT,
      title varchar(50) not null,
      lon float not null,
      lat float not null,
      PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
  }

  function db_delete_tables() {
    global $wpdb;
      $table_name = $wpdb->prefix . 'eventmap_data';
      $sql = "DROP TABLE IF EXISTS $table_name";
      $wpdb->query($sql);
  }

  /*
   * REST API
   */


/*
 * SHORTCODE
 */

 function eventmap_shortcode( $atts = [], $content = null, $tag = '' ) {

     return "<div class='wrapper'>
              <div id='eventmap' style='height:400px; width: max'>
             </div>";
 }

 /**
  * Initializers
  */
 function eventmap_init() {
     add_shortcode( 'eventmap', 'eventmap_shortcode' );

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

/*
 * Plugin management
 */

 function activate_eventmap() {
   db_create_tables();
 }

 function deactivate_eventmap() {
   db_delete_tables();

 }

 function uninstall_eventmap() {
 }

/*
 * ADD HOOKS
 */

 include ("php/rest.php");

 function eventmap_enqueue_scripts() {
     wp_enqueue_style( 'leaflet-css', plugin_dir_url(__FILE__) . 'assets/leaflet/leaflet.css');
     wp_enqueue_script( 'eventmap-js', plugin_dir_url(__FILE__) . 'assets/eventmap.js', array('jquery'));
     wp_enqueue_script( 'leaflet-js', plugin_dir_url(__FILE__) . 'assets/leaflet/leaflet.js');
 }


 add_action( 'wp_enqueue_scripts', 'eventmap_enqueue_scripts' );

 add_action('init', 'eventmap_init');
 add_action('admin_menu', 'eventmap_add_options_page');

 register_activation_hook(__FILE__, 'activate_eventmap');
 register_deactivation_hook(__FILE__, 'deactivate_eventmap');
 register_uninstall_hook(__FILE__, 'uninstall_eventmap');

?>
