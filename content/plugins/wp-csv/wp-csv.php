<?php
/*
Plugin Name: WP CSV
Plugin URI: http://cpkwebsolutions.com/plugins/wp-csv
Description: A powerful, yet easy to use, CSV Importer/Exporter for Wordpress posts and pages. 
Version: 1.6.3
Author: CPK Web Solutions
Author URI: http://cpkwebsolutions.com
Text Domain: wp-csv

	LICENSE

	Copyright 2012  CPK Web Solutions  (email : paul@cpkwebsolutions.com )

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

// Load libraries
spl_autoload_register( 'spl_autoload_classes' );

function spl_autoload_classes( $name ) {

	if ( class_exists( $name ) ) return FALSE;

	$folders = Array( '' );
	
	if ( is_array( $folders ) && !empty( $folders ) ) {
		foreach( $folders as $folder ) {
			$file = dirname( __FILE__ ) . "/{$folder}{$name}.php";
			if ( file_exists( $file ) ) {
				require_once( $file );
			}
		} # End foreach
	} # End if

}

// Initialise main class
if ( !class_exists( 'CPK_WPCSV' ) ) {

	class CPK_WPCSV {

		private $view;
		private $csv;
		private $wpcsv;
		private $backup_url;
		private $settings;
		private $option_name = '_pws_wpcsv_settings';


		const IMPORT_FILE_NAME = 'wpcsv-import.csv';
		const EXPORT_FILE_NAME = 'wpcsv-export.csv';

		const ERROR_MISSING_POST_ID = 1;
		const ERROR_MISSING_POST_PARENT = 2;
		const ERROR_MISSING_AUTHOR = 3;
		const ERROR_INVALID_TAXONOMY_TERM = 4;

		public function __construct( ) { // Constructor

			ob_start( ); # For download... TODO: refactor MVC framework so that view functions run earlier

			if ( !session_id( ) ) session_start( );
			$this->view = new CPK_WPCSV_View( );
			$this->csv = new CPK_WPCSV_CSV( );
			$this->log = new CPK_WPCSV_Log_Model( );

			$backup_url = '';

			$settings = Array( 
				'delimiter' => ',',
				'enclosure' => '"',
				'date_format' => 'US',
				'encoding' => 'UTF-8',
				'csv_path' => $this->get_csv_folder( ),
				'export_hidden_custom_fields' => '1',
				'include_field_list' => Array( '*' ),
				'exclude_field_list' => Array( ),
				'post_type' => NULL,
				'post_status' => NULL,
				'limit' => 1000,
				'post_fields' => Array( 'ID', 'post_date', 'post_status', 'post_title', 'post_content', 'post_excerpt', 'post_parent', 'post_name', 'post_type', 'ping_status', 'comment_status', 'menu_order', 'post_author' ),
				'mandatory_fields' => Array( 'ID', 'post_date', 'post_title' ),
				'access_level' => 'administrator'
			);

			add_option( $this->option_name, $settings ); // Does nothing if already exists

			$this->settings = get_option( $this->option_name );
			$this->settings['version'] = '1.6.3';

			$current_keys = Array( );
			if ( is_array( $this->settings ) ) {
				$current_keys = array_keys( $this->settings );
			}

			foreach( array_keys( $settings ) as $key ) {
				if ( !in_array( $key, $current_keys ) || empty( $this->settings[ $key ] ) ) {
					$this->settings[ $key ] = $settings[$key];
				}
			}
			
			$this->wpcsv = new CPK_WPCSV_Engine( $this->settings );

			$this->save_settings( );

			$this->csv->delimiter = $this->settings['delimiter'];
			$this->csv->enclosure = $this->settings['enclosure'];
			$this->csv->encoding = $this->settings['encoding'];
			
			add_action( 'wp_ajax_process_export', Array( $this, 'process_export' ) );
			add_action( 'wp_ajax_process_import', Array( $this, 'process_import' ) );

		}

		public function set_settings( $settings ) {
			$this->settings = $settings;
			$this->save_settings( );
		}

		public function folder_writable( $path ) {
			return ( is_dir( $path ) && is_writable( $path ) );
		}

		public function file_writable( $path ) {
			if ( $this->folder_writable( $path ) ) {
				$success = file_put_contents( "{$path}/.wpcsv-test", 'Just a test file.  Delete this file if you read this.' );
			}

			if ( $success ) {
				unlink( "{$path}/.wpcsv-test" );
				return TRUE;
			}
			
		}

		public function add_htaccess( $path ) {
			if ( $this->folder_writable( $path ) ) {
				return file_put_contents( "{$path}/.htaccess", 'Deny from all' );
			}
		}

		public function get_paths( $sub_folder = '' ) {

			$uploads_dir = wp_upload_dir( );

			# In order of preference
			return Array( 
				sys_get_temp_dir( ) . '/' . $sub_folder,
				ABSPATH . $sub_folder,
				WP_CONTENT_DIR . '/' . $sub_folder,
				$uploads_dir['basedir'] . '/' . $sub_folder
			);
		}

		public function get_csv_folder( ) {

			$chosen_folder = '';

			$paths = $this->get_paths( 'wpcsv_backups' );

			foreach( $paths as $p ) {
				if ( ( !file_exists( $p ) && mkdir( $p, 0755 ) ) || $this->folder_writable( $p ) ) {
					$chosen_folder = $p;
					break;
				}
			}

			# This will create .htaccess files below the web root (ie sys_temp, but shouldn't cause any harm)
			if ( $chosen_folder && $this->add_htaccess( $chosen_folder ) ) {
				return $chosen_folder;
			}

		}

		public function admin_pages( ) {

			$view_name = $_REQUEST['action'];

			if ( $_POST['action'] == 'export' ) {
				$_POST['imagefolder'] = trim( $_POST['imagefolder'], '/ ' );
				$imagefolder = WP_CONTENT_DIR . '/uploads/' . $_POST['imagefolder'];
				if ( is_dir( $imagefolder ) ) {
					$this->settings['imagefolder'] = $_POST['imagefolder'];
				} else {
					$_POST['action'] = 'settings';
					$error = "ERROR - Folder could not be opened: $imagefolder";
					$imagefolder = $_POST['imagefolder'];
				}
				$this->settings['date_format'] = $_POST['date_format'];
				$this->settings['encoding'] = $_POST['encoding'];

				$this->settings['delimiter'] = substr( stripslashes( $_POST['delimiter'] ), 0, 1 );
				$this->settings['enclosure'] = substr( stripslashes( $_POST['enclosure'] ), 0, 1 );

				if ( isset( $_POST['export_hidden_custom_fields'] ) ) {
					$this->settings['export_hidden_custom_fields'] = 1;
				} else {
					$this->settings['export_hidden_custom_fields'] = 0;
				}
				$this->settings['include_field_list'] = preg_split( '/(,|\s)/', $_POST['include_field_list'] );
				
				$this->settings['exclude_field_list'] =  preg_split( '/(,|\s)/', $_POST['exclude_field_list'] );
				$this->settings['post_type'] = ( !empty( $_POST['custom_post'] ) ) ? $_POST['custom_post'] : NULL;
				$this->settings['post_status'] = ( !empty( $_POST['post_status'] ) ) ? $_POST['post_status'] : NULL;
				
				$this->settings['access_level'] = ( !empty( $_POST['access_level'] ) ) ? $_POST['access_level'] : 'administrator';
				$this->settings['limit'] = 1000;

				$this->save_settings();
			}
			
			if ( $_POST['action'] == 'import' && $_FILES['uploadedfile']['name'] == '' ) {
				$error = 'You must select a file to upload and import.';
				$view_name = 'export';
			}

			$subdir = '/uploads';
			$filename = self::EXPORT_FILE_NAME;

			switch ( $view_name ) {
				case 'import':
					move_uploaded_file( $_FILES['uploadedfile']['tmp_name'], $this->settings['csv_path'] . '/' . self::IMPORT_FILE_NAME );
					$options['file_name'] = $_FILES['uploadedfile']['name'];
					$options['error'] = $error;
					$this->view->page( 'import', $options );
					break;
				case 'report':
					$this->log->add_message( __( "Limit: {$this->settings['limit']} (This is how many rows WP CSV can process at a time based on available server resources.  You should expect it to fluctuate.)", 'wp-csv' ), 'Info' );
					$this->log->store_messages( );
					$options = array_merge( Array( 'info_messages' => $this->log->get_message_list( 'Info' ), 'warning_messages' => $this->log->get_message_list( 'Warning' ), 'error_messages' => $this->log->get_message_list( 'Error' ) ), $this->settings );
					$options['error'] =  $error;
					$this->view->page( 'report', $options );
					break;
				case 'export':
					$this->prepare_export( );
					$enc = $this->settings['encoding'];
					$url = site_url( ) . "/wp-admin/tools.php?page=wp-csv.php&action=download&file=$filename&enc=$enc";
					$options = array_merge( Array( 'export_link' => $url ), $this->settings );
					$options['error'] = $error;
					$this->view->page( 'export', $options );
					break;
				case 'download':
					$this->view->page( 'download', $this->settings );
					break;
				default:
					$this->log->empty_table( );
					$max_memory = ini_get( 'memory_limit' );
					$max_execution_time = $this->wpcsv->get_max_execution_time( );
					$memory_usage = $this->wpcsv->get_memory_usage( );
					$this->log->add_message( __( "Max Memory: {$max_memory} (This is a server setting.)", 'wp-csv' ), 'Info' );
					$this->log->add_message( __( "Max Execution Time: {$max_execution_time} (This is a server setting.)", 'wp-csv' ), 'Info' );
					$this->log->add_message( __( "Initial Memory Usage: {$memory_usage}% (This is on the settings page, before the plugin does any real work)", 'wp-csv' ), 'Info' );
					$this->log->store_messages( );
					
					$options = $this->settings;
					global $wpdb;
					$sql = "SELECT count(ID) FROM {$wpdb->posts} WHERE post_status IN ( 'publish', 'draft', 'future' )";
					$options['total_rows'] = $wpdb->get_var( $sql );
					$options['error'] =  $error;
					$sql = "SELECT DISTINCT post_status FROM {$wpdb->posts}";
					$options['post_status_list'] = array_unique( array_merge( $wpdb->get_col( $sql ), Array( 'publish', 'draft', 'future', 'private', 'trash' ) ) );
					$this->view->page( 'settings', $options );
			}
		}

		public function file_permissions_problem( ) {
			if ( !$this->folder_writable( $this->settings['csv_path'] ) ) return TRUE;
			if ( !$this->file_writable( $this->settings['csv_path'] ) ) return TRUE;
		}

		public function display_notices() {

			if ( !$this->folder_writable( $this->settings['csv_path'] ) || !$this->file_writable( $this->settings['csv_path'] ) ) {
				$this->settings['csv_path'] = $this->get_csv_folder( );
				$this->save_settings( );
			}

			if ( $this->file_permissions_problem( ) && $_GET['page'] == 'wp-csv.php' ) {
				$paths = $this->get_paths( );

				$path_html = '';
				if ( is_array( $paths ) && !empty( $paths ) ) {
					foreach( $paths as $path ) {
						$path_html .= "<li>{$path}</li>";
					} # End foreach
				} # End if
				$html = "<div class='error'>
				<h4>WP CSV</h4><p>There is a problem with the file permissions on your server.  For the following locations, WP CSV was unable to create the 'wpcsv_backups' folder and/or unable to create a new file within that folder:</p><blockquote><ul>$path_html</ul></blockquote><p>These locations are listed in order of preference (from most secure to least secure, although precautions are taken to protect your data when the files are publicly accessible).</p>
				</div>";
				echo $html;
			}
			
		}

		public function save_settings( ) {
			update_option( $this->option_name, $this->settings );
			// A bit ugly but necessary, refactor later
			$this->csv->delimiter = $this->settings['delimiter'];
			$this->csv->enclosure = $this->settings['enclosure'];
			$this->csv->encoding = $this->settings['encoding'];

			$this->wpcsv->settings = $this->settings;
		}

		public function prepare_export( ) {
			$this->wpcsv->prepare( );
		}
		
		public function process_export( ) {
			
			$start 	= isset( $_GET['start'] ) ? $_GET['start'] : 0;

			$total = $this->wpcsv->get_total( );

			if ( $total == 0 ) {
				echo json_encode( Array( 'position' => 0, 'percentagecomplete' => -1 ) );
				die( );
			}

			$include_headings = ( $start == 0 );

			$number_processed = $this->wpcsv->export( $include_headings );

			$position = $start + $number_processed;
			$ret_percentage = round( ( ( $position - 1 ) / $total ) * 100 );

			$errors = ob_get_clean( );

			if ( $errors ) {
				$this->log->add_message( $errors, 'Error' );
				$this->log->store_messages( );
				ob_clean( ); # Run again to ensure no extra output was created
			}

			echo json_encode( Array( 'position' => $position, 'percentagecomplete' => $ret_percentage, 'errors' => $errors ) );
			die( );
		}
		
		public function process_import( ) {

			$file = $this->settings['csv_path'] . '/' . self::IMPORT_FILE_NAME;
			
			$start = $_GET['start'];
			
			$this->csv->delimiter = $this->settings['delimiter'];

			$this->csv->enclosure = $this->settings['enclosure'];

			$total = ( $_GET['lines'] == 0 ) ? $this->csv->line_count( $file ) : $_GET['lines'];
			
			$rows = $this->csv->load( $file, $start, $this->settings['limit'] );
			
			$number_processed = $this->wpcsv->import( $rows );

			$position = $start + $number_processed;
			
			$ret_percentage = round( ( ( $position - 1 ) / $total ) * 100 );

			$errors = ob_get_clean( );

			if ( $errors ) {
				$this->log->add_message( 'Error Message', 'Error', $errors );
				$this->log->store_messages( );
				ob_clean( ); # Run again to ensure no extra output was created
			}

			echo json_encode( Array( 'position' => $position, 'percentagecomplete' => $ret_percentage, 'lines' => $total ) );
			die( );
		}
		
		public function cpk_wpcsv_admin_page( ) {
			global $cpk_wpcsv;
			if ( !isset( $cpk_wpcsv ) ) {
				return;
			}
			if ( function_exists( 'add_submenu_page' ) ) {
				add_submenu_page( 'tools.php', __( 'WP CSV' ), __( 'WP CSV' ), $this->settings['access_level'], basename(__FILE__), array( &$cpk_wpcsv, 'admin_pages' ) );
			}
		}	

	}
}

// Instantiate

if ( !function_exists( "cpk_wpcsv_admin_page" ) ) {
}

if ( !function_exists( "cpk_wpcsv_header" ) ) {
	function cpk_wpcsv_header( ) {
		$ecsvi_url = plugins_url( '/css/cpk_wpcsv.css', __FILE__ );
		echo '<link type="text/css" rel="stylesheet" href="' . $ecsvi_url . '" />' . "\n";
	}
}

if ( !function_exists( 'cpk_add_settings_link' ) ) {
	function cpk_add_settings_link( $links, $file ) {
		if ( $file == 'wp-csv/wp-csv.php' ) {
			$settings_link = "<a href='tools.php?page=wp-csv.php'>Settings</a>";
			$links = array_merge( $links, array( $settings_link ) );
		}

		return $links;
	}
}	

if ( !function_exists( 'cpk_load_text_domain' ) ) {
	function cpk_load_text_domain( ) {
		load_plugin_textdomain( 'wp-csv', FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	}
}

//Actions and Filters	
if ( class_exists( "CPK_WPCSV" ) ) {
global $cpk_wpcsv;
$cpk_wpcsv = new CPK_WPCSV( );

add_action( 'admin_menu', Array( $cpk_wpcsv, 'cpk_wpcsv_admin_page' ) );
add_action( 'admin_head', 'cpk_wpcsv_header' );
add_filter( 'plugin_action_links', 'cpk_add_settings_link', 10, 2 );
add_action( 'plugins_loaded', 'cpk_load_text_domain' );
add_action( 'admin_notices', Array( $cpk_wpcsv, 'display_notices' ) );
}
