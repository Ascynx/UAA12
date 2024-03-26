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
        require_once("Views/base.php");
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
        require_once("Views/base.php");
    } else if (isPage($uri, "/profil", true, $loggedIn)) {
        $main_style = "flex column center-content";
        $template = "Views/Users/profil.php";
        $title = "Profil";

        $pageLoaded = true;
        if (isset($components['edit'])) {
            $edit = $components['edit'];
        } else {
            $edit = "";

            if (isset($_POST)) {
                //update name
                if (isset($_POST['name'])) {
                    $name = $_POST['name'];
                    if ($name !== '') {
                        setUsername($user['user_id'], $name);

                        header("Location:" . "/profil", TRUE, 303);
                    }
                }
                //update email
                if (isset($_POST['email'])) {
                    $email = $_POST['email'];
                    if ($email !== '') {
                        setEmail($user['user_id'], $email);

                        header("Location:" . "/profil", TRUE, 303);
                    }
                }
                //update password
                if (isset($_POST['password'])) {
                    $pass = $_POST['password'];
                    if ($pass !== '') {
                        $hash = setPassword($user['user_id'], $pass);
                        
                        $_SESSION['userHash'] = $hash;
                        header("Location:" . "/profil", TRUE, 303);
                    }
                }
            }
        }

        require_once("Views/base.php");
    } else if (isPage($uri, "/profil", false, $loggedIn)) {

        $pageLoaded = true;
        require_once("Views/Errors/403.php");
    } else if (isPage($uri, "/del", true, $loggedIn)) {
        if (isset($_POST["pass"])) {
            $pass = $_POST["pass"];
            delete_and_unload_user($user, $pass);
        }
        header("Location:" . "/", TRUE, 303);
    }