<?php
    $uri = $_SERVER["REQUEST_URI"];
    $loggedIn = logged_in();
    if (str_ends_with($uri, '/index.php') || str_ends_with($uri, '/')) {
        $template = "Views/accueil.php";
        $title = "Bienvenue";
        require_once("Views/base.php");
    }

    function logged_in(): bool {
        $userId = $_SESSION['userId'];
        $userHash = $_SESSION['userHash'];
        if (!isset($userHash) || !isset($userId)) {
            return false;
        }
        return isUserLoggedIn($userId, $userHash);
    }