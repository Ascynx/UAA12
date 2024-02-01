<?php
    function isPage(string $uri, string $wanted_page, bool $needs_login, bool $loggedIn): bool {
        if ($needs_login && !$loggedIn) {
            return false;
        }

        $uri_components = parse_url($uri);
        $path = $uri_components['path'];
    
        if (str_ends_with($path, $wanted_page)) {
            return true;
        }
        return false;
    }

    function get_query_components(string $uri): array {
        $uri_components = parse_url($uri);
        if (!isset($uri_components['query'])) {
            return [];
        }
        parse_str($uri_components['query'], $components);
        return $components;
    }