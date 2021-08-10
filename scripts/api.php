<?php
/**
 * Performs all sanitization functions required to save the option values to
 * the database.
 *
 * @package Custom_Admin_Settings
 */

/**
 * Performs all sanitization functions required to save the option values to
 * the database.
 *
 * This will also check the specified nonce and verify that the current user has
 * permission to save the data.
 *
 * @package Custom_Admin_Settings
 */


class API {

  private function verify() {

    // If the field isn't even in the $_POST, then it's invalid.
    if ( ! isset( $_POST['_wpnonce'] ) ) { // Input var okay.

          echo ('Kill: _wpnonce');
        return false;
    }

    if ( ! current_user_can (  WP_PERMISSION  ) ) {
      return false;
    }


    $nonce  = wp_unslash( $_POST['_wpnonce'] );

    return wp_verify_nonce( $nonce );

  }

  public function init() {

  }

  public function process_request() {
    if ( ! $this->verify() ) {
      echo 'Invalid Nonce';
      return;
    }

    // $action = isset($_POST['eventmap-action']) ? $_POST['eventmap_action'] : "";
    $action = $_POST['eventmap-action'] ?? null;


    if ( $action == "add" ) {
      $title = sanitize_text_field(  wp_unslash( $_POST['title']  ) );
      $lat   = sanitize_text_field(  wp_unslash( $_POST['lat']  ) );
      $lon   = sanitize_text_field(  wp_unslash( $_POST['lon']  ) );

      DB::insert_event( $title, $lat, $lon );
    }

    if ( $action == "edit" ) {
      $id    = sanitize_text_field(  wp_unslash( $_POST['id']  ) );
      $title = sanitize_text_field(  wp_unslash( $_POST['title']  ) );
      $lat   = sanitize_text_field(  wp_unslash( $_POST['lat']  ) );
      $lon   = sanitize_text_field(  wp_unslash( $_POST['lon']  ) );

      DB::update_event ( $id, $title, $lat, $lon );
    }

    if ( $action == "delete" ) {
      $id = sanitize_text_field(  wp_unslash( $_POST['id']  ) );
      DB::delete_event ( $id );
    }

    if ( $action == "edit-options" ) {
      $lat = sanitize_text_field(  wp_unslash( $_POST['lat']  ) );
      $lon   = sanitize_text_field(  wp_unslash( $_POST['lon']  ) );
      $zoom   = sanitize_text_field(  wp_unslash( $_POST['zoom']  ) );

      $options = array( 'lat' => $lat, 'lon' => $lon, 'zoom' => $zoom );
      update_option('eventmap-options', $options);

      $this->redirect();
      exit;
    }


    wp_redirect( admin_url( 'admin.php?page=eventmap-overview' ) );
    exit;
  }

  private function redirect() {
       if ( ! isset( $_POST['_wp_http_referer'] ) ) {
           $_POST['_wp_http_referer'] = wp_login_url();
       }

       $url = sanitize_text_field( wp_unslash( $_POST['_wp_http_referer'] ) );

       // Finally, redirect back to the admin page.
       wp_safe_redirect( urldecode( $url ) );
       exit;

   }

}
