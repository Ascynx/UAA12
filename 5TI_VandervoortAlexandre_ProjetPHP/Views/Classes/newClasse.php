<link rel="stylesheet" href="Assets/css/newEntries.css">
<div class="flex column center-items center-content">
    <div class="flex column center-items">
        <form action="/new_classe" method="post" class="flex column center-items center-content">
        <div>
            <label for="annee_scolaire">Année scolaire (format: 2023-2024)</label>
            <input type="text" name="annee_scolaire" id="annee_scolaire">
        </div>

        <div>
            <label for="annee">Nom classe</label>
            <input type="text" name="annee" id="annee">
        </div>

        <input type="submit" value="envoyer">
        </form>
    </div>
</div>
