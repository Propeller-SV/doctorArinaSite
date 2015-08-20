<?php
/**
 * Template name: Homepage template
 */
?>

<?php get_header(); ?>
<section class="banner-top">
	<?php $top_banner = get_post_meta( get_the_id(), 'top_banner_photo', true ); ?>
	<img class="img-responsive" src="<?= $top_banner ? $top_banner : IMAGES . '/banner-top.jpg'; ?>" alt="...">
	<div class="hidden-xs container">
		<div class="row">
			<div class="col-xs-12">
				<div class="banner-form">
					<h5 class="text-center">Заполните форму ниже и я свяжусь с<br>Вами в ближайшее время</h5>
					<?php get_template_part( 'contactform' ); ?>
				</div><!-- end of .banner-form -->
			</div><!-- end of .col-xs-12 -->
		</div><!-- end of .row -->
	</div><!-- end of .container -->
</section><!-- end of .banner-top -->

<section class="consultation">
	<div class="container">
		<?php if ($post->post_content) : ?>
			<?= $post->post_content; ?>
		<?php else : ?>
		<div class="row">
			<div class="col-xs-12">
				<h2 class="text-center">Когнитивно-поведенческая психотерапия и консультирование.</h2>
				<p class="text-center">В Одессе и других городах.</p>
			</div>
		</div>
		<div class="row main-row">
			<div class="col-xs-12 col-sm-4 paragraph">
				<img src="<?= IMAGES; ?>/foto-1.jpg"/>
				<h3 class="text-center">Индивидуальная консультация</h3>
				<p class="text-center">Очная консультация психолога - наилучший способ начать общение. Анонимность и профессиональный подход.</p>
			</div>
			<div class="col-xs-12 col-sm-4 paragraph">
				<img src="<?= IMAGES; ?>/foto-2.jpg"/>
				<h3 class="text-center">Консультация психолога онлайн</h3>
				<p class="text-center">Бесплатная консультация на сайте или платная по электронной почте. Выберите подходящий для Вас вариант.</p>
			</div>
			<div class="col-xs-12 col-sm-4 paragraph">
				<img src="<?= IMAGES; ?>/foto-3.jpg"/>
				<h3 class="text-center">Консультация психолога по скайпу</h3>
				<p class="text-center">Для тех, кто находится не в Москве или по каким-то причинам предпочитает общение через Skype.</p>
			</div>
		</div><!-- end of .main-row -->
	<?php endif; ?>
	</div><!-- end of .container -->
</section><!-- end of .consultation -->

<section class="psychology">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-5 paragraph">
				<!-- fetch theme options -->
				<?php $options = get_option('arina_theme_options'); ?>
				<img src="<?= $options['arina_image'] ? $options['arina_image'] : IMAGES . '/img1.png'; ?>"/>
				<h3 class="text-center"><?php bloginfo( 'name' ); ?><br>
				<span><?php bloginfo( 'description' ); ?></span></h3>
				<h5 class="text-center"><?= $options['phone'] ? $options['phone'] : '80(50) 354 311 72'; ?><span><i class="fa fa-skype"></i> <?= $options['skype'] ? $options['skype'] : 'arina@'; ?></span></h5>
				<p class="text-center">
					<?= $options['biography'] ? $options['biography'] : 'Я профессиональный психолог-консультант, психотерапевт, веду частную практику, оказываю частные, индивидуальные психологические консультации для взрослых: краткосрочные (помощь в решении проблем) и длительные (психотерапия).'; ?>
				</p>
			</div><!-- end of .paragraph -->
			<div class="col-xs-12 col-sm-7">

				<!-- fetch main points if exist -->
				<?php $main_points = get_post_meta( get_the_id(), 'main_points_data', true ); ?>
				<?php if (isset($main_points['point'][0])) : ?>
					<ul class="fa-ul">
					<?php for ($i=0; $i < count($main_points['point']); $i++) : ?>
						<li><i class="fa-li fa fa-check"></i>
							<?= $main_points['point'][$i]; ?>
						</li>
					<?php endfor; ?>
					</ul>
				<?php else : ?>
				<ul class="fa-ul">
					<li><i class="fa-li fa fa-check"></i>
						проблемы в отношениях с другими людьми и с самим собой
					</li>
					<li><i class="fa-li fa fa-check"></i>
						как повысить самооценку, низкая уверенность в себе
					</li>
					<li><i class="fa-li fa fa-check"></i>
						творческий кризис и кризис среднего возраста
					</li>
					<li><i class="fa-li fa fa-check"></i>
						проблемы с питанием (анорексия, булимия и пр.)
					</li>
					<li><i class="fa-li fa fa-check"></i>
						психологические консультации для желающих похудеть
					</li>
					<li><i class="fa-li fa fa-check"></i>
						проблемы на работе (с начальством, с подчиненными, с задачами, с каръерой, HR-консультирование)
					</li>
					<li><i class="fa-li fa fa-check"></i>
						принятие сложных решений
					</li>
					<li><i class="fa-li fa fa-check"></i>
						как избавиться от социофобии и других страхов, тревог и фобий
					</li>
					<li><i class="fa-li fa fa-check"></i>
						как преодолеть депрессию, грусть и потерю удовольствия от жизни
					</li>
					<li><i class="fa-li fa fa-check"></i>
						перфекционизм, раздражительность, навязчивые мысли и поведение и др.
					</li>
				</ul><!-- end of .fa-ul -->
				<?php endif; ?>
			</div><!-- end of .col-sm-7 -->
		</div><!-- end of .row -->
	</div><!-- end of .container -->
