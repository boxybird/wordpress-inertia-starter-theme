<?php

use BoxyBird\Inertia\Inertia;

require_once __DIR__ . '/vendor/autoload.php';

// WP enqueue
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('bb_theme', get_stylesheet_directory_uri() . '/dist/css/app.css');
    wp_enqueue_script('bb_theme', get_stylesheet_directory_uri() . '/dist/js/app.js', ['jquery'], ['latest'], true);

    wp_localize_script('bb_theme', 'bbTheme', [
        'nonce' => wp_create_nonce('wp_rest'),
    ]);
});

// Change Inertia root view. By default it's 'app.php'
add_action('after_setup_theme', function () {
    // Inertia::setRootView('layout.php');
});

// Share globally with Inertia views
add_action('after_setup_theme', function () {
    Inertia::share([
        'site' => [
            'name'        => get_bloginfo('name'),
            'description' => get_bloginfo('description'),
        ],
    ]);

    Inertia::share([
        'primary_menu' => array_map(function ($menu_item) {
            return [
                'id'   => $menu_item->ID,
                'link' => $menu_item->url,
                'name' => $menu_item->title,
            ];
        }, wp_get_nav_menu_items('Primary Menu') ?: []),
    ]);
});

// Share session with Inertia views
add_action('after_setup_theme', function () {
    if (empty(session_id())) {
        session_start();
    }

    Inertia::share('toast_message', function () {
        if (!empty($_SESSION['toast_message'])) {
            return $_SESSION['toast_message'];
        }
    });

    if (!empty(session_id())) {
        session_unset();
    }
});

// Add Inertia verison. Helps with cache busting
add_action('after_setup_theme', function () {
    $manifest = get_stylesheet_directory() . '/mix-manifest.json';

    Inertia::version(md5_file($manifest));
});

// General WP theme options
add_action('after_setup_theme', function () {
    add_theme_support('menus');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    register_nav_menus([
        'primary-menu' => 'Primary Menu',
    ]);
});
