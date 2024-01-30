<?php
if (!$pageLoaded) {
        $template = "Views/Errors/404.php";
        $title = "Uh oh";
        
        $pageLoaded = true;
        require_once($template);
    }