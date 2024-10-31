<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://makewebbetter.com
 * @since             1.0.0
 * @package           Mwb_wp_nofollow_links
 *
 * @wordpress-plugin
 * Plugin Name:       Wordpress Nofollow Links
 * Plugin URI:        https://makewebbetter.com/product/wordpress-nofollow-links/
 * Description:       This plugin is used to add rel="nofollow" to links and alt="" to img tags.
 * Version:           1.0.0
 * Author:            makewebbetter
 * Author URI:        https://makewebbetter.com
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       mwb_wp_nofollow
 * Domain Path:       /languages
 * Tested up to:      4.9.8
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MWB_NF_NAME_VERSION', '1.0.0' );
define('MWB_NOFOLLOW_DIR_URL',plugin_dir_url( __FILE__ ));
define('MWB_NOFOLLOW_DIR_PATH',plugin_dir_path(__FILE__));
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mwb_wp_nofollow-activator.php
 */
function activate_mwb_wp_nofollow() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mwb_wp_nofollow-activator.php';
	Mwb_wp_nofollow_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mwb_wp_nofollow-deactivator.php
 */
function deactivate_mwb_wp_nofollow() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mwb_wp_nofollow-deactivator.php';
	Mwb_wp_nofollow_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mwb_wp_nofollow' );
register_deactivation_hook( __FILE__, 'deactivate_mwb_wp_nofollow' );
function mwb_wn_add_settings_link( $links )
{
 

$my_link = array(
           '<a href="' . admin_url( 'admin.php?page=mwb_menu' ) . '">' . __( 'Settings', 'mwb-wn-attribute-setting' ) . '</a>',
           );

return array_merge( $my_link, $links );
}
add_filter( "plugin_action_links_".plugin_basename(__FILE__), 'mwb_wn_add_settings_link' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mwb_wp_nofollow.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mwb_wp_nofollow() {

	$plugin = new Mwb_wp_nofollow();
	$plugin->run();

}
run_mwb_wp_nofollow();
