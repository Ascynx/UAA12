<?php
    require_once("Models/sqlFuncModel.php");

    function getAllPlanningsAfterFromTo(int $min, int $max): array {
        $pdo = get_pdo();
        $query = create_get_planning_after_query();
        $results = run_advanced_query($pdo, $query, [
            "date"=>date("Y-m-d", date_create()->getTimestamp())
        ]);
        if (sizeof($results) == 0) {
            return [];
        }
        $first = $results[0];
        $firstId = $first->pla_id;

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

    function getPlanningFromId(int $id): stdClass | null {
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

    function createNewPlanning(string $date, string $debut, string $duree): bool {
        $pdo = get_pdo();
        $query = create_new_planning_query();
        run_advanced_query($pdo, $query, [
            "date"=>$date,
            "heure"=>$debut,
            "duree"=>$duree
        ]);
        return true;
    }

    function create_get_planning_after_query() {
        return "SELECT * FROM plannings WHERE pla_date >= :date ORDER BY pla_date ASC";
    }

    function create_get_from_to_planning_query() {
        return "SELECT * FROM plannings WHERE pla_id >= :min AND pla_id <= :max";
    }

    function create_get_planning_query(): string {
        return "SELECT * FROM plannings WHERE pla_id = :id";
    }

    function create_new_planning_query(): string {
        return "INSERT INTO plannings (pla_date, pla_heure, pla_duree) VALUES (:date, :heure, :duree)";
    }