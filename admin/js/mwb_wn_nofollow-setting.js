jQuery(document).ready(function(jQuery){
  setTimeout(function(){jQuery(".mwb_wp_nofollow_notice-success").fadeOut()},2000);
  jQuery("#mwb_wp_nofollow_remove_rel_link").on("change",function(){
  
		jQuery("#mwb_wp_nofollow_add_rel_link").attr('checked', false); 
		jQuery("#mwb_wp_nofollow_add_internal_rel_link").attr('checked', false); 
	  
     });
   jQuery("#mwb_wp_nofollow_add_rel_link").on("change",function(){
   
    	jQuery("#mwb_wp_nofollow_remove_rel_link").attr('checked', false); 
	   	var checked=jQuery("#mwb_wp_nofollow_add_internal_rel_link").attr('checked');
	   	
	  	if(jQuery("#mwb_wp_nofollow_add_internal_rel_link").attr('checked'))
	  	{
	  		jQuery("#mwb_wp_nofollow_add_rel_link").attr('checked', false);
	  		alert("You have already checked add rel=nofollow to all links . You have to disable the Add rel=nofollow to all links checkbox");
	  	}
	  	else
	  	{
	  		jQuery("#mwb_wp_nofollow_add_rel_link").attr('checked', true);
	  	}
    });
    jQuery("#mwb_wp_nofollow_add_internal_rel_link").on("change",function(){
    	
    	
  	    jQuery("#mwb_wp_nofollow_remove_rel_link").attr('checked', false); 
		jQuery("#mwb_wp_nofollow_add_rel_link").attr('checked', false); 
  	
     });
    jQuery("#mwb_wp_nofollow_add_alt_image").on("change",function(){
       
       if(jQuery("#mwb_wp_nofollow_add_alt_image").attr('checked'))
	  	{
	  		alert("Adding alt attribute to the image tag");
	  	}
	  	else
	  	{
	  		alert("Removing alt attribute from the image tag");
	  	}
    })
});