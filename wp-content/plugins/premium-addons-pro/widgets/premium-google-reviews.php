<?php 

/**
 * Class: Premium_Google_Reviews
 * Name: Google Reviews
 * Slug: premium-google-reviews
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
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;

if( ! defined( 'ABSPATH' ) ) exit;

class Premium_Google_Reviews extends Widget_Base {
    
    public function get_name() {
        return 'premium-google-reviews';
    }
    
    public function get_title() {
        return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Google Reviews', 'premium-addons-pro') );
    }
    
    public function get_icon() {
        return 'pa-pro-google-reviews';
    }
    
    public function get_categories() {
        return ['premium-elements'];
    }
    
    public function get_script_depends() {
        return [
            'jquery-slick',
            //'masonry-js',
            'isotope-js',
            'premium-pro-js'
        ];
    }
    
    public function is_reload_preview_required() {
        return true;
    }
    
    // Adding the controls fields for the Premium Google Reviews
    // This will controls the animation, colors and background, dimensions etc
    protected function _register_controls() {
        
        $this->start_controls_section('general',
            [
                'label'         => __( 'Access Credentials', 'premium-addons-pro' )
            ]
        );

        $this->add_control('api_key',
            [
                'label'         => __('API Key', 'premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
                'default'       => 'AIzaSyCmGbSUircQ6RktLk3VVC-n63kuYXykoqY',
                'description'   => 'Click <a href="https://developers.google.com/places/web-service/get-api-key" target="_blank">Here</a> to get your Google Places API key',
            ]
        );
        
        $this->add_control('place_id',
            [
                'label'         => __('Place ID', 'premium-addons-pro'),
                'type'          => Controls_Manager::TEXT,
                'default'       => 'ChIJ7abYXwhAxokRFGoJWSMHR7c',
                'dynamic'       => [ 'active' => true ],
                'description'   => 'Click <a href="https://developers.google.com/maps/documentation/javascript/examples/places-placeid-finder" target="_blank">Here</a> to get your place ID',
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('content',
            [
                'label'         => __( 'Display Options', 'premium-addons-pro' )
            ]
        );
        
        $this->start_controls_tabs('display_tabs');
        
        $this->start_controls_tab('place_tab',
            [
                'label'         => __('Place', 'premium-addons-pro'),
                'condition'     => [
                    'place_info'  => 'yes'
                ]
            ]
        );
        
        $this->add_control('place_custom_image_switch',
            [
                'label'         => __('Replace Place Image', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'condition'     => [
                    'place_info'  => 'yes'
                ]
            ]
        );
        
        $this->add_control('place_custom_image',
           [
                'label'         => __( 'Upload Image', 'premium-addons-pro' ),
                'type'          => Controls_Manager::MEDIA,
                'dynamic'       => [ 'active' => true ],
                'condition'     => [
                    'place_info'  => 'yes',
                    'place_custom_image_switch'  => 'yes'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'          => 'thumbnail',
                'default'       => 'full',
                'condition'     => [
                    'place_info'                    => 'yes',
                    'place_custom_image_switch'     => 'yes'
                ],
            ]
        );
        
        $this->add_control('place_display',
            [
                'label'         => __( 'Display', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'inline'        => __('Inline', 'premium-addons-pro'),
                    'block'         => __('Block', 'premium-addons-pro'),
                ],
                'default'       => 'block',
                'condition'         => [
                    'place_info'  => 'yes'
                ]
            ]
        );
        
        $this->add_control('place_dir',
                [
                    'label'     => __( 'Direction', 'premium-addons-pro' ),
                    'type'      => Controls_Manager::SELECT,
                    'options'   => [
                        'rtl'       => 'RTL',
                        'ltr'       => 'LTR',
                    ],
                    'default'   => 'ltr',
                    'condition' => [
                        'place_display'   => 'inline'
                    ]
                ]
            );
        
        $this->add_responsive_control('place_align',
            [
                'label'         => __( 'Place Alignment', 'premium-addons-pro' ),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'left'          => [
                        'title'=> __( 'Left', 'premium-addons-pro' ),
                        'icon' => 'fa fa-align-left',
                        ],
                    'center'        => [
                        'title'=> __( 'Center', 'premium-addons-pro' ),
                        'icon' => 'fa fa-align-center',
                        ],
                    'right'         => [
                        'title'=> __( 'Right', 'premium-addons-pro' ),
                        'icon' => 'fa fa-align-right',
                        ],
                    ],
                'default'       => 'center',
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-container .premium-fb-rev-page' => 'text-align: {{VALUE}};',
                    ],
                'condition'     => [
                    'place_info'   => 'yes'
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab('reviews_tab',
            [
                'label'         => __('Reviews', 'premium-addons-pro'),
            ]
        );
        
        $this->add_responsive_control('reviews_columns',
            [
                'label'             => __('Reviews/Row', 'premium-addons-pro'),
                'type'              => Controls_Manager::SELECT,
                'description'       => __('You may need to click \'APPLY\' to see your changes', 'premium-addons-pro'),
                'options'           => [
                    '100%'  => __('1 Column', 'premium-addons-pro'),
                    '50%'   => __('2 Columns', 'premium-addons-pro'),
                    '33.33%'=> __('3 Columns', 'premium-addons-pro'),
                    '25%'   => __('4 Columns', 'premium-addons-pro'),
                    '20%'   => __('5 Columns', 'premium-addons-pro'),
                    '16.667%'=> __('6 Columns', 'premium-addons-pro'),
                ],
                'default'           => '33.33%',
                'selectors'         => [
                    '{{WRAPPER}} .premium-fb-rev-review-wrap' => 'width: {{VALUE}}'
                ],
            ]
        );

        $this->add_control('reviews_display',
            [
                'label'         => __( 'Display', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'inline'        => __('Inline', 'premium-addons-pro'),
                    'block'         => __('Block', 'premium-addons-pro'),
                ],
                'default'       => 'block'
            ]
        );
        
        $this->add_control('reviews_style',
            [
                'label'         => __( 'Layout', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'even'          => __('Even', 'premium-addons-pro'),
                    'masonry'       => __('Masonry', 'premium-addons-pro'),
                ],
                'default'       => 'masonry',
                'condition'     => [
                    'reviews_columns!'  => '100%',
                    'reviews_carousel!'=> 'yes'
                ]
            ]
        );
        
        $this->add_control('reviews_dir',
            [
                'label'         => __( 'Direction', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'rtl'   => 'RTL',
                    'ltr'   => 'LTR',
                    ],
                'default'       => 'ltr',
                'condition'     => [
                    'reviews_display'   => 'inline'
                ]
            ]
        );
        
        $this->add_responsive_control('content_align',
            [
                'label'         => __( 'Content Alignment', 'premium-addons-pro' ),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'left'          => [
                        'title'=> __( 'Left', 'premium-addons-pro' ),
                        'icon' => 'fa fa-align-left',
                        ],
                    'center'        => [
                        'title'=> __( 'Center', 'premium-addons-pro' ),
                        'icon' => 'fa fa-align-center',
                        ],
                    'right'         => [
                        'title'=> __( 'Right', 'premium-addons-pro' ),
                        'icon' => 'fa fa-align-right',
                        ],
                    'justify'       => [
                        'title'=> __( 'Justify', 'premium-addons-pro' ),
                        'icon' => 'fa fa-align-justify',
                        ],
                    ],
                'default'       => 'center',
                'condition'     => [
                    'reviews_display'   => 'block'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-container .premium-fb-rev-content' => 'text-align: {{VALUE}};',
                ]
            ]
        );
        
        $this->add_control('reviews_carousel',
            [
                'label'         => __('Enable Carousel', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
            ]
        );
        
        $this->add_control('carousel_play',
            [
                'label'         => __('Auto Play', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'condition'     => [
                    'reviews_carousel'  => 'yes'
                ]
            ]
        );
        
        $this->add_control('carousel_autoplay_speed',
			[
				'label'			=> __( 'Autoplay Speed', 'premium-addons-pro' ),
				'description'	=> __( 'Autoplay Speed means at which time the next slide should come. Set a value in milliseconds (ms)', 'premium-addons-pro' ),
				'type'			=> Controls_Manager::NUMBER,
				'default'		=> 5000,
				'condition'		=> [
					'reviews_carousel' => 'yes',
                    'carousel_play' => 'yes',
				],
			]
		);
        
        $this->add_responsive_control('carousel_arrows_pos',
            [
                'label'         => __('Arrows Position', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', "em"],
                'range'         => [
                    'px'    => [
                        'min'       => -100, 
                        'max'       => 100,
                    ],
                    'em'    => [
                        'min'       => -10, 
                        'max'       => 10,
                    ],
                ],
                'condition'		=> [
					'reviews_carousel' => 'yes'
				],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-reviews a.carousel-arrow.carousel-next' => 'right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .premium-fb-rev-reviews a.carousel-arrow.carousel-prev' => 'left: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();
        
        $this->start_controls_section('adv',
            [
                'label'         => __( 'Advanced Settings', 'premium-addons-pro' )
            ]
        );
        
        $this->add_control('place_info',
            [
                'label'         => __('Place Info', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes'
            ]
        );
        
        $this->add_control('place_rate',
            [
                'label'         => __('Place Rate', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'condition'     => [
                    'place_info'  => 'yes'
                ]
            ]
        );
        
        $this->add_control('text',
            [
                'label'         => __('Show Review Text', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
            ]
        );
        
        $this->add_control('stars',
            [
                'label'         => __('Show Stars', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes'
            ]
        );
        
        $this->add_control('date',
            [
                'label'         => __('Show Date', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
            ]
        );
        
        $this->add_control('date_format',
            [
                'label'         => __( 'Date Format', 'premium-addons-pro' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'd/m/Y' => __('DD/MM/YYYY', 'premium-addons-pro'),
                    'm/d/Y' => __('MM/DD/YYYY', 'premium-addons-pro'),
                ],
                'default'       => 'd/m/Y',
                'condition'         => [
                    'date'  => 'yes'
                ]
            ]
        );
        
       $this->add_control('language',
           [
               'label'         => __('Filter by Language', 'premium-addons-pro'),
               'type'          => Controls_Manager::SWITCHER,
           ]
       );

       $this->add_control('language_prefix',
           [
               'label'         => __( 'Language Prefix', 'premium-addons-pro' ),
               'type'          => Controls_Manager::TEXT,
               'description'   => __('Enter language prefix, eg. en for English, ja for Japanese'),
               'condition'     => [
                   'language' => 'yes'
               ]
           ]
       );

        $this->add_control('filter',
            [
                'label'         => __('Filter by Rate', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control('filter_min',
            [
                'label'         => __( 'Min Stars', 'premium-addons-pro' ),
                'type'          => Controls_Manager::NUMBER,
                'min'           => 1,
                'max'           => 5,
                'condition'     => [
                    'filter' => 'yes'
                ]
            ]
        );

        $this->add_control('filter_max',
            [
                'label'         => __( 'Max Stars', 'premium-addons-pro' ),
                'type'          => Controls_Manager::NUMBER,
                'min'           => 1,
                'max'           => 5,
                'condition'     => [
                    'filter' => 'yes'
                ]
            ]
        );
        
        $this->add_control('limit',
            [
                'label'         => __('Reviews Limit', 'premium-addons-pro'),
                'type'          => Controls_Manager::SWITCHER,
            ]
        );
        
        $this->add_control('limit_num',
            [
                'label'         => __( 'Number of Reviews', 'premium-addons-pro' ),
                'type'          => Controls_Manager::NUMBER,
                'min'           => 0,
                'max'           => 5,
                'description'   => __( 'Set a number of reviews to retrieve', 'premium-addons-pro' ),
                'condition'     => [
                    'limit' => 'yes'
                ],
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('images',
            [
                'label'         => __('Images', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs('images_tabs');
        
        $this->start_controls_tab('place_img_tab',
            [
                'label'         => __('Place', 'premium-addons-pro'),
                'condition'     => [
                    'place_info'  => 'yes'
                ]
            ]
        );
        
        $this->add_responsive_control('place_image_size',
            [
                'label'         => __('Size', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%', "em"],
                'range'         => [
                    'px'    => [
                        'min'   => 1, 
                        'max'   => 400,
                    ],
                ],
                'default'       => [
                    'unit'  => 'px',
                    'size'  => 60
                ],
                'condition'     => [
                    'place_custom_image_switch!'    => 'yes',
                    'place_info'  => 'yes'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .prmeium-fb-rev-page-inner .premium-fb-rev-img' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'place_image_border',
                'selector'      => '{{WRAPPER}} .prmeium-fb-rev-page-inner .premium-fb-rev-img',
                'condition'     => [
                    'place_info'  => 'yes'
                ],
            ]
        );
        
        $this->add_control('place_image_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%' ,'em'],
                'condition'     => [
                    'place_info'  => 'yes'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .prmeium-fb-rev-page-inner .premium-fb-rev-img' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label'         => __('Shadow','premium-addons-pro'),
                'name'          => 'place_image_shadow',
                'selector'      => '{{WRAPPER}} .prmeium-fb-rev-page-inner .premium-fb-rev-img',
                'condition'     => [
                    'place_info'  => 'yes'
                ],
            ]
        );
        
        $this->add_responsive_control('place_image_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'condition'     => [
                    'place_info'  => 'yes'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .prmeium-fb-rev-page-inner .premium-fb-rev-page-left' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab('img_tab',
            [
                'label'         => __('Review', 'premium-addons-pro'),
            ]
        );
        
        $this->add_responsive_control('image_size',
            [
                'label'         => __('Size', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%', "em"],
                'range'         => [
                    'px'    => [
                        'min'   => 1, 
                        'max'   => 200,
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-review-inner .premium-fb-rev-img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label'         => __('Shadow','premium-addons-pro'),
                'name'          => 'image_shadow',
                'selector'      => '{{WRAPPER}} .premium-fb-rev-review-inner .premium-fb-rev-img',
            ]
        );
        
        $this->add_responsive_control('image_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-review-inner .premium-fb-rev-content-left' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();
        
        $this->start_controls_section('page',
            [
                'label'         => __('Place Info', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'place_info'  => 'yes'
                ]
            ]
        );
        
        $this->start_controls_tabs('place_info_tabs');
        
        $this->start_controls_tab('page_container',
            [
                'label'         => __('Container', 'premium-addons-pro'),
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'          => 'page_container_background',
                'types'         => [ 'classic' , 'gradient' ],
                'selector'      => '{{WRAPPER}} .premium-fb-rev-page',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'page_container_border',
                'selector'      => '{{WRAPPER}} .premium-fb-rev-page',
            ]
        );
        
        $this->add_control('page_container_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%' ,'em'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-page' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'page_container_shadow',
                'selector'      => '{{WRAPPER}} .premium-fb-rev-page',
            ]
        );
        
        $this->add_responsive_control('page_container_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-page' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );
        
        $this->add_responsive_control('page_container_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-page' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab('page_link',
            [
                'label'         => __('Name', 'premium-addons-pro'),
            ]
        );
        
        $this->add_control('page_color',
            [
                'label'         => __('Text Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-page-link' => 'color: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_control('page_hover_color',
            [
                'label'         => __('Hover Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-page-link:hover' => 'color: {{VALUE}};'
                ]
            ]
            );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'page_typo',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .premium-fb-rev-page-link',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'          => 'place_shadow',
                'selector'      => '{{WRAPPER}} .premium-fb-rev-page-link',
            ]
        );
        
        $this->add_responsive_control('page_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-page-link-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab('page_rate_link',
            [
                'label'         => __('Rate', 'premium-addons-pro'),
            ]
        );
        
        $this->add_control('place_star_size',
            [
                'label'         => __('Star Size', 'premium-addons-pro'),
                'type'          => Controls_Manager::NUMBER,
                'min'           => 1,
                'max'           => 50,
                'condition'     => [
                    'stars'  => 'yes'
                ]
            ]
        );
        
        $this->add_control('place_fill',
            [
                'label'         => __('Star Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition'     => [
                    'stars'  => 'yes'
                ]
            ]
        );
        
        $this->add_control('place_empty',
            [
                'label'         => __('Empty Star Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition'     => [
                    'stars'  => 'yes'
                ]
            ]
        );
        
        $this->add_control('page_rate_color',
            [
                'label'         => __('Text Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition'     => [
                    'place_rate'  => 'yes'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-page-rating' => 'color: {{VALUE}};'
                ]
            ]
        );
       
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'page_rate_typo',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'condition'     => [
                    'place_rate'  => 'yes'
                ],
                'selector'      => '{{WRAPPER}} .premium-fb-rev-page-rating',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'          => 'place_rate_shadow',
                'selector'      => '{{WRAPPER}} .premium-fb-rev-page-rating',
                'condition'     => [
                    'place_rate'  => 'yes'
                ],
            ]
        );
        
        $this->add_responsive_control('page_rate_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'condition'     => [
                    'place_rate'  => 'yes'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-page-rating-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();
        
        $this->start_controls_section('review_container',
            [
                'label'         => __('Review', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control('reviews_star_size',
            [
                'label'         => __('Star Size', 'premium-addons-pro'),
                'type'          => Controls_Manager::NUMBER,
                'min'           => 1,
                'max'           => 50,
            ]
        );
        
        $this->add_control('reviews_fill',
            [
                'label'         => __('Star Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
            ]
        );
        
        $this->add_control('reviews_empty',
            [
                'label'         => __('Empty Star Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'          => 'review_container_background',
                'types'         => [ 'classic' , 'gradient' ],
                'selector'      => '{{WRAPPER}} .premium-fb-rev-review',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'review_container_border',
                'selector'      => '{{WRAPPER}} .premium-fb-rev-review',
            ]
        );
        
        $this->add_control('review_container_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%' ,'em'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-review' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'review_container_box_shadow',
                'selector'      => '{{WRAPPER}} .premium-fb-rev-review',
            ]
        );
        
        $this->add_responsive_control('reviews_gap',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', '%', "em"],
                'condition'     => [
                    'reviews_columns!'   => '100%'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-review-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_responsive_control('review_container_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('reviewer',
            [
                'label'         => __('Reviewer Name', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control('reviewer_color',
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-reviewer-link' => 'color: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_control('reviewer_hover_color',
            [
                'label'         => __('Hover Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-reviewer-link:hover' => 'color: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'reviewer_typo',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .premium-fb-rev-reviewer-link',
            ]
        );
        
        
        
        $this->add_responsive_control('reviewer_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-content-link-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );
        
        
        $this->end_controls_section();
        
        $this->start_controls_section('date_style',
            [
                'label'         => __('Date', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'date'   => 'yes'
                ]
            ]
        );
        
        $this->add_control('date_color',
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-time .premium-fb-rev-time-text' => 'color: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_control('reviewer_date_color_hover',
            [
                'label'         => __('Hover Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-time .premium-fb-rev-time-text:hover' => 'color: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'date_typo',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .premium-fb-rev-time .premium-fb-rev-time-text',
            ]
        );
        
        $this->add_responsive_control('date_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-time' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('reviewer_txt',
            [
                'label'         => __('Review Content', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'text'   => 'yes'
                ]
            ]
        );
        
        $this->add_control('reviewer_txt_color',
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-text' => 'color: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'reviewer_txt_typo',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .premium-fb-rev-text',
            ]
        );
        
        $this->add_responsive_control('reviewer_txt_margin',
            [
                'label'         => __('Margin', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-text-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('container',
            [
                'label'         => __('Container', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control('container_width',
            [
                'label'         => __('Max Width', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%' ,'em'],
                'range'         => [
                    'px'    => [
                        'min'   => 1,
                        'max'   => 300,
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .elementor-widget-container' => 'max-width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_responsive_control('container_align',
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
                    'default'       => 'center',
                    'selectors'     => [
                        '{{WRAPPER}}' => 'justify-content: {{VALUE}};',
                        ],
                    ]
                );
        
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'          => 'container_background',
                'types'         => [ 'classic' , 'gradient' ],
                'selector'      => '{{WRAPPER}} .premium-fb-rev-container',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'container_border',
                'selector'      => '{{WRAPPER}} .premium-fb-rev-container',
            ]
        );
        
        $this->add_control('container_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%' ,'em'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-container' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'container_box_shadow',
                'selector'      => '{{WRAPPER}} .premium-fb-rev-container',
            ]
        );
        
        $this->add_responsive_control('container_margin',
                [
                    'label'     => __('Margin', 'premium-addons-pro'),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'size_units'=> ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .premium-fb-rev-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );

        $this->add_responsive_control('container_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]      
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('carousel_style',
            [
                'label'         => __('Carousel', 'premium-addons-pro'),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'reviews_carousel'  => 'yes'
                ]
            ]
        );
        
        $this->add_control('arrow_color',
            [
                'label'         => __('Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-container .slick-arrow' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_responsive_control('arrow_size',
            [
                'label'         => __('Size', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%' ,'em'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-container .slick-arrow i' => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_control('arrow_background',
            [
                'label'         => __('Background Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-container .slick-arrow' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        
        $this->add_control('arrow_border_radius',
            [
                'label'         => __('Border Radius', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%' ,'em'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-container .slick-arrow' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_control('arrow_padding',
            [
                'label'         => __('Padding', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%' ,'em'],
                'selectors'     => [
                    '{{WRAPPER}} .premium-fb-rev-container .slick-arrow' => 'padding: {{SIZE}}{{UNIT}};'
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
        
        $settings = $this->get_settings_for_display();
        
        $api_key = $settings['api_key'];
        
        $place_id = $settings['place_id'];
        
        if( 'yes' == $settings['place_info'] && 'yes' == $settings['place_custom_image_switch'] ) {
            
            $image_src = $settings['place_custom_image'];
            
            $image_src_size = Group_Control_Image_Size::get_attachment_image_src( $image_src['id'], 'thumbnail', $settings );
            
            if( empty( $image_src_size ) ) : $image_src_size = $image_src['url']; else: $image_src_size = $image_src_size; endif;
            
            $custom_image = ! empty( $image_src_size ) ? $image_src_size : '';
            
        } else {
            $custom_image = '';
        }
        
        $show_stars = 'yes' == $settings['stars'] ? true : false;
    
        $show_date = 'yes' == $settings['date'] ? true : false;
        
        $date_format = $settings['date_format'];

        $lang_filter = 'yes' == $settings['language'] ? true : false;

        $lang_prefix = $settings['language_prefix'];
        
        
        if( 'inline' == $settings['place_display'] ) {
            $this->add_render_attribute('place_dir','class',[ $settings['place_dir'], 'premium-fb-rev-page' ] );
        } else {
            $this->add_render_attribute('place_dir','class','premium-fb-rev-page');
        }
        
        if( 'inline' == $settings['reviews_display'] ) {
            $this->add_render_attribute('dir','class',[ $settings['reviews_dir'], 'premium-fb-rev-content' ] );
        } else {
            $this->add_render_attribute('dir','class','premium-fb-rev-content');
        }
        
        $page_rate = ( 'yes' == $settings['place_info'] && 'yes' == $settings['place_rate'] ) ? true : false;
        
        $rev_text = 'yes' == $settings['text'] ? true : false;
        
        
        $place_star_size    = ! empty( $settings['place_star_size'] ) ? $settings['place_star_size'] : 16;
        $place_fill_color   = ! empty( $settings['place_fill'] ) ? $settings['place_fill'] : '#6ec1e4';
        $place_empty_color  = ! empty( $settings['place_empty'] ) ? $settings['place_empty'] : '#ccc';
        
        $rev_star_size      = ! empty( $settings['reviews_star_size'] ) ? $settings['reviews_star_size'] : 16;
        $rev_fill_color     = ! empty( $settings['reviews_fill'] ) ? $settings['reviews_fill'] : '#6ec1e4';
        $rev_empty_color    = ! empty( $settings['reviews_empty'] ) ? $settings['reviews_empty'] : '#ccc';
        
        if( 'yes' == $settings['limit'] ){
            if  ( '0' == $settings['limit_num'] ) {
                $limit = 0;
            } else {
                $limit = ! empty( $settings['limit_num'] ) ? $settings['limit_num'] : 5;    
            }
            
        } else {
            $limit = 5;
        }
        
        $response = premium_google_rev_api_rating( $api_key, $place_id );

        if( 'yes' == $settings['filter'] ){
            $min_filter = ! empty( $settings['filter_min'] ) ? $settings['filter_min'] : 1;
            $max_filter = ! empty( $settings['filter_max'] ) ? $settings['filter_max'] : 5;
        } else {
            $min_filter = 1;
            $max_filter = 5;
        }
        
        $response_data      = $response['data'];

        $response_json      = rplg_json_decode($response_data);

        $response_results   = $response_json->result;
        
        $place = $response_results;
        
        if ( isset( $response_results->reviews ) ) {

            $reviews = $response_results->reviews;

            update_option('premium_google_reviews-' . $this->get_id() , $reviews );
            update_option('premium_google_reviews-place-' . $this->get_id() , $place_id );

        } elseif ( ! isset( $response_results->reviews ) && ! empty( $api_key ) && ! empty ( $place_id ) ) {
            
            $stored_id = get_option( 'premium_google_reviews-place-' . $this->get_id() );
            
            if( !empty( $stored_id ) && $stored_id == $place_id ) {
                $reviews = get_option('premium_google_reviews-' . $this->get_id() , array() );
            }
            
        } elseif ( empty( $api_key ) || empty ( $place_id ) ) { ?>
            <div class="premium-fbrev-error">
                <?php echo __('Please Enter a Valid API Key & Place ID','premium-addons-pro'); ?>
            </div>
        <?php
        }

        $rating = 0;
        
        if ( isset( $place->rating ) ){
            
            if ( $place->rating > $rating ) {

            $rating = $place->rating;

            }
        } elseif ( !empty( $reviews ) ) {
            
            if( count( $reviews ) > 0 ) {

            foreach ( $reviews as $review ) {

                $rating = $rating + $review->rating;

            }
                $rating = round( $rating / count( $reviews ), 1 );
                $rating = number_format( (float)$rating, 1, '.', '');
            }
        }
        
        $carousel = 'yes' == $settings['reviews_carousel'] ? true : false;
        $play = 'yes' == $settings['carousel_play'] ? true : false;
        $speed = !empty($settings['carousel_autoplay_speed']) ? $settings['carousel_autoplay_speed'] : 5000;
        
        if ( ! empty( $settings['reviews_columns'] ) ) {
            $reviews_number = intval ( 100 / substr( $settings['reviews_columns'], 0, strpos( $settings['reviews_columns'], '%') ) );
        } else {
            $reviews_number = 2;
        }
        
        
        ?>
    
<div class="premium-fb-rev-container <?php echo 'premium-review-'. $settings['reviews_style']; ?>" data-col="<?php echo esc_attr( $reviews_number ); ?>" data-style="<?php echo esc_attr($settings['reviews_style']); ?>" data-carousel="<?php echo $carousel; ?>" data-play="<?php echo $play; ?>" data-speed="<?php echo $speed; ?>">
    <div class="premium-fb-rev-list">
        <?php if( 'yes' == $settings['place_info'] ) : ?>
        <div <?php echo $this->get_render_attribute_string('place_dir'); ?>>
            
            <div class="prmeium-fb-rev-page-inner">
                <?php premium_google_rev_place($place, $custom_image, $rating, $place_fill_color, $place_empty_color, $show_stars, $place_star_size, $page_rate, $api_key, $this->get_id() ); ?>
            </div>
            
        </div>
        <?php endif; ?>
        
        <div <?php echo $this->get_render_attribute_string('dir'); ?>>
            
            <?php if( !empty( $reviews ) ) : premium_google_rev_reviews($reviews, $rev_fill_color, $rev_empty_color, $show_stars, $rev_star_size, $min_filter, $max_filter, $show_date, $date_format, $limit, $rev_text, $lang_filter, $lang_prefix); endif; ?>
            
        </div>
    </div>
</div>
    <?php
    }
}