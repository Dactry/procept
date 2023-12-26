<?php
//wp_body_open action in header.php
if (!function_exists('wp_body_open')) :
	function wp_body_open()
	{
		do_action('wp_body_open');
	}
endif;

//Post categories
if (!function_exists('get_core_categories')) :
	function get_core_categories()
	{
		if ('post' === get_post_type()) {
			$categories_list = get_the_category_list(esc_html__(', ', 'core'));
			if ($categories_list) {
				return sprintf("<p>" . esc_html__('%1$s', 'core') . '</p>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
endif;

//Post tags
if (!function_exists('get_core_tags')) :
	function get_core_tags()
	{
		if ('post' === get_post_type()) {
			$tags_list = get_the_tag_list('', ', ');
			if ($tags_list) {
				return sprintf("<p>" . esc_html__('%1$s', 'core') . "</p>", $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
endif;

//Sub Menu Button
class Sub_Menu_Toggle extends Walker_Nav_Menu
{
	function start_lvl(&$output, $depth = 0, $args = array())
	{
		ob_start();
		get_template_part('components/site-icon', null, ['icon' => 'plus', 'class' => 'dropdown-toggle__icon']);
		$icon = ob_get_clean();
		$output .= "<button type='button' class='dropdown-toggle' aria-label='Show Submenu' data-dropdown-toggle>$icon</button>\n<div class='dropdown-responsive'><ul class='sub-menu'>\n";
	}
	function end_lvl(&$output, $depth = 0, $args = array())
	{
		$output .= "</ul></div>\n";
	}
}

//Pagination
function core_pagination()
{
	global $wp_query;
	$big = 999999999;
	echo paginate_links(array(
		'base' => str_replace($big, '%#%', get_pagenum_link($big)),
		'format' => '?paged=%#%',
		'prev_text' => "<span class='d-flex' aria-label='Previous'>" . get_core_icon('arrow', 'rotate-180') . "</span>",
		'next_text' => "<span class='d-flex' aria-label='Next'>" . get_core_icon('arrow') . "</span>",
		'current' => max(1, get_query_var('paged')),
		'total' => $wp_query->max_num_pages,
		'end_size'  => 1,
		'mid_size'  => 1,
		
	));
}
add_action('init', 'core_pagination');

// Categories with a counter
class Walker_Category_List extends Walker_Category
{
	function start_el(&$output, $category, $depth = 0, $args = [], $id = 0)
	{
		$current_class = !empty($args['current_category']) && ($category->term_id == $args['current_category']) ? ' current-cat' : '';
		$cat_name = esc_attr($category->name);
		$cat_link = esc_url(get_term_link($category));
		$cat_count = $category->count;

		$link = "<a href='$cat_link'><span class='list-links__title'>$cat_name</span><span class='list-links__count'>($cat_count)</span></a>";
		$output .= "<li class='cat-item cat-item-$category->term_id$current_class'>$link";
	}
}
