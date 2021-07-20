<div class="wrap">

  <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

  <input id='eventmap-type' value='options' style='display:none;' />

  <form method="post" action="<?php echo esc_html( admin_url( 'admin-post.php' ) ); ?>">
    <input type="text" name="eventmap-action" value="edit-options" style="display:none" />
    <?php
      $options = get_option('eventmap-options');
      $lat  = $options['lat'] ?? 0;
      $lon  = $options['lon'] ?? 0;
      $zoom = $options['zoom'] ?? 0;
    ?>
    <table>
      <tr><td> Latitude:     </td><td> <input type="text" name="lat" id="eventmap-lat" value="<?php echo $lat ?>" />  <br /> </td></tr>
      <tr><td> Longitude:  </td><td> <input type="text" name="lon"  id="eventmap-lon" value="<?php echo $lon ?>" />    <br /> </td></tr>
      <tr><td> Zoom Level: </td><td> <input type="text" name="zoom"  id="eventmap-zoom" value="<?php echo $zoom ?>" />    <br /> </td></tr>
    </table>

    <?php
        wp_nonce_field( );
        submit_button();
    ?>
  </form>
</div>
