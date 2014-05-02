<?php
add_action('admin_menu', 'blue_login_create_menu');

function blue_login_create_menu() {
	add_options_page(__( 'Blue Login Settings', 'blue' ),__( 'Blue Login Settings', 'blue' ), 'administrator', __FILE__, 'blue_login_settings_page');
	add_action( 'admin_init', 'blue_login_register_mysettings' );
}


function blue_login_register_mysettings() {
	register_setting( 'blue-login-settings-group', 'login_message' );	
	register_setting( 'blue-login-settings-group', 'login_redirect' );	
	register_setting( 'blue-login-settings-group', 'logout_redirect' );	
	register_setting( 'blue-login-settings-group', 'register_redirect' );	
	register_setting( 'blue-login-settings-group', 'default_style' );
}

function blue_login_settings_page() {
?>
<div class="wrap">
<h2><?php _e('Blue Login Style Setting','blue'); ?></h2>

<form method="post" action="options.php">
    <?php settings_fields( 'blue-login-settings-group' ); ?>
    <?php do_settings_sections( 'blue-login-settings-group' ); ?>
    <table class="form-table">		

        <tr valign="top">
        <th scope="row"><?php _e('Login Page Message','blue'); ?></th>
        <td>
		<?php 
		$settings = array( 'media_buttons' => false,'tinymce' => false);
		$content = get_option('login_message');
		$editor_id = 'login_message';
		wp_editor( $content, $editor_id,$settings );
		?>
		</td>
        </tr>
		
        <tr valign="top">
        <th scope="row"><?php _e('After Login Redirect Link','blue'); ?></th>
        <td><input type="text" name="login_redirect" value="<?php echo get_option('login_redirect'); ?>" /></td>
        </tr>
		
        <tr valign="top">
        <th scope="row"><?php _e('After Log Out Redirect Link','blue'); ?></th>
        <td><input type="text" name="logout_redirect" value="<?php echo get_option('logout_redirect'); ?>" /></td>
        </tr>			
		
        <tr valign="top">
        <th scope="row"><?php _e('After Register Redirect Link','blue'); ?></th>
        <td><input type="text" name="register_redirect" value="<?php echo get_option('register_redirect'); ?>" /></td>
        </tr>			
		
        <tr valign="top">
        <th scope="row"><?php _e('Select Login Style','blue'); ?></th>
		<td>
		<fieldset>
		<label><input name="default_style" type="radio" value="BlueWorld" <?php checked( 'BlueWorld', get_option( 'default_style' ) ); ?> />Blue World</label><br />
		<label><input name="default_style" type="radio" value="DarkLight" <?php checked( 'DarkLight', get_option( 'default_style' ) ); ?> />Dark Light</label><br />
		<label><input name="default_style" type="radio" value="SimpleBlue" <?php checked( 'SimpleBlue', get_option( 'default_style' ) ); ?> />Simple Blue</label><br />
		<label><input name="default_style" type="radio" value="BlueMount" <?php checked( 'BlueMount', get_option( 'default_style' ) ); ?> />Blue Mount</label><br />
		<label><input name="default_style" type="radio" value="WoodStyle" <?php checked( 'WoodStyle', get_option( 'default_style' ) ); ?> />Wood Style</label><br />
		<label><input name="default_style" type="radio" value="BlurPurple" <?php checked( 'BlurPurple', get_option( 'default_style' ) ); ?> />Blur Purple</label>
		<p class="description"><?php _e('choose your default login style.','blue'); ?></p>
		</fieldset>
		</td>
        </tr>
    </table>
	<h2><?php _e('Like this plugin?','blue'); ?></h2>
		<p>
		<?php _e('Show your support by Rating 5 Star in <a href="http://wordpress.org/plugins/blue-login-style/"> Plugin Directory reviews</a>','blue'); ?><br />
		<?php _e('Follow me on <a href="https://www.facebook.com/alimir.ir"> Facebook</a>','blue'); ?>
		</p>
		<p class="update-nag">
		<?php _e('Plugin Author Blog: <a href="http://alimir.ir"> Wordpress & Programming World.</a>','blue'); ?>
		</p>
    <?php submit_button(); ?>
</form>
</div>
<?php } ?>