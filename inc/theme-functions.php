<?php
//Decode manifest.json to string to get a path to a file
function get_core_enqueue_path($name, $template_directory_uri = true)
{
    $manifest_file_path = get_template_directory() . '/dist/manifest.json';
    if (!file_exists($manifest_file_path)) return;
    $manifest_file = file_get_contents($manifest_file_path);
    $manifest_data = json_decode($manifest_file, true);
    $result = $manifest_data[$name] ?? null;
    $before_path = null;
    if ($template_directory_uri) {
        $before_path = get_template_directory_uri();
    }
    return $result ? $before_path . $result : null;
}

//Filter & Implode
if (!function_exists('get_core_filter_implode')) {
    function get_core_filter_implode(array $array)
    {
        return implode(' ', array_filter($array));
    }
}

//Remove image width And height attributes
if (!function_exists('get_core_remove_width_height_attr')) {
    function get_core_remove_width_height_attr($html)
    {
        $html = preg_replace('/(width|height)="\d*"/', '', $html);
        return $html;
    }
}

//Hide Block Logic
if (!function_exists('get_core_hide_block')) {
    function get_core_hide_block()
    {
        return get_sub_field('hide_block') === true ? false : true;
    }
}

//Rounded Block Logic
if (!function_exists('get_core_rounded_block')) {
    function get_core_rounded_block()
    {
        $group = get_sub_field('rounded_block');
        if (!$group) return;
        $rounded = $group['display_in_container'];
        $bg_color = $group['bg_color'];
        return $rounded === true ? CONTENT_BLOCK_CLASS . "--rounded $bg_color" : '';
    }
}

//Spacer
if (!function_exists('get_core_spacer')) {
    function get_core_spacer()
    {
        $padding = get_sub_field('padding');
        if (!$padding) {
            return;
        }
        $top = 'top';
        $bottom = 'bottom';
        if (in_array($bottom, $padding) && in_array($top, $padding)) {
            $class = 'spacer-section-py';
        } elseif (in_array($bottom, $padding)) {
            $class = 'spacer-section-pb';
        } elseif (in_array($top, $padding)) {
            $class = 'spacer-section-pt';
        } else {
            $class = null;
        }
        return $class;
    }
}

//Container Width
if (!function_exists('get_core_container_width')) {
    function get_core_container_width()
    {
        $container_width = get_sub_field('container_width');
        if ($container_width) {
            $container_width = $container_width !== 'default' ? "-" . esc_attr($container_width) : null;
            return "container$container_width";
        }
    }
}

//Height
if (!function_exists('get_core_height')) {
    function get_core_height()
    {
        $height = get_sub_field('height');
        if ($height && $height !== 'auto') {
            return  "min-height-" . esc_attr($height);
        }
    }
}

//Reverse Columns
if (!function_exists('get_core_reverse_columns')) {
    function get_core_reverse_columns()
    {
        $reverse_columns = get_sub_field('reverse_columns');
        if ($reverse_columns) {
            return "flex-column-reverse flex-md-row";
        }
    }
}

//Vertical Align
if (!function_exists('get_core_vertical_align')) {
    function get_core_vertical_align()
    {
        $vertical_align = get_sub_field('vertical_align');
        if ($vertical_align && $vertical_align !== 'start') {
            return "align-items-" . esc_attr($vertical_align);
        }
    }
}

//Horizontal Align
if (!function_exists('get_core_horizontal_align')) {
    function get_core_horizontal_align()
    {
        $horizontal_align = get_sub_field('horizontal_align');
        if ($horizontal_align && $horizontal_align !== 'start') {
            return "justify-content-md-" . esc_attr($horizontal_align);
        }
    }
}

//White Text Color
if (!function_exists('get_core_color_text_white')) {
    function get_core_color_text_white($smart = true)
    {
        $background = get_sub_field('background');
        if (!$background) {
            return;
        }
        $color_text_white = $background['text_settings']['white_text_color'];
        $color_text_class = "text-white";
        if ($smart) {
            $bg_type = get_sub_field('background')['bg_type'];
            return $bg_type !== 'none' && $color_text_white ? $color_text_class : null;
        }
        return $color_text_white ? $color_text_class : null;
    }
}


//Icon Label Component
function get_core_icon_label($icon = 'email', $label = 'Label', $href = '#', $type = '', $wrap = false)
{
    $label = esc_html($label);
    $href = esc_html($href);

    //link attributes based on $type
    $attributes = '';
    switch ($type) {
        case 'phone':
            $attributes = "href='tel:$href'";
            break;
        case 'email':
            $href = antispambot($href, 1);
            $attributes = "href='mailto:$href' target='_blank'";
            break;
        case 'address':
            $attributes = "href='$href' target='_blank' rel='noopener noreferrer'";
            break;
        default:
            $attributes = "href='$href'";
    }

    //icon
    ob_start();
    get_template_part('components/site-icon', null, ['icon' => $icon]);
    $icon = $icon ? "<span class='site-icon-rounded'>" . ob_get_clean() . "</span>" : '';

    //wrap in <p>
    $before = '';
    $after = '';
    if ($wrap) {
        $before = '<p>';
        $after = '</p>';
    }

    return "$before<a class='icon-label' $attributes>$icon$label</a>$after";
}

//Column Width
function get_core_column_width($width = 'default', $breakpoint = 'medium')
{
    $breakpoint_class = '';
    switch ($breakpoint) {
        case 'large':
            $breakpoint_class = 'xl';
            break;
        case 'small':
            $breakpoint_class = 'sm';
            break;
        default:
            $breakpoint_class = 'md';
    }
    $breakpoint_class = $breakpoint_class !== 'sm' ? "-$breakpoint_class" : '';
    return $width === 'default' ? "col$breakpoint_class" : "col$breakpoint_class-$width";
}


//Items Per Row
function get_core_items_per_row($items = 3)
{
    $items_per_row = get_sub_field('items_per_row');
    if ($items_per_row) {
        $items = intval($items_per_row);
    }
    $result = "row-cols-1 row-cols-sm-$items";
    if ($items > 3) {
        $result = "row-cols-2 row-cols-sm-3 row-cols-xl-$items";
    }
    return $result;
}

//Swiper CSS & JS
function get_core_swiper_enqueue()
{
    wp_enqueue_style('swiper', get_core_enqueue_path('swiper.css'), [], null);
    wp_enqueue_script('swiper-async', get_core_enqueue_path('swiper.js'), [], null, true);
}

function get_core_icon($icon = '', $class = '')
{
    ob_start();
    get_template_part('components/site-icon', null, ['icon' => $icon, 'class' => $class]);
    return ob_get_clean();
}

function get_core_swiper_options($options)
{
    $result = '';
    foreach ($options as $option) {
        if ($option) {
            $result .= " data-swiper-$option";
        }
    }
    return $result;
}

function get_core_link($link, $class = 'button', $wrap = 'p', $wrap_class = '')
{

    if (!$link) return;
    $wrap_class = $wrap_class ? " class='$wrap_class'" : '';
    $wrap_start = $wrap ? "<$wrap$wrap_class>" : null;
    $wrap_end = $wrap ? "</$wrap>" : null;
    $link_url = esc_url($link['url']);
    $link_title = esc_html($link['title']);
    $link_target = isset($link['target']) && $link['target'] ? esc_attr($link['target']) : '_self';

    return "$wrap_start<a class='$class' href='$link_url' target='$link_target'>$link_title</a>$wrap_end";
}
