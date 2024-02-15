<?php
    require_once("Models/sqlFuncModel.php");

    function getClasseFromId(int $cla_id): stdClass {
        $pdo = get_pdo();
        $query = create_get_classe_from_id($cla_id);
        $results = run_query($pdo, $query);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0];
    }

    function create_get_classe_from_id(int $id): string {
        return sprintf("SELECT * FROM classes WHERE cla_id = %u", $id);
    }