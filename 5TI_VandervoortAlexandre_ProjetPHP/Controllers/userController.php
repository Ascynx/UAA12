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
           if (!create_new_user($email, $username, $pass)) {
            $log_err = "Failed to create new user in database";
           } else {
            //set new session items
            

            //redirect
            header("Location:" . $_SERVER['HTTP_HOST'] . "/index.php", true, 303);
           }
        }

        require_once("Views/base.php");
    }