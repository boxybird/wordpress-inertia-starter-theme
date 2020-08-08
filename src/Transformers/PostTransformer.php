<?php

namespace BoxyBird\Theme\Transformers;

use WP_Query;
use Illuminate\Support\Collection;

class PostTransformer
{
    protected static $wp_query;

    public static function transform(WP_Query $wp_query): Collection
    {
        self::$wp_query = $wp_query;

        return collect(self::posts());
    }

    protected static function posts(): array
    {
        return collect(self::$wp_query->posts)
            ->map(function ($post) {
                return [
                    'id'      => $post->ID,
                    'title'   => get_the_title($post->ID),
                    'content' => apply_filters('the_content', get_the_content(null, false, $post->ID)),
                    'link'    => get_the_permalink($post->ID),
                    'excerpt' => wp_trim_words(get_the_excerpt($post->ID), 50),
                    'image'   => [
                        'sizes' => [
                            'full' => get_the_post_thumbnail_url($post->ID),
                        ],
                        'meta' => [
                            'alt' => get_post_meta(
                                get_post_thumbnail_id($post->ID),
                                '_wp_attachment_image_alt',
                                true
                            ),
                        ],
                    ],
                ];
            })
            ->toArray();
    }
}
