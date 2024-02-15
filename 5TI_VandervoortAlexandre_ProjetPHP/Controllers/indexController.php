<?php
    require_once("Models/userModel.php");
    require_once("Models/pageSortingModel.php");

    $uri = $_SERVER["REQUEST_URI"];
    $loggedIn = logged_in();
    if ($loggedIn) {
        $user = load_user();
    }
 
    if (isPage($uri, "/", true, $loggedIn) || isPage($uri, "/index.php", true, $loggedIn)) {
        $template = "Views/Users/loggedIn.php";
        $title = "Bienvenue " . $user["user_name"];

        $selected = 0;
        $page = 0;

        $components = get_query_components($uri);
        var_dump($components);
        if (isset($components["selected"]) && is_int($components["selected"])) {
            $selected = $components["selected"];
        }
        if (isset($components["page"]) && is_int($components["page"])) {
            $page = $components["page"];
        }

        $pageLoaded = true;
        require_once("Views/base.php");
    } else if (isPage($uri, "/", false, $loggedIn) || isPage($uri, "/index.php", false, $loggedIn)) {
        $template = "Views/accueil.php";
        $title = "Bienvenue";

        $pageLoaded = true;
        require_once("Views/base.php");
    } else if (isPage($uri, "/disconnect", true, $loggedIn)) {
        unset($_SESSION["userId"]);
        unset($_SESSION["userHash"]);
        header("Location:" . "/", TRUE, 303);
    }