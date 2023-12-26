<?php
get_template_part('content-blocks/accordion', null, ['content_block' => false]);
echo ($text = get_sub_field('accordion_content')) ? "<br><div>$text</div>" : null;
