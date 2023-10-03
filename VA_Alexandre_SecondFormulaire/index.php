<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vandervoort Alexandre - PHP Second Formulaire</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body class="center-content">
    <div class="center-self center-text">
        <h1>Un super formulaire</h1>
    </div>
    <form action="" class="flex row center-content">
        <div class="flex column">
            <fieldset>
                <legend>Données personelles</legend>

                <div class="flex column">
                    <div>
                        <label for="prenom">Votre prénom</label>
                        <input type="text" name="prenom" id="prenom">
                    </div>
                    <div class="div-input">
                        <label for="nom">Votre nom</label>
                        <input type="text" name="nom" id="nom">
                    </div>
                    <div class="div-input">
                        <label for="nais">Votre date de naissance</label>
                        <input type="date" name="nais" id="nais">
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Bouton envoi</legend>
                <div class="flex column">
                    <div class="div-input">
                        <input type="submit" name="submit" value="Envoyer" class="fit-content">
                    </div>
                    <div class="div-input">
                        <label for="reset">Bouton de reset</label>
                        <input type="reset" value="Réinitialiser">
                    </div>
                </div>
            </fieldset>
        </div>

        <fieldset>
            <legend>Les nouveaux input</legend>
            <div class="flex column">
                <div class="div-input">
                    <label for="url">Votre URL</label>
                    <input type="url" name="url" id="url">
                </div>
                <div class="div-input">
                    <label for="tel">Votre numéro de téléphone</label>
                    <input type="tel" name="tel" id="tel">
                </div>
                <div class="div-input">
                    <label for="appreciation">Votre appréciation (entre 10 et 20)</label>
                    <input type="range" name="appreciation" id="appreciation" min="10" max="20" value="15">
                </div>
                <div class="div-input">
                    <label for="color">Votre couleur préférée</label>
                    <input type="color" name="color" id="color">
                </div>
                <div class="div-input">
                    <label for="recherche">Votre recherche</label>
                    <input type="search" name="recherche" id="recherche">
                </div>
                <div class="div-input">
                    <label for="fichier" class="fake-file">
                        Choisir un fichier
                    </label>
                    <input type="file" name="fichier" id="fichier">
                </div>
                <div class="div-input">
                    <label for="heure">Choisis une heure</label>
                    <input type="time" name="heure" id="heure">
                </div>
                <div class="div-input">
                    <label for="semaine">Choisis une semaine</label>
                    <input type="week" name="semaine" id="semaine">
                </div>
                <div class="div-input">
                    <label for="mois">Choisis un mois</label>
                    <input type="month" name="mois" id="mois">
                </div>
                <div class="div-input">
                    <label for="expl" class="text-top">Vos explications</label>
                    <textarea name="expl" id="expl" cols="30" rows="5"></textarea>
                </div>
            </div>
        </fieldset>
    </form>
</body>

</html>