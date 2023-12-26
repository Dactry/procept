<?php
// Remove wordpress css variables
remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');

// Remove Emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Remove rss feed links
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);

// Disable wlwmanifest link
remove_action('wp_head', 'wlwmanifest_link');

// Remove Really Simple Discovery Link
remove_action('wp_head', 'rsd_link');

// Remove html margin top when logged in
function remove_admin_login_header()
{
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_login_header');


//Customize Query
add_action('pre_get_posts', 'pre_get_event_posts');
function pre_get_event_posts($query)
{
    if ($query->is_main_query() && !is_admin()) {
       if (is_home() || is_post_type_archive(['post', 'insight']) || is_category()) {
            $posts_query_args = array(
                'meta_key' => 'featured_post',
                'meta_value' => true,
                'meta_compare' => '!=',
            );
            foreach ($posts_query_args as $key => $value) {
                $query->set($key, $value);
            }
        }
    }
}
