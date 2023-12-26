<?php
$args = wp_parse_args($args, [
    'title' => get_sub_field('title'),
    'text' => get_sub_field('text'),
    'total' => 0,
    'current' => 1, // Start from 1
    'id' => wp_unique_id(),
    'faq_schema' => false,
]);
extract($args);
if ($total < 1) return;

$accordion_id = "accordion-$id";
$accordion_panel_id = "accordion-panel-$id";

$faq_schema_page = $faq_schema_question = $faq_schema_name = $faq_schema_answer = $faq_schema_text = '';

if ($faq_schema) {
    $faq_schema_page = "itemscope itemtype='https://schema.org/FAQPage'";
    $faq_schema_question = "itemscope itemprop='mainEntity' itemtype='https://schema.org/Question'";
    $faq_schema_name = "itemprop='name'";
    $faq_schema_answer = "itemscope itemprop='acceptedAnswer' itemtype='https://schema.org/Answer'";
    $faq_schema_text = "itemprop='text'";
}
//open parent div
if ($current === 1) echo "<ol class='accordion list-links' $faq_schema_page>";
?>
<li class="accordion__item" <?= $faq_schema_question; ?> data-animate data-accordion-item>
    <h3 class="accordion__header" <?= $faq_schema_name; ?>>
        <button type="button" id="<?= $accordion_id; ?>" class="accordion__button" aria-expanded="false" aria-controls="<?= $accordion_panel_id; ?>" data-accordion-trigger>
            <?= esc_html($title); ?>
            <?= get_core_icon('arrow', 'accordion__icon'); ?>
        </button>
    </h3>
    <div id="<?= $accordion_panel_id; ?>" class="element-hidden" role="region" aria-labelledby="<?= $accordion_id; ?>" <?= $faq_schema_answer; ?>>
        <div class="accordion__content" <?= $faq_schema_text; ?>>
            <?= $text; ?>
        </div>
    </div>
</li>
<?php
//close parent div
if ($current === $total) echo "</ol>";
