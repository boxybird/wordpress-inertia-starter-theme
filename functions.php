<?php

use BoxyBird\Inertia\Inertia;

require_once __DIR__ . '/vendor/autoload.php';

define('WP_ENVIRONMENT_TYPE', 'local');

if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}

// Get manifest

function get_vite_manifest() {
    $manifest = file_get_contents(__DIR__ . '/dist/manifest.json');
    return json_decode($manifest, true);
}

// Enqueue files from manifest.json

add_filter( 'script_loader_tag', function ( $tag, $handle, $src ) {

    $url = esc_url($src);

    // module

    if (str_contains($handle, 'vite__module')) {
        return '<script type="module" crossorigin src="'. $url . '"></script>';
    }

    // preload

    if (str_contains($handle, 'vite__preload')) {
        return '<link rel="modulepreload" href="'. $url . '">';
    }

    // css

    if (str_contains($handle, 'vite__style')) {
        return '<link rel="stylesheet" href="'. $url . '">';
    }

    // default

    return $tag;

}, 10, 3 );

// Enqueue scripts.

add_action('wp_enqueue_scripts', function () {

    $environment = wp_get_environment_type();

    // serve dev bundle

    if ($environment === 'development' || $environment === 'local') {
        wp_enqueue_script('vite__client', 'http://localhost:3000/@vite/client', [], true);
        wp_enqueue_script('vite__module', 'http://localhost:3000/src/js/app.js', [], true);
    }

    // serve compiled bundle

    if ($environment === 'production') {

        $manifest = get_vite_manifest();

        // enqueue scripts

        foreach ($manifest as $key => $value) {

            // if key ends with .css

            if (str_contains($key, '.css')) {

                wp_enqueue_style('vite__style_' . $key, get_stylesheet_directory_uri() . '/dist/' . $value['file'], [], false);

            } else {

                // must be .vue or .js file

                // get imports, if exists

                if (!empty($value['imports'])) {
                        
                        foreach ($value['imports'] as $import) {

                            $import_file = $manifest[$import]['file'];

                            wp_enqueue_script('vite__preload_' . $key, get_stylesheet_directory_uri() . '/dist/' . $import_file, [], false, false);
                        }
                }

                // get bundle

                wp_enqueue_script('vite__module_' . $key, get_stylesheet_directory_uri() . '/dist/' . $value['file'], [], false, false);

            }

        }

    }

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
    $version = md5_file(get_stylesheet_directory() . '/dist/manifest.json');
    Inertia::version($version);
});