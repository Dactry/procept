<?php
if (have_rows('timeline')) :
    $timeline = '';
    while (have_rows('timeline')) : the_row();
        $title = ($title = esc_html(get_sub_field('title'))) ? "<h4 class='h5'>$title</h4>" : '';
        $date = ($date = esc_html(get_sub_field('date'))) ? "<span class='h5'>$date</span>" : '';
        $date = $date ? "<div class='site-timeline__date' data-animate='down'>$date</div>" : '';
        $excerpt = ($excerpt = esc_html(get_sub_field('excerpt'))) ? "<p class='fs-xs text-muted'>$excerpt</p>" : '';
        $timeline_content = $title || $excerpt ? "<div class='site-timeline__content' data-animate='down'>$title$excerpt</div>" : '';
        $timeline .= $timeline_content ? "<li class='site-timeline__item'>$date$timeline_content</li>" : '';
    endwhile;
    echo $timeline ? "<ul class='site-timeline'>$timeline</ul>" : '';
endif;
