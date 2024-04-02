<?php
    require_once("Models/sqlFuncModel.php");

    function getEleveFromId(int $ele_id): stdClass | null {
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

    function getEleveFromName(string $ele_name, string $ele_firstname): stdClass | null  {
        $pdo = get_pdo();
        $query = create_get_eleve_from_name();
        $results = run_advanced_query($pdo, $query, [
            "name" => $ele_name,
            "firstname" => $ele_firstname
        ]);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0];
    }

    function create_get_eleve_from_id(): string {
        return "SELECT * FROM eleves WHERE ele_id = :id";
    }

    function create_get_eleve_from_name(): string {
        return "SELECT * FROM eleves WHERE ele_nom=:name AND ele_prenom=:firstname ORDER BY ele_cla_id DESC";
    }
