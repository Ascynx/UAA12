<?php
    require_once("Models/sqlFuncModel.php");

    function deleteEleve(int $id): bool {
        $pdo = get_pdo();
        $query = create_delete_eleve();

        run_advanced_query($pdo, $query, [
            "id"=>$id
        ]);
        return true;
    }

    function newEleve(string $nom, string $prenom, int $classe_id): bool {
        $pdo = get_pdo();

        $query = create_new_eleve();
        run_advanced_query($pdo, $query, [
            "nom"=>$nom,
            "prenom"=>$prenom,
            "classe_id"=>$classe_id
        ]);
        return true;
    }

    function editEleve(int $id, string $nom, string $prenom, int $classe_id): bool {
        $pdo = get_pdo();

        $cols = [];
        $vals = [];
        if ($nom != "") {
            //changé
            array_push($cols, "ele_nom");
            $vals["ele_nom_val"] = $nom;
        }

        if ($prenom != "") {
            //changé
            array_push($cols, "ele_prenom");
            $vals["ele_prenom_val"] = $prenom;
        }

        if ($classe_id != 0) {
            //changé
            array_push($cols, "ele_cla_id");
            $vals["ele_cla_id_val"] = $classe_id;
        }

        $vals["id"] = $id;
        $query = create_multi_value_eleve_update_query($cols);
        run_advanced_query($pdo, $query, $vals);
        return true;
    }

    function getAllElevesFromTo(int $min, int $max): array {
        $pdo = get_pdo();
        $query = create_get_all_eleves();
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

    function getEleveFromId(int $ele_id, bool $include_class = false): stdClass | null {
        $pdo = get_pdo();
        $query = create_get_eleve_from_id();
        if ($include_class) {
            $query = create_get_eleve_from_id_and_classe();
        }
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

    function create_get_eleve_from_id_and_classe(): string {
        return "SELECT * FROM eleves INNER JOIN classes ON eleves.ele_cla_id=classes.cla_id WHERE ele_id = :id";
    }

    function create_get_eleve_from_id(): string {
        return "SELECT * FROM eleves WHERE ele_id = :id";
    }

    function create_get_eleve_from_name(): string {
        return "SELECT * FROM eleves WHERE ele_nom=:name AND ele_prenom=:firstname ORDER BY ele_cla_id DESC";
    }

    function create_get_all_eleves(): string {
        return "SELECT eleves.ele_id, eleves.ele_nom, eleves.ele_prenom, classes.cla_annee FROM eleves INNER JOIN classes ON eleves.ele_cla_id=classes.cla_id";
    }

    function create_new_eleve(): string {
        return "INSERT INTO eleves (ele_nom, ele_prenom, ele_cla_id) VALUES (:nom, :prenom, :classe_id)";
    }

    function create_delete_eleve(): string {
        return "DELETE FROM eleves WHERE ele_id = :id";
    }

    function create_multi_value_eleve_update_query(array $columns) {
        $test = "UPDATE eleves SET";
        for ($i = 0; $i < sizeof($columns); $i++) {
            //donc si column = pla_date alors la clé est pla_date_val
            $test = $test . " " . $columns[$i] . "=:" . $columns[$i] . "_val"; 
        }
        return $test . " WHERE ele_id=:id";
    }