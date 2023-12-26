<?php
$args = wp_parse_args($args, [
    'icon' => 'facebook',
    'url' => '#',
]);
$icon = $args['icon'];
$url = $args['url'];
if (!$url) {
    return;
}
$has_label = $icon == 'linkedin' && !str_contains($url, '?url=');
$label = $has_label ? '<span class="social-icons__label">Join us on LinkedIn</span>' : '';
?>
<li class="social-icons__item<?= $has_label ? ' has_label' : '' ?>">
    <a class="social-icons__link site-icon-rounded" href="<?= esc_url($url); ?>" aria-label="<?= esc_attr($icon); ?>" target="_blank" rel="noopener noreferrer">
        <?php get_template_part('components/site-icon', null, ['icon' => $icon]); ?>
    </a>
    <?= $label; ?>
</li>