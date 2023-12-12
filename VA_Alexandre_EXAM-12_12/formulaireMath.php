<?php
require_once "fonctions.php"

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen UAA12 - Vandervoort</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <header class="flex column">
        <div class="flex row nav">
            <!-- Navigation -->
            <a href="index.php"><button>Home</button></a>
            <a href="formulaireMath.php"><button>Tester l'application</button></a>
            <a href=""><button>Contact</button></a>
        </div>
        <div>
            <!-- Titre de page -->
            <h1>Testez notre calculateur de triangle</h1>
        </div>
    </header>
    <main class="flex row center-content center-self">
        <div class="flex row space-between center-content main">
            <div class="flex row form-div">
                <form action="formulaireMath.php" method="GET" class="flex column center-content">
                    <div class="flex row center-content space-evenly">
                        <fieldset class="flex column">
                            <legend class="form-stuff">Les côtés de votre triangle</legend>

                            <label for="cote1">Côté A</label>
                            <input type="number" name="cote1" id="cote1" min="1" placeholder="Côté A">

                            <label for="cote2">Côté B</label>
                            <input type="number" name="cote2" id="cote2" min="1" placeholder="Côté B">

                            <label for="cote2">Côté C</label>
                            <input type="number" name="cote3" id="cote3" min="1" placeholder="Côté C">
                        </fieldset>
                    </div>
                    <input type="submit" value="Envoyez" name="envoyez" class="form-stuff center-self button">
                </form>
            </div>
            <?php if (isset($_GET)) : ?>
                <div class="flex column center-content">
                    <?php
                        if (isset($_GET["cote1"]) && isset($_GET["cote2"]) && isset($_GET["cote3"])) {
                            $cote1 = $_GET["cote1"];
                            $cote2 = $_GET["cote2"];
                            $cote3 = $_GET["cote3"];

                            $b = true;
                        }
                    ?>
                    <?php if ($b) : ?>
                        <p class="form-stuff center-self"><?= TriangleRectangle($cote1, $cote2, $cote3) ?></p>
                    <?php endif ?>
                <div>
            <?php endif ?>
        </div>
    </main>
    <footer class="flex row foot space-between">
        <!-- Foot -->
        <button>Examen décembre 2023 UAA12</button>
        <button>5TTI</button>
    </footer>
</body>

</html>