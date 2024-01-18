<?php
    require_once("Models/sqlFuncModel.php");

    enum Access: int {
        case Visiteur = 0;
        case Manager = 1;
        case Administrateur = 2;
    }

    function create_new_user(string $email, string $username, string $password): bool {
        $salt = generate_salt();
        $hash = hash_pass($password, $salt);
        $access = 0;

        return createNewUser($username, $email, $hash, $salt, $access);
    }

    function hash_pass(string $user_pass, string $user_salt): string {
        return hash('sha256', $user_pass . $user_salt);
    }

    function generate_salt(): string {
        $size = 30;
        $salt = "";
        
        for ($i = 0; $i < $size; $i++) {
            $charcode = rand(0, 52);
            if ($charcode < 26) {
                //maj
                $salt = $salt . chr($charcode + 65);
            } elseif ($charcode < 52) {
                //min
                $charcode = $charcode - 26;
                $salt = $salt . chr($charcode + 97);
                
            }
        }

        return $salt;
    }
 
    function logged_in(): bool {
        if (!isset($_SESSION['userId']) || !isset($_SESSION['userHash'])) {
            return false;
        }

        $userId = $_SESSION['userId'];
        $userHash = $_SESSION['userHash'];
        if (!isset($userHash) || !isset($userId)) {
            return false;
        }

        if ($userId === "test") {
            return true;
        }

        return isUserLoggedIn($userId, $userHash);
    }

    function load_user(): bool | array {
        if (!isset($_SESSION['userId']) || !isset($_SESSION['userHash'])) {
            return false;
        }

        $userId = $_SESSION['userId'];
        $userHash = $_SESSION['userHash'];
        if (!isset($userHash) || !isset($userId)) {
            return false;
        }

        if ($userId === "test") {
            return createTestUser();
        }

        return loadUser($userId); 
    }

    function isUserLoggedIn($userId, $userHash): bool {
        $remote_hash = getUserHash($userId);
        if ($remote_hash != $userHash) {
            return false;
        }
        return true;
    }

    function createNewUser(string $username, string $email, string $hash, string $salt, int $access): bool {
        $pdo = get_pdo();
        $query = sprintf("INSERT INTO utilisateurs (user_name, user_email, user_salted_hash, user_salt, user_access) VALUES ('%s', '%s', '%s', '%s', '%d');", $username, $email, $hash, $salt, $access);
        $results = run_query($pdo, $query);
        if (sizeof($results) == 0) {
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

    function getUserEmail($userId): string {
        $pdo = get_pdo();
        $query = create_user_query("user_email", $userId);
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
        return Access::tryFrom($intAccess);
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

    function loadUser($userId): object {
        $pdo = get_pdo();
        $query = createAllDataUserQuery($userId);
        $results = run_query($pdo, $query);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0];
    }

    function createTestUser(): array {
        $u = array('userId' => "test", "user_name" => "Ascynx", "user_salt" => "unset", "user_salted_hash" => "unset", "user_access" => 0);
        return $u;
    }

    function createAllDataUserQuery($userId): string {
        return create_user_query("*", $userId);
    }

    function create_user_query($column, $userId): string {
        return sprintf("SELECT %s FROM utilisateurs WHERE userId = %s", $column, $userId);
    }