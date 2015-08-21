<div class="row">
	<?php $args = array( 'numberposts' => '3', 'post_type' => 'post', 'exclude' => get_the_id() ); ?>
	<?php $recent_posts = wp_get_recent_posts( $args ); ?>
	<?php foreach( $recent_posts as $recent ): ?>
		<div class="col-xs-12 col-sm-4 articles-row">
			<?php $url = wp_get_attachment_url( get_post_thumbnail_id($recent["ID"]) ); ?>
			<img src="<?= $url; ?>" alt="...">
			<div class="article">
				<h5 class="text-center"><?= $recent["post_title"] ?></h5>
				<p><?= $recent["post_excerpt"] ?></p>
				<p class="text-center"><a href="<?= get_permalink( $recent["ID"] ); ?>">Узнать больше</a></p>
			</div>
		</div>
	<?php endforeach; ?>
</div><!-- end of .row -->