<?php

/**
 * Template name: Default Template
 */
get_header(); ?>
<div class="container spacer-section-py" data-animate>
    <?php
    the_title('<h1>', '</h1>');
    the_post_thumbnail('large');
    the_content();
    ?>
</div>
<?php
get_footer();
