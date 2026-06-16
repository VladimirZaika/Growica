<?php

/**
 * Deregister jQuery
 */
add_action( 'wp_enqueue_scripts', function() {
    if ( ! is_admin() ) {
        wp_deregister_script( 'jquery' );
        wp_deregister_script( 'jquery-core' );
        wp_deregister_script( 'jquery-migrate' );
    }
}, 20 );

/**
 * Replace all macros entries in the string:
 */
function brand_prepare_macros( $str ) {
	return str_replace(
		[
			'((',
			'))',
		],

		[
			'<span class="text-decor">',
			'</span>',
		],
		$str
	);
}

function brand_allow_html_in_title( $title ) {
	$title = brand_prepare_macros( $title );
	return $title;
}

add_filter( 'the_title', 'brand_allow_html_in_title', 10, 2 );
add_filter( 'the_content', 'brand_allow_html_in_title', 10, 2 );

function brand_filter_title_parts( $title ) {
        $title['title'] = str_replace( '((', '', $title['title'] );
        $title['title'] = str_replace( '))', '', $title['title'] );
    return $title;
}

add_filter( 'document_title_parts', 'brand_filter_title_parts' );

/**
 * Hex color to RGB
 */
function hexToRgb( $hex ) {
    $hex = ltrim( $hex, '#' );

    if (strlen($hex) === 3) {
        $r = hexdec( str_repeat($hex[0], 2) );
        $g = hexdec( str_repeat($hex[1], 2) );
        $b = hexdec( str_repeat($hex[2], 2) );
    } else {
        $r = hexdec( substr($hex, 0, 2) );
        $g = hexdec( substr($hex, 2, 2) );
        $b = hexdec( substr($hex, 4, 2) );
    }

    return "$r, $g, $b";
}

/**
 * Breadcrumbs output
 */
function yoast_breadcrumbs_output() {
    if ( function_exists( 'yoast_breadcrumb' ) ) {
        yoast_breadcrumb(
            '<div class="yoast-breadcrumbs">',
            '</div>'
        );
    }
}

/**
 * Remove gutenberg editor from default posts
 */
add_filter( 'use_block_editor_for_post_type', function ( $use_block_editor, $post_type ) {
    if ( $post_type === 'post' ) {
        return false;
    }

    return $use_block_editor;
}, 10, 2 );

/**
 * Remove link from logo on home page
 */
add_filter('get_custom_logo', function( $html ) {
    if ( is_front_page() || is_home() ) {
        $html = preg_replace( '/<a[^>]*?>/', '<span>', $html );
        $html = str_replace( '</a>', '</span>', $html );
    }

    return $html;
});

/**
 * Remove tag <p> from widgets
 */
add_filter( 'widget_block_content', function ( $content ) {
    $content = trim( $content );

    $content = preg_replace('/^\s*<p>\s*/i', '', $content  );

    $content = preg_replace( '/\s*<\/p>\s*$/i', '', $content );

    return $content;
}, 20 );

/**
 * Remove contain-intrinsic-size css property
 */
add_action( 'template_redirect', function() {
    if ( is_author() ) {
        global $wp_query;
        $wp_query->set_404();
        status_header( 404 );
        nocache_headers();
        include( get_404_template() );
        exit;
    }

    ob_start( function( $buffer ) {
        return preg_replace(
            '/<style>img:is\(\[sizes="auto" i\], \[sizes\^="auto," i\]\) \{ contain-intrinsic-size: [^}]+ \}<\/style>/',
            '',
            $buffer
        );
    });
});

add_action( 'shutdown', function() {
    if ( ob_get_level() ) {
        ob_end_flush();
    }
});

/**
 * Get theme location by menu id
 */
function get_theme_location_by_menu_id( $menu_id ) {
    $locations = get_nav_menu_locations();

    foreach ( $locations as $location => $assignedMenuId ) {
        if ( (int) $assignedMenuId === (int) $menu_id ) {
            return $location;
        }
    }

    return null;
}

/**
 * Get image mime type
 */
function get_image_mime_type($url) {
    $ext = strtolower( pathinfo($url, PATHINFO_EXTENSION) );

    return match ($ext) {
        'jpg', 'jpeg' => 'image/jpeg',
        'png'         => 'image/png',
        'webp'        => 'image/webp',
        'gif'         => 'image/gif',
        'svg'         => 'image/svg+xml',
        'avif'        => 'image/avif',
        default        => false,
    };
}

/**
 * Setup custom header and footer
 */
add_action( 'template_redirect', 'brand_setup_custom_header_footer', 1 );
function brand_setup_custom_header_footer() {
    if ( is_admin() ) {
        return;
    }

    if ( !function_exists( 'get_field' ) ) {
        return;
    }

    $postId = get_the_ID();

    $headerSwitch = get_field( 'header_switch', $postId );

    if ( $headerSwitch ) {
        remove_action( 'generate_header', 'generate_construct_header', 10 );
        add_action( 'generate_header', 'brand_render_custom_header', 10 );
    }

    $footerSwitch = get_field( 'footer_switch', $postId );

    if ( $footerSwitch ) {
        remove_action( 'generate_footer', 'generate_construct_footer', 10 );
        add_action( 'generate_footer', 'brand_render_custom_footer', 10 );
    }
}

/**
 * Render custom header from template-parts
 */
function brand_render_custom_header() {
    get_template_part( 'template-parts/header/header' );
}

/**
 * Render custom footer from template-parts
 */
function brand_render_custom_footer() {
    get_template_part( 'template-parts/footer/footer' );
}