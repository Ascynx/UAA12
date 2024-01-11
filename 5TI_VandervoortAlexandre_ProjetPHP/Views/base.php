<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> </title>
</head>
<body>
    <header>
        <?php require_once("Views/Components/nav.php"); ?>
    </header>
    <main>
        <?php require_once($template) ?>
    </main>
    <footer>
        <?php require_once("Views/Components/foot.php"); ?>
    </footer>
</body>
</html>