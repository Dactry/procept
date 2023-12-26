<?php
$args = wp_parse_args($args, ['class' => '']);
$class = $args['class'];

$current_category = get_queried_object_id();
$is_home = is_home();

$post_type_link = get_post_type_archive_link('project');
$published_posts = wp_count_posts('project')->publish;

$first_item_class = !$current_category || $is_home ? ' current-cat' : '';
$first_item = "<li class='cat-item-all$first_item_class'><a href='$post_type_link'><span class='list-links__title'>All</span> <span class='list-links__count'>($published_posts)</span></a></li>";

$taxonomy = wp_list_categories([
    'echo' => false,
    'title_li' => false,
    'taxonomy' => 'project-category',
    'show_option_none' => false,
    'show_count' => true,
    'current_category' => $current_category,
    'walker' => new Walker_Category_List()
]);

$taxonomy = $first_item . $taxonomy;

if ($taxonomy) {
    echo "<ul class='list-links $class' data-horizontal-scroll>$taxonomy</ul>";
}

