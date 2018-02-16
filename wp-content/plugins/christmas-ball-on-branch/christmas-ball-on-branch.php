<?php
/*
Plugin Name: Christmas Ball on Branch
Plugin URI: http://www.wpspeedster.com/christmas-ball-on-branch/
Description: Add nice looking animated "Christmas Ball on Branch" image to the top right corner of your WP site and enjoy Christmas season.
Author: Csaba Kissi
Version: 0.8.3
Author URI: http://www.wpspeedster.com/
*/

function chbob_footer() {
    echo "<img style=\"position: absolute; top: 0; right: 0;\" src=\"".plugins_url('img/ball_on_branch.gif', __FILE__)."\">";
}
add_action('wp_footer', 'chbob_footer');

?>