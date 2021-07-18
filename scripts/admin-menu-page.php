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
      'EventMap Data Tool', //menu title
      'manage_options', //capability
      'eventmap-overview', //slug
      array(  $this, 'render'  ) //callable function
    );
  }

  function render() {
    $data = db_get_events();

     echo "<div class='wrapper'> </div>";
     echo "<table><tr>";
     echo "<th style='display:none'> id </th>";
     echo "<th> Title </th>";
     echo "<th> Latitude </th>";
     echo "<th> Longitude </th>";
     echo "</tr>";

     foreach ($data as $row) {
       echo "<tr>";
       echo "<td style='display:none'> $row->id </td>";
       echo "<td> $row->title </td>";
       echo "<td> $row->lat </td>";
       echo "<td> $row->lon </td>";
       echo "</tr>";
     };
     echo "</div>";
   }

  }

?>
