<?php
if (have_rows('list')) :
    $list_item = '';
    while (have_rows('list')) : the_row();
        $title = ($title = esc_html(get_sub_field('title'))) ?
            "<h4>$title</h4>" : '';
        $excerpt = ($excerpt = esc_html(get_sub_field('excerpt'))) ?
            "<p class='fs-xs text-muted'>$excerpt</p>" : '';
        $icon = wp_get_attachment_image(get_sub_field('icon'), 'thumbnail', null, ['class' => 'site-icon-lg', 'loading' => 'lazy']);
        $icon = $icon ? "<div class='col-auto'>$icon</div>" : '';
        $content_list = $title || $excerpt ?
            "<div class='col vstack gap-2'>$title$excerpt</div>" : '';
        $list_item .= $icon || $content_list ?
            "<li data-animate='up'><div class='row gx-5 align-items-baseline'>$icon$content_list</div></li>" : '';
    endwhile;
    echo $list_item ? "<ul class='reset-list vstack gap-5'>$list_item</ul>" : '';
endif;
