<?php

/**
 * Class: Premium_Content_Toggle
 * Name: Content Switcher
 * Slug: premium-addon-content-toggle
 */

namespace PremiumAddonsPro\Widgets;

use PremiumAddons\Helper_Functions;
use PremiumAddons\Includes;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Frontend;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Premium_Content_Toggle extends Widget_Base {

    protected $templateInstance;

    public function getTemplateInstance() {
        return $this->templateInstance = Includes\premium_Template_Tags::getInstance();
    }

    public function get_name() {
        return 'premium-addon-content-toggle';
    }
    
    public function get_title() {
		return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Content Switcher', 'premium-addons-pro') );
	}

    public function get_icon() {
        return 'pa-pro-content-switcher';
    }

    public function get_categories() {
        return [ 'premium-elements' ];
    }

    public function get_script_depends(){
        return ['premium-pro-js'];
    }
    
    public function is_reload_preview_required() {
        return true;
    }

    // Adding the controls fields for the Content Switcher
    // This will controls the animation, colors and background, dimensions etc
    protected function _register_controls() {
        
        $this->start_controls_section('premium_content_toggle_headings_section',
            [
                'label'         => __( 'Switcher', 'premium-addons-pro' ),
            ]
        );
        
        $this->add_control('premium_content_toggle_labels_switcher',
            [
                'label'         => __('Show Labels','premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => 'Show',
                'label_off'     => 'Hide',
                'default'       => 'yes',
            ]
        );

        $this->add_control('premium_content_toggle_heading_one',
            [
                'label'         => __( 'First Label', 'premium-addons-pro' ),
                'default'       => __( 'Content #1', 'premium-addons-pro' ),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [
                    'active' => true,
                ],
                'condition'     => [
                    'premium_content_toggle_labels_switcher'    => 'yes'
                ]
            ]
        );

        $this->add_control('premium_content_toggle_heading_two',
            [
                'label'         => __( 'Second Label', 'premium-addons-pro' ),
                'default'       => __( 'Content #2', 'premium-addons-pro' ),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [
                    'active' => true,
                ],
                'condition'     => [
                    'premium_content_toggle_labels_switcher'    => 'yes'
                ]
            ]
        );

        $this->add_control('premium_content_toggle_headings_size',
            [
                'label'         => __( 'HTML Tag', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                ],
                'default'       => 'h3',
                'condition'     => [
                    'premium_content_toggle_labels_switcher'    => 'yes'
                ]
            ]
        );

        $this->add_control('premium_content_toggle_heading_layout',
            [
                'label'         => __( 'Display', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'no'    => __( 'Inline', 'premium-addons-pro' ),
                    'yes'   => __( 'Block', 'premium-addons-pro' ),
                ],
                'default'       => 'no',
                'condition'     => [
                    'premium_content_toggle_labels_switcher'    => 'yes'
                ]
            ]
        );

        $this->add_responsive_control('premium_content_toggle_headings_alignment',
            [
                'label'         => __( 'Alignment', 'premium-addons-pro' ),
                'type'          => Controls_Manager::CHOOSE,
                'default'       => 'center',
                'options'   => [
                    'flex-start' => [
                        'title' => __( 'Left', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __( 'Center', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end'   => [
                        'title' => __( 'Right', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-switcher' => 'justify-content: {{VALUE}};',
                    '{{WRAPPER}} .premium-content-toggle-stack-yes .premium-content-toggle-switcher' =>'align-items: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('premium_content_toggle_first_content_section',
            [
                'label'         => __( 'Content 1', 'premium-addons-pro' ),
            ]
        );

        $this->add_control('premium_content_toggle_first_content_tools', 
            [
                'label'         => __('Content to Show', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'text_editor'           => __('Text Editor', 'premium-addons-pro'),
                    'elementor_templates'   => __('Elementor Template', 'premium-addons-pro'),
                ],
                'default'       => 'text_editor'
            ]
        );

        $this->add_control('premium_content_toggle_first_content_text',
            [ 
                'type'          => Controls_Manager::WYSIWYG,
                'default'       => 'Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cras mattis consectetur purus sit amet fermentum. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec id elit non mi porta gravida at eget metus.',
                'label_block'   => true,
                'dynamic'       => [ 'active' => true ],
                'condition'     => [
                   'premium_content_toggle_first_content_tools'  => 'text_editor',
                ],
            ]
        );
        
        $this->add_responsive_control('premium_content_toggle_first_content_alignment',
            [
                'label'         => __( 'Alignment', 'premium-addons-pro' ),
                'type'          => Controls_Manager::CHOOSE,
                'default'       => 'center',
                'options'       => [
                    'left' => [
                        'title' => __( 'Left', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __( 'Center', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'   => [
                        'title' => __( 'Right', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'justify'   => [
                        'title'=> __( 'Justify', 'premium-addons-pro' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'condition'     => [
                   'premium_content_toggle_first_content_tools'  => 'text_editor',
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-monthly-text' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_control('premium_content_toggle_first_content_templates',
            [
                'label'         => __( 'Elementor Template', 'premium-addons-pro' ),
                'description'   => __( 'Elementor Template is a template which you can choose from Elementor library. Each template will be shown in content', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SELECT2,
                'options'       => $this->getTemplateInstance()->get_elementor_page_list(),
                'label_block'   => true,
                'condition'     => [
                   'premium_content_toggle_first_content_tools'  => 'elementor_templates',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('premium_content_toggle_second_content_section',
            [
                'label'         => __( 'Content 2', 'premium-addons-pro' ),
            ]
        );

        $this->add_control('premium_content_toggle_second_content_tools', 
            [
                'label'         => __('Content', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'text_editor'           => __('Text Editor', 'premium-addons-pro'),
                    'elementor_templates'   => __('Elementor Template', 'premium-addons-pro'),
                ],
                'default'       => 'text_editor'
            ]
        );

        $this->add_control('premium_content_toggle_second_content_text',
            [ 
                'label'         => __('Text Editor', 'premium-addons-pro'),
                'type'          => Controls_Manager::WYSIWYG,
                'dynamic'       => [ 'active' => true ],
                'default'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'label_block'   => true,
                'condition'     => [
                   'premium_content_toggle_second_content_tools'  => 'text_editor',
                ],
            ]
        );
        
        $this->add_responsive_control('premium_content_toggle_second_content_alignment',
            [
                'label'         => __( 'Alignment', 'premium-addons-pro' ),
                'type'          => Controls_Manager::CHOOSE,
                'default'       => 'center',
                'options'       => [
                    'left' => [
                        'title' => __( 'Left', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __( 'Center', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'   => [
                        'title' => __( 'Right', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'justify'   => [
                        'title'=> __( 'Justify', 'premium-addons-pro' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'condition'     => [
                   'premium_content_toggle_second_content_tools'  => 'text_editor',
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-yearly-text' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_control('premium_content_toggle_second_content_templates',
            [
                'label'         => __( 'Elementor Template', 'premium-addons-pro' ),
                'description'=> __( 'Elementor Template is a template which you can choose from Elementor library. Each template will be shown in content', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SELECT2,
                'options'       => $this->getTemplateInstance()->get_elementor_page_list(),
                'label_block'   => true,
                'condition'     => [
                   'premium_content_toggle_second_content_tools'  => 'elementor_templates',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('premium_content_toggle_content_display',
            [
                'label'         => __( 'Display Options', 'premium-addons-pro' ),
            ]
        );

        $this->add_control('premium_content_toggle_animation',
            [
                'label'         => __( 'Animation', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'opacity'       => __('Fade', 'premium-addons-pro'),
                    'fade'          => __('Slide', 'premium-addons-pro'),
                ],
                'default'       => 'opacity',
            ]
        );

        $this->add_control('premium_content_toggle_fade_dir',
            [
                'label'         => __( 'Direction', 'premium-addons-pro' ),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'top'    => [
                        'title'=> __( 'Top', 'premium-addons-pro' ),
                        'icon' => 'fa fa-arrow-down',
                        ],
                    'right'     => [
                        'title'=> __( 'Right', 'premium-addons-pro' ),
                        'icon' => 'fa fa-arrow-left',
                        ],
                    'bottom'     => [
                        'title'=> __( 'Bottom', 'premium-addons-pro' ),
                        'icon' => 'fa fa-arrow-up',
                        ],
                    'left'      => [
                        'title'=> __( 'Left', 'premium-addons-pro' ),
                        'icon' => 'fa fa-arrow-right',
                        ],
                    ],
                'default'       => 'top',
                'condition'     => [
                    'premium_content_toggle_animation'  => 'fade'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'premium_content_toggle_switcher_headings_container_style_section',
            [
                'label'         => __( 'Switcher', 'premium-addons-pro' ),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('premium_content_toggle_swithcer_headings_container_tabs');

        $this->start_controls_tab('premium_content_toggle_switcher_style_tab',
            [
                'label'         => __('Switcher', 'premium-addons-pro'),
            ]
        );

        $this->add_responsive_control('premium_content_toggle_switch_size',
            [
                'label'         => __('Size', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'  => 15
                ],
                'range'         => [
                    'px'    => [
                        'min'   => 1,
                        'max'   => 40
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-button'   =>  'font-size: {{SIZE}}px'
                ]

            ]
        );
        
        
        $this->add_control('premium_content_toggle_switcher_colors_popver',
            [
                'label'         => __('Colors', 'premium-addons-pro'),
                'type'          => Controls_Manager::POPOVER_TOGGLE,
            ]
        );

        $this->start_popover();

        $this->add_control('premium_content_toggle_popover_switch_first_content_color',
            [
                'label'         => __('Switcher Content 1 Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'          => 'premium_content_toggle_switch_normal_background_color',
                'types'         => [ 'classic','gradient' ],
                'selector'      => '{{WRAPPER}} .premium-content-toggle-switch-control:before'
            ]
        );

        $this->add_control('premium_content_toggle_popover_switch_second_content_color',
            [
                'label'         => __('Switcher Content 2 Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'          => 'premium_content_toggle_switch_active_background_color',
                'types'         => [ 'classic','gradient' ],
                'selector'      => '{{WRAPPER}} .premium-content-toggle-switch:checked + .premium-content-toggle-switch-control:before'
            ]
        );

        $this->add_control('premium_content_toggle_popover_switch_background',
            [
                'label'         => __('Switcher Background', 'premium-addons-pro'),
                'type'          => Controls_Manager::HEADING,
            ]
        );

        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'          => 'premium_content_toggle_fieldset_active_background_color',
                'types'         => [ 'classic','gradient' ],
                'selector'      => '{{WRAPPER}} .premium-content-toggle-switch-control'
            ]
        );

        $this->end_popover();
        
        $this->end_popover();

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label'         => __('Switcher Shadow','premium-addons-pro'),
                'name'          => 'premium_content_toggle_switch_box_shadow',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-switch-control:before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label'         => __('Background Shadow','premium-addons-pro'),
                'name'          => 'premium_content_toggle_fieldset_box_shadow',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-switch-control',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('premium_content_toggle_headings_style_tab',
            [
                'label'         => __('Labels', 'premium-addons-pro'),
                'condition'     => [
                    'premium_content_toggle_labels_switcher'    => 'yes'
                ]
            ]
        );

        $this->add_responsive_control('premium_content_toggle_switcher_headings_spacing',
            [
                'label'         => __('Spacing', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'range'     => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 150,
                        'step'  => 1,
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-stack-no .premium-content-toggle-heading-one' => 'margin-right: {{SIZE}}px;',
                    '{{WRAPPER}} .premium-content-toggle-stack-no .premium-content-toggle-heading-two' => 'margin-left: {{SIZE}}px;',
                    '{{WRAPPER}} .premium-content-toggle-stack-yes .premium-content-toggle-heading-one'=> 'margin-bottom: {{SIZE}}px;',
                    '{{WRAPPER}} .premium-content-toggle-stack-yes .premium-content-toggle-heading-two'=> 'margin-top: {{SIZE}}px;'
                ]
            ]
        );

        $this->add_control('premium_content_toggle_left_heading_head',
            [
                'label'         => __('First Label', 'premium-addons-pro'),
                'type'          => Controls_Manager::HEADING,
            ]
        );

        $this->add_control('premium_content_toggle_left_heading_color',
            [
                'label'         => __('Text Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-heading-one *' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'premium_content_toggle_left_heading_typhography',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-heading-one *'
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'          => 'premium_content_toggle_left_heading_text_shadow',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-heading-one *'
            ]
        );

        $this->add_control('premium_content_toggle_left_heading_background_color',
            [
                'label'         => __('Background', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-heading-one *' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'premium_content_toggle_left_heading_border',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-heading-one *',
            ]
        );

        $this->add_control('premium_content_toggle_left_heading_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em' , '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-heading-one *' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'premium_content_toggle_left_heading_box_shadow',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-heading-one *'
            ]
        );

        $this->add_responsive_control('premium_content_toggle_left_headings_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em' , '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-heading-one *' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control('premium_content_toggle_right_heading_head',
            [
                'label'         => __('Second Label', 'premium-addons-pro'),
                'type'          => Controls_Manager::HEADING,
            ]
        );

        $this->add_control('premium_content_toggle_right_heading_color',
            [
                'label'         => __('Text Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-heading-two *' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'premium_content_toggle_right_heading_typhography',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-heading-two *'
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'          => 'premium_content_toggle_right_heading_text_shadow',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-heading-two *'
            ]
        );

        $this->add_control('premium_content_toggle_right_heading_background_color',
            [
                'label'         => __('Background', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-heading-two *' => 'background: {{VALUE}};'
                ]
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'premium_content_right_heading_content_border',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-heading-two *',
            ]
        );

        $this->add_control('premium_content_toggle_right_heading_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em' , '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-heading-two *' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'premium_content_toggle_right_heading_box_shadow',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-heading-two *'
            ]
        );
        
        $this->add_responsive_control('premium_content_toggle_right_heading_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em' , '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-heading-two *' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('premium_content_toggle_container_tab',
            [
                'label'         => __('Container', 'premium-addons-pro'),
            ]
        );

        $this->add_control('premium_content_toggle_switcher_container_background_color',
            [
                'label'         => __('Background', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-switcher' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'premium_content_toggle_switcher_container_border',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-switcher',
            ]
        );

        $this->add_control('premium_content_toggle_switcher_container_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em' , '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-switcher' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'premium_content_toggle_switcher_container_box_shadow',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-switcher'
            ]
        );

        $this->add_responsive_control('premium_content_toggle_switcher_container_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em' , '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-switcher' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_responsive_control('premium_content_toggle_switcher_container_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em' , '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-switcher' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('premium_content_toggle_content_style_section',
            [
                'label'         => __( 'Content', 'premium-addons-pro' ),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control('premium_content_toggle_two_content_height',
            [
                'label'         => __('Height', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em' , '%'],
                'range'     => [
                    'px'    => [
                        'min'   => 0,
                        'step'  => 1,
                        'max'   => 1000
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-container .premium-content-toggle-two-content > li' => 'min-height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->start_controls_tabs('premium_content_toggle_content_style_tabs');

        $this->start_controls_tab('premium_content_toggle_first_content_style_tab',
            [
                'label'         => __('First Content', 'premium-addons-pro'),
            ]
        );

        $this->add_control('premium_content_toggle_first_content_color',
            [
                'label'         => __('Text Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-monthly-text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .premium-content-toggle-monthly-text *' => 'color: {{VALUE}};'
                ],
                'condition'     => [
                   'premium_content_toggle_first_content_tools'  => 'text_editor',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'premium_content_toggle_first_content_typhography',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-monthly-text',
                'condition'     => [
                   'premium_content_toggle_first_content_tools'  => 'text_editor',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'          => 'premium_content_toggle_first_content_text_shadow',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-monthly-text',
                'condition'     => [
                   'premium_content_toggle_first_content_tools'  => 'text_editor',
                ],
            ]
        );

        $this->add_control('premium_content_toggle_first_content_background_color',
            [
                'label'         => __('Background', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-monthly' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'premium_content_toggle_first_content_border',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-monthly',
            ]
        );

        $this->add_control('premium_content_toggle_first_content_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em' , '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-monthly' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'premium_content_toggle_first_content_box_shadow',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-monthly'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('premium_content_toggle_second_content_style_tab',
            [
                'label'         => __('Second Content', 'premium-addons-pro'),
            ]
        );

        $this->add_control('premium_content_toggle_second_content_color',
            [
                'label'         => __('Text Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-yearly-text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .premium-content-toggle-yearly-text *' => 'color: {{VALUE}};'
                ],
                'condition'     => [
                   'premium_content_toggle_second_content_tools'  => 'text_editor',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'premium_content_toggle_second_content_typhography',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-yearly-text',
                'condition'     => [
                   'premium_content_toggle_second_content_tools'  => 'text_editor',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'          => 'premium_content_toggle_second_content_text_shadow',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-yearly-text',
                'condition'     => [
                   'premium_content_toggle_second_content_tools'  => 'text_editor',
                ],
            ]
        );

        $this->add_control('premium_content_toggle_second_content_background_color',
            [
                'label'         => __('Background', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-yearly' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'premium_content_toggle_second_content_border',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-yearly',
            ]
        );

        $this->add_control('premium_content_toggle_second_content_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em' , '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-yearly' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'premium_content_toggle_second_content_box_shadow',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-yearly'
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->add_responsive_control('premium_content_toggle_contents_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em' , '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator'     => 'before'
            ]
        );

        $this->add_responsive_control('premium_content_toggle_contents_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em' , '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-monthly, {{WRAPPER}} .premium-content-toggle-yearly' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section('premium_content_toggle_container_style',
            [
                'label'         => __('Container', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'      => 'premium_content_toggle_container_background',
                    'types'     => [ 'classic', 'gradient' ],
                    'selector'  => '{{WRAPPER}} .premium-content-toggle-container',
                ]
                );

        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'premium_content_toggle_container_border',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-container',
            ]
        );

        $this->add_control('premium_content_toggle_container_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-container' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'premium_content_toggle_container_box_shadow',
                'selector'      => '{{WRAPPER}} .premium-content-toggle-container',
            ]
        );

        $this->add_responsive_control('premium_content_toggle_container_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );
        
        $this->add_responsive_control('premium_content_toggle_container_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-content-toggle-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );
        
        $this->end_controls_section();
    }

    /**
	 * renders the HTML content of the widget
	 * @return void
	 */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        
        if ( 'opacity' == $settings['premium_content_toggle_animation'] ) {
            
            $animation  = 'opacity';
            
        } else if ( 'fade' == $settings['premium_content_toggle_animation'] ) {
            
            $animation  = 'fade-' . $settings['premium_content_toggle_fade_dir'];
            
        }

        $this->add_inline_editing_attributes( 'premium_content_toggle_heading_one', 'basic' );

        $this->add_inline_editing_attributes( 'premium_content_toggle_heading_two', 'basic' );
        
        $this->add_inline_editing_attributes('premium_content_toggle_first_content_text', 'advanced');
        
        $this->add_inline_editing_attributes('premium_content_toggle_second_content_text', 'advanced');
        
        $this->add_render_attribute('premium_content_toggle_first_content_text', 'class', 'premium-content-toggle-monthly-text');
        
        $this->add_render_attribute('premium_content_toggle_second_content_text', 'class', 'premium-content-toggle-yearly-text');

    ?>

    <div class="premium-content-toggle-container premium-content-toggle-container-<?php echo esc_attr($this->get_id()); ?> <?php if ( $settings['premium_content_toggle_heading_layout'] === 'yes' ) {echo 'premium-content-toggle-stack-yes';} else { echo 'premium-content-toggle-stack-no';
}?>">
        <div class="premium-content-toggle-switcher">
            <?php if( 'yes' == $settings['premium_content_toggle_labels_switcher'] ) : ?>
            
                <div class="premium-content-toggle-heading-one">
                    <<?php echo $settings['premium_content_toggle_headings_size']; ?> <?php echo $this->get_render_attribute_string( 'premium_content_toggle_heading_one' ); ?>><?php echo esc_html( $settings['premium_content_toggle_heading_one'] ); ?></<?php echo $settings['premium_content_toggle_headings_size']; ?>>
                </div>
            
            <?php endif; ?>
            
            <div class="premium-content-toggle-button">
                <label class="premium-content-toggle-switch-label">
                    <input class="premium-content-toggle-switch premium-content-toggle-switch-normal elementor-clickable" type="checkbox">
                    <span class="premium-content-toggle-switch-control elementor-clickable"></span>
                </label>
            </div>
            
            <?php if( 'yes' == $settings['premium_content_toggle_labels_switcher'] ) : ?>
            
                <div class="premium-content-toggle-heading-two">
                    <<?php echo $settings['premium_content_toggle_headings_size']; ?> <?php echo $this->get_render_attribute_string( 'premium_content_toggle_heading_two' ); ?>><?php echo esc_attr( $settings['premium_content_toggle_heading_two'] ); ?></<?php echo $settings['premium_content_toggle_headings_size']; ?>>
                </div>
            
            <?php endif; ?>
            
        </div>
        
        <div class="premium-content-toggle-list <?php echo esc_attr( $animation ); ?>">
            <ul class="premium-content-toggle-two-content">
                <li data-type="premium-content-toggle-monthly" class="premium-content-toggle-is-visible premium-content-toggle-monthly">
                    <?php if ( 'text_editor' == $settings['premium_content_toggle_first_content_tools'] ) : ?>
                    
                        <div <?php echo $this->get_render_attribute_string('premium_content_toggle_first_content_text'); ?>>
                        <?php echo $this->parse_text_editor( $settings['premium_content_toggle_first_content_text'] ); ?>
                        </div>
                    
                    <?php elseif ( 'elementor_templates' == $settings['premium_content_toggle_first_content_tools'] ) :
                        $first_content_page_id =  $settings['premium_content_toggle_first_content_templates'];
                    
                        $first_content = new Frontend;  
                    ?>
                    
                    <div class="premium-content-toggle-first-content-item-wrapper">
                        <?php echo $first_content->get_builder_content($first_content_page_id, true); ?>
                    </div>
                    
                    <?php endif; ?>
                </li>
                
                <li data-type="premium-content-toggle-yearly" class="premium-content-toggle-is-hidden premium-content-toggle-yearly">
                    <?php if ( 'text_editor' == $settings['premium_content_toggle_second_content_tools'] ) : ?>
                    
                        <div <?php echo $this->get_render_attribute_string('premium_content_toggle_second_content_text'); ?>>
                            <?php echo $this->parse_text_editor( $settings['premium_content_toggle_second_content_text'] ); ?>
                        </div>
                    
                    <?php elseif ( 'elementor_templates' == $settings['premium_content_toggle_second_content_tools'] ) :
                        $second_content_page_id = $settings['premium_content_toggle_second_content_templates'];

                        $second_content = new Frontend;
                    ?>
                    
                    <div class="premium-content-toggle-second-content-item-wrapper">
                        <?php echo $second_content->get_builder_content($second_content_page_id, true); ?>
                    </div>
                    
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
    
<?php
    }
}