<?php

namespace PremiumAddonsPro\Admin\Settings;

use PremiumAddonsPro\Includes\White_Label\Helper;
use PremiumAddons\Helper_Functions;

if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly

class Premium_Pro_Admin_Settings {
    
    protected $page_slug = 'premium-addons-pro';

    public static $pa_pro_elements_keys = ['premium-iconbox', 'premium-twitter-feed', 'premium-instagram-feed', 'premium-notbar', 'premium-flipbox', 'premium-unfold', 'premium-fb-chat', 'premium-whatsapp-chat', 'premium-tabs', 'premium-charts', 'premium-prev-img', 'premium-image-hotspots', 'premium-image-comparison', 'premium-facebook-reviews', 'premium-facebook-feed', 'premium-magic-section', 'premium-google-reviews', 'premium-behance', 'premium-social-counter', 'premium-img-layers', 'premium-ihover', 'premium-content-toggle', 'premium-tables', 'premium-divider', 'premium-multi-scroll', 'premium-parallax', 'premium-particles', 'premium-gradient', 'premium-kenburns', 'premium-badge'];
    
    private $pa_pro_default_settings;
    
    private $pa_pro_settings;
    
    private $pa_pro_get_settings;

    public function __construct() {
        
        add_action( 'admin_menu', array( $this,'premium_pro_admin_menu') );
        
        add_filter( 'plugin_action_links_' . PREMIUM_PRO_ADDONS_BASENAME, array( $this, 'plugin_settings_page' ) );
        
//        add_action( 'admin_menu', array( $this,'remove_pro_sub_menu'), 0 );
        
        add_action('admin_enqueue_scripts', array( $this, 'pa_admin_page_scripts' ) );
        
        add_action( 'wp_ajax_pa_pro_save_admin_addons_settings', array( $this, 'pa_pro_save_settings' ) );
        
    }
    
