<?php
    session_start();
    require_once("Config/sqlConfig.php");
    try {
        $pdo = new PDO($str_conn, $sql_username, $sql_password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
        $GLOBALS['pdo'] = $pdo;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }

    require_once("Controllers/indexController.php");