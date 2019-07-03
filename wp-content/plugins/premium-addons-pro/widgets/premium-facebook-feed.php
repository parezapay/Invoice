<?php

/**
 * Class: Premium_Facebook_Feed
 * Name: Facebook Feed
 * Slug: premium-facebook-feed
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

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Premium_Facebook_Feed extends Widget_Base {
	
    public function get_name() {
        return 'premium-facebook-feed';
    }
    
    public function get_title() {
		return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Facebook Feed', 'premium-addons-pro') );
	}

    public function get_icon() {
        return 'pa-pro-facebook-feed';
    }
    
    public function get_categories() {
        return [ 'premium-elements' ];
    }
    
    public function get_script_depends() {
        return [
//            'codebird-js',
            'dot-js',
            'jquery-socialfeed-js',
            //'masonry-js',
            'isotope-js',
            'imagesloaded',
            'premium-pro-js',
        ];
    }
    
    public function is_reload_preview_required() {
        return true;
    }
   
    // Adding the controls fields for the Facebook Feed
    // This will controls the animation, colors and background, dimensions etc
    protected function _register_controls() {
    
        $this->start_controls_section('access_credentials_section',
            [
                'label'         => __('Access Credentials', 'premium-addons-pro')
            ]
        );

        $this->add_control('access_token',
            [
                'label'         => __('Access Token', 'premium-addons-pro'),
                'default'       => 'EAACuIfHasYEBAJdezdsCLK9IgAHc6jX9DRa6r0M2itsr53m2g2d8Pk1NPwKtzFBwE15NlEHpCHXF1ZAYZA2KspJbJIrqgdMinNv4aSJbNL3RmZBFwMXe0AjnA7G1E0Vz4n06VFSroqdZAZCx6ck5LDRtgWy58cfzHrHDWNjRRVwZDZD',
                'description'   => 'Click <a href="https://www.youtube.com/watch?v=Zb8YWXlXo-k" target="_blank">Here</a> to know how to get your page access token',
                'type'          => Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('account_settings_section',
            [
                'label'         => __('Account', 'premium-addons-pro')
            ]
        );

        $this->add_control('account_id',
            [
                'label'         => __( 'Page Slug /User ID', 'premium-addons-pro' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '!leap13themes',
                'description'   => 'Account ID is prefixed by @, Page Slug is prefixed by !, click <a target="_blank" href="https://findmyfbid.com/"> here</a> to get account ID',
                'label_block'   => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('page_settings',
            [
                'label'         => __( 'Layout', 'premium-addons-pro' ),
            ]
        );

        $this->add_control('layout_style',
            [
                'label'         => __('Style', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'description'   => __( 'Choose the layout style for the posts', 'premium-addons-pro' ),
                'options'       => [
                    'list'          => __('List', 'premium-addons-pro'),
                    'masonry'       => __('Masonry', 'premium-addons-pro'),
                ],
                'default'       => 'masonry',
            ]
        );
        
        $this->add_responsive_control('column_number',
            [
                'label'             => __('Posts/Row', 'premium-addons-pro'),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                    '100%'  => __('1 Column', 'premium-addons-pro'),
                    '50%'   => __('2 Columns', 'premium-addons-pro'),
                    '33.33%'=> __('3 Columns', 'premium-addons-pro'),
                    '25%'   => __('4 Columns', 'premium-addons-pro'),
                    '20%'   => __('5 Columns', 'premium-addons-pro'),
                    '16.667%'=> __('6 Columns', 'premium-addons-pro'),
                ],
                'desktop_default'   => '33.33%',
				'tablet_default'    => '50%',
				'mobile_default'    => '100%',
                'condition'         => [
                    'layout_style' =>  'masonry',
                ],
                'selectors'         => [
                    '{{WRAPPER}} .premium-social-feed-element-wrap' => 'width: {{VALUE}}'
                ],
            ]
        );

        $this->add_control('direction',
            [
                'label'         => __( 'Direction', 'premium-addons-pro' ),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'ltr'    => [
                        'title' => __( 'Left to Right', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-chevron-circle-right',
                    ],
                    'rtl'   => [
                        'title' => __( 'Right to Left', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-chevron-circle-left',
                    ],
                ],
                'default'       => 'ltr',
            ]
        );

        $this->add_responsive_control('align',
            [
                'label'         => __( 'Content Alignment', 'premium-addons-pro' ),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'left'          => [
                        'title' => __( 'Left', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'        => [
                        'title' => __( 'Center', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'          => [
                        'title' => __( 'Right', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'justify'       => [
                        'title' => __( 'Justify', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-align-justify',
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-social-feed-text, {{WRAPPER}} .premium-read-button' => 'text-align: {{VALUE}}',
                ],
                'default'       => 'left',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('layout_settings',
            [
                'label'         => __('Advanced Settings', 'premium-addons-pro' )
            ]
        );

        $this->add_control('post_number',
            [
                'label'         => __( 'Posts/Account', 'premium-addons-pro' ),
                'type'          => Controls_Manager::NUMBER,
                'label_block'   => false,
                'description'       => __( 'How many posts will be shown for each account', 'premium-addons-pro' ),
                'default'       => 5
            ]
        );
        
        $this->add_control('content_length',
            [
                'label'         => __('Post Length','premium-addons-pro'),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 200,
            ]
        );

        $this->add_control('posts_media',
            [
                'label'         => __('Show Post Media','premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => 'Show',
                'label_off'     => 'Hide',
                'default'       => 'yes',
            ]
        );

        $this->add_control('show_avatar', 
            [
                'label'             => __('Show Avatar','premium-addons-pro'),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                    'block' => __('Show', 'premium-addons-pro'),
                    'none'  => __('Hide', 'premium-addons-pro'),
                ],
                'default'           => 'block',
                'selectors'         => [
                    '{{WRAPPER}} .premium-author-img'   => 'display: {{VALUE}}'
                ]
            ]
        );
        
        $this->add_control('show_date', 
            [
                'label'             => __('Show Date','premium-addons-pro'),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                    'block' => __('Show', 'premium-addons-pro'),
                    'none'  => __('Hide', 'premium-addons-pro'),
                ],
                'default'           => 'block',
                'selectors'         => [
                    '{{WRAPPER}} .premium-social-date'   => 'display: {{VALUE}}'
                ]
            ]
        );

        $this->add_control('read', 
            [
                'label'             => __('Show Read More Button','premium-addons-pro'),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                    'block' => __('Show', 'premium-addons-pro'),
                    'none'  => __('Hide', 'premium-addons-pro'),
                ],
                'default'           => 'block',
                'selectors'         => [
                    '{{WRAPPER}} .premium-read-button'   => 'display: {{VALUE}}'
                ]
            ]
        );
        
        $this->add_control('show_icon',
            [
                'label'             => __('Show Facebook Icon','premium-addons-pro'),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                    'inline-block' => __('Show', 'premium-addons-pro'),
                    'none'  => __('Hide', 'premium-addons-pro'),
                ],
                'default'           => 'inline-block',
                'selectors'         => [
                    '{{WRAPPER}} .premium-social-icon'   => 'display: {{VALUE}}'
                ]
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section('post_box_style',
            [
                'label'         => __('Post Box','premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'post_box' );

        $this->start_controls_tab('post_box_normal',
            [
                'label'         => __('Normal', 'premium-addons-pro'),
            ]
        );

        $this->add_control('post_box_background', 
            [
                'label'         => __('Background', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .premium-social-feed-element' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'post_box_border',
                'selector'      => '{{WRAPPER}} .premium-social-feed-element',
            ]
        );

        $this->add_control('post_box_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%' ,'em'],
                'default'       => [
                    'unit'  => 'px',
                    'size'  => 0,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-social-feed-element' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'post_box_shadow',
                'selector'      => '{{WRAPPER}} .premium-social-feed-element',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('post_box_hover',
            [
                'label'         => __('Hover', 'premium-addons-pro'),
            ]
        );

        $this->add_control('post_box_background_hover', 
            [
                'label'         => __('Background', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .premium-social-feed-element:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'post_box_border_hover',
                'selector'      => '{{WRAPPER}} .premium-social-feed-element:hover',
            ]
        );

        $this->add_control('post_box_border_radius_hover',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%' ,'em'],
                'default'       => [
                    'unit'  => 'px',
                    'size'  => 0,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-social-feed-element:hover' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'post_box_shadow_hover',
                'selector'      => '{{WRAPPER}} .premium-social-feed-element:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control('post_box_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'separator'     => 'before',
                'selectors'     => [
                    '{{WRAPPER}} .premium-social-feed-element' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control('post_box_padding',
                [
                    'label'     => __('Padding', 'premium-addons-pro'),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'size_units'=> ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .premium-social-feed-element' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('content_style',
            [
                'label'         => __('Content','premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control('content_color', 
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-social-feed-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'facebook_feed_content_typography',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .premium-social-feed-text',
            ]
        );

        $this->add_responsive_control('facebook_feed_content_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-social-feed-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control('facebook_feed_read_more_heading',
            [
                'label'         => __('Read More', 'premium-addons-pro'),
                'type'          => Controls_Manager::HEADING,
                'condition'     => [
                    'read'  => 'block'
                ],
            ]
        );

        $this->add_control('read_more_color', 
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                    ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-read-button' => 'color: {{VALUE}};',
                ],
                'condition'     => [
                    'read'  => 'block'
                ],
            ]
        );

        $this->add_control('read_more_color_hover', 
            [
                'label'         => __('Hover Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme' => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                    ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-read-button:hover' => 'color: {{VALUE}};',
                ],
                'condition'     => [
                    'read'  => 'block'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'facebook_feed_read_more_typography',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .premium-read-button',
                'condition'     => [
                    'read'  => 'block'
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section('avatar_style',
            [
                'label'         => __('Avatar','premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'show_avatar'    => 'block'
                ]
            ]
        );

        $this->add_responsive_control('avatar_size',
            [
                'label'         => __('Size', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px',"em", '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-social-feed-element .media-object ' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'avatar_border',
                'selector'      => '{{WRAPPER}} .premium-author-img img',
            ]
        );

        $this->add_control('avatar_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px',"em", '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-author-img img' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control('avatar_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-author-img img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('icon_style',
            [
                'label'         => __('Facebook Icon','premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'show_icon'    => 'inline-block'
                ]
            ]
        );

        $this->add_control('facebook_icon_color', 
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme' => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-social-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control('facebook_icon_size',
            [
                'label'         => __('Size', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px',"em"],
                'selectors'     => [
                    '{{WRAPPER}} .premium-social-icon' => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control('icon_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-social-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('title_style',
            [
                'label'         => __('Author','premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control('title_color', 
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-social-author-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control('title_hover_color', 
            [
                'label'         => __('Hover Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme' => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-social-author-title:hover a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'title_typography',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .premium-social-author-title a',
            ]
        ); 

        $this->add_responsive_control('title_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-social-author-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('date_style',
            [
                'label'         => __('Date','premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'show_date'  => 'block'
                ]
            ]
        );

        $this->add_control('date_color', 
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme' => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-social-date a' => 'color: {{VALUE}};',
                ],
                'separator'     => 'before',
            ]
        );

        $this->add_control('date_hover_color',
            [
                'label'         => __('Hover Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme' => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-social-date:hover a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'date_typography',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .premium-social-date a',
            ]
        ); 

        $this->add_responsive_control('date_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-social-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('general_style',
            [
                'label'         => __('Container','premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control('container_background', 
            [
                'label'         => __('Background', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .premium-facebook-feed-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'container_box_border',
                'selector'      => '{{WRAPPER}} .premium-facebook-feed-wrapper',
            ]
        );

        $this->add_control('container_box_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%' ,'em'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-facebook-feed-wrapper' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'container_box_shadow',
                'selector'      => '{{WRAPPER}} .premium-facebook-feed-wrapper',
            ]
        );

        $this->add_responsive_control('container_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-facebook-feed-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control('container_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-facebook-feed-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

	}
    
    /**
	 * renders the HTML content of the widget
	 * @return void
	 */
	protected function render() {

      	$settings = $this->get_settings();
        
        $layout_class = $settings['layout_style'] == 'list' ? 'list-layout' : 'grid-layout';
        
        $template = $settings['layout_style'] == 'list' ? 'list-template.php' : 'grid-template.php';

        $direction = $settings['direction'];

        $limit = !empty( $settings['post_number'] ) ? $settings['post_number'] : 2;
        
        $post_length = !empty( $settings['content_length'] ) ? $settings['content_length'] : 130;
        
        $show_media = ( $settings['posts_media'] == 'yes' ) ? true : false;
        
        $facebook_settings = [
            'accounts'  => esc_html($settings['account_id']),
            'limit'     => $limit,
            'accessTok' => esc_html($settings['access_token']),
            'length'    => $post_length,
            'showMedia' => $show_media,
            'layout'    => $layout_class,
            'template'  => plugins_url( '/templates/', __FILE__ ) . $template,
        ];
        
        $this->add_render_attribute('facebook', 'class', [ 'premium-facebook-feed-wrapper', $direction ] );
        
        $this->add_render_attribute('facebook', 'data-settings', wp_json_encode( $facebook_settings ) );
        
        $this->add_render_attribute('facebook-inner', 'id', 'premium-social-feed-container-' . $this->get_id() );
        
        $this->add_render_attribute('facebook-inner', 'class', [ 'premium-social-feed-container', $layout_class ] );
      
	?>

    <?php if( empty ( $settings['access_token'] ) ) : ?>
        <div class="premium-fbrev-error">
                <?php echo __('Please fill the required fields: App ID & Access Token','premium-addons-pro'); ?>
        </div>
    <?php else: ?>
        <div <?php echo $this->get_render_attribute_string('facebook'); ?>>
            <div <?php echo $this->get_render_attribute_string('facebook-inner') ?>></div>
            <div class="premium-loading-feed">
                <div class="premium-loader"></div>
            </div>
        </div>
    <?php endif;
	
	}
}