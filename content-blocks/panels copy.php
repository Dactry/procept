<?php
$block_args = [
    'modifier' => basename(__FILE__, '.php'),
    'block_header_show' => false,
];
get_template_part('components/block', 'start', $block_args);
$row_class = get_core_filter_implode([
    CONTENT_BLOCK_CLASS . '__row row g-0',
    get_core_reverse_columns()
]);

get_template_part('components/block-header', null, ['content' => false, 'spacer' => false]);
$has_block_header = get_sub_field('block_header_show');
if (have_rows('panels')) :
?>
    <div class="<?= $row_class; ?>">
        <?php while (have_rows('panels')) :
            the_row();

            $type = get_sub_field('type');
            $type_content = $type == 'content';
            $type_list = $type == 'list';
            $type_timeline = $type == 'timeline';
            $type_accordion = $type == 'accordion';

            $bg = get_sub_field('background');
            $has_bg = $bg['bg_type'] === 'image' || $bg['bg_type'] === 'video' ? true : false;

            $content = '';
            if ($type_content) :
                if (have_rows('contents')) :
                    while (have_rows('contents')) : the_row();
                        $content .= ($content_item = get_sub_field('content')) ?
                            "<div class='site-panel__content-item'>$content_item</div>" : '';
                    endwhile;
                endif;
            endif;
            if ($type_list) :
                $list_item = '';
                if (have_rows('list')) :
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
                            "<li><div class='row gx-5 align-items-baseline'>$icon$content_list</div></li>" : '';
                    endwhile;
                    $content = $list_item ? "<ul class='reset-list vstack gap-5'>$list_item</ul>" : '';
                endif;
            endif;

            if ($type_timeline) :
                $timeline = '';
                if (have_rows('timeline')) :
                    while (have_rows('timeline')) : the_row();
                        $title = ($title = esc_html(get_sub_field('title'))) ? "<h4 class='h5'>$title</h4>" : '';
                        $date = ($date = esc_html(get_sub_field('date'))) ? "<span class='h5'>$date</span>" : '';
                        $date = $date ? "<div class='col-auto'>$date</div>" : '';
                        $excerpt = ($excerpt = esc_html(get_sub_field('excerpt'))) ? "<p class='fs-xs text-muted'>$excerpt</p>" : '';
                        $timeline_content = $title || $excerpt ? "<div class='col vstack gap-2'>$title$excerpt</div>" : '';
                        $timeline .= $timeline_content ? "<div class='row gx-5 align-items-baseline'>$date$timeline_content</div>" : '';
                    endwhile;
                    $content = $timeline ? "<div class='vstack gap-6'>$timeline</div>" : '';
                endif;
            endif;
            if ($type_accordion) :
                ob_start();
                get_template_part('content-blocks/accordion', null, ['content_block' => false]);
                $content = ob_get_clean();
                $content .= ($text = get_sub_field('accordion_content')) ? "<br><div>$text</div>" : null;
            endif;

            $col_class = get_core_filter_implode([
                'col-md spacer-section-py site-panel',
                $has_bg ? "has-bg" : null,
                $has_block_header ? "has-title" : null,
                $content ? get_core_vertical_align() : null,
            ]);

        ?>

            <div class="<?= $col_class; ?>">
                <div class="container-xs">
                    <?php
                    get_template_part('components/background');

                    if ($content) : ?>
                        <div class="<?= get_core_filter_implode(['site-panel__content', get_core_color_text_white()]) ?>" data-animate>
                            <?= $content ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php
endif;
get_template_part('components/block', 'end');
