<?php
/**
 * ACF JSON
 */
function acf_json_save_point( $path ) {
    return get_stylesheet_directory() . '/acf-json';
}

add_filter( 'acf/settings/save_json', 'acf_json_save_point' );

/**
 * ACF options
 */
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page( [
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ] );

	acf_add_options_sub_page( [
        'page_title'    => 'Styles and Scripts Settings',
        'menu_title'    => 'Styles and Scripts',
        'parent_slug'   => 'theme-general-settings',
    ] );

    acf_add_options_sub_page( [
        'page_title'    => 'Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-general-settings',
    ] );

    acf_add_options_sub_page( [
        'page_title'    => 'Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-general-settings',
    ] );
}


/**
 * Dinamyc date
 */
if ( !is_admin() ) {
    add_filter( 'acf/load_value/name=copyright', function ( $value ) {
        return str_replace( '@year', date( 'Y' ), $value );
    } );
}

/**
 * Add Custom Field (Nav Menu)
 */
add_filter('acf/load_field/name=landing_nav_menu', function ($field) {
    $menus = wp_get_nav_menus();

    $choices = [];

    foreach ( $menus as $menu ) {
        $choices[$menu->term_id] = $menu->name;
    }

    $field['choices'] = $choices;

    return $field;
});

/**
 * ACF Gutenberg block register
 */
function custom_blocks_acf_init() {
	$icon = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="256" height="256" viewBox="0 0 256 256" xml:space="preserve">
				<g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
					<polygon points="45,0 82.9,18.42 45,36.83 7.1,18.42 " style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(56,56,127); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "/>
					<polygon points="2.52,24.1 41.44,43.02 41.44,90 2.52,71.08 " style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(70,70,162); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "/>
					<polygon points="48.56,90 48.56,43.02 87.48,24.1 87.48,71.08 " style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(56,56,127); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "/>
				</g>
			</svg>';

	if( function_exists('acf_register_block') ) {

		acf_register_block( [
			'name'              => 'block-hero',
			'title'             => __('Hero Block'),
			'description'       => __('Hero Block Module'),
			'render_template'   => '/template-parts/blocks/block-hero/block-hero.php',
			'category'          => 'base-template-blocks',
			'keywords'          => ['primary', 'hero',''],
			'multiple'          => true,
			'icon' 				=> $icon,
			'mode'              => 'edit',
			'example'  => [
	            'attributes' => [
	                'mode' => 'preview',
	                'data' => [
	                	'preview_image_help' => get_theme_file_uri().'/src/images/block-hero.png',
					]
				]
			],
            'enqueue_assets' => function() {
                $stylePath = 'dist/css/blocks/block-hero/block-hero.css';
                $styleVersion = filemtime( get_theme_file_path($stylePath) );

                wp_enqueue_style(
                    'block-hero-style', 
                    get_theme_file_uri() . '/' . $stylePath, [], $styleVersion
                );
            },
		] );

		acf_register_block( [
			'name'              => 'block-cta',
			'title'             => __('CTA Block'),
			'description'       => __('CTA Module'),
			'render_template'   => '/template-parts/blocks/block-cta/block-cta.php',
			'category'          => 'base-template-blocks',
			'keywords'          => ['primary', 'cta',''],
			'multiple'          => true,
			'icon' 				=> $icon,
			'mode'              => 'edit',
			'example'  => [
	            'attributes' => [
	                'mode' => 'preview',
	                'data' => [
	                	'preview_image_help' => get_theme_file_uri().'/src/images/block-cta.png',
					]
				]
			],
            'enqueue_assets' => function() {
                $stylePath = 'dist/css/blocks/block-cta/block-cta.css';
                $styleVersion = filemtime( get_theme_file_path($stylePath) );

                wp_enqueue_style(
                    'block-cta-style', 
                    get_theme_file_uri() . '/' . $stylePath, [], $styleVersion
                );
            },
		] );
	}
}

add_action('acf/init', 'custom_blocks_acf_init');

/**
 * Define vibe category module Gutenberg
 */
function custom_block_category( $categories, $post ) {
	$custom_block = [
	  'slug' => 'base-template-blocks',
	  'title' => __( 'vibe Modules', 'custom-blocks' ),
	];

	$categories_sorted = [];
	$categories_sorted[0] = $custom_block;

	foreach ($categories as $category) {
		$categories_sorted[] = $category;
	}

	return $categories_sorted;
}

add_filter( 'block_categories', 'custom_block_category', 10, 2);

/**
 * Enqueue block styles
 */
function vibe_enqueue_custom_blocks_styles() {
    $hero_rel_path = 'dist/css/blocks/block-hero/block-hero.css';
    $hero_full_path = get_theme_file_path( $hero_rel_path );
    
    if ( file_exists( $hero_full_path ) ) {
        wp_enqueue_style(
            'block-vibe-hero-style', 
            get_stylesheet_directory_uri() . '/' . $hero_rel_path, 
            [], 
            filemtime( $hero_full_path )
        );
    }

    $cta_rel_path = 'dist/css/blocks/block-cta/block-cta.css';
    $cta_full_path = get_theme_file_path( $cta_rel_path );
    
    if ( file_exists( $cta_full_path ) ) {
        wp_enqueue_style(
            'block-vibe-cta-style', 
            get_stylesheet_directory_uri() . '/' . $cta_rel_path, 
            [], 
            filemtime( $cta_full_path )
        );
    }
}

add_action( 'enqueue_block_assets', 'vibe_enqueue_custom_blocks_styles', 100 );
