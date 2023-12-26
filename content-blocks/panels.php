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
            $bg = get_sub_field('background');
            $has_bg = $bg['bg_type'] === 'image' || $bg['bg_type'] === 'video' ? true : false;

            $type = get_sub_field('type');

            ob_start();     
            get_template_part('components/panel', $type);
            $content = ob_get_clean();

            $col_class = get_core_filter_implode([
                'col-md spacer-section-py site-panel',
                $has_bg ? "has-bg" : null,
                $has_block_header ? "has-title" : null,
                $content ? get_core_vertical_align() : null,
            ]);

        ?>

            <div class="<?= $col_class; ?>">    
                <div class="container-xs">
                    <?php get_template_part('components/background'); ?>
                    <?php if ($content) : ?>
                        <div class="<?= get_core_filter_implode(['site-panel__content', get_core_color_text_white()]) ?>" data-animate>
                            <?= $content; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php
endif;
get_template_part('components/block', 'end');
