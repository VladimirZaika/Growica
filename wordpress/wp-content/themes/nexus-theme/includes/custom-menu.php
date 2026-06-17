<?php

function register_custom_menus() {
    register_nav_menus([
        'landing'   => 'Landing Menu',
    ]);
}

add_action('after_setup_theme', 'register_custom_menus');