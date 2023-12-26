<?php
get_header();
$title = is_archive() ? get_the_archive_title() : get_the_title(get_option('page_for_posts', true));
$page_header_args = [
	'title' => $title,
	'img_id' => get_post_thumbnail_id(get_option('page_for_posts', true)),
];
get_template_part('components/page-header', null, $page_header_args);
?>
<div class="rounded-block spacer-section-pt">
	<div class="container">
		<div class="pos-rel">
			<?php get_template_part('components/categories-menu', null, ['class' => 'row-menu']) ?>
		</div>
	</div>
	<?php
	$term = get_queried_object();
	$taxonomy = $term->taxonomy ?? null;
	if ($taxonomy) {
		$term_id = $term->term_id;
		get_template_part('components/content-blocks', null, ['object_id' => $taxonomy . '_' . $term_id]);
	}
	?>
	<div class="container">
		<?php if (have_posts()) : ?>
			<div class="post-cards spacer-section-py columns-3">
				<?php while (have_posts()) : the_post(); ?>
					<?php get_template_part('components/post-card'); ?>
				<?php endwhile; ?>
			</div>
			<?php get_template_part('components/pagination'); ?>
		<?php else : ?>
			<h2>Nothing Found</h2>
		<?php endif; ?>
	</div>
</div>
<?php
get_footer();
