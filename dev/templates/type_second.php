<?php
/**
 * @rendered at: page-subscribe, page-faq, page-coupon, page-product, page-account, page-policy, page-about, page-blisters, page-testimonials, page-news, page-shopping, page-sitemap, page-contact, page-tell_friend, page-bonuses, page-articles
 * @param string 'type_el' - col-left special content
 * @param array 'data_type_el' - data array for col-left
 * @param string 'page' - ! do not change !
 *
 * @param bool 'use_page-title'
 * @param string 'if_page-title_start'
 * @param string 'if_page-title_end'
 *
 * @param array 'data_blocks_other-drugs'
 *
 * @param string 'href-link-home'
 * @param string 'text-link-home'
 *
 * @param string 'page-title'
 *
 * @param bool 'use_product-header' only for page product
 * @param string 'if_product-header_start'
 * @param string 'if_product-header_end'
 *
 * @param string 'use_add-all'
 *
 * @param string 'src-prod-img'
 * @param string 'alt-prod-img'
 * @param string 'src-prod-blister'
 * @param string 'alt-prod-blister'
 */
?>
<!-- type_second START -->
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
                  <? if(variable($var,'use_blocks_about-product')){ ?>
                    <?=variable($var,'if_blocks_about-product_start'); ?>
                        <?=render('blocks_about-product',variable($var,'data_blocks_about-product')); ?>
                    <?=variable($var,'if_blocks_about-product_end'); ?>
                 <? } ?>
                
                <main class="col-lg col-lg-9 col-right content">
                    <?=render(variable($var,'page'),array($var)); ?> 
                </main>
                <aside class="col-lg col-lg-3 col-left sidebar">
                    <? if(!empty(variable($var,'type_el'))){
                        echo render(variable($var,'type_el',variable($var, 'data_type_el')));
                    }else{ ?>
                           <?=render('list-benefits',variable($var,'data_list-benefits')); ?> 
                    <? } ?>
                </aside>
            </div>
        </section>
           <?=render('str_site-footer',variable($var,'data_str_site-footer')); ?>
    </div>
<!-- type_second END -->