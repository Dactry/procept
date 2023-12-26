<?php
$block_args = [
	'modifier' => basename(__FILE__, '.php'),
	'rounded_block' => false
];
$height = get_core_height();
$align = get_core_vertical_align();
get_template_part('components/block', 'start', $block_args);
$has_slider = count(get_sub_field('slides')) > 1;
$swiper_options = json_encode(array(
	'effect' => 'fade',
	'loop' => true
));
$slider_args = $has_slider ? "data-swiper='$swiper_options'" : null;
?>

<?php if (have_rows('slides')) : ?>

	<div class="swiper hero-slider" <?= $slider_args ?> data-swiper-custom-pagination>
		<div class="swiper-wrapper">
			<?php while (have_rows('slides')) : the_row();
				$content = get_sub_field('content');
				$image = wp_get_attachment_image(get_sub_field('image'), 'medium_large', null, ['class' => 'hero-slider__img']);
			?>
				<div class="swiper-slide d-flex align-items-center">
					<?php get_template_part('components/background') ?>
					<div class="container-lg hero-slider__body <?= $height; ?>">
						<div class="row gy-6 <?= $align ?>">
							<div class="col-md-6 hero-slider__content">
								<?= $content; ?>
							</div>
							<div class="col d-flex">
								<?= $image ?>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
		<?php if ($has_slider) : ?>
			<div class="container-lg swiper-pagination--hero">
				<?php get_template_part('components/slider-controls', null, ['fraction' => true, 'class' => 'gap-4']) ?>
			</div>
		<?php endif ?>
	</div>

<?php endif ?>
<?php
get_template_part('components/block', 'footer');
get_template_part('components/block', 'end');
