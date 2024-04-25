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

    function editClasse(int $id, string $cla_annee_scolaire, string $cla_annee) {
        $pdo = get_pdo();

        $cols = [];
        $vals = [];
        if ($cla_annee_scolaire != "") {
            array_push($cols, "cla_annee_scolaire");
            $vals["cla_annee_scolaire_val"] = $cla_annee_scolaire;
        }
        if ($cla_annee != "") {
            array_push($cols, "cla_annee");
            $vals["cla_annee_val"] = $cla_annee;
        }

        if (!isset($cols[0])) {
            return false;
        }

        $vals["id"] = $id;
        $query = create_multi_value_classe_update_query($cols);
        run_advanced_query($pdo, $query, $vals);
        return true;
    }

    function newClasse(string $cla_annee_scolaire, string $cla_annee) {
        $pdo = get_pdo();
        $query = create_new_classe();
        run_advanced_query($pdo, $query, [
            "annee_scolaire"=>$cla_annee_scolaire,
            "annee"=>$cla_annee
        ]);
        return true;
    }

    function deleteClasse(int $id) {
        $pdo = get_pdo();
        $query = create_delete_classe();

        run_advanced_query($pdo, $query, [
            "id"=>$id
        ]);
        return true;
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

    function create_new_classe(): string {
        return "INSERT INTO classes (cla_annee_scolaire, cla_annee) VALUES (:annee_scolaire, :annee)";
    }

    function create_delete_classe(): string {
        return "DELETE FROM classes WHERE cla_id=:id";
    }

    function create_multi_value_classe_update_query(array $columns) {
        $test = "UPDATE classes SET";
        for ($i = 0; $i < sizeof($columns); $i++) {
            //donc si column = pla_date alors la clé est pla_date_val
            $test = $test . " " . $columns[$i] . "=:" . $columns[$i] . "_val"; 
        }
        return $test . " WHERE cla_id=:id";
    }