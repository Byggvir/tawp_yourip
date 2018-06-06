<?php
/**
 * @package TA_YourIP
 * @version 0.1.3
 */
/*
Plugin Name: TA YourIP
Plugin URI: https://github.com/Byggvir/tawp_yourip/archive/master.zip
Description: This plugin displays the IP address of the caller.
Author: Thomas Arend
Version: 0.1.3
Author URI: http://byggvir.de/
*/

define( "UIP", 'UIP_' );

function getaddrtype($addrtype) {
	
    if (  !  empty($_SERVER[$addrtype] )  ) {
        // Return Clients IP Address
        return $_SERVER[$addrtype] ;
    } 
	else {
		return "-";
	}

}
	
function yourip($atts) {

    extract(
        shortcode_atts(
            array(
                'client' => 'yes',
                'remote' => 'yes',
                'forward' => 'yes',
            ),
            $atts
        )
    );

	$ClAddr = getaddrtype('HTTP_CLIENT_IP');
	$RmAddr = getaddrtype('REMOTE_ADDR');
	$XfAddr = getaddrtype('HTTP_X_FORWARDED_FOR');
	
	$ip = "<div class=\"tawp_yourip\">Client: $ClAddr;<br /> Remote: $RmAddr; <br />Forwarded for: $XfAddr;</div>";

	return $ip;
     
}

function yourhost($atts) {

	$host = "<div class=\"tawp_yourhost\">Hostname:" . $_SERVER['REMOTE_HOST'] . "</div>";

	return $host;
     
}
function youragent($atts) {

	$agent = $_SERVER['HTTP_USER_AGENT'];

	return $agent;
     
}
function add_uip_stylesheet( )
 {
  wp_register_style( UIP . 'StyleSheets', plugins_url( 'css/styles.css', __FILE__ ) );
  wp_enqueue_style( UIP . 'StyleSheets' );
 }

// Add the EVTStyleSheets

add_action( 'wp_print_styles', 'add_uip_stylesheet' );

// Add the shortcode

add_shortcode('yourip', 'yourip');
add_shortcode('yourhost', 'yourhost');
add_shortcode('youragent', 'youragent');
?>
