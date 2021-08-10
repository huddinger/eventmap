<?php

/*
 * shortcode
 */

class Shortcode {

  public function init() {
    add_shortcode(  'eventmap', array( $this, 'render' )  );
  }

  public function render( $atts = [], $content = null, $tag = '' ) {
    $atts = array_change_key_case( (array) $atts, CASE_LOWER );

    $table = $atts['table'] ?? false;

    $content = "<div class='wrapper'>
                 <input id='eventmap-type' value='map' style='display:none;' />
                 <div id='eventmap' style='height:400px; width: max'>";


    $content .= "</div>";

    return $content;

  }
}

 ?>
