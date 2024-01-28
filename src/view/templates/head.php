<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="global.css">
    <?php
    foreach ($cssPaths as $cssPath) {
        echo "<link rel=\"stylesheet\" href=\"{$cssPath}\">";
    }

    foreach ($scriptPaths as $scriptPath) {
        echo "<script defer src=\"{$scriptPath}\"></script>";
    }
    ?>
</head>
