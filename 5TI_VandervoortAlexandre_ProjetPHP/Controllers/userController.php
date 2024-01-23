<?php
    require_once("Models/userModel.php");
    require_once("Models/pageSortingModel.php");

    $uri = $_SERVER["REQUEST_URI"];
    $loggedIn = logged_in();
    if ($loggedIn) {
        $user = load_user();
    }

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

        require_once("Views/base.php");
    }