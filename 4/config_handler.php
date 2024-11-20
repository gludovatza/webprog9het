<?php

function parseConfigFile($filename) {
    $config = [];
    $currentCategory = null;

    if (!file_exists($filename)) {
        throw new Exception("File not found: $filename");
    }

    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);

        if (preg_match('/^\[(.+)]$/', $line, $matches)) {
            $currentCategory = $matches[1];
            $config[$currentCategory] = [];
        } elseif ($currentCategory !== null && strpos($line, '=') !== false) {
            [$key, $value] = explode('=', $line, 2);
            $config[$currentCategory][trim($key)] = trim($value);
        }
    }

    return $config;
}

?>
