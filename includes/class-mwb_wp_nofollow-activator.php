<?php

/**
 * Fired during plugin activation
 *
 * @link       https://makewebbetter.com
 * @since      1.0.0
 *
 * @package    wordpress-nofollow-links 
 * @subpackage wordpress-nofollow-links/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    wordpress-nofollow-links 
 * @subpackage wordpress-nofollow-links/includes
 * @author     makewebbetter <webmaster@makewebbetter.com>
 */
class Mwb_wp_nofollow_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		if (is_multisite()) 
		{
			if (is_plugin_active_for_network(__FILE__)) 
			{
				$blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
				foreach ($blogids as $blog_id) 
				{
     				switch_to_blog($blog_id);
					restore_current_blog();
				}
			}
		}
	}
}
