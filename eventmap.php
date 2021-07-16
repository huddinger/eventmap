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

 function rest_endpoint( $data ) {

   return "Response from the REST yields";
 }


/*
 * SHORTCODE
 */

 function eventmap_shortcode( $atts = [], $content = null, $tag = '' ) {

     return "<div class='wp-eventmap'> <h1> Happy Helloween! </h1> </div>";
 }

 /**
  * Initializers
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

 add_action('init', 'eventmap_shortcodes_init');
 add_action('rest_api_init', 'eventmap_rest_init');
 add_action('admin_menu', 'eventmap_add_options_page');

 register_activation_hook(__FILE__, 'activate_eventmap');
 register_deactivation_hook(__FILE__, 'deactivate_eventmap');
 register_uninstall_hook(__FILE__, 'uninstall_eventmap');

?>
