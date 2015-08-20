<?php
/**
 * ----------------------------------------------------------------------------------------
 * Create pages and insert into database
 * ----------------------------------------------------------------------------------------
 */

function addDefaultPages() {

	// add home page
	$home_page = array(
		'post_title'	=> 'Home',
		'post_status'	=> 'publish',
		'post_type'		=> 'page',
		'post_content'	=> ''
		);
	$home_page_exists = get_page_by_title( $home_page['post_title'] );

	if( ! $home_page_exists) {
		$home_page_id = wp_insert_post( $home_page );
		if( $home_page_id ) {
			update_post_meta( $home_page_id, '_wp_page_template', 'home-template.php' );

			// Set "static page" as the option
			update_option( 'show_on_front', 'page' );

			// Set the front page ID
			update_option( 'page_on_front', $home_page_id );
		}
	}

	// add article page
	$article_page = array(
		'post_title'	=> 'Как похудеть с помощью психологии?',
		'post_status'	=> 'publish',
		'post_type'		=> 'post',
		'post_content'	=> '<p>"Как быстро похудеть", "Как похудеть за неделю на... кг", "Как похудеть в домашних условиях на ... кг", "Как похудеть без диет" = ежемесячно 1,5 миллиона человек ищут эту информацию на Яндексе и 1,5 миллиона человек на Гугле. Наверное, на этой планете нет ни одного человека, кто был бы всегда на 100% доволен и удовлетворен своим весом или своей фигурой. Современная цивилизация и т.н. "стандарты красоты"обеспечивают стабильную поддержку этому интересу: как можно быть довольной своей фигурой, когда с экранов телевизоров и из журналов на нас постоянно смотрят и показывают своё тело тысячи стройных и подтянутых женщин и мужчин? </p>
            <p>Разумеется, стройность и подтянутость также ассоциируется с успешностью, эффективностью, популярностью, богатством, словом, нам постоянно транслируют идею - "будешь худая - будешь счастливая!"Маркетологи и рекламщики всех мастей успешно используют эту идею для продвижения своих товаров. Бесчисленные БАДы, супер-программы, таблетки-жиросжигатели, всё новые и новые диеты и прочие "волшебные таблетки" так и сыпятся на тех, кто задумался о том, чтобы похудеть. Сегодня самым действительно эффективным способом считается одно средство, а завтра это будет совсем другое. Как разобраться?</p>
            <p>В первую очередь мишенью (и зачастую жертвой) этой идеи стоновятся именно женщины. Однако, последние десятилетия наблюдается и рост интереса к похудению у мужчин. Только из-за того что похудение и интерес к диетам всегда считался прерогативой женщин, мужчины беспокоятся о своем весе или фигуре, не особенно распространяясь об этом.</p>
            <p>Консультация психолога как похудеть? Как разобраться в мире диет?</p>
            <p>Итак, поскольку я не диетолог и не фитнес-тренер, меня интересует немного другой аспект: психология похудения. При малейших колебаниях мотивации, если случается неудача, если у вас трудности.</p>',
            'post_excerpt' => '"Как быстро похудеть", "Как похудеть за неделю на...',
		);
	$article_page_exists = get_page_by_title( $article_page['post_title'], '', 'post' );

	if( ! $article_page_exists) {
		for ($i=2; $i < 6; $i++) {
			$article_page_id = wp_insert_post( $article_page );
			if( $article_page_id ) {

				// upload and set up the post thumbnail
				$image_url = IMAGES . '/img' . $i . '.png';
				$upload_dir = wp_upload_dir();
				$image_data = file_get_contents($image_url);
				$filename = basename($image_url);
				if(wp_mkdir_p($upload_dir['path']))
					$file = $upload_dir['path'] . '/' . $filename;
				else
					$file = $upload_dir['basedir'] . '/' . $filename;
				file_put_contents($file, $image_data);

				$wp_filetype = wp_check_filetype($filename, null );
				$attachment = array(
					'post_mime_type' => $wp_filetype['type'],
					'post_title' => sanitize_file_name($filename),
					'post_content' => '',
					'post_status' => 'inherit'
				);
				$attach_id = wp_insert_attachment( $attachment, $file, $article_page_id );
				require_once(ABSPATH . 'wp-admin/includes/image.php');
				$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
				wp_update_attachment_metadata( $attach_id, $attach_data );

				set_post_thumbnail( $article_page_id, $attach_id );
			}
		}
	}
}

add_action( 'after_switch_theme', 'addDefaultPages' );