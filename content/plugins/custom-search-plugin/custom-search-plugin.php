<?php
/*
Plugin Name: Custom Search
Plugin URI: http://bestwebsoft.com/plugin/
Description: Custom Search Plugin designed to search for site custom types.
Author: BestWebSoft
Version: 1.18
Author URI: http://bestwebsoft.com/
License: GPLv2 or later
*/
 
/*  © Copyright 2013  BestWebSoft  ( http://support.bestwebsoft.com )

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

require_once( dirname( __FILE__ ) . '/bws_menu/bws_menu.php' );

/* Function are using to add on admin-panel Wordpress page 'bws_plugins' and sub-page of this plugin */
if ( ! function_exists( 'add_cstmsrch_admin_menu' ) ) {
	function add_cstmsrch_admin_menu() {
		add_menu_page( 'BWS Plugins', 'BWS Plugins', 'manage_options', 'bws_plugins', 'bws_add_menu_render', plugins_url("images/px.png", __FILE__ ), 1001 );
		add_submenu_page( 'bws_plugins', __( 'Custom Search Settings', 'custom-search' ), __( 'Custom search', 'custom-search' ), 'manage_options', "custom_search.php", 'cstmsrch_settings_page' );
	}
}

/* Function create column in table wp_options for option of this plugin. If this column exists - save value in variable. */
if( ! function_exists( 'register_cstmsrch_settings' ) ) {
	function register_cstmsrch_settings() {
		global $wpmu, $cstmsrch_options, $bws_plugin_info;

		if ( function_exists( 'get_plugin_data' ) && ( ! isset( $bws_plugin_info ) || empty( $bws_plugin_info ) ) ) {
			$plugin_info = get_plugin_data( __FILE__ );	
			$bws_plugin_info = array( 'id' => '81', 'version' => $plugin_info["Version"] );
		};

		$cstmsrch_options_default = array();

		/* Install the option defaults */
		if ( 1 == $wpmu ) {
			if ( ! get_site_option( 'cstmsrch_options' ) ) {
				if ( false !== get_site_option( 'bws_custom_search' ) ) {
					$cstmsrch_options_default = get_site_option( 'bws_custom_search' );
					delete_site_option( 'bws_custom_search' );				
				}
				add_site_option( 'cstmsrch_options', $cstmsrch_options_default );
			}
		} else {
			if ( false !== get_option( 'bws_custom_search' ) ) {
				$cstmsrch_options_default = get_option( 'bws_custom_search' );
				delete_option( 'bws_custom_search' );
			}
			if ( ! get_option( 'cstmsrch_options' ) )
				add_option( 'cstmsrch_options', $cstmsrch_options_default );
		}

		if ( 1 == $wpmu )
			$cstmsrch_options = get_site_option( 'cstmsrch_options' );
		else
			$cstmsrch_options = get_option( 'cstmsrch_options' );
	}
}

/* Function check if plugin is compatible with current WP version  */
if ( ! function_exists ( 'cstmsrch_version_check' ) ) {
	function cstmsrch_version_check() {
		global $wp_version;
		$plugin_data	=	get_plugin_data( __FILE__, false );
		$require_wp		=	"3.0"; /* Wordpress at least requires version */
		$plugin			=	plugin_basename( __FILE__ );
	 	if ( version_compare( $wp_version, $require_wp, "<" ) ) {
			if ( is_plugin_active( $plugin ) ) {
				deactivate_plugins( $plugin );
				wp_die( "<strong>" . $plugin_data['Name'] . " </strong> " . __( 'requires', 'custom-search' ) . " <strong>WordPress" . $require_wp . " </strong> " . __( 'or higher, that is why it has been deactivated! Please upgrade WordPress and try again.', 'custom-search') . "<br /><br />" . __( 'Back to the WordPress', 'custom-search') . " <a href='" . get_admin_url( null, 'plugins.php' ) . "'>" . __( 'Plugins page', 'custom-search') . "</a>." );
			}
		}
	}
}

