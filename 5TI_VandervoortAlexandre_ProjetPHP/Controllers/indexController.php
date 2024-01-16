<?php
    require_once("Models/userModel.php");
    require_once("Models/pageSortingModel.php");

    $uri = $_SERVER["REQUEST_URI"];
    $loggedIn = logged_in();
    if ($loggedIn) {
        $user = load_user();
    }

    if (isPage("/", true, $loggedIn) || isPage("/index.php", true, $loggedIn)) {
        $template = "Views/Users/loggedIn.php";
        $title = "Bienvenue " . $user["user_name"];
        require_once("Views/base.php");
    } else if (isPage("/", false, $loggedIn) || isPage("/index.php", false, $loggedIn)) {
        $template = "Views/accueil.php";
        $title = "Bienvenue";
        require_once("Views/base.php");
    } else if (isPage("/testLogin", true, $loggedIn)) {//ces deux pages sont temporaires et seront supprimé quand plus nécessaire.
        unset($_SESSION["userId"]);
        unset($_SESSION["userHash"]);
        header("Location:".$_SERVER['HTTP_HOST']);
        die();
    } else if (isPage("/testLogin", false, $loggedIn)) {
        $_SESSION["userId"] = "test";
        $_SESSION["userHash"] = "unset";
        header("Location:".$_SERVER['HTTP_HOST']);
        die();
    }