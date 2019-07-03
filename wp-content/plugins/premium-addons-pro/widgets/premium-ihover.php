<?php

/**
 * Class: Premium_Ihover
 * Name: iHover
 * Slug: premium-ihover
 */

namespace PremiumAddonsPro\Widgets;

use PremiumAddons\Helper_Functions;
use PremiumAddons\Includes;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Css_Filter;

if( ! defined( 'ABSPATH' ) ) exit;

class Premium_Ihover extends Widget_Base {

    protected $templateInstance;
    
    public function getTemplateInstance() {
        return $this->templateInstance = Includes\premium_Template_Tags::getInstance();
    }

    public function get_name() {
        return 'premium-ihover';
    }
    
    public function get_title() {
        return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('iHover', 'premium-addons-pro') );
    }
    
    public function get_icon() {
        return 'pa-pro-ihover';
    }
    
    public function get_categories() {
        return ['premium-elements'];
    }
    
    
    // Adding the controls fields for the iHover
    // This will controls the animation, colors and background, dimensions etc
    protected function _register_controls(){

        $this->start_controls_section('premium_ihover_image_content_section',
            [
                'label'         => __('Image','premium-addons-pro'),
            ]
        );

        $this->add_control('premium_ihover_thumbnail_front_image',
            [
                'label'         => __( 'Choose Image', 'premium-addons-pro' ),
                'type'          => Controls_Manager::MEDIA,
                'dynamic'       => [ 'active' => true ],
                'default'       => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block'   => true
            ]
        );
        
        $this->add_responsive_control('premium_ihover_thumbnail_size',
            [
                'label'         => __('Size', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'range'         => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 500
                    ],
                    'em'    => [
                        'min'   => 0,
                        'max'   => 20
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-item.style20 .premium-ihover-spinner, {{WRAPPER}} .premium-ihover-item, {{WRAPPER}} .premium-ihover-img-wrap, {{WRAPPER}} .premium-ihover-img-wrap .premium-ihover-img, {{WRAPPER}} .premium-ihover-info-wrap' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_control('premium_ihover_thumbnail_hover_effect',
            [
                'label'         => __( 'Hover Effect', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'style18',
                'options'       => [
                    'style18'       => 'Advertising',
                    'style19'       => 'Book Cover',
                    'style10'       => 'Backward',
                    'style15'       => 'Faded In Background',
                    'style17'       => 'Flash Rotation',
                    'style4'        => 'Flip Background',
                    'style16'       => 'Flip Door',
                    'style9'        => 'Heroes Flying-Top',
                    'style9-1'      => 'Heroes Flying-Bottom',
                    'style9-2'      => 'Heroes Flying-Right',
                    'style14'       => 'Magic Door',
                    'style2'        => 'Reduced Image-Top',
                    'style2-2'      => 'Reduced Image-Right',
                    'style6'        => 'Reduced Image-Bottom',
                    'style2-1'      => 'Reduced Image-Left',
                    'style7'        => 'Rotated Image-Left',
                    'style7-1'      => 'Rotated Image-Right',
                    'style13'       => 'Rotated Wheel Image-Left',
                    'style8'        => 'Rotating Wheel-Left',
                    'style8-1'      => 'Rotating Wheel-Top',
                    'style8-2'      => 'Rotating Wheel-Bottom',
                    'style8-3'      => 'Rotating Wheel-Right',
                    'style1'        => 'Rotor Cube',
                    'style11'       => 'Slided Out Image',
                    'style12'       => 'Slided In Image',
                    'style20'       => 'Spinner',
                    'style5'        => 'Zoom In ',
                    'style5-1'      => 'Zoom Out'
                ],
                'label_block'   => true,
            ]
        );
         
        $this->add_control('premium_ihover_thumbnail_link_switcher',
            [
                'label'         => __('Link', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Add a custom link or select an existing page link','premium-addons-pro')
            ]
        );

        $this->add_control('premium_ihover_thumbnail_link_type', 
            [
                'label'         => __('Link/URL', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'url'   => __('URL', 'premium-addons-pro'),
                    'link'  => __('Existing Page', 'premium-addons-pro'),
                ],
                'default'       => 'url',
                'condition'     => [
                   'premium_ihover_thumbnail_link_switcher'  => 'yes',
                ],
                'label_block'   => true,
            ]
        );

        $this->add_control('premium_ihover_thumbnail_existing_page', 
            [
                'label'         => __('Existing Page', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT2,
                'options'       => $this->getTemplateInstance()->get_all_post(),
                'condition'     => [
                   'premium_ihover_thumbnail_link_switcher'  => 'yes',
                    'premium_ihover_thumbnail_link_type'     => 'link',
                ],
                'multiple'      => false,
                'label_block'   => true,
            ]
        );

        $this->add_control('premium_ihover_thumbnail_url',
            [
                'label'         => __('URL', 'premium-addons-pro'),
                'type'          => Controls_Manager::URL,
                'dynamic'       => [ 'active' => true ],
                'placeholder'   => 'https://premiumaddons.com/',
                'default'       => [
                  'url'     => '#'
                ],
                'condition'     => [
                    'premium_ihover_thumbnail_link_switcher'  => 'yes',
                    'premium_ihover_thumbnail_link_type'     => 'url',
                ],
                'label_block'   => true
            ]
        );

        $this->add_control('premium_ihover_thumbnail_link_text',
            [
                'label'         => __('Link Title', 'premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'condition'     => [
                    'premium_ihover_thumbnail_link_switcher' => 'yes',
                ],
                'label_block'   => true
            ]
        );

        $this->add_control('premium_ihover_thumbnail_alignment', 
            [
                'label'         => __('Alignment', 'premium-addons-pro'),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'left'  => [
                        'title'     => __('Left', 'premium-addons-pro'),
                        'icon'      => 'fa fa-align-left'
                    ],
                    'center'=> [
                        'title'     => __('Center', 'premium-addons-pro'),
                        'icon'      => 'fa fa-align-center'
                    ],
                    'right' => [
                        'title'     => __('Right', 'premium-addons-pro'),
                        'icon'      => 'fa fa-align-right'
                    ],
                ],
                'default'       => 'center',
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-list' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'premium_ihover_css_classes',
            [
                'label'         => __( 'CSS Classes', 'premium-addons-pro' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'label_block'   => true,
                'title'         => __( 'Add your custom class without the dot. e.g: my-class', 'premium-addons-pro' )
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section('premium_ihover_description_content_section',
            [
                'label'         => __('Content','premium-addons-pro'),
            ]
        );
        
        $this->add_control('premium_ihover_icon_fa_switcher',
            [
                'label'         => __('Icon', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
            ]
        );
        
        $this->add_control('premium_ihover_icon_selection',
            [
                'label'         => __('Icon Type', 'premium-addons-pro'),
                'description'   => __('Select type for the icon', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'icon',
                'options'       => [
                    'icon'  => __('Font Awesome Icon','premium-addons-pro'),
                    'image' => __('Custom Image','premium-addons-pro'),
                ],
                'label_block'   =>  true,
                'condition'     => [
                    'premium_ihover_icon_fa_switcher' => 'yes',
                ],
            ]
        );
        
        $this->add_control('premium_ihover_icon_fa', 
            [
                'label'         => __('Icon', 'premium-addons-pro'),
                'description'   => __( 'Choose an Icon for Front Side', 'premium-addons-pro' ),
                'type'          => Controls_Manager::ICON,
                'label_block'   => true,
                'default'       => 'fa fa-picture-o',
                'condition'     => [
                    'premium_ihover_icon_fa_switcher' => 'yes',
                    "premium_ihover_icon_selection"   => 'icon'
                ],
            ]
        );
        
        $this->add_control('premium_ihover_icon_image',
            [
                'label'         => __('Image', 'premium-addons-pro'),
                'type'          => Controls_Manager::MEDIA,
                'default'       => [
                    'url'   => Utils::get_placeholder_image_src(),
                    ],
                'description'   => __('Choose the icon image', 'premium-addons-pro' ),
                'label_block'   => true,
                'condition'     => [
                    'premium_ihover_icon_fa_switcher' => 'yes',
                    "premium_ihover_icon_selection"   => 'image'
                ]
            ]
        );

        $this->add_control('premium_ihover_icon_size',
            [
                'label'         => __('Icon Size', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px','em','%'],
                'default'       => [
                    'size'  => 30,
                ],
                'range'         => [
                    'px'    => [
                        'min' => 5,
                        'max' => 80
                    ],
                ],
                'selectors'         => [
                    '{{WRAPPER}} .premium-ihover-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .premium-ihover-icon-image' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition'      => [
                    'premium_ihover_icon_fa_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control('premium_ihover_thumbnail_back_title_switcher', 
            [
                'label'         => __('Title', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Enable/Disable Title','premium-addons-pro'),
                'default'       => 'yes',
            ]
        );

        $this->add_control('premium_ihover_thumbnail_back_title',
            [
                'label'         => __( 'Text', 'premium-addons-pro' ),
                'placeholder'   => __( 'Awesome Title', 'premium-addons-pro' ),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'dynamic'       => [
                    'active'        => true,
                ],
                'default'       => __( 'Awesome Title', 'premium-addons-pro' ),
                'condition'     => [
                   'premium_ihover_thumbnail_back_title_switcher'  => 'yes',
                ],
                'label_block'   => false
            ]
        );

         $this->add_control('premium_ihover_thumbnail_back_title_tag',
            [
                'label'         => __( 'HTML Tag', 'premium-addons-pro' ),
                'description'   => __( 'Select a heading tag for the title. Headings are defined with H1 to H6 tags', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'h4',
                'options'       => [
                    'h1'    => 'H1',
                    'h2'    => 'H2',
                    'h3'    => 'H3',
                    'h4'    => 'H4',
                    'h5'    => 'H5',
                    'h6'    => 'H6'
                ],
                'condition'     => [
                   'premium_ihover_thumbnail_back_title_switcher'  => 'yes',
                ],
                'label_block'   => true,
            ]
        );

        $this->add_control('premium_ihover_thumbnail_back_separator_switcher', 
            [
                'label'         => __('Separator', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Enable/Disable Separator','premium-addons-pro'),
            ]
        );

        $this->add_control('premium_ihover_thumbnail_back_description_switcher', 
            [
                'label'         => __('Description', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Enable/Disable Description','premium-addons-pro'),
            ]
        );

        $this->add_control('premium_ihover_thumbnail_back_description',
            [
                'label'         => __( 'Text', 'premium-addons-pro' ),
                'type'          => Controls_Manager::WYSIWYG,
                'dynamic'       => [ 'active' => true ],
                'default'       => __( 'Cool Description', 'premium-addons-pro' ),
                'condition'     => [
                   'premium_ihover_thumbnail_back_description_switcher'  => 'yes',
                ],
                'dynamic'       => [
                    'active'    => true
                ],
                'label_block'   => true
            ]
        );

        /** Description Alignment **/
        $this->add_control('premium_ihover_description_alignment_content', 
            [
                'label'         => __('Alignment', 'premium-addons-pro'),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'left'  => [
                        'title'     => __('Left', 'premium-addons-pro'),
                        'icon'      => 'fa fa-align-left'
                    ],
                    'center'=> [
                        'title'     => __('Center', 'premium-addons-pro'),
                        'icon'      => 'fa fa-align-center'
                    ],
                    'right' => [
                        'title'     => __('Right', 'premium-addons-pro'),
                        'icon'      => 'fa fa-align-right'
                    ],
                ],
                'default'       => 'center',
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-content-wrap' => 'text-align: {{VALUE}}'
                ]
            ]
        );


        $this->end_controls_section();
        
        $this->start_controls_section('premium_ihover_front_image',
            [
                'label'         => __( 'Front Image', 'premium-addons-pro' ),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .premium-ihover-img',
			]
		);
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_ihover_icon_style_section',
            [
                'label'         => __( 'Icon', 'premium-addons-pro' ),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'premium_ihover_icon_fa_switcher'  => 'yes'
                ]
            ]
        );
        
        $this->add_control('premium_ihover_fa_color_selection',
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-icon' => 'color: {{VALUE}};',
                ],
                'condition'     => [
                    'premium_ihover_icon_selection'   => 'icon'
                ]
            ]
        );
        
        $this->add_control('premium_ihover_icon_background',
            [
                'label'         => __('Background Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-icon, {{WRAPPER}} .premium-ihover-icon-image'    => 'background: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'premium_ihover_icon_border',
                'selector'      => '{{WRAPPER}} .premium-ihover-icon,{{WRAPPER}} .premium-ihover-icon-image',
            ]
        );
        
        $this->add_control('premium_ihover_icon_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px','em','%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-icon, {{WRAPPER}} .premium-ihover-icon-image'  => 'border-radius: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'label'         => __('Shadow','premium-addons-pro'),
                'name'          => 'premium_ihover_icon_shadow',
                'selector'      => '{{WRAPPER}} .premium-ihover-icon, {{WRAPPER}} .premium-ihover-icon-image',
                'condition'     => [
                    'premium_ihover_icon_selection'   => 'icon'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label'         => __('Shadow','premium-addons-pro'),
                'name'          => 'premium_ihover_image_shadow',
                'selector'      => '{{WRAPPER}} .premium-ihover-icon-image',
                'condition'     => [
                    'premium_ihover_icon_selection'   => 'image'
                ]
            ]
        );

        $this->add_responsive_control('premium_ihover_icon_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-icon , {{WRAPPER}} .premium-ihover-icon-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control('premium_ihover_icon_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-icon, {{WRAPPER}} .premium-ihover-icon-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_ihover_title_style_section',
            [
                'label'         => __( 'Title', 'premium-addons-pro' ),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'premium_ihover_thumbnail_back_title_switcher'  => 'yes'
                ]
            ]
        );
        
        $this->add_control('premium_ihover_thumbnail_title_color',
            [
                'label'         => __('Text Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'premium_ihover_thumbnail_title_typhography',
                'selector'      => '{{WRAPPER}} .premium-ihover-title'
            ]
        );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'          => 'premium_ihover_thumbnail_title_text_shadow',
                'selector'      => '{{WRAPPER}} .premium-ihover-title'
            ]
        );

        $this->add_responsive_control('premium_ihover_thumbnail_title_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em','%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control('premium_ihover_thumbnail_title_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em','%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_ihover_thumbnail_divider_style_tab',
            [
                'label'         => __('Separator', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                   'premium_ihover_thumbnail_back_separator_switcher'  => 'yes'
                ]
            ]
        );
        
        $this->add_control('premium_ihover_thumbnail_divider_color',
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-divider .premium-ihover-divider-line' => 'border-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control('premium_ihover_thumbnail_divider_type',
            [
                'label'         => __( 'Style', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'none'          => __( 'None', 'premium-addons-pro' ),
                    'solid'         => __( 'Solid', 'premium-addons-pro' ),
                    'double'        => __( 'Double', 'premium-addons-pro' ),
                    'dotted'        => __( 'Dotted', 'premium-addons-pro' ),
                ],
                'default'       =>'solid',
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-divider .premium-ihover-divider-line' => 'border-style: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_responsive_control('premium_ihover_thumbnail_divider_width',
            [
                'label'         => __('Width', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'description'   => __('Enter Separator width in (PX, EM, %), default is 100%', 'premium-addons-pro'),
                'size_units'    => ['px', 'em' , '%'],
                'range'         => [
                    'px'    => [
                        'min'       => 0,
                        'max'       => 450
                    ],
                    'em'    => [
                        'min'       => 0,
                        'max'       => 30
                    ]
                ],
                'label_block'   => true,
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-divider .premium-ihover-divider-line' => 'border-width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control('premium_ihover_thumbnail_divider_height',
            [
                'label'         => __('Height', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em'],
                'label_block'   => true,
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-divider' => 'height:{{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'premium_ihover_thumbnail_divider_box_shadow',
                'selector'      => '{{WRAPPER}} .premium-ihover-divider'
            ]
        );

        $this->add_responsive_control('premium_ihover_thumbnail_divider_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em','%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-divider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section('premium_ihover_thumbnail_description_style_tab',
            [
                'label'         => __('Description', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                   'premium_ihover_thumbnail_back_description_switcher'  => 'yes'
                ]
            ]
        );

        $this->add_control('premium_ihover_thumbnail_description_color',
            [
                'label'         => __('Text Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-description' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'premium_ihover_thumbnail_description_typhography',
                'selector'      => '{{WRAPPER}} .premium-ihover-description'
            ]
        );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'          => 'premium_ihover_thumbnail_description_text_shadow',
                'selector'      => '{{WRAPPER}} .premium-ihover-description'
            ]
        );

        $this->add_responsive_control('premium_ihover_thumbnail_description_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em','%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control('premium_ihover_thumbnail_description_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em','%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section('premium_ihover_thumbnail_spinner_style_section',
            [
                'label'         => __( 'Spinner', 'premium-addons-pro' ),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                   'premium_ihover_thumbnail_hover_effect'  => 'style20'
                ]
            ]
        );

        $this->add_control('premium_ihover_thumbnail_spinner_type',
            [
                'label'         => __( 'Style', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'none'          => __( 'None', 'premium-addons-pro' ),
                    'solid'         => __( 'Solid', 'premium-addons-pro' ),
                    'double'        => __( 'Double', 'premium-addons-pro' ),
                    'dotted'        => __( 'Dotted', 'premium-addons-pro' ),
                    'dashed'        => __( 'Dashed', 'premium-addons-pro' ),
                    'groove'        => __( 'Groove', 'premium-addons-pro' )
                ],
                'default'       =>'solid',
                'condition'     => [
                   'premium_ihover_thumbnail_hover_effect'  => 'style20'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-item.style20 .premium-ihover-spinner' => 'border-style: {{VALUE}};'
                ]
            ]
        );

        $this->add_control('premium_ihover_thumbnail_spinner_border_width',
            [
                'label'         => __('Border Width', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'condition'     => [
                   'premium_ihover_thumbnail_hover_effect'  => 'style20'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-item.style20 .premium-ihover-spinner' => 'border-width:{{SIZE}}{{UNIT}};'
                ]
            ]    
        );

        $this->add_control('premium_ihover_thumbnail_spinner_border_left_color',
            [
                'label'         => __('First Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition'     => [
                   'premium_ihover_thumbnail_hover_effect'  => 'style20'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-spinner' => 'border-top-color: {{VALUE}}; border-left-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control('premium_ihover_thumbnail_spinner_border_right_color',
            [
                'label'         => __('Second Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'condition'     => [
                   'premium_ihover_thumbnail_hover_effect'  => 'style20'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-spinner' => 'border-bottom-color: {{VALUE}};border-right-color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('premium_ihover_container_style_section',
            [
                'label'         => __( 'Container', 'premium-addons-pro' ),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control('premium_ihover_thumbnail_background_color',
            [
                'label'         => __('Overlay Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-info-back' => 'background: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_control('premium_ihover_container_background',
            [
                'label'         => __('Background', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-item-wrap' => 'background: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'premium_ihover_container_border',
                'selector'      => '{{WRAPPER}} .premium-ihover-item-wrap',
                'condition'     => [
                   'premium_ihover_thumbnail_hover_effect!'  => 'style20'
                ]
            ]
        );
        
        $this->add_control('premium_ihover_container_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em' , '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-item-wrap, {{WRAPPER}} .premium-ihover-img, {{WRAPPER}} .premium-ihover-info-back, {{WRAPPER}} .premium-ihover-spinner' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'premium_ihover_container_box_shadow',
                'selector'      => '{{WRAPPER}} .premium-ihover-img',
            ]
        );

        
        $this->add_responsive_control('premium_ihover_container_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em','%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-item-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_responsive_control('premium_ihover_container_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em','%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-ihover-item-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->end_controls_section();
        
    }
    
    /**
     * renders the HTML content of the link
     * @return void
     */
    protected function get_link( $settings ) {
        
        $ihover_link_type = $settings['premium_ihover_thumbnail_link_type'];
        
        if ( 'url' == $ihover_link_type ) {
            $link_url = $settings['premium_ihover_thumbnail_url']['url'];
        } elseif ( 'link' == $ihover_link_type ) {
            $link_url = get_permalink( $settings['premium_ihover_thumbnail_existing_page' ]);
        }
        
        $this->add_render_attribute('link', 'class', 'premium-ihover-item-link');
        
        $this->add_render_attribute('link', 'href', $link_url );
        
        $this->add_render_attribute('link', 'title', $settings['premium_ihover_thumbnail_link_text'] );
        
        if( ! empty( $settings['premium_ihover_thumbnail_url']['is_external'] ) ) {
            $this->add_render_attribute('link', 'target', '_blank' );
        }
        
        if( ! empty( $settings['premium_ihover_thumbnail_url']['nofollow'] ) ) {
            $this->add_render_attribute('link', 'rel', 'nofollow' );
        }
        
        ?>
            <a <?php echo $this->get_render_attribute_string('link'); ?>>
        <?php 
    
    }


    /**
     * renders the HTML content of the widget
     * @return void
     */
    protected function render(){
        
        $settings = $this->get_settings_for_display();
        
        $this->add_render_attribute('container', 'class', [ 'premium-ihover-container', $settings['premium_ihover_css_classes'] ] );
        
        $ihover_title_tag = $settings['premium_ihover_thumbnail_back_title_tag'];
        
        $this->add_inline_editing_attributes('title', 'basic');
        
        $this->add_render_attribute('title', 'class', 'premium-ihover-title');
        
        $this->add_inline_editing_attributes('description', 'advanced');
        
        $this->add_render_attribute('description', 'class', 'premium-ihover-description');
        
        $this->add_render_attribute('item', 'class', [ 'premium-ihover-item', $settings['premium_ihover_thumbnail_hover_effect' ] ] );
        
        $this->add_render_attribute('img', 'class', 'premium-ihover-img' );
        
        $this->add_render_attribute('img', 'src', $settings['premium_ihover_thumbnail_front_image' ]['url'] );
        
        ?>
        <div <?php echo $this->get_render_attribute_string('container'); ?>>
            <div class="premium-ihover-list">
                <div class="premium-ihover-item-wrap">
                <?php 
                    if ( 'yes' == $settings['premium_ihover_thumbnail_link_switcher'] ) :
                        echo $this->get_link($settings);
                    endif; 
                ?>
                    <div <?php echo $this->get_render_attribute_string('item'); ?>>
                        <?php if( 'style20' == $settings['premium_ihover_thumbnail_hover_effect'] ) { ?>
                            <div class="premium-ihover-spinner"></div>
                        <?php } ?>
                        <div class="premium-ihover-img-wrap">
                            <div class="premium-ihover-img-front">
                                <div class="premium-ihover-img-inner-wrap"></div>
                                <img <?php echo $this->get_render_attribute_string('img'); ?>>
                            </div>
                        </div>
                        <div class="premium-ihover-info-wrap">
                            <div class="premium-ihover-info-back">
                                <div class="premium-ihover-content">
                                    <div class="premium-ihover-content-wrap">
                                        <div class="premium-ihover-title-wrap">
                                            <?php if( 'yes' == $settings['premium_ihover_icon_fa_switcher'] && 'icon' == $settings['premium_ihover_icon_selection'] ) : ?>
                                            <i class="premium-ihover-icon <?php echo $settings['premium_ihover_icon_fa']; ?>"></i>
                                            <?php elseif( 'yes' == $settings['premium_ihover_icon_fa_switcher'] && 'image' == $settings['premium_ihover_icon_selection'] ) : ?>
                                            <img alt="Premium iHover Image" class="premium-ihover-icon-image" src="<?php echo $settings['premium_ihover_icon_image']['url']; ?>">
                                            <?php endif; ?>
                                        
                                        
                                        <?php if( 'yes' == $settings['premium_ihover_thumbnail_back_title_switcher'] ) : ?>
                                            <<?php echo $ihover_title_tag . ' ' . $this->get_render_attribute_string('title'); ?>><?php echo esc_html( $settings['premium_ihover_thumbnail_back_title'] ); ?></<?php echo $ihover_title_tag; ?>>
                                        <?php endif; ?>
                                            
                                        </div>
                                        
                                        <?php if( 'yes' == $settings['premium_ihover_thumbnail_back_separator_switcher'] ) : ?>
                                            <div class="premium-ihover-divider"><span class="premium-ihover-divider-line"></span></div>
                                        <?php endif; ?>
                                            
                                        <?php if( 'yes' == $settings['premium_ihover_thumbnail_back_description_switcher'] ) : ?>
                                            
                                        <div <?php echo $this->get_render_attribute_string('description'); ?>><?php echo $settings['premium_ihover_thumbnail_back_description']; ?></div>
                                        
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        if ( 'yes' == $settings['premium_ihover_thumbnail_link_switcher'] ) :
                            echo '</a>';
                        endif; 
                    ?>
                </div>
            </div>  
        </div>
    <?php 
    }
    
    protected function _content_template() {
        ?>
        <#
        
            view.addRenderAttribute('container', 'class', [ 'premium-ihover-container', settings.premium_ihover_css_classes ] );
        
            var titleTag = settings.premium_ihover_thumbnail_back_title_tag,
            
                linkUrl = 'url' == settings.premium_ihover_thumbnail_link_type ? settings.premium_ihover_thumbnail_url.url : settings.premium_ihover_thumbnail_existing_page,
                
                hoverEffect = settings.premium_ihover_thumbnail_hover_effect;

            view.addInlineEditingAttributes('title', 'basic');
            
            view.addRenderAttribute('title', 'class', 'premium-ihover-title');
            
            view.addInlineEditingAttributes('description', 'advanced');
            
            view.addRenderAttribute('description', 'class', 'premium-ihover-description');
            
            view.addRenderAttribute('premium_ihover_item', 'class', [ 'premium-ihover-item', hoverEffect ] );

        #>
        
        <div {{{ view.getRenderAttributeString('container') }}}>
            <div class="premium-ihover-list">
                <div class="premium-ihover-item-wrap">
                    <# if( 'yes' == settings.premium_ihover_thumbnail_link_switcher ) { #>
                        <a class="premium-ihover-item-link" href="{{ linkUrl }}" title="{{ settings.premium_ihover_thumbnail_link_text }}">
                    <# } #>
                    <div {{{ view.getRenderAttributeString('premium_ihover_item') }}}>
                        <# if( 'style20' == hoverEffect ){ #>
                            <div class="premium-ihover-spinner"></div>
                        <# } #>
                        <div class="premium-ihover-img-wrap">
                            <div class="premium-ihover-img-front">
                                <div class="premium-ihover-img-inner-wrap"></div>
                                <img class="premium-ihover-img" src="{{ settings.premium_ihover_thumbnail_front_image.url }}">
                            </div>
                        </div>
                        
                        <div class="premium-ihover-info-wrap">
                            <div class="premium-ihover-info-back">
                                <div class="premium-ihover-content">
                                    <div class="premium-ihover-content-wrap">
                                        <div class="premium-ihover-title-wrap">
                                            <# if( 'yes' == settings.premium_ihover_icon_fa_switcher && 'icon' == settings.premium_ihover_icon_selection ) { #>
                                                <i class="premium-ihover-icon {{ settings.premium_ihover_icon_fa }}"></i>
                                            <# } else if( 'yes' == settings.premium_ihover_icon_fa_switcher && 'image' == settings.premium_ihover_icon_selection ) { #>
                                                <img alt="Premium iHover Image" class="premium-ihover-icon-image" src="{{ settings.premium_ihover_icon_image.url }}">
                                            <# } #>
                                            
                                            <# if( 'yes' == settings.premium_ihover_thumbnail_back_title_switcher ) { #>
                                                <{{{titleTag}}} {{{ view.getRenderAttributeString('title') }}} >{{{ settings.premium_ihover_thumbnail_back_title }}}</{{{titleTag}}}>
                                            <# } #>
                                            
                                        </div>
                                        <# if( 'yes' == settings.premium_ihover_thumbnail_back_separator_switcher ) { #>
                                            <div class="premium-ihover-divider"><span class="premium-ihover-divider-line"></span></div>
                                        <# } #>
                                        
                                        <# if( 'yes' == settings.premium_ihover_thumbnail_back_description_switcher ) { #>
                                            <div {{{ view.getRenderAttributeString('description') }}}>
                                                {{{ settings.premium_ihover_thumbnail_back_description }}}
                                            </div>
                                        <# } #>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <# if( 'yes' == settings.premium_ihover_thumbnail_link_switcher ) { #>
                        </a>
                    <# } #>
                </div>
            </div>
        </div>
        
        <?php
    }
}