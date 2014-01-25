<?php

// Set permalinks on theme activation
// -------------------------------------------------------------
function set_permalinks() {
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure( '/%category%/%postname%/' );
}

add_action( 'after_switch_theme' , 'set_permalinks', 10, 2 );

// Remove Links section
// -------------------------------------------------------------
function remove_links_menu() {
     remove_menu_page( 'link-manager.php' );
} 

add_action( 'admin_menu', 'remove_links_menu' );

// Remove admin bar at front end
// -------------------------------------------------------------
add_filter( 'show_admin_bar', '__return_false' );

// Remove columns from Posts section, add Post ID column
// -------------------------------------------------------------
function my_posts_columns( $defaults ) {
    $defaults['id'] = 'Post ID';
    unset( $defaults['comments'] );
    unset( $defaults['author'] );
    unset( $defaults['tags'] );
    //unset( $defaults['date'] );
    return $defaults;
}

add_filter( 'manage_posts_columns', 'my_posts_columns' );

// Fill Post ID column
// -------------------------------------------------------------
function my_posts_fill_columns( $column_name, $id ) {
	global $post;
	switch ( $column_name ) {
		case 'id':
			echo $id;
			break;
		default:
			break;
	}
}

add_action( 'manage_posts_custom_column', 'my_posts_fill_columns', 10, 2 );

// Remove columns from Pages section, add Page ID column
// -------------------------------------------------------------
function my_pages_columns( $defaults ) {
    $defaults['id'] = 'Page ID';
    unset( $defaults['comments'] );
    unset( $defaults['author'] );
    unset( $defaults['date'] );
    return $defaults;
}

add_filter( 'manage_pages_columns', 'my_pages_columns' );

// Fill Page ID column
// -------------------------------------------------------------
add_action( 'manage_pages_custom_column', 'my_posts_fill_columns', 10, 2 );

// Remove columns from Tags section, add Tag ID column
// -------------------------------------------------------------
function my_post_tag_columns( $defaults ) {
	$defaults['tag_id'] = 'Tag ID';
    unset( $defaults['description'] );
    unset( $defaults['slug'] );
	return $defaults;
}

add_filter( 'manage_edit-post_tag_columns', 'my_post_tag_columns', 5 );

// Fill Tag ID column
// -------------------------------------------------------------
function my_post_tag_fill_columns( $value, $column_name, $id ) {
	if( $column_name == 'tag_id' ) {
		return (int)$id;
	}
}

add_action( 'manage_post_tag_custom_column', 'my_post_tag_fill_columns', 5, 3 );

// Remove columns from Media section
// -------------------------------------------------------------
function my_media_columns( $defaults ) {
    unset( $defaults['comments'] );
    unset( $defaults['author'] );
    unset( $defaults['date'] );
    return $defaults;
}

add_filter( 'manage_media_columns', 'my_media_columns' );

// Custom CSS for admin section
// -------------------------------------------------------------
function custom_admin_css() {
   echo '<style type="text/css">
   		   .column-id, .column-page-id, .column-tag_id { width: 80px !important; text-align: right !important; } 
           #poststuff .acf_postbox label.field_label { color: #333; }
         </style>';
}

add_action( 'admin_head', 'custom_admin_css' );

// Remove annoying meta panels
// -------------------------------------------------------------
if ( is_admin() ) :
	function my_remove_meta_boxes() {
		remove_meta_box('trackbacksdiv', 'post', 'normal');
		remove_meta_box('authordiv', 'page', 'normal');
		remove_meta_box('tagsdiv', 'page', 'normal');
		remove_meta_box('commentstatusdiv', 'page', 'normal');
		remove_meta_box('commentsdiv', 'page', 'normal');
		remove_meta_box('postcustom', 'post', 'normal');
		remove_meta_box('postcustom', 'page', 'normal');
		remove_meta_box('tagsdiv-post_tag','page','normal' );
		remove_meta_box('linktargetdiv', 'link', 'normal');
		remove_meta_box('linkxfndiv', 'link', 'normal');
		remove_meta_box('linkadvanceddiv', 'link', 'normal');
		//remove_meta_box('postexcerpt', 'post', 'normal');
		//remove_meta_box('commentsdiv', 'post', 'normal');
		//remove_meta_box('revisionsdiv', 'post', 'normal');
	}
	add_action( 'admin_menu', 'my_remove_meta_boxes' );
endif;

// Prevent WordPress core updates (do this via Git)
// -------------------------------------------------------------

# 2.3 to 2.7:
add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );

# 2.8 to 3.0:
remove_action( 'wp_version_check', 'wp_version_check' );
remove_action( 'admin_init', '_maybe_update_core' );
add_filter( 'pre_transient_update_core', create_function( '$a', "return null;" ) );

# 3.0:
add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );