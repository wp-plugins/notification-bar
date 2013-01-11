/*-- Admin Script
------------------------------------------*/
jQuery(document).ready(function(){
	jQuery('#notifybar_admin .handlediv,.hndle').click(function(){
		jQuery(this).parent().find('.inside').slideToggle("fast");
	});
});