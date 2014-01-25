<?php
/*
Plugin Name: Disable Revisions and Autosave
Plugin URI: http://exper.3drecursions.com/2008/07/25/disable-revisions-and-autosave-plugin/
Description: Disable the Revisions and Autosave functions. By <a href="http://exper.3drecursions.com/">Exper</a>. Original idea and code by <a href="http://lesterchan.net/wordpress/2008/07/17/how-to-turn-off-post-revision-in-wordpress-26/" target="_blank">Lester Chan</a> and <a href="http://www.untwistedvortex.com/2008/06/27/adjust-wordpress-autosave-or-disable-it-completely/" target="_blank">Untwisted Vortex</a>.
*/

define('WP_POST_REVISIONS', false);

function disable_autosave() {
wp_deregister_script('autosave');
}
add_action( 'wp_print_scripts', 'disable_autosave' );
?>
