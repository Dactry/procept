<?php 
$section_id = sanitize_title(get_sub_field('link_target'));
echo "<div id='$section_id' data-target-section></div>";
?>