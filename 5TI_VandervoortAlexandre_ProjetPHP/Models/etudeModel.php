<?php
    require_once("Models/sqlFuncModel.php");

    function getEtudesFromPlanning(int $pla_id): array {
        $pdo = get_pdo();
        $query = create_get_etude_from_planning();
        $results = run_advanced_query($pdo, $query, [
            "id"=>$pla_id
        ]);
        return $results;
    }

    function getEtudesFromId(int $etu_id): stdClass | null {
        $pdo = get_pdo();
        $query = create_get_etude_from_id();
        $results = run_advanced_query($pdo, $query, [
            "id"=>$etu_id
        ]);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0];
    }

    function create_get_etude_from_planning() {
        return "SELECT * FROM etudes WHERE etu_pla_id = :id";
    }

    function create_get_etude_from_id(): string {
        return "SELECT * FROM etudes WHERE etu_id = :id";
    }