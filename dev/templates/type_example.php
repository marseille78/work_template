<?php
/**
 * @rendered at: page-example.php,
 * @param string $var['left'] - content in .left
 * @param string $var['content'] - content in .content
 */
?>
<!-- sasscat_example2 START -->
<aside class="side">
	<?=variable($var,'left'); ?>
</aside>
<div class="content">
	<?=variable($var,'content'); ?>
</div>
<!-- sasscat_example2 END -->