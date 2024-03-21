<div class="nav flex row space-between">
    <div class="img-container center-self">
            <a href="/"><img src="Assets/images/book.png" alt="Naviguer vers l'Index"></a>
    </div>
    <div class="user">
        <?php if ($loggedIn) : ?>
            <div class="flex row">
            <div class="user padded-small   ">
                    <p><?= $user['user_name'] ?></p>
                </div>
                <div class="img-container center-self">
                    <a href="/profil"><img src="Assets/images/user.png" alt="Naviguer vers Profil"></a>
                </div>
            </div>
        <?php else : ?>
            <a href="/signin">
                <div class="flex row">
                    <div class="user padded-small">
                        <p>Login</p>
                    </div>
                    <div class="img-container center-self">
                        <img src="Assets/images/user.png" alt="user">
                    </div>
                </div>
            </a>
        <?php endif; ?> 
    </div>
</div>