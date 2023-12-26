<?php
$block_args = [
	'modifier' => basename(__FILE__, '.php'),
];
get_template_part('components/block', 'start', $block_args);
$items_per_row = get_core_items_per_row();
$gap = get_sub_field('items_per_row') < 3 ? 'g-4 g-xl-6' : 'g-3';
$col_sidebar = get_sub_field('items_per_row') > 3 ? 'col-xl-3' : '';
$content = get_sub_field('content'); ?>
<div class="row g-4 gx-md-6">
	<?php if ($content) : ?>
		<div class="col-lg-4 <?= $col_sidebar ?>">
			<div class="el-sticky">
				<?= $content; ?>
			</div>
		</div>
	<?php endif ?>
	<?php if (have_rows('cards')) : ?>
		<div class="col offset-xl-1">
			<div class="row justify-content-center <?= $gap . ' ' . $items_per_row; ?>">
				<?php while (have_rows('cards')) : the_row();
					$i = get_row_index();
					$index = $i < 10 ? "0$i" : $i;
					$col = get_sub_field('content') ? "col-12" : 'col';
				?>
					<div class="<?= $col ?>" data-animate="up">
						<?php get_template_part('components/card', null, ['i' => $index]); ?>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	<?php endif ?>
</div>
<?php
get_template_part('components/block', 'footer');
get_template_part('components/block', 'end');
