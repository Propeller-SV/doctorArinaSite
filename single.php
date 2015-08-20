<?php
/**
 * single.php
 *
 * The template for displaying single posts.
 */
?>

<?php get_header(); ?>
<section class="psychology">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-5 paragraph">
				<!-- fetch the post thumbnail -->
				<?php $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_id()) ); ?>
				<img src="<?= $url; ?>" alt="" class="hidden-xs libra">
				<!-- fetch theme options -->
				<?php $options = get_option('arina_theme_options'); ?>
				<img class="doctor" src="<?= $options['arina_image'] ? $options['arina_image'] : IMAGES . '/img1.png'; ?>"/>
				<!-- Blog name and description -->
				<h3 class="text-center"><?php bloginfo( 'name' ); ?><br>
				<span><?php bloginfo( 'description' ); ?></span></h3>
				<h5 class="text-center"><?= $options['phone'] ? $options['phone'] : '80(50) 354 311 72'; ?> <span><i class="fa fa-skype"></i> <?= $options['skype'] ? $options['skype'] : 'arina@'; ?></span></h5>
				<!-- Author's biography -->
				<p class="text-center">
					<?= $options['biography'] ? $options['biography'] : 'Я профессиональный психолог-консультант, психотерапевт, веду частную практику, оказываю частные, индивидуальные психологические консультации для взрослых: краткосрочные (помощь в решении проблем) и длительные (психотерапия).'; ?>
				</p>
			</div><!-- end of .paragraph -->
			<div class="col-xs-12 col-sm-7">
				<div class="lose">
					<!-- fetch the post thumbnail (mobile view)-->
					<img class="hidden-sm hidden-md hidden-lg libra" src="<?= $url; ?>"/>
					<!-- Main page link -->
					<h6 class="text-right"><a href="<?= esc_url( home_url( '/' ) ); ?>"><i class="fa fa-arrow-left"></i> На главную</a></h6>
					<?php while (have_posts()) : the_post(); ?>
						<h4><?php the_title(); ?></h4>
						<p><?php the_content(); ?></p>
					<?php endwhile; ?>
				</div>
			</div><!-- end of .col-sm-7 -->
		</div><!-- end of .row -->
	</div><!-- end of .container -->
</section><!-- end of .psychology -->

<section class="articles">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h1 class="text-center">Похожие статьи:</h1>
			</div>
		</div>
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
	</div><!-- end of .container -->
</section><!-- end of .articles -->
<?php get_footer(); ?>