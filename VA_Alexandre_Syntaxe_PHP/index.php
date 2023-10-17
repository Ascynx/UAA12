<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alexandre Vandervoort - PHP</title>
</head>
<body> 
    <div>
        <p>Etape 0</p>
        <?php
            echo "Hello World";
        ?>
    </div>
    
    <div>
        <p>Etape 1</p>
        <?php for ($i = 1; $i <= 10; $i++): ?>
            <p>Le nombre vaut <?=$i?> </p>    
        <?php endfor ?>
    </div>
    
    <div>
        <p>Etape 2</p>
        <?php for ($i = 1; $i <= 10; $i++): ?>
            <?php if ($i != 3): ?>
                <p>Le nombre vaut <?=$i?></p>
            <?php endif ?>
        <?php endfor ?>
    </div>

    <div>
        <p>Etape 3</p>
        <?php for ($i = 1; $i <= 10; $i++): ?>
            <?php if ($i >= 8 || $i <= 3): ?>
                    <p>Le nombre vaut <?=$i?></p>
            <?php endif ?>
        <?php endfor ?>
    </div>

    <div>
        <p>Etape 4</p>
        <p>La valeur absolue de -5 vaut <?=abs(-5)?></p>;
        <p>La valeur absolue de 10 vaut <?=abs(10)?></p>;
    </div>
</body>
</html>