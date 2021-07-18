<?php

class AdminMenu {

  public function init() {
    $menu = array();
    $menu[] = new AdminMenuPage();
    $menu[] = new AdminAddEventPage();

    foreach (  $menu as $e  ) {
      $e->init();
    }
  }

  function __constructor() {
    add_action(  'admin_menu', array (  $this, 'init')  );
  }


}


 ?>
