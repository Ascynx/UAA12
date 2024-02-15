<?php
    require_once("Models/sqlFuncModel.php");

    function getAllPlanningsFromTo(int $min, int $max): array {
        $pdo = get_pdo();
        $query = create_get_from_to_planning_query($min, $max);
        $results = run_query($pdo, $query);
        return $results;
    }

    function getPlanningFromId(int $id): stdClass {
        $pdo = get_pdo();
        $query = create_get_planning_query($id);
        $results = run_query($pdo, $query);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0];
    }

    function create_get_from_to_planning_query(int $min, int $max) {
        return sprintf("SELECT * FROM plannings WHERE pla_id >= %u AND pla_id <= %u", $min, $max);
    }

    function create_get_planning_query(int $id): string {
        return sprintf("SELECT * FROM plannings WHERE pla_id = %u", $id);
    }