<?php

use BoxyBird\Inertia\Inertia;

require_once __DIR__ . '/vendor/autoload.php';

// Enqueue scripts.
add_action('wp_enqueue_scripts', function () {
    $version = md5_file(get_stylesheet_directory() . '/dist/mix-manifest.json');

    wp_enqueue_script('bb_theme', get_stylesheet_directory_uri() . '/dist/app.js', [], $version, true);
});

// Share globally with Inertia views
add_action('after_setup_theme', function () {
    Inertia::share([
        'site' => [
            'name'        => get_bloginfo('name'),
            'description' => get_bloginfo('description'),
        ],
    ]);
});

// Add Inertia version. Helps with cache busting
add_action('after_setup_theme', function () {
    $version = md5_file(get_stylesheet_directory() . '/dist/mix-manifest.json');

    Inertia::version($version);
});
