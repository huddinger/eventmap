<?php


class AdminEditEventPage {

  public function init() {
    add_submenu_page(
      null,//parent_slug -> will not be shown in menu
      'Edit Event', //page_title,
      'Edit Event', //menu_title,
      'manage_options', //capability,
      'eventmap-edit-event', //menu_slug
      array( $this, 'render' ) // callable function
    );
  }

  function render() {
    include_once( 'views/edit-event.php' );
  }

}

?>
