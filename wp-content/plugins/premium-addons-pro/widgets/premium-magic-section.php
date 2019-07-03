<?php

namespace PremiumAddonsPro\Widgets;

use PremiumAddons\Helper_Functions;
use PremiumAddons\Includes;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Frontend;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Core\Responsive\Responsive;

if( ! defined( 'ABSPATH' ) ) exit;

class Premium_Magic_Section extends Widget_Base {
    
    protected $templateInstace;
    
    public function getTemplateInstance() {
        return $this->templateInstance = Includes\premium_Template_Tags::getInstance();
    }
    
    public function check_rtl() {
        return is_rtl();
    }
    
    public function get_name() {
        return 'premium-addon-magic-section';
    }
    
    public function get_title() {
        return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Magic Section', 'premium-addons-pro') );
    }

    public function get_icon() {
        return 'pa-pro-magic-section';
    } 
    public function is_reload_preview_required() {
        return true;
    }
    
    public function get_script_depends() {
        return ['premium-pro-js', 'jquery-ui'];
    }
    
   public function get_categories() {
    return [ 'premium-elements' ];
    }

    // Adding the controls fields for the Magic Section
    // This will controls the animation, colors and background, dimensions etc
    protected function _register_controls() {
        
        /*Magic Section Content Section*/
        $this->start_controls_section('premium_magic_section',
            [
                'label'     => __('Content', 'premium-addons-pro'),
            ]);
        
        /*Magic Section Content Type*/
        $this->add_control('premium_magic_section_content_type',
            [
                'label'         => __('Content to Show', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'editor'        => __('Text Editor', 'premium-addons-pro'),
                    'template'      => __('Elementor Template', 'premium-addons-pro'),
                ],
                'default'       => 'editor',
                'label_block'   => true
                ]
                );
        
        /*Magic Section Elementor Template*/
        $this->add_control('premium_magic_section_content_temp',
                [
                    'label'         => __( 'Content', 'premium-addons-pro' ),
                    'description'   => __( 'Magic content is a template which you can choose from Elementor library', 'premium-addons-pro' ),
                    'type' => Controls_Manager::SELECT2,
                    'options' => $this->getTemplateInstance()->get_elementor_page_list(),
                    'condition'     => [
                        'premium_magic_section_content_type'    => 'template',
                    ],
                ]
            );
        
        /*Magic Section Content*/
        $this->add_control('premium_magic_section_content',
                [
                    'type'          => Controls_Manager::WYSIWYG,
                    'dynamic'       => [ 'active' => true ],
                    'default'       => 'Premium Magic Section Content',
                    'condition'     => [
                        'premium_magic_section_content_type'    => 'editor',
                    ],
                    'show_label'    => false,
                ]
                );
        
        $this->add_control('premium_magic_section_close',
                [
                    'label'         => __('Close Button', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SWITCHER,
                ]
                );

        $this->add_control('premium_magic_section_close_pos_hor',
            [
                'label'        => __('Position','premium-addons-pro'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'bottom',
                'options'      => [
                    'top'           => __('Top','premium-addons-pro'),
                    'bottom'        => __('Bottom','premium-addons-pro'),
                ],
                'condition'    => [
                        'premium_magic_section_close'   => 'yes',
                        'premium_magic_section_pos'     => ['left', 'right']
                    ]  
                ]
            );
        
        $this->add_control('premium_magic_section_close_pos',
            [
                'label'        => __('Position','premium-addons-pro'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'right',
                'options'      => [
                    'left'            => __('Left','premium-addons-pro'),
                    'right'           => __('Right','premium-addons-pro'),
                ],
                'condition'    => [
                        'premium_magic_section_close'   => 'yes',
                        'premium_magic_section_pos'     => ['top', 'bottom']
                    ]  
                ]
            );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_magic_trig_icon',
            [
                'label'     => __('Trigger', 'premium-addons-pro'),
            ]);
        
        $this->add_control('premium_magic_section_trig_selector',
            [
                'label'        => __('Trigger','premium-addons-pro'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'button',
                'options'      => [
                    'button'    => __('Button','premium-addons-pro'),
                    'icon'      => __('Icon','premium-addons-pro'),
                    ],
                ]
            );
        
        $this->add_control('premium_magic_section_trig_float',
            [
                'label'        => __('Float','premium-addons-pro'),
                'type'         => Controls_Manager::SWITCHER,
                ]
            );
        
        $this->add_control('premium_magic_section_icon_selector',
            [
                'label'        => __('Icon Type','premium-addons-pro'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'font-awesome-icon',
                'options'      => [
                    'font-awesome-icon' => __('Font Awesome Icon','premium-addons-pro'),
                    'custom-image'      => __('Custom Image','premium-addons-pro'),
                    ],
                'condition'     => [
                    'premium_magic_section_trig_selector'   => 'icon'
                    ]
                ]
            );

        $this->start_controls_tabs('premium_magic_section_icon_font');
        
        /*Button Color*/
        $this->start_controls_tab('premium_magic_section_icon_font_in_tab',
            [
                'label'         => __( 'In', 'premium-addons-pro' ),
                'condition'     => [
                    'premium_magic_section_trig_selector'   => 'icon',
                    'premium_magic_section_icon_selector'   => 'font-awesome-icon',
                    'premium_magic_section_trig_float'      => 'yes'
                ]
            ]
        );
        
        $this->add_control('premium_magic_section_icon_font_in',
            [
                'label'        => __('Icon','premium-addons-pro'),
                'type'         => Controls_Manager::ICON,
                'default'      => 'fa fa-arrow-down',
                'condition'     => [
                    'premium_magic_section_trig_selector'   => 'icon',
                    'premium_magic_section_icon_selector'   => 'font-awesome-icon',
                ],
                'separator'     => 'after'
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab('premium_magic_section_icon_font_out_tab',
            [
                'label'         => __( 'Out', 'premium-addons-pro' ),
                'condition'     => [
                    'premium_magic_section_trig_selector'   => 'icon',
                    'premium_magic_section_icon_selector'   => 'font-awesome-icon',
                    'premium_magic_section_trig_float'      => 'yes'
                ]
            ]
        );
        
        $this->add_control('premium_magic_section_icon_font_out',
            [
                'label'        => __('Icon','premium-addons-pro'),
                'type'         => Controls_Manager::ICON,
                'default'      => 'fa fa-arrow-up',
                'condition'     => [
                    'premium_magic_section_trig_selector'   => 'icon',
                    'premium_magic_section_icon_selector'   => 'font-awesome-icon',
                    'premium_magic_section_trig_float'      => 'yes'
                ],
                'separator'     => 'after'
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->add_control('premium_magic_section_custom_image',
            [
                'label'        => __('Custom Image','premium-addons-pro'),
                'type'         => Controls_Manager::MEDIA,
                'dynamic'       => [ 'active' => true ],
                'default'      => [
                    'url'   => Utils::get_placeholder_image_src()
                ],
                'condition'    => [
                    'premium_magic_section_trig_selector'   => 'icon',
                    'premium_magic_section_icon_selector'   => 'custom-image',
                ]
            ]
            );
        
        $this->add_responsive_control('prmium_magic_section_float_icon_size',
            [
                'label'         => __('Size','premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', "em"],
                'range'         => [
                    'px'    => [
                        'min'   => 1, 
                        'max'   => 300,
                    ],
                    'em'    => [
                        'min'   => 1, 
                        'max'   => 30,
                    ],
                ],
                'condition'    => [
                    'premium_magic_section_trig_float'   => 'yes',
                    'premium_magic_section_trig_selector!'   => 'button',
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-magic-section-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .premium-magic-section-icon-image' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                ],
                ]
            );
        
        $this->add_responsive_control('prmium_magic_section_icon_size',
            [
                'label'         => __('Size','premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', "em"],
                'condition'    => [
                    'premium_magic_section_trig_float!'   => 'yes',
                    'premium_magic_section_trig_selector'   => 'icon',
                    'premium_magic_section_icon_selector'   => 'font-awesome-icon',
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-magic-section-btn' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                ]
            );
        
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
                [
                    'name' => 'prmium_magic_section_trig_image_size', 
                    'default' => 'full',
                    'condition'    => [
                            'premium_magic_section_trig_selector'   => 'icon',
                            'premium_magic_section_icon_selector'   => 'custom-image',
                            'premium_magic_section_trig_float!'      => 'yes',
                        ],    
                    ]
                );
        
        $this->add_control('premium_magic_section_button_text',
                [
                    'label'         => __('Button Text', 'premium-addons-pro'),
                    'default'       => __('Premium Magic Section','premium-addons-pro'),
                    'type'          => Controls_Manager::TEXT,
                    'dynamic'       => [ 'active' => true ],
                    'label_block'   => true,
                    'condition'    => [
                        'premium_magic_section_trig_selector'   => 'button',
                    ],
                ]
                );
        
        $this->add_control('premium_magic_section_icon_switcher',
                [
                    'label'         => __('Icon', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SWITCHER,
                    'description'   => __('Enable or disable button icon','premium-addons-pro'),
                    'condition'    => [
                        'premium_magic_section_trig_selector'   => 'button',
                    ],
                ]
                );

        $this->add_control('premium_magic_section_button_icon_selection',
                [
                    'label'         => __('Icon', 'premium-addons-pro'),
                    'type'          => Controls_Manager::ICON,
                    'default'       => 'fa fa-bars',
                    'condition'     => [
                        'premium_magic_section_trig_selector'   => 'button',
                        'premium_magic_section_icon_switcher'   => 'yes',
                    ],
                    'label_block'   => true,
                ]
                );
        
        $this->add_control('premium_magic_section_icon_position', 
                [
                    'label'         => __('Icon Position', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => 'before',
                    'options'       => [
                        'before'        => __('Before'),
                        'after'         => __('After'),
                        ],
                    'condition'     => [
                        'premium_magic_section_trig_selector'   => 'button',
                        'premium_magic_section_icon_switcher'   => 'yes',
                    ],
                    'label_block'   => true,
                    ]
                );
        
        $this->add_control('premium_magic_section_icon_before_size',
                [
                    'label'         => __('Icon Size', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'condition'     => [
                        'premium_magic_section_trig_selector'   => 'button',
                        'premium_magic_section_icon_switcher'   => 'yes',
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-btn i '=> 'font-size: {{SIZE}}px',
                    ]
                ]
                );
        
        if(!$this->check_rtl()){
        $this->add_control('premium_magic_section_icon_before_spacing',
                [
                    'label'         => __('Icon Spacing', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'condition'     => [
                        'premium_magic_section_trig_selector'   => 'button',
                        'premium_magic_section_icon_switcher'   => 'yes',
                        'premium_magic_section_icon_position'   => 'before'
                    ],
                    'default'       => [
                        'size'  => 15
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-btn i' => 'margin-right: {{SIZE}}px',
                    ],
                    'separator'     => 'after',
                ]
            );
        }
        
        if(!$this->check_rtl()){
        $this->add_control('premium_magic_box_icon_after_spacing',
                [
                    'label'         => __('Icon Spacing', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'condition'     => [
                        'premium_magic_section_trig_selector'   => 'button',
                        'premium_magic_section_icon_switcher'   => 'yes',
                        'premium_magic_section_icon_position'   => 'after'
                    ],
                    'default'       => [
                        'size'  => 15
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-btn i' => 'margin-left: {{SIZE}}px',
                    ],
                    'separator'     => 'after',
                ]
            );
        }
        
        if($this->check_rtl()){
            $this->add_control('premium_magic_box_icon_rtl_before_spacing',
                [
                    'label'         => __('Icon Spacing', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'condition'     => [
                        'premium_magic_section_trig_selector'   => 'button',
                        'premium_magic_section_icon_switcher'   => 'yes',
                        'premium_magic_section_icon_position'   => 'after'
                    ],
                    'default'       => [
                        'size'  => 15
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-btn i' => 'margin-left: {{SIZE}}px',
                    ],
                    'separator'     => 'after',
                ]
            );
        }
        
        if($this->check_rtl()){
            $this->add_control('premium_magic_box_icon_rtl_after_spacing',
                [
                    'label'         => __('Icon Spacing', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'condition'     => [
                        'premium_magic_section_trig_selector'   => 'button',
                        'premium_magic_section_icon_switcher'   => 'yes',
                        'premium_magic_section_icon_position'   => 'after',
                    ],
                    'default'       => [
                        'size'  => 15
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-btn i' => 'margin-right: {{SIZE}}px',
                    ],
                    'separator'     => 'after',
                ]
            );
        }
        
        /*Button Size*/
        $this->add_control('premium_magic_section_button_size',
            [
                'label'         => __('Button Size', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'premium-btn-sm'    => __('Small','premium-addons-pro'),
                    'premium-btn-md'    => __('Medium','premium-addons-pro'),
                    'premium-btn-lg'    => __('Large','premium-addons-pro'),
                    'premium-btn-block' => __('Block','premium-addons-pro'),
                ],
                'label_block'   => true,
                'default'       => 'premium-btn-lg',
                'condition'     => [
                    'premium_magic_section_trig_selector'   => 'button',
                    'premium_magic_section_trig_float!'     => 'yes'
                ],
            ]
            );
        
        $this->add_responsive_control('premium_magic_section_button_align',
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
                    '{{WRAPPER}} .premium-magic-section-button-trig' => 'text-align: {{VALUE}}',
                ],
                'default' => 'center',
                'condition'     => [
                    'premium_magic_section_trig_float!'     => 'yes',
                    'premium_magic_section_button_size!'    => 'premium-btn-block'
                ],
            ]
        );
        
        
        $this->add_control('premium_magic_section_trig_anim',
            [
                'label'         => __('Hover Animation', 'premium-addons-pro'),
                'type'          => Controls_Manager::HOVER_ANIMATION,
                'condition'     => [
                    'premium_magic_section_trig_selector'   => 'icon',
                ],
            ]);
        
        $this->add_responsive_control('premium_magic_section_icon_align_hor',
            [
                'label'             => __( 'Icon Alignment', 'premium-addons-pro' ),
                'type'              => Controls_Manager::CHOOSE,
                'options'           => [
                    'left'    => [
                        'title' => __( 'Left', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-align-justify',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'selectors'         => [
                    '{{WRAPPER}} .premium-magic-section-icon-wrap' => 'text-align: {{VALUE}}',
                ],
                'default' => 'center',
                'condition'         => [
                    'premium_magic_section_trig_selector'   => 'icon',
                    'premium_magic_section_trig_float'     => 'yes',
                    'premium_magic_section_pos' => ['top', 'bottom']
                ]
            ]
        );
        
        $this->add_responsive_control('premium_magic_section_icon_align_ver',
            [
                'label'             => __( 'Icon Alignment', 'premium-addons-pro' ),
                'type'              => Controls_Manager::CHOOSE,
                'options'           => [
                    'top'    => [
                        'title'=> __( 'Top', 'premium-addons-pro' ),
                        'icon' => 'fa fa-arrow-up',
                        ],
                    'middle' => [
                        'title' => __( 'Middle', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-align-center',
                        ],
                    'bottom'     => [
                        'title'=> __( 'Bottom', 'premium-addons-pro' ),
                        'icon' => 'fa fa-arrow-down',
                        ],
                    ],
                'default' => 'middle',
                'condition'         => [
                    'premium_magic_section_trig_float'     => 'yes',
                    'premium_magic_section_pos' => ['right', 'left']
                ]
            ]
        );
        
        $this->end_controls_section();
        
        /*Magic Section Icon Section*/
        $this->start_controls_section('premium_magic_section_display',
            [
                'label'     => __('Display Options', 'premium-addons-pro'),
            ]);
        
        $this->add_control('premium_magic_section_pos',
                [
                    'label'         => __( 'Position', 'premium-addons-pro' ),
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
                    ]
                );
        
        $this->add_control('premium_magic_section_gutter',
                [
                    'label'         => __('Gutter (%)', 'premium-addons-pro'),
                    'type'          => Controls_Manager::NUMBER,
                    'default'       => 0,
                    'min'           => -100,
                    'max'           => 100,
                    'description'   => __('0% is default. Increase to push the section outside or decrease to pull the section inside.','premium-addons-pro'),
                    ]
                );
        
        $this->add_control('premium_magic_section_style',
            [
                'label'         => __('Style', 'premium-addons-pro'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'slide' => __('Slide', 'premium-addons-pro'),
                    'push'  => __('Push', 'premium-addons-pro'),
                ],
                'default'       => 'slide',
                'label_block'   => true,
                'condition'     => [
                    'premium_magic_section_pos!'    => 'bottom'
                    ]
                ]
                );
        
        
        $this->add_control('premium_magic_section_overlay',
                [
                    'label'         => __('Overlay', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SWITCHER,
                ]
                );
        
        
        $this->add_responsive_control('premium_magic_section_content_align',
            [
                'label'             => __( 'Content Alignment', 'premium-addons-pro' ),
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
                    '{{WRAPPER}} .premium-magic-section-content-wrap' => 'text-align: {{VALUE}}',
                ],
                'default' => 'center',
                'condition'     => [
                    'premium_magic_section_content_type'    => 'editor',
                ],
            ]
        );
        
        $this->add_responsive_control('premium_magic_section_content_position',
            [
                'label'         => __('Vertical Position', 'premium-addons-pro'),
                'type'              => Controls_Manager::CHOOSE,
                'options'           => [
                    'flex-start'    => [
                        'title' => __( 'Top', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-arrow-up',
                    ],
                    'center' => [
                        'title' => __( 'Middle', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Bottom', 'premium-addons-pro' ),
                        'icon'  => 'fa fa-arrow-down',
                    ],
                ],
                'selectors'         => [
                    '{{WRAPPER}} .premium-magic-section-wrap.left .premium-magic-section-content-wrap-out, {{WRAPPER}} .premium-magic-section-wrap.right .premium-magic-section-content-wrap-out' => 'align-items: {{VALUE}}',
                ],
                'default' => 'center',
                'condition'     => [
                    'premium_magic_section_pos'    => ['right', 'left'],
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section('premium_magic_responsive',
            [
                'label'     => __('Responsive', 'premium-addons-pro'),
            ]);

        $this->add_control('premium_magic_section_responsive_switcher',
            [
                'label'         => __('Responsive Controls', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('This options will hide the trigger and the content below a specific screen size', 'premium-addons-pro')
            ]);
        
        $this->add_control('premium_magic_section_hide_tabs',
            [
                'label'         => __('Hide on Tablets', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Hide Magic Section below Elementor\'s Tablet Breakpoint ', 'premium-addons-pro'),
                'condition'     => [
                    'premium_magic_section_responsive_switcher'    => 'yes'
                ],
            ]);
        
        $this->add_control('premium_magic_section_hide_mobs',
            [
                'label'         => __('Hide on Mobiles', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => __('Hide Magic Section below Elementor\'s Mobile Breakpoint ', 'premium-addons-pro'),
                'condition'     => [
                    'premium_magic_section_responsive_switcher'    => 'yes'
                ],
            ]);

        $this->end_controls_section();
        
        /*Selector Style*/
        $this->start_controls_section('premium_magic_section_button_style',
                [
                    'label'         => __('Trigger', 'premium-addons-pro'),
                    'tab'           => Controls_Manager::TAB_STYLE,
                    ]
                );

        /*Button Text Color*/
        $this->add_control('premium_magic_section_button_text_color',
                [
                    'label'         => __('Color', 'premium-addons-pro'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'condition'     => [
                        'premium_magic_section_trig_selector'   => 'button'
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-btn,{{WRAPPER}} .premium-magic-section-btn span' => 'color:{{VALUE}};',
                        ],
                    ]
                );
        
        $this->add_control('premium_magic_section_button_icon_color',
                [
                    'label'         => __('Icon Color', 'premium-addons-pro'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'condition'     => [
                        'premium_magic_section_trig_selector'   => 'button'
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-btn i' => 'color:{{VALUE}};',
                        ],
                    ]
                );

        /*Selector Text Typography*/
        $this->add_group_control(
            Group_Control_Typography::get_type(),
                [
                    'name'          => 'premium_magic_section_button_typo',
                    'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'      => '{{WRAPPER}} .premium-magic-section-btn span',
                    'condition'     => [
                        'premium_magic_section_trig_selector'   => 'button'
                    ],
                ]
                );
        
        $this->start_controls_tabs('premium_magic_section_button_style_tabs');
        
        /*Button Color*/
        $this->start_controls_tab('premium_magic_section_button_normal',
                [
                    'label'         => __( 'Normal', 'premium-addons-pro' ),
                ]
        );
        
        $this->add_control('premium_magic_section_icon_color_normal',
                [
                    'label'         => __('Color', 'premium-addons-pro'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'condition'     => [
                        'premium_magic_section_trig_selector!'   => 'button',
                        'premium_magic_section_icon_selector'   => 'font-awesome-icon'
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-btn' => 'color:{{VALUE}};',
                        ],
                    ]
                );
        
        
        /*Button Background Color*/
        $this->add_control('premium_magic_section_button_background',
                [
                    'label'         => __('Background Color', 'premium-addons-pro'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-btn'   => 'background-color: {{VALUE}};',
                        ],
                    ]
                );

        /*Button Border*/
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_magic_section_button_border',
                    'selector'      => '{{WRAPPER}} .premium-magic-section-btn',
                ]
                );
        
        /*Button Border Radius*/
        $this->add_control('premium_magic_section_button_border_radius',
                [
                   'label'          => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%', 'em'],
                    'default'       => [
                            'size'  => 0
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-btn'     => 'border-radius:{{SIZE}}{{UNIT}};',
                    ],
                    ]
                );

        /*Selector Box Shadow*/
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'label'         => __('Shadow','premium-addons-pro'),
                    'name'          => 'premium_magic_section_button_box_shadow',
                    'selector'      => '{{WRAPPER}} .premium-magic-section-btn'
                ]
                );
        
        /*Selector Padding*/
        $this->add_responsive_control('premium_magic_section_button_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        ],
                    ]
                );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab('premium_magic_section_button_hover',
                [
                    'label'         => __('Hover', 'premium-addons-pro'),
                ]
                );
        
        $this->add_control('premium_magic_section_icon_color_HOVER',
                [
                    'label'         => __('Color', 'premium-addons-pro'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'condition'     => [
                        'premium_magic_section_trig_selector!'   => 'button',
                        'premium_magic_section_icon_selector'   => 'font-awesome-icon'
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-btn:hover' => 'color:{{VALUE}};',
                        ],
                    ]
                );
        
        /*Button Hover Background Color*/
        $this->add_control('premium_magic_section_button_hover_background',
                [
                    'label'         => __('Background Color', 'premium-addons-pro'),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-btn:hover' => 'background: {{VALUE}};',
                        ],
                    ]
                );

        /*Button Border*/
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_magic_section_button_border_hover',
                    'selector'      => '{{WRAPPER}} .premium-magic-section-btn:hover',
                ]
                );
        
        /*Button Border Radius*/
        $this->add_control('premium_magic_section_button_border_radius_hover',
                [
                   'label'          => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%', 'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-btn:hover'     => 'border-radius:{{SIZE}}{{UNIT}};',
                    ],
                ]
                );
        
        /*Selector Box Shadow*/
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'label'         => __('Shadow','premium-addons-pro'),
                    'name'          => 'premium_magic_section_button_box_shadow_hover',
                    'selector'      => '{{WRAPPER}} .premium-magic-section-btn:hover'
                ]
                );
        
        $this->add_responsive_control('premium_magic_section_button_padding_hover',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-btn:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        ],
                    ]
                );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
                
        $this->end_controls_section();
        
        $this->start_controls_section('premium_magic_section_close_style',
            [
                'label'             => __('Close','premium-addons-pro'),
                'tab'               => Controls_Manager::TAB_STYLE,
                'condition'         => [
                    'premium_magic_section_close'   => 'yes'
                ]
            ]);
        
        $this->add_control('premium_magic_section_close_color',
            [
                'label'             => __('Color', 'premium-addons-pro'),
                'type'              => Controls_Manager::COLOR,
                'scheme'            => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'         => [
                    '{{WRAPPER}} .premium-magic-section-wrap .premium-magic-section-close i'   => 'color: {{VALUE}};'
                ]
            ]);
        
        $this->add_control('premium_magic_section_close_size',
                [
                    'label'         => __('Size', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%', 'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-wrap .premium-magic-section-close' => 'font-size: {{SIZE}}{{UNIT}};'
                        ]
                    ]
                );
        
        $this->add_control('premium_magic_section_close_hover_color',
            [
                'label'             => __('Hover Color', 'premium-addons-pro'),
                'type'              => Controls_Manager::COLOR,
                'scheme'            => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'         => [
                    '{{WRAPPER}} .premium-magic-section-wrap .premium-magic-section-close:hover i'   => 'color: {{VALUE}};'
                ]
            ]);
        
        $this->add_control('premium_magic_section_close_backcolor',
            [
                'label'             => __('Background Color', 'premium-addons-pro'),
                'type'              => Controls_Manager::COLOR,
                'selectors'         => [
                    '{{WRAPPER}} .premium-magic-section-wrap .premium-magic-section-close'   => 'background-color: {{VALUE}};'
                ]
            ]);
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
                [
                    'name'              => 'premium_magic_section_close_border',
                    'selector'          => '{{WRAPPER}} .premium-magic-section-wrap .premium-magic-section-close'
                    ]
                );
        
        $this->add_control('premium_magic_section_close_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%', 'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-wrap .premium-magic-section-close' => 'border-radius: {{SIZE}}{{UNIT}};'
                        ]
                    ]
                );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'label'             => __('Shadow','premium-addons-pro'),
                    'name'              => 'premium_magic_section_close_shadow',
                    'selector'          => '{{WRAPPER}} .premium-magic-section-wrap .premium-magic-section-close'
                    ]
                );
        
        /*Icon Margin*/
        $this->add_responsive_control('premium_magic_section_close_margin',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-wrap .premium-magic-section-close' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        ]
                    ]
                );
        
        $this->add_responsive_control('premium_magic_section_close_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-wrap .premium-magic-section-close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                        ]
                    ]
                );
        
        $this->end_controls_section();
        
        /*Magic Section Container Style Section*/
        $this->start_controls_section('premium_magic_section_container',
            [
                'label'         => __('Container', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );
        
        $this->add_control('premium_magic_section_overlay_background',
                [
                    'label'             => __('Overlay Color', 'premium-addons-pro'),
                    'type'              => Controls_Manager::COLOR,
                    'selectors'         => [
                        '{{WRAPPER}} .premium-magic-section-overlay'  => 'background-color: {{VALUE}};',
                        ],
                    'condition'         => [
                        'premium_magic_section_overlay' => 'yes'
                    ]
                    ]
                );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
                [
                    'name'              => 'premium_magic_section_background',
                    'types'             => [ 'classic' , 'gradient' ],
                    'selector'          => '{{WRAPPER}} .premium-magic-section-wrap',
                    ]
                );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_magic_section_background__border',
                    'selector'      => '{{WRAPPER}} .premium-magic-section-wrap',
                ]
                );
        
        $this->add_responsive_control('premium_magic_section_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-wrap' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [

                    'name'          => 'premium_magic_section_background_box_shadow',
                    'selector'      => '{{WRAPPER}} .premium-magic-section-wrap',
                ]
                );
        
        $this->add_responsive_control('premium_magic_section_background_margin',
                [
                    'label'         => __('Out Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-wrap.out' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->add_responsive_control('premium_magic_section_background_margin_in',
                [
                    'label'         => __('In Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-wrap.in' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->add_responsive_control('premium_magic_section_background_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-magic-section-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->end_controls_section();
        
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        $elementor_post_id = $settings['premium_magic_section_content_temp'];
        $premium_elements_frontend = new Frontend;
        if($settings['premium_magic_section_icon_selector'] == 'font-awesome-icon'){
            $icon_font = $settings['premium_magic_section_icon_font_in'];
        } else {
            $icon_font = $settings['premium_magic_section_custom_image']['url'];
        }
        $section_gutter = !empty($settings['premium_magic_section_gutter']) ? $settings['premium_magic_section_gutter'] : 0;
        $section_pos = $settings['premium_magic_section_pos'];
        if($section_pos == 'right' || $section_pos == 'left'){
            $icon_align = $settings['premium_magic_section_icon_align_ver'];
            $close_align = 'close-'.$settings['premium_magic_section_close_pos_hor'];
        } else {
            $icon_align = '';
            $close_align = 'close-'.$settings['premium_magic_section_close_pos'];
        }
        
        $button_icon = $settings['premium_magic_section_button_icon_selection'];
        
        $magic_section_settings = [
            'position'  => $section_pos,
            'gutter'    => $section_gutter,
            'trigger'   => $settings['premium_magic_section_trig_selector'],
            'style'     => $settings['premium_magic_section_style'],
            'inIcon'    => $settings['premium_magic_section_icon_font_in'],
            'outIcon'   => $settings['premium_magic_section_icon_font_out'],
            'responsive'=> ( $settings['premium_magic_section_responsive_switcher'] == 'yes' ) ? true : false,
            'hideTabs'  => ( $settings['premium_magic_section_hide_tabs'] == 'yes' ) ? true: false,
            'tabSize'   => ( $settings['premium_magic_section_hide_tabs'] == 'yes' ) ? Responsive::get_breakpoints()['lg'] : Responsive::get_breakpoints()['lg'],
            'hideMobs'  => ( $settings['premium_magic_section_hide_mobs'] == 'yes' ) ? true: false,
            'mobSize'   => ( $settings['premium_magic_section_hide_mobs'] == 'yes' ) ? Responsive::get_breakpoints()['md'] : Responsive::get_breakpoints()['md']
        ];
        ?>

<?php if($settings['premium_magic_section_overlay'] == 'yes') : ?>
<div class="premium-magic-section-overlay"></div>
<?php endif; ?>
<div class="premium-magic-section-container">
        <div id="premium-magic-section-<?php echo esc_attr($this->get_id()); ?>" class="premium-magic-section-wrap magic-section-hide out <?php echo esc_attr( $section_pos ) .' '. esc_attr( $close_align ); ?>" data-settings='<?php echo wp_json_encode($magic_section_settings); ?>'>
        <?php if($section_pos == 'top' || $section_pos == 'left') : ?>
            <div class="premium-magic-section-content-wrap-out">
                <div class="premium-magic-section-content-wrap">
                <?php if($settings['premium_magic_section_content_type'] == 'editor') : echo $settings['premium_magic_section_content']; else: echo $premium_elements_frontend->get_builder_content($elementor_post_id, true); endif; ?>
                </div>        
            </div>
        
        <?php if($settings['premium_magic_section_close']) : ?>
            <div class="premium-magic-section-close-wrap">
                <button type="button" class="premium-magic-section-close"><i class="fa fa-times"></i></button>
            </div>
        <?php endif; ?>
        <?php if( $settings['premium_magic_section_trig_float'] == 'yes') : ?>
        <div class="premium-magic-section-icon-wrap <?php echo esc_attr($icon_align); ?>">
            <?php if($settings['premium_magic_section_trig_selector'] == 'icon' && $settings['premium_magic_section_icon_selector'] == 'font-awesome-icon') : ?>
            <i class ="premium-magic-section-btn premium-magic-section-icon <?php echo esc_attr($icon_font); ?> <?php echo 'elementor-animation-'.esc_attr($settings['premium_magic_section_trig_anim']); ?>"></i>
        <?php elseif($settings['premium_magic_section_trig_selector'] == 'icon' && $settings['premium_magic_section_icon_selector'] == 'custom-image') : ?>
                <img class="premium-magic-section-btn premium-magic-section-icon-image <?php echo 'elementor-animation-'.esc_attr($settings['premium_magic_section_trig_anim']); ?>" alt ="Custom Image" src="<?php echo esc_attr($icon_font);?>" >
        <?php elseif($settings['premium_magic_section_trig_selector'] == 'button') : ?>
            <button type="button" class="premium-magic-section-btn btn"><?php if($settings['premium_magic_section_icon_switcher'] && $settings['premium_magic_section_icon_position'] == 'before' && !empty($settings['premium_magic_section_button_icon_selection'])) : ?><i class="fa <?php echo esc_attr($button_icon); ?>"></i><?php endif; ?><span><?php echo $settings['premium_magic_section_button_text']; ?></span><?php if($settings['premium_magic_section_icon_switcher'] && $settings['premium_magic_section_icon_position'] == 'after' && !empty($settings['premium_magic_section_button_icon_selection'])) : ?><i class="fa <?php echo esc_attr($button_icon); ?>"></i><?php endif; ?></button>
        <?php endif;?>
        </div>
        <?php endif; ?>
        <?php elseif ($section_pos == 'bottom' || $section_pos == 'right') : ?>
            <?php if( $settings['premium_magic_section_trig_float'] == 'yes') : ?>
        <div class="premium-magic-section-icon-wrap <?php echo esc_attr($icon_align); ?>">
            <?php if($settings['premium_magic_section_trig_selector'] == 'icon' && $settings['premium_magic_section_icon_selector'] == 'font-awesome-icon') : ?>
            <i class ="premium-magic-section-btn premium-magic-section-icon <?php echo esc_attr($icon_font); ?> <?php echo 'elementor-animation-'.esc_attr($settings['premium_magic_section_trig_anim']); ?>"></i>
        <?php elseif($settings['premium_magic_section_trig_selector'] == 'icon' && $settings['premium_magic_section_icon_selector'] == 'custom-image') : ?>
                <img class="premium-magic-section-btn premium-magic-section-icon-image <?php echo 'elementor-animation-'.esc_attr($settings['premium_magic_section_trig_anim']); ?>" alt ="Custom Image" src="<?php echo esc_attr($icon_font);?>" >
        <?php elseif($settings['premium_magic_section_trig_selector'] == 'button') : ?>
            <button type="button" class="premium-magic-section-btn btn"><?php if($settings['premium_magic_section_icon_switcher'] && $settings['premium_magic_section_icon_position'] == 'before' && !empty($settings['premium_magic_section_button_icon_selection'])) : ?><i class="fa <?php echo esc_attr($button_icon); ?>"></i><?php endif; ?><span><?php echo $settings['premium_magic_section_button_text']; ?></span><?php if($settings['premium_magic_section_icon_switcher'] && $settings['premium_magic_section_icon_position'] == 'after' && !empty($settings['premium_magic_section_button_icon_selection'])) : ?><i class="fa <?php echo esc_attr($button_icon); ?>"></i><?php endif; ?></button>
        <?php endif;?>
        </div>
        <?php endif; ?>
        <div class="premium-magic-section-content-wrap-out">
            <div class="premium-magic-section-content-wrap">
                <?php if($settings['premium_magic_section_content_type'] == 'editor') : echo $settings['premium_magic_section_content']; else: echo $premium_elements_frontend->get_builder_content($elementor_post_id, true); endif; ?>
            </div>
        </div>
        <?php if($settings['premium_magic_section_close']) : ?>
            <div class="premium-magic-section-close-wrap">
                <button type="button" class="premium-magic-section-close"><i class="fa fa-times"></i></button>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    </div>
    <?php if($settings['premium_magic_section_trig_float'] != 'yes' ) : ?>
        
        <div class="premium-magic-section-button-trig">
            <?php if($settings['premium_magic_section_trig_selector'] == 'button' ) : ?>
            <button type="button" class="premium-magic-section-btn btn <?php echo esc_attr($settings['premium_magic_section_button_size']); ?>" ><?php if($settings['premium_magic_section_icon_switcher'] && $settings['premium_magic_section_icon_position'] == 'before' && !empty($settings['premium_magic_section_button_icon_selection'])) : ?><i class="fa <?php echo esc_attr($button_icon); ?>"></i><?php endif; ?><span><?php echo $settings['premium_magic_section_button_text']; ?></span><?php if($settings['premium_magic_section_icon_switcher'] && $settings['premium_magic_section_icon_position'] == 'after' &&!empty($settings['premium_magic_section_button_icon_selection'])) : ?><i class="fa <?php echo esc_attr($button_icon); ?>"></i><?php endif; ?></button>
            <?php elseif( $settings['premium_magic_section_trig_selector'] == 'icon' && $settings['premium_magic_section_icon_selector'] == 'font-awesome-icon' ) : ?>
            <i class="premium-magic-section-btn <?php echo esc_attr($icon_font); ?> <?php echo 'elementor-animation-'.esc_attr($settings['premium_magic_section_trig_anim']); ?>"></i>
            <?php elseif( $settings['premium_magic_section_trig_selector'] == 'icon' && $settings['premium_magic_section_icon_selector'] == 'custom-image' ) :
            $image_custom = $settings['premium_magic_section_custom_image'];
            $image_url_main = Group_Control_Image_Size::get_attachment_image_src( $image_custom['id'], 'prmium_magic_section_trig_image_size', $settings );
            $image_url_main = empty($image_url_main) ? $image_custom['url'] : $image_url_main;
             ?>
            <img class="premium-magic-section-btn <?php echo 'elementor-animation-'.esc_attr($settings['premium_magic_section_trig_anim']); ?>" src="<?php echo esc_attr($image_url_main); ?>">
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

    <?php }
    
}