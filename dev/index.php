<?
include 'php/functions.php';
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
        <?=render("page-".$_GET['page']); ?>
</body>
</html>