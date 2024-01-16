<?php
    function isPage(string $wanted_page, bool $needs_login, bool $loggedIn): bool {
        $uri = $_SERVER['REQUEST_URI'];
        if ($needs_login && !$loggedIn) {
            return false;
        }
    
        if (str_ends_with($uri, $wanted_page)) {
            return true;
        }
        return false;
    }