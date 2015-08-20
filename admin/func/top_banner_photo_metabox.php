<?php
/**
 * ----------------------------------------------------------------------------------------
 * Add metabox for Top Banner Photo
 * ----------------------------------------------------------------------------------------
 */

function top_banner_photo_metabox() {
	// Verify page template
	global $post;
	if (!empty($post)) {
		$pageTemplate = get_post_meta( $post->ID, '_wp_page_template', true );
		if ($pageTemplate == 'home-template.php') {
			add_meta_box(
				'top_banner_photo_metabox',
				'Top Banner Photo',
				'top_banner_metaboxe_options',
				'page',
				'normal',
				'core'
			);
		}
	}
}

/**
 * Print the Meta Box content
 */
function top_banner_metaboxe_options() {

	$top_banner = get_post_meta( get_the_id(), 'top_banner_photo', true );

	wp_nonce_field(plugin_basename(__FILE__), 'top_banner_photo_metabox_nonce');
	?>
	<div class="banner" style="border: 2px solid">
		<p class="description">Top banner photo:</p>
		<input type="text" id="banner" name="top_banner_photo" size="80" value="<?= $top_banner; ?>">
		<input class="button" type="button" value="Upload image" onclick="add_image(this)">
		<div class="image_wrap"><img src="<?= $top_banner; ?>" width="100" alt="..." /></div>
	</div>
	<?php
}

/**
 * Media Upload script
 */
function top_banner_upload_script() {

// Check for correct post_type
global $post;
if( 'page' != $post->post_type )
	return;
?>
<script type="text/javascript">
	function add_image(obj) {
		var parent=jQuery(obj).parent('div.banner');
		var inputField = jQuery(parent).find('input#banner');

		tb_show('', 'media-upload.php?TB_iframe=true');

		window.send_to_editor = function(html) {
			var url = jQuery(html).find('img').attr('src');
			inputField.val(url);
			jQuery(parent)
			.find("div.image_wrap")
			.html('<img src="'+url+'" height="100">');

			tb_remove();
		};
	return false;
	}
</script>
<?php
}

function save_top_banner_data($id) {

	/* --- security verification --- */
	if( isset($_POST['top_banner_photo_metabox_nonce']) && !wp_verify_nonce($_POST['top_banner_photo_metabox_nonce'], plugin_basename(__FILE__))) {
	  return $id;
	} // end if

	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
	  return $id;
	} // end if

	if(isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
		if(!current_user_can('edit_page', $id)) {
		return $id;
		} // end if
	} else {
		if(!current_user_can('edit_page', $id)) {
			return $id;
		} // end if
	} // end if
	/* - end security verification - */

	// add brand photo URL to database if exist

	if ( isset($_POST['top_banner_photo']) ) {
		// Build array for saving post meta
    	if ( '' != $_POST['top_banner_photo'] ) {
			$top_banner_photo  = esc_url($_POST['top_banner_photo']);
			update_post_meta( $id, 'top_banner_photo', $top_banner_photo );
	    }
		else
	    	delete_post_meta( $id, 'top_banner_photo' );
	}
	// Nothing received, field is empty, delete option
	else {
		delete_post_meta( $id, 'top_banner_photo' );
	}

} // end save_top_banner_data

add_action('add_meta_boxes', 'top_banner_photo_metabox');
add_action('admin_head-post.php', 'top_banner_upload_script');
add_action('save_post', 'save_top_banner_data');






