<?php
/**
 * @rendered at: page-example.php
 * @param array $var['select_countries']
 */
?>
<!-- block_select_country START -->
<div class="block_select_country">
	<?=render('form_sexy_select', variable($var, 'select_countries')); ?>
</div>
<!-- block_select_country END -->