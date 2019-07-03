<?php

namespace PremiumAddonsPro\Widgets;

use PremiumAddons\Helper_Functions;
use PremiumAddons\Includes;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Frontend;
use Elementor\Repeater;
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

class Premium_Image_Hotspots extends Widget_Base {
    
	protected $templateInstance;

    public function getTemplateInstance() {
        return $this->templateInstance = Includes\premium_Template_Tags::getInstance();
    }

    public function get_name() {
        return 'premium-addon-image-hotspots';
    }

    public function is_reload_preview_required() {
        return true;
    }
    
    public function get_title() {
		return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Image Hotspots', 'premium-addons-pro') );
	}

    public function get_style_depends() {
        return [
            'tooltipster'
        ];
    }

    public function get_icon() {
        return 'pa-pro-hot-spot';
    }

    public function get_script_depends() {
        return [
            'tooltipster-bundle-js',
            'premium-pro-js'
        ];
    }

    public function get_categories() {
        return [ 'premium-elements' ];
    }

    // Adding the controls fields for the premium image hotspots
    // This will controls the animation, colors and background, dimensions etc
    protected function _register_controls() {

    	/**START Background Image Section  **/
    	$this->start_controls_section('premium_image_hotspots_image_section',
			[
				'label' => __( 'Image', 'premium-addons-pro' ),
			]
		);

		$this->add_control('premium_image_hotspots_image',
			[
				'label' => __( 'Choose Image', 'premium-addons-pro' ),
				'type' => Controls_Manager::MEDIA,
                'dynamic'       => [ 'active' => true ],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
                'label_block'   => true
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'background_image', // Actually its `image_size`.
				'default' => 'full'
			]
		);
        
        $this->add_control('premium_image_hotspots_stretch',
            [
                'label'         => __('Stretch Image', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Stretch image to full container width','premium-addons-pro'),
                'default'       => 'yes'
            ]);
        
        $this->add_responsive_control('premium_image_hotspots_align',
            [
                'label'             => __( 'Alignment', 'premium-addons-pro' ),
                'type'              => Controls_Manager::CHOOSE,
                'options'           => [
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
                'selectors'         => [
                    '{{WRAPPER}} .premium-image-hotspots-container' => 'text-align: {{VALUE}}',
                ],
                'default' => 'center',
                'condition'     => [
                    'premium_image_hotspots_stretch!'    => 'yes'
                ]
            ]
        );

		$this->end_controls_section();
        
		$this->start_controls_section('premium_image_hotspots_icons_settings',
            [
                'label'         => __('Hotspots', 'premium-addons-pro'),
            ]
        );
        
        $this->add_control('premium_image_hotspots_notice', 
            [
                'raw'               => __('NEW: Now you can position hotspots from the preview area', 'premium-addons-for-elemeentor'),
                'type'              => Controls_Manager::RAW_HTML,
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ] 
        );

        $repeater = new Repeater();
        
        $repeater->add_control('premium_image_hotspots_icon_type_switch',
            [
                'label'         => __('Display On', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'font_awesome_icon'     => __('Font Awesome Icon', 'premium-addons-pro'),
                    'custom_image'          => __('Custom Image', 'premium-addons-pro'),
                    'text'                  => __('Text', 'premium-addons-pro'),
                    ],
                'default'       => 'font_awesome_icon',
                'label_block'   => true,
            ]);
        
        $repeater->add_control('premium_image_hotspots_font_awesome_icon',
            [
                'label'         => __('Select Icon', 'premium-addons-pro'),
                'type'          => Controls_Manager::ICON,
                'default'       => 'fa fa-map-marker',
                'condition'     => [
                    'premium_image_hotspots_icon_type_switch'     => 'font_awesome_icon',
                    ]
                ]
            );
        
        $repeater->add_control('premium_image_hotspots_custom_image',
            [
                'label'         => __('Custom Image', 'premium-addons-pro'),
                'type'          => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition'     => [
                        'premium_image_hotspots_icon_type_switch'     => 'custom_image',
                    ]
                ]
            );
        
        $repeater->add_control('premium_image_hotspots_text',
            [
                'label'         => __('Text', 'premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'condition'     => [
                    'premium_image_hotspots_icon_type_switch'     => 'text',
	                    ]
            ]);
        
        $repeater->add_responsive_control('preimum_image_hotspots_main_icons_horizontal_position',
            [
                'label'     => __('Horizontal Position', 'premium-addons-pro'),
                'type'      => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%'],
                'range'     => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 200,
                    ],
                ],
                'default'   => [
                    'size'  => 50,
                    'unit'  => '%'
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.premium-image-hotspots-main-icons'    => 'left: {{SIZE}}{{UNIT}}'
                ]
            ]
            );
        
