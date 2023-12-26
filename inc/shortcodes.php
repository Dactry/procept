<?php
/*------------------------------------*\
	Shortcodes
\*------------------------------------*/

$contacts = [
    'address' => 'pin',
    'phone' => 'phone',
    'email' => 'email'
];

foreach ($contacts as $contact => $icon) {
    add_shortcode($contact, function ($atts, $content) use ($contact, $icon) {
        $a = shortcode_atts(array(
            'wrap' => 'true',
            'icon' => 'false',
            'suffix' => '',
        ), $atts);
        $field = $a['suffix'] ? $contact . "_" . $a['suffix'] : $contact;
        extract(get_field($field, 'option'));
        $wrap = $a['wrap'] === 'true' ? true : false;
        $icon = $a['icon'] === 'true' ? $icon : false;
        if ($link) {
            if ($content) {
                $label = $content;
            }
            return get_core_icon_label($icon, $label, $link, $contact, $wrap);
        }
    });
}

add_shortcode('social-icons', 'social_icons');
function social_icons()
{
    ob_start();
    get_template_part('components/social-icons');
    return ob_get_clean();
}

add_shortcode('cta-link', 'cta_link');
function cta_link()
{
    return get_core_link(get_field('cta_link', 'option'), 'button button--arrow', null);
}

add_shortcode('contact-info', 'contact_info');
function contact_info()
{
    ob_start();
    get_template_part('components/contact');
    return ob_get_clean();
}

add_shortcode('map', 'map');
function map()
{

    $image = ($image = get_field('address', 'option')['image']) ? wp_get_attachment_image($image, 'large', false, ['class' => 'stretch', 'loading' => 'lazy']) : '';
    $link = esc_url(get_field('address', 'option')['link']);
    $icon = get_core_icon('pin', 'icon-map');
    $image = "<a href='$link' class='ratio-16-9 site-map el-clip' target='_blank'><span class='site-map__icon'></span>$image</a>";
    return $image;
}
