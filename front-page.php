<?php get_header(); ?>

<div id="main" class="clearfix">
    <div id="container" class="clearfix">
        <h1><?php bloginfo( 'name' ); ?></h1>
        <h3><?php bloginfo( 'description' ); ?></h3>
        <?php
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post();
                    ?>
                        <?php the_content(); ?>
                    <?php
                }
            }
        ?>
    </div>
</div>

<?php get_footer(); ?>