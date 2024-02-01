<?php
require_once("Models/userModel.php");
?>

<link rel="stylesheet" href="Assets/css/profil.css">

<form action = "/profil" method="POST" class="flex column center-items center-content">
    <div>
        <a <?= $edit !== 'username' ? "href=\"/profil?edit=username\"" : "" ?> class="flex row space-between interactible" id="username">
            <p>
                Nom d'utilisateur
            </p>
            <div class="flex row center-items center-content left">
                <?php if ($edit !== 'username') : ?>
                    <p>
                        <?= $user["user_name"] ?>
                    </p>
                    <div class="small-img-container flex center-content">
                        <img src="Assets/images/pencil.png" alt="Edit">
                    </div>
                <?php else : ?>
                    <form action="/profil" method="post">
                        <input type="text" name="name" id="name" placeholder="<?= $user["user_name"] ?>">
                            <div class="small-img-container flex center-content">
                                <img src="Assets/images/pencil.png" alt="Edit">
                            </div>
                    </form>
                <?php endif ?>
            </div>
        </a>

        <a <?= $edit !== 'useremail' ? "href=\"/profil?edit=useremail\"" : "" ?> class="flex row space-between interactible" id="useremail">
            <p>
                Email
            </p>
            <div class="flex row center-items center-content left">
                <?php if ($edit !== 'useremail') : ?>
                    <p>
                        <?= $user["user_email"] ?>
                    </p>
                    <div class="small-img-container flex center-content">
                        <img src="Assets/images/pencil.png" alt="Edit">
                    </div>
                <?php else : ?>
                    <input type="email" name="email" id="email" placeholder="<?= $user["user_email"] ?>">
                    <div class="small-img-container flex center-content">
                        <img src="Assets/images/pencil.png" alt="Edit">
                    </div>
                <?php endif ?>
            </div>
        </a>
        <a <?= $edit !== 'password' ? "href=\"/profil?edit=password\"" : "" ?> class="flex row space-between interactible" id="userpassword">
            <p>
                Password
            </p>
            <div class="flex row center-items center-content">
                <?php if ($edit !== 'password') : ?>
                    <p style="font-weight:bolder; font-size:larger;color:red;">
                        ***************
                        <!-- genere un nombre random de points (en bold) et affiche les-->
                    </p>
                    <div class="small-img-container flex center-content">
                        <img src="Assets/images/pencil.png" alt="Edit">
                    </div>
                <?php else : ?>
                    <input type="password" name="password" id="password" placeholder="***************" style="font-weight:bolder; font-size:larger;">
                    <div class="small-img-container flex center-content">
                        <img src="Assets/images/pencil.png" alt="Edit">
                    </div>
                <?php endif ?>

            </div>
        </a>
        <div class="flex row space-between interactible-disabled">
            <p>
                Niveau d'accès
            </p>
            <div class="flex row center-items center-content">
                <p>
                    <?= getStringAccessFrom($user["user_access"])->name ?>
                </p>
            </div>
        </div>
        <div class="flex row space-between">
            <input type="submit" value="Mettre à jour" class="center-self center-content center-items" <?= $edit === "" ? "disabled=\"disabled\"" : "" ?>>
            <a href="/disconnect"><button>Déconnexion</button></a>
        </div>
        
    </div>
</div>