<?php
/**
 * @rendered at: page-example.php
 * @param array $var['thead']
 * @param array $var['row']
 */
?>
<!-- tbl_products START -->
<div class="tbl_products">
	<table>
		<thead>
			<?=render('tbl_products_thead', variable($var, 'thead')); ?>
		</thead>
		<tbody>
			<?=render('tbl_products_row', variable($var, 'row')); ?>
		</tbody>
	</table>
</div>
<!-- tbl_products END -->