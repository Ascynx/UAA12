<?php
$actualPage = $page + 1;
$min = $page * 10;
$max = $min + 10;
?>

<link rel="stylesheet" href="Assets/css/loggedIn.css">

<div class="table flex column scroll-overflow">
    <table class="flex center-self">
        <tr class="table-header">
            <th>
                Année scolaire
            </th>
            <th>
                Classe nom
            </th>
        </tr>
        <?php
        $pagedElements = getAllClassesFromTo($min, $max);
        for ($i = 0; $i < sizeof($pagedElements); $i++) {
            $element = $pagedElements[$i];
            $id = $element->cla_id;
            $isSelected = $id == $selected;

            $annee_scolaire = $element->cla_annee_scolaire;
            $classe_nom = $element->cla_annee;


            echo ("
                    <tr>
                        <td>
                            $annee_scolaire
                        </td>
                        <td>
                            $classe_nom
                        </td>
                        <td class=\"highlightOnHover clickable\">
                            <span class=\"edit smaller-img-container inherit-display\" onclick=\"redirectTo('/edit_classe?s=$id')\">
                                <img src=\"/Assets/images/pencil.png\" alt=\"edit\">
                            </span>
                        </td>
                        <td class=\"highlightOnHover clickable\">
                            <span class=\"delete smaller-img-container inherit-display\" onclick=\"redirectTo('/delete_classe?s=$id')\">
                                <img src=\"/Assets/images/trash-can.png\" alt=\"delete\">
                            </span>
                        </td>
                     </tr>
            ");
        }
        ?>

        <?php if ($user["user_access"] > 0) : ?>
            <tr class="new-element center-text BEEG_TEXT clickable" onclick="redirectTo('/new_classe')">
                <td colspan="3">
                    +
                </td>
            </tr>
        <?php endif ?>
    </table>
</div>

<script src="/Assets/scripts/utils.js"></script>
<script src="/Assets/scripts/loggedIn.js"></script>