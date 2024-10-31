<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @mwb_wn_link       https://makewebbetter.com
 * @since      1.0.0
 *
 * @package    wordpress-nofollow-links
 * @subpackage wordpress-nofollow-links/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    wordpress-nofollow-links
 * @subpackage wordpress-nofollow-links/public
 * @author     makewebbetter <webmaster@makewebbetter.com>
 */
class Mwb_wp_nofollow_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mwb_wp_nofollow_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mwb_wp_nofollow_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */


	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mwb_wp_nofollow_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mwb_wp_nofollow_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */



	}

     /**
	 * function to add/remove  alt to images and rel=nofollow to links
	 * @name mwb_wp_nofollow_the_content
	 * @author makewebbetter
	 * @since 1.0.0
	 */
	function mwb_wp_nofollow_the_content($text) {

		$post_id=get_the_Id();
		$mwb_wn_enable_alt_attribute=get_option("mwb_wp_nofollow_add_alt_image",true);
		$mwb_wn_enable_rel_attribute=get_option("mwb_wp_nofollow_add_rel_link");
		$mwb_wn_enable_rel_all_attribute=get_option("mwb_wp_nofollow_add_internal_rel_link");
		$mwb_wn_disable_rel_link=get_option("mwb_wp_nofollow_remove_rel_link");
		$content=$text;
		if($mwb_wn_enable_rel_all_attribute=="on")
		{

			$content= preg_replace_callback('/<a[^>]+/', 'mwb_wp_nofollow_all_callback', $content);
		}
		if($mwb_wn_enable_alt_attribute=="on")
		{
			global $post;
			preg_match_all('/<img(.*?)>/', $content, $images);
			
			if(!is_null($images))
			{
				foreach($images[1] as $index => $value)
				{ 
					if(!preg_match('/alt=/', $value))
					{
						$mwb_wn_img = str_replace('<img', '<img alt="'.$post->post_title.'"', $images[0][$index]);
						$content = str_replace($images[0][$index], $mwb_wn_img, $content);
					}
				}
			}
		}
		if($mwb_wn_enable_alt_attribute=="off")
		{
			global $post;
			preg_match_all('/<img (.*?)>/', $content, $images);
			if(!is_null($images))
			{
				foreach($images[1] as $index => $value)
				{ 
					
						$mwb_wn_img = preg_replace('/alt="(.*?)"/', null, $images[0][$index]);
						$content = str_replace($images[0][$index], $mwb_wn_img, $content);
				
				}
			}
		}
		if($mwb_wn_enable_rel_attribute=="on")
		{
		
         $content= preg_replace_callback('/<a[^>]+/', 'mwb_wp_nofollow_callback', $content);					 
		}
		if($mwb_wn_disable_rel_link=="on")
		{
         $content= preg_replace_callback('/<a[^>]+/', 'mwb_wp_nofollow_remove_nofollow_callback', $content);					 
		}

		$mwb_post = array(
		      'ID'           => $post_id,
		      'post_content' => $content,
		     );
		wp_update_post( $mwb_post );
		return $content;
	}
	
}


	 /**
	 * adding the rel=nofollow to external links
	 * @name mwb_wp_nofollow_callback
	 * @author makewebbetter
	 * @since 1.0.0
	 */
	function mwb_wp_nofollow_callback($matches) {
	    
	    $site_link = get_bloginfo('url');
	    $mwb_link = $matches[0];
	   if(strpos($mwb_link,$site_link)===false)
	    {
		   	if(strpos($mwb_link,'rel')===false)
		   	{
		   	  $mwb_link = preg_replace("%(href=\S(?!$site_link))%i", 'rel="nofollow" $1', $mwb_link);
		   		
		   	}
	  	if(strpos($mwb_link,'rel')>0)
		  {	
		       $mwb_link_length=strlen($mwb_link);
		   		$count=0;
		   		$mwb_link_rel_pos=strpos($mwb_link,'rel');
		   		
	   		    for($x=$mwb_link_rel_pos;$x<$mwb_link_length;$x++)
	   		    {
	   		    	$mwb_rel_after_mwb_link[$count]=$mwb_link[$x];
	   		    	$count++;
	   		    }
	   		    $mwb_rel_after_mwb_link=implode($mwb_rel_after_mwb_link);
		   		 
				  $count=0;

				    if (strpos($mwb_link, 'rel')>0) {
				       $mwb_quote_pos=strpos($mwb_rel_after_mwb_link, '"');

				       $mwb_pos_last_quote_find=$mwb_link_rel_pos+$mwb_quote_pos;
					    for($x=$mwb_pos_last_quote_find+1;$x<$mwb_link_length;$x++)
					    {
					    $mwb_substring[$count]=$mwb_link[$x];
					    $count++;
					    }
				   } 
				  $mwb_substring = implode($mwb_substring);
				  
				  $mwb_quote_pos2=strpos($mwb_substring, '"');
				  
				   $count=0;
				   for($x=0;$x<$mwb_quote_pos2;$x++)
				   {
				   	 $mwb_substring_inside_rel[$count]=$mwb_substring[$x];
					    $count++;
				   }
				   $mwb_substring_inside_rel=implode($mwb_substring_inside_rel);
				  
				   $mwb_length_substring=strlen($mwb_substring_inside_rel);
				   $count=0;
				   for($x=1;$x<$mwb_link_rel_pos+5;$x++)
				   {
				   	$mwb_initial_string[$count]=$mwb_link[$x];
				   	$count++;
				   }
				   $count=0;
				   for($x=$mwb_link_rel_pos+5+$mwb_length_substring;$x<$mwb_link_length;$x++)
				   {
				   	$mwb_remaining_string[$count]=$mwb_link[$x];
				   	$count++;
				   }
				   $mwb_add="nofollow"." ";
				   $mwb_start="<";
				   $mwb_remaining_string=implode($mwb_remaining_string);
				   $mwb_initial_string=implode($mwb_initial_string);
				   if(strpos($mwb_substring_inside_rel,'nofollow') === false)
				   { 		
				   	$mwb_link=$mwb_start.$mwb_initial_string.$mwb_add.$mwb_substring_inside_rel.$mwb_remaining_string; 		
				   }
		   	} 
	    }
	return $mwb_link;
	}

	/**
	 * adding the rel=nofollow to all links
	 * @name mwb_wp_nofollow_all_callback
	 * @author makewebbetter
	 * @since 1.0.0
	 */
	function mwb_wp_nofollow_all_callback($matches)
	{
		$mwb_link = $matches[0];
	   	if(strpos($mwb_link,'rel')===false)
	   	{
	   	    $mwb_link = preg_replace("/<a/", '<a rel="nofollow"', $mwb_link);
	   	}
  	  	if(strpos($mwb_link,'rel')>0)
		  {	
		       $mwb_link_length=strlen($mwb_link);
		   		$count=0;
		   		$mwb_link_rel_pos=strpos($mwb_link,'rel');
		   		
	   		    for($x=$mwb_link_rel_pos;$x<$mwb_link_length;$x++)
	   		    {
	   		    	$mwb_rel_after_mwb_link[$count]=$mwb_link[$x];
	   		    	$count++;
	   		    }
	   		    $mwb_rel_after_mwb_link=implode($mwb_rel_after_mwb_link);
		   		 
				  $count=0;

				    if (strpos($mwb_link, 'rel')>0) {
				       $mwb_quote_pos=strpos($mwb_rel_after_mwb_link, '"');

				       $mwb_pos_last_quote_find=$mwb_link_rel_pos+$mwb_quote_pos;
					    for($x=$mwb_pos_last_quote_find+1;$x<$mwb_link_length;$x++)
					    {
					    $mwb_substring[$count]=$mwb_link[$x];
					    $count++;
					    }
				   } 
				  $mwb_substring = implode($mwb_substring);
				  
				  $mwb_quote_pos2=strpos($mwb_substring, '"');
				  
				   $count=0;
				   for($x=0;$x<$mwb_quote_pos2;$x++)
				   {
				   	 $mwb_substring_inside_rel[$count]=$mwb_substring[$x];
					    $count++;
				   }
				   $mwb_substring_inside_rel=implode($mwb_substring_inside_rel);
				  
				   $mwb_length_substring=strlen($mwb_substring_inside_rel);
				   $count=0;
				   for($x=1;$x<$mwb_link_rel_pos+5;$x++)
				   {
				   	$mwb_initial_string[$count]=$mwb_link[$x];
				   	$count++;
				   }
				   $count=0;
				   for($x=$mwb_link_rel_pos+5+$mwb_length_substring;$x<$mwb_link_length;$x++)
				   {
				   	$mwb_remaining_string[$count]=$mwb_link[$x];
				   	$count++;
				   }
				   $mwb_add="nofollow"." ";
				   $mwb_start="<";
				   $mwb_remaining_string=implode($mwb_remaining_string);
				   $mwb_initial_string=implode($mwb_initial_string);
				   if(strpos($mwb_substring_inside_rel,'nofollow') === false)
				   { 		
				   	$mwb_link=$mwb_start.$mwb_initial_string.$mwb_add.$mwb_substring_inside_rel.$mwb_remaining_string; 		
				   }
		   	} 
	    return $mwb_link;
	}

	/**
	 * removing the rel=nofollow from alll links
	 * @name mwb_wp_nofollow_remove_nofollow_callback
	 * @author makewebbetter
	 * @since 1.0.0
	 */
	function mwb_wp_nofollow_remove_nofollow_callback($matches)
	{
		$mwb_link = $matches[0];
		$mwb_link = str_replace("nofollow",null,$mwb_link);
	    return $mwb_link;
	}