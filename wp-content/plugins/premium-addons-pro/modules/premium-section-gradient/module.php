<?php

/**
 * Class: Module
 * Name: Section Animated Gradient
 * Slug: premium-gradient
 */

namespace PremiumAddonsPro\Modules\PremiumSectionGradient;

use Elementor\Repeater;
use Elementor\Controls_Manager;
use PremiumAddonsPro\Base\Module_Base;
use PremiumAddons\Helper_Functions;

if( ! defined( 'ABSPATH' ) ) exit;

class Module extends Module_Base {
    
    public function __construct() {
        
        parent::__construct();
        
        //Checks if Section Gradient is enabled
        $gradient = get_option( 'pa_pro_save_settings' )['premium-gradient'];
        
        $check_gradient_active = isset( $gradient ) ? $gradient : 1;
        
        if( $check_gradient_active ) {
            
            //Creates Premium Animated Gradient tab at the end of section layout tab
            add_action( 'elementor/element/section/section_layout/after_section_end',array( $this,'register_controls'), 10 );
            
            //Enqueue the required JS file
            add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'premium_gradient_enqueue_scripts' ), 9 );
            
            //insert data before section rendering
            add_action( 'elementor/frontend/section/before_render', array( $this,'before_render') );

        }
    }
    
    public function register_controls( $element ) {
        
        $element->start_controls_section('premium_gradient_section',
            [
                'label'         => sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Animated Gradient', 'premium-addons-pro') ),
                'tab'           => Controls_Manager::TAB_LAYOUT
            ]
        );
        
        $element->add_control('premium_gradient_update',
            [
               'label'          => '<div class="elementor-update-preview" style="background-color: #fff;"><div class="elementor-update-preview-title">Update changes to page</div><div class="elementor-update-preview-button-wrapper"><button class="elementor-update-preview-button elementor-button elementor-button-success">Apply</button></div></div>',
                'type'          => Controls_Manager::RAW_HTML
            ]
        );
        
        $element->add_control('premium_gradient_switcher',
            [
				'label'         => __( 'Enable Animated Gradient', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SWITCHER,
			]
		);
		
        $repeater = new Repeater();
		
        $element->add_control('premium_gradient_notice',
            [
                'raw'           => __( 'NOTICE: Please remove Elementor\'s background image/gradient for this section', 'premium-addons-pro' ),
                'type'          => Controls_Manager::RAW_HTML,
            ]
        );
        
        $repeater->add_control('premium_gradient_colors',
			[
				'label'         => __( 'Select Color', 'premium-addons-pro' ),
				'type'          => Controls_Manager::COLOR,
			]
		);
        
        $element->add_control('premium_gradient_colors_repeater',
            [
                'type'          => Controls_Manager::REPEATER,
                'fields'        => array_values( $repeater->get_controls() ),
                'title_field'   => '{{{ premium_gradient_colors }}}'
            ]
        );

        $element->add_control('premium_gradient_angle', 
			[
				'label'         => __( 'Put the Gradient Angle in degrees ', 'premium-addons-pro' ),
				'type'          => Controls_Manager::NUMBER,
                'default'       => -45,
                'min'           => -180,
                'max'           => 180,
			]
		);
        
        $element->end_controls_section();
        
    }
    
    public function premium_gradient_enqueue_scripts() {
        
        wp_enqueue_script( 
           'premium-pro-js',
            PREMIUM_PRO_ADDONS_URL . 'assets/js/premium-addons.js',
            array('jquery'),
            PREMIUM_PRO_ADDONS_VERSION,
            true
        );
        
    }
    
    public function before_render( $element ) {
        
		$data 		= $element->get_data();
        
        $type       = $data['elType'];
        
        $settings   = $element->get_settings_for_display();
        
		if( 'section' === $type && 'yes' === $settings['premium_gradient_switcher'] && isset( $settings['premium_gradient_colors_repeater'] ) ) {
            
            $grad_angle         = ! empty( $settings['premium_gradient_angle'] ) ? $settings['premium_gradient_angle'] : -45;
            
            $colors             = array();
            
            foreach( $settings['premium_gradient_colors_repeater'] as $color ) {
                
                array_push( $colors, $color );
                
            }
            
            $gradient_settings = [
                'angle'     => $grad_angle,
                'colors'    => $colors
            ];
            
            $element->add_render_attribute( '_wrapper','data-gradient', wp_json_encode( $gradient_settings ) );
        }
	}    
}