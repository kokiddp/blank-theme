<?php get_header(); ?>

<div id="main" class="clearfix">
    <div id="container" class="clearfix">
        <h1><?php _e( 'Oops, qualcosa è andato storto...', 'blank-theme' ); ?></h1>
        <p><?php _e( 'Impossibile trovare la pagina che stavi cercando (errore 404)', 'blank-theme' ); ?></p>
        <div class="wp-block-button aligleft">
            <a class="wp-block-button__link" href="<?php echo home_url(); ?>"><?php _e( 'Torna alla Home', 'blank-theme' ); ?></a>
        </div>
    </div>
</div>

<?php get_footer(); ?>