<?php

add_action('init', 'register_resources');

function register_resources() {

	register_post_type('resource', array(
		'label' => 'Resources',
		'description' => '',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'resource', 'with_front' => true),
		'query_var' => true,
		'supports' => array('title', 'editor', 'revisions', 'thumbnail', 'page-attributes', 'post-formats'),
		'labels' => array(
			'name' => 'Resources',
			'singular_name' => 'Resource',
			'menu_name' => 'Resources',
			'add_new' => 'Add Resource',
			'add_new_item' => 'Add New Resource',
			'edit' => 'Edit',
			'edit_item' => 'Edit Resource',
			'new_item' => 'New Resource',
			'view' => 'View Resource',
			'view_item' => 'View Resource',
			'search_items' => 'Search Resources',
			'not_found' => 'No Resources Found',
			'not_found_in_trash' => 'No Resources Found in Trash',
			'parent' => 'Parent Resource',
		)
	));
};

add_action('init', 'register_centres');

function register_centres() {
	register_post_type('centre', array(
		'label' => 'Centres',
		'description' => '',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'centre', 'with_front' => true),
		'query_var' => true,
		'supports' => array('title', 'editor', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'thumbnail', 'author', 'page-attributes', 'post-formats'),
		'labels' => array(
			'name' => 'Centres',
			'singular_name' => 'Centre',
			'menu_name' => 'Centres',
			'add_new' => 'Add Centre',
			'add_new_item' => 'Add New Centre',
			'edit' => 'Edit',
			'edit_item' => 'Edit Centre',
			'new_item' => 'New Centre',
			'view' => 'View Centre',
			'view_item' => 'View Centre',
			'search_items' => 'Search Centres',
			'not_found' => 'No Centres Found',
			'not_found_in_trash' => 'No Centres Found in Trash',
			'parent' => 'Parent Centre',
		)
	));
};

add_action('init', 'register_treatments');

function register_treatments() {
	register_post_type('treatment', array(
		'label' => 'Treatments',
		'description' => '',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'treatment', 'with_front' => true),
		'query_var' => true,
		'supports' => array('title', 'editor', 'excerpt', 'comments', 'thumbnail', 'page-attributes', 'post-formats'),
		'labels' => array(
			'name' => 'Treatments',
			'singular_name' => 'Treatment',
			'menu_name' => 'Treatments',
			'add_new' => 'Add Treatment',
			'add_new_item' => 'Add New Treatment',
			'edit' => 'Edit',
			'edit_item' => 'Edit Treatment',
			'new_item' => 'New Treatment',
			'view' => 'View Treatment',
			'view_item' => 'View Treatment',
			'search_items' => 'Search Treatments',
			'not_found' => 'No Treatments Found',
			'not_found_in_trash' => 'No Treatments Found in Trash',
			'parent' => 'Parent Treatment',
		)
	));
};

add_action('init', 'register_members');

function register_members() {
	register_post_type('oversight-member', array(
		'label' => 'Oversight Members',
		'description' => 'Members of the Trial Steering Committee, Data Monitoring Committee and Trial Management Group. Investigators who are also within these groups should be added as an Investigator (no need to repeat content)',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'oversight-member', 'with_front' => true),
		'query_var' => true,
		'supports' => array('title', 'editor', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'thumbnail', 'author', 'page-attributes', 'post-formats'),
		'labels' => array(
			'name' => 'Oversight Members',
			'singular_name' => 'Oversight Member',
			'menu_name' => 'Oversight Members',
			'add_new' => 'Add Oversight Member',
			'add_new_item' => 'Add New Oversight Member',
			'edit' => 'Edit',
			'edit_item' => 'Edit Oversight Member',
			'new_item' => 'New Oversight Member',
			'view' => 'View Oversight Member',
			'view_item' => 'View Oversight Member',
			'search_items' => 'Search Oversight Members',
			'not_found' => 'No Oversight Members Found',
			'not_found_in_trash' => 'No Oversight Members Found in Trash',
			'parent' => 'Parent Oversight Member',
		)
	));
};

add_action('init', 'register_investigators');

function register_investigators() {
	register_post_type('investigator', array(
		'label' => 'Investigators',
		'description' => '',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'specialists', 'with_front' => 1),
		'query_var' => true,
		'supports' => array('title', 'editor', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'thumbnail', 'author', 'page-attributes', 'post-formats'),
		'labels' => array(
			'name' => 'Investigators',
			'singular_name' => 'Investigator',
			'menu_name' => 'Investigators',
			'add_new' => 'Add Investigator',
			'add_new_item' => 'Add New Investigator',
			'edit' => 'Edit',
			'edit_item' => 'Edit Investigator',
			'new_item' => 'New Investigator',
			'view' => 'View Investigator',
			'view_item' => 'View Investigator',
			'search_items' => 'Search Investigators',
			'not_found' => 'No Investigators Found',
			'not_found_in_trash' => 'No Investigators Found in Trash',
			'parent' => 'Parent Investigator',
		)
	));
}