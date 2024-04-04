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

    function editEtude(int $id, int $sub_id, string $oldtype, string $type, string $raison) {
        $pdo = get_pdo();

        $edit_raison = $raison != "";
        $edit_sub = $sub_id != 0;
        if ($edit_raison) {
            $query = create_etude_update_query("etu_raison");
            echo(run_advanced_query($pdo, $query, [
                "val" => $raison,
                "id" => $id
            ]));
        }

        if ($edit_sub) {
            //set
            if ($type == "classe") {
                $col1 = "etu_cla_id";
            } else {
                $col1 = "etu_ele_id";
            }

            //unset
            if ($oldtype == "classe") {
                $col2 = "etu_cla_id";
            } else {
                $col2 = "etu_ele_id";
            }

            $query = create_etude_double_update_query($col1, $col2);
            echo(run_advanced_query($pdo, $query, [
                "val1" => $sub_id,
                "val2" => ""
            ]));
        }

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

    function create_etude_update_query($column): string {
        return sprintf("UPDATE etudes SET %s=:val WHERE etu_id=:id", $column);
    }

    function create_etude_double_update_query($column1, $column2): string {
        return sprintf("UPDATE etudes SET %s=:val1 %s=:val2 WHERE etu_id=:id", $column1, $column2);
    }