<link rel="stylesheet" href="Assets/css/newEntries.css">
<div class="flex column center-items center-content">
    <div class="flex column center-items">
        <form action="/new_eleve" method="post" class="flex column center-items center-content">
        <div>
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom">
        </div>

        <div>
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom">
        </div>

        <div>
            <label for="classe">Classe</label>
            <input type="text" name="classe" id="classe">
        </div>

        <input type="submit" value="envoyer">
        </form>
    </div>
</div>