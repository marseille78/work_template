<?php

//pathes
$_TPLPATH  = 'templates/';
$_PAGETPLPATH = '';
$_BASEPATH = __DIR__."/..";

$_mode = 1; // 1 - dev, 0 - other;
$_VARS = [];
$_ext = 'html';
$_VARS['index']=[
  'type'=>'',
  'file'=>[
    'name'=>'index',
    'ext'=>$_ext,
    'skip'=>1,
  ],
  [

  ]
];


$_VARS['blocks_example'] = [
  'type'=>'',
  'file'=>[
    'name'=>'blocks_example',
    'ext'=>$_ext,
    'skip'=>0,
  ],
  [
    'text_info'=>'text for test',
    'href_left'=>'',
    'href_right'=>'',
    'data_blocks_pagination_item'=>[
      [
        'href'=>'',
        'text'=>'1',
        'class'=>' active',
      ],
      [
        'href'=>'',
        'text'=>'2',
        'class'=>'',
      ],
      [
        'href'=>'',
        'text'=>'3',
        'class'=>'',
      ],
    ],
  ],
];