<?php
get_header();
$post_type = get_post_type();

get_template_part('components/content-blocks');
$related = get_posts(
	array(
		'post_type' => $post_type,
		'numberposts'  => 8,
		'exclude' => get_the_ID(),
	)
);
if ($related) :
	$count_slides = count($related);
	$slidesPerViewMobile = 1;
	$slidesPerViewTablet = 3;
	$slidesPerView = 4;
	$swiper_options = json_encode(array(
		'slidesPerView' => $slidesPerViewMobile,
		'loop' => $count_slides > $slidesPerViewMobile,
		'breakpoints' => [
			'768' => [
				'slidesPerView' => $slidesPerViewTablet,
				'loop' => $count_slides > $slidesPerViewTablet,
			],
			'1200' => [
				'slidesPerView' => $slidesPerView,
				'loop' => $count_slides > $slidesPerView
			]
		],
		'autoplay' => [
			'delay' => 3000,
			'pauseOnMouseEnter' => true,
		]
	));
?>
	<div class="bg-dark text-white rounded-block">
		<div class="container-lg spacer-section-py">
			<div class="swiper" data-swiper='<?= $swiper_options ?>' data-animate>
				<div class="block-header__title">
					<h2 class="text-primary decor-line decor-line--extra decor-line--left">Projects & Capabilites</h2>
				</div>
				<div class="row align-items-center spacer-section-pb">
					<div class="col">
						<h2 class="h3">Medical technology projects</h2>
					</div>
					<div class="col-auto">
						<?php get_template_part('components/slider-controls', null, ['pagination' => false]) ?>
					</div>
				</div>

				<div class="swiper-wrapper post-cards">
					<?php
					foreach ($related as $post) :
						setup_postdata($post);
					?>
						<div class="swiper-slide d-flex h-auto">
							<?php get_template_part('components/post-card', null, ['class' => ' post-card--ratio-1-1']); ?>
						</div>
					<?php endforeach;
					wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
	<?php get_core_swiper_enqueue() ?>
<?php endif; ?>

<?php


get_footer();
