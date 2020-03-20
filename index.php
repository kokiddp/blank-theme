<?php get_header(); ?>

<div id="main" class="clearfix">
    <div id="container" class="clearfix">
        <h1><?php bloginfo( 'name' ); ?></h1>
        <?php
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post();
                    ?>
                        <div class="entry" class="clearfix">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <?php the_excerpt(); ?>
                        </div>
                    <?php
                }
            }
        ?>
    </div>
</div>

<?php get_footer(); ?>