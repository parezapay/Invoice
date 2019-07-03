<?php

/**
 * Class: Premium_Divider
 * Name: Divider
 * Slug: premium-divider
 */

namespace PremiumAddonsPro\Widgets;

use PremiumAddons\Helper_Functions;
use PremiumAddons\Includes;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;

if( ! defined( 'ABSPATH' ) ) exit;

class Premium_Divider extends Widget_Base {

    protected $templateInstance;

    public function getTemplateInstance() {
        return $this->templateInstance = Includes\premium_Template_Tags::getInstance();
    }
    
    public function get_name(){
        return 'premium-divider';
    }
    
    public function get_title() {
        return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Divider', 'premium-addons-pro') );
    }
    
    public function get_icon(){
        return 'pa-pro-separator';
    }
    
    public function get_categories(){
        return ['premium-elements'];
    }
    
    public function get_script_depends() {
        return ['premium-pro-js'];
    }
    
    // Adding the controls fields for the Divider
    // This will controls the animation, colors and background, dimensions etc
    protected function _register_controls(){
        
        $this->start_controls_section('separator_section',
            [
                'label'         => __('Separator','premium-addons-pro'),
            ]
        );

        $this->add_control('content_lines_Number',
            [
                'label'         => __('Number of Lines', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'separators_one_span'   => __('One', 'premium-addons-pro'),
                    'separators_two_span'   => __('Two', 'premium-addons-pro'),
                    'separators_three_span' => __('Three', 'premium-addons-pro'),
                    'separators_four_span'  => __('Four', 'premium-addons-pro'),
                    'separators_five_span'  => __('Five', 'premium-addons-pro')
                ],
                'default'       => 'separators_one_span',
                'label_block'   => true
            ]
        );
        
        $this->add_control('left_and_right_separator_type',
            [
                'label'         => __( 'Style', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'solid'         => __( 'Solid', 'premium-addons-pro' ),
                    'double'        => __( 'Double', 'premium-addons-pro' ),
                    'dotted'        => __( 'Dotted', 'premium-addons-pro' ),
                    'dashed'        => __( 'Dashed', 'premium-addons-pro' ),
                    'groove'        => __( 'Groove', 'premium-addons-pro' ),
                    'shadow'        => __( 'Shadow', 'premium-addons-pro' ),
                    'gradient'      => __( 'Gradient', 'premium-addons-pro' ),
                    'curvedbot'     => __( 'Curved Bottom', 'premium-addons-pro' ),
                    'curvedtop'     => __( 'Curved Top', 'premium-addons-pro' ),
                    'custom'        => __( 'Custom', 'premium-addons-pro' )
                ],
                'default'       =>'solid',
            ]
        );
        
        $this->add_control('left_separator_image',
            [
                'label'         => __( 'Left Line Image', 'premium-addons-pro' ),
                'type'          => Controls_Manager::MEDIA,
                'dynamic'       => [ 'active' => true ],
                'condition'     => [
                    'left_and_right_separator_type'     => 'custom'
                ],
                'label_block'   => true,
            ]
        );
        
        $this->add_control('right_separator_image',
            [
                'label'         => __( 'Right Line Image', 'premium-addons-pro' ),
                'type'          => Controls_Manager::MEDIA,
                'dynamic'       => [ 'active' => true ],
                'condition'     => [
                    'left_and_right_separator_type'     => 'custom'
                ],
                'label_block'   => true,
            ]
        );

        $this->add_responsive_control('content_and_separator_size',
            [
                'label'         => __('Container Width', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'range'         => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 400
                    ],
                    'em'    => [
                        'min'   => 0,
                        'max'   => 30
                    ]
                ],
                'label_block'   => true,
                'selectors'     => [
                    '{{WRAPPER}} .premium-separator-wrapper-separator-divider-main-inner' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control('content_link_switcher',
            [
                'label'         => __('Link', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Add a custom link or select an existing page link','premium-addons-pro')
            ]
        );

        $this->add_control('content_link_type', 
            [
                'label'         => __('Link/URL', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'url'   => __('URL', 'premium-addons-pro'),
                    'link'  => __('Existing Page', 'premium-addons-pro'),
                ],
                'default'       => 'url',
                'label_block'   => true,
                'condition'     => [
                   'content_link_switcher'  => 'yes'
                ]
            ]
        );

        $this->add_control('content_existing_page', 
            [
                'label'         => __('Existing Page', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT2,
                'options'       => $this->getTemplateInstance()->get_all_post(),
                'condition'     => [
                   'content_link_switcher'  => 'yes',
                    'content_link_type'     => 'link'
                ],
                'multiple'      => false,
                'label_block'   => true,
            ]
        );
 
        $this->add_control('content_url',
            [
                'label'         => __('URL', 'premium-addons-pro'),
                'type'          => Controls_Manager::URL,
                'dynamic'       => [ 'active' => true ],
                'placeholder'   => 'https://premiumaddons.com/',
                'condition'     => [
                    'content_link_switcher'  => 'yes',
                    'content_link_type'     => 'url',
                ],
                'label_block'   => true
            ]
        );
 
        $this->add_control('content_link_title',
            [
                'label'         => __('Link Title', 'premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'condition'     => [
                    'content_link_switcher' => 'yes',
                ],
                'label_block'   => true
            ]
        );
 
        $this->add_responsive_control('content_alignment',
            [
                'label'         => __( 'Alignment', 'premium-addons-pro' ),
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
                'default'       => 'center',
                'selectors'     => [
                    '{{WRAPPER}} .premium-separator-wrapper-separator-divider' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('content_section',
            [
                'label'         => __( 'Icon/Image/Text', 'premium-addons-pro' ),
            ]
        );
        
        $this->add_control('hide_icon',
            [
                'label'         => __('Show/Hide Icon', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'table-cell',
                'options'       => [
                    'table-cell'    => __('Show', 'premium-addons-pro'),
                    'none'          => __('Hide', 'premium-addons-pro')
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-separator-wrapper-separator-divider-icon' => 'display: {{VALUE}}',
                ],
            ]
        );

        $this->add_control('content_inside_separator',
            [
                'label'         => __('Icon/Text/Image', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'font_awesome_icon'   => __('Icon', 'premium-addons-pro'),
                    'custom_image'        => __('Image', 'premium-addons-pro'),
                    'text'                =>  __('Text', 'premium-addons-pro'),
                ],
                'default'       => 'font_awesome_icon',
                'label_block'   => true,
                'condition'     => [
                    'hide_icon' =>  'table-cell'
                ]
            ]
        );
 
        $this->add_control('content_font_awesome_icon',
            [
                'label'         => __('Icon', 'premium-addons-pro'),
                'type'          => Controls_Manager::ICON,
                'default'       => 'fa fa-heart',
                'condition'     => [
                    'hide_icon' =>  'table-cell',
                    'content_inside_separator'     => 'font_awesome_icon'
                ]
            ]
        );

        $this->add_control('content_image',
            [
                'label'         => __( 'Choose Image', 'premium-addons-pro' ),
                'type'          => Controls_Manager::MEDIA,
                'dynamic'       => [ 'active' => true ],
                'condition'     => [
                    'hide_icon' =>  'table-cell',
                    'content_inside_separator'     => 'custom_image'
                ],
                'label_block'   => true
            ]
        );
        
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'          => 'thumbnail',
                'default'       => 'thumbnail',
                'condition'     => [
                    'hide_icon' =>  'table-cell',
                    'content_inside_separator'     => 'custom_image'
                ],
            ]
        );

        $this->add_control('content_text',
            [
                'label'         => __( 'Text', 'premium-addons-pro' ),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'default'       => __( 'Separator', 'premium-addons-pro' ),
                'condition'     => [
                    'hide_icon' =>  'table-cell',
                   'content_inside_separator'  => 'text',
                ],
                'label_block' => true
            ]
        );

         $this->add_control('content_text_tag',
            [
                'label'         => __( 'HTML Tag', 'premium-addons-pro' ),
                'description'   => __( 'Select a Heading tag for the Separator Text. Headings are defined with H1 to H6 tags', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'h3',
                'options'       => [
                    'h1'    => 'H1',
                    'h2'    => 'H2',
                    'h3'    => 'H3',
                    'h4'    => 'H4',
                    'h5'    => 'H5',
                    'h6'    => 'H6'
                ],
                'condition'     => [
                    'hide_icon' =>  'table-cell',
                   'content_inside_separator'  => 'text'
                ],
                'label_block'   => true
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('separator_style_section',
            [
                'label'         => __( 'Separator', 'premium-addons-pro' ),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('separator_style_tabs');

        $this->start_controls_tab('separator_content_tab',
            [
                'label'         => __('Icon', 'premium-addons-pro'),
                'condition'     => [
                    'hide_icon' =>  'table-cell'
                ]
            ]
        );
 
        $this->add_responsive_control('content_size',
            [
                'label'         => __('Size', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'range'         => [
                    'em'    => [
                        'min'       => 0,
                        'max'       => 25
                    ]
                ],
                'condition'     => [
                    'hide_icon' =>  'table-cell',
                    'content_inside_separator'     => 'font_awesome_icon'
                ],
                'label_block'   => true,
                'selectors'     => [
                    '{{WRAPPER}} .premium-separator-wrapper-separator-divider-icon-inner i' => 'font-size: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
 
        $this->add_control('separator_content_color',
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition'     => [
                    'hide_icon' =>  'table-cell',
                    'content_inside_separator!'     => 'custom_image'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-separator-wrapper-separator-divider-icon-inner i, {{WRAPPER}} .premium-separator-text-icon .premium-separator-icon-text' => 'color: {{VALUE}};'
                ]
            ]
        );
         
        $this->add_control('separator_content_hover_color',
            [
                'label'         => __('Hover Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition'     => [
                    'hide_icon' =>  'table-cell',
                    'content_inside_separator!'     => 'custom_image'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-separator-container:hover .premium-separator-icon i, {{WRAPPER}} .premium-separator-container:hover .premium-separator-icon-text' => 'color: {{VALUE}};'
                ]
            ]
        );
 
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'separator_typhography',
                'condition'     => [
                    'hide_icon' =>  'table-cell',
                    'content_inside_separator'     => 'text'
                ],
                'selector'      => '{{WRAPPER}} .premium-separator-icon-text'
            ]
        );
 
        $this->add_control('separator_content_background',
            [
                'label'         => __('Background', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'condition'     => [
                    'hide_icon' =>  'table-cell'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-separator-wrapper-separator-divider-icon-inner *' => 'background: {{VALUE}};'
                ]
            ]
        );
 
        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'separator_content_border',
                'condition'     => [
                    'hide_icon' =>  'table-cell'
                ],
                'selector'      => '{{WRAPPER}} .premium-separator-wrapper-separator-divider-icon-inner *'
            ]
        );
 
        $this->add_control('separator_content_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em' , '%'],
                'condition'     => [
                    'hide_icon' =>  'table-cell'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-separator-wrapper-separator-divider-icon-inner *' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
 
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'separator_content_box_shadow',
                'condition'     => [
                    'hide_icon' =>  'table-cell'
                ],
                'selector'      => '{{WRAPPER}} .premium-separator-wrapper-separator-divider-icon-inner *'
            ]
        );
 
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'          => 'separator_content_text_shadow',
                'condition'     => [
                    'hide_icon' =>  'table-cell'
                ],
                'selector'      => '{{WRAPPER}} .premium-separator-wrapper-separator-divider-icon-inner *'
            ]
        );

        $this->add_responsive_control('separator_content_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em','%' ],
                'condition'     => [
                    'hide_icon' =>  'table-cell'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-separator-wrapper-separator-divider-icon-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
 
        $this->add_responsive_control('separator_content_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'condition'     => [
                    'hide_icon' =>  'table-cell'
                ],
                'size_units'    => [ 'px', 'em','%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-separator-wrapper-separator-divider-icon-inner *' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_tab();
        
        $this->start_controls_tab('separator_lines_tab',
            [
                'label'         => __('Separator', 'premium-addons-pro'),
            ]
        );

        $this->add_responsive_control('left_separator_width',
            [
                'label'         => __('Left Width (%)', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'label_block'   => true,
                'selectors'     => [
                    '{{WRAPPER}} .premium-separator-wrapper-separator-divider-left' => 'width: {{SIZE}}%;'
                ]
            ]
        );
         
        $this->add_responsive_control('right_separator_width',
            [
                'label'         => __('Right Width (%)', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'label_block'   => true,
                'selectors'     => [
                    '{{WRAPPER}} .premium-separator-wrapper-separator-divider-right' => 'width: {{SIZE}}%;'
                ]
            ]
        );
 
        $this->add_responsive_control('left_and_right_separator_height',
            [
                'label'         => __('Height', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em'],
                'label_block'   => true,
                'condition'     => [
                    'left_and_right_separator_type!'  => [ 'curved' ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-separator-wrapper-separator-divider-left hr,{{WRAPPER}} .premium-separator-wrapper-separator-divider-right hr' => 'border-top-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .premium-separator-curvedtop .premium-separator-left-side hr, {{WRAPPER}} .premium-separator-curvedtop .premium-separator-right-side hr' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .premium-separator-shadow .premium-separator-left-side hr, {{WRAPPER}} .premium-separator-shadow .premium-separator-right-side hr, {{WRAPPER}} .premium-separator-gradient .premium-separator-left-side hr, {{WRAPPER}} .premium-separator-gradient .premium-separator-right-side hr' => 'height: {{SIZE}}{{UNIT}}',
                ]
            ]
        );
        
        $this->add_responsive_control('left_and_right_separator_top_space',
            [
                'label'         => __('Space Between Lines', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => [ 'px', 'em','%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-separator-wrapper-separator-divider-left hr,{{WRAPPER}} .premium-separator-wrapper-separator-divider-right hr' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control('left_separator_heading',
            [
                'label'         => __('Left', 'premium-addons-pro'),
                'type'          => Controls_Manager::HEADING,
            ]
        );
     
        $this->add_control('left_separator_color',
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'condition'     => [
                    'left_and_right_separator_type!'  => [ 'custom', 'gradient' ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-separator-wrapper-separator-divider-left hr' => 'border-top-color: {{VALUE}};',
                    '{{WRAPPER}} .premium-separator-curvedtop .premium-separator-left-side hr' => 'border-bottom-color: {{VALUE}}',
                    '{{WRAPPER}} .premium-separator-shadow .premium-separator-left-side hr' => 'background-color: {{VALUE}};'
                ],
            ]
        );
        
        $this->add_responsive_control('left_separator_slices',
            [
                'label'         => __('Number of Slices', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 1000
                    ]
                ],
                'label_block'   => true,
                'condition'     => [
                    'left_and_right_separator_type'  => [ 'custom' ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-separator-custom .premium-separator-left-side hr' => 'border-image-slice: {{SIZE}} !important;',
                ]
            ]
        );
        
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'left_shadow',
                'label'         => __('Shadow','premium-addons-pro'),
                'condition'     => [
                    'left_and_right_separator_type'  => [ 'shadow' ]
                ],
                'selector'      => '{{WRAPPER}} .premium-separator-shadow .premium-separator-left-side hr'
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'          => 'left_background',
                'types'         => [ 'gradient' ],
                'condition'     => [
                    'left_and_right_separator_type'  => [ 'gradient' ]
                ],
                'selector'      => '{{WRAPPER}} .premium-separator-gradient .premium-separator-left-side hr'
            ]
        );
        
        $this->add_control('right_separator_heading',
            [
                'label'         => __('Right', 'premium-addons-pro'),
                'type'          => Controls_Manager::HEADING,
            ]
        );
 
        $this->add_control('right_separator_color',
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'condition'     => [
                    'left_and_right_separator_type!'  => [ 'custom', 'gradient']
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-separator-wrapper-separator-divider-right hr' => 'border-top-color: {{VALUE}};',
                    '{{WRAPPER}} .premium-separator-curvedtop .premium-separator-right-side hr' => 'border-bottom-color: {{VALUE}}',
                    '{{WRAPPER}} .premium-separator-shadow .premium-separator-right-side hr' => 'background-color: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_responsive_control('right_separator_slices',
            [
                'label'         => __('Number of Slices', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 1000
                    ]
                ],
                'label_block'   => true,
                'condition'     => [
                    'left_and_right_separator_type'  => [ 'custom' ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-separator-custom .premium-separator-right-side hr' => 'border-image-slice: {{SIZE}} !important;',
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'right_shadow',
                'label'         => __('Gradient','premium-addons-pro'),
                'condition'     => [
                    'left_and_right_separator_type'  => [ 'shadow' ]
                ],
                'selector'      => '{{WRAPPER}} .premium-separator-shadow .premium-separator-right-side hr'
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'          => 'right_background',
                'types'         => [ 'gradient' ],
                'condition'     => [
                    'left_and_right_separator_type'  => [ 'gradient' ]
                ],
                'selector'      => '{{WRAPPER}} .premium-separator-gradient .premium-separator-right-side hr'
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
       
        $this->end_controls_section();
        
        $this->start_controls_section('container_style', 
            [
                'label'         => __('Container', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'          => 'container_background',
                'types'         => [ 'classic' , 'gradient' ],
                'selector'      => '{{WRAPPER}} .premium-separator-container',
            ]
        );
        
        $this->add_responsive_control('container_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-separator-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );

        $this->add_responsive_control('container_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-separator-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );
        
        $this->end_controls_section();

    }
    
    /**
     * renders the HTML content of the widget
     * @return void
     */
    protected function render(){
        
        $settings = $this->get_settings_for_display();
        
        $this->add_inline_editing_attributes('content_text', 'basic');
        
        $this->add_render_attribute('content_text', 'class', 'premium-separator-icon-text');
        
        $this->add_render_attribute('left_sep', 'class', ['premium-separator-wrapper-separator-divider-left', 'premium-separator-left-side'] );
        
        $this->add_render_attribute('right_sep', 'class', ['premium-separator-wrapper-separator-divider-right', 'premium-separator-right-side'] );
        
        if( 'custom' === $settings['left_and_right_separator_type'] ) {
            $this->add_render_attribute('left_sep', 'data-background', $settings['left_separator_image']['url'] );
        }
        
        if( 'custom' === $settings['left_and_right_separator_type'] ) {
            $this->add_render_attribute('right_sep', 'data-background', $settings['right_separator_image']['url'] );
        }
        
        $separator_link_type = $settings['content_link_type'];
                            
        if ( 'url' == $separator_link_type ) {

            $link_url = $settings['content_url']['url'];

        } elseif ( 'link' == $separator_link_type  ) {

            $link_url = get_permalink( $settings['content_existing_page']);

        }
        
//        $separator_settings = [
//            'style'    => $settings['left_and_right_separator_type'],
//        ];
        
?>
    <div id="premium-separator-container-<?php echo esc_attr($this->get_id()); ?>" class="premium-separator-container <?php echo 'premium-separator-' . esc_attr( $settings['left_and_right_separator_type'] ); ?>" data-settings='<?php echo $settings['left_and_right_separator_type']; ?>'>
        <div class="premium-separator-wrapper">
            <div class="premium-separator-wrapper-separator">
                <div class="premium-separator-wrapper-separator-divider">
                    <div class="premium-separator-wrapper-separator-divider-main-inner">
                        <?php if ( 'yes' == $settings['content_link_switcher'] ) : ?>
                        
                            <a class="premium-separator-item-link" href="<?php echo esc_url( $link_url ); ?>" title="<?php echo $settings['content_link_title']; ?>" <?php if( ! empty( $settings['content_url']['is_external'] ) ) : ?>target="_blank"<?php endif; ?><?php if( ! empty( $settings['content_url']['nofollow'] ) ) : ?>rel="nofollow"<?php endif; ?>><?php endif; ?>
                                
                            <div class="premium-separator-wrapper-separator-divider-inner">
                                <div <?php echo $this->get_render_attribute_string('left_sep'); ?>>
                                    <?php if( 'separators_one_span' == $settings['content_lines_Number'] ) {
                                            echo '<hr>';
                                        } elseif( 'separators_two_span' == $settings['content_lines_Number'] ){
                                            echo '<hr><hr>';
                                        } elseif( 'separators_three_span' == $settings['content_lines_Number'] ){
                                            echo '<hr><hr><hr>';
                                        } elseif( 'separators_four_span' == $settings['content_lines_Number'] ){
                                            echo '<hr><hr><hr><hr>';
                                        } elseif( 'separators_five_span' == $settings['content_lines_Number'] ){
                                            echo '<hr><hr><hr><hr><hr>';
                                        }
                                    ?>
                                </div>
                                <div class="premium-separator-wrapper-separator-divider-icon">
                                    <?php if( 'font_awesome_icon' == $settings['content_inside_separator'] ) : ?>
                                        <div class="premium-separator-wrapper-separator-divider-icon-inner premium-separator-icon">
                                            <i class="<?php echo $settings['content_font_awesome_icon']; ?>"></i>
                                        </div>
                                    <?php elseif( 'custom_image' == $settings['content_inside_separator'] ) : ?>
                                        <div class="premium-separator-wrapper-separator-divider-icon-inner premium-separator-img-icon">
                                            <?php
                                                $image_src = $settings['content_image'];
                                                
                                                $image_src_size = Group_Control_Image_Size::get_attachment_image_src( $image_src['id'], 'thumbnail', $settings );
                                                
                                                if( empty( $image_src_size ) ) : $image_src_size = $image_src['url']; else: $image_src_size = $image_src_size; endif;
                                                
                                            ?>
                                            <img src="<?php echo esc_attr( $image_src_size ); ?>">
                                        </div>
                                    <?php elseif( 'text' == $settings['content_inside_separator'] ) : ?>
                                    
                                        <div class="premium-separator-wrapper-separator-divider-icon-inner premium-separator-text-icon">
                                            <<?php echo $settings['content_text_tag'] . ' ' . $this->get_render_attribute_string('content_text');?>><?php echo $settings['content_text']; ?></<?php echo $settings['content_text_tag'];?>>
                                            
                                        </div>
                                    <?php endif; ?> 
                                </div>
                                <div <?php echo $this->get_render_attribute_string('right_sep'); ?>>
                                    <?php if( 'separators_one_span' == $settings['content_lines_Number'] ) {
                                        echo '<hr>';
                                    } elseif( 'separators_two_span' == $settings['content_lines_Number'] ){
                                        echo '<hr><hr>';
                                    } elseif( 'separators_three_span' == $settings['content_lines_Number'] ){
                                        echo '<hr><hr><hr>';
                                    } elseif( 'separators_four_span' == $settings['content_lines_Number'] ){
                                        echo '<hr><hr><hr><hr>';
                                    } elseif( 'separators_five_span' == $settings['content_lines_Number'] ){
                                        echo '<hr><hr><hr><hr><hr>';
                                    }
                                    ?>
                                </div>
                            </div>
                                
                        <?php if( 'yes' == $settings['content_link_switcher'] ) : ?>
                            </a>
                        <?php endif; ?>
                        
                        </div>
                    
                    </div>
                
            </div>
            
            <div class="premium-clearfix"></div>
            
        </div>
        
    </div>

<?php

    }
    
    protected function _content_template() {
        ?>
        <#
        
            var separatorType = settings.left_and_right_separator_type,
                
                textTag = settings.content_text_tag;
            
            view.addInlineEditingAttributes('content_text', 'basic');
            
            view.addRenderAttribute( 'content_text', 'class', 'premium-separator-icon-text' );
        
            view.addRenderAttribute('left_sep', 'class', ['premium-separator-wrapper-separator-divider-left', 'premium-separator-left-side'] );
        
            view.addRenderAttribute('right_sep', 'class', ['premium-separator-wrapper-separator-divider-right', 'premium-separator-right-side'] );
            
            view.addRenderAttribute('separator_container', 'id', 'premium-separator-container-' + view.getIDInt() );
            
            view.addRenderAttribute('separator_container', 'class', [ 'premium-separator-container', 'premium-separator-' + separatorType ] );
            
            view.addRenderAttribute('separator_container', 'data-settings', separatorType );
            
            if( 'custom' === separatorType ) {
                view.addRenderAttribute('left_sep', 'data-background', settings.left_separator_image.url );
            }
        
            if( 'custom' === separatorType ) {
                view.addRenderAttribute('right_sep', 'data-background', settings.right_separator_image.url );
            }
            
            var separatorLinkType = settings.content_link_type;
                            
            if ( 'url' == separatorLinkType ) {

                linkUrl = settings.content_url.url;

            } else if ( 'link' == separatorLinkType  ) {

                linkUrl = settings.content_existing_page;

            }
        
        #>
        
        <div {{{ view.getRenderAttributeString('separator_container') }}}>
            <div class="premium-separator-wrapper">
                <div class="premium-separator-wrapper-separator">
                    <div class="premium-separator-wrapper-separator-divider">
                        <div class="premium-separator-wrapper-separator-divider-main-inner">
                            <# if ( 'yes' == settings.content_link_switcher ) { #>
                                <a class="premium-separator-item-link" href="{{ linkUrl }}" title="{{ settings.content_link_title }}">
                            <# } #>
                            <div class="premium-separator-wrapper-separator-divider-inner">
                                <div {{{ view.getRenderAttributeString('left_sep') }}}>
                                    <# if( 'separators_one_span' == settings.content_lines_Number ) { #>
                                        <hr>
                                    <# } else if( 'separators_two_span' == settings.content_lines_Number ) { #>
                                       <hr><hr>
                                    <# } else if( 'separators_three_span' == settings.content_lines_Number ) { #>
                                        <hr><hr><hr>
                                    <# } else if( 'separators_four_span' == settings.content_lines_Number ) { #>
                                        <hr><hr><hr><hr>
                                    <# } else if( 'separators_five_span' == settings.content_lines_Number ) { #>
                                        <hr><hr><hr><hr><hr>
                                    <# } #>
                                </div>
                                <div class="premium-separator-wrapper-separator-divider-icon">
                                    <# if( 'font_awesome_icon' == settings.content_inside_separator ) { #>
                                        <div class="premium-separator-wrapper-separator-divider-icon-inner premium-separator-icon">
                                            <i class="{{ settings.content_font_awesome_icon }}"></i>
                                        </div>
                                    <# } else if( 'custom_image' == settings.content_inside_separator ) { #>
                                        <div class="premium-separator-wrapper-separator-divider-icon-inner premium-separator-img-icon">
                                            <#
                                            
                                            var image = {
                                                    id: settings.content_image.id,
                                                    url: settings.content_image.url,
                                                    size: settings.thumbnail_size,
                                                    dimension: settings.thumbnail_custom_dimension,
                                                    model: view.getEditModel()
                                                };
                        
                                            var image_url = elementor.imagesManager.getImageUrl( image );
                                                
                                            #>
                                            <img src="{{ image_url }}">
                                        </div>
                                    <# } else if( 'text' == settings.content_inside_separator ) { #>
                                    
                                        <div class="premium-separator-wrapper-separator-divider-icon-inner premium-separator-text-icon">
                                            <{{{textTag}}} {{{ view.getRenderAttributeString('content_text') }}}>{{{settings.content_text}}}</{{{textTag}}}>
                                            
                                        </div>
                                    <# } #>
                                </div>
                                <div {{{ view.getRenderAttributeString('right_sep') }}}>
                                    <# if( 'separators_one_span' == settings.content_lines_Number ) { #>
                                        <hr>
                                    <# } else if( 'separators_two_span' == settings.content_lines_Number ) { #>
                                       <hr><hr>
                                    <# } else if( 'separators_three_span' == settings.content_lines_Number ) { #>
                                        <hr><hr><hr>
                                    <# } else if( 'separators_four_span' == settings.content_lines_Number ) { #>
                                        <hr><hr><hr><hr>
                                    <# } else if( 'separators_five_span' == settings.content_lines_Number ) { #>
                                        <hr><hr><hr><hr><hr>
                                    <# } #>
                                </div>
                            </div>
                            <# if( 'yes' == settings.content_link_switcher ) { #>
                                </a>
                            <# } #>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
    }
}