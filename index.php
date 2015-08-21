<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 */
?>

<?php get_header(); ?>
<section class="psychology">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-5 paragraph">
				<!-- fetch theme options -->
				<?php $options = get_option('arina_theme_options'); ?>
				<img class="doctor" src="<?= $options['arina_image'] ? $options['arina_image'] : IMAGES . '/img1.png'; ?>"/>
				<!-- Blog name and description -->
				<h3 class="text-center"><?php bloginfo( 'name' ); ?><br>
				<span><?php bloginfo( 'description' ); ?></span></h3>
				<h5 class="text-center"><?= $options['phone'] ? $options['phone'] : '80(50) 354 311 72'; ?> <span><i class="fa fa-skype"></i> <?= $options['skype'] ? $options['skype'] : 'arina@'; ?></span></h5>
				<!-- Arina's biography -->
				<p class="text-center">
					<?= $options['biography'] ? $options['biography'] : 'Я профессиональный психолог-консультант, психотерапевт, веду частную практику, оказываю частные, индивидуальные психологические консультации для взрослых: краткосрочные (помощь в решении проблем) и длительные (психотерапия).'; ?>
				</p>
			</div><!-- end of .paragraph -->
			<div class="col-xs-12 col-sm-7">
				<div class="lose">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
						<p><?php the_excerpt(); ?></p>
					<?php endwhile; ?>
					<?php else : ?>
						<h6 class="text-right"><a href="<?= esc_url( home_url( '/' ) ); ?>"><i class="fa fa-arrow-left"></i> На главную</a></h6>
						<p>Извините, нет записей, удовлетворяющих вашим условиям.</p>
					<?php endif; ?>
				</div>
			</div><!-- end of .col-sm-7 -->
		</div><!-- end of .row -->
	</div><!-- end of .container -->
</section><!-- end of .psychology -->

<section class="articles">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h1 class="text-center">Полезные статьи:</h1>
			</div>
		</div>
		<?php get_template_part( 'recent_posts' ); ?>
	</div><!-- end of .container -->
</section><!-- end of .articles -->
<?php get_footer(); ?>