<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://kit.fontawesome.com/9e5ac608ee.js" crossorigin="anonymous"></script>

    <?php foreach ($css as $c) { ?>
        <link rel="stylesheet" href="/assets/css/<?= $c ?>.css">
    <?php } ?>

    <title><?= $title ?></title>
</head>
<body>
    <?php
    if(isset($var["error"])){?>
        <div id="error" style="background-color:<?= $var["color"] ?>"><?= $var["error"]; ?></div><?php
    } ?>
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/assets/parts/menu.php") ?>
    <?= $html ?>

    <?php if(isset($js)){ ?>
        <script src="./assets/js/<?= $js ?>.js"></script>
    <?php } ?>
</body>
</html>

