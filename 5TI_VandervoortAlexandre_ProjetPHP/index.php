<?php
    session_start();
    require_once("Config/sqlConnect.php");

    $pageLoaded = false;
    require_once("Controllers/indexController.php");
    require_once("Controllers/userController.php");
    require_once("Controllers/errorController.php");