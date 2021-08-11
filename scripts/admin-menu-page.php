<?php


//
// if ($_POST) {
//     echo "user capability update_plugins ? " . current_user_can('update_plugins');
//     echo json_encode($_POST);
// }

class AdminMenuPage {

  public function __constructor() {

  }

  public function init() {
    add_menu_page(
      'EventMap', //page title
      'EventMap', //menu title
      WP_PERMISSION, //capability
      'eventmap-overview', //slug
      array(  $this, 'render'  ) //callable function
    );
  }

  function render() {
    require_once('views/menu.php');
    require_once('views/map.php');
   }

  }

?>
