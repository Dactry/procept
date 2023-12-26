<?php
get_header();
get_template_part('components/page-header');
$post_type = get_post_type();
$sidebar_col = 'col-md-4';
$content_col = 'col offset-md-1';

while (have_posts()) :
	the_post(); ?>
	<div class="spacer-section-py rounded-block">
		<div class="container" data-animate>
			<div class="block-header__title">
				<span class="text-primary decor-line decor-line--extra decor-line--left">UPD: <?= get_the_date() ?> / by <?= get_the_author() ?></span>
			</div>
			<br>
			<div class="row gx-md-6">
				<div class="<?= $sidebar_col ?>">
					<?php
					$tags = get_the_tags();
					if ($tags) {
						echo '<ul>';
						foreach ($tags as $tag) {
							echo '<li>' . esc_html($tag->name) . '</li>';
						}
						echo '</ul>';
					}
					echo has_excerpt() ? the_excerpt() : null;
					?>

				</div>
				<div class="<?= $content_col ?>">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
<?php endwhile; ?>

<?php
$title = get_the_title();
$post_url = urlencode(get_permalink());
$post_title = urlencode($title);
$social_args = [
	'social_icons' => [
		'facebook' => "https://www.facebook.com/sharer.php?u=$post_url",
		'twitter' => "https://twitter.com/intent/tweet?text=$post_title&url=$post_url",
		'linkedin' => "https://www.linkedin.com/sharing/share-offsite/?url=$post_url",
		'email' => "mailto:?subject=$title&body=Check out this link: $post_url",
	]
];
$content = get_field('cta_share_post', 'options');
$link = ($link = do_shortcode('[cta-link]')) ? "<div class='col-auto spacer-element'>$link</div>" : '';
?>

<div class="spacer-section-py rounded-block bg-surface">
	<div class="container" data-animate>
		<div class="block-header__title">
			<span class="text-primary decor-line decor-line--extra decor-line--left">SHARE THIS POST:</span>
		</div>
		<br>
		<div class="row gy-4 gx-md-6">
			<div class="<?= $sidebar_col ?>">
				<?php get_template_part('components/social-icons', null, $social_args) ?>
			</div>
			<div class="<?= $content_col ?>">
				<div class="row gx-md-6">
					<div class="col-lg">
						<?= $content ?>
					</div>
					<?= $link; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
$related = get_posts(
	array(
		'post_type' => $post_type,
		'numberposts'  => 8,
		'exclude' => get_the_ID(),
	)
);
if ($related) : ?>
	<div class="bg-dark text-white rounded-block">
		<div class="container-lg spacer-section-py">
			<?php
			$count_slides = count($related);
			$slidesPerViewMobile = 2;
			$slidesPerViewTablet = 3;
			$slidesPerView = 4;
			$swiper_options = json_encode(array(
				'slidesPerView' => $slidesPerViewMobile,
				'loop' => $count_slides > $slidesPerViewMobile,
				'breakpoints' => [
					'768' => [
						'slidesPerView' => $slidesPerViewTablet,
						'loop' => $count_slides > $slidesPerViewTablet,
						'spaceBetween' => 30,
					],
					'1200' => [
						'slidesPerView' => $slidesPerView,
						'spaceBetween' => 60,
						'loop' => $count_slides > $slidesPerView
					]
				],
				'autoplay' => [
					'delay' => 3000,
					'pauseOnMouseEnter' => true,
				]
			));
			?>

			<div class="swiper" data-swiper='<?= $swiper_options ?>' data-animate>
				<div class="block-header__title">
					<h2 class="text-primary decor-line decor-line--extra decor-line--left">Expert Insights</h2>
				</div>
				<div class="row align-items-center spacer-section-pb">
					<div class="col">
						<h2 class="h3">You may also like</h2>
					</div>
					<div class="col-auto">
						<?php get_template_part('components/slider-controls', null, ['pagination' => false]) ?>
					</div>
				</div>

				<div class="swiper-wrapper">
					<?php
					foreach ($related as $post) :
						setup_postdata($post);
					?>
						<div class="swiper-slide d-flex h-auto">
							<?php get_template_part('components/post-card'); ?>
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
