<?php


class AdminAddEventPage {

  public function init() {
    add_submenu_page(
      null, //parent_slug -> not shown in menu, but accessable via overview
      'Add Event', //page_title,
      'Add Event', //menu_title,
      WP_PERMISSION, //capability,
      'eventmap-add-event', //menu_slug
      array( $this, 'render' ) // callable function
    );
  }

  function render() {
    include_once( 'views/add-event.php' );
    include_once( 'views/map.php' );
  }

}

?>
