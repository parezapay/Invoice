<?php

namespace PremiumAddonsPro\Widgets;

use PremiumAddons\Helper_Functions;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Premium_Image_Comparison extends Widget_Base {

    public function get_name() {
        return 'premium-addon-image-comparison';
    }

    public function is_reload_preview_required() {
        return true;
    }

    public function get_title() {
		return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Image Comparison', 'premium-addons-pro') );
	}

    public function get_icon() {
        return 'pa-pro-image-comparison';
    }

    public function get_script_depends() {
        return [
            'imagesloaded',
            'event-move',
            'pa-imgcompare',
            'premium-pro-js'
        ];
    }

    public function get_categories() {
        return [ 'premium-elements' ];
    }

    // Adding the controls fields for the premium image comparison
    // This will controls the animation, colors and background, dimensions etc
    protected function _register_controls() {

        $this->start_controls_section('premium_img_compare_original_image_section',
            [
                'label' => __( 'Original Image', 'premium-addons-pro' ),
            ]
        );

        $this->add_control('premium_image_comparison_original_image',
            [
                'label' => __( 'Choose Image', 'premium-addons-pro' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic'       => [ 'active' => true ],
                'description'   => __('It\'s recommended to use two images that have the same size','premium-addons-pro'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block'   => true
            ]
        );

        $this->add_control('premium_img_compare_original_img_label_switcher', 
            [
                'label'         => __('Label', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes'
            ]
        );

        $this->add_control('premium_img_compare_original_img_label',
            [
                'label' => __( 'Text', 'premium-addons-pro' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Before', 'premium-addons-pro' ),
                'placeholder'   => 'Before',
                'condition'     => [
                   'premium_img_compare_original_img_label_switcher'  => 'yes',
                ],
                'label_block' => true
            ]
        );
        
        $this->add_control('premium_img_compare_original_hor_label_position',
                [
                    'label'         => __('Horizontal Position', 'premium-addons-pro'),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'       => [
                        'left'  => [
                            'title'     => __('Left', 'premium-addons-pro'),
                            'icon'      => 'fa fa-align-left'
                        ],
                        'center'  => [
                            'title'     => __('Center', 'premium-addons-pro'),
                            'icon'      => 'fa fa-align-center'
                        ],
                        'right'  => [
                            'title'     => __('Right', 'premium-addons-pro'),
                            'icon'      => 'fa fa-align-right'
                        ],
                    ],
                    'condition'     => [
                        'premium_img_compare_original_img_label_switcher'  => 'yes',
                        'premium_image_comparison_orientation'          => 'vertical'
                    ],
                    'default'       => 'center',
                    'label_block'   => true,
                ]
                );

        $this->add_responsive_control('premium_img_compare_original_label_horizontal_offset',
            [
                'label'     	=> __('Horizontal Offset', 'premium-addons-pro'),
                'type'      	=> Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em','%'],
                'range'         => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 300
                    ],
                ],
                'condition'     => [
                   'premium_img_compare_original_img_label_switcher'  => 'yes',
                    'premium_image_comparison_orientation'          => 'horizontal'
                ],
                'selectors' => [
                    '{{WRAPPER}} .premium-twentytwenty-horizontal .premium-twentytwenty-before-label' => 'left: {{SIZE}}{{UNIT}};'
                ]
            ]  
        );
        
        $this->add_control('premium_img_compare_original_label_position',
                [
                    'label'         => __('Vertical Position', 'premium-addons-pro'),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'           => [
                        'top'    => [
                            'title' => __( 'Top', 'premium-addons-pro' ),
                            'icon'  => 'fa fa-arrow-circle-up',
                        ],
                        'middle' => [
                            'title' => __( 'Middle', 'premium-addons-pro' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'bottom' => [
                            'title' => __( 'Bottom', 'premium-addons-pro' ),
                            'icon'  => 'fa fa-arrow-circle-down',
                        ],
                    ],
                    'condition'     => [
                        'premium_img_compare_original_img_label_switcher'  => 'yes',
                        'premium_image_comparison_orientation'          => 'horizontal'
                    ],
                    'default'       => 'middle',
                    'label_block'   => true,
                ]
                );
        
        $this->add_responsive_control('premium_img_compare_original_label_vertical_offset',
            [
                'label'     	=> __('Vertical Offset', 'premium-addons-pro'),
                'type'      	=> Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em','%'],
                'range'         => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 300
                    ],
                ],
                'condition'     => [
                   'premium_img_compare_original_img_label_switcher'  => 'yes',
                    'premium_image_comparison_orientation'          => 'vertical'
                ],
                'selectors' => [
                    '{{WRAPPER}} .premium-twentytwenty-vertical .premium-twentytwenty-before-label' => 'top: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        
        $this->end_controls_section();

        
        $this->start_controls_section('premium_image_comparison_modified_image_section',
            [
                'label' => __( 'Modified Image', 'premium-addons-pro' ),
            ]
        );

        $this->add_control('premium_image_comparison_modified_image',
            [
                'label' => __( 'Choose Image', 'premium-addons-pro' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic'       => [ 'active' => true ],
                'description'   => __('It\'s recommended to use two images that have the same size','premium-addons-pro'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block'   => true
            ]
        );

        $this->add_control('premium_image_comparison_modified_image_label_switcher', 
            [
                'label'         => __('Label', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes'
            ]
        );

        $this->add_control('premium_image_comparison_modified_image_label',
            [
                'label' => __( 'Text', 'premium-addons-pro' ),
                'type' => Controls_Manager::TEXT,
                'placeholder'   => 'After',
                'default' => __( 'After', 'premium-addons-pro' ),
                'condition'     => [
                   'premium_image_comparison_modified_image_label_switcher'  => 'yes',
                ],
                'label_block' => true
            ]
        );
        
        $this->add_control('premium_img_compare_modified_hor_label_position',
                [
                    'label'         => __('Horizontal Position', 'premium-addons-pro'),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'       => [
                        'left'  => [
                            'title'     => __('Left', 'premium-addons-pro'),
                            'icon'      => 'fa fa-align-left'
                        ],
                        'center'  => [
                            'title'     => __('Center', 'premium-addons-pro'),
                            'icon'      => 'fa fa-align-center'
                        ],
                        'right'  => [
                            'title'     => __('Right', 'premium-addons-pro'),
                            'icon'      => 'fa fa-align-right'
                        ],
                    ],
                    'condition'     => [
                        'premium_image_comparison_modified_image_label_switcher'  => 'yes',
                        'premium_image_comparison_orientation'          => 'vertical'
                    ],
                    'default'       => 'center',
                    'label_block'   => true,
                ]
                );

        $this->add_responsive_control('premium_img_compare_modified_label_horizontal_offset',
            [
                'label'     	=> __('Horizontal Offset', 'premium-addons-pro'),
                'type'      	=> Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em','%'],
                'range'         => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 300
                    ],
                ],
                'condition'     => [
                   'premium_image_comparison_modified_image_label_switcher'  => 'yes',
                    'premium_image_comparison_orientation'          => 'horizontal'
                ],
                'selectors' => [
                    '{{WRAPPER}} .premium-twentytwenty-horizontal .premium-twentytwenty-after-label' => 'right: {{SIZE}}{{UNIT}};',
                ]
            ]  
        );

        $this->add_control('premium_img_compare_modified_label_position',
                [
                    'label'         => __('Vertical Position', 'premium-addons-pro'),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'           => [
                        'top'    => [
                            'title' => __( 'Top', 'premium-addons-pro' ),
                            'icon'  => 'fa fa-arrow-circle-up',
                        ],
                        'middle' => [
                            'title' => __( 'Middle', 'premium-addons-pro' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'bottom' => [
                            'title' => __( 'Bottom', 'premium-addons-pro' ),
                            'icon'  => 'fa fa-arrow-circle-down',
                        ],
                    ],
                    'condition'     => [
                        'premium_image_comparison_modified_image_label_switcher'  => 'yes',
                        'premium_image_comparison_orientation'          => 'horizontal'
                    ],
                    'default'       => 'middle',
                    'label_block'   => true,
                ]
            );
        
        $this->add_responsive_control('premium_img_compare_modified_label_vertical_offset',
            [
                'label'     	=> __('Vertical Offset', 'premium-addons-pro'),
                'type'      	=> Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em','%'],
                'range'         => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 300
                    ],
                ],
                'condition'     => [
                   'premium_image_comparison_modified_image_label_switcher'  => 'yes',
                    'premium_image_comparison_orientation'          => 'vertical'
                ],
                'selectors' => [
                    '{{WRAPPER}} .premium-twentytwenty-vertical .premium-twentytwenty-after-label' => 'bottom: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();
        
        
        $this->start_controls_section('premium_img_compare_display_options',
            [
                'label' => __( 'Display Options', 'premium-addons-pro' ),
            ]
        );
        
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
                [
                    'name' => 'prmium_img_compare_images_size', 
                    'default' => 'full',
                    ]
                );
        
        $this->add_control('premium_image_comparison_orientation',
            [
                'label'         => __('Orientation', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'horizontal'    => __('Vertical', 'premium-addons-pro' ),
                    'vertical'      => __('Horizontal', 'premium-addons-pro' )
                ],
                'default'       => 'horizontal',
                'label_block'   => true,
            ]
        );

        $this->add_control('premium_img_compare_visible_ratio',
            [
                'label'   => __( 'Visible Ratio', 'premium-addons-pro' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 0.5,
                'min'     => 0,
                'step'    => 0.1,
                'max'     => 1,
            ]
        );

        $this->add_control('premium_image_comparison_add_drag_handle',
            [
                'label'         => __('Show Drag Handle','premium-addons-pro'),
                'description'   => __('Show drag handle between the images', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'label_on'      => 'Show',
                'label_off'     => 'Hide',
            ]
        );
        
        $this->add_control('premium_image_comparison_add_separator',
            [
                'label'         => __('Show Separator','premium-addons-pro'),
                'description'   => __('Show separator between the images', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => 'Show',
                'label_off'     => 'Hide',
                'condition'     => [
                    'premium_image_comparison_add_drag_handle'  => 'yes'
                ]
            ]
        );
        
        $this->add_control('premium_image_comparison_interaction_mode',
            [
                'label'         => __('Interaction Mode', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'mousemove'     => __('Mouse Move','premium-addons-pro'),
                    'drag'          => __('Mouse Drag','premium-addons-pro'),
                    'click'         => __('Mouse Click','premium-addons-pro'),
                ],
                'default'       => 'mousemove',
                'label_block'   => true,
            ]
        );
        
        $this->add_control('premium_image_comparison_overlay',
            [
                'label'         => __('Overlay Color','premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => 'Show',
                'label_off'     => 'Hide',
                
            ]
        );

        $this->end_controls_section();

        
        $this->start_controls_section('premium_img_compare_original_img_label_style_tab',
            [
                'label'         => __('First Label', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'premium_img_compare_original_img_label_switcher'  => 'yes'
                ]
            ]
        );
        
        $this->add_control('premium_image_comparison_original_label_color',
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-twentytwenty-before-label span'   => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'premium_image_comparison_original_label_typo',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .premium-twentytwenty-before-label span',
            ]
        );
        
        $this->add_control('premium_image_comparison_original_label_background_color',
            [
                'label'         => __('Background Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-twentytwenty-before-label span'  => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'premium_image_comparison_original_label_border',
                'selector'      => '{{WRAPPER}} .premium-twentytwenty-before-label span',
            ]
        );

        $this->add_control('premium_image_comparison_original_label_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em' , '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-twentytwenty-before-label span' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'premium_image_comparison_original_label_box_shadow',
                'selector'      => '{{WRAPPER}} .premium-twentytwenty-before-label span',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'              => 'premium_image_comparison_original_label_text_shadow',
                'label'             => __('Shadow','premium-addons-pro'),
                'selector'          => '{{WRAPPER}} .premium-twentytwenty-before-label span',
            ]
        );

        $this->add_responsive_control('premium_image_comparison_original_label_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-twentytwenty-before-label span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );

        $this->end_controls_section();

        $this->start_controls_section('premium_image_comparison_modified_image_label_style_tab',
            [
                'label'         => __('Second Label', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'premium_image_comparison_modified_image_label_switcher'  => 'yes',
                ]
            ]
        );
        
        $this->add_control('premium_image_comparison_modified_label_color',
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-twentytwenty-after-label span'   => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'premium_image_comparison_modified_label_typo',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .premium-twentytwenty-after-label span',
            ]
        );
        
        $this->add_control('premium_image_comparison_modified_label_background_color',
            [
                'label'         => __('Background Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-twentytwenty-after-label span'  => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'premium_image_comparison_modified_label_border',
                'selector'      => '{{WRAPPER}} .premium-twentytwenty-after-label span',
            ]
        );

        $this->add_control('premium_image_comparison_modified_label_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em' , '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-twentytwenty-after-label span' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'premium_image_comparison_modified_label_box_shadow',
                'selector'      => '{{WRAPPER}} .premium-twentytwenty-after-label span',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'              => 'premium_image_comparison_modified_label_text_shadow',
                'label'             => __('Shadow','premium-addons-pro'),
                'selector'          => '{{WRAPPER}} .premium-twentytwenty-after-label span',
            ]
        );

        $this->add_responsive_control('premium_image_comparison_modified_label_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-twentytwenty-after-label span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );

        $this->end_controls_section();
        
        $this->start_controls_section('premium_image_comparison_drag_style_settings',
            [
                'label'         => __('Drag', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                   'premium_image_comparison_add_drag_handle'  => 'yes',
                ],
            ]
        );
        
        $this->add_responsive_control('premium_image_comparison_drag_width',
            [
                'label'         => __('Width', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'description'   => __('Enter Drag width in (PX), default is 50px', 'premium-addons-pro'),
                'size_units'    => ['px', 'em'],
                'label_block'   => true,
                'selectors'     => [
                    '{{WRAPPER}} .premium-twentytwenty-handle' => 'width:{{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control('premium_image_comparison_drag_height',
            [
                'label'         => __('Height', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 300,
                    ]
                ],
                'description'   => __('Enter Drag height in (PX), default is 50px', 'premium-addons-pro'),
                'size_units'    => ['px','em'],
                'label_block'   => true,
                'selectors'     => [
                    '{{WRAPPER}} .premium-twentytwenty-handle' => 'height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control('premium_image_comparison_drag_background_color',
            [
                'label'         => __('Background Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-twentytwenty-handle'  => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'premium_image_comparison_drag_border',
                'selector'      => '{{WRAPPER}} .premium-twentytwenty-handle',
            ]
        );

        $this->add_control('premium_image_comparison_drag_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-twentytwenty-handle' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'premium_image_comparison_drag_box_shadow',
                'selector'      => '{{WRAPPER}} .premium-twentytwenty-handle',
            ]
        );

        $this->add_responsive_control('premium_image_comparison_drag_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-twentytwenty-handle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );

        $this->end_controls_section();

        $this->start_controls_section('premium_image_comparison_arrow_style',
            [
                'label'         => __('Arrows', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                   'premium_image_comparison_add_drag_handle'  => 'yes',
                ],
            ]
        );

        $this->add_responsive_control('premium_image_comparison_arrows_size',
            [
                'label'         => __('Size', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'label_block'   => true,
                'selectors'     => [
                    '{{WRAPPER}} .premium-twentytwenty-left-arrow' => 'border: {{SIZE}}px inset transparent; border-right: {{SIZE}}px solid; margin-top: -{{size}}px',
                    '{{WRAPPER}} .premium-twentytwenty-right-arrow' => 'border: {{SIZE}}px inset transparent; border-left: {{SIZE}}px solid; margin-top: -{{size}}px',
                    '{{WRAPPER}} .premium-twentytwenty-down-arrow' => 'border: {{SIZE}}px inset transparent; border-top: {{SIZE}}px solid; margin-left: -{{size}}px',
                    '{{WRAPPER}} .premium-twentytwenty-up-arrow' => 'border: {{SIZE}}px inset transparent; border-bottom: {{SIZE}}px solid; margin-left: -{{size}}px',
                ]
            ]
        );

        $this->add_control('premium_image_comparison_arrows_color',
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-twentytwenty-left-arrow' => 'border-right-color: {{VALUE}}',
                    '{{WRAPPER}} .premium-twentytwenty-right-arrow' => 'border-left-color: {{VALUE}}',
                    '{{WRAPPER}} .premium-twentytwenty-down-arrow' => 'border-top-color: {{VALUE}};',
                    '{{WRAPPER}} .premium-twentytwenty-up-arrow' => 'border-bottom-color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section('premium_img_compare_separator_style_settings',
            [
                'label'         => __('Separator', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                   'premium_image_comparison_add_drag_handle'  => 'yes',
                    'premium_image_comparison_add_separator'    => 'yes'
                ],
            ]
        );
        
        $this->add_control('premium_img_compare_separator_background_color',
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-twentytwenty-handle:after, {{WRAPPER}} .premium-twentytwenty-handle:before'  => 'background-color: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_responsive_control('premium_img_compare_separator_spacing',
            [
                'label'         => __('Spacing', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 200,
                    ]
                ],
                'label_block'   => true,
                'selectors'     => [
                    '{{WRAPPER}} .premium-twentytwenty-horizontal .premium-twentytwenty-handle:after' => 'top: {{SIZE}}%;',
                    '{{WRAPPER}} .premium-twentytwenty-horizontal .premium-twentytwenty-handle:before' => 'bottom: {{SIZE}}%;',
                    '{{WRAPPER}} .premium-twentytwenty-vertical .premium-twentytwenty-handle:after' => 'right: {{SIZE}}%;',
                    '{{WRAPPER}} .premium-twentytwenty-vertical .premium-twentytwenty-handle:before' => 'left: {{SIZE}}%;'
                ]
            ]
        );
        
        $this->add_responsive_control('premium_img_compare_separator_width',
            [
                'label'         => __('Height', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em'],
                'label_block'   => true,
                'selectors'     => [
                    '{{WRAPPER}} .premium-twentytwenty-vertical .premium-twentytwenty-handle:before,{{WRAPPER}} .premium-twentytwenty-vertical .premium-twentytwenty-handle:after' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition'     => [
                   'premium_image_comparison_add_drag_handle'   => 'yes',
                    'premium_image_comparison_add_separator'    => 'yes',
                    'premium_image_comparison_orientation'      => 'vertical'
                ],
            ]
        );

        $this->add_responsive_control('premium_img_compare_separator_height',
            [
                'label'         => __('Width', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'label_block'   => true,
                'selectors'     => [
                    '{{WRAPPER}} .premium-twentytwenty-horizontal .premium-twentytwenty-handle:after,{{WRAPPER}} .premium-twentytwenty-horizontal .premium-twentytwenty-handle:before' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'     => [
                   'premium_image_comparison_add_drag_handle'   => 'yes',
                    'premium_image_comparison_add_separator'    => 'yes',
                    'premium_image_comparison_orientation'      => 'horizontal'
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'premium_img_compare_separator_shadow',
                'selector'      => '{{WRAPPER}} .premium-twentytwenty-handle:after,{{WRAPPER}} .premium-twentytwenty-handle:before',
            ]
        );

        $this->end_controls_section();

         
        $this->start_controls_section('premium_image_comparison_contents_wrapper_style_settings',
            [
                'label'         => __('Container', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control('premium_image_comparison_overlay_background',
            [
                'label'         => __('Overlay Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .premium-twentytwenty-overlay.premium-twentytwenty-show:hover'  => 'background: {{VALUE}};'
                ],
                'condition'     => [
                    'premium_image_comparison_overlay'  => 'yes'
                ]
            ]
        );
       
        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'premium_image_comparison_contents_wrapper_border',
                'selector'      => '{{WRAPPER}} .premium-images-compare-container',
            ]
        );

        $this->add_control('premium_image_comparison_contents_wrapper_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-images-compare-container' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'premium_image_comparison_contents_wrapper_box_shadow',
                'selector'      => '{{WRAPPER}} .premium-images-compare-container',
            ]
        );

        $this->add_responsive_control('premium_image_comparison_contents_wrapper_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-images-compare-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );
        
        $this->end_controls_section();

    }

    protected function render() {
        // get our input from the widget settings.
        $settings = $this->get_settings_for_display();
            
        $original_image = $settings['premium_image_comparison_original_image'];

        $modified_image = $settings['premium_image_comparison_modified_image'];

        $original_image_src = Group_Control_Image_Size::get_attachment_image_src( $original_image['id'], 'prmium_img_compare_images_size', $settings );
        
        $original_image_src = empty($original_image_src) ? $original_image['url'] : $original_image_src;
        
        $modified_image_src = Group_Control_Image_Size::get_attachment_image_src( $modified_image['id'], 'prmium_img_compare_images_size', $settings );
        
        $modified_image_src = empty($modified_image_src) ? $modified_image['url'] : $modified_image_src;
        

        $img_compare_setttings = [
            'orientation'      => $settings['premium_image_comparison_orientation'],
            'visibleRatio'     => !empty($settings['premium_img_compare_visible_ratio']) ? $settings['premium_img_compare_visible_ratio'] : 0.1,
            'switchBefore'      => ($settings['premium_img_compare_original_img_label_switcher'] == 'yes') ? true: false,
            'beforeLabel'       => ($settings['premium_img_compare_original_img_label_switcher'] == 'yes' && !empty($settings['premium_img_compare_original_img_label'])) ? $settings['premium_img_compare_original_img_label'] : '',
            'switchAfter'       => ($settings['premium_image_comparison_modified_image_label_switcher'] == 'yes') ? true: false,
            'afterLabel'        => ($settings['premium_image_comparison_modified_image_label_switcher'] == 'yes' && !empty($settings['premium_image_comparison_modified_image_label'])) ? $settings['premium_image_comparison_modified_image_label'] : '',
            'mouseMove'         => ($settings['premium_image_comparison_interaction_mode'] == 'mousemove') ? true: false,
            'clickMove'         => ($settings['premium_image_comparison_interaction_mode'] == 'click') ? true: false,
            'showDrag'          => ($settings['premium_image_comparison_add_drag_handle'] == 'yes') ? true : false,
            'showSep'           => ($settings['premium_image_comparison_add_separator'] == 'yes') ? true : false,
            'overlay'           => ($settings['premium_image_comparison_overlay'] == 'yes') ? false : true,
            'beforePos'         => $settings['premium_img_compare_original_label_position'],
            'afterPos'          => $settings['premium_img_compare_modified_label_position'],
            'verbeforePos'      => $settings['premium_img_compare_original_hor_label_position'],
            'verafterPos'       => $settings['premium_img_compare_modified_hor_label_position'],            
        ];
        
        $this->add_render_attribute('image-compare', 'id', 'premium-image-comparison-contents-wrapper-' . $this->get_id() );
        
        $this->add_render_attribute('image-compare', 'class', [ 'premium-images-compare-container', 'premium-twentytwenty-container' ] );
        
        $this->add_render_attribute('image-compare', 'data-settings', wp_json_encode( $img_compare_setttings ) );
        
        $this->add_render_attribute('first-image', 'src', $original_image_src );
        
        $this->add_render_attribute('second-image', 'src', $modified_image_src );
        
        $this->add_render_attribute('first-image', 'alt', $settings['premium_img_compare_original_img_label'] );
        
        $this->add_render_attribute('second-image', 'alt', $settings['premium_image_comparison_modified_image_label'] );
    ?>

    <div class="premium-image-comparison-contents-wrapper premium-twentytwenty-wrapper">
        <div <?php echo $this->get_render_attribute_string('image-compare'); ?>>
            <img <?php echo $this->get_render_attribute_string('first-image'); ?>>
            <img <?php echo $this->get_render_attribute_string('second-image'); ?>>
        </div>
    </div>
    
<?php

    }
}