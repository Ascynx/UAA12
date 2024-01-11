<?php
    enum Access: int {
        case Visiteur = 0;
        case Manager = 1;
        case Administrateur = 2;
    }

    function isUserLoggedIn($userId, $userHash): bool {
        $remote_hash = getUserHash($userId);
        if ($remote_hash != $userHash) {
            return false;
        }
        return true;
    }

    function getUserSalt($userId): string {
        $pdo = get_pdo();
        $query = create_user_query("user_salt", $userId);
        $results = run_query($pdo, $query);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0];
    }

    function getUserHash($userId): string {
        $pdo = get_pdo();
        $query = create_user_query("user_salted_hash", $userId);
        $results = run_query($pdo, $query);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0];
    }

    function getUserName($userId): string {
        $pdo = get_pdo();
        $query = create_user_query("user_name", $userId);
        $results = run_query($pdo, $query);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0];
    }

    function getStringUserAccess($userId): Access {
        $intAccess = getUserAccess($userId);
        if ($intAccess == null) {
            return null;
        }
        return Access::from($intAccess);
    }

    function getUserAccess($userId): int {
        $pdo = get_pdo();
        $query = create_user_query("user_access", $userId);
        $results = run_query($pdo, $query);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0];
    }

    function create_user_query($column, $userId): string {
        return sprintf("SELECT %s FROM Utilisateurs WHERE userId = %s", $column, $userId);
    }