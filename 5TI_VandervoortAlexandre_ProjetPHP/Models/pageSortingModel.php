<?php
    function isPage(string $uri, string $wanted_page, bool $needs_login, bool $loggedIn): bool {
        if ($needs_login && !$loggedIn) {
            return false;
        }
    
        if (str_ends_with($uri, $wanted_page)) {
            return true;
        }
        return false;
    }