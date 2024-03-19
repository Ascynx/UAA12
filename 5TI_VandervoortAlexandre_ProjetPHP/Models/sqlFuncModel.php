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

    function execute_with(PDOStatement $prepared_query, array $query_elements): void {
        $prepared_query->execute($query_elements);
    }

    function get_query_response(PDOStatement $executed_query): array|false {
        return $executed_query->fetchAll();
    }

    function run_query(PDO $pdo, string $query): array|Countable {
        $prepared_query = prepare_query($pdo, $query);
        if (!$prepared_query) {
            throw new Exception("Failed to prepare query");
        }

        execute_query($prepared_query);
        $results = get_query_response($prepared_query);
        if (!$results && !is_array($results) && !is_countable($results)) {
            throw new Exception("Failed to run query");
        }
        return $results;
    }

    function run_advanced_query(PDO $pdo, string $query, array $queryables): array|Countable {
        $prepared_query = prepare_query($pdo, $query);
        if (!$prepared_query) {
            throw new Exception("Failed to prepare query");
        }

        execute_with($prepared_query, $queryables);
        $results = get_query_response($prepared_query);
        if (!$results && !is_array($results) && !is_countable($results)) {
            throw new Exception("Failed to run query");
        }
        return $results;
    }