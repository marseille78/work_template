<?php

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

global $_TPLPATH, //TODO: set constants
       $_PAGETPLPATH,
       $_VARS,
       $_mode;

$var=[
  'index_page'=>'',
];
if(!empty($_GET['page'])){
  $var['index_page'] = $_GET['page'];
}
if(!empty($_GET['type'])) {
  include_once "config.map.php";
}else{
  include_once "config.php";
}

/**
 * TEMPLATE
 */

/**
 * @param string $tplName
 * @param null $data
 * @return null|string
 */
function render($tplName,$data=null,$cycle=null){ // TODO: TRY TO CREATE PRETTY ECHO
  global $_TPLPATH, $_PAGETPLPATH, $_BASEPATH;
  $tpl = null;
  if(file_exists($_BASEPATH.'/'.$_TPLPATH.$tplName.'.php')){
    $tpl = $_BASEPATH.'/'.$_TPLPATH.$tplName.'.php';
  }elseif (file_exists($_BASEPATH.'/'.$_PAGETPLPATH.$tplName.'.php')){
    $tpl = $_BASEPATH.'/'.$_PAGETPLPATH.$tplName.'.php';
  }
  // TODO: ? merge with default data $_VARS
  if(is_null($data)){
    $data = getVars($tplName);
  }
  // TODO: make debug
//    if($tplName == 'type_second'){
//        debug(
//            '
//        $tplName: '.print_r($tplName,true).'
//        $data: '.print_r($data,true).'
//        $cycle: '.print_r($cycle,true).'
//        tplPath: '.print_r($tpl,true).'
//        '
//        );
//        exit;
//    }

  if(isset($data['RETURN'])){
    return $data['RETURN']."\n";
  }
  if(isset($data['file'])){
    unset($data['file']);
  }
  if(isset($data['type']) && $data['type']==''){
    unset($data['type']);
  }

  if(!is_null($tpl)){
    ob_start();
    if(is_null($data) || (is_string($data) && empty($data))){
      $var = '';
      if(!is_null($cycle) && is_int($cycle)){
        for($i=0;$i<$cycle;$i++){
          include_once $tpl;
        }
      }else{
        include_once $tpl;
      }
    }else{
      if (!empty($data['type']) && file_exists($_BASEPATH . '/' . $_TPLPATH . $data['type'] . '.php')) {
        $type = $data['type'];
        unset($data['type']);
        $data[0]['page'] = $tplName;
        $vars = getVars($type)?getVars($type):[[]];//TODO: watch this part for righting
        $data = [array_merge($vars[0],$data[0])];
        echo render($type, $data);
      } else if(!is_null($cycle) && is_int($cycle)){
        for($i=0;$i<$cycle;$i++){
          if(isset($data[$i]) && is_array($data[$i])){
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
      } else {
        if(is_array($data)){
          foreach ($data as $var) {
            $gv = getVars($tplName);
            if(is_array($gv)){
              $var = array_merge($gv[0],$var);
            }
            include $tpl;
          }
        }
      }
    }
    $r = ob_get_contents();
    ob_end_clean();
    return $r."\n";
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
function createTpls($type='page'){ // TODO: optimize this function
  global $_TPLPATH, $_PAGETPLPATH, $_BASEPATH;
  $path_tpl = $_BASEPATH.'/html/'.$type.'/';
  switch ($type){
    case 'full_page':
      debug('tpl creation. mode: '.$type);
      mkdir($path_tpl, 0777, true);
      $dirs = scandir($_BASEPATH);
      foreach ($dirs as $dir) {
        if($dir == '.' || $dir == '..' || !preg_match('/page\-(.*)\.php/',$dir,$page))
          continue;

        debug('start '.$dir);
        $vars['page'] = getVars('page-'.$page[1]);
        if(is_null($vars['page']))
          continue;

        $vars['index'] = getVars('index');
        $file = [
          'name'=>$page[1],
          'ext'=>'html',
        ];
        if(!empty($vars['page']['file'])){
          if(!empty($vars['page']['file']['ext'])){
            $file['ext']=$vars['page']['file']['ext'];
          }
          if(!empty($vars['page']['file']['name'])){
            $file['name']=$vars['page']['file']['name'];
          }
        }
        $vars = [array_merge_recursive(array('index_page'=>$page[1]),$vars['index'][0],$vars['page'][0])];
        $html = render('index',$vars);
        file_put_contents($path_tpl.$file['name'].'.'.$file['ext'],$html);
      }
      break;
    case 'page':
      debug('tpl creation. mode: '.$type);
      mkdir($path_tpl, 0777, true);
      $dirs = scandir($_BASEPATH);
      foreach ($dirs as $dir) {
        if($dir == '.' || $dir == '..' || !preg_match('/page\-(.*)\.php/',$dir,$page))
          continue;

        $vars['page'] = getVars('page-'.$page[1]);
        if(is_null($vars['page']))
          continue;

        $file = [
          'name'=>$page[1],
          'ext'=>'html',
        ];
        if(!empty($vars['page']['file'])){
          if(!empty($vars['page']['file']['ext'])){
            $file['ext']=$vars['page']['file']['ext'];
          }
          if(!empty($vars['page']['file']['name'])){
            $file['name']=$vars['page']['file']['name'];
          }
        }
        $html = render('page-'.$page[1]);
        file_put_contents($path_tpl.$file['name'].'.'.$file['ext'],$html);
      }
      break;
    case 'layers':
      debug('tpl creation. mode: '.$type);
      mkdir($path_tpl, 0777, true);
      $dirs = scandir($_BASEPATH.'/'.$_TPLPATH);
      foreach ($dirs as $dir) {
        if($dir == '.' || $dir == '..' || is_dir($dir))
          continue;

        $dir = preg_replace('/\.php/','',$dir);
        $vars['layer'] = getVars($dir);
        if(is_null($vars['layer']))
          continue;

        $file = [
          'name'=>$dir,
          'ext'=>'html',
        ];
        if(!empty($vars['layer']['file'])){
          if(!empty($vars['layer']['file']['ext'])){
            $file['ext']=$vars['layer']['file']['ext'];
          }
          if(!empty($vars['layer']['file']['name'])){
            $file['name']=$vars['layer']['file']['name'];
          }
        }
        $html = render($dir);
        file_put_contents($path_tpl.$file['name'].'.'.$file['ext'],$html);
      }
      break;
    case 'classic':
      debug('tpl creation. mode: '.$type);
      mkdir($path_tpl, 0755, true);
      $dirs = scandir($_BASEPATH);
      foreach ($dirs as $dir) {
        if($dir == '.' || $dir == '..' || !preg_match('/page\-(.*)\.php/',$dir,$page))
          continue;

        $vars['page'] = getVars('page-'.$page[1]);
        if(is_null($vars['page']))
          continue;

        if(!empty($vars['page']['file']) && !empty($vars['page']['file']['skip']) && ($vars['page']['file']['skip']==1||$vars['page']['file']['skip']==true))
          continue;

        $file = [
          'name'=>$page[1],
          'ext'=>'html',
        ];
        if(!empty($vars['page']['file'])){
          if(!empty($vars['page']['file']['ext'])){
            $file['ext']=$vars['page']['file']['ext'];
          }
          if(!empty($vars['page']['file']['name'])){
            $file['name']=$vars['page']['file']['name'];
          }
        }
        $html = render('page-'.$page[1]);
        file_put_contents($path_tpl.$file['name'].'.'.$file['ext'],$html);
      }
      $dirs = scandir($_BASEPATH.'/'.$_TPLPATH);
      foreach ($dirs as $dir) {
        if($dir == '.' || $dir == '..' || is_dir($dir))
          continue;

        $dir = preg_replace('/\.php/','',$dir);
        $vars['layer'] = getVars($dir);
        if(is_null($vars['layer']))
          continue;

        if(!empty($vars['layer']['file']) && !empty($vars['layer']['file']['skip']) && ($vars['layer']['file']['skip']==1||$vars['layer']['file']['skip']==true))
          continue;

        $file = [
          'name'=>$dir,
          'ext'=>'html',
        ];
        if(!empty($vars['layer']['file'])){
          if(!empty($vars['layer']['file']['ext'])){
            $file['ext']=$vars['layer']['file']['ext'];
          }
          if(!empty($vars['layer']['file']['name'])){
            $file['name']=$vars['layer']['file']['name'];
          }
        }
        $html = render($dir);
        file_put_contents($path_tpl.$file['name'].'.'.$file['ext'],$html);
      }
      break;
  }
}

function debug($m){
  echo "\n".'<pre>'."\n";
  print_r($m);
  echo "\n".'</pre>'."\n";
}

function m($message){
  global $_mode;
  return $_mode?"<!-- $message -->":'';
}