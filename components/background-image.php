<?php
$args = wp_parse_args(
    $args,
    array(
        'img_id' => get_post_thumbnail_id(),
        'img_id_mobile' => null,
        'curtain' => false
    )
);
extract($args);
if (!$img_id && !$img_id_mobile) return;
$img_args = [
    'class' => "stretch background-item",
    'loading' => 'lazy'
];

$img_args_mobile = [
    'class' => "stretch background-item background-item-mobile d-md-none",
    'loading' => 'lazy'
];

$image_mobile = $img_id_mobile ? wp_get_attachment_image($img_id_mobile, 'small', false, $img_args_mobile) : '';
$image = $img_id ? wp_get_attachment_image($img_id, '1536x1536', false, $img_args) : '';
echo $image_mobile ? get_core_remove_width_height_attr($image_mobile) : '';
echo $image ? get_core_remove_width_height_attr($image) : '';
if ($curtain) {
    get_template_part('components/curtain');
}
