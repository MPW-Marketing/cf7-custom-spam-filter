<?php
/*
Plugin Name: Contact Form 7 custom spam filter additions
Plugin URI:
Description: fitler text content for specific terms
Version: 0.1
Author: DMM
Author URI:
License: GPL2
*/
function strposa($haystack, $needle, $offset=0) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $query) {
        if(strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
    }
    return false;
}

		$spam_list = array('free website', 'increase visitors', 'website marketing', 'seo', 'web site design', 'website design', 'online marketing', 'targeted traffic', 'web marketing', 'our email list', 'remove, as the subject line', 'remove within the subject line', 'my database');

function custom_textarea_spam_validation_filter( $result, $tag ) {
	$tag = new WPCF7_Shortcode( $tag );
	if ( 'your-message-t' == $tag->name ) {
		if ( isset($_POST['your-message-t'] ) ) {
			$your_message = sanitize_text_field( $_POST['your-message-t'] );
		}

	if (strposa($your_message, $spam_list)) {
		$result->invalidate( $tag, "Please check the content of your message" );
	}
}
return $result;
}
