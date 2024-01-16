<?php
    require_once("Models/userModel.php");

    $uri = $_SERVER["REQUEST_URI"];
    $loggedIn = logged_in();
    if ($loggedIn) {
        $user = load_user();
    }

    if (str_ends_with($uri, '/index.php') || str_ends_with($uri, '/')) {
        $template = "Views/accueil";
        if ($loggedIn) {
            $template = $template . "_logged.php";
        } else {
            $template = $template . ".php"; 
        }

        $title = "Bienvenue";
        require_once("Views/base.php");
    }

    function logged_in(): bool {
        if (!isset($_SESSION['userId']) || !isset($_SESSION['userHash'])) {
            return false;
        }

        $userId = $_SESSION['userId'];
        $userHash = $_SESSION['userHash'];
        if (!isset($userHash) || !isset($userId)) {
            return false;
        }

        if ($userId === "test") {
            return true;
        }

        return isUserLoggedIn($userId, $userHash);
    }

    function load_user(): bool | array {
        if (!isset($_SESSION['userId']) || !isset($_SESSION['userHash'])) {
            return false;
        }

        $userId = $_SESSION['userId'];
        $userHash = $_SESSION['userHash'];
        if (!isset($userHash) || !isset($userId)) {
            return false;
        }

        if ($userId === "test") {
            return createTestUser();
        }

        return loadUser($userId); 
    }