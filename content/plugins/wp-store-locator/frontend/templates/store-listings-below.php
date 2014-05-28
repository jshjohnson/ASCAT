<?php 
// $output = $this->get_custom_css(); 

$show_results_filter = $this->settings['results_dropdown'];
$results_filter_class = ( $show_results_filter ) ? '' : 'wpsl-no-results';  
    $title = get_field('alternative_title');
    if($title == ''):
        $title = get_the_title();
    endif; 

if ( $this->settings['reset_map'] ) { 
    
    /* If the control position is set to right, we need to adjust to right space to make sure it doesn't cover map controls.  */
    if ( $this->settings['control_position'] == 'right' ) {
        $align_class = 'class="wpsl-right-controls"';
    } else {
        $align_class = '';
    }
    
    $output .= '<div class="wpsl-gmap-wrap">' . "\r\n";
    $output .= '<div id="wpsl-reset-map" ' . $align_class . '>' . esc_html_x( stripslashes( $this->settings['reset_label'] ), 'wpsl' ) . '</div>' . "\r\n";
    $output .= '<div id="wpsl-gmap"></div>' . "\r\n";
    $output .= '</div>' . "\r\n";
} else {
    $output .= '<header class="content__header content__header--tall">' . "\r\n";
    $output .= '<div id="wpsl-gmap" class="map"></div>' . "\r\n";
    $output .= '<div class="content__overlay content__overlay--subtle">' . "\r\n";
    $output .= '<div class="container"><h1 class="page-heading page-heading--alt">' . $title . '</h1></div>' . "\r\n";
    $output .= '</div>' . "\r\n";
    $output .= '</header>' . "\r\n";
}

$output .= '<div id="wpsl-wrap" class="wpsl-store-below">' . "\r\n";
$output .= '<div class="wpsl-search clearfix' . $results_filter_class . '">' . "\r\n";
$output .= '<div id="wpsl-search-wrap" class="container">' . "\r\n";
$output .= '<div class="grid">' . "\r\n";
$output .= '<div class="wpsl-input grid__cell unit-1-2--bp2">' . "\r\n";
$output .= '<label for="wpsl-search-input">' . esc_html_x( stripslashes( $this->settings['search_label'] ), 'wpsl' ) . '</label>' . "\r\n";
$output .= '<input autocomplete="off" id="wpsl-search-input" type="text" value="" name="wpsl-search-input" />' . "\r\n";
$output .= '</div>' . "\r\n";
$output .= '<div class="wpsl-select-wrap grid__cell unit-1-2--bp2">' . "\r\n";
$output .=      '<div id="wpsl-radius">' . "\r\n";
$output .=          '<label for="wpsl-radius-label">' . esc_html_x( stripslashes( $this->settings['radius_label'] ), 'wpsl' ).'</label>' . "\r\n";
$output .=          '<select autocomplete="off" id="wpsl-radius-label" class="wpsl-dropdown" name="wpsl-radius">' . "\r\n";
$output .=              $this->get_dropdown_list( 'search_radius' );
$output .=          '</select>' . "\r\n";
$output .=      '</div>' . "\r\n";

if ( $show_results_filter ) {
    $output .=          '<div id="wpsl-results">' . "\r\n";
    $output .=              '<label for="wpsl-results-label">' . esc_html_x( stripslashes( $this->settings['results_label'] ), 'wpsl' ) . '</label>' . "\r\n";
    $output .=              '<select autocomplete="off" id="wpsl-results-label" class="wpsl-dropdown" name="wpsl-results">' . "\r\n";
    $output .=                  $this->get_dropdown_list( 'max_results' );
    $output .=              '</select>' . "\r\n";
    $output .=          '</div>' . "\r\n";
} 

$output .=      '<input id="wpsl-search-btn" type="submit" value='. esc_attr_x( stripslashes( $this->settings['search_btn_label'] ), 'wpsl' ) . '>' . "\r\n";
$output .=      '</div>' . "\r\n";
$output .=   '</div>' . "\r\n";
$output .= '</div>' . "\r\n";
$output .= '</div>' . "\r\n";
    

$output .= '<div id="wpsl-result-list" class="content__container container">' . "\r\n";
$output .=      '<div id="wpsl-stores">' . "\r\n";
$output .=          '<h3>Nearest Centres</h3><ul></ul>' . "\r\n";
$output .=      '</div>' . "\r\n";
$output .=      '<div id="wpsl-direction-details">' . "\r\n";
$output .=          '<ul></ul>' . "\r\n";
$output .=      '</div>' . "\r\n";
$output .= '</div>' . "\r\n";

$output .= '</div>' . "\r\n";

return $output;