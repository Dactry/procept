<?php
$args = wp_parse_args($args, [
    'icon' => '',
    'class' => null
]);

$icon = $args['icon'];

if (!$icon) {
    return;
}

$icon_class = 'site-icon';
$extra_class = $args['class'];

if ($extra_class) {
    $icon_class .= " $extra_class";
}
?>
<svg class="<?= $icon_class ?>">
    <use href="#<?= $icon ?>"></use>
</svg>