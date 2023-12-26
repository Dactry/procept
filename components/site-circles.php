<?php
$args = wp_parse_args($args, [
    'main_image' => '',
    'xs_image' => '',
    'sm_image' => '',
    'md_image' => '',
]);

extract($args);

$main_image = $main_image ? wp_get_attachment_image($main_image, 'thumbnail', null, ['loading' => 'lazy']) : '';
$xs_image = $xs_image ? wp_get_attachment_image($xs_image, 'thumbnail', null, ['loading' => 'lazy']) : '';
$sm_image = $sm_image ? wp_get_attachment_image($sm_image, 'thumbnail', null, ['loading' => 'lazy']) : '';
$md_image = $md_image ? wp_get_attachment_image($md_image, 'thumbnail', null, ['loading' => 'lazy']) : '';
?>

<div class="site-circles">
    <div class="site-circles__image">
        <?= $main_image; ?>
    </div>
    <div class="site-circles__image">
        <?= $xs_image; ?>
    </div>
    <div class="site-circles__image">
        <?= $sm_image; ?>
    </div>
    <div class="site-circles__image">
        <?= $md_image; ?>
    </div>
</div>