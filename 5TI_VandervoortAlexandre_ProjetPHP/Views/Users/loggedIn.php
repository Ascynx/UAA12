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
            <div class="table flex column scroll-overflow">
                <table class="flex center-self">
                    <tr class="table-header">
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
                        $pagedElements = getAllPlanningsAfterFromTo($min, $max);
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
                                    <td>
                                        $date
                                    </td>
                                    <td>
                                        $heure_debut
                                    </td>
                                    <td>
                                        $heure_fin
                                    </td>
                                    <td class=\"highlightOnHover clickable\">
                                        <span class=\"edit smaller-img-container inherit-display\" onclick=\"redirectTo('/edit_planning?s=$id')\">
                                            <img src=\"/Assets/images/pencil.png\" alt=\"edit\">
                                        </span>
                                    </td>
                                    <td class=\"highlightOnHover clickable\">
                                        <span class=\"delete smaller-img-container inherit-display\" onclick=\"redirectTo('/delete_planning?s=$id')\">
                                            <img src=\"/Assets/images/trash-can.png\" alt=\"delete\">
                                        </span>
                                    </td>
                                </tr>
                            ");
                        }
                    ?>

                    <?php if($user["user_access"]> 0): ?>
                        <tr class="new-element center-text BEEG_TEXT clickable" onclick="redirectTo('/new_planning')">
                            <td colspan="3">
                                +
                            </td>
                        </tr>
                    <?php endif?>
                </table>
            </div>
        </div>
        <div class="participants half flex column">
            <div class="title center-text">
                <h2>Participants</h2>
            </div>
            <div class="table flex column scroll-overflow">
                <table class="flex center-self">
                    <tr class="table-header">
                        <th>
                            Raison
                        </th>
                        <th>
                            Classe
                        </th>
                        <th>
                            Nom
                        </th>
                        <th>
                            Prénom
                        </th>
                    </tr>
                    <?php
                        if ($selected != 0) {
                            $etudes = getEtudesFromPlanning($selected);

                            for ($i = 0; $i < sizeof($etudes); $i++) {
                                $etude = $etudes[$i];
                                $id = $etude->etu_id;

                                $estClasse = $etude->etu_cla_id != NULL;
                                $raison = $etude->etu_raison;

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
                                }
                                echo("
                                <tr>
                                    <td>
                                        $raison
                                    </td>
                                    <td>
                                        $classe
                                    </td>
                                    <td>
                                        $nom
                                    </td>
                                    <td>
                                        $prenom
                                    </td>
                                    <td class=\"highlightOnHover clickable\">
                                        <span class=\"edit smaller-img-container inherit-display\" onclick=\"redirectTo('/edit_etude?s=$id')\">
                                            <img src=\"/Assets/images/pencil.png\" alt=\"edit\">
                                        </span>
                                    </td>
                                    <td class=\"highlightOnHover clickable\">
                                        <span class=\"delete smaller-img-container inherit-display\" onclick=\"redirectTo('/delete_etude?s=$id')\">
                                            <img src=\"/Assets/images/trash-can.png\" alt=\"delete\">
                                        </span>
                                    </td>
                                </tr>
                            ");
                            }
                        }
                    ?>
                    <?php if($user["user_access"] > 0 && $selected != 0): ?>
                        <tr class="new-element center-text BEEG_TEXT clickable" onclick="redirectTo('/new_etude?planning=<?=$selected?>')">
                            <td colspan="4">
                                +
                            </td>
                        </tr>
                    <?php endif?>
                </table>
            </div>
        </div>
    </div>
    
</div>

<script src="/Assets/scripts/utils.js"></script>
<script src="/Assets/scripts/loggedIn.js"></script>