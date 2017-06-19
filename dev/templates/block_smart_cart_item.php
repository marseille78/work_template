<?php
/**
 * @ rendered at: block_smart_cart.php
 * @param string $var['item-view']
 * @param string $var['item-name']
 * @param string $var['item-desc']
 * @param string $var['item-price']
 * @param string $var['item-btn-remove']
 * @param string $var['item-btn-checkout']
 * @param integer $var['item-total-amount']
 * @param string $var['item-total-price']
 */
?>
<!-- block_smart_cart_item START -->
<div class="item_ordered_product">
	<div class="view_item"><img src="<?=variable($var, 'item-view'); ?>" alt=""></div>
	<div class="name_item"><?=variable($var, 'item-name'); ?></div>
	<div class="desc_item"><?=variable($var, 'item-desc'); ?></div>
	<div class="price_item"><?=variable($var, 'item-price'); ?></div>
	<button class="btn-remove-smart_cart_item"><?=variable($var, 'item-btn-remove'); ?></button>
	<div class="total_ordered_item">
		<button class="btn-smart_cart_checkout_item"><?=variable($var, 'item-btn-checkout'); ?></button>
		<div class="total_ordered_data_item">
			<div class="total_amount_item"><?=variable($var, 'item-total-amount'); ?></div>
			<div class="total_price_item"><?=variable($var, 'item-total-price'); ?></div>
		</div>
	</div>
</div>
<!-- block_smart_cart_item END -->