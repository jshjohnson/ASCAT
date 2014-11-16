<?php

/**
 * PLUGIN - BOON'S IN-SECTION NAVIGATION
 *
 * This is a function to generate an "in this section" navigation which shows sub pages of the section you're in
 * It allows you to target any given post type (the post type MUST be hierarchical )
 *
 * Call the sub navigation as follows: <?php boons_insection_subnav( 'product', 'current' ); ?>
 * Attributes: 'product' = post type and 'current' = current class for <li>'s
 */

// Navigation function
// -------------------------------------------------------------
function get_insection_subnav( $post_type = 'page' ) {
	global $post;
	// test for subnav
	if ( $post_type == 'page' ) {
		$sub_level_1 = get_sub_pages( get_root_parent_id( $post->ID ) );
	} else {
		$sub_level_1 = get_root_pages( $post_type );
	}
	// if pages to display
	if ( $sub_level_1 ) {
		return $sub_level_1;
	}
	else {
		return false;
	}
}

function insection_subnav( $post_type = 'page', $current_class = 'current_page_item' ) {

	// Test if current page in sub navigation
	// -------------------------------------------------------------
	function subnav_is_current( $post_id ) {
		global $post;
		return ( $post_id == $post->ID );
	}

	// Test next level in sub navigation
	// -------------------------------------------------------------
	function subnav_next_level( $post_id, $next_level ) {
		global $post;
		if ( $post->ancestors == null ) {
			$post_ancestors = array();
		}
		else {
			$post_ancestors = $post->ancestors; 
		}
		return ( $next_level && subnav_is_current( $post_id ) || in_array( $post_id, $post_ancestors ) );
	}

	// Test for subnav
	// -------------------------------------------------------------
	$sub_level_1 = get_insection_subnav( $post_type );

	// Output subnav
	// -------------------------------------------------------------
	// level 1
	if ( $sub_level_1 ) : ?>
	<ul class="nav-secondary level-1">
		<?php
		// level 1 items
		foreach ( $sub_level_1 as $level_1_page ) :
		$level_1_page_id = $level_1_page->ID;
		?>
		<li class="level-1-item<?php echo subnav_is_current( $level_1_page_id ) ? ' ' . $current_class . '' : ''; ?>">
			<?php link_by_id( $level_1_page_id ); ?>
			<?php
			// level 2
			$sub_level_2 = get_sub_pages( $level_1_page_id, $post_type );
			if ( subnav_next_level( $level_1_page_id, $sub_level_2 ) ) : ?>
			<ul class="level-2">
				<?php
				// level 2 items
				foreach ( $sub_level_2 as $level_2_page ) :
				$level_2_page_id = $level_2_page->ID;
				?>
				<li class="level-2-item<?php echo subnav_is_current( $level_2_page_id ) ? ' ' . $current_class . '' : ''; ?>">
					<?php link_by_id( $level_2_page_id ); ?>
					<?php
					// level 3
					$sub_level_3 = get_sub_pages( $level_2_page_id, $post_type );
					if ( subnav_next_level( $level_2_page_id, $sub_level_3 ) ) : ?>
					<ul class="level-3">
						<?php
						// level 3 items
						foreach ( $sub_level_3 as $level_3_page ) :
						$level_3_page_id = $level_3_page->ID;
						?>
						<li class="level-3-item<?php echo subnav_is_current( $level_3_page_id ) ? ' ' . $current_class . '' : ''; ?>">
							<?php link_by_id( $level_3_page_id ); ?>
						</li>
						<?php
						// level 3 items
						endforeach; ?>
					</ul>
					<?php
					// level 3
					endif; ?>
				</li>
				<?php
				// level 2 items
				endforeach; ?>
			</ul>
			<?php
			// level 2
			endif; ?>
		</li>
		<?php
		// level 1 items
		endforeach; ?>
	</ul>
	<?php endif; ?>
<?php
}

/**
 * PLUGIN - MIXD MODIFIED TWITTER WIDGET
 *
 * Taken from the Twitter for WordPress plugin
 * Use the twitter_messages( $username, $num ) function to call Twitter widget in sidebar
 */

