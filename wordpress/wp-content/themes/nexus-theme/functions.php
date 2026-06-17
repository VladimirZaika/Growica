<?php

/**
 * Nexus functions
 *
 * @package nexus
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

$nexus_includes = [
	'includes/custom-post-types.php',  // Register custom post types
	'includes/custom-taxonomies.php',  // Register custom taxonomies
	'includes/theme-default.php',      // Set up theme defaults and registers support for various WordPress feaures.
	'includes/custom-menu.php',        // Register menu
	'includes/widgets.php',            // Register widget area
	'includes/scripts.php',            // Enqueue scripts and styles
	'includes/custom-functions.php',   // Custom functions
];

foreach ( $nexus_includes as $file ) {
	locate_template( $file, true, true );
}

add_action( 'after_setup_theme', 'nexus_include_plugin_settings' );
function nexus_include_plugin_settings() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		locate_template( 'includes/plugin-settings/acf.php', true, true );
	}

	if ( defined( 'WPSEO_VERSION' ) ) {
		locate_template( 'includes/plugin-settings/yoast-seo.php', true, true );
	}
}