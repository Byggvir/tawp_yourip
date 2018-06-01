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


    if ( ! empty($_SERVER['HTTP_CLIENT_IP']) ) {

        // Return Clients IP Address
        $ip = $_SERVER['HTTP_CLIENT_IP'];

    } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {

        //check ip from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

	} else {

	$ip = $_SERVER['REMOTE_ADDR'];

	}

	return apply_filters( 'wpb_get_ip', $ip );
     
}

// Add the shortcode

add_shortcode('yourip', 'yourip');
?>
