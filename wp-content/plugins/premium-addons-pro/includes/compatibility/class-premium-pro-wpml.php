<?php

namespace PremiumAddonsPro\Compatibility\WPML;

use \PremiumAddons\Compatibility\WPML\Premium_Addons_Wpml;

if ( ! defined('ABSPATH') ) exit; // No access of directly access

if ( ! class_exists ( 'Premium_Pro_Wpml' ) ) {
    
    /**
    * Class Premium_Pro_Wpml.
    */
   class Premium_Pro_Wpml {

       /*
        * Instance of the class
        * @access private
        * @since 3.1.9
        */
        private static $instance = null;

       /**
        * Constructor
        */
       public function __construct() {
           
           
           $is_wpml_active = Premium_Addons_Wpml::is_wpml_active();
           
           // WPML String Translation plugin exist check.
           if ( $is_wpml_active ) {
               
               $this->includes();

               add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'translatable_widgets' ] );
           }
       }
        
       /**
        * 
        * Includes
        * 
        * Integrations class for widgets with complex controls.
        *
        * @since 3.1.9
        */
       public function includes() {
    
            include_once( 'widgets/charts.php' );
            include_once( 'widgets/hotspots.php' );
            include_once( 'widgets/multiscroll.php' );
            include_once( 'widgets/tabs.php' );
    
       }

       /**
        * Widgets to translate.
        *
        * @since 3.1.9
        * @param array $widgets Widget array.
        * @return array
        */
       function translatable_widgets( $widgets ) {

           $widgets['premium-behance-feed'] = [
               'conditions' => [ 'widgetType' => 'premium-behance-feed' ],
               'fields'     => [
                   [
                       'field'       => 'username',
                       'type'        => __( 'Behance Feed: Username', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
               ]
           ];
           
           $widgets['premium-chart'] = [
               'conditions' => [ 'widgetType' => 'premium-chart' ],
               'fields'     => [
                   [
                       'field'       => 'x_axis_label',
                       'type'        => __( 'Charts: X-axis Label', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'x_axis_labels',
                       'type'        => __( 'Charts: Data Labels', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'y_axis_label',
                       'type'        => __( 'Charts: Y-axis Label', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'title',
                       'type'        => __( 'Charts: Title', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],   
               ],
               'integration-class' => 'PremiumAddonsPro\Compatibility\WPML\Widgets\Charts',
           ];
           
           $widgets['premium-addon-content-toggle'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-content-toggle' ],
               'fields'     => [
                   [
                       'field'       => 'premium_content_toggle_heading_one',
                       'type'        => __( 'Content Switcher: First Label', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_content_toggle_heading_two',
                       'type'        => __( 'Content Switcher: Second Label', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_content_toggle_first_content_text',
                       'type'        => __( 'Content Switcher: First Content', 'premium-addons-pro' ),
                       'editor_type' => 'AREA',
                   ],
                   [
                       'field'       => 'premium_content_toggle_second_content_text',
                       'type'        => __( 'Content Switcher: Second Content', 'premium-addons-pro' ),
                       'editor_type' => 'AREA',
                   ],
               ]
           ];
           
           $widgets['premium-divider'] = [
               'conditions' => [ 'widgetType' => 'premium-divider' ],
               'fields'     => [
                   [
                       'field'       => 'content_text',
                       'type'        => __( 'Divider: Separator Text', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'content_link_title',
                       'type'        => __( 'Divider: Link Titlte', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
               ]
           ];
           
           $widgets['premium-facebook-feed'] = [
               'conditions' => [ 'widgetType' => 'premium-facebook-feed' ],
               'fields'     => [
                   [
                       'field'       => 'access_token',
                       'type'        => __( 'Facebook Feed: Access Token', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'account_id',
                       'type'        => __( 'Facebook Feed: User ID/Page Slug', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
               ]
           ];
           
           $widgets['premium-facebook-reviews'] = [
               'conditions' => [ 'widgetType' => 'premium-facebook-reviews' ],
               'fields'     => [
                   [
                       'field'       => 'page_name',
                       'type'        => __( 'Facebook Reviews: Page Name', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
               ]
           ];
           
           $widgets['premium-addon-flip-box'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-flip-box' ],
               'fields'     => [
                   [
                       'field'       => 'premium_flip_paragraph_header',
                       'type'        => __( 'Flip Box: Front Title', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_flip_back_paragraph_header',
                       'type'        => __( 'Flip Box: Back Title', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_flip_paragraph_text',
                       'type'        => __( 'Flip Box: Front Description', 'premium-addons-pro' ),
                       'editor_type' => 'AREA',
                   ],
                   [
                       'field'       => 'premium_flip_back_paragraph_text',
                       'type'        => __( 'Flip Box: Back Description', 'premium-addons-pro' ),
                       'editor_type' => 'AREA',
                   ],
                   [
                       'field'       => 'premium_flip_back_link_text',
                       'type'        => __( 'Flip Box: Link Text', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   'premium_flip_back_link' => [
                       'field'       => 'url',
                       'type'        => __( 'Flip Box: URL', 'premium-addons-pro' ),
                       'editor_type' => 'LINK',
                   ],
               ]
           ];
           
           $widgets['premium-google-reviews'] = [
               'conditions' => [ 'widgetType' => 'premium-google-reviews' ],
               'fields'     => [
                   [
                       'field'       => 'api_key',
                       'type'        => __( 'Google Reviews: API Key', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'place_id',
                       'type'        => __( 'Google Reviews: Place ID', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'language_prefix',
                       'type'        => __( 'Google Reviews: Language Prefix', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
               ]
           ];
           
           $widgets['premium-addon-icon-box'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-icon-box' ],
               'fields'     => [
                   [
                       'field'       => 'premium_icon_box_title',
                       'type'        => __( 'Icon Box: Title', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_icon_box_content',
                       'type'        => __( 'Icon Box: Description', 'premium-addons-pro' ),
                       'editor_type' => 'AREA',
                   ],
                   [
                       'field'       => 'premium_icon_box_more_text',
                       'type'        => __( 'Icon Box: Read More Text', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   'premium_icon_box_link' => [
                       'field'       => 'url',
                       'type'        => __( 'Icon Box: URL', 'premium-addons-pro' ),
                       'editor_type' => 'LINK',
                   ],
               ]
           ];
           
           $widgets['premium-ihover'] = [
               'conditions' => [ 'widgetType' => 'premium-ihover' ],
               'fields'     => [
                   [
                       'field'       => 'premium_ihover_thumbnail_link_text',
                       'type'        => __( 'iHover: Link Title', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_ihover_thumbnail_back_title',
                       'type'        => __( 'iHover: Title', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_ihover_thumbnail_back_description',
                       'type'        => __( 'iHover: Description Text', 'premium-addons-pro' ),
                       'editor_type' => 'AREA',
                   ],
                   'premium_ihover_thumbnail_url' => [
                       'field'       => 'url',
                       'type'        => __( 'iHover: URL', 'premium-addons-pro' ),
                       'editor_type' => 'LINK',
                   ],
               ]
           ];
           
           $widgets['premium-addon-image-comparison'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-image-comparison' ],
               'fields'     => [
                   [
                       'field'       => 'premium_img_compare_original_img_label',
                       'type'        => __( 'Image Comparison: First Label', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_image_comparison_modified_image_label',
                       'type'        => __( 'Image Comparison: Second Label', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
               ]
           ];
           
           $widgets['premium-addon-image-hotspots'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-image-hotspots' ],
               'integration-class' => 'PremiumAddonsPro\Compatibility\WPML\Widgets\Hotspots',
           ];
           
           $widgets['premium-addon-magic-section'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-magic-section' ],
               'fields'     => [
                   [
                       'field'       => 'premium_magic_section_content',
                       'type'        => __( 'Magic Section: Content', 'premium-addons-pro' ),
                       'editor_type' => 'AREA',
                   ],
                   [
                       'field'       => 'premium_magic_section_button_text',
                       'type'        => __( 'Magic Section: Button Text', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
               ]
           ];
           
           $widgets['premium-multi-scroll'] = [
               'conditions' => [ 'widgetType' => 'premium-multi-scroll' ],
               'fields'     => [
                   [
                       'field'       => 'dots_tooltips',
                       'type'        => __( 'Multi Scroll: Dots Tooltips Text', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
               ],
               'integration-class' => 'PremiumAddonsPro\Compatibility\WPML\Widgets\MultiScroll',
           ];
           
           $widgets['premium-notbar'] = [
               'conditions' => [ 'widgetType' => 'premium-notbar' ],
               'fields'     => [
                   [
                       'field'       => 'premium_notbar_content_temp',
                       'type'        => __( 'Alert Box: Content Template ID', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_notbar_text',
                       'type'        => __( 'Alert Box: Content Text', 'premium-addons-pro' ),
                       'editor_type' => 'AREA',
                   ],
                   [
                       'field'       => 'premium_notbar_close_text',
                       'type'        => __( 'Alert Box: Close Button Text', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
               ],
           ];
           
           $widgets['premium-addon-preview-image'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-preview-image' ],
               'fields'     => [
                   [
                       'field'       => 'premium_preview_image_alt',
                       'type'        => __( 'Preview Window: Image Alt', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_preview_image_caption',
                       'type'        => __( 'Preview Window: Caption', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_preview_image_title',
                       'type'        => __( 'Preview Window: Title', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_preview_image_desc',
                       'type'        => __( 'Preview Window: Description', 'premium-addons-pro' ),
                       'editor_type' => 'AREA',
                   ],
                   'premium_preview_image_link' => [
                       'field'       => 'url',
                       'type'        => __( 'Preview Window: URL', 'premium-addons-pro' ),
                       'editor_type' => 'LINK',
                   ],
               ],
           ];
           
           $widgets['premium-addon-tabs'] = [
               'conditions' => [ 'widgetType' => 'premium-addon-tabs' ],
               'integration-class' => 'PremiumAddonsPro\Compatibility\WPML\Widgets\Tabs',
           ];
           
           $widgets['premium-unfold-addon'] = [
               'conditions' => [ 'widgetType' => 'premium-unfold-addon' ],
               'fields'     => [
                   [
                       'field'       => 'premium_unfold_title',
                       'type'        => __( 'Unfold: Title', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_unfold_content',
                       'type'        => __( 'Unfold: Content', 'premium-addons-pro' ),
                       'editor_type' => 'AREA',
                   ],
                   [
                       'field'       => 'premium_unfold_button_fold_text',
                       'type'        => __( 'Unfold: Unfold Text', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'premium_unfold_button_unfold_text',
                       'type'        => __( 'Unfold: Fold Text', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
               ],
           ];
           
           $widgets['premium-whatsapp-chat'] = [
               'conditions' => [ 'widgetType' => 'premium-whatsapp-chat' ],
               'fields'     => [
                   [
                       'field'       => 'number',
                       'type'        => __( 'Whatsapp: Phone Number', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'group_id',
                       'type'        => __( 'Whatsapp: Group ID', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'button_text',
                       'type'        => __( 'Whatsapp: Button Text', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
                   [
                       'field'       => 'tooltips_msg',
                       'type'        => __( 'Whatsapp: Tooltip Text', 'premium-addons-pro' ),
                       'editor_type' => 'LINE',
                   ],
               ],
           ];
           
           return $widgets;
       }
       
       /**
        * Creates and returns an instance of the class
        * 
        * @since 1.4.8
        * @access public
        * 
        * @return object
        */
        public static function get_instance() {
            if( self::$instance == null ) {
                self::$instance = new self;
            }
            return self::$instance;
        }
       
   }
 
}

if( ! function_exists('premium_pro_wpml') ) {
    
    /**
     * 
     * Triggers `get_instance` method
     * 
     * @since 1.4.8
     * @access public
     * 
     * @return object
     * 
     */
    function premium_pro_wpml() {
        
        Premium_Pro_Wpml::get_instance();
        
    }
    
}
premium_pro_wpml();