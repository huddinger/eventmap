<div class='wrap'>
    <h1>
      <?php echo esc_html( get_admin_page_title() ); ?>
    </h1>

  <table>
    <tr>
      <th> ID </th>
      <th> Title doo </th>
      <th> Latitude </th>
      <th> Longitude </th>
      <th> Edit </th>
    </tr>

    <?php
    $data = DB::get_events();
    foreach ($data as $row) {
     echo "<tr>";
     echo "<td> $row->id </td>";
     echo "<td> $row->title </td>";
     echo "<td> $row->lat </td>";
     echo "<td> $row->lon </td>";
     echo "<td> <a href='" . menu_page_url( 'eventmap-edit-event', false ) . '&id=' . $row->id . "' > Edit </a> </td>";
     echo "</tr>";
    };
    ?>

  </table>

  <input id='eventmap-type' value='map' style='display:none;' />
</div>
