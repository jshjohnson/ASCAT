<?php

// Remove auto <p> and <br /> tags in shortcodes
// -------------------------------------------------------------
function my_clean_shortcodes( $content ){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );
    $content = strtr( $content, $array );
    return $content;
}

add_filter( 'the_content', 'my_clean_shortcodes' );

// Flash message 
// -------------------------------------------------------------
function my_shortcode_message( $atts, $content = null ) {
	// extract and set defaults
	extract( shortcode_atts( array(
		'type' => 'info',
	), $atts ) );
	
	$output_string = '<p><strong class="flash ' . esc_attr($type) . '">' . $content . '</strong></p>';
	return force_balance_tags( $output_string );
}

add_shortcode( 'message', 'my_shortcode_message' );

// PDF download 
// -------------------------------------------------------------
function my_shortcode_pdf( $atts, $content = null ) {
	$output_string = '<p class="pdf"><i class="icon-doc icon-large"></i> ' . $content . '<br /><span class="adobe">In order to view PDF documents you will need <a href="http://get.adobe.com/reader/">Adobe PDF Reader</a></span></p>';
	return force_balance_tags($output_string);
}

add_shortcode( 'pdf', 'my_shortcode_pdf' );

// Back link
// -------------------------------------------------------------
function my_shortcode_back( $atts, $content = null ) {
	global $post;
	$output_string = '<div class="back"><a href="' . get_permalink( $post->post_parent ) . '" class="icon-caret-left icon-pad">Back to ' . get_the_title($post->post_parent ) . '</a></div>';
	
	return force_balance_tags( $output_string );
}
add_shortcode( 'back', 'my_shortcode_back' );

// Surrounding panel
// -------------------------------------------------------------
function my_shortcode_panel( $atts, $content = null ) {
	// extract and set defaults
	extract( shortcode_atts( array(
		'type' => 'keyline'
	), $atts ) );

	$output_string = '<article class="island panel ' . $type . '">' . $content . '</article>';
	return force_balance_tags($output_string);
}
add_shortcode( 'panel', 'my_shortcode_panel' );

// Shortcode include
// -------------------------------------------------------------
function my_shortcode_inc_panel() {
	ob_start();
	// include your template e.g. /inc/random-panel.php
	get_template_part( 'parts/panel' );
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}

add_shortcode( 'inc-panel', 'my_shortcode_inc_panel' );