<?php
$args = wp_parse_args($args, [
	'object_id' => get_the_ID(),
]);
$object_id = $args['object_id'];

$close_section = false;
global $spy_link;

if (have_rows('content_blocks', $object_id)) {
	// Get All Spy Links And Check if Target Menu Block Used
	while (have_rows('content_blocks', $object_id)) {
		the_row();
		if (get_row_layout() == 'link-target') {
			$title = get_sub_field('link_target');
			$link = sanitize_title($title);
			$decore_line = "<span class='decor-line'></span>";
			$spy_link .= "<li><a class='target-menu__buttons-link' href='#$link' data-spy-link><span class='target-menu__buttons-title decor-line'>$title</span></a></li>";
		}
	}

	while (have_rows('content_blocks', $object_id)) {
		the_row();
		if (get_core_hide_block()) {
			// Wrap Link Target
			if (get_row_layout() == 'link-target') {
				echo $close_section ? '</div>' : '';
				$section_id = sanitize_title(get_sub_field('link_target'));
				echo "<div id='$section_id' data-spy-section>";
				$close_section = true;
			}
			// Content Blocks
			else {
				get_template_part('content-blocks/' . get_row_layout());
			}
		}
	}
}

echo $close_section ? '</div>' : '';
