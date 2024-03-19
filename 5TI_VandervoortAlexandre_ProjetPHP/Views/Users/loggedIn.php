<?php
    require_once("Models/planningModel.php");
    require_once("Models/etudeModel.php");
    require_once("Models/eleveModel.php");
    require_once("Models/classeModel.php");

    $actualPage = $page + 1;
    $min = $page * 10;
    $max = $min + 10;
?>

<link rel="stylesheet" href="Assets/css/accueil.css">
<link rel="stylesheet" href="Assets/css/loggedIn.css">

<div class="flex column">
    <div class="blue-bg padded">
        <div class="title center-text">
            <h1>Bienvenue <?= $user['user_name'] ?></h1>
        </div> 
    </div>
    <div class="flex row fill-width space-between">
        <div class="etude half flex column">
            <div class="title center-text">
                <h2>Horaire</h2>
            </div>
            <div class="table flex column">
                <table class="flex center-self">
                    <tr>
                        <th>
                            Date
                        </th>
                        <th>
                            Heure de début
                        </th>
                        <th>
                            Heure de fin
                        </th>
                    </tr>
                    <?php
                        $pagedElements = getAllPlanningsFromTo($min, $max);
                        for ($i = 0; $i < sizeof($pagedElements); $i++) {
                            $element = $pagedElements[$i];
                            $id = $element->pla_id;
                            $isSelected = $id == $selected;

                            $date = $element->pla_date;
                            $timestamp_debut = strtotime($element->pla_heure, 0);
                            $time = $element->pla_duree * 50;
                            $timestamp_fin = $timestamp_debut + mktime(floor($time / 60), floor($time % 60), 0, 1, 1, 1970);
                            
                            $heure_debut = date("H:i:s", $timestamp_debut);
                            $heure_fin = date("H:i:s", $timestamp_fin);


                            $selectedAttributes = $isSelected ? "class=\"selected\"" : "class=\"clickable\" onClick=\"window.open('?selected=$id', '_self')\"";
                            echo("
                                <tr $selectedAttributes>
                                    <th>
                                        $date
                                    </th>
                                    <th>
                                        $heure_debut
                                    </th>
                                    <th>
                                        $heure_fin
                                    </th>
                                </tr>
                            ");
                        }
                    ?>
                </table>
            </div>
        </div>
        <div class="participants half flex column">
            <div class="title center-text">
                <h2>Participants</h2>
            </div>
            <div class="table flex column">
                <table class="flex center-self">
                    <tr>
                        <th>
                            Nom
                        </th>
                        <th>
                            Prénom
                        </th>
                        <th>
                            Classe
                        </th>
                    </tr>
                    <?php
                        if ($selected != 0) {
                            $etudes = getEtudesFromPlanning($selected);

                            for ($i = 0; $i < sizeof($etudes); $i++) {
                                $etude = $etudes[$i];

                                $estClasse = $etude->etu_cla_id != NULL;

                                $nom = "";
                                $prenom = "";
                                $classe = "";

                                if ($estClasse) {
                                    $cla = getClasseFromId($etude->etu_cla_id);
                                    $classe = $cla->cla_annee;
                                } else {
                                    if ($etude->etu_ele_id != NULL) {
                                        $ele = getEleveFromId($etude->etu_ele_id);
                                        $nom = $ele->ele_nom;
                                        $prenom = $ele->ele_prenom;
                                        $classe = getClasseFromId($ele->ele_cla_id)->cla_annee;
                                    } else {
                                        $nom = "UNKNOWN";
                                        $prenom = "UNKNOWN";
                                        $classe = "UNKNOWN";
                                    }
                                    
                                    echo("
                                <tr>
                                    <th>
                                        $nom
                                    </th>
                                    <th>
                                        $prenom
                                    </th>
                                    <th>
                                        $classe
                                    </th>
                                </tr>
                            ");
                                }
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
    
</div>