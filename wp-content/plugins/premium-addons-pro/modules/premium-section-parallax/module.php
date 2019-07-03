<?php

/**
 * Class: Module
 * Name: Section Parallax
 * Slug: premium-parallax
 */

namespace PremiumAddonsPro\Modules\PremiumSectionParallax;

use PremiumAddonsPro\Base\Module_Base;
use PremiumAddons\Helper_Functions;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Controls_Manager;


if( ! defined( 'ABSPATH' ) ) exit;

class Module extends Module_Base {
    
    public function __construct() {
        
        parent::__construct();
        
        //Checks if Section Parallax is enabled
        $parallax = get_option( 'pa_pro_save_settings' )['premium-parallax'];
        
        $check_parallax_active = isset( $parallax ) ? $parallax : 1;
        
        if( $check_parallax_active ) {
            
            //Creates Premium Prallax tab at the end of section layout tab
            add_action( 'elementor/element/section/section_layout/after_section_end',array($this,'register_controls'), 10 );
            
            //insert data before section rendering
            add_action( 'elementor/frontend/section/before_render',array($this,'before_render'), 10 );
            
            //Enqueue the required JS file
            add_action( 'wp_enqueue_scripts', array($this,'premium_parallax_enqueue_scripts'), 9 );
        }
    }
    