/*  Copyright 2007  Ricardo González Castro (rick[in]jinlabs.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define('MAGPIE_CACHE_ON', 1); //2.7 Cache Bug
define('MAGPIE_CACHE_AGE', 180);
define('MAGPIE_INPUT_ENCODING', 'UTF-8');
define('MAGPIE_OUTPUT_ENCODING', 'UTF-8');

$twitter_options['prefix'] = 'twitter';

// Display Twitter messages
function twitter_messages($username = '', $num = 1, $list = false, $update = true, $linked  = false, $hyperlinks = true, $twitter_users = true, $encode_utf8 = false) {

	global $twitter_options;
	include_once(ABSPATH . WPINC . '/rss.php');
	
	$messages = fetch_rss('http://twitter.com/statuses/user_timeline/'.$username.'.rss');

	if ($list) echo '<ul class="tweets">';
	
	if ($username == '') {
		if ($list) echo '<li>';
		echo '<strong class="flash error">Tweets could not be loaded</strong>';
		if ($list) echo '</li>';
	} else {
			if ( empty($messages->items) ) {
				if ($list) echo '<li>';
				echo 'No public Twitter messages.';
				if ($list) echo '</li>';
			} else {
        $i = 0;
				foreach ( $messages->items as $message ) {
					$msg = " ".substr(strstr($message['description'],': '), 2, strlen($message['description']))." ";
					if($encode_utf8) $msg = utf8_encode($msg);
					$link = $message['link'];
				
					if ($list) echo '<li class="tweet">'; elseif ($num != 1) echo '<article class="tweet">';

          if ($hyperlinks) { $msg = hyperlinks($msg); }
          if ($twitter_users)  { $msg = twitter_users($msg); }
          					
					if ($linked != '' || $linked != false) {
            if($linked == 'all')  { 
              $msg = '<a href="'.$link.'" class="tweet-link">'.$msg.'</a>';  // Puts a link to the status of each tweet 
            } else {
              $msg = $msg . '<a href="'.$link.'" class="tweet-link">'.$linked.'</a>'; // Puts a link to the status of each tweet
              
            }
          } 

          echo $msg;
          
          
        if($update) {				
          $time = strtotime($message['pubdate']);
          
          if ( ( abs( time() - $time) ) < 86400 )
            $h_time = sprintf( __('%s ago'), human_time_diff( $time ) );
          else
            $h_time = date(__('Y/m/d'), $time);

          echo sprintf( __('%s', 'twitter-for-wordpress'),' <time datatime="' . date(__('c'), $time) . '" pubdate>' . $h_time . '</time>' );
         }          
                  
					if ($list) echo '</li>'; elseif ($num != 1) echo '</article>';
				
					$i++;
					if ( $i >= $num ) break;
				}
			}
		}
		if ($list) echo '</ul>';
	}

// Link discover stuff

function hyperlinks($text) {
    // Props to Allen Shaw & webmancers.com
    // match protocol://address/path/file.extension?some=variable&another=asf%
    //$text = preg_replace("/\b([a-zA-Z]+:\/\/[a-z][a-z0-9\_\.\-]*[a-z]{2,6}[a-zA-Z0-9\/\*\-\?\&\%]*)\b/i","<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
    $text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
    // match www.something.domain/path/file.extension?some=variable&another=asf%
    //$text = preg_replace("/\b(www\.[a-z][a-z0-9\_\.\-]*[a-z]{2,6}[a-zA-Z0-9\/\*\-\?\&\%]*)\b/i","<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);
    $text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);    
    
    // match name@address
    $text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
        //mach #trendingtopics. Props to Michael Voigt
    $text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
    return $text;
}

function twitter_users($text) {
       $text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text);
       return $text;
}

/**
 * PLUGIN - BOON'S SIMPLE SOCIAL SHARING
 *
 * Taken from https://github.com/mattberridge/Simple-Social-Sharing-Buttons
 * Use the simple_social_sharing( $attr_twitter, $attr_items ) function to call Twitter widget in sidebar
 * [simple-social-sharing] shortcode also available
 */

function simple_social_sharing( $attr_twitter = null, $attr_items = null ) {

	// parse variables
	$twitter_account = $attr_twitter;
	$item_toggles = $attr_items;

	// get post content and urlencode it
	global $post;
	$browser_title_encoded = urlencode( trim( wp_title( '', false, 'right' ) ) );
	$page_title_encoded = urlencode( get_the_title() );
	$page_url_encoded = urlencode( get_permalink($post->ID) );

	// create share items array
	$share_items = array ();

	// set each item
	$item_facebook = array(
		"class" => "facebook",
		"href" => "http://www.facebook.com/sharer.php?u={$page_url_encoded}&amp;t={$browser_title_encoded}",
		"text" => "Share on Facebook"
	);
	$item_twitter = array(
		"class" => "twitter",
		"href" => "http://twitter.com/share?text={$page_title_encoded}&amp;url={$page_url_encoded}&amp;via={$twitter_account}",
		"text" => "Share on Twitter"
	);
	$item_google = array(
		"class" => "google",
		"href" => "http://plus.google.com/share?url={$page_url_encoded}",
		"text" => "Share on Google+"
	);

	// test whether to display each item
	if($item_toggles) {
		// explode into array
		$item_toggles_array = explode( ",", $item_toggles );
		// set each item on or off
		$show_facebook = $item_toggles_array['0'];
		$show_twitter = $item_toggles_array['1'];
		$show_google = $item_toggles_array['2'];
	}
	else {
		$display_all_items = 1;
	}

	// form array of items set to 1
	if( $show_facebook==1 || $display_all_items ) {
		array_push( $share_items, $item_facebook );
	}
	if( $show_twitter==1 || $display_all_items) {
		array_push( $share_items, $item_twitter );
	}
	if( $show_google==1 || $display_all_items) {
		array_push( $share_items, $item_google );
	}

	// if one or more items
	if ( ! empty( $share_items ) ) {
		// create output
		$share_output = "<ul class=\"ss-share\">\n";
		foreach ( $share_items as $share_item ) {
			$share_output .= "<li class=\"ss-share-item\">\n";	
			$share_output .= "<a class=\"ss-share-link ico-{$share_item['class']}\" href=\"{$share_item["href"]}\" rel=\"nofollow\" target=\"_blank\">{$share_item['text']}</a>\n";	
			$share_output .= "</li>\n";	
		}
		$share_output .= "</ul>";
		// echo output
		echo $share_output;
	}

}

// add shortcode to output buttons
function simple_social_sharing_shortcode( $atts, $content = null ) {
	// parse variables / set defaults
	extract( shortcode_atts( array(
		'twitter' => '',
		'display' => '1,1,1',
	), $atts ) );
	// output buttons
	ob_start();
	simple_social_sharing( $twitter, $display );
	$output_string = ob_get_contents();
	ob_end_clean();
	return force_balance_tags( $output_string );
}

add_shortcode( 'simple-social-sharing', 'simple_social_sharing_shortcode' ); 