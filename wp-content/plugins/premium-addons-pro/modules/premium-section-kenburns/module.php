<?php

namespace PremiumAddonsPro\Modules\PremiumSectionKenburns;

use PremiumAddonsPro\Base\Module_Base;
use PremiumAddons\Helper_Functions;
use Elementor\Repeater;
use Elementor\Controls_Manager;

if( !defined( 'ABSPATH' ) ) exit;

class Module extends Module_Base {
    
    public function __construct() {
        
        parent::__construct();
        
        //Checks if Section Parallax is enabled
        $kenburns = get_option( 'pa_pro_save_settings' )['premium-kenburns'];
        
        $check_ken_active = isset( $kenburns ) ? $kenburns : 1;
        
        if( $check_ken_active ) {
            
            //Creates Premium Prallax tab at the end of section layout tab
            add_action( 'elementor/element/section/section_layout/after_section_end',array( $this,'register_controls' ), 10 );
            
            //insert data before section rendering
            add_action( 'elementor/frontend/section/before_render',array( $this,'before_render' ) );
            
            //Enqueue the required JS file
            add_action( 'elementor/frontend/after_enqueue_scripts', array( $this, 'premium_kenburns_enqueue_scripts' ), 9 );
        }
    }

    public function register_controls( $element ) {
        
        $element->start_controls_section('premium_kenburns_section',
            [
                'label'         => sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Ken Burns Effect', 'premium-addons-pro') ),
                'tab'           => Controls_Manager::TAB_LAYOUT
            ]
        );
        
        $element->add_control('premium_kenburns_notice',
            [
                'raw'           => __( 'Add the images that you need, Save and Preview to see your changes', 'premium-addons-pro' ),
                'type'          => Controls_Manager::RAW_HTML,
            ]
        );
        
        $element->add_control('premium_kenburns_switcher',
            [
                'label'             => __( 'Enable Ken Burns Effect', 'premium-addons-pro' ),
                'type'              => Controls_Manager::SWITCHER,
            ]
        );
        
        $repeater = new Repeater();
        
        $repeater->add_control('premium_kenburns_images',
            [
                'label'             => __( 'Upload Image', 'premium-addons-pro' ),
                'type'              => Controls_Manager::MEDIA,
                'dynamic'           => [ 'active' => true ],
                'label_block'       => true,
            ]
        );
        
        $repeater->add_control('premium_kenburns_image_fit',
            [
                'label'         => __( 'Image Fit', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'pa-fill'       => __( 'Fill', 'premium-addons-pro' ),
                    'pa-contain'    => __( 'Contain', 'premium-addons-pro' ),
                    'pa-cover'      => __( 'Cover', 'premium-addons-pro' ),
                ],
                'default'       => 'pa-fill',
                'label_block'   => 'true',
            ]
        );
        
        $repeater->add_control('premium_kenburns_dir',
            [
                'label'         => __( 'Direction', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'center'        => __( 'Center Center', 'premium-addons-pro' ),
                    'cl'            => __( 'Center Left', 'premium-addons-pro' ),
                    'cr'            => __( 'Center Right', 'premium-addons-pro' ),
                    'tc'            => __( 'Top Center', 'premium-addons-pro' ),
                    'bc'            => __( 'Bottom Center', 'premium-addons-pro' ),
                    'tl'            => __( 'Top Left', 'premium-addons-pro' ),
                    'tr'            => __( 'Top Right', 'premium-addons-pro' ),
                    'bl'            => __( 'Bottom Left', 'premium-addons-pro' ),
                    'br'            => __( 'Bottom Right', 'premium-addons-pro' ),
                ],
                'default'           => 'center',
                'label_block'       => 'true',
            ]
        );
        
        $element->add_control('premium_kenburns_repeater',
            [
                'type'          => Controls_Manager::REPEATER,
                'fields'        => array_values( $repeater->get_controls() ),
            ]
        );
        
        $element->add_control('premium_kenburns_speed',
            [
                'label'         => __('Transition Speed (sec)', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'    => [
                        'min'   => 1,
                        'max'   => 10,
                        'step'  => 0.1
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .kenburns-scale' => '-webkit-animation-duration: {{SIZE}}s; animation-duration: {{SIZE}}s;'
                ]
            ]
        );
        
        $element->add_control('premium_kenburns_fade',
            [
                'label'         => __('Fade Speed (sec)', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'    => [
                        'min'   => 1,
                        'max'   => 10,
                        'step'  => 0.1
                    ]
                ],
            ]
        );
        
        $element->add_control('premium_kenburns_infinite',
            [
                'label'         => __('Infinite', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('This option works only if you have only one image slide','premium-addons-pro'),
                'return_value'  => true
            ]
        );
        
        $element->add_control('premium_kenburns_overlay',
            [
                'label'         => __( 'Overlay Color', 'premium-addons-pro' ),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .premium-kenburns-overlay' => 'background-color: {{VALUE}};'
                ]
            ]
        );
        
        $element->end_controls_section();
         
   }
    
    public function premium_kenburns_enqueue_scripts() {
        
        wp_enqueue_script('cycle', PREMIUM_PRO_ADDONS_URL . 'assets/js/lib/cycle.min.js', array('jquery'), PREMIUM_PRO_ADDONS_VERSION, true);
        
        wp_enqueue_script('premium-pro-js', PREMIUM_PRO_ADDONS_URL . 'assets/js/premium-addons.js', array('jquery'), PREMIUM_PRO_ADDONS_VERSION, true);
        
    }
    
    public function before_render( $element ) {
        
        $data       = $element->get_data();
        
        $type       = $data['elType'];
        
        $settings   = $element->get_settings_for_display();
        
        if( 'section' == $type && 'yes' === $settings['premium_kenburns_switcher'] && isset( $settings['premium_kenburns_repeater'] ) ) {
            
            $transition = 1000 * ( ( isset( $settings['premium_kenburns_speed'] ) && !empty( $settings['premium_kenburns_speed']['size'] ) ) ? $settings['premium_kenburns_speed']['size'] : 6.5 );
            
            $fade       = 1000 * ( ( isset( $settings['premium_kenburns_fade'] ) && !empty( $settings['premium_kenburns_fade']['size'] ) ) ? $settings['premium_kenburns_fade']['size'] : 0.5 );
            
            $slides = array();
            
            foreach( $settings['premium_kenburns_repeater'] as $slide ) {
                
                array_push( $slides, $slide );
                
            }
            
            $kenburns_settings = [
                'speed'     => $transition,
                'fade'      => $fade,
                'slides'    => $slides,
                'infinite'  => $settings['premium_kenburns_infinite']
            ];
            
            $element->add_render_attribute( '_wrapper','data-kenburns', wp_json_encode( $kenburns_settings ) );
        
        }
    }    
}