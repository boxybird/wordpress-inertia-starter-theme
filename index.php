<?php

use BoxyBird\Inertia\Inertia;
use BoxyBird\Theme\Transformers\PostTransformer;
use BoxyBird\Theme\Transformers\PaginationTransformer;

if (is_home()) {
    return Inertia::render('Index', [
        'posts'      => PostTransformer::transform($wp_query),
        'pagination' => PaginationTransformer::transform($wp_query),
    ]);
}

if (is_single()) {
    return Inertia::render('Single', [
        'post' => PostTransformer::transform($wp_query)->first(),
    ]);
}

if (is_page()) {
    return Inertia::render('Page', [
        'page' => $wp_query->post,
    ]);
}

if (is_404()) {
    return Inertia::render('404', [
        'content' => '404 - Not Found',
    ]);
}
