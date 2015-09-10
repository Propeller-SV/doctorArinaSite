<?php
/**
 * Theme functions and definitions
 */

/**
 * -------------------------------------------------------------------------
 * Define constants.
 * -------------------------------------------------------------------------
 */
define( 'THEMEROOT', get_stylesheet_directory_uri() );
define( 'IMAGES', THEMEROOT . '/img' );
define( 'SCRIPTS', THEMEROOT . '/js' );
define( 'THEMEADMIN', TEMPLATEPATH . '/admin' );
define( 'THEMEFUNC', TEMPLATEPATH . '/admin/func' );

/**
 * ----------------------------------------------------------------------------------------
 * Create default pages and posts
 * ----------------------------------------------------------------------------------------
 */
require_once(THEMEFUNC . '/default_pages.php');

/**
 * ----------------------------------------------------------------------------------------
 * Include the functions for metaboxes.
 * ----------------------------------------------------------------------------------------
 */
require_once THEMEFUNC . '/top_banner_photo_metabox.php';
require_once THEMEFUNC . '/contactform_banner_photo_metabox.php';
require_once THEMEFUNC . '/main_points_metabox.php';
require_once THEMEFUNC . '/services_metabox.php';

/**
 * ----------------------------------------------------------------------------------------
 * Theme Options Menu Page
 * ----------------------------------------------------------------------------------------
 */
require_once THEMEFUNC . '/arina_theme_options.php';

/**
 * ----------------------------------------------------------------------------------------
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'arina_theme_setup' ) ) :
	function arina_theme_setup() {
		/*
		 *Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );

	}
endif; // arina_theme_setup
add_action( 'after_setup_theme', 'arina_theme_setup' );

/**
 * -------------------------------------------------------------------------
 * Load styles and scripts
 * -------------------------------------------------------------------------
 */
function current_theme_resources()
{
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/font-awesome-4.3.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery', SCRIPTS . '/jquery.min.js' );
}

add_action( 'wp_enqueue_scripts', 'current_theme_resources' );

/**
 * ----------------------------------------------------------------------------------------
 * Add Excerpts for pages
 * ----------------------------------------------------------------------------------------
 */
if (!function_exists('add_excerpts_to_pages')) {
	function add_excerpts_to_pages() {
		add_post_type_support( 'page', 'excerpt' );
	}
}	/* /add_excerpts_to_pages */
add_action( 'init', 'add_excerpts_to_pages' );

/**
 * ----------------------------------------------------------------------------------------
 * Contact form
 * ----------------------------------------------------------------------------------------
 */
function deliver_mail() {

	// if the submit button is clicked, send the email
	if ( isset( $_POST['cf_submit'] ) ) {

		// sanitize form values
		$name		= sanitize_text_field( $_POST["cf_name"] );
		$phone		= preg_replace('/[^0-9]/', '', $_POST["cf_phone"] );
		$subject	= 'Arina\'s Site response';
		$message	= "Name: $name" . "\r\n" . "Phone: $phone" . "\r\n" . esc_textarea( $_POST["cf_message"] );

		// get the blog administrator's email address
		$to = get_option( 'admin_email' );

		$headers = "From: $name, $phone" . "\r\n";

		// If email has been process for sending, display a success message
		if ( wp_mail( $to, $subject, $message, $headers ) ) {

			?>
			<script src="<?php echo SCRIPTS; ?>/jquery.min.js" type="text/javascript"></script>
			<script>
				$(document).ready(function() {
				    // $(".success").trigger('click');
				    // alert('Success');
				});
			</script>
			<?php

		} else {
			?>
			<script src="<?php echo SCRIPTS; ?>/jquery.min.js" type="text/javascript"></script>
			<script>
				$(document).ready(function() {
				    // $(".error").trigger('click');
				    // alert('Error');
				});
			</script>
			<?php
		}
	}
}

add_action( 'after_setup_theme', 'deliver_mail' );
