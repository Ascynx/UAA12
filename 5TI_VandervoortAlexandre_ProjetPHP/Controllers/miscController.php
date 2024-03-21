<?php
if (isPage($uri, "/new_etude", true, $loggedIn) && $user["user_access"] > 0) {
    $template = "Views/Etudes/newEtude.php";
    $title = "Ajout d'un participant.";

    $pageLoaded = true;
    require_once("Views/base.php");
} else if (isPage($uri, "/new_planning", true, $loggedIn) && $user["user_access"] > 0) {
    $template = "Views/Etudes/newPlanning.php";
    $title = "Ajout d'une heure d'étude.";

    $pageLoaded = true;
    require_once("Views/base.php");
}
