<?php
    require_once("Models/sqlFuncModel.php");

    function getAllPlanningsFromTo(int $min, int $max): array {
        $pdo = get_pdo();
        $query = create_get_from_to_planning_query();
        $results = run_advanced_query($pdo, $query, [
            "min"=>$min,
            "max"=>$max
        ]);
        return $results;
    }

    function getPlanningFromId(int $id): stdClass {
        $pdo = get_pdo();
        $query = create_get_planning_query();
        $results = run_advanced_query($pdo, $query, [
            "id"=>$id
        ]);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0];
    }

    function create_get_from_to_planning_query() {
        return sprintf("SELECT * FROM plannings WHERE pla_id >= :min AND pla_id <= :max");
    }

    function create_get_planning_query(): string {
        return "SELECT * FROM plannings WHERE pla_id = :id";
    }