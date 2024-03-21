<?php
    session_start();
    require_once("Config/sqlConnect.php");
    require_once("Models/userModel.php");
    require_once("Models/pageSortingModel.php");

    $pageLoaded = false;

    $uri = $_SERVER["REQUEST_URI"];
    $loggedIn = logged_in();
    if ($loggedIn) {
        $user = load_user();
    }
    require_once("Controllers/indexController.php");
    require_once("Controllers/userController.php");
    require_once("Controllers/miscController.php");
    require_once("Controllers/errorController.php");