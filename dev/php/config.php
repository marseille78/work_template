<?php

//pathes
$_TPLPATH  = 'templates/';
$_PAGETPLPATH = '';
$_BASEPATH = __DIR__."/..";

$_VARS = [];

/**
 * keys in $_VARS create by file name
 * $_VARS['key'] = [[],[],[],...]
 */
//templates
/*$_VARS['preview_form'] = [];
$_VARS['preview_table'] = [];
$_VARS['preview_tpg'] = [];
$_VARS['sasscat_example2'] = [
    ['content'=>'I am sasscat_example2 content 1'],
//    ['content'=>'I am sasscat_example2 content 2'],
//    ['content'=>'I am sasscat_example2 content 3'],
];
$_VARS['sasscat_example'] = [
    [
        'content'=>'I am sasscat_example content 1',
        'data'=> [], //do not show
    ],
    [
        'content'=>'I am sasscat_example content 1',
        'data-sasscat_example2' =>[
            ['content'=>'I am sasscat_example2 inside sasscat_example 1'],
            ['content'=>'I am sasscat_example2 inside sasscat_example 2'],
            ['content'=>'I am sasscat_example2 inside sasscat_example 3'],
        ],
    ],
    [
        'content'=>'I am sasscat_example content 1.1',
    ],

//    [
//        'content'=>'I am sasscat_example content 3',
//        'data'=> getVars('sasscat_example2'),
//    ],
];
$_VARS['type_example'] = [];

//pages
$_VARS['index'] = [];
$_VARS['page-example'] = [
    [
        'content'=>render('sasscat_example'),
        'left'=>render('sasscat_example2'),
    ],
];
$_VARS['page-preview'] = [];*/

$_VARS['tbl_products'] = [
    [
        'row' => [
            [
                'field_id_checkout' => 'field_id_checkout_1',
                'field_name' => '1 Femail test',
                'field_per_pill' => '&euro;&nbsp;3.76',
                'field_savings' => '&euro;&nbsp;37.65',
                'field_btn' => 'Add to cart',
            ],
            [
                'field_id_checkout' => 'field_id_checkout_1',
                'field_name' => '5 Femails test',
                'field_per_pill' => '&euro;&nbsp;3.76',
                'field_savings' => '&euro;&nbsp;37.65',
                'field_btn' => 'Add to cart',
            ],
            [
                'field_id_checkout' => 'field_id_checkout_1',
                'field_name' => '10 Femails test',
                'field_per_pill' => '&euro;&nbsp;3.76',
                'field_savings' => '&euro;&nbsp;37.65',
                'field_btn' => 'Add to cart',
            ],
            [
                'field_id_checkout' => 'field_id_checkout_1',
                'field_name' => '5 Femails test',
                'field_per_pill' => '&euro;&nbsp;3.76',
                'field_savings' => '&euro;&nbsp;37.65',
                'field_btn' => 'Add to cart',
            ],
        ],
    ],
];

$_VARS['block_smart_cart'] = [
    [
        'top_view' => [
            [
                'btn_checkout' => 'Checkout',
                'smart_cart_name' => 'Shopping cart',
                'amount_price' => '&euro;&nbsp;45.95',
            ],
        ],
        'items' => [
            [
                'item-view' => 'http://lapku.ru/images/42487/kak-uzanat-pochemu-krichit-kotenok.jpg',
                'item-name' => 'Коте',
                'item-desc' => '50mg + 30mg + 12 tablet',
                'item-btn-remove' => 'Close',
                'item-btn-checkout' => 'Checkout',
                'item-total-amount' => 1,
                'item-total-price' => '&euro;&nbsp;10.50',
            ],
            [
                'item-view' => 'http://lapku.ru/images/42487/kak-uzanat-pochemu-krichit-kotenok.jpg',
                'item-name' => 'Коте',
                'item-desc' => '50mg + 30mg + 12 tablet',
                'item-btn-remove' => 'Close',
                'item-btn-checkout' => 'Checkout',
                'item-total-amount' => 1,
                'item-total-price' => '&euro;&nbsp;10.50',
            ],
        ],
    ],
];

$_VARS['blocks_select-country'] = [
    [
        'data_form_sexy_select' => [
            [
                'id' => 'select_countries_1',
                'data_form_sexy_select_item' => [
                    [
                        'text' => 'hsdfvbudfv', 
                    ],
                    [
                        'text' => 'hsdfvbudfv', 
                    ],
                    [
                        'text' => 'hsdfvbudfv', 
                    ],
                    [
                        'text' => 'hsdfvbudfv', 
                    ],
                ]
            ],
            [
                'id' => 'select_countries_2',
                'data_form_sexy_select_item' => [
                    [
                        'text' => 'kcxvbidsfvbdfs',
                    ]
                ]
            ],
            [
                'id' => 'select_countries_3',
                'data_form_sexy_select_item' => [
                    [
                        'text' => 'hsdfvbudfv66666',
                    ]
                ]
            ],
        ],
    ],
];