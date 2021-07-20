<?php


class AdminAddEventPage {

  public function init() {
    add_submenu_page(
      'eventmap-overview',//parent_slug
      'Add Event', //page_title,
      'Add Event', //menu_title,
      'manage_options', //capability,
      'eventmap-add-event', //menu_slug
      array( $this, 'render' ) // callable function
    );
  }

  function render() {
    include_once( 'views/add-event.php' );
    include_once( 'views/location-selector.php' );
  }

}

?>
