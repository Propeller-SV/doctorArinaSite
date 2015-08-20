<?php
/**
 * ----------------------------------------------------------------------------------------
 * Add metabox for Srvices
 * ----------------------------------------------------------------------------------------
 */

function services() {
	// Verify page template
	global $post;
	if (!empty($post)) {
	$pageTemplate = get_post_meta( $post->ID, '_wp_page_template', true );
		if ($pageTemplate == 'home-template.php' ) {
			add_meta_box(
			'services_area',
			'Услуги',
			'services_options',
			'page',
			'normal',
			'core'
			);
		}
	}
}

/**
 * Print the Services metabox content
 */
function services_options() {

	// fetch post meta data
	$services_data = get_post_meta( get_the_id(), 'services_data', true );

	// Use nonce for verification
	wp_nonce_field( basename( __FILE__ ), 'services_nonce' );
	?>
		<div class="service_heading">
			<label for="service_heading">Заголовок</label>
			<input type="text" id="service_heading" name="service[heading]" value="<?= $services_data['heading']; ?>" size="50">
		</div>
		<div class="service_comment">
			<label for="service_comment">Комментарий</label>
			<textarea name="service[comment]" id="service_comment" cols="50" rows="2"><?= $services_data['comment']; ?></textarea>
		</div>
		<div style="border: 2px solid">
			<div class="service_1">
				<label for="service_1">Сервис 1</label>
				<input type="text" id="service_1" name="service[1][type]" value="" size="50" value="<?= $services_data[1]['type']; ?>"><br>
				<input type="text" name="service[1][value]" placeholder="стоимость" value="<?= $services_data[1]['value']; ?>"><br>
				<input type="text" name="service[1][point][]" placeholder="пункт 1" size="70" value="<?= $services_data[1]['point'][0]; ?>"><br>
				<input type="text" name="service[1][point][]" placeholder="пункт 2" size="70" value="<?= $services_data[1]['point'][1]; ?>"><br>
				<input type="text" name="service[1][point][]" placeholder="пункт 3" size="70" value="<?= $services_data[1]['point'][2]; ?>"><br>
			</div>
		</div><br>
		<div style="border: 2px solid">
			<div class="service_2">
				<label for="service_2">Сервис 2</label>
				<input type="text" id="service_2" name="service[2][type]" value="<?= $services_data[2]['type']; ?>" size="50"><br>
				<input type="text" name="service[2][value]" placeholder="стоимость" value="<?= $services_data[2]['value']; ?>"><br>
				<input type="text" name="service[2][point][]" placeholder="пункт 1" size="70" value="<?= $services_data[2]['point'][0]; ?>"><br>
				<input type="text" name="service[2][point][]" placeholder="пункт 2" size="70" value="<?= $services_data[2]['point'][1]; ?>"><br>
				<input type="text" name="service[2][point][]" placeholder="пункт 3" size="70" value="<?= $services_data[2]['point'][2]; ?>"><br>
			</div>
		</div><br>
		<div style="border: 2px solid">
			<div class="service_3">
				<label for="service_3">Сервис 3</label>
				<input type="text" id="service_3" name="service[3][type]" value="<?= $services_data[3]['type']; ?>" size="50"><br>
				<input type="text" name="service[3][value]" placeholder="стоимость" value="<?= $services_data[3]['value']; ?>"><br>
				<input type="text" name="service[3][point][]" placeholder="пункт 1" size="70" value="<?= $services_data[3]['point'][0]; ?>"><br>
				<input type="text" name="service[3][point][]" placeholder="пункт 2" size="70" value="<?= $services_data[3]['point'][1]; ?>"><br>
				<input type="text" name="service[3][point][]" placeholder="пункт 3" size="70" value="<?= $services_data[3]['point'][2]; ?>"><br>
			</div>
		</div>
	<?php
}

/**
 * Save post action, process fields
 */
function update_services_data( $post_id, $post_object ) {
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
		if ( $pageTemplate !== 'home-template.php' ) {
		  return;
		}
	}

	// Verify authenticity
	if ( isset($_POST['services_nonce']) && !wp_verify_nonce( $_POST['services_nonce'], basename( __FILE__ ) ) )
		return;

	// Correct post type
	if ( isset($_POST['post_type']) && 'page' != $_POST['post_type'] )
		return;

	if ( isset($_POST['service']) && $_POST['service'] ) {

		// Build array for saving post meta
		$services_data = array();
		$services_data['heading'] = sanitize_text_field( $_POST['service']['heading'] );
		$services_data['comment'] = sanitize_text_field( $_POST['service']['comment'] );

		for ($i = 0; $i < 3; $i++ ) {
			$services_data[$i+1]['type'] = sanitize_text_field($_POST['service'][$i+1]['type']);
			$services_data[$i+1]['value'] = sanitize_text_field($_POST['service'][$i+1]['value']);
			for ($j=0; $j < 3; $j++) {
				$services_data[$i+1]['point'][] = sanitize_text_field($_POST['service'][$i+1]['point'][$j]);
			}
		}
		if ( $services_data )
			update_post_meta( $post_id, 'services_data', $services_data );
		else
			delete_post_meta( $post_id, 'services_data' );
	}
	// Nothing received, all fields are empty, delete option
	else {
		delete_post_meta( $post_id, 'services_data' );
	}
}


add_action('add_meta_boxes', 'services');
add_action( 'save_post', 'update_services_data', 10, 2 );