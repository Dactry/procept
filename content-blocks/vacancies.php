<?php
$args = wp_parse_args($args, [
    'exclude' => '',
    'title' => 'Most Recent Jobs'
]);

$loop = get_posts([
    'post_type' => 'vacancy',
    'posts_per_page' => -1,
    'exclude' => $args['exclude'],
]);
$loop = get_sub_field('type') == 'select' ? get_sub_field('vacancies') : $loop;
if (!$loop) return;

$block_args = [
    'modifier' => basename(__FILE__, '.php'),
    'block_header_show' => false,
    'class' => 'bg-dark text-white spacer-section-py'
];
$block_header_args = [
    'show' => true,
    'title' => $args['title'],
    'block_header_container' => 'container-lg',
    'alignment' => 'left',
    'tag' => 'h2',
    'spacer' => '<br>',
];
get_template_part('components/block', 'start', $block_args);
get_template_part('components/block-header', null, $block_header_args); ?>

<div class="container-lg" data-animate>
    <div class="row">
        <div class="col">
            <h2>Open Positions</h2>
        </div>
        <div class="col-md">
            <p>We’re always looking for talented people to join our team. See below for our list of open roles follow the links to apply.</p>
        </div>
    </div>
    <br>
    <ol class="list-links vacancy-cards">
        <?php
        foreach ($loop as $post) :
            setup_postdata($post); ?>
            <li>
                <?php get_template_part('components/vacancy-card'); ?>
            </li>
        <?php
        endforeach;
        wp_reset_postdata(); ?>
    </ol>
</div>
<?php
get_template_part('components/block', 'end'); ?>