<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 */
?>
<footer>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-lg-4 footer-phone-text">
				<!-- fetch theme options -->
				<?php $options = get_option('arina_theme_options'); ?>
				<h5><?= $options['phone'] ? $options['phone'] : '80(50) 354 311 72'; ?> <span><i class="fa fa-skype"></i> <?= $options['skype'] ? $options['skype'] : 'arina@'; ?></span></h5>
			</div>
			<div class="hidden-xs hidden-sm hidden-md col-lg-4 footer-text">
				<p class="text-center">&#169; 2015 - Все права защищены</p>
			</div>
			<div class="col-xs-12 col-sm-4 col-lg-4">
				<table border="0">
					<tr>
						<td rowspan="2"><a href="<?= esc_url( home_url( '/' ) ); ?>"><img src="<?= IMAGES; ?>/logo.png"/></a></td>
						<td class="logo-text"><h5><?php bloginfo( 'name' ); ?></h5></td>
					</tr>
					<tr>
						<td class="logo-text"><p><?php bloginfo( 'description' ); ?></p></td>
					</tr>
				</table>
			</div>
			<div class="hidden-lg col-xs-12 footer-text">
				<p class="text-center">&#169; 2015 - Все права защищены</p>
			</div>
		</div><!-- end of .row -->
	</div><!-- end of .container -->
</footer>
<?php wp_footer(); ?>
</body>
</html>