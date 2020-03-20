<?php
namespace BlankTheme;

class BlankTheme {

    /**
     * Theme name
     * 
     * @var string
     */
    public $name;

    /**
     * Theme version
     * 
     * @var string
     */
    public $version;

    /**
     * Initialize the class and set its properties.
     * 
     * @return BlankTheme
     */
    public function __construct() {
        $this->name = wp_get_theme()->get( 'Name' );
        $this->version = wp_get_theme()->get( 'Version' );
    }

    /**
     * Add an action to the 'init' hook
     *
     * @param Closure $function
     * @access private
     * @return void
     */
    private function actionInit( $function )
    {
        add_action( 'init', function() use ( $function ) {
            $function();
        } );
    }

    /**
     * Add an action to the 'template_redirect' hook
     *
     * @param Closure $function
     * @access private
     * @return void
     */
    private function actionTemplateRedirect( $function )
    {
        add_action( 'template_redirect', function() use ( $function ) {
            $function();
        } );
    }

    /**
     * Add an action to the 'after_setup_theme' hook
     *
     * @param Closure $function
     * @access private
     * @return void
     */
    private function actionAfterSetup( $function )
    {
        add_action( 'after_setup_theme', function() use ( $function ) {
            $function();
        } );
    }

    /**
     * Add an action to the 'wp_enqueue_scripts' hook
     *
     * @param Closure $function
     * @access private
     * @return void
     */
    private function actionEnqueueScripts( $function )
    {
        add_action( 'wp_enqueue_scripts', function() use ( $function ) {
            $function();
        } );
    }

    /**
     * Add an action to the 'admin_enqueue_scripts' hook
     *
     * @param [type] $function
     * @return void
     */
    private function actionEnqueueAdminScripts( $function ) {
        add_action( 'admin_enqueue_scripts', function() use ( $function ) {
            $function();
        } );
    }

    /**
     * Add an action to the 'widgets_init' hook
     *
     * @param Closure $function
     * @access private
     * @return void
     */
    private function actionWidgetsInit( $function )
    {
        add_action( 'widgets_init', function() use ( $function ) {
            $function();
        } );
    }

    /**
     * Add an action to the 'admin_menu' hook
     *
     * @param Closure $function
     * @access private
     * @return void
     */
    private function actionAdminMenu( $function ) {
        add_action( 'admin_menu', function() use ( $function ) {
            $function();
        } );
    }

    /**
     * Add an action to the 'add_meta_boxes' hook
     *
     * @param Closure $function
     * @access private
     * @return void
     */
    private function actionAddMetaBoxes ( $function ) {
        add_action( 'add_meta_boxes', function() use ( $function ) {
            $function();
        } );
    }

    /**
     * Registers theme support for a given feature
     *
     * @param string $feature
     * @param array $options
     * @return BlankTheme
     */
    public function addSupport( $feature, $options = null )
    {
        $this->actionAfterSetup( function() use ( $feature, $options ) {
            if ( $options ){
                add_theme_support( $feature, $options );
            } else {
                add_theme_support( $feature );
            }
        } );
        return $this;
    }

    /**
     * Register a new image size
     *
     * @param string $name
     * @param integer $width
     * @param integer $height
     * @param boolean $crop
     * @return BlankTheme
     */
    public function addImageSize( $name, $width = 0, $height = 0, $crop = false )
    {
        $this->actionAfterSetup( function() use ( $name, $width, $height, $crop ) {
            add_image_size( $name, $width, $height, $crop );
        } );
        return $this;
    }

    /**
     * Remove an image size
     *
     * @param string $name
     * @return BlankTheme
     */
    public function removeImageSize( $name )
    {
        $this->actionAfterSetup( function() use ( $name ) {
            remove_image_size( $name );
        } );
        return $this;
    }

    /**
     * Enqueue a CSS stylesheet
     *
     * @param string $handle
     * @param string $src
     * @param array $deps
     * @param string $ver
     * @param string $media
     * @return BlankTheme
     */
    public function addStyle( $handle, $src = '', $deps = array(), $ver = '', $media = 'all' )
    {
        if ( $ver === '' ) $ver = $this->version;
        $this->actionEnqueueScripts( function() use ( $handle, $src, $deps, $ver, $media ) {
            wp_enqueue_style( $handle, $src, $deps, $ver, $media );
        } );
        return $this;
    }

    /**
     * Enqueue a script
     *
     * @param string $handle
     * @param string $src
     * @param array $deps
     * @param string $ver
     * @param boolean $in_footer
     * @return BlankTheme
     */
    public function addScript( $handle, $src = '', $deps = array(), $ver = '', $in_footer = false )
    {
        if ( $ver === '' ) $ver = $this->version;
        $this->actionEnqueueScripts( function() use ( $handle, $src, $deps, $ver, $in_footer ) {
            wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
        } );
        return $this;
    }

