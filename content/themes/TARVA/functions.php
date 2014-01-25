<?php

/**
 * ADMIN SETUP / REFINEMENT
 *
 * These clean up our admin and add/change bits here and there
 */
require_once( 'inc/setup-admin.php' );

/**
 * THEME SETUP / REFINEMENT
 *
 * These clean up our theme and add/change bits here and there
 */
require_once( 'inc/setup-theme.php' );

/**
 * CREATE DEFAULT PAGES
 *
 * Create pages when theme is activated
 */
require_once( 'inc/default-pages.php' );

/**
 * SHORTCODES
 *
 * Import any shortcdes to be used at the front end
 */
require_once( 'inc/shortcodes.php' );

/**
 * GRAVITY FORMS
 *
 * Function and configuration for Gravity Forms plugin
 */
require_once( 'inc/gravity-forms.php' );

/**
 * MIXD PLUGINS
 *
 * Plugins/functions written by Mixd (not on WordPress.org)
 */
require_once( 'inc/mixd-plugins.php' );

/**
 * HELPER FUNCTIONS
 *
 * These are common theme functions to help you!
 */
require_once( 'inc/helper-functions.php' );

/**
 * CUSTOM POST TYPES
 *
 * Import any custom post types for the theme
 */
require_once( 'inc/post-types.php' );