    /*
    * Creates `Settings` action link
    * @since 1.0.0
    * @return void
    */
   public function plugin_settings_page( $links ) {

       $settings_link = sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'admin.php?page=' . $this->page_slug . '-elems' ), __( 'Settings', 'premium-addons-pro' ) );

       array_unshift( $links, $settings_link );

       return $links;
   }

    public function remove_pro_sub_menu() {
        
        remove_action( 'admin_menu', [ Plugin::premium_addons()->settings, 'create_pro_menus' ], 100 );
        
    }
    
    public function pa_admin_page_scripts () {
        
        $current_screen = get_current_screen();
        
        if( strpos( $current_screen->id, $this->page_slug ) !== false ) {
            
            wp_enqueue_style( 'pa-pro-admin-style', PREMIUM_PRO_ADDONS_URL.'admin/assets/admin.css' );
            
            wp_enqueue_script( 'pa-pro-admin-js', PREMIUM_PRO_ADDONS_URL.'admin/assets/admin.js' , array( 'jquery' ), PREMIUM_PRO_ADDONS_VERSION , true );
            
        }
    }
    

    public function premium_pro_admin_menu() { 
       add_submenu_page(
            'premium-addons',
            '',
            __('PRO Widgets Settings','premium-addons-pro'),
            'manage_options',
            'premium-addons-pro-elems',
            [ $this,'premium_pro_elements_page' ]
        );
    }

    public function premium_pro_elements_page() {
        
        $js_info = array(
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		);
		wp_localize_script( 'pa-pro-admin-js', 'settings', $js_info );
       
	   $this->pa_pro_default_settings = $this->get_default_keys();
       
	   $this->pa_pro_get_settings = $this->get_enabled_keys();
       
	   $pa_pro_new_settings = array_diff_key( $this->pa_pro_default_settings, $this->pa_pro_get_settings );
       
	   if( ! empty( $pa_pro_new_settings ) ) {
	   	$pa_pro_updated_settings = array_merge( $this->pa_pro_get_settings, $pa_pro_new_settings );
	   	update_option( 'pa_pro_save_settings', $pa_pro_updated_settings );
	   }
	   $this->pa_pro_get_settings = get_option( 'pa_pro_save_settings', $this->pa_pro_default_settings );
       
       $prefix = Helper_Functions::get_prefix();
       
	?>
	<div class="wrap">
        <div class="response-wrap"></div>
        <form action="" method="POST" id="pa-pro-settings" name="pa-settings">
            <div class="pa-header-wrapper">
                <div class="pa-title-left">
                    <h1 class="pa-title-main"><?php echo Helper::name_pro(); ?></h1>
                    <h3 class="pa-title-sub"><?php echo sprintf(__('Thank you for using %s. This plugin has been developed by %s and we hope you enjoy using it.','premium-addons-pro'), Helper::name_pro(), Helper::author_pro()); ?></h3>
                </div>
                <?php if( ! Helper_Functions::is_show_logo() ) : ?>
                <div class="pa-title-right">
                    <img class="pa-logo" src="<?php echo PREMIUM_ADDONS_URL .'admin/images/premium-addons-logo.png'; ?>">
                </div>
                <?php endif; ?>
            </div>
            <div class="pa-settings-tabs">
                <div id="pa-modules" class="pa-settings-tab">
                    <div>
                        <br>
                        <input type="checkbox" class="pa-checkbox" checked="checked">
                        <label>Enable/Disable All</label>
                    </div>
                    <table class="pa-elements-table">
                        <tbody>
                            <tr>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Alert Box', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-notbar" name="premium-notbar" <?php checked(1, $this->pa_pro_get_settings['premium-notbar'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Behance Feed', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-behance" name="premium-behance" <?php checked(1, $this->pa_pro_get_settings['premium-behance'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                            </tr>
                            
                            <tr>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Charts', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-charts" name="premium-charts" <?php checked(1, $this->pa_pro_get_settings['premium-charts'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Content Switcher', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-content-toggle" name="premium-content-toggle" <?php checked(1, $this->pa_pro_get_settings['premium-content-toggle'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                            </tr>
                            
                            <tr>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Divider', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-divider" name="premium-divider" <?php checked(1, $this->pa_pro_get_settings['premium-divider'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Facebook Feed', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-facebook-feed" name="premium-facebook-feed" <?php checked(1, $this->pa_pro_get_settings['premium-facebook-feed'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                            </tr>
                            
                            <tr>

                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Facebook Reviews', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-facebook-reviews" name="premium-facebook-reviews" <?php checked(1, $this->pa_pro_get_settings['premium-facebook-reviews'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Flip Box', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-flipbox" name="premium-flipbox" <?php checked(1, $this->pa_pro_get_settings['premium-flipbox'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                            </tr>
                            
                            <tr>

                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Google Reviews', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-google-reviews" name="premium-google-reviews" <?php checked(1, $this->pa_pro_get_settings['premium-google-reviews'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Icon Box', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-iconbox" name="premium-iconbox" <?php checked(1, $this->pa_pro_get_settings['premium-iconbox'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                            </tr>
                            
                            <tr>

                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('iHover', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-ihover" name="premium-ihover" <?php checked(1, $this->pa_pro_get_settings['premium-ihover'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Image Comparison', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-image-comparison" name="premium-image-comparison" <?php checked(1, $this->pa_pro_get_settings['premium-image-comparison'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                            </tr>
                            
                            <tr>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Image Hotspots', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-image-hotspots" name="premium-image-hotspots" <?php checked(1, $this->pa_pro_get_settings['premium-image-hotspots'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Image Layers', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-img-layers" name="premium-img-layers" <?php checked(1, $this->pa_pro_get_settings['premium-img-layers'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>

                            </tr>
                            
                            <tr>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Instagram Feed', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-instagram-feed" name="premium-instagram-feed" <?php checked(1, $this->pa_pro_get_settings['premium-instagram-feed'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Magic Section', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-magic-section" name="premium-magic-section" <?php checked(1, $this->pa_pro_get_settings['premium-magic-section'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                            </tr>
                            
                            <tr>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Messenger Chat', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-fb-chat" name="premium-fb-chat" <?php checked(1, $this->pa_pro_get_settings['premium-fb-chat'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Multi Scroll', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-multi-scroll" name="premium-multi-scroll" <?php checked(1, $this->pa_pro_get_settings['premium-multi-scroll'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                            </tr>
                            
                            <tr>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Preview Window', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-prev-img" name="premium-prev-img" <?php checked(1, $this->pa_pro_get_settings['premium-prev-img'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Table', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-tables" name="premium-tables" <?php checked(1, $this->pa_pro_get_settings['premium-tables'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>

                            </tr>
                            
                            <tr>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Tabs', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-tabs" name="premium-tabs" <?php checked(1, $this->pa_pro_get_settings['premium-tabs'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Twitter Feed', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-twitter-feed" name="premium-twitter-feed" <?php checked(1, $this->pa_pro_get_settings['premium-twitter-feed'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                            </tr>
                            
                            <tr>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Unfold', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-unfold" name="premium-unfold" <?php checked(1, $this->pa_pro_get_settings['premium-unfold'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Whatsapp Chat', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-whatsapp-chat" name="premium-whatsapp-chat" <?php checked(1, $this->pa_pro_get_settings['premium-whatsapp-chat'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                            </tr>
                            
                            <tr class="pa-sec-elems-tr"><th><h1><?php echo __('Section Elements', 'premium-addons-pro'); ?></h1></th></tr>
                            <tr>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Animated Gradient', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-gradient" name="premium-gradient" <?php checked(1, $this->pa_pro_get_settings['premium-gradient'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Parallax', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-parallax" name="premium-parallax" <?php checked(1, $this->pa_pro_get_settings['premium-parallax'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                            </tr>
                            
                            <tr>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Particles', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-particles" name="premium-particles" <?php checked(1, $this->pa_pro_get_settings['premium-particles'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                                <th><?php echo sprintf( '%1$s %2$s', $prefix, __('Ken Burns', 'premium-addons-pro') ); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-kenburns" name="premium-kenburns" <?php checked(1, $this->pa_pro_get_settings['premium-kenburns'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                            </tr>

<!--                            <tr class="pa-sec-elems-tr"><th><h1>Column Elements</h1></th></tr>
                            <tr>
                                <th><?php echo sprintf("%s Badge",$prefix); ?></th>
                                <td>
                                    <label class="switch">
                                            <input type="checkbox" id="premium-badge" name="premium-badge" <?php checked(1, $this->pa_pro_get_settings['premium-badge'], true) ?>>
                                            <span class="slider round"></span>
                                    </label>
                                </td>
                                
                            </tr>-->
                        </tbody>
                    </table>
                    <input type="submit" value="<?php echo __('Save Settings', 'premium-addons-pro'); ?>" class="button pa-btn pa-save-button">
                    
                </div>
                
                
                <?php if( ! Helper_Functions::is_show_rate() ) : ?>
                <div>
                    <p>Did you like Premium Addons for Elementor Plugin? Please <a href="https://wordpress.org/support/plugin/premium-addons-for-elementor/reviews/#new-post" target="_blank">Click Here to Rate it ★★★★★</a></p>
                </div>
                <?php endif; ?>

            </div>
            </form>
        </div>
	<?php
}

    public static function get_default_keys() {
        
        $default_keys = array_fill_keys( self::$pa_pro_elements_keys, true );
        
        return $default_keys;
    }
    
    public static function get_enabled_keys() {
        
        $enabled_keys = get_option( 'pa_pro_save_settings', self::get_default_keys() );
        
        return $enabled_keys;
    }

    public function pa_pro_save_settings() {
        if( isset( $_POST['fields'] ) ) {
            parse_str( $_POST['fields'], $settings );
        }else {
            return;
        }
        $this->pa_pro_settings = array(
            'premium-iconbox'           => intval( $settings['premium-iconbox'] ? 1 : 0),
            'premium-notbar'            => intval( $settings['premium-notbar'] ? 1 : 0),
            'premium-twitter-feed'      => intval( $settings['premium-twitter-feed'] ? 1 : 0),
            'premium-instagram-feed'    => intval( $settings['premium-instagram-feed'] ? 1 : 0),
            'premium-flipbox'           => intval( $settings['premium-flipbox'] ? 1 : 0),
            'premium-unfold'            => intval( $settings['premium-unfold'] ? 1 : 0),
            'premium-fb-chat'           => intval( $settings['premium-fb-chat'] ? 1 : 0),
            'premium-whatsapp-chat'     => intval( $settings['premium-whatsapp-chat'] ? 1 : 0),
            'premium-tabs'              => intval( $settings['premium-tabs'] ? 1 : 0),
            'premium-charts'            => intval( $settings['premium-charts'] ? 1 : 0),
            'premium-prev-img'          => intval( $settings['premium-prev-img'] ? 1 : 0),
            'premium-image-hotspots'    => intval( $settings['premium-image-hotspots'] ? 1 : 0),
            'premium-image-accordion'   => intval( $settings['premium-image-accordion'] ? 1 : 0 ),
            'premium-image-comparison'  => intval( $settings['premium-image-comparison'] ? 1 : 0 ),
            'premium-facebook-reviews'  => intval( $settings['premium-facebook-reviews'] ? 1 : 0),
            'premium-facebook-feed'     => intval( $settings['premium-facebook-feed'] ? 1 : 0),
            'premium-magic-section'     => intval( $settings['premium-magic-section'] ? 1 : 0),
            'premium-google-reviews'    => intval( $settings['premium-google-reviews'] ? 1 : 0),
            'premium-behance'           => intval( $settings['premium-behance'] ? 1 : 0),
            'premium-img-layers'        => intval( $settings['premium-img-layers'] ? 1 : 0),
            'premium-ihover'            => intval( $settings['premium-ihover'] ? 1 : 0),
            'premium-content-toggle'    => intval( $settings['premium-content-toggle'] ? 1 : 0),
            'premium-divider'           => intval( $settings['premium-divider'] ? 1 : 0),
            'premium-tables'            => intval( $settings['premium-tables'] ? 1 : 0),
            'premium-multi-scroll'      => intval( $settings['premium-multi-scroll'] ? 1 : 0),
            'premium-parallax'          => intval( $settings['premium-parallax'] ? 1 : 0),
            'premium-particles'         => intval( $settings['premium-particles'] ? 1 : 0),
            'premium-gradient'          => intval( $settings['premium-gradient'] ? 1 : 0),
            'premium-kenburns'          => intval( $settings['premium-kenburns'] ? 1 : 0)
        );
        update_option( 'pa_pro_save_settings', $this->pa_pro_settings );
        return true;
        die();    
    }
}