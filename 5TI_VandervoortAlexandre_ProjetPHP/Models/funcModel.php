<?php
    function get_pdo(): PDO {
        if (is_pdo_loaded()) {
            return $GLOBALS['pdo'];
        }
        throw new Exception("PDO not loaded");
    }

    function is_pdo_loaded(): bool {
        return isset($GLOBALS['pdo']);
    }

    function prepare_query(PDO $pdo, string $query): PDOStatement|false {
        return $pdo->prepare($query);
    }

    function execute_query(PDOStatement $prepared_query): void {
        $prepared_query->execute();
    }
    function get_query_response(PDOStatement $executed_query): array|false {
        return $executed_query->fetchAll();
    }

    function run_query(PDO $pdo, $query): array {
        $prepared_query = prepare_query($pdo, $query);
        if (!$prepared_query) {
            throw new Exception("Failed to prepare query");
        }

        execute_query($prepared_query);
        $results = get_query_response($prepared_query);
        if (!$results) {
            throw new Exception("Failed to run query");
        }
        return $results;
    }