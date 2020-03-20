<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
        <?php
        if ( function_exists( 'wp_body_open' ) ) {
            wp_body_open();
        } else {
            do_action( 'wp_body_open' );
        }
        ?>
		<header id="header" class="clearfix">
            <div id="header-container" class="clearfix">
                <div id="logo">
                    <a href="<?= home_url() ?>">
                        <?php the_custom_logo(); ?>
                    </a>
                </div>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'top',
                    'container' => 'nav',
                    'container_class' => 'menu-wrapper clearfix',
                    'container_id' => 'top-menu',
                ) );
                ?>
                <div id="menu-trigger"></div>
            </div>
        </header>
        