<?php

/**
 * Class: Premium_Tables
 * Name: Table
 * Slug: premium-tables-addon
 */

namespace PremiumAddonsPro\Widgets;

use PremiumAddons\Helper_Functions;
use PremiumAddons\Includes;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;

if( ! defined( 'ABSPATH' ) ) exit;

class Premium_Tables extends Widget_Base {
    
    public function getTemplateInstance() {
		return $this->templateInstance = Includes\premium_Template_Tags::getInstance();
	}
    
    public  function get_name() {
         return 'premium-tables-addon';
     }
     
    public function get_title() {
		return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Table', 'premium-addons-pro') );
	}
    
    public function get_icon() {
        return 'pa-pro-table';
    }
    
    public function get_categories() {
        return ['premium-elements'];
    }
    
    public function is_reload_preview_required() {
        return true;
    }
    
    public function get_script_depends() {
        return [
            'table-sorter',
            'table-search',
            'premium-pro-js'
        ];
    }
    
    protected function get_repeater_controls( $repeater, $condition = [] ) {
        
        $repeater->add_control('premium_table_text',
            [
                'label'         => __('Text', 'premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'placeholder'   => 'Text',
                'condition'     => array_merge( $condition, [] ),
            ]
        );

        $repeater->add_control('premium_table_icon_selector',
            [
                'label'        => __('Icon Type','premium-addons-pro'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'font-awesome-icon',
                'options'      =>[
                    'font-awesome-icon' => __('Font Awesome Icon','premium-addons-pro'),
                    'custom-image'     => __('Custom Image','premium-addons-pro'),
                ],
                'condition'     => array_merge( $condition, [] ),
            ]
        );
        
        $repeater->add_control('premium_table_cell_icon',
            [
                'label'         => __('Icon', 'premium-addons-pro'),
                'type'          => Controls_Manager::ICON,
                'label_block'   => true,
                'condition'     => array_merge( $condition,
                    [
                            'premium_table_icon_selector'   => 'font-awesome-icon'
                    ]
                ),
            ]
        );

        $repeater->add_control('premium_table_cell_icon_img',
            [
                'label'        => __('Custom Image','premium-addons-pro'),
                'type'         => Controls_Manager::MEDIA,
                'dynamic'       => [ 'active' => true ],
                'condition'     => array_merge( $condition,
                    [
                        'premium_table_icon_selector'   => 'custom-image'
                    ]
                ),
            ]
        );
        
        $repeater->add_control('premium_table_cell_icon_align', 
                [
                    'label'         => __('Icon Position', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => 'before',
                    'options'       => [
                        'top'           => __('Top', 'premium-addons-pro'),
                        'before'        => __('Before', 'premium-addons-pro'),
                        'after'         => __('After', 'premium-addons-pro'),
                        ],
                    'condition'	=> array_merge( $condition, [] ),
                    'label_block'   => true,
                    ]
                );
        
        $repeater->add_control('premium_table_cell_icon_spacing',
                [
                    'label'         => __('Icon Spacing', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'condition'	=> array_merge( $condition, [] ),
                    'selectors'     => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .premium-table-text .premium-table-cell-icon-before'   => 'margin-right: {{SIZE}}px',
                        '{{WRAPPER}} {{CURRENT_ITEM}} .premium-table-text .premium-table-cell-icon-after'    => 'margin-left: {{SIZE}}px',
                        '{{WRAPPER}} {{CURRENT_ITEM}} .premium-table-text.premium-table-cell-top .premium-table-cell-icon-top'    => 'margin-bottom: {{SIZE}}px',
                    ],
                    'separator'     => 'below',
                ]
            );
        
        $repeater->add_control('premium_table_cell_row_span',
            [
                'label'         => __('Row Span', 'premium-addons-pro'),
                'type'          => Controls_Manager::NUMBER,
                'title'         => __('Enter the number of rows for the cell', 'premium-addons-pro'),
                'default'       => 1,
                'min'           => 1,
                'max'           => 10,
                'condition'     => array_merge( $condition, [] ),
            ]
        );
        
        $repeater->add_control('premium_table_cell_span',
            [
                'label'         => __('Column Span', 'premium-addons-pro'),
                'type'          => Controls_Manager::NUMBER,
                'title'         => __('Enter the number of columns for the cell', 'premium-addons-pro'),
                'default'       => 1,
                'min'           => 1,
                'max'           => 10,
                'condition'     => array_merge( $condition, [] ),
            ]
        );
        
        $repeater->add_responsive_control('premium_table_cell_align',
                [
                    'label'         => __( 'Alignment', 'premium-addons-pro' ),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'       => [
                        'left'      => [
                            'title'=> __( 'Left', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center'    => [
                            'title'=> __( 'Center', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right'     => [
                            'title'=> __( 'Right', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'selectors_dictionary'  => [
                        'left'      => 'flex-start',
                        'center'    => 'center',
                        'right'     => 'flex-end',
                    ],
                    'default'       => 'left',
                    'selectors'     => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .premium-table-text' => 'justify-content: {{VALUE}};',
                    ],
                    'condition'     => array_merge( $condition, [
                        'premium_table_cell_icon_align!' => 'top'
                ] ),
            ]
        );
        
        $repeater->add_responsive_control('premium_table_cell_top_align',
                [
                    'label'         => __( 'Alignment', 'premium-addons-pro' ),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'       => [
                        'flex-start'      => [
                            'title'=> __( 'Left', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-left',
                            ],
                        'center'    => [
                            'title'=> __( 'Center', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-center',
                            ],
                        'flex-end'     => [
                            'title'=> __( 'Right', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-right',
                            ],
                        ],
                    'default'       => 'left',
                    'selectors'     => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .premium-table-cell-top' => 'align-items: {{VALUE}};',
                        ],
                    'condition'     => array_merge( $condition, [
                        'premium_table_cell_icon_align' => 'top'
                    ] ),
                    ]
                );
        
    }
    
    protected function _register_controls() {
        
        $this->start_controls_section('premium_table_data_section',
            [
                'label'     => __('Data', 'premium-addons-pro'),
            ]
        );
        
        $this->add_control('premium_table_data_type',
            [
                'label'     => __('Data Type', 'premium-addons-pro'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'custom'    => __('Custom', 'premium-addons-pro'),
                    'csv'       => 'CSV' . __(' File','premium-addons-pro')
                ],
                'default'   => 'custom'
            ]);
        
        $this->add_control('premium_table_csv_type',
            [
                'label'     => __('File Type', 'premium-addons-pro'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'file'      => __('Upload FIle', 'premium-addons-pro'),
                    'url'       => __('Remote File','premium-addons-pro')
                ],
                'condition' => [
                    'premium_table_data_type'   => 'csv',
                ],
                'default'   => 'file'
            ]
        );
        
        $this->add_control('premium_table_separator',
            [
                'label'     => __('Data Separator', 'premium-addons-pro'),
                'type'      => Controls_Manager::TEXT,
                'description'=> __('Separator between cells data', 'premium-addons-pro'),
                'label_block'=> true,
                'default'   => ',',
                'condition' => [
                    'premium_table_data_type'   => 'csv',
                ]
            ]
        );
        
        $this->add_control('premium_table_csv',
            [
                'label'     => __('Upload CSV File', 'premium-addons-pro'),
                'type'      => Controls_Manager::MEDIA,
                'media_type'=> array(),
                'condition' => [
                    'premium_table_data_type'   => 'csv',
                    'premium_table_csv_type'    => 'file'
                ]
            ]);
        
        $this->add_control('premium_table_csv_url',
            [
                'label'     => __('File URL', 'premium-addons-pro'),
                'type'      => Controls_Manager::TEXT,
                'label_block'   => true,
                'condition' => [
                    'premium_table_data_type'   => 'csv',
                    'premium_table_csv_type'    => 'url'
                ]
            ]);
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_table_head_section',
            [
                'label'     => __('Head', 'premium-addons-pro'),
                'condition' => [
                    'premium_table_data_type'   => 'custom'
                ]
            ]
        );
        
        $head_repeater = new Repeater();
        
        $this->get_repeater_controls($head_repeater, array() );
        
        $this->add_control('premium_table_head_repeater',
            [
                'label'         => __('Cell', 'premium-addons-pro'),
                'type'          => Controls_Manager::REPEATER,
                'fields'        => $head_repeater->get_controls(),
                'default'       => [
                    [
                        'premium_table_text'    => __('First Head', 'premium-addons-pro'),
                    ],
                    [
                        'premium_table_text'    => __('Second Head', 'premium-addons-pro'),
                    ],
                    [
                        'premium_table_text'    => __('Third Head', 'premium-addons-pro'),
                    ]
                ],
                'title_field'   =>  '{{{ premium_table_text }}}',
                'prevent_empty' => true
            ]
        );
        
        //Text Align
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_table_body_section',
            [
                'label'     => __('Body', 'premium-addons-pro'),
                'condition' => [
                    'premium_table_data_type'   => 'custom'
                ]
            ]
        );
        
        $body_repeater = new Repeater();
        
        $body_repeater->add_control('premium_table_elem_type',
            [
                'label'     => __('Type', 'premium-addons-pro'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'cell'      => __('Cell', 'premium-addons-pro'),
                    'row'       => __('Row', 'premium-addons-pro'),
                ],
                'default'   => 'cell'
            ]
        );
        
        $body_repeater->add_control('premium_table_cell_type',
            [
                'label'     => __('Cell Type', 'premium-addons-pro'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'td'        => __('Body', 'premium-addons-pro'),
                    'th'        => __('Head', 'premium-addons-pro'),
                ],
                'default'   => 'td',
                'condition'     => [
                    'premium_table_elem_type'   => 'cell'
                ]
            ]
        );
        
        $this->get_repeater_controls( $body_repeater, array( 'premium_table_elem_type' => 'cell' ) );

        $body_repeater->add_control('premium_table_link_switcher',
            [
                'label'         => __('Link', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'condition'     => [
                    'premium_table_elem_type'   => 'cell'
                ]
            ]
        );

        $body_repeater->add_control('premium_table_link_selection', 
            [
                'label'         => __('Link Type', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'url'   => __('URL', 'premium-addons-pro'),
                    'link'  => __('Existing Page', 'premium-addons-pro'),
                ],
                'default'       => 'url',
                'label_block'   => true,
                'condition'		=> [
                    'premium_table_link_switcher'	=> 'yes',
                    'premium_table_elem_type'       => 'cell'
                    ]
                ]
            );
        
        $body_repeater->add_control('premium_table_link',
            [
                'label'         => __('Link', 'premium-addons-pro'),
                'type'          => Controls_Manager::URL,
                'dynamic'       => [ 'active' => true ],
                'default'       => [
                    'url'   => '#',
                ],
                'placeholder'   => 'https://premiumaddons.com/',
                'label_block'   => true,
                'separator'     => 'after',
                'condition'     => [
                    'premium_table_elem_type'       => 'cell',
                    'premium_table_link_switcher'	=> 'yes',
                    'premium_table_link_selection'  => 'url'
                ]
            ]
        );
        
        $body_repeater->add_control('premium_table_existing_link',
            [
                'label'         => __('Existing Page', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT2,
                'options'       => $this->getTemplateInstance()->get_all_post(),
                'condition'     => [
                    'premium_table_elem_type'       => 'cell',
                    'premium_table_link_switcher'	=> 'yes',
                    'premium_table_link_selection'  => 'link',
                ],
                'multiple'      => false,
                'label_block'   => true,
            ]
        );
        
    $this->add_control('premium_table_body_repeater',
				[
					'label' 	=> __( 'Rows', 'premium-addons-pro' ),
					'type' 		=> Controls_Manager::REPEATER,
					'default' 	=> [
						[
							'premium_table_elem_type'           => 'row',
						],
						[
							'premium_table_elem_type' 			=> 'cell',
							'premium_table_text'                => __( 'Column #1', 'premium-addons-pro' ),
						],
						[
							'premium_table_elem_type' 			=> 'cell',
							'premium_table_text'                => __( 'Column #2', 'premium-addons-pro' ),
						],
						[
							'premium_table_elem_type'           => 'cell',
							'premium_table_text'                => __( 'Column #3', 'premium-addons-pro' ),
						],
						[
							'premium_table_elem_type'           => 'row',
						],
						[
							'premium_table_elem_type'           => 'cell',
							'premium_table_text'                => __( 'Column #1', 'premium-addons-pro' ),
						],
						[
							'premium_table_elem_type'           => 'cell',
							'premium_table_text'                => __( 'Column #2', 'premium-addons-pro' ),
						],
						[
							'premium_table_elem_type'           => 'cell',
							'premium_table_text'                => __( 'Column #3', 'premium-addons-pro' ),
						],
					],
					'fields' 			=> array_values( $body_repeater->get_controls() ),
					'title_field' 		=> '{{ premium_table_elem_type }}: {{{ premium_table_text }}}',
				]
			);
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_table_display', 
            [
                'label'         => __('Display Options', 'premium-addons-pro'),
            ]
        );
        
        $this->add_responsive_control('premium_table_width',
                [
                    'label'         => __('Width', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%'],
                    'range'         => [
                        'px'    => [
                            'min'   => 1,
                            'max'   => 700
                        ]
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .elementor-widget-container' => 'width: {{SIZE}}{{UNIT}};'
                        ]
                    ]
                );
        
        $this->add_control('premium_table_blur',
            [
                'label' 		=> __( 'Blur On Hover', 'premium-addons-pro' ),
                'type' 			=> Controls_Manager::SWITCHER,
                'description'   => sprintf('<span style="font-weight: bold">%s</span>', __( 'You will need to set rows text hover color from style tab', 'premium-addons-pro' ) )
            ]
        );
        
        $this->add_control('premium_table_responsive',
            [
                'label' 		=> __( 'Responsive', 'premium-addons-pro' ),
                'type' 			=> Controls_Manager::SWITCHER,
                'description'   => __( 'Enables scroll on mobile.', 'premium-addons-pro' ),
                'frontend_available' => true,
            ]
        );
        
        $this->add_responsive_control('premium_table_align',
                [
                    'label'         => __( 'Table Alignment', 'premium-addons-pro' ),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'       => [
                        'flex-start'      => [
                            'title'=> __( 'Left', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-left',
                            ],
                        'center'    => [
                            'title'=> __( 'Center', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-center',
                            ],
                        'flex-end'     => [
                            'title'=> __( 'Right', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-right',
                            ],
                        ],
                    'default'       => 'center',
                    'selectors'     => [
                        '{{WRAPPER}}' => 'justify-content: {{VALUE}};',
                        ],
                    ]
                );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_table_advanced', 
            [
                'label'         => __('Advanced Settings', 'premium-addons-pro'),
            ]
        );
        
        $this->add_control('premium_table_sort',
            [
                'label' 		=> __( 'Sortable', 'premium-addons-pro' ),
                'type' 			=> Controls_Manager::SWITCHER,
                'description'   => __( 'Enables sorting with respect to the table heads.', 'premium-addons-pro' ),
                'frontend_available' => true,
                'condition'     => [
                    'premium_table_data_type!'   => 'csv'
                ]
            ]
        );
        
        $this->add_control('premium_table_sort_mob',
            [
                'label'             => __( 'Sort on Mobile', 'premium-addons-pro' ),
                'type'              => Controls_Manager::SWITCHER,
                'frontend_available'=> true,
                'condition'         => [
                    'premium_table_sort'    => 'yes'
                ]
            ]
        );
        
        $this->add_control('premium_table_search',
            [
                'label' 		=> __( 'Search', 'premium-addons-pro' ),
                'type' 			=> Controls_Manager::SWITCHER,
                'description'   => __( 'Enables searching through the table using rows\' first cell keyword.', 'premium-addons-pro' ),
                'frontend_available' => true,
            ]
        );
        
        $this->add_control('premium_table_search_placeholder',
            [
                'label'         => __('Placeholder', 'premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'default'       => __('Live Search...', 'premium-addons-pro'),
                'condition'     => [
                    'premium_table_search'  => 'yes'
                ]
            ]
        );

        $this->add_control('premium_table_records',
            [
                'label'         => __( 'Show Records', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __( 'Shows a dropdown to control number of records', 'premium-addons-pro' ),
                'condition'     => [
                    'premium_table_data_type'   => 'custom'
                ],
                'frontend_available' => true,
            ]
        );
        
        $this->add_control('premium_table_records_label',
            [
                'label'         => __('Label', 'premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'default'       => __('Show Records:', 'premium-addons-pro'),
                'condition'     => [
                    'premium_table_records'  => 'yes'
                ]
            ]
        );
        
        $this->add_responsive_control('premium_table_search_align',
                [
                    'label'         => __( 'Search Alignment', 'premium-addons-pro' ),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'       => [
                        'left'      => [
                            'title'=> __( 'Left', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-left',
                            ],
                        'center'    => [
                            'title'=> __( 'Center', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-center',
                            ],
                        'right'     => [
                            'title'=> __( 'Right', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-right',
                            ],
                        ],
                    'default'       => 'right',
                    'selectors'     => [
                        '{{WRAPPER}} .premium-table-search-wrap' => 'text-align: {{VALUE}};',
                        ],
                    'condition'         => [
                        'premium_table_search'    => 'yes',
                        'premium_table_records!'    => 'yes'
                        ]
                    ]
                );
        
        $this->add_responsive_control('premium_table_records_align',
                [
                    'label'         => __( 'Show Records Alignment', 'premium-addons-pro' ),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'       => [
                        'left'      => [
                            'title'=> __( 'Left', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-left',
                            ],
                        'center'    => [
                            'title'=> __( 'Center', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-center',
                            ],
                        'right'     => [
                            'title'=> __( 'Right', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-right',
                            ],
                        ],
                    'default'       => 'right',
                    'selectors'     => [
                        '{{WRAPPER}} .premium-table-records-wrap' => 'text-align: {{VALUE}};',
                        ],
                    'condition'         => [
                        'premium_table_records'    => 'yes',
                        'premium_table_search!'    => 'yes'
                        ]
                    ]
                );
        
        $this->add_control('premium_table_search_dir',
                [
                    'label'         => __('Direction', 'premium-addons-pro'),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'           => [
                        'ltr'    => [
                            'title' => __( 'LTR', 'premium-addons-pro' ),
                            'icon'  => 'fa fa-arrow-circle-right',
                        ],
                        'rtl' => [
                            'title' => __( 'RTL', 'premium-addons-pro' ),
                            'icon'  => 'fa fa-arrow-circle-left',
                        ],
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-table-wrap' => 'direction: {{VALUE}};',
                    ],
                    'default'       => 'ltr',
                    'label_block'   => true,
                ]
                );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_table_head_style', 
            [
                'label'         => __('Head', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );
        
        $this->start_controls_tabs('premium_table_head_style_tabs');
        
        $this->start_controls_tab('premium_table_odd_head_odd_style',
                [
                    'label'     => __('Odd', 'premium-addons-pro'),
                ]
            );
        
        $this->add_control('premium_table_odd_head_color',
            [
                'label'         => __('Text Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'      => Scheme_Color::get_type(),
                    'value'     => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-table .premium-table-row th.premium-table-cell:nth-child(odd) .premium-table-text' => 'color: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_control('premium_table_odd_head_hover_color',
            [
                'label'         => __('Text Hover Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'      => Scheme_Color::get_type(),
                    'value'     => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-table .premium-table-row th.premium-table-cell:nth-child(odd) .premium-table-text:hover' => 'color: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_control('premium_table_odd_head_icon_color',
            [
                'label'         => __('Icon Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'      => Scheme_Color::get_type(),
                    'value'     => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-table .premium-table-row th.premium-table-cell:nth-child(odd) .premium-table-text i' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'premium_table_data_type'   => 'custom'
                ]
            ]
        );
        
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'          => 'premium_table_odd_head_typo',
                    'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'      => '{{WRAPPER}} .premium-table .premium-table-row th.premium-table-cell:nth-child(odd) .premium-table-text'
                    ]
                );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'name'          => 'premium_table_odd_head_text_shadow',
                    'selector'      => '{{WRAPPER}} .premium-table .premium-table-row th.premium-table-cell:nth-child(odd) .premium-table-text'
                    ]
                );
        
        $this->add_control('premium_table_odd_head_background_popover',
                [
                    'label'         => __('Background', 'premium-addons-pro'),
                    'type'          => Controls_Manager::POPOVER_TOGGLE,
                    ]
                );

        $this->start_popover();
        
        $this->add_control('premium_table_odd_head_background_heading',
            [
                'label'             => __('Normal', 'premium-addons-pro'),
                'type'              => Controls_Manager::HEADING
            ]);
        
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_table_odd_head_background',
                    'types'             => [ 'classic', 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-table .premium-table-row th.premium-table-cell:nth-child(odd)'
                ]
                );
        
        $this->add_control('premium_table_odd_head_hover_background_heading',
            [
                'label'             => __('Hover', 'premium-addons-pro'),
                'type'              => Controls_Manager::HEADING
            ]);
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_table_odd_head_hover_background',
                    'types'             => [ 'classic', 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-table .premium-table-row th.premium-table-cell:nth-child(odd):hover'
                ]
                );
        
        $this->end_popover();
        
        $this->add_responsive_control('premium_table_odd_head_align',
                [
                    'label'         => __( 'Alignment', 'premium-addons-pro' ),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'       => [
                        'left'      => [
                            'title'=> __( 'Left', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center'    => [
                            'title'=> __( 'Center', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right'     => [
                            'title'=> __( 'Right', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'default'       => 'left',
                    'selectors_dictionary'  => [
                        'left'      => 'flex-start',
                        'center'    => 'center',
                        'right'     => 'flex-end',
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-table .premium-table-row th.premium-table-cell:nth-child(odd) .premium-table-text' => 'justify-content: {{VALUE}};',
                        ],
                    'condition'     => [
                            'premium_table_data_type' => 'csv'
                        ] ,
                    ]
                );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab('premium_table_head_even_style',
                [
                    'label'     => __('Even', 'premium-addons-pro'),
                ]
            );
        
        $this->add_control('premium_table_even_head_color',
            [
                'label'         => __('Text Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'      => Scheme_Color::get_type(),
                    'value'     => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-table .premium-table-row th.premium-table-cell:nth-child(even) .premium-table-text' => 'color: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_control('premium_table_even_head_hover_color',
            [
                'label'         => __('Text Hover Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'      => Scheme_Color::get_type(),
                    'value'     => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-table .premium-table-row th.premium-table-cell:nth-child(even) .premium-table-text:hover' => 'color: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_control('premium_table_even_head_icon_color',
            [
                'label'         => __('Icon Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'      => Scheme_Color::get_type(),
                    'value'     => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-table .premium-table-row th.premium-table-cell:nth-child(even) .premium-table-text i' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'premium_table_data_type'   => 'custom'
                ]
            ]
        );
        
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'          => 'premium_table_even_head_typo',
                    'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'      => '{{WRAPPER}} .premium-table .premium-table-row th.premium-table-cell:nth-child(even) .premium-table-text'
                    ]
                );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'name'          => 'premium_table_even_head_text_shadow',
                    'selector'      => '{{WRAPPER}} .premium-table .premium-table-row th.premium-table-cell:nth-child(even) .premium-table-text'
                    ]
                );
        
        $this->add_control('premium_table_even_head_background_popover',
                [
                    'label'         => __('Background', 'premium-addons-pro'),
                    'type'          => Controls_Manager::POPOVER_TOGGLE,
                    ]
                );

        $this->start_popover();
        
        $this->add_control('premium_table_even_head_background_heading',
            [
                'label'             => __('Normal', 'premium-addons-pro'),
                'type'              => Controls_Manager::HEADING
            ]);
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_table_even_head_background',
                    'types'             => [ 'classic', 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-table .premium-table-row th.premium-table-cell:nth-child(even)'
                ]
                );
        
        $this->add_control('premium_table_even_head_hover_background_heading',
            [
                'label'             => __('Hover', 'premium-addons-pro'),
                'type'              => Controls_Manager::HEADING
            ]);
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_table_even_head_hover_background',
                    'types'             => [ 'classic', 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-table .premium-table-row th.premium-table-cell:nth-child(even):hover'
                ]
                );
        
        $this->end_popover();
        
        $this->add_responsive_control('premium_table_even_head_align',
                [
                    'label'         => __( 'Alignment', 'premium-addons-pro' ),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'       => [
                        'left'      => [
                            'title'=> __( 'Left', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-left',
                            ],
                        'center'    => [
                            'title'=> __( 'Center', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-center',
                            ],
                        'right'     => [
                            'title'=> __( 'Right', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-right',
                            ],
                        ],
                    'default'       => 'left',
                    'selectors_dictionary'  => [
                        'left'      => 'flex-start',
                        'center'    => 'center',
                        'right'     => 'flex-end',
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-table .premium-table-row th.premium-table-cell:nth-child(even) .premium-table-text' => 'justify-content: {{VALUE}};',
                        ],
                    'condition'     => [
                            'premium_table_data_type' => 'csv'
                        ] ,
                    ]
                );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_table_head_rows_border',
                    'selector'      => '{{WRAPPER}} .premium-table .premium-table-row th.premium-table-cell',
                    'separator'     => 'before'
                ]
                );
        
        $this->add_responsive_control('premium_table_head_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-table .premium-table-row th.premium-table-cell .premium-table-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_table_row_style', 
            [
                'label'         => __('Rows', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );
        
        $this->start_controls_tabs('premium_table_row_style_tabs');
        
        $this->start_controls_tab('premium_table_odd_row_odd_style',
                [
                    'label'     => __('Odd', 'premium-addons-pro'),
                ]
            );
        
        $this->add_control('premium_table_odd_row_color',
            [
                'label'         => __('Text Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'      => Scheme_Color::get_type(),
                    'value'     => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-table tbody tr:nth-of-type(odd) .premium-table-cell .premium-table-text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .premium-table-blur tbody:hover tr:nth-of-type(odd) .premium-table-text' => 'text-shadow: 0 0 3px {{VALUE}};'
                    
                ]
            ]
        );
        
        $this->add_control('premium_table_odd_row_hover_color',
            [
                'label'         => __('Text Hover Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'      => Scheme_Color::get_type(),
                    'value'     => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-table tbody tr:nth-of-type(odd) .premium-table-cell .premium-table-text:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .premium-table-blur tbody:hover tr:nth-of-type(odd):hover .premium-table-text' => 'text-shadow: none !important; color: {{VALUE}} !important;'
                ]
            ]
        );
        
        $this->add_control('premium_table_row_row_icon_color',
            [
                'label'         => __('Icon Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'      => Scheme_Color::get_type(),
                    'value'     => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-table tbody tr:nth-of-type(odd) .premium-table-cell .premium-table-text i' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'premium_table_data_type'   => 'custom'
                ]
            ]
        );
        
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'          => 'premium_table_odd_row_typo',
                    'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'      => '{{WRAPPER}} .premium-table tbody tr:nth-of-type(odd) .premium-table-cell .premium-table-text'
                    ]
                );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'name'          => 'premium_table_odd_row_text_shadow',
                    'selector'      => '{{WRAPPER}} .premium-table tbody tr:nth-of-type(odd) .premium-table-cell .premium-table-text'
                    ]
                );
        
        $this->add_control('premium_table_odd_row_background_popover',
                [
                    'label'         => __('Background', 'premium-addons-pro'),
                    'type'          => Controls_Manager::POPOVER_TOGGLE,
                    ]
                );

        $this->start_popover();
        
        $this->add_control('premium_table_odd_row_background_heading',
            [
                'label'             => __('Normal', 'premium-addons-pro'),
                'type'              => Controls_Manager::HEADING
            ]);
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_table_odd_row_background',
                    'types'             => [ 'classic' , 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-table tbody tr:nth-of-type(odd) .premium-table-cell'
                    ]
                );
        
        $this->add_control('premium_table_odd_row_hover_background_heading',
            [
                'label'             => __('Hover', 'premium-addons-pro'),
                'type'              => Controls_Manager::HEADING
            ]);
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_table_odd_row_hover_background',
                    'types'             => [ 'classic' , 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-table tbody tr:nth-of-type(odd) .premium-table-cell:hover'
                    ]
                );
        
        $this->end_popover();
        
        $this->end_controls_tab();
        
        $this->start_controls_tab('premium_table_row_even_style',
                [
                    'label'     => __('Even', 'premium-addons-pro'),
                ]
            );
        
        $this->add_control('premium_table_even_row_color',
            [
                'label'         => __('Text Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'      => Scheme_Color::get_type(),
                    'value'     => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-table tbody tr:nth-of-type(even) .premium-table-cell .premium-table-text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .premium-table-blur tbody:hover tr:nth-of-type(even) .premium-table-text' => 'text-shadow: 0 0 3px {{VALUE}};'
                ]
            ]
        );
        
        $this->add_control('premium_table_even_row_hover_color',
            [
                'label'         => __('Text Hover Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'      => Scheme_Color::get_type(),
                    'value'     => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-table tbody tr:nth-of-type(even) .premium-table-cell .premium-table-text:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .premium-table-blur tbody:hover tr:nth-of-type(even):hover .premium-table-text' => 'text-shadow: none !important; color: {{VALUE}} !important;'
                ]
            ]
        );
        
        $this->add_control('premium_table_row_even_icon_color',
            [
                'label'         => __('Icon Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'      => Scheme_Color::get_type(),
                    'value'     => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-table tbody tr:nth-of-type(even) .premium-table-cell .premium-table-text i' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'premium_table_data_type'   => 'custom'
                ]
            ]
        );
        
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'          => 'premium_table_even_row_typo',
                    'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'      => '{{WRAPPER}} .premium-table tbody tr:nth-of-type(even) .premium-table-cell .premium-table-text'
                    ]
                );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'name'          => 'premium_table_even_row_text_shadow',
                    'selector'      => '{{WRAPPER}} .premium-table tbody tr:nth-of-type(even) .premium-table-cell .premium-table-text'
                    ]
                );
        
        $this->add_control('premium_table_even_row_background_popover',
                [
                    'label'         => __('Background', 'premium-addons-pro'),
                    'type'          => Controls_Manager::POPOVER_TOGGLE,
                    ]
                );

        $this->start_popover();
        
        $this->add_control('premium_table_even_row_background_heading',
            [
                'label'             => __('Normal', 'premium-addons-pro'),
                'type'              => Controls_Manager::HEADING
            ]);
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_table_even_row_background',
                    'types'             => [ 'classic' , 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-table tbody tr:nth-of-type(even) .premium-table-cell'
                    ]
                );
        
        $this->add_control('premium_table_even_row_hover_background_heading',
            [
                'label'             => __('Hover', 'premium-addons-pro'),
                'type'              => Controls_Manager::HEADING
            ]);
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_table_even_row_hover_background',
                    'types'             => [ 'classic' , 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-table tbody tr:nth-of-type(even) .premium-table-cell:hover'
                    ]
                );
        
        $this->end_popover();
                
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_table_row_border',
                    'separator'		=> 'before',
                    'selector'      => '{{WRAPPER}} .premium-table .premium-table-row td.premium-table-cell'
                ]
                );
        
        $this->add_responsive_control('premium_table_odd_row_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-table .premium-table-row td.premium-table-cell .premium-table-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );
         
       
        $this->end_controls_section();

        $this->start_controls_section('premium_table_col_style', 
            [
                'label'         => __('Columns', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );
        
        $this->start_controls_tabs('premium_table_col_style_tabs');
        
        $this->start_controls_tab('premium_table_odd_col_odd_style',
                [
                    'label'     => __('Odd', 'premium-addons-pro'),
                ]
            );
        
        $this->add_control('premium_table_odd_col_background_popover',
                [
                    'label'         => __('Background', 'premium-addons-pro'),
                    'type'          => Controls_Manager::POPOVER_TOGGLE,
                    ]
                );

        $this->start_popover();
        
        $this->add_control('premium_table_odd_col_background_heading',
            [
                'label'             => __('Normal', 'premium-addons-pro'),
                'type'              => Controls_Manager::HEADING
            ]);
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_table_odd_col_background',
                    'types'             => [ 'classic', 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-table .premium-table-row .premium-table-cell:nth-child(odd)'
                ]
                );
        
        
        $this->add_control('premium_table_odd_col_hover_background_heading',
            [
                'label'             => __('Hover', 'premium-addons-pro'),
                'type'              => Controls_Manager::HEADING
            ]);
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_table_odd_col_hover_background',
                    'types'             => [ 'classic', 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-table .premium-table-row .premium-table-cell:nth-child(odd):hover'
                ]
                );
        
        $this->end_popover();
        
        $this->add_responsive_control('premium_table_odd_col_align',
                [
                    'label'         => __( 'Alignment', 'premium-addons-pro' ),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'       => [
                        'left'      => [
                            'title'=> __( 'Left', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-left',
                            ],
                        'center'    => [
                            'title'=> __( 'Center', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-center',
                            ],
                        'right'     => [
                            'title'=> __( 'Right', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-right',
                            ],
                        ],
                    'default'       => 'left',
                    'selectors_dictionary'  => [
                        'left'      => 'flex-start',
                        'center'    => 'center',
                        'right'     => 'flex-end',
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-table .premium-table-row .premium-table-cell:nth-child(odd) .premium-table-text' => 'justify-content: {{VALUE}};',
                        ],
                    'condition'     => [
                            'premium_table_data_type' => 'csv'
                        ] ,
                    ]
                );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab('premium_table_col_even_style',
                [
                    'label'     => __('Even', 'premium-addons-pro'),
                ]
            );
        
        $this->add_control('premium_table_even_col_background_popover',
                [
                    'label'         => __('Background', 'premium-addons-pro'),
                    'type'          => Controls_Manager::POPOVER_TOGGLE,
                    ]
                );

        $this->start_popover();
        
        $this->add_control('premium_table_even_col_background_heading',
            [
                'label'             => __('Normal', 'premium-addons-pro'),
                'type'              => Controls_Manager::HEADING
            ]);
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_table_even_col_background',
                    'types'             => [ 'classic', 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-table .premium-table-row .premium-table-cell:nth-child(even)'
                ]
                );
        
        $this->add_control('premium_table_even_col_hover_background_heading',
            [
                'label'             => __('Hover', 'premium-addons-pro'),
                'type'              => Controls_Manager::HEADING
            ]);
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_table_even_col_hover_background',
                    'types'             => [ 'classic', 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-table .premium-table-row .premium-table-cell:nth-child(even):hover'
                ]
                );
        
        $this->end_popover();
        
        $this->add_responsive_control('premium_table_even_col_align',
                [
                    'label'         => __( 'Alignment', 'premium-addons-pro' ),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'       => [
                        'left'      => [
                            'title'=> __( 'Left', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-left',
                            ],
                        'center'    => [
                            'title'=> __( 'Center', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-center',
                            ],
                        'right'     => [
                            'title'=> __( 'Right', 'premium-addons-pro' ),
                            'icon' => 'fa fa-align-right',
                            ],
                        ],
                    'default'       => 'left',
                    'selectors_dictionary'  => [
                        'left'      => 'flex-start',
                        'center'    => 'center',
                        'right'     => 'flex-end',
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-table .premium-table-row td.premium-table-cell:nth-child(even) .premium-table-text' => 'justify-content: {{VALUE}};',
                        ],
                    'condition'     => [
                            'premium_table_data_type' => 'csv'
                        ] ,
                    ]
                );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_table_sort_style', 
            [
                'label'         => __('Sort', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'premium_table_sort'    => 'yes',
                    'premium_table_data_type!'  => 'csv'
                ]
            ]
        );
        
        $this->add_control('premium_table_sort_color',
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'      => Scheme_Color::get_type(),
                    'value'     => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-table thead .premium-table-cell .premium-table-sort-icon:before' => 'color: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_control('premium_table_sort_hover_color',
            [
                'label'         => __('Hover Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'      => Scheme_Color::get_type(),
                    'value'     => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-table thead .premium-table-cell:hover .premium-table-sort-icon:before' => 'color: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_control('premium_table_sort_background',
            [
                'label'         => __('Background', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'      => Scheme_Color::get_type(),
                    'value'     => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-table thead .premium-table-cell .premium-table-sort-icon:before' => 'background: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_table_sort_border',
                    'selector'      => '{{WRAPPER}} .premium-table thead .premium-table-cell .premium-table-sort-icon:before'
                ]
                );
        
        $this->add_control('premium_table_sort_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-table thead .premium-table-cell .premium-table-sort-icon:before' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'name'          => 'premium_table_sort_box_shadow',
                    'selector'      => '{{WRAPPER}} .premium-table thead .premium-table-cell .premium-table-sort-icon:before'
                    ]
                );

        $this->add_responsive_control('premium_table_sort_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-table thead .premium-table-cell .premium-table-sort-icon:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_table_search_style', 
            [
                'label'         => __('Search', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'premium_table_search'    => 'yes'
                ]
            ]
        );
        
        $this->add_responsive_control('premium_table_search_width',
                [
                    'label'         => __('Width', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'range'         => [
                        'px'    => [
                            'min'   => 1,
                            'max'   => 300
                        ],
                        'em'    => [
                            'min'   => 1,
                            'max'   => 20
                        ]
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-table-search-field, {{WRAPPER}} .premium-table-filter-records .premium-table-search-wrap' => 'width: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        $this->add_control('premium_table_search_color',
            [
                'label'         => __('Input Text Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'      => Scheme_Color::get_type(),
                    'value'     => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-table-search-field' => 'color: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_table_search_background',
                    'types'             => [ 'classic' , 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-table-search-field',
                    ]
                );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_table_search_border',
                    'selector'      => '{{WRAPPER}} .premium-table-search-field',
                ]
                );
        
        $this->add_control('premium_table_search_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-table-search-field' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'name'          => 'premium_table_container_search_shadow',
                    'selector'      => '{{WRAPPER}} .premium-table-search-field',
                    ]
                );
        
        $this->add_responsive_control('premium_table_search_margin',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-table-search-field' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );

        $this->add_responsive_control('premium_table_search_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-table-search-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_table_records_style', 
            [
                'label'         => __('Records', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'premium_table_records'    => 'yes'
                ]
            ]
        );
        
        $this->add_responsive_control('premium_table_records_width',
                [
                    'label'         => __('Width', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'range'         => [
                        'px'    => [
                            'min'   => 50,
                            'max'   => 300
                        ],
                        'em'    => [
                            'min'   => 1,
                            'max'   => 20
                        ]
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-table-records-box' => 'width: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        $this->add_control('premium_table_filters_color',
            [
                'label'         => __('Options Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'      => Scheme_Color::get_type(),
                    'value'     => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-table-records-box' => 'color: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_table_records_background',
                    'types'             => [ 'classic' , 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-table-records-box',
                    ]
                );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_table_records_border',
                    'selector'      => '{{WRAPPER}} .premium-table-records-box',
                ]
                );
        
        $this->add_control('premium_table_records_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-table-records-box' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'name'          => 'premium_table_records_shadow',
                    'selector'      => '{{WRAPPER}} .premium-table-records-box',
                    ]
                );
        
        $this->add_responsive_control('premium_table_records_margin',
                [
                    'label'         => __('Select Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-table-records-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );
        
        $this->add_responsive_control('premium_table_records_box_margin',
                [
                    'label'         => __('Box Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-table-records-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );
        

        $this->add_responsive_control('premium_table_records_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-table-records-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_table_style', 
            [
                'label'         => __('Table', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_table_background',
                    'types'             => [ 'classic' , 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-table',
                    ]
                );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_table_border',
                    'selector'      => '{{WRAPPER}} .premium-table',
                ]
                );
        
        $this->add_control('premium_table_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-table' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'name'          => 'premium_table_box_shadow',
                    'selector'      => '{{WRAPPER}} .premium-table',
                    ]
                );
        
        $this->end_controls_section();
        
    }
    
    protected function get_table_head(){
        $settings = $this->get_settings_for_display();
        
        
        $head = '';
        
        $this->add_render_attribute('table_head', 'class', 'premium-table-head');
        
        $this->add_render_attribute('table_row', 'class', 'premium-table-row');
        
        ?>

        <thead <?php echo $this->get_render_attribute_string('table_head'); ?>>
            
            <tr <?php echo $this->get_render_attribute_string('table_row'); ?>>
                
                <?php 
                
                if( 'custom' == $settings['premium_table_data_type'] ) {
                    
                    foreach($settings['premium_table_head_repeater'] as $index => $head_cell ) {
                    
                        $head_cell_text = $this->get_repeater_setting_key('premium_table_text','premium_table_head_repeater', $index);

                        $this->add_render_attribute('head-cell-' . $index , 'class', 'premium-table-cell');
                        $this->add_render_attribute('head-cell-' . $index , 'class', 'elementor-repeater-item-' . $head_cell['_id']);

                        $this->add_render_attribute('head-text-' . $index, 'class', 'premium-table-text');

                        if( 'top' == $head_cell['premium_table_cell_icon_align'] && ('' != $head_cell['premium_table_cell_icon'] || '' != $head_cell['premium_table_cell_icon_img']['url'] ) ){
                            $this->add_render_attribute('head-text-' . $index, 'class', 'premium-table-cell-top');
                        }

                        $this->add_render_attribute($head_cell_text, 'class', 'premium-table-inner');

                        $this->add_inline_editing_attributes($head_cell_text, 'basic');

                        if( $head_cell['premium_table_cell_span'] > 1 ){
                            $this->add_render_attribute('head-cell-'. $index,'colspan', $head_cell['premium_table_cell_span']);
                        }
                        if( $head_cell['premium_table_cell_row_span'] > 1 ){
                            $this->add_render_attribute('head-cell-'. $index,'rowspan', $head_cell['premium_table_cell_row_span']);
                        }

                        $head .= '<th ' . $this->get_render_attribute_string('head-cell-'. $index) . '>';
                        $head .= '<span ' . $this->get_render_attribute_string('head-text-'. $index) . '>';
                        if( '' != $head_cell['premium_table_cell_icon'] || '' != $head_cell['premium_table_cell_icon_img']['url']){

                            $this->add_render_attribute('cell-icon-' . $index , 'class', 'premium-table-cell-icon-' . $head_cell['premium_table_cell_icon_align']);
                            $this->add_render_attribute('head-text-' . $index, 'class', 'premium-table-text');

                            $head .= '<span ' . $this->get_render_attribute_string( 'cell-icon-' . $index ) . '>';
                                if($head_cell['premium_table_icon_selector'] == 'font-awesome-icon'){
                                    $head .= '<i class="' . esc_attr( $head_cell['premium_table_cell_icon'] ) . '"></i>';
                                } else {
                                    $head .= '<img src="' . esc_attr( $head_cell['premium_table_cell_icon_img']['url'] ) . '">';
                                }

                            $head .= '</span>';
                        }

                        $head .= '<span ' . $this->get_render_attribute_string($head_cell_text) . '>' . $head_cell['premium_table_text'] . '</span>';
                        if ( 'yes' === $settings['premium_table_sort'] ) {
                            $head .= '<span class="premium-table-sort-icon premium-icon-sort fa fa-sort"></span>';
                            $head .= '<span class="premium-table-sort-icon premium-icon-sort-up fa fa-sort-up"></span>';
                            $head .= '<span class="premium-table-sort-icon premium-icon-sort-down fa fa-sort-down"></span>';
                        }
                        $head .= '</span>';
                        $head .= '</th>';

                    }

                    echo $head;
                    
                }
                
                ?>
                
            </tr>
            
        </thead>
            
    <?php }
    
protected function is_first_elem_row() {
    $settings = $this->get_settings();

    if ( 'row' === $settings['premium_table_body_repeater'][0]['premium_table_elem_type'] )
        return false;

    return true;
}
    
protected function get_table_body(){
     
    $settings = $this->get_settings_for_display();
        
    $body = '';
    
    $counter 		= 1;
    
    $cell_counter 	= 0;
    
    $row_count 		= count( $settings['premium_table_body_repeater'] );
    
    $this->add_render_attribute('table_body', 'class', 'premium-table-body');
        
    $this->add_render_attribute('table_row', 'class', 'premium-table-row');
        
    ?>
        
        <tbody <?php echo $this->get_render_attribute_string('table_body'); ?>>
            <?php if($this->is_first_elem_row()) { ?>
                <tr <?php echo $this->get_render_attribute_string('table_row'); ?>
            <?php } ?>
            <?php foreach($settings['premium_table_body_repeater'] as $index => $elem){
                
                $html_tag = 'span';
                
                $body_cell_text = $this->get_repeater_setting_key('premium_table_text','premium_table_body_repeater', $index);
                
                if( 'yes' == $elem['premium_table_link_switcher']) {
                    $html_tag = 'a';
                    if($elem['premium_table_link_selection'] == 'url'){
                        $this->add_render_attribute('body-cell-text-' . $counter, 'href', $elem['premium_table_link']['url']);
                    } else {
                        $this->add_render_attribute('body-cell-text-' . $counter, 'href', get_permalink($elem['premium_table_existing_link']));
                    }
                    if($elem['premium_table_link']['is_external']){
                        $this->add_render_attribute('body-cell-text-' . $counter, 'target', '_blank');
                    }
                    if($elem['premium_table_link']['nofollow']){
                        $this->add_render_attribute('body-cell-text-' . $counter, 'rel', 'nofollow');
                    }
                }
                
                if($elem['premium_table_elem_type'] == 'cell'){
                    $this->add_render_attribute('body-cell-' . $counter , 'class', 'premium-table-cell');
                    $this->add_render_attribute('body-cell-' . $counter , 'class', 'elementor-repeater-item-' . $elem['_id']);
                    
                    $this->add_render_attribute('body-cell-text-' . $counter, 'class', 'premium-table-text');
                    
                    if( 'top' == $elem['premium_table_cell_icon_align'] && ('' != $elem['premium_table_cell_icon'] || '' != $elem['premium_table_cell_icon_img']['url'] ) ){
                        $this->add_render_attribute('body-cell-text-' . $counter, 'class', 'premium-table-cell-top');
                    }
                    
                    $this->add_render_attribute($body_cell_text, 'class', 'premium-table-inner');
                    
                    $this->add_inline_editing_attributes($body_cell_text, 'basic');
                    if( $elem['_id'] ){
                        $this->add_render_attribute('body-cell-'.$counter,'id', $elem['_id']);
                    }
                    if( $elem['premium_table_cell_span'] > 1 ){
                        $this->add_render_attribute('body-cell-'. $counter,'colspan', $elem['premium_table_cell_span']);
                    }
                    if( $elem['premium_table_cell_row_span'] > 1 ){
                        $this->add_render_attribute('body-cell-'. $counter,'rowspan', $elem['premium_table_cell_row_span']);
                    }
                    
                    $body .= '<' . $elem['premium_table_cell_type'] . ' ' . $this->get_render_attribute_string('body-cell-' .$counter) . '>';
                    $body .= '<' . $html_tag . ' ' . $this->get_render_attribute_string('body-cell-text-'.$counter ) . '>';
                    if( '' != $elem['premium_table_cell_icon'] || '' != $elem['premium_table_cell_icon_img']['url']){
                        $this->add_render_attribute('cell-icon-' . $counter , 'class', 'premium-table-cell-icon-' . $elem['premium_table_cell_icon_align']);
                        $body .= '<span ' . $this->get_render_attribute_string( 'cell-icon-' . $counter ) . '>';
							if($elem['premium_table_icon_selector'] == 'font-awesome-icon'){
                                $body .= '<i class="' . esc_attr( $elem['premium_table_cell_icon'] ) . '"></i>';
                            } else {
                                $body .= '<img src="' . esc_attr( $elem['premium_table_cell_icon_img']['url'] ) . '">';
                            }
						$body .= '</span>';
                    }
                    $body .= '<span ' . $this->get_render_attribute_string($body_cell_text) . '>' . $elem['premium_table_text'] . '</span>';
                    $body .= '</span>';
                    $body .= '</' . $html_tag .'>';
                    $body .= '</' . $elem['premium_table_cell_type'] .'>';
                } else {
                    
                    $this->add_render_attribute( 'body-row-' . $counter, 'class', 'premium-table-row' );
                    $this->add_render_attribute( 'body-row-' . $counter, 'class', 'elementor-repeater-item-' . $elem['_id'] );

                    if ( $counter > 1 && $counter < $row_count ) {
                    $body .= '</tr><tr ' . $this->get_render_attribute_string( 'body-row-' . $counter ) . '>';

                    } else if ( $counter === 1 && false === $this->is_first_elem_row() ) {
                        $body .= '<tr ' . $this->get_render_attribute_string( 'body-row-' . $counter ) . '>';
                    }

                    $cell_counter = 0;
                    }

                    $counter++;
                }
                
                echo $body; ?>
            </tr>
        </tbody>
     
 <?php }


 protected function render(){
        $settings = $this->get_settings_for_display();
        
        $this->add_render_attribute('table_wrap', 'class', 'premium-table-wrap');
        if($settings['premium_table_responsive'] == 'yes'){
            $this->add_render_attribute('table_wrap', 'class', 'premium-table-responsive');
        }
        
        if( $settings['premium_table_records'] == 'yes' && $settings['premium_table_search'] == 'yes' ){
            $this->add_render_attribute('table_wrap', 'class', 'premium-table-filter-records');
        }
        
        $this->add_render_attribute('table', 'class', 'premium-table');
        
        if($settings['premium_table_search'] == 'yes'){
            $this->add_render_attribute('table', 'class', 'premium-table-search');
        }
        
        if($settings['premium_table_blur'] == 'yes'){
            $this->add_render_attribute('table', 'class', 'premium-table-blur');
        }
        
        
        if($settings['premium_table_sort'] == 'yes'){
            $this->add_render_attribute('table', 'class', 'premium-table-sort');
        }
        
        $table_settings = [
            'sort'      => ($settings['premium_table_sort'] === 'yes') ? true : false,
            'sortMob'   => ($settings['premium_table_sort_mob'] === 'yes') ? true : false,
            'search'    => ($settings['premium_table_search'] === 'yes') ? true : false,
            'records'   => ($settings['premium_table_records'] === 'yes') ? true : false,
            'dataType'  =>  $settings['premium_table_data_type'],
            'csvFile'   => ($settings['premium_table_csv_type'] === 'file') ? $settings['premium_table_csv']['url'] : $settings['premium_table_csv_url'],
            'separator' => $settings['premium_table_separator']
        ];
            
        $this->add_render_attribute('table', 'data-settings', wp_json_encode( $table_settings ) );
        
        if( $settings['premium_table_search'] === 'yes' ) {
            $this->add_render_attribute('search', 'id', 'premium-table-search-field' );
            $this->add_render_attribute('search', 'class', 'premium-table-search-field' );
            $this->add_render_attribute('search', 'type', 'text' );
            $this->add_render_attribute('search', 'placeholder', $settings['premium_table_search_placeholder'] );
        }
        
        ?>
        
        <div <?php echo $this->get_render_attribute_string('table_wrap'); ?>>
            <div class="premium-table-filter">
            <?php if( $settings['premium_table_search'] === 'yes' ) : ?>
                <div class="premium-table-search-wrap">
                    <input <?php echo $this->get_render_attribute_string('search'); ?>>
                </div>
            <?php endif; ?>
            <?php if( 'yes' === $settings['premium_table_records'] && 'custom' === $settings['premium_table_data_type'] ) : ?>
                <div class="premium-table-records-wrap">
                    <label class="premium-table-label-records"><?php echo $settings['premium_table_records_label']; ?></label>
                    <select class="premium-table-records-box">
                        <?php
                            $rows = 0;
                            foreach( $settings['premium_table_body_repeater'] as $element ) {
                                if ( 'row' === $element[ 'premium_table_elem_type' ] ) {
                                    $rows++;
                                    if( 1 === $rows ) {
                                ?>
                                    <option value="1" selected="selected"><?php echo __( 'All', 'premium-addons-pro' ); ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $rows; ?>"><?php echo $rows - 1; ?></option>
                                <?php }
                                }
                            }
                        ?>
                    </select>
                </div>
            <?php endif; ?>
            </div>
            <table <?php echo $this->get_render_attribute_string('table'); ?> >
        
            <?php $this->get_table_head(); ?>
            <?php if(!empty($settings['premium_table_body_repeater'])) : $this->get_table_body(); endif; ?>
        
            </table>
        </div>
        
    <?php 
    
    }
    
    protected function _content_template() {
        ?>
        <#
        
            view.addRenderAttribute('table_wrap', 'class', 'premium-table-wrap');
            
            if( 'yes' == settings.premium_table_responsive ){
                view.addRenderAttribute('table_wrap', 'class', 'premium-table-responsive');
            }
            
            if( 'yes' === settings.premium_table_records && 'yes' === settings.premium_table_search ) {
                view.addRenderAttribute('table_wrap', 'class', 'premium-table-filter-records');
            }
        
            view.addRenderAttribute('table', 'class', 'premium-table');
        
            if(  'yes' == settings.premium_table_search ){
                view.addRenderAttribute('table', 'class', 'premium-table-search');
            }
            
            if(  'yes' == settings.premium_table_blur){
                view.addRenderAttribute('table', 'class', 'premium-table-blur');
            }
        
            if( 'yes' == settings.premium_table_sort ){
                view.addRenderAttribute('table', 'class', 'premium-table-sort');
            }
            
            var tableSettings = {};
            
            tableSettings.sort = 'yes' === settings.premium_table_sort ? true : false;
            tableSettings.sortMob = 'yes' === settings.premium_table_sort_mob ? true : false;
            tableSettings.search  = 'yes' === settings.premium_table_search ? true : false;
            tableSettings.records = 'yes' === settings.premium_table_records ? true : false;
            tableSettings.dataType  = settings.premium_table_data_type;
            tableSettings.csvFile   = 'file' === settings.premium_table_csv_type ? settings.premium_table_csv.url : settings.premium_table_csv_url;
            tableSettings.separator = settings.premium_table_separator
            
            view.addRenderAttribute('table', 'data-settings', JSON.stringify(tableSettings));
            
            if( 'yes' === settings.premium_table_search ) {
                view.addRenderAttribute('search', 'id', 'premium-table-search-field' );
                view.addRenderAttribute('search', 'class', 'premium-table-search-field' );
                view.addRenderAttribute('search', 'type', 'text' );
                view.addRenderAttribute('search', 'placeholder', settings.premium_table_search_placeholder );
            }
            
            function getTableHead() {
                
                var head = '';
        
                view.addRenderAttribute('table_head', 'class', 'premium-table-head');
        
                view.addRenderAttribute('table_row', 'class', 'premium-table-row');
        
            #>

            <thead {{{ view.getRenderAttributeString('table_head') }}}>
            
                <tr {{{ view.getRenderAttributeString('table_row') }}}>
                
                <# 
                
                if( 'custom' == settings.premium_table_data_type ) {
                    
                    _.each( settings.premium_table_head_repeater, function( headCell, index ) {
                        
                        var headCellText = view.getRepeaterSettingKey('premium_table_text', 'premium_table_head_repeater', index);
                        view.addRenderAttribute('head-cell-' + index , 'class', 'premium-table-cell');
                        view.addRenderAttribute('head-cell-' + index , 'class', 'elementor-repeater-item-' + headCell._id );

                        view.addRenderAttribute('head-text-' + index, 'class', 'premium-table-text');

                        if( 'top' == headCell.premium_table_cell_icon_align && ('' != headCell.premium_table_cell_icon || '' != headCell.premium_table_cell_icon_img.url ) ) {
                            view.addRenderAttribute('head-text-' + index, 'class', 'premium-table-cell-top');
                        }

                        view.addRenderAttribute(headCellText, 'class', 'premium-table-inner');

                        view.addInlineEditingAttributes(headCellText, 'basic');

                        if( headCell.premium_table_cell_span > 1 ){
                            view.addRenderAttribute('head-cell-' + index, 'colspan', headCell.premium_table_cell_span);
                        }
                        if( headCell.premium_table_cell_row_span > 1 ){
                            view.addRenderAttribute('head-cell-' + index, 'rowspan', headCell.premium_table_cell_row_span);
                        }
                        #>
                        <th {{{ view.getRenderAttributeString('head-cell-' + index) }}}>
                        <span {{{ view.getRenderAttributeString('head-text-' + index) }}}>
                        <# if( '' != headCell.premium_table_cell_icon || '' != headCell.premium_table_cell_icon_img.url ){
                            
                            view.addRenderAttribute('cell-icon-' + index , 'class', 'premium-table-cell-icon-' + headCell.premium_table_cell_icon_align);
                            view.addRenderAttribute('head-text-' + index, 'class', 'premium-table-text');
                            
                        #>
                            <span {{{ view.getRenderAttributeString( 'cell-icon-' + index ) }}}>
                                <# if( headCell.premium_table_icon_selector == 'font-awesome-icon' ){ #>
                                    <i class="{{ headCell.premium_table_cell_icon }}"></i>
                                <# } else { #>
                                    <img src="{{ headCell.premium_table_cell_icon_img.url }}">
                                <# } #>
                            </span>
                        <# } #>

                        <span {{{ view.getRenderAttributeString( headCellText ) }}}>{{{ headCell.premium_table_text }}}</span>
                        <# if ( 'yes' === settings.premium_table_sort ) { #>
                            <span class="premium-table-sort-icon premium-icon-sort fa fa-sort"></span>
                            <span class="premium-table-sort-icon premium-icon-sort-up fa fa-sort-up"></span>
                            <span class="premium-table-sort-icon premium-icon-sort-down fa fa-sort-down"></span>
                        <# } #>
                        </span>
                        </th>

                    <#
                    } )
                }
                
                #>
                
                </tr>
            
            </thead>
            
            <# }
            
            function isFirstElemRow() {
                
                if ( 'row' === settings.premium_table_body_repeater[0].premium_table_elem_type )
                    return false;

                return true;
            
            }
            
            function getTableBody(){
                
                var counter 		= 1,
                cellCounter         = 0;
                rowCount            = settings.premium_table_body_repeater.length;
                
                view.addRenderAttribute('table_body', 'class', 'premium-table-body');
        
                view.addRenderAttribute('table_row', 'class', 'premium-table-row');
                
                #>
                
                <tbody {{{ view.getRenderAttributeString('table_body') }}}>
                <# if( isFirstElemRow() ) { #>
                    <tr {{{ view.getRenderAttributeString('table_row') }}}>
                <# } #>
                <#
                
                    _.each( settings.premium_table_body_repeater, function( bodyCell, index ) {
                    
                        var htmlTag = 'span',
                            bodyCellText = view.getRepeaterSettingKey('premium_table_text', 'premium_table_body_repeater', index);
                            
                            
                        if( 'yes' == bodyCell.premium_table_link_switcher ) {
                            htmlTag = 'a';
                            if( 'url' == bodyCell.premium_table_link_selection ) {
                                view.addRenderAttribute('body-cell-text-' + counter, 'href', bodyCell.premium_table_link.url);
                            } else {
                                view.addRenderAttribute('body-cell-text-' + counter, 'href', bodyCell.premium_table_existing_link);
                            }
                        }
                    
                        if( 'cell' == bodyCell.premium_table_elem_type ) {
                        
                            view.addRenderAttribute('body-cell-' + counter , 'class', 'premium-table-cell');
                            view.addRenderAttribute('body-cell-' + counter , 'class', 'elementor-repeater-item-' + bodyCell._id);
                    
                            view.addRenderAttribute('body-cell-text-' + counter, 'class', 'premium-table-text');
                    
                            if( 'top' == bodyCell.premium_table_cell_icon_align && ( '' != bodyCell.premium_table_cell_icon || '' != bodyCell.premium_table_cell_icon_img.url ) ){
                                view.addRenderAttribute('body-cell-text-' + counter, 'class', 'premium-table-cell-top');
                            }
                            
                            view.addRenderAttribute(bodyCellText, 'class', 'premium-table-inner');
                    
                            view.addInlineEditingAttributes(bodyCellText, 'basic');
                            if( bodyCell._id ){
                                view.addRenderAttribute('body-cell-' + counter, 'id', bodyCell._id);
                            }
                            if( bodyCell.premium_table_cell_span > 1 ){
                                view.addRenderAttribute('body-cell-' + counter, 'colspan', bodyCell.premium_table_cell_span);
                            }
                            if( bodyCell.premium_table_cell_row_span > 1 ){
                                view.addRenderAttribute('body-cell-' + counter, 'rowspan', bodyCell.premium_table_cell_row_span);
                            }
                            #>
                            <{{{bodyCell.premium_table_cell_type}}} {{{ view.getRenderAttributeString('body-cell-' + counter) }}}>
                                <{{{htmlTag}}} {{{ view.getRenderAttributeString('body-cell-text-' + counter) }}} >
                                    <# if( '' != bodyCell.premium_table_cell_icon || '' != bodyCell.premium_table_cell_icon_img.url){
                                        view.addRenderAttribute('cell-icon-' + counter , 'class', 'premium-table-cell-icon-' + bodyCell.premium_table_cell_icon_align);
                                        #>
                                        <span {{{ view.getRenderAttributeString('cell-icon-' + counter) }}}>
                                            <# if('font-awesome-icon' == bodyCell.premium_table_icon_selector){ #>
                                                <i class="{{ bodyCell.premium_table_cell_icon }}"></i>
                                            <# } else { #>
                                                <img src="{{ bodyCell.premium_table_cell_icon_img.url }}">
                                            <# } #>
                                        </span>
                                    <# } #>
                                    
                                        <span {{{ view.getRenderAttributeString(bodyCellText) }}}> {{{bodyCell.premium_table_text}}}</span>
                                    </span>
                                </{{{htmlTag}}}>
                            </{{{bodyCell.premium_table_cell_type}}}>
                        
                        <# } else {
                        
                            view.addRenderAttribute( 'body-row-' + counter, 'class', 'premium-table-row' );
                            view.addRenderAttribute( 'body-row-' + counter, 'class', 'elementor-repeater-item-' + bodyCell._id );
                            
                            if ( counter > 1 && counter < rowCount ) { #>
                                </tr><tr {{{ view.getRenderAttributeString( 'body-row-' + counter ) }}}>
                            <# } else if ( counter === 1 && false === isFirstElemRow() ) { #>
                                <tr {{{ view.getRenderAttributeString( 'body-row-' + counter ) }}}>
                            <# }

                            cellCounter = 0;
                            
                            }

                            counter++;
                        
                    })
                
                #>
            
            <# }
        
        #>
        
        <div {{{ view.getRenderAttributeString('table_wrap') }}}>
            <div class="premium-table-filter">
            <# if( 'yes' == settings.premium_table_search ) { #>
                <div class="premium-table-search-wrap">
                    <input {{{ view.getRenderAttributeString('search') }}}>
                </div>
            <# } #>
            <# if( 'yes' == settings.premium_table_records && 'custom' === settings.premium_table_data_type ) { #>
                <div class="premium-table-records-wrap">
                    <label class="premium-table-label-records">{{{ settings.premium_table_records_label }}}</label>
                    <select class="premium-table-records-box">
                        <#
                            var rows = 0;
                            _.each( settings.premium_table_body_repeater, function( element, index ) {
                                if( 'row' === element.premium_table_elem_type ) {
                                rows++;
                                if( 1 === rows ) { #>
                                    <option value="1" selected="selected"><?php echo __( 'All', 'premium-addons-pro' ); ?></option>
                                <# } else { #>
                                    <option value="{{rows}}">{{{ rows - 1 }}}</option>
                                <# }
                                }
                            } )
                        #>
                        
                    </select>
                </div>
            <# } #>
            </div>
            <table {{{ view.getRenderAttributeString('table') }}}>
        
            <# getTableHead(); #>
            <# if( '' != settings.premium_table_body_repeater ) getTableBody(); #>
        
            </table>
        </div>
        
        <?php
    }

}