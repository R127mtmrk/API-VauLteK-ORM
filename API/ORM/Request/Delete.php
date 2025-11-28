<?php

/**
 * @param string $table
 * @param array $where
 * @return array
 * @throws Exception
 */
function Delete(string $table, array $where): array
{
    if (!$where) {
        throw new Exception("DELETE requires WHERE clause");
    }

    $params = [];
    $query  = "DELETE FROM `$table`";

    // WHERE
    $parts = [];

    foreach ($where as $cond) {
        [$column, $operator, $value] = $cond;

        if (!in_array($operator, ["=", "!=", "LIKE"])) {
            throw new Exception("Invalid operator '$operator'");
        }

        $parts[] = "`$column` $operator ?";
        $params[] = $value;
    }

    $query .= " WHERE " . implode(" AND ", $parts);
    $query .=';';

    return [
        "query"  => $query,
        "params" => $params
    ];
}
