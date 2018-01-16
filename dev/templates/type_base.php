<?php
/**
 * @rendered at: page-index
 *
 * @param string 'page' - ! do not change !
 * @param array  'data_str_header'
 * @param array  'data_str_footer'
 * @param string 'use_list-breadcrumbs' => '1',
 * @param string 'if_list-breadcrumbs_start' => '',
 * @param string 'if_list-breadcrumbs_end' =>'',
 */
?>
<!-- type_base START -->

<div class="<?=variable($var, 'page-class'); ?>">
        <?=render('str_site-header',variable($var,'data_str_site-header')); ?>
        <? if(variable($var,'use_list-breadcrumbs')){ ?>
            <?=variable($var,'if_list-breadcrumbs_start'); ?>
            	<?=render('list-breadcrumbs',variable($var,'data_list-breadcrumbs')); ?>
            <?=variable($var,'if_list-breadcrumbs_end'); ?>
        <? } ?>

        <? if(variable($var,'use_page-title')){ ?>
            <?=variable($var,'if_page-title_start'); ?>
            <div class="site clearfix">
                <h1 class="page-title"><?=variable($var, 'page-title'); ?></h1>
                <? if(variable($var,'use_add-all')){ ?>
                    <?=variable($var,'if_add-all_start'); ?>
                    <a href="#" class="page-add-all icon-add"><?=variable($var, 'use_add-all'); ?></a>
                    <?=variable($var,'if_add-all_end'); ?>
                <? } ?>
            </div>
            <?=variable($var,'if_page-title_end'); ?>
        <? } ?>

        <section class="site-middle">
            <div class="site clearfix">
                 <?=render(variable($var,'page'),array($var)); ?>  
            </div>
        </section>
         <?=render('str_site-footer',variable($var,'data_str_site-footer')); ?>
    </div>

<!-- type_base END -->