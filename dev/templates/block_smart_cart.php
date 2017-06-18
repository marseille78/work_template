<?php
/**
 * @rendered at: page-example.php,
 * @param array $var['top_view'],
 * @param array $var['items']
 */
?>
<!-- block_smart_cart START -->
<div class="block_smart_cart">
	<div class="veiw_amount">
		<?=render('block_smart_cart_top', variable($var, 'top_view')); ?>
	</div>
	<div class="list_ordered_products">
		<?=render('block_smart_cart_item', variable($var, 'items')); ?>
	</div>
</div>
<!-- block_smart_cart END -->