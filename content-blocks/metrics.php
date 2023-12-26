<?php
$block_args = [
	'modifier' => basename(__FILE__, '.php'),
];
get_template_part('components/block', 'start', $block_args);
$content = get_sub_field('content'); ?>
<div class="row">
	<?php if (have_rows('metrics')) : ?>
		<div class="col-md">
			<div class="row g-3">
				<?php while (have_rows('metrics')) : the_row();
					$image = get_sub_field('image');
					$title = ($title = esc_html(get_sub_field('title'))) ? "<h3 class='fs-xxs'>$title</h3>" : '';
					$description = ($description = esc_html(get_sub_field('description'))) ? "<p class='card__description'>$description</p>" : '';
					$value = ($value = esc_html(get_sub_field('value'))) ? "<span class='accent-text text-primary'>$value</span>" : '';
				?>
					<div class="col-6" data-animate>
						<div class="card bg-dark text-white">
							<div class="card__content">
								<?= $description ?>
								<?php get_template_part('components/site-circles', null, ['main_image' => $image]) ?>
								<?= $value . $title  ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	<?php endif ?>
	<?php if ($content) : ?>
		<div class="col-md-5 offset-xl-1">
			<?= $content; ?>
		</div>
	<?php endif ?>
</div>
<?php
get_template_part('components/block', 'footer');
get_template_part('components/block', 'end');
