<?php
/**
 * ----------------------------------------------------------------------------------------
 * Add metabox for Main Points of Homepage
 * ----------------------------------------------------------------------------------------
 */

function add_main_points() {
	// Verify page template
	global $post;
	if (!empty($post)) {
	$pageTemplate = get_post_meta( $post->ID, '_wp_page_template', true );
		if ($pageTemplate == 'home-template.php' ) {
			add_meta_box(
			'main_points_area',
			'Основные проблемы',
			'main_homepage_options',
			'page',
			'normal',
			'core'
			);
		}
	}
}

/**
 * Print the Main metabox content
 */
function main_homepage_options() {
	// fetch post meta data
	$main_points_data = get_post_meta( get_the_id(), 'main_points_data', true );

	// Use nonce for verification
	wp_nonce_field( basename( __FILE__ ), 'main_homepage_points_nonce' );
	?>
	<div>
		<div id="main_points">
			<?php if (isset($main_points_data['point'])): ?>
				<?php for( $i = 0; $i < count( $main_points_data['point'] ); $i++ ): ?>
					<div class="main_point" style="border : 1px solid">
						<label for="point-<?= $i+1 ?>">Пункт <?= $i+1; ?>:</label>
						<textarea id="point-<?= $i+1 ?>" name="main_points[point][]" cols="50" rows="2"><?php esc_html_e( $main_points_data['point'][$i] ); ?></textarea>
						<input class="button" type="button" value="Удалить пункт" onclick="jQuery(this).closest('div').remove();" />
					</div>
				<?php endfor; ?>
			<?php endif; ?>
		</div> <!-- end #main_points -->

		<div id="main_points_row" style="clear:both; display:none">
			<div class="main_point form-group" style="border : 1px solid">
				<textarea name="main_points[point][]" cols="50" rows="2"></textarea>
				<input class="button" type="button" value="Удалить пункт" onclick="jQuery(this).closest('div').remove();" />
			</div>
		</div>

		<div>
			<input class="button" type="button" value="Добавить пункт" onclick="jQuery('#main_points').append(jQuery('#main_points_row').html());" />
		</div>
	</div>
	<?php

}
/**
 * Save post action, process fields
 */
function update_main_points_data( $post_id, $post_object ) {
	// Doing revision, exit earlier **can be removed**
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;

	// Doing revision, exit earlier
	if ( 'revision' == $post_object->post_type )
		return;

	// Verify page template
	global $post;
	if (!empty($post)) {
		$pageTemplate = get_post_meta( $post->ID, '_wp_page_template', true );
		if ($pageTemplate !== 'home-template.php' ) {
		  return;
		}
	}

	// Verify authenticity
	if ( isset($_POST['main_homepage_points_nonce']) && !wp_verify_nonce( $_POST['main_homepage_points_nonce'], basename( __FILE__ ) ) )
		return;

	// Correct post type
	if ( isset($_POST['post_type']) && 'page' != $_POST['post_type'] )
		return;

	if ( isset($_POST['main_points']) && $_POST['main_points'] ) {
		// Build array for saving post meta
		$main_points_data = array();
		for ($i = 0; $i < count( $_POST['main_points']['point'] ); $i++ ) {
			if ( '' != $_POST['main_points']['point'][ $i ] ) {
				$main_points_data['point'][] = sanitize_text_field($_POST['main_points']['point'][ $i ]);
			}
		}

		if ( $main_points_data )
			update_post_meta( $post_id, 'main_points_data', $main_points_data );
		else
			delete_post_meta( $post_id, 'main_points_data' );
	}
	// Nothing received, all fields are empty, delete option
	else {
		delete_post_meta( $post_id, 'main_points_data' );
	}
}

add_action('add_meta_boxes', 'add_main_points');
add_action( 'save_post', 'update_main_points_data', 10, 2 );