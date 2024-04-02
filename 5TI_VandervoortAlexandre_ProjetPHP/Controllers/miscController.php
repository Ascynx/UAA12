<?php
require_once("Models/planningModel.php");
require_once("Models/etudeModel.php");
require_once("Models/eleveModel.php");
require_once("Models/classeModel.php");

if (isPage($uri, "/new_etude", true, $loggedIn) && $user["user_access"] > 0 && isset($components["planning"])) {
    $template = "Views/Etudes/newEtude.php";
    $title = "Ajout d'un participant.";
    $main_style = "flex column center-content";

    $planningId = (int) $components["planning"];
    if (getPlanningFromId($planningId) == null) {
        echo("N'ai pas pu obtenir planning depuis planningId=" . $planningId);
    }

    if (isset($_POST["raison"])) {
        $type = $_POST["type"];
        $id;
        $raison = $_POST["raison"];
        if ($type=="classe") {
            $classe_name = $_POST["class-name"];
            $cla = findClasseFromName($classe_name);
            $id = $cla == null ? 0 : $cla->cla_id;


        } else if ($type=="eleve") {
            $eleve_name = $_POST["eleve-name"];
            $eleve_firstname = $_POST["eleve-firstname"];
            $ele = getEleveFromName($eleve_name, $eleve_firstname);
            $id = $ele == null ? 0 : $ele->ele_id;
        }

        if ($id != 0) {
            createEtude($id, $type, $raison, $planningId);
            echo('<script>alert("Créé nouvelle entrée")</script>');
        }
    }

    $pageLoaded = true;
    require_once("Views/base.php");
} else if (isPage($uri, "/new_planning", true, $loggedIn) && $user["user_access"] > 0) {
    $template = "Views/Etudes/newPlanning.php";
    $title = "Ajout d'une heure d'étude.";
    $main_style = "flex column center-content";

    if (isset($_POST["date"])) {
        //creation d'une nouvelle entrée
        $date = $_POST["date"];
        $debut = $_POST["debut"];
        $duree = $_POST["duree"];

        $debut_time = strtotime($debut, 0);
        if ($debut_time > 30_300 || $debut_time < 58_500) {
            //heure est correct (entre en 8:25 et 16:15).
            createNewPlanning($date, $debut, (int) $duree);
            echo('<script>alert("Créé nouvelle entrée commençant à '. $debut . ' d\'une durée de '. $duree . ' périodes")</script>');
        }

        
    }

    $pageLoaded = true;
    require_once("Views/base.php");
}
