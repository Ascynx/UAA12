<?php
    require_once("Models/sqlFuncModel.php");

    function getAllClassesFromTo(int $min, int $max): array {
        $pdo = get_pdo();
        $query = create_get_all_classes();
        $results = run_advanced_query($pdo, $query, []);
        if (sizeof($results) == 0) {
            return [];
        }

        $newResults = [];
        $j = 0;
        for ($i = $min; $i < $max; $i++) {
            if (isset($results[$i])) {
                $newResults[$j] = $results[$i];
                $j++;
            } else {
                break;
            }
        }

        return $newResults;
    }

    function getClasseFromId(int $cla_id): stdClass | null {
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

    function findClasseFromName(string $cla_name): stdClass | null  {
        $pdo = get_pdo();
        $query = create_get_classe_from_name();
        $results = run_advanced_query($pdo, $query, [
            "nom" => $cla_name
        ]);
        if (sizeof($results) == 0) {
            return null;
        }
        return $results[0];
    }

    function create_get_all_classes(): string {
        return "SELECT * FROM classes";
    }

    function create_get_classe_from_id(): string {
        return "SELECT * FROM classes WHERE cla_id = :id";
    }

    function create_get_classe_from_name(): string {
        return "SELECT * FROM classes WHERE cla_annee=:nom ORDER BY cla_annee_scolaire DESC";
    }