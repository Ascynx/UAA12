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

    function getEtudeFromId(int $etu_id): stdClass | null {
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

    function createEtude(int $id, string $type, string $raison, int $pla_id) {
        $pdo = get_pdo();
        if ($type == "classe") {
            $query = create_new_etude_classe_query();
        } else if ($type == "eleve") {
            $query = create_new_etude_eleve_query();
        }

        run_advanced_query($pdo, $query, [
            "raison" => $raison,
            "pla_id" => $pla_id,
            "id" => $id
        ]);
        return true;
    }

    function create_get_etude_from_planning() {
        return "SELECT * FROM etudes WHERE etu_pla_id = :id";
    }

    function create_get_etude_from_id(): string {
        return "SELECT * FROM etudes WHERE etu_id = :id";
    }

    function create_new_etude_classe_query(): string {
        return "INSERT INTO etudes (etu_raison, etu_pla_id, etu_cla_id) VALUES (:raison, :pla_id, :id)";
    }

    function create_new_etude_eleve_query(): string {
        return "INSERT INTO etudes (etu_raison, etu_pla_id, etu_ele_id) VALUES (:raison, :pla_id, :id)";
    }