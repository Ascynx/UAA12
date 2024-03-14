<?php
    require_once('Models/sqlFuncModel.php');

    enum Access: int {
        case Visiteur = 0;
        case Manager = 1;
        case Administrateur = 2;
    }

    function login_user_and_load_into_session(string $emailName, string $pass): bool {
        if (filter_var($emailName, FILTER_VALIDATE_EMAIL)) {
            //its an email!
            $query = create_get_id_using_email_query();
            $results = run_advanced_query(get_pdo(), $query, ['email' => $emailName]);
        } else {
            //its a name!
            $query = create_get_id_using_name_query();
            $results = run_advanced_query(get_pdo(), $query, ['name' => $emailName]);
        }
        
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

    function delete_and_unload_user(stdClass $user, string $password) {
        $id = $user->id;
        $salt = $user->user_salt;
        if (hash_pass($password, $salt) == $user->user_salted_hash) {
            //can delete as password is correct
        }
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
        $salt = '';
        
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

        if ($userId === 'test') {
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

        if ($userId === 'test') {
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
        $query = "INSERT INTO utilisateurs (user_name, user_email, user_salted_hash, user_salt, user_access) VALUES (:name, :email, :salted_hash, :salt, :access);";
        run_advanced_query($pdo, $query, [
            'name'=>$username,
            'email'=>$email,
            'salted_hash'=>$hash,
            'salt'=>$salt,
            'access'=>$access
        ]);
        return true;
    }

    function getUserSalt($userId): string | null {
        $pdo = get_pdo();
        $query = create_user_query('user_salt');
        $results = run_advanced_query($pdo, $query, [
            'id'=>$userId
        ]);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0];
    }


    function getUserHash($userId): string | null {
        $pdo = get_pdo();
        $query = create_user_query('user_salted_hash');
        $results = run_advanced_query($pdo, $query, [
            'id'=>$userId
        ]);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0]->user_salted_hash;
    }

    function getUserName($userId): string | null {
        $pdo = get_pdo();
        $query = create_user_query('user_name');
        $results = run_advanced_query($pdo, $query, [
            'id'=>$userId
        ]);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0]->user_name;
    }

    function setUsername($userId, $newUsername) {
        $pdo = get_pdo();
        $query = create_user_update_query('user_name');
        run_advanced_query($pdo, $query, [
            'val'=>$newUsername,
            'id'=>$userId
        ]);
    }

    function setEmail($userId, $newEmail) {
        $pdo = get_pdo();
        $query = create_user_update_query('user_email');
        run_advanced_query($pdo, $query, [
            'val'=>$newEmail,
            'id'=>$userId
        ]);
    }

    function setPassword($userId, $newPassword): string {
        $salt = generate_salt();
        $hash = hash_pass($newPassword, $salt);
        $pdo = get_pdo();
        $hash_query = create_user_update_query('user_salted_hash');
        $salt_query = create_user_update_query('user_salt');
        run_advanced_query($pdo, $hash_query, [
            'val'=>$hash,
            'id'=>$userId
        ]);
        run_advanced_query($pdo, $salt_query, [
            'val'=>$salt,
            'id'=>$userId
        ]);
        return $hash;
    }

    function getUserId(string $username): string | null {
        $pdo = get_pdo();
        $query = create_get_id_using_name_query();
        $results = run_advanced_query($pdo, $query, [
            'name'=>$username
        ]);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0]->user_id;
    }

    function getUserEmail($userId): string | null {
        $pdo = get_pdo();
        $query = create_user_query('user_email');
        $results = run_advanced_query($pdo, $query, [
            'id'=>$userId
        ]);
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
        $query = create_user_query('user_access');
        $results = run_advanced_query($pdo, $query, [
            'id'=>$userId
        ]);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0]->user_access;
    }

    function getStringAccessFrom(int $userAccessInt): Access {
        return Access::tryFrom($userAccessInt);
    }

    function loadUser($userId): stdClass {
        $pdo = get_pdo();
        $query = create_all_user_query();
        $results = run_advanced_query($pdo, $query, [
            'id'=>$userId
        ]);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0];
    }

    function createTestUser(): array {
        $u = array('userId' => 'test', 'user_name' => 'Ascynx', 'user_salt' => 'unset', 'user_salted_hash' => 'unset', 'user_access' => 0);
        return $u;
    }

    function create_all_user_query(): string {
        return "SELECT * FROM utilisateurs WHERE user_id = :id";
    }

    function create_user_query($column): string {
        return "SELECT " . $column . " FROM utilisateurs WHERE user_id = :id";
    }

    function create_user_update_query(): string {
        return "UPDATE utilisateurs SET :col=:val WHERE user_id=:id";
    }

    function create_get_id_using_name_query(): string {
        return "SELECT user_id FROM utilisateurs WHERE user_name=:name";
    }

    function create_get_id_using_email_query(): string {
        return "SELECT user_id FROM utilisateurs WHERE user_email=:email";
    }