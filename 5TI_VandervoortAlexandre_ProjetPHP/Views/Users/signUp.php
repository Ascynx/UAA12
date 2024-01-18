<link rel="stylesheet" href="Assets/css/login.css">

<div class="flex column center-items center-content">
    <div class="flex column center-items login-sheet">
        <div class="user-image">
            <img src="Assets/images/user.png" alt="user" width="128" height="128">
            <div class="switch center-text">
                <a href="signin">Connecte-toi</a>
            </div>
        </div>
        <div>
            <form action="signup" method="post" class="flex column">
                <div class="flex row form-element">
                    <div class="img-container flex center-content">
                        <img src="Assets/images/email.png" alt="email" class="center-self">
                    </div>
                    <!--Email-->
                    <input type="email" name="email" id="email" placeholder="Adresse email" value="<?=$email?>" required>
                </div>
                <div class="flex row form-element">
                    <div class="img-container flex center-content">
                        <img src="Assets/images/user.png" alt="username" class="center-self">
                    </div>
                    <!--Nom d'utilisateur-->
                    <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" value="<?=$username?>" required>
                </div>
                <div class="flex row form-element">
                    <div class="img-container flex center-content">
                        <img src="Assets/images/lock.png" alt="lock" class="center-self">
                    </div>
                    <!--Mot de passe-->
                    <input type="password" name="pass" id="pass" placeholder="mot de passe" value="<?=$pass?>" required>
                </div>

                <?php if (isset($log_err)): ?>
                    <p class="error"><?=$log_err?></p>
                <?php endif ?>

                <div class="flex center-content form-element">
                    <!--Login/Signup-->
                    <input type="submit" value="S'inscrire">
                </div>

            </form>
        </div>
    </div>
</div>