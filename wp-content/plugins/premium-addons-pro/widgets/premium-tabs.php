<?php

namespace PremiumAddonsPro\Widgets;

use PremiumAddons\Helper_Functions;
use PremiumAddons\Includes;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Frontend;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Premium_Tabs extends Widget_Base {
    
    public function getTemplateInstance() {
        return $this->templateInstance = Includes\premium_Template_Tags::getInstance();
    }

    public function get_name() {
        return 'premium-addon-tabs';
    }

    public function get_title() {
        return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Tabs', 'premium-addons-pro') );
  }

    public function get_icon() {
      return 'pa-pro-tabs';
   }
   
   public function is_reload_preview_required() {
       return true;
   }

   public function get_script_depends() {
        return [
            'premium-pro-js'
        ];
    }
    
    public function get_categories() {
        return [ 'premium-elements' ];
    }

    protected function _register_controls() {

       $this->start_controls_section('premium_tabs',
           [
               'label'         => __('Premium Tabs', 'premium-addons-pro'),
           ]
       );
       
       $repeater = new Repeater();
       
       $repeater->add_control('premium_tabs_icon_switcher',
           [
                'label'         => __( 'Enable Icon', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',  
            ]);
       
       $repeater->add_control('premium_tabs_icon',
           [
                'label'         => __( 'Icon', 'premium-addons-pro' ),
                'type'          => Controls_Manager::ICON,
                'label_block'   => true,
                'default'       => 'fa fa-star',
                'condition'      => [
                   'premium_tabs_icon_switcher' => 'yes'
               ]
            ]);
       
       $repeater->add_control('premium_tabs_title',
           [
                'label'         => __( 'Title', 'premium-addons-pro' ),
                'default'       => __('Title','premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
               'dynamic'        => [ 'active' => true ],
                'label_block'   => true,
            ]);

       $repeater->add_control('premium_tabs_content', 
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

        $repeater->add_control('premium_tabs_content_text',
            [ 
                'type'          => Controls_Manager::WYSIWYG,
                'default'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'label_block'   => true,
                'dynamic'       => [ 'active' => true ],
                'condition'     => [
                   'premium_tabs_content'  => 'text_editor',
                ],
            ]
        );
        
        $repeater->add_control('premium_tabs_content_temp',
            [
                'label'         => __( 'Elementor Template', 'premium-addons-pro' ),
                'description'   => __( 'Elementor Template is a template which you can choose from Elementor library. Each template will be shown in content', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SELECT2,
                'options'       => $this->getTemplateInstance()->get_elementor_page_list(),
                'label_block'   => true,
                'condition'     => [
                   'premium_tabs_content'  => 'elementor_templates',
                ],
            ]
        );
        
       $this->add_control('premium_tabs_repeater',
           [
               'label'          => __( 'Tabs', 'premium-addons-pro' ),
               'type'           => Controls_Manager::REPEATER,
               'fields'         => array_values( $repeater->get_controls() ),
               'title_field'    => '{{{ premium_tabs_title }}}',
           ]
       );
       
       $this->end_controls_section();

       $this->start_controls_section('premium_tab_additional_settings',
           [
               'label'         => __('Additional Settings', 'premium-addons-pro'),
           ]
       );

       $this->add_control('premium_tab_type',
           [
               'label'         => __('Tabs Type', 'premium-addons-pro'),
               'type'          => Controls_Manager::SELECT,
               'default'       => 'horizontal',
               'options'       => [
                   'horizontal'         => __('Horizontal','premium-addons-pro'),
                   'vertical'         => __('Vertical','premium-addons-pro'),
               ],
               'label_block'   => true,
           ]
       );

       $this->add_control('premium_tab_style_selected',
           [
               'label'         => __('Tabs Style', 'premium-addons-pro'),
               'type'          => Controls_Manager::SELECT,
               'default'       => 'style1',
               'options'       => [
                   'style1'        => 'style1',
                   'style2'        => 'style2',
                   'style3'        => 'style3',
                   'style4'        => 'style4',
               ],
               'label_block'   => true,
           ]
       );
       
       $this->end_controls_section();
       
       $this->start_controls_section('premium_tabs_style',
           [
               'label'         => __('Tab', 'premium-addons-pro'),
               'tab'           => Controls_Manager::TAB_STYLE,
           ]
       );

      $this->add_responsive_control('premium_tabs_content_width',
          [
              'label'          => __('Tabs Sections Width (%)','premium-addons-pro'),
              'type'          => Controls_Manager::SLIDER,
              'condition'     => [
                  'premium_tab_type'  => 'vertical'
              ],
              'selectors'     => [
                  '{{WRAPPER}} .premium-tabs .premium-content-wrap.premium-tabs-vertical' => 'width: {{SIZE}}%;'
              ]
          ]
      );
       
       $this->start_controls_tabs( 'premium_tab_style' );
        
        $this->start_controls_tab('premium_tab_style_normal',
            [
                'label'             => __('Normal', 'premium-addons-pro'),
            ]
            );
        
        $this->add_control('premium_tab_background_color',
           [
               'label'         => __('Background Color', 'premium-addons-pro'),
               'type'          => Controls_Manager::COLOR,
               'scheme' => [
                   'type'  => Scheme_Color::get_type(),
                   'value' => Scheme_Color::COLOR_1,
               ],
               'selectors'     => [
                   '{{WRAPPER}} .premium-tabs-style-iconbox nav ul li a,{{WRAPPER}} .premium-tabs-style-circle nav ul li a,{{WRAPPER}} .premium-tabs-style-flip nav li, {{WRAPPER}} .premium-tabs-style-tzoid nav ul li a::after' => 'background-color: {{VALUE}};',
               ],
           ]
       );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_tab_border',
                    'selector'      => '{{WRAPPER}} .premium-tabs .premium-tab-link',
                    ]
                );
        
        $this->add_control('premium_tab_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-tabs .premium-tab-link' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'name'          => 'premium_tab_tab_box_shadow',
                    'selector'      => '{{WRAPPER}} .premium-tabs .premium-tab-link',
                ]
                );
       
       $this->add_responsive_control('premium_tab_margin',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-tabs li.premium-tabs-nav-list-item .premium-tab-link, {{WRAPPER}} .premium-tabs-style-tzoid .premium-tabs-nav .premium-tabs-nav-list.premium-tabs-horizontal li:first-child .premium-tab-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        ]
                    ]
                );
        
        $this->add_responsive_control('premium_tab_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-tabs .premium-tab-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        ]
                    ]
                );
       
       $this->end_controls_tab();
       
       $this->start_controls_tab('premium_tab_style_hover',
            [
                'label'             => __('Hover', 'premium-addons-pro'),
            ]
            );
        
        $this->add_control('premium_tab_hover_background_color',
           [
               'label'         => __('Background Color', 'premium-addons-pro'),
               'type'          => Controls_Manager::COLOR,
               'scheme' => [
                   'type'  => Scheme_Color::get_type(),
                   'value' => Scheme_Color::COLOR_1,
               ],
               'condition'      => [
                   'premium_tab_style_selected!' => ['style2', 'style3'],
               ],
               'selectors'     => [
                   '{{WRAPPER}} .premium-tabs-style-iconbox nav ul li a:hover,{{WRAPPER}} .premium-tabs-style-tzoid nav ul li a:hover:after' => 'background-color: {{VALUE}};',
                   '{{WRAPPER}} .premium-tabs-style-iconbox .premium-tabs-nav ul.premium-tabs-horizontal li.tab-current a:hover:after'    => 'border-top-color: {{VALUE}}',
                   '{{WRAPPER}} .premium-tabs-style-iconbox .premium-tabs-nav ul.premium-tabs-vertical li.tab-current a:hover:after'    => 'border-left-color: {{VALUE}}'
               ],
           ]
       );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_tab_hover_border',
                    'selector'      => '{{WRAPPER}} .premium-tabs .premium-tab-link:hover',
                    ]
                );
        
        $this->add_control('premium_tab_hover_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-tabs .premium-tab-link:hover' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'name'          => 'premium_tab_hover_box_shadow',
                    'selector'      => '{{WRAPPER}} .premium-tabs .premium-tab-link:hover',
                ]
                );
       
       $this->add_responsive_control('premium_tab_hover_margin',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-tabs .premium-tab-link:hover, {{WRAPPER}} .premium-tabs-style-tzoid .premium-tabs-nav .premium-tabs-nav-list.premium-tabs-horizontal li:first-child .premium-tab-link:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        ]
                    ]
                );
        
        $this->add_responsive_control('premium_tab_hover_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-tabs .premium-tab-link:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        ]
                    ]
                );
       
       $this->end_controls_tab();
       
       $this->start_controls_tab('premium_tab_style_active',
            [
                'label'             => __('Active', 'premium-addons-pro'),
            ]
            );

       $this->add_control('premium_tab_active_background_color',
           [
               'label'         => __('Background Active Color', 'premium-addons-pro'),
               'type'          => Controls_Manager::COLOR,
               'scheme' => [
                   'type'  => Scheme_Color::get_type(),
                   'value' => Scheme_Color::COLOR_3,
               ],
               'selectors'     => [
                   '{{WRAPPER}} .premium-tabs-style-iconbox nav ul li.tab-current a,{{WRAPPER}} .premium-tabs-style-circle nav ul li.tab-current a,{{WRAPPER}} .premium-tabs-style-flip nav li.tab-current a::after, {{WRAPPER}} .premium-tabs-style-tzoid nav ul li.tab-current a::after' => 'background-color: {{VALUE}};',
                   '{{WRAPPER}} .premium-tabs-style-iconbox .premium-tabs-nav ul.premium-tabs-horizontal li.tab-current a:hover:after'    => 'border-top-color: {{VALUE}}',
                   '{{WRAPPER}} .premium-tabs-style-iconbox .premium-tabs-nav ul.premium-tabs-vertical li.tab-current a:hover:after'  => 'border-left-color: {{VALUE}};'
               ],
           ]
       );
       
       $this->add_control('premium_tab_active_arrow_color',
           [
               'label'          => __('Arrow Color', 'premium-addons-pro'),
               'type'           => Controls_Manager::COLOR,
               'scheme'         => [
                   'type'  => Scheme_Color::get_type(),
                   'value' => Scheme_Color::COLOR_2,
               ],
               'selectors'      => [
                   '{{WRAPPER}} .premium-tabs-style-iconbox .premium-tabs-nav ul.premium-tabs-horizontal li.tab-current a::after' => 'border-top-color: {{VALUE}};',
               ],
               'condition'      => [
                   'premium_tab_style_selected' => 'style1',
                   'premium_tab_type'           => 'horizontal'
               ]
           ]
       );
       
       $this->add_control('premium_tab_active_arrow_color_vertical',
           [
               'label'          => __('Arrow Color', 'premium-addons-pro'),
               'type'           => Controls_Manager::COLOR,
               'scheme'         => [
                   'type'  => Scheme_Color::get_type(),
                   'value' => Scheme_Color::COLOR_2,
               ],
               'selectors'      => [
                   '{{WRAPPER}} .premium-tabs-style-iconbox .premium-tabs-nav ul.premium-tabs-vertical li.tab-current a::after' => 'border-left-color: {{VALUE}};',
               ],
               'condition'      => [
                   'premium_tab_style_selected' => 'style1',
                   'premium_tab_type'           => 'vertical'
               ]
           ]
       );
       
       $this->add_responsive_control('premium_tab_active_circle_color',
           [
               'label'          => __('Circle Size', 'premium-addons-pro'),
               'type'           => Controls_Manager::SLIDER,
               'size_units'     => ['px','em','%'],
               'range'          => [
                   'px' => [
                       'min' => 1,
                       'max' => 200,
                   ],
               ],
               'default'        => [
                   'unit'   => 'px',
                   'size'   => 75
               ],
               'selectors'      => [
                   '{{WRAPPER}} .premium-tabs-style-circle nav li::before' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
               ],
               'condition'      => [
                   'premium_tab_style_selected' => 'style2'
               ]
           ]
       );
       
       $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'              => 'premium_tab_active_circle_border',
                    'selector'          => '{{WRAPPER}} .premium-tabs-style-circle nav li::before',
                    'condition'      => [
                        'premium_tab_style_selected' => 'style2'
                    ]
                ]
                );
       
       $this->add_control('premium_tab_active_border_color',
           [
               'label'         => __('Border Color', 'premium-addons-pro'),
               'type'          => Controls_Manager::COLOR,
               'scheme' => [
                   'type'  => Scheme_Color::get_type(),
                   'value' => Scheme_Color::COLOR_3,
               ],
               'selectors'     => [
                   '{{WRAPPER}} .premium-tabs-style-iconbox nav ul.premium-tabs-horizontal li::after, {{WRAPPER}} .premium-tabs-style-iconbox nav ul.premium-tabs-vertical li::after,{{WRAPPER}} .premium-tabs-style-flip nav ul.premium-tabs-horizontal li::after, {{WRAPPER}} .premium-tabs-style-flip nav ul.premium-tabs-vertical li::after' => 'background-color: {{VALUE}};',
               ],
               'condition'      => [
                   'premium_tab_style_selected' => 'style1'
               ]
           ]
       );
       
       $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'name'          => 'premium_tab_tab_box_shadow_active',
                    'selector'      => '{{WRAPPER}} .premium-tabs .tab-current',
                ]
                );
       
       $this->add_responsive_control('premium_tab_active_margin',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-tabs .tab-current, {{WRAPPER}} .premium-tabs-style-tzoid .premium-tabs-nav .premium-tabs-nav-list.premium-tabs-horizontal li.tab-current:first-child ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        ]
                    ]
                );
        
        /*First Padding*/
        $this->add_responsive_control('premium_tab_active_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-tabs .tab-current' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        ]
                    ]
                );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
       
        $this->end_controls_section();

        $this->start_controls_section('premium_tabs_icons_style_section',
           [
               'label'    => __('Icon', 'premium-addons-pro'),
               'tab'        => Controls_Manager::TAB_STYLE,
           ]
        );

       $this->add_control('premium_tab_icon_color',
           [
               'label'         => __('Color', 'premium-addons-pro'),
               'type'          => Controls_Manager::COLOR,
               'scheme' => [
                   'type'  => Scheme_Color::get_type(),
                   'value' => Scheme_Color::COLOR_2,
               ],
               'selectors'     => [
                   '{{WRAPPER}} .premium-tabs .premium-title-icon' => 'color: {{VALUE}};',
               ],
           ]
       );

       $this->add_control('premium_tab_active_icon_color',
           [
               'label'         => __('Active Color', 'premium-addons-pro'),
               'type'          => Controls_Manager::COLOR,
               'scheme' => [
                   'type'  => Scheme_Color::get_type(),
                   'value' => Scheme_Color::COLOR_1,
               ],
               'selectors'     => [
                   '{{WRAPPER}} .premium-tabs .tab-current .premium-title-icon' => 'color: {{VALUE}};',
               ],
           ]
       );

       $this->add_control('premium_tab_icon_size',
           [
               'label' => __( 'Size', 'premium-addons-pro' ),
               'type' => Controls_Manager::SLIDER,
               'selectors' => [
                   '{{WRAPPER}} .premium-tabs .premium-title-icon' => 'font-size: {{SIZE}}{{UNIT}};',
               ],
           ]
       );
       
       /*Icon Border*/
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_tab_icon_border',
                    'selector'      => '{{WRAPPER}} .premium-tabs .premium-title-icon',
                ]
                );
        
        /*Icon Border Radius*/
        $this->add_control('premium_tab_icon_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-tabs .premium-title-icon' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'label'         => __('Shadow','premium-addons-pro'),
                    'name'          => 'premium_tab_icon_shadow',
                    'selector'      => '{{WRAPPER}}  .premium-tabs .premium-title-icon',
                ]
                );
        
        /*Icon Margin*/
        $this->add_responsive_control('premium_tab_icon_margin',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-tabs .premium-title-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );
        
        /*Icon Padding*/
        $this->add_responsive_control('premium_tab_icon_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-tabs .premium-title-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );
       
       $this->end_controls_section();

       $this->start_controls_section('premium_tabs_titles_style_section',
           [
               'label'         => __('Title', 'premium-addons-pro'),
               'tab'           => Controls_Manager::TAB_STYLE,
           ]
       );

       $this->add_control('premium_tab_title_color',
           [
               'label'         => __('Color', 'premium-addons-pro'),
               'type'          => Controls_Manager::COLOR,
               'scheme' => [
                   'type'  => Scheme_Color::get_type(),
                   'value' => Scheme_Color::COLOR_2,
               ],
               'selectors'     => [
                   '{{WRAPPER}} .premium-tabs .premium-tab-title' => 'color: {{VALUE}};',
               ],
           ]
       );

       $this->add_control('premium_tab_active_title_color',
           [
               'label'         => __('Active Color', 'premium-addons-pro'),
               'type'          => Controls_Manager::COLOR,
               'scheme' => [
                   'type'  => Scheme_Color::get_type(),
                   'value' => Scheme_Color::COLOR_1,
               ],
               'selectors'     => [
                   '{{WRAPPER}} .premium-tabs .tab-current .premium-tab-title' => 'color: {{VALUE}};',
               ],
           ]
       );

       $this->add_group_control(
           Group_Control_Typography::get_type(),
           [
               'name' => 'premium_tab_title_typography',
               'scheme' => Scheme_Typography::TYPOGRAPHY_1,
               'selector' => '{{WRAPPER}} .premium-tabs .premium-tab-title',
           ]
       );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_tab_title_border',
                    'selector'      => '{{WRAPPER}} .premium-tabs .premium-tab-title',
                    'condition'      => [
                        'premium_tab_style_selected!' => 'style2'
                        ]
                    ]
                );
        
        /*Icon Border Radius*/
        $this->add_control('premium_tab_title_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-tabs .premium-tab-title' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ],
                    'condition'      => [
                        'premium_tab_style_selected!' => 'style2'
                        ]
                ]
                );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'label'         => __('Shadow','premium-addons-pro'),
                    'name'          => 'premium_tab_title_shadow',
                    'selector'      => '{{WRAPPER}}  .premium-tabs .premium-tab-title',
                ]
                );
        
        /*Icon Margin*/
        $this->add_responsive_control('premium_tab_title_margin',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-tabs .premium-tab-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );
        
        /*Icon Padding*/
        $this->add_responsive_control('premium_tab_title_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-tabs .premium-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );

       $this->end_controls_section();

       $this->start_controls_section('premium_tabs_style_descriptions_section',
           [
               'label'         => __('Description', 'premium-addons-pro'),
               'tab'           => Controls_Manager::TAB_STYLE,
           ]
       );
       
//       $this->add_responsive_control('premium_tab_description_width',
//                [
//                    'label'         => __('Width', 'premium-addons-pro'),
//                    'type'          => Controls_Manager::SLIDER,
//                    'size_units'    => ['px', '%' ,'em'],
//                    'range'         => [
//                        'px'    => [
//                            'min'   => 1,
//                            'max'   => 300,
//                        ],
//                        'em'    => [
//                            'min'   => 1,
//                            'max'   => 30,
//                        ]
//                    ],
//                    'default'   => [
//                        'unit'      => '%',
//                        'size'      => 73
//                    ],
//                    'selectors'     => [
//                        '{{WRAPPER}} .premium-tabs .premium-content-wrap.vertical' => 'width: {{SIZE}}{{UNIT}};'
//                    ],
//                    'condition'     => [
//                        'premium_tab_type'  => 'vertical'
//                    ]
//                ]
//                );

       $this->add_control('premium_tab_description_color',
           [
               'label'         => __('Color', 'premium-addons-pro'),
               'type'          => Controls_Manager::COLOR,
               'scheme' => [
                   'type'  => Scheme_Color::get_type(),
                   'value' => Scheme_Color::COLOR_2,
               ],
               'selectors'     => [
                   '{{WRAPPER}} .premium-content-wrap-inner' => 'color: {{VALUE}};',
               ],
           ]
       );

       $this->add_group_control(
           Group_Control_Typography::get_type(),
           [
               'name' => 'premium_tab_description_typography',
               'scheme' => Scheme_Typography::TYPOGRAPHY_1,
               'selector' => '{{WRAPPER}} .premium-tab-content',
           ]
       );
       
       $this->add_control('premium_tab_description_background',
           [
               'label'         => __('Background Color', 'premium-addons-pro'),
               'type'          => Controls_Manager::COLOR,
               'selectors'     => [
                   '{{WRAPPER}} .premium-tab-content' => 'background-color: {{VALUE}};',
               ],
           ]
       );
       
       $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_tab_description_border',
                    'selector'      => '{{WRAPPER}} .premium-tab-content',
                ]
                );
        
        /*Button Border Radius*/
        $this->add_control('premium_tab_description_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-tab-content' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
       
       $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'label'         => __('Shadow','premium-addons-pro'),
                    'name'          => 'premium_tab_description_shadow',
                    'selector'      => '{{WRAPPER}} .premium-tab-content',
                    ]
                );
        
        /*Button Shadow*/
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'name'          => 'premium_tab_description_box_shadow',
                    'selector'      => '{{WRAPPER}} .premium-tab-content',
                ]
                );
       
       $this->add_responsive_control('premium_tab_description_margin',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        ]
                    ]
                );
        
        /*First Padding*/
        $this->add_responsive_control('premium_tab_description_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'default'       => [
                        'unit'  => 'px',
                        'top'   => 10,
                        'right' => 10,
                        'bottom'=> 10,
                        'left'  => 10,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        ]
                    ]
                );

       $this->end_controls_section();
       
       $this->start_controls_section('premium_tab_container_style',
           [
               'label'         => __('Container', 'premium-addons-pro'),
               'tab'           => Controls_Manager::TAB_STYLE,
           ]
       );
       
       $this->add_control('premium_tab_container_background_color',
           [
               'label'         => __('Background Color', 'premium-addons-pro'),
               'type'          => Controls_Manager::COLOR,
               'selectors'     => [
                   '{{WRAPPER}} .premium-tabs-container' => 'background-color: {{VALUE}};',
               ],
           ]
       );
       
       $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_tab_container_border',
                    'selector'      => '{{WRAPPER}} .premium-tabs-container',
                ]
                );
        
        /*Button Border Radius*/
        $this->add_control('premium_tab_container_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-tabs-container' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        /*Button Shadow*/
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'name'          => 'premium_tab_container_shadow',
                    'selector'      => '{{WRAPPER}} .premium-tabs-container',
                ]
                );
       
       $this->add_responsive_control('premium_tab_container_margin',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-tabs-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        ]
                    ]
                );
        
        /*First Padding*/
        $this->add_responsive_control('premium_tab_container_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-tabs-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        ]
                    ]
                );

       $this->end_controls_section();
       
   }

   protected function render( $instance = [] ) {

       // get our input from the widget settings.
       $settings = $this->get_settings_for_display();
       
       $id = $this->get_id();
      
       $tabs = $settings['premium_tabs_repeater'];
       
       $this->add_inline_editing_attributes('premium_tabs_content_text', 'advanced');
       
       $style = $settings['premium_tab_style_selected'];
       switch ($style){
           case 'style1' :
               $section_style = 'iconbox';
               $html_elem = 'p';
               break;
           case 'style2' :
               $section_style = 'circle';
               $html_elem = 'p';
               break;
           case 'style3' :
               $section_style = 'flip';
               $html_elem = 'span';
               break;
           case 'style4' :
               $section_style = 'tzoid';
               $html_elem = 'span';
               break;
       }
       
       $direction = 'premium-tabs-' . $settings['premium_tab_type'];
       
       $tabs_settings = [
           'id' => $id
       ];
       
       $this->add_render_attribute('tabs', 'class', 'premium-tabs-container');
       
       $this->add_render_attribute('tabs', 'data-settings', wp_json_encode( $tabs_settings ) );
       
       $this->add_render_attribute('tabs-wrap', 'id', 'premium-tabs-' . $id );
       
       $this->add_render_attribute('tabs-wrap', 'class', [ 'premium-tabs', 'premium-tabs-style-' . $section_style, $direction ] );
       
       $this->add_render_attribute('tabs-nav', 'class', [ 'premium-tabs-nav-list', $direction ] );
       
       $this->add_render_attribute('tabs-content', 'class', [ 'premium-content-wrap', $direction ] );
       
       $this->add_render_attribute('premium_tabs_title', 'class', 'premium-tab-title');
       
      ?>
        <div <?php echo $this->get_render_attribute_string('tabs'); ?>>
            <section class="premium-tabs-section">
                <div <?php echo $this->get_render_attribute_string('tabs-wrap'); ?>>
                    <nav class="premium-tabs-nav">
                        <ul <?php echo $this->get_render_attribute_string('tabs-nav'); ?>>
                           <?php foreach ($tabs as $index => $tab){?>
                                <li class="premium-tabs-nav-list-item">
                                    <a class="premium-tab-link" href="#section-<?php echo $section_style . '-'.$index . '-'. esc_attr($this->get_id()); ?>">
                                        <?php if ($tab['premium_tabs_icon_switcher'] == 'yes'){?>
                                            <i class="premium-title-icon <?php echo $tab['premium_tabs_icon'];?>"></i>
                                        <?php } ?>
                                        <?php
                                            echo '<' . $html_elem . ' ' . $this->get_render_attribute_string('premium_tabs_title') . '>' . $tab['premium_tabs_title'] . '</' . $html_elem . '>';
                                        ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </nav>
                    <div <?php echo $this->get_render_attribute_string('tabs-content'); ?>>
                        <?php foreach ($tabs as $index => $tab){ ?>
                        <section class="premium-tabs-content-section" id="section-<?php echo $section_style . '-' . $index . '-'. esc_attr($this->get_id()); ?>">
                                <div class="premium-tab-content">
                                    <div class="premium-content-wrap-inner"><?php
                                    if($tab['premium_tabs_content'] == 'text_editor') { ?>
                                        <div <?php echo $this->get_render_attribute_string('premium_tabs_content_text'); ?>>
                                            <?php echo $this->parse_text_editor($tab['premium_tabs_content_text']); ?>
                                        </div>
                                    <?php } else {
                                        $content_page_id = $tab['premium_tabs_content_temp'];
                                        $content = new Frontend;
                                        echo $content->get_builder_content($content_page_id, false);
                                    }
                                    ?>
                                    </div>
                                </div>
                            </section>
                        <?php } ?>
                    </div>
                    <div class="premium-clearfix"></div>
                </div>
            </section>
        </div>
        <?php
   }

}
