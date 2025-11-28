<?php
/**
 * @param string|null $table
 * @param array $params
 * @return array $truncate[]
 */
function purge(array $params, ?string $table = null): array
{
    $query = "TRUNCATE TABLE ";

    if ($table === null) {
        $table = array_keys($params);
    }

    $truncate[] = "SET FOREIGN_KEY_CHECKS = 0;";

    foreach ($table as $column) {
        $truncate[] = $query . " " . $column . "`;";
    }

    $truncate[] = "SET FOREIGN_KEY_CHECKS = 1;";

    return $truncate;
}