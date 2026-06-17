<?php

/**
 * Vibe functions
 *
 * @package vibe
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

$vibe_includes = [
	'includes/custom-post-types.php',  // Register custom post types
	'includes/custom-taxonomies.php',  // Register custom taxonomies
	'includes/theme-default.php',      // Set up theme defaults and registers support for various WordPress feaures.
	'includes/custom-menu.php',        // Register menu
	'includes/widgets.php',            // Register widget area
	'includes/scripts.php',            // Enqueue scripts and styles
	'includes/custom-functions.php',   // Custom functions
];

foreach ( $vibe_includes as $file ) {
	locate_template( $file, true, true );
}

add_action( 'after_setup_theme', 'vibe_include_plugin_settings' );
function vibe_include_plugin_settings() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		locate_template( 'includes/plugin-settings/acf.php', true, true );
	}

	if ( defined( 'WPSEO_VERSION' ) ) {
		locate_template( 'includes/plugin-settings/yoast-seo.php', true, true );
	}
}