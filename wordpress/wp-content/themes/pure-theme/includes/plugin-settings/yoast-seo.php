<?php
/**
 * Custom meta
 */
add_filter( 'wpseo_title', 'custom_seo_titles' );
add_filter( 'wpseo_opengraph_title', 'custom_seo_titles' );

function custom_seo_titles( $title ) {
    if ( is_404() ) {
        $custom_title = get_field( 'seo_title_not_found', 'options' );

        if ( $custom_title ) {
            return $custom_title;
        }
    }

    return $title;
};

add_filter( 'wpseo_opengraph_type', function( $type ) {
    if ( is_category() || is_page() ) {
        return 'website';
    }

    return $type;
});
