<?php

class AdminOptionsPage {

  public function init() {
    add_submenu_page(
      'eventmap-overview',//parent_slug -> will not be shown in menu
      'Eventmap Options', //page_title,
      'Options', //menu_title,
      'manage_options', //capability,
      'eventmap-options', //menu_slug
      array( $this, 'render' ) // callable function
    );
  }

  function render() {
    include_once( 'views/options.php' );
    include_once( 'views/map.php' );
  }

}

?>
