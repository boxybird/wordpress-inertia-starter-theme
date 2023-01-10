<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php wp_head(); ?>

        <!-- warning message, safe to remove -->
    
        <?php if (wp_get_environment_type() === 'production') : ?>
            <script>
                console.info('Wordpress is running in production mode. This will prevent hot reload (HMR) from working. You can define your environment using the WP_ENVIRONMENT_TYPE constant in your wp-config.php file. Read more: https://make.wordpress.org/core/2020/07/24/new-wp_get_environment_type-function-in-wordpress-5-5/');
            </script>
        <?php endif; ?>

        <?php if (wp_get_environment_type() === 'local') : ?>
            <script>
                console.info('Wordpress is running in local mode. This will only work if Vite is running - do not use in production! You can define your environment using the WP_ENVIRONMENT_TYPE constant in your wp-config.php file. Read more: https://make.wordpress.org/core/2020/07/24/new-wp_get_environment_type-function-in-wordpress-5-5/');
            </script>
        <?php endif; ?>

        <?php if (wp_get_environment_type() === 'development') : ?>
            <script>
                console.info('Wordpress is running in development mode. This will only work if Vite is running - do not use in production! You can define your environment using the WP_ENVIRONMENT_TYPE constant in your wp-config.php file. Read more: https://make.wordpress.org/core/2020/07/24/new-wp_get_environment_type-function-in-wordpress-5-5/');
            </script>
        <?php endif; ?>

    </head>
    <body>

        <?php bb_inject_inertia(); ?>

        <?php wp_footer(); ?>

    </body>
</html>