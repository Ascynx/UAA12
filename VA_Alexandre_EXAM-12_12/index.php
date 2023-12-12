<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen UAA12 - Vandervoort</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <header class="flex column">
        <div class="flex row nav">
            <!-- Navigation -->
            <a href="index.php"><button>Home</button></a>
            <a href="formulaireMath.php"><button>Tester l'application</button></a>
            <a href=""><button>Contact</button></a>
        </div>
        <div>
            <!-- Titre de page -->
            <h1>Commandez notre application AstyCalc</h1>
        </div>
    </header>
    <main class="flex column">
        <div class="flex row center-content center-self main">
            <div class="flew column images">
                <!-- Images -->
                <p>Galerie<br>images</p>
                <div class="flex column">
                    <div class="flex row">
                        <img src="images/calc.png" alt="calc">
                        <img src="images/calc.png" alt="calc">
                    </div>
                    <div>
                        <img src="images/calc.png" alt="calc">
                        <img src="images/calc.png" alt="calc">
                    </div>
                </div>
                <div class="flex column">
                    <div class="flex row">
                        <img src="images/ops.png" alt="ops">
                        <img src="images/ops.png" alt="ops">
                    </div>
                    <div>
                        <img src="images/ops.png" alt="ops">
                        <img src="images/ops.png" alt="ops">
                    </div>
                </div>
                <div class="flex column">
                    <div class="flex row">
                        <img src="images/pi.png" alt="pi">
                        <img src="images/pi.png" alt="pi">
                    </div>
                    <div>
                        <img src="images/pi.png" alt="pi">
                        <img src="images/pi.png" alt="pi">
                    </div>
                </div>
                <div class="flex column">
                    <div class="flex row">
                        <img src="images/log.png" alt="log">
                        <img src="images/log.png" alt="log">
                    </div>
                    <div>
                        <img src="images/log.png" alt="log">
                        <img src="images/log.png" alt="log">
                    </div>
                </div>
            </div>
            <div class="flex column center-content form-div">
                <form action="" class="flex column center-content">
                    <div class="flex row center-content space-evenly">
                        <fieldset class="flex column">
                            <legend class="form-stuff">Vos informations</legend>

                            <label for="nom">Votre nom</label>
                            <input type="text" name="nom" id="nom" placeholder="Nom">

                            <label for="prenom">Votre prénom</label>
                            <input type="text" name="prenom" id="prenom" placeholder="Prénom">

                            <label for="email">Votre mail</label>
                            <input type="text" name="mail" id="mail" placeholder="Email">
                        </fieldset>
                        <fieldset class="flex column">
                            <legend class="form-stuff">Paramétrez votre commande</legend>

                            <label for="appareil">Choisissez parmi les possibilités</label>
                            <select name="appareil" id="appareil">
                                <optgroup label="Ordinateur">
                                    <option value="pc">Pc</option>
                                    <option value="mac">Mac</option>
                                </optgroup>
                                <optgroup label="Tablette">
                                    <option value="android">Androïd</option>
                                    <option value="apple">Apple</option>
                                </optgroup>
                            </select>

                            <label for="abonnement">Date de début d'abonnement</label>
                            <input type="date" name="abonnement" id="abonnement">

                            <label for="facture">Facture</label>
                            <div>
                                <input type="radio" name="facture" id="facture1" value="1" checked>
                                <label for="facture1" class="label_nostyle">Par mail</label>
                            </div>
                            <div>
                                <input type="radio" name="facture" id="facture2" value="2">
                                <label for="facture2" class="label_nostyle">Par papier</label>
                            </div>
                        </fieldset>
                    </div>

                    <input type="submit" value="Envoyez" name="envoyez" class="form-stuff center-self button">
                </form>
            </div>
            <div class="flew column images">
                <!-- Images -->
                <p>Galerie<br>images</p>
                <div class="flex column">
                    <div class="flex row">
                        <img src="images/calc.png" alt="calc">
                        <img src="images/calc.png" alt="calc">
                    </div>
                    <div>
                        <img src="images/calc.png" alt="calc">
                        <img src="images/calc.png" alt="calc">
                    </div>
                </div>
                <div class="flex column">
                    <div class="flex row">
                        <img src="images/ops.png" alt="ops">
                        <img src="images/ops.png" alt="ops">
                    </div>
                    <div>
                        <img src="images/ops.png" alt="ops">
                        <img src="images/ops.png" alt="ops">
                    </div>
                </div>
                <div class="flex column">
                    <div class="flex row">
                        <img src="images/pi.png" alt="pi">
                        <img src="images/pi.png" alt="pi">
                    </div>
                    <div>
                        <img src="images/pi.png" alt="pi">
                        <img src="images/pi.png" alt="pi">
                    </div>
                </div>
                <div class="flex column">
                    <div class="flex row">
                        <img src="images/log.png" alt="log">
                        <img src="images/log.png" alt="log">
                    </div>
                    <div>
                        <img src="images/log.png" alt="log">
                        <img src="images/log.png" alt="log">
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="flex row foot space-between">
        <!-- Foot -->
        <button>Examen décembre 2023 UAA12</button>
        <button>5TTI</button>
    </footer>
</body>

</html>