        $repeater->add_responsive_control('preimum_image_hotspots_main_icons_vertical_position',
            [
                'label'     => __('Vertical Position', 'premium-addons-pro'),
                'type'      => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%'],
                'range'     => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 200,
                    ],
                ],
                'default'   => [
                    'size'  => 50,
                    'unit'  => '%'
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.premium-image-hotspots-main-icons'    => 'top: {{SIZE}}{{UNIT}}'
                ]
            ]
            );
        
        $repeater->add_control('premium_image_hotspots_content', 
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
        
        $repeater->add_control('premium_image_hotspots_tooltips_texts',
            [
                'type'          => Controls_Manager::WYSIWYG,
                'default'       => 'Lorem ipsum',
                'dynamic'       => [ 'active' => true ],
                'label_block'   => true,
                'condition'     => [
                    'premium_image_hotspots_content'    => 'text_editor'
                ]
            ]);
        
        $repeater->add_control('premium_image_hotspots_tooltips_temp',
            [
                'label'         => __( 'Elementor Template', 'premium-addons-pro' ),
                'description'   => __( 'Elementor Template is a template which you can choose from Elementor library. Each template will be shown in content', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SELECT2,
                'options'       => $this->getTemplateInstance()->get_elementor_page_list(),
                'label_block'   => true,
                'condition'     => [
                   'premium_image_hotspots_content'  => 'elementor_templates',
                ],
            ]
        );
        
        $repeater->add_control('premium_image_hotspots_link_switcher',
            [
                'label'         => __('Link', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Add a custom link or select an existing page link','premium-addons-pro'),
            ]);
        
        $repeater->add_control('premium_image_hotspots_link_type',
            [
                'label'         => __('Link/URL', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'url'   => __('URL', 'premium-addons-pro'),
                    'link'  => __('Existing Page', 'premium-addons-pro'),
                ],
                'default'       => 'url',
                'condition'     => [
                    'premium_image_hotspots_link_switcher'  => 'yes',
                ],
                'label_block'   => true,
            ]);
        
        $repeater->add_control('premium_image_hotspots_existing_page',
            [
                'label'         => __('Existing Page', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT2,
                'description'   => __('Active only when tooltips trigger is set to hover','premium-addons-pro'),
                'options'       => $this->getTemplateInstance()->get_all_post(),
                'multiple'      => false,
                'condition'     => [
                    'premium_image_hotspots_link_switcher'  => 'yes',
                    'premium_image_hotspots_link_type'     => 'link',
                ],
                'label_block'   => true,
            ]);
        
        $repeater->add_control('premium_image_hotspots_url',
            [
                'label'         => __('URL', 'premium-addons-pro'),
                'type'          => Controls_Manager::URL,
                'dynamic'       => [ 'active' => true ],
                'condition'     => [
                    'premium_image_hotspots_link_switcher'  => 'yes',
                    'premium_image_hotspots_link_type'     => 'url',
                ],
                'placeholder'   => 'https://premiumaddons.com/',
                'label_block'   => true
            ]);
        
        $repeater->add_control('premium_image_hotspots_link_text',
            [
                'label'         => __('Link Title', 'premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'condition'     => [
                    'premium_image_hotspots_link_switcher' => 'yes',
                ],
                'label_block'   => true
            ]);
        
        $this->add_control('premium_image_hotspots_icons',
            [
                'label'         => __('Hotspots', 'premium-addons-pro'),
                'type'          => Controls_Manager::REPEATER,
                'fields'        => array_values( $repeater->get_controls() ),
            ]
        );
        
        $this->add_control('premium_image_hotspots_icons_animation',
                [
                    'label'         => __('Radar Animation', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SWITCHER,
                ]
                );

        $this->end_controls_section();
        
        $this->start_controls_section('premium_image_hotspots_tooltips_section',
            [
                'label'         => __('Tooltips', 'premium-addons-pro'),
            ]
        );

        $this->add_control(
			'premium_image_hotspots_trigger_type', 
		    [
		        'label'         => __('Trigger', 'premium-addons-pro'),
		        'type'          => Controls_Manager::SELECT,
		        'options'       => [
		            'click'   => __('Click', 'premium-addons-pro'),
		            'hover'  => __('Hover', 'premium-addons-pro'),
		        ],
		        'default'       => 'hover'
		    ]
        );

        $this->add_control(
			'premium_image_hotspots_arrow', 
		    [
		        'label'         => __('Show Arrow', 'premium-addons-pro'),
		        'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __('Show', 'premium-addons-pro'),
                'label_off'     => __('Hide', 'premium-addons-pro'),
		    ]
        );

        $this->add_control(
        	'premium_image_hotspots_tooltips_position',
	        [
	            'label'         => __('Positon', 'premium-addons-pro'),
	            'type'          => Controls_Manager::SELECT2,
	            'options'       => [
	                'top'   => __('Top', 'premium-addons-pro'),
	                'bottom'=> __('Bottom', 'premium-addons-pro'),
	                'left'  => __('Left', 'premium-addons-pro'),
	                'right' => __('Right', 'premium-addons-pro'),
	            ],
                'description'       => __('Sets the side of the tooltip. The value may one of the following: \'top\', \'bottom\', \'left\', \'right\'. It may also be an array containing one or more of these values. When using an array, the order of values is taken into account as order of fallbacks and the absence of a side disables it','premium-addons-pro'),
                'default'           => ['top','bottom'],
	            'label_block'   => true,
                'multiple'      => true
	        ]
        );
        
        $this->add_control('premium_image_hotspots_tooltips_distance_position',
            [
                'label'             => __('Spacing', 'premium-addons-pro'),
                'type'              => Controls_Manager::NUMBER,
                'title'       => __('The distance between the origin and the tooltip in pixels, default is 6','premium-addons-pro'),
                'default'           => 6,
            ]
            );
        
        $this->add_control('premium_image_hotspots_min_width',
            [
                'label'             => __('Min Width', 'premium-addons-pro'),
                'type'              => Controls_Manager::SLIDER,
                'range'         => [
                    'px'    => [
                        'min'       => 0,
                        'max'       => 800,
                    ],
                ],
                'description'       => __('Set a minimum width for the tooltip in pixels, default: 0 (auto width)','premium-addons-pro'),
            ]
            );
        
        $this->add_control('premium_image_hotspots_max_width',
            [
                'label'             => __('Max Width', 'premium-addons-pro'),
                'type'              => Controls_Manager::SLIDER,
                'range'         => [
                    'px'    => [
                        'min'       => 0,
                        'max'       => 800,
                    ],
                ],
                'description'       => __('Set a maximum width for the tooltip in pixels, default: null (no max width)','premium-addons-pro'),
            ]
            );
        
        $this->add_responsive_control('premium_image_hotspots_tooltips_wrapper_height',
            [
                'label'         => __('Height', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em' , '%'],
                'range'         => [
                    'px'    => [
                        'min'       => 0,
                        'max'       => 500,
                    ],
                    'em'    => [
                        'min'       => 0,
                        'max'       => 20,
                    ]
                ],
                'label_block'   => true,
                'selectors'     => [
                    '.tooltipster-box.tooltipster-box-{{ID}}' => 'height: {{SIZE}}{{UNIT}} !important;'
                ]
        	]
        );

        $this->add_control('premium_image_hotspots_anim', 
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
                'default'       => 'fade',
                'label_block'   => true,
            ]
        );
        
        $this->add_control('premium_image_hotspots_anim_dur',
                [
                    'label'             => __('Animation Duration', 'premium-addons-pro'),
                    'type'              => Controls_Manager::NUMBER,
                    'title'             => __('Set the animation duration in milliseconds, default is 350', 'premium-addons-pro'),
                    'default'           => 350,
                ]
                );
        
        $this->add_control('premium_image_hotspots_delay',
                [
                    'label'             => __('Delay', 'premium-addons-pro'),
                    'type'              => Controls_Manager::NUMBER,
                    'title'              => __('Set the animation delay in milliseconds, default is 10'),
                    'default'           => 10,
                ]
                );
        
        $this->add_control('premium_image_hotspots_hide',
                [
                    'label'         => __('Hide on Mobiles', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SWITCHER,
                    'label_on'      => 'Show',
                    'label_off'     => 'Hide',
                    'description'   => __('Hide tooltips on mobile phones', 'premium-addons-pro'),
                    'return_value'  => true,
                ]
                );

        $this->end_controls_section();

        $this->start_controls_section('premium_image_hotspots_image_style_settings',
            [
                'label'         => __('Image', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'premium_image_hotspots_image_border',
                'selector'      => '{{WRAPPER}} .premium-image-hotspots-container .premium-addons-image-hotspots-ib-img',
            ]
        );

        $this->add_control('premium_image_hotspots_image_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em' , '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-image-hotspots-container .premium-addons-image-hotspots-ib-img' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_responsive_control('premium_image_hotspots_image_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em' ,'%'],
				'selectors'     => [
                  '{{WRAPPER}} .premium-image-hotspots-container .premium-addons-image-hotspots-ib-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]     
        );

        $this->end_controls_section();

        $this->start_controls_section('premium_image_hotspots_Hotspots_style_settings',
            [
                'label'         => __('Hotspots', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('premium_image_hotspots_main_icons_active_borders_style_tabs');

        $this->start_controls_tab('premium_image_hotspots_main_icons_style_tab',
            [
                'label'         => __('Icon', 'premium-addons-pro'),
            ]
        );
        
        $this->add_control('premium_image_hotspots_main_icons_color',
			[
				'label' => __( 'Color', 'premium-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
				'selectors' => [
					'{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-icon' => 'color: {{VALUE}};',
				]
			]
		);

        $this->add_responsive_control('preimum_image_hotspots_main_icons_size',
	        [
	            'label'         => __('Size', 'premium-addons-pro'),
	            'type'          => Controls_Manager::SLIDER,
	            'size_units'    => ['px', 'em'],
	            'range'     => [
	                'px'    => [
	                    'min'   => 0,
	                    'max'   => 500,
	                ],
	                'em'	=> [
	                    'min'   => 0,
	                    'max'   => 20,
	                ]
	            ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-icon' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
	    	]
    	);

		$this->add_control('premium_image_hotspots_main_icons_background_color',
			[
				'label' => __( 'Background Color', 'premium-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-icon' => 'background-color: {{VALUE}};',
				]
			]
		);
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_image_hotspots_main_icons_border',
                    'selector'      => '{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-icon'
                ]
                );

        $this->add_control('premium_image_hotspots_main_icons_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,    
                'size_units'    => ['px', 'em' , '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-icon' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'label'         => __('Shadow', 'premium-addons-pro'),
                    'name'          => 'premium_image_hotspots_main_icons_shadow',
                    'selector'      => '{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-icon'
                ]
                );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'name'          => 'premium_image_hotspots_main_icons_shadow',
                    'selector'      => '{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-icon',
                    'condition'     => [
                        'premium_image_hotspots_icons_animation!' => 'yes'
                    ]
                ]
                );
        
        $this->add_responsive_control('premium_image_hotspots_main_icons_margin',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->add_responsive_control('premium_image_hotspots_main_icons_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);

        $this->end_controls_tab();
        
        $this->start_controls_tab('premium_image_hotspots_main_images_style_tab',
            [
                'label'         => __('Image', 'premium-addons-pro'),
            ]
        );

        $this->add_responsive_control('preimum_image_hotspots_main_images_size',
	        [
	            'label'         => __('Size', 'premium-addons-pro'),
	            'type'          => Controls_Manager::SLIDER,
	            'size_units'    => ['px', 'em'],
	            'range'     => [
	                'px'    => [
	                    'min'   => 0,
	                    'max'   => 500,
	                ],
	                'em'	=> [
	                    'min'   => 0,
	                    'max'   => 20,
	                ]
	            ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-image-icon' => 'width:{{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
	    	]
    	);

		$this->add_control('preimum_image_hotspots_main_images_background',
			[
				'label' => __( 'Background Color', 'premium-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
				'selectors' => [
					'{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-image-icon' => 'background-color: {{VALUE}};',
				]
			]
		);
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'preimum_image_hotspots_main_images_border',
                    'selector'      => '{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-image-icon'
                ]
                );

        $this->add_control('preimum_image_hotspots_main_images_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,    
                'size_units'    => ['px', 'em' , '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-image-icon' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'name'          => 'premium_image_hotspots_main_images_shadow',
                    'selector'      => '{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-image-icon',
                    'condition'     => [
                        'premium_image_hotspots_icons_animation!' => 'yes'
                    ]
                ]
                );
        
        $this->add_responsive_control('premium_image_hotspots_main_images_margin',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-image-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->add_responsive_control('premium_image_hotspots_main_images_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-image-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->end_controls_tab();
        
        $this->start_controls_tab('premium_image_hotspots_main_text_style_tab',
            [
                'label'         => __('Text', 'premium-addons-pro'),
            ]
        );

        $this->add_control(
			'premium_image_hotspots_main_text_color',
			[
				'label'         => __( 'Text Color', 'premium-addons-pro' ),
				'type'          => Controls_Manager::COLOR,
				'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
				'selectors'     => [
					'{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-text' => 'color: {{VALUE}};',
				]
			]
		);
        
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'          => 'premium_image_hotspots_main_text_typo',
                    'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'      => '{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-text'
                    ]
                ); 
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'name'          => 'premium_image_hotspots_main_text_shadow',
                    'selector'      => '{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-text'
                ]
                );

		$this->add_control(
			'premium_image_hotspots_main_text_background_color',
			[
				'label' => __( 'Background Color', 'premium-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
				'selectors' => [
					'{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-text' => 'background-color: {{VALUE}};',
				]
			]
		);
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_image_hotspots_main_text_border',
                    'selector'      => '{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-text'
                ]
                );

        $this->add_control('premium_image_hotspots_main_text_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,    
                'size_units'    => ['px', 'em' , '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-text' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'name'          => 'premium_image_hotspots_main_text_shadow',
                    'selector'      => '{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-text',
                    'condition'     => [
                        'premium_image_hotspots_icons_animation!' => 'yes'
                    ]
                ]
                );
        
        $this->add_responsive_control('premium_image_hotspots_main_text_margin',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->add_responsive_control('premium_image_hotspots_main_text_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-image-hotspots-main-icons .premium-image-hotspots-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);

        $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->add_control('premium_image_hotspots_radar_background',
			[
				'label' => __( 'Radar Background Color', 'premium-addons-pro' ),
				'type' => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition' => [
                    'premium_image_hotspots_icons_animation'  => 'yes'
                ],
				'selectors' => [
					'{{WRAPPER}} .premium-image-hotspots-main-icons.premium-image-hotspots-anim::before' => 'background-color: {{VALUE}};',
				],
                'separator' => 'before'
			]
		);
        
        $this->add_control('premium_image_hotspots_radar_border_radius',
            [
                'label'         => __('Radar Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,    
                'size_units'    => ['px', 'em' , '%'],
                'condition' => [
                    'premium_image_hotspots_icons_animation'  => 'yes'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-image-hotspots-main-icons.premium-image-hotspots-anim::before' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
			'premium_image_hotspots_main_icons_opacity',
			[
				'label'         => __( 'Hotspots Opacity', 'premium-addons-pro' ),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px'    => [
		                'min' => 0,
		                'max' => 1,
		                'step'=> .1,
		            ]
				],
				'selectors'     => [
		            '{{WRAPPER}} .premium-image-hotspots-main-icons' => 'opacity: {{SIZE}};',
		        ],
                'separator' => 'before'
			]
		);


         $this->add_control('preimum_image_hotspots_main_icons_hover_animation',
	        [
				'label' => __( 'Hover Animation', 'premium-addons-pro' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

        $this->end_controls_section();
        
        $this->start_controls_section('premium_image_hotspots_tooltips_style_settings',
            [
                'label'         => __('Tooltips', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control('premium_image_hotspots_tooltips_wrapper_color',
            [
                'label'         => __('Text Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '.tooltipster-box.tooltipster-box-{{ID}} .premium-image-hotspots-tooltips-text' => 'color: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'premium_image_hotspots_tooltips_wrapper_typo',
				'scheme'                => Scheme_Typography::TYPOGRAPHY_1,
                'selector'              => '.tooltipster-box.tooltipster-box-{{ID}} .premium-image-hotspots-tooltips-text'
			]
		);
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'          => 'premium_image_hotspots_tooltips_content_text_shadow',
                'selector'      => '.tooltipster-box.tooltipster-box-{{ID}} .premium-image-hotspots-tooltips-text'
            ]
        );
        
        $this->add_control('premium_image_hotspots_tooltips_wrapper_background_color',
            [
                'label'         => __('Background Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content' => 'background: {{VALUE}};',
                    '.premium-tooltipster-base.tooltipster-top .tooltipster-arrow-{{ID}} .tooltipster-arrow-background' => 'border-top-color: {{VALUE}};',
                    '.premium-tooltipster-base.tooltipster-bottom .tooltipster-arrow-{{ID}} .tooltipster-arrow-background' => 'border-bottom-color: {{VALUE}};',
                    '.premium-tooltipster-base.tooltipster-right .tooltipster-arrow-{{ID}} .tooltipster-arrow-background' => 'border-right-color: {{VALUE}};',
                    '.premium-tooltipster-base.tooltipster-left .tooltipster-arrow-{{ID}} .tooltipster-arrow-background' => 'border-left-color: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'              => 'premium_image_hotspots_tooltips_wrapper_border',
                    'selector'          => '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content'
                    ]
                );

        $this->add_control('premium_image_hotspots_tooltips_wrapper_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em' , '%'],
                'selectors'		=>[
                	'.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content'	=>	'border-radius: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'premium_image_hotspots_tooltips_wrapper_box_shadow',
                'selector'      => '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content'
            ]
        );
        
        $this->add_responsive_control('premium_image_hotspots_tooltips_wrapper_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
                  '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content, .tooltipster-arrow-{{ID}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
//        $this->add_responsive_control('premium_image_hotspots_tooltips_wrapper_padding',
//            [
//                'label'         => __('Padding', 'premium-addons-pro'),
//                'type'          => Controls_Manager::DIMENSIONS,
//                'size_units'    => [ 'px', 'em', '%' ],
//				'selectors'     => [
//                  '.tooltipster-box.tooltipster-box-{{ID}} div.premium-image-hotspots-tooltips-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
//                ]
//            ]
//        );

        $this->end_controls_section();
		
        $this->start_controls_section('premium_img_hotspots_container_style',
            [
                'label'         => __('Container', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control('premium_img_hotspots_container_background',
            [
                'label'         => __('Background Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .premium-image-hotspots-container' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'premium_img_hotspots_container_border',
                'selector'      => '{{WRAPPER}} .premium-image-hotspots-container',
            ]
        );

        $this->add_control('premium_img_hotspots_container_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-image-hotspots-container' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'premium_img_hotspots_container_box_shadow',
                'selector'      => '{{WRAPPER}} .premium-image-hotspots-container',
            ]
        );

        $this->add_responsive_control('premium_img_hotspots_container_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-image-hotspots-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );
        
        $this->add_responsive_control('premium_img_hotspots_container_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-image-hotspots-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );
        
        $this->end_controls_section();
	}

    private function get_hotspots() {
        ?>



        <?php
    }

	protected function render() {
    	
    	$settings = $this->get_settings_for_display();
        
        $id = $this->get_id();
        
        $animation_class = '';
        if( 'yes' === $settings['premium_image_hotspots_icons_animation'] ) {
            $animation_class = 'premium-image-hotspots-anim';
        }
        
		$image_src = $settings['premium_image_hotspots_image'];
		$image_src_size = Group_Control_Image_Size::get_attachment_image_src( $image_src['id'], 'background_image', $settings );
        if( empty( $image_src_size ) ) { 
            $image_src_size = $image_src['url'];
        } else { 
            $image_src_size = $image_src_size; 
        
        }
        
        $image_hotspots_settings = [
            'anim'      => $settings['premium_image_hotspots_anim'],
            'animDur'   => !empty($settings['premium_image_hotspots_anim_dur']) ? $settings['premium_image_hotspots_anim_dur'] : 350,
            'delay'     => !empty($settings['premium_image_hotspots_anim_delay']) ? $settings['premium_image_hotspots_anim_delay'] : 10,
            'arrow'     => ($settings['premium_image_hotspots_arrow'] == 'yes' ) ? true : false,
            'distance'  => !empty($settings['premium_image_hotspots_tooltips_distance_position']) ? $settings['premium_image_hotspots_tooltips_distance_position'] : 6,
            'minWidth'  =>  !empty($settings['premium_image_hotspots_min_width']['size']) ? $settings['premium_image_hotspots_min_width']['size'] : 0,
            'maxWidth'  => !empty($settings['premium_image_hotspots_max_width']['size']) ? $settings['premium_image_hotspots_max_width']['size'] : 'null',
            'side'      => !empty($settings['premium_image_hotspots_tooltips_position']) ? $settings['premium_image_hotspots_tooltips_position'] : array('right', 'left'),
            'hideMobiles'=> ($settings['premium_image_hotspots_hide'] == true) ? true : false,
            'trigger'   => $settings['premium_image_hotspots_trigger_type'],
            'id'        => $id
        ];
        
        $this->add_render_attribute( 'container', [
            'id'            => 'premium-image-hotspots-' . $id,
            'class'         => [
                'premium-image-hotspots-container'
            ],
            'data-settings' => wp_json_encode( $image_hotspots_settings )
        ] );
        
        $this->add_render_attribute( 'image', [
            'class' => 'premium-addons-image-hotspots-ib-img',
            'alt'   => 'Hotspots Background',
            'src'   => $image_src_size
        ] );
        
        if ( 'yes' === $settings['premium_image_hotspots_stretch'] ) {
            
            $this->add_render_attribute( 'image', 'class', 'premium-image-hotspots-stretch' );
            
        }
        
    ?>

	<div <?php echo $this->get_render_attribute_string('container'); ?>>
        <img <?php echo $this->get_render_attribute_string('image'); ?>>
    	<?php foreach ( $settings['premium_image_hotspots_icons'] as $index => $item ) {
            $list_item_key = 'premium_img_hotspot_' . $index;
            $this->add_render_attribute( $list_item_key, [
                'class' => [
                     $animation_class,
                    'premium-image-hotspots-main-icons',
                    'elementor-repeater-item-' . $item['_id'],
                    'tooltip-wrapper',
                    'premium-image-hotspots-main-icons-'. $item['_id']
                ],
                'data-tooltip-content'  => '#tooltip_content'
                ] );
		?>
	        <div <?php echo $this->get_render_attribute_string( $list_item_key ); ?>>
	        	<?php 
	    	    	$link_type = $item['premium_image_hotspots_link_type'];
				        if ($link_type == 'url') {
				            $link_url = $item['premium_image_hotspots_url']['url'];
				        } elseif ($link_type == 'link') {
				            $link_url = get_permalink( $item['premium_image_hotspots_existing_page' ]);
				        }
	            if ( $item['premium_image_hotspots_link_switcher'] == 'yes' && $settings['premium_image_hotspots_trigger_type'] == 'hover' ) :
	            ?>
	        	<a class="premium-image-hotspots-tooltips-link" href="<?php echo esc_url($link_url); ?>" title="<?php echo $item['premium_image_hotspots_link_text']; ?>" <?php if(!empty($item['premium_image_hotspots_url']['is_external'])) : ?>target="_blank"<?php endif; ?><?php if(!empty($item['premium_image_hotspots_url']['nofollow'])) : ?>rel="nofollow"<?php endif; ?>>
		    		<?php if ( $item['premium_image_hotspots_icon_type_switch'] == 'font_awesome_icon') : ?>
		        	<i class="premium-image-hotspots-icon <?php echo esc_attr( $item['premium_image_hotspots_font_awesome_icon']);?> elementor-animation-<?php echo $settings['preimum_image_hotspots_main_icons_hover_animation']; ?>"></i>
		    		<?php elseif ( $item['premium_image_hotspots_icon_type_switch'] == 'custom_image') : ?>
	    			<div class="pica">
						<img alt="Hotspot Image" class="premium-image-hotspots-image-icon elementor-animation-<?php echo $settings['preimum_image_hotspots_main_icons_hover_animation']; ?>" src="<?php echo $item['premium_image_hotspots_custom_image']['url']; ?>">
					</div>
					<?php elseif ( $item['premium_image_hotspots_icon_type_switch'] == 'text') : ?>
						<p class="premium-image-hotspots-text elementor-animation-<?php echo $settings['preimum_image_hotspots_main_icons_hover_animation']; ?>"><?php echo esc_attr( $item['premium_image_hotspots_text']);?></p>

		    		<?php endif;?>
	    		</a>
	    	<?php else : ?>
	    		<?php if ( $item['premium_image_hotspots_icon_type_switch'] == 'font_awesome_icon') : ?>
		        	<i class="premium-image-hotspots-icon <?php echo esc_attr( $item['premium_image_hotspots_font_awesome_icon']);?> elementor-animation-<?php echo $settings['preimum_image_hotspots_main_icons_hover_animation']; ?>"></i>
		    		<?php elseif ( $item['premium_image_hotspots_icon_type_switch'] == 'custom_image') : ?>
	    			<div class="pica elementor-animation-<?php echo $settings['preimum_image_hotspots_main_icons_hover_animation']; ?>">
						<img alt="Hotspot Image" class="premium-image-hotspots-image-icon" src="<?php echo $item['premium_image_hotspots_custom_image']['url']; ?>">
					</div>
					<?php elseif ( $item['premium_image_hotspots_icon_type_switch'] == 'text') : ?>
						<p class="premium-image-hotspots-text elementor-animation-<?php echo $settings['preimum_image_hotspots_main_icons_hover_animation']; ?>"><?php echo $item['premium_image_hotspots_text'];?></p>

	    		<?php endif;?>
    		<?php endif; ?>
		        <div class="premium-image-hotspots-tooltips-wrapper">
		            <div id="tooltip_content" class="premium-image-hotspots-tooltips-text">
                    <?php
                        if( $item['premium_image_hotspots_content'] == 'elementor_templates' ) {
                            $elementor_post_id = $item['premium_image_hotspots_tooltips_temp'];
                            $premium_elements_frontend = new Frontend;
                            echo $premium_elements_frontend->get_builder_content( $elementor_post_id, true );
                        } else {
                            echo $item['premium_image_hotspots_tooltips_texts']; 
                        } ?>
                    </div>
		        </div>
	        </div>
        <?php } ?>
    </div>
    
        <?php
	}
    
    protected function _content_template() {
        ?>
        <#
        
            var listItemKey,
                linkURL,
                animationClass = '',
                id  = view.getID(),
                image = {
                    id: settings.premium_image_hotspots_image.id,
                    url: settings.premium_image_hotspots_image.url,
                    size: settings.background_image_size,
                    dimension: settings.background_image_custom_dimension,
                    model: view.getEditModel()
                },
            hotSpotsSettings = {};
            
            image_url = elementor.imagesManager.getImageUrl( image );
            
            hotSpotsSettings.anim = settings.premium_image_hotspots_anim;
            hotSpotsSettings.animDur = '' !== settings.premium_image_hotspots_anim_dur ? settings.premium_image_hotspots_anim_dur : 350;
            hotSpotsSettings.delay  = '' !== settings.premium_image_hotspots_anim_delay ? settings.premium_image_hotspots_anim_delay : 10;
            hotSpotsSettings.arrow = 'yes' === settings.premium_image_hotspots_arrow ? true : false;
            hotSpotsSettings.distance = '' !== settings.premium_image_hotspots_tooltips_distance_position ? settings.premium_image_hotspots_tooltips_distance_position : 6;
            hotSpotsSettings.minWidth  = '' !== settings.premium_image_hotspots_min_width.size ? settings.premium_image_hotspots_min_width.size : 0;
            hotSpotsSettings.maxWidth  = '' !== settings.premium_image_hotspots_max_width.size ? settings.premium_image_hotspots_max_width.size : null;
            hotSpotsSettings.side = '' !== settings.premium_image_hotspots_tooltips_position ? settings.premium_image_hotspots_tooltips_position : ['right', 'left'];
            hotSpotsSettings.hideMobiles  = 'yes' === settings.premium_image_hotspots_hide ? true : false;
            hotSpotsSettings.trigger = settings.premium_image_hotspots_trigger_type;
            hotSpotsSettings.id = id;
            
            if( 'yes' === settings.premium_image_hotspots_icons_animation ) {
                animationClass = 'premium-image-hotspots-anim';
            }
        
            var hoverAnimation = 'elementor-animation-' + settings.preimum_image_hotspots_main_icons_hover_animation;
            
            view.addRenderAttribute('container', 'id', 'premium-image-hotspots-' + id );
            view.addRenderAttribute('container', 'class', 'premium-image-hotspots-container' );
            view.addRenderAttribute('container', 'data-settings', JSON.stringify( hotSpotsSettings ) );
            
            view.addRenderAttribute('tooltip_content', 'id', 'tooltip_content' );
            view.addRenderAttribute('tooltip_content', 'class', 'premium-image-hotspots-tooltips-text' );
            
            view.addRenderAttribute( 'image', 'class', 'premium-addons-image-hotspots-ib-img' );
            view.addRenderAttribute( 'image', 'alt', 'Hotspots Background' );
            view.addRenderAttribute( 'image', 'src', image_url );
            
            if ( 'yes' === settings.premium_image_hotspots_stretch ) {
            
                view.addRenderAttribute( 'image', 'class', 'premium-image-hotspots-stretch' );
            
            }

        #>
        
        <div {{{ view.getRenderAttributeString('container') }}}>
            <img {{{ view.getRenderAttributeString('image') }}}>
            <#
            _.each( settings.premium_image_hotspots_icons, function( hotspot, index ) {
                listItemKey = 'premium_img_hotspot_' + index;
                view.addRenderAttribute( listItemKey, 'class',
                 [
                     animationClass,
                    'premium-image-hotspots-main-icons',
                    'elementor-repeater-item-' + hotspot._id,
                    'tooltip-wrapper',
                    'premium-image-hotspots-main-icons-' + hotspot._id
                ]);
                
                if( 'elementor_templates' === hotspot.premium_image_hotspots_content && '' !== hotspot.premium_image_hotspots_tooltips_temp ) {
                    view.addRenderAttribute( listItemKey, 'data-template-id', hotspot.premium_image_hotspots_tooltips_temp );

                }
                
            #>
            <div {{{ view.getRenderAttributeString(listItemKey) }}} data-tooltip-content="#tooltip_content">
                
                <#
	    	    	var linkType = hotspot.premium_image_hotspots_link_type;
				        if ( 'url' === linkType ) {
				            linkURL = hotspot.premium_image_hotspots_url.url;
				        } else if ( 'link' === linkType ) {
				            linkURL = hotspot.premium_image_hotspots_existing_page;
				        }
	            if ( 'yes' === hotspot.premium_image_hotspots_link_switcher && 'hover' === settings.premium_image_hotspots_trigger_type  ) {
                
	            #>
                
                    <a class="premium-image-hotspots-tooltips-link" href="{{linkURL}}" title="{{hotspot.premium_image_hotspots_link_text}}" >
		    		<# if ( 'font_awesome_icon' === hotspot.premium_image_hotspots_icon_type_switch ) { #>
		        	<i class="premium-image-hotspots-icon {{hoverAnimation}} {{hotspot.premium_image_hotspots_font_awesome_icon}}"></i>
		    		<# } else if ( 'custom_image' === hotspot.premium_image_hotspots_icon_type_switch ) { #>
	    			<div class="pica">
						<img class="premium-image-hotspots-image-icon {{hoverAnimation}}" src="{{hotspot.premium_image_hotspots_custom_image.url}}" alt="Hotspot Image" >
					</div>
					<# } else if ( 'text' === hotspot.premium_image_hotspots_icon_type_switch ) { #>
						<p class="premium-image-hotspots-text {{hoverAnimation}}">{{{hotspot.premium_image_hotspots_text}}}</p>
		    		<# } #>
	    		</a>
                
                <#
                 } else {
                 
                    if ( 'font_awesome_icon' === hotspot.premium_image_hotspots_icon_type_switch ) { #>
		        	<i class="premium-image-hotspots-icon {{hoverAnimation}} {{hotspot.premium_image_hotspots_font_awesome_icon}}"></i>
		    		<# } else if ( 'custom_image' === hotspot.premium_image_hotspots_icon_type_switch ) { #>
	    			<div class="pica">
						<img class="premium-image-hotspots-image-icon {{hoverAnimation}}" src="{{hotspot.premium_image_hotspots_custom_image.url}}" alt="Hotspot Image" >
					</div>
					<# } else if ( 'text' === hotspot.premium_image_hotspots_icon_type_switch ) { #>
						<p class="premium-image-hotspots-text {{hoverAnimation}}">{{{hotspot.premium_image_hotspots_text}}}</p>
		    		<# }
                 }
                #>
                <div class="premium-image-hotspots-tooltips-wrapper">
		            <div {{{ view.getRenderAttributeString('tooltip_content') }}}>
                        <# if( 'text_editor' === hotspot.premium_image_hotspots_content ) { #>
                                {{{hotspot.premium_image_hotspots_tooltips_texts}}}
                        <# } #>
                    </div>
		        </div>
            </div>
            <# }); #>
        </div>
        
    <?php
    
    }
    
}