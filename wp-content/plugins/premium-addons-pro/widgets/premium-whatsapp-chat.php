<?php

/**
 * Class: Premium_Whatsapp_Chat
 * Name: Whatsapp Chat
 * Slug: premium-whatsapp-chat
 */

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
use Elementor\Core\Responsive\Responsive;

if( ! defined( 'ABSPATH' ) ) exit;

class Premium_Whatsapp_Chat extends Widget_Base {
    
    public function get_name(){
        return 'premium-whatsapp-chat';
    }
    
    public function get_title(){
        return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Whatsapp Chat', 'premium-addons-pro') );
    }
    
    public function get_icon() {
        return 'pa-pro-whatsapp';
    }
    
    public function get_categories() {
        return ['premium-elements'];
    }
    
    public function get_style_depends() {
        return [
            'tooltipster'
        ];
    }
    
    public function get_script_depends() {
        return [
            'tooltipster-bundle-js',
            'premium-pro-js'
        ];
    }
    
    public function check_rtl(){
        return is_rtl();
    }
    
    // Adding the controls fields for the Whatsapp Chat
    // This will controls the animation, colors and background, dimensions etc
    protected function _register_controls() {
        
        $this->start_controls_section('chat',
            [
                'label'         => __('Chat','premium-addons-pro'),
            ]
        );
        
        $this->add_control('chat_type', 
            [
                'label'         => __('Chat', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'private'       => __('Private', 'premium-addons-pro'),
                    'group'         => __('Group', 'premium-addons-pro'),
                ],
                'default'       => 'private',
                'label_block'   => true,
            ]
        );
        
        $this->add_control('number',
            [
                'label'         => __('Phone Number', 'premium-addons-pro'),
                'description'   => 'Example: +1123456789',
                'dynamic'       => [ 'active' => true ],
                'condition'     => [
                    'chat_type'     => 'private'
                ],
                'type'          => Controls_Manager::TEXT,
            ]
        );
        
        $this->add_control('group_id',
            [
                'label'         => __('Group ID', 'premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
                'description'   => 'click <a href="https://www.youtube.com/watch?time_continue=13&v=Vx53spbt_qk" target="_blank"> here</a> to know how to get the group id',
                'dynamic'       => [ 'active' => true ],
                'default'       => '9EHLsEsOeJk6AVtE8AvXiA',
                'condition'     => [
                    'chat_type'     => 'group'
                ],
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('settings',
            [
                'label'         => __('Button','premium-addons-pro'),
            ]
        );
         
        $this->add_control('button_float',
            [
                'label'         => __('Float', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER
            ]
        );
        
        $this->add_responsive_control('horizontal_position',
            [
                'label'         => __('Horizontal Offset', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'range'         => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 300,
                    ]
                ],
                'condition'     => [
                    'button_float'  => 'yes',
                    'position'      => 'right'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-whatsapp-link' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control('horizontal_position_left',
            [
                'label'         => __('Horizontal Offset', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'range'         => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 300,
                    ]
                ],
                'condition'     => [
                    'button_float'  => 'yes',
                    'position'      => 'left'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-whatsapp-link' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control('vertical_position',
            [
                'label'         => __('Vertical Offset', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'range'         => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 300,
                    ]
                ],
                'condition'     => [
                    'button_float'  => 'yes',
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-whatsapp-link' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
         
        $this->add_control('button_text',
            [
                'label'         => __('Text', 'premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'default'       => __('Contact us','premium-addons-pro'),
                'label_block'   => true,
            ]
        );
        
        $this->add_control('icon_switcher',
            [
                'label'         => __('Icon', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Enable or disable button icon','premium-addons-pro'),
                'default'       => 'yes',
                'separator'     => 'before',
            ]
        );

        $this->add_control('icon_selection',
            [
                'label'         => __('Icon', 'premium-addons-pro'),
                'type'          => Controls_Manager::ICON,
                'default'       => 'fa fa-whatsapp',
                'condition'     => [
                    'icon_switcher' => 'yes',
                ],
                'label_block'   => true,
            ]
        );
        
        $this->add_control('icon_position', 
            [
                'label'         => __('Icon Position', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'row-reverse'   => __('Before', 'premium-addons-pro'),
                    'row'           => __('After', 'premium-addons-pro'),
                ],
                'condition'     => [
                    'icon_switcher'     => 'yes',
                    'icon_selection!'    => '',
                    'button_text!'      => ''
                ],
                'default'       => 'row',
                'label_block'   => true,
                'selectors'     => [
                    '{{WRAPPER}} .premium-whatsapp-link'    => '-webkit-flex-direction: {{VALUE}}; flex-direction: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_responsive_control('icon_size',
            [
                'label'         => __('Icon Size', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'condition'     => [
                    'icon_switcher'     => 'yes',
                    'icon_selection!'    => '',
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-whatsapp-link .premium-whatsapp-icon' => 'font-size: {{SIZE}}px',
                ]
            ]
        );
        
        $this->add_responsive_control('icon_spacing',
            [
                'label'         => __('Icon Spacing', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'condition'     => [
                    'icon_switcher'     => 'yes',
                    'icon_position'     => 'row',
                    'icon_selection!'    => '',
                    'button_text!'      => ''
                ],
                'default'       => [
                    'size'  => 15
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-whatsapp-link i' => 'margin-left: {{SIZE}}px',
                ],
                'separator'     => 'after',
            ]
        );
        
        $this->add_responsive_control('icon_before_spacing',
            [
                'label'         => __('Icon Spacing', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'condition'     => [
                    'icon_switcher'     => 'yes',
                    'icon_position'     => 'row-reverse',
                    'icon_selection!'   => '',
                    'button_text!'      => ''
                ],
                'default'       => [
                    'size'  => 15
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-whatsapp-link i' => 'margin-right: {{SIZE}}px',
                ],
                'separator'     => 'after',
            ]
        );
        
        $this->add_control('button_size', 
            [
                'label'         => __('Size', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'lg',
                'options'       => [
                    'sm'    => __('Small', 'premium-addons-pro'),
                    'md'    => __('Medium', 'premium-addons-pro'),
                    'lg'    => __('Large', 'premium-addons-pro'),
                    'block' => __('Block', 'premium-addons-pro'),
                ],
                'label_block'   => true,
                'separator'     => 'before'
            ]
        );
        
        $this->add_responsive_control('button_alignment',
            [
                'label'         => __( 'Button Alignment', 'premium-addons-pro' ),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
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
                'toggle'        => false,
                'condition'     => [
                    'button_float!' => 'yes',
                    'button_size!'  => 'block'
                ],
                'default'       => 'center',
                'selectors'     => [
                    '{{WRAPPER}} .premium-whatsapp-link-wrap' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control('text_alignment',
            [
                'label'         => __( 'Text Alignment', 'premium-addons-pro' ),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
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
                'toggle'        => false,
                'condition'     => [
                    'button_float!' => 'yes',
                    'icon_position' => 'row',
                    'button_size'  => 'block'
                ],
                'default'       => 'center',
                'selectors'     => [
                    '{{WRAPPER}} .premium-whatsapp-link-wrap .premium-whatsapp-link' => 'justify-content: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control('text_alignment_after',
            [
                'label'         => __( 'Text Alignment', 'premium-addons-pro' ),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'right'    => [
                        'title' => __( 'Left', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'left' => [
                        'title' => __( 'Right', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'toggle'        => false,
                'condition'     => [
                    'button_float!' => 'yes',
                    'icon_position' => 'row-reverse',
                    'button_size'  => 'block'
                ],
                'default'       => 'center',
                'selectors'     => [
                    '{{WRAPPER}} .premium-whatsapp-link-wrap .premium-whatsapp-link' => 'justify-content: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control('position', 
            [
                'label'         => __('Button Position', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'right' => __('Right', 'premium-addons-pro'),
                    'left'  => __('Left', 'premium-addons-pro'),
                ],
                'condition'     => [
                    'button_float'  => 'yes'
                ],
                'toggle'        => false,
                'default'       => 'right',
                'label_block'   => true,
            ]
        );
        
        $this->add_control('button_hover_animation',
	        [
				'label'         => __( 'Hover Animation', 'premium-addons-pro' ),
				'type'          => Controls_Manager::HOVER_ANIMATION,
			]
		);
    
        $this->add_control('link_new_tab',
            [
                'label'         => __('Open Link in New Tab', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('advanced',
            [
                'label'         => __('Advanced Settings','premium-addons-pro'),
            ]
        );
        
        $this->add_control('hide_tabs',
            [
                'label'         => __('Hide on Tabs', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('This will hide the chat button on tablets','premium-addons-pro'),
            ]
        );
        
        $this->add_control('hide_mobiles',
            [
                'label'         => __('Hide on Mobiles', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('This will hide the chat button on mobile phones','premium-addons-pro'),
            ]
        );
        
        $this->add_control('tooltips',
            [
                'label'         => __('Tooltips', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('This will show a tooltip next to the button when hovered','premium-addons-pro'),
            ]
        );
        
        $this->add_control('tooltips_msg',
            [
                'label'         => __('Tooltip Message', 'premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'default'       => __('Message us', 'premium-addons-pro'),
                'condition'     => [
                    'tooltips'      => 'yes'
                ]
            ]
        );
       
        $this->add_control('tooltips_anim', 
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
                'condition'     => [
                    'tooltips'      => 'yes'
                ],
                'default'       => 'fade',
                'label_block'   => true,
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_button_style_section',
            [
                'label'         => __('Button', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'button_typo',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'condition'     => [
                    'button_text!'  => ''
                ],
                'selector'      => '{{WRAPPER}} .premium-whatsapp-link span',
            ]
        );
        
        $this->start_controls_tabs('button_style_tabs');
        
        $this->start_controls_tab('button_style_normal',
            [
                'label'         => __('Normal', 'premium-addons-pro'),
            ]
        );
        
        $this->add_control('text_color_normal',
            [
                'label'         => __('Text Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'condition'     => [
                    'button_text!'  => ''
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-whatsapp-link span'   => 'color: {{VALUE}};',
                ]
            ]
        );
        
        $this->add_control('button_icon_color_normal',
            [
                'label'         => __('Icon Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-whatsapp-link i'   => 'color: {{VALUE}};',
                ],
                'condition'     => [
                    'icon_switcher'     => 'yes',
                    'icon_selection!'   => ''
                ]
            ]
        );
        
        $this->add_control('button_background_normal',
            [
                'label'         => __('Background Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_4,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-whatsapp-link'  => 'background-color: {{VALUE}};',
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'button_border_normal',
                'selector'      => '{{WRAPPER}} .premium-whatsapp-link',
            ]
        );
        
        $this->add_control('button_border_radius_normal',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%' ,'em'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-whatsapp-link' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'label'         => __('Icon Shadow','premium-addons-pro'),
                'name'          => 'button_icon_shadow_normal',
                'selector'      => '{{WRAPPER}} .premium-whatsapp-link i',
                'condition'         => [
                    'icon_switcher' => 'yes',
                    'icon_switcher!'=> ''
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'label'         => __('Text Shadow','premium-addons-pro'),
                'name'          => 'button_text_shadow_normal',
                'condition'     => [
                    'button_text!'  => ''
                ],
                'selector'      => '{{WRAPPER}} .premium-whatsapp-link span',
            ]
        );
    
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label'         => __('Button Shadow','premium-addons-pro'),
                'name'          => 'button_box_shadow_normal',
                'selector'      => '{{WRAPPER}} .premium-whatsapp-link',
            ]
        );
        
        $this->add_responsive_control('button_margin_normal',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-whatsapp-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_responsive_control('button_padding_normal',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-whatsapp-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab('button_style_hover',
            [
                'label'         => __('Hover', 'premium-addons-pro'),
            ]
        );
        
        $this->add_control('tooltips_background', 
            [
               'label'          => __('Tooltips Background Color','premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '.tooltipster-sidetip div.tooltipster-box-{{ID}} .tooltipster-content'  => 'background-color:{{VALUE}};'
                ],
                'condition'     => [
                    'tooltips'   => 'yes'
                ]
            ]
        );
        
        $this->add_control('text_color_hover',
            [
                'label'         => __('Text Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-whatsapp-link:hover span'   => 'color: {{VALUE}};',
                ],
                'condition'     => [
                    'button_text!'   => ''
                ]
            ]
        );
        
        $this->add_control('icon_color_hover',
            [
                'label'             => __('Icon Color', 'premium-addons-pro'),
                'type'              => Controls_Manager::COLOR,
                'scheme'            => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'         => [
                    '{{WRAPPER}} .premium-whatsapp-link:hover i'   => 'color: {{VALUE}};',
                ],
                'condition'         => [
                    'icon_selection!'   => '',
                    'icon_switcher'    => 'yes',
                ]
            ]
        );
        
        $this->add_control('button_background_hover',
            [
                'label'             => __('Background Color', 'premium-addons-pro'),
                'type'              => Controls_Manager::COLOR,
                'scheme'            => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_4
                ],
                'selectors'          => [
                    '{{WRAPPER}} .premium-whatsapp-link:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'button_border_hover',
                    'selector'      => '{{WRAPPER}} .premium-whatsapp-link:hover',
                ]
                );
        
        $this->add_control('button_border_radius_hover',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%' ,'em'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-whatsapp-link:hover' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'label'         => __('Icon Shadow','premium-addons-pro'),
                'name'          => 'button_icon_shadow_hover',
                'selector'      => '{{WRAPPER}} .premium-whatsapp-link:hover i',
                'condition'     => [
                        'icon_switcher'     => 'yes',
                        'icon_selection!'   => '',
                    ]
                ]
            );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'label'         => __('Text Shadow','premium-addons-pro'),
                    'name'          => 'button_text_shadow_hover',
                    'selector'      => '{{WRAPPER}} .premium-button:hover span',
                    'condition'         => [
                       'button_text!'   => ''
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label'         => __('Button Shadow','premium-addons-pro'),
                'name'          => 'button_shadow_hover',
                'selector'      => '{{WRAPPER}} .premium-whatsapp-link:hover',
            ]
        );
        
        $this->add_responsive_control('button_margin_hover',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-whatsapp-link:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_responsive_control('button_padding_hover',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-whatsapp-link:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->end_controls_section();
        
    }
    
    /**
     * renders the HTML content of the widget
     * @return void
     */
    protected function render() {
        
        $settings       = $this->get_settings_for_display();
        
        $breakpoints    = Responsive::get_breakpoints();
        
        $pa_whats_chat_settings = array( 
            'tooltips'  => $settings['tooltips'],
            'anim'      => $settings['tooltips_anim'],
            'hideMobile'=> $settings['hide_mobiles'] == 'yes' ? true : false,
            'hideTab'   => $settings['hide_tabs'] == 'yes' ? true : false,
            'mob'       => $breakpoints['md'],
            'tab'       => $breakpoints['lg'],
            'id'        => $this->get_id()
        );
        
        $target = 'yes' == $settings['link_new_tab'] ? "_blank" : "_self";
        
        $id = ( 'private' == $settings['chat_type'] ) ? $settings['number'] : $settings['group_id'];
        
        $is_mobile = ( wp_is_mobile() ) ? 'api' : 'web';
        
        $browser = $_SERVER['HTTP_USER_AGENT'];
        
        $is_firefox = ( false !==  strpos( $browser, 'Firefox' ) ) ? 'web' : 'chat';
        
        $prefix = ( 'private' == $settings['chat_type'] ) ? $is_mobile : $is_firefox;
        
        $suffix = ( 'private' == $settings['chat_type'] ) ? 'send?phone=' : '';
        
        $href = sprintf('https://%s.whatsapp.com/%s%s', $prefix, $suffix, $id );
        
        $pos = 'yes' == $settings['button_float'] ? 'premium-button-float' : '';
        
        $button_size = 'premium-button-' . $settings['button_size'];
        
        $this->add_render_attribute( 'whatsapp', 'class', 'premium-whatsapp-container' );
        
        $this->add_render_attribute( 'whatsapp', 'data-settings', wp_json_encode( $pa_whats_chat_settings ) );
        
        $this->add_render_attribute( 'button_link', 'class', [ 'premium-whatsapp-link', $button_size, $pos, $settings['position'], 'elementor-animation-' . $settings['button_hover_animation'] ] );
        
        $this->add_render_attribute( 'button_link', 'data-tooltip-content', '#tooltip_content' );
        
        $this->add_render_attribute( 'button_link', 'href', esc_attr( $href ) );
        
        $this->add_render_attribute( 'button_link', 'target', $target );
        
    ?>

    <div <?php echo $this->get_render_attribute_string( 'whatsapp' ); ?>>
        <div class="premium-whatsapp-link-wrap">
            <a <?php echo $this->get_render_attribute_string( 'button_link' ); ?>>
                <?php if( ! empty ( $settings['button_text'] ) ) : ?>
                    <span class="premium-whatsapp-text"><?php echo esc_html( $settings['button_text'] ); ?></span>
                <?php endif; ?>
                <?php if( ! empty ( $settings['icon_selection'] ) && 'yes' == $settings['icon_switcher'] ) : ?>
                    <i class="premium-whatsapp-icon <?php echo esc_attr( $settings['icon_selection'] ); ?>"></i>
                <?php endif; ?>
                <?php if( 'yes' == $settings['tooltips'] ) : ?>
                    <div id="tooltip_content">
                        <span><?php echo esc_html( $settings['tooltips_msg'] ); ?></span>
                    </div>
                <?php endif; ?>
            </a>

        </div>
        
    </div>
    
    <?php }
}