<?php

// Return if we're in the blog
// -------------------------------------------------------------
function is_blog() {
	return ( is_home() || is_singular( 'post' ) || is_post_type_archive( 'post' ) );
}

// Return is_front() post ID
// -------------------------------------------------------------
function page_id_front() {
	return ( get_option( 'page_on_front' ) );
}

// Return is_home() post ID
// -------------------------------------------------------------
function page_id_home() {
	return ( get_option( 'page_for_posts' ) );
}

// Return primary telephone number
// -------------------------------------------------------------
function primary_telephone() {
	return ( get_option( 'primary_telephone' ) );
}

// Return email address
// -------------------------------------------------------------
function primary_email() {
	return ( get_option( 'primary_email' ) );
}

// Return twitter username
// -------------------------------------------------------------
function twitter_username() {
	return ( get_option( 'twitter_username' ) );
}

// Return if we have pagination
// -------------------------------------------------------------
function show_posts_nav() {
	global $wp_query;
	return ( $wp_query->max_num_pages > 1 );
}

// Return excluded (hidden) pages string
// -------------------------------------------------------------
function excluded_pages_string() {
	return ( get_option( 'nav_excluded_ids' ) );
}

// Return excluded (hidden) pages array
// -------------------------------------------------------------
function excluded_pages_array() {
	return ( explode( ',', excluded_pages_string() ) );
}

// Output link by post ID
// -------------------------------------------------------------
function link_by_id( $post_id ) {
	echo '<a href="' . get_permalink( $post_id ) . '">' . get_the_title( $post_id ) . '</a>';
}

// Output the current taxonomy title
// -------------------------------------------------------------
function current_tax_title() {
	echo get_queried_object()->name;
}

// Output cleaner, linked post thumbnails
// -------------------------------------------------------------
function my_the_post_thumbnail( $post_id, $linked = 1, $type = 'thumbnail' ) {
	$attr = array( 'title' => '', 'alt' => get_the_title( $post_id ), 'class' => 'entry-thumb' );
	if ( $linked ) {
		echo '<a href="' . get_permalink( $post_id ) . '" title="' . get_the_title( $post_id ) . '" rel="bookmark">' . get_the_post_thumbnail( $post_id, $type, $attr ) . '</a>';
	}
	else {
		echo get_the_post_thumbnail( $post_id, $type, $attr );
	}
}

// Output the_excerpt within a <p>
// -------------------------------------------------------------
function my_the_excerpt( $post_id, $p_class = 'excerpt' ) {
	if ( $post_id->post_excerpt!=='' ) {
		echo '<p class="' . $p_class . '">' . $post_id->post_excerpt . '</p>';
	}
}

// Return the root parent ID of a given post
// -------------------------------------------------------------
function get_root_parent_id( $post_id = null ) {
	if ( ! $post_id ) {
		global $post;
		$post_id = $post->ID;
	}
	global $wpdb;
	$parent = $wpdb->get_var( "SELECT post_parent FROM $wpdb->posts WHERE post_type='page' AND post_status='publish' AND ID = '$post_id'" );
	if ( $parent == 0 ) return $post_id;
	else return get_root_parent_id( $parent );
}

// Return all sub pages of a given post
// -------------------------------------------------------------
function get_sub_pages( $post_id, $post_type = 'page' ) {
	$args = array(
		'post_type' => $post_type,
		'child_of' => $post_id,
		'parent' => $post_id,
		'sort_order' => 'ASC',
		'sort_column' => 'menu_order',
		'exclude' => excluded_pages_array(),
	);	
	return get_pages( $args );
}

// Return all root (top-level) posts of any given post type
// -------------------------------------------------------------
function get_root_pages( $post_type = 'page' ) {
	$args = array(
		'post_type' => $post_type,
		'parent' => 0,
		'order' => 'ASC',
		'orderby' => 'menu_order',
		'numberposts' => -1,
		'exclude' => excluded_pages_array(),
	);	
	return get_pages( $args );
}