<?php
get_header();
global $wp_query;
$wp_query_post_type = $wp_query->query_vars['post_type'];

$post_type = get_post_type();
$post_type_title = get_field('title', "$post_type-options") ?? null;
$title = (is_home() || is_post_type_archive()) && $post_type_title ? $post_type_title : null;
$title = $title ? $title : get_the_archive_title();

$page_header_args = [
	'title' => $title,
	'img_id' => get_post_thumbnail_id(get_option('page_for_posts', true)),
];
get_template_part('components/page-header', null, $page_header_args);

$block_header_args = [
	'show' => true,
	'title' => 'Trending',
	'alignment' => 'left',
	'tag' => 'h2',
	'spacer' => '<br>',
];

$featured_posts_args = array(
	'post_type' => $wp_query_post_type,
	'posts_per_page' => -1,
	'meta_key' => 'featured_post',
	'meta_value' => true,
	'meta_compare' => '==',
);
$loop = get_posts($featured_posts_args);
if ($loop) : ?>
	<div class="rounded-block spacer-section-py bg-surface">
		<?php get_template_part('components/block-header', null, $block_header_args); ?>
		<div class="container">
			<div class="row gy-6 gx-md-6">
				<?php
				foreach ($loop as $post) :
					setup_postdata($post); ?>
					<div class="col-6" data-animate>
						<?php get_template_part('components/post-card', null, ['img_class' => 'ratio-4-3']); ?>
					</div>
				<?php endforeach;
				wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
<?php endif ?>

<div class="rounded-block spacer-section-py<?= $loop ? ' bg-dark text-white' : ' bg-surface' ?>">
	<div class="container-lg">
		<?php if (have_posts()) : ?>
			<div class="row gy-7 gx-xl-6">
				<?php while (have_posts()) : the_post(); ?>
					<div class="col-6 col-md-4 col-lg-3 d-flex" data-animate="up">
						<?php get_template_part('components/post-card'); ?>
					</div>
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
