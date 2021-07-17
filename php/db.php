<?php

function db_get_events() {
  global $wpdb;
  return $wpdb->get_results("SELECT id, title, lon, lat FROM `{$wpdb->prefix}eventmap_data`;");
}


function db_put_event() {
  global $wpdb;
  
}

?>
