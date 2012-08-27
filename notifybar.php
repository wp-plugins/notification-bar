<?php
/*
Plugin Name:Notification Bar
Plugin URI: 
Description: This plugin will show notification at top of the header.
Author: Nishant Jain, rahulbrilliant2004, tikendramaitry
Version: 1.0.3
Author URI: http://www.wpfruits.com
*/
// ----------------------------------------------------------------------------------

// ADD Styles and Script in head section
add_action('admin_init', 'notifybar_backend_scripts');
add_action('wp_head', 'notifybar_frontend_scripts');

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
		'color_scheme' => $options['color_scheme'],
    	'text_field' =>$options['text_field'],
    	'link_url' =>$options['link_url'],
    	'link_text' => $options['link_text'],
		'link_bgcolor' => $options['link_bgcolor']
    );
return $update_val;
}

function notifybar_backend_menu()
{
wp_nonce_field('update-options'); $options = get_option('notifybar_options'); 
?>
	<div class="wrap">
	<div id="icon-themes" class="icon32"></div>
	<h2> Notification Bar Setting</h2>
	</div>
	
	<div class="postbox" id="notifybar_admin">
		<span class="desc">Enter Notification values :</span>
		<form method="post">
			<table>
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
					<td><?php _e("Enter Text", 'notifybar'); ?> :</td>
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
					<td><?php _e("Link Bgcolor", 'notifybar'); ?> :</td>
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
				<input type="submit" value="<?php _e('Save') ?>" class="button-primary" id="notifybar_update" name="notifybar_update">	
			</p>
		</form>
	</div>
<?php
}
//--------------------------------------------------------------------------------------------------------------------------------------

function notifybar(){
$options = get_option('notifybar_options'); 
?>  
	<div id="notifybar" class="run_once">
		<div class="notifybar_topsec" style="background-color:<?php echo $options['color_scheme'] ?>">
			<div class="notifybar_center">
				<?php if($options['text_field']){ ?><div class="notifybar_block"><?php echo $options['text_field'] ?></div><?php } ?>
				<?php if($options['link_url']){ ?><a href="<?php echo $options['link_url'] ?>" target="_blank" class="notifybar_block notifybar_button" style="background-color:<?php echo $options['link_bgcolor'] ?>"><?php echo $options['link_text'] ?></a><?php } ?>
			</div>
			<a href="#"class="notifybar_close"></a>
		</div>
		<a href="JavaScript:void(0);"class="notifybar_botsec" style="background-color:<?php echo $options['color_scheme'] ?>"></a>
	</div>

<?php
}
add_action('wp_footer', 'notifybar');

?>