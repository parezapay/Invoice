<?php

namespace PremiumAddonsPro\Widgets;

use PremiumAddons\Helper_Functions;
use PremiumAddons\Includes;
use Elementor\Widget_Base;
use Elementor\Frontend;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Premium_Prev_Img extends Widget_Base {
    
    public function getTemplateInstance() {
		return $this->templateInstance = Includes\premium_Template_Tags::getInstance();
	}
   
    public function get_name() {
        return 'premium-addon-preview-image';
    }

    public function get_title() {
		return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Preview Window', 'premium-addons-pro') );
	}

    public function get_icon() {
        return 'pa-pro-preview-window';
    }
    
     public function is_reload_preview_required() {
        return true;
    }
    
    public function get_style_depends() {
        return [
            'tooltipster',
            'tooltipster-themes'
        ];
    }

    public function get_script_depends() {
        return [
            'tooltipster-bundle-js',
            'premium-pro-js'
        ];
    }
    
    public function get_categories() {
        return [ 'premium-elements' ];
    }

    // Adding the controls fields for the Preview Image
    // This will controls the animation, colors and background, dimensions etc
    protected function _register_controls() {

        /* Start Image Preview Content Section */
        $this->start_controls_section('premium_preview_image',
            [
                'label'         => __('Trigger Image', 'premium-addons-pro'),
                ]
            );
        
        $this->add_control('premium_preview_image_main',
            [
                'label' => __( 'Choose Image', 'premium-addons-pro' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic'       => [ 'active' => true ],
                'default'       => [
                    'url'	=> PREMIUM_PRO_ADDONS_URL. 'assets/images/placeholder.png',
                    ],
                ]
            );
        
	$this->add_group_control(
		Group_Control_Image_Size::get_type(),
            [
                'name' => 'premium_preview_image_main_size', 
                'default' => 'full',
                ]
            );
    
        $this->add_control('premium_preview_image_alt', 
            [
                'label'     => __('Alt','premium-addons-pro'),
                'type'      => Controls_Manager::TEXT,
                'dynamic'   => [ 'active' => true ],
                'default'	=>__('Premium Preview Window', 'premium-addons-pro'),
                ]
            );
        
        $this->add_control('premium_preview_image_caption', 
            [
                'label'     => __('Caption','premium-addons-pro'),
                'type'      => Controls_Manager::TEXT,
                'dynamic'   => [ 'active' => true ],
                'default'	=>__('Premium Preview Window', 'premium-addons-pro')
                ]
            );
    
        $this->add_control('premium_preview_image_link_switcher',
                [
                    'label'         => __('Link', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SWITCHER,
                ]
                );
        
        $this->add_control('premium_preview_image_link_selection', 
            [
                'label'         => __('Link Type', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'url'   => __('URL', 'premium-addons-pro'),
                    'link'  => __('Existing Page', 'premium-addons-pro'),
                ],
                'default'       => 'url',
                'label_block'   => true,
                'condition'     => [
                    'premium_preview_image_link_switcher'    => 'yes'
                ]
            ]
        );
        
        $this->add_control('premium_preview_image_link',
            [
                'label'         => __('Link', 'premium-addons-pro'),
                'type'          => Controls_Manager::URL,
                'dynamic'       => [ 'active' => true ],
                'default'       => [
                    'url'   => '#',
                ],
                'placeholder'   => 'https://premiumaddons.com/',
                'label_block'   => true,
                'condition'     => [
                    'premium_preview_image_link_selection' => 'url',
                    'premium_preview_image_link_switcher'    => 'yes'
                ]
            ]
            );
        
        $this->add_control('premium_preview_image_existing_link',
            [
                'label'         => __('Existing Page', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT2,
                'options'       => $this->getTemplateInstance()->get_all_post(),
                'condition'     => [
                    'premium_preview_image_link_selection'     => 'link',
                    'premium_preview_image_link_switcher'    => 'yes'
                ],
                'multiple'      => false,
                'label_block'   => true,
                ]
            );
        
        $this->add_control('premium_preview_image_align',
                [
                    'label'         => __('Alignment','premium-addons-pro'),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'       => [
                        'left'      => [
                               'title'=> __( 'Left', 'premium-addons-pro' ),
                               'icon' => 'fa fa-align-left',   
                                ],
                       'center'     => [
                               'title'=> __( 'Center', 'premium-addons-pro' ),
                               'icon' => 'fa fa-align-center',
                                ],
                       'right'     => [
                               'title'=> __( 'Right', 'premium-addons-pro' ),
                               'icon' => 'fa fa-align-right',
                               ],
                       ],
                    'default'       => 'center',
                    'selectors'     => [
                       '{{WRAPPER}} .premium-preview-image-trig-img-wrap' => 'text-align: {{VALUE}};',
                        ],
                    ]
                );
         
        $this->end_controls_section();
        
        $this->start_controls_section('premium_preview_image_magnifier',
                [
                    'label'             => __('Preview Window', 'premium-addons-pro'),
                    ]
                );
        
        $this->add_control('premium_preview_image_content_selection', 
            [
                'label'         => __('Content Type', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'custom'        => __('Custom Content', 'premium-addons-pro'),
                    'template'      => __('Elementor Template', 'premium-addons-pro'),
                ],
                'default'       => 'custom',
                'label_block'   => true,
            ]
        );
        
        $this->add_control('premium_preview_image_img_switcher',
            [
                'label'         => __('Image', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'condition' => [
                    'premium_preview_image_content_selection'   => 'custom'
                ]
            ]
            );
        
        $this->add_control('premium_preview_image_tooltips_image',
		[
            'label' => __( 'Choose Image', 'premium-addons-pro' ),
            'type' => Controls_Manager::MEDIA,
            'dynamic'       => [ 'active' => true ],
            'default'       => [
                'url'	=> PREMIUM_PRO_ADDONS_URL. 'assets/images/placeholder.png',
                ],
            'condition' => [
                'premium_preview_image_content_selection'   => 'custom',
                'premium_preview_image_img_switcher'        => 'yes'
                ]
            ]
            );
        
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'premium_preview_image_tooltips_image_size', 
                'default' => 'full',
                'condition' => [
                    'premium_preview_image_content_selection'   => 'custom',
                    'premium_preview_image_img_switcher'        => 'yes'
                ]
            ]
            );
        
        $this->add_control('premium_preview_image_tooltips_image_alt', 
            [
                'label'     => __('Alt','premium-addons-pro'),
                'type'      => Controls_Manager::TEXT,
                'dynamic'   => [ 'active' => true ],
                'default'	=> __('Premium Preview Window', 'premium-addons-pro'),
                'condition' => [
                    'premium_preview_image_content_selection'   => 'custom',
                    'premium_preview_image_img_switcher'        => 'yes'
                    ]
                ]
            );
        
        $this->add_responsive_control('premium_preview_image_tooltip_img_align',
                [
                    'label'         => __('Alignment','premium-addons-pro'),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'       => [
                        'left'      => [
                               'title'=> __( 'Left', 'premium-addons-pro' ),
                               'icon' => 'fa fa-align-left',   
                                ],
                       'center'     => [
                               'title'=> __( 'Center', 'premium-addons-pro' ),
                               'icon' => 'fa fa-align-center',
                                ],
                       'right'     => [
                               'title'=> __( 'Right', 'premium-addons-pro' ),
                               'icon' => 'fa fa-align-right',
                               ],
                       ],
                    'default'       => 'center',
                    'selectors'     => [
                       '.premium-prev-img-tooltip-img-wrap-{{ID}}' => 'text-align: {{VALUE}};',
                    ],
                    'condition' => [
                        'premium_preview_image_content_selection'   => 'custom',
                        'premium_preview_image_img_switcher'        => 'yes'
                        ]
                    ]
                );
        
        $this->add_control('premium_preview_image_title_switcher',
            [
                'label'         => __('Title', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'condition' => [
                    'premium_preview_image_content_selection'   => 'custom'
                ]
            ]
            );
        
        $this->add_control('premium_preview_image_title', 
                [
                    'label'     => __('Title','premium-addons-pro'),
                    'type'      => Controls_Manager::TEXT,
                    'default'	=>'Premium Preview Image',
                    'condition' => [
                        'premium_preview_image_title_switcher'      => 'yes',
                        'premium_preview_image_content_selection'   => 'custom'
                        ]
                    ]
                );
        
        $this->add_control('premium_image_preview_title_heading', 
                [
                    'label'     => __('HTML Tag','premium-addons-pro'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   =>'h3',
                    'options'   =>[
                        'h1'    => 'H1',
                        'h2'    => 'H2',
                        'h3'    => 'H3',
                        'h4'    => 'H4',
                        'h5'    => 'H5',
                        'h6'    => 'H6'
                        ],
                    'condition' => [
                        'premium_preview_image_title_switcher'      => 'yes',
                        'premium_preview_image_content_selection'   => 'custom'
                        ]
                    ]
                );
        
        $this->add_responsive_control('premium_preview_image_tooltip_title_align',
                [
                    'label'         => __('Alignment','premium-addons-pro'),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'       => [
                        'left'      => [
                               'title'=> __( 'Left', 'premium-addons-pro' ),
                               'icon' => 'fa fa-align-left',   
                                ],
                       'center'     => [
                               'title'=> __( 'Center', 'premium-addons-pro' ),
                               'icon' => 'fa fa-align-center',
                                ],
                       'right'     => [
                               'title'=> __( 'Right', 'premium-addons-pro' ),
                               'icon' => 'fa fa-align-right',
                               ],
                       ],
                    'default'       => 'center',
                    'selectors'     => [
                       '.premium-prev-img-tooltip-title-wrap-{{ID}}' => 'text-align: {{VALUE}};',
                    ],
                    'condition' => [
                        'premium_preview_image_content_selection'   => 'custom',
                        'premium_preview_image_title_switcher'        => 'yes'
                        ]
                    ]
                );
                
        $this->add_control('premium_preview_image_desc_switcher',
            [
                'label'         => __('Description', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'condition'     => [
                    'premium_preview_image_content_selection'   => 'custom'
                ]
            ]
            );
        
        $this->add_control('premium_preview_image_desc',
		[
                'label' => __( 'Content', 'premium-addons-pro' ),
                'type' => Controls_Manager::WYSIWYG,
                'dynamic'   => [ 'active' => true ],
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                'condition' => [
                    'premium_preview_image_desc_switcher'      => 'yes',
                    'premium_preview_image_content_selection'   => 'custom'
                ]
            ]
        );
        
        $this->add_responsive_control('premium_preview_image_tooltip_desc_align',
                [
                    'label'         => __('Alignment','premium-addons-pro'),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'       => [
                        'left'      => [
                               'title'=> __( 'Left', 'premium-addons-pro' ),
                               'icon' => 'fa fa-align-left',   
                                ],
                       'center'     => [
                               'title'=> __( 'Center', 'premium-addons-pro' ),
                               'icon' => 'fa fa-align-center',
                                ],
                       'right'     => [
                               'title'=> __( 'Right', 'premium-addons-pro' ),
                               'icon' => 'fa fa-align-right',
                               ],
                       ],
                    'default'       => 'center',
                    'selectors'     => [
                       '.premium-prev-img-tooltip-desc-wrap-{{ID}}' => 'text-align: {{VALUE}};',
                    ],
                    'condition' => [
                        'premium_preview_image_content_selection'   => 'custom',
                        'premium_preview_image_desc_switcher'        => 'yes'
                        ]
                    ]
                );
        
        $this->add_control('premium_preview_image_content_temp',
                [
                    'label'			=> __( 'Choose Template', 'premium-addons-pro' ),
                    'description'	=> __( 'Template content is a template which you can choose from Elementor library', 'premium-addons-pro' ),
                    'type' => Controls_Manager::SELECT2,
                    'options' => $this->getTemplateInstance()->get_elementor_page_list(),
                    'condition' => [
                        'premium_preview_image_content_selection'   => 'template'
                    ]
                ]
            );
    
        $this->end_controls_section();
        
        $this->start_controls_section('premium_preview_image_advanced',
                [
                    'label'             => __('Advanced Settings', 'premium-addons-pro'),
                    ]
                );
        
        $this->add_control('premium_preview_image_interactive',
                [
                    'label'         => __('Interactive', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SWITCHER,
                    'description'   => __('Give users the possibility to interact with the content of the tooltip', 'premium-addons-pro'),
                ]
                );
        
        $this->add_control('premium_preview_image_responsive',
                [
                    'label'         => __('Responsive', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SWITCHER,
                    'description'   => __('Resize tooltip image to fit screen', 'premium-addons-pro'),
                ]
                );
        
        $this->add_control('premium_preview_image_theme', 
            [
                'label'         => __('Tooltip Theme', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'description'   => __('Kindly, be noted that this will override styling for the container', 'premium-addons-pro'),
                'options'       => [
                    'tooltipster-default'   => __('Custom', 'premium-addons-pro'),
                    'tooltipster-light'     => __('Light', 'premium-addons-pro'),
                    'tooltipster-borderless'=> __('Borderless', 'premium-addons-pro'),
                    'tooltipster-punk'      => __('Punk', 'premium-addons-pro'),
                    'tooltipster-noir'      => __('Noir', 'premium-addons-pro'),
                    'tooltipster-shadow'    => __('Shadow', 'premium-addons-pro'),
                ],
                'default'       => 'tooltipster-default',
                'label_block'   => true,
            ]
        );
        
        $this->add_control('premium_preview_image_anim', 
            [
                'label'         => __('Animation', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'fade'  => __('Fade', 'premium-addons-pro'),
                    'grow'  => __('Grow', 'premium-addons-pro'),
                    'swing' => __('Swing', 'premium-addons-pro'),
                    'slide' => __('Slide', 'premium-addons-pro'),
                    'fall'  => __('Fall', 'premium-addons-pro'),
                ],
                'default'       => 'fade',
                'label_block'   => true,
            ]
        );
        
        $this->add_control('premium_preview_image_anim_dur',
                [
                    'label'             => __('Animation Duration', 'premium-addons-pro'),
                    'type'              => Controls_Manager::NUMBER,
                    'description'       => __('Set the animation duration in milliseconds, default is 350', 'premium-addons-pro'),
                    'default'           => 350,
                ]
                );
        
        $this->add_control('premium_preview_image_delay',
                [
                    'label'             => __('Delay', 'premium-addons-pro'),
                    'type'              => Controls_Manager::NUMBER,
                    'description'       => __('Set the animation delay in milliseconds, default is 10'),
                    'default'           => 10,
                ]
                );
        
        $this->add_control('premium_preview_image_arrow',
                [
                    'label'         => __('Arrow', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SWITCHER,
                    'label_on'      => 'Show',
                    'label_off'     => 'Hide',
                    'description'   => __('Show an arrow beside the tooltip', 'premium-addons-pro'),
                    'return_value'  => true,
                ]
                );
        
        $this->add_control('premium_preview_image_distance',
            [
                'label'             => __('Spacing', 'premium-addons-pro'),
                'type'              => Controls_Manager::NUMBER,
                'description'       => __('The distance between the origin and the tooltip in pixels, default is 6','premium-addons-pro'),
                'default'           => -1,
            ]
            );
        
        $this->add_responsive_control('premium_preview_image_min_width',
            [
                'label'             => __('Min Width', 'premium-addons-pro'),
                'type'              => Controls_Manager::NUMBER,
                'description'       => __('Set a minimum width for the tooltip in pixels, default: 0 (auto width)','premium-addons-pro'),
            ]
            );
        
        $this->add_responsive_control('premium_preview_image_max_width',
            [
                'label'             => __('Max Width', 'premium-addons-pro'),
                'type'              => Controls_Manager::NUMBER,
                'description'       => __('Set a maximum width for the tooltip in pixels, default: null (no max width)','premium-addons-pro'),
            ]
            );
        
        $this->add_control('premium_preview_image_custom_height_switcher',
                [
                    'label'         => __('Custom Height', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SWITCHER,
                    'label_on'      => 'Show',
                    'label_off'     => 'Hide',
                    'return_value'  => true,
                ]
                );
        
        $this->add_responsive_control('premium_preview_image_custom_height',
            [
                'label'         => __('Height', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em' , '%'],
                'range'         => [
                    'px'    => [
                        'min'       => 0,
                        'max'       => 800,
                    ],
                    'em'    => [
                        'min'       => 0,
                        'max'       => 20,
                    ]
                ],
                'default'       => [
                    'unit'  => 'px',
                    'size'  => 200,
                ],
                'label_block'   => true,
                'condition'     => [
                    'premium_preview_image_custom_height_switcher'  => 'true'
                ],
                'selectors'     => [
                    '.premium-prev-img-tooltip-wrap-{{ID}}' => 'height: {{SIZE}}{{UNIT}} !important;'
                ]
        	]
        );
        
        $this->add_control('premium_preview_image_side',
            [
                'label'             => __('Side', 'premium-addons-pro'),
                'type'              => Controls_Manager::SELECT2,
                'options'           => [
                    'top'   => __('Top','premium-addons-pro'),
                    'right' => __('Right','premium-addons-pro'),
                    'bottom'=> __('Bottom','premium-addons-pro'),
                    'left'  => __('Left','premium-addons-pro'),
                ],
                'description'       => __('Sets the side of the tooltip. The value may one of the following: \'top\', \'bottom\', \'left\', \'right\'. It may also be an array containing one or more of these values. When using an array, the order of values is taken into account as order of fallbacks and the absence of a side disables it','premium-addons-pro'),
                'default'           => ['right','left'],
                'multiple'          => true,
            ]);
        
        $this->add_control('premium_preview_image_hide',
                [
                    'label'         => __('Hide on Mobiles', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SWITCHER,
                    'label_on'      => 'Show',
                    'label_off'     => 'Hide',
                    'description'   => __('Hide tooltips on mobile phones', 'premium-addons-pro'),
                    'return_value'  => true,
                ]
                );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_preview_image_trigger_style_settings',
            [
                'label'             => __('Trigger Image', 'premium-addons-pro'),
                'tab'               => Controls_Manager::TAB_STYLE,
                ]
            );
        
        $this->add_control('premium_preview_image_trigger_background', 
            [
               'label'              => __('Background Color','premium-addons-pro'),
                'type'              => Controls_Manager::COLOR,
                'scheme'            => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'         => [
                    '{{WRAPPER}} .premium-preview-image-trigger'  => 'background-color:{{VALUE}};'
                    ]
               ]
            );
        
        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'              => 'premium_preview_image_trigger_border',
                    'selector'          => '{{WRAPPER}} .premium-preview-image-trigger',
                    ]
                );
        
        $this->add_responsive_control('premium_preview_image_trigger_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-preview-image-trigger' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'              => 'premium_preview_image_trigger_shadow',
                    'selector'          => '{{WRAPPER}} .premium-preview-image-trigger',
                    ]
                );
        
        $this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .premium-preview-image-trigger',
			]
		);
        
        $this->add_responsive_control('premium_preview_image_trigger_margin',
                [
                    'label'         => __( 'Margin', 'premium-addons-pro' ),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                       '{{WRAPPER}} .premium-preview-image-trigger' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                      	],
                    ]
               );

        $this->add_responsive_control('premium_preview_image_trigger_padding',
                [
                    'label'         => __( 'Padding', 'premium-addons-pro' ),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                      '{{WRAPPER}} .premium-preview-image-trigger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
      
        $this->end_controls_section();
        
        $this->start_controls_section('premium_preview_image_caption_style',
            [
                'label'             => __('Trigger Image Caption', 'premium-addons-pro'),
                'tab'               => Controls_Manager::TAB_STYLE,
                'condition'         => [
                    'premium_preview_image_caption!'    => ''
                    ]
                ]
            );
        
        $this->add_control('premium_preview_image_caption_color',
                [
                    'label'             => __('Text Color', 'premium-addons-pro'),
                    'type'              => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors'         => [
                        '{{WRAPPER}} .premium-preview-image-figcap' => 'color: {{VALUE}};',
                        ],
                    ]
                );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'premium_preview_image_caption_typo',
                'scheme'                => Scheme_Typography::TYPOGRAPHY_1,
                'selector'              => '{{WRAPPER}} .premium-preview-image-figcap'
            ]
        );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'name'          => 'premium_preview_image_caption_shadow',
                    'selector'      => '{{WRAPPER}} .premium-preview-image-figcap'
                    ]
                );
        
        $this->add_control('premium_preview_image_caption_background_color',
                [
                    'label'             => __('Background Color', 'premium-addons-pro'),
                    'type'              => Controls_Manager::COLOR,
                    'selectors'         => [
                        '{{WRAPPER}} .premium-preview-image-figcap'    => 'background: {{VALUE}};',
                        ],
                    ]
                );

        
        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'              => 'premium_preview_image_caption_border',
                    'selector'          => '{{WRAPPER}} .premium-preview-image-figcap'
                    ]
                );
        
        $this->add_responsive_control('premium_preview_image_caption_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-preview-image-figcap' => 'border-radius: {{SIZE}}{{UNIT}}'
                    ]
                ]);
        
        $this->add_responsive_control('premium_preview_image_caption_margin',
                [
                    'label'             => __('Margin', 'premium-addons-pro'),
                    'type'              => Controls_Manager::DIMENSIONS,
                    'size_units'        => ['px', 'em', '%'],
                    'selectors'         => [
                        '{{WRAPPER}} .premium-preview-image-figcap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ]
                    ]
                );
        
        $this->add_responsive_control('premium_preview_image_caption_padding',
                [
                    'label'             => __('Padding', 'premium-addons-pro'),
                    'type'              => Controls_Manager::DIMENSIONS,
                    'size_units'        => ['px', 'em', '%'],
                    'selectors'         => [
                        '{{WRAPPER}} .premium-preview-image-figcap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ]
                    ]
                );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_preview_image_tooltip_style_settings',
            [
                'label'             => __('Preview Window Content', 'premium-addons-pro'),
                'tab'               => Controls_Manager::TAB_STYLE,
                ]
            );
        
	$this->add_control('premium_preview_image_tooltip_background', 
            [
               'label'              => __('Background Color','premium-addons-pro'),
                'type'              => Controls_Manager::COLOR,
                'scheme'            => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'         => [
                    '.premium-prev-img-tooltip-wrap-{{ID}}'  => 'background-color:{{VALUE}};'
                    ]
               ]
            );
        
        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'              => 'premium_preview_image_tooltip_border',
                    'selector'          => '.premium-prev-img-tooltip-wrap-{{ID}}'
                    ]
                );
        
        $this->add_responsive_control('premium_preview_image_tooltip_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '.premium-prev-img-tooltip-wrap-{{ID}}' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'              => 'premium_preview_image_tooltip_shadow',
                    'selector'          => '.premium-prev-img-tooltip-wrap-{{ID}}'
                    ]
                );
        
        $this->add_responsive_control('premium_preview_image_tooltip_margin',
                [
                    'label'         => __( 'Margin', 'premium-addons-pro' ),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                       '.premium-prev-img-tooltip-wrap-{{ID}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                      	],
                    ]
               );

        $this->add_responsive_control('premium_preview_image_tooltip_padding',
                [
                    'label'         => __( 'Padding', 'premium-addons-pro' ),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                      '.premium-prev-img-tooltip-wrap-{{ID}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
      
        $this->end_controls_section();
        
        $this->start_controls_section('premium_preview_image_tooltip_img_style_settings',
            [
                'label'             => __('Preview Window Image', 'premium-addons-pro'),
                'tab'               => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'premium_preview_image_content_selection'   => 'custom',
                    'premium_preview_image_img_switcher'        => 'yes'
                ]
                ]
            );
        
        $this->add_control('premium_preview_image_tooltip_img_background', 
            [
               'label'              => __('Background Color','premium-addons-pro'),
                'type'              => Controls_Manager::COLOR,
                'scheme'            => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'         => [
                    '.premium-prev-img-tooltip-img-wrap-{{ID}} .premium-preview-image-tooltips-img'  => 'background-color:{{VALUE}};'
                    ]
               ]
            );
        
        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'              => 'premium_preview_image_tooltip_img_border',
                    'selector'          => '.premium-prev-img-tooltip-img-wrap-{{ID}} .premium-preview-image-tooltips-img'
                    ]
                );
        
        $this->add_responsive_control('premium_preview_image_tooltip_img_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '.premium-prev-img-tooltip-img-wrap-{{ID}} .premium-preview-image-tooltips-img' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'label'             => __('Shadow', 'premium-addons-pro'),
                    'name'              => 'premium_preview_image_tooltip_img_shadow',
                    'selector'          => '.premium-prev-img-tooltip-img-wrap-{{ID}} .premium-preview-image-tooltips-img'
                    ]
                );
        
        $this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'preview_css_filters',
				'selector' => '.premium-prev-img-tooltip-img-wrap-{{ID}} .premium-preview-image-tooltips-img',
			]
		);
        
        $this->add_responsive_control('premium_preview_image_tooltip_img_margin',
                [
                    'label'         => __( 'Margin', 'premium-addons-pro' ),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                       '.premium-prev-img-tooltip-img-wrap-{{ID}} .premium-preview-image-tooltips-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                      	],
                    ]
               );

        $this->add_responsive_control('premium_preview_image_tooltip_img_padding',
                [
                    'label'         => __( 'Padding', 'premium-addons-pro' ),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                      '.premium-prev-img-tooltip-img-wrap-{{ID}} .premium-preview-image-tooltips-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
      
        $this->end_controls_section();
        
        $this->start_controls_section('premium_preview_image_tooltip_title_style_settings',
            [
                'label'             => __('Preview Window Title', 'premium-addons-pro'),
                'tab'               => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'premium_preview_image_content_selection'   => 'custom',
                    'premium_preview_image_title_switcher'        => 'yes'
                ]
                ]
            );
        
        $this->add_control('premium_preview_image_tooltip_title_color', 
            [
               'label'              => __('Color','premium-addons-pro'),
                'type'              => Controls_Manager::COLOR,
                'scheme'            => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'         => [
                    '.premium-prev-img-tooltip-title-wrap-{{ID}} .premium-previmg-tooltip-title'  => 'color: {{VALUE}};'
                    ]
               ]
            );
        
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'premium_preview_image_tooltip_title_typo',
				'scheme'                => Scheme_Typography::TYPOGRAPHY_1,
                'selector'              => '.premium-prev-img-tooltip-title-wrap-{{ID}} .premium-previmg-tooltip-title'
			]
		);

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name'              => 'premium_preview_image_tooltip_title_shadow',
                    'selector'          => '.premium-prev-img-tooltip-title-wrap-{{ID}}'
                    ]
                );
        
        $this->add_control('premium_preview_image_tooltip_title_background', 
            [
               'label'              => __('Background Color','premium-addons-pro'),
                'type'              => Controls_Manager::COLOR,
                'scheme'            => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'         => [
                    '.premium-prev-img-tooltip-title-wrap-{{ID}}'  => 'background-color:{{VALUE}};'
                    ]
               ]
            );
        
        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'              => 'premium_preview_image_tooltip_title_border',
                    'selector'          => '.premium-prev-img-tooltip-title-wrap-{{ID}}'
                    ]
                );
        
        $this->add_responsive_control('premium_preview_image_tooltip_title_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '.premium-prev-img-tooltip-title-wrap-{{ID}}' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->add_responsive_control('premium_preview_image_tooltip_title_margin',
                [
                    'label'         => __( 'Margin', 'premium-addons-pro' ),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                       '.premium-prev-img-tooltip-title-wrap-{{ID}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                      	],
                    ]
               );

        $this->add_responsive_control('premium_preview_image_tooltip_title_padding',
                [
                    'label'         => __( 'Padding', 'premium-addons-pro' ),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                      '.premium-prev-img-tooltip-title-wrap-{{ID}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
      
        $this->end_controls_section();
        
        $this->start_controls_section('premium_preview_image_tooltip_desc_style_settings',
            [
                'label'             => __('Preview Window Description', 'premium-addons-pro'),
                'tab'               => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'premium_preview_image_content_selection'   => 'custom',
                    'premium_preview_image_desc_switcher'        => 'yes'
                ]
                ]
            );
        
        $this->add_control('premium_preview_image_tooltip_desc_color', 
            [
               'label'              => __('Color','premium-addons-pro'),
                'type'              => Controls_Manager::COLOR,
                'scheme'            => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'         => [
                    '.premium-prev-img-tooltip-desc-wrap-{{ID}}'  => 'color:{{VALUE}};'
                    ]
               ]
            );
        
        
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'premium_preview_image_tooltip_desc_typo',
				'scheme'                => Scheme_Typography::TYPOGRAPHY_1,
                'selector'              => '.premium-prev-img-tooltip-desc-wrap-{{ID}}'
			]
		);

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name'              => 'premium_preview_image_tooltip_desc_shadow',
                    'selector'          => '.premium-prev-img-tooltip-desc-wrap-{{ID}}'
                    ]
                );
        
        $this->add_control('premium_preview_image_tooltip_desc_background', 
            [
               'label'              => __('Background Color','premium-addons-pro'),
                'type'              => Controls_Manager::COLOR,
                'scheme'            => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'         => [
                    '.premium-prev-img-tooltip-desc-wrap-{{ID}}'  => 'background-color:{{VALUE}};'
                    ]
               ]
            );
        
        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'              => 'premium_preview_image_tooltip_desc_border',
                    'selector'          => '.premium-prev-img-tooltip-desc-wrap-{{ID}}'
                    ]
                );
        
        $this->add_responsive_control('premium_preview_image_tooltip_desc_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '.premium-prev-img-tooltip-desc-wrap-{{ID}}' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->add_responsive_control('premium_preview_image_tooltip_desc_margin',
                [
                    'label'         => __( 'Margin', 'premium-addons-pro' ),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                       '.premium-prev-img-tooltip-desc-wrap-{{ID}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                      	],
                    ]
               );

        $this->add_responsive_control('premium_preview_image_tooltip_desc_padding',
                [
                    'label'         => __( 'Padding', 'premium-addons-pro' ),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                      '.premium-prev-img-tooltip-desc-wrap-{{ID}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
      
        $this->end_controls_section();
        
        $this->start_controls_section('premium_preview_image_tooltip_container',
            [
                'label'             => __('Preview Window Container', 'premium-addons-pro'),
                'tab'               => Controls_Manager::TAB_STYLE,
                ]
            );
        
        $this->add_control('premium_preview_image_tooltip_container_background', 
            [
               'label'              => __('Inner Background Color','premium-addons-pro'),
                'type'              => Controls_Manager::COLOR,
                'scheme'            => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'         => [
                    '.tooltipster-sidetip div.tooltipster-box-{{ID}}'  => 'background-color:{{VALUE}};'
                    ]
               ]
            );
        
        $this->add_control('premium_preview_image_tooltip_outer_background', 
            [
               'label'              => __('Outer Background Color','premium-addons-pro'),
                'type'              => Controls_Manager::COLOR,
                'scheme'            => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'         => [
                    '.tooltipster-sidetip div.tooltipster-box-{{ID}} .tooltipster-content'  => 'background-color:{{VALUE}};'
                    ]
               ]
            );
        
        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'              => 'premium_preview_image_tooltip_container_border',
                    'selector'          => '.tooltipster-sidetip div.tooltipster-box-{{ID}}'
                    ]
                );
        
        $this->add_responsive_control('premium_preview_image_tooltip_container_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '.tooltipster-sidetip div.tooltipster-box-{{ID}}' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'              => 'premium_preview_image_tooltip_container_shadow',
                    'selector'          => '.tooltipster-sidetip div.tooltipster-box-{{ID}}'
                    ]
                );
        
        $this->add_responsive_control('premium_preview_image_tooltip_containe_rpadding',
                [
                    'label'         => __( 'Padding', 'premium-addons-pro' ),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                      '.tooltipster-sidetip div.tooltipster-box-{{ID}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
        
        $this->end_controls_section();
       
    }

    protected function render() {
        
        $settings = $this->get_settings_for_display();
        
        $id = $this->get_id();
        
        $elementor_post_id = $settings['premium_preview_image_content_temp'];
        $premium_elements_frontend = new Frontend;
        
        if( ! empty( $settings['premium_preview_image_main']['url'] ) ) {
            $image_main = $settings['premium_preview_image_main'];
            $image_url_main = Group_Control_Image_Size::get_attachment_image_src( $image_main['id'], 'premium_preview_image_main_size', $settings );
            $image_url = empty( $image_url_main ) ? $image_main['url'] : $image_url_main; 
        }
        
        $size = 0;
        if(!empty($settings['premium_preview_image_tooltips_image']['url'])) {
            
            $tooltips_image = $settings['premium_preview_image_tooltips_image'];
            $selected_size = $settings[ 'premium_preview_image_tooltips_image_size' . '_size' ];
            $size = wp_get_attachment_image_src($tooltips_image['id'],$selected_size);
            $tool_tips_image_url = Group_Control_Image_Size::get_attachment_image_src( $tooltips_image['id'], 'premium_preview_image_tooltips_image_size', $settings );
            if( empty( $tool_tips_image_url ) ) { 
                $tool_tips_image_url = $tooltips_image['url']; 
            } else {
                $tool_tips_image_url = $tool_tips_image_url;
            }       
        }
        
        $this->add_render_attribute('premium_preview_img_trigger', 'class', 'premium-preview-image-trigger');
        $this->add_render_attribute('premium_preview_img_trigger', 'alt', $settings['premium_preview_image_alt']);
        $this->add_render_attribute('premium_preview_img_trigger', 'src', $image_url);
        
        $this->add_inline_editing_attributes('premium_preview_image_caption', 'basic');
        $this->add_render_attribute('premium_preview_image_caption', 'class', 'premium-preview-image-figcap');
        
        
        if($settings['premium_preview_image_link_switcher'] == 'yes'){
            if($settings['premium_preview_image_link_selection'] == 'url'){
                $preview_img_url = $settings['premium_preview_image_link']['url'];
            } else {
                $preview_img_url = get_permalink($settings['premium_preview_image_existing_link']);
            }
        }
        
        $tooltip_container = [
          'background'      => $settings['premium_preview_image_tooltip_container_background']
        ];
        
        $prev_img_settings = [
            'theme'     => $settings['premium_preview_image_theme'],
            'anim'      => $settings['premium_preview_image_anim'],
            'animDur'   => !empty($settings['premium_preview_image_anim_dur']) ? $settings['premium_preview_image_anim_dur'] : 350,
            'delay'     => !empty($settings['premium_preview_image_delay']) ? $settings['premium_preview_image_delay'] : 10,
            'arrow'     => ( $settings['premium_preview_image_arrow'] == true ) ? true : false,
            'active'    => ( $settings['premium_preview_image_interactive'] == 'yes') ? true : false,
            'responsive'=> ( $settings['premium_preview_image_responsive'] == 'yes' ) ? true : false,
            'distance'  => !empty($settings['premium_preview_image_distance']) ? $settings['premium_preview_image_distance'] : 6,
            'maxWidth'  => !empty($settings['premium_preview_image_max_width']) ? $settings['premium_preview_image_max_width'] : 'null',
            'minWidth'  =>  !empty($settings['premium_preview_image_min_width']) ? $settings['premium_preview_image_min_width'] : $size[1],
            'maxWidthTabs'  => !empty($settings['premium_preview_image_max_width_tablet']) ? $settings['premium_preview_image_max_width_tablet'] : 'null',
            'minWidthTabs'  =>  !empty($settings['premium_preview_image_min_width_tablet']) ? $settings['premium_preview_image_min_width_tablet'] : $size[1],
            'maxWidthMobs'  => !empty($settings['premium_preview_image_max_width_mobile']) ? $settings['premium_preview_image_max_width_mobile'] : 'null',
            'minWidthMobs'  =>  !empty($settings['premium_preview_image_min_width_mobile']) ? $settings['premium_preview_image_min_width_mobile'] : $size[1],
            'side'      => !empty($settings['premium_preview_image_side']) ? $settings['premium_preview_image_side'] : array('right', 'left'),
            'container' => $tooltip_container,
            'hideMobiles'=> ($settings['premium_preview_image_hide'] == true) ? true : false,
            'id'        => $id,
        ];
        
        if($settings['premium_preview_image_title_switcher'] == 'yes' && !empty($settings['premium_preview_image_title'] ) ){
            $title = '<' . $settings['premium_image_preview_title_heading'] . ' class="premium-previmg-tooltip-title">' . $settings['premium_preview_image_title'] . '</'. $settings['premium_image_preview_title_heading'] . '>';
        }
        
        $this->add_render_attribute('preview-img', 'id', 'premium-preview-image-main-' . $id );
        
        $this->add_render_attribute('preview-img', 'class', 'premium-preview-image-wrap' );
        
        $this->add_render_attribute('preview-img', 'data-settings', wp_json_encode( $prev_img_settings ) );
        
        if( $settings['premium_preview_image_link_switcher'] == 'yes' ) {
            $this->add_render_attribute('img-link', 'class', 'premium-preview-img-link' );
            
            $this->add_render_attribute('img-link', 'href', $preview_img_url );
            
            if( !empty( $settings['premium_preview_image_link']['is_external'] ) ) {
                $this->add_render_attribute('img-link', 'target', '_blank' );
            }
            
            if( !empty( $settings['premium_preview_image_link']['nofollow'] ) ) {
                $this->add_render_attribute('img-link', 'rel', 'nofollow' );
            }   
        }
        
        $this->add_render_attribute('tooltip', 'id', 'tooltip_content' );
        
        $this->add_render_attribute('tooltip', 'class', [ 'premium-prev-img-tooltip-wrap', 'premium-prev-img-tooltip-wrap-' . $id ] );
        
        $this->add_render_attribute('tooltip-img-wrap', 'class', 'premium-prev-img-tooltip-img-wrap-' . $id );
        
        $this->add_render_attribute('tooltip-img', 'class', 'premium-preview-image-tooltips-img' );
        
        $this->add_render_attribute('tooltip-img', 'alt', $settings['premium_preview_image_tooltips_image_alt'] );
        
        $this->add_render_attribute('tooltip-img', 'src', $tool_tips_image_url );
        
        $this->add_render_attribute('tooltip-title', 'class', ['premium-prev-img-tooltip-title-wrap', 'premium-prev-img-tooltip-title-wrap-' . $id ] ); 
        
        $this->add_render_attribute('tooltip-desc', 'class', ['premium-prev-img-tooltip-desc-wrap', 'premium-prev-img-tooltip-desc-wrap-' . $id ] );
    ?>		

    <div <?php echo $this->get_render_attribute_string('preview-img'); ?>>
        <div class="premium-preview-image-trig-img-wrap">
            <div class="premium-preview-image-inner-trig-img" data-tooltip-content="#tooltip_content">
                <?php if($settings['premium_preview_image_link_switcher'] == 'yes') : ?>
                    <a <?php echo $this->get_render_attribute_string('img-link'); ?>>
                <?php endif; ?>
                    <figure class="premium-preview-image-figure">
                        <img <?php echo $this->get_render_attribute_string('premium_preview_img_trigger'); ?>>
                        <?php if( ! empty( $settings['premium_preview_image_caption'] ) ) : ?>
                            <figcaption <?php echo $this->get_render_attribute_string('premium_preview_image_caption'); ?>>
                                <?php echo esc_html( $settings['premium_preview_image_caption'] ); ?>
                            </figcaption>
                        <?php endif; ?>
                    </figure>
                <?php if($settings['premium_preview_image_link_switcher'] == 'yes') : ?>
                    </a>
                <?php endif; ?>
                
                <div <?php echo $this->get_render_attribute_string('tooltip'); ?>>
                    <?php if( $settings['premium_preview_image_content_selection'] == 'custom' ) : ?>
                        <?php if( $settings['premium_preview_image_img_switcher'] == 'yes' ) : ?>
                            <div <?php echo $this->get_render_attribute_string('tooltip-img-wrap'); ?>>
                                <img <?php echo $this->get_render_attribute_string('tooltip-img'); ?>>
                            </div>
                        <?php endif; ?>

                        <?php if( $settings['premium_preview_image_title_switcher'] == 'yes' && !empty( $settings['premium_preview_image_title'] ) ) : ?>
                            <div <?php echo $this->get_render_attribute_string('tooltip-title'); ?>>
                                <?php  echo $title; ?>
                            </div>
                        <?php endif; ?>
                        <?php if( $settings['premium_preview_image_desc_switcher'] == 'yes' && ! empty( $settings['premium_preview_image_desc'] ) ) : ?>
                            <div <?php echo $this->get_render_attribute_string('tooltip-desc'); ?>>
                                <?php echo $settings['premium_preview_image_desc']; ?>
                            </div>
                        <?php endif; ?>
                    <?php else:
                        echo $premium_elements_frontend->get_builder_content($elementor_post_id, true); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

	<?php 
   }
}