<?php
    require_once("Models/sqlFuncModel.php");

    function getEleveFromId(int $ele_id): stdClass {
        $pdo = get_pdo();
        $query = create_get_eleve_from_id();
        $results = run_advanced_query($pdo, $query, [
            "id"=>$ele_id
        ]);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0];
    }

    function create_get_eleve_from_id(): string {
        return "SELECT * FROM eleves WHERE ele_id = :id";
    }