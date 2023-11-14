<?php
    require_once "fonctions.php";

    $MIN = 0;
    $MAX = 200;

    $message = "";

    if (isset($_GET["guess"])) {
        $val = $_GET["guess"];
        
        $gagne = devinerNombre($val, $message);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VA - Alexandre - Premier Exercice GET</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="flex column">
        <div class="bar-under box">
        <h1 class="fullcaps big">Jouez avec nous!!!!</h1>
        </div>
        <div class="box flex column">
        <form action="index.php" method="get" class="center-self">
            <legend class="center-text">Deviner un nombre</legend>
            <div class="deviner">
                <input type="number" min="<?=$MIN?>" max="<?=$MAX?>" placeholder="entre <?=$MIN?> et <?=$MAX?>" value="<?= $val ?>" name="guess" id="guess">
            </div>
            <div class="flex column beeg-button">
                <input type="submit" value="DEVINER">
            </div>
        </form>
        <p><?= $message?></p>
        </div>
        <div class="bar-above box">
            <p class="text-right">Premier exercice GET 5TI 2023</p>
        </div>
    </div>
</body>
</html>