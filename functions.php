<?php

/**
 * Content Width
 */
function core_content_width()
{
	$GLOBALS['content_width'] = apply_filters('core_content_width', 2048);
}
add_action('after_setup_theme', 'core_content_width', 0);


/**
 * Core functions and definitions
 */
if (!function_exists('core_setup')) :
	function core_setup()
	{

		// Menus
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'core'),
			)
		);
		register_nav_menus(
			array(
				'menu-2' => esc_html__('Site Policy', 'core'),
			)
		);

		//Theme Support
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support(
			'html5',
			array(
				'search-form',
				'gallery',
				'caption',
				'comment-form',
				'comment-list',
				'style',
				'script',
			)
		);
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 100,
				'width'       => 300,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_image_size('small', 384, 384, false);

		add_theme_support('editor-styles');
		add_editor_style(get_core_enqueue_path('main.css', false));
	}
endif;
add_action('after_setup_theme', 'core_setup');

add_post_type_support('page', 'excerpt');

/**
 * Extra Image Sizes In Editor
 */
function add_custom_image_sizes()
{
	return array(
		'thumbnail' => __('Thumbnail'),
		'small' => __('X Small'),
		'medium' => __('Small'),
		'medium_large' => __('Medium'),
		'large' => __('Large'),
		'1536x1536' => __('X Large'),
		'2048x2048' => __('XX Large'),
		'full' => __('Full Size')
	);
}
add_filter('image_size_names_choose', 'add_custom_image_sizes');

/**
 * Widgets
 */
function core_widgets_init()
{

	$register_footer_widget_counter = 1;
	while ($register_footer_widget_counter <= FOOTER_SIDEBAR_QUANTITY) {
		register_sidebar(
			array(
				'name'          => esc_html__("Footer Widget $register_footer_widget_counter", 'core'),
				'id'            => "footer-sidebar-$register_footer_widget_counter",
				'before_sidebar' => '<div id="%1$s" class="col-md">',
				'after_sidebar' => '</div>',
				'before_widget' => '<div class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="h5">',
				'after_title'   => '</h3>',
			)
		);
		$register_footer_widget_counter++;
	}
}
add_action('widgets_init', 'core_widgets_init');

/**
 * Front-end CSS and JS
 */

function core_enqueue()
{
	//Dequeue
	wp_dequeue_style('classic-theme-styles');
	wp_dequeue_style('wp-block-library');
	wp_dequeue_script('comment-reply');

	//Core Files
	wp_enqueue_style('main', get_core_enqueue_path('main.css'), [], null);
	wp_enqueue_script('main-defer', get_core_enqueue_path('main.js'), [], null, true);

	//Sprite
	wp_enqueue_script('sprite-async', get_core_enqueue_path('sprite.js'), [], null, true);

	// Swiper
	global $post;
	if ($post) {
		global $wpdb;
		$post_id = $post->ID;
		$post_meta_sql = "select * from $wpdb->postmeta where post_id = {$post_id} and meta_key not like '\_%' and meta_value like '%[gallery%'";
		$post_meta_results = $wpdb->get_results($post_meta_sql);
		// run the has_shortcode() as usual, works for all the_content() cases
		if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'gallery')) {
			get_core_swiper_enqueue();
		}
		// for shortcodes in post_meta
		else if (is_a($post, 'WP_Post') && !empty($post_meta_results)) {
			get_core_swiper_enqueue();
		}
	}

	// Other conditions for Swiper in Content Blocks. Uncomment and add your logic when needed
	if (have_rows('content_blocks')) {
		while (have_rows('content_blocks')) {
			the_row();
			if (in_array(get_row_layout(), ['members', 'logos', 'testimonials']) && get_core_hide_block()) {
				get_core_swiper_enqueue();
			}
		}
	}
}
add_action('wp_enqueue_scripts', 'core_enqueue');

/**
 * Admin Panel CSS and JS
 */
add_action('admin_enqueue_scripts', 'core_admin_enqueue');
function core_admin_enqueue()
{
	wp_enqueue_style('admin', get_core_enqueue_path('admin.css'), [], null);
	wp_enqueue_script('admin-async', get_core_enqueue_path('admin.js'), ['acf', 'jquery'], null);
}


/**
 * Requires
 */
require get_template_directory() . '/inc/variables.php';
require get_template_directory() . '/inc/theme-functions.php';
require get_template_directory() . '/inc/theme-tags.php';
require get_template_directory() . '/inc/acf.php';
require get_template_directory() . '/inc/actions.php';
require get_template_directory() . '/inc/filters.php';
require get_template_directory() . '/inc/shortcodes.php';
require get_template_directory() . '/inc/tiny-mce.php';
require get_template_directory() . '/inc/gravity-forms.php';


//Admin panel CSS
add_action('admin_head', 'admin_panel_css');
function admin_panel_css()
{
	echo '<style>#edittag{max-width: none;}[data-name="content_blocks"] > :first-child {display: none}</style>';
}

function remove_elementor_css()
{
	if (is_page_template('default') && get_post_type() == 'page') {
		global $wp_styles;
		foreach ($wp_styles->registered as $handle => $data) {
			if (strpos($data->src, '/elementor/css/post-') !== false) {
				wp_dequeue_style($handle);
			}
			if (strpos($data->src, 'swiper.min.css') !== false) {
				wp_dequeue_style($handle);
			}
		}
	}
}
add_action('wp_enqueue_scripts', 'remove_elementor_css', 9999);