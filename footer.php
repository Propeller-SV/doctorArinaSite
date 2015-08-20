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
				<div class="pull-left logo">
					<a href=""><img src="<?= IMAGES; ?>/logo.png"/></a>
				</div>
				<div class="pull-left logo-text">
					<h5><?php bloginfo( 'name' ); ?></h5>
					<p><?php bloginfo( 'description' ); ?></p>
				</div>
			</div>
			<div class="hidden-lg col-xs-12 footer-text">
				<p class="text-center">&#169; 2015 - Все права защищены</p>
			</div>
		</div><!-- end of .row -->
	</div><!-- end of .container -->
</footer>
<script type="text/javascript">
    var k = jQuery.noConflict();
    function equalHeight(group) {
        var tallest = 0;
        group.each(function() {
            thisHeight = k(this).height();
            if(thisHeight > tallest) {
                tallest = thisHeight;
            }
        });
        group.height(tallest);
    }
    k(document).ready(function(){
    equalHeight(k(".box"));
    });
</script>
<?php wp_footer(); ?>
</body>
</html>