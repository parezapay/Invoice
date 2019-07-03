<?php

/**
 * Class: Premium_Img_Layers
 * Name: Image Layers
 * Slug: premium-img-layers-addon
 */

namespace PremiumAddonsPro\Widgets;

use PremiumAddons\Helper_Functions;
use PremiumAddons\Includes;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;

if(!defined('ABSPATH')) exit;

class Premium_Img_Layers extends Widget_Base {
    
    private $templateInstance; 
    
    public function getTemplateInstance() {
        return $this->templateInstance = Includes\premium_Template_Tags::getInstance();
    }
    
    public function get_name() {
        return 'premium-img-layers-addon';
    }

    public function get_title() {
        return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Image Layers', 'premium-addons-pro') );
    }

    public function get_icon() {
        return 'pa-pro-image-layers';
    }

    public function get_categories() {
        return ['premium-elements'];
    }

    public function get_script_depends() {
        return [
            'parallaxmouse-js',
            'tweenmax-js',
            'tilt-js',
            'elementor-waypoints',
            'premium-pro-js'
        ];
    }

    public function is_reload_preview_required() {
        return true;
    }
    
    // Adding the controls fields for the Image layers
    // This will controls the animation, colors and background, dimensions etc
    protected function _register_controls() {
        
        $this->start_controls_section('premium_img_layers_content',
            [
                'label'         => __('Images','premium-addons-pro'),
            ]
        );
        
        $this->add_control('premium_img_layers_notice', 
            [
                'raw'               => __('NEW: Now you can position, resize layers from the preview area', 'premium-addons-for-elemeentor'),
                'type'              => Controls_Manager::RAW_HTML,
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ] 
        );
        
        $repeater = new Repeater();
        
        $repeater->add_control('premium_img_layers_image',
           [
                'label'         => __( 'Upload Image', 'premium-addons-pro' ),
                'type'          => Controls_Manager::MEDIA,
               'dynamic'       => [ 'active' => true ],
                'default'       => [
                    'url'	=> Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $repeater->add_control('premium_img_layers_alt',
            [
                'label'         => __( 'Alt', 'premium-addons-pro' ),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'placeholder'   => 'Premium Image Layers',
                'label_block'   => true,
            ]
        );
        
        $repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'          => 'thumbnail',
				'default'       => 'full',
			]
		);

        $repeater->add_control('premium_img_layers_position',
            [
                'label'         => __('Position', 'premium-addons-pro'),
                'type'          => Controls_Manager::HIDDEN,
                'options'       => [
                    'relative'      => __('Relative','premium-addons-pro'),
                    'absolute'      => __('Absolute','premium-addons-pro'),
                ]
            ]
        );
        
        $repeater->add_responsive_control('premium_img_layers_hor_position',
            [
                'label'         => __('Horizontal Offset','premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'description'   => __('Mousemove Interactivity works only with pixels', 'premium-addons-pro'),
                'size_units'    => ['px', '%'],
                'range'         => [
                    'px'    => [
                        'min'   => -200, 
                        'max'   => 300,
                    ],
                    '%'    => [
                        'min'   => -50, 
                        'max'   => 100,
                    ],
                ],
//                'default'       => [
//                    'unit'  => '%',
//                    'size'  => 50,
//                ],
                'selectors'     => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.absolute' => 'left: {{SIZE}}{{UNIT}};'
                ],
            ]
        );
        
        $repeater->add_responsive_control('premium_img_layers_ver_position',
            [
                'label'         => __('Vertical Offset','premium-addons-pro'),
                'description'   => __('Mousemove Interactivity works only with pixels', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%'],
                'range'         => [
                    'px'    => [
                        'min'   => -200, 
                        'max'   => 300,
                    ],
                    '%'    => [
                        'min'   => -50, 
                        'max'   => 100,
                    ],
                ],
//                'default'       => [
//                    'unit'  => '%',
//                    'size'  => 50,
//                ],
                'selectors'     => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.absolute' => 'top: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $repeater->add_responsive_control('premium_img_layers_width',
            [
                'label'         => __('Width','premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%', "vw"],
                'range' => [
					'px' => [
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
                'selectors'     => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};'
                ],
                'separator'     => 'after',
            ]
        );

        $repeater->add_control('premium_img_layers_link_switcher',
            [
                'label'         => __('Link','premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
            ]
        );
        
        $repeater->add_control('premium_img_layers_link_selection', 
            [
                'label'         => __('Link Type', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'url'   => __('URL', 'premium-addons-pro'),
                    'link'  => __('Existing Page', 'premium-addons-pro'),
                ],
                'default'       => 'url',
                'label_block'   => true,
                'condition'		=> [
                	'premium_img_layers_link_switcher'	=> 'yes'
            	]
        	]
        );
        
        $repeater->add_control('premium_img_layers_link',
            [
                'label'         => __('Link', 'premium-addons-pro'),
                'type'          => Controls_Manager::URL,
                'dynamic'       => [ 'active' => true ],
                'default'       => [
                    'url'   => '#',
                ],
                'placeholder'   => 'https://premiumaddons.com/',
                'label_block'   => true,
                'separator'     => 'after',
                'condition'     => [
                	'premium_img_layers_link_switcher'	=> 'yes',
                    'premium_img_layers_link_selection' => 'url'
                ]
            ]
        );
        
        $repeater->add_control('premium_img_layers_existing_link',
            [
                'label'         => __('Existing Page', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT2,
                'options'       => $this->getTemplateInstance()->get_all_post(),
                'condition'     => [
                	'premium_img_layers_link_switcher'	=> 'yes',
                    'premium_img_layers_link_selection' => 'link',
                ],
                'multiple'      => false,
                'separator'     => 'after',
                'label_block'   => true,
            ]
        );

        $repeater->add_control('premium_img_layers_rotate',
            [
                'label'         => __('Rotate', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
            ]
        );

        $repeater->add_control('premium_img_layers_rotatex',
            [
                'label'         => __('Degrees', 'premium-addons-pro'),
                'type'          => Controls_Manager::NUMBER,
                'description'   => __('Set rotation value in degress', 'premium-addons-pro'),
                'min'           => -180,
                'max'           => 180,
                'condition'     => [
                    'premium_img_layers_rotate'   => 'yes'
                ],
                'separator'     => 'after',
                'selectors'     => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => '-webkit-transform: rotate({{VALUE}}deg); -moz-transform: rotate({{VALUE}}deg); -o-transform: rotate({{VALUE}}deg); transform: rotate({{VALUE}}deg);'
                ],
            ]
        );
        
        $repeater->add_control('premium_img_layers_animation_switcher',
            [
                'label'        => __('Animation','premium-addons-pro'),
                'type'         => Controls_Manager::SWITCHER,
            ]
        );
        
        $repeater->add_control('premium_img_layers_animation',
			[
				'label'         => __( 'Entrance Animation', 'premium-addons-pro' ),
				'type'          => Controls_Manager::ANIMATION,
				'default'       => '',
				'label_block'   => false,
                'frontend_available' => true,
                'condition'     => [
                    'premium_img_layers_animation_switcher' => 'yes'
                ],
				'frontend_available' => true,
			]
		);
        
        $repeater->add_control('premium_img_layers_animation_duration',
			[
				'label'         => __( 'Animation Duration', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => '',
				'options'       => [
					'slow' => __( 'Slow', 'premium-addons-pro' ),
					''     => __( 'Normal', 'premium-addons-pro' ),
					'fast' => __( 'Fast', 'premium-addons-pro' ),
				],
                'condition'     => [
                    'premium_img_layers_animation_switcher' => 'yes',
					'premium_img_layers_animation!'    => '',
				],
			]
		);
        
        $repeater->add_control('premium_img_layers_animation_delay',
			[
				'label'         => __( 'Animation Delay', 'premium-addons-pro' ) . ' (s)',
				'type'          => Controls_Manager::NUMBER,
				'default'       => '',
				'min'           => 0,
				'step'          => 0.1,
				'condition'     => [
                    'premium_img_layers_animation_switcher' => 'yes',
					'premium_img_layers_animation!'    => '',
				],
				'frontend_available' => true,
                'selectors'     => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.animated' => '-webkit-animation-delay:{{VALUE}}s; -moz-animation-delay: {{VALUE}}s; -o-animation-delay: {{VALUE}}s; animation-delay: {{VALUE}}s;'
                ]
			]
		);
        
        $repeater->add_control('premium_img_layers_mouse',
            [
                'label'         => __('Mousemove Interactivity', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Enable or disable mousemove interaction','premium-addons-pro'),
            ]
        );
        
        $repeater->add_control('premium_img_layers_mouse_type', 
            [
                'label'         => __('Interactivity Style', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'parallax'      => __('Mouse Parallax', 'premium-addons-pro'),
                    'tilt'          => __('Tilt', 'premium-addons-pro'),
                ],
                'default'       => 'parallax',
                'label_block'   => true,
                'condition'		=> [
                	'premium_img_layers_mouse'	=> 'yes'
            	]
        	]
        );
        
        $repeater->add_control('premium_img_layers_rate',
            [
                'label'         => __('Rate', 'premium-addons-pro'),
                'type'          => Controls_Manager::NUMBER,
                'default'       => -10,
                'min'           => -20,
                'max'           => 20,
                'step'          => 1,
                'description'   => __('Choose the movement rate for the layer image, default: -10','premium-addons-pro'),
                'separator'     => 'after',
                'condition'     => [
                    'premium_img_layers_mouse' => 'yes',
                            'premium_img_layers_mouse_type' => 'parallax'
                    ]
                ]
            );
        
        $repeater->add_control('premium_img_layers_scroll_effects',
            [
                'label'         => __('Scroll Effects', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER
            ]
        );
        
        $conditions = array(
            'premium_img_layers_scroll_effects' => 'yes'
        );
        
        $repeater->add_control('premium_img_layers_opacity',
            [
                'label'         => __('Scroll Fade', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'condition'     => $conditions
            ]
        );
        
        $repeater->add_control('premium_img_layers_opacity_effect',
			[
				'label'         => __( 'Direction', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'down'  => __( 'Fade In', 'premium-addons-pro' ),
					'up'    => __( 'Fade Out', 'premium-addons-pro' ),
				],
                'default'       => 'down',
				'condition'     => array_merge( $conditions, [
					'premium_img_layers_opacity'     => 'yes'
				] ) ,
			]
		);
        
        $repeater->add_control('premium_img_layers_opacity_level',
			[
				'label'         => __( 'Opacity Level', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SLIDER,
				'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
				'condition'     => array_merge( $conditions, [
					'premium_img_layers_opacity'     => 'yes'
				] ) ,
			]
		);
        
        $repeater->add_control('premium_img_layers_opacity_view',
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
                'condition'     => array_merge( $conditions, [
					'premium_img_layers_opacity'     => 'yes'
				] ) ,
			]
		);
        
        $repeater->add_control('premium_img_layers_vscroll',
            [
                'label'         => __('Vertical Parallax', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'condition'     => $conditions
            ]
        );
        
        $repeater->add_control('premium_img_layers_vscroll_direction',
			[
				'label'         => __( 'Direction', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'up'    => __( 'Up', 'premium-addons-pro' ),
					'down'  => __( 'Down', 'premium-addons-pro' ),
				],
                'default'       => 'down',
				'condition'     => array_merge( $conditions, [
					'premium_img_layers_vscroll'     => 'yes'
				] ) ,
			]
		);
        
        $repeater->add_control('premium_img_layers_vscroll_speed',
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
				'condition'     => array_merge( $conditions, [
					'premium_img_layers_vscroll'     => 'yes'
				] ) ,
			]
		);
        
        $repeater->add_control('premium_img_layers_vscroll_view',
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
                'condition'     => array_merge( $conditions, [
					'premium_img_layers_vscroll'     => 'yes'
				] ) ,
			]
		);
        
        $repeater->add_control('premium_img_layers_hscroll',
            [
                'label'         => __('Horizontal Parallax', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'condition'     => $conditions
            ]
        );
        
        $repeater->add_control('premium_img_layers_hscroll_direction',
			[
				'label'         => __( 'Direction', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'up'    => __( 'To Left', 'premium-addons-pro' ),
					'down'  => __( 'To Right', 'premium-addons-pro' ),
				],
                'default'       => 'down',
				'condition'     => array_merge( $conditions, [
					'premium_img_layers_hscroll'     => 'yes'
				] ) ,
			]
		);
        
        $repeater->add_control('premium_img_layers_hscroll_speed',
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
				'condition'     => array_merge( $conditions, [
					'premium_img_layers_hscroll'     => 'yes'
				] ) ,
			]
		);
        
        $repeater->add_control('premium_img_layers_hscroll_view',
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
                'condition'     => array_merge( $conditions, [
					'premium_img_layers_hscroll'     => 'yes'
				] ) ,
			]
		);
        
        $repeater->add_control('premium_img_layers_blur',
            [
                'label'         => __('Blur', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'condition'     => $conditions
            ]
        );
        
        $repeater->add_control('premium_img_layers_blur_effect',
			[
				'label'         => __( 'Direction', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'down'  => __( 'Decrease Blur', 'premium-addons-pro' ),
					'up'    => __( 'Increase Blur', 'premium-addons-pro' ),
				],
                'default'       => 'down',
				'condition'     => array_merge( $conditions, [
					'premium_img_layers_blur'     => 'yes'
				] ) ,
			]
		);
        
        $repeater->add_control('premium_img_layers_blur_level',
			[
				'label'         => __( 'Blur Level', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SLIDER,
				'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
				'condition'     => array_merge( $conditions, [
					'premium_img_layers_blur'     => 'yes'
				] ) ,
			]
		);
        
        $repeater->add_control('premium_img_layers_blur_view',
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
                'condition'     => array_merge( $conditions, [
					'premium_img_layers_blur'     => 'yes'
				] ) ,
			]
		);
        
        $repeater->add_control('premium_img_layers_rscroll',
            [
                'label'         => __('Rotate', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'condition'     => $conditions
            ]
        );
        
        $repeater->add_control('premium_img_layers_rscroll_direction',
			[
				'label'         => __( 'Direction', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'up'    => __( 'Counter Clockwise', 'premium-addons-pro' ),
					'down'  => __( 'Clockwise', 'premium-addons-pro' ),
				],
                'default'       => 'down',
				'condition'     => array_merge( $conditions, [
					'premium_img_layers_rscroll'     => 'yes'
				] ) ,
			]
		);
        
        $repeater->add_control('premium_img_layers_rscroll_speed',
			[
				'label'         => __( 'Speed', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SLIDER,
				'default' => [
                    'size' => 3,
                ],
                'range' => [
                    'px' => [
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
				'condition'     => array_merge( $conditions, [
					'premium_img_layers_rscroll'     => 'yes'
				] ) ,
			]
		);
        
        $repeater->add_control('premium_img_layers_rscroll_view',
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
                'condition'     => array_merge( $conditions, [
					'premium_img_layers_rscroll'     => 'yes'
				] ) ,
			]
		);
        
        $repeater->add_control('premium_img_layers_scale',
            [
                'label'         => __('Scale', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'condition'     => $conditions
            ]
        );
        
        $repeater->add_control('premium_img_layers_scale_direction',
			[
				'label'         => __( 'Scale', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'up'    => __( 'Shrink', 'premium-addons-pro' ),
					'down'  => __( 'Scale', 'premium-addons-pro' ),
				],
                'default'       => 'down',
				'condition'     => array_merge( $conditions, [
					'premium_img_layers_scale'     => 'yes'
				] ) ,
			]
		);
        
        $repeater->add_control('premium_img_layers_scale_speed',
			[
				'label'         => __( 'Speed', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SLIDER,
				'default' => [
                    'size' => 3,
                ],
                'range' => [
                    'px' => [
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
				'condition'     => array_merge( $conditions, [
					'premium_img_layers_scale'     => 'yes'
				] ) ,
			]
		);
        
        $repeater->add_control('premium_img_layers_scale_view',
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
                'condition'     => array_merge( $conditions, [
					'premium_img_layers_scale'     => 'yes'
				] ) ,
			]
		);
        
        $repeater->add_control('premium_img_layers_gray',
            [
                'label'         => __('Gray Scale', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'condition'     => $conditions
            ]
        );
        
        $repeater->add_control('premium_img_layers_gray_effect',
			[
				'label'         => __( 'Effect', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => [
					'up'    => __( 'Increase', 'premium-addons-pro' ),
					'down'  => __( 'Decrease', 'premium-addons-pro' ),
				],
                'default'       => 'down',
				'condition'     => array_merge( $conditions, [
					'premium_img_layers_gray'     => 'yes'
				] ) ,
			]
		);
        
        $repeater->add_control('premium_img_layers_gray_level',
			[
				'label'         => __( 'Speed', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SLIDER,
				'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
				'condition'     => array_merge( $conditions, [
					'premium_img_layers_gray'     => 'yes'
				] ) ,
			]
		);
        
        $repeater->add_control('premium_img_layers_gray_view',
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
                'condition'     => array_merge( $conditions, [
					'premium_img_layers_gray'     => 'yes'
				] ) ,
			]
		);
        
        $repeater->add_responsive_control('premium_img_layerstransform_origin_x',
            [
                'label' => __( 'X Anchor Point', 'premium-addons-pro' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'premium-addons-pro' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'premium-addons-pro' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'premium-addons-pro' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'conditions'    => [
                    'terms' => [
                        [
                            'name' => 'premium_img_layers_scroll_effects',
                            'value' => 'yes',
                        ],
                        [
                            'relation'      =>  'or',
                            'terms'         => [
                                [
                                    'name'  =>  'premium_img_layers_rscroll',
                                    'value'  => 'yes'
                                ],
                                [
                                    'name'  =>  'premium_img_layers_scale',
                                    'value'  => 'yes'
                                ]
                            ],
                        ]
                    ]
                ],
                'label_block' => false,
                'toggle' => false,
                'render_type' => 'ui',
            ]
        );

		$repeater->add_responsive_control('premium_img_layerstransform_origin_y',
            [
                'label' => __( 'Y Anchor Point', 'premium-addons-pro' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'top' => [
                        'title' => __( 'Top', 'premium-addons-pro' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'premium-addons-pro' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __( 'Bottom', 'premium-addons-pro' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'conditions'    => [
                    'terms' => [
                        [
                            'name' => 'premium_img_layers_scroll_effects',
                            'value' => 'yes',
                        ],
                        [
                            'relation'      =>  'or',
                            'terms'         => [
                                [
                                    'name'  =>  'premium_img_layers_rscroll',
                                    'value'  => 'yes'
                                ],
                                [
                                    'name'  =>  'premium_img_layers_scale',
                                    'value'  => 'yes'
                                ]
                            ],
                        ]
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.premium-img-layers-list-item' => 'transform-origin: {{premium_img_layerstransform_origin_x.VALUE}} {{VALUE}}',
                ],
                'label_block' => false,
                'toggle' => false
            ]
		);
        
        $repeater->add_control('premium_img_layers_zindex',
            [
                'label'         => __('z-index','premium-addons-pro'),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 1,
                'selectors'     => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.premium-img-layers-list-item' => 'z-index: {{VALUE}};'
                    ],
                ]
            );
        
        $repeater->add_control('premium_img_layers_class', 
            [
                'label'         => __('CSS Classes','premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
                'description'   => __('Separate class with spaces','premium-addons-pro'),
            ]
        );
        
        $this->add_control('premium_img_layers_images_repeater',
			[
				'type'          => Controls_Manager::REPEATER,
				'fields'        => array_values( $repeater->get_controls() ),
                'title_field'   => '{{{ premium_img_layers_alt }}}',
			]
		);
        
        $this->add_control('premium_parallax_layers_devices',
            [
                'label'             => __('Apply Scroll Effects On', 'premium-addons-pro'),
                'type'              => Controls_Manager::SELECT2,
                'options'           => [
                    'desktop'   => __('Desktop','premium-addons-pro'),
                    'tablet'    => __('Tablet','premium-addons-pro'),
                    'mobile'    => __('Mobile','premium-addons-pro'),
                ],
                'default'           => [ 'desktop', 'tablet', 'mobile' ],
                'multiple'          => true,
                'label_block'       => true
            ]);
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_img_layers_container',
            [
                'label'         => __('Container', 'premium-addons-pro'),
            ]
        );
        
        $this->add_responsive_control('premium_img_layers_height',
            [
                'label'         => __('Minimum Height','premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', "em", "vh"],
                'range'         => [
                    'px'    => [
                        'min'   => 1, 
                        'max'   => 800,
                    ],
                    'em'    => [
                        'min'   => 1, 
                        'max'   => 80,
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-img-layers-wrapper' => 'min-height: {{SIZE}}{{UNIT}}'
                ],
            ]
        );
        
        $this->add_responsive_control('premium_img_layers_overflow',
            [
                'label'         => __('Overflow', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'auto'          => __('Auto','premium-addons-pro'),
                    'visible'       => __('Visible','premium-addons-pro'),
                    'hidden'        => __('Hidden','premium-addons-pro'),
                    'scroll'        => __('Scroll','premium-addons-pro'),
                ],
                'default'       => 'visible',
                'selectors'     => [
                    '{{WRAPPER}} .premium-img-layers-wrapper'   => 'overflow: {{VALUE}}'
                ]
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_img_layers_images_style',
            [
                'label'         => __('Image', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
            );
        
        $this->add_control('premium_img_layers_images_background',
            [
                'label'         => __('Background Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .premium-img-layers-list-item .premium-img-layers-image'  => 'background-color: {{VALUE}};',
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'premium_img_layers_images_border',
                'selector'      => '{{WRAPPER}} .premium-img-layers-list-item .premium-img-layers-image'
            ]
        );
        
        $this->add_responsive_control('premium_img_layers_images_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-img-layers-list-item .premium-img-layers-image' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'premium_img_layers_images_shadow',
                'selector'      => '{{WRAPPER}} .premium-img-layers-list-item .premium-img-layers-image'
            ]
        );
        
        $this->add_responsive_control('premium_img_layers_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-img-layers-list-item .premium-img-layers-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_responsive_control('premium_img_layers_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-img-layers-list-item .premium-img-layers-image' => 'padding:  {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_img_layers_container_style',
            [
                'label'         => __('Container', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control('premium_img_layers_container_background',
            [
                'label'         => __('Background Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .premium-img-layers-wrapper'  => 'background-color: {{VALUE}};',
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'premium_img_layers_container_border',
                'selector'      => '{{WRAPPER}} .premium-img-layers-wrapper'
            ]
        );
        
        $this->add_responsive_control('premium_img_layers_container_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-img-layers-wrapper' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'premium_img_layers_container_shadow',
                'selector'      => '{{WRAPPER}} .premium-img-layers-wrapper'
            ]
        );
        
        $this->add_responsive_control('premium_img_layers_container_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-img-layers-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_responsive_control('premium_img_layers_container_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-img-layers-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->end_controls_section();
        
    }
    
    protected function render(){

        $settings = $this->get_settings_for_display();
        
        $this->add_render_attribute( 'container', [
            'id'        => 'premium-img-layers-wrapper',
            'class'     => 'premium-img-layers-wrapper',
        ]);
        
        $scroll_effects = isset( $settings['premium_parallax_layers_devices'] ) ? $settings['premium_parallax_layers_devices'] : array();
        
        $this->add_render_attribute( 'container', 'data-devices', wp_json_encode( $scroll_effects ) );
        
        
    ?>

    <div <?php echo $this->get_render_attribute_string('container'); ?>>
        <ul class="premium-img-layers-list-wrapper">
            <?php $animation_arr = array();
            foreach( $settings['premium_img_layers_images_repeater'] as $index => $image ) :
                array_push( $animation_arr, $image['premium_img_layers_animation_switcher'] );
                if( 'yes' == $animation_arr[ $index ] ) {
                    $animation_class = $image['premium_img_layers_animation'];
                    if( '' != $image['premium_img_layers_animation_duration'] ) {
                        $animation_dur = 'animated-' . $image['premium_img_layers_animation_duration'];
                    } else {
                        $animation_dur = 'animated-';
                    }
                } else {
                        $animation_class = '';
                        $animation_dur = '';
                }

                $list_item_key = 'img_layer_' . $index;

                $position = ! empty ( $image['premium_img_layers_position'] ) ? $image['premium_img_layers_position'] : 'absolute';

                $this->add_render_attribute( $list_item_key, 'class',
                    [
                        'premium-img-layers-list-item',
                        $position,
                        esc_attr($image['premium_img_layers_class']),
                        'elementor-repeater-item-' . $image['_id']
                    ]
                );

                $this->add_render_attribute( $list_item_key, 'data-layer-animation',
                    [
                        $animation_class,
                        $animation_dur,
                    ]
                );

                if( 'yes' == $image['premium_img_layers_scroll_effects'] ) {

                    $this->add_render_attribute( $list_item_key, 'data-scrolls', 'true' );

                    if( 'yes' == $image['premium_img_layers_vscroll'] ) {

                        $speed = ! empty ( $image['premium_img_layers_vscroll_speed']['size'] ) ? $image['premium_img_layers_vscroll_speed']['size'] : 4;

                        $this->add_render_attribute( $list_item_key, 'data-vscroll', 'true' );

                        $this->add_render_attribute( $list_item_key, 'data-vscroll-speed', $speed );

                        $this->add_render_attribute( $list_item_key, 'data-vscroll-dir', $image['premium_img_layers_vscroll_direction'] );

                        $this->add_render_attribute( $list_item_key, 'data-vscroll-start', $image['premium_img_layers_vscroll_view']['sizes']['start'] );
                        $this->add_render_attribute( $list_item_key, 'data-vscroll-end', $image['premium_img_layers_vscroll_view']['sizes']['end'] );

                    }

                    if( 'yes' == $image['premium_img_layers_hscroll'] ) {

                        $speed = ! empty ( $image['premium_img_layers_hscroll_speed']['size'] ) ? $image['premium_img_layers_hscroll_speed']['size'] : 4;

                        $this->add_render_attribute( $list_item_key, 'data-hscroll', 'true' );

                        $this->add_render_attribute( $list_item_key, 'data-hscroll-speed', $speed );

                        $this->add_render_attribute( $list_item_key, 'data-hscroll-dir', $image['premium_img_layers_hscroll_direction'] );

                        $this->add_render_attribute( $list_item_key, 'data-hscroll-start', $image['premium_img_layers_hscroll_view']['sizes']['start'] );
                        $this->add_render_attribute( $list_item_key, 'data-hscroll-end', $image['premium_img_layers_hscroll_view']['sizes']['end'] );

                    }

                    if( 'yes' == $image['premium_img_layers_opacity'] ) {

                        $level = ! empty ( $image['premium_img_layers_opacity_level']['size'] ) ? $image['premium_img_layers_opacity_level']['size'] : 10;

                        $this->add_render_attribute( $list_item_key, 'data-oscroll', 'true' );

                        $this->add_render_attribute( $list_item_key, 'data-oscroll-level', $level );

                        $this->add_render_attribute( $list_item_key, 'data-oscroll-effect', $image['premium_img_layers_opacity_effect'] );

                        $this->add_render_attribute( $list_item_key, 'data-oscroll-start', $image['premium_img_layers_opacity_view']['sizes']['start'] );
                        $this->add_render_attribute( $list_item_key, 'data-oscroll-end', $image['premium_img_layers_opacity_view']['sizes']['end'] );

                    }

                    if( 'yes' == $image['premium_img_layers_blur'] ) {

                        $level = ! empty ( $image['premium_img_layers_blur_level']['size'] ) ? $image['premium_img_layers_blur_level']['size'] : 10;

                        $this->add_render_attribute( $list_item_key, 'data-bscroll', 'true' );

                        $this->add_render_attribute( $list_item_key, 'data-bscroll-level', $level );

                        $this->add_render_attribute( $list_item_key, 'data-bscroll-effect', $image['premium_img_layers_blur_effect'] );

                        $this->add_render_attribute( $list_item_key, 'data-bscroll-start', $image['premium_img_layers_blur_view']['sizes']['start'] );
                        $this->add_render_attribute( $list_item_key, 'data-bscroll-end', $image['premium_img_layers_blur_view']['sizes']['end'] );

                    }

                    if( 'yes' == $image['premium_img_layers_rscroll'] ) {

                        $speed = ! empty ( $image['premium_img_layers_rscroll_speed']['size'] ) ? $image['premium_img_layers_rscroll_speed']['size'] : 3;

                        $this->add_render_attribute( $list_item_key, 'data-rscroll', 'true' );

                        $this->add_render_attribute( $list_item_key, 'data-rscroll-speed', $speed );

                        $this->add_render_attribute( $list_item_key, 'data-rscroll-dir', $image['premium_img_layers_rscroll_direction'] );

                        $this->add_render_attribute( $list_item_key, 'data-rscroll-start', $image['premium_img_layers_rscroll_view']['sizes']['start'] );
                        $this->add_render_attribute( $list_item_key, 'data-rscroll-end', $image['premium_img_layers_rscroll_view']['sizes']['end'] );

                    }

                    if( 'yes' == $image['premium_img_layers_scale'] ) {

                        $speed = ! empty ( $image['premium_img_layers_scale_speed']['size'] ) ? $image['premium_img_layers_scale_speed']['size'] : 3;

                        $this->add_render_attribute( $list_item_key, 'data-scale', 'true' );

                        $this->add_render_attribute( $list_item_key, 'data-scale-speed', $speed );

                        $this->add_render_attribute( $list_item_key, 'data-scale-dir', $image['premium_img_layers_scale_direction'] );

                        $this->add_render_attribute( $list_item_key, 'data-scale-start', $image['premium_img_layers_scale_view']['sizes']['start'] );
                        $this->add_render_attribute( $list_item_key, 'data-scale-end', $image['premium_img_layers_scale_view']['sizes']['end'] );

                    }

                    if( 'yes' == $image['premium_img_layers_gray'] ) {

                        $level = ! empty ( $image['premium_img_layers_gray_level']['size'] ) ? $image['premium_img_layers_gray_level']['size'] : 10;

                        $this->add_render_attribute( $list_item_key, 'data-gscale', 'true' );

                        $this->add_render_attribute( $list_item_key, 'data-gscale-level', $level );

                        $this->add_render_attribute( $list_item_key, 'data-gscale-effect', $image['premium_img_layers_gray_effect'] );

                        $this->add_render_attribute( $list_item_key, 'data-gscale-start', $image['premium_img_layers_gray_view']['sizes']['start'] );
                        $this->add_render_attribute( $list_item_key, 'data-gscale-end', $image['premium_img_layers_gray_view']['sizes']['end'] );

                    }

                }

                if( 'yes' == $image['premium_img_layers_mouse'] ) {

                    $this->add_render_attribute( $list_item_key, 'data-' . $image['premium_img_layers_mouse_type'], 'true' );

                    $this->add_render_attribute( $list_item_key, 'data-rate', ! empty( $image['premium_img_layers_rate'] ) ? $image['premium_img_layers_rate'] : -10  );

                }

                if( 'url' == $image['premium_img_layers_link_selection'] ){
                    $image_url = $image['premium_img_layers_link']['url'];
                } else {
                    $image_url = get_permalink($image['premium_img_layers_existing_link']);
                }

                $list_item_link = 'img_link_' . $index;
                if( 'yes' == $image['premium_img_layers_link_switcher'] ) {
                    $this->add_render_attribute( $list_item_link, 'class', 'premium-img-layers-link' );

                    $this->add_render_attribute( $list_item_link, 'href', $image_url );

                    if( ! empty( $image['premium_img_layers_link']['is_external'] ) ) {
                        $this->add_render_attribute( $list_item_link, 'target', '_blank' );
                    }
                    if( ! empty( $image['premium_img_layers_link']['nofollow'] ) ) {
                        $this->add_render_attribute( $list_item_link, 'rel', 'nofollow' );
                    }
                }

            ?>

            <li <?php echo $this->get_render_attribute_string( $list_item_key ); ?>>
                    <?php
                        $image_src = $image['premium_img_layers_image'];

                        $image_src_size = Group_Control_Image_Size::get_attachment_image_src( $image_src['id'], 'thumbnail', $image );

                        if( empty( $image_src_size ) ) : $image_src_size = $image_src['url']; else: $image_src_size = $image_src_size; endif;
                    ?>

                        <img src="<?php echo $image_src_size; ?>" class="premium-img-layers-image" alt="<?php echo esc_attr($image['premium_img_layers_alt']); ?>">
                        <?php if( $image['premium_img_layers_link_switcher'] == 'yes' ) : ?>
                            <a <?php echo $this->get_render_attribute_string ( $list_item_link ); ?>></a>
                        <?php endif; ?>

                </li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php }

    protected function _content_template() {
        
        ?>

        <#
        
            view.addRenderAttribute( 'container', 'id', 'premium-img-layers-wrapper' );
            view.addRenderAttribute( 'container', 'class', 'premium-img-layers-wrapper' );
        
            view.addRenderAttribute( 'container', 'data-devices', JSON.stringify( settings.premium_parallax_layers_devices ) );

        
        #>

        <div {{{ view.getRenderAttributeString('container') }}}>
            <ul class="premium-img-layers-list-wrapper">
                
            <# var animationClass, animationDur, listItemKey, imageUrl, animationArr = [];
            
            _.each( settings.premium_img_layers_images_repeater, function( image, index ) {
            
                animationArr.push( image.premium_img_layers_animation_switcher );
                
                if( 'yes' == animationArr[index] ) {

                    animationClass = image.premium_img_layers_animation;

                    if( '' != image.premium_img_layers_animation_duration ) {

                        animationDur = 'animated-' + image.premium_img_layers_animation_duration;

                    } else {
                        animationDur = 'animated-';
                    }
                } else {

                        animationClass = '';

                        animationDur = '';

                }
                
                listItemKey = 'img_layer_' + index;

                var position = '' !== image.premium_img_layers_position ? image.premium_img_layers_position : 'absolute';
                
                view.addRenderAttribute( listItemKey, 'class',
                    [
                        'premium-img-layers-list-item',
                        position,
                        image.premium_img_layers_class,
                        'elementor-repeater-item-' + image._id
                    ]
                );

                view.addRenderAttribute( listItemKey, 'data-layer-animation',
                    [
                        animationClass,
                        animationDur,
                    ]
                );
                
                if( 'yes' == image.premium_img_layers_mouse ) {
                
                    var rate = '' != image.premium_img_layers_rate ? image.premium_img_layers_rate : -10;
                    
                    view.addRenderAttribute( listItemKey, 'data-' + image.premium_img_layers_mouse_type , 'true' );
                    
                    view.addRenderAttribute( listItemKey, 'data-rate', rate );
                
                }
                
                if( 'yes' == image.premium_img_layers_scroll_effects ) {
                
                    view.addRenderAttribute( listItemKey, 'data-scrolls', 'true' );
                
                    if( 'yes' == image.premium_img_layers_vscroll ) {

                        var speed = '' !== image.premium_img_layers_vscroll_speed.size ? image.premium_img_layers_vscroll_speed.size : 4;

                        view.addRenderAttribute( listItemKey, 'data-vscroll', 'true' );

                        view.addRenderAttribute( listItemKey, 'data-vscroll-speed', speed );

                        view.addRenderAttribute( listItemKey, 'data-vscroll-dir', image.premium_img_layers_vscroll_direction );

                        view.addRenderAttribute( listItemKey, 'data-vscroll-start', image.premium_img_layers_vscroll_view.sizes.start );

                        view.addRenderAttribute( listItemKey, 'data-vscroll-end', image.premium_img_layers_vscroll_view.sizes.end );

                    }

                    if( 'yes' == image.premium_img_layers_hscroll ) {

                        var speed = '' !== image.premium_img_layers_hscroll_speed.size ? image.premium_img_layers_hscroll_speed.size : 4;

                        view.addRenderAttribute( listItemKey, 'data-hscroll', 'true' );

                        view.addRenderAttribute( listItemKey, 'data-hscroll-speed', speed );

                        view.addRenderAttribute( listItemKey, 'data-hscroll-dir', image.premium_img_layers_hscroll_direction );

                        view.addRenderAttribute( listItemKey, 'data-hscroll-start', image.premium_img_layers_hscroll_view.sizes.start );

                        view.addRenderAttribute( listItemKey, 'data-hscroll-end', image.premium_img_layers_hscroll_view.sizes.end );

                    }

                    if( 'yes' == image.premium_img_layers_opacity ) {

                        var level = '' !== image.premium_img_layers_opacity_level.size ? image.premium_img_layers_opacity_level.size : 4;

                        view.addRenderAttribute( listItemKey, 'data-oscroll', 'true' );

                        view.addRenderAttribute( listItemKey, 'data-oscroll-level', level );

                        view.addRenderAttribute( listItemKey, 'data-oscroll-effect', image.premium_img_layers_opacity_effect );

                        view.addRenderAttribute( listItemKey, 'data-oscroll-start', image.premium_img_layers_opacity_view.sizes.start );

                        view.addRenderAttribute( listItemKey, 'data-oscroll-end', image.premium_img_layers_opacity_view.sizes.end );

                    }
                    
                    if( 'yes' == image.premium_img_layers_blur ) {

                        var level = '' !== image.premium_img_layers_blur_level.size ? image.premium_img_layers_blur_level.size : 4;

                        view.addRenderAttribute( listItemKey, 'data-bscroll', 'true' );

                        view.addRenderAttribute( listItemKey, 'data-bscroll-level', level );

                        view.addRenderAttribute( listItemKey, 'data-bscroll-effect', image.premium_img_layers_blur_effect );

                        view.addRenderAttribute( listItemKey, 'data-bscroll-start', image.premium_img_layers_blur_view.sizes.start );

                        view.addRenderAttribute( listItemKey, 'data-bscroll-end', image.premium_img_layers_blur_view.sizes.end );

                    }
                    
                    if( 'yes' == image.premium_img_layers_rscroll ) {

                        var speed = '' !== image.premium_img_layers_rscroll_speed.size ? image.premium_img_layers_rscroll_speed.size : 3;

                        view.addRenderAttribute( listItemKey, 'data-rscroll', 'true' );

                        view.addRenderAttribute( listItemKey, 'data-rscroll-speed', speed );

                        view.addRenderAttribute( listItemKey, 'data-rscroll-dir', image.premium_img_layers_rscroll_direction );

                        view.addRenderAttribute( listItemKey, 'data-rscroll-start', image.premium_img_layers_rscroll_view.sizes.start );

                        view.addRenderAttribute( listItemKey, 'data-rscroll-end', image.premium_img_layers_rscroll_view.sizes.end );

                    }
                    
                    if( 'yes' == image.premium_img_layers_scale ) {

                        var speed = '' !== image.premium_img_layers_scale_speed.size ? image.premium_img_layers_scale_speed.size : 3;

                        view.addRenderAttribute( listItemKey, 'data-scale', 'true' );

                        view.addRenderAttribute( listItemKey, 'data-scale-speed', speed );

                        view.addRenderAttribute( listItemKey, 'data-scale-dir', image.premium_img_layers_scale_direction );

                        view.addRenderAttribute( listItemKey, 'data-scale-start', image.premium_img_layers_scale_view.sizes.start );

                        view.addRenderAttribute( listItemKey, 'data-scale-end', image.premium_img_layers_scale_view.sizes.end );

                    }
                    
                    if( 'yes' == image.premium_img_layers_gray ) {

                        var level = '' !== image.premium_img_layers_gray_level.size ? image.premium_img_layers_gray_level.size : 10;

                        view.addRenderAttribute( listItemKey, 'data-gscale', 'true' );

                        view.addRenderAttribute( listItemKey, 'data-gscale-level', level );

                        view.addRenderAttribute( listItemKey, 'data-gscale-effect', image.premium_img_layers_gray_effect );

                        view.addRenderAttribute( listItemKey, 'data-gscale-start', image.premium_img_layers_gray_view.sizes.start );

                        view.addRenderAttribute( listItemKey, 'data-gscale-end', image.premium_img_layers_gray_view.sizes.end );

                    }
                
                }
                
                if( 'url' == image.premium_img_layers_link_selection ) {

                    imageUrl = image.premium_img_layers_link.url;

                } else {

                    imageUrl = image.premium_img_layers_existing_link;

                } 
                
                var imageObj = {
                    id: image.premium_img_layers_image.id,
                    url: image.premium_img_layers_image.url,
                    size: image.thumbnail_size,
                    dimension: image.thumbnail_custom_dimension,
                    model: view.getEditModel()
                },
                
                image_url = elementor.imagesManager.getImageUrl( imageObj );
                
                #>
                
                <li {{{ view.getRenderAttributeString(listItemKey) }}}>
                    <img src="{{ image_url }}" class="premium-img-layers-image" alt="{{ image.premium_img_layers_alt }}">
                    <# if( 'yes' == image.premium_img_layers_link_switcher ) { #>
                        <a class="premium-img-layers-link" href="{{ imageUrl }}"></a>
                    <# } #>
                </li>
                
            <# } );
                
            #>
                
            </ul>
        </div>

        <?php
    }

}