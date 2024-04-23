<?php
    $sql_address = "10.10.51.98";
    $sql_username = "alexandre";
    $sql_password = "root";
    
    $db = "alexandre";
    $sql_conn = "mysql:host=" . $sql_address . ";dbname=" . $db . ";port=3306";

    try {
        $pdo = new PDO($sql_conn, $sql_username, $sql_password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
        $GLOBALS['pdo'] = $pdo;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die("Uh oh, le site n'a réussi à charger: " . $message);
    }