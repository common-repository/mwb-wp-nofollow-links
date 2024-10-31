<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://makewebbetter.com
 * @since      1.0.0
 *
 * @package    wordpress-nofollow-links 
 * @subpackage wordpress-nofollow-links/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    wordpress-nofollow-links
 * @subpackage wordpress-nofollow-links/includes
 * @author     makewebbetter <webmaster@makewebbetter.com>
 */
class Mwb_wp_nofollow_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		    
		    update_option("mwb_add_alt_image","off");
			
			update_option("mwb_add_rel_link","off");
			
			update_option("mwb_add_rel_internal_link","off");
			
			update_option("mwb_remove_rel_link","off");
	}

}
