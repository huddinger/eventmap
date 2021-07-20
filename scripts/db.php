<?php


class DB {
  static public function create_tables() {
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

  static public function delete_tables() {
    global $wpdb;
      $table_name = $wpdb->prefix . 'eventmap_data';
      $sql = "DROP TABLE IF EXISTS $table_name";
      $wpdb->query($sql);
  }

  static public function get_events() {
    global $wpdb;
    return $wpdb->get_results( "SELECT id, title, lon, lat
                                FROM `{$wpdb->prefix}eventmap_data`;");
  }

  static public function insert_event( $title, $lat, $lon ) {
    global $wpdb;
    $sql = "INSERT INTO `{$wpdb->prefix}eventmap_data`(title, lat, lon)
            VALUES ('{$title}', {$lat}, {$lon});";
    return $wpdb->query( $sql );

  }

  static public function get_event_by_id( $id ) {
    global $wpdb;
    return $wpdb->get_row( "SELECT id, title, lon, lat
                            FROM {$wpdb->prefix}eventmap_data
                            WHERE id = {$id};");
  }

  static public function update_event( $id, $title, $lat, $lon ) {
    global $wpdb;
    $wpdb->query("UPDATE {$wpdb->prefix}eventmap_data
                  SET   title = '{$title}',
                        lon   = {$lon},
                        lat   = {$lat}
                  WHERE id    = {$id};");
  }

  static public function delete_event( $id ) {
    global $wpdb;
    $wpdb->query("DELETE FROM {$wpdb->prefix}eventmap_data
                        WHERE id = {$id};");
  }
}

?>
