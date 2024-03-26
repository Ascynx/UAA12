<?php
    if (isPage($uri, "/", true, $loggedIn) || isPage($uri, "/index.php", true, $loggedIn)) {
        $template = "Views/Users/loggedIn.php";
        $title = "Bienvenue " . $user["user_name"];

        $selected = 0;
        $page = 0;

        if (isset($components["selected"]) && filter_var($components["selected"], FILTER_VALIDATE_INT)) {
            $selected = (int)$components["selected"];
        }
        if (isset($components["page"]) && filter_var($components["page"], FILTER_VALIDATE_INT)) {
            $page = (int)$components["page"];
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