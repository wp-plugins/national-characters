<?php
/*
Plugin Name: National Characters
Plugin URI:
Description: Allows you to enter national characters in username during registration
Version: 1.0.0
Author: OptArt | Konrad Choma
Author URI: http://www.optart.biz
*/

/* Overrides the Wordpress sanitize_user filter */

function mb_sanitize_user($username,$raw,$strict){
	$username=wp_strip_all_tags($raw);
	$username=mb_convert_encoding($username,"UTF-8");
	$username=preg_replace('/%([a-fA-F0-9][a-fA-F0-9])/','',$username);
	$username=preg_replace('/&.+?;/','',$username);
	if($strict){
		$username=preg_replace('/^\p{L}0-9 _.\-@/iu','',$username);
	}
	$username=trim($username);
	$username=preg_replace('/\s+/',' ',$username);
	return $username;
}
add_filter('sanitize_user','mb_sanitize_user',10,3);