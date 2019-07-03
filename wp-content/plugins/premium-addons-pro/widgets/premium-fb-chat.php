<?php

/**
 * Class: Premium_Fb_Chat
 * Name: Behance Feed
 * Slug: premium-behance-feed
 */

namespace PremiumAddonsPro\Widgets;

use PremiumAddons\Helper_Functions;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

if( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Premium_Fb_Chat extends Widget_Base {
    
    public function get_name(){
        return 'premium-addon-facebook-chat';
    }
    
    public function get_title() {
		return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Messenger Chat', 'premium-addons-pro') );
	}
    
    public function is_reload_preview_required() {
        return true;
    }
    
    public function get_icon(){
        return 'pa-pro-messenger-chat';
    }
    
    public function get_script_depends(){
        return ['premium-pro-js'];
    }
    
    public function get_categories(){
        return [ 'premium-elements' ];
    }

    // Adding the controls fields for the Premium Facebook Chat
    // This will controls the animation, colors and background, dimensions etc
    protected function _register_controls(){
        
        $this->start_controls_section('premium_fbchat_account_settings',
            [
                'label'         => __('Account Settings','premium-addons-pro'),
            ]
        );
        
        $this->add_control('premium_fbchat_app_id',
            [
                'label'         => __('App ID', 'premium-addons-pro'),
                'description'   => 'Click <a href="https://developers.facebook.com/docs/apps/register" target="_blank">Here</a> to create and get App Id',
                'type'          => Controls_Manager::TEXT,
            ]
        );
        
        $this->add_control('premium_fbchat_page_id',
            [
                'label'         => __('Page ID', 'premium-addons-pro'),
                'description'   => 'You need to put your site URL in whitelisted domains in your page messenger platform settings, Click <a href="https://www.facebook.com/help/community/question/?id=378910098941520" target="_blank">Here</a> to know how to get your page ID',
                'type'          => Controls_Manager::TEXT,
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_fbchat_message',
            [
                'label'         => __('Messages','premium-addons-pro'),
            ]
        );
        
        $this->add_control('premium_fbchat_login_msg',
            [
                'label'         => __('Logged in Message', 'premium-addons-pro'),
                'dynamic'       => [ 'active' => true ],
                'description'   => __('The greeting text that will be displayed if the user is currently logged in to Facebook. Maximum 80 characters.','premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
            ]
        );
        
        $this->add_control('premium_fbchat_logout_msg',
            [
                'label'         => __('Logged out Message', 'premium-addons-pro'),
                'dynamic'       => [ 'active' => true ],
                'description'   => __('The greeting text that will be displayed if the user is not currently logged in to Facebook. Maximum 80 characters.','premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
            ]
        );
        
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_fbchat_adv_section',
            [
                'label'         => __('Advanced Settings','premium-addons-pro'),
            ]
        );
        
        $this->add_control('premium_fbchat_lang',
            [
                'label'         => __('Language', 'premium-addons-pro'),
                'description'   => __('Select language for the chat box, default is English', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'en_US',
                'options'       => [
                    'en_US' => __('English','premium-addons-pro'),
                    'fr_FR' => __('French','premium-addons-pro'),
                    'da_DK' => __('Danish','premium-addons-pro'),
                    'de_DE' => __('German','premium-addons-pro'),
                    'ja_JP' => __('Japanese','premium-addons-pro'),
                    'ko_KR' => __('Korean','premium-addons-pro'),
                    'he_IL' => __('Hebrew','premium-addons-pro'),
                    'es_ES' => __('Spanish','premium-addons-pro'),
                ],
                'label_block'   =>  true,
            ]
        );
        
        $this->add_control('premium_fbchat_ref',
            [
                'label'         => __('Ref', 'premium-addons-pro'),
                'description'   => __('Optional. Custom string passed to your webhook in messaging_postbacks and messaging_referrals events.','premium-addons-pro'),
            ]
        );
        
        $this->add_control('premium_fbchat_mini',
            [
                'label'         => __('Minimized', 'premium-addons-pro'),
                'description'   => __('Specifies whether the plugin should be minimized or shown. Defaults to false on desktop and true on mobile browsers.','premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
            ]
        );
        
        $this->add_control('premium_fbchat_hide_mobile',
            [
                'label'         => __('Hide on Mobiles', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('This will hide the messenger chat on mobile phones','premium-addons-pro'),
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_fbchat_style',
            [
                'label'         => __('Icon','premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );
        
        $this->add_control('premium_fbchat_theme_color',
            [
                'label'         => __('Theme Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
            ]
        );
        
        $this->add_control('premium_fbchat_position_select', 
            [
                'label'         => __('Position', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'topleft'       => __('Top Left', 'premium-addons-pro'),
                    'topright'      => __('Top Right', 'premium-addons-pro'),
                    'bottomleft'    => __('Bottom Left', 'premium-addons-pro'),
                    'bottomright'   => __('Bottom Right', 'premium-addons-pro'),
                    'custom'        => __('Custom', 'premium-addons-pro'),
                ],
                'default'       => 'bottomright',
                'label_block'   => true,
            ]
        );
        
        $this->add_control('premium_fbchat_hor_position',
            [
                'label'         => __('Horizontal Position', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'default'       =>  [
                    'size'  => 0
                    ],
                'condition'     => [
                    'premium_fbchat_position_select'    => 'custom'
                ]
            ]
        );
                
        $this->add_control('premium_fbchat_ver_position',
            [
                'label'         => __('Vertical Position', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'default'       =>  [
                    'size'  => 0
                ],
                'condition'     => [
                    'premium_fbchat_position_select'    => 'custom'
                ]
            ]
        );
        
        $this->end_controls_section();
        
        
    }
    
    /**
	 * renders the HTML content of the widget
	 * @return void
	 */
    protected function render(){
        
        $settings   = $this->get_settings_for_display();
        
        $app_id     = $settings['premium_fbchat_app_id'];
        
        $page_id    = $settings['premium_fbchat_page_id'];
        
        $login_msg  = $settings['premium_fbchat_login_msg'];
        
        $logout_msg = $settings['premium_fbchat_logout_msg'];
        
        $theme_color= $settings['premium_fbchat_theme_color'];
        
        $position   = $settings['premium_fbchat_position_select'];
        
        $hide_mobile= $settings['premium_fbchat_hide_mobile'] == 'yes' ? true : false;
        
        $ref        = $settings['premium_fbchat_ref'];
        
        $language   = $settings['premium_fbchat_lang'];
        
        $pa_chat_settings = [
            'appId'         => $app_id,
            'hideMobile'    => $hide_mobile,
            'lang'          => $language
        ];
    
        $this->add_render_attribute('chat', [
                'class'                 => 'fb-customerchat',
                'page_id'               => esc_attr( $page_id ),
                'theme_color'           => esc_attr( $theme_color ),
                'logged_in_greeting'    => esc_attr( $login_msg ),
                'logged_out_greeting'   => esc_attr( $logout_msg ),
                'ref'                   => esc_attr( $ref ),
            ]
        );
        
        
        if ( 'yes' != $settings['premium_fbchat_mini'] ) {
            $this->add_render_attribute('chat', 'minimized', false);
        }
        
        
        ?>
    
    <div id="premium-fbchat-container" class="premium-fbchat-container" data-settings='<?php echo wp_json_encode( $pa_chat_settings ); ?>'>
      <div <?php echo $this->get_render_attribute_string('chat'); ?>></div>
    </div>
    <style>
        <?php if( 'bottomleft' == $position ) : ?>
        .fb_dialog,
        .fb-customerchat * > iframe {
            left: 18pt !important;
            right: auto;
        }
        <?php elseif( 'bottomright' == $position ) : ?>
        .fb_dialog,
        .fb-customerchat * > iframe {
            right: 18pt !important;
            left: auto;
        }
        <?php elseif('topleft' == $position ) : ?>
        .fb_dialog,
        .fb-customerchat * > iframe {
            left: 18pt !important;
            right: auto;
            top:18px !important;
            bottom: auto;
        }
        <?php elseif( 'topright' == $position ) : ?>
        .fb_dialog,
        .fb-customerchat * > iframe {
            right: 18pt !important;
            left: auto;
            top:18px !important;
            bottom: auto;
        }
        <?php elseif( 'custom' == $position ) : ?>
        .fb_dialog,
        .fb-customerchat * > iframe {
            left: <?php echo $settings['premium_fbchat_hor_position']['size'] . '%'; ?> !important;
            right: auto;
            top: <?php echo $settings['premium_fbchat_ver_position']['size'] . '%'; ?> !important;
            bottom: auto;
            -webkit-transform: translate(-50%,-50%);
            transform: translate(-50%,-50%);
        }
        <?php endif; ?>
    </style>
    
<?php 
    }
}