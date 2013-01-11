<?php
/*
Plugin Name:Notification Bar
Plugin URI: http://www.wpfruits.com/downloads/wp-plugins/notification-bar-plugin/
Description: This plugin will show notification at top of the header.
Author: Nishant Jain, rahulbrilliant2004, tikendramaitry
Version: 2.0.3
Author URI: http://www.wpfruits.com
*/
// ----------------------------------------------------------------------------------

// ADD Styles and Script in head section
add_action('admin_init', 'notifybar_backend_scripts');
add_action('wp_enqueue_scripts', 'notifybar_frontend_scripts');

function notifybar_backend_scripts() {
	if(is_admin()){
		wp_enqueue_script ('jquery');
		wp_enqueue_script( 'notifybar_backend_scripts',plugins_url('admin/notifybar_admin.js',__FILE__), array('jquery'));
		wp_enqueue_style( 'notifybar_backend_scripts',plugins_url('admin/notifybar_admin.css',__FILE__), false, '1.0.0' );
	}
}

function notifybar_frontend_scripts() {	
	if(!is_admin()){
		wp_enqueue_script('jquery');
		wp_enqueue_script('notifybar',plugins_url('js/notifybar.js',__FILE__), array('jquery'));
		wp_enqueue_style('notifybar',plugins_url('css/notifybar.css',__FILE__));
	}
}
//-------------------------------------------------------------------------------------

// Hook for adding admin menus
add_action('admin_menu', 'notifybar_plugin_admin_menu');
function notifybar_plugin_admin_menu() {
     add_menu_page('notifybar', 'Notification Bar','administrator', 'notifybar', 'notifybar_backend_menu',plugins_url('images/icon.png',__FILE__));
}


//This function will create new database fields with default values
function notifybar_defaults(){
	    $default = array(
		'defaultposition' => 'top',
		'color_scheme' => '#0F67A1',
        'text_field' => 'Get my Subscription',
    	'link_url' => 'http://www.wpfruits.com',
    	'link_text' => 'Subscribe',
		'link_bgcolor' => '#0F67A1'
    );
return $default;
}

// Runs when plugin is activated and creates new database field
register_activation_hook(__FILE__,'notifybar_plugin_install');
function notifybar_plugin_install() {
    add_option('notifybar_options', notifybar_defaults());
}	


// update the notifybar options
if(isset($_POST['notifybar_update'])){
	update_option('notifybar_options', notifybar_updates());
}

function notifybar_updates() {
	$options = $_POST['notifybar_options'];
	    $update_val = array(
		'defaultposition' => $options['defaultposition'],
		'color_scheme' => $options['color_scheme'],
    	'text_field' =>$options['text_field'],
    	'link_url' =>$options['link_url'],
    	'link_text' => $options['link_text'],
		'link_bgcolor' => $options['link_bgcolor']
    );
return $update_val;
}

// get notifybar version
function notifybar_get_version(){
	if ( ! function_exists( 'get_plugins' ) )
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
	$plugin_file = basename( ( __FILE__ ) );
	return $plugin_folder[$plugin_file]['Version'];
}

