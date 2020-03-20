<?php
namespace BlankTheme;

//Requires
require_once( trailingslashit( get_template_directory() ) . 'includes/class-blank.theme.php' );

//Init theme
$theme = new BlankTheme;
$theme->addSupport( 'title-tag' )
    ->addSupport( 'post-thumbnails' )
    ->addSupport( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ) )
    ->addSupport( 'custom-logo' )
    ->removeScript( 'jquery' )
    ->removeScript( 'jquery-migrate' )
    ->addStyle( $theme->name, get_stylesheet_uri(), array(), time() )
    ->addScript( $theme->name, get_template_directory_uri() . '/js/scripts-bundled.js', array(), time() )
    ->addNavMenu( 'top', 'Top Menu' )
    ->addNavMenu( 'bottom', 'Bottom Menu' )
    ->addWidgetArea( array(
        'name'          => 'Footer Area 1',
        'id'            => 'footer-area-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>',
    ) )
    ->addWidgetArea( array(
        'name'          => 'Footer Area 2',
        'id'            => 'footer-area-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>',
    ) )
    ->addWidgetArea( array(
        'name'          => 'Footer Area 3',
        'id'            => 'footer-area-3',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>',
    ) );