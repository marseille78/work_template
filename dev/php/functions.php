<?php

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

global $_TPLPATH, //TODO: set constants
       $_PAGETPLPATH,
       $_VARS;

include "config.php";

/**
 * TEMPLATE
 */

/**
 * @param string $tplName
 * @param null $data
 * @return null|string
 */
function render($tplName,$data=null,$cycle=null){
    global $_TPLPATH, $_PAGETPLPATH, $_BASEPATH;
    $tpl = null;
    if(file_exists($_BASEPATH.'/'.$_TPLPATH.$tplName.'.php')){
        $tpl = $_BASEPATH.'/'.$_TPLPATH.$tplName.'.php';
    }elseif (file_exists($_BASEPATH.'/'.$_PAGETPLPATH.$tplName.'.php')){
        $tpl = $_BASEPATH.'/'.$_PAGETPLPATH.$tplName.'.php';
    }
    if(is_null($data)){
        $data = getVars($tplName);
    }

//    if($tplName == 'sasscat_example2'){
//
//        var_dump($data);
////        exit;
//    }

//    TODO: make debug
//    if($tplName == 'sasscat_example2')
//    debug(
//        '
//        $tplName: '.print_r($tplName,true).'
//        $data: '.print_r($data,true).'
//        $cycle: '.print_r($cycle,true).'
//        tplPath: '.print_r($tpl,true).'
//        '
//    );
    if(!is_null($tpl)){
        ob_start();
        if(is_null($data) || (is_string($data) && empty($data))){
            $var = '';
            if(!is_null($cycle) && is_int($cycle)){
                for($i=0;$i<$cycle;$i++){
                    include $tpl;
                }
            }else{
                include $tpl;
            }
        }else{
//            if($tplName == 'sasscat_example2') var_dump($cycle);
            if(!is_null($cycle) && is_int($cycle)){
                for($i=0;$i<$cycle;$i++){
                    if(is_array($data[$i])){
                        if(empty($data[$i])){
                            continue;
                        }
                        $var = $data[$i];
                    }else{
                        if(empty($data[0])){
                            continue;
                        }
                        if(!empty($data[0]) && is_array($data[0])){
                            $var = $data[0];
                        }else{
                            $var = $data;
                        }
                    }
                    include $tpl;
                }
            }else {
//                var_dump($data);
                if(is_array($data)){
                    foreach ($data as $var) {
//                    if($tplName == 'sasscat_example') var_dump($var);
                        include $tpl;
                    }
                }
            }
        }
        $r = ob_get_contents();
        ob_end_clean();
        return $r;
    }
    return null;
}

/**
 * @param string $name - $_VARS key
 * @return null
 */
function getVars($name){
    global $_VARS;
    return !empty($_VARS[$name]) ? $_VARS[$name] : null;
}

/**
 * @param * $var
 * @return string|*
 */
function variable($var,$key){
    return isset($var[$key])
    ? (empty($var[$key])
        ? (is_array($var[$key])
            ? []
            : '' )
        : $var[$key] )
    : null;
}

/**
 * PRE TEMPLATE
 */
/**
 * @param string $type - type kind of templates
 * [full|]
 */
function createTpls($type='page'){
    global $_TPLPATH, $_PAGETPLPATH, $_BASEPATH;
    $path_tpl = $_BASEPATH.'/html/'.$type.'/';
    switch ($type){
        case 'page':
            debug('tpl creation. mode: '.$type);
            mkdir($path_tpl, 0777, true);
            $dirs = scandir($_BASEPATH);
            foreach ($dirs as $dir) {
                if($dir == '.' || $dir == '..' || !preg_match('/page\-(.*)\.php/',$dir,$page))
                    continue;

                $url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/?page='.$page[1];
                $html = file_get_contents($url);
                file_put_contents($path_tpl.'page-'.$page[1].'.html',$html);
            }
            break;
        case 'layers':
            debug('tpl creation. mode: '.$type);
            mkdir($path_tpl, 0777, true);
            $dirs = scandir($_BASEPATH.'/'.$_TPLPATH);
            foreach ($dirs as $dir) {
                if($dir == '.' || $dir == '..')
                    continue;

                $html = render(preg_replace('/\.php/','',$dir));
                file_put_contents($path_tpl.$dir.'.html',$html);
            }
            break;
        case 'triple':
            debug('tpl creation. mode: '.$type);
            mkdir($path_tpl, 0755, true);
            $dirs = scandir($_BASEPATH.'/'.$_TPLPATH);
            foreach ($dirs as $dir) {
                if($dir == 'static_top.php' || $dir == 'static_bottom.php'){
                    $html = render(preg_replace('/\.php/','',$dir));
                    file_put_contents($path_tpl.$dir.'.html',$html);
                }
            }
            $dirs = scandir($_BASEPATH);
            foreach ($dirs as $dir) {
                if(preg_match('/page\-.*\.php/',$dir)){
                    $html = render(preg_replace('/\.php/','',$dir));
                    file_put_contents($path_tpl.$dir.'.html',$html);
                }
            }
            break;
    }
}

function debug($m){
    echo '<pre>';
    print_r($m);
    echo '</pre>';
}