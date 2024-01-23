<?php
    require_once("Models/sqlFuncModel.php");

    enum Access: int {
        case Visiteur = 0;
        case Manager = 1;
        case Administrateur = 2;
    }

    function login_user_and_load_into_session(string $emailName, string $pass): bool {
        if (filter_var($emailName, FILTER_VALIDATE_EMAIL)) {
            //its an email!
            $query = create_get_id_using_email_query($emailName);
        } else {
            //its a name!
            $query = create_get_id_using_name_query($emailName);
        }

        $results = run_query(get_pdo(), $query);
        if (sizeof($results) == 0) {
            return false;
        }
        $userId = $results[0]->user_id;
        $user = loadUser($userId);
        $salt = $user->user_salt;

        $hash = hash_pass($pass, $salt);
        if ($hash==$user->user_salted_hash) {
            $_SESSION['userId'] = $userId;
            $_SESSION['userHash'] = $hash;
            return true;
        }
        return false;
    }

    function create_and_load_user_into_session(string $email, string $username, string $password): bool {
        $salt = generate_salt();
        $hash = hash_pass($password, $salt);
        $access = 0;

        $created = createNewUser($username, $email, $hash, $salt, $access);
        if (!$created) {
            return false;
        }

        $userId = getUserId($username);
        $userHash = getUserHash($userId);

        $_SESSION['userId'] = $userId;
        $_SESSION['userHash'] = $userHash;
        return true;
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

        return get_object_vars(loadUser($userId)); 
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
        run_query($pdo, $query);
        return true;
    }

    function getUserSalt($userId): string | null {
        $pdo = get_pdo();
        $query = create_user_query("user_salt", $userId);
        $results = run_query($pdo, $query);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0];
    }

    function getUserHash($userId): string | null {
        $pdo = get_pdo();
        $query = create_user_query("user_salted_hash", $userId);
        $results = run_query($pdo, $query);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0]->user_salted_hash;
    }

    function getUserName($userId): string | null {
        $pdo = get_pdo();
        $query = create_user_query("user_name", $userId);
        $results = run_query($pdo, $query);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0]->user_name;
    }

    function getUserId(string $username): string | null {
        $pdo = get_pdo();
        $query = create_get_id_using_name_query($username);
        $results = run_query($pdo, $query);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0]->user_id;
    }

    function getUserEmail($userId): string | null {
        $pdo = get_pdo();
        $query = create_user_query("user_email", $userId);
        $results = run_query($pdo, $query);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0]->user_email;
    }

    function getStringUserAccess($userId): Access {
        $intAccess = getUserAccess($userId);
        if ($intAccess == null) {
            return null;
        }
        return Access::tryFrom($intAccess);
    }

    function getUserAccess($userId): int | null {
        $pdo = get_pdo();
        $query = create_user_query("user_access", $userId);
        $results = run_query($pdo, $query);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0]->user_access;
    }

    function loadUser($userId): stdClass {
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
        return sprintf("SELECT %s FROM utilisateurs WHERE user_id = %s", $column, $userId);
    }

    function create_get_id_using_name_query(string $name): string {
        return sprintf("SELECT user_id FROM utilisateurs WHERE user_name='%s'", $name);
    }

    function create_get_id_using_email_query(string $email): string {
        return sprintf("SELECT user_id FROM utilisateurs WHERE user_email='%s'", $email);
    }