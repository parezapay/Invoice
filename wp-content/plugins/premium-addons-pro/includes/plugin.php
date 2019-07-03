<?php

namespace PremiumAddonsPro;

use PremiumAddonsPro\Admin\Settings;
use PremiumAddonsPro\License;
use PremiumAddonsPro\Includes;
use Elementor;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main class plugin
 */
class Plugin {

	/**
	 * @var Plugin
	 */
	private static $_instance;

	/**
	 * @var Manager
	 */
	private $_modules_manager;

	/**
	 * @return \Elementor\Plugin
	 */

	public static function premium_addons() {
		return \PremiumAddons\Plugin::$instance;
	}

	/**
	 * @return Plugin
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	private function _includes() {
		require PREMIUM_PRO_ADDONS_PATH . 'includes/class-modules-manager.php';
	}

	public function autoload( $class ) {
		if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
			return;
		}

		$filename = strtolower(
			preg_replace(
				[ '/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
				[ '', '$1-$2', '-', DIRECTORY_SEPARATOR ],
				$class
			)
		);
		$filename = PREMIUM_PRO_ADDONS_PATH . $filename . '.php';

		if ( is_readable( $filename ) ) {
			include( $filename );
		}
	}

	public function elementor_controls_init() {
		$this->_modules_manager = new Manager();
		do_action( 'elementor_controls/init' );
	}
    
    public function init() {
        $this->init_component();
    }
    
    private function init_component() {
        $this->admin_pro_settings = new Settings\Premium_Pro_Admin_Settings();
        $this->white_label_settings = new Includes\White_Label\Admin();
        $this->license_settings = new License\Admin();
    }
	
	private function setup_hooks() {
		add_action( 'elementor/init', [ $this, 'elementor_controls_init' ] );
	}
    
	/**
	 * Plugin constructor.
	 */
	private function __construct() {
        
		spl_autoload_register( [ $this, 'autoload' ] );
		$this->_includes();
		$this->setup_hooks();
        add_action('init',array($this,'init'), 0);
        
	}
}

if ( ! defined( 'ELEMENTOR_CONTROLS_TESTS' ) ) {
	// In tests we run the instance manually.
	Plugin::instance();
}