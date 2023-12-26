<?php
$link = get_sub_field('link');

$args = wp_parse_args(
    $args,
    array(
        'image_id' => get_sub_field('image'),
        'icon' => get_sub_field('icon'),
        'hover' => get_sub_field('text_on_hover'),
        'title' => get_sub_field('title'),
        'content' => get_sub_field('content'),
        'link_title' => $link ? $link['title'] : null,
        'link_url' => $link ? $link['url'] : null,
        'link_target' => $link ? $link['target'] : null,
        'i' => '',
    )
);
extract($args);

$link_attributes = sprintf(' href="%1$s"%2$s', esc_url($link_url), $link_target === '_blank' ? " target='_blank'" : null);
$content_class = $hover ? " card__text--hover" : '';
$content = $content ? "<div class='card__text$content_class'>$content</div>" : '';
$header_mb = !$content ? " mb-auto" : '';
$icon = ($icon = wp_get_attachment_image($icon, 'thumbnail', null, ['loading' => 'lazy'])) ?
    "<div class='card__icon'>$icon</div>" : '';
$i = $i && $icon ? "<span class='fs-xs'>" . esc_html($i) . "</span>" : '';
$title = "<h3 class='h6 m-0'>" . esc_html($title) . "</h3>";

$row_tag = 'div';
$row_attributes = "class='row align-items-baseline card__title'";
if ($link_url) {
    $row_tag = 'a';
    $row_attributes .= $link_attributes;
};

?>
<div class='card<?= $link_url ? ' has-link' : '' ?>'>
    <?php if ($image_id) : ?>
        <div class="bg-surface ratio-16-9 overflow-hidden">
            <?= get_core_remove_width_height_attr(wp_get_attachment_image($image_id, 'small', false, ['class' => 'stretch', 'loading' => 'lazy'])); ?>
        </div>
    <?php endif; ?>
    <div class="card__content">
        <?= $i . $icon ? "<div class='card__content-header$header_mb'>$i$icon</div>" : '' ?>
        <?= "<$row_tag $row_attributes>" ?>
        <?= "<div class='col'>$title</div>"; ?>
        <?= $link_url ? "<div class='col-auto'>" . get_core_icon('arrow', 'icon-link fs-xxs') . "</div>" : '' ?>
        <?= "</$row_tag>" ?>
        <?= $content; ?>
    </div>
</div>