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
            <div class="table">
                <table>
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
                            $selected = $id == $selected;

                            $date = $element->pla_date;
                            $heure_debut = $element->pla_heure;
                            $heure_fin = $heure_debut + $element->pla_duree;

                            echo("
                                <tr class=\"selected\">
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
        </div>
    </div>
    
</div>