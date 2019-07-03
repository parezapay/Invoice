<?php

namespace PremiumAddonsPro\License;

use PremiumAddonsPro\Includes\White_Label\Helper;
use PremiumAddonsPro\License\API;
use PremiumAddons\Helper_Functions;

if ( ! defined('ABSPATH') ) exit;

class Admin {
    
    private static $slug = 'premium-addons-pro-license';
    
    public function __construct() {
        
        add_action( 'admin_menu', array ( $this,'create_license_menu' ), 100 );
        
        add_action( 'admin_init', array ( $this,'papro_register_option' ) );

        add_action( 'admin_post_papro_license_activate', array( $this, 'action_papro_license_activate') );

        add_action( 'admin_post_papro_license_deactivate', array( $this, 'action_papro_license_deactivate') );
        
    }

    /**
    * Creates license submenu page
     * 
    * @since 1.0.0
    * @access public
     * 
    * @return void
    */
    public function create_license_menu() {
        if ( !Helper::is_show_license() ) {
            add_submenu_page(
                'premium-addons',
                '',
                __('License','premium-addons-pro'),
                'manage_options',
                self::$slug,
                [ $this,'pa_pro_license' ]
            );
        }
    }

    /**
     * Adds the content to license admin submenu page
     * 
     * @since 1.0.0
     * @access public
     * 
     * @return void
     */
    public function pa_pro_license() {
        
        $theme = wp_get_theme();
        
        $theme_name = $theme->parent() ? $theme->parent()->get('Name') : $theme->get('Name');
        
        $theme_name = sanitize_key( $theme_name );
        
        $account_link = sprintf('https://my.leap13.com/?utm_source=license-page&utm_medium=wp-dash&utm_campaign=your-account&utm_term=%s',$theme_name);
        $get_license = sprintf('https://premiumaddons.com/pro/?utm_source=license-page&utm_medium=wp-dash&utm_campaign=get-pro&utm_term=%s',$theme_name);
        
//        $license = $this->get_license_key();
        
        $status  = self::get_license_status();

        ?>

        <div class="wrap">
            <div class="pa-header-wrapper pa-license-header">
                <div class="pa-title-left">
                    <h1 class="pa-title-main"><?php echo Helper::name_pro(); ?></h1>
                    <h3 class="pa-title-sub"><?php echo sprintf(__('Thank you for using %s. This plugin has been developed by %s and we hope you enjoy using it.','premium-addons-pro'), Helper::name_pro(),Helper::author_pro()); ?></h3>
                </div>
                <?php if( ! Helper_Functions::is_show_logo() ) : ?>
                    <div class="pa-title-right">
                        <img class="pa-logo" src="<?php echo PREMIUM_ADDONS_URL .'admin/images/premium-addons-logo.png'; ?>">
                    </div>
                <?php endif; ?>
            </div>
            <form class="pa-license-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                <?php settings_fields('papro_license'); ?>
                <span><?php echo __('Enter your license key here, to activate Premium Addons Pro, and enable feature updates, white labeling options and premium support.','premium-addons-pro'); ?></span>
                <ol>
                    <li><span><?php echo __('Log in to', 'premium-addons-pro'); ?><a href="<?php echo esc_url( $account_link ); ?>" target="_blank"><?php echo __('your account', 'premium-addons-for-elementor'); ?></a><?php echo __('to get your license key', 'premium-addons-pro');?></span></li>
                    <li><span><?php echo __('If you don\'t have a license key yet, ', 'premium-addons-pro'); ?><a href="<?php echo esc_url( $get_license ); ?>" target="_blank"><?php echo __('get Premium Addons Pro now.', 'premium-addons-pro'); ?></a></span></li>
                    <li><span><?php echo __('Copy the license key from your account and paste it below.', 'premium-addons-pro'); ?></span></li>
                    <li><span><?php echo __('Click on Activate to activate the license.', 'premium-addons-pro'); ?></span></li>
                </ol>
                <label for="papro-license-key"><?php _e('License Key'); ?></label>
                <input id="papro-license-key" <?php echo ( $status !== false && $status == 'valid' ) ? 'disabled' : ''; ?> name="papro_license_key" placeholder="<?php echo __('Please enter your license key here', 'premium-addons-pro'); ?>" type="text" class="regular-text" value="<?php echo esc_attr( self::get_enc_key() );?>" />
                <?php
                    wp_nonce_field( 'papro_nonce', 'papro_nonce' );
                    if( $status !== false && $status == 'valid' ) { ?>
                        <input type="hidden" name="action" value="papro_license_deactivate" />
                        <?php submit_button( __( 'Deactivate', 'premium-addons-pro' ), 'primary', 'submit', false ); ?>
                        <span style="color:green;"><?php echo __('Active', 'premium-addons-pro'); ?></span>
                    <?php } else { ?>
                        <input type="hidden" name="action" value="papro_license_activate" />
                        <?php submit_button( __( 'Activate', 'premium-addons-pro' ), 'primary', 'submit', false ); ?>
                        <span style="color:red;"><?php echo __('License not valid', 'premium-addons-pro'); ?></span>
                    <?php }
                ?>
            </form>
        </div>
    <?php }
    
    
    /**
    * Sends the entered license key to the activation function
    * @since 1.0.0
    * @access public
    * @return void
    */
    public function action_papro_license_activate() {

        check_admin_referer('papro_nonce', 'papro_nonce');

        $license = trim( $_POST[ 'papro_license_key' ] );

        $data = API::papro_activate_license( $license );
    }

