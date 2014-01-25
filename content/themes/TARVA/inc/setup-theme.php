<?php

// Set post thumbnail sizes
// -------------------------------------------------------------
add_theme_support( 'post-thumbnails' );
add_image_size( 'index-thumb', 150, 150, true ); // section index
add_image_size( 'slideshow', 800, 300, true ); // slideshow
add_image_size( 'panel-thumb', 300, 150, true ); // panels

// Register wp_nav_menu()s
// -------------------------------------------------------------
function my_register_nav_menus() {
	register_nav_menus(
		array(
			'primary' => __( 'Primary' ),
			'tertiary' => __( 'Tertiary' ),
			'sitemap' => __( 'Sitemap' )
		)
	);
}

add_action( 'init', 'my_register_nav_menus' );

// Remove wp_nav_menu() containers
// -------------------------------------------------------------
function my_wp_nav_menu_args( $args = '' )
{
	$args['container'] = false;
	return $args;
}

add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );

// Remove all wp_nav_menu() classes (and add .is-current)
// -------------------------------------------------------------
function my_wp_nav_strip_classes( $a ){
	return ( in_array( 'current_page_item', $a ) ) ? array( 'is-current' ) : array();
}

add_filter( 'nav_menu_css_class', 'my_wp_nav_strip_classes', 10, 2 );

// Add special classes to wp_nav_menu
// -------------------------------------------------------------
function my_wp_nav_special_classes( $classes, $item ){
     //if( $item->object_id == page_chalets() ) {
     //        $classes[] = 'section-chalets';
     //}
     if( $item->object_id == get_root_parent_id() ) {
             $classes[] = 'is-root-parent';
     }
     return $classes;
}

add_filter( 'nav_menu_css_class' , 'my_wp_nav_special_classes', 10, 2 );

// Remove wp_nav_menu() IDs
// -------------------------------------------------------------
function my_wp_nav_strip_id() {
	return '';
}

add_filter( 'nav_menu_item_id', 'my_wp_nav_strip_id' );

// Remove <img> dimensions from the_post_thumbnail()
// -------------------------------------------------------------
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 2 );

// Remove inline CSS and change wp-caption images
// -------------------------------------------------------------
class FixWpCaption{

    public function __construct(){
        add_filter( 'img_caption_shortcode', array( $this, 'fixcaption' ), 10, 3 );
    }
    public function fixcaption( $x=null, $attr, $content ){

        extract(shortcode_atts(array(
                'id'    => '',
                'align'    => 'alignnone',
                'width'    => '',
                'caption' => ''
            ), $attr));

        if ( 1 > (int) $width || empty( $caption ) ) {
            return $content;
        }

    return '<aside class="wp-caption ' . $align . '">'
    . $content . '<p class="wp-caption-text">' . $caption . '</p></aside>';
    }
    
}

$FixWpCaption = new FixWpCaption();

// Include jQuery properly to stop conflicts
// -------------------------------------------------------------
function my_jquery_include() {
    wp_deregister_script( 'jquery' );
    
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js','','',true );
    wp_register_script( 'js-scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.min.js', array( 'jquery' ), '', true );
    wp_register_script( 'comment-reply','','','', true );
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'js-scripts' );
}     
 
add_action('wp_enqueue_scripts', 'my_jquery_include');

// Remove rel="next" rel="prev" in <head>
// -------------------------------------------------------------
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );

// Remove rel="wlwmanifest in <head> (Windows Live Writer)
// -------------------------------------------------------------
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );

// Remove RSS feed links in <head>
// -------------------------------------------------------------
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );

/*
function my_add_back_rss() {
    echo '<link rel="alternate" type="application/rss+xml" title="RSS 2.0 Feed" href="' . get_bloginfo('rss2_url') . '" />'; 
}

add_action( 'wp_head', 'my_add_back_rss' );
*/

// Add page excerpts panel
// -------------------------------------------------------------
add_post_type_support( 'page', 'excerpt' );

// Add 'Site Options' menu
// -------------------------------------------------------------
function site_options_init() {
	add_action( 'admin_menu', 'site_options_menu' );
}

add_action('init', 'site_options_init');


function site_options_menu() {
	add_options_page( 'Site Options', 'Site Options', 7, basename(__FILE__), 'site_options_page' );	
}

