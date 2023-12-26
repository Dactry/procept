<?php

$args = wp_parse_args(
    $args,
    array(
        'modifier' => null,
        'class' => null,
        'block_header_show' => true,
        'block_header_container' => 'container',
        'rounded_block' => true
    )
);
extract($args);
$rounded_blocks = !is_tax() && $rounded_block ?  'rounded-block' : null;
//Modifier
if ($modifier) {
    $modifier = CONTENT_BLOCK_MODIFIER . $modifier;
}

$outher_class = get_core_filter_implode([
    CONTENT_BLOCK_CLASS,
    $modifier,
    get_core_spacer(),
    get_core_height(),
    get_core_color_text_white(),
    get_core_rounded_block(),
    $class,
    $rounded_blocks
]);

$content_class = get_core_filter_implode([
    CONTENT_BLOCK_CONTENT,
    get_core_container_width()
]);

?>
<div class="<?= $outher_class ?>">
    <?php
    if ($block_header_show) {
        get_template_part('components/block-header', null, ['block_header_container' => $block_header_container]);
    }
    ?>
    <?php get_template_part('components/background'); ?>
    <div class="<?= $content_class ?>">