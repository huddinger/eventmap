<div class="wrap">

    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>


    <form method="post" action="<?php echo esc_html( admin_url( 'admin-post.php' ) ); ?>">
      <table>
        <tr><td> Titel:     </td><td> <input type="text" name="title" />  <br /> </td></tr>
        <tr><td> Latitude:  </td><td> <input type="text" name="lat" />    <br /> </td></tr>
        <tr><td> Longitude: </td><td> <input type="text" name="lon" />    <br /> </td></tr>
      </table>

      <?php
          wp_nonce_field( );
          submit_button();
      ?>

    </form>

</div><!-- .wrap -->
