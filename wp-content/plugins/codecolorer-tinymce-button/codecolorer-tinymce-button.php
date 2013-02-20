<?php
/*
Plugin Name:CodeColorer TinyMCE Button
Plugin URI: http://homolibere.info/articles/codecolorer-tinymce-button/
Description: A plugin that provides a WordPress CodeColorer button for TinyMCE
Version: 0.2 
Author: Nick Remeslennikov
Author URI:  http://homolibere.info
*/
function cctb_addbuttons() {
	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
	// add the button for wp25 in a new way
		add_filter("mce_external_plugins", "add_cctb_tinymce_plugin", 5);
		add_filter('mce_buttons', 'register_cctb_button', 5);
	}
}

// used to insert button in wordpress 2.5x editor
function register_cctb_button($buttons) {
	array_push($buttons, "separator", "cctb");
	return $buttons;
}

// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function add_cctb_tinymce_plugin($plugin_array) {
	$plugin_array['cctb'] = get_option('siteurl').'/wp-content/plugins/codecolorer-tinymce-button/editor_plugin.js';	
	return $plugin_array;
}

function cctb_change_tinymce_version($version) {
	return ++$version;
}
// Modify the version when tinyMCE plugins are changed.
add_filter('tiny_mce_version', 'cctb_change_tinymce_version');
// init process for button control
add_action('init', 'cctb_addbuttons');
?>