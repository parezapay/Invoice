<?php

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
use Elementor\Group_Control_Css_Filter;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Premium_Instagram_Feed extends Widget_Base {

    public function get_name() {
        return 'premium-addon-instagram-feed';
    }

    public function get_title() {
		return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __('Instagram Feed', 'premium-addons-pro') );
	}
    
    public function is_reload_preview_required() {
        return true;
    }
    
    public function get_style_depends() {
        return [
            'pa-prettyphoto',
        ];
    }
    
    public function get_script_depends() {
        return [
            'imagesloaded',
            'prettyPhoto-js',
            //'masonry-js',
            'isotope-js',
            'instafeed-js',
            'premium-pro-js',
        ];
    }

    public function get_icon() {
        return 'pa-pro-instagram-feed';
    }

    public function get_categories() {
        return [ 'premium-elements' ];
    }

    // Adding the controls fields for the premium instagram feed
    // This will controls the animation, colors and background, dimensions etc
    protected function _register_controls() {
        
       /*Start General Settings Section*/
        $this->start_controls_section('premium_instagram_feed_general_settings_section',
                [
                    'label'         => __('Access Credentials', 'premium-addons-pro')
                    ]
                );
        
        /*Client ID*/
        $this->add_control('premium_instagram_feed_client_id',
                [
                    'label'         => __('Client ID', 'premium-addons-pro'),
                    'type'          => Controls_Manager::TEXT,
                    'dynamic'       => [ 'active' => true ],
                    'default'       => '8f051adcfa134a18bd6afecc7521ef44',
                    'label_block'   => false,
                    'description'   => '<a href="https://www.instagram.com/developer/" target="_blank">Get Client ID</a> by creating a new app or selecting an existing app ',
                    ]
                );
                
        /*Access Token*/
        $this->add_control('premium_instagram_feed_client_access_token',
                [
                    'label'         => __('Access Token', 'premium-addons-pro'),
                    'type'          => Controls_Manager::TEXT,
                    'dynamic'       => [ 'active' => true ],
                    'default'       => '2075884021.1677ed0.2fd28d5d3abf45d4a80534bee8376f4c',
                    'label_block'   => false,
                    'description'   => '<a href="http://instagram.pixelunion.net/" target="_blank">Get Access Token</a> by creating a new app or selecting an existing app ',
                    ]
                );
        
        /*Search For userID*/
        $this->add_control('premium_instagram_feed_user_id',
                [
                    'label'         => __('User Id', 'premium-addons-pro'),
                    'type'          => Controls_Manager::TEXT,
                    'dynamic'       => [ 'active' => true ],
                    'default'       => '2075884021',
                    'label_block'   => false,
                    'description'   => 'Click <a href="https://codeofaninja.com/tools/find-instagram-user-id" target="_blank">Here</a> to get User ID',
                    ]
                );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_instagram_feed_query_section',
                [
                    'label'             => __('Queries', 'premium-addons-pro')
                ]);
        
        /*Search For*/
        $this->add_control('premium_instagram_feed_search_for',
                [
                    'label'             => __('Search for:', 'premium-addons-pro'),
                    'type'              => Controls_Manager::SELECT,
                    'options'           => [
                        'user'      => __('User', 'premium-addons-pro'),
                        'location'  => __('Location', 'premium-addons-pro'),
                        'tagged'    => __('Tag', 'premium-addons-pro'),
                    ],
                    'default'           => 'user',
                ]
                );
        
        /*Search For Location id*/
        $this->add_control('premium_instagram_feed_location_id',
                [
                    'label'         => __('Location Id', 'premium-addons-pro'),
                    'type'          => Controls_Manager::TEXT,
                    'dynamic'       => [ 'active' => true ],
                    'label_block'   => false,
                    'default'       => '6889842',
                    'description'   => 'Click <a href="http://docs.social-streams.com/article/118-find-instagram-location-id" target="_blank">Here</a> to find how to get location ID',
                    'condition'     => [
                        'premium_instagram_feed_search_for' => 'location',
                        ]
                    ]
                );
        
        /*Search For Location id*/
        $this->add_control('premium_instagram_feed_tag_name',
                [
                    'label'         => __('Tag Name', 'premium-addons-pro'),
                    'type'          => Controls_Manager::TEXT,
                    'dynamic'       => [ 'active' => true ],
                    'label_block'   => false,
                    'default'       => 'sport',
                    'condition'     => [
                        'premium_instagram_feed_search_for' => 'tagged',
                        ]
                    ]
                );
        
        /*Images Sort By*/
        $this->add_control('premium_instagram_feed_sort_by',
                [
                    'label'             => __('Sort By:', 'premium-addons-pro'),
                    'type'              => Controls_Manager::SELECT,
                    'options'           => [
                        'none'              => __('none', 'premium-addons-pro'),
                        'most-recent'       => __('Most Recent', 'premium-addons-pro'),
                        'least-recent'      => __('Least Recent', 'premium-addons-pro'),
                        'most-liked'        => __('Most Liked', 'premium-addons-pro'),
                        'least-liked'       => __('Least Liked', 'premium-addons-pro'),
                        'most-commented'    => __('Most Commented', 'premium-addons-pro'),
                        'least-commented'   => __('Least Commented', 'premium-addons-pro'),
                        'random'            => __('Random', 'premium-addons-pro'),
                    ],
                    'default'           => 'none',
                ]
                );
        
        $this->add_control('premium_instagram_feed_link',
			[
				'label'                 => __( 'Enable Redirection', 'premium-addons-pro' ),
				'type'                  => Controls_Manager::SWITCHER,
                'description'           => __('Redirect to Photo Link on Instgram','premium-addons-pro'),
			]
		);

		$this->add_control('premium_instagram_feed_new_tab',
			[
				'label'                 => __( 'Open in a New Tab', 'premium-addons-pro' ),
				'type'                  => Controls_Manager::SWITCHER,
                'condition'             => [
                    'premium_instagram_feed_link'   => 'yes'
                ]
			]
		);
        
        $this->add_control('premium_instagram_feed_popup',
			[
				'label'                 => __( 'Lightbox', 'premium-addons-pro' ),
				'type'                  => Controls_Manager::SWITCHER,
                'description'           => __('Modal image works only on the frontend', 'premium-addons-pro'),
                'condition'             => [
                    'premium_instagram_feed_link!'   => 'yes'
                ]
			]
		);
        
        $this->add_control('premium_instagram_feed_show_likes',
			[
				'label'                 => __( 'Show Likes', 'premium-addons-pro' ),
				'type'                  => Controls_Manager::SWITCHER,
			]
		);
        
        $this->add_control('premium_instagram_feed_show_comments',
			[
				'label'                 => __( 'Show Comments', 'premium-addons-pro' ),
				'type'                  => Controls_Manager::SWITCHER,
			]
		);
        
        $this->add_control('premium_instagram_feed_show_caption',
			[
				'label'                 => __( 'Show Caption', 'premium-addons-pro' ),
				'type'                  => Controls_Manager::SWITCHER,
			]
		);
        
        /*End General Settings Section*/
        $this->end_controls_section();
        
        /*Start Layout Settings*/
        $this->start_controls_section('premium_instagram_feed_layout_settings_section',
            [
                'label'             => __('Layout', 'premium-addons-pro'),
            ]);
        
        /*Number of Images*/
        $this->add_control('premium_instagram_feed_img_number',
                [
                    'label'             => __('Maximum Images Number', 'premium-addons-pro'),
                    'type'              => Controls_Manager::NUMBER,
                    'default'           => 6,
                ]
                );
        
        /*Image Resolution*/
        $this->add_control('premium_instagram_feed_resolution',
                [
                    'label'             => __('Image Resolution', 'premium-addons-pro'),
                    'type'              => Controls_Manager::SELECT,
                    'options'           => [
                        'thumbnail'             => __('Thumbnail (150x150)', 'premium-addons-pro'),
                        'low_resolution'        => __('Low (306x306)', 'premium-addons-pro'),
                        'standard_resolution'   => __('Standard (612x612)', 'premium-addons-pro'),
                        
                    ],
                    'default'           => 'standard_resolution',
                ]
                );
        
        $this->add_control('premium_instagram_feed_masonry',
			[
				'label'                 => __( 'Masonry', 'premium-addons-pro' ),
				'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes'
			]
		);
        
        $this->add_responsive_control('premium_instagram_feed_column_number',
            [
                'label'             => __('Images per Row', 'premium-addons-pro'),
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
                'selectors'         => [
                    '{{WRAPPER}} .premium-insta-feed' => 'width: {{VALUE}}'
                ],
            ]
        );
        
        /*Hover Image Effect*/ 
        $this->add_control('premium_instagram_feed_image_hover',
                [
                    'label'         => __('Hover Image Effect', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SELECT,
                    'options'       => [
                        'none'   => __('None', 'premium-addons-pro'),
                        'zoomin' => __('Zoom In', 'premium-addons-pro'),
                        'zoomout'=> __('Zoom Out', 'premium-addons-pro'),
                        'scale'  => __('Scale', 'premium-addons-pro'),
                        'gray'   => __('Grayscale', 'premium-addons-pro'),
                        'blur'   => __('Blur', 'premium-addons-pro'),
                        'sepia'  => __('Sepia', 'premium-addons-pro'),
                        'bright' => __('Brightness', 'premium-addons-pro'),
                        'trans'  => __('Translate', 'premium-addons-pro'),
                    ],
                    'default'       => 'zoomin',
                    'label_block'   => true
                ]
                );
        
        /*End Account Settings Section*/
        $this->end_controls_section();
        
        /*Start Tweet Box Section*/
        $this->start_controls_section('premium_instgram_feed_photo_box_style',
                [
                    'label'             => __('Photo Box','premium-addons-pro'),
                    'tab'               => Controls_Manager::TAB_STYLE,
                    ]
            );
        
        $this->add_responsive_control('premium_instgram_feed_image_height',
                [
                    'label'         => __('Image Height', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px',"em"],
                    'range'             => [
                        'px'    => [
                            'min' => 50, 
                            'max' => 500,
                            ],
                        'em'    => [
                            'min' => 1, 
                            'max' => 100,
                        ]
                    ],
                    'default'       => [
                        'size'  => 300,
                        'unit'  => 'px'
                    ],
                    'condition'     => [
                        'premium_instagram_feed_masonry!'    => 'yes'
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-img-wrap img' => 'height: {{SIZE}}{{UNIT}};'
                        ]
                    ]
                );
        
        $this->start_controls_tabs( 'premium_instgram_feed_tweet_box' );
        
        $this->start_controls_tab('premium_instgram_feed_photo_box_normal',
            [
                'label'             => __('Normal', 'premium-addons-pro'),
            ]
            );
        
        /*Tweet Box Border*/
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_instgram_feed_photo_box_border',
                    'selector'      => '{{WRAPPER}} .premium-insta-img-wrap',
                ]
                );
        
        /*Tweet Box Border Radius*/
        $this->add_control('premium_instgram_feed_photo_box_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'default'       => [
                        'unit'  => 'px',
                        'size'  => 0,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-img-wrap' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        /*Tweet Box Shadow*/    
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'label'         => __('Shadow','premium-addons-pro'),
                    'name'          => 'premium_instgram_feed_photo_box_shadow',
                    'selector'      => '{{WRAPPER}} .premium-insta-img-wrap',
                ]
                );
        
        $this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .premium-insta-img-wrap img',
			]
		);
        
         /*Tweet Box Margin*/
        $this->add_responsive_control('premium_instgram_feed_photo_box_margin',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-img-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
                
        /*Tweet Box Padding*/
        $this->add_responsive_control('premium_instgram_feed_photo_box_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-img-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->end_controls_tab();


        $this->start_controls_tab('premium_instgram_feed_photo_box_hover',
            [
                'label'             => __('Hover', 'premium-addons-pro'),
            ]
            );
        
        $this->add_control('premium_instgram_feed_overlay_background', 
                [
                    'label'         => __('Overlay Background', 'premium-addons-pro'),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-info-wrap' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );
                
        /*Tweet Box Border*/
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_instgram_feed_photo_box_border_hover',
                    'selector'      => '{{WRAPPER}} .premium-insta-feed-wrap:hover .premium-insta-img-wrap',
                ]
                );
        
        /*Tweet Box Border Radius*/
        $this->add_control('premium_instgram_feed_photo_box_border_radius_hover',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'default'       => [
                        'unit'  => 'px',
                        'size'  => 0,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-feed-wrap:hover .premium-insta-img-wrap' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        /*Tweet Box Shadow*/
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'label'         => __('Shadow','premium-addons-pro'),
                    'name'          => 'premium_instgram_feed_photo_box_shadow_hover',
                    'selector'      => '{{WRAPPER}} .premium-insta-feed-wrap:hover .premium-insta-img-wrap',
                ]
                );
        
        $this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .premium-insta-feed-wrap:hover img',
			]
		);
        
        /*Tweet Box Margin*/
        $this->add_responsive_control('premium_instgram_feed_photo_box_margin_hover',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-feed-wrap:hover .premium-insta-img-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
 
        $this->end_controls_tab();

        $this->end_controls_tabs();
            
        /*End Tweet Box Section*/
        $this->end_controls_section();

        $this->start_controls_section('premium_instgram_feed_photo_likes_style',
            [
                'label'             => __('Likes','premium-addons-pro'),
                'tab'               => Controls_Manager::TAB_STYLE,
                'condition'         => [
                    'premium_instagram_feed_show_likes' => 'yes'
                ]
            ]
        );
        
        $this->start_controls_tabs( 'premium_instgram_feed_likes' );
        
        $this->start_controls_tab('premium_instgram_feed_likes_icon',
            [
                'label'             => __('Icon', 'premium-addons-pro'),
            ]
            );

        /*Likes Icon Color*/
        $this->add_control('premium_instgram_feed_likes_color', 
                [
                    'label'         => __('Icon Color', 'premium-addons-pro'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme' => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                        ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-heart' => 'color: {{VALUE}};',
                        ],
                    ]
                );

        /*Likes Icon Size*/
        $this->add_responsive_control('premium_instgram_feed_likes_size',
                [
                    'label'         => __('Size', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px',"em"],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-heart' => 'font-size: {{SIZE}}{{UNIT}};'
                        ]
                    ]
                );
        
        $this->add_control('premium_instgram_feed_likes_background', 
                [
                    'label'         => __('Background Color', 'premium-addons-pro'),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-heart' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_instgram_feed_likes_border',
                    'selector'      => '{{WRAPPER}} .premium-insta-heart',
                ]
                );
        
        /*Container Border Radius*/
        $this->add_control('premium_instgram_feed_likes_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'default'       => [
                        'unit'  => 'px',
                        'size'  => 0,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-heart' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        /*Container Box Shadow*/
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'label'         => __('Shadow','premium-addons-pro'),
                    'name'          => 'premium_instgram_feed_likes_shadow',
                    'selector'      => '{{WRAPPER}} .premium-insta-heart',
                ]
                );
        
        $this->add_responsive_control('premium_instgram_feed_likes_margin',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-heart' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
                
        /*Container Padding*/
        $this->add_responsive_control('premium_instgram_feed_likes_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-heart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->end_controls_tab();
        
        $this->start_controls_tab('premium_instgram_feed_likes_number',
            [
                'label'             => __('Number', 'premium-addons-pro'),
            ]
            );
        
        /*Likes Number Color*/
        $this->add_control('premium_instgram_feed_likes_number_color', 
                [
                    'label'         => __('Color', 'premium-addons-pro'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme' => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                        ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-likes' => 'color: {{VALUE}};',
                        ],
                    ]
                );
        
        /*Likes Number Typography*/
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'          => 'premium_instgram_feed_likes_number_type',
                    'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'      => '{{WRAPPER}} .premium-insta-likes',
                    ]
                );
        
        $this->add_control('premium_instgram_feed_likes_number_background', 
                [
                    'label'         => __('Background Color', 'premium-addons-pro'),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}}  .premium-insta-likes' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_instgram_feed_likes_number_border',
                    'selector'      => '{{WRAPPER}} .premium-insta-likes',
                ]
                );
        
        /*Container Border Radius*/
        $this->add_control('premium_instgram_feed_likes_number_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'default'       => [
                        'unit'  => 'px',
                        'size'  => 0,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-likes' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        /*Container Box Shadow*/
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'label'         => __('Shadow','premium-addons-pro'),
                    'name'          => 'premium_instgram_feed_likes_number_shadow',
                    'selector'      => '{{WRAPPER}} .premium-insta-likes',
                ]
                );
        
        $this->add_responsive_control('premium_instgram_feed_likes_number_margin',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-likes' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
                
        /*Container Padding*/
        $this->add_responsive_control('premium_instgram_feed_likes_number_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-likes' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_instgram_feed_photo_comments_style',
            [
                'label'             => __('Comments','premium-addons-pro'),
                'tab'               => Controls_Manager::TAB_STYLE,
                'condition'         => [
                    'premium_instagram_feed_show_comments' => 'yes'
                ]
            ]
        );
        
        $this->start_controls_tabs( 'premium_instgram_feed_comments' );
        
        $this->start_controls_tab('premium_instgram_feed_comments_icon',
            [
                'label'             => __('Icon', 'premium-addons-pro'),
            ]
            );

        /*Likes Icon Color*/
        $this->add_control('premium_instgram_feed_comment_color', 
                [
                    'label'         => __('Color', 'premium-addons-pro'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme' => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                        ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-comment' => 'color: {{VALUE}};',
                        ],
                    ]
                );

        /*Likes Icon Size*/
        $this->add_responsive_control('premium_instgram_feed_comment_size',
                [
                    'label'         => __('Size', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px',"em"],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-comment' => 'font-size: {{SIZE}}{{UNIT}};'
                        ]
                    ]
                );
        
        $this->add_control('premium_instgram_feed_comment_background', 
                [
                    'label'         => __('Background Color', 'premium-addons-pro'),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-comment' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_instgram_feed_comments_border',
                    'selector'      => '{{WRAPPER}} .premium-insta-comment',
                ]
                );
        
        /*Likes Border Radius*/
        $this->add_control('premium_instgram_feed_comment_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'default'       => [
                        'unit'  => 'px',
                        'size'  => 0,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-comment' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        /*Likes Box Shadow*/
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'label'         => __('Shadow','premium-addons-pro'),
                    'name'          => 'premium_instgram_feed_comments_shadow',
                    'selector'      => '{{WRAPPER}} .premium-insta-comment',
                ]
                );
        
        $this->add_responsive_control('premium_instgram_feed_comments_margin',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-comment' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
                
        /*Likes Padding*/
        $this->add_responsive_control('premium_instgram_feed_comments_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-comment' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->end_controls_tab();
        
        $this->start_controls_tab('premium_instgram_feed_comments_number',
            [
                'label'             => __('Number', 'premium-addons-pro'),
            ]
            );
        
        /*Likes Number Color*/
        $this->add_control('premium_instgram_feed_comments_number_color', 
                [
                    'label'         => __('Color', 'premium-addons-pro'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme' => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                        ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-comments' => 'color: {{VALUE}};',
                        ],
                    ]
                );
        
        /*Likes Number Typography*/
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'          => 'premium_instgram_feed_comments_number_typo',
                    'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'      => '{{WRAPPER}} .premium-insta-comments',
                    ]
                );
        
        $this->add_control('premium_instgram_feed_comments_number_background', 
                [
                    'label'         => __('Background Color', 'premium-addons-pro'),
                    'type'          => Controls_Manager::COLOR,
                    'selectors'     => [
                        '{{WRAPPER}}  .premium-insta-comments' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_instgram_feed_comments_number_border',
                    'selector'      => '{{WRAPPER}} .premium-insta-comments',
                ]
                );
        
        $this->add_control('premium_instgram_feed_comments_number_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'default'       => [
                        'unit'  => 'px',
                        'size'  => 0,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-comments' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
                [
                    'label'         => __('Shadow','premium-addons-pro'),
                    'name'          => 'premium_instgram_feed_comments_number_shadow',
                    'selector'      => '{{WRAPPER}} .premium-insta-comments',
                ]
                );
        
        $this->add_responsive_control('premium_instgram_feed_comments_number_margin',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-comments' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->add_responsive_control('premium_instgram_feed_comments_number_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-insta-comments' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_instgram_feed_caption',
            [
                'label'             => __('Caption','premium-addons-pro'),
                'tab'               => Controls_Manager::TAB_STYLE,
                'condition'         => [
                    'premium_instagram_feed_show_caption' => 'yes'
                ]   
            ]
        );
        
        $this->add_control('premium_instgram_feed_caption_color', 
            [
                'label'         => __('Text Color', 'premium-addons-pro'),
                'type'          => Controls_Manager::COLOR,
                'scheme' => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
            'selectors'     => [
                    '{{WRAPPER}} .premium-insta-image-caption' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'premium_instgram_feed_caption_typo',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .premium-insta-image-caption'
            ]
        );
        
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'          => 'premium_instgram_feed_caption_shadow',
                'selector'      => '{{WRAPPER}} .premium-insta-image-caption'
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_instgram_feed_general_style',
                [
                    'label'             => __('Container','premium-addons-pro'),
                    'tab'               => Controls_Manager::TAB_STYLE,
                    ]
            );
            
        $this->add_control('premium_instgram_feed_container_background', 
                [
                    'label'         => __('Background', 'premium-addons-pro'),
                    'type'          => Controls_Manager::COLOR,
    				'scheme' => [
					    'type'  => Scheme_Color::get_type(),
					    'value' => Scheme_Color::COLOR_1,
					    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-instafeed-container' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );
        
        $this->add_group_control(
            Group_Control_Border::get_type(), 
                [
                    'name'          => 'premium_instgram_feed_container_box_border',
                    'selector'      => '{{WRAPPER}} .premium-instafeed-container',
                ]
                );
        
        $this->add_control('premium_instgram_feed_container_box_border_radius',
                [
                    'label'         => __('Border Radius', 'premium-addons-pro'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%' ,'em'],
                    'default'       => [
                        'unit'  => 'px',
                        'size'  => 0,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-instafeed-container' => 'border-radius: {{SIZE}}{{UNIT}};'
                    ]
                ]
                );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'name'          => 'premium_instgram_feed_container_box_shadow',
                    'selector'      => '{{WRAPPER}} .premium-instafeed-container',
                ]
                );
        
        $this->add_responsive_control('premium_instgram_feed_container_margin',
                [
                    'label'         => __('Margin', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-instafeed-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
                
        $this->add_responsive_control('premium_instgram_feed_container_padding',
                [
                    'label'         => __('Padding', 'premium-addons-pro'),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => ['px', 'em', '%'],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-instafeed-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]);
        
        $this->end_controls_section();
        
    }
    
    protected function render()
    {
        // get our input from the widget settings.
        $settings = $this->get_settings_for_display();
        
        $get_from = $settings['premium_instagram_feed_search_for'];
        
        $hover_effect = 'premium-insta-' . $settings['premium_instagram_feed_image_hover'];
        
        $new_tab = $settings['premium_instagram_feed_new_tab'] == 'yes' ? 'target="_blank"' : '' ;
        if($settings['premium_instagram_feed_link'] == 'yes') {
            $link = '<a href="{{link}}"' . $new_tab . '></a>';
        } else {
            if($settings['premium_instagram_feed_popup'] == 'yes') {
                $link = '<a href="{{image}}" data-rel="prettyPhoto[premium-insta-' . esc_attr( $this->get_id() ) . ']"></a>';
            } else {
                $link = '';
            }
        }
        
        if($settings['premium_instagram_feed_show_likes'] == 'yes') {
            $likes = '<p> <i class="fa fa-heart premium-insta-heart" aria-hidden="true"></i> <span  class="premium-insta-likes">{{likes}}</span></p>';
        } else {
            $likes = '';
        }
        
        if($settings['premium_instagram_feed_show_comments'] == 'yes') {
            $comments = '<p><i class="fa fa-comment premium-insta-comment" aria-hidden="true"></i><span class="premium-insta-comments">{{comments}}</span></p>';
        } else {
            $comments = '';
        }
        
        if($settings['premium_instagram_feed_show_caption'] == 'yes') {
            $caption = '<p class="premium-insta-image-caption">{{model.caption.text}}</p>';
        } else {
            $caption = '';
        }
        
        $client_id = !empty( $settings['premium_instagram_feed_client_id'] ) ? $settings['premium_instagram_feed_client_id'] : '';
        $access_token = !empty( $settings['premium_instagram_feed_client_access_token'] ) ? $settings['premium_instagram_feed_client_access_token'] : '';
        $location = !empty( $settings['premium_instagram_feed_location_id'] ) ? $settings['premium_instagram_feed_location_id'] : '';
        $user = !empty( $settings['premium_instagram_feed_user_id'] ) ? $settings['premium_instagram_feed_user_id'] : '';
        $tag = !empty( $settings['premium_instagram_feed_tag_name'] ) ? $settings['premium_instagram_feed_tag_name'] : '';
        $sort = $settings['premium_instagram_feed_sort_by'];
        $res = $settings['premium_instagram_feed_resolution'];
        $limit  = !empty( $settings['premium_instagram_feed_img_number'] ) ? $settings['premium_instagram_feed_img_number'] : 6;
        $instagram_settings = [
            'clientId'      => $client_id,
            'accesstok'     => $access_token,
            'get'           => $get_from,
            'location'      => $location,
            'user'          => $user,
            'tag'           => $tag,
            'sort'          => $sort,
            'limit'         => $limit,
            'res'           => $res,
            'likes'         => $likes,
            'comments'      => $comments,
            'description'   => $caption,
            'link'          => $link,
            'id'            => 'premium-instafeed-container-' . $this->get_id(),
            'masonry'       => ( $settings['premium_instagram_feed_masonry'] == 'yes' ) ? true : false
        ];
        
        $this->add_render_attribute( 'instagram', 'class', 'premium-instafeed-container' );
        
        $this->add_render_attribute( 'instagram', 'data-settings', wp_json_encode( $instagram_settings ) );
        
        $this->add_render_attribute( 'instagram_container', 'id', 'premium-instafeed-container-' . $this->get_id() );
        
        $this->add_render_attribute( 'instagram_container', 'class', [ 'premium-insta-grid', $hover_effect ] );
        
        if( empty ( $settings['premium_instagram_feed_client_id'] ) || empty ( $settings['premium_instagram_feed_client_access_token'] ) ) : ?>
            <div class="premium-fbrev-error">
                    <?php echo __('Please fill the required fields: Consumer Key & Consumer Secret','premium-addons-pro'); ?>
            </div>
        <?php else: ?>
            <div <?php echo $this->get_render_attribute_string('instagram'); ?>>
                <div <?php echo $this->get_render_attribute_string('instagram_container'); ?>></div>
                <div class="premium-loading-feed">
                    <div class="premium-loader"></div>
                </div>
            </div>

        <?php
        
        endif;
    }
}