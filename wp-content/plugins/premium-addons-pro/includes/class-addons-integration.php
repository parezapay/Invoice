<?php

namespace PremiumAddonsPro;

use PremiumAddonsPro\Admin\Settings\Premium_Pro_Admin_Settings;

if( ! defined( 'ABSPATH' ) ) exit();

class Addons_Integration {
    
    private static $instance = null;
    
    public function __construct() {
        
        //Load plugin icons font
        add_action( 'elementor/editor/before_enqueue_styles', array( $this, 'enqueue_icon_font' ) );
        
        // Load widgets files
        add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_register' ) );
        
        // Enqueue Editor assets
        add_action( 'elementor/editor/before_enqueue_scripts', array( $this,'enqueue_editor_scripts') );
        
        // Enqueue Preview CSS files
        add_action( 'elementor/preview/enqueue_styles', array( $this, 'enqueue_preview_styles' ) );
        
        // Register Frontend CSS files
        add_action( 'elementor/frontend/after_register_styles', array( $this, 'register_frontend_styles' ) );
        
        // Enqueue Frontend CSS files
        add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'enqueue_frontend_styles' ) );
        
        // Registers Frontend JS files
        add_action( 'elementor/frontend/after_register_scripts', array( $this, 'register_frontend_scripts' ) );
        
        // Registers Editor Required AJAX Hooks
