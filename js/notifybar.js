/*-- Notifybar JS Script
--------------------------------*/

jQuery(document).ready(function(){
	jQuery('#notifybar .notifybar_botsec').hide();
	jQuery('body').prepend('<div id="notifybar_push"></div>');
	jQuery('#notifybar_push').css('height','61px');
	jQuery('#notifybar').css('height','61px');
	
		setTimeout(function() {
			jQuery('#notifybar .notifybar_topsec').slideToggle(100);
			jQuery('#notifybar a.notifybar_botsec').slideToggle(200);
			jQuery('#notifybar_push').css('height','0px');
			jQuery('#notifybar').css('height','0px');
		}, 7000);


	jQuery('#notifybar a.notifybar_botsec').click(function(){
		jQuery(this).slideToggle(100);
		jQuery('#notifybar .notifybar_topsec').slideToggle(200);
		jQuery('#notifybar_push').css('height','61px');
		jQuery('#notifybar').css('height','61px');
	});
	
	jQuery('#notifybar a.notifybar_close').click(function(){
		jQuery('#notifybar .notifybar_topsec').slideToggle(100);
		jQuery('#notifybar a.notifybar_botsec').slideToggle(200);
		jQuery('#notifybar_push').css('height','0px');
		jQuery('#notifybar').css('height','0px');
	});
	
});