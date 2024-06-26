<?php
require_once("Models/planningModel.php");
require_once("Models/etudeModel.php");
require_once("Models/eleveModel.php");
require_once("Models/classeModel.php");

if (isPage($uri, "eleves", false, $loggedIn)) {
    $template = "Views/Eleves/eleves.php";
    $title = "Eleves";
    $main_style = "flex column center-content gray-bg";

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
} else if (isPage($uri, "/classes", false, $loggedIn)) {
    $template = "Views/Classes/classes.php";
    $title = "Classes";
    $main_style = "flex column center-content gray-bg";

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
}

else if (isPage($uri, "/new_etude", true, $loggedIn) && $user["user_access"] > 0 && isset($components["planning"])) {
    $template = "Views/Etudes/newEtude.php";
    $title = "Ajout d'un participant.";
    $main_style = "flex column center-content gray-bg";

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
    $main_style = "flex column center-content gray-bg";

    if (isset($_POST["date"])) {
        //creation d'une nouvelle entrée
        $date = $_POST["date"];
        $debut = $_POST["debut"];
        $duree = $_POST["duree"];

        $debut_time = strtotime($debut, 0);
        if ($debut_time > 30_300 || $debut_time < 58_500) {
            //heure est correct (entre en 8:25 et 16:15).
            createNewPlanning($date, $debut, $duree);
            echo('<script>alert("Créé nouvelle entrée commençant à '. $debut . ' d\'une durée de '. $duree . ' périodes")</script>');
        }
    }
    $pageLoaded = true;
    require_once("Views/base.php");
}

else if (isPage($uri, "/edit_planning", true, $loggedIn) && $user["user_access"] > 0 && isset($components["s"])) {
    $id = $components["s"];
    $pla = getPlanningFromId($id);

    $date = $pla->pla_date;
    $debut = $pla->pla_heure;
    $duree = $pla->pla_duree;

    $datemin = date_create($date);
    $datemax = clone $datemin;
    $datemax = $datemax->add(DateInterval::createFromDateString("1 year"));

    $datemin_str = $datemin->format("Y-m-d");
    $datemax_str = $datemax->format("Y-m-d");

    if (isset($_POST["date"])) {
        //creation d'une nouvelle entrée
        $p_date = $_POST["date"];
        $p_debut = $_POST["debut"];
        $p_duree = $_POST["duree"];

        $p_debut_time = strtotime($p_debut, 0);
        if ($p_debut_time > 30_300 || $p_debut_time < 58_500) {
            //heure est correct (entre en 8:25 et 16:15).
            if (!($date == $p_date && $debut == $p_debut && $duree == $p_duree)) {
                //il y a au moins 1 changement
                editPlanning($id, $p_date == $date ? $p_date : "", $p_debut == $debut ? $p_debut : "", $p_duree == $duree ? $p_duree : "");
                header("Location:" . "/", TRUE, 303);
            }
        }
    }

    $template = "Views/Etudes/editPlanning.php";
    $title = "Edition d'une heure d'étude.";
    $main_style = "flex column center-content gray-bg";

    $pageLoaded = true;
    require_once("Views/base.php");
} else if (isPage($uri, "/delete_planning", true, $loggedIn) && $user["user_access"] > 0 && isset($components["s"])) {
    $id = $components["s"];

    deletePlanning($id);
    header("Location:" . "/", TRUE, 303);
}

else if (isPage($uri, "/edit_etude", true, $loggedIn) && $user["user_access"] > 0 && isset($components["s"])) {
    $id = $components["s"];
    $etu = getEtudeFromId($id);

    $type = $etu->etu_cla_id == null ? "eleve" : "classe";
    $raison = $etu->etu_raison;

    $classe_name = "";
    $eleve_firstname = "";
    $eleve_name = "";

    if ($type == "eleve") {
        $s_id = $etu->etu_ele_id;
        $ele = getEleveFromid($s_id);

        $eleve_name = $ele->ele_nom;
        $eleve_firstname = $ele->ele_prenom;
    } else if ($type == "classe") {
        $s_id = $etu->etu_cla_id;
        $cla = getClasseFromId($s_id);
    
        $classe_name = $cla->cla_annee;
    }

    if (isset($_POST["raison"])) {
        $newtype = $_POST["type"];
        $sub_id;
        $raison_p = $_POST["raison"];
        if ($type=="classe") {
            $classe_name_p = $_POST["class-name"];
            $cla = findClasseFromName($classe_name_p);
            $sub_id = $cla == null ? 0 : $cla->cla_id;
        } else if ($type=="eleve") {
            $eleve_name_p = $_POST["eleve-name"];
            $eleve_firstname_p = $_POST["eleve-firstname"];
            $ele = getEleveFromName($eleve_name_p, $eleve_firstname_p);
            $sub_id = $ele == null ? 0 : $ele->ele_id;
        }

        if ($sub_id != 0) {
            if (!($raison_p == $raison && ($sub_id == $s_id && $type == $newtype))) {
                //edit
                editEtude($id, $sub_id != $s_id ? $sub_id : 0, $type, $newtype, $raison_p != $raison ? $raison_p : "");
                header("Location:" . "/", TRUE, 303);
            }
        } 
    }

    $template = "Views/Etudes/editEtude.php";
    $title = "Edition d'un participant'.";
    $main_style = "flex column center-content gray-bg";

    $pageLoaded = true;
    require_once("Views/base.php");
} else if (isPage($uri, "/delete_etude", true, $loggedIn) && $user["user_access"] > 0 && isset($components["s"])) {
    $id = $components["s"];

    deleteEtude($id);
    header("Location:"."/", TRUE, 303);
}

