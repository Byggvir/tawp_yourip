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

//Security check!
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define( "TAYIP", 'TAYIP_' );

function TAYIP_getaddrtype($addrtype) {
	
    if (  !  empty($_SERVER[$addrtype] )  ) {
        // Return Clients IP Address
        return $_SERVER[$addrtype] ;
    } 
	else {
		return "-";
	}

}
	
function TAYIP_yourip($atts) {

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

	$ClAddr = TAYIP_getaddrtype('HTTP_CLIENT_IP');
	$RmAddr = TAYIP_getaddrtype('REMOTE_ADDR');
	$XfAddr = TAYIP_getaddrtype('HTTP_X_FORWARDED_FOR');
	
	$ip = "<div class=\"tawp_yourip\">Client: $ClAddr;<br /> Remote: $RmAddr; <br />Forwarded for: $XfAddr;</div>";

	return $ip;
     
}

function TAYIP_yourhost($atts) {

	$host = "<div class=\"tawp_yourhost\">Hostname:" . $_SERVER['REMOTE_HOST'] . "</div>";

	return $host;
     
}

function TAYIP_youragent($atts) {

	$agent = $_SERVER['HTTP_USER_AGENT'];

	return $agent;
     
}

function TAYIP_add_stylesheet( )
 {
  wp_register_style( TAYIP . 'StyleSheets', plugins_url( 'css/styles.css', __FILE__ ) );
  wp_enqueue_style( TAYIP . 'StyleSheets' );
 }

// Add the EVTStyleSheets

add_action( 'wp_print_styles', TAYIP.'add_stylesheet' );

// Add the shortcode

add_shortcode('yourip', 'yourip');
add_shortcode('yourhost', 'yourhost');
add_shortcode('youragent', 'youragent');
?>
