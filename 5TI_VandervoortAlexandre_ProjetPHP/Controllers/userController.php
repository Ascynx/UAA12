<?php
if (isPage($uri, "/signin", false, $loggedIn)) {
    $main_style = "flex column center-content";
    $template = "Views/Users/signIn.php";
    $title = "Connection";

    $username = "";
    $pass = "";

    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        if (isset($_POST['pass'])) {
            $pass = $_POST['pass'];
        }
    }

    if ($username != "" && $pass != "") {
        //db stuff
        if (!login_user_and_load_into_session($username, $pass)) {
            $log_err = "Failed to login.";
        } else {
            //redirect
            header("Location:" . "/", TRUE, 303);
        }
    }

    $pageLoaded = true;
    require_once ("Views/base.php");
} else if (isPage($uri, "/signup", false, $loggedIn)) {
    $main_style = "flex column center-content";
    $template = "Views/Users/signUp.php";
    $title = "Inscription";

    $email = "";
    $username = "";
    $pass = "";

    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        }
        if (isset($_POST['pass'])) {
            $pass = $_POST['pass'];
        }
    }

    if ($email != "" && $username != "" && $pass != "") {
        //db stuff
        if (!create_and_load_user_into_session($email, $username, $pass)) {
            $log_err = "Failed to create new user in database";
        } else {
            //redirect
            header("Location:" . "/", TRUE, 303);
        }
    }

    $pageLoaded = true;
    require_once ("Views/base.php");
} else if (isPage($uri, "/profil", true, $loggedIn)) {
    $main_style = "flex column center-content";
    $template = "Views/Users/profil.php";
    $title = "Profil";

    $pageLoaded = true;
    if (isset($components['editUser'])) {
        $editUser = get_object_vars(loadUser($components['editUser']));
    } else {
        $editUser = $user;
    }

    $canEdit = false;
    if ($user["user_access"] >= 2 || $user["user_id"] == $editUser["user_id"]) {
        $canEdit = true;
    }

    if (!$canEdit) {
        //on force l'utilisation de l'utilisateur actuel car l'utilisateur n'as pas les permissions pour changer un autre utilisateur.
        $editUser = $user;
    }

    if (isset($components['edit'])) {
        $edit = $components['edit'];
    } else {
        $edit = "";

        if (isset($_POST)) {
            if ($canEdit) {
                //update user_access
                if (isset($_POST['suseraccess']) && $user["user_access"] >= 2) {
                    $user_access = $_POST['suseraccess'];
                    if ($user_access !== '') {
                        setAccess($editUser['user_id'], $user_access);

                        header("Location:" . "/profil?editUser=" . $editUser['user_id'], TRUE, 303);
                    }
                }

                //update name
                if (isset($_POST['name'])) {
                    $name = $_POST['name'];
                    if ($name !== '') {
                        setUsername($editUser['user_id'], $name);

                        header("Location:" . "/profil?editUser=" . $editUser['user_id'], TRUE, 303);
                    }
                }
                //update email
                if (isset($_POST['email'])) {
                    $email = $_POST['email'];
                    if ($email !== '') {
                        setEmail($editUser['user_id'], $email);

                        header("Location:" . "/profil?editUser=" . $editUser['user_id'], TRUE, 303);
                    }
                }
                //update password
                if (isset($_POST['password'])) {
                    $pass = $_POST['password'];
                    if ($pass !== '') {
                        $hash = setPassword($editUser['user_id'], $pass);

                        $_SESSION['userHash'] = $hash;
                        header("Location:" . "/profil?editUser=" . $editUser['user_id'], TRUE, 303);
                    }
                }
            }
        }
    }

    require_once ("Views/base.php");
} else if (isPage($uri, "/profil", false, $loggedIn)) {

    $pageLoaded = true;
    require_once ("Views/Errors/403.php");
} else if (isPage($uri, "/del", true, $loggedIn)) {
    if (isset($_POST["pass"])) {
        $pass = $_POST["pass"];
        delete_and_unload_user($user, $pass);
    }
    header("Location:" . "/", TRUE, 303);
} else if (isPage($uri, "/deladmin", true, $loggedIn) && $user["user_access"] >= 2) {
    try {
        if (isset($components["userId"]) && filter_var($components["userId"], FILTER_VALIDATE_INT)) {
            admin_delete_user($components["userId"], $user);
        }
    } catch (_ignored) {}
    header("Location:" . "/userindex", TRUE, 303);
} else if (isPage($uri, "userindex", true, $loggedIn) && $user["user_access"] >= 2) {
    $main_style = "flex column center-content gray-bg ";
    $template = "Views/Users/userIndex.php";
    $title = "Table des utilisateurs";

    $page = 0;
    if (isset($components["page"]) && filter_var($components["page"], FILTER_VALIDATE_INT)) {
        $page = (int)$components["page"];
    }

    $pageLoaded = true;
    require_once("Views/base.php");
}