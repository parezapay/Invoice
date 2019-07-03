<?php 

namespace PremiumAddonsPro\Includes\White_Label;

use PremiumAddons\Helper_Functions;

if ( ! defined('ABSPATH') ) exit;

class Admin {
    
    private $lic_status;

    public $pa_wht_lbl_keys = [
        'premium-wht-lbl-name',
        'premium-wht-lbl-url',
        'premium-wht-lbl-plugin-name',
        'premium-wht-lbl-short-name',
        'premium-wht-lbl-desc',
        'premium-wht-lbl-name-pro',
        'premium-wht-lbl-url-pro',
        'premium-wht-lbl-plugin-name-pro',
        'premium-wht-lbl-desc-pro',
        'premium-wht-lbl-option',
        'premium-wht-lbl-rate',
        'premium-wht-lbl-about',
        'premium-wht-lbl-license',
        'premium-wht-lbl-logo',
        'premium-wht-lbl-version',
        'premium-wht-lbl-prefix',
        'premium-wht-lbl-badge',
    ];
    
    private $pa_wht_lbl_default_settings;
    
    private $pa_wht_lbl_settings;
    
    private $pa_wht_lbl_get_settings;
    
    public function __construct() {
        
        add_action( 'admin_menu' , array( $this,'create_pro_section_white_label') );
        
        add_action( 'wp_ajax_pa_wht_lbl_save_settings', array( $this,'pa_pro_save_white_label_settings') );
        
        
    }
    
    public function create_pro_section_white_label() {
        
        $check_network = is_network_admin();
        
        if ( ! $check_network ) {
            $this->lic_status   = ( null !== get_option( 'papro_license_status' ) ) ? get_option( 'papro_license_status' ) : '';
            $show_wht_lbl       = ( null !== get_option('pa_wht_lbl_save_settings')['premium-wht-lbl-option'] ) ? get_option('pa_wht_lbl_save_settings')['premium-wht-lbl-option'] : false;
        } else {
            $this->lic_status   = ( null !== get_site_option( 'papro_license_status' ) ) ? get_site_option( 'papro_license_status' ) : '';
            $show_wht_lbl       = ( null !== get_site_option('pa_wht_lbl_save_settings')['premium-wht-lbl-option'] ) ? get_site_option('pa_wht_lbl_save_settings')['premium-wht-lbl-option'] : false;
        }
        
        if( false == $show_wht_lbl ) {
           add_submenu_page(
                'premium-addons',
                '',
                __('White Labeling','premium-addons-pro'),
                'manage_options',
                'premium-addons-pro-white-label',
                [ $this,'pa_pro_white_label' ]
            );
        }
        
        if( 'valid' != $this->lic_status ) {
            
            delete_option('pa_wht_lbl_save_settings');
            
            delete_site_option('pa_wht_lbl_save_settings');
            
        }
        
    }
    
