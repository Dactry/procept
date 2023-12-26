<?php
get_header();
get_template_part('components/page-header');
$post_type = get_post_type();
while (have_posts()) :
	the_post(); ?>
	<div class="spacer-section-py rounded-block bg-surface">
		<div class="container" data-animate>
			<div class="block-header__title">
				<h2 class="text-primary decor-line decor-line--extra decor-line--left">Description</h2>
			</div>
			<br>
			<div class="row gx-md-6">
				<div class="col-md-4">
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
					echo get_core_link(get_field('link'), 'button button--arrow');
					?>

				</div>
				<div class="col offset-md-1">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
<?php
endwhile;

get_template_part('content-blocks/vacancies', null, ['exclude' => get_the_id(), 'title' => 'More Jobs']);
get_footer();
