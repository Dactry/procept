<?php
$args = wp_parse_args($args, array(
    'pagination' => true,
    'fraction' => false,
    'class' => ''
));
extract($args);
?>
<div class="d-inline-flex align-items-center <?= $class ?>" data-animate>
    <button type="button" aria-label="Previous slide" class="button button--square swiper-button" data-swiper-navigation="prev">
        <?= get_core_icon('arrow', 'rotate-180 fs-md'); ?>
    </button>
    <?php if ($fraction) : ?><span class="current-slide"></span><?php endif; ?>
    <?php if ($pagination) : ?> <div class="swiper-pagination" data-swiper-pagination></div><?php endif; ?>
    <?php if ($fraction) : ?><span class="total-slides"></span><?php endif; ?>
    <button type="button" aria-label="Next slide" class="button button--square swiper-button" data-swiper-navigation="next">
        <?= get_core_icon('arrow', 'fs-md'); ?>
    </button>
</div>