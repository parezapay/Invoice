<?php

/**
 * Class: Premium_Charts
 * Name: Charts
 * Slug: premium-chart
 */

namespace PremiumAddonsPro\Widgets;

use PremiumAddons\Helper_Functions;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if( ! defined( 'ABSPATH' ) ) exit;

class Premium_Charts extends Widget_Base {
    
    public function get_name() {
        return 'premium-chart';
    }
    
    public function get_title() {
		return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Charts', 'premium-addons-pro') );
	}
    
    public function get_icon() {
        return 'pa-pro-charts';
    }
    
    public function get_categories() {
        return ['premium-elements'];
    }
    
    public function get_script_depends() {
        return [
            'chart-js',
            'elementor-waypoints',
            'premium-pro-js',
        ];
    }
    
    public function is_reload_preview_required() {
        return true;
    }
    
    // Adding the controls fields for the Premium Charts
    // This will controls the animation, colors and background, dimensions etc
    protected function _register_controls() {
        
        $this->start_controls_section('general_settings',
            [
                'label'         => __('Premium Charts','premium-addons-pro'),
            ]
        );

        $this->add_control('type', 
            [
                'label'         => __('Layout', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'line'          => __('Line','premium-addons-pro'),
                    'bar'           => __('Bar','premium-addons-pro'),
                    'horizontalBar' => __('Horizontal Bar','premium-addons-pro'),
                    'pie'           => __('Pie','premium-addons-pro'),
                    'radar'         => __('Radar','premium-addons-pro'),
                    'doughnut'      => __('Doughnut','premium-addons-pro'),
                    'polarArea'     => __('Polar Area','premium-addons-pro'),

                    ],
                'default'       => 'bar',
                'label_block'   => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('x_axis',
            [
                'label'         => __('X-Axis','premium-addons-pro'),
            ]
        );

        $this->add_control('x_axis_label_switch',
            [
                'label'         => __('Show Axis Label', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => 'Show',
                'label_off'     => 'Hide',
                'return_value'  => 'true',
                'description'   => __('Show or Hide X-Axis Label','premium-addons-pro'),
            ]
        );

        $this->add_control('x_axis_label',
                [
                    'label'     => __('Label', 'premium-addons-pro'),
                    'type'      => Controls_Manager::TEXT,
                    'dynamic'   => [ 'active' => true ],
                    'default'   => 'X-Axis',
                    'label_block'=> true,
                    'condition' => [
                        'x_axis_label_switch'    => 'true',
                    ]
                ]
            );

        $this->add_control('x_axis_labels',
            [
                'label'         => __('Data Labels', 'premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'default'       => 'Jan,Feb,Mar,Apr,May',
                'description'   => __('Enter labels for X-Axis separated with \' , \' ','premium-addons-pro'),
                'label_block'   => true,
            ]
        );
        
        $this->add_control('x_axis_grid',
            [
                'label'         => __('Show Grid Lines', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => 'Show',
                'label_off'     => 'Hide',
                'return_value'  => 'true',
                'default'       => 'true',
                'description'   => __('Show or Hide X-Axis Grid Lines','premium-addons-pro'),
            ]
        );

        $this->add_control('x_axis_begin',
            [
                'label'         => __('Begin at Zero', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'return_value'  => 'true',
                'description'   => __('Start X-Axis Labels at zero','premium-addons-pro'),
            ]
        );

        $this->add_control('x_axis_label_rotation',
            [
                'label'			=> __( 'Labels\' Rotation ', 'premium-addons-pro' ),
                'type'			=> Controls_Manager::NUMBER,
                'min'           => 0,
                'max'           => 360,
                'default'       => 0
            ]
        );
        
        $this->add_control('x_column_width',
            [
                'label'         => __('Column Width', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 1,
                        'step'  => 0.1
                    ]
                ],
                'condition'     => [
                    'type'  => 'bar'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('y_axis',
            [
                'label'         => __('Y-Axis','premium-addons-pro'),
            ]
        );

        $this->add_control('y_axis_label_switch',
            [
                'label'         => __('Show Axis Label', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => 'Show',
                'label_off'     => 'Hide',
                'return_value'  => 'true',
                'description'   => __('Show or Hide Y-Axis Label','premium-addons-pro'),
            ]
        );

        $this->add_control('y_axis_label',
            [
                'label'         => __('Label', 'premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'default'       => 'Y-Axis',
                'label_block'   => true,
                'condition'     => [
                    'y_axis_label_switch'    => 'true',
                ]
            ]
        );

        $data_repeater = new REPEATER();

        $data_repeater->add_control('y_axis_column_title',
            [
                'label'         => __( 'Title', 'premium-addons-pro' ),
               'default'        => __('Dataset','premium-addons-pro'),
               'type'           => Controls_Manager::TEXT,
               'dynamic'       => [ 'active' => true ],
            ]
        );

        $data_repeater->add_control('y_axis_column_data',
            [
                'label'         => __( 'Data', 'premium-addons-pro' ),
                'description'   => __('Enter Data Numbers for Y-Axis separated with \' , \' ','premium-addons-pro'),
                'dynamic'       => [ 'active' => true ],
                'type'          => Controls_Manager::TEXT,

            ]
        );
        
        $data_repeater->add_control('y_axis_urls',
            [
                'label'         => __('URLs', 'premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
                'description'   => __('Enter URLs for each Dataset separated with \' , \' ','premium-addons-pro'),
                'label_block'   => true,
            ]
        );

        $data_repeater->add_control('y_axis_column_color',
            [
                'label'         => __( 'First Fill Color', 'premium-addons-pro' ),
                'type'          => Controls_Manager::COLOR,
                'default'       => '#6ec1e4',
            ]
        );
        
        $data_repeater->add_control('y_axis_column_second_color',
            [
                'label'         => __( 'Second Fill Color', 'premium-addons-pro' ),
                'type'          => Controls_Manager::COLOR
            ]
        );

        $data_repeater->add_control('y_axis_circle_color',
            [
               'label'          => __( 'Fill Colors', 'premium-addons-pro' ),
               'description'    => __('Enter Colors separated with \' , \', this will work only for pie and doughnut charts ','premium-addons-pro'),
               'type'           => Controls_Manager::TEXT,
            ]
        );

        $data_repeater->add_control('y_axis_column_border_width',
            [
               'label'         => __( 'Border Width', 'premium-addons-pro' ),
               'default'       => 1,
               'type'           => Controls_Manager::NUMBER,
            ]
        );
        
        $data_repeater->add_control('y_axis_column_border_color',
            [
               'label'         => __( 'Border Color', 'premium-addons-pro' ),
               'type'           => Controls_Manager::COLOR,
            ]
        );

        $this->add_control('y_axis_data',
           [
               'label'          => __( 'Data', 'premium-addons-pro' ),
               'type'           => Controls_Manager::REPEATER,
               'default'        => [
                    [
                       'y_axis_column_data'   => '1,5,2,3,7',
                    ],
               ],
               'fields'         => array_values( $data_repeater->get_controls() ),
           ]
        );
        
        $this->add_control('data_type',
            [
                'label'         => __('Data Type', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'linear'            => __('Linear', 'premium-addons-pro'),
                    'logarithmic'       => __('Logarithmic', 'premium-addons-pro'),
                ],
                'default'       => 'linear',
                'condition'     => [
                    'type!'             => 'horizontalBar'
                    ]
                ]
            );

        $this->add_control('y_axis_grid',
            [
                'label'         => __('Show Grid Lines', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => 'Show',
                'label_off'     => 'Hide',
                'return_value'  => 'true',
                'default'       => 'true',
                'description'   => __('Show or Hide Y-Axis Grid Lines','premium-addons-pro'),
            ]
        );

        $this->add_control('y_axis_begin',
            [
                'label'         => __('Begin at Zero', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'true',
                'return_value'  => 'true',
                'description'   => __('Start Y-Axis Data at zero','premium-addons-pro'),
            ]
        );
        
        $this->add_control('y_axis_urls_target',
            [
                'label'         => __('Open Links in new tab', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => 'Show',
                'label_off'     => 'Hide',
                'return_value'  => 'true',
                'default'       => 'true',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('title_content',
            [
                'label'         => __('Title','premium-addons-pro'),
            ]
        );

        $this->add_control('title_switcher',
            [
                'label'         => __('Title', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'return_value'  => 'true',
            ]
        );

        $this->add_control('title',
            [
                'label'         => __('Title', 'premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
                'description'   => __('Enter a Title for the Chart','premium-addons-pro'),
                'label_block'   => true,
                'dynamic'       => [ 'active' => true ],
                'condition'     => [
                    'title_switcher'  => 'true'
                ]
            ]
        );

        $this->add_control('title_tag',
            [
                'label'         => __('HTML Tag', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'h3',
                'options'       => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6' 
                    ],
                'label_block'   =>  true,
                'condition'     => [
                    'title_switcher'  => 'true'
                ]
            ]
        );

        $this->add_control('title_position',
        [
            'label'             => __('Position', 'premium-addons-pro'),
            'type'              => Controls_Manager::SELECT,
            'options'           => [
                'top'       => __('Top', 'premium-addons-pro'),
                'bottom'    => __('Bottom', 'premium-addons-pro'),
            ],
            'default'           => 'top',
            'condition'         => [
                'title_switcher'  => 'true'
                ]
            ]
        );

        $this->add_responsive_control('title_align',
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
                'selectors'     => [
                    '{{WRAPPER}} .premium-chart-title' => 'text-align: {{VALUE}}',
                ],
                'default'       => 'center',
                'condition'     => [
                    'title_switcher'  => 'true'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('advanced',
            [
                'label'         => __('Advanced Settings','premium-addons-pro'),
            ]
        );

        $this->add_control('y_axis_max',
            [
                'label'         => __( 'Maximum Value', 'premium-addons-pro' ),
                'type'          => Controls_Manager::NUMBER,
                'title'         => __('Set Y-axis maximum value, this will be overriden if data has a larger value', 'premium-addons-pro'),
                'min'           => 0,
                'default'       => 1,
                'condition'     => [
                    'type!'   => [ 'pie', 'doughnut', 'polarArea', 'radar' ]
                ]
            ]
        );

        $this->add_control('legend_display',
            [
                'label'         => __('Show Legend', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => 'Show',
                'label_off'     => 'Hide',
                'return_value'  => 'true',
                'description'   => __('Show or Hide chart legend','premium-addons-pro'),
            ]
        );

        $this->add_control('legend_position',
            [
                'label'         => __('Legend Position', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'top'           => __('Top', 'premium-addons-pro'),
                    'right'         => __('Right', 'premium-addons-pro'),
                    'bottom'        => __('Bottom', 'premium-addons-pro'),
                    'left'          => __('Left', 'premium-addons-pro'),
                ],
                'default'       => 'top',
                'condition'     => [
                    'legend_display'  => 'true'
                ]
            ]
        );

        $this->add_control('legend_reverse',
            [
                'label'         => __('Reverse', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Enable or Disable legend data reverse','premium-addons-pro'),
                'return_value'  => 'true',
                'condition'     => [
                    'legend_display'  => 'true'
                ]
            ]
        );

        $this->add_control('tool_tips',
            [
                'label'         => __('Show Values on Hover', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => 'Show',
                'label_off'     => 'Hide',
                'return_value'  => 'true',
            ]
        );
        
        $this->add_control('tool_tips_percent',
            [
                'label'         => __('Convert Values to percent', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'return_value'  => 'true',
                'condition'     => [
                    'tool_tips'  => 'true'
                ]
            ]
        );

        $this->add_control('tool_tips_mode',
            [
                'label'         => __('Mode', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'point'         => __('Point', 'premium-addons-pro'),
                    'nearest'       => __('Nearest', 'premium-addons-pro'),
                    'dataset'       => __('Dataset', 'premium-addons-pro'),
                    'x'             => __('X', 'premium-addons-pro'),
                    'y'             => __('Y', 'premium-addons-pro'),
                ],
                'default'       => 'nearest',
                'condition'     => [
                    'tool_tips'  => 'true'
                ]
            ]
        );

        $this->add_control('value_on_chart',
            [
                'label'         => __('Show Values on Chart', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __("This option works only with Pie and Douhnut Charts", "premium-addons-pro"),
                'label_on'      => 'Show',
                'label_off'     => 'Hide',
                'return_value'  => 'true',
                'condition'     => [
                    'type'          => ['pie', 'doughnut'],
                    'tool_tips!'    => 'true'
                ]
            ]
        );
        
        $this->add_control('start_animation',
            [
                'label'         => __('Animation', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'linear'            => __('Linear','premium-addons-pro'),
                    'easeInQuad'        => __('Ease in Quad','premium-addons-pro'),
                    'easeOutQuad'       => __('Ease out Quad','premium-addons-pro'),
                    'easeInOutQuad'     => __('Ease in out Quad','premium-addons-pro'),
                    'easeInCubic'       => __('Ease in Cubic','premium-addons-pro'),
                    'easeOutCubic'      => __('Ease out Cubic','premium-addons-pro'),
                    'easeInOutCubic'    => __('Ease in out Cubic','premium-addons-pro'),
                    'easeInQuart'       => __('Ease in Quart','premium-addons-pro'),
                    'easeOutQuart'      => __('Ease out Quart','premium-addons-pro'),
                    'easeInOutQuart'    => __('Ease in out Quart','premium-addons-pro'),
                    'easeInQuint'       => __('Ease in Quint','premium-addons-pro'),
                    'easeOutQuint'      => __('Ease out Quint','premium-addons-pro'),
                    'easeInOutQuint'    => __('Ease in out Quint','premium-addons-pro'),
                    'easeInSine'        => __('Ease in Sine','premium-addons-pro'),
                    'easeOutSine'       => __('Ease out Sine','premium-addons-pro'),
                    'easeInOutSine'     => __('Ease in out Sine','premium-addons-pro'),
                    'easeInExpo'        => __('Ease in Expo','premium-addons-pro'),
                    'easeOutExpo'       => __('Ease out Expo','premium-addons-pro'),
                    'easeInOutExpo'     => __('Ease in out Cubic','premium-addons-pro'),
                    'easeInCirc'        => __('Ease in Circle','premium-addons-pro'),
                    'easeOutCirc'       => __('Ease out Circle','premium-addons-pro'),
                    'easeInOutCirc'     => __('Ease in out Circle','premium-addons-pro'),
                    'easeInElastic'     => __('Ease in Elastic','premium-addons-pro'),
                    'easeOutElastic'    => __('Ease out Elastic','premium-addons-pro'),
                    'easeInOutElastic'  => __('Ease in out Elastic','premium-addons-pro'),
                    'easeInBack'        => __('Ease in Back','premium-addons-pro'),
                    'easeOutBack'       => __('Ease out Back','premium-addons-pro'),
                    'easeInOutBack'     => __('Ease in Out Back','premium-addons-pro'),
                    'easeInBounce'      => __('Ease in Bounce','premium-addons-pro'),
                    'easeOutBounce'     => __('Ease out Bounce','premium-addons-pro'),
                    'easeInOutBounce'   => __('Ease in out Bounce','premium-addons-pro'),
                ],
                'default'       => 'easeInQuad',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section('general_style',
            [
                'label'         => __('General','premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control('height',
            [
                'label'         => __('Height', 'premium-addons-pro'),
                'type'          => Controls_Manager::NUMBER,
                'title'         => __('Set the height of the graph in pixels', 'premium-addons-pro'),
                'selectors'     => [
                    '{{WRAPPER}} .premium-chart-canvas-container'   => 'height: {{VALUE}}px'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'          => 'general_background',
                'types'         => [ 'classic', 'gradient' ],
                'selector'      => '{{WRAPPER}} .premium-chart-container',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'general_border',
                'selector'      => '{{WRAPPER}} .premium-chart-container',
                ]
            );

        $this->add_control('general_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%', 'em'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-chart-container' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'general_box_shadow',
                'selector'      => '{{WRAPPER}} .premium-chart-container',
            ]
        );

        $this->add_responsive_control('general_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-chart-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );

        $this->add_responsive_control('general_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-chart-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('title_style',
            [
                'label'         => __('Title','premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'title_switcher'  => 'true'
                ]
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
                    '{{WRAPPER}} .premium-chart-title' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'title_typo',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .premium-chart-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'          => 'title_background',
                'types'         => [ 'classic', 'gradient' ],
                'selector'      => '{{WRAPPER}} .premium-chart-title-container',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
                [
                    'name'      => 'title_border',
                    'selector'  => '{{WRAPPER}} .premium-chart-title-container',
                ]
            );

        $this->add_control('title_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%', 'em'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-chart-title-container' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'          => 'title_box_shadow',
                'selector'      => '{{WRAPPER}} .premium-chart-title',
            ]
        );

        $this->add_responsive_control('title_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-chart-title-container .premium-chart-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );

        $this->add_responsive_control('title_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-chart-title-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('x_axis_style',
            [
                'label'         => __('X-Axis','premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control('x_axis_label_pop',
            [
                'label'         => __('Axis Label', 'premium-addons-pro'),
                'type'          => Controls_Manager::POPOVER_TOGGLE,
                'condition'     => [
                    'x_axis_label_switch' => 'true'
                ]
            ]
        );

        $this->start_popover();

        $this->add_control('x_axis_label_color',
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
            ]
        );

        $this->add_control('x_axis_label_size',
            [
                'label'			=> __( 'Size', 'premium-addons-pro' ),
                'type'			=> Controls_Manager::NUMBER,
                'min'           => 0,
                'max'           => 50,
                'default'       => 12
            ]
        );

        $this->end_popover();

        $this->add_control('x_axis_labels_pop',
            [
                'label'         => __('Data Labels', 'premium-addons-pro'),
                'type'          => Controls_Manager::POPOVER_TOGGLE,
            ]
        );

        $this->start_popover();

        $this->add_control('x_axis_labels_color',
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
            ]
        );

        $this->add_control('x_axis_labels_size',
            [
                'label'			=> __( 'Size', 'premium-addons-pro' ),
                'type'			=> Controls_Manager::NUMBER,
                'min'           => 0,
                'max'           => 50,
                'default'       => 12
            ]
        );

        $this->end_popover();

        $this->add_control('x_axis_grid_pop',
            [
                'label'         => __('Grid', 'premium-addons-pro'),
                'type'          => Controls_Manager::POPOVER_TOGGLE,
                'condition'     => [
                    'x_axis_grid' => 'true'
                ]
            ]
        );

        $this->start_popover();

        $this->add_control('x_axis_grid_color',
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'default'       => '#6ec1e4',
            ]
        );

        $this->end_popover();

        $this->end_controls_section();

        $this->start_controls_section('y_axis_style',
            [
                'label'         => __('Y-Axis','premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control('y_axis_label_pop',
            [
                'label'         => __('Axis Label', 'premium-addons-pro'),
                'type'          => Controls_Manager::POPOVER_TOGGLE,
                'condition'     => [
                    'y_axis_label_switch' => 'true'
                ]
            ]
        );

        $this->start_popover();

        $this->add_control('y_axis_label_color',
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                    ],
                ]
            );

        $this->add_control('y_axis_label_size',
            [
                'label'			=> __( 'Size', 'premium-addons-pro' ),
                'type'			=> Controls_Manager::NUMBER,
                'min'           => 0,
                'max'           => 50,
                'default'       => 12
            ]
        );

        $this->end_popover();

        $this->add_control('y_axis_data_pop',
            [
                'label'         => __('Data', 'premium-addons-pro'),
                'type'          => Controls_Manager::POPOVER_TOGGLE,
            ]
        );

        $this->start_popover();

        $this->add_control('y_axis_labels_color',
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
            ]
        );

        $this->add_control('y_axis_labels_size',
            [
                'label'			=> __( 'Size', 'premium-addons-pro' ),
                'type'			=> Controls_Manager::NUMBER,
                'min'           => 0,
                'max'           => 50,
                'default'       => 12
            ]
        );

        $this->end_popover();

        $this->add_control('y_axis_grid_pop',
            [
                'label'         => __('Grid', 'premium-addons-pro'),
                'type'          => Controls_Manager::POPOVER_TOGGLE,
                'condition'     => [
                    'y_axis_grid' => 'true'
                ]
            ]
        );

        $this->start_popover();

        $this->add_control('y_axis_grid_color',
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'default'       => '#54595f',
            ]
        );

        $this->end_popover();

        $this->end_controls_section();
        
        $this->start_controls_section('legend_style',
            [
                'label'         => __('Legend','premium-charts'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'legend_display'   => 'true'
                ]
            ]
        );
        
        $this->add_control('legend_text_color',
            [
                'label'         => __('Color', 'premium-charts'),
                'type'          => Controls_Manager::COLOR,
            ]
        );
        
        $this->add_control('legend_text_size',
			[
				'label'			=> __( 'Size', 'premium-charts' ),
				'type'			=> Controls_Manager::NUMBER,
                'min'           => 0,
                'max'           => 50,
                'default'       => 12
			]
		);
        
        $this->add_control(
            'legend_item_width',
			[
				'label'			=> __( 'Item Width', 'premium-charts' ),
				'type'			=> Controls_Manager::NUMBER,
                'min'           => 1,
                'default'       => 40
			]
		);
        
        $this->end_controls_section();
        
    }
    
    /**
	 * renders the HTML content of the widget
	 * @return void
	 */
    protected function render() {
        
        $settings = $this->get_settings_for_display();
        
        $id = $this->get_id();
        
        if(!empty($settings['title']) && $settings['title_switcher']){
            $title = '<' . $settings['title_tag'] . ' class="premium-chart-title">'. $settings['title'] .'</'.$settings['title_tag'] . '>';
        }
        $xlabels = explode(',', $settings['x_axis_labels']);

        $columns_array = array();
        
        
        foreach( $settings['y_axis_data'] as $column_data ) {
            
            if( 'pie' != $settings['type'] && 'doughnut' != $settings['type'] ) {
                $background = [ $column_data['y_axis_column_color'], $column_data['y_axis_column_second_color'] ];
            } else {
                $background = explode(',', $column_data['y_axis_circle_color']);
            }
            
            $col_settings = [
                'label'             => $column_data['y_axis_column_title'],
                'data'              => explode( ',', $column_data['y_axis_column_data'] ),
                'links'             => explode( ',', $column_data['y_axis_urls']),
                'backgroundColor'   => $background,
                'borderColor'       => $column_data['y_axis_column_border_color'],
                'borderWidth'       => $column_data['y_axis_column_border_width']
            ];
            
            array_push( $columns_array, $col_settings );
            
        }
        
        $labels_rotation    = !empty( $settings['x_axis_label_rotation'] ) ? $settings['x_axis_label_rotation'] : 0;
        
        $x_label_size       = !empty( $settings['x_axis_labels_size'] ) ? $settings['x_axis_labels_size'] : 12;
        
        $y_label_size       = !empty( $settings['y_axis_labels_size'] ) ? $settings['y_axis_labels_size'] : 12;
        
        $ytype              = 'horizontalBar' != $settings['type'] ? $settings['data_type'] : 'category';
        
        $chart_id = 'premium-chart-canvas-' . $id;
        
        $chart_settings = [
            'type'          => $settings['type'],
            'xlabeldis'     => $settings['x_axis_label_switch'],
            'xlabel'        => $settings['x_axis_label'],
            'ylabeldis'     => $settings['y_axis_label_switch'],
            'ylabel'        => $settings['y_axis_label'],
            'xlabels'       => $xlabels,
            'easing'        => $settings['start_animation'],
            'xwidth'        => ! empty( $settings['x_column_width']['size'] ) ? $settings['x_column_width']['size'] : 0.9,
            'enTooltips'    => $settings['tool_tips'],
            'printVal'      => $settings['value_on_chart'],
            'percentage'    => $settings['tool_tips_percent'],
            'modTooltips'   => $settings['tool_tips_mode'],
            'legDis'        => $settings['legend_display'],
            'legPos'        => $settings['legend_position'],
            'legRev'        => $settings['legend_reverse'],
            'legCol'        => ! empty( $settings['legend_text_color'] ) ? ( $settings['legend_text_color'] ) : '#54595f',
            'legSize'       => ( $settings['legend_text_size'] ),
            'itemWid'       => ( $settings['legend_item_width'] ),
            'xGrid'         => $settings['x_axis_grid'],
            'xGridCol'      => $settings['x_axis_grid_color'],
            'xTicksSize'    => $x_label_size,
            'xlabelcol'     => $settings['x_axis_label_color'],
            'ylabelcol'     => $settings['y_axis_label_color'],
            'xlabelsize'    => $settings['x_axis_label_size'],
            'ylabelsize'    => $settings['y_axis_label_size'],
            'xTicksCol'     => !empty( $settings['x_axis_labels_color'] ) ? $settings['x_axis_labels_color'] : '#54595f',
            'xTicksRot'     => $labels_rotation,
            'xTicksBeg'     => $settings['x_axis_begin'],
            'yAxis'         => $ytype,
            'yGrid'         => $settings['y_axis_grid'],
            'yGridCol'      => $settings['y_axis_grid_color'],
            'yTicksSize'    => $y_label_size,
            'yTicksCol'     => !empty( $settings['y_axis_labels_color'] ) ? $settings['y_axis_labels_color'] : '#54595f',
            'yTicksBeg'     => $settings['y_axis_begin'],
            'chartId'       => $chart_id,
            'suggestedMax'  => !empty( $settings['y_axis_max'] ) ? $settings['y_axis_max'] : 1,
            'height'        => !empty( $settings['height'] ) ? $settings['height'] : 400,
            'target'        => ( $settings['y_axis_urls_target'] ) ? '_blank' : '_top'
        ];
        
        $this->add_render_attribute('charts', 'id', 'premium-chart-container-' . $id );
        
        $this->add_render_attribute('charts', 'class', 'premium-chart-container' );
        
        $this->add_render_attribute('charts', 'data-chart', wp_json_encode( $columns_array ) );
        
        $this->add_render_attribute('charts', 'data-settings', wp_json_encode( $chart_settings ) );
        
        $this->add_render_attribute('canvas', 'id', 'premium-chart-canvas-' . $id );
        
        $this->add_render_attribute('canvas', 'class', 'premium-chart-canvas');
        
        $this->add_render_attribute('canvas', 'width', 400);
        
        $this->add_render_attribute('canvas', 'height', 400);
        
    ?>

    <div <?php echo $this->get_render_attribute_string('charts'); ?>>
        <?php if( !empty( $settings['title'] ) && $settings['title_switcher'] && 'top' == $settings['title_position'] ) : ?>
            <div class="premium-chart-title-container"><?php echo $title; ?></div>
        <?php endif; ?>
        <div class="premium-chart-canvas-container">
            <canvas <?php echo $this->get_render_attribute_string('canvas'); ?>></canvas>
        </div>
        <?php if( !empty( $settings['title'] ) && $settings['title_switcher'] && 'bottom' == $settings['title_position'] ) : ?>
            <div class="premium-chart-title-container"><?php echo $title; ?></div>
        <?php endif; ?>
    </div>

    <?php }
    
}