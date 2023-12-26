<?php
if (have_rows('contents')) :
    while (have_rows('contents')) : the_row();
        echo ($content_item = get_sub_field('content')) ?
            "<div class='site-panel__content-item'>$content_item</div>" : '';
    endwhile;
endif;
