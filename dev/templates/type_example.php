<?php
/**
 * @param (string) $type_example['left'] - content in .left 
 * @param (string) $type_example['contrnt'] - content in .content
 */
$type_example_def = array(
	'left'=>'',
	'content'=>'',
);
if(!empty($type_example)){
    $type_example = array_merge($type_example_def,$type_example);
}else{
    $type_example = $type_example_def;
}
?>
<!-- sasscat_example2 START -->
<aside class="side">
	<?=$type_example['left']; ?>
</aside>
<div class="content">
	<?=$type_example['content']; ?>
</div>
<!-- sasscat_example2 END -->
<?php
if(!empty($type_example)) {
    $type_example = $type_example_def;
}
?>