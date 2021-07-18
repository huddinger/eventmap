<?php

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

function db_get_events() {
  global $wpdb;
  return $wpdb->get_results("SELECT id, title, lon, lat FROM `{$wpdb->prefix}eventmap_data`;");
}

function db_insert_event(  $title, $lat, $lon  ) {
  global $wpdb;
  $sql = "INSERT INTO `{$wpdb->prefix}eventmap_data`(title, lon, lat) VALUES ('{$title}', {$lat}, {$lon});";
  return $wpdb->query( $sql );

}

function db_put_event() {
  global $wpdb;

}

?>
