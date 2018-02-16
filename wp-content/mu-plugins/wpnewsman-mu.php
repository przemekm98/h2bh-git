<?php
/*
Plugin Name: WPNewsman Pro - Worker Stability Enhancement
Plugin URI: http://wpnewsman.com
Description: Disables 3rd party plugins during the calls to internal worker URLs. Enhances stability of the worker.
Version: 1.0.7
Author: Alex Ladyga - G-Lock Software
Author URI: http://www.glocksoft.com
*/

define('WPNEWSMAN_MU_VERSION', '1.0.7');

define('NEWSMAN_AJAX_REQUEST', isset( $_REQUEST['action'] ) && strpos($_REQUEST['action'], 'newsmanAj') !== false);

	
add_filter( 'option_active_plugins', 'wpnewsman_disable_other_plugins' );

function wpnewsman_disable_other_plugins($plugins) {
	if ( isset($_REQUEST['newsman_worker_fork']) || NEWSMAN_AJAX_REQUEST ) {

		$whitelist = array(
			'wpnewsman-pro/wpnewsman-pro.php',
			'wpnewsman/wpnewsman.php',
			'wpnewsman-newsletters/wpnewsman.php'
		);
		$whitelisted_plugins = array();

		foreach ($plugins as $name) {
			if ( in_array( $name , $whitelist) || strpos( $name , 'wpnewsman-' ) !== false )
				$whitelisted_plugins[] = $name;
		}

		return $whitelisted_plugins;
	}
	return $plugins;
}