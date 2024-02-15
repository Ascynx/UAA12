<?php
    require_once("Models/sqlFuncModel.php");

    function getEtudesFromPlanning(int $pla_id): stdClass {
        $pdo = get_pdo();
        $query = create_get_etude_from_planning($pla_id);
        $results = run_query($pdo, $query);
        return $results;
    }

    function getEtudesFromId(int $etu_id): stdClass {
        $pdo = get_pdo();
        $query = create_get_etude_from_id($etu_id);
        $results = run_query($pdo, $query);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0];
    }

    function create_get_etude_from_planning(int $pla_id) {
        return sprintf("SELECT * FROM etudes WHERE etu_pla_id = %u", $pla_id);
    }

    function create_get_etude_from_id(int $id): string {
        return sprintf("SELECT * FROM etudes WHERE etu_id = %u", $id);
    }