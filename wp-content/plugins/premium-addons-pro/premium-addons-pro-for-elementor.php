<?php
/*
Plugin Name: Premium Addons PRO
Description: Premium Addons PRO Plugin Includes 28+ premium widgets & addons for Elementor Page Builder.
Plugin URI: https://premiumaddons.com
Version: 1.5.6
Author: Leap13
Author URI: https://leap13.com/
Text Domain: premium-addons-pro
Domain Path: /languages
*/


/**
 * Checking if WordPress is installed
 */
if ( ! function_exists('add_action') ) {
    die('WordPress not Installed'); // if WordPress not installed kill the page.   
}

if ( ! defined('ABSPATH') ) exit; // No access of directly access

define('PREMIUM_PRO_ADDONS_VERSION', '1.5.6');
define('PREMIUM_PRO_ADDONS_STABLE_VERSION', '1.5.5');
define('PREMIUM_PRO_ADDONS_URL', plugins_url('/', __FILE__));
define('PREMIUM_PRO_ADDONS_PATH', plugin_dir_path(__FILE__));
define('PREMIUM_PRO_ADDONS_FILE', __FILE__);
define('PREMIUM_PRO_ADDONS_BASENAME', plugin_basename(PREMIUM_PRO_ADDONS_FILE));
define('PAPRO_ITEM_NAME', 'Premium Addons PRO');
define('PAPRO_STORE_URL', 'http://my.leap13.com');
define('PAPRO_ITEM_ID', 361);

// Require Plugin Updater
if( ! class_exists( 'PAPRO_Plugin_Updater' ) ) {
	include( dirname( __FILE__ ) . '/license/updater.php' );
}

if( ! class_exists('Premium_Addons_Pro_Elementor') ) {
    /*
    * Intialize and Sets up the plugin
    */
    class Premium_Addons_Pro_Elementor {

        private static $instance = null;
        
        /**
        * Sets up needed actions/filters for the plug-in to initialize.
        * @since 1.0.0
        * @access public
        * @return void
        */
        public function __construct() {
            register_activation_hook(__FILE__, array( $this,'Premium_Pro_Activation' ) );
            //Get License Key
            $license_key = trim( get_option( 'papro_license_key' ) ); 
            //Plugin Updater Configuration
            $edd_updater = new PAPRO_Plugin_Updater(
                PAPRO_STORE_URL,
                __FILE__,
                array(
                    'version' 	=> PREMIUM_PRO_ADDONS_VERSION,
                    'license' 	=> $license_key,
                    'item_id'   => PAPRO_ITEM_ID,
                    'author' 	=> 'Leap13',
                    'url'       => home_url(),
                    'beta'      => false
                )
            );
            //Load plugin core
            add_action( 'plugins_loaded', array( $this, 'premium_pro_elementor_setup' ) );
            //Check if free version of Premium Addons installed
            if ( self::check_premium_free() ) {
                // Load Addons required Files
                add_action( 'elementor/init', array( $this, 'elementor_init' ) );
            }
        }
        
        /**
        * Reset White Label upon deactivation
        */
        public function Premium_Pro_Activation() {
            $white_label_settings = is_network_admin() ? get_site_option('pa_wht_lbl_save_settings') : get_option('pa_wht_lbl_save_settings');
            if( isset( $white_label_settings['premium-wht-lbl-option'] ) ){
                $white_label_settings['premium-wht-lbl-option'] = 0;
                is_network_admin() ? update_site_option( 'pa_wht_lbl_save_settings', $white_label_settings ) : update_option( 'pa_wht_lbl_save_settings', $white_label_settings );
            }
        }
        
        /**
         * Elementor Init
         * 
         * Load required files after init Elementor
         * 
         * @access public
         * 
         * @return void
         */
        public function elementor_init() {
            
            require_once ( PREMIUM_PRO_ADDONS_PATH . 'includes/compatibility/class-premium-pro-wpml.php' );
            
            require_once ( PREMIUM_PRO_ADDONS_PATH . 'includes/class-addons-integration.php' );
            
        }

        /**
        * Installs translation text domain and checks if Elementor is installed
        * @since 1.0.0
        * @access public
        * @return void
        */
        public function premium_pro_elementor_setup() {
            if ( self::check_premium_free() ) {
                $this->load_domain();
            }
            $this->init_files();
        }
        
        /**
         * Check if free version is activated
         * @since 1.1.1
         * @access public
         * @return void
         */
        public static function check_premium_free() {
            return defined( 'PREMIUM_ADDONS_VERSION' );
        }

        /**
         * Load plugin translated strings using text domain
         * @since 1.1.1
         * @access public
         * @return void
         */
        public function load_domain() {
            
            load_plugin_textdomain( 'premium-addons-pro' );
            
        }
        
        
        /**
         * Require initial necessary files
         * @since 1.1.1
         * @access public
         * @return void
         */
        public function init_files() {
            
            if(  self::check_premium_free() ) {
                if( is_admin() ) {
                    require_once ( PREMIUM_PRO_ADDONS_PATH . 'license/api.php' );
                    require_once ( PREMIUM_PRO_ADDONS_PATH . 'license/admin.php' );
                }
                
                require_once ( PREMIUM_PRO_ADDONS_PATH . 'admin/settings/elements.php' );
                
                require_once ( PREMIUM_PRO_ADDONS_PATH . 'includes/white-label/admin.php' );
                require_once ( PREMIUM_PRO_ADDONS_PATH . 'includes/white-label/branding.php' );
                require_once ( PREMIUM_PRO_ADDONS_PATH . 'includes/plugin.php' );
                
            }
            require_once ( PREMIUM_PRO_ADDONS_PATH . 'admin/includes/admin-notices.php' );
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
}

if ( ! function_exists( 'premium_addons_pro' ) ) {
	/**
	 * Returns an instance of the plugin class.
	 * @since  1.0.0
	 * @return object
	 */
	function premium_addons_pro() {
		return Premium_Addons_Pro_Elementor::get_instance();
	}
}
premium_addons_pro();