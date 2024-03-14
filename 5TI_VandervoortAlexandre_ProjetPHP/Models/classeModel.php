<?php
    require_once("Models/sqlFuncModel.php");

    function getClasseFromId(int $cla_id): stdClass {
        $pdo = get_pdo();
        $query = create_get_classe_from_id();
        $results = run_advanced_query($pdo, $query, [
            "id"=>$cla_id
        ]);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0];
    }

    function create_get_classe_from_id(): string {
        return "SELECT * FROM classes WHERE cla_id = :id";
    }