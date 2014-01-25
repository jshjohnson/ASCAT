=== Admin Collapse Subpages ===
Contributors: lupka
Donate link: http://alexchalupka.com/donate
Tags: random, posts, widget, categories, date, date range, timeframe, excerpt, randomize, sidebar, category
Requires at least: 3.0
Tested up to: 3.2.1
Stable tag: trunk

jQuery-powered plugin that allows expansion/collapse of subpages within pages admin (/edit.php?post_type=page) menu.

== Description ==

Simple plugin that allows you to collapse subpages in the Pages admin list. Especially helpful if you have a ton of pages. It uses a cookie to save the expand/collapse status of your pages.

This is loosely based on Collapse Sub-Pages by Dan Dietz (http://wordpress.org/extend/plugins/collapse-sub-pages/), which broke with the 3.0 upgrade due to UI changes and hasn't been updated. I've had to rewrite the jQuery to make it work with 3.x versions. 

Because this is a jQuery, it's possible that they could make additional changes that would break it. I'll do my best to stay on top of it, but let me know if it stops working.

== Installation ==

1. Download, unzip, and upload the `random-posts-within-date-range-widget` folder along with all its files to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Visit your Pages admin page and notice the lovely +/- buttons.

== Frequently Asked Questions ==

= Why is there a delay after I use "Quick Edit"? =

The WordPress Quick Edit functionality is a little buggy in my opinion. To make a long story short, this delay is so that WordPress can complete the edit(and any possible parent changes) before refreshing the expand/collapse status.
I'd recommend not using Quick Edit to change parent/child pages at all. It often doesn't refresh any changed rows properly.

== Screenshots ==

1. Example Edit Page menu.
2. Same menu with a group of subpages minimized.
3. Same menu completely minimized.
4. Expand/collapse all buttons at the top of the page.

== Changelog ==

= 1.0 =
* Initial version of the plugin

== Upgrade Notice ==

= 1.0 =
* N/A