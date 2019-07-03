<?php

namespace PremiumAddonsPro\Includes\White_Label;

if( ! defined('ABSPATH') ) exit;

/**
 * Contains White Label functions
 * @since 1.0.0
 */
class Helper {
   
    /**
     * Return plugin pro version author name
     * @since 1.0.0
     * @access public
     * @return string
     */
    public static function author_pro(){
        if(isset(get_option('pa_wht_lbl_save_settings')['premium-wht-lbl-name-pro'])){
            $author_pro = get_option('pa_wht_lbl_save_settings')['premium-wht-lbl-name-pro'];
        }
        
        return ( isset($author_pro) && '' != $author_pro ) ? $author_pro : 'Leap13';
    }
    
    /**
     * Return plugin pro version name
     * @since 1.0.0
     * @access public
     * @return string
     */
    public static function name_pro(){
        if(isset(get_option('pa_wht_lbl_save_settings')['premium-wht-lbl-plugin-name-pro'])){
            $name_pro = get_option('pa_wht_lbl_save_settings')['premium-wht-lbl-plugin-name-pro'];
        }
        
        return ( isset($name_pro) && '' != $name_pro ) ? $name_pro : 'Premium Addons PRO for Elementor';
    }
    
    /**
     * Check if show plugin license tab is enabled
     * @since 1.0.0
     * @access public
     * @return boolean
     */
    public static function is_show_license(){
        if(isset(get_option('pa_wht_lbl_save_settings')['premium-wht-lbl-license'])){
            $show_license = get_option('pa_wht_lbl_save_settings')['premium-wht-lbl-license'];
        }
        
        return isset( $show_license ) ? $show_license : false;
    }
    
    /**
     * Check if license if valid
     * @since 1.0.0
     * @access public
     * @return boolean
     */
    public static function is_lic_act(){
        $license_status = get_option( 'papro_license_status' );
        return ( 'valid' == $license_status ) ? true : false;
    }
    
}