function notifybar_backend_menu()
{
wp_nonce_field('update-options'); $options = get_option('notifybar_options'); 
?>

<div class="wrap">
<div id="icon-themes" class="icon32"></div>
<h2><?php _e('Notification Bar '.notifybar_get_version().' Setting\'s','notifybar'); ?></h2>
</div>
	
<div id="poststuff">
	<div class="postbox" id="notifybar_admin">
		<div class="handlediv" title="Click to toggle"><br/></div>
		<h3 class="hndle"><span><?php _e("Enter Notification values:",'notifybar'); ?></span></h3>
		<div class="inside" style="padding: 15px;margin: 0;">
			<form method="post">
				<table>
				
					<tr>
						<td><?php _e("Default Position",'notifybar'); ?> :</td>
						<td><select name="notifybar_options[defaultposition]"><option value="top" <?php selected('top', $options['defaultposition']); ?>>Top</option><option value="bottom" <?php selected('bottom', $options['defaultposition']); ?>>Bottom</option></select></td>
					</tr>
				
					<tr>
						<td><?php _e("Color Scheme", 'notifybar'); ?> :</td>
						<td>
							<select name="notifybar_options[color_scheme]">
								<option <?php selected('#0F67A1', $options['color_scheme']); ?> value="#0F67A1">Blue</option>
								<option <?php selected('#C21415', $options['color_scheme']); ?> value="#C21415">Red</option>
								<option <?php selected('#81BB07', $options['color_scheme']); ?> value="#81BB07">Green</option>
								<option <?php selected('#C39500', $options['color_scheme']); ?> value="#C39500">Yellow Dark</option>
								<option <?php selected('#EF166D', $options['color_scheme']); ?> value="#EF166D">Pink</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><?php _e("Text Message", 'notifybar'); ?> :</td>
						<td><textarea col="10" name="notifybar_options[text_field]"><?php echo $options['text_field'] ?></textarea></td>
					</tr>
					<tr>
						<td><?php _e("Link URL", 'notifybar'); ?> :</td>
						<td><input type="text" name="notifybar_options[link_url]" value="<?php echo $options['link_url'] ?>" /></td>
					</tr>
					<tr>
						<td><?php _e("Link Button Text", 'notifybar'); ?> :</td>
						<td><input type="text" name="notifybar_options[link_text]" value="<?php echo $options['link_text'] ?>" /></td>
					</tr>
					<tr>
						<td><?php _e("Link Bg-Color", 'notifybar'); ?> :</td>
						<td>
							<select name="notifybar_options[link_bgcolor]">
								<option <?php selected('#0F67A1', $options['link_bgcolor']); ?> value="#0F67A1">Blue</option>
								<option <?php selected('#C21415', $options['link_bgcolor']); ?> value="#C21415">Red</option>
								<option <?php selected('#81BB07', $options['link_bgcolor']); ?> value="#81BB07">Green</option>
								<option <?php selected('#C39500', $options['link_bgcolor']); ?> value="#C39500">Yellow Dark</option>
								<option <?php selected('#EF166D', $options['link_bgcolor']); ?> value="#EF166D">Pink</option>
							</select>
						</td>
					</tr>
				</table>

				<p class="button-controls">
					<input type="submit" value="<?php _e('Save Settings','notifybar'); ?>" class="button-primary" id="notifybar_update" name="notifybar_update">	
				</p>
			</form>
		</div>
	</div>
	<iframe class="notifybar_iframe" src="http://www.sketchthemes.com/sketch-updates/plugin-updates/notification-bar-pro/nbpro.php" width="250px" height="380px" scrolling="no" ></iframe> 
</div>
<?php
}
//--------------------------------------------------------------------------------------------------------------------------------------

function notifybar(){
$options = get_option('notifybar_options'); 
?>  
<style type="text/css">
#notifybar{<?php echo $options['defaultposition'] ?>:0px;}

<?php if($options['defaultposition'] =="bottom"){ ?> 
#notifybar .notifybar_topsec{border-top:3px solid #fff;border-bottom:0;}
#notifybar a.notifybar_close{top: 17px;background-image:url("<?php echo plugins_url('images/sprite_bot.png',__FILE__); ?>");background-position:0 center;}
#notifybar a.notifybar_close:hover{background-position:0 center;opacity:0.6;filter:alpha(opacity = 60);}
<?php } ?>
#nbar_downArr.notifybar_botsec{<?php echo $options['defaultposition']; ?>:-41px;<?php if($options['defaultposition'] =="bottom"){ ?> background-image:url("<?php echo plugins_url('images/up_arrow.png',__FILE__); ?>");<?php } ?>}
</style>

	<div id="notifybar">
		<a class="nbar_downArr" href="#nbar_downArr" style="display:none;"></a>
		<div class="notifybar_topsec" style="background-color:<?php echo $options['color_scheme'] ?>">
		<?php $from_this = "http://www.wpfruits.com/notification-bar-pro/?utm_refs=".$_SERVER['SERVER_NAME']; ?>
		<a title="Get the Notification Bar PRO for your website and Attract visitors to your page" class="nb_fromthis" target="_blank" href="<?php echo $from_this; ?>" title=""><img src="<?php echo plugins_url('images/NB_32x32.png',__FILE__) ?>" /></a>
			<div class="notifybar_center">
				<?php if($options['text_field']){ ?><div class="notifybar_block"><?php echo $options['text_field'] ?></div><?php } ?>
				<?php if($options['link_url']){ ?><a href="<?php echo $options['link_url'] ?>" target="_blank" class="notifybar_block notifybar_button" style="background-color:<?php echo $options['link_bgcolor'] ?>"><?php echo $options['link_text'] ?></a><?php } ?>
			</div>
			<a href="JavaScript:void(0);" class="notifybar_close"></a>
		</div>
	</div>
	<a href="JavaScript:void(0);" class="notifybar_botsec" id="nbar_downArr" style="background-color:<?php echo $options['color_scheme'] ?>"></a>
	
<script type="text/javascript">
	jQuery(document).ready(function(){
		<?php 
		if($options['defaultposition'] =="bottom"){ ?>jQuery('body').append('<div class="notifybar_push"></div>');<?php } 
		else{ ?>jQuery('body').prepend('<div class="notifybar_push"></div>');<?php } ?>
		
		jQuery("#notifybar").notifybar();
	});
</script>

<?php
}
add_action('wp_footer', 'notifybar');

?>