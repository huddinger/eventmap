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

    if ( ! current_user_can (  'manage_options'  ) ) {
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

        echo ('my ass');
    $title = sanitize_text_field(  wp_unslash( $_POST['title']  ) );
    $lat   = sanitize_text_field(  wp_unslash( $_POST['lat']  ) );
    $lon   = sanitize_text_field(  wp_unslash( $_POST['lon']  ) );

    db_insert_event( $title, $lat, $lon );


    $this->redirect();
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