function site_options_page() {

	// Define our fields with label / key
	$options_fields = array(
		'Primary Telephone' => 'primary_telephone',
		'Primary Email Address' => 'primary_email',
		'Twitter Username' => 'twitter_username',
		'Excluded Page IDs' => 'nav_excluded_ids',
	);

?>
	<div class="wrap">
		<h2>Manage Site Options</h2>
		<form method="post" action="options.php">
		<?php wp_nonce_field( 'update-options' ); ?>
		<table class="form-table">
			<tbody>
			<?php foreach($options_fields as $label => $key): ?>
			<tr valign="top">
				<th scope="row">
					<label class="field" for="<?php echo $key; ?>"><strong><?php echo $label; ?> :</label>
				</th>	
				<td>
					<input size="40" id="<?php echo $key; ?>" name="<?php echo $key; ?>" value="<?php echo get_option( $key ); ?>" />
				</td>
			</tr>
			<?php
				$saveopts[] = $key;
				endforeach;
			?>
		</table>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="<?php echo implode( ',' , $saveopts ); ?>" />
		<p class="submit">
			<input type="submit" name="Submit" value="<?php _e( 'Save Changes' ); ?>" />
		</p>		
		</form>
	</div>
<?php
}

// Set default twitter username
// -------------------------------------------------------------
function default_twitter_username() {
	if( get_option( 'twitter_username' ) == '' ) {
		update_option( 'twitter_username', 'mixd' );
	}	
}

add_action( 'after_switch_theme' , 'default_twitter_username', 10, 2 );

// Define comments loop
// -------------------------------------------------------------
function my_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	
	<li class="pingback">
		<p><b>Pingback</b>: <?php comment_author_link(); ?></p>
		
	<?php break; default : ?>
	
	<li<?php // comment_class(); ?>>
		<article class="comment" id="comment-<?php comment_ID(); ?>">
			<header class="comment-head vcard">
				<h3 class="fn">
					<?php comment_author_link(); ?>
				</h3>
				<span class="meta comment-meta">
					<time datetime="<?php comment_date( 'c' ); ?>" pubdate><?php comment_date( 'jS F Y' ); ?> @ <?php comment_time( 'g:iA' ); ?></time> <a href="<?php comment_link() ?>" title="Comment Permalink">#</a>
				</span>
				<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="moderation">
					Awaiting moderation
				</em>
				<?php endif; ?>
			</header>

			<div class="comment-body">
				<?php comment_text(); ?>
			</div>

			<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'twentyeleven' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			
		</article>

	<?php
			break;
			endswitch;
}

/**
 * WIDGETIZED SIDEBAR
 *
 * Default method of adding widgets to the sidebar
 */

// Remove all default widgets
// -------------------------------------------------------------
function my_unregister_widgets() {
    unregister_widget( 'WP_Widget_Pages' );
    unregister_widget( 'WP_Widget_Calendar' );
    unregister_widget( 'WP_Widget_Archives' );
    unregister_widget( 'WP_Widget_Links' );
    unregister_widget( 'WP_Widget_Categories' );
    unregister_widget( 'WP_Widget_Recent_Posts' );
    unregister_widget( 'WP_Widget_Search' );
    unregister_widget( 'WP_Widget_Tag_Cloud' );
    unregister_widget( 'WP_Widget_RSS' );
    unregister_widget( 'WP_Widget_Meta' );
    unregister_widget( 'WP_Widget_Recent_Comments' );
    unregister_widget( 'WP_Nav_Menu_Widget' );
    unregister_widget( 'bcn_widget' );
    unregister_widget( 'GFWidget' );
    unregister_widget( 'HSS_WpWidgets' );
    unregister_widget( 'P2P_Widget' );
    unregister_widget( 'WP_Widget_Recent_Posts_No_Title_Attributes' );
}

add_action( 'widgets_init', 'my_unregister_widgets' );

// Widgetized sidebar
// -------------------------------------------------------------
if ( function_exists('register_sidebar') ) :

	register_sidebar(array(
		'name' => __( 'Widgets' ),
		'id' => __( 'widgets' ),
		'before_widget' => '<article class="panel widget">',
		'after_widget' => '</article>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	
endif;