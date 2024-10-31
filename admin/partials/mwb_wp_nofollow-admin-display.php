<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://makewebbetter.com
 * @since      1.0.0
 *
 * @package    wordpress-nofollow-links 
 * @subpackage wordpress-nofollow-links/admin/partials
 */
	$mwb_wp_nofollow_alt_activation=get_option("mwb_wp_nofollow_add_alt_image");
	$mwb_wp_nofollow_rel_activation=get_option("mwb_wp_nofollow_add_rel_link");
	$mwb_wp_nofollow_alt_internal_activation=get_option("mwb_wp_nofollow_add_internal_rel_link");
  	$mwb_wp_nofollow_disable_rel_link=get_option("mwb_wp_nofollow_remove_rel_link");
	
	$mwb_wp_nofollow_checked_image="";
	$mwb_wp_nofollow_checked_link="";
	$mwb_wp_nofollow_checked_internal_link="";
	$mwb_wp_nofollow_checked_remove_rel_link="";

	if($mwb_wp_nofollow_alt_activation=="on")
	{
		$mwb_wp_nofollow_checked_image="checked";
	}
	if($mwb_wp_nofollow_rel_activation=="on")
	{
		$mwb_wp_nofollow_checked_link="checked";
	} 
	if($mwb_wp_nofollow_alt_internal_activation=="on")
	{
		$mwb_wp_nofollow_checked_internal_link="checked";
	}
	if($mwb_wp_nofollow_disable_rel_link=="on")
	{
		$mwb_wp_nofollow_checked_remove_rel_link="checked";
	}
?>
<h1 class="mwb_wp_nofollow_heading"><?php _e('Wordpress nofollow Links','mwb_wp_nofollow')?></h1>
<?php
	if(isset($_POST["mwb_wp_nofollow_add"]))
	{

		echo '<div class="notice notice-success mwb_wp_nofollow_notice-success is-dismissible"><p>';
		_e("Settings saved","mwb_wp_nofollow");
		echo '</p></div>'; 
	}
	?>
	<form method="post" class="mwb_wp_nofollow_form_class"><br>
		
		<input type="checkbox" name="mwb_wp_nofollow_add_alt_image" id="mwb_wp_nofollow_add_alt_image" <?php echo $mwb_wp_nofollow_checked_image;?>>
		<span id="mwb_checkbox_text">
		<?php _e('Add or Remove alt to image','mwb_wp_nofollow')?><br>
		<p class="description" id="tagline-description">
			<?php _e('This setting can be used to add image alt attribute by enabling the checkbox and remove image alt attribute by disabling the checkbox','mwb_wp_nofollow')?>
		</p>
		</span>
		<br><br><br>
		
		<input type="checkbox" name="mwb_wp_nofollow_add_rel_link" id="mwb_wp_nofollow_add_rel_link" <?php echo $mwb_wp_nofollow_checked_link;?>>
		<?php _e('Add rel=nofollow to external links','mwb_wp_nofollow')?>
		<br>
		<p class="description" id="tagline-description">
			<?php _e('This setting can be used to add the rel=nofollow attribute to the external links','mwb_wp_nofollow')?>
		</p>	
		<br><br><br>
		
		<input type="checkbox" name="mwb_wp_nofollow_add_internal_rel_link" id="mwb_wp_nofollow_add_internal_rel_link" <?php echo $mwb_wp_nofollow_checked_internal_link;?>>
		<?php _e('Add rel=nofollow to all links','mwb_wp_nofollow')?>
		<br>
		<p class="description" id="tagline-description">
			<?php _e('This setting can be used to add the rel=nofollow attribute to all the links','mwb_wp_nofollow')?>
		</p>	
        <br><br><br>
        
        <input type="checkbox" name="mwb_wp_nofollow_remove_rel_link" id="mwb_wp_nofollow_remove_rel_link" <?php echo $mwb_wp_nofollow_checked_remove_rel_link;?>>
        <?php _e('Remove rel=nofollow from all links','mwb_wp_nofollow')?>
        <br>
		<p class="description" id="tagline-description">
			<?php _e('This setting can be used to remove the rel=nofollow attribute from all the links','mwb_wp_nofollow')?>
		</p>	
        <br><br><br>
		<input type="hidden" name='nonce' value="<?php echo wp_create_nonce("mwb_wp_nofollow_form_string"); ?>"></input>
		<input type="submit" class="button button-primary" name="mwb_wp_nofollow_add" value=<?php _e('save settings','mwb_wp_nofollow')?>>

	</form>