<div class="wrap">

    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

    <input id='eventmap-type' value='event' style='display:none;' />


    <form method="post" action="<?php echo esc_html( admin_url( 'admin-post.php' ) ); ?>">
      <input type="text" name="eventmap-action" value="add" style="display:none" />

      <table>
        <tr><td> Titel:     </td><td> <input type="text" name="title" />  <br /> </td></tr>
        <tr><td> Latitude:  </td><td> <input type="text" name="lat"  id="eventmap-lat" />    <br /> </td></tr>
        <tr><td> Longitude: </td><td> <input type="text" name="lon"  id="eventmap-lon" />    <br /> </td></tr>
      </table>

      <?php
          wp_nonce_field( );
          submit_button();
      ?>

    </form>

</div><!-- .wrap -->
