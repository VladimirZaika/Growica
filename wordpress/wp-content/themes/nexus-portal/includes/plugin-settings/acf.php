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
	$icon = '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                <path d="M27.9449 29.1833L29.1871 27.9411C30.4081 26.7192 32.084 26.1201 33.8112 26.1356C35.6679 26.1511 37.5304 25.3303 38.784 23.6691C40.4053 21.5197 40.4053 18.4753 38.784 16.3259C37.5304 14.6647 35.6679 13.8431 33.8112 13.8594C32.084 13.8741 30.4089 13.275 29.1871 12.0531L27.944 10.8101C26.723 9.5891 26.124 7.91407 26.1386 6.18768C26.1549 4.33008 25.3333 2.46756 23.6721 1.21394C21.4689 -0.448865 18.3365 -0.396682 16.1814 1.32888C13.2714 3.65926 13.097 7.91977 15.6581 10.4816C16.8709 11.6945 18.4636 12.292 20.0531 12.2773C21.7762 12.261 23.448 12.8593 24.6665 14.0778L25.8672 15.2785C27.1078 16.5191 27.728 18.2186 27.7207 19.9735C27.7207 19.9898 27.7207 20.0061 27.7207 20.0224C27.728 21.7773 27.1078 23.476 25.8672 24.7174L24.7195 25.865C23.4789 27.1056 21.7794 27.7259 20.0245 27.7194C20.0082 27.7194 19.992 27.7194 19.9756 27.7194C18.2207 27.7259 16.5221 27.1064 15.2807 25.865L14.0849 24.6692C12.8639 23.4482 12.2648 21.7732 12.2794 20.0469C12.2958 18.1892 11.4742 16.3267 9.81297 15.0739C7.60975 13.4111 4.47733 13.4633 2.3222 15.188C-0.588519 17.5176 -0.762947 21.7789 1.79891 24.3408C3.01178 25.5537 4.60446 26.1511 6.19393 26.1365C7.91706 26.1201 9.58883 26.7176 10.8074 27.9362L12.0553 29.1841C13.2763 30.4051 13.8754 32.081 13.8616 33.8081C13.8453 35.6657 14.6669 37.5274 16.3281 38.7811C18.4775 40.4023 21.5219 40.4023 23.6713 38.7811C25.3325 37.5274 26.1541 35.665 26.1378 33.8081C26.124 32.0801 26.723 30.4051 27.9449 29.1833Z" fill="#0A0D1B"/>
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
			'name'              => 'block-post-cards',
			'title'             => __('Post Cards Block'),
			'description'       => __('Post Cards Block Module'),
			'render_template'   => '/template-parts/blocks/block-post-cards/block-post-cards.php',
			'category'          => 'base-template-blocks',
			'keywords'          => ['primary', 'post-cards',''],
			'multiple'          => true,
			'icon' 				=> $icon,
			'mode'              => 'edit',
			'example'  => [
	            'attributes' => [
	                'mode' => 'preview',
	                'data' => [
	                	'preview_image_help' => get_theme_file_uri().'/src/images/block-post-cards.png',
					]
				]
			],
            'enqueue_assets' => function() {
                $stylePath = 'dist/css/blocks/block-post-cards/block-post-cards.css';
                $styleVersion = filemtime( get_theme_file_path($stylePath) );

                wp_enqueue_style(
                    'block-post-cards-style', 
                    get_theme_file_uri() . '/' . $stylePath, [], $styleVersion
                );
            },
		] );

		acf_register_block( [
			'name'              => 'block-numbered-tree',
			'title'             => __('Numbered Tree Block'),
			'description'       => __('Numbered Tree Block Module'),
			'render_template'   => '/template-parts/blocks/block-numbered-tree/block-numbered-tree.php',
			'category'          => 'base-template-blocks',
			'keywords'          => ['primary', 'numbered-tree',''],
			'multiple'          => true,
			'icon' 				=> $icon,
			'mode'              => 'edit',
			'example'  => [
	            'attributes' => [
	                'mode' => 'preview',
	                'data' => [
	                	'preview_image_help' => get_theme_file_uri().'/src/images/block-numbered-tree.png',
					]
				]
			],
            'enqueue_assets' => function() {
                $stylePath = 'dist/css/blocks/block-numbered-tree/block-numbered-tree.css';
                $styleVersion = filemtime( get_theme_file_path($stylePath) );

                wp_enqueue_style(
                    'block-numbered-tree-style', 
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

		acf_register_block( [
			'name'              => 'block-gallery',
			'title'             => __('Gallery Block'),
			'description'       => __('Gallery Module'),
			'render_template'   => '/template-parts/blocks/block-gallery/block-gallery.php',
			'category'          => 'base-template-blocks',
			'keywords'          => ['primary', 'gallery',''],
			'multiple'          => true,
			'icon' 				=> $icon,
			'mode'              => 'edit',
			'example'  => [
	            'attributes' => [
	                'mode' => 'preview',
	                'data' => [
	                	'preview_image_help' => get_theme_file_uri().'/src/images/block-gallery.png',
					]
				]
			],
            'enqueue_assets' => function() {
                $stylePath = 'dist/css/blocks/block-gallery/block-gallery.css';
                $styleVersion = filemtime( get_theme_file_path($stylePath) );

                wp_enqueue_style(
                    'block-gallery-style', 
                    get_theme_file_uri() . '/' . $stylePath, [], $styleVersion
                );
            },
		] );

		acf_register_block( [
			'name'              => 'block-text-and-cards',
			'title'             => __('Text and Cards Block'),
			'description'       => __('Text and Cards Module'),
			'render_template'   => '/template-parts/blocks/block-text-and-cards/block-text-and-cards.php',
			'category'          => 'base-template-blocks',
			'keywords'          => ['primary', 'text-and-cards',''],
			'multiple'          => true,
			'icon' 				=> $icon,
			'mode'              => 'edit',
			'example'  => [
	            'attributes' => [
	                'mode' => 'preview',
	                'data' => [
	                	'preview_image_help' => get_theme_file_uri().'/src/images/block-text-and-cards.png',
					]
				]
			],
            'enqueue_assets' => function() {
                $stylePath = 'dist/css/blocks/block-text-and-cards/block-text-and-cards.css';
                $styleVersion = filemtime( get_theme_file_path($stylePath) );

                wp_enqueue_style(
                    'block-text-and-cards-style', 
                    get_theme_file_uri() . '/' . $stylePath, [], $styleVersion
                );
            },
		] );

		acf_register_block( [
			'name'              => 'block-alternating-content',
			'title'             => __('Alternating Content Block'),
			'description'       => __('Alternating Content Module'),
			'render_template'   => '/template-parts/blocks/block-alternating-content/block-alternating-content.php',
			'category'          => 'base-template-blocks',
			'keywords'          => ['primary', 'alternating-content',''],
			'multiple'          => true,
			'icon' 				=> $icon,
			'mode'              => 'edit',
			'example'  => [
	            'attributes' => [
	                'mode' => 'preview',
	                'data' => [
	                	'preview_image_help' => get_theme_file_uri().'/src/images/block-alternating-content.png',
					]
				]
			],
            'enqueue_assets' => function() {
                $stylePath = 'dist/css/blocks/block-alternating-content/block-alternating-content.css';
                $styleVersion = filemtime( get_theme_file_path($stylePath) );

                wp_enqueue_style(
                    'block-alternating-content-style', 
                    get_theme_file_uri() . '/' . $stylePath, [], $styleVersion
                );
            },
		] );

		acf_register_block( [
			'name'              => 'block-form',
			'title'             => __('Form Block'),
			'description'       => __('Form Module'),
			'render_template'   => '/template-parts/blocks/block-form/block-form.php',
			'category'          => 'base-template-blocks',
			'keywords'          => ['primary', 'form',''],
			'multiple'          => true,
			'icon' 				=> $icon,
			'mode'              => 'edit',
			'example'  => [
	            'attributes' => [
	                'mode' => 'preview',
	                'data' => [
	                	'preview_image_help' => get_theme_file_uri().'/src/images/block-form.png',
					]
				]
			],
            'enqueue_assets' => function() {
                $stylePath = 'dist/css/blocks/block-form/block-form.css';

                $styleVersion = filemtime( get_theme_file_path($stylePath) );

                wp_enqueue_style( 'block-form-style', get_theme_file_uri() . '/' . $stylePath, [], $styleVersion );
            },
		] );
	}
}

add_action('acf/init', 'custom_blocks_acf_init');

/**
 * Define Movies category module Gutenberg
 */
function custom_block_category( $categories, $post ) {
	$custom_block = [
	  'slug' => 'base-template-blocks',
	  'title' => __( 'Datase Pros Modules', 'custom-blocks' ),
	];

	$categories_sorted = [];
	$categories_sorted[0] = $custom_block;

	foreach ($categories as $category) {
		$categories_sorted[] = $category;
	}

	return $categories_sorted;
}

add_filter( 'block_categories', 'custom_block_category', 10, 2);
