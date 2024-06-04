<div class="nav flex row space-between">
    <div class="flex row space-between center-items pad-small">
        <div class="img-container center-self">
                <a href="/"><img src="Assets/images/book.png" alt="Naviguer vers l'Index"></a>
        </div>
        <?php if ($loggedIn): ?>
        <div class="flex row space-between pad-small">
            <div class="pad-small">
                <a href="/eleves"><span>Eleves</span></a>
            </div>
            <div class="pad-small">
                <a href="/classes"><span>Classes</span></a>
            </div>
        </div>
        <?php endif; ?>
        <?php if ($loggedIn && $user["user_access"] >= 2): ?>
             <div class="pad-small">
                <a href="/userindex"><span>Utilisateurs</span></a>
             </div>   
        <?php endif; ?> 
    </div>
    
    <div class="user pad-small">
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