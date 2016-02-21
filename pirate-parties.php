<?php
/*
	Plugin Name: wp-pirate-parties
	Plugin URI: https://github.com/PeterTheOne/wp-pirate-parties
	Description: A wordpress plugin that displays pirate parties as a widget.
	Version: 0.1.0
	Author: Peter Grassberger
	Author URI: http://petergrassberger.com
	Text Domain: wp-pirate-parties
	Domain Path: /languages
	License: MIT
	License URI: http://opensource.org/licenses/MIT
*/

// todo: move to folder "controler"
include_once(plugin_dir_path(__FILE__) . 'Wp_Pirate_Parties_Widget.php');
include_once(plugin_dir_path(__FILE__) . 'shortcode.php');

/**
 * Class Wp_Pirate_Parties
 */
class Wp_Pirate_Parties {

}
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('wp-pirate-parties', plugins_url('public/css/style.css', __FILE__));
});

add_action('plugins_loaded', function() {
    load_plugin_textdomain('wp-pirate-parties', false, plugin_basename(dirname(__FILE__)) . '/languages');
});
