<div class="nav">
    <div class="user">
        <?php if ($loggedIn) : ?>
            <div class="flex row">
                <div class="img-container center-self">
                    <a href="/profil"><img src="Assets/images/user.png" alt="user"></a>
                </div>
                <div class="user">
                    <p><?= $user['user_name'] ?></p>
                </div>
            </div>
        <?php else : ?>
            <a href="/signin">
                <div class="flex row">
                    <div class="img-container center-self">
                        <img src="Assets/images/user.png" alt="user">
                    </div>
                    <div class="user">
                        <p>Login</p>
                    </div>
                </div>
            </a>
        <?php endif; ?>
    </div>
</div>