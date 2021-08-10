<div class="wrap">

    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

    <input id='eventmap-type' value='event' style='display:none;' />


    <form method="post" action="<?php echo esc_html( admin_url( 'admin-post.php' ) ); ?>">
      <input type="text" name="eventmap-action" value="edit" style="display:none" />
      <?php
      $id = isset($_GET['id']) ? $_GET['id'] : -1;

      if ( $id != -1 ) {
        $data = DB::get_event_by_id( $id );

        echo '<table>';

        echo '<tr><td> ID:        </td><td> <input type="text" name="id"    value="' . $data->id    . '" readonly/> <br /> </td></tr>
              <tr><td> Titel:     </td><td> <input type="text" name="title" id="eventmap-title" value="' . $data->title . '" />         <br /> </td></tr>
              <tr><td> Latitude:  </td><td> <input type="text" name="lat"  id="eventmap-lat" value="' . $data->lat   . '" />         <br /> </td></tr>
              <tr><td> Longitude: </td><td> <input type="text" name="lon"  id="eventmap-lon" value="' . $data->lon   . '" />         <br /> </td></tr>';

        echo '</table>';


        wp_nonce_field( );
        submit_button();
      } else {
        echo '<h1> No ID provided </h1>';
      }
      ?>
    </form>
    <form method="post" action="<?php echo esc_html( admin_url( 'admin-post.php' ) ); ?>">
      <input type="text" name="eventmap-action" value="delete" style="display:none" />
      <?php
      if ( $id != -1 ) {
        echo '<input type="text" name="id" value="' . $id . '" style="display:none" />';

        wp_nonce_field( );
        submit_button("Delete Event");
      }
      ?>
    </form>

</div><!-- .wrap -->
