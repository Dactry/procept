<?php
$args = wp_parse_args($args, [
    'social_icons' => get_field('social_icons', 'option'),
    'class' => ''
]);
$social_icons = $args['social_icons'];
$class = $args['class'];
?>
<ul class="social-icons <?= $class?>">
    <?php foreach ($social_icons as $key => $value) {
        get_template_part('components/social-icon', null, ['icon' => $key, 'url' => $value]);
    };
    ?>
</ul>