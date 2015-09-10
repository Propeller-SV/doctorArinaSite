<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">
	<meta name="author" content="">

	<title><?php wp_title( '' ); ?>Арина Боровик психолог-консультант</title>

	<!-- Just for debugging purposes. Don't actually copy this line! -->
	<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
	<header>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-6">
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
				<div class="col-xs-12 col-sm-4 col-md-3 phone-text">
					<!-- fetch theme options -->
					<?php $options = get_option('arina_theme_options'); ?>
					<h5>Звоните прямо сейчас! <span><?= $options['phone'] ? $options['phone'] : '80(50) 354 311 72'; ?></span></h5>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-3 email-text">
					<p><?= $options['email'] ? $options['email'] : 'arinapsihologyst@gmail.com'; ?></p>
				</div>
			</div><!-- end of .row -->
		</div><!-- end of .container -->
	</header>