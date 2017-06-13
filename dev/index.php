<?
ini_set('error_reporting', E_ALL);

//if($_GET['compile']==1){
//    chmod(__DIR__.'/html/',0777);
//    $dirs = scandir('./');
//    foreach ($dirs as $dir) {
//        if($dir == '.' || $dir == '..' || !preg_match('/page\-(.*)\.php/',$dir,$page)) continue;
//        $url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/';
//        $html = file_get_contents($url.'?page='.$page[1]);
//        file_put_contents(__DIR__.'/html/page-'.$page[1].'.html',$html);
//    }
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="/css/css.css" />

    <script src="/js/js.js"></script>
</head>
<body>
        <?
        include "page-".$_GET['page'].".php";
        ?>
</body>
</html>