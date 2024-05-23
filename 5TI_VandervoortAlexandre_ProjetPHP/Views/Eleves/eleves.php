<?php
require_once("Models/planningModel.php");
require_once("Models/etudeModel.php");
require_once("Models/eleveModel.php");
require_once("Models/classeModel.php");

$actualPage = $page + 1;
$min = $page * 10;
$max = $min + 10;
?>

<link rel="stylesheet" href="Assets/css/loggedIn.css">

<div class="table flex column scroll-overflow">
    <table class="flex center-self">
        <tr class="table-header">
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
        $pagedElements = getAllElevesFromTo($min, $max);
        for ($i = 0; $i < sizeof($pagedElements); $i++) {
            $element = $pagedElements[$i];
            $id = $element->ele_id;
            $isSelected = $id == $selected;

            $nom = $element->ele_nom;
            $prenom = $element->ele_prenom;
            $classe = $element->cla_annee;

            if ($user["user_access"] > 0) {
                echo ("
                    <tr>
                        <td>
                            $nom
                        </td>
                        <td>
                            $prenom
                        </td>
                        <td>
                            $classe
                        </td>
                        <td class=\"highlightOnHover clickable\">
                            <span class=\"edit smaller-img-container inherit-display\" onclick=\"redirectTo('/edit_eleve?s=$id')\">
                                <img src=\"/Assets/images/pencil.png\" alt=\"edit\">
                            </span>
                        </td>
                        <td class=\"highlightOnHover clickable\">
                            <span class=\"delete smaller-img-container inherit-display\" onclick=\"redirectTo('/delete_eleve?s=$id')\">
                                <img src=\"/Assets/images/trash-can.png\" alt=\"delete\">
                            </span>
                        </td>
                     </tr>
            ");
            } else {
                echo ("
                    <tr>
                        <td>
                            $nom
                        </td>
                        <td>
                            $prenom
                        </td>
                        <td>
                            $classe
                        </td>
                     </tr>
            ");
            }
        }
        ?>

        <?php if ($user["user_access"] > 0) : ?>
            <tr class="new-element center-text BEEG_TEXT clickable" onclick="redirectTo('/new_eleve')">
                <td colspan="3">
                    +
                </td>
            </tr>
        <?php endif ?>
    </table>
</div>

<script src="/Assets/scripts/utils.js"></script>
<script src="/Assets/scripts/loggedIn.js"></script>