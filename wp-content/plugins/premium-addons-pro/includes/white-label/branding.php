<?php

namespace PremiumAddonsPro\Includes\White_Label;

if( ! defined('ABSPATH') ) exit;

if ( ! class_exists( 'PA_White_Label' ) ) {
    
    final class Branding {
    
        public static function init() {
            add_action('after_setup_theme', __CLASS__ . '::pa_init_hooks');
        }

        public static function pa_init_hooks() {
            
            if( ! is_admin() ) {
                return;
            }
            
            add_filter('all_plugins', __CLASS__ . '::pa_plugins_page');
            add_filter( 'plugin_row_meta', __CLASS__ . '::pa_meta_data', 10, 2 );
            
        }
        
        static public function pa_meta_data($plugin_meta, $plugin_file) {
            
            $settings = self::pa_white_label_settings();
            
            $url = $settings['premium-wht-lbl-url'];
            
            if( $plugin_file === PREMIUM_ADDONS_BASENAME && ! empty( $url ) ) {
                $plugin_meta[2] = '';
                $row_meta = [
				'docs' => '<a href="' . $url . '"'. 'title="' . esc_attr( __( 'Visit Plugin Site', 'premium-addons-pro' ) ) . '" target="_blank">' . __( 'Visit Plugin Site', 'premium-addons-pro' ) . '</a>',
			];

                $plugin_meta = array_merge( $plugin_meta, $row_meta );

            }

            return $plugin_meta;

        }
        
        public static function pa_plugins_page( $plugins ) {
            
            $settings = self::pa_white_label_settings();
            
            $basename_free = plugin_basename( PREMIUM_ADDONS_PATH . 'premium-addons-for-elementor.php' );
            $basename_pro = plugin_basename( PREMIUM_PRO_ADDONS_PATH . 'premium-addons-pro-for-elementor.php' );
            if ( isset( $plugins[ $basename_pro ] )&& isset( $plugins[ $basename_free ] ) && is_array( $settings ) ) {
                $plugin_name = ( isset( $settings['premium-wht-lbl-plugin-name'] ) && '' != $settings['premium-wht-lbl-plugin-name'] ) ? $settings['premium-wht-lbl-plugin-name'] : '';
				$plugin_desc = ( isset( $settings['premium-wht-lbl-desc'] ) && '' != $settings['premium-wht-lbl-desc'] ) ? $settings['premium-wht-lbl-desc'] : '';
                
				$author_name = ( isset( $settings['premium-wht-lbl-name'] ) && '' != $settings['premium-wht-lbl-name'] ) ? $settings['premium-wht-lbl-name'] : '';
				$author_url  = ( isset( $settings['premium-wht-lbl-url'] ) && '' != $settings['premium-wht-lbl-url'] ) ? $settings['premium-wht-lbl-url'] : '';
                $plugin_name_pro = ( isset( $settings['premium-wht-lbl-plugin-name-pro'] ) && '' != $settings['premium-wht-lbl-plugin-name-pro'] ) ? $settings['premium-wht-lbl-plugin-name-pro'] : '';
                
				$plugin_desc_pro = ( isset( $settings['premium-wht-lbl-desc-pro'] ) && '' != $settings['premium-wht-lbl-desc-pro'] ) ? $settings['premium-wht-lbl-desc-pro'] : '';
                
				$author_name_pro = ( isset( $settings['premium-wht-lbl-name-pro'] ) && '' != $settings['premium-wht-lbl-name-pro'] ) ? $settings['premium-wht-lbl-name-pro'] : '';
				$author_url_pro  = ( isset( $settings['premium-wht-lbl-url-pro'] ) && '' != $settings['premium-wht-lbl-url-pro'] ) ? $settings['premium-wht-lbl-url-pro'] : '';
                
                if ( '' != $plugin_name ) {
					$plugins[ $basename_free ]['Name']  = $plugin_name;
					$plugins[ $basename_free ]['Title'] = $plugin_name;
				}

				if ( '' != $plugin_desc ) {
					$plugins[ $basename_free ]['Description'] = $plugin_desc;
				}

				if ( '' != $author_name ) {
					$plugins[ $basename_free ]['Author']     = $author_name;
					$plugins[ $basename_free ]['AuthorName'] = $author_name;
				}

				if ( '' != $author_url ) {
					$plugins[ $basename_free ]['AuthorURI'] = $author_url;
					$plugins[ $basename_free ]['PluginURI'] = $author_url;
				}

				if ( '' != $plugin_name_pro ) {
					$plugins[ $basename_pro ]['Name']  = $plugin_name_pro;
					$plugins[ $basename_pro ]['Title'] = $plugin_name_pro;
				}

				if ( '' != $plugin_desc_pro ) {
					$plugins[ $basename_pro ]['Description'] = $plugin_desc_pro;
				}

				if ( '' != $author_name_pro ) {
					$plugins[ $basename_pro ]['Author']     = $author_name_pro;
					$plugins[ $basename_pro ]['AuthorName'] = $author_name_pro;
				}

				if ( '' != $author_url_pro ) {
					$plugins[ $basename_pro ]['AuthorURI'] = $author_url_pro;
					$plugins[ $basename_pro ]['PluginURI'] = $author_url_pro;
				}
            }
            return $plugins;
        }
        
        public static function pa_white_label_settings(){
            
            $settings = get_option('pa_wht_lbl_save_settings');
            
            return isset( $settings ) ? $settings : array();
            
        }

    }
    
}

Branding::init();
