<?php
$bg = get_sub_field('background');
if (!$bg) return;

$bg_type = $bg['bg_type'];
$bg_type_mobile = $bg['bg_type_mobile'];
if ($bg_type === 'none' && $bg_type_mobile === 'none') return;

//Background Color
if ($bg_type === 'color') {
    $bg_type_color = $bg['bg_type_color'];
    $bg_color =  $bg_type_color['bg_color'];
    if ($bg_color !== 'custom') {
        echo "<div class='background-item stretch bg-$bg_color'></div>";
    } else {
        $bg_color_custom = $bg_type_color['bg_color_custom'];
        echo "<div class='background-item stretch' style='background-color:$bg_color_custom'></div>";
    }
}


if ($bg_type_mobile === 'video') {
    $video_mobile = $bg['bg_type_video_mobile'];
    if ($video_mobile) {
        $src = $video_mobile['url'];
        $mime_type = $video_mobile['mime_type'];
        $poster = '';
        $poster_id = get_field('video_poster', $video_mobile['id']);
        if ($poster_id) {
            $poster_url = wp_get_attachment_image_url($poster_id, 'large');
            $poster = 'poster="' . esc_url($poster_url) . '"';
        }
        echo sprintf(
            "<video class='stretch background-item background-item-mobile d-md-none' data-mobile-bg playsinline autoplay muted loop %s><source src='/' data-src='%s' type='%s'></video>",
            $poster,
            esc_url($src),
            esc_attr($mime_type)
        );
    }
}
//Background Image
if ($bg_type === 'image' || $bg_type_mobile === 'image') {
    $image = $bg_type === 'image' ? $bg['bg_type_image'] : null;
    $image_mobile = $bg_type_mobile === 'image' ? $bg['bg_type_image_mobile'] : null;
    if ($image || $image_mobile) {
        $args = [
            'img_id' => $image['ID'] ?? null,
            'img_id_mobile' => $image_mobile['ID'] ?? null
        ];
        get_template_part('components/background-image', null, $args);
    }
}


//Background Video
if ($bg_type === 'video') {
    $video = $bg['bg_type_video'];
    if ($video) {
        $src = $video['url'];
        $mime_type = $video['mime_type'];
        $poster = '';
        $poster_id = get_field('video_poster', $video['id']);
        if ($poster_id) {
            $poster_url = wp_get_attachment_image_url($poster_id, 'large');
            $poster = 'poster="' . esc_url($poster_url) . '"';
        }
        echo sprintf(
            "<video class='stretch background-item' playsinline autoplay muted loop %s><source src='/' data-src='%s' type='%s'></video>",
            $poster,
            esc_url($src),
            esc_attr($mime_type)
        );
    }
}

//Background Overlay
$bg_overlay = $bg['text_settings']['background_overlay'];
if ($bg_overlay && $bg_type !== 'color') {
    get_template_part('components/curtain');
}
