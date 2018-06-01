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
Version: 0.1.1
Author URI: http://byggvir.de/
*/

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
                'datum' => 'now',
            ),
            $atts
        )
    );
   
	$ClAddr = getaddrtype('HTTP_CLIENT_IP');
	$RmAddr = getaddrtype('REMOTE_ADDR');
	$XfAddr = getaddrtype('HTTP_X_FORWARDED_FOR');
	
	$ip = "<div class=\"tawp_yourip\">Client: $ClAddr;<br /> Remote: $RmAddr; <br />Forwarded for: $XfAddr;<br /></div>";

	return apply_filters( 'wpb_get_ip', $ip );
     
}

// Add the shortcode

add_shortcode('yourip', 'yourip');
?>
