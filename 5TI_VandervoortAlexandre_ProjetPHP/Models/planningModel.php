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

    function editPlanning(int $id, string $date, string $debut, string $duree) {
        $date_edited = ($date != "");
        $debut_edited = ($debut != "");
        $duree_edited = ($duree != "");

        $pdo = get_pdo();

        $cols = [];
        $vals = [];
        if ($date_edited) {
            array_push($cols, "pla_date");
            $vals["pla_date_val"] = $date;
        }
        if ($debut_edited) {
            array_push($cols, "pla_heure");
            $vals["pla_heure_val"] = $debut;
        }
        if ($duree_edited) {
            array_push($cols, "pla_duree");
            $vals["pla_duree_val"] = $duree;
        }

        $vals["id"] = $id;
        $query = create_multi_value_planning_update_query($cols);
        run_advanced_query($pdo, $query, $vals);
        return true;
    }

    function deletePlanning(int $id): bool {
        $pdo = get_pdo();

        $query = create_planning_delete_query();
        run_advanced_query($pdo, $query, [
            "id"=>$id
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

    function create_planning_delete_query(): string {
        return "DELETE FROM plannings WHERE pla_id=:id";
    }

    function create_multi_value_planning_update_query(array $columns) {
        $test = "UPDATE plannings SET";
        for ($i = 0; $i < sizeof($columns); $i++) {
            //donc si column = pla_date alors la clé est pla_date_val
            $test = $test . " " . $columns[$i] . "=:" . $columns[$i] . "_val"; 
        }
        return $test . " WHERE pla_id=:id";
    }