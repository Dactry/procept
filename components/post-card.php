<?php
$args = wp_parse_args($args, [
    'class' => '',
    'img_class' => 'post-card__img--ratio',
]);
extract($args);
$post_type = get_post_type();
$subtitle = ($subtitle = get_field('subtitle')) ?
    "<p class='post-card__subtitle'>$subtitle</p>" : "";
?>

<a href="<?php the_permalink(); ?>" class="post-card<?= $class ?>">
    <div class="post-card__body">
        <div class="post-card__content vstack">
            <h3 class="post-card__title"><?php the_title(); ?></h3>
            <?= $subtitle; ?>
            <?php if (get_post_type() === 'post' && false) : ?>
                <span class="post-card__subtitle"><?= esc_html(get_the_date()); ?></span>
            <?php endif; ?>
        </div>
        <?= get_core_icon('arrow', 'post-card__icon icon-link fs-xs d-none d-md-block') ?>
    </div>
    <div class="post-card__img el-clip <?= $img_class ?>">
        <?= get_core_remove_width_height_attr(get_the_post_thumbnail(get_the_ID(), 'medium', ['class' => 'stretch', 'loading' => 'lazy'])); ?>
    </div>
</a>