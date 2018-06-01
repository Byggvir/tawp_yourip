<?php
/**
 * @package TA_YourIP
 * @version 0.1
 */
/*
Plugin Name: TA YourIP
Plugin URI: https://github.com/Byggvir/tawp_yourip/archive/master.zip
Description: This plugin displays the IP address of the caller.
Author: Thomas Arend
Version: 0.1
Author URI: http://byggvir.de/
*/

function yourip($atts) {

    extract(
        shortcode_atts(
            array(
                'datum' => 'now',
            ),
            $atts
        )
    );

    $ip = ""
    
    if ( ! empty($_SERVER['HTTP_CLIENT_IP']) ) {

        // Return Clients IP Address
        $ip = "Client: $_SERVER['HTTP_CLIENT_IP']";

    } 
    
    if ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {

        //check ip from proxy
        $ip = $ip + "; Forwarded for $_SERVER['HTTP_X_FORWARDED_FOR']";

    }

    if ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
        
        // Remote address
        $ip = $ip + "; Romote Address: $_SERVER['REMOTE_ADDR']";

	}

	return apply_filters( 'wpb_get_ip', $ip );
     
}

// Add the shortcode

add_shortcode('yourip', 'yourip');
?>
