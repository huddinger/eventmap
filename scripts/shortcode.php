<?php

/*
 * shortcode
 */

 class Shortcode {

   public function init() {
     add_shortcode(  'eventmap', array( $this, 'render' )  );
   }

   public function render( $atts = [], $content = null, $tag = '' ) {
     return "<div class='wrapper'>
              <input id='eventmap-type' value='map' style='display:none;' />
              <div id='eventmap' style='height:400px; width: max'>
             </div>";
   }
 }

 ?>
