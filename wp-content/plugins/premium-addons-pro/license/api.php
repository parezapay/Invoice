<?php

namespace PremiumAddonsPro\License;

use PremiumAddonsPro\License\Admin;
    
class API {

    /**
     * Handles license activation
     * @since 1.0.0
     * @access public
     * @return void
     */
    public static function papro_activate_license( $license_key ) {
        // data to send in our API request
        $api_params = array(
            'edd_action' => 'activate_license',
            'license'    => $license_key,
            'item_id'    => PAPRO_ITEM_ID,
            'url'        => home_url()
        );
        
        $slug = self::get_redirection_slug();
        // Call the custom API.
        $response = self::call_custom_api( $api_params );
        
        // make sure the response came back okay
        if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
            $message =  ( is_wp_error( $response ) ) ? $response->get_error_message() : __( 'An error occurred, please try again.' );
        } else {
            $license_data = json_decode( wp_remote_retrieve_body( $response ) );
            if ( false === $license_data->success ) {
                
            switch( $license_data->error ) {
                
                case 'expired' :
                    $message = sprintf(
                        __( 'Your license key expired on %s.' ),
                        date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
                    );
                    break;
                case 'revoked' :
                    $message = __( 'Your license key has been disabled.' );
                    break;
                case 'missing' :
                    $message = __( 'Invalid license.' );
                    break;
                case 'invalid' :
                case 'site_inactive' :
                    $message = __( 'Your license is not active for this URL.' );
                    break;
                case 'item_name_mismatch' :
                    $message = sprintf( __( 'This appears to be an invalid license key for %s.' ), PAPRO_ITEM_NAME );
                    break;
                case 'no_activations_left':
                    $message = __( 'Your license key has reached its activation limit.' );
                    break;
                default :
                    $message = __( 'An error occurred, please try again.' );
                    break;
                
                }
            }
        }

        if ( ! empty( $message ) ) {
            $base_url =  admin_url( sprintf( 'admin.php?page=%s', $slug ) );
            $redirect = add_query_arg( array( 'sl_activation' => 'false', 'message' => urlencode( $message ) ), $base_url );
            wp_redirect( $redirect );
            exit();
        }

        update_option( 'papro_license_key', $license_key );
        update_option( 'papro_license_status', $license_data->license );
        
        $redirect = sprintf( "admin.php?page=%s", $slug ) ;
        wp_redirect( $redirect );
        
        exit();
    }

    /**
     * Handles license deactivation
     * @since 1.0.0
     * @access public
     * @return void
     */
    public static function papro_deactivate_license( $license_key ){
        // data to send in our API request
        $api_params = array(
            'edd_action' => 'deactivate_license',
            'license'    => $license_key,
            'item_name'  => PAPRO_ITEM_NAME,
            'url'        => home_url()
        );

        $slug = self::get_redirection_slug();
        
        // Call the custom API.
        $response = self::call_custom_api( $api_params );
        
        if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
            
            if ( is_wp_error( $response ) ) {
                $message = $response->get_error_message();
            } else {
                $message = __( 'An error occurred, please try again.' );
            }
            
            $base_url =  admin_url( sprintf( 'admin.php?page=%s', $slug ) );
            $redirect = add_query_arg( array( 'sl_activation' => 'false', 'message' => urlencode( $message ) ), $base_url );

            wp_redirect( $redirect );
            exit();
            
        }
        
        delete_option( 'papro_license_status' );
        
        delete_option( 'papro_license_key' );
        
        $redirect = sprintf( "admin.php?page=%s", $slug ) ;
        wp_redirect( $redirect );
        
        exit();

    }
    
    public static function get_redirection_slug() {
        return Admin::get_slug();
    }
    
    public static function call_custom_api( $args ) {
        
        $response = wp_remote_post(
            PAPRO_STORE_URL,
            array(
                'timeout' => 40,
                'sslverify' => false,
                'body' => $args
            )
        );
        
        return $response;
    }
    
}