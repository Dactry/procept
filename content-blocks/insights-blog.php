<?php
$post_type = get_sub_field('post_type');
$loop = get_posts([
    'post_type' => $post_type,
    'posts_per_page' => 4,
]);

$loop = get_sub_field('type') == 'select' ? get_sub_field('posts') : $loop;
if (!$loop) return;

$block_args = [
    'modifier' => basename(__FILE__, '.php'),

    'block_header_show' => false,
];
get_template_part('components/block', 'start', $block_args);
get_template_part('components/block', 'header', ['spacer' => '', 'block_header_container' => 'container-lg']);
?>
<div class="container-lg spacer-section-pt">
    <div class="row gy-7 gx-xl-6">
        <?php
        foreach ($loop as $post) :
            setup_postdata($post); ?>
            <div class="col-6 col-md-4 col-lg-3 d-flex" data-animate="up">
                <?php get_template_part('components/post-card'); ?>
            </div>
        <?php
        endforeach;
        wp_reset_postdata(); ?>
    </div>
</div>
<?php
get_template_part('components/block', 'end'); ?>