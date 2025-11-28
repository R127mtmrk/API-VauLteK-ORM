<?php
function saveSQL(string $filename, string $sql): void {
    $path = __DIR__ . "/../../../sql/" . $filename;
    if (!is_dir(dirname($path))) {
        mkdir(dirname($path), 0777, true);
    }
    file_put_contents($path, $sql . "\n\n", FILE_APPEND);
}
