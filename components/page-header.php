<?php
$post_type = get_post_type();
$args = wp_parse_args($args,    [
    'title' => get_the_title(),
    'height' => '',
    'img_id' => get_post_thumbnail_id(),
]);
extract($args);

$block_name = CONTENT_BLOCK_CLASS . ' ' . CONTENT_BLOCK_MODIFIER . basename(__FILE__, '.php');
$block_class = get_core_filter_implode([
    $block_name,
    'text-white',
    'bg-dark',
    'spacer-section-pt',
    $height,
    'rounded-block',
]);

$sidebar = '';

if (in_array($post_type, ['post', 'insight']) && !is_single()) {
    $post_types = [
        'post' => 'Post',
        'insight' => 'Insights'
    ];
    foreach ($post_types as $post_type => $label) :
        $post_type_link = get_post_type_archive_link($post_type);
        $count_post = wp_count_posts($post_type)->publish;
        $current_page = get_post_type() == $post_type ? ' current-cat' : '';
        $sidebar .= "<li class='cat-item-all$current_page'><a href='$post_type_link'><span class='list-links__title'>$label</span><span class='list-links__count'>($count_post)</span></a></li>";
    endforeach;
    $sidebar = "<div class='spacer-element'><ul class='list-links row-menu' data-horizontal-scroll>$sidebar</ul></div>";
}

$custom_content = get_sub_field('custom_content');
$subtitle = ($subtitle_text = esc_html(get_field('subtitle')))
    ? "<span class='text-light fs-xxs uppercase'>$subtitle_text</span>" : '';
$content = $custom_content && ($custom_text = get_sub_field('content'))
    ? $custom_text : "<h1>" . esc_html($title) . "</h1>";
?>

<div class="<?= $block_class;  ?>">
        <?php
        if ($img_id) {
            $img_args = [
                'curtain' => true,
                'img_id' => $img_id,
            ];
            get_template_part('components/background-image', null, $img_args);
        }
        ?>
    <div class="<?= CONTENT_BLOCK_CONTENT; ?> container" data-animate>
        <div class="row spacer-element gx-md-6">
            <div class="col-md-4">
                <?php get_template_part('components/breadcrumbs') ?>
                <?= $sidebar; ?>
                <?= $custom_content ? esc_html(get_sub_field('description')) : '' ?>
            </div>
            <div class="col offset-md-1 ">
                <?= $content ?>
                <?= $subtitle ?>
            </div>
        </div>
        <br>
    </div>
</div>