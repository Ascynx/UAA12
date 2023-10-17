<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alexandre Vandervoort - PHP</title>
</head>
<body> 
    <div>
        <?php
            echo "<p>Etape 0</p>";
            echo "Hello World";
        ?>
    </div>
    
    <div>
        <?php
            echo "<p>Etape 1</p>";
            for ($i = 1; $i <= 10; $i++) {
                echo "<p>Le nombre vaut " . $i . "</p>";
            }
        ?>
    </div>
    
    <div>
        <?php
            echo "<p>Etape 2</p>";
            for ($i = 1; $i <= 10; $i++) {
                if ($i != 3) {
                    echo "<p>Le nombre vaut " . $i . "</p>";
                }
            }
        ?>
    </div>

    <div>
        <?php
            echo "<p>Etape 3</p>";
            for ($i = 1; $i <= 10; $i++) {
                if ($i >= 8 || $i <= 3) {
                    echo "<p> Le nombre vaut " . $i . "</p>";
                }
            }
        ?>
    </div>

    <div>
        <?php
            echo "<p>Etape 4</p>";
            echo "<p>La valeur absolue de -5 vaut " . abs(-5) . "</p>";
            echo "<p>La valeur absolue de 10 vaut " . abs(10) . "</p>";
        ?>
    </div>
</body>
</html>