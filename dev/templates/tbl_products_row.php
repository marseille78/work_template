<?
/**
 * @rendered at: tbl_products.php
 * @param string $var['field_id_checkout']
 * @param string $var['field_name']
 * @param string $var['field_per_pill']
 * @param string $var['field_savings']
 * @param string $var['field_btn']
 */
?>
<!-- tbl_products_row START -->
<tr>
	<td><div class="form-custom_checkbox"><input type="checkbox" id="<?=variable($var, 'field_id_checkout')?>"><label for="<?=variable($var, 'field_id_checkout')?>">111</label></div></td>
	<td><?=variable($var,'field_name'); ?></td>
	<td><span><?=variable($var,'field_per_pill'); ?></span> Per test</td>
	<td><?=variable($var,'field_savings'); ?></td>
	<td><button class="btn"><?=variable($var,'field_btn'); ?></button></td>
</tr>
<!-- tbl_products_row END -->