<?php

// Slideshow
// -------------------------------------------------------------
function _init_slide_post_type() {

	// Create post type
	//---------------------------
	register_post_type( 'slide',
		array(
			'public' => true,
			'show_ui' => true,
			'capability_type' => 'page',
			'hierarchical' => false,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'menu_position' => 20,
			//'menu_icon' => '/assets/images/icon.png',
			'query_var' => true,
			'rewrite' => array( 'slug' => 'slides', 'with_front' => false ),
			'supports' => array( 'title', 'page-attributes', 'excerpt', 'thumbnail' ),
			'labels' => array(
				'name' => __( 'Slideshow' ),
				'singular_name' => __( 'Slide' ),
				'add_new' => __( 'Add New' ),
				'add_new_item' => __( 'Add New Slide' ),
				'edit' => __( 'Edit' ),
				'edit_item' => __( 'Edit Slide' ),
				'new_item' => __( 'New Slide' ),
				'view' => __( 'View Slide' ),
				'view_item' => __( 'View Slide' ),
				'search_items' => __( 'Search Slides' ),
				'not_found' => __( 'No Slides found' ),
				'not_found_in_trash' => __( 'No Slides found in Trash' )
			)
		)
	);
	
	// Define custom columns
	//---------------------------
	function slide_define_columns( $slide_columns ) {
		$new_columns['cb'] = '<input type="checkbox" />';
		$new_columns['title'] = __('Slide Title');
		$new_columns['slide_text'] = __('Slide Text');
		return $new_columns;
	}
	
	add_filter( 'manage_edit-slide_columns', 'slide_define_columns' );	
	
	// Fill custom columns
	//---------------------------
	function slide_fill_columns( $column_name, $id ) {
		global $post;
		switch ( $column_name ) {
			case 'slide_text':
				echo get_the_excerpt();
				break;
			default:
				break;
		}
	}
	
	add_action( 'manage_slide_posts_custom_column', 'slide_fill_columns', 10, 2 );
	
}

add_action('init', '_init_slide_post_type');

// Panels
// -------------------------------------------------------------
function _init_panel_post_type() {

	// Create post type
	//---------------------------
	register_post_type( 'panel',
		array(
			'public' => true,
			'show_ui' => true,
			'capability_type' => 'page',
			'hierarchical' => false,
			'publicly_queryable' => false,
			'exclude_from_search' => false,
			'menu_position' => 21,
			//'menu_icon' => '/assets/images/icon.png',
			'query_var' => true,
			'rewrite' => array( 'slug' => 'panels', 'with_front' => false ),
			'supports' => array( 'title', 'excerpt', 'thumbnail' ),
			'labels' => array(
				'name' => __( 'Panels' ),
				'singular_name' => __( 'Panel' ),
				'add_new' => __( 'Add New' ),
				'add_new_item' => __( 'Add New Panel' ),
				'edit' => __( 'Edit' ),
				'edit_item' => __( 'Edit Panel' ),
				'new_item' => __( 'New Panel' ),
				'view' => __( 'View Panels' ),
				'view_item' => __( 'View Panel' ),
				'search_items' => __( 'Search Panels' ),
				'not_found' => __( 'No Panels found' ),
				'not_found_in_trash' => __( 'No Panels found in Trash' ),
			)
		)
	);
	
	// Define custom columns
	//---------------------------
	function panel_define_columns( $panel_columns ) {
		$new_columns['cb'] = '<input type="checkbox" />';
		$new_columns['title'] = __('Panel Name');
		$new_columns['panel_text'] = __('Panel Text');
		return $new_columns;
	}
	
	add_filter( 'manage_edit-panel_columns', 'panel_define_columns' );	
	
	// Fill custom columns
	//---------------------------
	function panel_fill_columns( $column_name, $id ) {
		global $post;
		switch ($column_name) {
			case 'panel_text':
				echo get_the_excerpt();
				break;
			default:
				break;
		}
	}
	
	add_action( 'manage_panel_posts_custom_column', 'panel_fill_columns', 10, 2 );
	
	// Fix permalinks
	//---------------------------
	flush_rewrite_rules();
	
}

add_action('init', '_init_panel_post_type');

// Connect Panels to Pages
// -------------------------------------------------------------
add_action( 'init', '_init_panel_connection', 100 );
function _init_panel_connection() {

	// Make sure the Posts 2 Posts plugin is active.
	if ( ! function_exists( 'p2p_register_connection_type' ) )
		return;

	// Keep a reference to the connection type; we'll need it later
	global $connect_panels;

	$connect_panels = p2p_register_connection_type( array(
		'id' => 'connect_panels',
		'title' => 'Sidebar Panels',
		'admin_box' => 'from',
		'from' => 'page',
		'to' => 'panel',
		'sortable' => 'order'
	) );
	
}

// Project-Specific Custom Post Types
// ----------------------------------------------------------------------------------------------------------------------------------------

// Use this as a reference - https://github.com/mattberridge/CPT-Permalinks


// Add Headspace to Custom Post Types
// ----------------------------------------------------------------------------------------------------------------------------------------
/*
function _admit_init_headpspace_boxes() {
 	global $headspace2;
 	if ( function_exists( 'add_meta_box' ) && is_object( $headspace2 ) ) {
		add_meta_box( 'headspacestuff', __( 'HeadSpace', 'headspace' ), array( &$headspace2, 'metabox' ), 'slide', 'normal', 'high' );
	}
}

add_action( 'admin_init', '_admit_init_headpspace_boxes' );
*/