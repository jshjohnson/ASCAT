<?php
/*
	Plugin Name: Admin Collapse Subpages
	Plugin URI: http://alexchalupka.com/projects/wordpress/admin-collapse-subpages/
	Description: jQuery-powered plugin that allows expansion/collapse of subpages within admin (/edit.php?post_type=page) menu.
	Author: Alex Chalupka
	Author URI: http://alexchalupka.com/
	Version: 1.0
*/

/*  Copyright 2011  Alex Chalupka  (email : lupka31@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!class_exists('adminCollapseSubpages')) {

	class adminCollapseSubpages {
		
		function __construct() {

			define('COLLAPSE_SUBPAGES_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
			
			if ( is_admin() ) {
				
				//make sure jquery is loaded
				wp_enqueue_script('jquery');
				
				//cookie script for saving collapse states 
				wp_enqueue_script('jquery-cookie', COLLAPSE_SUBPAGES_PATH .'js/jquery.cookie.js', 'jquery', '1.0');
				
				//main collapse pages script
				wp_enqueue_script('admin_collapse_subpages', COLLAPSE_SUBPAGES_PATH .'js/admin_collapse_subpages.js', FALSE, '2.1');
			
				//Load Styles
				wp_enqueue_style('admin_collapse_subpages_styles', COLLAPSE_SUBPAGES_PATH .'css/style.css', false, '1.0', 'screen');
				
			}
		}
	}

	global $collapsePages;
	$collapsePages = new adminCollapseSubpages();
}

?>