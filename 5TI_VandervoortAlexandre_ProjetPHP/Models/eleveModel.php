<?php
    require_once("Models/sqlFuncModel.php");

    function getEleveFromId(int $ele_id): stdClass {
        $pdo = get_pdo();
        $query = create_get_eleve_from_id($ele_id);
        $results = run_query($pdo, $query);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0];
    }

    function create_get_eleve_from_id(int $id): string {
        return sprintf("SELECT * FROM eleves WHERE ele_id = %u", $id);
    }