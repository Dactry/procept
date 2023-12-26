<?php
$block_args = [
	'modifier' => basename(__FILE__, '.php'),
	'block_header_show' => false
];
get_template_part('components/block', 'start', $block_args);
$count_slides = count(get_sub_field('logos'));
$swiper_options = json_encode(array(
	'slidesPerView' => 3,
	'loop' => $count_slides > 3,
	'breakpoints' => [
		'768' => [
			'slidesPerView' => 4,
			'loop' => $count_slides > 4
		],
		'1200' => [
			'slidesPerView' => 6,
			'loop' => $count_slides > 6
		]
	],
	'autoplay' => [
		'delay' => 3000,
		'pauseOnMouseEnter' => true,
	]
));

echo ($title = esc_html(get_sub_field('title'))) ?
	"<div class='title-decor' data-animate><h2 class='h3 title-decor__title'><span class='text-primary decor-line decor-line--extra'></span><span class='decor-line decor-line--extra text-primary'></span>$title</h2></div><br>" : '';
?>
<?php
$images = get_sub_field('logos');
$size = 'thumbnail';
if ($images) : ?>
	<div class="swiper swiper--center" data-swiper='<?= $swiper_options; ?>' data-animate>
		<div class="swiper-wrapper">
			<?php foreach ($images as $image_id) : ?>
				<div class="swiper-slide swiper-slide--center text-center">
					<?php echo wp_get_attachment_image($image_id, $size,  null, ['loading' => 'lazy']); ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>
<?php
get_template_part('components/block', 'footer');
get_template_part('components/block', 'end');
?>