<?php 

namespace PremiumAddonsPro\Widgets;

use PremiumAddons\Helper_Functions;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;

if( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Premium_Unfold extends Widget_Base {
    
    public function get_name(){
        return 'premium-unfold-addon';
    }
    
    public function get_title() {
		return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Unfold', 'premium-addons-pro') );
	}
    
    public function get_icon() {
        return 'pa-pro-unfold';
    }
    
    public function is_reload_preview_required(){
        return true;
    }
    
    public function get_script_depends(){
        return [
            'jquery-ui',
            'premium-pro-js'
            ];
    }
    
    public function get_categories() {
        return [ 'premium-elements' ];
    }
    
    // Adding the controls fields for the premium unfold
    // This will controls the animation, colors and background, dimensions etc
    protected function _register_controls() {
        
        $this->start_controls_section('premium_unfold_general_settings',
                [
                    'label'         => __('Content', 'premium-addons-pro'),
                    ]
                );
        
        $this->add_control('premium_unfold_title_switcher',
            [
                'label'         => __('Title', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes'
            ]
        );
        
        $this->add_control('premium_unfold_title', 
            [
                'label'         => __('Title','premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'default'       =>'Premium Unfold',
                'condition'     => [
                    'premium_unfold_title_switcher'    => 'yes'
                ]
            ]
        );
        
        $this->add_control('premium_unfold_title_heading', 
            [
                'label'         => __('Title Heading','premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'h3',
                'options'       =>[
                    'h1'    => 'H1',
                    'h2'    => 'H2',
                    'h3'    => 'H3',
                    'h4'    => 'H4',
                    'h5'    => 'H5',
                    'h6'    => 'H6',
                ],
                'condition'     => [
                    'premium_unfold_title_switcher'    => 'yes'
                ]
            ]
        );
        
        $this->add_control('premium_unfold_content',
                [
                    'type'          => Controls_Manager::WYSIWYG,
                    'default'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
                    'dynamic'       => [ 'active' => true ],
                    ]
                );
        
        $this->add_responsive_control('premium_unfold_content_align',
			[
				'label'             => __( 'Alignment', 'premium-addons-pro' ),
				'type'              => Controls_Manager::CHOOSE,
				'options'           => [
					'left'    => [
						'title' => __( 'Left', 'premium-addons-pro' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'premium-addons-pro' ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'premium-addons-pro' ),
						'icon'  => 'fa fa-align-right',
					],
                    'justify'   => [
                        'title'=> __( 'Justify', 'premium-addons-pro' ),
                        'icon' => 'fa fa-align-justify',
                    ],
				],
                'selectors'         => [
                    '{{WRAPPER}} .premium-unfold-content,{{WRAPPER}} .premium-unfold-heading' => 'text-align: {{VALUE}}',
                ],
				'default' => 'left',
			]
		);
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_unfold_button_settings',
                [
                    'label'         => __('Button', 'premium-addons-pro'),
                    ]
                );
        
        $this->add_control('premium_unfold_button_fold_text',
                [
                    'label'         => __('Unfold Text', 'premium-addons-pro'),
                    'type'          => Controls_Manager::TEXT,
                    'dynamic'       => [ 'active' => true ],
                    'default'       => __('Show more', 'premium-addons-pro'),
                    ]
                );
        
        $this->add_control('premium_unfold_button_unfold_text',
                [
                    'label'         => __('Fold Text', 'premium-addons-pro'),
                    'type'          => Controls_Manager::TEXT,
                    'dynamic'       => [ 'active' => true ],
                    'default'       => __('Show Less', 'premium-addons-pro'),
                    ]
                );
        
        $this->add_control('premium_unfold_button_icon_switcher',
                [
                    'label'         => __('Icon', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SWITCHER,
                    'description'   => __('Enable or disable button icon','premium-addons-pro'),
                    'separator'     => 'before'
                ]
                );

        /*Button Icon Selection*/ 
        $this->add_control('premium_unfold_button_icon',
                [
                    'label'         => __('Fold Icon', 'premium-addons-pro'),
                    'type'          => Controls_Manager::ICON,
                    'default'       => 'fa fa-arrow-up',
                    'condition'     => [
                        'premium_unfold_button_icon_switcher' => 'yes',
                    ],
                    'label_block'   => true,
                ]
                );
        
        $this->add_control('premium_unfold_button_icon_unfolded',
                [
                    'label'         => __('Unfold Icon', 'premium-addons-pro'),
                    'type'          => Controls_Manager::ICON,
                    'default'       => 'fa fa-arrow-down',
                    'condition'     => [
                        'premium_unfold_button_icon_switcher' => 'yes',
                    ],
                    'label_block'   => true,
                ]
                );
        
        $this->add_control('premium_unfold_button_icon_position', 
                [
                    'label'         => __('Icon Position', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => 'before',
                    'options'       => [
                        'before'        => __('Before', 'premium-addons-pro'),
                        'after'         => __('After', 'premium-addons-pro'),
                        ],
                    'condition'     => [
                        'premium_unfold_button_icon_switcher' => 'yes',
                    ],
                    'label_block'   => true,
                    ]
                );
        
        $this->add_control('premium_unfold_button_size', 
                [
                    'label'         => __('Button Size', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => 'sm',
                    'options'       => [
                            'sm'            => __('Small', 'premium-addons-pro'),
                            'md'            => __('Medium', 'premium-addons-pro'),
                            'lg'            => __('Large', 'premium-addons-pro'),
                            'block'         => __('Block', 'premium-addons-pro'),
                        ],
                    'label_block'   => true,
                    'separator'     => 'before',
                    ]
                );
        
        $this->add_control('premium_unfold_button_position', 
                [
                    'label'         => __('Button Position', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => 'inside',
                    'options'       => [
                        'inside'            => __('Inside', 'premium-addons-pro'),
                        'outside'           => __('Outside', 'premium-addons-pro'),
                        ],
                    'label_block'   => true,
                    'separator'     => 'before',
                    ]
                );
        
        $this->add_responsive_control('premium_unfold_button_align',
			[
				'label'             => __( 'Alignment', 'premium-addons-pro' ),
				'type'              => Controls_Manager::CHOOSE,
				'options'           => [
					'left'    => [
						'title' => __( 'Left', 'premium-addons-pro' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'premium-addons-pro' ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'premium-addons-pro' ),
						'icon'  => 'fa fa-align-right',
					],
				],
                'selectors'         => [
                    '{{WRAPPER}} .premium-unfold-button-container' => 'text-align: {{VALUE}}',
                ],
				'default' => 'center',
			]
		);
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_unfold_sep_settings',
                [
                    'label'         => __('Fade Effect', 'premium-addons-pro'),
                    ]
                );
        
        $this->add_control('premium_unfold_sep_switcher',
                [
                    'label'         => __('Faded Content', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SWITCHER,
                    'default'       => 'yes',
                ]
                );
        
        $this->add_control('premium_unfold_sep_height', 
                    [
                        'label'     => __('Fade Height', 'premium-addons-pro'),
                        'type'      => Controls_Manager::SLIDER,
                        'description'=> __('Increase or decrease fade height. The default value is 30px','premium-addons-pro'),
                        'range'     => [
                            'px'    => [
                                'min'   => 1,
                                'max'   => 400,
                            ],
                        ],
                        'default'   => [
                            'size'=> 30,
                            'unit'=> 'px'
                        ],
                        'condition' => [
                            'premium_unfold_sep_switcher'  => 'yes'
                        ]
                    ]
                    );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_unfold_adv_settings',
                [
                    'label'         => __('Advanced Settings', 'premium-addons-pro'),
                    ]
                );

        $this->add_control('premium_unfold_fold_height_select',
                [
                    'label'         => __('Fold Height', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => 'percent',
                    'options'       => [
                        'percent' => __('Percentage','premium-addons-pro'),
                        'pixel'   => __('Pixels','premium-addons-pro'),
                        ],
                    'label_block'   =>  true,
                    'separator'     => 'before'
                    ]
                );
        
        $this->add_control('premium_unfold_fold_height',
            [
                'label'             => __('Fold Height', 'premium-addons-pro'),
                'type'              => Controls_Manager::NUMBER,
                'description'   => __('How much of the folded content should be shown, default is 60%','premium-addons-pro'),
                'min'               => 0,
                'default'           => 60,
                'condition'         => [
                    'premium_unfold_fold_height_select' => 'percent'
                ]
            ]);

        $this->add_control('premium_unfold_fold_height_pix',
            [
                'label'             => __('Fold Height', 'premium-addons-pro'),
                'type'              => Controls_Manager::NUMBER,
                'description'   => __('How much of the folded content should be shown, default is 100px','premium-addons-pro'),
                'min'               => 0,
                'default'           => 100,
                'condition'         => [
                    'premium_unfold_fold_height_select' => 'pixel'
                ]
            ]);
        
        $this->add_control('premium_unfold_fold_dur_select',
                [
                    'label'         => __('Fold Duration', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => 'fast',
                    'options'       => [
                        'slow'    => __('Slow','premium-addons-pro'),
                        'fast'    => __('Fast','premium-addons-pro'),
                        'custom'  => __('Custom','premium-addons-pro'),
                        ],
                    'label_block'   =>  true,
                    'separator'     => 'before'
                    ]
                );
        
        $this->add_control('premium_unfold_fold_dur',
            [
                'label'             => __('Number of Seconds', 'premium-addons-pro'),
                'type'              => Controls_Manager::NUMBER,
                'description'       => __('How much time does it take for the fold, default is 0.5s','premium-addons-pro'),
                'min'               => 0.1,
                'default'           => 0.5,
                'condition'         => [
                    'premium_unfold_fold_dur_select' => 'custom'
                ]
            ]);
        
        $this->add_control('premium_unfold_fold_easing',
                [
                    'label'         => __('Fold Easing', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => 'swing',
                    'options'       => [
                        'swing' => 'Swing',
                        'linear'=> 'Linear',
                        ],
                    'label_block'   =>  true,
                    ]
                );
        
        $this->add_control('premium_unfold_unfold_dur_select',
                [
                    'label'         => __('Unfold Duration', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => 'fast',
                    'options'       => [
                        'slow'    => 'Slow',
                        'fast'    => 'Fast',
                        'custom'  => 'Custom',
                        ],
                    'label_block'   =>  true,
                    'separator'     => 'before',
                    ]
                );
        
        $this->add_control('premium_unfold_unfold_dur',
            [
                'label'             => __('Number of Seconds', 'premium-addons-pro'),
                'type'              => Controls_Manager::NUMBER,
                'description'       => __('How much time does it take for the unfold, default is 0.5s','premium-addons-pro'),
                'min'               => 0.1,
                'default'           => 0.5,
                'condition'         => [
                    'premium_unfold_unfold_dur_select' => 'custom'
                ]
            ]);
        
        $this->add_control('premium_unfold_unfold_easing',
                [
                    'label'         => __('Unfold Easing', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SELECT,
                    'description'   => __('Choose the animation style','premium-addons-pro'),
                    'default'       => 'swing',
                    'options'       => [
                        'swing' => 'Swing',
                        'linear'=> 'Linear',
                        ],
                    'label_block'   =>  true,
                    ]
                );
        
        $this->end_controls_section();
        
        /*Start Box Style Settings*/
        $this->start_controls_section('premium_unfold_style_settings',
                [
                    'label'         => __('Box Settings', 'premium-addons-pro'),
                    'tab'           => Controls_Manager::TAB_STYLE,
                ]
                );
        
        $this->start_controls_tabs('premium_unfold_box_style_tabs');
        
        $this->start_controls_tab('premium_unfold_box_style_normal',
                [
                    'label'         => __('Normal', 'premium-addons-pro'),
                ]
                );
        
        /*Box Background*/
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_unfold_box_background',
                    'types'             => [ 'classic' , 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-unfold-container',
                    ]
                );
        
        /*Box Border*/
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_unfold_box_border',
                    'selector'      => '{{WRAPPER}} .premium-unfold-container',
                ]
                );
        
        /*Box Border Radius*/
        $this->add_control('premium_unfold_box_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-unfold-container' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        /*Button Shadow*/
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'name'          => 'premium_unfold_box_shadow',
                    'selector'      => '{{WRAPPER}} .premium-unfold-container',
                ]
                );
        
        /*Box Margin*/
        $this->add_responsive_control('premium_unfold_box_margin',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-unfold-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        /*Box Padding*/
        $this->add_responsive_control('premium_unfold_box_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-unfold-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->end_controls_tab();

        $this->start_controls_tab('premium_unfold_box_style_hover',
        [
            'label'         => __('Hover', 'premium-addons-pro'),
	        ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_unfold_box_background_hover',
                    'types'             => [ 'classic' , 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-unfold-container:hover',
                    ]
                );
        
        
        /*Box Border*/
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_unfold_box_border_hover',
                    'selector'      => '{{WRAPPER}} .premium-unfold-container:hover',
                ]
                );
        
        /*Box Border Radius*/
        $this->add_control('premium_unfold_box_border_radius_hover',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', 'em' , '%' ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-unfold-container:hover' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        /*Box Shadow*/
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'name'          => 'premium_unfold_box_shadow_hover',
                    'selector'      => '{{WRAPPER}} .premium-unfold-container:hover',
                ]
                );
        
        /*Box Margin*/
        $this->add_responsive_control('premium_unfold_box_margin_hover',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-unfold-container:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        /*Box Padding*/
        $this->add_responsive_control('premium_unfold_box_padding_hover',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-unfold-container:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        

        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        /*End Box Style Settings*/
        $this->end_controls_section();
        
        $this->start_controls_section('premium_unfold_title_style',
                [
                    'label'         => __('Title', 'premium-addons-pro'),
                    'tab'           => Controls_Manager::TAB_STYLE,
                    'condition'     => [
                        'premium_unfold_title_switcher' => 'yes'
                    ]
                ]
                );
        
        /*Title Color*/
        $this->add_control('premium_unfold_heading_color',
                [
                    'label'         => __('Color', 'premium-addons-pro'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-unfold-heading'  => 'color: {{VALUE}};'
                        ]
                    ]
                );
        
        /*Title Typography*/
        $this->add_group_control(
            Group_Control_Typography::get_type(),
                [
                    'name'          => 'premium_unfold_heading_typo',
                    'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'      => '{{WRAPPER}} .premium-unfold-heading',
                ]
            );
        
        /*Title Background*/
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_unfold_heading_background',
                    'types'             => [ 'classic' , 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-unfold-heading',
                    ]
                );
        
        /*Title Border*/
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_unfold_title_border',
                    'selector'      => '{{WRAPPER}} .premium-unfold-heading',
                ]
                );
        
        /*Title Border Radius*/
        $this->add_control('premium_unfold_title_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-unfold-heading' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'label'         => __('Shadow','premium-addons-pro'),
                    'name'          => 'premium_unfold_title_shadow',
                    'selector'      => '{{WRAPPER}} .premium-unfold-heading',
                ]
                );
        
        /*TItle Margin*/
        $this->add_responsive_control('premium_unfold_title_margin',
                [
                    'label'             => __('Margin', 'premium-addons-pro'),
                    'type'              => Controls_Manager::DIMENSIONS,
                    'size_units'        => ['px', 'em', '%'],
                    'selectors'         => [
                    '{{WRAPPER}} .premium-unfold-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]      
        );
        
        /*Title Padding*/
        $this->add_responsive_control('premium_unfold_title_padding',
                [
                    'label'             => __('Padding', 'premium-addons-pro'),
                    'type'              => Controls_Manager::DIMENSIONS,
                    'size_units'        => ['px', 'em', '%'],
                    'selectors'         => [
                    '{{WRAPPER}} .premium-unfold-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]      
        );
        
        /*End Content Style Settings*/
        $this->end_controls_section();
        
        $this->start_controls_section('premium_unfold_content_style',
                [
                    'label'         => __('Content', 'premium-addons-pro'),
                    'tab'           => Controls_Manager::TAB_STYLE,
                ]
                );
        
                /*Description Color*/
        $this->add_control('premium_pricing_desc_color',
                [
                    'label'         => __('Color', 'premium-addons-pro'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-unfold-content'  => 'color: {{VALUE}};'
                        ]
                    ]
                );
        
        /*Description Typography*/
        $this->add_group_control(
            Group_Control_Typography::get_type(),
                [
                    'name'          => 'unfold_content_typo',
                    'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'      => '{{WRAPPER}} .premium-unfold-content',
                ]
            );
        
        /*Description Background*/
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_unfold_content_background',
                    'types'             => [ 'classic' , 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-unfold-content',
                    ]
                );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'label'         => __('Shadow','premium-addons-pro'),
                    'name'          => 'premium_unfold_content_shadow',
                    'selector'      => '{{WRAPPER}} .premium-unfold-content',
                ]
                );
        
        /*Description Margin*/
        $this->add_responsive_control('premium_unfold_content_margin',
                [
                    'label'             => __('Margin', 'premium-addons-pro'),
                    'type'              => Controls_Manager::DIMENSIONS,
                    'size_units'        => ['px', 'em', '%'],
                    'selectors'         => [
                    '{{WRAPPER}} .premium-unfold-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]      
        );
        
        /*Description Padding*/
        $this->add_responsive_control('premium_unfold_content_padding',
                [
                    'label'             => __('Padding', 'premium-addons-pro'),
                    'type'              => Controls_Manager::DIMENSIONS,
                    'size_units'        => ['px', 'em', '%'],
                    'selectors'         => [
                    '{{WRAPPER}} .premium-unfold-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]      
        );
        
        /*End Content Style Settings*/
        $this->end_controls_section();
        
        /*Start Styling Section*/
        $this->start_controls_section('premium_unfold_button_style_section',
            [
                'label'             => __('Button', 'premium-addons-pro'),
                'tab'               => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control('premium_unfold_button_icon_size',
                [
                    'label'             => __('Icon Size', 'premium-addons-pro'),
                    'type'              => Controls_Manager::SLIDER,
                    'size_units'        => ['px','em','%'],
                    'selectors'         => [
                        '{{WRAPPER}} .premium-button i' => 'font-size: {{SIZE}}{{UNIT}};',
                        ],
                    'condition'         => [
                            'premium_unfold_button_icon_switcher'   => 'yes'
                        ]
                    ]
                );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'              => 'premium_unfold_button_typo',
                'scheme'            => Scheme_Typography::TYPOGRAPHY_1,
                'selector'          => '{{WRAPPER}} .premium-button',
            ]
            );
        
        $this->start_controls_tabs('premium_unfold_button_style_tabs');
        
        $this->start_controls_tab('premium_unfold_button_style_normal',
            [
                'label'             => __('Normal', 'premium-addons-pro'),
            ]
            );
        
        $this->add_control('premium_unfold_button_text_color_normal',
            [
                'label'             => __('Text Color', 'premium-addons-pro'),
                'type'              => Controls_Manager::COLOR,
                'scheme'            => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'         => [
                    '{{WRAPPER}} .premium-button span'   => 'color: {{VALUE}};',
                ]
            ]);
        
        $this->add_control('premium_unfold_button_icon_color_normal',
            [
                'label'             => __('Icon Color', 'premium-addons-pro'),
                'type'              => Controls_Manager::COLOR,
                'scheme'            => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'         => [
                    '{{WRAPPER}} .premium-button i'   => 'color: {{VALUE}};',
                ],
                'condition'         => [
                    'premium_unfold_button_icon_switcher'  => 'yes',
                ]
            ]);
        
        $this->add_control('premium_unfold_button_background_normal',
                [
                    'label'             => __('Background Color', 'premium-addons-pro'),
                    'type'              => Controls_Manager::COLOR,
                    'scheme'            => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors'      => [
                        '{{WRAPPER}} .premium-button'  => 'background-color: {{VALUE}};',
                        ]
                    ]
                );
        
        /*Button Border*/
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_unfold_button_border_normal',
                    'selector'      => '{{WRAPPER}} .premium-button',
                ]
                );
        
        /*Button Border Radius*/
        $this->add_control('premium_unfold_button_border_radius_normal',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-button' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        /*Icon Shadow*/
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'label'         => __('Icon Shadow','premium-addons-pro'),
                    'name'          => 'premium_unfold_button_icon_shadow_normal',
                    'selector'      => '{{WRAPPER}} .premium-button i',
                    'condition'         => [
                            'premium_unfold_button_icon_switcher'  => 'yes',
                        ]
                    ]
                );
        
        /*Text Shadow*/
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'label'         => __('Text Shadow','premium-addons-pro'),
                    'name'          => 'premium_unfold_button_text_shadow_normal',
                    'selector'      => '{{WRAPPER}} .premium-button span',
                    ]
                );
        
        /*Button Shadow*/
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'label'         => __('Button Shadow','premium-addons-pro'),
                    'name'          => 'premium_unfold_button_box_shadow_normal',
                    'selector'      => '{{WRAPPER}} .premium-button',
                ]
                );
        
        /*Button Margin*/
        $this->add_responsive_control('premium_unfold_button_margin_normal',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        /*Button Padding*/
        $this->add_responsive_control('premium_unfold_button_padding_normal',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->end_controls_tab();
        
        $this->start_controls_tab('premium_unfold_button_style_hover',
            [
                'label'             => __('Hover', 'premium-addons-pro'),
            ]
            );
        
        $this->add_control('premium_unfold_button_text_color_hover',
            [
                'label'             => __('Text Color', 'premium-addons-pro'),
                'type'              => Controls_Manager::COLOR,
                'scheme'            => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'         => [
                    '{{WRAPPER}} .premium-button:hover span'   => 'color: {{VALUE}};',
                ],
            ]);
        
        $this->add_control('premium_unfold_button_icon_color_hover',
            [
                'label'             => __('Icon Color', 'premium-addons-pro'),
                'type'              => Controls_Manager::COLOR,
                'scheme'            => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'         => [
                    '{{WRAPPER}} .premium-button:hover i'   => 'color: {{VALUE}};',
                ],
                'condition'         => [
                    'premium_unfold_button_icon_switcher'  => 'yes',
                ]
            ]);
        
        $this->add_control('premium_unfold_button_background_hover',
                [
                    'label'             => __('Background Color', 'premium-addons-pro'),
                    'type'              => Controls_Manager::COLOR,
                    'scheme'            => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_3
                    ],
                    'selectors'          => [
                        '{{WRAPPER}} .premium-button:hover' => 'background-color: {{VALUE}};',
                    ],
                    ]
                );
        
        /*Button Border*/
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_unfold_button_border_hover',
                    'selector'      => '{{WRAPPER}} .premium-button:hover',
                ]
                );
        
        /*Button Border Radius*/
        $this->add_control('premium_unfold_button_border_radius_hover',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-button:hover' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        /*Icon Shadow*/
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'label'         => __('Icon Shadow','premium-addons-pro'),
                    'name'          => 'premium_unfold_button_icon_shadow_hover',
                    'selector'      => '{{WRAPPER}} .premium-button:hover i',
                    'condition'         => [
                            'premium_unfold_button_icon_switcher'  => 'yes',
                        ]
                    ]
                );

        /*Text Shadow*/
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'label'         => __('Text Shadow','premium-addons-pro'),
                    'name'          => 'premium_unfold_button_text_shadow_hover',
                    'selector'      => '{{WRAPPER}} .premium-button:hover span',
                    ]
                );
        
        /*Button Shadow*/
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'label'         => __('Button Shadow','premium-addons-pro'),
                    'name'          => 'premium_unfold_button_box_shadow_hover',
                    'selector'      => '{{WRAPPER}} .premium-button:hover',
                ]
                );
        
        /*Button Margin*/
        $this->add_responsive_control('premium_unfold_button_margin_hover',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-button:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        /*Button Padding*/
        $this->add_responsive_control('premium_unfold_button_padding_hover',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        /*End Button Style Section*/
        $this->end_controls_section();
        
        $this->start_controls_section('premium_unfold_grad_style',
                [
                    'label'         => __('Fade Color', 'premium-addons-pro'),
                    'tab'           => Controls_Manager::TAB_STYLE,
                    'condition'     => [
                        'premium_unfold_sep_switcher'  => 'yes',
                    ]
                ]
                );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_unfold_sep_background',
                    'types'             => [ 'classic' , 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-unfold-gradient',
                    ]
                );
        
        /*Separator Border*/
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_unfold_sep_border',
                    'selector'      => '{{WRAPPER}} .premium-unfold-gradient',
                ]
                );
        
        /*Separator Border Radius*/
        $this->add_control('premium_unfold_sep_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-unfold-gradient' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        /*Separator Padding*/
        $this->add_responsive_control('premium_unfold_sep_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-unfold-gradient' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        
        $this->end_controls_section();
        
    }
    
    protected  function get_unfold_button(){
        $settings = $this->get_settings_for_display();
        $button_size = 'premium-button-' . $settings['premium_unfold_button_size'];
        ?>
        <div class="premium-unfold-button-container">
            <a id='premium-unfold-button-<?php echo esc_attr($this->get_id()); ?>' class="premium-button <?php echo esc_attr($button_size); ?>">
            <?php if($settings['premium_unfold_button_icon_switcher'] && $settings['premium_unfold_button_icon_position'] == 'before' && !empty($settings['premium_unfold_button_icon'])) : ?><i class="premium-unfold-before"></i><?php endif; ?><span id="premium-unfold-button-text-<?php echo esc_attr($this->get_id()); ?>" class="premium-unfold-button-text"></span><?php if($settings['premium_unfold_button_icon_switcher'] && $settings['premium_unfold_button_icon_position'] == 'after' && !empty($settings['premium_unfold_button_icon'])) : ?><i class="premium-unfold-after"></i><?php endif; ?>
            </a>
        </div>
    <?php }


    protected function render($instance = [])
    {
        // get our input from the widget settings.
        $settings = $this->get_settings_for_display();
        
        $this->add_render_attribute( 'premium_unfold_title', 'class', 'premium-unfold-heading' );
        
        $this->add_inline_editing_attributes('premium_unfold_title', 'basic');

        $this->add_render_attribute( 'premium_unfold_content', 'class', 'premium-unfold-editor-content' );
        
        $this->add_inline_editing_attributes('premium_unfold_content', 'advanced');
        
        $button_size = 'premium-button-' . $settings['premium_unfold_button_size'];
        
        $button_icon = $settings['premium_unfold_button_icon'];
        
        $button_icon_unfolded = $settings['premium_unfold_button_icon_unfolded'];
        
        if($settings['premium_unfold_fold_height_select'] == 'percent'){
            $fold_height = $settings['premium_unfold_fold_height'];
        } else {
            $fold_height = $settings['premium_unfold_fold_height_pix'];
        }
        
        
        if($settings['premium_unfold_fold_dur_select'] == 'custom'){
            $fold_dur = $settings['premium_unfold_fold_dur'] * 1000;
        } else {
            $fold_dur = $settings['premium_unfold_fold_dur_select'];
        }
        
        if($settings['premium_unfold_unfold_dur_select'] == 'custom'){
            $unfold_dur = $settings['premium_unfold_unfold_dur'] * 1000;
        } else {
            $unfold_dur = $settings['premium_unfold_unfold_dur_select'] ;
        }
        
        if(!empty($settings['premium_unfold_sep_height'])){
            $sep_height = $settings['premium_unfold_sep_height']['size'] . 'px';
        }
        
        $fold_ease =  $settings['premium_unfold_fold_easing'];
        $unfold_ease =  $settings['premium_unfold_unfold_easing'];
        
        $unfold_settings = [
          'buttonIcon'          => $button_icon,
          'buttonUnfoldIcon'    => $button_icon_unfolded,
          'foldSelect'          => $settings['premium_unfold_fold_height_select'],
          'foldHeight'          => $fold_height,
          'foldDur'             => $fold_dur,
          'unfoldDur'           => $unfold_dur,
          'foldEase'            => $fold_ease,
          'unfoldEase'          => $unfold_ease,
          'foldText'            => $settings['premium_unfold_button_fold_text'],
          'unfoldText'          => $settings['premium_unfold_button_unfold_text'],
        ];
        
        
?>

<div class="premium-unfold-wrap" data-settings='<?php echo wp_json_encode($unfold_settings); ?>'>
    <div class='premium-unfold-container'>
        <div class='premium-unfold-folder'>
            <?php if($settings['premium_unfold_title_switcher'] == 'yes' && !empty($settings['premium_unfold_title'])) : ?>
            <<?php echo $settings['premium_unfold_title_heading'] . ' ' . $this->get_render_attribute_string('premium_unfold_title'); ?>><?php echo $settings['premium_unfold_title']; ?></<?php echo $settings['premium_unfold_title_heading']; ?>>
            <?php endif; ?>
            <div id="premium-unfold-content-<?php echo $this->get_id(); ?>" class="premium-unfold-content toggled">
                <div <?php echo $this->get_render_attribute_string('premium_unfold_content');  ?>><?php echo $this->parse_text_editor($settings['premium_unfold_content']); ?></div>
            </div>
            <?php if($settings['premium_unfold_sep_switcher'] == 'yes') : ?>
            <div id="premium-unfold-gradient-<?php echo esc_attr($this->get_id()); ?>" class="premium-unfold-gradient toggled" style="<?php echo 'height:' . $sep_height; ?>"></div>
            <?php endif; ?>
        </div>
    <?php if($settings['premium_unfold_button_position'] == 'inside') $this->get_unfold_button(); ?>
    </div>
    <?php if($settings['premium_unfold_button_position'] == 'outside') $this->get_unfold_button(); ?>
</div>
    <?php
    }   
}