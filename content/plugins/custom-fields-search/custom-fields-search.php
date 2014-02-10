<?php
/*
Plugin Name: Custom Fields Search
Plugin URI:  http://bestwebsoft.com/plugin/
Description: This plugin allows you to add website search any existing custom fields.
Author: BestWebSoft
Version: 1.1.5
Author URI: http://bestwebsoft.com/
License: GPLv2 or later
*/

/*  Copyright 2013  BestWebSoft  ( http://support.bestwebsoft.com )

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
if ( ! function_exists( 'cstmfldssrch_add_to_admin_menu' ) ) {
	function cstmfldssrch_add_to_admin_menu() {
		add_menu_page( 'BWS Plugins', 'BWS Plugins', 'manage_options', 'bws_plugins', 'bws_add_menu_render', plugins_url( "images/px.png", __FILE__ ), 1001 );
		add_submenu_page( 'bws_plugins', __( 'Custom fields search settings', 'custom-fields-search' ), __( 'Custom fields search', 'custom-fields-search' ), 'manage_options', "custom_fields_search.php", 'cstmfldssrch_page_of_settings' );
	}
}

/* Function create column in table wp_options for option of this plugin. If this column exists - save value in variable. */
if ( ! function_exists( 'cstmfldssrch_register_options' ) ) {
	function cstmfldssrch_register_options() {
		global $wpmu, $cstmfldssrch_array_options, $bws_plugin_info;

		if ( function_exists( 'get_plugin_data' ) && ( ! isset( $bws_plugin_info ) || empty( $bws_plugin_info ) ) ) {
			$plugin_info = get_plugin_data( __FILE__ );	
			$bws_plugin_info = array( 'id' => '85', 'version' => $plugin_info["Version"] );
		};

		$search_cusfields_defaults = array();
		if ( 1 == $wpmu ) {
			if( ! get_site_option( 'cstmfldssrch_options' ) ) {
				add_site_option( 'cstmfldssrch_options', $search_cusfields_defaults );
			}
		} else {
			if( ! get_option( 'cstmfldssrch_options' ) )
				add_option( 'cstmfldssrch_options', $search_cusfields_defaults );
		}
		if ( 1 == $wpmu )
			$cstmfldssrch_array_options = get_site_option( 'cstmfldssrch_options' );
		else
			$cstmfldssrch_array_options = get_option( 'cstmfldssrch_options' );
	}
}

