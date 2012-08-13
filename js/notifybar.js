/*-- Notifybar JS Script
--------------------------------*/

jQuery(document).ready(function(){
	jQuery('body').prepend('<div id="notifybar_push"></div>');
	jQuery('#notifybar .notifybar_botsec').hide();
	jQuery('#notifybar_push').css('height','35px');
	jQuery('#notifybar').css('height','61px');
	
		setTimeout(function() {
			jQuery('#notifybar .notifybar_topsec').slideToggle(100);
			jQuery('#notifybar a.notifybar_botsec').show("bounce", { times:2 }, 200);
			jQuery('#notifybar_push').css('height','0px');
			jQuery('#notifybar').css('height','0px');
			jQuery('#notifybar').removeClass('run_once');
		}, 6000);


	jQuery('#notifybar a.notifybar_botsec').click(function(){
		jQuery(this).slideToggle(100);
		jQuery('#notifybar .notifybar_topsec').show("bounce", { times:2 }, 200);
		jQuery('#notifybar_push').css('height','35px');
		jQuery('#notifybar').css('height','61px');
	});
	
	jQuery('#notifybar a.notifybar_close').click(function(){
		jQuery('#notifybar .notifybar_topsec').slideToggle(100);
		jQuery('#notifybar a.notifybar_botsec').show("bounce", { times:2 }, 200);
		jQuery('#notifybar_push').css('height','0px');
		jQuery('#notifybar').css('height','0px');
	});
	
});