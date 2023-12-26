
<div class="underline-reverse post-card el-clip">
    <a href="<?php the_permalink(); ?>">
        <div class="row">
            <div class="col">
                <h3 class="h6"><?php the_title(); ?></h3>
            </div>
            <div class="col-auto"><?= get_core_icon('arrow', 'icon-link') ?></div>
        </div>
        <div class="bg-surface ratio-4-3">
            <?= get_core_remove_width_height_attr(get_the_post_thumbnail(get_the_ID(), 'small', ['class' => 'stretch', 'loading' => 'lazy'])); ?>
        </div>
    </a>
</div>