    /**
    * Sends the entered license key to the deactivation function
    * @since 1.0.0
    * @access public
    * @return void
    */
    public function action_papro_license_deactivate() {

        check_admin_referer('papro_nonce', 'papro_nonce');

        $license = self::get_license_key();
        
        $data = API::papro_deactivate_license( $license );
    }

    /**
    * Get the stored license key
    * @since 1.1.1
    * @access public
    */
    public static function get_license_key() {
        
        $license = get_option( 'papro_license_key' );

        return ( ! $license ) ? false : trim( $license );
        
    }
    
    /**
    * Get the stored license status
    * @since 1.1.1
    * @access public
    */
    public static function get_license_status() {
        
        $status = get_option( 'papro_license_status' );

        return ( ! $status ) ? false : $status;
        
    }
    
    /**
    * Register license key input field
    * @since 1.0.0
    * @access public
    * @return void
    */
    public function papro_register_option() {
        // creates our settings in the options table
        register_setting('papro_license', 'papro_license_key', array( $this,'papro_sanitize_license' ) );
    }
    
    /**
    * Delete stored license status if new license key is entered
    * @since 1.0.0
    * @access public
    * @return string
    */
    public function papro_sanitize_license( $new ) {
        
        $old = self::get_license_key();
        if( $old && $old != $new ) {
            delete_option( 'papro_license_status' ); // new license has been entered, so must reactivate    
        }
        
        return $new;
    }
    
    /**
    * Delete stored license status if new license key is entered
    * @since 1.0.0
    * @access private
    * @return string
    */
    private function get_enc_key() {
        
        $input_string = self::get_license_key();

        $status = self::get_license_status();
        
        if( 'valid' == $status ) {
            $start = 5;
            $length = mb_strlen( $input_string ) - $start - 5;

            $mask_string = preg_replace( '/\S/', 'X', $input_string );
            $mask_string = mb_substr( $mask_string, $start, $length );
            $input_string = substr_replace( $input_string, $mask_string, $start, $length );
            
        } else {
            $input_string = '';
        }
        

        return $input_string;
    }
    
    /**
     * Returns license page slug
     * 
     * @since 1.1.1
     * @access public
     * 
     * @return string
     */
    public static function get_slug() {
        return self::$slug;
    }
    
}