//        add_action( 'wp_ajax_save_pa_editor_data', array( $this, 'update_option' ) );
//        
//        add_action( 'wp_ajax_get_pa_editor_data', array( $this, 'get_option' ) );
        
    }
    
    public function update_option() {
        
        $option_key = $_REQUEST['option_key'];
        
        $option_value = $_REQUEST['option_value'];
        
        if( ! isset( $option_key ) || ! isset( $option_value ) ) {
            return;
        }
        
        update_option( $option_key, $option_value );
        
        wp_send_json_success();
    }
    
    public function get_option() {
        
        $option_key = $_GET['option_key'];
        
        if( ! isset( $option_key ) ) {
            return;
        }
        
        $settings = get_option( $option_key, false );
        
        $data = array(
            'settings'  => $settings
        );
        
        wp_send_json_success( $data );
    }
    
    /**
    * Loads plugin icons font
    * @since 1.0.0
    * @access public
    * @return void
    */
    public function enqueue_icon_font() {
        wp_enqueue_style(
            'premium-pro-elements',
            PREMIUM_PRO_ADDONS_URL . 'admin/assets/pa-elements-font/css/pa-elements.css'
        );
        
    }
    
    /**
    * Enqueue Editor assets
    * @since 1.4.5
    * @access public
    * @return void
    */
    public function enqueue_editor_scripts() {
        
        wp_enqueue_script(
            'papro-editor',
            PREMIUM_PRO_ADDONS_URL . 'assets/js/editor.js', 
            array(),
            PREMIUM_PRO_ADDONS_VERSION,
            'all'
        );
        
    }
    
    /** 
    * Register Front CSS files
    * @since 1.2.8
    * @access public
    */
    public function register_frontend_styles() {
        
        wp_register_style(
            'tooltipster',
            PREMIUM_PRO_ADDONS_URL . 'assets/css/tooltipster.min.css', 
            array(),
            PREMIUM_PRO_ADDONS_VERSION,
            'all'
        );
        
        wp_register_style(
            'tooltipster-themes',
            PREMIUM_PRO_ADDONS_URL . 'assets/css/tooltipster-themes.min.css', 
            array(),
            PREMIUM_PRO_ADDONS_VERSION,
            'all'
        );
        
    }
    
    /** 
    * Enqueue Preview CSS files
    * @since 1.2.8
    * @access public
    */
    public function enqueue_preview_styles() {
        
        wp_enqueue_style('tooltipster');
        
        wp_enqueue_style('tooltipster-themes');
     
    }
    
    /** Load widgets require function
    * @since 1.0.0
    * @access public
    */
    public function widgets_register() {
        $this->premium_pro_widgets_area();
    }
    
    /** 
    * Enqueue required CSS files
    * @since 1.2.7
    * @access public
    */
    public function enqueue_frontend_styles() {
        wp_enqueue_style(
            'premium-pro',
            PREMIUM_PRO_ADDONS_URL . 'assets/css/premium-addons.css',
            array(),
            PREMIUM_PRO_ADDONS_VERSION,
            'all'
        );
    }
    
    /** Requires widgets files
    * @since 1.0.0
    * @access private
    */
    private function premium_pro_widgets_area() {

        $check_component_active = Premium_Pro_Admin_Settings::get_enabled_keys();
        
        foreach ( glob( PREMIUM_PRO_ADDONS_PATH . 'widgets/' . '*.php' ) as $file ) {
            $slug = basename( $file, '.php' );
            
            $enabled = isset( $check_component_active[ $slug ] ) ? $check_component_active[ $slug ] : '';
            
            if ( filter_var( $enabled, FILTER_VALIDATE_BOOLEAN ) || ! $check_component_active ) {
                $this->register_addon( $file );
            }
        }

    }
    
    /** Registers required JS files
    * @since 1.0.0
    * @access public
    */
    public function register_frontend_scripts() {
        
        $magic_section = Premium_Pro_Admin_Settings::get_enabled_keys()['premium-magic-section'];
        
        wp_register_script(
            'premium-pro-js',
            PREMIUM_PRO_ADDONS_URL . 'assets/js/premium-addons.js',
            array(
                'jquery',
                'jquery-ui-draggable',
                'jquery-ui-sortable',
                'jquery-ui-resizable'
            ),
            PREMIUM_PRO_ADDONS_VERSION,
            true
        );
        
        $data = array(
            'ajaxurl'       => esc_url( admin_url( 'admin-ajax.php' ) ),
            'magicSection'  => $magic_section ? true : false
        );
        
		wp_localize_script( 'premium-pro-js', 'PremiumProSettings', $data );

        wp_register_script(
            'codebird-js',
            PREMIUM_PRO_ADDONS_URL . 'assets/js/lib/codebird.min.js',
            array('jquery'),
            PREMIUM_PRO_ADDONS_VERSION,
            true
        );
        
        wp_register_script(
            'dot-js',
            PREMIUM_PRO_ADDONS_URL . 'assets/js/lib/doT.min.js',
            array('jquery'),
            PREMIUM_PRO_ADDONS_VERSION,
            true
        );
            
        wp_register_script(
            'jquery-socialfeed-js',
            PREMIUM_PRO_ADDONS_URL . 'assets/js/lib/jquery.socialfeed.min.js',
            array('jquery'),
            PREMIUM_PRO_ADDONS_VERSION,
            true
        );

        wp_register_script(
            'instafeed-js', 
            PREMIUM_PRO_ADDONS_URL . 'assets/js/lib/instafeed.min.js',
            array(), 
            PREMIUM_PRO_ADDONS_VERSION, 
            true
        );
        
        wp_register_script(
            'chart-js', 
            PREMIUM_PRO_ADDONS_URL . 'assets/js/lib/charts.min.js', 
            array(), 
            PREMIUM_PRO_ADDONS_VERSION, 
            false
        );
        
        wp_register_script(
            'event-move',
            PREMIUM_PRO_ADDONS_URL . 'assets/js/lib/jquery.event.move.min.js', 
            array('jquery'), 
            PREMIUM_PRO_ADDONS_VERSION, 
            true
        );
            
        wp_register_script(
            'pa-imgcompare', 
            PREMIUM_PRO_ADDONS_URL . 'assets/js/lib/imgcompare.min.js', 
            array('jquery'), 
            PREMIUM_PRO_ADDONS_VERSION, 
            true
        );
        
        wp_register_script(
            'premium-behance-js', 
            PREMIUM_PRO_ADDONS_URL . 'assets/js/lib/embed.behance.min.js',
            array('jquery'), 
            PREMIUM_PRO_ADDONS_VERSION,
            true
        );
        
        wp_register_script(
            'tweenmax-js', 
            PREMIUM_PRO_ADDONS_URL.'assets/js/lib/TweenMax.min.js',
            array( 'jquery' ), 
            PREMIUM_PRO_ADDONS_VERSION, 
            true
        );
        
        wp_register_script(
            'tilt-js', 
            PREMIUM_PRO_ADDONS_URL.'assets/js/lib/universal-tilt.min.js',
            array( 'jquery' ), 
            PREMIUM_PRO_ADDONS_VERSION, 
            true
        );
        
        wp_register_script(
            'table-sorter',
            PREMIUM_PRO_ADDONS_URL . 'assets/js/lib/jquery.tablesorter.min.js',
            array('jquery'),
            PREMIUM_PRO_ADDONS_VERSION,
            true
        );
        
        wp_register_script(
            'tooltipster-bundle-js',
            PREMIUM_PRO_ADDONS_URL . 'assets/js/lib/tooltipster.bundle.min.js',
            array(),
            PREMIUM_PRO_ADDONS_VERSION,
            true
        );
        
        wp_register_script( 'multi-scroll',
            PREMIUM_PRO_ADDONS_URL . 'assets/js/lib/jquery.multiscroll.min.js',
            array('jquery'),
            PREMIUM_PRO_ADDONS_VERSION,
            true
        );

    }
    
    /**
    * Register addon by file name
    *
    * @param  string $file            File name.
    * @param  object $widgets_manager Widgets manager instance.
    * @return void
    */
    public function register_addon( $file ) {

        $widget_manager = \Elementor\Plugin::instance()->widgets_manager;
        
        $base  = basename( str_replace( '.php', '', $file ) );
        $class = ucwords( str_replace( '-', ' ', $base ) );
        $class = str_replace( ' ', '_', $class );
        $class = sprintf( 'PremiumAddonsPro\Widgets\%s', $class );
        
        require $file;
        
        if ( 'PremiumAddonsPro\Widgets\Premium_Facebook_Reviews'== $class || 'PremiumAddonsPro\Widgets\Premium_Google_Reviews' == $class ) {
            require_once ( PREMIUM_PRO_ADDONS_PATH . 'includes/deps/urlopen.php' );

            require_once ( PREMIUM_PRO_ADDONS_PATH . 'includes/deps/reviews.php' ); 
        }

        if ( class_exists( $class ) ) {
            $widget_manager->register_widget_type( new $class );
        }
    }
    
    /**
    * Creates and returns an instance of the class
    * @since 1.0.0
    * @access public
    * return object
    */
   public static function get_instance() {
       if( self::$instance == null ) {
           self::$instance = new self;
       }
       return self::$instance;
   }
}
    

if ( ! function_exists( 'premium_addons_integration' ) ) {

	/**
	 * Returns an instance of the plugin class.
	 * @since  1.0.0
	 * @return object
	 */
	function premium_addons_integration() {
		return Addons_Integration::get_instance();
	}
}
premium_addons_integration();