    public function pa_pro_white_label (){
        
        $js_info = array(
			'ajaxurl'   => admin_url( 'admin-ajax.php' ),
            'adminurl'  => admin_url()
		);
        
		wp_localize_script( 'pa-pro-admin-js', 'settings', $js_info );
        
        $this->pa_wht_lbl_default_settings = array_fill_keys($this->pa_wht_lbl_keys, '');
       
        $this->pa_wht_lbl_get_settings = get_option( 'pa_wht_lbl_save_settings', $this->pa_wht_lbl_default_settings );
        
        $pa_wht_lbl_new_settings = array_diff_key( $this->pa_wht_lbl_default_settings, $this->pa_wht_lbl_get_settings );
        
        if( ! empty( $pa_wht_lbl_new_settings ) ) {
            $pa_wht_lbl_updated_settings = array_merge( $this->pa_wht_lbl_get_settings, $pa_wht_lbl_new_settings );
            update_option( 'pa_wht_lbl_save_settings', $pa_wht_lbl_updated_settings );
        }
        $this->pa_wht_lbl_get_settings = get_option( 'pa_wht_lbl_save_settings', $this->pa_wht_lbl_default_settings );
        
    ?>    
<div class="wrap">
    <div class="response-wrap"></div>
    <form action="" method="POST" id="pa-white-label-settings" name="pa-white-label-settings">
            <div class="pa-header-wrapper">
                <div class="pa-title-left">
                    <h1 class="pa-title-main"><?php echo Helper::name_pro(); ?></h1>
                    <h3 class="pa-title-sub"><?php echo sprintf(__('Thank you for using %s. This plugin has been developed by %s and we hope you enjoy using it.','premium-addons-pro'), Helper::name_pro(), Helper::author_pro() ); ?></h3>
                </div>
                <?php if( ! Helper_Functions::is_show_logo() ) : ?>
                <div class="pa-title-right">
                    <img class="pa-logo" src="<?php echo PREMIUM_ADDONS_URL .'admin/images/premium-addons-logo.png'; ?>">
                </div>
                <?php endif; ?>
            </div>
            <div class="pa-wht-lbl-settings">
                <div class="pa-row">
                    <div class="pa-wht-lbl-settings-wrap">
                        <h3 class="pa-wht-lbl-title pa-wht-lbl-head"><?php echo __('Free Version', 'premium-addons-pro'); ?></h3>
                        <div class="pa-wht-lbl-group-wrap">
                            <!-- Author Name -->
                            <h4 class="premium-wht-lbl-name pa-wht-lbl-title"><label><?php echo __('Author Name:', 'premium-addons-pro'); ?></label></h4>
                            <input name="premium-wht-lbl-name" id="premium-wht-lbl-name" type="text" placeholder="Leap13" value="<?php echo $this->pa_wht_lbl_get_settings['premium-wht-lbl-name']; ?>">
                            <!-- Author URL -->
                            <h4 class="premium-wht-lbl-url pa-wht-lbl-title"><label><?php echo __('Author URL:', 'premium-addons-pro'); ?></label></h4>
                            <input name="premium-wht-lbl-url" id="premium-wht-lbl-url" type="text" placeholder="https://premiumaddons.com" value="<?php echo $this->pa_wht_lbl_get_settings['premium-wht-lbl-url']; ?>">
                            <!-- Plugin Name -->
                            <h4 class="premium-wht-lbl-plugin-name pa-wht-lbl-title"><label><?php echo __('Plugin Name', 'premium-addons-pro'); ?></label></h4>
                            <input name="premium-wht-lbl-plugin-name" id="premium-wht-lbl-plugin-name" type="text" placeholder="Premium Addons for Elementor" value="<?php echo $this->pa_wht_lbl_get_settings['premium-wht-lbl-plugin-name']; ?>">
                            <!-- Plugin Description -->
                            <h4 class="premium-wht-lbl-desc pa-wht-lbl-title"><label><?php echo __('Plugin Description:', 'premium-addons-pro'); ?></label></h4>
                            <input name="premium-wht-lbl-desc" id="premium-wht-lbl-desc" type="text" placeholder="Premium Addons Plugin Includes 20 premium widgets for Elementor Page Builder" value="<?php echo $this->pa_wht_lbl_get_settings['premium-wht-lbl-desc']; ?>">
                        </div>
                    </div>
                    
                    
                    <div class="pa-wht-lbl-settings-wrap">
                        <h3 class="pa-wht-lbl-title pa-wht-lbl-head"><?php echo __('PRO Version', 'premium-addons-pro'); ?></h3>
                        <div class="pa-wht-lbl-group-wrap">
                            <h4 class="premium-wht-lbl-name pa-wht-lbl-title"><label><?php echo __('Author Name:', 'premium-addons-pro'); ?></label></h4>
                            <input name="premium-wht-lbl-name-pro" id="premium-wht-lbl-name-pro" type="text" placeholder="Leap13" value="<?php echo $this->pa_wht_lbl_get_settings['premium-wht-lbl-name-pro']; ?>">
                    
                            <h4 class="premium-wht-lbl-url pa-wht-lbl-title"><label><?php echo __('Author URL:', 'premium-addons-pro'); ?></label></h4>
                            <input name="premium-wht-lbl-url-pro" id="premium-wht-lbl-url-pro" type="text" placeholder="https://premiumaddons.com" value="<?php echo $this->pa_wht_lbl_get_settings['premium-wht-lbl-url-pro']; ?>">
                            <h4 class="premium-wht-lbl-plugin-name pa-wht-lbl-title"><label><?php echo __('Plugin Name:', 'premium-addons-pro'); ?></label></h4>
                            <input name="premium-wht-lbl-plugin-name-pro" id="premium-wht-lbl-plugin-name-pro" type="text" placeholder="Premium Addons PRO for Elementor" value="<?php echo $this->pa_wht_lbl_get_settings['premium-wht-lbl-plugin-name-pro']; ?>">
                            <h4 class="premium-wht-lbl-desc pa-wht-lbl-title"><label><?php echo __('Plugin Description:', 'premium-addons-pro'); ?></label></h4>
                            <input name="premium-wht-lbl-desc-pro" id="premium-wht-lbl-desc-pro" type="text" placeholder="Premium Addons Plugin Includes 20 premium widgets for Elementor Page Builder" value="<?php echo $this->pa_wht_lbl_get_settings['premium-wht-lbl-desc-pro']; ?>">
                            
                        </div>
                    </div>
                    <div class="pa-wht-lbl-settings-wrap">
                        <h3 class="pa-wht-lbl-title pa-wht-lbl-head"><?php echo __('General Options', 'premium-addons-pro'); ?></h3>
                        <div class="pa-wht-lbl-group-wrap">
                            <!-- Widgets Category Name -->
                            <h4 class="premium-wht-lbl-short-name pa-wht-lbl-title"><label><?php echo __('Widgets Category Name:', 'premium-addons-pro'); ?></label></h4>
                            <input name="premium-wht-lbl-short-name" id="premium-wht-lbl-short-name" type="text" placeholder="Premium Addons" value="<?php echo $this->pa_wht_lbl_get_settings['premium-wht-lbl-short-name']; ?>">
                            <!-- Widgets Prefix -->
                            <h4 class="premium-wht-lbl-short-name pa-wht-lbl-title"><label><?php echo __('Widgets Prefix:', 'premium-addons-pro'); ?></label></h4>
                            <input name="premium-wht-lbl-prefix" id="premium-wht-lbl-prefix" type="text" placeholder="Premium" value="<?php echo $this->pa_wht_lbl_get_settings['premium-wht-lbl-prefix']; ?>">
                            <!-- Widgets Badge -->
                            <h4 class="premium-wht-lbl-short-name pa-wht-lbl-title"><label><?php echo __('Widgets Badge:', 'premium-addons-pro'); ?></label></h4>
                            <input name="premium-wht-lbl-badge" id="premium-wht-lbl-badge" type="text" placeholder="PA" value="<?php echo $this->pa_wht_lbl_get_settings['premium-wht-lbl-badge']; ?>">
                        </div>
                    </div>
                    
                    <div class="pa-wht-lbl-save">
                        <input type="submit" value="Save Settings" class="button pa-btn pa-save-button" data-lic="<?php echo esc_attr($this->lic_status); ?>">
                    </div>
                    </div>
                <div class="pa-wht-lbl-admin">
                    <div class="pa-wht-lbl-settings-wrap">
                        <h3 class="pa-wht-lbl-title pa-wht-lbl-head"><?php echo __('Admin Settings', 'premium-addons-pro'); ?></h3>
                        <div class="pa-wht-lbl-group-wrap">
                            <!-- Hide White Label Tab-->
                            <h4 class="pa-wht-lbl-box-head"><?php echo __('Rate Notice', 'premium-addons-pro'); ?></h4>
                            <input name="premium-wht-lbl-rate" id="premium-wht-lbl-rate" type="checkbox" <?php checked(1, $this->pa_wht_lbl_get_settings['premium-wht-lbl-rate'], true) ?>><span>This will hide the rating notice at the bottom of plugin admin tabs</span>
                            <!-- Hide About Tab-->
                            <h4 class="pa-wht-lbl-box-head"><?php echo __('About Tab', 'premium-addons-pro'); ?></h4>
                            <input name="premium-wht-lbl-about" id="premium-wht-lbl-about" type="checkbox" <?php checked(1, $this->pa_wht_lbl_get_settings['premium-wht-lbl-about'], true) ?>><span>This will hide About tab</span>
                            <!-- Hide Version Control Tab-->
                            <h4 class="pa-wht-lbl-box-head"><?php echo __('Version Control Tab', 'premium-addons-pro'); ?></h4>
                            <input name="premium-wht-lbl-version" id="premium-wht-lbl-version" type="checkbox" <?php checked(1, $this->pa_wht_lbl_get_settings['premium-wht-lbl-version'], true) ?>><span>Hide Version Control Tab</span>
                            <!-- Hide Logo-->
                            <h4 class="pa-wht-lbl-box-head"><?php echo __('Premium Addons Logo', 'premium-addons-pro'); ?></h4>
                            <input name="premium-wht-lbl-logo" id="premium-wht-lbl-logo" type="checkbox" <?php checked(1, $this->pa_wht_lbl_get_settings['premium-wht-lbl-logo'], true) ?>><span>Hide Premium Addons Logo</span>
                            <h4 class="pa-wht-lbl-box-head"><?php echo __('License Tab', 'premium-addons-pro'); ?></h4>
                            <input name="premium-wht-lbl-license" id="premium-wht-lbl-license" type="checkbox" <?php checked(1, $this->pa_wht_lbl_get_settings['premium-wht-lbl-license'], true) ?>><span>Hide License Tab</span>
                            <h4 class="pa-wht-lbl-box-head"><?php echo __('White Labeling Tab', 'premium-addons-pro'); ?></h4>
                            <input name="premium-wht-lbl-option" id="premium-wht-lbl-option" type="checkbox" <?php checked(1, $this->pa_wht_lbl_get_settings['premium-wht-lbl-option'], true) ?>><span>This will Hide White Label options tab, to reset this option, please reactivate Premium Addons Pro for Elementor Plugin </span>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <?php if( ! Helper_Functions::is_show_rate() ) : ?>
                <div>
                    <p>Did you like Premium Addons for Elementor Plugin? Please <a href="https://wordpress.org/support/plugin/premium-addons-for-elementor/reviews/#new-post" target="_blank">Click Here to Rate it ★★★★★</a></p>
                </div>
                <?php endif; ?>
                </div>
    </form>
</div>
    <?php }
    
