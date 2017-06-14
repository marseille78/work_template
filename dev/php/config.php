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
$_VARS['preview_form'] = [];
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
        'data'=> [
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
$_VARS['page-preview'] = [];