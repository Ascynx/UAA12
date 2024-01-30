<?php
    require_once("Models/userModel.php");
?>

<link rel="stylesheet" href="Assets/css/profil.css">

<div class="flex column center-items center-content">
    <div class="flex column">
        <div class="flex row space-between interactible" id="username">
            <p>
                Nom d'utilisateur
            </p>
            <div class="flex row center-items center-content left">
                <p>
                     <?= $user["user_name"] ?>
                </p>
                 <div class="small-img-container flex center-content">
                    <img src="Assets/images/pencil.png" alt="Edit">
                </div>
            </div>
        </div>
        <div class="flex row space-between interactible"  id="useremail">
            <p>
                Email
            </p>
            <div class="flex row center-items center-content left">
                <p>
                    <?= $user["user_email"] ?>
                </p>
                <div class="small-img-container flex center-content">
                    <img src="Assets/images/pencil.png" alt="Edit">
                </div>
            </div>
        </div>
        <div class="flex row space-between interactible"  id="userpassword">
            <p>
                Password
            </p>
            <div class="flex row center-items center-content">
                <p>
                    <!-- genere un nombre random de points (en bold) et affiche les-->
                </p>
                <div class="small-img-container flex center-content">
                    <img src="Assets/images/pencil.png" alt="Edit">
                </div>
            </div>
        </div>
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
    </div>
</div>