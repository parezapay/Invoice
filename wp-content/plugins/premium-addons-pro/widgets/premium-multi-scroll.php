<?php

/**
 * Class: Premium_Multi_Scroll
 * Name: Multi Scroll Widget
 * Slug: premium-multi-scroll
 */

namespace PremiumAddonsPro\Widgets;

use PremiumAddons\Helper_Functions;
use PremiumAddons\Includes;
use Elementor\Widget_Base;
use Elementor\Frontend;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

use Elementor\Core\Responsive\Responsive;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Premium_Multi_Scroll extends Widget_Base {
    
    public function getTemplateInstance() {
        return $this->templateInstance = Includes\premium_Template_Tags::getInstance();
    }
    
    public function get_name() {
        return 'premium-multi-scroll';
    }
    
    public function get_title() {
        return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Multi Scroll', 'premium-addons-pro') );
    }
    
    public function get_icon() {
     return 'pa-pro-multi-scroll';
    }
    
    public function get_categories() {
        return [ 'premium-elements' ];
    }
    
    public function get_script_depends() {
        return [
            'multi-scroll',
            'premium-pro-js'
        ];
    }
    
    public function is_reload_preview_required() {
        return true;
    }
    
    public function check_rtl(){
        return is_rtl();
    }
    
    protected function get_repeater_controls( $repeater, $condition = [] ) {
        
        $repeater->add_control('notice', 
            [
                'label'         => __('Names are reversed in RTL mode', 'premium-addons-pro'),
                'type'          => Controls_Manager::HEADING,
            ]
        );
        
        $repeater->add_control('left_content', 
            [
                'label'         => __('Left Content', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'text'   => __('Text Editor', 'premium-addons-pro'),
                    'temp'   => __('Elementor Template', 'premium-addons-pro'),
                ],
                'default'       => 'temp'
            ]
        );

        $repeater->add_control('left_side_text',
            [ 
                'type'          => Controls_Manager::WYSIWYG,
                'default'       => 'Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cras mattis consectetur purus sit amet fermentum. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec id elit non mi porta gravida at eget metus.',
                'label_block'   => true,
                'dynamic'       => [ 'active' => true ],
                'condition'     => [
                   'left_content'  => 'text',
                ],
            ]
        );
        
        $repeater->add_control('left_side_template',
		  	[
		     	'label'			=> __( 'Left Template', 'premium-addons-pro' ),
		     	'type'          => Controls_Manager::SELECT2,
		     	'options'       => $this->getTemplateInstance()->get_elementor_page_list(),
		     	'multiple'      => false,
                'condition'     => [
                    'left_content'     => 'temp'     
                ]
		  	]
		);
        
        $repeater->add_control('hide_left_section_tabs',
            [
                'label'         => __('Hide on Tabs', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('This option works only when multiscroll disabled on tablets', 'premium-addons-pro'),
            ]
        );
        
        $repeater->add_control('hide_left_section_mobs',
            [
                'label'         => __('Hide on Mobiles', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('This option works only when multiscroll disabled on mobiles', 'premium-addons-pro'),
            ]
        );
        
        $repeater->add_control('right_content', 
            [
                'label'         => __('Right Content', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'text'   => __('Text Editor', 'premium-addons-pro'),
                    'temp'   => __('Elementor Template', 'premium-addons-pro'),
                ],
                'default'       => 'temp',
                'separator'     => 'before'
            ]
        );

        $repeater->add_control('right_side_text',
            [ 
                'type'          => Controls_Manager::WYSIWYG,
                'default'       => 'Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cras mattis consectetur purus sit amet fermentum. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec id elit non mi porta gravida at eget metus.',
                'label_block'   => true,
                'dynamic'       => [ 'active' => true ],
                'condition'     => [
                   'right_content'  => 'text',
                ],
            ]
        );
        
        $repeater->add_control('right_side_template',
		  	[
		     	'label'			=> __( 'Right Template', 'premium-addons-pro' ),
		     	'type'          => Controls_Manager::SELECT2,
		     	'options'       => $this->getTemplateInstance()->get_elementor_page_list(),
		     	'multiple'      => false,
                'condition'     => [
                   'right_content'  => 'temp',
                ],
		  	]
		);
        
        $repeater->add_control('hide_right_section_tabs',
            [
                'label'         => __('Hide on Tabs', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('This option works only when multiscroll disabled on tablets', 'premium-addons-pro'),
            ]
        );
        
        $repeater->add_control('hide_right_section_mobs',
            [
                'label'         => __('Hide on Mobiles', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('This option works only when multiscroll disabled on mobiles', 'premium-addons-pro'),
            ]
        );
        
    }

    protected function _register_controls() {
        
        $this->start_controls_section('content_templates',
            [
                'label'         => __('Content', 'premium-addons-pro'),
            ]
        );
        
        $this->add_control('template_height_hint',
		  	[
                'label'         => '<span style="line-height: 1.4em;">It\'s recommended that templates be the same height</span>',
		     	'type'          => Controls_Manager::RAW_HTML,
		     	
		  	]
		);
        
        $repeater = new REPEATER();
        
        $this->get_repeater_controls($repeater, array( 'scroll_responsive_tabs' => 'yes' ) );
        
        $this->add_control('left_side_repeater',
           [
               'label'          => __( 'Sections', 'premium-addons-pro' ),
               'type'           => Controls_Manager::REPEATER,
               'fields'         => array_values( $repeater->get_controls() ),
           ]
       );
        
        $this->end_controls_section();
        
        $this->start_controls_section('nav_menu',
            [
                'label'     => __('Navigation', 'premium-addons-pro'),
            ]
        );
        
        $this->add_control('nav_menu_switch',
            [
                'label'         => __('Navigation Menu', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('This option works only on the frontend', 'premium-addons-pro'),
            ]
        );
        
        $this->add_control('navigation_menu_pos',
            [
                'label'         => __('Position', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'left'  => __('Left', 'premium-addons-pro'),
                    'right' => __('Right', 'premium-addons-pro'),
                ],
                'default'       => 'left',
                'condition'     => [
                    'nav_menu_switch'   => 'yes'
                ]
            ]
        );
        
        $nav_repeater = new REPEATER();
        
        $nav_repeater->add_control('nav_menu_item',
		  	[
		     	'label'			=> __( 'List Item', 'premium-addons-pro' ),
		     	'type'          => Controls_Manager::TEXT,
		  	]
		);
        
        $this->add_control('nav_menu_repeater',
           [
               'label'          => __( 'List Items', 'premium-addons-pro' ),
               'type'           => Controls_Manager::REPEATER,
               'fields'         => array_values( $nav_repeater->get_controls() ),
               'title_field'    => '{{{ nav_menu_item }}}',
               'condition'      => [
                   'nav_menu_switch'    => 'yes'
               ]
           ]
        );
        
        $this->add_control('navigation_dots',
            [
                'label'         => __('Navigation Dots', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'separator'     => 'before'
                
            ]
        );
        
        $this->add_control('dots_tooltips',
            [
                'label'         => __('Dots Tooltips Text', 'premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
                'description'   => __('Add text for each navigation dot separated by \',\'','premium-addons-pro'),
                'condition'     => [
                    'navigation_dots'   => 'yes'
                ]
            ]
        );
        
        $this->add_control('navigation_dots_pos',
            [
                'label'         => __('Dots Horizontal Position', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'left'  => __('Left', 'premium-addons-pro'),
                    'right' => __('Right', 'premium-addons-pro'),
                ],
                'default'       => 'right',
                'condition'     => [
                    'navigation_dots'   => 'yes'
                ]
            ]
        );
        
        $this->add_control('navigation_dots_v_pos',
            [
                'label'         => __('Dots Vertical Position', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'top'   => __('Top', 'premium-addons-pro'),
                    'middle'=> __('Middle', 'premium-addons-pro'),
                    'bottom'=> __('Bottom', 'premium-addons-pro'),
                ],
                'default'       => 'middle',
                'condition'     => [
                    'navigation_dots'   => 'yes'
                ]
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('advanced_options',
            [
                'label'     => __('Advanced Settings', 'premium-addons-pro'),
            ]
        );
        
        $this->add_control('left_width',
            [
                'label'         => esc_html__('Left Section Width (%)', 'premium-multi-scroll'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => '%',
                'default'       => [
                    'size'  => 50
                ]
            ]
        );
        
        $this->add_control('right_width',
            [
                'label'         => esc_html__('Right Section Width (%)', 'premium-multi-scroll'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => '%',
                'default'       => [
                    'size'  => 50
                ]
            ]
        );
        
        $this->add_control('scroll_container_height',
            [
                'label'         => __('Height', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'fit'   => __('Fit to Screen', 'premium-addons-pro'),
                    'min'   => __('Min Height', 'premium-addons-pro'),
                ],
                'default'       => 'min',
            ]
        );
        
        $this->add_responsive_control('container_min_height',
            [
                'label'         => __('Min Height (px)', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'  => 500
                ],
                'range'         => [
                    'px'    => [
                        'min'   => 1,
                        'max'   => 600
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-multiscroll-inner'    => 'min-height: {{SIZE}}px'
                ],
                'condition'     => [
                    'scroll_container_height'   => 'min'
                ],
            ]
        );
        
        $this->add_control('keyboard_scrolling',
            [
                'label'         => __('Keyboard Scrolling', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'condition'     => [
                    'scroll_container_height'   => 'min'
                ],
            ]
        );
        
        $this->add_control('loop_top',
            [
                'label'         => __('Loop Top', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Defines whether scrolling up in the first section should scroll to the last one or not.','premium-addons-pro')
                
            ]
        );
        
        $this->add_control('loop_bottom',
            [
                'label'         => __('Loop Bottom', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Defines whether scrolling down in the last section should scroll to the first one or not.','premium-addons-pro')
                
            ]
        );
        
        $this->add_control('scroll_speed',
            [
                'label'         => __('Scroll Speed', 'premium-addons-pro'),
                'type'          => Controls_Manager::NUMBER,
                'title'         => __('Set scolling speed in seconds, default: 0.7', 'premium-addons-pro'),
                'default'       => 0.7,
                'selectors'     => [
                    '{{WRAPPER}} .premium-multiscroll-inner .premium-scroll-easing'    => '-webkit-transition:all {{VALUE}}s cubic-bezier(0.895, 0.03, 0.685, 0.22); -moz-transition:all {{VALUE}}s cubic-bezier(0.895, 0.03, 0.685, 0.22); -o-transition:all {{VALUE}}s cubic-bezier(0.895, 0.03, 0.685, 0.22); transition:all {{VALUE}}s cubic-bezier(0.895, 0.03, 0.685, 0.22)'
                ]
            ]
        );
        
        $this->add_control('scroll_responsive_tabs',
            [
                'label'         => __('Disable on Tabs', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Disable multiscroll on tabs', 'premium-addons-pro'),
                'default'       => 'yes'
            ]
        );
        
        $this->add_control('scroll_responsive_mobs',
            [
                'label'         => __('Disable on Mobiles', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Disable multiscroll on mobile phones', 'premium-addons-pro'),
                'default'       => 'yes'
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('left_side_text',
            [
                'label'     => __('Left Side', 'premium-addons-pro'),
                'tab'       => CONTROLS_MANAGER::TAB_STYLE,
            ]
        );
        
        $this->add_control('left_side_background', 
            [
                'label'         => __('Background Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .ms-left .ms-tableCell' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control('left_text_color', 
            [
                'label'         => __('Text Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-multiscroll-left-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control('left_text_background', 
            [
                'label'         => __('Text Background Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-multiscroll-left-text' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'left_text_typography',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .premium-multiscroll-left-text',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'left_text_border',
                'selector'      => '{{WRAPPER}} .premium-multiscroll-left-text',
            ]
        );

        $this->add_control('left_text_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%' ,'em'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-multiscroll-left-text' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_responsive_control('left_text_vertical',
            [
                'label'         => __( 'Vertical Position', 'premium-addons-pro' ),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'top'      => [
                        'title'=> __( 'Top', 'premium-addons-pro' ),
                        'icon' => 'fa fa-long-arrow-up',
                    ],
                    'middle'    => [
                        'title'=> __( 'Middle', 'premium-addons-pro' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                    'bottom'     => [
                        'title'=> __( 'Bottom', 'premium-addons-pro' ),
                        'icon' => 'fa fa-long-arrow-down',
                    ],
                ],
                'default'       => 'middle',
                'selectors'     => [
                    '{{WRAPPER}} .ms-left .ms-tableCell' => 'vertical-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control('left_text_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-multiscroll-left-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_responsive_control('left_text_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-multiscroll-left-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('right_side_text',
            [
                'label'     => __('Right Side', 'premium-addons-pro'),
                'tab'       => CONTROLS_MANAGER::TAB_STYLE,
            ]
        );
        
        $this->add_control('right_side_background', 
            [
                'label'         => __('Background Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .ms-right .ms-tableCell' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control('right_text_color', 
            [
                'label'         => __('Text Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-multiscroll-right-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control('right_text_background', 
            [
                'label'         => __('Text Background Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-multiscroll-right-text' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'right_text_typography',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .premium-multiscroll-right-text',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'right_text_border',
                'selector'      => '{{WRAPPER}} .premium-multiscroll-right-text',
            ]
        );

        $this->add_control('right_text_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%' ,'em'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-multiscroll-right-text' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_responsive_control('right_text_vertical',
            [
                'label'         => __( 'Vertical Position', 'premium-addons-pro' ),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'top'      => [
                        'title'=> __( 'Top', 'premium-addons-pro' ),
                        'icon' => 'fa fa-long-arrow-up',
                    ],
                    'middle'    => [
                        'title'=> __( 'Middle', 'premium-addons-pro' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                    'bottom'     => [
                        'title'=> __( 'Bottom', 'premium-addons-pro' ),
                        'icon' => 'fa fa-long-arrow-down',
                    ],
                ],
                'default'       => 'middle',
                'selectors'     => [
                    '{{WRAPPER}} .ms-right .ms-tableCell' => 'vertical-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control('right_text_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-multiscroll-right-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_responsive_control('right_text_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-multiscroll-right-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('navigation_style',
            [
                'label'     => __('Navigation Dots', 'premium-addons-pro'),
                'tab'       => CONTROLS_MANAGER::TAB_STYLE,
                'condition' => [
                    'navigation_dots'   => 'yes'
                ]
            ]
        );
        
        $this->start_controls_tabs('navigation_style_tabs');

        $this->start_controls_tab('dots_style_tab',
            [
                'label'         => __('Dots', 'premium-addons-pro'),
            ]
        );
        
        $this->add_control('tooltips_color',
            [
                'label'         => __( 'Tooltips Text Color', 'premium-addons-pro' ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value' => Scheme_Color::COLOR_1
                ],
                'selectors'     => [
                    '{{WRAPPER}} .multiscroll-tooltip'  => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation_dots'   => 'yes',
                    'dots_tooltips!'    => ''
                ]
            ]
        );
        
        $this->add_control('tooltips_font',
            [
                'label'         => __( 'Tooltips Text Font', 'premium-addons-pro' ),
                'type'          => Controls_Manager::FONT,
                'selectors'     => [
                    '{{WRAPPER}} .multiscroll-tooltip'  => 'font-family: {{VALUE}};',
                ],
                'condition' => [
                    'navigation_dots'   => 'yes',
                    'dots_tooltips!'    => ''
                ]
            ]
        );
        
        $this->add_control('dots_color',
            [
                'label'         => __( 'Dots Color', 'premium-addons-pro' ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value' => Scheme_Color::COLOR_1
                ],
                'selectors'     => [
                    '{{WRAPPER}} .multiscroll-nav span'  => 'background-color: {{VALUE}};',
                ]
            ]
        );
        
        $this->add_control('active_dot_color',
            [
                'label'         => __( 'Active Dot Color', 'premium-addons-pro' ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value' => Scheme_Color::COLOR_2
                ],
                'selectors'     => [
                    '{{WRAPPER}} .multiscroll-nav li .active span'  => 'background-color: {{VALUE}};',
                ]
            ]
        );
        
        $this->add_control('dots_border_color',
            [
                'label'         => __( 'Dots Border Color', 'premium-addons-pro' ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value'=> Scheme_Color::COLOR_2
                ],
                'selectors'     => [
                    '{{WRAPPER}} .multiscroll-nav span'  => 'border-color: {{VALUE}};',
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab('container_style_tab',
            [
                'label'         => __('Container', 'premium-addons-pro'),
            ]
        );
        
        $this->add_control('navigation_background',
            [
                'label'         => __( 'Background Color', 'premium-addons-pro' ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value'=> Scheme_Color::COLOR_1
                ],
                'selectors'     => [
                    '{{WRAPPER}} .multiscroll-nav'  => 'background-color: {{VALUE}}'
                ]
            ]
        );
        
        $this->add_control('navigation_border_radius',
            [
                'label'         => __( 'Border Radius', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .multiscroll-nav'  => 'border-radius: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label'         => __('Shadow','premium-addons-pro'),
                'name'          => 'navigation_box_shadow',
                'selector'      => '{{WRAPPER}} .multiscroll-nav',
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();
        
        $this->start_controls_section('navigation_menu_style',
            [
                'label'     => __('Navigation Menu', 'premium-addons-pro'),
                'tab'       => CONTROLS_MANAGER::TAB_STYLE,
                'condition' => [
                    'nav_menu_switch'   => 'yes'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'navigation_items_typography',
                'selector'      => '{{WRAPPER}} .premium-scroll-nav-menu .premium-scroll-nav-item .premium-scroll-nav-link'
            ]
        );
        
        $this->start_controls_tabs('navigation_menu_style_tabs');

        $this->start_controls_tab('normal_style_tab',
            [
                'label'         => __('Normal', 'premium-addons-pro'),
            ]
        );
        
        $this->add_control('normal_color',
            [
                'label'         => __( 'Text Color', 'premium-addons-pro' ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value'=> Scheme_Color::COLOR_1
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-scroll-nav-menu .premium-scroll-nav-item .premium-scroll-nav-link'  => 'color: {{VALUE}}'
                ]
            ]
        );
        
        $this->add_control('normal_hover_color',
            [
                'label'         => __( 'Text Hover Color', 'premium-addons-pro' ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value'=> Scheme_Color::COLOR_1
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-scroll-nav-menu .premium-scroll-nav-item .premium-scroll-nav-link:hover'  => 'color: {{VALUE}}'
                ]
            ]
        );
        
        $this->add_control('normal_background',
            [
                'label'         => __( 'Background Color', 'premium-addons-pro' ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value'=> Scheme_Color::COLOR_2
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-scroll-nav-menu .premium-scroll-nav-item'  => 'background-color: {{VALUE}}'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label'         => __('Shadow','premium-addons-pro'),
                'name'          => 'normal_shadow',
                'selector'      => '{{WRAPPER}} .premium-scroll-nav-menu .premium-scroll-nav-item'
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab('active_style_tab',
            [
                'label'         => __('Active', 'premium-addons-pro'),
            ]
        );
        
        $this->add_control('active_color',
            [
                'label'         => __( 'Text Color', 'premium-addons-pro' ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value'=> Scheme_Color::COLOR_2
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-scroll-nav-menu .premium-scroll-nav-item.active .premium-scroll-nav-link'  => 'color: {{VALUE}}'
                ]
            ]
        );
        
        $this->add_control('active_hover_color',
            [
                'label'         => __( 'Text Hover Color', 'premium-addons-pro' ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value'=> Scheme_Color::COLOR_2
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-scroll-nav-menu .premium-scroll-nav-item.active .premium-scroll-nav-link:hover'  => 'color: {{VALUE}}'
                ]
            ]
        );
        
        $this->add_control('active_background',
            [
                'label'         => __( 'Background Color', 'premium-addons-pro' ),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(), 
                    'value'=> Scheme_Color::COLOR_1
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-scroll-nav-menu .premium-scroll-nav-item.active'  => 'background-color: {{VALUE}}'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label'         => __('Shadow','premium-addons-pro'),
                'name'          => 'active_shadow',
                'selector'      => '{{WRAPPER}} .premium-scroll-nav-menu .premium-scroll-nav-item.active'
            ]
        );
        
        $this->end_controls_tabs();
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'navigation_items_border',
                'selector'      => '{{WRAPPER}} .premium-scroll-nav-menu .premium-scroll-nav-item',
                'separator'     => 'before'
            ]
        );

        $this->add_control('navigation_items_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px','em','%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-scroll-nav-menu .premium-scroll-nav-item'  => 'border-radius: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        
        $this->add_responsive_control('navigation_items_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-scroll-nav-menu .premium-scroll-nav-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control('navigation_items_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-scroll-nav-menu .premium-scroll-nav-item .premium-scroll-nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
    }
    
    protected function get_template_content( $template_id ) {
        
        $premium_elements_frontend = new Frontend;
        
        $template_content = $premium_elements_frontend->get_builder_content($template_id, true);
        
        return $template_content;
    }
    
    protected function render() {
        
        $settings = $this->get_settings_for_display();
        
        $id = $this->get_id();
        
        $navigation_dots = ( 'yes' == $settings['navigation_dots'] ) ? true : false;
        
        $top_loop = ( 'yes' == $settings['loop_top'] ) ? true : false;
        
        $bottom_loop = ( 'yes' == $settings['loop_bottom'] ) ? true : false;
        
        $dots_text = explode(',', $settings['dots_tooltips'] );
        
        $nav_items = $settings['nav_menu_repeater'];
        
        $anchors_arr = array();
        
        if ('yes' == $settings['nav_menu_switch'] ) {
            foreach( $nav_items as $index => $item ) {
                array_push($anchors_arr,'section_' . $index);
            }
        }
        
        $scoll_settings = [
            'dots'          => $navigation_dots,
            'leftWidth'     => !empty( $settings['left_width']['size'] ) ? $settings['left_width']['size'] : 50,
            'rightWidth'    => !empty( $settings['right_width']['size'] ) ? $settings['right_width']['size'] : 50,
            'dotsText'      => $dots_text,
            'dotsPos'       => $settings['navigation_dots_pos'],
            'dotsVPos'      => $settings['navigation_dots_v_pos'],
            'topLoop'       => $top_loop,
            'btmLoop'       => $bottom_loop,
            'anchors'       => $anchors_arr,
            'hideTabs'      => ( $settings['scroll_responsive_tabs'] == 'yes' ) ? true: false,
            'tabSize'       => ( $settings['scroll_responsive_tabs'] == 'yes' ) ? Responsive::get_breakpoints()['lg'] : Responsive::get_breakpoints()['lg'],
            'hideMobs'      => ( $settings['scroll_responsive_mobs'] == 'yes' ) ? true: false,
            'mobSize'       => ( $settings['scroll_responsive_mobs'] == 'yes' ) ? Responsive::get_breakpoints()['md'] : Responsive::get_breakpoints()['md'],
            'cellHeight'    => !empty( $settings['container_min_height']['size'] ) ? $settings['container_min_height']['size'] : 500,
            'fit'           => $settings['scroll_container_height'],
            'keyboard'      => ( $settings['keyboard_scrolling'] == 'yes' ) ? true : false,
            'rtl'           => $this->check_rtl(),
            'id'            => esc_attr( $id )
        ];
        
        $this->add_render_attribute( 'multiscroll_wrapper', 'class', 'premium-multiscroll-wrap' );
        
        $this->add_render_attribute( 'multiscroll_inner', 'class', array( 'premium-multiscroll-inner', 'premium-scroll-' . $settings['scroll_container_height'] ) );
        
        $this->add_render_attribute( 'multiscroll_inner', 'id', 'premium-multiscroll-' . $id );
        
        $this->add_render_attribute( 'multiscroll_menu', 'id', 'premium-scroll-nav-menu-' . $id );
        
        $this->add_render_attribute( 'multiscroll_menu', 'class', array( 'premium-scroll-nav-menu', 'premium-scroll-responsive', $settings['navigation_menu_pos'] ) );
        
        $this->add_render_attribute('right_template', 'class', [ 'premium-multiscroll-temp', 'premium-multiscroll-right-temp', 'premium-multiscroll-temp-' . $id ] );
        
        $this->add_render_attribute('left_template', 'class', [ 'premium-multiscroll-temp', 'premium-multiscroll-left-temp', 'premium-multiscroll-temp-' . $id ] );
        
        $this->add_render_attribute('left_side', 'class', 'premium-multiscroll-left-' . $id );
        
        $this->add_render_attribute('right_side', 'class', 'premium-multiscroll-right-' . $id );
        
        $this->add_inline_editing_attributes('left_side_text', 'advanced');
        
        $this->add_inline_editing_attributes('right_side_text', 'advanced');
        
        $this->add_render_attribute('left_side_text', 'class', 'premium-multiscroll-left-text');
        
        $this->add_render_attribute('right_side_text', 'class', 'premium-multiscroll-right-text');

        $templates = $settings['left_side_repeater'];
        
        ?>
        
        <div <?php echo $this->get_render_attribute_string('multiscroll_wrapper'); ?> data-settings='<?php echo wp_json_encode($scoll_settings); ?>'>
            <?php if ('yes' == $settings['nav_menu_switch'] ) : ?>
                <ul <?php echo $this->get_render_attribute_string('multiscroll_menu'); ?>>
                    <?php foreach( $nav_items as $index => $item ) : ?>
                        <li data-menuanchor="<?php echo 'section_' . $index; ?>" class="premium-scroll-nav-item"><a class="premium-scroll-nav-link" href="<?php echo '#section_' . $index; ?>"><?php echo $item['nav_menu_item'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div <?php echo $this->get_render_attribute_string('multiscroll_inner'); ?>>
                <div <?php echo $this->get_render_attribute_string('left_side'); ?>>
                    <?php foreach( $templates as $index => $section ) :
                        if('yes' == $section['hide_left_section_tabs'] ) {
                            $this->add_render_attribute('left_section' . $index , 'data-hide-tabs', true);
                        }
                        if( 'yes' == $section['hide_left_section_mobs'] ) {
                            $this->add_render_attribute('left_section' . $index , 'data-hide-mobs', true);
                        }
                    ?>
                    <div <?php echo $this->get_render_attribute_string('left_template') . $this->get_render_attribute_string('left_section' . $index ); ?>>
                        <?php
                            if('temp' == $section['left_content'] ) :
                                $template_id = $section['left_side_template'];
                                echo $this->get_template_content($template_id);
                            else :
                        ?>
                            <div <?php echo $this->get_render_attribute_string('left_side_text'); ?>>
                                <?php echo $section['left_side_text'] ?>
                            </div>
                        <?php
                            endif;
                        ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div <?php echo $this->get_render_attribute_string('right_side'); ?>>
                    <?php foreach( $templates as $index => $section ) :
                        if('yes' == $section['hide_right_section_tabs'] ) {
                            $this->add_render_attribute('right_section' . $index , 'data-hide-tabs', true);
                        }
                        if( 'yes' == $section['hide_right_section_mobs'] ) {
                            $this->add_render_attribute('right_section' . $index , 'data-hide-mobs', true);
                        }
                    ?>
                    <div <?php echo $this->get_render_attribute_string('right_template') . $this->get_render_attribute_string('right_section' . $index ); ?>>
                        <?php 
                            if('temp' == $section['right_content'] ) :
                                $template_id = $section['right_side_template'];
                                echo $this->get_template_content($template_id);
                            else : 
                        ?>
                            <div <?php echo $this->get_render_attribute_string('right_side_text'); ?>>
                                <?php echo $section['right_side_text'] ?>
                            </div>
                        <?php
                            endif;
                        ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <?php
        
    }
    
}