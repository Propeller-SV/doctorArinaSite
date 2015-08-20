<?php
/**
 * ----------------------------------------------------------------------------------------
 * Fractal Options Menu Page
 * ----------------------------------------------------------------------------------------
 */
function arina_theme_options() {
	add_menu_page( 'Arina\'s Options', 'Arina\'s Options', 'manage_options', 'arina_options_page', 'display_arina_options_page', 'dashicons-admin-generic' );
}
function display_arina_options_page() {
	?>
	<div class="wrap">
		<h2>Arina's options</h2>
		<form method="post" action="options.php" enctype="multipart/form-data">
			<?php settings_fields( 'arina_options_page' ); ?>
			<?php do_settings_sections( __FILE__ ); ?>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

function initialize_arina_theme_options() {

	add_settings_section( 'about_section', 'About Me', function() {}, __FILE__ );

	add_settings_field( 'phone_number', 'Phone: ', function() { $options = get_option( 'arina_theme_options' );
		?><input type="text" name="arina_theme_options[phone]" value="<?= isset($options['phone']) ? $options['phone'] : ''; ?>" size="40"><?php
	}, __FILE__, 'about_section' );

	add_settings_field( 'email', 'Email: ', function() { $options = get_option( 'arina_theme_options' );
		?><input type="text" name="arina_theme_options[email]" value="<?= isset($options['email']) ? $options['email'] : ''; ?>" size="40"><?php
	}, __FILE__, 'about_section' );

	add_settings_field( 'skype_account', 'Skype: ', function() { $options = get_option( 'arina_theme_options' );
		?><input type="text" name="arina_theme_options[skype]" value="<?= isset($options['skype']) ? $options['skype'] : ''; ?>" size="40"><?php
	}, __FILE__, 'about_section' );

	add_settings_field( 'biography', 'Biography: ', function() { $options = get_option( 'arina_theme_options' );
		?><textarea name="arina_theme_options[biography]" id="arina_biography" cols="50" rows="5"><?= isset($options['biography']) ? $options['biography'] : ''; ?></textarea><?php
	}, __FILE__, 'about_section' );

	add_settings_field( 'arina_image', 'Profile image: ', function() { $options = get_option( 'arina_theme_options' );
		?><input type="file" id="arina_image" name="arina_image" size="25" /><br>
		<input type="text" name="arina_theme_options[arina_image]" value="<?php echo $options['arina_image']; ?>" size="80"><br>
		<img src="<?php echo $options['arina_image']; ?>" alt='...' width="250"><?php
	}, __FILE__, 'about_section' );



	register_setting( 'arina_options_page', 'arina_theme_options', 'arina_theme_validate' );
}

function arina_theme_validate($options) {

	if ( !empty($_FILES['arina_image']['tmp_name']) ) {
		$override = array('test_form' => false);
		$file = wp_handle_upload($_FILES['arina_image'], $override);
		$options['arina_image'] = $file['url'];
	}

	return $options;
}

add_action( 'admin_menu', 'arina_theme_options' );
add_action( 'admin_init', 'initialize_arina_theme_options' );