/* Function adds translations in this plugin */
if ( ! function_exists ( 'cstmfldssrch_translate' ) ) {
	function cstmfldssrch_translate(){
		load_plugin_textdomain( 'custom-fields-search', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		load_plugin_textdomain( 'bestwebsoft', false, dirname( plugin_basename( __FILE__ ) ) . '/bws_menu/languages/' );
	}
}

/* Function check if plugin is compatible with current WP version  */
if ( ! function_exists ( 'cstmfldssrch_version_check' ) ) {
	function cstmfldssrch_version_check() {
		global $wp_version;
		$plugin_data	=	get_plugin_data( __FILE__, false );
		$require_wp		=	"3.0"; /* Wordpress at least requires version */
		$plugin			=	plugin_basename( __FILE__ );
	 	if ( version_compare( $wp_version, $require_wp, "<" ) ) {
			if( is_plugin_active( $plugin ) ) {
				deactivate_plugins( $plugin );
				wp_die( "<strong>" . $plugin_data['Name'] . " </strong> " . __( 'requires', 'custom-fields-search' ) . " <strong>WordPress " . $require_wp . "</strong> " . __( 'or higher, that is why it has been deactivated! Please upgrade WordPress and try again.', 'custom-fields-search') . "<br /><br />" . __( 'Back to the WordPress', 'custom-fields-search') . " <a href='" . get_admin_url( null, 'plugins.php' ) . "'>" . __( 'Plugins page', 'custom-fields-search') . "</a>." );
			}
		}
	}
}

/* Function are using to register script jQuery */
if ( ! function_exists ( 'cstmfldssrch_admin_head' ) ) {
	function cstmfldssrch_admin_head() {
		global $wp_version;
		if ( $wp_version < 3.8 )
			wp_enqueue_style( 'cstmfldssrch_style', plugins_url( 'css/style_wp_before_3.8.css', __FILE__ ) );	
		else
			wp_enqueue_style( 'cstmfldssrch_style', plugins_url( 'css/style.css', __FILE__ ) );
		if ( isset( $_GET['page'] ) && "bws_plugins" == $_GET['page'] )
			wp_enqueue_script( 'bws_menu_script', plugins_url( 'js/bws_menu.js', __FILE__ ) );
	}
}

/* Function exclude records that contain duplicate data in selected fields */
if ( ! function_exists( 'cstmfldssrch_distinct' ) ) {
	function cstmfldssrch_distinct( $distinct ) {
		global $wp_query, $cstmfldssrch_array_options;
		if ( is_search() && ! empty( $wp_query->query_vars['s'] ) && ! empty( $cstmfldssrch_array_options ) ) {
			$distinct .= "DISTINCT";
		}
		return $distinct;
	}
}

/* Function join table `wp_posts` with `wp_postmeta` */
if ( ! function_exists( 'cstmfldssrch_join' ) ) {
	function cstmfldssrch_join( $join ) {
		global $wp_query, $wpdb, $cstmfldssrch_array_options;
		if ( is_search() && ! empty( $wp_query->query_vars['s'] ) && ! empty( $cstmfldssrch_array_options ) ) {
			$join .= "JOIN " . $wpdb->postmeta . " ON " . $wpdb->posts . ".ID = " . $wpdb->postmeta . ".post_id ";
		}
		return $join;
	}
}

/* Function adds in request keyword search on custom fields, and list of meta_key, which user has selected */
if ( ! function_exists( 'cstmfldssrch_request' ) ) {
	function cstmfldssrch_request( $where ) {
		global $wp_query, $wpdb, $cstmfldssrch_array_options;
		$pos = strrpos( $where, '%' );
		if ( is_search() && false !== $pos && ! empty( $wp_query->query_vars['s'] ) && ! empty( $cstmfldssrch_array_options ) ) {
			$end_pos_where = 5 + $pos; /* Find position of the end of the request with check the type and status of the post  */
			$end_of_where_request = substr( $where, $end_pos_where ); /* Save check the type and status of the post in variable */
			$cusfields_sql_request = "'" . implode( "', '", $cstmfldssrch_array_options ) . "'"; /* Forming a string with the list of meta_key, which user has selected */
			$user_request = trim ( $wp_query->query_vars['s'] );
			$user_request_arr = preg_split( "/[\s,]+/", $user_request ); /* The user's regular expressions are used to separate array for the desired keywords */
			$where .=  " OR (" . $wpdb->postmeta . ".meta_key IN (" . $cusfields_sql_request . ") "; /* Modify the request */
			foreach ( $user_request_arr as $value ) {
				$where .= "AND " . $wpdb->postmeta . ".meta_value LIKE '%" . $value . "%' ";
			}
			$where .= $end_of_where_request . ") ";
		}
		return $where;
	}
}

/* Function is forming page of the settings of this plugin */
if ( ! function_exists( 'cstmfldssrch_page_of_settings' ) ) {
	function  cstmfldssrch_page_of_settings() {
		global $wpdb, $cstmfldssrch_array_options, $wpmu;
		if ( ! function_exists( 'is_plugin_active_for_network' ) )
			require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
		if ( isset( $_REQUEST['cstmfldssrch_submit_nonce'] ) && check_admin_referer( plugin_basename( __FILE__ ), 'cstmfldssrch_nonce_name' ) ) {
			$cstmfldssrch_array_options = isset( $_REQUEST['cstmfldssrch_array_options'] ) ? $_REQUEST['cstmfldssrch_array_options'] : array() ;
			update_option( 'cstmfldssrch_options', $cstmfldssrch_array_options );
			$message = __( "Settings saved" , 'custom-fields-search' );
		} /* Retrieve all the values ​​of custom fields from the database - the keys */
		$meta_key_custom_posts	=	$wpdb->get_col( "SELECT DISTINCT(meta_key) FROM " . $wpdb->postmeta . " JOIN " . $wpdb->posts . " ON " . $wpdb->posts . ".id = " . $wpdb->postmeta . ".post_id WHERE  " . $wpdb->posts . ".post_type NOT IN ('revision', 'page', 'post', 'attachment', 'nav_menu_item') AND meta_key NOT REGEXP '^_'" );
		$meta_key_result		=	$wpdb->get_col( "SELECT DISTINCT(meta_key) FROM " . $wpdb->postmeta . " WHERE meta_key NOT REGEXP '^_'" );//select all user's meta_key from table `wp_postmeta`
		$active_plugins			=	get_option( 'active_plugins' );
		$install_plugins		=	get_plugins();
		$path_plugin			=	'custom-search-plugin/custom-search-plugin.php';?>
		<div class="wrap">
			<div class="icon32 icon32-bws" id="icon-options-general"></div>
			<h2><?php echo get_admin_page_title(); ?></h2>
			<div class="updated fade" <?php if( ! isset( $_REQUEST['cstmfldssrch_submit_nonce'] ) ) echo "style=\"display:none\""; ?>><p><strong><?php echo $message; ?></strong></p></div>
			<div id="cstmfldssrch_settings_notice" class="updated fade" style="display:none"><p><strong><?php _e( "Notice:", 'custom-fields-search' ); ?></strong> <?php _e( "The plugin's settings have been changed. In order to save them please don't forget to click the 'Save Changes' button.", 'custom-fields-search' ); ?></p></div>
			<?php if( 0 < count( $meta_key_result ) ) { ?>
				<form method="post" action="" style="margin-top: 10px;" id="cstmfldssrch_settings_form">
					<table class="form-table">
						<tr valign="top">
							<th scope="row"><?php _e( 'Enable search for the custom field:', 'custom-fields-search' ); ?> </th>
							<?php if ( in_array( $path_plugin, $active_plugins ) || is_plugin_active_for_network( $path_plugin ) ) { /* If Custom Search is activated for site or network */ ?>
								<td>
									<?php foreach ( $meta_key_result as $value ) { ?>
										<label><input type="checkbox" <?php echo ( in_array( $value, $cstmfldssrch_array_options ) ?  'checked="checked"' : "" ); ?> name="cstmfldssrch_array_options[]" value="<?php echo $value; ?>"/><span class="value_of_metakey"><?php echo $value; ?></span></label><br />
									<?php } ?>
								</td>
							<?php } else {
								$i = 1; ?>
								<td>
									<?php foreach ( $meta_key_result as $value ) {
										if ( FALSE !== in_array( $value, $meta_key_custom_posts ) ) {
											$list_custom_key[$i] = $value;
											$i++;
										} else { ?>
											<label><input type="checkbox" <?php echo ( in_array( $value, $cstmfldssrch_array_options ) ?  'checked="checked"' : "" ); ?> name="cstmfldssrch_array_options[]" value="<?php echo $value; ?>"/><span class="value_of_metakey"><?php echo $value; ?></span></label><br />
										<?php }
									}
									echo "<br />";
									if ( isset( $list_custom_key ) ) {
										foreach ( $list_custom_key as $value ) {
											$post_type_of_mkey = $wpdb->get_col( "SELECT DISTINCT(post_type) FROM " . $wpdb->posts . " JOIN " . $wpdb->postmeta . " ON " . $wpdb->posts . ".id = " . $wpdb->postmeta . ".post_id WHERE  " . $wpdb->postmeta . ".meta_key LIKE ('" . $value . "')" ); ?>
											<label><input type="checkbox" disabled="disabled" name="cstmfldssrch_array_options[]" value="<?php echo ' ' . $value; ?>"/>
											<span class="disable_key">
												<?php echo $value . " (" . $post_type_of_mkey[0] . " ";
												_e( 'custom post type', 'custom-fields-search');
												echo ")"; ?>
											</span></label><br />
										<?php }
										if ( array_key_exists( $path_plugin, $install_plugins ) ) { ?>
											<span class="note_bottom"><?php _e( 'You need to', 'custom-fields-search' ); ?> <a href="<?php echo bloginfo("url"); ?>/wp-admin/plugins.php"><?php _e( 'activate plugin Custom Search', 'custom-fields-search' ); ?></a><span>
										<?php } else { ?>
											<span class="note_bottom"><?php _e( 'If the type of the post is not default - you need to install and activate the plugin', 'custom-fields-search' ); ?> <a href="http://bestwebsoft.com/plugin/custom-search-plugin/#download"><?php _e( 'Custom Search', 'custom-fields-search' ); ?></a>.<span>
										<?php } 
									} ?>
								</td>
							<?php }	?>
						</tr>
					</table>	
					<input type="hidden" name="cstmfldssrch_submit_nonce" value="submit" />
					<p class="submit">
						<input type="submit" class="button-primary" value="<?php _e( 'Save Changes' , 'custom-fields-search' ) ?>" />
					</p>
					<?php wp_nonce_field( plugin_basename( __FILE__ ), 'cstmfldssrch_nonce_name' ); ?>
				</form>
			<?php } else {
				echo '<br/>';
				_e( 'Custom fields not found.', 'custom-fields-search' );
			} ?>
			<br />
			<div class="bws-plugin-reviews">
				<div class="bws-plugin-reviews-rate">
				<?php _e( 'If you enjoy our plugin, please give it 5 stars on WordPress', 'custom-fields-search' ); ?>:<br/>
				<a href="http://wordpress.org/support/view/plugin-reviews/custom-fields-search" target="_blank" title="Custom Fields Search reviews"><?php _e( 'Rate the plugin', 'custom-fields-search' ); ?></a><br/>
				</div>
				<div class="bws-plugin-reviews-support">
				<?php _e( 'If there is something wrong about it, please contact us', 'custom-fields-search' ); ?>:<br/>
				<a href="http://support.bestwebsoft.com">http://support.bestwebsoft.com</a>
				</div>
			</div>
		</div>
	<?php }
}

/* Function are using to create action-link 'settings' on admin page. */
if ( ! function_exists( 'cstmfldssrch_action_links' ) ) {
	function cstmfldssrch_action_links( $links, $file ) {
		$base = plugin_basename( __FILE__ );
		if ( $file == $base ) {
			$settings_link = '<a href="admin.php?page=custom_fields_search.php">' . __( 'Settings', 'custom-fields-search' ) . '</a>';
			array_unshift( $links, $settings_link );
		}
		return $links;
	}
}

/* Function are using to create link 'settings' on admin page. */
if ( ! function_exists ( 'cstmfldssrch_links' ) ) {
	function cstmfldssrch_links( $links, $file ) {
		$base = plugin_basename( __FILE__ );
		if ( $file == $base ) {
			$links[]	=	'<a href="admin.php?page=custom_fields_search.php">' . __( 'Settings','custom-fields-search' ) . '</a>';
			$links[]	=	'<a href="http://wordpress.org/plugins/custom-fields-search/faq/">' . __('FAQ','custom-fields-search') . '</a>';
			$links[]	=	'<a href="http://support.bestwebsoft.com">' . __('Support','custom-fields-search') . '</a>';
		}
		return $links;
	}
}

if ( ! function_exists('cstmfldssrch_admin_js') ) {
	function cstmfldssrch_admin_js() {
		if ( isset( $_GET['page'] ) && "custom_fields_search.php" == $_GET['page'] ) {
			/* add notice about changing in the settings page */
			?>
			<script type="text/javascript">
				(function($) {
					$(document).ready( function() {
						$( '#cstmfldssrch_settings_form input' ).bind( "change click select", function() {
							if ( $( this ).attr( 'type' ) != 'submit' ) {
								$( '.updated.fade' ).css( 'display', 'none' );
								$( '#cstmfldssrch_settings_notice' ).css( 'display', 'block' );
							};
						});
					});
				})(jQuery);
			</script>
		<?php }
	}
}

/* Function for delete options from table `wp_options` */
if ( ! function_exists( 'cstmfldssrch_delete_options' ) ) {
	function cstmfldssrch_delete_options() {
		delete_site_option( 'cstmfldssrch_options' );
		delete_option( 'cstmfldssrch_options' );
	}
}

add_action( 'admin_menu', 'cstmfldssrch_add_to_admin_menu' );
add_action( 'init', 'cstmfldssrch_register_options' );
add_action( 'admin_init', 'cstmfldssrch_register_options' );
add_action( 'admin_init', 'cstmfldssrch_translate' );
add_action( 'admin_init', 'cstmfldssrch_version_check' );
add_action( 'admin_enqueue_scripts', 'cstmfldssrch_admin_head' );
add_action( 'wp_enqueue_scripts', 'cstmfldssrch_admin_head' );
add_action( 'admin_head', 'cstmfldssrch_admin_js' );

add_filter( 'posts_distinct', 'cstmfldssrch_distinct' );
add_filter( 'posts_join', 'cstmfldssrch_join' );
add_filter( 'posts_where', 'cstmfldssrch_request' );
add_filter( 'plugin_action_links', 'cstmfldssrch_action_links', 10, 2 );
add_filter( 'plugin_row_meta', 'cstmfldssrch_links', 10, 2 );

register_uninstall_hook( __FILE__, 'cstmfldssrch_delete_options' );
?>