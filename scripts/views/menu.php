<div class='wrapper'>
    <h1>
      <?php

      echo esc_html( get_admin_page_title() ); echo json_encode($_REQUEST);


      ?>
    </h1>

  <table>
    <tr>
      <th> ID </th>
      <th> Title doo </th>
      <th> Latitude </th>
      <th> Longitude </th>
      <th> Edit </th>
      <th> Delete </th>
    </tr>

    <?php
    $data = db_get_events();
    foreach ($data as $row) {
     echo "<tr>";
     echo "<td> $row->id </td>";
     echo "<td> $row->title </td>";
     echo "<td> $row->lat </td>";
     echo "<td> $row->lon </td>";
     echo "<td> </td>";
     echo "<td>";
     echo "</tr>";
    };
    ?>

  </table>
</div>