</section><!-- end of .psychology -->

<section class="services">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 heading">
				<p class="text-center"><i class="fa fa-shopping-cart"></i></p>

				<!-- fetch services data if exist -->
				<?php $services_data = get_post_meta( get_the_id(), 'services_data', true ); ?>
				<h1 class="text-center"><?= isset($services_data['heading']) ? $services_data['heading'] : 'Услуги психолога'; ?></h1>
				<h5 class="text-center">
				<?= isset($services_data['comment']) ? $services_data['comment'] : 'Уважаемые клиенты! В настоящий момент я консультирую по скайпу или по электронной почте. По очным консультациям - уточняйте, пожалуйста, в индивидуальном порядке.'; ?>
				</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-4">
				<div class="box-left box">
					<h2 class="text-center"><?= isset($services_data[1]['type']) ? $services_data[1]['type'] : 'Очная консультация'; ?></h2>
					<h1 class="text-center"><?= isset($services_data[1]['value']) ? $services_data[1]['value'] : '$300'; ?></h1>
					<ul class="fa-ul">
						<li><i class="fa-li fa fa-check-square-o"></i>
							<?= isset($services_data[1]['point'][0]) ? $services_data[1]['point'][0] : '50 минут'; ?>
						</li>
						<li><i class="fa-li fa fa-check-square-o"></i>
							<?= isset($services_data[1]['point'][1]) ? $services_data[1]['point'][1] : 'Оплата по факту'; ?>
						</li>
						<li><i class="fa-li fa fa-check-square-o"></i>
							<?= isset($services_data[1]['point'][2]) ? $services_data[1]['point'][2] : 'Только наличными в офисе после приема'; ?>
						</li>
					</ul>
				</div><!-- end of .box-left -->
			</div><!-- end of .col-sm-4 -->
			<div class="col-xs-12 col-sm-4">
				<div class="box-center box">
					<h2 class="text-center"><?= isset($services_data[2]['type']) ? $services_data[2]['type'] : 'Skype'; ?></h2>
					<h1 class="text-center"><?= isset($services_data[2]['value']) ? $services_data[2]['value'] : '$200'; ?></h1>
					<ul class="fa-ul">
						<li><i class="fa-li fa fa-check-square-o"></i>
							<?= isset($services_data[2]['point'][0]) ? $services_data[2]['point'][0] : '50 минут'; ?>
						</li>
						<li><i class="fa-li fa fa-check-square-o"></i>
							<?= isset($services_data[2]['point'][1]) ? $services_data[2]['point'][1] : 'Оплата по факту'; ?>
						</li>
						<li><i class="fa-li fa fa-check-square-o"></i>
							<?= isset($services_data[2]['point'][2]) ? $services_data[2]['point'][2] : 'Оплата: PayPal, Яндекс. Деньги банковские карты'; ?>
						</li>
					</ul>
				</div><!-- end of .box-center -->
			</div><!-- end of .col-sm-4 -->
			<div class="col-xs-12 col-sm-4">
				<div class="box-right box">
					<h2 class="text-center"><?= isset($services_data[3]['type']) ? $services_data[3]['type'] : 'Электронная почта'; ?></h2>
					<h1 class="text-center"><?= isset($services_data[3]['value']) ? $services_data[3]['value'] : '$150'; ?></h1>
					<ul class="fa-ul">
						<li><i class="fa-li fa fa-check-square-o"></i>
							<?= isset($services_data[3]['point'][0]) ? $services_data[3]['point'][0] : '50 минут'; ?>
						</li>
						<li><i class="fa-li fa fa-check-square-o"></i>
							<?= isset($services_data[3]['point'][1]) ? $services_data[3]['point'][1] : 'Оплата по факту'; ?>
						</li>
						<li><i class="fa-li fa fa-check-square-o"></i>
							<?= isset($services_data[3]['point'][2]) ? $services_data[3]['point'][2] : 'Оплата: PayPal, Яндекс. Деньги банковские карты'; ?>
						</li>
					</ul>
				</div><!-- end of .box-right -->
			</div><!-- end of .col-sm-4 -->
		</div><!-- end of .row -->
	</div><!-- end of .container -->
</section><!-- end of .services -->

<section class="articles">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h1 class="text-center">Полезные статьи:</h1>
			</div>
		</div>
		<div class="row">
			<?php $args = array( 'numberposts' => '3', 'post_type' => 'post' ); ?>
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

<!-- Set custom background if exist -->
<?php $contactform_background = get_post_meta( get_the_id(), 'contactform_banner_photo', true ); ?>
<section class="hidden-sm hidden-md banner-bottom" <?= $contactform_background ? 'style="background-image:url(' . $contactform_background . ')"' : ''; ?> >
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="banner-form">
					<h3 class="hidden-xs text-center">Заполните форму ниже и я свяжусь с Вами в ближайшее время</h3>
					<h5 class="hidden-lg text-center">Заполните форму ниже и я свяжусь с<br>Вами в ближайшее время</h5>
					<?php get_template_part( 'contactform' ); ?>
				</div><!-- end of .banner-form -->
			</div><!-- end of .col-xs-12 -->
		</div><!-- end of .row -->
	</div><!-- end of .container -->
</section><!-- end of .banner-bottom -->
<?php get_footer(); ?>