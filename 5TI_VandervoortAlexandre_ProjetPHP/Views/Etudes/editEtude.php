<?php
    $etu = getEtudeFromId($id);

    $type = $etu->etu_cla_id == null ? "eleve" : "classe";
    $raison = $etu->etu_raison;

    $classe_name = "";
    $eleve_firstname = "";
    $eleve_name = "";

    if ($type == "eleve") {
        $eleve_id = $etu->etu_ele_id;
        $ele = getEleveFromid($eleve_id);

        $eleve_name = $ele->ele_nom;
        $eleve_firstname = $ele->ele_prenom;
    } else if ($type == "classe") {
        $classe_id = $etu->etu_cla_id;
        $cla = getClasseFromId($classe_id);
    
        $classe_name = $cla->cla_annee;
    }
?>

<link rel="stylesheet" href="Assets/css/newEntries.css">

<div class="flex column center-items center-content">
    <div class="flex column center-items">
        <form action="/edit_etude?s=<?=$id?>" method="post" class="flex column center-items center-content">
            <div class="flex row">
                <label for="raison">Raison donnée</label>
                <textarea name="raison" id="raison" cols="30" rows="2" required><?=$raison?></textarea>
            </div>
            <div>
                <label for="type">Quel est le type de participants?</label>
                <div>
                    <input type="radio" name="type" id="classe" value="classe" onclick="toggleTypeForm(0)" <?=$type == "classe" ? "checked" : ""?>>
                    <span>classe</span>
                </div>
                <div>
                    <input type="radio" name="type" id="eleves" value="eleve" onclick="toggleTypeForm(1)" <?=$type == "eleve" ? "checked" : ""?>>
                    <span>eleve</span>
                </div>
            </div>

            <div>
                <div class="class-toggle">
                    <label for="class-name">Classe</label>
                    <input type="text" name="class-name" id="class-name" class="classe" value=<?=$classe_name?> required>
                </div>
                <div class="eleve-toggle">
                    <div>
                        <label for="eleve-name">Nom de l'élève</label>
                        <input type="text" name="eleve-name" id="eleve-name" class="eleve" value=<?=$eleve_name?>>
                    </div>
                    <div>
                        <label for="eleve-firstname">Prénom de l'élève</label>
                        <input type="text" name="eleve-firstname" id="eleve-firstname" class="eleve" value=<?=$eleve_firstname?>>
                    </div>
                </div>
            </div>

            <div>
                <input type="submit" value="envoyer">
            </div>
        </form>
    </div>
</div>

<script src="Assets/scripts/utils.js"></script>
<script>
    if ("<?=$type?>" !== "classe") {
        toggleTypeForm(1);
    }
</script>