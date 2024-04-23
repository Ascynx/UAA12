<link rel="stylesheet" href="Assets/css/newEntries.css">
<div class="flex column center-items center-content">
    <div class="flex column center-items">
        <form action="/edit_eleve?s=<?=$id?>" method="post" class="flex column center-items center-content">
        <div>
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="<?=$ele_nom?>">
        </div>

        <div>
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" value="<?=$ele_prenom?>">
        </div>

        <div>
            <label for="classe">Classe</label>
            <input type="text" name="classe" id="classe" value="<?=$ele_cla_name?>">
        </div>

        <input type="submit" value="envoyer">
        </form>
    </div>
</div>