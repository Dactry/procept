<?php
get_header();
?>
<div class="bg-surface spacer-section-py rounded-block">
	<div class="container">
		<p>404</p>
		<h1>That page can’t be found</h1>
		<a href="<?= esc_url(home_url()); ?>" class="button">Return home</a>
	</div>
</div>
<?php
get_footer();
