<?php
$subtitle = get_field('subtitle')
?>

<a class="vacancy-card" href="<?= get_permalink() ?>">
    <div class="vacancy-card__body">
        <div class="vacancy-card__content">
            <?php the_title('<h3 class="h4 vacancy-card__title">', '</h3>') ?>
            <?php if ($subtitle) : ?>
                <span class="vacancy-card__subtitle">
                     (<?= $subtitle ?>)
                </span>
            <?php endif ?>
        </div>
        <?php
        $tags = get_the_tags();
        if ($tags) {
            echo '<ul class="text-white vacancy-card__tags">';
            foreach ($tags as $tag) {
                echo '<li>' . esc_html($tag->name) . '</li>';   
            }
            echo '</ul>';
        }
        ?>
    </div>
</a>