    public function register_controls( $element ) {
        
        $element->start_controls_section('premium_parallax_section',
            [
                'label'         => sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Parallax', 'premium-addons-pro') ),
                'tab'           => Controls_Manager::TAB_LAYOUT
            ]
        );
        
        $element->add_control('premium_parallax_update',
            [
               'label'          => '<div class="elementor-update-preview" style="background-color: #fff;"><div class="elementor-update-preview-title">Update changes to page</div><div class="elementor-update-preview-button-wrapper"><button class="elementor-update-preview-button elementor-button elementor-button-success">Apply</button></div></div>',
                'type'          => Controls_Manager::RAW_HTML
            ]
        );
        
        $element->add_control('premium_parallax_switcher',
            [
				'label'         => __( 'Enable Parallax', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SWITCHER,
			]
		);
        
		$element->add_control('premium_parallax_type',
			[
				'label'         => __( 'Type', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'scroll' 			=> __( 'Scroll', 'premium-addons-pro' ),
					'scroll-opacity' 	=> __( 'Scroll + Opacity', 'premium-addons-pro' ),
					'opacity' 			=> __( 'Opacity', 'premium-addons-pro' ),
					'scale' 			=> __( 'Scale', 'premium-addons-pro' ),
					'scale-opacity' 	=> __( 'Scale + Opacity', 'premium-addons-pro' ),
                    'automove'          => __( 'Auto Moving Background', 'premium-addons-pro' ),
                    'multi'             => __( 'Multi Layer Parallax', 'premium-addons-pro')
				],
				'label_block'   => 'true',
			]
		);
        
        $repeater = new Repeater();
        
        $repeater->add_control('premium_parallax_layer_image',
			[
				'label'         => __( 'Choose Image', 'premium-addons-pro' ),
				'type'          => Controls_Manager::MEDIA,
				'default'       => [
					'url' => Utils::get_placeholder_image_src(),
				],
                'label_block'   => true
			]
		);
        
        $repeater->add_responsive_control('premium_parallax_layer_hor_pos',
            [
                'label'         => __('Horizontal Position', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'description'   => __('Set the horizontal position for the layer background, default: 50%','premium-addons-pro'),
                'default'       => [
                    'size'  => 0
                ],
                'min'           => 0,
                'max'           => 100,
                'label_block'   => true,
            ]
        );
        
        $repeater->add_responsive_control('premium_parallax_layer_ver_pos',
            [
                'label'         => __('Vertical Position', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'  => 0
                ],
                'min'           => 0,
                'max'           => 100,
                'description'   => __('Set the vertical position for the layer background, default: 50%','premium-addons-pro'),
                'label_block'   => true,
                ]
            );
        
        $repeater->add_responsive_control('premium_parallax_layer_width',
            [
                'label'         => __('Size', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'  => 100
                ],
                'label_block'   => true,
                ]
            );

        $repeater->add_control('premium_parallax_layer_z_index',
			[
				'label'         => __( 'z-index', 'premium-addons-pro' ),
				'type'          => Controls_Manager::NUMBER,
				'default'       => 1,
				'description'   => __( 'Choose z-index for the parallax layer, default: 3', 'premium-addons-pro' ),
			]
		);
        
        $repeater->add_control('premium_parallax_layer_mouse',
            [
                'label'         => __('Mouse Track', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Enable or disable mousemove interaction','premium-addons-pro'),
            ]
        );
        
        $repeater->add_control('premium_parallax_layer_rate',
            [
                'label'         => __('Rate', 'premium-addons-pro'),
                'type'          => Controls_Manager::NUMBER,
                'default'       => -10,
                'min'           => -20,
                'max'           => 20,
                'step'          => 1,
                'description'   => __('Choose the movement rate for the layer background, default: -10','premium-addons-pro'),
                'condition'     => [
                    'premium_parallax_layer_mouse' => 'yes'
                ]
            ]
        );
        
        $repeater->add_control('premium_parallax_layer_scroll',
            [
                'label'         => __('Scroll Parallax', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Enable or disable scroll parallax','premium-addons-pro'),
            ]
        );
        
        $repeater->add_control('premium_parallax_layer_direction',
			[
				'label'         => __( 'Direction', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'up'    => __( 'Up', 'premium-addons-pro' ),
					'down'  => __( 'Down', 'premium-addons-pro' ),
				],
                'default'       => 'down',
				'condition'     => [
					'premium_parallax_layer_scroll'     => 'yes'
				],
			]
		);
        
        $repeater->add_control('premium_parallax_layer_speed',
			[
				'label'         => __( 'Speed', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SLIDER,
				'default' => [
                    'size' => 4,
                ],
                'range' => [
                    'px' => [
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
				'condition'     => [
                    'premium_parallax_layer_scroll' => 'yes'
				],
			]
		);
        
        $repeater->add_control('premium_parallax_layer_view',
			[
				'label'         => __( 'Viewport', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SLIDER,
				'default' => [
                    'sizes' => [
                        'start' => 0,
                        'end' => 100,
                    ],
                    'unit' => '%',
                ],
                'labels' => [
                    __( 'Bottom', 'premium-addons-pro' ),
                    __( 'Top', 'premium-addons-pro' ),
                ],
                'scales' => 1,
                'handles' => 'range',
                'condition'     => [
                    'premium_parallax_layer_scroll' => 'yes'
				],
			]
		);
        
		$element->add_control('premium_parallax_auto_type',
			[
				'label'         => __( 'Direction', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'left'  => __( 'Left to Right', 'premium-addons-pro' ),
					'right' => __( 'Right to Left', 'premium-addons-pro' ),
					'top' 	=> __( 'Top to Bottom', 'premium-addons-pro' ),
					'bottom'=> __( 'Bottom to Top', 'premium-addons-pro' ),
				],
                'default'       => 'left',
				'condition'     => [
					'premium_parallax_type'     => 'automove'
				],
			]
		);

		
		$element->add_control('premium_parallax_speed',
			[
				'label'         => __( 'Speed', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
                    'px'  => [
                        'min'   => -1,
                        'max'   => 2,
                        'step'  => 0.1
                    ]
                ],
				'condition'     => [
                    'premium_parallax_type!'    => [ 'automove' , 'multi' ]
				],
			]
		);

        $element->add_control('premium_auto_speed',
			[
				'label'         => __( 'Speed', 'premium-addons-pro' ),
				'type'          => Controls_Manager::NUMBER,
				'default'       => 3,
                'min'           => 0,
                'max'           => 150,
				'description'   => __( 'Set the speed of background movement, default: 3', 'premium-addons-pro' ),
				'condition'     => [
                    'premium_parallax_type'     => 'automove'
				],
			]
		);
		
		$element->add_control('premium_parallax_android_support',
			[
				'label'         => __( 'Enable Parallax on Android', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SWITCHER,
				'condition'     => [
                    'premium_parallax_type!'    => [ 'automove' , 'multi' ]
				],
			]
		);
		
		$element->add_control('premium_parallax_ios_support',
			[
				'label'         => __( 'Enable Parallax on iOS', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SWITCHER,
				'condition'     => [
                    'premium_parallax_type!'    => [ 'automove' , 'multi' ]
				],
			]
		);
        
//        $element->add_control('premium_parallax_notice',
//            [
//                'raw'           => __( 'Kindly, be noted that the option below works only with multi layer parallax effect', 'premium-addons-pro' ),
//                'type'          => Controls_Manager::RAW_HTML,
//            ]
//        );
        
        $element->add_control('premium_parallax_notice', 
            [
                'raw'               => __('NEW: Now you can position, resize parallax layers from the preview area', 'premium-addons-for-elemeentor'),
                'type'              => Controls_Manager::RAW_HTML,
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition'     => [
                    'premium_parallax_type'    => 'multi'
				]
            ] 
        );

        $element->add_control('premium_parallax_layers_list',
            [
                'type'          => Controls_Manager::REPEATER,
                'fields'        => array_values( $repeater->get_controls() ),
                'condition'     => [
                    'premium_parallax_type'    => 'multi'
				],
            ]
        );
        
        $element->add_control('premium_parallax_layers_devices',
            [
                'label'             => __('Apply Scroll Parallax On', 'premium-addons-pro'),
                'type'              => Controls_Manager::SELECT2,
                'options'           => [
                    'desktop'   => __('Desktop','premium-addons-pro'),
                    'tablet'    => __('Tablet','premium-addons-pro'),
                    'mobile'    => __('Mobile','premium-addons-pro'),
                ],
                'default'           => [ 'desktop', 'tablet', 'mobile' ],
                'multiple'          => true,
                'label_block'       => true,
                'condition'     => [
                    'premium_parallax_type'    => 'multi'
				],
            ]);
        
        $element->end_controls_section();
        
    }
    
    public function premium_parallax_enqueue_scripts() {
        
        wp_enqueue_script('tweenmax-js', PREMIUM_PRO_ADDONS_URL.'assets/js/lib/TweenMax.min.js',array( 'jquery' ), PREMIUM_PRO_ADDONS_VERSION, true);
        
        wp_enqueue_script('parallax-js', PREMIUM_PRO_ADDONS_URL.'assets/js/lib/jarallax.min.js',array( 'jquery' ), PREMIUM_PRO_ADDONS_VERSION, true);
        
        wp_enqueue_script('premium-pro-js', PREMIUM_PRO_ADDONS_URL . 'assets/js/premium-addons.js', array('jquery'), PREMIUM_PRO_ADDONS_VERSION, true);
        
    }
    
    public function before_render( $element ) {
        
        $data       = $element->get_data();
        
        $type       = $data['elType'];
        
        $settings   = $element->get_settings_for_display();
        
        $parallax   = isset( $settings['premium_parallax_type'] ) ? $settings['premium_parallax_type']: '';
        
        if( 'section' === $type && isset( $parallax ) && '' !== $parallax && 'yes' === $element->get_settings('premium_parallax_switcher') ) {
            
            $parallax_settings = array(
                'type'  => $parallax
            );
            
            if ( "multi" !== $parallax && "automove" !== $parallax ) {
                $speed = isset ( $settings['premium_parallax_speed']['size'] ) ? $settings['premium_parallax_speed']['size'] : 0.5;
                $parallax_settings = array_merge( $parallax_settings, [
                    'speed'      => $speed,
                    'android'    => "yes" === $settings['premium_parallax_android_support'] ? 0 : 1,
                    'ios'        => "yes" === $settings['premium_parallax_ios_support'] ? 0 : 1,
                    'size'       => $settings['background_size'],
                    'position'   => $settings['background_position'],
                    'repeat'     => $settings['background_repeat'],
                ] );

              } else if ( "automove" === $parallax ) {
                
                $speed = ! empty( $settings['premium_auto_speed'] ) ? $settings['premium_auto_speed'] : 3;
                $type  = ! empty ( $settings['premium_parallax_auto_type'] ) ? $settings['premium_parallax_auto_type'] : 'left';
                $parallax_settings = array_merge( $parallax_settings, [
                    'speed'     => $speed,
                    'direction' => $type
                ] );
                
              } else {
                  
                $layers = array();
                
                foreach( $settings['premium_parallax_layers_list'] as $layer ) {
                
                    array_push( $layers, $layer );
                
                }
                
                $parallax_settings = array_merge( $parallax_settings, [
                    'items'     => $layers,
                    'devices'   => $settings['premium_parallax_layers_devices']
                ] );
                
            }
                
            $element->add_render_attribute( '_wrapper','data-pa-parallax', wp_json_encode( $parallax_settings ) );
            
        }
	}    
}