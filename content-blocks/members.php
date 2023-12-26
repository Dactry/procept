<?php
$post_type = 'member';
$loop = get_posts([
    'post_type' => $post_type,
    'posts_per_page' => -1,
]);
$loop = get_sub_field('type') == 'select' ? get_sub_field('members') : $loop;
if (!$loop) return;

$block_args = [
    'modifier' => basename(__FILE__, '.php'),
];
get_template_part('components/block', 'start', $block_args);
$swiper_loop = count($loop) > 4;
$swiper_options = json_encode(array(
    'slidesPerView' => 4,
    'loop' => $swiper_loop,
    'centeredSlides' => true,
    'slidesPerView' => 'auto',
));
?>
<br class="d-md-none">
<div class="swiper members-slider" data-swiper='<?= $swiper_options ?>'>
    <div class="swiper-wrapper align-items-end">
        <?php
        foreach ($loop as $post) :
            setup_postdata($post);
            $title = ($title = esc_html(get_the_title())) ? "<h3>$title</h3>" : "";
            $subtitle = ($subtitle = esc_html(get_field('subtitle'))) ?
                "<span class='text-label'>$subtitle</span>" : "";
        ?>
            <div class="swiper-slide member-card">
                <div class="member-card__body">
                    <div class="member-card__content el-clip vstack gap-4">
                        <div class="vstack gap-1">
                            <?= $title ?>
                            <?= $subtitle ?>
                        </div>
                        <div class="fs-xs hstack gap-4"><?php the_content() ?></div>
                    </div>
                    <div class="member-card__img">
                        <?= get_the_post_thumbnail(null, 'medium', ['loading' => 'lazy']) ?>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
        wp_reset_postdata(); ?>
    </div>
    <br>
    <div class='text-center spacer-element-sm'>
        <?php get_template_part('components/slider-controls') ?>
    </div>
</div>
<?php
get_template_part('components/block', 'end'); ?>