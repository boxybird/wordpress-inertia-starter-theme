<?php

namespace BoxyBird\Theme\Transformers;

use WP_Query;
use Illuminate\Support\Collection;

class PaginationTransformer
{
    protected static $wp_query;

    public static function transform(WP_Query $wp_query): Collection
    {
        self::$wp_query = $wp_query;

        return collect(self::pagination());
    }

    protected static function pagination(): array
    {
        $current_page = self::$wp_query->query['paged'] ?? 1;
        $prev_page    = $current_page > 1 ? $current_page - 1 : false;
        $next_page    = $current_page + 1;

        return [
            'prev_page'    => $prev_page,
            'next_page'    => $next_page,
            'current_page' => $current_page,
            'total_pages'  => self::$wp_query->max_num_pages,
            'total_posts'  => (int) self::$wp_query->found_posts,
        ];
    }
}
