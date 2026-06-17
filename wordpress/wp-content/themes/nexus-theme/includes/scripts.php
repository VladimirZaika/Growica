<?php
function nexus_dynamic_styles() {
    $notFoundPageVer = filemtime( get_theme_file_path('dist/css/template/not-found/not-found.css') );
    
    $scriptVersion = filemtime( get_theme_file_path('dist/js/main.js') );

    wp_enqueue_style( 'generatepress-parent-style', get_template_directory_uri() . '/style.css', [], wp_get_theme( 'generatepress' )->get( 'Version' ) );
    wp_enqueue_style( 'nexus-style', get_stylesheet_directory_uri() . '/style.css', [ 'generatepress-parent-style' ], wp_get_theme()->get( 'Version' ) );

    wp_enqueue_script( 'nexus-scripts', get_theme_file_uri( 'dist/js/main.js' ), [], $scriptVersion, true );


    if ( is_404() ) {
        wp_enqueue_style( 'nexus-not-found-styles', get_theme_file_uri( 'dist/css/template/not-found/not-found.css' ), [], $notFoundPageVer );
    }
    
    $primaryColor = get_theme_mod('primary_color', '#305CDE');
    $secondaryColor = get_theme_mod('secondary_color', '#88A0B8');
    $textColor = get_theme_mod('text_color', '#ffffff');
    $bodyColor = get_theme_mod('body_color', '#1e1e1e');
    $errorColor = get_theme_mod('error_color', '#C64D34');
    $successColor = get_theme_mod('success_color', '#61FF87');
    $optionalColor1 = get_theme_mod('optional_color_1', '#cbcbcb');
    $bodyFont = get_theme_mod('body_font', 'Inter, sans-serif');
    $headingFont = get_theme_mod('heading_font', 'Roboto, sans-serif');

    $customCss = "
        :root {
            --primary-color-nexus: $primaryColor;
            --primary-color-nexus-80: rgba(" . hexToRgb($primaryColor) . ", 0.8);
            --primary-color-nexus-70: rgba(" . hexToRgb($primaryColor) . ", 0.7);
            --primary-color-nexus-54: rgba(" . hexToRgb($primaryColor) . ", 0.54);

            --secondary-color-nexus: $secondaryColor;
            --secondary-color-nexus-60: rgba(" . hexToRgb($secondaryColor) . ", 0.6);
            --secondary-color-nexus-50: rgba(" . hexToRgb($secondaryColor) . ", 0.5);
            --secondary-color-nexus-45: rgba(" . hexToRgb($secondaryColor) . ", 0.45);
            --secondary-color-nexus-35: rgba(" . hexToRgb($secondaryColor) . ", 0.35);
            --secondary-color-nexus-25: rgba(" . hexToRgb($secondaryColor) . ", 0.25);
            --secondary-color-nexus-15: rgba(" . hexToRgb($secondaryColor) . ", 0.15);

            --text-color-nexus: $textColor;
            --text-color-nexus-85: rgba(" . hexToRgb($textColor) . ", 0.85);
            --text-color-nexus-75: rgba(" . hexToRgb($textColor) . ", 0.75);
            --text-color-nexus-65: rgba(" . hexToRgb($textColor) . ", 0.65);
            --text-color-nexus-50: rgba(" . hexToRgb($textColor) . ", 0.5);
            --text-color-nexus-40: rgba(" . hexToRgb($textColor) . ", 0.4);
            --text-color-nexus-20: rgba(" . hexToRgb($textColor) . ", 0.20);
            --text-color-nexus-14: rgba(" . hexToRgb($textColor) . ", 0.14);

            --body-color-nexus: $bodyColor;
            --body-color-nexus-80: rgba(" . hexToRgb($bodyColor) . ", 0.8);
            --body-color-nexus-50: rgba(" . hexToRgb($bodyColor) . ", 0.5);
            --body-color-nexus-30: rgba(" . hexToRgb($bodyColor) . ", 0.3);
            --body-color-nexus-10: rgba(" . hexToRgb($bodyColor) . ", 0.1);
            --body-color-nexus-5: rgba(" . hexToRgb($bodyColor) . ", 0.05);

            --error-color-nexus: $errorColor;
            --success-color-nexus: $successColor;
            --optional-color-nexus-1: $optionalColor1;
            --body-font: $bodyFont;
            --heading-font: $headingFont;
        }";

    wp_add_inline_style( 'nexus-style', $customCss );
};

add_action('wp_enqueue_scripts', 'nexus_dynamic_styles');