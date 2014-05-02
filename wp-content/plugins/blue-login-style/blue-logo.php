<?php

function blue_get_default_options()
{
    $options = array(
        'logo' => ''
    );
    return $options;
}


function blue_options_init()
{
    $blue_options = get_option('theme_blue_options');
    
    if (false === $blue_options) {
        $blue_options = blue_get_default_options();
        add_option('theme_blue_options', $blue_options);
    }
    
}
// Initialize Theme options
add_action('after_setup_theme', 'blue_options_init');

function blue_options_setup()
{
    global $pagenow;
    if ('media-upload.php' == $pagenow || 'async-upload.php' == $pagenow) {
        add_filter('gettext', 'replace_thickbox_text', 1, 2);
    }
}
add_action('admin_init', 'blue_options_setup');

function replace_thickbox_text($translated_text, $text)
{
    if ('Insert into Post' == $text) {
        $referer = strpos(wp_get_referer(), 'blue-settings');
        if ($referer != '') {
            return __('I want this to be my logo!', 'blue');
        }
    }
    
    return $translated_text;
}

// Add "wp-login Options"
function blue_menu_options()
{
    add_theme_page(__( 'Select Login Logo', 'blue' ), __( 'Select Login Logo', 'blue' ), 'edit_theme_options', 'blue-settings', 'blue_admin_options_page');
}
add_action('admin_menu', 'blue_menu_options');

function blue_admin_options_page()
{
	if ( isset($_REQUEST['settings-updated']) ) echo '<div id="message" class="updated fade"><p><strong>' . __( 'Options Saved', 'blue' ) .'</strong></p></div>';
?>
		
		
		
		<div class="wrap">
			
			<div id="icon-themes" class="icon32"><br /></div>
		
			<h2><?php
    _e('Login Logo Options', 'blue');
?></h2>
			
			<?php
    settings_errors('blue-settings-errors');
?>
			
			<form id="form-blue-options" action="options.php" method="post" enctype="multipart/form-data">
			
				<?php
    settings_fields('theme_blue_options');
    do_settings_sections('blue');
?>
			
				<p class="submit">
					<input name="theme_blue_options[submit]" id="submit_options_form" type="submit" class="button-primary" value="<?php
    esc_attr_e('Save Settings', 'blue');
?>" />
					<input name="theme_blue_options[reset]" type="submit" class="button-secondary" value="<?php
    esc_attr_e('Reset Defaults', 'blue');
?>" />		
				</p>
			
			</form>
		<?php _e('Powered by','blue') ?>
		<a href="http://alimir.ir" title="<?php _e('Wordpress And Programming World','blue') ?>"><?php _e('Wordpress And Programming World','blue') ?></a>
		&#167;&#167;&#167;
		<?php _e('Join me on facebook','blue') ?>
		<a href="https://www.facebook.com/alimir.ir" title="<?php _e('Ali Mirzaei','blue') ?>"><?php _e('Ali Mirzaei','blue') ?></a>
		</div>
	<?php
}

function blue_options_validate($input)
{
    $default_options = blue_get_default_options();
    $valid_input     = $default_options;
    
    $blue_options = get_option('theme_blue_options');
    
    $submit      = !empty($input['submit']) ? true : false;
    $reset       = !empty($input['reset']) ? true : false;
    $delete_logo = !empty($input['delete_logo']) ? true : false;
    
    if ($submit) {
        $valid_input['logo'] = $input['logo'];
    } elseif ($reset) {
        delete_image($blue_options['logo']);
        $valid_input['logo'] = $default_options['logo'];
    } elseif ($delete_logo) {
        delete_image($blue_options['logo']);
        $valid_input['logo'] = '';
    }
    
    return $valid_input;
}

function delete_image($image_url)
{
    global $wpdb;
    
    // We need to get the image's meta ID..
    $query   = "SELECT ID FROM wp_posts where guid = '" . esc_url($image_url) . "' AND post_type = 'attachment'";
    $results = $wpdb->get_results($query);
    
    foreach ($results as $row) {
        wp_delete_attachment($row->ID);
    }
}

function blue_options_enqueue_scripts()
{
    wp_register_script('blue-upload', plugins_url("blue-login-style/js/blue-upload.js"), array(
        'jquery',
        'media-upload',
        'thickbox'
    ));
    
    
    if ('appearance_page_blue-settings' == get_current_screen()->id) {
        wp_enqueue_script('jquery');
        
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
        
        wp_enqueue_script('media-upload');
        wp_enqueue_script('blue-upload');
        
    }
    
}
add_action('admin_enqueue_scripts', 'blue_options_enqueue_scripts');


function blue_options_settings_init()
{
    register_setting('theme_blue_options', 'theme_blue_options', 'blue_options_validate');
    
    add_settings_section('blue_settings_header', __('Logo Options', 'blue'), 'blue_settings_header_text', 'blue');
    
    add_settings_field('blue_setting_logo', __('Logo', 'blue'), 'blue_setting_logo', 'blue', 'blue_settings_header');
    
    add_settings_field('blue_setting_logo_preview', __('Logo Preview', 'blue'), 'blue_setting_logo_preview', 'blue', 'blue_settings_header');
}
add_action('admin_init', 'blue_options_settings_init');

function blue_setting_logo_preview()
{
    $blue_options = get_option('theme_blue_options');
?>
	<div id="upload_logo_preview" style="min-height: 100px;">
		<img style="max-width:100%;" src="<?php
    echo esc_url($blue_options['logo']);
?>" />
	</div>
	<?php
}

function blue_settings_header_text()
{
?>
		<p><?php
    _e('Manage Logo Options for WP-Login Form.', 'blue');
?></p>
	<?php
}

function blue_setting_logo()
{
    $blue_options = get_option('theme_blue_options');
?>
		<input type="hidden" id="logo_url" name="theme_blue_options[logo]" value="<?php
    echo esc_url($blue_options['logo']);
?>" />
		<input id="upload_logo_button" type="button" class="button" value="<?php
    _e('Upload Logo', 'blue');
?>" />
		<?php
    if ('' != $blue_options['logo']):
?>
			<input id="delete_logo_button" name="theme_blue_options[delete_logo]" type="submit" class="button" value="<?php
        _e('Delete Logo', 'blue');
?>" />
		<?php
    endif;
?>
		<span class="description"><?php
    _e('Upload an image for the banner.', 'blue');
?></span>
	<?php
}

?>