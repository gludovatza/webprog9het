<?php
require_once 'config_handler.php';

try {
    $config = parseConfigFile('config.ini');
} catch (Exception $e) {
    echo "Hiba: " . $e->getMessage();
    exit;
}

echo "<h1>Konfigurációs Beállítások</h1>";

foreach ($config as $category => $settings) {
    echo "<h2>[$category]</h2>";
    echo "<ul>";
    foreach ($settings as $key => $value) {
        echo "<li><strong>$key</strong>: $value</li>";
    }
    echo "</ul>";
}

echo "<a href='index.php'>Vissza</a>";
?>
