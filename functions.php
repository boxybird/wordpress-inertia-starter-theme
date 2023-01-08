<?php

use BoxyBird\Inertia\Inertia;

require_once __DIR__ . '/vendor/autoload.php';

// Enqueue bundles using type=module
add_filter( 'script_loader_tag', function ( $tag, $handle, $src ) {

    $url = esc_url($src);

	switch ( $handle ) {
        case 'vite_bundle':

            return <<<EOD
                <link rel="modulepreload" href=" $url">
                <script type="module" crossorigin src=" $url"></script>
            EOD;

		default:
			return $tag;
			break;
	}

}, 10, 3 );

// Enqueue scripts.
add_action('wp_enqueue_scripts', function () {
    
    $environment = wp_get_environment_type();

    // serve dev bundle

    if ($environment === 'development' || $environment === 'local') {
        wp_enqueue_script('vite_bundle', 'http://localhost:3000/src/js/app.js', [], true);
        wp_enqueue_script('vite_client', 'http://localhost:3000/@vite/client', [], true);
    }

    // serve compiled bundle

    if ($environment === 'production') {
        $version = md5_file(get_stylesheet_directory() . '/dist/app.js');
        wp_enqueue_script('prod_bundle', get_stylesheet_directory_uri() . '/dist/app.js', [], $version, true);
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