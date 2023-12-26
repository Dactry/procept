<?php
$post_type = 'project';
$loop = get_posts([
    'post_type' => $post_type,
    'posts_per_page' => 6,
]);
$loop = get_sub_field('type') == 'select' ? get_sub_field('projects') : $loop;
if (!$loop) return;

$block_args = [
    'modifier' => basename(__FILE__, '.php'),
];
get_template_part('components/block', 'start', $block_args);
$post_type_link = get_post_type_archive_link('project');
?>
<div class="container" data-animate>
    <div class="row gy-5 gx-lg-6">
        <div class="col-md-4">
            <?php the_sub_field('sidebar') ?>
            <?php get_template_part('components/categories-menu') ?>
            <br class="d-none d-md-block">
            <a href="<?= esc_url($post_type_link); ?>" class="button">View All<?= get_core_icon('arrow', 'icon-link') ?></a>
        </div>
        <div class="col">
            <div class="post-cards">
                <?php
                foreach ($loop as $post) :
                    setup_postdata($post); ?>
                    <?php get_template_part('components/post-card'); ?>
                <?php
                endforeach;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</div>
<?php
get_template_part('components/block', 'end'); ?>