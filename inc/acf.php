<?php
//Options 
if (function_exists('acf_add_options_page')) {
	acf_add_options_page();
	$post_types = [
		'post' => 'Post',
		'project' => 'Project',
		'insight' => 'Insights'
	];

	foreach ($post_types as $post_type => $label) {
		$parent_slug = $post_type !== 'post' ? "?post_type=$post_type" : '';
		acf_add_options_sub_page([
			'page_title' => "$label Options",
			'menu_title' => "$label Options",
			'parent_slug' => "edit.php$parent_slug",
			'post_id' => "$post_type-options",
		]);
	}
}

//Hide ACF menu and show it for specific users only
if (is_user_logged_in() && get_current_user_id() !== 1 && get_current_user_id() !== 2) {
	add_filter('acf/settings/show_admin', '__return_false');
}
