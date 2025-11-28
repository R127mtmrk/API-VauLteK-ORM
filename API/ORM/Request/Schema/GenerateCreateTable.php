<?php

function GenerateCreateTableSQL(string $table, array $schema): string {
    $columns = [];
    $constraints = [];

    foreach ($schema as $col => $props) {

        $line = "`$col` " . $props["type"];

        if (isset($props["length"])) {
            $line .= "(" . $props["length"] . ")";
        }

        if (!($props["nullable"] ?? true)) {
            $line .= " NOT NULL";
        }

        if (($props["auto_increment"] ?? false) === true) {
            $line .= " AUTO_INCREMENT";
        }

        if (($props["primary"] ?? false) === true) {
            $constraints[] = "PRIMARY KEY (`$col`)";
        }

        if (isset($props["foreign"])) {
            $fk = $props["foreign"];
            $constraints[] =
                "FOREIGN KEY (`$col`) REFERENCES {$fk['table']}({$fk['column']}) " .
                "ON DELETE {$fk['on_delete']} ON UPDATE {$fk['on_update']}";
        }

        $columns[] = $line;
    }

    $query = "CREATE TABLE `$table` (\n";
    $query .= "  " . implode(",\n  ", array_merge($columns, $constraints));
    $query .= "\n);";

    return $query;
}
