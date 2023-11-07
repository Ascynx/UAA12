<?php
    $nbrDepart = 5;
    $nbrElements = 8;

    $nbr1 = 21;
    $nbr2 = 15;

    $phrase = "La réussite passe par une étude et un entraînement régulier et sérieux";

    require_once "fonctions.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UAA12 - Alexandre Vandervoort - PHP Fonctions</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body class="flex column">
    <header>
        <h1>Apprendre les fonctions en php</h1>
    </header>
    <main class="center-self">
        <div>
            <div>
                <h1>Testons les appels de fonctions</h1>
                <p class="bold">Je veux des belles fonctions php (séparer analyse et affichage dans votre fichier)</p>
                <h2 class="bold">Première fonction</h2>
                <p>Voici une suite tout à fait farfelue (pour un numbre de départ de <?= $nbrDepart ?> et un nombre d'éléments de <?= $nbrElements ?>): <?= fonctionSpeciale($nbrDepart, $nbrElements) ?></p>
                <h2 class="bold">Calcul du PGCD</h2>
                <p>Le PGCD entre <?= $nbr1 ?> et <?= $nbr2 ?> vaut <?= algorithmeEuclide2($nbr1, $nbr2) ?></p>
            </div>
            <div>
                <h1>Affichez proprement du code</h1>
                <p>
                    On ne crée pas de fonction mais on écrit proprement la boucle php dans l'html<br>
                    (On souhaite afficher la dernière lettre de chaque mot dans une liste à puces. On considère que chaque mot est suivi d'un espace sauf le dernier)
                </p>

                <p>Dans la variable $phrase "<?= $phrase ?>", la dernière lettre de chaque mot est </p>
                <ul>
                    <?php $words = explode(" ", $phrase); ?>
                    <?php for ($i = 0; $i < sizeof($words); $i++) : ?>
                        <?php $word = $words[$i]; ?>
                        <li><?= $word[strlen($word) - 1] ?></li>
                    <?php endfor ?>
                </ul>
            </div>
        </div>
    </main>
</body>

</html>