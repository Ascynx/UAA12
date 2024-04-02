<?php
    $etu = getEtudeFromId($components["etude"]);

    $type = $etu->etu_cla_id == null ? "eleve" : "classe";
    $raison = $etu->raison;

    

?>

<link rel="stylesheet" href="Assets/css/newEntries.css">

<div class="flex column center-items center-content">
    <div class="flex column center-items">
        <form action="/editEtude?etude=<?=$components["etude"]?>" method="post" class="flex column center-items center-content">
            <div class="flex row">
                <label for="raison">Raison donnée</label>
                <textarea name="raison" id="raison" cols="30" rows="2" required></textarea>
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
                    <input type="text" name="class-name" id="class-name" class="classe" required>
                </div>
                <div class="eleve-toggle">
                    <div>
                        <label for="eleve-name">Nom de l'élève</label>
                        <input type="text" name="eleve-name" id="eleve-name" class="eleve">
                    </div>
                    <div>
                        <label for="eleve-firstname">Prénom de l'élève</label>
                        <input type="text" name="eleve-firstname" id="eleve-firstname" class="eleve">
                    </div>
                </div>
            </div>

            <div>
                <input type="submit" value="envoyer">
            </div>
        </form>
    </div>
</div>

<script src="Assets/scripts/utils.js">
    if (<?=$type?> !== "classe") {
        toggleTypeForm(1);
    }
</script>