<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php wp_head(); ?>
    </head>
    <body>

        <?php if (wp_get_environment_type() === 'production') : ?>
            <span>Warning: Wordpress is running in production mode. This will prevent the hot reload feature from working.</span>
        <?php endif; ?>

        <?php bb_inject_inertia(); ?>

        <?php wp_footer(); ?>

    </body>
</html>