<?php
$args = wp_parse_args(
	$args,
	array(
		'show' => get_sub_field('block_header_show'),
		'block_header_container' => 'container',
		'title' => get_sub_field('title'),
		'alignment' => get_sub_field('title_alignment'),
		'content' => get_sub_field('description'),
		'tag' => get_sub_field('title_role'),
		'spacer' => '<br class="d-none d-md-block">',
		'class' => '',
	)
);
extract($args);
$title = esc_html($title) ?: '';
$tag = esc_html($tag) ?: '';
$alignment = ($alignment = esc_attr($alignment)) ? " decor-line--$alignment" : '';
$content = $content ? "<div class='col-md-9'>$content</div>" : '';
$color = $tag == 'h2' ? ' text-primary' : '';
if (!$show) return;
echo "<div class='block-header $class' data-animate>";
echo "<div class='$block_header_container'><div class='block-header__title$color'><$tag class=' decor-line decor-line--extra$alignment'>$title</$tag></div>$content$spacer</div>";
echo "</div>";
