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

add_filter( 'wpcf7_validate_textarea*', 'custom_textarea_spam_validation_filter', 20, 2 );
add_filter( 'wpcf7_validate_textarea', 'custom_textarea_spam_validation_filter', 20, 2 );




function custom_textarea_spam_validation_filter( $result, $tag ) {
			$spam_list = array('free website', 'increase visitors', 'website marketing', 'seo', 'web site design', 'website design', 'online marketing', 'targeted traffic', 'web marketing', 'our email list', 'remove, as the subject line', 'remove within the subject line', 'my database', 'business directories' , 'get listed');
	$tag = new WPCF7_Shortcode( $tag );
	if ( 'your-message' == $tag->name ) {
	$your_message = isset( $_POST['your-message'] ) ? trim( $_POST['your-message'] ) : '';
	$your_message = strtolower($your_message);
	$is_spam = false;
    foreach($spam_list as $query) {
	if (strpos($your_message, $query) !== false ) {
		$is_spam = true;
	}
}
if ($is_spam) {
			$result->invalidate( $tag, "Please check the content of your message" );
}
}
return $result;
}