    /**
     * Localize a script
     *
     * @param string $handle
     * @param string $object_name
     * @param array $l10n
     * @return BlankTheme
     */
    public function localizeScript( $handle, $object_name, $l10n)
    {
        $this->actionEnqueueScripts( function() use ( $handle, $object_name, $l10n ) {
            wp_localize_script( $handle, $object_name, $l10n );
        } );
        return $this;
    }

    /**
     * Remove a registered stylesheet
     *
     * @param string $handle
     * @return BlankTheme
     */
    public function removeStyle( $handle )
    {
        $this->actionEnqueueScripts( function() use ( $handle ) {
            wp_dequeue_style( $handle );
            wp_deregister_style( $handle ); 
        } );
        return $this;
    }

    /**
     * Remove a registered script
     *
     * @param string $handle
     * @return BlankTheme
     */
    public function removeScript( $handle )
    {
        $this->actionEnqueueScripts( function() use ( $handle ) {
            wp_dequeue_script( $handle );
            wp_deregister_script( $handle );   
        } );
        return $this;
    }

    /**
     * Enqueue an admin script
     *
     * @param string $handle
     * @param string $src
     * @param array $deps
     * @param string $ver
     * @param boolean $in_footer
     * @return BlankTheme
     */
    public function addAdminScript( $handle, $src = '', $deps = array(), $ver = '', $in_footer = false )
    {
        if ( $ver === '' ) $ver = $this->version;
        $this->actionEnqueueAdminScripts( function() use ( $handle, $src, $deps, $ver, $in_footer ) {
            wp_enqueue_script($handle, $src, $deps, $ver, $in_footer );
        } );
        return $this;
    }

    /**
     * Enqueue an admin style
     *
     * @param string $handle
     * @param string $src
     * @param array $deps
     * @param string $ver
     * @param string $media
     * @return BlankTheme
     */
    public function addAdminStyle( $handle, $src = '', $deps = array(), $ver = '', $media = 'all' )
    {
        if ( $ver === '' ) $ver = $this->version;
        $this->actionEnqueueAdminScripts( function() use ( $handle, $src, $deps, $ver, $media ) {
            wp_enqueue_style( $handle, $src, $deps, $ver, $media );
        } );
        return $this;
    }

    /**
     * Enqueue WPMediaScripts
     *
     * @param array $args
     * @return BlankTheme
     */
    public function addWPMediaScripts( $args = array() )
    {
        $this->actionEnqueueAdminScripts( function() use ( $args ) {
            wp_enqueue_media( $args );
        } );
        return $this;
    }

    /**
     * Register a navigation menu
     *
     * @param string $location
     * @param string $description
     * @return BlankTheme
     */
    public function addNavMenu( $location, $description )
    {
        $this->actionAfterSetup( function() use ( $location, $description ) {
            register_nav_menu( $location, $description );
        } );
        return $this;
    }

    /**
     * Register a widget area
     *
     * @param array $args
     * @return BlankTheme
     */
    public function addWidgetArea( $args )
    {
        $this->actionWidgetsInit( function() use ( $args ) {
            register_sidebar( $args );
        } );
        return $this;
    }

    /**
     * Register a menu page
     *
     * @param string $page_title
     * @param string $menu_title
     * @param string $capability
     * @param string $menu_slug
     * @param mixed $function
     * @param string $icon_url
     * @param mixed $position
     * @return BlankTheme
     */
    public function addMenuPage( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url = '', $position = null )
    {
        $this->actionAdminMenu( function() use ( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position ) {
            add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
        } );
        return $this;
    }

    /**
     * Register a menu page
     *
     * @param string $parent_slug
     * @param string $page_title
     * @param string $menu_title
     * @param string $capability
     * @param string $menu_slug
     * @param mixed $function
     * @param mixed $position
     * @return BlankTheme
     */
    public function addSubmenuPage( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function, $position = null )
    {
        $this->actionAdminMenu( function() use ( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function, $position ) {
            add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function, $position );
        } );
        return $this;
    }

    /**
     * Register a metabox
     *
     * @param string $id
     * @param string $title
     * @param mixed $callback
     * @param mixed $screen
     * @param string $context
     * @param string $priority
     * @param array $callback_args
     * @return BlankTheme
     */
    public function addMetaBox( $id, $title, $callback, $screen = null, $context = 'advanced', $priority = 'default', $callback_args = array() )
    {
        $this->actionAddMetaBoxes( function() use ( $id, $title, $callback, $screen, $context, $priority, $callback_args ) {
            add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );
        } );
        return $this;
    }
}