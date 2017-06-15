<?php
/**
 * @rendered at: page-example.php,
 * @param string $var['content']
 * @param array $var['data'] - data for example_data2 tpl
 */
?>
<!-- sasscat_example START -->
<div class="class" style="margin-bottom: 1em; border: 1px solid #f00;">
    <p><?=variable($var,'content'); ?></p>
    <?=variable($var,'foreach-start-sasscat_example2'); ?>
    <?=render('sasscat_example2',variable($var,'data-sasscat_example2')); ?>
    <?=variable($var,'foreach-end-sasscat_example2'); ?>
</div>
<!-- sasscat_example END -->