<?php
$loop = get_posts([
    'post_type' => 'testimonial',
    'posts_per_page' => 4,
]);
$loop = get_sub_field('type') == 'select' ? get_sub_field('testimonial') : $loop;
if (!$loop) return;


$swiper_options = json_encode(array(
    'effect' => 'fade',
    'loop' => true,
    'autoplay' => [
        'delay' => 3000,
        'pauseOnMouseEnter' => true,
    ]
));

$slider_args = count($loop) > 1 ? "data-swiper='$swiper_options'" : null;

$block_args = [
    'modifier' => basename(__FILE__, '.php'),
    'block_header_show' => false,
];

get_template_part('components/block', 'start', $block_args);
get_template_part('components/block-header', null, ['content' => false]);
$block_header_show = get_sub_field('block_header_show');
$description = $block_header_show ? get_sub_field('description') : '';
?>
<div class="container" data-animate>
    <div class="row gy-3">
        <?php echo $description ? "<div class='col-md-4'>$description</div>" : '' ?>
        <div class="col-md-8 col-lg-7 offset-lg-1">
            <div class="swiper testimonials" <?= $slider_args ?>>
                <div class="swiper-wrapper">
                    <?php
                    foreach ($loop as $post) :
                        setup_postdata($post);
                        $title = ($title = esc_html(get_the_title())) ?
                            "<h4 class='h6 fw-bold'>$title</h4>" : null;
                        $subtitle = ($subtitle = esc_html(get_field('subtitle'))) ? $subtitle : null;
                    ?>
                        <div class="swiper-slide">
                            <div class="row gx-0 justify-content-between">
                                <div class="col-md-auto">
                                    <div class="testimonials__img">
                                        <?= get_the_post_thumbnail(null, 'thumbnail', ['loading' => 'lazy']) ?>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="vstack spacer-element">
                                        <?= $title ?>
                                        <?= $subtitle ?>
                                    </div>
                                    <?php the_content() ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    wp_reset_postdata(); ?>
                </div>
                <?php get_template_part('components/slider-controls', null, ['pagination' => false, 'class' => 'testimonials__pagination']) ?>
            </div>
        </div>
    </div>
</div>
<?php
get_template_part('components/block', 'end'); ?>