    public function pa_pro_save_white_label_settings()  {
        
        if( isset( $_POST['fields'] ) ) {
            parse_str( $_POST['fields'], $settings );
        } else {
            return;
        }
        
        $this->pa_wht_lbl_settings = array(
            'premium-wht-lbl-name'          => $settings['premium-wht-lbl-name'],
            'premium-wht-lbl-name-pro'      => $settings['premium-wht-lbl-name-pro'],
            'premium-wht-lbl-url'           => $settings['premium-wht-lbl-url'],
            'premium-wht-lbl-url-pro'       => $settings['premium-wht-lbl-url-pro'],
            'premium-wht-lbl-plugin-name'   => $settings['premium-wht-lbl-plugin-name'],
            'premium-wht-lbl-plugin-name-pro'=> $settings['premium-wht-lbl-plugin-name-pro'],
            'premium-wht-lbl-short-name'    => $settings['premium-wht-lbl-short-name'],
            'premium-wht-lbl-short-name-pro'=> $settings['premium-wht-lbl-short-name-pro'],
            'premium-wht-lbl-desc'          => $settings['premium-wht-lbl-desc'],
            'premium-wht-lbl-desc-pro'      => $settings['premium-wht-lbl-desc-pro'],
            'premium-wht-lbl-prefix'        => $settings['premium-wht-lbl-prefix'],
            'premium-wht-lbl-badge'         => $settings['premium-wht-lbl-badge'],
            'premium-wht-lbl-option'        => intval($settings['premium-wht-lbl-option'] ? 1 : 0 ) ,
            'premium-wht-lbl-rate'          => intval($settings['premium-wht-lbl-rate'] ? 1 : 0 ) ,
            'premium-wht-lbl-about'         => intval($settings['premium-wht-lbl-about'] ? 1 : 0 ) ,
            'premium-wht-lbl-license'       => intval($settings['premium-wht-lbl-license'] ? 1 : 0 ) ,
            'premium-wht-lbl-logo'          => intval($settings['premium-wht-lbl-logo'] ? 1 : 0 ) ,
            'premium-wht-lbl-version'       => intval($settings['premium-wht-lbl-version'] ? 1 : 0 ) ,
        );
            
        update_option( 'pa_wht_lbl_save_settings', $this->pa_wht_lbl_settings );
            
        return true;
        
        die();
        
    }
}