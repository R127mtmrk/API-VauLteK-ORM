<?php

/**
 * @param string $table
 * @param array $data
 * @return array
 */
function Insert(string $table, array $data): array
{
    $columns = array_keys($data);
    $placeholders = array_fill(0, count($data), "?");
    $params = array_values($data);

    $query = "INSERT INTO `$table` ("
        . implode(", ", $columns)
        . ") VALUES ("
        . implode(", ", $placeholders)
        . ")";
    $query .=';';
    return [
        "query"  => $query,
        "params" => $params
    ];
}