/* Function adds translations in this plugin */
if ( ! function_exists ( 'cstmsrch_init' ) ) {
	function cstmsrch_init() {
		load_plugin_textdomain( 'custom-search', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		load_plugin_textdomain( 'bestwebsoft', false, dirname( plugin_basename( __FILE__ ) ) . '/bws_menu/languages/' );
	}
}

/* Function ащк пуеештп wp_options for option of this plugin. If this column exists - save value in variable. */
if ( ! function_exists( 'cstmsrch_options_global' ) ) {
	function cstmsrch_options_global() {
		global $wpmu, $cstmsrch_options;
		if ( 1 == $wpmu )
			$cstmsrch_options = get_site_option( 'cstmsrch_options' ); 
		else
			$cstmsrch_options = get_option( 'cstmsrch_options' );
	}
}

/* Function are using to register styles and scripts */
if ( ! function_exists ( 'cstmsrch_admin_head' ) ) {
	function cstmsrch_admin_head() {
		global $wp_version;
		if ( $wp_version < 3.8 )
			wp_enqueue_style( 'cstmsrchStylesheet', plugins_url( 'css/style_wp_before_3.8.css', __FILE__ ) );	
		else
			wp_enqueue_style( 'cstmsrchStylesheet', plugins_url( 'css/style.css', __FILE__ ) );
		if ( isset( $_GET['page'] ) && $_GET['page'] == "bws_plugins" )
			wp_enqueue_script( 'bws_menu_script', plugins_url( 'js/bws_menu.js', __FILE__ ) );
	}
}

if ( ! function_exists( 'cstmsrch_searchfilter' ) ) {
	function cstmsrch_searchfilter( $query ) {
		global $cstmsrch_options;
		if ( $query->is_search ) {
			$cstmsrch_post_standart_types	=	array( 'post', 'page', 'revision', 'attachment', 'nav_menu_item' );
			$cstmsrch_result_merge			=	array_merge( $cstmsrch_post_standart_types, $cstmsrch_options );
			$query->set( 'post_type', $cstmsrch_result_merge );
		}
		return $query;
	}
}

/* Function is forming page of the settings of this plugin */
if ( ! function_exists( 'cstmsrch_settings_page' ) ) {
	function  cstmsrch_settings_page() {
	global $wpdb, $cstmsrch_options;
	$cstmsrch_necessary_variables = array();
	if ( isset( $_REQUEST['cstmsrch_submit'] ) && check_admin_referer( plugin_basename( __FILE__ ), 'cstmsrch_nonce_name' ) ) {
		$cstmsrch_options = isset( $_REQUEST['cstmsrch_options'] ) ? $_REQUEST['cstmsrch_options'] : array() ;
		update_option( 'cstmsrch_options', $cstmsrch_options );
		$message = __( "Settings saved" , 'custom-search' );
	}
	$cstmsrch_result = $wpdb->get_results( "SELECT post_type FROM ". $wpdb->posts ." WHERE post_type NOT IN ('revision', 'page', 'post', 'attachment', 'nav_menu_item') GROUP BY post_type" );
	?>
	<div class="wrap">
		<div class="icon32 icon32-bws" id="icon-options-general"></div>
		<h2><?php _e( 'Custom Search Settings', 'custom-search' ); ?></h2>
		<div class="updated fade" <?php if ( ! isset( $_REQUEST['cstmsrch_submit'] ) ) echo "style=\"display:none\""; ?>><p><strong><?php echo $message; ?></strong></p></div>
		<div id="cstmsrch_settings_notice" class="updated fade" style="display:none"><p><strong><?php _e( "Notice:", 'custom-search' ); ?></strong> <?php _e( "The plugin's settings have been changed. In order to save them please don't forget to click the 'Save Changes' button.", 'custom-search' ); ?></p></div>
		<?php if ( 0 < count( $cstmsrch_result ) ) { ?>
			<form method="post" action="" style="margin-top: 10px;" id="cstmsrch_settings_form">
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><?php _e( 'Enable Custom search for:', 'custom-search' ); ?> </th>
						<td>
							<?php
							foreach ( $cstmsrch_result as $key => $value ) { ?>
								<label><input type="checkbox" <?php echo ( in_array( $value->post_type, $cstmsrch_options ) ?  'checked="checked"' : "" ); ?> name="cstmsrch_options[]" value="<?php echo $value->post_type; ?>"/><span style="text-transform: capitalize; padding-left: 5px;"><?php echo $value->post_type; ?></span></label><br />
							<?php } ?>
						</td>
					</tr>
				</table>
				<input type="hidden" name="cstmsrch_submit" value="submit" />
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e( 'Save Changes' , 'custom-search' ) ?>" />
				</p>
				<?php wp_nonce_field( plugin_basename( __FILE__ ), 'cstmsrch_nonce_name' ); ?>
			</form>
		<?php } else { ?>
			<?php _e( 'No custom post type found.', 'custom-search' ); ?>
		<?php } ?>
		<br />
		<div class="bws-plugin-reviews">
			<div class="bws-plugin-reviews-rate">
			<?php _e( 'If you enjoy our plugin, please give it 5 stars on WordPress', 'custom-search' ); ?>:<br/>
			<a href="http://wordpress.org/support/view/plugin-reviews/custom-search-plugin" target="_blank" title="Custom Search reviews"><?php _e( 'Rate the plugin', 'custom-search' ); ?></a><br/>
			</div>
			<div class="bws-plugin-reviews-support">
			<?php _e( 'If there is something wrong about it, please contact us', 'custom-search' ); ?>:<br/>
			<a href="http://support.bestwebsoft.com">http://support.bestwebsoft.com</a>
			</div>
		</div>
		</div>
	<?php
	}
}

/* Positioning in the page. End. */
if ( !function_exists( 'cstmsrch_action_links' ) ) {
	function cstmsrch_action_links( $links, $file ) {
		/* Static so we don't call plugin_basename on every plugin row. */
		static $this_plugin;
		if ( ! $this_plugin ) $this_plugin = plugin_basename( __FILE__ );

		if ( $file == $this_plugin ) {
			$settings_link = '<a href="admin.php?page=custom_search.php">' . __( 'Settings', 'custom-search' ) . '</a>';
			array_unshift( $links, $settings_link );
		}
		return $links;
	}
} /* End function cstmsrch_action_links */

/* Function are using to create link 'settings' on admin page. */
if ( !function_exists( 'cstmsrch_links' ) ) {
	function cstmsrch_links( $links, $file ) {
		$base = plugin_basename( __FILE__ );
		if ( $file == $base ) {
			$links[]	=	'<a href="admin.php?page=custom_search.php">' . __( 'Settings','custom-search' ) . '</a>';
			$links[]	=	'<a href="http://wordpress.org/plugins/custom-search-plugin/faq/" target="_blank">' . __( 'FAQ','custom-search' ) . '</a>';
			$links[]	=	'<a href="http://support.bestwebsoft.com">' . __( 'Support','custom-search' ) . '</a>';
		}
		return $links;
	}
}

if ( ! function_exists('cstmsrch_admin_js') ) {
	function cstmsrch_admin_js() {
		if ( isset( $_GET['page'] ) && "custom_search.php" == $_GET['page'] ) {
			/* add notice about changing in the settings page */
			?>
			<script type="text/javascript">
				(function($) {
					$(document).ready( function() {
						$( '#cstmsrch_settings_form input' ).bind( "change click select", function() {
							if ( $( this ).attr( 'type' ) != 'submit' ) {
								$( '.updated.fade' ).css( 'display', 'none' );
								$( '#cstmsrch_settings_notice' ).css( 'display', 'block' );
							};
						});
					});
				})(jQuery);
			</script>
		<?php }
	}
}

/* Function for delete options from table `wp_options` */
if ( ! function_exists( 'delete_cstmsrch_settings' ) ) {
	function delete_cstmsrch_settings() {
		delete_option( 'cstmsrch_options' );
		delete_site_option( 'cstmsrch_options' );
	}
}

add_action( 'admin_menu', 'add_cstmsrch_admin_menu' );
add_action( 'admin_init', 'register_cstmsrch_settings' );
add_action( 'admin_init', 'cstmsrch_version_check' );
add_action( 'admin_init', 'cstmsrch_init' );
add_action( 'init', 'cstmsrch_options_global' );
add_action( 'admin_enqueue_scripts', 'cstmsrch_admin_head' );
add_action( 'admin_head', 'cstmsrch_admin_js' );

add_filter( 'pre_get_posts', 'cstmsrch_searchfilter' );
/* Adds "Settings" link to the plugin action page */
add_filter( 'plugin_action_links', 'cstmsrch_action_links', 10, 2 );
/* Additional links on the plugin page */
add_filter( 'plugin_row_meta', 'cstmsrch_links', 10, 2 );

register_uninstall_hook( __FILE__, 'delete_cstmsrch_settings');
?>