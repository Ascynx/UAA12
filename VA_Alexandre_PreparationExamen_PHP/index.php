<?php
require_once "fonctions.php";
if (isset($_POST["age"])) {
    $age = $_POST["age"];
    $permisAge = $_POST["permisAge"];
    $accidents = $_POST["accidents"];
    $anciennete = $_POST["anciennete"];

    if (!isset($age) || !isset($permisAge) || !isset($accidents) || !isset($anciennete)) {
        //ça pourrait créer un bug, donc on skip.
        return;
    }

    $contrat = CalculeContrat($age, $permisAge, $accidents, $anciennete);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Alexandre Vandervoort - Préparation Examen (basé sur C# Interro 2)</title>
</head>

<body>
    <div class="flex row">
        <form action="index.php" method="post" class="flex column">
            <fieldset>
            <legend>Client</legend>
                <div class="flex column">
                    <label for="age">Age du client</label>
                    <input type="number" name="age" id="age" min="18" max="95" required>
                </div>

                <div class="flex column">
                    <label for="permisAge">Années avec le permis</label>
                    <input type="number" name="permisAge" id="permisAge" required>
                </div>

                <div class="flex column">
                    <label for="accidents">Accidents depuis l'obtention du permis</label>
                    <input type="number" name="accidents" id="accidents" required>
                </div>

                <div class="flex column">
                    <label for="anciennete">Ancienneté du client dans la boite</label>
                    <input type="number" name="anciennete" id="anciennete" required>
                </div>

                <div class="flex column">
                    <input type="submit" value="Envoyer">
                </div>
            </fieldset>

        </form>

        <div>
            <?php if (isset($contrat)) : ?>
                <p>Contrat: <?= $contrat ?></p>
            <?php endif ?>
        </div>
    </div>
</body>

</html>