else if (isPage($uri, "edit_eleve", true, $loggedIn) && $user["user_access"] > 0 && isset($components["s"])) {
    $id = $components["s"];
    $ele = getEleveFromId($id, true);

    $ele_nom = $ele->ele_nom;
    $ele_prenom = $ele->ele_prenom;
    $ele_cla_id = $ele->ele_cla_id;

    $ele_cla_name = $ele->cla_annee;

    if (isset($_POST["nom"])) {
        $new_nom = $_POST["nom"];
        $new_prenom;
        $new_classe;

        if (isset($_POST["prenom"])) {
            $new_prenom = $_POST["prenom"];
        }
        if (isset($_POST["classe"])) {
            $new_classe = $_POST["classe"];
        }

        $edited = false;
        if ($new_nom != $ele_nom) {
            //nom changé
            $edited = true;
        } else {
            $new_nom = "";
        }

        if ($new_prenom != $ele_prenom) {
            //prénom changé
            $edited = true;
        } else {
            $new_prenom = "";
        }

        $cla = 0;
        if ($new_classe != $ele_cla_name) {
            //classe changée
            $cla_ = findClasseFromName($new_classe);
            $cla = $cla_ == null ? 0 : $cla_->cla_id;
            $edited = true;
        } else {
            $new_classe = "";
        }

        if ($edited) {
            editEleve($id, $new_nom, $new_prenom, $cla);
            header("Location: ". "/eleves", TRUE, 303);
        }
    }

    $template = "Views/Eleves/editEleve.php";
    $title = "Mettre à jour élève";
    $main_style = "flex column center-content gray-bg";

    $pageLoaded = true;
    require_once("Views/base.php");
} else if (isPage($uri, "new_eleve", true, $loggedIn) && $user["user_access"] > 0) {
    $template = "Views/Eleves/newEleve.php";
    $title = "Nouvel élève";
    $main_style = "flex column center-content gray-bg";

    if (isset($_POST["nom"])) {
        $new_nom = $_POST["nom"];
        $new_prenom = $_POST["prenom"];
        $new_classe = $_POST["classe"];

        $cla = findClasseFromName($new_classe);
        $sub_id = $cla == null ? 0 : $cla->cla_id;

        if ($cla != null) {
            newEleve($new_nom, $new_prenom, $sub_id);
        }
    }

    $pageLoaded = true;
    require_once("Views/base.php");
} else if (isPage($uri, "delete_eleve", true, $loggedIn) && $user["user_access"] > 0  && isset($components["s"]) ) {
    $id = $components["s"];
    $cla = getEleveFromId($id);

    deleteEleve($id);
    header("Location: ". "/eleves", TRUE, 303);
} 

else if (isPage($uri, "edit_classe", true, $loggedIn) && $user["user_access"] > 0 && isset($components["s"])) {
    $id = $components["s"];
    $cla = getClasseFromId($id);

    $cla_annee_scolaire = $cla->cla_annee_scolaire;
    $cla_annee = $cla->cla_annee;

    if (isset($_POST["annee_scolaire"])) {
        $new_annee_scolaire = $_POST["annee_scolaire"];
        $new_annee = $_POST["annee"];

        if ($new_annee_scolaire != $cla_annee_scolaire || $new_annee != $cla_annee) {
            $new_annee_scolaire = $new_annee_scolaire != $cla_annee_scolaire ? $new_annee_scolaire : "";
            $new_annee = $new_annee != $cla_annee ? $new_annee : "";

            if ($new_annee != "" || $new_annee_scolaire != "") {
                editClasse($id, $new_annee_scolaire, $new_annee);
                header("Location: ". "/classes", TRUE, 303);
            }
            
        }
    }

    $template = "Views/Classes/editClasse.php";
    $title = "Mettre à jour classe";
    $main_style = "flex column center-content gray-bg";

    $pageLoaded = true;
    require_once("Views/base.php");
} else if (isPage($uri, "new_classe", true, $loggedIn) && $user["user_access"] > 0) {
    $template = "Views/Classes/newClasse.php";
    $title = "Nouvelle classe";
    $main_style = "flex column center-content gray-bg";

    if (isset($_POST["annee_scolaire"])) {
        $new_annee_scolaire = $_POST["annee_scolaire"];
        $new_annee = $_POST["annee"];

        newClasse($new_annee_scolaire, $new_annee);
    }

    $pageLoaded = true;
    require_once("Views/base.php");
} else if (isPage($uri, "delete_classe", true, $loggedIn) && $user["user_access"] > 0 && isset($components["s"])) {
    $id = $components["s"];
    $cla = getClasseFromId($id);

    header("Location: ". "/classes", TRUE, 303);
}