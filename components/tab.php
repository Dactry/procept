<?php
$args = wp_parse_args($args, [
    'unique_id' => 1,
    'i' => 1,
    'title' => get_sub_field('title')
]);

extract($args);

$aria_selected = 'false';

$class = null;

if ($i === 1) {
    $class .= " active";
    $aria_selected = 'true';
}

?>
<li>
    <button type="button" id="tab-<?= esc_attr($unique_id); ?>" class="tabs__tab <?= $class; ?>" role="tab" aria-selected="<?= $aria_selected; ?>" aria-controls="tabpanel-<?= esc_attr($unique_id); ?>" data-tab>
        <span class='text-overflow'><?= esc_html($title) ?></span><?= get_core_icon('arrow', 'tabs__tab-icon'); ?>
    </button>
</li>