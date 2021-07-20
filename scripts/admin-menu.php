<?php

class AdminMenu {

  public function init() {
    $menu = array();
    $menu[] = new AdminMenuPage();
    $menu[] = new AdminAddEventPage();
    $menu[] = new AdminEditEventPage();
    $menu[] = new AdminOptionsPage();

    foreach (  $menu as $e  ) {
      $e->init();
    }
  }

  public function __constructor() {
    add_action(  'admin_menu', array (  $this, 'init')  );
  }


}


 ?>
