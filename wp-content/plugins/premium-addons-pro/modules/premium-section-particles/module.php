<?php

/**
 * Class: Module
 * Name: Section Particles
 * Slug: premium-particles
 */

namespace PremiumAddonsPro\Modules\PremiumSectionParticles;

use PremiumAddonsPro\Base\Module_Base;
use PremiumAddons\Helper_Functions;
use Elementor\Controls_Manager;

if( !defined( 'ABSPATH' ) ) exit;

class Module extends Module_Base {
    
    public function __construct() {
        
        parent::__construct();
        
        //Checks if Section Particles is enabled
        $particles = get_option( 'pa_pro_save_settings' )['premium-particles'];
        
        $check_particles_active = isset( $particles ) ? $particles : 1;
        
        if( $check_particles_active ) {
            
            //Register Controls inside Section Layout tab
            add_action( 'elementor/element/section/section_layout/after_section_end',array( $this,'register_controls' ), 10 );
            
            //insert data before section rendering
            add_action( 'elementor/frontend/section/before_render',array( $this,'before_render' ), 10, 1 );
            
            //Enqueue the required JS file
            add_action( 'wp_enqueue_scripts', array( $this,'premium_particles_enqueue_scripts' ) );
            
        }
    }
    
    public function register_controls( $element ) {
        
        $element->start_controls_section('premium_particles_section',
            [
                'label'         => sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Particles', 'premium-addons-pro') ),
                'tab'           => Controls_Manager::TAB_LAYOUT
            ]
        );
        
        $element->add_control('premium_particles_switcher',
            [
                'label'         => __( 'Enable Particles', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SWITCHER,
            ]
        );
        
        $element->add_control('premium_particles_zindex',
            [
                'label'         => __( 'Z-index', 'premium-addons-pro' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 0
            ]
        );
        
        $element->add_control('premium_particles_custom_style',
            [
                'label'         => __( 'Custom Style', 'premium-addons-pro' ),
                'type'          => Controls_Manager::CODE,
                'description'   => __( 'Paste your particles JSON code here - Generate it from <a href="http://vincentgarreau.com/particles.js/#default" target="_blank">Here!</a>', 'premium-addons-pro' ),
                'render_type' => 'template',
            ]
        );

        $element->add_control('premium_particles_notice',
            [
                'raw'           => __( 'Kindly, be noted that you will need to add a background as particles JSON code doesn\'t include a background color', 'premium-addons-pro' ),
                'type'          => Controls_Manager::RAW_HTML,
            ]
        );
        
        $element->end_controls_section();
        
    }
    
    public function premium_particles_enqueue_scripts() {
        
        wp_enqueue_script('particles-js', PREMIUM_PRO_ADDONS_URL.'assets/js/lib/particles.min.js',array(), PREMIUM_PRO_ADDONS_VERSION, false);
        
        wp_enqueue_script('premium-pro-js', PREMIUM_PRO_ADDONS_URL . 'assets/js/premium-addons.js', array('jquery'), PREMIUM_PRO_ADDONS_VERSION, true);
        
    }
    
    public function before_render( $element ) {
        
        $data               = $element->get_data();
        
        $type               = $data['elType'];
        
        $settings           = $element->get_settings_for_display();
        
        $zindex             = ! empty( $settings['premium_particles_zindex'] ) ? $settings['premium_particles_zindex'] : 0;
        
        if( 'section' == $type && 'yes' === $settings['premium_particles_switcher'] ) {
            
            if( ! empty( $settings['premium_particles_custom_style'] ) ) {
                
                $particles_settings = [
                    'zindex'    => $zindex,
                    'style'     => $settings['premium_particles_custom_style']
                ];
                
                $element->add_render_attribute( '_wrapper', [
                    'data-particles-style'  => $particles_settings['style'],
                    'data-particles-zindex' => $particles_settings['zindex']
                ]);
                
                ?>
                
            <?php }
        }
    }
}